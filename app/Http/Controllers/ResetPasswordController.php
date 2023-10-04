<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function showRecoverPassword()
    {
        return view('auth.recoverPassword');
    }


    public function resetPassword()
    {
        return view('auth.recoverPassword');
    }
    
}
