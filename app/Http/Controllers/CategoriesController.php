<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Http\Resources\CategoriesResource;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
// use RealRashid\SweetAlert\Facades\Alert;

class CategoriesController extends Controller
{
    public function index()
    {
        //melakukan quey get data
        $categories = Categories::all(); //select * from categories
        $categoriesRecourse = CategoriesResource::collection($categories);
        // // return response()->json($categoriesRecourse, 200);
        // return $this->sendResponse($categoriesRecourse, "succesfull get categories");
        dd($categoriesRecourse);
    }

    public function data()
    {
        $datas = DB::table('categories')->get();
        return view('categories/data', compact('datas'));
    }

    public function add()
    {
        return view('categories/add');
    }

    public function addProcess(Request $request)
    {
        $request->validate([
            'name_category' => 'required|unique:categories,name',
            'user_id' => 'required|unique:categories,user_id',
        ], [
            'name_category.required' => 'Nama Category Harus di Isi !',
            'user_id.required' => 'User Id Harus di Isi !',
            'name_category.unique' => 'Nama Category Sudah Pernah Ada !',
            'user_id.unique' => 'User Id Sudah Pernah Ada !',
        ]);

        $categories = Categories::create([
            'name' => $request->name_category,
            'user_id' => $request->user_id,
        ]);

        return redirect('categories')->with('status', 'Data Berhasil diTambah !');
    }

    public function edit($id)
    {
        $datas = DB::table('categories')->where('id', $id)->first();
        return view('categories/edit', compact('datas'));
    }

    public function editProcess($id, Request $request)
    {
        $request->validate([
            'name_category' => ['required', Rule::unique('categories', 'name')->ignore($id),],
            'user_id' => ['required', Rule::unique('categories', 'user_id')->ignore($id),],
        ], [
            'name_category.required' => 'Nama Category Harus di Isi !',
            'user_id.required' => 'User Id Harus di Isi !',
            'name_category.unique' => 'Nama Category Sudah Pernah Ada !',
            'user_id.unique' => 'User Id Sudah Pernah Ada !',
        ]);

        $updated = Categories::where('id', $id)->update([
            'name' => $request->name_category,
            'user_id' => $request->user_id,
        ]);

        return redirect('categories')->with('status', 'Data Berhasil diUbah !');
    }

    public function delete($id)
    {
        $delete = Categories::where('id', $id)->delete();
        return redirect('categories')->with('status', 'Data Berhasil diHapus !');
    }
    //Last Line
}
