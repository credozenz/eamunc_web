<?php

namespace App\Http\Controllers\App\Bureau;

use App\Helpers\WebAppHelper;
use App\Http\Controllers\Controller;
use App\Models\Committee;
use App\Models\Program_schedule;
use App\Models\Program_schedule_time;
use App\Models\Program_schedule_attendance;

use App\Models\User;
use Carbon\Carbon;
use DB;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use View;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer as Writer;

class BureauScheduleProgramController extends Controller
{
    public function __construct()
    {
        View::share('routeGroup', 'bureau_guideline');
    }
    public function index(Request $request)
    {
        $member = WebAppHelper::getLogMember();

        $committee = Committee::where('id', $member->committee_choice)->first();

        $schedule = Program_schedule::where('deleted_at', null)->where('committe_id', $committee->id)->orderBy('id', 'ASC')->paginate(25);

        $program_schedule = $schedule->map(function ($item, $key) {

            $time = Program_schedule_time::where('schedule_id', $item->id)->get();
            return [
                'id' => $item->id,
                'date' => $item->date,
                'time' => $time,
            ];
        });

        return view('app/bureau/program_schedule/index', compact('program_schedule', 'committee'));
    }

    public function bureau_program_attendance(Request $request)
    {
        View::share('routeGroup', '');
        $member = WebAppHelper::getLogMember();

        $committee = Committee::where('id', $member->committee_choice)->first();

        $program_schedule = Program_schedule::where('deleted_at', null)->where('committe_id', $committee->id)->orderBy('id', 'ASC')->get();
       
        foreach ($program_schedule as $k => $v) {
            $time = Program_schedule_time::where('schedule_id', $v->id)->get();
            foreach ($time as $tk => $tv) {
                $committee_member = User::where('users.deleted_at', null)
                ->join('students', 'users.id', '=', 'students.user_id')
                ->join('countries', 'countries.id', '=', 'students.country_choice')
                ->select('users.id', 'users.role', 'users.name', 'countries.name as cntry_name')
                ->where('students.status', '=', 3)
                ->where('students.committee_choice', '=', $committee->id)
                ->get();
                foreach ($committee_member as $ck => $cv) {
                    
                    $att = DB::table('program_schedule_attendance')->where('schedule_id', $tv->schedule_id)->where('time_id', $tv->id)->where('user_id', $cv->id)->where('attendance', 1)->first();
                    if ($att) {
                        $committee_member[$ck]->at = 1;
                    } else {
                        $committee_member[$ck]->at = 0;
                    }
                }
                $time[$tk]->members = $committee_member;
            }
            $program_schedule[$k]->time = $time;
        }
        // dd( $program_schedule);
        return view('app/bureau/program_schedule/attendance', compact('program_schedule', 'committee'));
    }
    public function bureau_program_attendance_export(Request $request)
    {

        
        View::share('routeGroup', '');
        $member = WebAppHelper::getLogMember();

        $committee = Committee::where('id', $member->committee_choice)->first();

        $program_schedule = Program_schedule::where('deleted_at', null)->where('committe_id', $committee->id)->orderBy('id', 'ASC')->get();
       
        foreach ($program_schedule as $k => $v) {
            $time = Program_schedule_time::where('schedule_id', $v->id)->get();
            foreach ($time as $tk => $tv) {
                $committee_member = User::where('users.deleted_at', null)
                ->join('students', 'users.id', '=', 'students.user_id')
                ->join('countries', 'countries.id', '=', 'students.country_choice')
                ->select('users.id', 'users.role', 'users.name', 'countries.name as cntry_name')
                ->where('students.status', '=', 3)
                ->where('students.committee_choice', '=', $committee->id)
                ->get();
                foreach ($committee_member as $ck => $cv) {
                    
                    $att = DB::table('program_schedule_attendance')->where('schedule_id', $tv->schedule_id)->where('time_id', $tv->id)->where('user_id', $cv->id)->where('attendance', 1)->first();
                    if ($att) {
                        $committee_member[$ck]->at = 1;
                    } else {
                        $committee_member[$ck]->at = 0;
                    }
                }
                $time[$tk]->members = $committee_member;
            }
            $program_schedule[$k]->time = $time;
        }

        $styleArray = array(
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => '000000'),
                'background-color' => array('rgb' => '800000'),
                'size' => 12,
                'name' => 'Verdana',
            ),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ),
        );

        $styleArray1 = array(
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => '000000'),
                'background-color' => array('rgb' => '800000'),
                'size' => 10,
                'name' => 'Verdana',
            ),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
            ),
        );

       
      
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->getColumnDimension('A')->setWidth(35);
        $sheet->getColumnDimension('B')->setWidth(35);

        $sheet->mergeCells('A1:B1');
        $sheet->mergeCells('A2:B2');
       
        $sheet->getStyle('A1')->applyFromArray($styleArray);
        $sheet->getStyle('A2')->applyFromArray($styleArray);
        $sheet->setCellValue('A1', 'E.Ahamed Model United Nations Conference');
        $sheet->setCellValue('A2',  $committee->title. ' Attendance List');

        $sheet->setCellValue('A3', '');
        $sheet->setCellValue('A4', '');
        
       
        $rows = 4;
        foreach ($program_schedule as $key => $value){
            $rows = $rows + 1;
            $sheet->mergeCells("A$rows:B$rows");
            $sheet->mergeCells("A$rows:B$rows");
            $sheet->setCellValue("A$rows", date('d F, Y (l)', strtotime($value['date'])) ?? '');

            $sheet->getStyle("A$rows")->applyFromArray($styleArray1);

            foreach ($value->time as $tkey => $time){
                $rows = $rows + 1;
                $sheet->mergeCells("A$rows:B$rows");
                $sheet->mergeCells("A$rows:B$rows");
                $dt_time =  date('g:i a', strtotime($time->time_start)) ?? '' . date('g:i a', strtotime($time->time_end)) ?? ('' ?? '');
                $sheet->setCellValue("A$rows", $dt_time);
                $sheet->getStyle("A$rows")->applyFromArray($styleArray1);

                $rows = $rows + 1;
                $sheet->mergeCells("A$rows:B$rows");
                $sheet->mergeCells("A$rows:B$rows");
                $sheet->setCellValue("A$rows", $time->title);
                $sheet->getStyle("A$rows")->applyFromArray($styleArray1);

                $rows = $rows + 1;
                $sheet->setCellValue("A$rows", "");
                $sheet->setCellValue("B$rows", "");
                $rows = $rows + 1;
                $sheet->setCellValue("A$rows", "");
                $sheet->setCellValue("B$rows", "");

                $rows = $rows + 1;
                $sheet->setCellValue("A$rows", "Bureau Member");
                $sheet->setCellValue("B$rows", "Attendance");

                $sheet->getStyle("A$rows")->applyFromArray($styleArray1);
                $sheet->getStyle("B$rows")->applyFromArray($styleArray1);

                foreach ($time->members as $mkey => $mval){
                    if ($mval->role == 3){
                        $rows = $rows + 1;
                        $sheet->setCellValue("A$rows", $mval->name);
                        $sheet->setCellValue("B$rows", $mval->at ? "Attended" : "Not Attended");
                    }
                }

                $rows = $rows + 1;
                $sheet->setCellValue("A$rows", "");
                $sheet->setCellValue("B$rows", "");
                $rows = $rows + 1;
                $sheet->setCellValue("A$rows", "");
                $sheet->setCellValue("B$rows", "");

                $rows = $rows + 1;
                $sheet->setCellValue("A$rows", "Delegate");
                $sheet->setCellValue("B$rows", "Attendance");

                $sheet->getStyle("A$rows")->applyFromArray($styleArray1);
                $sheet->getStyle("B$rows")->applyFromArray($styleArray1);

                foreach ($time->members as $mkey => $mval){
                    if ($mval->role == 2){
                        $rows = $rows + 1;
                        $sheet->setCellValue("A$rows", $mval->cntry_name);
                        $sheet->setCellValue("B$rows", $mval->at ? "Attended" : "Not Attended");
                    }
                }
                $rows = $rows + 1;
                $sheet->setCellValue("A$rows", "");
                $sheet->setCellValue("B$rows", "");
                $rows = $rows + 1;
                $sheet->setCellValue("A$rows", "");
                $sheet->setCellValue("B$rows", "");
                   
                   
            }
        }
        $writer = new Xlsx($spreadsheet);
        $fileName = "attendance." . time() . ".xlsx";
        $filePath = "./excel/students/" . $fileName;
        $writer->save($filePath);
        return response()->download($filePath);

       dd('dd');
    }

    public function program_attendance_store(Request $request)
    {
        $member = WebAppHelper::getLogMember();

        $committee = Committee::where('id', $member->committee_choice)->first();

        $at = $request->at;
        foreach ($at as $ak => $av) {
            foreach ($av['user'] as $uk => $uv) {
                Program_schedule_attendance::where('schedule_id',$av['schedule_id'])->where('time_id',$av['time_id'])->where('user_id',$uv)->delete();
                $ins['schedule_id'] = $av['schedule_id'];
                $ins['time_id'] = $av['time_id'];
                $ins['user_id'] = $uv;
                $ins['attendance'] = 0;
                if (isset($av['at'][$uv])) {
                    $ins['attendance'] = 1;
                }
                Program_schedule_attendance::create($ins);
            }
        }

        Session::flash('success', 'Attendance added successfully!');
        return redirect('/app/bureau_program_attendance');
    }

    public function create()
    {
        return view('app/bureau/program_schedule/create');
    }

    public function store(Request $request)
    {

        $member = WebAppHelper::getLogMember();

        $committee = Committee::where('id', $member->committee_choice)->first();

        $validatedData = $request->validate([
            "date" => 'required',
            "title" => "required|array",
            "title.*" => "required",
            "time_start" => "required|array",
            "time_start.*" => "required",
            "time_end" => "required|array",
            "time_end.*" => "required",
        ], [
            'date.required' => 'The Date field is required',
            'title.required' => 'The Title field is required',
            'time_start.required' => 'The start time field is required',
            'time_end.required' => 'The end time field is required',
        ]);

        $schedule = new Program_schedule;
        $schedule->committe_id = $committee->id;
        $schedule->date = date('Y-m-d', strtotime($request->date));
        $schedule->save();

        $title = $request->input('title');
        $start_time = $request->input('time_start');
        $end_time = $request->input('time_end');

        $insert_schedule = array();

        for ($count = 0; $count < count($title); $count++) {
            if (!empty($title[$count])) {
                $data = array(
                    'title' => $title[$count],
                    'time_start' => $start_time[$count],
                    'time_end' => $end_time[$count],
                    'schedule_id' => $schedule->id,
                );

                $insert_schedule[] = $data;
            }
        }

        Program_schedule_time::insert($insert_schedule);

        if ($schedule->id) {
            Session::flash('success', 'Schedule added successfully!');
            return redirect('/app/bureau_program_schedule');
        } else {
            Session::flash('error', 'Something went wrong!!');
            return redirect()->back();
        }

    }

    public function destroy(Request $request, $id)
    {

        $news = Program_schedule::where('id', $id)->first();
        $mytime = Carbon::now();
        $timestamp = $mytime->toDateTimeString();
        $news->deleted_at = $timestamp;
        $news->save();

        echo json_encode(['status' => true, 'message' => 'Schedule Deleted Successfully !']);exit();
    }
}
