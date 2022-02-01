<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Post;
use Illuminate\Support\Str;
use App\Log;
use Illuminate\Support\Facades\Storage;
use Laracasts\Flash\Flash;
use App\Http\Requests\PostRequest;
use App\Notifications\ArticlePublished;
use Sentinel;

class PostController extends Controller
{
    // NOTE Master
    private $folder_name = "post_img";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts/index');
    }

    public function data()
    {
        // $posts = Post::query();
        $posts = Post::orderBy('created_at','desc')->get();

        // return DataTables::of($posts)
        return DataTables::make($posts)

            ->addColumn('action', function ($post) {

                $path_link = url("/post/{$post->id}/edit");

                return
                    '<p style="width:200px">
                    <a href="#" 
                        class="btn btn-sm btn-success" 
                        data-toggle="modal" data-target="#post-view" onclick="postView(' . $post->id . ')">
                        <i class="fa fa-eye"></i> View
                    </a>
                    <a href="' . $path_link . '" class="btn btn-sm btn-primary">
                        <i class="fa fa-pencil-square-o"></i> Edit
                    </a> 
                    <a href="" 
                        class="btn btn-sm btn-danger" 
                        data-toggle="modal" data-target="#post-delete" onclick="postDelete(' . $post->id . ')">
                        <i class="fa fa-trash"></i> Delete
                    </a></p>';
            })
            ->editColumn('type', function ($post) {
                $post_name = "";
                if ($post->post_category == 1) {
                    $post_name = "Бичлэг";
                } else if ($post->post_category == 2) {
                    $post_name = "Кино";
                } else if ($post->post_category == 3) {
                    $post_name = "Дуу хөгжим";
                } else if ($post->post_category == 4) {
                    $post_name = "Драма";
                } else if ($post->post_category == 5) {
                    $post_name = "Бусад";
                }
                return $post_name;
            })
            ->editColumn('count_post',function($post){
                return '<p style="width:10px">'.$post->post_count.'</p>';
            })
            ->editColumn('content', function ($post) {
                $text_string = strip_tags($post->content);
                // $text_string = Str::ascii($text_string,'utf-8');
                $text_summary =  str_limit($text_string, 100);
                return '<p style="width:150px">'.$text_summary.'</p>';
            })
            ->editColumn('title',function($post){
                return '<p style="width:150px">'.$post->title.'</p>';
            })
            ->rawColumns(['content','action','title','count_post'])
            // ->orderColumn('date', function ($post) {
            //     $post->orderBy('created_at', 'desc');
            // })
            ->editColumn('date', function ($post) {
                return $post->created_at->format('Y-m-d');
            })
            ->toJson();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.add');
    }
    // ->orderColumn('created_at', function ($query) {
    //     $query->orderBy('created_at', 'desc');
    // })
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $content = $request->content;
        $dom = new \DomDocument();
        @$dom->loadHtml('<?xml encoding="utf-8" ?>' . $content);
        $images  = $dom->getElementsByTagName('img');
        $video   = $dom->getElementsByTagName('iframe');
  
        foreach ($video as $key => $vide) {
            $vide->setAttribute('id','video_title'.$key);
            // $vide->setAttribute('style','width:100%');
        }

        foreach ($images as $k => $img) {

            $data = $img->getAttribute('src');
            $style = $img->getAttribute('style');
            if(mb_strpos($style,'px')){
                $img->setAttribute('style','width:100%');
            }
            list(, $data) = (strstr($data, ';') ? explode(';', $data) : array($data, ''));
            list(, $data) = (strstr($data, ',') ? explode(',', $data) : array($data, ''));
            // Convert Image to File 
            if (!empty($data)) {

                $data = base64_decode($data);
                $image_name = "/edit_img/" . time() . $k . '.jpg';
                $path = public_path() . $image_name;

                file_put_contents($path, $data);

                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }
        }

        //text more
        $text_string = strip_tags($dom->saveHTML());
        $txt = explode(';',$text_string);
        //html code-g utf-8 болгох.
        $str_result = $this->jdUtf8($txt);
        $text_summary =  str_limit($str_result, 100);

        //Image Upload

        // FIXME: files errors 
        $post = new Post($request->except('image', 'files', 'content'));

        // TODO: Upload File
        if ($request->hasFile('image') != "") {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $picture = str_random(10) . '.' . $extension;

            $destinationPath = public_path() . '/' . $this->folder_name;
            $file->move($destinationPath, $picture);

            $file_path = '/' . $this->folder_name . '/' . $picture;

            // Save to DB
            $post->title_img = $file_path;
        }

        $post->title = $request->title;
        $post->content = $dom->saveHTML();
        $post->summary = $text_summary;
        $post->post_category = $request->post_category;
        $post->save();

        // TODO: Logging
        $user = Sentinel::getUser();
        Log::create([
            'type' => 'add',
            'ip' => $request->ip(),
            'description' =>  'Мэдээлэл нэмсэн: ' . $user->first_name,
            'page_name' => $request->path(),
            'user_id' => $user->id
        ]);

        // FIXME: Facebook Posting
        // $post->notify(new ArticlePublished);

        // return response()->json(['success' => 'Амжилттай хадгалагдлаа'], 200);
        return redirect('post');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Show on Modal
    // public function show($id)
    public function show(Post $post)
    {
        // $post = Post::find($id);
        return response()->json(['post' => $post], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    public function edit(Post $post)
    {
        // $post = Post::find($id);

        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $content = $request->content;
        $dom = new \DomDocument();
        @$dom->loadHtml('<?xml encoding="utf-8" ?>' . $content);
        $images  = $dom->getElementsByTagName('img');
        $video   = $dom->getElementsByTagName('iframe');
  
        foreach ($video as $key => $vide) {
            $vide->setAttribute('id','video_title'.$key);
            // $vide->setAttribute('style','width:100%');
        }
        
        foreach ($images as $k => $img) {

            $data = $img->getAttribute('src');
            list(, $data) = (strstr($data, ';') ? explode(';', $data) : array($data, ''));
            list(, $data) = (strstr($data, ',') ? explode(',', $data) : array($data, ''));
            // Convert Image to File 
            if (!empty($data)) {

                $data = base64_decode($data);
                $image_name = "/edit_img/" . time() . $k . '.jpg';
                $path = public_path() . $image_name;

                file_put_contents($path, $data);

                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }
        }

        //text more
        $text_string = strip_tags($dom->saveHTML());
        $txt = explode(';',$text_string);
        //html code-g utf-8 болгох.
        $str_result = $this->jdUtf8($txt);
        $text_summary =  str_limit($str_result, 100);

        //Image Upload
        if ($request->hasFile('image')) {
            //file name 
            $file_name = $request->file('image')->getClientOriginalName();
            $file_name = explode('.', $file_name)[0];
            //Upload file $file to give 
            $file = $request->file('image');
            //Get file type 
            $extension = $file->getClientOriginalExtension();
            $picture = $file_name . "." . $extension;

            // $destination_path = public_path() . '/slide_show_img/';
            $destinationPath = public_path() . '/' . $this->folder_name;
            $file->move($destinationPath, $picture);

            //file path
            $file_path = '/' . $this->folder_name . '/' . $picture;

            // Save to DB
            $post->title_img = $file_path;
        }

        // FIXME: files errors 
        $post->update($request->except('image', 'files', 'content'));

        $post->title = $request->title;
        $post->content = $dom->saveHTML();
        $post->summary = $text_summary;
        $post->post_category = $request->post_category;
        $post->save();

        $user = Sentinel::getUser();
        Log::create([
            'type' => 'edit',
            'ip' => $request->ip(),
            'description' =>  'Мэдээлэл зассан: ' . $user->first_name,
            'page_name' => $request->path(),
            'user_id' => $user->id
        ]);

        // return response()->json(['success' => 'Амжилттай засагдлаа'], 200);
        return redirect('post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Post::destroy($id);

        $user = Sentinel::getUser();

        Log::create([
            'type' => 'delete',
            'ip' => $request->ip(),
            'page_name' => $request->path(),
            'description' =>  'Мэдээлэл устгасан: ' . $user->first_name,
            'user_id' => $user->id
        ]);
        return response()->json(['success' => 'Амжилттай устгаллаа'], 200);
    }
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
