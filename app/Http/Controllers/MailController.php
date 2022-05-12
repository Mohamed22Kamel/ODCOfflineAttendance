<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use mysql_xdevapi\Exception;

class MailController extends Controller
{

    public static function SendAttachedEmail ($name,$path , $email ,$course) {
        try {
            $data = array('name'=>"$name" ,'path' => $path , 'email' => $email , 'course' => $course);
            Mail::send('mail', $data, function($message) use ($data) {
                $data["path"] = Storage::path($data["path"]) ;
                $message->to($data['email'], $data['name'])->subject
                ('ODC Course Accept Inform');
                $message->from('odchakathon@gmail.com','ODC Academy');
                $message->attach($data["path"]);
            });
        }catch (\Exception $exception){
            return ResponseController::sendError('Error Sending Email' ,500 );
        }
    }
    public static function SendEmailWithIDs ($student_id,$code,$course_id){
        try {
            $name = StudentController::getName($student_id);
            $email = StudentController::getEmail($student_id);
            $course = array('name' =>CourseController::getName($course_id),'start' =>CourseController::getStart($course_id),'end' =>CourseController::getEnd($course_id));
            $QR_Path = QRController::Generate($code);
            self::SendAttachedEmail($name, $QR_Path, $email, $course);
        }catch (Exception $exception){
            return ResponseController::sendError('Error Sending Email' ,500 );
        }finally {
            Storage::disk('local')->delete($QR_Path) ;
        }

    }
}
