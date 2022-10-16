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

class AccountResetPasswordRequestForm extends Form
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
            ->addField('identity', ['type' => 'string']);
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
            ->scalar('identity')
            ->maxLength('identity', 100)
            ->allowEmptyString('identity', false);
        
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

        if (!$user = $UsersTable->find('resetPasswordRequest', [
            'identity' => $data['identity']
        ])->first())
        {
            return false;
        }

        if (!$user->is_activated)
        {
            return false;
        }

        $user->secret = base64_encode(Security::randomBytes(8));

        $email = new Mailer('default');
        $email->viewBuilder()->setTemplate('resetpwd')->setLayout('default');
        $email
            ->setEmailFormat('both')
            ->setViewVars([
                'secret' => $user->secret,
                'username' => $user->username,
                'website_name' => Configure::read('Applebiter.Mailer.website_name'),
                'host_name' => Configure::read('Applebiter.Mailer.host_name')
            ])
            ->setFrom(Configure::read('Applebiter.Mailer.email_from'))
            ->setTo($user->email)
            ->setSubject("Did you request a password reset from " . Configure::read('Applebiter.Mailer.website_name') . "?")
            ->deliver();

        return $UsersTable->save($user) ? true : false;
    }
}