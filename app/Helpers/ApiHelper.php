<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Intervention\Image\Facades\Image;
use Illuminate\Http\JsonResponse;
class ApiHelper
{

    public function sendError($message, $code = 400)
    {
        return response()->json(['error' => $message], $code);
    }

    public static function getYoutubeIdFromUrl($url) {
        $parts = parse_url($url);
        if(isset($parts['query'])){
              parse_str($parts['query'], $qs);
          if(isset($qs['v'])){
            return $qs['v'];
          }else if(isset($qs['vi'])){
            return $qs['vi'];
          }
        }
    if(isset($parts['path'])){
        $path = explode('/', trim($parts['path'], '/'));
        return $path[count($path)-1];
    }
    return '';
    }
  
}