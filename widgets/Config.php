<?php

namespace wolfguard\config\widgets;

use yii\base\Exception;
use wolfguard\config\helpers\ModuleTrait;
use yii\base\Widget;

/**
 * @author Ivan Fedyaev <ivan.fedyaev@gmail.com>
 */
class Config extends Widget
{
    use ModuleTrait;

    /**
     * @var string
     */
    public $code;

    public function init()
    {
        parent::init();
        if($this->code === null){
            throw new Exception(\Yii::t('config', 'No configuration code defined.'));
        }
    }

    public function run()
    {
        $model = $this->module->manager->findConfigByCode($this->code);
        if(!empty($model->value)) {
            return $model->value;
        }
    }

} 