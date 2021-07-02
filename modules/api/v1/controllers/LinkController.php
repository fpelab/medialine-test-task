<?php

namespace app\modules\api\v1\controllers;

use Yii;
use yii\rest\Controller;
use yii\rest\CreateAction;
use app\modules\api\models\Link;
use yii\web\NotFoundHttpException;

/** @noinspection PhpUnused */
class LinkController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions(): array
    {
        return [
            'create' => [
                'class' => CreateAction::class,
                'modelClass' => Link::class
            ],
        ];
    }

    /**
     * @param $hash
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionView($hash): array
    {
        $model = Link::findOne(['hash' => $hash]);

        if ($model === null) {
            throw new NotFoundHttpException("Link not found with hash: $hash");
        }
        return [
            'url' => $model->url,
            'counter' => $model->counter
        ];
    }

    /**
     * Handle 404 inside API to prevent html response
     * @return array
     */
    public function actionError(): array
    {
        Yii::$app->response->statusCode = 404;
        return [
            'name' => 'Not Found',
            'message' => 'Endpoint not found',
            'status' =>  404,
        ];
    }
}
