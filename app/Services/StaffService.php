<?php
namespace App\Services;

use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

abstract class Staffservice
{
    /**
     * Create a Qrcode
     *
     * @param string $base_url
     * 
     * @param string $slug
     * 
     * @return void|Illuminate\Support\HtmlString|string|null
     */
    public static function create_qrcode(string $base_url, string $slug)
    {
        // Create the qrcode
        $base_url = trim('/', $base_url);
        return (!is_null($base_url)) ?
            QrCode::size(250)->generate($base_url . '/' . Str::slug($slug)) : null;
    }
}
