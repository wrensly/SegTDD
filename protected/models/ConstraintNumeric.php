<?php
/**
 * This is the model class for table "constraint_numeric".
 * The followings are the available columns in table 'constraint_numeric':
 * @property integer $id
 * @property integer $field_id
 * @property double $minvalue
 * @property double $maxvalue
 * @property double $default_value
 * @property integer $decimaldigit
 * The followings are the available model relations:
 * @property Field $field
 */
class ConstraintNumeric extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ConstraintNumeric the static model class
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
		return 'constraint_numeric';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, field_id, decimaldigit', 'numerical', 'integerOnly'=>true),
			array('minvalue, maxvalue, default_value', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, field_id, minvalue, maxvalue, default_value, decimaldigit', 'safe', 'on'=>'search'),
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
			'id' 		   => 'ID',
			'field_id' 	   => 'Field',
			'minvalue' 	   => 'Minimum Value',
			'maxvalue' 	   => 'Maximum Value',
			'default_value'=> 'Default Value',
			'decimaldigit' => 'No. of Decimal Digits',
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
		$criteria = new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('field_id',$this->field_id);
		$criteria->compare('minvalue',$this->minvalue);
		$criteria->compare('maxvalue',$this->maxvalue);
		$criteria->compare('default_value',$this->default_value);
		$criteria->compare('decimaldigit',$this->decimaldigit);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
?>