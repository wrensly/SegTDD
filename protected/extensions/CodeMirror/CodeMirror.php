<?php
/**
 * Bootstrap class file.
 * @author Seth Busque <sethbusque@gmail.com>
 * @copyright Copyright &copy; Seth Busque 2011-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version 0.1.0
 */

/**
 * Bootstrap application component.
 * Used for registering Bootstrap core functionality.
 */
class CodeMirror extends CApplicationComponent
{
	/**
	 * @var boolean whether to register the CodeMirror core CSS (codeMirror.css).
	 * Defaults to true.
	 */
	public $coreCss = true;
	/**
	 * @var boolean whether to register jQuery and the CodeMirror JavaScript.
	 * Defaults to true.
	 */
	public $enableJS = true;
	
	protected $_assetsUrl;

	protected $_config = array();

	/**
	 * Initializes the component.
	 */
	public function init()
	{
		// Register the CodeMirror path alias.
		if (!Yii::getPathOfAlias('CodeMirror'))
			Yii::setPathOfAlias('CodeMirror', realpath(dirname(__FILE__)));

		// Prevents the extension from registering scripts
		// and publishing assets when ran from the command line.
		if (php_sapi_name() === 'cli')
			return;

		if ($this->coreCss)
			$this->registerCss();

		if ($this->enableJS)
			$this->registerJs();
	}

	/**
	 * Registers the Bootstrap CSS.
	 */
	public function registerCss()
	{
		Yii::app()->clientScript->registerCssFile($this->getAssetsUrl().'/lib/codemirror.css');
	}

	/**
	 * Registers the core JavaScript plugins.
	 * @since 0.9.8
	 */
	public function registerJs()
	{
		Yii::app()->clientScript->registerCoreScript('jquery');
		Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl().'/lib/codemirror.js');
	}

	public function getAssetsPath(){
		return $this->_assetsUrl;
	}

	public function load($id,$config){
		$options = "";
		foreach ($config as $option=>$value){
			$options .= "{$option}: '{$value}',".PHP_EOL;
			switch($option){
				case 'mode':
					$this->loadMode($value);
					break;
				case 'theme':
					$this->loadTheme($value);
					break;
			}
		}

		$script = "var editor = CodeMirror.fromTextArea(document.getElementById('{$id}'), {
					    {$options}
					  });";
		Yii::app()->clientScript->registerScript('CodeMirror', $script);	
	}

	private function loadMode($mode){
		$location = '/mode/'.$mode.'/'.$mode.'.js';
		Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl().$location);
	}

	private function loadTheme($theme){
		$location = '/theme/'.$theme.'.css';
		Yii::app()->clientScript->registerCssFile($this->getAssetsUrl().$location);
	}
	/**
	* Returns the URL to the published assets folder.
	* @return string the URL
	*/
	protected function getAssetsUrl()
	{
		if ($this->_assetsUrl !== null)
			return $this->_assetsUrl;
		else
		{
			$assetsPath = Yii::getPathOfAlias('CodeMirror.assets');

			if (YII_DEBUG)
				$assetsUrl = Yii::app()->assetManager->publish($assetsPath, false, -1, true);
			else
				$assetsUrl = Yii::app()->assetManager->publish($assetsPath);

			return $this->_assetsUrl = $assetsUrl;
		}
	}
}
