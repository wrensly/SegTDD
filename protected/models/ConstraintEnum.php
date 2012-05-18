<?php
/**
 * This is the model class for table "constraint_enum".
 * The followings are the available columns in table 'constraint_enum':
 * @property integer $id
 * @property integer $field_id
 * @property integer $maxselect
 * @property integer $minselect
 * @property string $picklist
 * @property string $default_value
 *
 * The followings are the available model relations:
 * @property Field $field
 */
class ConstraintEnum extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ConstraintEnum the static model class
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
		return 'constraint_enum';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, field_id, maxselect, minselect', 'numerical', 'integerOnly'=>true),
			array('picklist, default_value', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, field_id, maxselect, minselect, picklist, default_value', 'safe', 'on'=>'search'),
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
			'field' => array(self::BELONGS_TO, 'Field', 'field_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' 			=> 'ID',
			'field_id' 		=> 'Field',
			'maxselect'	    => 'Maximum No. of Selected Items',
			'minselect' 	=> 'Minimum No. of Selected Items',
			'picklist' 		=> 'Picklist',
			'default_value' => 'Default Selected Value',
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
		$criteria->compare('maxselect',$this->maxselect);
		$criteria->compare('minselect',$this->minselect);
		$criteria->compare('picklist',$this->picklist,true);
		$criteria->compare('default_value',$this->default_value,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
?>