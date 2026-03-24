<?php

namespace app\controllers;

use app\services\LinkService;
use app\services\LogService;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class GoController extends Controller
{
    /**
     * Statistics
     */
    public function actionIndex($short)
    {
        $service = Yii::createObject(LogService::class);
        $fullLink = $service->updateLog(htmlspecialchars($short));
        $this->redirect($fullLink, 301);
    }
}
