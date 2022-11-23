<?php
namespace App\Form;

use App\Model\Entity\User;
use Cake\Core\Configure;
use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Mailer\Mailer;
use Cake\Utility\Security;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use Sodium\Compat;

class AdminRolesAddForm extends Form
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
        return $schema->addField('name', ['type' => 'string']);
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
            ->scalar('name', 'Incorrect data type.')
            ->notEmptyString('name', 'A Role name is required.')
            ->maxLength('name', 30, 'The name can be no more than 30 characters in length.');
        
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
        $RolesTable = TableRegistry::getTableLocator()->get('Roles');
        $exists = $RolesTable->find()->where(['name' => $data['name']])->first();

        if ($exists) 
        {
            $this->_errors = ['role' => ['exists' => 'That Role already exists.']];
            return false;
        }

        $role = $RolesTable->newEmptyEntity();
        $role->name = $data['name'];
        
        return $RolesTable->save($role) ? true : false;
    }
}