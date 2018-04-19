<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Log;
use Illuminate\Support\Facades\Input;
use App\AdvertismentMedia;
use Carbon\Carbon;
use Image;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function userLog($user, $activity){
        $log = new Log();
        $log->user_id = $user;
        $log->log = $activity;
        $log->save();
    }

    public static function file_uploader($file){
        $extension = $file->getClientOriginalExtension();
        $current_timestamp = Carbon::now()->timestamp;
        $filename = $current_timestamp.uniqid().'.'.$extension;
        $file->move(public_path().'/uploads', $filename);

        return $filename;
    }

    public function multiple_upload($advertisment_id, $default_pic = '') {
        // getting all of the post data
        //$files = $request->file('file');
        $files = Input::file('images');

        foreach($files as $key=>$file) {
            $destinationPath = 'uploads/';
            $rules = array('file' => 'required');
            $validator = Validator::make(array('file'=> $file), $rules);

            if($validator->passes()){
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $orig_name = $file->getClientOriginalName(); // getting image name
                $filename = 'ad'.$advertisment_id.'-'.rand(1111,9999).'.'.$extension; // renameing image

                $file->move($destinationPath, $filename);
                $AdvertismentMedia = new AdvertismentMedia();
                $AdvertismentMedia->advertisment_id = $advertisment_id;
                $AdvertismentMedia->data_url = $filename;
                $AdvertismentMedia->is_active = true;
                $AdvertismentMedia->save();

                $filepath = $destinationPath.'/'.$filename;

                //http://image.intervention.io/getting_started/installation
                $img = Image::make(public_path($filepath))->fit(800, 526, function ($constraint) {
                    $constraint->upsize();
                })->insert(public_path('watermark.png'), 'center');

                //$img = Image::make($image->getRealPath())->resize(200, 200)->save($path);

                $img->resize(800, 526)->save(public_path($filepath));
            }
        }
    }
}
