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
 * @property integer $attribute
 *
 * The followings are the available model relations:
 * @property ConstraintDatetime[] $constraintDatetime
 * @property ConstraintComputed[] $constraintComputed
 * @property ConstraintEnum[] $constraintEnum
 * @property ConstraintFile[] $constraintFile
 * @property ConstraintNumeric[] $constraintNumeric
 * @property ConstraintText[] $constraintText
 * @property EntityAttribute[] $entityAttributes
 * @property Entity $entity
 * @property Field $parent
 * @property Field[] $fields
 * @property FieldValueCompound[] $fieldValueCompounds
 * @property FieldValueComputed[] $fieldValueComputeds
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
	const TYPE_COMPUTED ='X';
	const TYPE_COMPOUND ='C';

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Field the static model class
	 */

	private $_newProperty;

     public function getNewProperty(){
         return $this->_newProperty;
     }

     public function setNewProperty($newProperty){
         $this->_newProperty = $newProperty;
     }

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
			array('fieldname, datatype, description, multiple, label, required, attribute', 'required'),
			array('multiple, entity_id, required, parent_id, attribute', 'numerical', 'integerOnly'=>true),
			array('fieldname', 'length', 'max'=>100),
			array('datatype', 'length', 'max'=>1),
			array('alias, default, label', 'length', 'max'=>45),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, fieldname, datatype, description, multiple, alias, default, entity_id, label, required, parent_id, attribute', 'safe', 'on'=>'search'),
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
			'constraintComputed' => array(self::HAS_ONE, 'ConstraintComputed', 'field_id'),
			'constraintEnum' => array(self::HAS_ONE, 'ConstraintEnum', 'field_id'),
			'constraintFile' => array(self::HAS_ONE, 'ConstraintFile', 'field_id'),
			'constraintNumeric' => array(self::HAS_ONE, 'ConstraintNumeric', 'field_id'),
			'constraintText' => array(self::HAS_ONE, 'ConstraintText', 'field_id'),
			'entityAttributes' => array(self::HAS_MANY, 'EntityAttribute', 'field_id'),
			'entity' => array(self::BELONGS_TO, 'Entity', 'entity_id'),
			'parent' => array(self::BELONGS_TO, 'Field', 'parent_id'),
            'fields' => array(self::HAS_MANY, 'Field', 'parent_id'),
			'fieldValueCompounds' => array(self::HAS_MANY, 'FieldValueCompound', 'id'),
			'fieldValueComputeds' => array(self::HAS_MANY, 'FieldValueComputed', 'id'),
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
		$criteria->compare('attribute',$this->attribute);
		$criteria->compare('deleted',0);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));

	}


	public function search3($model)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->select = array('entity_id','fieldname', 'label', 'datatype', 'description', 'multiple','required','derived','attribute');
		$criteria->condition = 'select * from field where fieldname='.$model.'';

		$criteria->compare('id',$this->id);
		$criteria->compare('entity_id',$this->entity_id);
		$criteria->compare('fieldname',$this->fieldname,true);
		$criteria->compare('label',$this->label,true);
		$criteria->compare('datatype',$this->datatype,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('description',$this->description,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	

public function search2($id)
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
	
	/**
	 * Function for getting a list of records
	 * @param string the name of the property to load
	 * @return string[] array of records $primary_index => $property 
	 */	
	public static function items($property){
		if(!isset(self::$_items[$property]))
			self::loadItems($property);
		return self::$_items[$property];
	}
	
	/**
	 * Function for getting a list of records if the list is not set
	 * @param string the name of the property to load
	 * @return string[] array of records $primary_index => $property 
	 */	
	private static function loadItems($property){
		self::$_items[$property]=array();
		$criteria=new CDbCriteria;
		$criteria->compare('deleted',0);
		$models=self::model()->findAll($criteria);
		foreach($models as $model)
			self::$_items[$property][$model->id]=$model->$property;
	}
}
