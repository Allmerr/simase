<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogEmail;

class LogEmailController extends Controller
{
    public function index()
    {
        return view('admin.log_email.index', [
            'log_emails' => LogEmail::all(),
        ]);
    }
}
