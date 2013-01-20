<?php

Yii::import('bootstrap.widgets.input.TbInput');

abstract class YbInput extends TbInput
{
	// The different input types.
	const TYPE_RADIOBUTTONGROUPSLIST = 'radiobuttongroupslist';
	const TYPE_DATEPICKER = 'datepicker';
	const TYPE_REDACTOR = 'redactor';
	const TYPE_MARKDOWNEDITOR = 'markdowneditor';
	const TYPE_HTML5EDITOR = 'wysihtml5';
	const TYPE_DATERANGEPICKER = 'daterangepicker';
	const TYPE_TOGGLEBUTTON = 'togglebutton';
	const TYPE_COLORPICKER = 'colorpicker';
	const TYPE_CKEDITOR = 'ckeditor';
	const TYPE_TIMEPICKER = 'timepicker';
	const TYPE_SELECT2 = 'select2';

	/**
	 * Runs the widget.
	 * @throws CException if the widget type is invalid.
	 */
	public function run()
	{
		switch ($this->type)
		{
			case self::TYPE_RADIOBUTTONGROUPSLIST:
				$this->radioButtonGroupsList();
				break;

			case self::TYPE_TEXT:
				$this->textField();
				break;

			case self::TYPE_DATEPICKER:
				$this->datepickerField();
				break;

			case self::TYPE_REDACTOR:
				$this->redactorJs();
				break;

			case self::TYPE_MARKDOWNEDITOR:
				$this->markdownEditorJs();
				break;

			case self::TYPE_HTML5EDITOR:
				$this->html5Editor();
				break;

			case self::TYPE_DATERANGEPICKER:
				$this->dateRangeField();
				break;

			case self::TYPE_TOGGLEBUTTON:
				$this->toggleButton();
				break;

			case self::TYPE_COLORPICKER:
				$this->colorpickerField();
				break;

			case self::TYPE_CKEDITOR:
				$this->ckEditor();
				break;

			// Adding timepicker (Sergii)
			case self::TYPE_TIMEPICKER:
				$this->timepickerField();
				break;

			case self::TYPE_SELECT2:
				$this->select2Field();
				break;

			default:
				parent::run();
		}
	}

	/**
	 * Renders a list of radio buttons using Button Groups.
	 * @return string the rendered content
	 * @abstract
	 */
	abstract protected function radioButtonGroupsList();

	/**
	 * Renders a datepicker field.
	 * @return string the rendered content
	 * @abstract
	 */
	abstract protected function datepickerField();

	/**
	 * Renders a redactorJS wysiwyg field.
	 * @abstract
	 * @return mixed
	 */
	abstract protected function redactorJs();


	/**
	 * Renders a markdownEditorJS wysiwyg field.
	 * @abstract
	 * @return mixed
	 */
	abstract protected function markdownEditorJs();

	/**
	 * Renders a bootstrap CKEditor wysiwyg editor.
	 * @abstract
	 * @return mixed
	 */
	abstract protected function ckEditor();

	/**
	 * Renders a bootstrap wysihtml5 editor.
	 * @abstract
	 * @return mixed
	 */
	abstract protected function html5Editor();

	/**
	 * Renders a daterange picker field
	 * @abstract
	 * @return mixed
	 */
	abstract protected function dateRangeField();

	/**
	 * Renders a colorpicker field.
	 * @return string the rendered content
	 * @abstract
	 */
	abstract protected function colorpickerField();

	/**
	 * Renders a timepicker field.
	 * @return string the rendered content
	 * @abstract
	 */
	abstract protected function timepickerField();

	/**
	 * Renders a select2 field.
	 * @return mixed
	 */
	abstract protected function select2Field();
}