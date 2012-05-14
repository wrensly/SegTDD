<?php

/**
 * This is the model class for tables "field_value_*".
 *
 * The followings are the available columns in tables 'field_value_*':
 *
 * The followings are the available model relations:
 */
class FieldValueModel extends CActiveRecord
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
	/**
	 * Constructor.
	 * @param int $field_id primary key of the field to associate a field value on.
	 */
	public function __construct($field_id)
	{
		parent::__construct();
		
		$_fieldModel = $this->loadModelOf('Field',$field_id);

		switch($_fieldModel->datatype){
			case self::TYPE_TEXT     : $_fieldValueModel = new FieldValueText;     break;
			case self::TYPE_NUMERIC  : $_fieldValueModel = new FieldValueNumeric;  break;
			case self::TYPE_DATE     : $_fieldValueModel = new FieldValueDate;     break;
			case self::TYPE_TIME     : $_fieldValueModel = new FieldValueTime;     break;
			case self::TYPE_DATETIME : $_fieldValueModel = new FieldValueDatetime; break;
			case self::TYPE_OPTION   : $_fieldValueModel = new FieldValueEnum;     break;
			case self::TYPE_FILE     : $_fieldValueModel = new FieldValueFile;     break;
			case self::TYPE_COMPOUND : $_fieldValueModel = new FieldValueCompound; break;
		}
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
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'field_value_text';
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
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModelOf($class, $id)
	{
		$model=$class::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}