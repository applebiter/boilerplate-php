<?php
namespace App\Form;

use App\Model\Entity\User;
use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use Sodium\Compat;
use stdClass;

class AccountLoginForm extends Form
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
            ->addField('username', ['type' => 'string'])
            ->addField('password', ['type' => 'string']);
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
            ->notEmptyString('password', 'A password must be provided.')
            ->ascii('password', 'Only ASCII characters are allowed in the password.')
            ->maxLength('password', 36, 'The password can be no more than 36 characters in length.')
            ->minLength('password', 8, 'The password can be no fewer than 8 characters in length.');
        
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

        if (!$user = $UsersTable->find('byUsername', [
            'username' => $data['username'
        ]])->first())
        {
            $this->_errors = ['username' => ['exists' => 'No account matching username "'.$data['username'].'" was found.']];
            return false;
        }

        if (!$user->is_activated)
        {
            $this->_errors = ['username' => ['activated' => 'The account matching username "'.$data['username'].'" has not been activated.']];
            return false;
        }

        $result = sodium_crypto_pwhash_str_verify($user->password, $data['password']);

        if (!$result) 
        {
            $this->_errors = ['password' => ['invalid' => 'The password is invalid.']];
            return false;
        }

        $PreferencesTable = TableRegistry::getTableLocator()->get('Preferences');
        $preference = $PreferencesTable->find()->where([
            'user_id' => $user->id
        ])->first();

        $ProfilesTable = TableRegistry::getTableLocator()->get('Profiles');
        $profile = $ProfilesTable->find()->where([
            'user_id' => $user->id
        ])->first();

        $RolesTable = TableRegistry::getTableLocator()->get('Roles');
        $role = $RolesTable->find()->where([
            'id' => $user->role_id
        ])->first();

        $user->preference = $preference;
        $user->profile = $profile;      
        $user->role = new stdClass();  
        $user->role->name = $role->name;          
        $this->user = $user;
        
        return true;
    }

    /**
     * @return App\Model\Entity\User
     */
    public function getAuthenticatedUser()
    {
        return $this->user;
    }
}