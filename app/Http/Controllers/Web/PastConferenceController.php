<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use View;
use App\Helper\WebHelper;
use App\Models\SiteIndexes;
use App\Models\Images;

class PastConferenceController extends Controller
{
    public function index()
    {
        $past_conferences = SiteIndexes::where('deleted_at', null)->where('type', 'past_conference')->orderBy('id', 'DESC')->paginate(4);
        return view('web/past-conferences', compact('past_conferences'));
    }

    public function index_inner($id)
    {
        $past_conferences = SiteIndexes::find($id); 
        $images = Images::where('connect_id', $id)->where('type', 'past_conference')->where('deleted_at', null)->orderBy('id', 'DESC')->paginate(4);
        return view('web/past-conference-inner', compact('past_conferences','images'));
    }
}