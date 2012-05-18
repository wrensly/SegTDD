<?php
/**
 * This is the model class for table "constraint_text".
 * The followings are the available columns in table 'constraint_text':
 * @property integer $id
 * @property integer $field_id
 * @property integer $minlength
 * @property integer $maxlength
 * @property string $encoding
 * @property string $format
 * @property string $default_value
 * The followings are the available model relations:
 * @property Field $field
 */
class ConstraintText extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ConstraintText the static model class
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
		return 'constraint_text';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('minlength, maxlength','required'),
			array('id, field_id, minlength, maxlength', 'numerical', 'integerOnly'=>true),
			array('encoding, format, default_value', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, field_id, minlength, maxlength, encoding, format, default_value', 'safe', 'on'=>'search'),
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
			'field_id'	    => 'Field',
			'minlength'     => 'Minimum Length',
			'maxlength' 	=> 'Maximum Length',
			'encoding' 		=> 'Encoding',
			'format' 		=> 'Format',
			'default_value' => 'Default Value',
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
		$criteria->compare('minlength',$this->minlength);
		$criteria->compare('maxlength',$this->maxlength);
		$criteria->compare('encoding',$this->encoding,true);
		$criteria->compare('format',$this->format,true);
		$criteria->compare('default_value',$this->default_value,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
?>