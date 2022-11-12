<?php
namespace App\Form;

use App\Model\Entity\User;
use Cake\Core\Configure;
use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use Sodium\Compat;

class AccountChangePasswordForm extends Form
{
    private $user;
    
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
            ->addField('old_password', ['type' => 'string'])
            ->addField('password', ['type' => 'string'])
            ->addField('repassword', ['type' => 'string']);
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
            ->scalar('old_password', 'Incorrect data type.')
            ->maxLength('old_password', 36, 'The password can be no more than 36 characters in length.')
            ->minLength('old_password', 8, 'The password can be no fewer than 8 characters in length.')
            ->notEmptyString('old_password', 'Your current password must be provided.');
        
        $validator
            ->scalar('password', 'Incorrect data type.')
            ->notEmptyString('password', 'A new password must be provided.')
            ->ascii('password', 'Only ASCII characters are allowed in the password.')
            ->maxLength('password', 36, 'The password can be no more than 36 characters in length.')
            ->minLength('password', 8, 'The password can be no fewer than 8 characters in length.');
        
        $validator
            ->scalar('repassword', 'Incorrect data type.')
            ->notEmptyString('repassword', 'The new password must be entered twice.')
            ->sameAs('repassword', 'password', 'The passwords do not match.', true);

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
        $user = $UsersTable->get($data['user_id']);
        $verified = sodium_crypto_pwhash_str_verify($user->password, $data['old_password']);

        if (!$verified)
        {
            return false;
        }        
               
        $user->password = $data['password'];        
        return $UsersTable->save($user) ? true : false;
    }
}