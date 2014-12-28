<?php

namespace wolfguard\config\helpers;

/**
 * @property \wolfguard\config\Module $module
 */
trait ModuleTrait
{
    /**
     * @var null|\wolfguard\config\Module
     */
    private $_module;

    /**
     * @return null|\wolfguard\config\Module
     */
    protected function getModule()
    {
        if ($this->_module == null) {
            $this->_module = \Yii::$app->getModule('config');
        }

        return $this->_module;
    }
}