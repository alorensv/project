<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QrManagerController extends Controller
{
    public function view()
    {
        return view('qrManager.view');
    }
}
