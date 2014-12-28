<?php

namespace wolfguard\config;

use yii\base\BootstrapInterface;
use yii\web\GroupUrlRule;

/**
 * Bootstrap class registers module and config application component. It also creates some url rules which will be applied
 * when UrlManager.enablePrettyUrl is enabled.
 *
 * @author Ivan Fedyaev <ivan.fedyaev@gmail.com>
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        if (!$app->hasModule('config')) {
            $app->setModule('config', [
                'class' => 'wolfguard\config\Module'
            ]);
        }

        /** @var $module Module */
        $module = $app->getModule('config');

        if ($app instanceof \yii\console\Application) {
            $module->controllerNamespace = 'wolfguard\config\commands';
        } else {
            $configUrlRule = [
                'prefix' => $module->urlPrefix,
                'rules'  => $module->urlRules
            ];

            if ($module->urlPrefix != 'config') {
                $configUrlRule['routePrefix'] = 'config';
            }

            $app->get('urlManager')->rules[] = new GroupUrlRule($configUrlRule);
        }

        $app->get('i18n')->translations['config*'] = [
            'class'    => 'yii\i18n\PhpMessageSource',
            'basePath' => __DIR__ . '/messages',
        ];
    }
}