<?php
class MyActiveRecord extends CActiveRecord
{
   /**
    * Override of delete function, if in the table exists '' field  
    * then it logically deletes the record by saving a value like 'Y' in the field. 
    * @return boolean whether the deletion is successful.
    * @throws CException if the record is new
    */
    public function delete()
    {
        if(!$this->getIsNewRecord())
        {
            Yii::trace(get_class($this).'.delete()','system.db.ar.CActiveRecord');
            if($this->beforeDelete())
            {
                if ($this->hasAttribute('deleted')) 
                {
                    //logical deletion
                    $this->setAttribute('deleted', true); 
                    $result=$this->save();
                } else {
                    $result=$this->deleteByPk($this->getPrimaryKey())>0;
                }
                $this->afterDelete();
            }
            return $result;
        }
        else
        throw new CDbException(Yii::t('yii','The active record cannot be deleted because it is new.'));
    }
}