<?php


class FieldController extends Controller
{
	const TYPE_TEXT     = Field::TYPE_TEXT;
	const TYPE_NUMERIC  = Field::TYPE_NUMERIC;
	const TYPE_DATE     = Field::TYPE_DATE;
	const TYPE_TIME     = Field::TYPE_TIME;
	const TYPE_DATETIME = Field::TYPE_DATETIME;
	const TYPE_OPTION   = Field::TYPE_OPTION;
	const TYPE_FILE     = Field::TYPE_FILE;
	const TYPE_COMPOUND = Field::TYPE_COMPOUND;

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
				'actions'=>array('admin','delete','testFieldValue'),
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

		// load field model
		$fieldModel              = $this->loadModel($id);

		// initialize constraint models
		$constraintTextModel     = new ConstraintText;
		$constraintNumericModel  = new ConstraintNumeric;
		$constraintDatetimeModel = new ConstraintDatetime;
		$constraintEnumModel     = new ConstraintEnum;
		$constraintFileModel     = new ConstraintFile;
		$constraintDerivedModel  = new ConstraintDerived;

		// load the constraint model according to the data type of the loaded model
		$constraintModel = $this->loadConstraintModel($id,$fieldModel->datatype);

		// if the constraint model is not null, update the initialized constraint models
		if($constraintModel!==null){
			switch ($fieldModel->datatype){
				case 'T': $constraintTextModel     = $constraintModel; break;
				case 'N': $constraintNumericModel  = $constraintModel; break;
				case 'D':
				case 't':
				case 'd': $constraintDatetimeModel = $constraintModel; break;
				case 'O': $constraintEnumModel     = $constraintModel; break;
				case 'F': $constraintFileModel     = $constraintModel; break;
				case 'C':                                              break;
			};
		}

		if($fieldModel->derived){
			$constraintModel = $this->loadConstraintModel($id,'R');
			if($constraintModel!==null){
				$constraintDerivedModel = $constraintModel;
			}
		}

		$this->render('view',array(
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
		$this->performAjaxValidations(array(
			$fieldModel,
			$constraintTextModel,
			$constraintNumericModel,
			$constraintDatetimeModel,
			$constraintEnumModel,
			$constraintFileModel,
			$constraintDerivedModel,
		));
		
		if(isset($_POST['Field']))
		{
			$fieldModel->attributes = $_POST['Field'];
			//$fieldModelSave         = $fieldModel->save();
			$dataType               = $_POST['Field']['datatype'];
			$constraintDataType     = '';
			$constraintModel        = null;
			switch ($dataType){
				case 'T':
					$constraintDataType = 'ConstraintText';
					$constraintModel    = $constraintTextModel;     break;
				case 'N':
					$constraintDataType = 'ConstraintNumeric';
					$constraintModel    = $constraintNumericModel;  break;
				case 'D':
				case 't':
				case 'd':
					$constraintDataType = 'ConstraintDatetime';
					$constraintModel    = $constraintDatetimeModel; break;
				case 'O':
					$constraintDataType = 'ConstraintEnum';
					$constraintModel    = $constraintEnumModel;     break;
				case 'F':
					$constraintDataType = 'ConstraintFile';
					$constraintModel    = $constraintFileModel;     break;
				case 'C':
					if(isset($_POST['ConstraintCompound'])){
						$child = $_POST['ConstraintCompound']['child'];
						foreach($child as $key => $id){
							$fieldModel = $this->loadModel($id);
							$fieldModel->setAttribute('parent_id', '-1'); 
                    		echo "Updating ".$fieldModel->fieldname."...";
                    		if ($fieldModel->save()){
                    			echo "OK.<br>";
                    		} else {
                    			echo "failed.<br>";
                    		}
						}
				    }
					break;
			}
			if(isset($_POST[$constraintDataType])){
				$_POST[$constraintDataType]['field_id'] = $fieldModel->id;
		    	$constraintModel->attributes = $_POST[$constraintDataType]; 
		    }
		    $constraintModelSave = $constraintModel->save();
		   	if ($_POST['Field']['derived']){
		    	if(isset($_POST['ConstraintDerived'])){
					$_POST['ConstraintDerived']['field_id'] = $fieldModel->id;
			    	$constraintDerivedModel->attributes = $_POST['ConstraintDerived'];
			    	$constraintModelSave = $constraintDerivedModel->save();
			    }
			}
			if($fieldModelSave && $constraintModelSave)
				$this->redirect(array('view','id'=>$fieldModel->id));
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
		// load field model
		$fieldModel              = $this->loadModel($id);

		// initialize constraint models
		$constraintTextModel     = new ConstraintText;
		$constraintNumericModel  = new ConstraintNumeric;
		$constraintDatetimeModel = new ConstraintDatetime;
		$constraintEnumModel     = new ConstraintEnum;
		$constraintFileModel     = new ConstraintFile;
		$constraintDerivedModel  = new ConstraintDerived;

		// load the constraint model according to the data type of the loaded model
		$constraintModel = $this->loadConstraintModel($id,$fieldModel->datatype);

		// if the constraint model is not null, update the initialized constraint models
		if($constraintModel!==null){
			switch ($fieldModel->datatype){
				case 'T': $constraintTextModel     = $constraintModel; break;
				case 'N': $constraintNumericModel  = $constraintModel; break;
				case 'D':
				case 't':
				case 'd': $constraintDatetimeModel = $constraintModel; break;
				case 'O': $constraintEnumModel     = $constraintModel; break;
				case 'F': $constraintFileModel     = $constraintModel; break;
				case 'C':                                              break;
			};
		}

		if($fieldModel->derived){
			$constraintModel = $this->loadConstraintModel($id,'R');
			if($constraintModel!==null){
				$constraintDerivedModel = $constraintModel;
			}
		}

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidations(array(
			$fieldModel,
			$constraintTextModel,
			$constraintNumericModel,
			$constraintDatetimeModel,
			$constraintEnumModel,
			$constraintFileModel,
			$constraintDerivedModel,
		));

		if(isset($_POST['Field']))
		{
			$fieldModel->attributes = $_POST['Field'];
			$fieldModelSave         = $fieldModel->save();
			$dataType               = $_POST['Field']['datatype'];
			$constraintDataType     = '';
			$constraintModel        = null;
			switch ($dataType){
				case 'T':
					$constraintDataType = 'ConstraintText';
					$constraintModel    = $constraintTextModel;     break;
				case 'N':
					$constraintDataType = 'ConstraintNumeric';
					$constraintModel    = $constraintNumericModel;  break;
				case 'D':
				case 't':
				case 'd':
					$constraintDataType = 'ConstraintDatetime';
					$constraintModel    = $constraintDatetimeModel; break;
				case 'O':
					$constraintDataType = 'ConstraintEnum';
					$constraintModel    = $constraintEnumModel;     break;
				case 'F':
					$constraintDataType = 'ConstraintFile';
					$constraintModel    = $constraintFileModel;     break;
				case 'C':
					break;
			}
			if(isset($_POST[$constraintDataType])){
				$_POST[$constraintDataType]['field_id'] = $fieldModel->id;
		    	$constraintModel->attributes = $_POST[$constraintDataType]; 
		    }
		    $constraintModelSave = $constraintModel->save();

		    if ($_POST['Field']['derived']){
		    	if(isset($_POST['ConstraintDerived'])){
					$_POST['ConstraintDerived']['field_id'] = $fieldModel->id;
			    	$constraintDerivedModel->attributes = $_POST['ConstraintDerived'];
			    	$constraintModelSave = $constraintDerivedModel->save();
			    }
			}
			if($fieldModelSave && $constraintModelSave)
				$this->redirect(array('view','id'=>$fieldModel->id));
		}

		$this->render('update',array(
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
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// load the field model
			$fieldModel = $this->loadModel($id);
			
			// load the constraint model according to the data type of the loaded model
			$constraintModel = $this->loadConstraintModel($id,$fieldModel->datatype);

			// if the constraint model is not null, delete the constraint
			if($constraintModel!==null){
				$constraintModel->delete();
			}

			// if the field is derived, load the constraint model for derived fields
			if ($fieldModel->derived){
				$constraintModel = $this->loadConstraintModel($id,'R');

				// if the constraint model is not null, delete the constraint
				if($constraintModel!==null){
					$constraintModel->delete();
				}
			}

			// we only allow deletion via POST request
			$fieldModel->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex(){
		$model=new Field('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Field'])){
			$model->attributes=$_GET['Field'];
		}
		$this->render('index',array(
			'model'=>$model,
		));
	}

	public function actionAcceptUserRegistration() {
        if(isset($_POST['button1'])){
        	echo "Accept code here ";
        }
      	if(isset($_POST['button2'])){
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
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadConstraintModel($id,$datatype)
	{
		switch ($datatype){
			case 'T': $model =     ConstraintText::model()->findByAttributes(array('field_id' => $id, )); break;
			case 'N': $model =  Constraintnumeric::model()->findByAttributes(array('field_id' => $id, )); break;
			case 'D':
			case 't':
			case 'd': $model = ConstraintDatetime::model()->findByAttributes(array('field_id' => $id, )); break;
			case 'O': $model =     ConstraintEnum::model()->findByAttributes(array('field_id' => $id, )); break;
			case 'F': $model =     ConstraintFile::model()->findByAttributes(array('field_id' => $id, )); break;
			// special switch case for derived
			case 'R': $model =  ConstraintDerived::model()->findByAttributes(array('field_id' => $id, )); break;
		};
		//if($model===null)
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
	
	/**
	 * Performs AJAX validations on multiple models.
	 * @param array Array of models to be validated
	 */
	protected function performAjaxValidations($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='field-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/**
	 * Renders the name of the data type according to a mnemonic
	 * @param CModel The model of the current row data
	 * @param integer The row index
	 */
	public function renderDataType($data,$row){
		$dataType = '';
		switch ($data->datatype){
			case 'T': $dataType = 'Text';     break;
			case 'N': $dataType = 'Numeric';  break;
			case 'D': $dataType = 'Date';     break;
			case 't': $dataType = 'Time';     break;
			case 'd': $dataType = 'Datetime'; break;
			case 'O': $dataType = 'Option';   break;
			case 'F': $dataType = 'File';     break;
			case 'C': $dataType = 'Compound'; break;
		}
        return $dataType;
	}

	public function actionTestFieldValue(){
		echo "Loading a new object FieldValue...";
		$fieldValue = new FieldValue;
		$fieldValue->initValueOf(85);
		echo "done.<br>Setting entity_instance_id...";
		$fieldValue->setAttribute('entity_instance_id','1');
		echo "done.<br>Setting value...";
		$fieldValue->setAttribute('value','2');
		echo "done.<br>Saving...";
		if($fieldValue->save()){
			echo "done.";
		} else echo "failed.";
	}

}

