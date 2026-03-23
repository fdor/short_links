<?php

namespace app\controllers;

use app\services\LinkService;
use chillerlan\QRCode\QRCode;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Validate URL
     *
     * @return array
     */
    public function actionValidate(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $url = htmlspecialchars(Yii::$app->request->post('url'));

        return LinkService::checkUrl($url);
    }
}
