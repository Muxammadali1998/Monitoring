<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QrCodeController extends Controller
{
    public function qrcode($id)
    {
        $svg = \QrCode::size(300)->format('png')->generate($id);
        return $svg;
    }
}
