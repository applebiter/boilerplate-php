<?php
namespace App\Form;

use App\Model\Entity\User;
use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use Laminas\Diactoros\UploadedFile;

class AccountProfileForm extends Form
{
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
            ->scalar('full_name')
            ->maxLength('full_name', 60)
            ->allowEmptyString('full_name', true);
        
        $validator
            ->scalar('short_biography')
            ->maxLength('short_biography', 255)
            ->allowEmptyString('short_biography', true);
        
        $validator
            ->scalar('long_biography')
            ->maxLength('long_biography', 16383)
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
        if (isset($data['avatar']) && ($data['avatar'] instanceof UploadedFile) 
            && !$data['avatar']->geterror() && $data['avatar']->getSize())
        {
            if (!$mimetype = $this->isValidUploadedImageFile($data['avatar']))
            {
                return false;
            }
        }

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
}