<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ArticlesController extends Controller
{
    public function data()
    {
        $datas = DB::table('articles')
            ->select('articles.id','articles.title','articles.content','articles.image','articles.user_id','articles.category_id','categories.name')
            ->Join('categories', 'articles.category_id', '=', 'categories.id')
            ->orderBy('articles.id','desc')
            ->get();
        return view('articles/data', compact('datas'));
    }

    public function add()
    {
        $categories = DB::table('categories')->get();
        return view('articles/add', compact('categories'));
    }

    public function addProcess(Request $request)
    {
        if(!is_null($request->image)){
            $imageN = time().'_'.$request->image->getClientOriginalName(); 
            $request->image->move(public_path('db_image'), $imageN);
        }

        $request->validate([
            'title' => 'required',
            'user_id' => 'required',
        ], [
            'title.required' => 'Title Harus di Isi !',
            'user_id.required' => 'Silahkan Pilih Category Agar User Id Terisi Otomatis !',
        ]);

        $articles = Articles::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imageN,
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
        ]);

        return redirect('articles')->with('status', 'Data Berhasil diTambah !');
    }

    public function edit($id)
    {
        $categories = DB::table('categories')->get();
        $datas = DB::table('articles')->where('id', $id)->first();
        return view('articles/edit', compact('categories','datas'));
    }

    public function editProcess($id, Request $request)
    {
        if(!is_null($request->image)){
            $imageN = time().'_'.$request->image->getClientOriginalName(); 
            $request->image->move(public_path('db_image'), $imageN);
        }

        $request->validate([
            'title' => 'required',
            'user_id' => 'required',
        ], [
            'title.required' => 'Title Harus di Isi !',
            'user_id.required' => 'Silahkan Pilih Category Agar User Id Terisi Otomatis !',
        ]);

        if($request->has('image')){
            $articles = Articles::where('id', $id)->update([
                'title' => $request->title,
                'content' => $request->content,
                'image' => $imageN,
                'user_id' => $request->user_id,
                'category_id' => $request->category_id,
            ]);
        }else{
            $articles = Articles::where('id', $id)->update([
                'title' => $request->title,
                'content' => $request->content,
                'user_id' => $request->user_id,
                'category_id' => $request->category_id,
            ]);
        }

        return redirect('articles')->with('status', 'Data Berhasil diUbah !');
    }

    public function delete($id)
    {
        $delete = articles::where('id', $id)->delete();
        return redirect('articles')->with('status', 'Data Berhasil diHapus !');
    }

    public function uploadImage(Request $request)
    {
        if($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            //Upload File
            $request->file('upload')->move('public/uploads', $filenametostore);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('public/uploads/'.$filenametostore);
            $message = 'File uploaded successfully';
            $result = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$message')</script>";

            // Render HTML output
            @header('Content-type: text/html; charset=utf-8');
            echo $result;
        }
    }
    //LAST LINE
}
