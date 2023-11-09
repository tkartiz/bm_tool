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
                'os_appds' => Os_appd::all(),
                'creators' => Creator::all(),
                'user' => $user,
            ]);
        } elseif($user->roll === 'creator') {
            return view('creator.works.index', [
                'works' => Work::where('creator_id', '=', $user->id)->get(),
                'workspecs' => Workspec::all(),
                'applications' => Application::all(),
                'os_appds' => Os_appd::all(),
                'creator' => Creator::where('id', '=', $user->id)->first(),
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
        $work = Work::findOrFail($id);
        $Work2Workspec = Workspec::find($work->work_spec_id);
        $Workspec2Application = Application::find($Work2Workspec->application_id);
        $Work2Os_appd = Os_appd::where('work_id', '=', $work->id)->first();
        $client = User::where('id', '=', $Workspec2Application->user_id)->first();
        if($work->creator_id !== null){
            $creator = Creator::find($work->creator_id);
        } else {
            $creator = null;
        }
        $user = Auth::user();

        if($user->roll == 'admin'){
            return view('admin.works.show', [
                'work' => $work,
                'workspec' => $Work2Workspec,
                'application' => $Workspec2Application,
                'os_appd' => $Work2Os_appd,
                'client' => $client,
                'creator' => $creator,
                'user' => $user,
            ]);
        } elseif($user->roll === 'creator') {
            return view('creator.works.show', [
                'work' => $work,
                'workspec' => $Work2Workspec,
                'application' => $Workspec2Application,
                'os_appd' => $Work2Os_appd,
                'client' => $client,
                'creator' => $creator,
                'user' => $user,
            ]);
        }
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

            return view('admin.works.edit', [
                'work' => $work,
                'workspec' => $Work2Workspec,
                'application' => $Workspec2Application,
                'client' => $client,
                'creators' => $creators,
                'user' => $user,
            ]);
        } elseif($user->roll === 'creator') {
            $Work2Workspec = Workspec::find($work->work_spec_id);
            $Workspec2Application = Application::find($Work2Workspec->application_id);
            $client = User::where('id', '=', $Workspec2Application->user_id)->first();
            $creators = Creator::where('id', '=', $user->id)->first();

            return view('creator.works.edit', [
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
        $work = Work::findOrFail($id);
        $work->creator_id = $request->creator_id;
        if ($request->outsourcing === "1") {
            $work->outsourcing = true;
            $os_appd = Os_appd::where('work_id', '=', $work->id)->first();
            if (empty($os_appd)) {
                Os_appd::create([
                    'work_id' => $work->id,
                ]);

                $os_appd_new = Os_appd::where('work_id', '=', $work->id)->first();
                $work->os_appd_id = $os_appd_new->id;
            } else {
                $work->os_appd_id = $os_appd->id;
            }
        } elseif ($request->outsourcing === "0") {
            $work->outsourcing = false;
        }

        $work->started_at = $request->started_at;
        $work->completed_at = $request->completed_at;
        $work->message = $request->message;
        $work->save();

        $user = Auth::user();
        if ($user->roll === 'admin') {
            return redirect()
                ->route('admin.works.index', ['work' => $request->work_id])
                ->with(['message'=>'申請書を更新しました。', 'status'=>'info']);
        } elseif($user->roll === 'creator') {
            return redirect()
                ->route('creator.works.index', ['work' => $request->work_id])
                ->with(['message'=>'申請書を更新しました。', 'status'=>'info']);
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
        //
    }
}
