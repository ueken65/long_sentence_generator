<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ReiwaFakeAdController extends Controller
{
    public function index ()
    {
        return view('reiwaFakeAdForm');
    }

    public function createImage (Request $request)
    {
        $text = $request->get('message');

        // テキストを描画したい画像
        $imagePath = 'letter.png';
        $im = new \Imagick($imagePath);
        $draw = new \ImagickDraw();

        // 描画するテキストのスタイル
        $font = 'huifont.ttf';
        $fontSize = 30;

        // 設定したいテキストの描画範囲の最大幅
        $width = $im->getImageWidth() - 100;

        // テキストを描画する基準点の座標
        $baseX = 50;
        $baseY = 100;

        // テキストの一行の描画高さ
        $lineHeight = 40;

        // テキストを描画幅に収まるように分割した配列を取得
        $wrappedText = $this->imagickTextWrap($text, $width, $font, $fontSize, $draw);

        foreach ($wrappedText as $_i => $_s) {
            $_y = $baseY + $lineHeight * ($_i);
            $draw->annotation($baseX, $_y, $_s);
        }

        $im->drawImage($draw);

        $im->setImageFormat("png");
        $im->writeImage('new_sample.png');

        echo '<img src="/new_sample.png">';

        $im->clear();
        $im->destroy();
    }

    public function imagickTextWrap($text, $width, $font, $fontSize, $draw) {
        $wrappedText = [];
        $im = new \Imagick();

        $draw->setFont($font);
        $draw->setFontSize($fontSize);

        // 一行分の文字
        // $textの先頭から一文字ずつ加える
        $_s = '';
        while ($text) {
            // 一行分の文字に先頭一文字加えた描画幅を取得
            $_a = mb_substr($text, 0, 1);
            $metrics = $im->queryFontMetrics($draw, $_s . $_a);

            // 描画幅が指定幅を超えたら、一文字加える前の文字をreturn用配列に追加し、
            // 一行分の文字をクリア
            if (isset($metrics['textWidth']) && $metrics['textWidth'] > $width) {
                $wrappedText[] = $_s;
                $_s = '';
            // 描画幅が指定幅以内であれば、一行分の文字に先頭一文字を加え、
            // $textの先頭一文字を削除する
            } else {
                $_s .= $_a;
                $text = mb_substr($text, 1);
            }

            // $textが0文字になった場合、一行分の文字をreturn用配列に追加し終了
            if (strlen($text) == 0) {
                $wrappedText[] = $_s;
                break;
            }
        }

        return $wrappedText;
    }
}
