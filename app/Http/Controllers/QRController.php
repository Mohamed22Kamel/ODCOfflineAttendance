<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use mysql_xdevapi\Exception;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRController extends Controller
{
    public static function Generate($code)
    {
        try {
            $Code = QrCode::format('png')
                ->size(200)->errorCorrection('H')
                ->generate($code);
            $output_file = 'img/qr-code/img-' . time() . '.png';

            Storage::disk('local')->put($output_file, $Code);

            Storage::setVisibility($output_file, 'public');
        } catch (Exception $exception) {
            return ResponseController::sendError('Error Generate Code', 500);
        }

        return $output_file;
    }

    public static function Delete($Path)
    {
        try {
            Storage::disk('local')->delete($Path);
            return 1;
        } catch (Exception $exception) {
            return ResponseController::sendError("Can't delete Image", 500);
        }
    }
}
