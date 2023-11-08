<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Work;
use App\Models\Admin;
use App\Models\User;
use App\Models\Creator;
use App\Models\Application;
use App\Models\Workspec;
use App\Models\Os_appd;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->roll === 'admin') {
            return view('admin.works.index', [
                'works' => Work::all(),
                'workspecs' => Workspec::all(),
                'applications' => Application::all(),
                'os_appd' => Os_appd::all(),
                'creators' => Creator::all(),
                'user' => $user,
            ]);
        } else {
            $creators = Creator::where('id', '=', $user->id)->first();
            $work = Work::where('creator_id', '=', $user->id)->get();
            $os_appd = Os_appd::all();

            return view('creator.works.index', [
                'works' => $work,
                'workspecs' => Workspec::all(),
                'applications' => Application::all(),
                'os_appd' => $os_appd,
                'creators' => $creators,
                'user' => $user,
            ]);
        };
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $work = Work::findOrFail($id);
        if ($user->roll === 'admin') {
            $Work2Workspec = Workspec::find($work->work_spec_id);
            $Workspec2Application = Application::find($Work2Workspec->application_id);
            $client = User::where('id', '=', $Workspec2Application->user_id)->first();
            $creators = Creator::all();

            return view('Admin/works/edit', [
                'work' => $work,
                'workspec' => $Work2Workspec,
                'application' => $Workspec2Application,
                'client' => $client,
                'creators' => $creators,
                'user' => $user,
            ]);
        } else {
            $Work2Workspec = Workspec::find($work->work_spec_id);
            $Workspec2Application = Application::find($Work2Workspec->application_id);
            $client = User::where('id', '=', $Workspec2Application->user_id)->first();
            $creators = Creator::where('id', '=', $user->id)->first();

            return view('Creator/works/edit', [
                'work' => $work,
                'workspec' => $Work2Workspec,
                'application' => $Workspec2Application,
                'client' => $client,
                'creators' => $creators,
                'user' => $user,
            ]);
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
