<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Contact;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactSendMail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = (int)$_GET['application'];
        $user = Auth::user();
        $application = Application::findOrFail($id);
        return view('contacts.create', compact('user', 'application'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 問い合わせ内容保存
        // Contact::create([
        //     'user_id' => $request->user_id,
        //     'application_id' => $request->application_id,
        //     'email' => $request->email,
        //     'title' => $request->title,
        //     'message' => $request->message,
        // ]);

        // メール送信
        $inputs = $request->all();
        if(!$inputs){
            return redirect()->route('user.contacts.create');
        }
        
        $user = Auth::user();
        Mail::to($inputs['email'])
            ->cc($user->email)
            ->send(new ContactSendMail($inputs));
        
        $request->session()->regenerateToken(); //2回メール送信を防ぐため

        dd($inputs);
        return redirect()
            ->route('user.applications.index')
            ->with(['message' => '問合せを送信しました。', 'status' => 'info']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
