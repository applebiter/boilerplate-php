<?php
namespace App\Form;

use App\Model\Entity\User;
use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

class AccountPreferencesForm extends Form
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
            ->addField('theme', ['type' => 'string'])
            ->addField('timezone', ['type' => 'string']);
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
            ->scalar('theme')
            ->maxLength('theme', 36)
            ->inList('theme', $this->getThemes());
        
        $validator
            ->scalar('timezone')
            ->maxLength('timezone', 150)
            ->inList('timezone', $this->getTimezones());
        
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
        $PreferencesTable = TableRegistry::getTableLocator()->get('Preferences');

        if (!$preferences = $PreferencesTable->find()->where([
            'user_id' => $data['user_id']
        ])->first())
        {
            return false;
        }

        $preferences->theme = $data['theme'];
        $preferences->timezone = $data['timezone'];

        return $PreferencesTable->save($preferences) ? true : false;
    }

    /**
     * getThemes
     * 
     * @return string[]
     */
    public function getThemes() 
    {
        $themes = [
            'cerulean', 'cosmo', 'cyborg', 'darkly', 'default', 'flatly', 
            'journal', 'litera', 'lumen', 'lux', 'materia', 'minty', 
            'morph', 'pulse', 'quartz', 'sandstone', 'simplex', 'sketchy',
            'slate', 'solar', 'spacelab', 'superhero', 'united', 'vapor', 
            'yeti', 'zephyr'
        ];
        $assoc = [];

        foreach ($themes as $theme)
        {
            $assoc[$theme] = ucfirst($theme);
        }

        return $assoc;
    }

    /**
     * getTimezones
     * 
     * @return string[]
     */
    public function getTimezones()
    {
        $ZonesTable = TableRegistry::getTableLocator()->get('Zones');
        $zones = $ZonesTable->find()->order(['Zones.name' => 'ASC']);
        $timezones = [];

        foreach ($zones as $zone)
        {
            $timezones[$zone->name] = $zone->name;
        }

        return $timezones;
    }
}