<?php

namespace app\modules\api\v1\config;

use Yii;
use yii\base\ExitException;
use yii\web\UrlRuleInterface;
use app\modules\api\models\Link;
use yii\base\InvalidConfigException;

/** @noinspection PhpUnused */
class ErrorUrlRule implements UrlRuleInterface
{

    /**
     * {@inheritdoc}
     * @throws InvalidConfigException
     */
    public function parseRequest($manager, $request)
    {
        $path = $request->getPathInfo();
        $pathInfo = explode('/', $path);
        $pathInfo = array_filter($pathInfo);

        if ($pathInfo[0] === 'v1') {
            return ['v1/link/error', []];
        }

        return false;
    }

    public function createUrl($manager, $route, $params)
    {
        // TODO: Implement createUrl() method.
    }
}
