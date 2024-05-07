<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\mail\CreateJObMail;

class EmailController extends Controller
{
    public function index()
    {
       $mailData=[
        'title' => 'Mail from JOb provider',
        'body' => ' job  are Created check it!',
       ];

        Mail::to('umardev82@gmail.com')->send(new CreateJObMail($mailData));

        return "Email sent successfully!";
    }
}
