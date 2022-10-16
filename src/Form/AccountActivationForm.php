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
            ->scalar('username')
            ->maxLength('username', 36)
            ->allowEmptyString('username', false);
        
        $validator
            ->scalar('secret')
            ->maxLength('secret', 36)
            ->allowEmptyString('secret', false);
        
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

        if (!$user = $UsersTable->find('activate', [
            'username' => $data['username'],
            'secret' => $data['secret'
        ]])->first())
        {
            return false;
        }

        if ($user->is_activated)
        {
            return true;
        }

        $user->secret = null;
        $user->is_activated = 1;

        return $UsersTable->save($user) ? true : false;
    }
}