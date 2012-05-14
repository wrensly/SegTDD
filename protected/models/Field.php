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
 * @property ConstraintDatetime[] $constraintDatetime
 * @property ConstraintDerived[] $constraintDerived
 * @property ConstraintEnum[] $constraintEnum
 * @property ConstraintFile[] $constraintFile
 * @property ConstraintNumeric[] $constraintNumeric
 * @property ConstraintText[] $constraintText
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
class Field extends MyActiveRecord
{
	const TYPE_TEXT     ='T';
	const TYPE_NUMERIC  ='N';
	const TYPE_DATE     ='D';
	const TYPE_TIME     ='t';
	const TYPE_DATETIME ='d';
	const TYPE_OPTION   ='O';
	const TYPE_FILE     ='F';
	const TYPE_COMPOUND ='C';

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
			array('fieldname, datatype, description, multiple, label, required, derived, attribute', 'required'),
			array('multiple, entity_id, required, parent_id, derived, attribute', 'numerical', 'integerOnly'=>true),
			array('fieldname', 'length', 'max'=>100),
			array('datatype', 'length', 'max'=>1),
			array('alias, default, label', 'length', 'max'=>45),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, fieldname, datatype, description, multiple, alias, default, entity_id, label, required, parent_id, derived, attribute', 'safe', 'on'=>'search'),
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
			'constraintDatetime' => array(self::HAS_ONE, 'ConstraintDatetime', 'field_id'),
			'constraintDerived' => array(self::HAS_ONE, 'ConstraintDerived', 'field_id'),
			'constraintEnum' => array(self::HAS_ONE, 'ConstraintEnum', 'field_id'),
			'constraintFile' => array(self::HAS_ONE, 'ConstraintFile', 'field_id'),
			'constraintNumeric' => array(self::HAS_ONE, 'ConstraintNumeric', 'field_id'),
			'constraintText' => array(self::HAS_ONE, 'ConstraintText', 'field_id'),
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
			'description' => 'Description',
			'multiple' => 'Multiple',
			'alias' => 'Alias',
			'default' => 'Default',
			'entity_id' => 'Entity Association',
			'label' => 'Label',
			'required' => 'Required',
			'parent_id' => 'Parent',
			'derived' => 'Derived',
			'attribute' => 'Attribute',
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

		$criteria->compare('fieldname',$this->fieldname,false);
		$criteria->compare('datatype',$this->datatype,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('multiple',$this->multiple);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('default',$this->default,true);
		$criteria->compare('entity_id',$this->entity_id);
		$criteria->compare('label',$this->label,false);
		$criteria->compare('required',$this->required);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('derived',$this->derived);
		$criteria->compare('attribute',$this->attribute);
		$criteria->compare('deleted',0);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
		
	}


		public function searchitem()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		

		$criteria=new CDbCriteria;

		$criteria=new CDbCriteria;


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
