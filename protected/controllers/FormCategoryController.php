<?php

class FormCategoryController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1_mod';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','formeditor','xmleditor'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);
		$form = Form::model()->findByPk($model->form_id);
		$entity = Entity::model()->findByPk($form->entity_id);
		$tags = $model->getTags($model->form_id);
		$this->render('view',array(
			'model'=>$model,
			'entity'=>$entity,
			'tags'=>$tags,
		));

	}

	/**
	 * Creates a new model.
	 * Creates a new Tag if does not exist and associates it with the form
	 * Associate Category to Form
	 * Associate form to an Entity
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Form;
		$tags = new Tag;
		$formTag = new FormTag;
		$category = new Category;
		$formCategory = new FormCategory;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Form']))
		{
			$model->attributes=$_POST['Form'];
			
			if($model->save())
			{
				$tags->attributes=$_POST['Tag'];
				$arr = preg_split('/,/', $tags->tag_name, -1, PREG_SPLIT_NO_EMPTY);

				foreach($arr as $val)
				{
					$tags->tag_name = trim($val);
					$tagCount = Tag::model()->findByAttributes(array('tag_name' => $tags->tag_name));

				if($tagCount == null)
				{
					$tags->save();
					$formTag->tag_id = $tags->id;
					$tags = new Tag;
				}
				else
				{
					$formTag->tag_id = $tagCount->id;
				}
					$formTag->form_id = $model->id;
					$formTag->save();
					$formTag = new FormTag;
				}

			}

				$formCategory->attributes=$_POST['FormCategory'];
				$formCategory->form_id = $model->id;
				$formCategory->save(false);
				$this->redirect(array('view','id'=>$formCategory->id));
		}
		

			$this->render('create',array(
			'model'=>$model,
			'formCategory' => $formCategory,
			'category' => $category,
			'tags' => $tags,
			'suggest' => $this->actionSuggest(),
		));
	}

	/**
	 * Updates a particular model.
	 * Updates association of Tags.
	 * Updates association Category to Form.
	 * Updates association of form to an Entity
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		
		$tags = new Tag;
		$category=new Category;
		$formTag = new FormTag;
		$formCategory=$this->loadModel($id);
		$model=Form::model()->findByPk($formCategory->form_id);
		$tags->tag_name = implode(',', $formCategory->getTags($model->id));
		FormTag::model()->deleteAll('form_id = :form_id', array(':form_id' => $model->id));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Form']))
		{
			$model->attributes=$_POST['Form'];
			if($model->save())
			{
				$tags = new Tag;
				$tags->attributes=$_POST['Tag'];
				$arr = preg_split('/,/', $tags->tag_name, -1, PREG_SPLIT_NO_EMPTY);
				
				foreach($arr as $val)
				{
					$tags->tag_name = trim($val);
					$tagCount = Tag::model()->findByAttributes(array('tag_name' => $tags->tag_name));
				if($tagCount == null)
				{
					$tags->save();
					$formTag->tag_id = $tags->id;
					$tags = new Tag;
				}
				else
				{
					$formTag->tag_id = $tagCount->id;
				}
					$formTag->form_id = $model->id;
					$formTag->save();
					$formTag = new FormTag;
				}

			}

				$formCategory->attributes=$_POST['FormCategory'];
				$formCategory->form_id = $model->id;
				$formCategory->save();
				$this->redirect(array('view','id'=>$formCategory->id));	
		}
		

			$this->render('update',array(
			'model'=>$model,
			'formCategory'=>$formCategory,
			'category' => $category,
			'tags' => $tags,
			'suggest' => $this->actionSuggest(),
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{

		$model=new FormCategory('search');
		$model->unsetAttributes(); 
		

		if(isset($_GET['FormCategory']))
			$model->attributes=$_GET['FormCategory'];

		$this->render('index',array(
			'model' => $model,
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionFormEditor($id)
	{
		$model = $this->loadModel($id);
		$form = Form::model()->findByPk($model->form_id);
		$entity = Entity::model()->findByPk($form->entity_id);
		$tags = $model->getTags($model->form_id);
		

		if(isset($_POST['Form']))
		{
			$form->attributes=$_POST['Form'];
			//echo var_dump($form->attributes);
			if($form->save()){
				$this->redirect(array('view','id'=>$model->id));
			}	
		}

		$this->render('_formEditor',array(
			'model'=>$model,
			'entity'=>$entity,
			'tags'=>$tags,
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionXMLEditor($id)
	{
		$model = $this->loadModel($id);
		$form = Form::model()->findByPk($model->form_id);
		$entity = Entity::model()->findByPk($form->entity_id);
		$tags = $model->getTags($model->form_id);
		

		if(isset($_POST['Form']))
		{
			$form->attributes=$_POST['Form'];
			//echo var_dump($form->attributes);
			if($form->save()){
				$this->redirect(array('view','id'=>$model->id));
			}	
		}

		$this->render('_XMLeditor',array(
			'model'=>$model,
			'entity'=>$entity,
			'tags'=>$tags,
		));
	}
	/**
	 *Array of Data for the autocomplete of Tags
	 *Returns an array of Tags
	*/
	public function actionSuggest()
	{
   		$model = Tag::model()->findAll();
   		$result = array();
   		foreach ($model as $val){
    	$result[] = $val->tag_name;
   		}
   		return $result;
  	}
 
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=FormCategory::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='form-category-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	/**
	 * Converts boolean data to String for attribute Status
	 * @param $data = data of the model.
	 * @param $row = access each row of data.
	 */
	public function renderStatus($data, $row)
	{
		if($data->form->status == 1)
			return 'Active';
		return 'Inactive';
	}
}
