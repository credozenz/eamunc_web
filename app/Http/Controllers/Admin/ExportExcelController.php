<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use View;
use App\Helper\AdminHelper;
use App\Models\SiteIndexes;
use App\Models\Committee;
use App\Models\Committee_member;
use App\Models\User;
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
        $delegate = $query1->orderBy('students.id', 'desc');
 
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
                    $sheet->mergeCells('A1:D1');
                    $sheet->mergeCells('A2:D2');
                    $sheet->mergeCells('A3:D3');
                    $sheet->mergeCells('A4:D4');
                    $sheet->getStyle('A1')->applyFromArray($styleArray);
                    $sheet->getStyle('A2')->applyFromArray($headstyleArray);
                    $sheet->getStyle('A5')->applyFromArray($headstyleArray);
                    $sheet->getStyle('A6')->applyFromArray($subheadstyleArray);
                    $sheet->getStyle('B6')->applyFromArray($subheadstyleArray);
                    $sheet->getStyle('C6')->applyFromArray($subheadstyleArray);
                    $sheet->getStyle('D6')->applyFromArray($subheadstyleArray);
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
                    $sheet->setCellValue('B6', 'Country Choice');
                    $sheet->setCellValue('C6', 'Position');
                    $sheet->setCellValue('D6', 'School');

                
                    $rows=6;

                    foreach ($bureau as $key => $each) {
                    $rows = $rows+1;
                    $sheet->setCellValue('A' . $rows, $each->name);
                    $sheet->setCellValue('B' . $rows, $each->country_choice_name);
                    $sheet->setCellValue('C' . $rows, $each->position);
                    $sheet->setCellValue('D' . $rows, $each->school_name);
                    }

                
                    $rows = $rows+1;

                    $sheet->getStyle('A' . $rows)->applyFromArray($headstyleArray);
                    $sheet->setCellValue('A' . $rows, 'Committee Delegates');
                    $rows = $rows+1;
                   
                    $sheet->getStyle('A' . $rows)->applyFromArray($subheadstyleArray);
                    $sheet->getStyle('B' . $rows)->applyFromArray($subheadstyleArray);
                    $sheet->getStyle('C' . $rows)->applyFromArray($subheadstyleArray);
                    $sheet->getStyle('D' . $rows)->applyFromArray($subheadstyleArray);
                    $sheet->setCellValue('A' . $rows, 'Name');
                    $sheet->setCellValue('B' . $rows, 'Role');
                    $sheet->setCellValue('C' . $rows, 'Position');
                    $sheet->setCellValue('D' . $rows, 'School');

                    foreach ($delegate as $key => $each) {
                    $rows = $rows+1;
                    $sheet->setCellValue('A' . $rows, $each->name);
                    $sheet->setCellValue('B' . $rows, $each->country_choice_name);
                    $sheet->setCellValue('C' . $rows, $each->position);
                    $sheet->setCellValue('D' . $rows, $each->school_name);
                    }



        
        $writer = new Xlsx($spreadsheet);
        $fileName = "committe.".time().".xlsx";
        $filePath = "./excel/committe/".$fileName;
        $writer->save($filePath);

        return response()->download($filePath);
       
    }

   
   
    
   
}
