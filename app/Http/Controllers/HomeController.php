<?php

namespace App\Http\Controllers;

use App\Jobs\SendContactEmail;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('home.index');
    }

    public function contact()
    {
        return view('home.contact');
    }

    public function sendEmail(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'messageContent' => 'required'
        ]);

        $data['name'] = strip_tags($data['name']);
        $data['email'] = strip_tags($data['email']);
        $data['messageContent'] = strip_tags($data['messageContent']);

        dispatch(new SendContactEmail([
            'name' => $data['name'],
            'email' => $data['email'],
            'messageContent' => $data['messageContent'],
            'sendTo' => env('COMPANY_EMAIL')
        ]));

        return redirect()->back()->with('status', 'Email sent successfully');
    }
}
