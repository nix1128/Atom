<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactEmail;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{



    public function submit(Request $request)
    {



        $this->validate($request, [
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'phone' => 'required|phone',
            'message' => 'required|max:500',
        ]);

        $input = $request->all();



        $details = [
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'message' => $input['message'],

        ];

        Mail::to("atom@gmail.com")->send(new ContactEmail($details));

        return response()->json(null, 200);
    }
}
