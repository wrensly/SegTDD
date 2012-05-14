<?php

/**
 * This is the unified model class for the following tables:
 * "field_value_text"
 * "field_value_numeric"
 * "field_value_date"
 * "field_value_time"
 * "field_value_datetime"
 * "field_value_enum"
 * "field_value_file"
 * "field_value_compound"
 *
 * The followings are the available columns in the tables above:
 * @property integer $id  Primary Index
 * 
 * @property string $filetype Value for the type of file of file data type
 * @property string $filename Value for the file data type
 * @property integer $field_value_id Value for the compound data type
 * @property string $value Value for the majority of the data types
 * @property double $value Value for the numeric data type
 * 
 * @property integer $priority Index for the ordering of multiple values
 * 
 * @property integer $field_id Foreign Index referencing Field
 * @property integer $entity_id Foreign Index referencing Entity
 * @property integer $snapshot_id Foreign Index referencing Snapshot
 * @property integer $entity_instance_id Foreign Index referencing Entity_Instance
 *
 * The followings are the available model relations:
 * @property Entity $entity
 * @property EntityInstance $entityInstance
 * @property Field $field
 * @property Snapshot $snapshot
 * 
 */
class FieldValue extends MyActiveRecord
{
	const TYPE_TEXT     ='T';
	const TYPE_NUMERIC  ='N';
	const TYPE_DATE     ='D';
	const TYPE_TIME     ='t';
	const TYPE_DATETIME ='d';
	const TYPE_OPTION   ='O';
	const TYPE_FILE     ='F';
	const TYPE_COMPOUND ='C';

	private $_fieldModel;
	private $_fieldValueModel;
	private $_metadata;
	private $_constraints;
	private $_constraintRules;
	private $_field_id;
	private $_md;
	

	/**
	 * Initializes the object with the associated field
	 * @param int $field_id the primary index of the field associated to.
	 * The function loads the metadata from the field's properties, loads
	 * the constraints associated with the field and generates rules from the
	 * loaded constraints. Since this model works on multiple tables, the
	 * function re-initialize the attributes based on the available columns
	 * from the table designed for the data type of the value.
	 */
	public function initValueOf($field_id){
		
		$this->_field_id = $field_id;
		// load the metadata for the field value
		$this->loadMetadata();
		// load and generate the constraints
		$this->loadConstraints();
		
		// re-initialize the attributes based on the loaded metadata
		// $this->attributes=$this->getMetaData()->attributeDefaults;
		$this->refreshMetaData();
		echo "<pre>";
		print_r($this->getMetaData());
		echo "</pre>";
		// set the attributes with the available data
		$this->setAttributes(array(
			'field_id'  => $this->_field_id,
			'entity_id' => $this->_metadata['entity_id'],
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FieldValueText the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name based on the datatype
	 * Returns the table 'field_value_text' by default
	 */
	public function tableName()
	{
		echo '<pre>';
		print_r($this->_metadata);
		echo '</pre>';
		echo ("<br>tableName() is invoked. Returning table for ".$this->_metadata['datatype']);
		switch($this->_metadata['datatype']){
			case self::TYPE_TEXT     : return 'field_value_text'; break;
			case self::TYPE_NUMERIC  : return 'field_value_numeric';  break;
			case self::TYPE_DATE     : return 'field_value_date'; break;
			case self::TYPE_TIME     : return 'field_value_time'; break;
			case self::TYPE_DATETIME : return 'field_value_datetime'; break;
			case self::TYPE_OPTION   : return 'field_value_enum'; break;
			case self::TYPE_FILE     : return 'field_value_file'; break;
			case self::TYPE_COMPOUND : return 'field_value_compound'; break;
			default                  : return 'field_value_text'; break;
		}
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, field_id, entity_id, priority, snapshot_id, entity_instance_id', 'numerical', 'integerOnly'=>true),
			array('value', 'safe'),
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

	/**i
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

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param string the class name which we loads the model from
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModelOf($classname, $id)
	{
		$model=$classname::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Loads the metadata from the values of the associated field in the field table.
	 */
	protected function loadMetadata(){
		$this->_fieldModel = $this->loadModelOf('Field',$this->_field_id);
		foreach($this->_fieldModel as $key => $value){
			$this->_metadata[$key] = $value;
		}
		echo "<pre>";
		print_r($this->_metadata);
		echo "</pre>";
	}

	/**
	 * Loads the constraints from the values of the associated constraint in the
	 * constraint table of the field's data type.
	 */
	protected function loadConstraints(){
		switch($this->_metadata['datatype']){
			case self::TYPE_TEXT     : $constraintDataType = "constraintText";     break;
			case self::TYPE_NUMERIC  : $constraintDataType = "constraintNumeric";  break;
			case self::TYPE_DATE     :
			case self::TYPE_TIME     :
			case self::TYPE_DATETIME : $constraintDataType = "constraintDatetime"; break;
			case self::TYPE_OPTION   : $constraintDataType = "constraintEnum";     break;
			case self::TYPE_FILE     : $constraintDataType = "constraintFile";     break;
			case self::TYPE_COMPOUND : $constraintDataType = "constraintCompound"; break;
		};
		$constraintModel = $this->_fieldModel->$constraintDataType;
		foreach($constraintModel as $key => $value){
			$this->_constraints[$key] = $value;
		}
		$this->generateConstraints();
	}
	/**
	 * @todo Generate Constraints defined in the loaded constraint
	 */
	protected function generateConstraints(){

	}

	public function setInstance($entity_instance_id){
		$this->setAttributes(array(
			'entity_instance_id'  => $entity_instance_id,
		));
	}

	
}
