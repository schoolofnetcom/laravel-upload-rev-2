<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

class PhotosController extends Controller
{
    public function create()
    {
        return view('photos.create');
    }

    public function store(Request $request)
    {
        $file = $request->file('url');
        $validExtensions = ['jpeg', 'jpg', 'png', 'gif'];
        if (!is_null($file) and $file->isValid() and in_array($file->extension(), $validExtensions)) {
            $name = $file->getClientOriginalName();
            $data = $request->all();
            $file->storeAs('img', $name);
            $data['url'] = $name;
            Photo::create($data);
            dd('salvo com sucesso');
        }
        dd('inválido');
    }
}
