<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
class PostApiController extends Controller
{
    function postData(){
        $data = Post::all();
        foreach ($data as $key => $post) {

            $text_string = strip_tags($post->content);
            $txt = explode(';',$text_string);
            //html code-g utf-8 болгох.
            $str_result = $this->jdUtf8($txt);
            $data[$key]['content'] = $str_result;
        }
        return response()->json(compact('data'),200);
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
