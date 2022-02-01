<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Page;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Storage;
use App\Log;
use DataTables;

class AjaxChangeController extends Controller
{
    //Зураг хадгалах фолдер
    private $folder_name = 'edit_img'; 
    //  Хуудасны эрх олгох
    function AjaxPermissionPageActive(Request $request){
        $page = Page::find($request->id);
        $text = "";
        if($request->active_page == 1){
            $text = "Сонгосон хуудас идэвхтэй боллоо";
        }else{
            $text = "Сонгосон хуудас идэвхгүй боллоо";
        }

        if($page->url == 'permission'){
            return response()->json(['success' => 'Permission өөрчиллөх боломжгүй'],200);
        }else{
            Page::where('id',$request->id)->update(['active' => $request->active_page]);
            return response()->json(['success' => $text],200);
        }
    }
    //FIXME not needed!
    //summernote editor-н мэдээлэл хадгалах
    function imgStoreEdit(Request $request){
        //Фолдер үүсгэх
        $active = 0;
        $directories = Storage::directories('public');

        foreach($directories as $directory) {
            if($directory == 'public/'.$this->folder_name){
                $active = 1;
            }
        } 

        if($active == 0){
            Storage::makeDirectory('public/'.$this->folder_name);
            $active = 1;
        }

        $image = $request->long_data;
        $image = str_replace("data:image/jpeg;base64",',',$image);
        //$image = str_replace('','+',$image);
        $image_name = 'file_name'.'.jpg';
        //edit_img
        Storage::disk($this->folder_name)->put($image_name,base64_decode($image));
        
        //хадгалсан газраас файл аа дуудах
        $img = Storage::url($image_name);
        //storage фолдерын нэр 
        $storage = explode('/',$img)[1];
        //файлын нэр 
        $file_name = explode('/',$img)[2];
        //файл байрлах холбоос
        $img = '/'.$storage.'/'.$this->folder_name.'/'.$file_name;

        return response()->json(['img_src' => $img],200);
    }
    //Програмын түүх (Засах,устгах,нэмэх,нэвтрэх гэсэн дээр түүх үүснэ)
    public function getLog(){

        $log = Log::all();

        return  DataTables::of($log)
        ->editColumn('date',function($post){
            return $post->created_at->format('Y-m-d');
        })
        ->toJson();
    }
    
    public function viewLog(){
        return view('pages.log');
    }
}
