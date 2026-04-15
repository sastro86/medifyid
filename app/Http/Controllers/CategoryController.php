<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        return view('category.index');
    }
    
    public function formView(Request $request, $method, $id = '')
    {
        if ($method == 'new') {
            $item = [];
        } else {
            $item = Category::find($id);
        }
        $data['item'] = $item;
        $data['method'] = $method;
        return view('category.form', $data);
    }
    
    public function formSubmit(Request $request, $method, $id = '')
    {
        if ($method == 'new') {
            $data_item = new Category;
        } else {
            $data_item = Category::find($id);
        }

        $data_item->kode = $request->kode;
        $data_item->nama = $request->nama;
        $data_item->save();

        return redirect('ctg');
    }

    public function singleView($kode)
    {
        $data['data'] = Category::where('kode', $kode)->first();
        return view('category.single', $data);
    }

    public function search(Request $request)
    {
        $kode = $request->kode;
        $nama = $request->nama;

        $data_search = Category::query();

        if (!empty($kode)) $data_search = $data_search->where('kode', $kode);
        if (!empty($nama)) $data_search = $data_search->where('nama', 'LIKE', '%' . $nama . '%');

        $data_search = $data_search->select('kode', 'nama')->orderBy('id')->get();


        return json_encode([
            'status' => 200,
            'data' => $data_search
        ]);
    }

    public function delete($id)
    {
        Category::find($id)->delete();
        return redirect('ctg');
    }
}
