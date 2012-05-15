<?php

/**
 * This is the model class for table "field".
 *
 * The followings are the available columns in table 'field':
 * @property integer $id
 * @property string $fieldname
 * @property string $datatype
 * @property string $description
 * @property integer $multiple
 * @property string $alias
 * @property string $default
 * @property integer $entity_id
 * @property string $label
 * @property integer $required
 * @property integer $parent_id
 * @property integer $derived
 * @property integer $attribute
 *
 * The followings are the available model relations:
 * @property ConstraintDatetime[] $constraintDatetimes
 * @property ConstraintDerived[] $constraintDeriveds
 * @property ConstraintEnum[] $constraintEnums
 * @property ConstraintFile[] $constraintFiles
 * @property ConstraintNumeric[] $constraintNumerics
 * @property ConstraintText[] $constraintTexts
 * @property EntityAttribute[] $entityAttributes
 * @property Entity $entity
 * @property FieldValueCompound $fieldValueCompound
 * @property FieldValueDate[] $fieldValueDates
 * @property FieldValueDatetime[] $fieldValueDatetimes
 * @property FieldValueEnum[] $fieldValueEnums
 * @property FieldValueFile[] $fieldValueFiles
 * @property FieldValueNumeric[] $fieldValueNumerics
 * @property FieldValueText[] $fieldValueTexts
 * @property FieldValueTime[] $fieldValueTimes
 */
class EntityInst extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Field the static model class
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
		return 'field';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fieldname, label', 'required'),
			// array('entity_id', 'integerOnly'=>true),
			// array('fieldname', 'length', 'max'=>100),
			// array('datatype', 'length', 'max'=>1),
			// array('label', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('label', 'safe', 'on'=>'search'),
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
			'constraintDatetimes' => array(self::HAS_ONE, 'ConstraintDatetime', 'field_id'),
			'constraintDeriveds' => array(self::HAS_ONE, 'ConstraintDerived', 'field_id'),
			'constraintEnums' => array(self::HAS_ONE, 'ConstraintEnum', 'field_id'),
			'constraintFiles' => array(self::HAS_ONE, 'ConstraintFile', 'field_id'),
			'constraintNumerics' => array(self::HAS_ONE, 'ConstraintNumeric', 'field_id'),
			'constraintTexts' => array(self::HAS_ONE, 'ConstraintText', 'field_id'),
			'entityAttributes' => array(self::HAS_MANY, 'EntityAttribute', 'field_id'),
			'entity' => array(self::BELONGS_TO, 'Entity', 'entity_id'),
			'fieldValueCompound' => array(self::HAS_ONE, 'FieldValueCompound', 'id'),
			'fieldValueDates' => array(self::HAS_MANY, 'FieldValueDate', 'field_id'),
			'fieldValueDatetimes' => array(self::HAS_MANY, 'FieldValueDatetime', 'field_id'),
			'fieldValueEnums' => array(self::HAS_MANY, 'FieldValueEnum', 'field_id'),
			'fieldValueFiles' => array(self::HAS_MANY, 'FieldValueFile', 'field_id'),
			'fieldValueNumerics' => array(self::HAS_MANY, 'FieldValueNumeric', 'field_id'),
			'fieldValueTexts' => array(self::HAS_MANY, 'FieldValueText', 'field_id'),
			'fieldValueTimes' => array(self::HAS_MANY, 'FieldValueTime', 'field_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fieldname' => 'Field Name',
			'datatype' => 'Data Type',
			'entity_id' => 'Entity Association',
			'label' => 'Label',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($id)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->select = array('fieldname', 'label', 'datatype');
		$criteria->condition = 'entity_id=(select id from entity where form_id=(select form_id from entity where id='.$id.'))';

		$criteria->compare('id',$this->id);
		$criteria->compare('fieldname',$this->fieldname,true);
		$criteria->compare('datatype',$this->datatype,true);
		$criteria->compare('entity_id',$this->entity_id);
		$criteria->compare('label',$this->label,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	private static $_items=array();
		
	public static function items($type){
		if(!isset(self::$_items[$type]))
			self::loadItems($type);
		return self::$_items[$type];
	}
	
	public static function item($type,$code){
		if(!isset(self::$_items[$type]))
			self::loadItems($type);
		return isset(self::$_items[$type][$code]) ? self::$_items[$type][$code] : false;
	}
	
	private static function loadItems($type){
		self::$_items[$type]=array();
		$models=self::model()->findAll();
		foreach($models as $model)
			self::$_items[$type][$model->id]=$model->$type;

	}
}