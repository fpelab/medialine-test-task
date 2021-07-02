<?php

namespace app\components;

use Yii;
use yii\base\ExitException;
use yii\web\UrlRuleInterface;
use app\modules\api\models\Link;
use yii\base\InvalidConfigException;

/** @noinspection PhpUnused */
class ShortUrlRule implements UrlRuleInterface
{

    /**
     * {@inheritdoc}
     * @throws InvalidConfigException
     * @throws ExitException
     */
    public function parseRequest($manager, $request)
    {
        $path = $request->getPathInfo();
        $pathInfo = explode('/', $path);
        $pathInfo = array_filter($pathInfo);

        if (count($pathInfo) !== 1) {
            return false;
        }

        $model = Link::findOne(['hash' => $pathInfo[0]]);

        if ($model !== null) {
            $redirectUrl = $model->url;
            $model->updateCounters(['counter' => 1]);
            Yii::$app->getResponse()->redirect($redirectUrl)->send();
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: ' . $redirectUrl);
            Yii::$app->end();
        }

        return false;
    }

    public function createUrl($manager, $route, $params)
    {
        // TODO: Implement createUrl() method.
    }
}