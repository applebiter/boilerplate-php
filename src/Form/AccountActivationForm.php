<?php
namespace App\Form;

use App\Model\Entity\User;
use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use Sodium\Compat;

class AccountActivationForm extends Form
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
            ->addField('username', ['type' => 'string'])
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
            ->notEmptyString('username', 'A username must be provided.')
            ->asciiAlphaNumeric('username', 'Only letters and numbers are allowed in a username.')
            ->maxLength('username', 36, 'The username can be no more than 36 characters in length.')  
            ->minLength('username', 5, 'The username can be no fewer than 5 characters in length.');
        
        $validator
            ->notEmptyString('secret', 'An activation code must be provided.')
            ->maxLength('secret', 100, 'The activation code can be no more than 100 characters in length.')
            ->minLength('secret', 8, 'The activation code can be no fewer than 8 characters in length.');
        
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

        if (!$UsersTable->find('byUsername', ['username' => $data['username']])->first())
        {
            $this->_errors = ['username' => [
                'exists' => 'No account was found matching username "'.$data['username'].'"'
            ]];
            return false;
        }

        if ($expired = $UsersTable->find('expired', ['username' => $data['username']])->first())
        {
            $UsersTable->delete($expired);
            $this->_errors = ['secret' => [
                'expired' => 'The activation code has expired. You will have to start the registration process over from the beginning.'
            ]];
            return false;
        }

        if (!$user = $UsersTable->find('activate', [
            'username' => $data['username'],
            'secret' => $data['secret'
        ]])->first())
        {
            $this->_errors = ['username' => [
                'unknown' => 'An error was encountered. Perhaps you have already activated the account? Try logging in.'
            ]];
            return false;
        }

        $user->secret = null;
        $user->is_activated = 1;

        return $UsersTable->save($user) ? true : false;
    }
}