<?php

/**
 * This is the model class for table "teacher".
 *
 * The followings are the available columns in table 'teacher':
 * @property string $TID
 * @property string $Firstname
 * @property string $Midname
 * @property string $Lastname
 * @property string $Address
 * @property string $Bdate
 * @property string $Status
 * @property string $Level
 * @property string $SubjectArea
 * @property string $inactiveDate
 *
 * The followings are the available model relations:
 * @property Account[] $accounts
 * @property Assignsubject[] $assignsubjects
 * @property Classlist[] $classlists
 * @property Subjectteach[] $subjectteaches
 */
class Teacher extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Teacher the static model class
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
		return 'teacher';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TID', 'required'),
			array('TID, Firstname, Midname, Lastname, SubjectArea', 'length', 'max'=>45),
			array('Address', 'length', 'max'=>100),
			array('Status, Level', 'length', 'max'=>5),
			array('Bdate, inactiveDate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TID, Firstname, Midname, Lastname, Address, Bdate, Status, Level, SubjectArea, inactiveDate', 'safe', 'on'=>'search'),
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
			'accounts' => array(self::HAS_MANY, 'Account', 'tid'),
			'assignsubjects' => array(self::HAS_MANY, 'Assignsubject', 'TID'),
			'classlists' => array(self::HAS_MANY, 'Classlist', 'TID'),
			'subjectteaches' => array(self::HAS_MANY, 'Subjectteach', 'TID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'TID' => 'Tid',
			'Firstname' => 'Firstname',
			'Midname' => 'Midname',
			'Lastname' => 'Lastname',
			'Address' => 'Address',
			'Bdate' => 'Bdate',
			'Status' => 'Status',
			'Level' => 'Level',
			'SubjectArea' => 'Subject Area',
			'inactiveDate' => 'Inactive Date',
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

		$criteria->compare('TID',$this->TID,true);
		$criteria->compare('Firstname',$this->Firstname,true);
		$criteria->compare('Midname',$this->Midname,true);
		$criteria->compare('Lastname',$this->Lastname,true);
		$criteria->compare('Address',$this->Address,true);
		$criteria->compare('Bdate',$this->Bdate,true);
		$criteria->compare('Status',$this->Status,true);
		$criteria->compare('Level',$this->Level,true);
		$criteria->compare('SubjectArea',$this->SubjectArea,true);
		$criteria->compare('inactiveDate',$this->inactiveDate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}