<?php

/**
 * This is the model class for table "Entity".
 *
 * The followings are the available columns in table 'Entity':
 * @property integer $id
 * @property string $entity_name
 * @property string $description
 * @property integer $form_id
 *
 * The followings are the available model relations:
 * @property Form $form
 * @property EntityAttribute $entityAttribute
 * @property EntityInstance[] $entityInstances
 * @property Field[] $fields
 * @property FieldValueCompound[] $fieldValueCompounds
 * @property FieldValueDate[] $fieldValueDates
 * @property FieldValueDatetime[] $fieldValueDatetimes
 * @property FieldValueEnum[] $fieldValueEnums
 * @property FieldValueFile[] $fieldValueFiles
 * @property FieldValueNumeric[] $fieldValueNumerics
 * @property FieldValueText[] $fieldValueTexts
 * @property FieldValueTime[] $fieldValueTimes
 * @property Form[] $forms
 */
class Entity extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Entity the static model class
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
		return 'entity';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('form_id', 'numerical', 'integerOnly'=>true),
			array('entity_name, description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, entity_name, description, form_id', 'safe', 'on'=>'search'),
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
			'form' => array(self::BELONGS_TO, 'Form', 'form_id'),
			'entityAttribute' => array(self::HAS_ONE, 'EntityAttribute', 'id'),
			'entityInstances' => array(self::HAS_MANY, 'EntityInstance', 'entity_id'),
			'fields' => array(self::HAS_MANY, 'Field', 'entity_id'),
			'fieldValueCompounds' => array(self::HAS_MANY, 'FieldValueCompound', 'entity_id'),
			'fieldValueDates' => array(self::HAS_MANY, 'FieldValueDate', 'entity_id'),
			'fieldValueDatetimes' => array(self::HAS_MANY, 'FieldValueDatetime', 'entity_id'),
			'fieldValueEnums' => array(self::HAS_MANY, 'FieldValueEnum', 'entity_id'),
			'fieldValueFiles' => array(self::HAS_MANY, 'FieldValueFile', 'entity_id'),
			'fieldValueNumerics' => array(self::HAS_MANY, 'FieldValueNumeric', 'entity_id'),
			'fieldValueTexts' => array(self::HAS_MANY, 'FieldValueText', 'entity_id'),
			'fieldValueTimes' => array(self::HAS_MANY, 'FieldValueTime', 'entity_id'),
			'forms' => array(self::HAS_MANY, 'Form', 'entity_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'entity_name' => 'Entity Name',
			'description' => 'Description',
			'form_id' => 'Default Form',
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
		$criteria->compare('entity_name',$this->entity_name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('form_id',$this->form_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function search2($model)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->select = array('id','entity_name','description','form_id');
		$criteria->condition = 'select * from entity where entity_name='.$model.'';

		$criteria->compare('id',$this->id);
		$criteria->compare('entity_name',$this->entity_name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('form_id',$this->form_id,true);
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