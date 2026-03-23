<?php

namespace app\services;

use chillerlan\QRCode\QRCode;
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

        $shortLink = 'http://short.loc/' . uniqid();

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
}