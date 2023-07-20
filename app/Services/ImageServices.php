<?php

namespace App\Services;
use Illuminate\Support\Facades\Storage;

class ImageServices{
    public function uploadImage($file) {
        $path = Storage::putFile(
            'public/images',
            $file,
        );
        $url_image = Storage::url($path);
        $result = url('/') . $url_image;
        return $result;
    }
}
