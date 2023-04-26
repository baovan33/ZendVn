<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index() {
        $categories = Category::paginate(5);
        return view('admin.category.index',compact('categories'));
    }

    public function create() {
        $categories = Category::all();
        $data = getCategory($categories);
        return view('admin.category.create', compact('data'));
    }

    public function postCreate(Request $request) {

        $request->validate(
            [
                'name' => 'required|unique:categories',

            ],
            [
                'name.required' => 'Tên danh mục không được để trống',
                'name.unique' => 'Tên danh mục đã bị trùng',
            ]
        );

        Category::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id
        ]);

        return redirect()->route('category.index')->with('msg','Thêm thành công');

    }

   public function edit(Category $category) {
       $categories = Category::all();
       $data = getCategory($categories);
       return view('admin.category.edit', compact('category','data'));
   }

   public function update(Request $request, Category $category) {
       $request->validate(
           [
               'name' => 'required|unique:categories,name,'.$category->id,

           ],
           [
               'name.required' => 'Tên danh mục không được để trống',
               'name.unique' => 'Tên danh mục đã bị trùng',
           ]
       );

       $category->update([
           'name' => $request->name,
           'parent_id' => $request->parent_id
       ]);

       return redirect()->route('category.index')->with('msg','Cập nhập thành công');
   }

   public function delete(Category $category) {

       $categories = Category::all();
       foreach ($categories as $key => $item) {
           if ($item->parent_id == $category->id) {
              $item->delete();
               unset($categories[$key]);
               getCategory($categories, $item->id);
           }
       }
        $category->delete();
       return redirect()->route('category.index')->with('msg','Xoá thành công');

   }
}
