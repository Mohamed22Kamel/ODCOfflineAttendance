<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CSVFileController extends Controller
{
    public function importCsv(Request $request)
    {
        $input = $request->all();

        $file = $input['path'];

        $output_file = '/CSV/Data/';

        $CSVF = Storage::disk('local')->put($output_file, $file);

        $customerArr = $this->csvToArray($CSVF);
        $ErrorResponses = [];
        for ($i = 0; $i < count($customerArr); $i++) {
            $customerArr[$i]['phone'] = '0111111111';
            $customerArr[$i]['name'] = trim($customerArr[$i]['name']);
            $customerArr[$i]['email'] = trim($customerArr[$i]['email']);
            $R = StudentController::storeStudent($customerArr[$i]);
            if ($R->getData()->success == false)
                $ErrorResponses[] = $R;

            else {
                $req = new Request(['student_id' => $R->getData()->data->id, 'course_id' => 1]);
                StudentCourseController::Register($req);
            }

        }
        Storage::disk('local')->delete($output_file) ;

        return $ErrorResponses ;
    }

    function csvToArray($filename = '', $delimiter = ',')
    {
        $filename  = Storage::path($filename) ;
        $file_handle = fopen($filename, 'r');
        $header = fgetcsv($file_handle, 0, $delimiter);
        $i =0;
        $fp = file($filename, FILE_SKIP_EMPTY_LINES);

        while (!feof($file_handle)) {

            $line_of_text[] = fgetcsv($file_handle, 0, $delimiter);
            if ($i+2 <= count($fp))
                $data[] = array_combine($header, $line_of_text[$i]);

            $i = $i +1 ;
        }
        fclose($file_handle);
        return mb_convert_encoding($data, 'UTF-8', 'UTF-7');
    }
}
