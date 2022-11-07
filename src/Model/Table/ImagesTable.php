<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\Image;
use ArrayObject;
use Cake\Event\EventInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Images Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Image newEmptyEntity()
 * @method \App\Model\Entity\Image newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Image[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Image get($primaryKey, $options = [])
 * @method \App\Model\Entity\Image findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Image patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Image[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Image|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Image saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Image[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Image[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Image[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Image[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ImagesTable extends Table
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

        $this->setTable('images');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'dependent' => false,
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
            ->nonNegativeInteger('user_id')
            ->notEmptyString('user_id');

        $validator
            ->uuid('uuid')
            ->requirePresence('uuid', 'create')
            ->notEmptyString('uuid')
            ->add('uuid', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('title', 'Incorrect data type.')
            ->maxLength('title', 100, 'The title can be no more than 100 characters in length.')
            ->requirePresence('title', 'create', 'A title is required.')
            ->notEmptyString('title', 'A title is required.');

        $validator
            ->scalar('description', 'Incorrect data type.')
            ->maxLength('description', 16383, 'The description can be no more than 16383 characters in length.')
            ->allowEmptyString('description');

        $validator
            ->boolean('is_avatar')
            ->notEmptyString('is_avatar');

        $validator
            ->scalar('location', 'Incorrect data type.')
            ->maxLength('location', 127)
            ->allowEmptyString('location');

        $validator
            ->scalar('filename')
            ->maxLength('filename', 127)
            ->allowEmptyFile('filename');

        $validator
            ->nonNegativeInteger('size')
            ->allowEmptyString('size');

        $validator
            ->nonNegativeInteger('width')
            ->allowEmptyString('width');

        $validator
            ->nonNegativeInteger('height')
            ->allowEmptyString('height');

        $validator
            ->scalar('mimetype')
            ->maxLength('mimetype', 12)
            ->allowEmptyString('mimetype');

        $validator
            ->scalar('extension')
            ->maxLength('extension', 4)
            ->allowEmptyString('extension');

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
        $rules->add($rules->isUnique(['uuid']), ['errorField' => 'uuid']);
        $rules->add($rules->isUnique(['location', 'filename'], ['allowMultipleNulls' => true]), ['errorField' => 'location']);
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
    
    /**
     * beforeDelete
     *
     * @param EventInterface $event
     * @param Image $image
     * @param ArrayObject $options
     * @return boolean
     */
    public function beforeDelete(EventInterface $event, Image $image, $options)
    {
        $path = $image->location . DS . $image->filename;
        $parr = explode('.', $image->filename);
        $uuid = array_shift($parr);
        
        if (file_exists($image->location . DS . $uuid) && is_dir($image->location . DS . $uuid)) 
        {
            foreach (@scandir($image->location . DS . $uuid) as $item)
            {
                if ($item == '.' || $item == '..')
                {
                    continue;
                }
                else
                {
                    exec(sprintf(
                        "rm -rf %s/%s/%s", 
                        escapeshellarg($image->location),
                        escapeshellarg($uuid),
                        escapeshellarg($item)
                    ));
                }
            }
            exec(sprintf("rm -rf %s", escapeshellarg($image->location . DS . $uuid)));
        }
        
        exec(sprintf("rm -rf %s", escapeshellarg($path)));
        
        $dayIsEmpty = true;
        
        foreach (@scandir($image->location) as $item)
        {
            if ($item == '.' || $item == '..')
            {
                continue;
            }
            else
            {
                $dayIsEmpty = false;
            }
        }
        if ($dayIsEmpty)
        {
            exec(sprintf("rm -rf %s", escapeshellarg($image->location)));
        }
        
        $month = dirname($image->location);
        $monthIsEmpty = true;
        
        foreach (@scandir($month) as $item)
        {
            if ($item == '.' || $item == '..')
            {
                continue;
            }
            else
            {
                $monthIsEmpty = false;
            }
        }
        if ($monthIsEmpty)
        {
            exec(sprintf("rm -rf %s", escapeshellarg($month)));
        }
        
        $year = dirname($month);
        $yearIsEmpty = true;
        
        foreach (@scandir($year) as $item)
        {
            if ($item == '.' || $item == '..')
            {
                continue;
            }
            else
            {
                $yearIsEmpty = false;
            }
        }
        if ($yearIsEmpty)
        {
            exec(sprintf("rm -rf %s", escapeshellarg($year)));
        }
        
        return true;
    }
    
    /**
     * FindSearch method
     *
     * @param Query $query
     * @param array $options
     * @return \Cake\ORM\Query
     */
    public function findSearch(Query $query, array $options)
    {
        $query = $this->find('all', [
            'conditions' => [
                'OR' => [
                    'Images.title LIKE' => '%'.$$options['term'].'%',
                    'Images.description LIKE' => '%'.$$options['term'].'%'
                ],
            ]
        ]);
        
        return $query;
    }
}
