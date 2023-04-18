<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use View;
use App\Helpers\WebHelper;
use App\Models\SiteIndexes;
use App\Models\Gallery;
use App\Models\Images;

class GalleryController extends Controller
{
    public function index()
    {
        

        $gallery = Gallery::where('deleted_at', null)->orderBy('id', 'DESC')->paginate(8); 

        return view('web/gallery', compact('gallery'));


    }

    public function index_inner($id)
    {
        $gallery = Gallery::find($id);
        $images = Images::where('connect_id', $id)->where('type', 'gallery')->where('deleted_at', null)->orderBy('id', 'DESC')->paginate(9);

        return view('web/gallery-inner', compact('gallery','images'));


    }
}
