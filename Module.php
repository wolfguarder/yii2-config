<?php

namespace wolfguard\config;

use yii\base\Module as BaseModule;

/**
 * This is the main module class for the Yii2-config.
 *
 * @property ModelManager $manager
 *
 * @author Ivan Fedyaev <ivan.fedyaev@gmail.com>
 */
class Module extends BaseModule
{
    const VERSION = '0.1.0';

    /**
     * @var string The prefix for config module URL.
     * @See [[GroupUrlRule::prefix]]
     */
    public $urlPrefix = 'config';

    /**
     * @var array The rules to be used in URL management.
     */
    public $urlRules = [
        'admin/<action:\w+>'        => 'admin/<action>'
    ];

    /**
     * @inheritdoc
     */
    public function __construct($id, $parent = null, $config = [])
    {
        foreach ($this->getModuleComponents() as $name => $component) {
            if (!isset($config['components'][$name])) {
                $config['components'][$name] = $component;
            } elseif (is_array($config['components'][$name]) && !isset($config['components'][$name]['class'])) {
                $config['components'][$name]['class'] = $component['class'];
            }
        }
        parent::__construct($id, $parent, $config);
    }

    /**
     * Returns module components.
     * @return array
     */
    protected function getModuleComponents()
    {
        return [
            'manager' => [
                'class' => 'wolfguard\config\ModelManager'
            ],
        ];
    }
}
