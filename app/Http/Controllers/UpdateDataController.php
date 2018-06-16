<?php

namespace App\Http\Controllers;

use App\Advertisment;
use App\Member;
use App\MemberArticle;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\MemberShipReminderMail;
use Illuminate\Support\Facades\Redirect;

class UpdateDataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $Advertisments = Advertisment::where('expier_at', '<=', Carbon::today())->get();

        if(is_object($Advertisments) && (count($Advertisments) > 0)){
            foreach ($Advertisments as $Advertisment){
                $Advertisment->advertisment_attributes()->delete();
                $Advertisment->advertisment_media()->delete();
                $Advertisment->delete();
            }
        }

        $today = Carbon::today();
        $sevenDays = $today->addDays(7);
        $memberstoExpire = Member::where('expier_at', '<=', $sevenDays )->get();
        if(is_object($memberstoExpire) && (count($memberstoExpire) > 0)){
            foreach ($memberstoExpire as $member){
                $user = User::find($member->user_id);

                Mail::to($user->email)->send(new MemberShipReminderMail($user));
            }
        }

        $membersExpire = Member::where('expier_at', '<', $today)->get();
        if(is_object($membersExpire) && (count($membersExpire) > 0)){
            foreach ($membersExpire as $member){
                $user = User::find($member->user_id);
                $user->delete();
                MemberArticle::where('member_id', $member->id)->delete();
                $member->delete();
            }
        }

        return Redirect::to('/');
    }
}
