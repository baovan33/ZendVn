<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SliderController extends Controller
{
    use StorageImageTrait;
    public function index() {
        $sliders = Slider::paginate(5);
        return view('admin.slider.index',compact('sliders'));
    }

    public function create() {
        return view('admin.slider.create');
    }

    public function PostCreate(Request $request) {

        $request->validate(
            [
                'name' => 'required',
                'description' => 'required',
                'link' => 'required',
                'thumb' => 'required',
                'status' => ['required', function ($attribute, $value, $fail) {
                    if ($value == 2) {
                        $fail('Vui lòng chọn nhóm');
                    }
                }]
            ],
            [
                'name.required' => 'Tên không được để trống',
                'description.required' => 'Mô tả không được để trống',
                'link.required' => 'Link đã được sử dụng',
                'thumb.required' => 'Ảnh không được để trống',
            ]
        );

        $data = ([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'link' => $request->link,
            'user_id' => Auth::user()->id,
        ]);

        $dataImg = $this->storageTraitUpload($request, 'thumb', 'slider');

        if ( !empty($dataImg) ) {
            $data['thumb'] = $dataImg['file_path'];
            Slider::create($data);
            return redirect()->route('slider.index')->with('status', 'Bạn đã thêm thành công!');
        }

    }

    public function edit(Slider $slider) {
        return view('admin.slider.edit', compact('slider'));
    }

    public  function update(Slider $slider, Request $request) {
        $request->validate(
            [
                'name' => 'required',
                'description' => 'required',
                'link' => 'required',
                'status' => ['required', function ($attribute, $value, $fail) {
                    if ($value == 2) {
                        $fail('Vui lòng chọn nhóm');
                    }
                }]
            ],
            [
                'name.required' => 'Tên không được để trống',
                'description.required' => 'Mô tả không được để trống',
                'link.required' => 'Link đã được sử dụng',
            ]
        );
        $data = ([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'link' => $request->link,
            'user_id' => Auth::user()->id,
        ]);

        $path = $slider->thumb;

       $dataImg = $this->storageTraitUpload($request, 'thumb', 'slider');
       if ( !empty($dataImg) ) {
           if( file_exists(public_path($path))  ) {
               unlink(public_path($path));
           }
           $data['thumb'] = $dataImg['file_path'];
       }
      else {
           $data['thumb'] = $path;
       }
      $slider->update($data);
      return redirect()->route('slider.index')->with('status', 'Bạn đã cập nhập thành công!');
    }

    public function delete(Slider $slider) {
        $path = $slider->thumb;
        if(file_exists($path)){
            unlink($path);
        }

        $slider->delete();

        return redirect()->route('slider.index')->with('status', 'Bạn đã xoá thành công!');

    }
}
