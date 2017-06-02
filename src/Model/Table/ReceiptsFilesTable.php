<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ReceiptsFiles Model
 *
 * @method \App\Model\Entity\ReceiptsFile get($primaryKey, $options = [])
 * @method \App\Model\Entity\ReceiptsFile newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ReceiptsFile[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ReceiptsFile|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReceiptsFile patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ReceiptsFile[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ReceiptsFile findOrCreate($search, callable $callback = null, $options = [])
 */
class ReceiptsFilesTable extends Table
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

        $this->setTable('receipts_files');
        $this->setDisplayField('id_receipt');
        $this->setPrimaryKey(['id_receipt', 'id_file']);
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
            ->integer('id_receipt')
            ->allowEmpty('id_receipt', 'create');

        $validator
            ->integer('id_file')
            ->allowEmpty('id_file', 'create');

        return $validator;
    }
}
