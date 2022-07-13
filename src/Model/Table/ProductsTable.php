<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Database\Type;
/**
 * Products Model
 *
 * @method \App\Model\Entity\Product get($primaryKey, $options = [])
 * @method \App\Model\Entity\Product newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Product[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Product|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Product saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Product patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Product[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Product findOrCreate($search, callable $callback = null, $options = [])
 */
class ProductsTable extends Table
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

        $this->setTable('products');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
    }

  
    public function validationDefault(Validator $validator)
    {
       
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create')
        
        
            ->scalar('name') 
            ->maxLength('name', 255)
            ->requirePresence('name', 'name must field out')
            ->notEmptyString('name', 'Please fill this field')

   
            ->scalar('unit')
            ->maxLength('unit', 255)
            ->requirePresence('unit', 'create')
            ->notEmptyString('unit', 'Please fill this field')

      
            ->decimal('price')
            ->requirePresence('price', 'price must field out')
            ->notEmptyString('price')

   
            ->dateTime('expiry')
             ->requirePresence('expiry', 'expiry must field out')
            ->notemptyDateTime('expiry')

    
            ->decimal('inventory')
            ->requirePresence('inventory', 'inventory must field out')
            ->notEmptyString('inventory')
       
    
            ->allowEmptyString('image');

        return $validator;
        
    }
   

    public function CheckIfExist($name)
    {
        $query = $this->find()->where(['name' => $name])->count();
        return $query;
    }
}