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
use App\Models\Outsourcing;

class Os_appdController extends Controller
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
        $os_appd = Os_appd::findOrFail($id);
        $Os_appd2Work = Work::where('id', '=', $os_appd->work_id)->first();
        $Work2Workspec = Workspec::find($Os_appd2Work->work_spec_id);
        $Workspec2Application = Application::find($Work2Workspec->application_id);
        $client = User::where('id', '=', $Workspec2Application->user_id)->first();
        $creator = Creator::find($Os_appd2Work->creator_id);
        $user = Auth::user();
        $admins = Admin::all();
        $Outsourcings = Outsourcing::where('os_appd_id', '=', $os_appd->id)->get();

        if ($user->roll === 'admin') {
            return view('admin.os_appds.show', [
                'work' => $Os_appd2Work,
                'workspec' => $Work2Workspec,
                'application' => $Workspec2Application,
                'os_appd' => $os_appd,
                'outsourcings' => $Outsourcings,
                'client' => $client,
                'creator' => $creator,
                'user' => $user,
                'admins' => $admins,
            ]);
        } elseif ($user->roll === 'creator') {
            return view('creator.os_appds.show', [
                'work' => $Os_appd2Work,
                'workspec' => $Work2Workspec,
                'application' => $Workspec2Application,
                'os_appd' => $os_appd,
                'outsourcings' => $Outsourcings,
                'client' => $client,
                'creator' => $creator,
                'user' => $user,
                'admins' => $admins,
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
        $os_appd = Os_appd::findOrFail($id);
        $Os_appd2Work = Work::where('id', '=', $os_appd->work_id)->first();
        $Work2Workspec = Workspec::find($Os_appd2Work->work_spec_id);
        $Workspec2Application = Application::find($Work2Workspec->application_id);
        $client = User::where('id', '=', $Workspec2Application->user_id)->first();
        $creator = Creator::find($Os_appd2Work->creator_id);
        $user = Auth::user();
        $admins = Admin::all();
        $Outsourcings = Outsourcing::where('os_appd_id', '=', $os_appd->id)->get();
        if (is_null($Outsourcings) === false || count($Outsourcings) < 3) {
            for ($i = 0; $i < 3 - count($Outsourcings); $i++) {
                Outsourcing::create([
                    'os_appd_id' => $os_appd->id,
                ]);
            }
            $Outsourcings = Outsourcing::where('os_appd_id', '=', $os_appd->id)->get();
        }

        if ($user->roll === 'admin') {
            return view('admin.os_appds.edit', [
                'work' => $Os_appd2Work,
                'workspec' => $Work2Workspec,
                'application' => $Workspec2Application,
                'os_appd' => $os_appd,
                'outsourcings' => $Outsourcings,
                'client' => $client,
                'creator' => $creator,
                'user' => $user,
                'admins' => $admins,
            ]);
        } else {
            return view('creator.os_appds.edit', [
                'work' => $Os_appd2Work,
                'workspec' => $Work2Workspec,
                'application' => $Workspec2Application,
                'os_appd' => $os_appd,
                'outsourcings' => $Outsourcings,
                'client' => $client,
                'creator' => $creator,
                'user' => $user,
                'admins' => $admins,
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
        $os_appd = Os_appd::findOrFail($id);

        // 競合先更新
        $Outsourcings = Outsourcing::where('os_appd_id', '=', $id)->get();
        foreach ($Outsourcings as $Outsourcing) :
            if ($Outsourcing->id === $request->outsourcing1_id) {
                for ($i = 1; $i < 4; $i++) {
                    $filecheck = $request->comp.$i._file1;
                    dd($filecheck);
                    if (!is_null($request->comp1_file1)) {
                        $directory = 'public/outsourcing/' . $request->outsourcing1_id;
                        Storage::makeDirectory($directory);
                        $file_name = $request->file('file')->getClientOriginalName();
                        $request->file('file')->storeAs($directory, $file_name);
                        $request->file = $file_name;
                        $request->filepath = 'storage/outsourcing/' . $request->application_id . '/' . $file_name;
                    }
                    $Outsourcing->comp_name = $request->comp1_name;
                    $Outsourcing->comp_price_incl = $request->comp1_price_incl;
                    $Outsourcing->comp_price_exc = $request->comp1_price_exc;
                    $Outsourcing->comp_remarks = $request->comp1_remarks;
                    $Outsourcing->comp_file1 = $request->comp1_file1;
                    $Outsourcing->comp_file2 = $request->comp1_file2;
                    $Outsourcing->comp_file3 = $request->comp1_file3;
                };
            }
        endforeach;

        $os_appd->work_id = $request->work_id;
        $os_appd->comment = $request->comment;
        $os_appd->spec = $request->spec;

        $os_appd->order_recipient = $request->order_recipient;
        if (!is_null($Outsourcings)) {
            foreach ($Outsourcings as $Outsourcing) :
                if ($request->order_recipient === $Outsourcing->id) {
                    $os_appd->order_recipient = $Outsourcing->id;
                    $os_appd->price_exc = $Outsourcing->comp_price_exc;
                    $os_appd->price_incl = $Outsourcing->comp_price_incl;
                }
            endforeach;
        }

        $os_appd->price_list = $request->price_list;
        $os_appd->remarks = $request->remarks;
        $os_appd->comp_num = $request->comp_num;
        $os_appd->appd1_id = $request->appd1_id;
        $os_appd->appd2_id = $request->appd2_id;
        $os_appd->save();

        $user = Auth::user();
        if ($user->roll === 'admin') {
            return redirect()
                ->route('admin.os_appds.show', $os_appd->id)
                ->with([
                    'message' => '更新しました。',
                    'status' => 'success',
                ]);
        } elseif ($user->roll === 'creator') {
            return redirect()
                ->route('creator.os_appds.show', $os_appd->id)
                ->with([
                    'message' => '更新しました。',
                    'status' => 'success',
                ]);
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
