<?php
namespace App\Http\Controllers;

class ArticleController extends Controller
{
    public function index()
    {
        return view('admin.pages.articles.index');
    }

    public function create()
    {
        return view('admin.pages.articles.create');
    }
}