<?php

namespace App\Http\Controllers;

class UserAdminController extends Controller
{
    public function index()
    {
        return view('admin.pages.users.index');
    }
}
