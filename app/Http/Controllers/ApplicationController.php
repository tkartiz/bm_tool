<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Application;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon; // Laravel 標準搭載の日付ライブラリ

class ApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->id;
        $applications = Application::where('user_id', $user)->get();
        return view('applications.index', compact('user', 'applications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('applications.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'subject' => 'required|string|max:50',
            'severity' => 'required|string',
            'desired_dlvd_at' => 'required|date',
        ]);

        Application::create([
            'user_id' => $request->user_id,
            'subject' => $request->subject,
            'severity' => $request->severity,
            'desired_dlvd_at' => $request->desired_dlvd_at,
        ]);

        return redirect()
        ->route('user.applications.index')
        ->with(['message'=>'申請書を作成しました。', 'status'=>'info']);
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
        $user = Auth::user();
        $application = Application::findOrFail($id);
        return view('applications.edit', compact('user', 'application'));
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
        $application = Application::findOrFail($id);
        $application->user_id = $request->user_id;
        $application->subject = $request->subject;
        $application->works_quantity = $request->works_quantity;
        $application->severity = $request->severity;
        if($request->check === "true"){
            $application->applicated_at = date("Y-m-d");
        } else {
            $application->applicated_at = null;
        }
        $application->desired_dlvd_at = $request->desired_dlvd_at;
        
        $application->save();

        return redirect()
        ->route('user.applications.index', $id)
        ->with(['message'=>'申請書を更新しました。', 'status'=>'info']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Application::findOrFail($id)->forceDelete(); //物理削除
        return redirect()
        ->route('user.applications.index')
        ->with(['message'=>'申請書を削除しました。', 'status'=>'alert']);
    }
}
