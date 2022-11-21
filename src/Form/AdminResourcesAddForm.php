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

class AdminResourcesAddForm extends Form
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
            ->addField('path', ['type' => 'string'])
            ->addField('type', ['type' => 'string']);
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
            ->scalar('path', 'Incorrect data type.')
            ->notEmptyString('path', 'A resource path is required.')
            ->maxLength('path', 128, 'The path can be no more than 128 characters in length.');
        
        $validator
            ->scalar('type', 'Incorrect data type.')
            ->maxLength('type', 7, 'The resource type can be no more than 7 characters in length.')
            ->inList('type', ['URI', 'FILE', 'ENTITY', 'TABLE', 'SERVICE']);
        
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
        $ResourcesTable = TableRegistry::getTableLocator()->get('Resources');
        $exists = $ResourcesTable->find()->where([
            'path' => $data['path'],
            'type IS' => $data['type']
        ])->first();

        if ($exists) 
        {
            $this->_errors = ['resource' => ['exists' => 'That combination of path and type has already been defined.']];
            return false;
        }

        $resource = $ResourcesTable->newEmptyEntity();
        $resource->path = $data['path'];
        $resource->type = $data['type'];
        
        return $ResourcesTable->save($resource) ? true : false;
    }
}