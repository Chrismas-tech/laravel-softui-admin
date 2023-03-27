<?php

namespace App\Http\Controllers;

class CustomerAccountController extends Controller
{
    public function index()
    {
        return view('customer-account.index');
    }
}
