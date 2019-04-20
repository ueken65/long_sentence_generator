<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Http\Requests\ImageUploadRequest;

class WaterMarkController extends Controller
{
    public function index()
    {
        return view('waterMarkForm');
    }

    public function createImage(ImageUploadRequest $request)
    {
        $name = $request->image->getClientOriginalName();

        $file = $request->image;
        $image = \Image::make(file_get_contents($file->getRealPath()));
        
        $width  = 1080;
        // 横幅と比例してリサイズするための高さを計算する
        $height = $image->height() / ($image->width() / $width);

        return $image->resize($width, $height)->insert('mochiya_wm.png')->response();

        return $image->response();

        $request->image->storeAs(
            'uploadImage', 'wm_'.$name, ['disk' => 'public']
        );

        $imagePath = 'storage/uploadImage/wm_'.$name;

        $disk = \Storage::disk('public');
        $mimetype = $disk->mimeType($imagePath);
    

        // echo $im;
    }
}
