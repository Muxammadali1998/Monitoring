<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Worker;
use Intervention\Image\Facades\Image;

class QrCodeController extends Controller
{
    public function qrcode($id)
    {
        \QrCode::size(300)->format('png')->generate($id, public_path('images/qrcode.png'));
        return $this->success('https://monitoring.a-umar.uz/images/qrcode.png','',200);
    }
    public function qr($id)
    {



        $worker = Worker::find($id);
        $shablon = Image::make('./images/shablon.jpg');
         \QrCode::size(300)->format('png')->generate($id, public_path('images/qrcode.png'));
        $qr = Image::make("./images/qrcode.png");
        $shablon->text($worker->name, 350 , 530, function($font){
            $font->file('font.ttf');
            $font->size(36);
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
        });
        $shablon->text($worker->job, 350 , 580, function($font){
            $font->file('font.ttf');
            $font->size(25);
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
        });
        $shablon->text( "Phone  ".$worker->phone, 350 , 700, function($font){
            $font->file('font.ttf');
            $font->size(25);
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
        });
        $shablon->text( auth()->name(), 180 , 60, function($font){
            $font->file('font.ttf');
            $font->size(30);
            $font->color('#fff');
            $font->align('center');
            $font->valign('top');
        });



        $shablon->insert($qr, 'top-left', 200, 200);
        $shablon->save('./images/new_image.jpg');


        return response()->download('./images/new_image.jpg');
    }
}
