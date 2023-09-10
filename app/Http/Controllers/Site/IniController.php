<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IniController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index()
    {
        return view(view: 'auth.login');
    }
}
