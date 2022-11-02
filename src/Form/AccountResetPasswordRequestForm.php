<?php
namespace App\Form;

use App\Model\Entity\User;
use Cake\Core\Configure;
use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Mailer\Mailer;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;
use Cake\Validation\Validator;

class AccountResetPasswordRequestForm extends Form
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
            ->addField('identity', ['type' => 'string']);
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
            ->notEmptyString('identity', 'A username or email address must be provided.')
            ->maxLength('identity', 100, 'The username or email address can be no more than 100 characters in length.')
            ->minLength('identity', 5, 'The username or email address can be no fewer than 5 characters in length.');
        
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
        $UsersTable = TableRegistry::getTableLocator()->get('Users');

        if (!$user = $UsersTable->find('resetPasswordRequest', [
            'identity' => $data['identity']
        ])->first())
        {
            $this->_errors = ['identity' => ['exists' => 'No account matching "'.$data['identity'].'" was found.']];
            return false;
        }

        if (!$user->is_activated)
        {
            $this->_errors = ['identity' => ['inactive' => 'The account matching "'.$data['username'].'" has not been activated, and no changes can be made to it.']];
            return false;
        }

        $user->secret = $this->generateRandomString(rand(8, 15));

        $email = new Mailer('default');
        $email->viewBuilder()->setTemplate('resetpwd')->setLayout('default');
        $email
            ->setEmailFormat('both')
            ->setViewVars([
                'secret' => $user->secret,
                'username' => $user->username,
                'website_name' => Configure::read('Applebiter.Mailer.website_name'),
                'host_name' => Configure::read('Applebiter.Mailer.host_name')
            ])
            ->setSender(Configure::read('Applebiter.Mailer.email_from'), Configure::read('Applebiter.Mailer.name_from'))
            ->setTo($user->email)
            ->setSubject("Did you request a password reset from " . Configure::read('Applebiter.Mailer.website_name') . "?")
            ->deliver();

        return $UsersTable->save($user) ? true : false;
    }

    /**
     * generateRandomString
     * 
     * @param int $length
     * @return string
     */
    public function generateRandomString($length = 10) 
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!)(?][_`~;:#$^&*+=';
        $charactersLength = strlen($characters);
        $randomString = '';
        
        for ($i = 0; $i < $length; $i++) 
        {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return utf8_decode($randomString);
    }
}