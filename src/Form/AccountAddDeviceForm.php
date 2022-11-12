<?php
namespace App\Form;

use App\Model\Entity\User;
use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use Laminas\Diactoros\UploadedFile;
use Sodium\Compat;
use stdClass;

class AccountAddDeviceForm extends Form
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
            ->addField('name', ['type' => 'string'])
            ->addField('number', ['type' => 'string'])
            ->addField('gateway', ['type' => 'string']);
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
            ->nonNegativeInteger('user_id')
            ->notEmptyString('user_id');

        $validator
            ->scalar('name', 'Invalid data type supplied.')
            ->maxLength('name', 100, 'The device name can be no more than 100 characters in length.')
            ->requirePresence('name', 'A name is required for the device.')
            ->notEmptyString('name', 'A name is required for the device.');

        $validator
            ->scalar('number', 'Invalid data type supplied.')
            ->maxLength('number', 15, 'The device number can be no more than 15 characters in length.')
            ->notEmptyString('number', 'A device number is required.');

        $validator
            ->scalar('gateway', 'Invalid data type supplied.')
            ->maxLength('gateway', 100, 'The mobile service provider gateway can be no more than 100 characters in length.')
            ->notEmptyString('gateway', 'A mobile service provider gateway is required.');

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
        $secretKey = $UsersTable->getUserKey($data['user_id']);
        $obj = new stdClass();
        $obj->name = $data['name'];
        $obj->number = $data['number'];
        $obj->gateway = $data['gateway'];
        $json = json_encode($obj);
        $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
        $ciphertext = sodium_crypto_secretbox($json, $nonce, $secretKey);
        $result = sodium_bin2base64($nonce . $ciphertext, SODIUM_BASE64_VARIANT_ORIGINAL);
        $DevicesTable = TableRegistry::getTableLocator()->get('Devices');
        $device = $DevicesTable->newEntity([
            'user_id' => $data['user_id'],
            'data' => $result
        ]);
        sodium_memzero($ciphertext);
        sodium_memzero($nonce);
        sodium_memzero($secretKey);

        return $DevicesTable->save($device) ? true : false;
    }
}