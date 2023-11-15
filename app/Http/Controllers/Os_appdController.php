<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Work;
use App\Models\Admin;
use App\Models\User;
use App\Models\Creator;
use App\Models\Application;
use App\Models\Workspec;
use App\Models\Os_appd;
use App\Models\Outsourcing;

use App\Libraries\Common;

class Os_appdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $user = Auth::user();
        $admins = Admin::all();
        $works = Common::WorksArray(); // 共通関数を呼び出す

        if ($user->roll === 'admin') {
            return view('admin.os_appds.index', [
                'works' => $works,
                'admins' => $admins,
                'user' => $user,
            ]);
        } elseif ($user->roll === 'creator') {
            return view('creator.os_appds.index', [
                'works' => $works->where('creator_id', '=', $user->id),
                'admins' => $admins,
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
        $user = Auth::user();
        $admins = Admin::all();
        $work = Common::WorksArray()
            ->where('os_appd_id', '=', $id)->first();
        $Outsourcings = Outsourcing::all()
            ->where('os_appd_id', '=', $work->os_appd_id);

        if ($user->roll === 'admin') {
            return view('admin.os_appds.show', [
                'work' => $work,
                'outsourcings' => $Outsourcings,
                'admins' => $admins,
                'user' => $user,
            ]);
        } elseif ($user->roll === 'creator') {
            return view('creator.os_appds.show', [
                'work' => $work,
                'outsourcings' => $Outsourcings,
                'admins' => $admins,
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

    public function filesave()
    {
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
        if ($request->request_check !== "true" && $request->approve_check !== "true" && $request->reject_check !== "true") { //　編集時のみ作動
            $request->validate([
                'comp1_price_incl' => ['required_with:comp1_name', 'nullable', 'integer'],
                'comp1_price_exc' => ['required_with:comp1_name', 'nullable', 'integer'],
                'comp2_price_incl' => ['required_with:comp2_name', 'nullable', 'integer'],
                'comp2_price_exc' => ['required_with:comp2_name', 'nullable', 'integer'],
                'comp3_price_incl' => ['required_with:comp3_name', 'nullable', 'integer'],
                'comp3_price_exc' => ['required_with:comp3_name', 'nullable', 'integer'],
            ]);

            Common::updateOsFile($request); // 競合先更新
        }

        // 外注承認申請書更新　↓
        $os_appd = Os_appd::findOrFail($id);
        if ($request->approve_check === "true" && $request->comment_by === "appd1") { //　承認者１の承認時
            $os_appd->appd1_comment = $request->appd1_comment;
            $os_appd->appd1_appd_at = date("Y-m-d");
            $os_appd->appd1_approval = 1; // 承認：１、却下：０
        } elseif ($request->approve_check === "true" && $request->comment_by === "appd2") { //　承認者2の承認時
            $os_appd->appd2_comment = $request->appd2_comment;
            $os_appd->appd2_appd_at = date("Y-m-d");
            $os_appd->appd2_approval = 1;
        } elseif ($request->reject_check === "true" && $request->comment_by === "appd1") { //　承認者１の却下時
            $os_appd->appd1_comment = $request->appd1_comment;
            $os_appd->appd1_appd_at = date("Y-m-d");
            $os_appd->appd1_approval = 0;
        } elseif ($request->reject_check === "true" && $request->comment_by === "appd2") { //　承認者2の却下時
            $os_appd->appd2_comment = $request->appd2_comment;
            $os_appd->appd2_appd_at = date("Y-m-d");
            $os_appd->appd2_approval = 0;
        } elseif($request->request_check !== "true") { // 制作者の編集時
            $os_appd->work_id = $request->work_id;
            $os_appd->comment = $request->comment;
            $os_appd->spec = $request->spec;

            $os_appd->order_recipient = $request->order_recipient;
            $Outsourcings = Outsourcing::where([['os_appd_id', $id], ['comp_name', '!=', null]])->get();
            if (!is_null($Outsourcings)) {
                foreach ($Outsourcings as $Outsourcing) :
                    if ((int)$request->order_recipient === $Outsourcing->id) {
                        $os_appd->price_exc = $Outsourcing->comp_price_exc;
                        $os_appd->price_incl = $Outsourcing->comp_price_incl;
                    }
                endforeach;
            }

            $os_appd->price_list = $request->price_list;
            $os_appd->remarks = $request->remarks;
            $os_appd->comp_num = count($Outsourcings);
            $os_appd->appd1_id = $request->appd1_id;
            $os_appd->appd2_id = $request->appd2_id;
            $os_appd->requested_at = null;
        } else { // 制作者の承認申請時
            $os_appd->requested_at = date("Y-m-d");
        }
        $os_appd->save();
        // 外注承認申請書更新　↑

        $user = Auth::user();
        if ($user->roll === 'admin') {
            if ($request->appd1_approval === 1 || $request->appd2_approval === 1) {
                $message = '承認しました。';
                $status = 'success';
            } else {
                $message = '却下しました。';
                $status = 'alert';
            }
            return redirect()
                ->route('admin.os_appds.show', $os_appd->id)
                ->with([
                    'message' => $message,
                    'status' => $status,
                ]);
        } elseif ($user->roll === 'creator') {
            if ($request->request_check === "true") {
                $message = '更新しました。';
                $status = 'success';
            } else {
                $message = '承認申請しました。';
                $status = 'success';
            }
            return redirect()
                ->route('creator.os_appds.show', $os_appd->id)
                ->with([
                    'message' => $message,
                    'status' => $status,
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
