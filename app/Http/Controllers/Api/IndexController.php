<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use App\Models\Committee;
use App\Models\Students;
use App\Models\User;
use View;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ApiHelper;

class IndexController extends Controller
{

  public function sendResponse($response)
  {
      return response()->json($response, 200);
  }
  
  public function sendError($error, $code = 400)
  {
      $response = [
          'error' => $error,
      ];

      return response()->json($response, $code);
  }
  
 
}
