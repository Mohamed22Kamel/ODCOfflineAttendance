<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Type;
use function Sodium\add;

class CSVFileController extends Controller
{
    public function importCsv(Request $request)
    {

        $input = $request->all();

//        $validator = Validator::make($input, $Constrains);

        $file = $input['path'];

        $output_file = '/CSV/Data/';

        $CSVF = Storage::disk('local')->put($output_file, $file);


        $customerArr = $this->csvToArray($CSVF);
        $ErrorResponses = [];
        for ($i = 0; $i < count($customerArr); $i ++)
        {
//            return $customerArr[$i];
            $R = StudentController::storeStudent($customerArr[$i]);
            if($R-> getData()->success == false )
                array_push($ErrorResponses,$R);
//            return var_dump($R)  ;
//             $t = $R-> getData()->success;
////             $t = json_decode($R,true) ;
//            return $t->success ;

        }

        return $ErrorResponses ;
    }

    function csvToArray($filename = '', $delimiter = ',')
    {
//        if (!file_exists($filename) || !is_readable($filename))
//            return false;
//
//        $header = null;
//        $data = array();
////        return $data ;
//        if (($handle = fopen($filename, 'r')) != false)
//        {
//            while (($row = fgetcsv($handle, 1000, $delimiter)) != false)
//            {
//                if (!$header)
//                    $header = $row;
//                else
//                    $data[] = array_combine($header, $row);
//            }
//            fclose($handle);
//        }
//
//        return $header;

        $filename  = Storage::path($filename) ;
        $file_handle = fopen($filename, 'r');
        $header = fgetcsv($file_handle, 0, $delimiter);
        $header[0] = substr($header[0], 3);

//        $line_of_text[] = fgetcsv($file_handle, 1, $delimiter);
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
