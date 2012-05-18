<?php

/**
 * Form Geneerator generates an XML string from an associative array.
 * 
 * The following array format should be passed when using generate() function.
 * $form = array(
 * 	'items' => array($section1,$section2,...),
 * );
 * $section = array(
 * 	'label' => 'string that appears on the page',
 * 	'order' => 'integer that determines ordering of sections',
 * 	'items' => array(
 * 			'fieldsetlabel' => array(field_id1,field_id2,field_id3,...),
 * 			'fieldsetlabel' => array(field_id4,field_id5,field_id6,...),
 * 			field_id7,field_id8,field_id9,
 * 		),
 * );
 *
 */
class FormGenerator
{
	private $_formID;
	private $_formModel;
	private $xml;

	/**
	 * Constructor
	 */
	public function __construct($formID){
		// get the static model for the form
		$this->_formModel = $this->loadFormModel($formID);
		$this->_formID = $formID;
		$this->init();
	}
	/**
	 * Function that initializes the xml string for the default settings.
	 */
	private function init(){
		$xmlstr = "<form></form>";
		$this->xml = new SimpleXMLElement($xmlstr);
		$this->xml->addAttribute('type','horizontal');
		$this->xml->addAttribute('formID',$this->_formID);
		$this->xml->addAttribute('sectionType','tabs');
	}

	/**
	 * Function that generates the xml string from an array.
	 */
	public function generate($form){
		$sections = $form['items'];
		foreach($sections as $section){
			$currentSection = $this->addSection($section['label'],$section['order']);
			$sectionItems = $section['items'];
			foreach($sectionItems as $key=>$value ){
				if (is_array($value)){
					$fieldset = $this->addFieldset($key,$currentSection);
					foreach($value as $field_id){
						$this->addField($field_id,$fieldset);
					}
				} else {
					$this->addField($value,$currentSection);
				}
			}
		}
	}
	
	private function addSection($label,$order=null){
		if($this->xml->count() == 0){
			$sections = $this->xml->addChild('sections');
			if ($order == null) $order = 1; 
		}
		else{
			$sections = $this->xml->sections;
			if ($order == null){
				$order = $sections->count();
				$order++;
			}
		}
		$section = $sections->addChild('section');
		$section->addAttribute('label',$label);
		$section->addAttribute('order',$order);
		return $section;
	}

	private function addFieldset($label, $section){
		$fieldset = $section->addChild('fieldset');
		$fieldset->addAttribute('label',$label);
		return $fieldset;
	}

	private function addField($field_id,$parentNode){
		$field = $parentNode->addChild('field');
		$field->addAttribute('field_id',$field_id);
		return $field;
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	private function loadFormModel($id)
	{
		$model=Form::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function asXML(){
		$dom = dom_import_simplexml($this->xml)->ownerDocument;
		$dom->formatOutput = true;
		return $dom->saveXML();
	}

	public function previewXML(){
		return '<pre>'.CHtml::encode($this->asXML()).'</pre>';
	}
}