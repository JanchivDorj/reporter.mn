<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SystemCode;
use App\Http\Requests\FooterInformationRequest;
use App\Http\Requests\SocialMediaRequest;
use App\User;
class SettingController extends Controller
{
    //Тохиргооны хуудас дуудах
    function settingIndex(){
        return view('pages.settings');
    }
    //Баазаас олон нийтийн апп-н холбоосын хаяг дуудах
    function socialMedia(){
        $social_media = SystemCode::where('system_name','media')->get();
        return response()->json(['social_media' => $social_media],200);
    }
    //Сайтны доод хэсгийн мэдээлэл баазаас дуудах
    function footerInformation(){
        $footer_information = SystemCode::whereIn('system_name',['address','mail','send_email'])->get();
        return response()->json(['footer_information' => $footer_information],200);
    }
    //Бааз руу олон нийтийн апп-н холбоос оруулах
    function postSocialMedia(SocialMediaRequest $request){

         $name = ['facebook','twitter','instagram'];

        for ($i=0; $i < 3; $i++) { 
            SystemCode::where('id' ,$request["social_media_id".$i])->update(
                ['image' => $request[$name[$i]]]
            );
        }

        return response()->json(['success' => 'Амжилттай хадгалагдлаа'],200);
    }
    //Сайтны доод хэсгийн мэдээлэл бааз руу оруулах
    function postFooterInformation(FooterInformationRequest $request){
        $name = ['address','email','send_email'];
        for($i = 0;$i < 3;$i++){
            SystemCode::where('id',$request['footer_information_id'.$i])
            ->update(["image" => $request[$name[$i]]]);
        }
        return response()->json(['success' => 'Амжилттай хадгалагдлаа'],200);
    }
    //Хэрэглэгчийн хувийн мэдээлэл
    function getProfile(Request $request){
        
        if( isset($request->user_id)){
            $profile = User::find($request->user_id);
            return response()->json(['profile' => $profile],200);
        }

        return view('pages.profile');
    }
}
