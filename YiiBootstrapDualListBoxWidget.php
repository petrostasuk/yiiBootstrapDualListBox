<?php
/**
 * Created by PhpStorm.
 * User: peter
 * Date: 11.12.14
 * Time: 11:06
 */

class YiiBootstrapDualListBoxWidget extends CWidget
{
    public $model = null;
    public $name = null;
    public $htmlOptions = array();
    public $options = array();
    public $data = array();

    protected $_inputId = null;

    public function init()
    {
        if ($this->model === null && $this->name === null)
            throw new CException('Set the model or name');
        if (empty($this->data))
            throw new CException('Set the data list for select input');
        if (!isset($this->htmlOptions['id'])) {
            if ($this->model !== null) {
                $this->_inputId = CHtml::activeId($this->model, $this->name);
            } else {
                $this->_inputId = $this->name.uniqid();
            }
            $this->htmlOptions['id'] = $this->_inputId;
        } else {
            $this->_inputId = $this->htmlOptions['id'];
        }

        $this->registerClientScript();
    }

    public function run()
    {
        if (!isset($this->htmlOptions['multiple']) || $this->htmlOptions['multiple'] === false) {
            $this->htmlOptions['multiple'] = true;
        }
        if ($this->model !== null) {
            echo CHtml::activeDropDownList($this->model, $this->name, $this->data, $this->htmlOptions);
        } else {
            echo CHtml::dropDownList($this->name, isset($this->htmlOptions['selected']) ? $this->htmlOptions['selected'] : '', $this->data, $this->htmlOptions);
        }
    }

    /**
     * Get the assets path.
     * @return string
     */
    public function getAssetsPath()
    {
        return __DIR__ . '/assets';
    }

    /**
     * Publish assets and return url.
     * @return string
     */
    public function getAssetsUrl()
    {
        return Yii::app()->assetManager->publish($this->assetsPath);
    }

    /**
     * Register CSS and Script.
     */
    protected function registerClientScript()
    {
        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');
        $cs->registerCssFile($this->assetsUrl.'/bootstrap-duallistbox.min.css');
        $cs->registerScriptFile($this->assetsUrl.'/jquery.bootstrap-duallistbox.min.js');
        $cs->registerScript(__FILE__.$this->_inputId, '
            $("#'.$this->_inputId.'").bootstrapDualListbox('.$this->getPluginConfig().');
        ', CClientScript::POS_READY);
    }

    protected function getPluginConfig()
    {
        $pluginConfig = '';
        if (!empty($this->options)) {
            $pluginConfig = json_encode($this->options);
        }
        return $pluginConfig;
    }
}