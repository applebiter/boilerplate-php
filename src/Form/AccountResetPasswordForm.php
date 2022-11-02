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

class AccountResetPasswordForm extends Form
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
            ->addField('identity', ['type' => 'string'])
            ->addField('secret', ['type' => 'string']);
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

        $validator
            ->notEmptyString('secret', 'The secret code sent to your email inbox is required.')
            ->maxLength('secret', 100, 'The secret code can be no more than 100 characters in length.')
            ->minLength('secret', 8, 'The secret code can be no fewer than 8 characters in length.');
        
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

        if (!$user = $UsersTable->find('resetPassword', [
            'identity' => $data['identity'],
            'secret' => $data['secret']
        ])->first())
        {
            $this->_errors = ['identity' => ['exists' => 'No account matching account was found or the confirmation code was expired.']];
            return false;
        }

        if (!$user->is_activated)
        {
            $this->_errors = ['identity' => ['inactive' => 'This account is not activated and cannot be modified until it has been activated.']];
            return false;
        }

        $user->secret = null;
        $password = $this->generateRandomString(rand(8, 15));
        $user->password = $password;

        $email = new Mailer('default');
        $email->viewBuilder()->setTemplate('newpassword')->setLayout('default');
        $email
            ->setEmailFormat('both')
            ->setViewVars([
                'username' => $user->username,
                'password' => $password,
                'email' => $user->email,
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