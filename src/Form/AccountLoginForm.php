<?php
namespace App\Form;

use App\Model\Entity\User;
use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use Sodium\Compat;

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
            ->scalar('username')
            ->maxLength('username', 36)
            ->allowEmptyString('username', false);
        
        $validator
            ->scalar('password')
            ->maxLength('password', 36)
            ->allowEmptyString('password', false);
        
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
            return false;
        }

        if (!$user->is_activated)
        {
            return false;
        }

        $result = sodium_crypto_pwhash_str_verify($user->password, $data['password']);

        if ($result) 
        {
            $PreferencesTable = TableRegistry::getTableLocator()->get('Preferences');
            $preference = $PreferencesTable->find()->where([
                'user_id' => $user->id
            ])->first();

            $ProfilesTable = TableRegistry::getTableLocator()->get('Profiles');
            $profile = $ProfilesTable->find()->where([
                'user_id' => $user->id
            ])->first();

            $user->preference = $preference;
            $user->profile = $profile;            
            $this->user = $user;
        }
        
        return $result;
    }

    /**
     * @return App\Model\Entity\User
     */
    public function getAuthenticatedUser()
    {
        return $this->user;
    }
}