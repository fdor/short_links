<?php

namespace app\services;

use chillerlan\QRCode\QRCode;

class LinkService
{
    public static function checkUrl(?string $url): array
    {
        if (!$url) {
            return [
                'success' => false,
                'message' => 'Ссылка не указана'
            ];
        }

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return [
                'success' => false,
                'message' => 'Ссылка не валидна'
            ];
        }

        $headers = @get_headers($url);

        if (!($headers && strpos($headers[0], '200'))) {
            return [
                'success' => false,
                'message' => 'Сайт не доступен'
            ];
        }

        $shortLink = 'http://short.loc/' . md5($url);

        $qrcode = (new QRCode())->render($shortLink);

        return [
            'success' => true,
            'message' => '<img style="width:500px" src="' . $qrcode . '" />' . $shortLink,
        ];
    }
}