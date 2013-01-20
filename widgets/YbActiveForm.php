<?php

Yii::import('bootstrap.widgets.TbActiveForm');
Yii::import('yiibooster.widgets.input.YbInput');

class YbActiveForm extends TbActiveForm
{
	const INPUT_HORIZONTAL = 'yiibooster.widgets.input.YbInputHorizontal';
	const INPUT_INLINE = 'yiibooster.widgets.input.YbInputInline';
	const INPUT_SEARCH = 'yiibooster.widgets.input.YbInputSearch';
	const INPUT_VERTICAL = 'yiibooster.widgets.input.YbInputVertical';

	/**
	 * Renders a toggle input row.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes (options key sets the options for the toggle component)
	 * @return string the generated row
	 */
	public function toggleButtonRow($model, $attribute, $htmlOptions = array())
	{
		return $this->inputRow(YbInput::TYPE_TOGGLEBUTTON, $model, $attribute, null, $htmlOptions);
	}

	/**
	 * Renders a radio button list input row using Button Groups.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $data the list data
	 * @param array $htmlOptions additional HTML attributes
	 * @return string the generated row
	 */
	public function radioButtonGroupsListRow($model, $attribute, $data = array(), $htmlOptions = array())
	{
		return $this->inputRow(YbInput::TYPE_RADIOBUTTONGROUPSLIST, $model, $attribute, $data, $htmlOptions);
	}

	/**
	 * Renders a WYSIWYG redactor editor
	 * @param $model
	 * @param $attribute
	 * @param array $htmlOptions
	 * @return string
	 */
	public function redactorRow($model, $attribute, $htmlOptions = array())
	{
		return $this->inputRow(YbInput::TYPE_REDACTOR, $model, $attribute, null, $htmlOptions);
	}

	/**
	 * Renders a WYSIWYG Markdown editor
	 * @param $model
	 * @param $attribute
	 * @param array $htmlOptions
	 * @return string
	 */
	public function markdownEditorRow($model, $attribute, $htmlOptions = array())
	{
		return $this->inputRow(YbInput::TYPE_MARKDOWNEDITOR, $model, $attribute, null, $htmlOptions);
	}

	/**
	 * Renders a WYSIWYG bootstrap editor
	 * @param $model
	 * @param $attribute
	 * @param array $htmlOptions
	 * @return string
	 */
	public function html5EditorRow($model, $attribute, $htmlOptions = array())
	{
		return $this->inputRow(YbInput::TYPE_HTML5EDITOR, $model, $attribute, null, $htmlOptions);
	}

	/**
	 * Renders a WYSIWYG  ckeditor
	 * @param $model
	 * @param $attribute
	 * @param array $htmlOptions
	 * @return string
	 */
	public function ckEditorRow($model, $attribute, $htmlOptions = array())
	{
		return $this->inputRow(YbInput::TYPE_CKEDITOR, $model, $attribute, null, $htmlOptions);
	}

	/**
	 * Renders a datepicker field row.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes. 'events' and 'options' key specify the events
	 * and configuration options of datepicker respectively.
	 * @return string the generated row
	 * @since 1.0.2 Booster
	 */
	public function datepickerRow($model, $attribute, $htmlOptions = array())
	{
		return $this->inputRow(YbInput::TYPE_DATEPICKER, $model, $attribute, null, $htmlOptions);
	}

	/**
	 * Renders a colorpicker field row.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes. 'events' and 'options' key specify the events
	 * and configuration options of colorpicker respectively.
	 * @return string the generated row
	 * @since 1.0.3 Booster
	 */
	public function colorpickerRow($model, $attribute, $htmlOptions = array())
	{
		return $this->inputRow(YbInput::TYPE_COLORPICKER, $model, $attribute, null, $htmlOptions);
	}

	/**
	 * @param $model
	 * @param $attribute
	 * @param array $htmlOptions addition HTML attributes. In order to pass initialization parameters to dateRange, you
	 * need to set the HTML 'options' key with an array of configuration options. 'options' also has a
	 */
	public function dateRangeRow($model, $attribute, $htmlOptions = array())
	{
		return $this->inputRow(YbInput::TYPE_DATERANGEPICKER, $model, $attribute, null, $htmlOptions);
	}

	/**
	 * Renders a timepicker field row.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes
	 * @return string the generated row
	 * @since 0.10.0
	 */
	public function timepickerRow($model, $attribute, $htmlOptions = array())
	{
		return $this->inputRow(YbInput::TYPE_TIMEPICKER, $model, $attribute, null, $htmlOptions);
	}

	/**
	 * Renders a select2 field row
	 * @param $model
	 * @param $attribute
	 * @param array $htmlOptions
	 * @return string
	 */
	public function select2Row($model, $attribute, $htmlOptions = array())
	{
		return $this->inputRow(YbInput::TYPE_SELECT2, $model, $attribute, null, $htmlOptions);
	}

	/**
	 * Renders a radio button list for a model attribute using Button Groups.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $data value-label pairs used to generate the radio button list.
	 * @param array $htmlOptions additional HTML options.
	 * @return string the generated radio button list
	 * @since 0.9.5
	 */
	public function radioButtonGroupsList($model, $attribute, $data, $htmlOptions = array())
	{
		$buttons = array();
		$scripts = array();

		$hiddenFieldId = CHtml::getIdByName(get_class($model) . '[' . $attribute . ']');
		$buttonType = isset($htmlOptions['type']) ? $htmlOptions['type'] : null;

		foreach ($data as $key => $value) {
			$btnId = CHtml::getIdByName(get_class($model) . '[' . $attribute . '][' . $key . ']');

			$button = array();
			$button['label'] = $value;
			$button['htmlOptions'] = array(
				'value' => $key,
				'id' => $btnId,
				'class' => (isset($model->$attribute) && $model->$attribute == $key ? 'active': ''),
			);
			$buttons[] = $button;

			// event as ordinary input
			$scripts[] = "\$('#" . $btnId . "').click(function(){
                \$('#" . $hiddenFieldId . "').val('" . $key . "').trigger('change');
            });";
		}

		Yii::app()->controller->widget('bootstrap.widgets.TbButtonGroup', array(
			'buttonType' => 'button',
			'toggle' => 'radio',
			'htmlOptions' => $htmlOptions,
			'buttons' => $buttons,
			'type' => $buttonType,
		));

		echo $this->hiddenField($model, $attribute);

		Yii::app()->clientScript->registerScript('radiobuttongrouplist-' . $attribute, implode("\n", $scripts));
	}

	/**
	 * Returns the input widget class name suitable for the form.
	 * @return string the class name
	 */
	protected function getInputClassName()
	{
		if (isset($this->input))
			return $this->input;
		else
		{
			switch ($this->type)
			{
				case self::TYPE_HORIZONTAL:
					return self::INPUT_HORIZONTAL;
					break;

				case self::TYPE_INLINE:
					return self::INPUT_INLINE;
					break;

				case self::TYPE_SEARCH:
					return self::INPUT_SEARCH;
					break;

				case self::TYPE_VERTICAL:
				default:
					return self::INPUT_VERTICAL;
					break;
			}
		}
	}
}