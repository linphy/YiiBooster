<?php

Yii::import('yiibooster.widgets.input.YbInputInline');

class YbInputSearch extends YbInputInline
{
	/**
	 * Renders a text field.
	 * @return string the rendered content
	 */
	protected function searchField()
	{
		if (isset($this->htmlOptions['class']))
			$this->htmlOptions['class'] .= ' search-query';
		else
			$this->htmlOptions['class'] = 'search-query';

		$this->htmlOptions['placeholder'] = $this->model->getAttributeLabel($this->attribute);
		echo $this->getPrepend();
		echo $this->form->textField($this->model, $this->attribute, $this->htmlOptions);
		echo $this->getAppend();
		echo $this->getError().$this->getHint();
	}
}