<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\User;
use ArrayObject;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Event\EventInterface;
use Cake\I18n\FrozenTime;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;
use Cake\Utility\Text;
use Cake\Validation\Validator;
use Exception;

/**
 * Users Model
 *
 * @property \App\Model\Table\RolesTable&\Cake\ORM\Association\BelongsTo $Roles
 * @property \App\Model\Table\DevicesTable&\Cake\ORM\Association\HasMany $Devices
 * @property \App\Model\Table\PreferencesTable&\Cake\ORM\Association\HasMany $Preferences
 * @property \App\Model\Table\ProfilesTable&\Cake\ORM\Association\HasMany $Profiles
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('username');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Devices', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Images', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasOne('Preferences', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasOne('Profiles', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Sounds', [
            'foreignKey' => 'user_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->uuid('uuid')
            ->add('uuid', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('username')
            ->maxLength('username', 36)
            ->requirePresence('username', 'create')
            ->notEmptyString('username')
            ->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('password')
            ->maxLength('password', 36)
            ->requirePresence('password', 'create')
            ->notEmptyString('password');

        $validator
            ->scalar('secret')
            ->maxLength('secret', 100)
            ->allowEmptyString('secret');

        $validator
            ->nonNegativeInteger('role_id')
            ->notEmptyString('role_id');

        $validator
            ->boolean('is_activated')
            ->notEmptyString('is_activated');

        $validator
            ->boolean('agreed_to_terms')
            ->requirePresence('agreed_to_terms', false);

        $validator
            ->boolean('read_privacy_policy')
            ->requirePresence('read_privacy_policy', false);

        $validator
            ->boolean('email_opt_in')
            ->requirePresence('email_opt_in', false);

        $validator
            ->boolean('newsletter_opt_in')
            ->requirePresence('newsletter_opt_in', false);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['email']), ['errorField' => 'email']);
        $rules->add($rules->isUnique(['username']), ['errorField' => 'username']);
        $rules->add($rules->isUnique(['uuid']), ['errorField' => 'uuid']);
        $rules->add($rules->existsIn('role_id', 'Roles'), ['errorField' => 'role_id']);

        return $rules;
    }
    
    /**
     * beforeSave
     *
     * On creation of a new user, a UUID (v4) is generated and inserted into the
     * user record. This identifier will be used to name a subdirectory under
     * the '/data/users' directory.
     *
     * In addition, a 256-bit encryption key will be generated and stored in a
     * file in the new user's directory. The key will be stored in a base64-
     * encoded string 44 characters in length. The file in which it is stored is
     * set to octal permissions 0600, granting the web app itself read-only
     * access and no permissions to group or others. The folder in which the
     * file resides is set with octal permissions 0700, granting read-write
     * ability to the application and no permissions to group or others.
     *
     * @param Event $event
     * @param User $user
     * @param ArrayObject $options
     */
    public function beforeSave(Event $event, User $user, ArrayObject $options)
    {
        if ($user->isNew())
        {
            /*
             * First, a UUID (RFC 4122) is generated and inserted into the new
             * user record.
             */
            $user->uuid = Text::uuid();
            
            /*
             * Set the date to use for archiving, build dir path as required
             */
            $date = date("Y-m-d", strtotime($user->created->format("Y-m-d H:i:s")));
            $basedir = Configure::read('Applebiter.Storage.userdata');
            $year = $basedir . DS . date("Y", strtotime($date));
            $month = $year . DS . date("m", strtotime($date));
            $day = $month . DS . date("d", strtotime($date));
            
            $dirname = $day . DS . $user->uuid;
            
            /*
             * Next, the UUID is used to name a new, protected directory which
             * will serve to protect sensitive user data outside of the
             * database. There is a non-zero, though astronomically unlikely
             * chance, that the new user's UUID was already generated and
             * assigned to a prior user. The following code will determine
             * whether this has occurred and will regenerate the UUID, if
             * necessary.
             */
            if (is_dir($dirname))
            {
                $user->uuid = Text::uuid();
                $dirname = $day . DS . $user->uuid;
            }
            
            /* The directory is created with the permissions set to 700, giving
             * only the owner (web server/application process) permission to see
             * inside and create files inside the directory.
             */
            mkdir($dirname, 0700, true);
            
            /* Generate a 256-bit encryption key for the user and store it
             * in the user's protected directory. The key is stored in a base64-
             * encoded string 44 characters in length in a file named
             * 'private.key', and its permissions are set to 600, giving even
             * the owner read-only permission. If the key cannot be successfully
             * written, the User will not be created in persistence.
             */
            $keyFile = $dirname . DS . 'private.key';
            $secretKey = sodium_crypto_secretbox_keygen();
            $secretKeyHex = sodium_bin2hex($secretKey);
            
            if (!file_put_contents($keyFile, $secretKeyHex, LOCK_EX))
            {
                return false;
            }
            
            return chmod($keyFile, 0600);
        }
    }
    
    /**
     * afterDelete
     *
     * @param Event $event
     * @param User $user
     * @param ArrayObject $options
     */
    public function afterDelete(Event $event, User $user, ArrayObject $options)
    {
        $preferences = $this->fetchTable('Preferences')->find()->where([
            'user_id' => $user->id
        ])->first();
        
        if ($preferences) 
        {
            $this->fetchTable('Preferences')->delete($preferences);
        }

        $profile = $this->fetchTable('Profiles')->find()->where([
            'user_id' => $user->id
        ])->first();
        
        if ($profile)
        {
            $this->fetchTable('Profiles')->delete($profile);
        }
        
        /*
         * Set the date of archiving, build dir path as required
         */
        $date = date("Y-m-d", strtotime($user->created->format("Y-m-d H:i:s")));
        $basedir = Configure::read('Applebiter.Storage.userdata');
        $year = $basedir . DS . date("Y", strtotime($date));
        $month = $year . DS . date("m", strtotime($date));
        $day = $month . DS . date("d", strtotime($date));        
        $dirname = $day . DS . $user->uuid;
        
        /*
         * The user's directory and private encryption key must be removed from
         * the filesystem.
         */
        $keyFile = $dirname . DS . 'private.key';
        
        if (!unlink($keyFile) || !rmdir($dirname))
        {
            return false;
        }
        
        return true;
    }
    
    /**
     * findByUsername
     *
     * @param Query $query
     * @param array $options
     * @return \Cake\Datasource\EntityInterface|array|NULL
     */
    public function findByUsername(Query $query, array $options)
    {
        return $query->where(['Users.username' => trim($options['username'])]);
    }
    
    /**
     * findActivate
     *
     * @param \Cake\ORM\Query $query
     * @param array $options
     * @return \Cake\Datasource\EntityInterface|array|NULL
     */
    public function findActivate(Query $query, array $options)
    {
        $query->where([
            'Users.username' => $options['username'],
            'Users.is_activated' => 0,
            'Users.secret' => $options['secret'],
            'Users.created >' => FrozenTime::now()->modify('-1 hour'),
        ]);
        
        return $query;
    }
    
    /**
     * findResetPasswordRequest
     *
     * This method returns a user whose email or username matches the user
     * input.
     *
     * @param \Cake\ORM\Query $query
     * @param array $options
     * @return \Cake\Datasource\EntityInterface|array|NULL
     */
    public function findResetPasswordRequest(Query $query, array $options)
    {
        $query = $this->find('all', [
            'conditions' => [
                'OR' => [
                    'Users.email LIKE' => $options['identity'],
                    'Users.username LIKE' => $options['identity']
                ]
            ]
        ]);
        
        return $query;
    }
    
    /**
     * findResetPassword
     *
     * @param \Cake\ORM\Query $query
     * @param array $options
     * @return \Cake\Datasource\EntityInterface|array|NULL
     */
    public function findResetPassword(Query $query, array $options)
    {
        $query->where([
            'Users.email' => $options['email'],
            'Users.is_activated' => 1,
            'Users.secret' => $options['secret'],
            'Users.modified >' => FrozenTime::now()->modify('-1 hour')
        ]);
        
        return $query;
    }
    
    /**
     * findByUuid method
     *
     * @param Query $query
     * @param array $options
     * @return \Cake\Datasource\EntityInterface|array|NULL
     */
    public function findByUuid(Query $query, array $options)
    {
        return $query->where(['Users.uuid LIKE' => $options['uuid']]);
    }
    
    /**
     * findByRoleId
     *
     * @param Query $query
     * @param array $options
     * @return \Cake\ORM\Query
     */
    public function findByRoleId(Query $query, array $options)
    {
        return $query->where(['Users.role_id' => $options['role_id']]);
    }
    
    /**
     * getUserKey
     *
     * @param int|string $id
     * @return bool|string
     */
    public function getUserKey($id) : string
    {
        if (!$user = $this->get($id))
        {
            return false;
        }
        
        $date  = $user->created->format("Y-m-d");
        $year  = Configure::read('Applebiter.Storage.userdata') . DS . date("Y", strtotime($date));
        $month = $year . DS . date("m", strtotime($date));
        $day = $month . DS . date("d", strtotime($date));        
        $file = $day . DS . $user->uuid . DS . 'private.key';
        
        if (!is_file($file) || !is_readable($file))
        {
            return false;
        }

        $secretKeyHex = file_get_contents($file); 
        return sodium_hex2bin($secretKeyHex);
    }
}
