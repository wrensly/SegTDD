<?php

class RenderField extends CActiveRecord {

	private $prop;

	public function getProp()
	{
        return $this->prop;
    }

    public function setProp($newProperty)
    {
        $this->prop = $newProperty;
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

	public function search($id)
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

}

?>