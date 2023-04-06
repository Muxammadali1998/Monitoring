<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Traits\ApiResponcer;

class QrCodeController extends Controller
{
    use ApiRespocer;
    public function qrcode($id)
    {
        $svg = \QrCode::size(300)->generate($id);
        return $this->success($svg,'',200);
    }
}
