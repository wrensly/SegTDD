<?php

/**
 * This is the model class for table "Form".
 *
 * The followings are the available columns in table 'Form':
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property integer $status
 * @property string $tags
 * @property string $layout
 * @property integer $entity_id
 * @property integer $attribute
 *
 * The followings are the available model relations:
 * @property Entity $entity
 * @property FormCategory[] $formCategories
 */
class Form extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Form the static model class
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
		return 'Form';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			
			array('id, status, entity_id, attribute', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>50),
			array('name, description, tags, layout', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, code, name, description, status, tags, layout, entity_id, attribute', 'safe', 'on'=>'search'),
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
			'formCategories' => array(self::HAS_MANY, 'FormCategory', 'form_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'code' => 'Code',
			'name' => 'Name',
			'description' => 'Description',
			'status' => 'Status',
			'tags' => 'Tags',
			'layout' => 'Layout',
			'entity_id' => 'Entity',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('layout',$this->layout,true);
		$criteria->compare('entity_id',$this->entity_id);
		$criteria->compare('attribute',$this->attribute);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}