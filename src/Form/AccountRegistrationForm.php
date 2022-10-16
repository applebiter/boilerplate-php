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

class AccountRegistrationForm extends Form
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
            ->addField('password', ['type' => 'string'])
            ->addField('repassword', ['type' => 'string'])
            ->addField('email', ['type' => 'string'])
            ->addField('reemail', ['type' => 'string'])
            ->addField('agreed_to_terms', ['type' => 'bool'])
            ->addField('read_privacy_policy', ['type' => 'bool'])
            ->addField('email_opt_in', ['type' => 'bool'])
            ->addField('newsletter_opt_in', ['type' => 'bool']);
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
            ->asciiAlphaNumeric('username')
            ->maxLength('username', 36)
            ->allowEmptyString('username', false);
        
        $validator
            ->scalar('password')
            ->ascii('password')
            ->maxLength('password', 36)
            ->allowEmptyString('password', false);
        
        $validator
            ->sameAs('repassword', 'password', 'The passwords do not match.', true);

        $validator
            ->scalar('email')
            ->ascii('password')
            ->email('email')
            ->maxLength('email', 100)
            ->allowEmptyString('email', false);
        
        $validator 
            ->sameAs('reemail', 'email', 'The email addresses do not match.', true);

        $validator
            ->requirePresence('agreed_to_terms')
            ->equals('agreed_to_terms', 1)
            ->requirePresence('read_privacy_policy')
            ->equals('read_privacy_policy', 1)
            ->requirePresence('email_opt_in', false)
            ->requirePresence('newsletter_opt_in', false);
        
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
        $user = $UsersTable->newEntity([
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => $data['password'],
            'secret' => base64_encode(Security::randomString(8)),
            'role_id' => 1,
            'is_activated' => 0,
            'agreed_to_terms' => isset($data['agreed_to_terms']) && $data['agreed_to_terms'] > 0 ? 1 : 0,
            'read_privacy_policy' => isset($data['read_privacy_policy']) && $data['read_privacy_policy'] > 0 ? 1 : 0,
            'email_opt_in' => isset($data['email_opt_in']) && $data['email_opt_in'] > 0 ? 1 : 0,
            'newsletter_opt_in' => isset($data['newsletter_opt_in']) && $data['newsletter_opt_in'] > 0 ? 1 : 0,
        ]);

        if (!$UsersTable->save($user))
        {
            return false;
        }

        $PreferencesTable = TableRegistry::getTableLocator()->get('Preferences');
        $preferences = $PreferencesTable->newEntity([
            'user_id' => $user->id,
            'theme' => 'default'
        ]);

        if (!$preferences = $PreferencesTable->save($preferences))
        {
            $UsersTable->delete($user);            
            return false;
        }

        $ProfilesTable = TableRegistry::getTableLocator()->get('Profiles');
        $profile = $ProfilesTable->newEntity([
            'user_id' => $user->id
        ]);

        if (!$profile = $ProfilesTable->save($profile))
        {
            $UsersTable->delete($user);
            $PreferencesTable->delete($preferences)            ;
            return false;
        }

        $email = new Mailer('default');
        $email->viewBuilder()->setTemplate('activate')->setLayout('default');
        $email
            ->setEmailFormat('both')
            ->setViewVars([
                'id' => $user->id,
                'secret' => $user->secret,
                'username' => $user->username,
                'website_name' => Configure::read('Applebiter.Mailer.website_name'),
                'host_name' => Configure::read('Applebiter.Mailer.host_name')
            ])
            ->setFrom(Configure::read('Applebiter.Mailer.email_from'))
            ->setTo($user->email)
            ->setSubject("Activate your new account with " . Configure::read('Applebiter.Mailer.website_name'))
            ->deliver();
        
        return true;
    }
}