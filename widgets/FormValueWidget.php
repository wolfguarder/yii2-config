<?php

namespace wolfguard\config\widgets;

use yii\widgets\InputWidget;

class FormValueWidget extends InputWidget
{
    public function run()
    {
        if(!empty($this->model->{$this->attribute})) {
            echo  '<div class="form-control">' . $this->model->{$this->attribute} . '</div>';
        }
    }
} 