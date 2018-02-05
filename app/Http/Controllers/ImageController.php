<?php

namespace App\Http\Controllers;

use Storage;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageController extends Controller
{
    protected $allowedFileExtensions= [
      'png', 'jpg', 'gif'
    ];

    public function create(Request $request)
    {
      // dd($request->file('image'));
      $file = $request->file('image');

      if (!$file) {
        return redirect()->back();
      }

      if (!$this->isAllowedFile($file)) {
        return redirect()->back();
      }

      $name = str_random(255) . '.' . $file->getClientOriginalExtension();
      // dd($name);

      // dd($this->buildFilePath($name));

      Storage::disk('s3')->put(
        $this->buildFilePath($name),
        file_get_contents($file->getRealPath())
      );

      return redirect()->back();
    }

    protected function isAllowedFile(UploadedFile $file)
    {
        return in_array(
            $file->getClientOriginalExtension(),
            $this->allowedFileExtensions
        );
    }

    protected function buildFilePath($name)
   {
       return 'images/' . $name;
   }
}
