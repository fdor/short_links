<?php

namespace app\services;

use app\models\Link;
use chillerlan\QRCode\QRCode;
use yii\helpers\Url;
use function PHPUnit\Framework\returnArgument;

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

        $shortLink = Url::base('http') . '/' . uniqid();
        $this->saveLink($url, $shortLink);

        $qrcode = (new QRCode())->render($shortLink);

        return [
            'success' => true,
            'message' => 'Ok',
            'qrcode' => $qrcode,
            'link' => $shortLink,
        ];
    }

    private function checkValidity(string $url): bool
    {
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            return true;
        }

        return false;
    }

    private function checkAvailable(string $url): bool
    {
        $headers = @get_headers($url);
        if ($headers && strpos($headers[0], '200')) {
            return true;
        }

        return false;
    }

    private function saveLink(string $url, string $shortLink): void
    {
        $link = new Link();
        $link->url = $url;
        $link->short = $shortLink;
        $link->save();
    }
}