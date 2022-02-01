<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\SystemCode;
use DB;
use App\Category;

class BlogController extends Controller
{
    function indexBlog()
    {
        //TODO: Мэдээлэл (Category)
        $posts_information = DB::table('posts')
            ->whereIn('post_img', array(2, 3, 4, 5))
            ->limit(9)
            ->orderBy('created_at', 'desc')
            ->get();
         //TODO: Бичлэг (Category)
        $posts_movies      = DB::table('posts')
            ->where('post_img', 1)
            ->limit(7)
            ->orderBy('created_at', 'desc')
            ->get();
        //TODO: get carousel    
        $slide_shows       = SystemCode::where('system_name', 'slide_show')->get();
        //TODO: get footer information
        $footer_information = SystemCode::whereIn('system_name', ['address', 'mail'])->get();
        //TODO: get social media
        $social_media = SystemCode::whereIn('system_name', ['media'])->get();

        view()->share('active', 0);

        return view('index', [
            'posts' => $posts_information,
            'movies' => $posts_movies,
            'slide_shows' => $slide_shows,
            'footer_information' => $footer_information,
            'social_media' => $social_media
        ]);
    }
    //TODO: GET ALL POST
    function blogPost($id)
    {
        $post = Post::where('post_img', $id)->orderBy('created_at', 'desc')->paginate(12);
        view()->share('active', $id);
        $category =  Category::find($id);
        //Category count 
        Category::where('id', $id)->update(['category_count' => ($category->category_count + 1)]);

        return view("web.post-page", ['post' => $post]);
    }
    //TODO: GET ONE POST
    function blogPostMore(Request $request,$post_id)
    {
        //Нийт хуудас руу variable дамжуулах
        view()->share('active', 0);
        $post = Post::where("id", $post_id)->first();

        $post =  Post::find($post_id);

        if ($post != null) {
            //Category count 
            Post::where('id', $post_id)->update(['post_count' => ($post->post_count + 1)]);
            //where("id","!=",$post->id)-g nemj oruulav
            $posts = Post::whereIn('post_img', array(2, 3, 4, 5))->where("id","!=",$post->id)->orderBy('created_at', 'desc')->take(15)->get();
            $post_link = $request->path();

            $text_string = strip_tags($post->content);
            $txt = explode(';',$text_string);
            //html code-g utf-8 болгох.
            $str_result = $this->jdUtf8($txt);
            // BANNER PHONE AND WEB 

            if(mb_strpos($post->content,'[--BANNER 1--]')){
                $system_code = SystemCode::where('system_name','banner')->where('id',11)->first();
                if($system_code->active == 1){
                    $post->content = str_replace("[--BANNER 1--]",$system_code->image,$post->content);
                }else{
                    $post->content = str_replace("[--BANNER 1--]"," ",$post->content);                    
                }
            }
            if(mb_strpos($post->content,'[--BANNER 2--]')){
                $system_code = SystemCode::where('system_name','banner')->where('id',12)->first();
                if($system_code->active == 1){
                    $post->content = str_replace("[--BANNER 2--]",$system_code->image,$post->content);
                }else{
                    $post->content = str_replace("[--BANNER 2--]"," ",$post->content);                    
                }
            }
            if(mb_strpos($post->content,'[--BANNER 3--]')){
                $system_code = SystemCode::where('system_name','banner')->where('id',13)->first();
                if($system_code->active == 1){
                    $post->content = str_replace("[--BANNER 3--]",$system_code->image,$post->content);
                }else{
                    $post->content = str_replace("[--BANNER 3--]"," ",$post->content);                    
                }
            }

            $banner4 = SystemCode::where('system_name','banner')->where('id',14)->first();
            $banner5 = SystemCode::where('system_name','banner')->where('id',15)->first();
            $banner6 = SystemCode::where('system_name','banner')->where('id',16)->first();

            $post_description = $str_result;

            return view("web.post-more", ['post' => $post,'posts' => $posts,'post_link' => $post_link,'post_description' => $post_description,'banner1' => $banner4,'banner2' => $banner5,'banner3' => $banner6]);

        }


        return view("web.error-page");
    }
    //TODO: GET SEARCH POST 
    function searchPost(Request $request)
    {

        $post = Post::where('title', 'LIKE', '%' . $request->post_search . '%')->orderBy('created_at', 'desc')->paginate(10);
        view()->share('active', 0);

        return view('web.post-search', ['post' => $post]);
    }
    //TODO: MAIL SEND
    function usContact()
    {

        view()->share('active', 0);

        return view('web.contact-us');
    }
     //TODO: Тэмдэгтийг монгол үсэг рүү шилжүүлэх
    private function jdUtf8($txt){

        $result_utf8 = implode("",$txt);
        $small_letter = ['а' => '&#1072','б' => '&#1073','в' => '&#1074','г' => '&#1075','д' => '&#1076','е' => '&#1077','ё' => '&#1105','ж' => '&#1078','з' => '&#1079','и' => '&#1080','й' => '&#1081','к' => '&#1082','л' => '&#1083','м' => '&#1084','н' => '&#1085','о' => '&#1086','ө' => '&#1257','п' => '&#1087','р' => '&#1088','с' => '&#1089','т' => '&#1090','у' => '&#1091','ү' => '&#1199','ф' => '&#1092','х' => '&#1093','ц' => '&#1094','ч' => '&#1095','ш' => '&#1096','щ' => '&#1097','ъ' => '&#1098','ь' => '&#1100','ы' => '&#1099','э' => '&#1101','ю' => '&#1102','я' => '&#1103','','А' => '&#1040','Б' => '&#1041','В' => '&#1042','Г' => '&#1043','Д' => '&#1044','Е' => '&#1045','Ё' => '&#1025','Ж' => '&#1046','З' => '&#1047','И' => '&#1048','Й' => '&#1049','К' => '&#1050','Л' => '&#1051','М' => '&#1052','Н' => '&#1053','О' => '&#1054','Ө' => '&#1256','П' => '&#1055','Р' => '&#1056','С' => '&#1057','Т' => '&#1058','У' => '&#1059','Ү' => '&#1198','Ф' => '&#1060','Х' => '&#1061','Ц' => '&#1062','Ч' => '&#1063','Ш' => '&#1064','Щ' => '&#1065','Ъ' => '&#1066','Ь' => '&#1068','Ы' => '&#1067','Э' => '&#1069','Ю' => '&#1070','Я' => '&#1071',' ' => '&nbsp','“' => '&ldquo','”' => '&rdquo','№' => '&#8470','₮' => '&#8366'];
        
        foreach ($small_letter as $key => $value) {
            if($key == '&#1105'){
                $result_utf8 = str_replace($value,'ё',$result_utf8);
            }else if($key == '&#1257'){
                $result_utf8 = str_replace($value,'ө',$result_utf8);
            }else
            if($key == '&#1199'){
                $result_utf8 = str_replace($value, 'ү',$result_utf8);
            }else{
                $result_utf8 = str_replace($value,$key,$result_utf8);
            }
        }
        return $result_utf8;
    }
}
