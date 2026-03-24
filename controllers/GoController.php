<?php

namespace app\controllers;

use app\services\LinkService;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class GoController extends Controller
{
    /**
     * Statistics
     */
    public function actionIndex($shortLink)
    {
        echo $shortLink;
    }
}
