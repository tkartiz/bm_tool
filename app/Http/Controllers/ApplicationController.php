<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Application;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon; // Laravel 標準搭載の日付ライブラリ

class ApplicationController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:users');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->roll === 'user') {
            $applications = Application::where('user_id', $user->id)->get();
            return view('user.applications.index', compact('user', 'applications'));
        } elseif ($user->roll === 'admin') {
            $applications = Application::all();
            return view('admin.applications.index', compact('user', 'applications'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if ($user->roll === 'user') {
            return view('user.applications.create', compact('user'));
        } elseif ($user->roll === 'admin') {
            return view('admin.applications.create', compact('user'));
        }
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

        $user = Auth::user();
        if ($user->roll === 'user') {
            return redirect()
                ->route('user.applications.index')
                ->with(['message' => '申請書を作成しました。', 'status' => 'info']);
        } elseif ($user->roll === 'admin') {
            return redirect()
                ->route('admin.applications.index')
                ->with(['message' => '申請書を作成しました。', 'status' => 'info']);
        }
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
        if ($user->roll === 'user') {
            return view('user.applications.edit', compact('user', 'application'));
        } elseif ($user->roll === 'admin') {
            return view('admin.applications.edit', compact('user', 'application'));
        }
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
        $request->validate([
            'subject' => 'required|string|max:50',
            'desired_dlvd_at' => 'required|date',
        ]);

        $application = Application::findOrFail($id);
        $application->user_id = $request->user_id;
        $application->subject = $request->subject;
        $application->works_quantity = $request->works_quantity;
        $application->severity = $request->severity;
        if ($request->check === "true") {
            $application->applicated_at = date("Y-m-d");
        } else {
            $application->applicated_at = null;
        }
        $application->desired_dlvd_at = $request->desired_dlvd_at;

        $application->save();

        $user = Auth::user();
        if ($user->roll === 'user') {
            return redirect()
                ->route('user.applications.index', $id)
                ->with(['message' => '申請書を更新しました。', 'status' => 'info']);
        } elseif ($user->roll === 'admin') {
            return redirect()
                ->route('admin.applications.index', $id)
                ->with(['message' => '申請書を更新しました。', 'status' => 'info']);
        }
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

        $user = Auth::user();
        if ($user->roll === 'user') {
            return redirect()
                ->route('user.applications.index')
                ->with(['message' => '申請書を削除しました。', 'status' => 'alert']);
        } elseif ($user->roll === 'admin') {
            return redirect()
                ->route('admin.applications.index')
                ->with(['message' => '申請書を削除しました。', 'status' => 'alert']);
        }
    }
}
