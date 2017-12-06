<?php

namespace App\Extra;

class Qr
{
    // support png file
    public static function encode($content, $size = 1024, $encode='utf-8')
    {
        $renderer = new \BaconQrCode\Renderer\Image\Png();
        $renderer->setHeight($size);
        $renderer->setWidth($size);
        $writer = new \BaconQrCode\Writer($renderer);

        return $writer->writeString($content, $encode );
    }
}