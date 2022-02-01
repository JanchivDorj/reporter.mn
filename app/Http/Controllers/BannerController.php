<?php

namespace App\Http\Controllers;
use App\SystemCode;
use Illuminate\Http\Request;
use App\Http\Requests\BannerRequest;
class BannerController extends Controller
{
    private $folder_name = "img_banner";
    function index(){
        $banners = SystemCode::where('system_name','banner')->get();
        return view('banner.index',['banners' => $banners]);
    }
    function show($id){
        $system_code = SystemCode::find($id);

        return response()->json(['system_code' => $system_code], 200);
    }
    function update(BannerRequest $request, $id){
        $systemCode = SystemCode::find($id);

        if ($request->hasFile('image') != "") {

            //Upload file 
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $picture = str_random(10) . '.' . $extension;

            $destinationPath = public_path() . '/' . $this->folder_name;
            $file->move($destinationPath, $picture);
            //file save database 
            $file_path = '/'.$this->folder_name.'/'.$picture;
            //<img class='card-img-top img-responsive' src="{{ url('/') . $item->image }}" alt='No image' style='width:100px;'>
            if($id == 14 || $id == 15 || $id == 16){
                $systemCode->active = $request->active;
                $systemCode->image = '<jd1><a href="http://'.$request->link_image.'" target="_blank"><img class="card-img-top img-responsive jd-banner" src="'.url('/').$file_path.'"></a></jd1>';
            }else{
                $systemCode->active = 1;
                $systemCode->image = '<div class="jd-content"><jd><a href="http://'.$request->link_image.'" target="_blank"><img class="card-img-top img-responsive" src="'.url('/').$file_path.'"></a></jd></div>'; 
            }

        }else{
            if($id == 14 || $id == 15 || $id == 16){
                $systemCode->active = $request->active;
                $systemCode->image = '<jd1><a href="http://'.$request->link_image.'" target="_blank"><img class="card-img-top img-responsive jd-banner" src="'.$request->img_link_img.'"></a></jd1>';
            }else{
                $systemCode->active = 1;
                $systemCode->image = '<div class="jd-content"><jd><a href="http://'.$request->link_image.'" target="_blank"><img class="card-img-top img-responsive" src="'.$request->img_link_img.'"></a></jd></div>'; 
            }
        }     

        $systemCode->start_date = $request->start_date;
        $systemCode->end_date = $request->end_date;
        //<img class='card-img-top img-responsive' src="{{ url('/') . $item->image }}" alt='No image' style='width:100px;'>
        $systemCode->save();  

        return response()->json(['success' => 'Success'],200);
    }
}
