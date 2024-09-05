<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use View;
use App\Helpers\AdminHelper;
use App\Models\SiteIndexes;
use App\Models\Committee;
use App\Models\Committee_member;
use App\Models\User;
use App\Models\School;
use Carbon\Carbon;
use Str;
use Image;
use Storage;
use Alert;
use League\Flysystem\File;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer as Writer;

class ExportExcelController extends Controller
{
    public function __construct()
    {
        View::share('routeGroup','about');
    }
  
    public function committee_excelexport($id)
    {



        $committee  = Committee::find($id); 
        $query = user::where('users.deleted_at', null)
                ->join('students', 'users.id', '=', 'students.user_id')
                ->leftjoin('schools', 'students.school_id', '=', 'schools.id')
                ->leftjoin('countries', 'students.country_choice', '=', 'countries.id')
                ->select('students.*', 'schools.name as school_name', 'countries.name as country_choice_name', 'users.role')
                ->where('users.role', '=' , 3)
                ->whereIn('students.status', [1, 2, 3])
                ->where('students.committee_choice', '=' , $id);
        $bureau = $query->orderBy('students.id', 'desc')->get();

        $query1 = user::where('users.deleted_at', null)
                ->join('students', 'users.id', '=', 'students.user_id')
                ->leftjoin('schools', 'students.school_id', '=', 'schools.id')
                ->leftjoin('countries', 'students.country_choice', '=', 'countries.id')
                ->select('students.*', 'schools.name as school_name', 'countries.name as country_choice_name', 'users.role')
                ->where('users.role', '=' , 2)
                ->whereIn('students.status', [1, 2, 3])
                ->where('students.committee_choice', '=' , $id);
        $delegate = $query1->orderBy('students.id', 'desc')->get();
 
        $committee  = Committee::find($id); 

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
                    $sheet->setCellValue('A1', $committee->name.' - '.$committee->title.'');
                    $sheet->setCellValue('A2', $committee->sub_title);

                   
                    $wrappedParagraph = wordwrap($committee->description,250);
                    $lines = explode("\n", $wrappedParagraph);
                    $description = implode("\n", array_map('trim', $lines));
                    $sheet->getStyle('A3')->getAlignment()->setWrapText(true);
                  
                    $sheet->setCellValue('A3', $committee->description);
                    
                    
                    $sheet->setCellValue('A4', 'Agenda: '.$committee->agenda);
                    $sheet->setCellValue('A5', 'Committee Bureau Members');
                    $sheet->setCellValue('A6', 'Name');
                    $sheet->setCellValue('B6', 'Email');
                    $sheet->setCellValue('C6', 'Phone');
                    $sheet->setCellValue('D6', 'Class');
                    $sheet->setCellValue('E6', 'MUN Experience');
                    $sheet->setCellValue('F6', 'Bureau Member Experience');
                    $sheet->setCellValue('G6', 'Position');
                    $sheet->setCellValue('H6', 'School');

                
                    $rows=6;

                    foreach ($bureau as $key => $each) {
                    $rows = $rows+1;
                    $sheet->setCellValue('A' . $rows, $each->name);
                    $sheet->setCellValue('B' . $rows, $each->email);
                    $sheet->setCellValue('C' . $rows, $each->phone);
                    $sheet->setCellValue('D' . $rows, $each->class);
                    $sheet->setCellValue('E' . $rows, $each->mun_experience);
                    $sheet->setCellValue('F' . $rows, $each->bureaumem_experience);
                    $sheet->setCellValue('G' . $rows, $each->position);
                    $sheet->setCellValue('H' . $rows, $each->school_name);
                    }

                
                    $rows = $rows+1;

                    $sheet->getStyle('A' . $rows)->applyFromArray($headstyleArray);
                    $sheet->setCellValue('A' . $rows, 'Committee Delegates');
                    $rows = $rows+1;
                   
                    $sheet->getStyle('A' . $rows)->applyFromArray($subheadstyleArray);
                    $sheet->getStyle('B' . $rows)->applyFromArray($subheadstyleArray);
                    $sheet->getStyle('C' . $rows)->applyFromArray($subheadstyleArray);
                    $sheet->getStyle('D' . $rows)->applyFromArray($subheadstyleArray);
                    $sheet->getStyle('E' . $rows)->applyFromArray($subheadstyleArray);
                    $sheet->getStyle('F' . $rows)->applyFromArray($subheadstyleArray);
                    $sheet->getStyle('G' . $rows)->applyFromArray($subheadstyleArray);
                    $sheet->getStyle('H' . $rows)->applyFromArray($subheadstyleArray);
                    $sheet->getStyle('I' . $rows)->applyFromArray($subheadstyleArray);
                    $sheet->setCellValue('A' . $rows, 'Name');
                    $sheet->setCellValue('B' . $rows, 'Email');
                    $sheet->setCellValue('C' . $rows, 'Phone');
                    $sheet->setCellValue('D' . $rows, 'Class');
                    $sheet->setCellValue('E' . $rows, 'Country Choice');
                    $sheet->setCellValue('F' . $rows, 'MUN Experience');
                    $sheet->setCellValue('G' . $rows, 'Bureau Member Experience');
                    $sheet->setCellValue('H' . $rows, 'Position');
                    $sheet->setCellValue('I' . $rows, 'School');

                    foreach ($delegate as $key => $each) {
                    $rows = $rows+1;
                    $sheet->setCellValue('A' . $rows, $each->name);
                    $sheet->setCellValue('B' . $rows, $each->email);
                    $sheet->setCellValue('C' . $rows, $each->phone);
                    $sheet->setCellValue('D' . $rows, $each->class);
                    $sheet->setCellValue('E' . $rows, $each->country_choice_name);
                    $sheet->setCellValue('F' . $rows, $each->mun_experience);
                    $sheet->setCellValue('G' . $rows, $each->bureaumem_experience);
                    $sheet->setCellValue('H' . $rows, $each->position);
                    $sheet->setCellValue('I' . $rows, $each->school_name);
                    }



        
        $writer = new Xlsx($spreadsheet);
        $fileName = "committe.".time().".xlsx";
        $filePath = "./excel/committe/".$fileName;
        $writer->save($filePath);

        return response()->download($filePath);
       
    }

   
    public function faculty_advisorsexport(Request $request)
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

            $styleDataArray = array(
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                ],
                'numberFormat' => [
                    'formatCode' => '000000000',
                ],
                );

        $myschool = School::where('id', 1)->first();
        $query = School::where('deleted_at', null)
                ->where('id','!=', 1)
                ->orderBy('id', 'DESC');
                if($request->q){
                    $query->where('name','LIKE', $request->q);
                }
                
                $data=$query->paginate(10); 





        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getColumnDimension('A')->setWidth(35);
        $sheet->getColumnDimension('B')->setWidth(35);
        $sheet->getColumnDimension('C')->setWidth(35);
        $sheet->getColumnDimension('D')->setWidth(35);
                    $sheet->getColumnDimension('A')->setWidth(35);
                    $sheet->mergeCells('A1:D1');
                    $sheet->getStyle('A1')->applyFromArray($styleArray);
                   
                    $sheet->setCellValue('A1', 'E.A.MUNC FACULTY ADVISOR');

                    $sheet->setCellValue('A2', 'Name');
                    $sheet->setCellValue('B2', 'Phone');
                    $sheet->setCellValue('C2', 'Email');
                    $sheet->setCellValue('D2', 'School Name');

                
                    $rows=2;

                    foreach ($data as $key => $each) {
                    $rows = $rows+1;
                    $sheet->getStyle('B' . $rows)->applyFromArray($styleDataArray);
                    $sheet->setCellValue('A' . $rows, $each->advisor_name);
                    $sheet->setCellValue('B' . $rows, $each->mobile);
                    $sheet->setCellValue('C' . $rows, $each->email);
                    $sheet->setCellValue('D' . $rows, $each->name);
                    }

                
        $writer = new Xlsx($spreadsheet);
        $fileName = "faculty advisors.".time().".xlsx";
        $filePath = "./excel/committe/".$fileName;
        $writer->save($filePath);

        return response()->download($filePath);
       
    }


    public function students_export()
    {



        $query = user::where('users.deleted_at', null)
                ->join('students', 'users.id', '=', 'students.user_id')
                ->leftjoin('schools', 'students.school_id', '=', 'schools.id')
                ->leftjoin('countries', 'students.country_choice', '=', 'countries.id')
                ->select('students.*', 'schools.name as school_name', 'countries.name as country_choice_name', 'users.role')
                ->where('users.role', '=' , 3)
                ->whereIn('students.status', [1, 2, 3]);
                $students = $query->orderBy('students.id', 'desc')->get();
     

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

                
                    $rows=6;

                    foreach ($students as $key => $each) {
                    $rows = $rows+1;
                    $sheet->setCellValue('A' . $rows, $each->name);
                    $sheet->setCellValue('B' . $rows, $each->email);
                    $sheet->setCellValue('C' . $rows, $each->phone);
                    $sheet->setCellValue('D' . $rows, $each->class);
                    $sheet->setCellValue('E' . $rows, $each->mun_experience);
                    $sheet->setCellValue('F' . $rows, $each->bureaumem_experience);
                    $sheet->setCellValue('G' . $rows, $each->position);
                    $sheet->setCellValue('H' . $rows, $each->school_name);
                    }

                
                    
        
        $writer = new Xlsx($spreadsheet);
        $fileName = "students.".time().".xlsx";
        $filePath = "./excel/students/".$fileName;
        $writer->save($filePath);

        return response()->download($filePath);
       
    }
    
   
}
