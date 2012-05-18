<?php
/**
 * This is the model class for table "entity_instance".
 *
 * The followings are the available columns in table 'entity_instance':
 * @property integer $id
 * @property integer $entity_id
 *
 * The followings are the available model relations:
 * @property Entity $entity
 * @property FieldValueCompound[] $fieldValueCompounds
 * @property FieldValueDate[] $fieldValueDates
 * @property FieldValueDatetime[] $fieldValueDatetimes
 * @property FieldValueEnum[] $fieldValueEnums
 * @property FieldValueFile[] $fieldValueFiles
 * @property FieldValueNumeric[] $fieldValueNumerics
 * @property FieldValueText[] $fieldValueTexts
 * @property FieldValueTime[] $fieldValueTimes
 */
class EntityInstance extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EntityInstance the static model class
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
		return 'entity_instance';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('id, entity_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, entity_id', 'safe', 'on'=>'search'),
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
			'entity'              => array(self::BELONGS_TO, 'Entity', 'entity_id'),
			'fieldValueCompounds' => array(self::HAS_MANY, 'FieldValueCompound', 'entity_instance_id'),
			'fieldValueDates' 	  => array(self::HAS_MANY, 'FieldValueDate', 'entity_instance_id'),
			'fieldValueDatetimes' => array(self::HAS_MANY, 'FieldValueDatetime', 'entity_instance_id'),
			'fieldValueEnums' 	  => array(self::HAS_MANY, 'FieldValueEnum', 'entity_instance_id'),
			'fieldValueFiles' 	  => array(self::HAS_MANY, 'FieldValueFile', 'entity_instance_id'),
			'fieldValueNumerics'  => array(self::HAS_MANY, 'FieldValueNumeric', 'entity_instance_id'),
			'fieldValueTexts' 	  => array(self::HAS_MANY, 'FieldValueText', 'entity_instance_id'),
			'fieldValueTimes' 	  => array(self::HAS_MANY, 'FieldValueTime', 'entity_instance_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'entity_id' => 'Entity',
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
		$criteria->compare('entity_id',$this->entity_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
?>