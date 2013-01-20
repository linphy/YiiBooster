<?php

Yii::import('bootstrap.components.Bootstrap');

class YiiBooster extends Bootstrap
{
	// Bootstrap plugins.
	const PLUGIN_DATEPICKER = 'bdatepicker';
	const PLUGIN_REDACTOR = 'redactor';
	const PLUGIN_MARKDOWNEDITOR = 'markdowneditor';
	const PLUGIN_AFFIX = 'affix';
	const PLUGIN_DATERANGEPICKER = 'daterangepicker';
	const PLUGIN_HTML5EDITOR = 'wysihtml5';
	const PLUGIN_COLORPICKER = 'colorpicker';

	/**
	 * @var bool whether to enable bootbox messages or not. Default value is true.
	 * @since YiiBooster 1.0.5
	 */
	public $enableBootboxJS = true;

	private $_ybAssetsUrl;

	/**
	 * Registers the JQuery-specific CSS missing from Bootstrap.
	 */
	public function registerJuiCss()
	{
		$cs = Yii::app()->getClientScript(); /* @var CClientScript $cs */
		$url = $this->getYbAssetsUrl() . '/css/jquery-ui-bootstrap.css';
		$cs->scriptMap['jquery-ui.css'] = $url;
		$cs->registerCssFile($url);
	}

	/**
	 * Registers the Bootstrap JavaScript.
	 * @param int $position the position of the JavaScript code.
	 * @see CClientScript::registerScriptFile
	 */
	public function registerJS($position = CClientScript::POS_HEAD)
	{
		parent::registerJS($position);
		if ($this->enableBootboxJS)
			Yii::app()->clientScript->registerScriptFile($this->getYbAssetsUrl() . '/js/bootstrap.bootbox.min.js', $position);
	}

	/**
	 * Registers all Bootstrap CSS and JavaScript.
	 */
	public function register()
	{
		parent::register();
		$this->registerJuiCss();
	}

	/**
	 * Registers a specific css in the asset's css folder
	 * @param string $cssFile the css file name to register
	 * @param string $media the media that the CSS file should be applied to. If empty, it means all media types.
	 */
	public function registerAssetCss($cssFile, $media = '')
	{
		Yii::app()->clientScript->registerCssFile($this->getYbAssetsUrl() . '/css/'.$cssFile, $media);
	}

	/**
	 * Register a specific js file in the asset's js folder
	 * @param string $jsFile
	 * @param int $position the position of the JavaScript code.
	 * @see CClientScript::registerScriptFile
	 */
	public function registerAssetJs($jsFile, $position = CClientScript::POS_END)
	{
		Yii::app()->clientScript->registerScriptFile($this->getYbAssetsUrl() . '/js/'.$jsFile, $position);
	}

	/**
	 * Register the Bootstrap datepicker plugin.
	 * IMPORTANT: if you register a selector via this method you wont be able to attach events to the plugin.
	 * @param string $selector the CSS selector
	 * @param array $options the plugin options
	 * @see http://www.eyecon.ro/bootstrap-datepicker/
	 */
	public function registerDatePicker($selector = null, $options = array())
	{
		$this->registerPlugin(self::PLUGIN_DATEPICKER, $selector, $options);
	}

	/**
	 * Registers the RedactorJS plugin.
	 * @param null $selector
	 * @param $options
	 */
	public function registerRedactor($selector = null, $options = array())
	{
		$this->registerPlugin(self::PLUGIN_REDACTOR, $selector, $options);
	}

	/**
	 * Registers the Bootstrap-whysihtml5 plugin.
	 * @param null $selector
	 * @param $options
	 */
	public function registerHtml5Editor($selector = null, $options = array())
	{
		$this->registerPlugin(self::PLUGIN_HTML5EDITOR, $selector, $options);
	}

	/**
	 * Registers the Bootstrap-colorpicker plugin.
	 * @param null $selector
	 * @param $options
	 */
	public function registerColorPicker($selector = null, $options = array())
	{
		$this->registerPlugin(self::PLUGIN_COLORPICKER, $selector, $options);
	}

	/**
	 * Registers the affix plugin
	 * @param null $selector
	 * @param array $options
	 * @see  http://twitter.github.com/bootstrap/javascript.html#affix
	 */
	public function registerAffix($selector = null, $options = array())
	{
		$this->registerPlugin(self::PLUGIN_AFFIX, $selector, $options);
	}

	/**
	 * Registers the Bootstrap daterange plugin
	 * @param string $selector the CSS selector
	 * @param array $options the plugin options
	 * @param string $callback the javascript callback function
	 * @see  http://www.dangrossman.info/2012/08/20/a-date-range-picker-for-twitter-bootstrap/
	 * @since 1.1.0
	 */
	public function registerDateRangePlugin($selector, $options = array(), $callback = null)
	{
		$key = __CLASS__ . '.' . md5(self::PLUGIN_DATERANGEPICKER . $selector . serialize($options) . $callback);
		Yii::app()->clientScript->registerScript($key, '$("' . $selector . '").daterangepicker(' . CJavaScript::encode($options) . ($callback ? ', ' . CJavaScript::encode($callback) : '') . ');');
	}

	/**
	 * Returns the URL to the published assets folder.
	 * @return string the URL
	 */
	public function getYbAssetsUrl()
	{
		if (isset($this->_ybAssetsUrl))
			return $this->_ybAssetsUrl;
		else
		{
			$assetsPath = Yii::getPathOfAlias('yiibooster.assets');
			$assetsUrl = Yii::app()->assetManager->publish($assetsPath, true, -1, $this->forceCopyAssets);
			return $this->_ybAssetsUrl = $assetsUrl;
		}
	}

	/**
	 * Returns the extension version number.
	 * @return string the version
	 */
	public function getVersion()
	{
		return '2.0.0';
	}
}