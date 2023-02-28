<?php

namespace App\Http\Controllers;

use App\Models\AlbumPhoto;
use App\Models\UploadFile;

class AlbumPhotoController extends Controller
{
    public function index()
    {
        return view('admin.pages.album-photos.index');
    }

    public function create()
    {
        return view('admin.pages.album-photos.create');
    }

    public function show($id)
    {
        return view(
            'admin.pages.album-photos.show',
            [
                'album' => AlbumPhoto::findOrFail($id),
                'files' => UploadFile::where('model_id', $id)->get(),
            ]
        );
    }
}
