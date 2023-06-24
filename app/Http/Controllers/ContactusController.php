<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contactus;
use Mail;
use App\Mail\ContactMail;
use Contactus as GlobalContactus;
use PhpParser\Node\Expr\FuncCall;

class ContactusController extends Controller
{
    public function index()
    {
        
        return view('contactUs', [
            
            'tittle' => 'ContactUs'
        ]);
    }

    public function storeContactUs(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'subject' => 'required',
            'message' => 'required  ',
        ]);

        $input = $request->all();
        // $data = Contactus::all();

        Contactus::create($input);

        //   Send mail to admin
        Mail::send('contactMail', array(
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'subject' => $input['subject'],
            'bodymessage' => $input['message'],
        ), function($bodymessage) use ($request){
            $bodymessage->from($request->email);
            $bodymessage->to('zhemz2015@gmail.com', 'Admin')->subject($request->get('subject'));
        });
        // $input = Contactus::all();
        return redirect()->back()->with(['success' => 'Pesan berhasil dikirim']);
    }

    // public function sendEmail(contactUs $contactus)
    // {
    //     $input = [
    //         'name' => $contactus->name,
    //         'email' => $contactus->email,
    //         'phone' => $contactus->phone,
    //         'message' => $contactus->message,
    //     ];

    //     Mail::to('zhemz2015@gmail.com')->send(new ContactMail($input));
    //     return back()->with(['success' => 'Contact Form Submit Successfully']);
    // }

}
