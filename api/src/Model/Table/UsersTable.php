<?php

namespace App\Model\Table;

use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
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
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('username')
            ->maxLength('username', 255)
            ->requirePresence('username', 'create', 'Username is required.')
            ->notEmptyString('username');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create', 'Password is required.')
            ->notEmptyString('password');

        $validator
            ->integer('gender')
            ->requirePresence('gender', 'create', 'Gender is required')
            ->notEmptyString('gender');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create', 'Name is required')
            ->notEmptyString('name');

        $validator
            ->scalar('surname')
            ->maxLength('surname', 255)
            ->requirePresence('surname', 'create', 'Surname is required')
            ->notEmptyString('surname');

        $validator
            ->email('email')
            ->requirePresence('email', 'create', 'Email is required')
            ->notEmptyString('email');

        $validator
            ->dateTime('birth')
            ->requirePresence('birth', 'create', 'Birth is required')
            ->notEmptyDateTime('birth');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 255)
            ->requirePresence('phone', 'create', 'Phone is required')
            ->notEmptyString('phone');

        $validator
            ->scalar('mobile')
            ->maxLength('mobile', 255)
            ->requirePresence('mobile', 'create', 'Mobile is required')
            ->notEmptyString('mobile');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['username'], 'This username is already registered'));
        $rules->add($rules->isUnique(['email'], 'This email is already registered'));

        return $rules;
    }


    /**
     * Modifies password before saving into database
     *
     * @param Event $event Event
     * @param EntityInterface $entity Entity
     * @param ArrayObject $options Array of options
     * @return bool
     */
    public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
    {
        if (isset($entity->password)) {
            $entity->password = md5($entity->password);
        }

        return true;
    }
}
