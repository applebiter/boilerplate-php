<?php
namespace App\Form;

use App\Model\Entity\User;
use Cake\Core\Configure;
use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use Cake\Utility\Text;
use Laminas\Diactoros\UploadedFile;

class AccountProfileForm extends Form
{
    /**
     * @var App\Model\Entity\Profile
     */
    private $profile;
    
    /**
     * _buildSchema 
     * 
     * {@inheritDoc}
     * @see \Cake\Form\Form::_buildSchema()
     */
    protected function _buildSchema(Schema $schema) : Schema
    {
        return $schema
            ->addField('user_id', ['type' => 'int'])
            ->addField('avatar', ['type' => 'file'])
            ->addField('full_name', ['type' => 'string'])
            ->addField('short_biography', ['type' => 'string'])
            ->addField('long_biography', ['type' => 'text']);
    }
    
    /**
     * validationDefault
     * 
     * {@inheritDoc}
     * @see \Cake\Form\Form::validationDefault
     */
    public function validationDefault(Validator $validator) : Validator
    {
        $validator  
            ->integer('user_id');
        
        $validator
            ->scalar('full_name', 'Incorrect data type.')
            ->maxLength('full_name', 60, 'This value can be no more than 60 characters in length.')
            ->allowEmptyString('full_name', true);
        
        $validator
            ->scalar('short_biography', 'Incorrect data type.')
            ->maxLength('short_biography', 255, 'This value can be no more than 255 characters in length.')
            ->allowEmptyString('short_biography', true);
        
        $validator
            ->scalar('long_biography', 'Incorrect data type.')
            ->maxLength('long_biography', 16383, 'This value can be no more than 16383 characters in length.')
            ->allowEmptyString('long_biography', true);
        
        return $validator;
    }
    
    /**
     * _execute 
     * 
     * {@inheritDoc}
     * @see \Cake\Form\Form::_execute()
     */
    protected function _execute(array $data) : bool
    {
        $ProfilesTable = TableRegistry::getTableLocator()->get('Profiles');        
        
        if (!$this->profile = $ProfilesTable->find()->where(['user_id' => $data['user_id']])->first())
        {
            return false;
        }
        
        if (isset($data['avatar']) && ($data['avatar'] instanceof UploadedFile) 
            && !$data['avatar']->geterror() && $data['avatar']->getSize())
        {
            
            
            $mimetype = $this->isValidUploadedImageFile($data['avatar']);
            
            if ($mimetype === false)
            {
                $this->_errors = ['avatar' => ['mimetype' => 'Only files of type GIF, JPEG, or PNG are allowed.']];
                return false;
            }
            
            $ImagesTable = TableRegistry::getTableLocator()->get('Images');
            
            $uuid = Text::uuid();
            $date = date("Y-m-d H:i:s");
            $path  = Configure::read('Applebiter.Storage.imagedata') . '/' . date("Y", strtotime($date));
            $path = $path . '/' . date("m", strtotime($date));
            $location = $path . '/' . date("d", strtotime($date));
            
            if (!is_dir($location))
            {
                if (!@mkdir($location, 0700, true))
                {
                    $this->_errors = ['avatar' => ['filesystem' => 'Unable to create the image storage directory.']];
                    return false;
                }
            }
            
            $nameArr = explode('.', $data['avatar']->getClientFilename());
            $originalFilename = current($nameArr);
            $originalFilename = addcslashes(strip_tags($originalFilename), '$');
            $extension = end($nameArr);
            $extension = trim(strtolower($extension));
            $filename = $uuid . '.' . $extension;
            $path = $location . '/' . $filename;
            $size = $data['avatar']->getSize();
            
            $data['avatar']->moveTo($path);
            
            $dimensions = getimagesize($path);
            $image = $ImagesTable->newEmptyEntity();
            $image->user_id = $data['user_id'];
            $image->is_avatar = 1;
            $image->uuid = $uuid;
            $image->location =$location;
            $image->filename = $filename;
            $image->extension = $extension;
            $image->mimetype = $mimetype;
            $image->title = $originalFilename;
            $image->size = $size;
            $image->width = $dimensions[0];
            $image->height = $dimensions[1];
            $image->created = $date;
            $image->modified = $date;

            if ($existing = $ImagesTable->find()
                ->where(['user_id' => $data['user_id'], 'is_avatar' => 1])
                ->first())
            {
                $ImagesTable->delete($existing);
            }
            
            if (!$ImagesTable->save($image))
            {
                $this->_errors = ['avatar' => ['database' => 'Unable to insert the image into the database.']];
                return false;
            } 

            $data['avatar'] = "/images/show/{$image->id}";
        } 
        else 
        {
            $data['avatar'] = null;
        }

        $this->profile->avatar = $data['avatar'] ? $data['avatar'] : $this->profile->avatar;
        $this->profile->full_name = $data['full_name'];
        $this->profile->short_biography = $data['short_biography'];
        $this->profile->long_biography = $data['long_biography'];        
        $this->profile = $ProfilesTable->save($this->profile);
        
        return true;
    }
    
    /**
     * isValidUploadedImageFile method
     *
     * @param UploadedFile $uploaded
     * @throws Exception
     * @return string|boolean
     */
    protected function isValidUploadedImageFile($uploaded)
    {
        $allowed = [
            'gif' => 'image/gif',
            'jpg' => 'image/jpeg',
            'png' => 'image/png'
        ];
        
        $tmpName = $uploaded->getStream()->getMetadata('uri');
        $filename = addcslashes($uploaded->getClientFilename(), '$');
        $arr = explode('.', $filename);
        $extension = count($arr) ? strtolower(array_pop($arr)) : 'nope';
        
        if (array_key_exists($extension, $allowed))
        {
            $mimetype = shell_exec("file -b --mime-type -m /usr/share/misc/magic \"$tmpName\"");
            $mimetype = $mimetype ? trim($mimetype) : $mimetype;
            
            if ($mimetype && $mimetype == $allowed[$extension])
            {
                return $mimetype;
            }
        }
        
        return false;
    }

    public function getProfile()
    {
        return $this->profile;
    }
}