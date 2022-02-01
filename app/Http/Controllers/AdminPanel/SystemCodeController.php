<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\SystemCode;
use App\Post;
use Illuminate\Support\Facades\Storage;
use Laracasts\Flash\Flash;
use App\Http\Requests\SlideShowRequest;

class SystemCodeController extends Controller
{
    private $folder_name = "slide_show_img";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $slide_shows = SystemCode::where('system_name','slide_show')->get();
        // return view('slide-shows.index', [ 'slide_shows' => $slide_shows]);

        $slide_shows = SystemCode::take(4)->get();
        return view('slide-shows.index', [ 'slide_shows' => $slide_shows]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    // public function show(SystemCode $systemCode)
    {
        $systemCode = SystemCode::find($id);

        return response()->json(['systemCode' => $systemCode], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SlideShowRequest $request, $id)
    // public function update(SlideShowRequest $request, SystemCode $systemCode)
    {
        $systemCode = SystemCode::find($id);

        if ($request->hasFile('image') != "") {

            //Upload file 
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $picture = str_random(10) . '.' . $extension;

            // $destinationPath = public_path() . '/slide_show_img/';
            $destinationPath = public_path() . '/' . $this->folder_name;
            $file->move($destinationPath, $picture);

            //file save database 
            $file_path = '/'.$this->folder_name.'/'.$picture;

            // Save to DB
            // SystemCode::where('id', $id)->update(['image' => $file_path]);
            $systemCode->image = $file_path;

            $systemCode->save();

            // flash('Амжилттай хадгалагдлаа')->success();
            // return redirect('slide-show');

            return response()->json(['success' => 'Success'],200);

        }

        return response()->json(['success' => 'Failed'],200);
        // flash('Successful', 'error')->important();
        // return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
