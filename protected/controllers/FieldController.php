<?php


class FieldController extends Controller
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
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),

			array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('InboundSearch','OutboundSearch','admin','FreeSearch','SearchEngine'),
                'users'=>array('admin'),
            ),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$fieldModel              = new Field;
		$constraintTextModel     = new ConstraintText;
		$constraintNumericModel  = new ConstraintNumeric;
		$constraintDatetimeModel = new ConstraintDatetime;
		$constraintEnumModel     = new ConstraintEnum;
		$constraintFileModel     = new ConstraintFile;
		$constraintDerivedModel  = new ConstraintDerived;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Field']))
		{
			$save = false;
			$fieldModel->attributes=$_POST['Field'];
			//$save = $fieldModel->save();
			$dataType = $_POST['Field']['datatype'];
			$constraintDataType = '';
			$constraintModel = '';
			switch ($dataType){
				case 'T':
					$constraintDataType = 'ConstraintText';
					$constraintModel = $constraintTextModel;
					break;
				case 'N':
					$constraintDataType = 'ConstraintNumeric';
					$constraintModel = $constraintNumericModel;
					break;
				case 'D':
				case 't':
				case 'd':
					$constraintDataType = 'ConstraintDatetime';
					$constraintModel = $constraintDatetimeModel;
					break;
				case 'O':
					$constraintDataType = 'ConstraintEnum';
					$constraintModel = $constraintEnumModel;
					break;
				case 'F':
					$constraintDataType = 'ConstraintFile';
					$constraintModel = $constraintFileModel;
					break;
				case 'C':
					break;
			}
			if(isset($_POST[$constraintDataType])){
				$_POST[$constraintDataType]['field_id'] = $fieldModel->id;
		    	$constraintModel->attributes=$_POST[$constraintDataType]; 
		    }
		    $constraintModel->save();
			/*if($save)
				$this->redirect(array('view','id'=>$fieldModel->id));
				*/
		}

		$this->render('create',array(
			'fieldModel'              =>$fieldModel,
			'constraintTextModel'     =>$constraintTextModel,
			'constraintNumericModel'  =>$constraintNumericModel,
			'constraintDatetimeModel' =>$constraintDatetimeModel,
			'constraintEnumModel'     =>$constraintEnumModel,
			'constraintFileModel'     =>$constraintFileModel,
			'constraintDerivedModel'  =>$constraintDerivedModel,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Field']))
		{
			$model->attributes=$_POST['Field'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
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
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new Field('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Field']))
		{
		
			$model->attributes=$_GET['Field'];

		$this->render('index',array(
			'model'=>$model,
		));

		}


	
	}


	public function actionAcceptUserRegistration() {

        if(isset($_POST['button1']))
        {
        echo "Accept code here ";
        }
      if(isset($_POST['button2']))
        {
        echo "Reject code here ";
        }

       
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Field::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='field-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}




	public function renderDataType($data,$row){
		// ... generate the output for a full address
 
          // Params:
          // $data ... the current row data   
         // $row ... the row index
		$dataType = '';
		switch ($data->datatype){
				case 'T':
					$dataType = 'Text'; break;
				case 'N':
					$dataType = 'Numeric'; break;
				case 'D':
					$dataType = 'Date'; break;
				case 't':
					$dataType = 'Time'; break;
				case 'd':
					$dataType = 'Datetime'; break;
				case 'O':
					$dataType = 'option'; break;
				case 'F':
					$dataType = 'File'; break;
				case 'C':
					$dataType = 'Compound'; break;
			}
        return $dataType;
	}

}

