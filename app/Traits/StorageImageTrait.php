<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait StorageImageTrait {
    public function storageTraitUpload($request, $fieldName, $folderUpload) {
        if ( $request->hasFile($fieldName) ) {
            $file = $request->$fieldName;
            $fileNameOrigin = $file->getClientOriginalName();
            $fileNameHash = Str::random(20) .'.'.$file->getClientOriginalExtension();
            $filePath = $request->file($fieldName)->storeAs('public/'.$folderUpload.'/'.auth()->id(), $fileNameHash);
            $data = [
                'file_name' => $fileNameOrigin,
                'file_path' =>  Storage::url($filePath),
            ];
            return $data;
        }
        return null;
    }

    public function storageTraitUploadMultiple( $file, $folderUpload) {

            $fileNameOrigin = $file->getClientOriginalName();
            $fileNameHash = Str::random(20) .'.'.$file->getClientOriginalExtension();
            $filePath = $file->storeAs('public/'.$folderUpload.'/'.auth()->id(), $fileNameHash);
            $data = [
                'file_name' => $fileNameOrigin,
                'file_path' =>  Storage::url($filePath),
            ];
            return $data;

    }
}
