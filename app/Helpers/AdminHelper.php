<?php
namespace App\Helper;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Intervention\Image\Facades\Image;
class AdminHelper
{

    public static function cdn_folder()
    {
      $config_cdn= view()->shared('config_cdn');
      $url = parse_url($config_cdn);
      return  trim($url['path'],'/').'/';
    }

}