<?php

namespace wolfguard\config\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%config}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property string $value
 * @property integer $system
 */
class Config extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%config}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'system'], 'required'],
            [['code'], 'match', 'pattern' => '/^[0-9a-zA-Z\_\.\-]+$/'],
            [['code'], 'string', 'min' => 3, 'max' => 255],
            [['code'], 'unique'],
            [['value'], 'string'],
            [['system'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => \Yii::t('config', 'Name'),
            'code' => \Yii::t('config', 'Code'),
            'value' => \Yii::t('config', 'Value'),
            'system' => \Yii::t('config', 'System'),
        ];
    }

    /** @inheritdoc */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /** @inheritdoc */
    public function scenarios()
    {
        return [
            'create'   => ['name', 'code', 'value', 'system'],
            'update'   => ['name', 'code', 'value', 'system'],
        ];
    }

    public function create()
    {
        if ($this->getIsNewRecord() == false) {
            throw new \RuntimeException('Calling "' . __CLASS__ . '::' . __METHOD__ . '" on existing object');
        }

        if ($this->save()) {
            \Yii::getLogger()->log('Configuration value has been created', Logger::LEVEL_INFO);
            return true;
        }

        \Yii::getLogger()->log('An error occurred while creating configuration value', Logger::LEVEL_ERROR);

        return false;
    }

    public function getDropdown($value = null)
    {
        $list = [
            0 => \Yii::t('config', 'No'),
            1 => \Yii::t('config', 'Yes'),
        ];

        if ($value !== null) {
            return $list[$value];
        }
        return $list;
    }
}
