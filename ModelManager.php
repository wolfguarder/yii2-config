<?php

namespace wolfguard\config;

use yii\base\Component;

/**
 * ModelManager is used in order to create models and find configs.
 *
 * @method models\Config               createConfig
 * @method models\ConfigSearch         createConfigSearch
 *
 * @author Ivan Fedyaev <ivan.fedyaev@gmail.com>
 */
class ModelManager extends Component
{
    /** @var string */
    public $configClass = 'wolfguard\config\models\Config';

    /** @var string */
    public $configSearchClass = 'wolfguard\config\models\ConfigSearch';

    /**
     * Finds a config by the given id.
     *
     * @param  integer $id Config id to be used on search.
     * @return models\Config
     */
    public function findConfigById($id)
    {
        return $this->findConfig(['id' => $id])->one();
    }

    /**
     * Finds a config by the given code.
     *
     * @param  string $code Code to be used on search.
     * @return models\Config
     */
    public function findConfigByCode($code)
    {
        return $this->findConfig(['code' => $code])->one();
    }

    /**
     * Finds a config by the given condition.
     *
     * @param  mixed $condition Condition to be used on search.
     * @return \yii\db\ActiveQuery
     */
    public function findConfig($condition)
    {
        return $this->createConfigQuery()->where($condition);
    }

    /**
     * @param string $name
     * @param array $params
     * @return mixed|object
     */
    public function __call($name, $params)
    {
        $property = (false !== ($query = strpos($name, 'Query'))) ? mb_substr($name, 6, -5) : mb_substr($name, 6);
        $property = lcfirst($property) . 'Class';
        if ($query) {
            return forward_static_call([$this->$property, 'find']);
        }
        if (isset($this->$property)) {
            $config = [];
            if (isset($params[0]) && is_array($params[0])) {
                $config = $params[0];
            }
            $config['class'] = $this->$property;
            return \Yii::createObject($config);
        }

        return parent::__call($name, $params);
    }
}