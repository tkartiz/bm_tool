<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Application;
use App\Models\Workspec;
use App\Models\Work;
use Illuminate\Support\Facades\Auth;

class WorkspecController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $id = (int)$_GET['application'];
        $application = Application::findOrFail($id);
        $workspecs = Workspec::where('application_id', '=', $id)->get();
        return view('workspecs.index', compact('user', 'application', 'workspecs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $id = (int)$_GET['application'];
        $application = Application::findOrFail($id);
        return view('workspecs.create', compact('user', 'application'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 選択されたファイル情報よりファイルをアップロードしてパスを保存する
        if ($request->file) {
            $directory = 'public/application/' . $request->application_id;
            Storage::makeDirectory($directory);
            $file_name = $request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs($directory, $file_name);
            $request->file = $file_name;
        }

        $workspec = Workspec::create([
            'application_id' => $request->application_id,
            'size' => $request->size,
            'format' => $request->format,
            'article' => $request->article,
            'content' => $request->content,
            'file' => $request->file,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
        ]);

        Work::create([
            'work_spec_id' => $workspec->id,
        ]);

        // 親の申請書の制作物点数を更新する
        $id = $request->application_id;
        $workspecs = Workspec::where('application_id', '=', $id)->get();
        $works_quantity = count($workspecs);
        $Workspec2Application = Application::find($id);
        $Workspec2Application->works_quantity = $works_quantity;
        $Workspec2Application->save();

        $user = Auth::user();
        if ($user->roll == 'creator') {
            return redirect()
            ->route('creator.workspecs.index', ['application' => $request->application_id])
            ->with(['message'=>'登録しました。', 'status'=>'info']);
        } else {
            return redirect()
            ->route('user.workspecs.index', ['application' => $request->application_id])
            ->with(['message'=>'登録しました。', 'status'=>'info']);
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
