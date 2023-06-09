<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Dompdf\Dompdf;
use Dompdf\Options;
use Mpdf\Mpdf;
use View;
use App\Helpers\AdminHelper;
use App\Models\SiteIndexes;
use App\Models\School;
use App\Models\Students;
use App\Models\Countries;
use App\Models\Committee;
use App\Models\CertificateSetup;
use App\Models\Certificate;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use Str;
use Mail;
use Image;
use Storage;
use League\Flysystem\File;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer as Writer;

class StudentsController extends Controller
{
    public function __construct()
    {
        View::share('routeGroup','students');
    }
    
 
    public function index(Request $request)
    {

        $query = user::where('users.deleted_at', null)
        ->join('students', 'users.id', '=', 'students.user_id')
        ->leftjoin('schools', 'students.school_id', '=', 'schools.id')
        ->select('students.*', 'schools.name as school_name', 'users.role')
        ->where('users.role', '!=' , 1);
        
        if($request->q){
            $query->where('students.name','LIKE', $request->q)
            ->orwhere('schools.name','LIKE', $request->q)
            ->orwhere('students.email','LIKE', $request->q)
            ->orwhere('students.whatsapp_no','LIKE', $request->q);
        }

        if($request->s != NULL){
            $query->where('students.status','=', $request->s);
        }

        if($request->t != NULL){
            $query->where('users.type','=', $request->t);
        }

        if($request->r != NULL){
            $query->where('users.role','=', $request->r);
        }

        if($request->school != NULL){
            $query->where('students.school_id','=', $request->school);
        }

        if($request->xls == '1'){
            $students = $query ->orderBy('students.id', 'desc')->get();
          
            $filePath = $this->students_export($students);
            return response()->download($filePath);
            $request->request->set('xls', '0');
            return redirect()->to($request->fullUrl());
        }

        $data = $query ->orderBy('students.id', 'desc')
        ->paginate(10);



        $school = School::where('deleted_at', null)
        ->where('id','!=', 1)
        ->orderBy('id', 'DESC')
        ->get();
       
        return view('admin/students/index', compact('data','school','request'));
       
    }

    public function edit(Request $request,$id)
    {
        $committees = Committee::where('deleted_at', null)->orderBy('id', 'DESC')->paginate(50); 
        $data   = students::where('id', $id)->first();  
        $school = School::where('id', $data->school_id)->first(); 
        $user   = User::where('id', $data->user_id)->first(); 
        $countries = Countries::where('deleted_at', null)->get();
        return view('admin/students/edit', compact('data','school','committees','user','countries'));
       
    }

    public function show(Request $request,$id)
    {
        $committees = Committee::where('deleted_at', null)->orderBy('id', 'DESC')->paginate(50);
        $data   = students::where('id', $id)->first();  
        $school = School::where('id', $data->school_id)->first();
        $user   = User::where('id', $data->user_id)->first(); 
        $countries = Countries::where('deleted_at', null)->get();
        return view('admin/students/show', compact('data','school','user','committees','id','countries'));
       
    }


    public function update(Request $request,$id)
    {

        
        $student = students::where('id', $id)->first();
        
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users,email,NULL,id,deleted_at,NULL',
            'class' => 'required|max:255',
            'committee_choice' => 'required|max:255',
            'country_choice' => 'required|max:255',
            // 'phone_code'    => 'required|max:255',
            // 'whatsapp_no'    => 'required|max:255',
            //'mun_experience' => 'required|max:255',
        ],[
            'name.required' => 'The Name field is required',
            'email.required' => 'The Email field is required',
            'email.email' => 'Please put valid email Number',
            'email.unique' => 'Email id already exists',
            'class.required' => 'The Class field is required',
            'committee_choice.required' => 'The Committee choice field is required',
            'country_choice.required' => 'The Country choice field is required',
            // 'phone_code.required' => 'The Phone code field is required',
            // 'whatsapp_no.required' => 'The WhatsApp No field is required',
            //'mun_experience.required' => 'The MUN Experience field is required',
        ]);


        $phone_code = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $request->phone_code);
        $position = $request->position;

        // if($request->role == '3'){

        //     $validatedData = $request->validate([
        //         'position' => 'required|max:255',
        //     ],[
        //         'position.required' => 'The position field is required',
        //     ]);

        //     $position = $request->position;

        // }
        
            $user = User::where('id', $student->user_id)->first();
            $user->name  = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->save();
           
            if($user->id){

            $student = students::where('id', $id)->first();
            $student->name  = $request->name;
            $student->email = $request->email;
            $student->class = $request->class;
            $student->committee_choice = $request->committee_choice;
            $student->country_choice   = $request->country_choice;
            $student->phone_code      = $phone_code;
            $student->whatsapp_no     = $request->whatsapp_no;
            $student->mun_experience  = $request->mun_experience;
            $student->awards_received = $request->awards_received;
            $student->user_id  = $user->id;
            $student->position = $position;
            if($request->status != null){

                if($request->status=='1'){

                    $check_student = user::where('users.deleted_at', null)
                    ->join('students', 'users.id', '=', 'students.user_id')
                    ->select('students.*', 'users.role')
                    ->where('users.role', '!=' , 2)
                    ->where('students.committee_choice', $student->committee_choice)
                    ->where('students.country_choice', $student->country_choice)
                    ->where('students.id', '!=' , $id)
                    ->first(); 

                    if(!empty($check_student)){
                        Session::flash('error', 'This country, Committee
                        combination has already been assigned to another Delegate !');
                        return  redirect()->back();
                    }

                }



                if($request->status=='2'){

                      
                    $committee = Committee::where('id', $student->committee_choice)->first();  
                    $country = Countries::where('id', $student->country_choice)->first(); 

                    $data['name']       = $student->name;
                    $data['committee']  = $committee->title;
                    $data['country']    = $country->name;

                        $token = Str::random(64);
    
                        $settoken = DB::table('password_resets')->insert([
                                        'email' => $student->email,
                                        'token' => $token,
                                        'created_at' => Carbon::now()
                                    ]);
                                
                            if($settoken) {
                                Mail::send('admin.auth.invite-email', ['token' => $token,'data' => $data], function($message) use($student){
                                    $message->to(trim($student->email));
                                    $message->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'));
                                    $message->subject('Set Password');
                                });
    
    
                               
                                
                            } 
                  


                }






            $student->status   = $request->status;
            }
            
            $student->save();
            
            if($student->id){
                Session::flash('success', 'Student Updated successfully Completed!');
                return redirect('admin/students');
            }else{
                Session::flash('error', 'Something went wrong!!');
                return  redirect()->back();
            }
        }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
        }
    
    }


    public function destroy(Request $request,$id)
    {
        $mytime = Carbon::now();
        $timestamp=$mytime->toDateTimeString();

        $student = students::where('id', $id)->first(); 
        $student->deleted_at = $timestamp;
        $student->save();

        $user = User::where('id', $student->user_id)->first(); 
        $user->deleted_at = $timestamp;
        $user->save();

        echo json_encode(['status'=>true,'message'=>'Student Deleted Successfully !']);exit();
    }



    public function status_change(Request $request,$id)
    {
        
        
        $validatedData = $request->validate([
            'status' => 'required',
            'role' => 'required',
        ],[
            'status.required' => 'The status field is required',
            'role.required' => 'The role field is required',
        ]);


        
            $student = students::where('user_id', $id)->first();
            $student->status  = $request->status;
            $student->save();

            $user = User::where('id', $id)->first();
            $user->role  = $request->role;
            $user->save(); 

          
            if($student){
                Session::flash('success', 'Student status successfully Completed!');
                return redirect('admin/students');
            }else{
                Session::flash('error', 'Something went wrong!!');
                return  redirect()->back();
            }
       
    
    }



    public function invite_student(Request $request,$id)
    {
        
        
            $student = students::where('id', $id)->first();
            $committee = Committee::where('id', $student->committee_choice)->first();  
            $country = Countries::where('id', $student->country_choice)->first(); 
            
            $data['name'] = $student->name;
            $data['committee'] = $committee->title;
            $data['country'] = $country->name;

                if($student){

                  $token = Str::random(64);

                 

               $settoken = DB::table('password_resets')->insert([
                            'email' => $student->email,
                            'token' => $token,
                            'created_at' => Carbon::now()
                        ]);
                    
                if($settoken) {
                    Mail::send('admin.auth.invite-email', ['token' => $token,'data' => $data], function($message) use($student){
                        $message->to(trim($student->email));
                        $message->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'));
                        $message->subject('Set Password');
                    });


                    $student->status  = 2;
                    $student->save();

                    
                  } 
                }
           
                
            if($student){
                Session::flash('success', 'Student invited successfully Completed!');
                return  redirect()->back();
            }else{
                Session::flash('error', 'Something went wrong!!');
                return  redirect()->back();
            }


    }
       
    
    
    public function change_password(Request $request,$id)
    {
        
        
        $student = students::where('id', $id)->first();
        return view('admin/students/change_password', compact('student'));
       
      
    }



    public function update_password(Request $request,$id)
    {

        $request->validate([
            'password' => 'required|string|min:8',
            'password_confirm' => 'required|same:password'
        ],[
            'password.min' => 'The Password min 8 required',
            'password.string' => 'The Password include string',
            'password.required' => 'The Password field is required',
            'password_confirm.required' => 'The Password confirmation field is required',
            'password_confirm.same' => 'Password and Confirm Password must match',
        ]);

    

        $student = students::where('id', $id)->first();
        $user = User::where('id', $student->user_id)->first(); 

        $user->password = Hash::make($request->password);
        $user->save();
           
           
           if($user->id){
            Session::flash('success', 'Password updated successfully!');
            return redirect()->back();
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

        
       
      
   
       
    
    }




  
    public function student_certificate(Request $request,$id) {
        $student = students::where('id', $id)->first(); 
       
        $data = Certificate::where('id',1)->first();
        $html = $data->certi_design;

        $setup = CertificateSetup::where('deleted_at', null)->orderBy('id', 'ASC')->get();

        $committee = Committee::where('id', $student->committee_choice)->first();
        $country = Countries::where('id', $student->country_choice)->first();
        $html = str_replace("%student_name%", $student->name, $html);
        $html = str_replace("%committee_name%", $committee->name, $html);

        if(!empty($setup)){
            foreach ($setup as $each){
                if($each->index_type == 'text'){
                    $html =str_replace($each->index_name, $each->index_value, $html);
                }elseif($each->index_type == 'file'){
                    $img = file_get_contents($each->index_value);
                    $img_data = base64_encode($img);
                    $img_data ="data:image/png;base64,'.$img_data.'";
                    $html = str_replace($each->index_name, $img_data, $html);
                }
                    
            }
        }

    
      
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html); 
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        // $dompdf->stream('certificate_' . $student->name . '.pdf', array("Attachment" => false));
        // exit;
       
        $pdfContent = $dompdf->output(); // Get the PDF content as a string

        $data['name'] = $student->name;
        $data['committee'] = $committee->title;
        $data['country'] = $country->name;
        
        $send = Mail::send('admin.auth.issue-certificates', ['data' =>$data ], function($message) use($student, $pdfContent){
            $message->to(trim($student->email));
            $message->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'));
            $message->subject('Participation Certificate');
            $message->attachData($pdfContent, 'participation_certificate.pdf');
        });

        
 
    if (count(Mail::failures()) > 0) {
        Session::flash('error', 'Certificate could not be sent.');
    } else {

        $student = students::where('id', $id)->first();
        $student->certi_status  = '1';
        $student->save();

        Session::flash('success', 'Certificate sent successfully!');
    }

        return redirect()->back();

      
}



public function student_bulk_certi(Request $request) {


$students=$request->students;
$student_array = explode("#", $students);

if (is_null($student_array)) {
    Session::flash('error', 'Please choose students.');
    return redirect()->back();

}

foreach ($student_array as $key => $id) {
   


    $student = students::where('id', $id)->first(); 
   
    $data = Certificate::where('id',1)->first();
    $html = $data->certi_design;

    $setup = CertificateSetup::where('deleted_at', null)->orderBy('id', 'ASC')->get();

    $committee = Committee::where('id', $student->committee_choice)->first();
    $country = Countries::where('id', $student->country_choice)->first();
    $html = str_replace("%student_name%", $student->name, $html);
    $html = str_replace("%committee_name%", $committee->name, $html);

    if(!empty($setup)){
        foreach ($setup as $each){
            if($each->index_type == 'text'){
                $html =str_replace($each->index_name, $each->index_value, $html);
            }elseif($each->index_type == 'file'){
                $img = file_get_contents($each->index_value);
                $img_data = base64_encode($img);
                $img_data ="data:image/png;base64,'.$img_data.'";
                $html = str_replace($each->index_name, $img_data, $html);
            }
        }
    }

   
    $data['name'] = $student->name;
    $data['committee'] = $committee->title;
    $data['country'] = $country->name;
 
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html); 
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $pdfContent = $dompdf->output();
    
    $send = Mail::send('admin.auth.issue-certificates', ['data' =>$data ], function($message) use($student, $pdfContent){
        $message->to(trim($student->email));
        $message->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'));
        $message->subject('Participation Certificate');
        $message->attachData($pdfContent, 'participation_certificate.pdf');
    });


    if (count(Mail::failures()) < 0) {

        $student = students::where('id', $id)->first();
        $student->certi_status  = '1';
        $student->save();

    }


}

    
    if (count(Mail::failures()) > 0) {
        Session::flash('error', 'Certificate could not be sent.');
    } else {
        Session::flash('success', 'Certificate sent successfully!');
    }
    return redirect()->back();

    
}





public function student_bulk_invite(Request $request) {

    
    $students=$request->students;
    $student_array = explode("#", $students);
    
    if (is_null($student_array)) {
        Session::flash('error', 'Please choose students.');
        return redirect()->back();
    
    }
    
    foreach ($student_array as $key => $id) {
       
    
    
        $student = students::where('id', $id)->first();
        
        $committee = Committee::where('id', $student->committee_choice)->first();  
        $country = Countries::where('id', $student->country_choice)->first(); 
    
        $check_student = user::where('users.deleted_at', null)
                        ->join('students', 'users.id', '=', 'students.user_id')
                        ->select('students.*', 'users.role')
                        ->where('users.role', '!=' , 2)
                        ->where('students.committee_choice', $student->committee_choice)
                        ->where('students.country_choice', $student->country_choice)
                        ->where('students.id', '!=' , $id)
                        ->first(); 
  
            $unsendstudent = array();

                if(empty($check_student)){
                   
                    $data['name']      = $student->name;
                    $data['committee'] = $committee->title;
                    $data['country']   = $country->name;
    
                    if($student){
    
                            $token = Str::random(64);
    
                            $settoken = DB::table('password_resets')->insert([
                                        'email' => $student->email,
                                        'token' => $token,
                                        'created_at' => Carbon::now()
                                        ]);
                                
                            if($settoken) {
                                Mail::send('admin.auth.invite-email', ['token' => $token,'data' => $data], function($message) use($student){
                                    $message->to(trim($student->email));
                                    $message->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'));
                                    $message->subject('Set Password');
                                });
    
    
                                $student->status  = 2;
                                $student->save();
    
                                
                            } 
                    }
    
                } else {
    
                    $unsendstudent[] = $student->name;
                }            
    
    
    
        
        
       
            
            if (count(Mail::failures()) > 0) {
                Session::flash('error', 'Something went wrong!!');
            } else {
                Session::flash('success', 'Student invited successfully Completed!');
            }
    
            if(isset($unsendstudent[0])){
                foreach ($unsendstudent as $key => $student) {
                    Session::flash('error', $student.'Not Invite!, This country, Committee combination has already been assigned to another Delegate !');
                }
            }
            

            return redirect()->back();
    
    
       
    
    }
    
        
       
    
        
    }








    public function students_export($students)
    {



        $styleArray = array(
            'font'  => array(
                'bold'  => true,
                'color' => array('rgb' => '000000'),
                'background-color' => array('rgb' => '800000'),
                'size'  => 12,
                'name'  => 'Verdana'
            ),
            'alignment' => array(
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            )
            );

        $headstyleArray = array(
            'font'  => array(
                'bold'  => true,
                'color' => array('rgb' => '000000'),
                'size'  => 12,
                'name'  => 'Verdana'
            ),
            'alignment' => array(
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            )
            );

        $subheadstyleArray = array(
            'font'  => array(
                'bold'  => true,
                'color' => array('rgb' => '000000'),
                'size'  => 10,
                'name'  => 'Verdana'
            ),
            'alignment' => array(
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            )
            );







        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

                    $sheet->getColumnDimension('A')->setWidth(35);
                    $sheet->getColumnDimension('B')->setWidth(35);
                    $sheet->getColumnDimension('C')->setWidth(35);
                    $sheet->getColumnDimension('D')->setWidth(35);
                    $sheet->getColumnDimension('E')->setWidth(35);
                    $sheet->getColumnDimension('F')->setWidth(35);
                    $sheet->getColumnDimension('G')->setWidth(35);
                    $sheet->getColumnDimension('H')->setWidth(35);
                    $sheet->getColumnDimension('I')->setWidth(35);
                    $sheet->mergeCells('A1:I1');
                    $sheet->mergeCells('A2:I2');
                    $sheet->mergeCells('A3:I3');
                    $sheet->mergeCells('A4:I4');
                    $sheet->getStyle('A1')->applyFromArray($styleArray);
                    $sheet->getStyle('A2')->applyFromArray($headstyleArray);
                    $sheet->getStyle('A5')->applyFromArray($headstyleArray);
                    $sheet->getStyle('A6')->applyFromArray($subheadstyleArray);
                    $sheet->getStyle('B6')->applyFromArray($subheadstyleArray);
                    $sheet->getStyle('C6')->applyFromArray($subheadstyleArray);
                    $sheet->getStyle('D6')->applyFromArray($subheadstyleArray);
                    $sheet->getStyle('E6')->applyFromArray($subheadstyleArray);
                    $sheet->getStyle('F6')->applyFromArray($subheadstyleArray);
                    $sheet->getStyle('G6')->applyFromArray($subheadstyleArray);
                    $sheet->getStyle('H6')->applyFromArray($subheadstyleArray);
                    $sheet->getStyle('I6')->applyFromArray($subheadstyleArray);
                    $sheet->setCellValue('A1', 'E.Ahamed Model United Nations Conference');
                    $sheet->setCellValue('A2', 'Students List');

                   
                   
                  
                    $sheet->setCellValue('A3', '');
                    $sheet->setCellValue('A4', '');
                    $sheet->setCellValue('A5', '');
                    $sheet->setCellValue('A6', 'Name');
                    $sheet->setCellValue('B6', 'Email');
                    $sheet->setCellValue('C6', 'Phone');
                    $sheet->setCellValue('D6', 'Class');
                    $sheet->setCellValue('E6', 'MUN Experience');
                    $sheet->setCellValue('F6', 'Bureau Member Experience');
                    $sheet->setCellValue('G6', 'Position');
                    $sheet->setCellValue('H6', 'School');
                    $sheet->setCellValue('I6', 'Status');
                
                    $rows=6;

                    foreach ($students as $key => $each) {
                    $rows = $rows+1;
                    $sheet->setCellValue('A' . $rows, $each->name);
                    $sheet->setCellValue('B' . $rows, $each->email);
                    $sheet->setCellValue('C' . $rows, $each->phone_code.'-'.$each->whatsapp_no);
                    $sheet->setCellValue('D' . $rows, $each->class);
                    $sheet->setCellValue('E' . $rows, $each->mun_experience);
                    $sheet->setCellValue('F' . $rows, $each->bureaumem_experience);
                    $sheet->setCellValue('G' . $rows, $each->position);
                   

                    if($each->type=='1'){
                        $sheet->setCellValue('H' . $rows, 'ISG Student');
                    }elseif($each->type=='2'){
                        $sheet->setCellValue('H' . $rows, $each->school_name);
                    }
                    
                   

                    if($each->status=='0'){
                        $sheet->setCellValue('I' . $rows, 'Pending');
                    }elseif($each->status=='1'){
                        $sheet->setCellValue('I' . $rows, 'Approve');
                    }elseif($each->status=='2'){
                        $sheet->setCellValue('I' . $rows, 'Invite');
                    }elseif($each->status=='3'){
                        $sheet->setCellValue('I' . $rows, 'Active');
                    }elseif($each->status=='4'){
                        $sheet->setCellValue('I' . $rows, 'Reject');
                    }
                                            

                    }

                
                    
        
        $writer = new Xlsx($spreadsheet);
        $fileName = "students.".time().".xlsx";
        $filePath = "./excel/students/".$fileName;
        $writer->save($filePath);

        return $filePath;
       
    }
    




}
