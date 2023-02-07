<?php

namespace App\Http\Controllers;

class YoutubeVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.youtube-videos.index');
    }

    /**
     * Create a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.youtube-videos.create');
    }
}
