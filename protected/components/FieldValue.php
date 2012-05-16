<?php

class FieldValue
{
	private $_fieldModel;
	private $_fieldValueModel;
	private $_metadata;
	private $_constraints;
	private $_constraintRules;
	private $_field_id;
	private $_staticModel;
	
	public function __construct($field_id){
		$this->_field_id = $field_id;
		$this->loadMetadata();
		$this->loadConstraints();
		$this->loadFieldValueModel();
	}

	public function model()
	{
		return $this->_fieldValueModel->model();
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
			case 'T' : $constraintDataType = "constraintText";     break;
			case 'N' : $constraintDataType = "constraintNumeric";  break;
			case 'D' :   
			case 't' :
			case 'd' : $constraintDataType = "constraintDatetime"; break;
			case 'O' : $constraintDataType = "constraintEnum";     break;
			case 'F' : $constraintDataType = "constraintFile";     break;
			case 'X' : $constraintDataType = "constraintComputed"; break;
			case 'C' : $constraintDataType = "constraintCompound"; break;
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

	/**
	 * @todo Generate Constraints defined in the loaded constraint
	 */
	protected function loadFieldValueModel(){
		switch($this->_metadata['datatype']){
			case 'T' : $this->_fieldValueModel = new FieldValueText;     break;
			case 'N' : $this->_fieldValueModel = new FieldValueNumeric;  break;
			case 'D' : $this->_fieldValueModel = new FieldValueDate;     break;
			case 't' : $this->_fieldValueModel = new FieldValueTime;     break;
			case 'd' : $this->_fieldValueModel = new FieldValueDatetime; break;
			case 'O' : $this->_fieldValueModel = new FieldValueEnum;     break;
			case 'F' : $this->_fieldValueModel = new FieldValueFile;     break;
			case 'X' : $this->_fieldValueModel = new FieldValueComputed; break;
			case 'C' : $this->_fieldValueModel = new FieldValueCompound; break;
		};
	}
	
}