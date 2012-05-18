<?php

/**
 * This is the model class for table "field_value_enum".
 *
 * The followings are the available columns in table 'field_value_enum':
 * @property integer $id
 * @property integer $field_id
 * @property string $value
 * @property integer $entity_id
 * @property integer $priority
 * @property integer $snapshot_id
 * @property integer $entity_instance_id
 *
 * The followings are the available model relations:
 * @property Entity $entity
 * @property EntityInstance $entityInstance
 * @property Field $field
 * @property Snapshot $snapshot
 */
class FieldValueEnum extends MyActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FieldValueEnum the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'field_value_enum';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('field_id, value, entity_id, priority, snapshot_id, entity_instance_id', 'required'),
			array('field_id, entity_id, priority, snapshot_id, entity_instance_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, field_id, value, entity_id, priority, snapshot_id, entity_instance_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'entity' => array(self::BELONGS_TO, 'Entity', 'entity_id'),
			'entityInstance' => array(self::BELONGS_TO, 'EntityInstance', 'entity_instance_id'),
			'field' => array(self::BELONGS_TO, 'Field', 'field_id'),
			'snapshot' => array(self::BELONGS_TO, 'Snapshot', 'snapshot_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'field_id' => 'Field',
			'value' => 'Value',
			'entity_id' => 'Entity',
			'priority' => 'Priority',
			'snapshot_id' => 'Snapshot',
			'entity_instance_id' => 'Entity Instance',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('field_id',$this->field_id);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('entity_id',$this->entity_id);
		$criteria->compare('priority',$this->priority);
		$criteria->compare('snapshot_id',$this->snapshot_id);
		$criteria->compare('entity_instance_id',$this->entity_instance_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}