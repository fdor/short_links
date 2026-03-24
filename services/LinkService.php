<?php

namespace app\services;

use app\models\Link;
use chillerlan\QRCode\QRCode;
use yii\helpers\Url;

class LinkService
{
    public function checkUrl(?string $url): array
    {
        if (!$url) {
            return [
                'success' => false,
                'message' => 'Ссылка не указана'
            ];
        }

        if (!$this->checkValidity($url)) {
            return [
                'success' => false,
                'message' => 'Ссылка не валидна'
            ];
        }

        if (!$this->checkAvailable($url)) {
            return [
                'success' => false,
                'message' => 'Сайт не доступен'
            ];
        }

        $link = $this->saveLink($url);

        $qrcode = (new QRCode())->render($link->short);

        return [
            'success' => true,
            'message' => 'Ok',
            'qrcode' => $qrcode,
            'link' => $link->short,
        ];
    }

    private function checkValidity(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    private function checkAvailable(string $url): bool
    {
        $headers = @get_headers($url);
        if ($headers && strpos($headers[0], '200')) {
            return true;
        }

        return false;
    }

    private function saveLink(string $url): Link
    {
        if (!$link = Link::findOne(['url' => $url])) {
            $link = new Link();
            $link->url = $url;
            $link->short = Url::base('http') . '/go/' . uniqid();
            $link->save();
        }

        return $link;
    }
}