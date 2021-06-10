<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */


    //overriding the functions, since we do not have a reset password form to see, or submit
    public function showLinkRequestForm(){
        return abort('404');
    }

    public function sendResetLinkEmail()
    {
        return abort('404');
    }

    use SendsPasswordResetEmails;
}
