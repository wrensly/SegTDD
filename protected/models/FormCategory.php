<?php
/**
 * This is the model class for table "form_category".
 *
 * The followings are the available columns in table 'form_category':
 * @property integer $id
 * @property integer $category_id
 * @property integer $form_id
 * @property string  $code
 * @property string  $name,
 * @property string  $description, 
 * @property boolean $status, 
 * @property string  $layout, 
 * @property string  $category_name, 
 * @property integer $entity_id, 
 * @property string  $tags;
 * The followings are the available model relations:
 * @property Category $category
 * @property Form $form
 */
class FormCategory extends CActiveRecord
{
	/**	
	 * @todo Compose PHP doc
	 */
	public $code; 
	public $name; 
	public $description; 
	public $status; 
	public $layout;
	public $attribute; 
	public $category_name;
	public $entity_id;
	public $tags;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FormCategory the static model class
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
		return 'form_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, form_id, status, attribute', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>50),
			array('category_id', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('category_name, code, name, description, layout, entity_id, tags', 'safe', 'on'=>'search'),
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
			'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
			'form' 	   => array(self::BELONGS_TO, 'Form', 'form_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'		    => 'ID',
			'category_id' 	=> 'Category',
			'form_id' 		=> 'Form',
			'category_name' => 'Category',
			'code' 			=> 'Form Code',
			'name' 			=> 'Form Name',
			'description'   => 'Description',
			'layout' 		=> 'Layout',
			'attribute' 	=> 'Attribute',
			'status' 		=> 'Active',
			'entity_id' 	=> 'Entity Name',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 * Added additional conditions for the searching of tags.
	 * Added relational search with related tables (Form, Category)
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria=new CDbCriteria;
		$criteria->with = array('form','category');

		$criteria->alias = 'fc';
		$criteria->select= 't.tag_name as tag_name';
		$criteria->join= 'LEFT JOIN form f ON (f.id=fc.form_id) LEFT JOIN form_tag ft on (fc.form_id = ft.form_id) 
		LEFT JOIN tag t on (t.id = ft.tag_id)';
		$criteria->compare('form.code',$this->code, true);
		$criteria->compare('form.name',$this->name, true);
		$criteria->compare('form.description',$this->description, true);
		$criteria->compare('category.category_name',$this->category_name, true);
		$criteria->compare('form.status',$this->status, true);
		$criteria->compare('form.entity_id',$this->entity_id, true);
		$criteria->compare('tag_name',$this->tags, true);	
		return new CActiveDataProvider($this, array(
			'criteria'  => $criteria,
			'sort'	    => array(
        	'attributes'=> array(
        	'id',

        	'category_name' =>array(
                'asc'		=>'form.description',
                'desc'		=>'form.description DESC',
            ),

            'name' => array( 
                'asc'	=>'form.name',
                'desc'	=>'form.name DESC',
            ),

            'code' => array(
                'asc'	=>'form.code',
                'desc'	=>'form.code DESC',
            ),

            'description' => array(
                'asc'	=>'form.description',
                'desc'	=>'form.description DESC',
            ),
        		
            'status' => array(
                'asc'	=>'form.status',
                'desc'	=>'form.status DESC',
            ),   
        ),
    ),
		));
	}
	
	/**	
	 * @todo Compose PHP doc
	 */
	public function search3($model)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->select = array('code','name', 'description', 'status',);
		$criteria->condition = 'select * from field where fieldname='.$model.'';

		$criteria->compare('id',$this->id);
		$criteria->compare('entity_id',$this->entity_id);
		$criteria->compare('fieldname',$this->fieldname,true);
		$criteria->compare('label',$this->label,true);
		$criteria->compare('datatype',$this->datatype,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('description',$this->description,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	 * @return array of Tag that is associated with the form
	 * @param id of the form.
	 * 
	 */
	public function getTags($id)
	{
		$sql = "select t.tag_name as tagName from tag t left join form_tag ft on (t.id = ft.tag_id)
		left join form f on (f.id = ft.form_id) where f.id = :id";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindParam(":id",$id,PDO::PARAM_STR);
		$tags = $command->query()->readAll();
		$arr = array();
		foreach($tags as $row)
		{
			$arr[] = $row['tagName'];
		}
		return $arr;
	}
}
?>