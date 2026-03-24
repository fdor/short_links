<?php

namespace app\services;

use app\models\Link;
use app\models\Log;
use Yii;
use yii\helpers\Url;

class LogService
{
    public function updateLog(string $short)
    {
        $shortLink = Url::base('http') . '/go/' . $short;
        $link = Link::findOne(['short' => $shortLink]);
        $this->saveLog($link);

        return $link->url;
    }

    private function saveLog(Link $link): void
    {
        if (!$log = Log::findOne(['link_id' => $link->id])) {
            $log = new Log();
            $log->link_id = $link->id;
            $log->count = 1;
        } else {
            $log->count = $log->count + 1;
        }

        $log->last_ip = Yii::$app->request->getUserIP();
        $log->save();
    }
}