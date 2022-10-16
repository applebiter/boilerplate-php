<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sounds Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Sound newEmptyEntity()
 * @method \App\Model\Entity\Sound newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Sound[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Sound get($primaryKey, $options = [])
 * @method \App\Model\Entity\Sound findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Sound patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Sound[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Sound|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sound saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sound[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sound[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sound[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sound[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SoundsTable extends Table
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

        $this->setTable('sounds');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
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
            ->scalar('location')
            ->maxLength('location', 255)
            ->requirePresence('location', 'create')
            ->notEmptyString('location');

        $validator
            ->scalar('filename')
            ->maxLength('filename', 255)
            ->allowEmptyFile('filename');

        $validator
            ->scalar('mimetype')
            ->maxLength('mimetype', 150)
            ->requirePresence('mimetype', 'create')
            ->notEmptyString('mimetype');

        $validator
            ->scalar('extension')
            ->maxLength('extension', 150)
            ->requirePresence('extension', 'create')
            ->notEmptyString('extension');

        $validator
            ->scalar('size')
            ->maxLength('size', 150)
            ->allowEmptyString('size');

        $validator
            ->scalar('duration_timecode')
            ->maxLength('duration_timecode', 150)
            ->allowEmptyString('duration_timecode');

        $validator
            ->scalar('duration_milliseconds')
            ->maxLength('duration_milliseconds', 150)
            ->allowEmptyString('duration_milliseconds');

        $validator
            ->scalar('bits_per_sample')
            ->maxLength('bits_per_sample', 150)
            ->allowEmptyString('bits_per_sample');

        $validator
            ->scalar('bitrate')
            ->maxLength('bitrate', 150)
            ->allowEmptyString('bitrate');

        $validator
            ->scalar('channels')
            ->maxLength('channels', 150)
            ->allowEmptyString('channels');

        $validator
            ->scalar('samplerate')
            ->maxLength('samplerate', 150)
            ->allowEmptyString('samplerate');

        $validator
            ->scalar('beats_per_minute')
            ->maxLength('beats_per_minute', 150)
            ->allowEmptyString('beats_per_minute');

        $validator
            ->scalar('genre')
            ->maxLength('genre', 150)
            ->allowEmptyString('genre');

        $validator
            ->scalar('title')
            ->maxLength('title', 150)
            ->allowEmptyString('title');

        $validator
            ->scalar('albumartist')
            ->maxLength('albumartist', 150)
            ->allowEmptyString('albumartist');

        $validator
            ->scalar('album')
            ->maxLength('album', 150)
            ->allowEmptyString('album');

        $validator
            ->scalar('tracknumber')
            ->maxLength('tracknumber', 150)
            ->allowEmptyString('tracknumber');

        $validator
            ->scalar('discnumber')
            ->maxLength('discnumber', 150)
            ->allowEmptyString('discnumber');

        $validator
            ->scalar('artist')
            ->maxLength('artist', 150)
            ->allowEmptyString('artist');

        $validator
            ->scalar('year')
            ->maxLength('year', 150)
            ->allowEmptyString('year');

        $validator
            ->scalar('label')
            ->maxLength('label', 150)
            ->allowEmptyString('label');

        $validator
            ->scalar('copyright')
            ->maxLength('copyright', 150)
            ->allowEmptyString('copyright');

        $validator
            ->scalar('composer')
            ->maxLength('composer', 150)
            ->allowEmptyString('composer');

        $validator
            ->scalar('producer')
            ->maxLength('producer', 150)
            ->allowEmptyString('producer');

        $validator
            ->scalar('engineer')
            ->maxLength('engineer', 150)
            ->allowEmptyString('engineer');

        $validator
            ->scalar('comment')
            ->allowEmptyString('comment');

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
}
