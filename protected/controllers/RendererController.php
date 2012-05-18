<?php
 /**	
	 * @todo Compose PHP doc
	 */
 class RendererController extends Controller
 {
 	/**	
	 * @todo Compose PHP doc
	 */
	public $layout='//layouts/column1_mod';

	/**	
	 * @todo Compose PHP doc
	 */
	public function actionIndex()
	{	
		$model = new Form('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Form']))
			$model->attributes=$_GET['Form'];

		$this->render('index', array('model'=>$model));
	}

	/**	
	 * @todo Compose PHP doc
	 */
	public function actionRender($id)
	{	
		$this->render('render',array(
			'model'=>$this->loadFormModel($id),
			'id'=>$id,
		));
	}

	/**	
	 * @todo Compose PHP doc
	 */
	private function loadFormModel($id)
	{	
		$model=Form::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**	
	 * @todo Compose PHP doc
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index'),
				'users'	 =>array('*'),
			),
			array('deny',  // deny all users
				'users'	 =>array('*'),
			),
		);
	}

	/**	
	 * @todo Compose PHP doc
	 */
	private function parseXML($elem, $field_model, $field_val_model, $field_cons, $form, $tabs)
  	{
	  switch($elem)
	    {
	    case "text": 
		    $tabs['content'] .= "<div class='control-group'>";
			//check if a Text Area or Text Field
				if($field_cons->maxlength <= 45) {
					$tabs['content'] .= $form->labelEx($field_val_model, $field_model->label, array('style'=>'font-weight: bold;', 'class'=>'control-label'));
					$tabs['content'] .=  "<div class='controls'>";
						$tabs['content'] .= $form->textField($field_val_model, 'value', array('style' => 'width: 290px', 'placeHolder' => 'Enter '.$field_model->label, 'title'=>$field_model->label));
						//required
					$tabs['content'] .= '</div>';
				}else {
					$tabs['content'] .= $form->labelEx($field_val_model, $field_model->label, array('style'=>'font-weight: bold;', 'class'=>'control-label'));
					$tabs['content'] .=  "<div class='controls'>";
						$tabs['content'] .= $form->textArea($field_val_model, 'value', array('style' => 'width: 290px', 'maxlength' => 240, 'rows' => 6, 'placeHolder' => $field_model->label, 'title'=>$field_model->label));
						//required
					$tabs['content'] .= '</div>';
				}
			$tabs['content'] .= '</div>';
		    return $tabs['content'];
		    break;

		case "option":
			$options = CJSON::decode($field_cons->picklist);
			$tabs['content'] .= "<div class='control-group'>";
				$tabs['content'] .= $form->labelEx($field_val_model, $field_model->label, array('style'=>'font-weight: bold;', 'class'=>'control-label'));
				$tabs['content'] .=  "<div class='controls'>";
			       	$tabs['content'] .= $form->dropDownList($field_val_model, 'value', $options, array('style' => 'width: 300px',));
			    $tabs['content'] .= '</div>';
	        $tabs['content'] .= '</div>';
			return $tabs['content'];
			break;

		case "file":
			$tabs['content'] .= "<div class='control-group'>";
				$tabs['content'] .= $form->labelEx($field_val_model, $field_model->label, array('style'=>'font-weight: bold;', 'class'=>'control-label'));
				$tabs['content'] .=  "<div class='controls'>";
					$tabs['content'] .= $form->fileField($field_val_model, 'filename');
				$tabs['content'] .= '</div>';
			$tabs['content'] .= '</div>';
		return $tabs['content'];
		break;

		case "numeric":
			   $tabs['content'] .= "<div class='control-group'>";
			   $tabs['content'] .= $form->labelEx($field_val_model, $field_model->label, array('style'=>'font-weight: bold;', 'class'=>'control-label'));
			   $tabs['content'] .=  "<div class='controls'>";
			   if($field_cons->maxvalue == 1)
			   	$tabs['content'] .= $form->dropDownList($field_val_model, 'value', array('1' => 'True', '0' => 'False'), array('prompt' => '-Select-'));
			   else
			   	$tabs['content'] .= $form->textField($field_val_model, 'value', array('style' => 'width: 290px', 'placeHolder' => 'Enter '.$field_model->label, 'title'=>$field_model->label));
					//required
		   	   $tabs['content'] .= '</div>';
		   	   $tabs['content'] .= '</div>';

		   return $tabs['content'];
		   break;

		   case "date":
			   $tabs['content'] .= "<div class='control-group'>";
			   $tabs['content'] .= $form->labelEx($field_val_model, $field_model->label, array('style'=>'font-weight: bold;', 'class'=>'control-label'));
			   $tabs['content'] .=  "<div class='controls'>";
			  
    		   $tabs['content'] .=	$this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
    		   		'model'		=>$field_val_model,
    		   		'attribute' =>'value',
                	'mode'		=>'date', 
                	'language'  => '',
   					'options'   => array(
                		'ampm' 		     => true,
                		'showOn' 	     => 'button',
                		'buttonImage'    => Yii::app()->baseUrl . '/images/calendar.gif',
                		'buttonImageOnly'=>true,
                		'changeMonth' 	 => true,
                		'changeYear' 	 => true,
                		'constraintInput'=> true,
                		'autoSize' 		 => true,
                		),
   					), true);
					//required
		   	   $tabs['content'] .= '</div>';
		   	   $tabs['content'] .= '</div>';
		   return $tabs['content'];
		   break;

		   case "time":
			   $tabs['content'] .= "<div class='control-group'>";
			   $tabs['content'] .= $form->labelEx($field_val_model, $field_model->label, array('style'=>'font-weight: bold;', 'class'=>'control-label'));
			   $tabs['content'] .=  "<div class='controls'>";
			  
    		   $tabs['content'] .=	$this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
    		   		'model'=>$field_val_model,
    		   		'attribute'=>'value',
                	'mode'=>'time', 
                	'language' => '',
                	'options' => array('ampm' => true),
   					), true);
					//required
		   	   $tabs['content'] .= '</div>';
		   	   $tabs['content'] .= '</div>';
		   return $tabs['content'];
		   break;

		   case "datetime":
			   $tabs['content'] .= "<div class='control-group'>";
			   $tabs['content'] .= $form->labelEx($field_val_model, $field_model->label, array('style'=>'font-weight: bold;', 'class'=>'control-label'));
			   $tabs['content'] .=  "<div class='controls'>";
			  
    		   $tabs['content'] .=	$this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',array(
    		   		'model'		=>$field_val_model,
    		   		'attribute' =>'value',
                	'mode'		=>'datetime', 
                	'language'	=> '',
                	'options'   =>array(
                		'ampm' 			 => true,
                		'showOn'		 => 'button',
                		'buttonImage'    => Yii::app()->baseUrl . '/images/calendar.gif',
                		'buttonImageOnly'=>true,
                		'changeMonth' 	 => true,
                		'changeYear' 	 => true,
                		'constraintInput'=> true,
                		'autoSize' 	     => true,
                		),
   					), true);
					//required
		   	   $tabs['content'] .= '</div>';
		   	   $tabs['content'] .= '</div>';
		   return $tabs['content'];
		   break;
	    }
  	}

  	/**	
	 * @todo Compose PHP doc
	 */
	public function renderXML($xml, $form, $id)
	{
		$tabs = array();
		$tabs_f = array();
		$i=true;

		foreach($xml->children() as $sections) {

			foreach ($sections->children() as $section) {
				//section
				if($i) {
					$tabs['active']  =true;
				}
				
				$tabs['label'] = $section['label'];

				foreach ($section->children() as $child) {

					if($child->getName()=='fieldset') {
						//fieldset
						$tabs['content'] .= '<fieldset>';
	 					$tabs['content'] .= '<legend>'.$child['label'].'</legend>';

						foreach ($child as $field) {
							//field
							$field_id = $field['field_id'];
							$field_model = $this->loadFieldModel($field_id);
							$field_val_model;											//Field Value Model
							
							//render Datatype Text
							if($field_model->datatype=='T') {
								$field_val_model = new FieldValueText; 					//Instantiated Field Value Model
								$field_val_model->field_id = $field_id;
								$field_val_model->entity_id = $field_model->entity_id;
								$field_val_model->value = $field_model->default;
								
								$field_cons = new ConstraintText();						//Constraint Model
								$field_cons = $this->loadConsModel($field_cons, $field_id);

								$tabs['content'] = $this->parseXML('text', $field_model, $field_val_model, $field_cons, $form, $tabs);
							}

							//render Datatype Option
							elseif($field_model->datatype=='O') {
								$field_val_model = new FieldValueEnum; 					//Instantiated Field Value Model
								$field_val_model->field_id = $field_id;
								$field_val_model->entity_id = $field_model->entity_id;			
								
								$field_cons = new ConstraintEnum();						//Constraint Model
								$field_cons = $this->loadConsModel($field_cons, $field_id);
								$field_val_model->value = $field_cons->default_value;

								$tabs['content'] = $this->parseXML('option', $field_model, $field_val_model, $field_cons, $form, $tabs);
							}

							//render Datatype File
							elseif($field_model->datatype=='F') {
								$field_val_model = new FieldValueFile; 					//Instantiated Field Value Model
								$field_val_model->field_id = $field_id;
								$field_val_model->entity_id = $field_model->entity_id;
								
								$field_cons = new ConstraintFile();						//Constraint Model
								$field_cons = $this->loadConsModel($field_cons, $field_id);

								$tabs['content'] = $this->parseXML('file', $field_model, $field_val_model, $field_cons, $form, $tabs);
							}

							else if($field_model->datatype == 'N')
							{
								$field_val_model = new FieldValueNumeric; 					//Field Value Model
								$field_val_model->field_id = $field_id;
								$field_val_model->entity_id = $field_model->entity_id;	
								$field_val_model->value = $field_model->default;
								$field_cons = new ConstraintNumeric();						//Constraint Model
								$field_cons = $this->loadConsModel($field_cons, $field_id);
								$tabs['content'] = $this->parseXML('numeric', $field_model, $field_val_model, $field_cons, $form, $tabs);
							}
							else if($field_model->datatype == 'D')
							{
								$field_val_model = new FieldValueDate; 					//Field Value Model
								$field_val_model->field_id = $field_id;
								$field_val_model->entity_id = $field_model->entity_id;	
								$field_val_model->value = $field_model->default;
								$field_cons = new ConstraintDatetime();						//Constraint Model
								$field_cons = $this->loadConsModel($field_cons, $field_id);
								$tabs['content'] = $this->parseXML('date', $field_model, $field_val_model, $field_cons, $form, $tabs);
							}
							else if($field_model->datatype == 't')
							{
								$field_val_model = new FieldValueTime; 					//Field Value Model
								$field_val_model->field_id = $field_id;
								$field_val_model->entity_id = $field_model->entity_id;	
								$field_val_model->value = $field_model->default;
								$field_cons = new ConstraintDatetime();						//Constraint Model
								$field_cons = $this->loadConsModel($field_cons, $field_id);
								$tabs['content'] = $this->parseXML('time', $field_model, $field_val_model, $field_cons, $form, $tabs);
							}
							else if($field_model->datatype == 'd')
							{
								$field_val_model = new FieldValueDatetime; 					//Field Value Model
								$field_val_model->field_id = $field_id;
								$field_val_model->entity_id = $field_model->entity_id;	
								$field_val_model->value = $field_model->default;
								$field_cons = new ConstraintDatetime();						//Constraint Model
								$field_cons = $this->loadConsModel($field_cons, $field_id);
								$tabs['content'] = $this->parseXML('datetime', $field_model, $field_val_model, $field_cons, $form, $tabs);
							}

							//render Datatype Compound
							elseif($field_model->datatype=='C') {
								$field_val_model[] = new FieldValueCompound;							//Instantiated Field Value Model
								$child_model = new Field;
								$child_val_model;

								$criteria=new CDbCriteria;
								
								$criteria->condition = 'parent_id='.$field_id;
								$countC = Field::model()->count($criteria);

								$child_model = Field::model()->findAll($criteria);						//Child Field Model

								$tabs['content'] .= "<div class='well'>";								//WELL
								$tabs['content'] .= '<legend>'.$field_model['label'].'</legend>';				//Title Header of Well

								foreach ($child_model as $key => $value) {
									$field_val_model[]->field_id = $field_id;
									$field_val_model[]->entity_id = $field_model->entity_id;

									if($value->datatype=='T') {
										$child_val_model = new FieldValueText;							//Child Field Value Model
										$child_val_model->field_id = $field_id;
										$child_val_model->entity_id = $field_model->entity_id;
										$child_val_model->value = $value->default;

										$field_cons = new ConstraintText();								//Constraint Model
										$field_cons = $this->loadConsModel($field_cons, $value->id);

										$tabs['content'] = $this->parseXML('text', $value, $child_val_model, $field_cons, $form, $tabs);
									}
									elseif($value->datatype=='O') {
										$child_val_model = new FieldValueEnum; 					//Instantiated Field Value Model
										$child_val_model->field_id = $field_id;
										$child_val_model->entity_id = $field_model->entity_id;			
								
										$field_cons = new ConstraintEnum();						//Constraint Model
										$field_cons = $this->loadConsModel($field_cons, $value->id);
										$child_val_model->value = $field_cons->default_value;

										$tabs['content'] = $this->parseXML('option', $value, $child_val_model, $field_cons, $form, $tabs);
									}
									elseif($value->datatype=='F') {
										$child_val_model = new FieldValueFile; 					//Instantiated Field Value Model
										$child_val_model->field_id = $field_id;
										$child_val_model->entity_id = $field_model->entity_id;
										
										$field_cons = new ConstraintFile();						//Constraint Model
										$field_cons = $this->loadConsModel($field_cons, $value->id);

										$tabs['content'] = $this->parseXML('file', $value, $child_val_model, $field_cons, $form, $tabs);
									}
									else if($value->datatype== 'N')
									{
										$child_val_model = new FieldValueNumeric; 					//Field Value Model
										$child_val_model->field_id = $field_id;
										$child_val_model->entity_id = $field_model->entity_id;	
										$child_val_model->value = $value->default;

										$field_cons = new ConstraintNumeric();						//Constraint Model
										$field_cons = $this->loadConsModel($field_cons, $value->id);

										$tabs['content'] = $this->parseXML('numeric', $value, $child_val_model, $field_cons, $form, $tabs);
									}
									else if($value->datatype == 'D')
									{
										$child_val_model = new FieldValueDate; 					//Field Value Model
										$child_val_model->field_id = $field_id;
										$child_val_model->entity_id = $field_model->entity_id;	
										$child_val_model->value = $value->default;

										$field_cons = new ConstraintDatetime();						//Constraint Model
										$field_cons = $this->loadConsModel($field_cons, $value->id);

										$tabs['content'] = $this->parseXML('date', $value, $child_val_model, $field_cons, $form, $tabs);
									}
									else if($value->datatype == 't')
									{
										$child_val_model = new FieldValueTime; 					//Field Value Model
										$child_val_model->field_id = $field_id;
										$child_val_model->entity_id = $field_model->entity_id;	
										$child_val_model->value = $value->default;

										$field_cons = new ConstraintDatetime();						//Constraint Model
										$field_cons = $this->loadConsModel($field_cons, $value->id);

										$tabs['content'] = $this->parseXML('time', $value, $child_val_model, $field_cons, $form, $tabs);
									}
									else if($value->datatype == 'd')
									{
										$child_val_model = new FieldValueDatetime; 					//Field Value Model
										$child_val_model->field_id = $field_id;
										$child_val_model->entity_id = $field_model->entity_id;	
										$child_val_model->value = $value->default;

										$field_cons = new ConstraintDatetime();						//Constraint Model
										$field_cons = $this->loadConsModel($field_cons, $value->id);

										$tabs['content'] = $this->parseXML('datetime', $value, $child_val_model, $field_cons, $form, $tabs);
									}
								}
								$tabs['content'] .= '</div>';
							}
						}

						$tabs['content'] .= '</fieldset>';
					}elseif($child->getName()=='field') {
						//field

					}
				}

				$i = false;
				$tabs_f[] = $tabs;
				unset($tabs);
			}
		}
		return $tabs_f;
	}

	/**	
	 * @todo Compose PHP doc
	 */
	private function loadFieldModel($id)
	{
		$model=Field::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Search and return a Constraint model with values.
	 * @param Constraint Model and a Primary Key of Field table
	 * @return Constraint Model with values  
	 */
	private function loadConsModel($cons, $id)
	{
		$criteria=new CDbCriteria;
		$criteria->condition = 'field_id='.$id;

		$model=$cons::model()->find($criteria);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
?>