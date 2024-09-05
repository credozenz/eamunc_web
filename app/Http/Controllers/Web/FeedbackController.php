<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use View;
use App\Helpers\WebHelper;
use App\Models\SiteIndexes;
use App\Models\Committee;
use App\Models\Feedback_ans;
use App\Models\Feedback_qsn;
use App\Models\Feedback;
class FeedbackController extends Controller
{
    public function index()
    {
        

        $committees = Committee::where('deleted_at', null)->orderBy('id', 'DESC')->paginate(30); 
        $question = Feedback_qsn::where('deleted_at', null)->orderBy('id', 'DESC')->paginate(30); 

        return view('web/feedback', compact('committees','question'));


    }



    public function feedback_store(Request $request)
    {

        $validatedData = $request->validate([
            // 'delegate_name' => 'required|max:255',
            // 'email' => 'required|max:255',
            'committee' => 'required|max:255',
            'answer.9' => 'required',
            // 'country' => 'required|max:255',
        ],[
            'delegate_name.required' => 'The Delegate name field is required',
            'email.required' => 'The Email field is required',
            'committee.required' => 'The Committee field is required',
            'country.required' => 'The Country field is required',
            'answer.9.required' => 'This answer field is required.',
        ]);

            $feerback = new Feedback;
            $feerback->delegate_name   = $request->delegate_name;
            $feerback->email  = $request->email;
            $feerback->committee = $request->committee;
            $feerback->country = $request->country;
            $feerback->save();

            if($feerback->id){

        $question = $request->input('question');
        $answer = $request->input('answer');

        
        $insert_feedback=array();

    for($count = 0; $count < count($question); $count++)
    {
        if(!empty($answer[$count])){
        $data = array(
                'feedback_id' => $feerback->id,
                'question_id'  => $question[$count],
                'answers'    => $answer[$count],
              );

        $insert_feedback[] = $data; 
            }
     }

     
     
     Feedback_ans::insert($insert_feedback);



      
            if($feerback->id){
                Session::flash('success', 'Feedback successfully Submitted!');
                return redirect('feedback');
            }else{
                Session::flash('error', 'Something went wrong!!');
                return  redirect()->back();
            }
        }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
        }

   
    
    }
















}
