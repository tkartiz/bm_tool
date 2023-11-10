<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Application;
use App\Models\Workspec;
use App\Models\Work;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        if (!is_null($request->file)) {
            $directory = 'public/application/' . $request->application_id;
            Storage::makeDirectory($directory);
            $file_name = $request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs($directory, $file_name);
            $request->file = $file_name;
            $request->filepath = '/storage/application/' . $request->application_id . '/' . $file_name;
        }

        $request->validate([
            'application_id' => 'required|integer',
            'size' => 'required',
            'format' => 'required',
            'quantity' => 'integer',
            'unit' => 'string',
        ]);

        $workspec = Workspec::create([
            'application_id' => $request->application_id,
            'size' => $request->size,
            'format' => $request->format,
            'article' => $request->article,
            'content' => $request->content,
            'file' => $request->file,
            'filepath' => $request->filepath,
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
                ->with(['message' => '登録しました。', 'status' => 'info']);
        } else {
            return redirect()
                ->route('user.workspecs.index', ['application' => $request->application_id])
                ->with(['message' => '登録しました。', 'status' => 'info']);
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
        dd('制作物内容参照画面です');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $workspec = Workspec::findOrFail($id);
        $application = Application::where('id', '=', $workspec->application_id)->first();
        $user = Auth::user();
        return view('workspecs.edit', compact('user', 'application', 'workspec'));
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
            'quantity' => 'integer',
            'unit' => 'string',
        ]);
        
        $workspec = Workspec::findOrFail($id);
        $workspec->size = $request->size;
        $workspec->format = $request->format;
        $workspec->article = $request->article;
        $workspec->content = $request->content;

        // 選択されたファイル情報よりファイルを削除/アップロード/維持してパスを保存する

        if ($request->delete == "on") {
            $deletefile = 'public/application/' . $request->application_id . '/' . $request->old_file;
            Storage::delete($deletefile);
            $request->file = null;
            $request->filepath = null;
        } elseif (!is_null($request->file) && $request->delete == null) {
            $directory = 'public/application/' . $request->application_id;
            Storage::makeDirectory($directory);
            $file_name = $request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs($directory, $file_name);
            $request->file = $file_name;
            $request->filepath = '/storage/application/' . $request->application_id . '/' . $file_name;
            // 旧ファイルは削除する
            $deletefile = 'public/application/' . $request->application_id . '/' . $request->old_file;
            Storage::delete($deletefile);
        } else {
            $request->file = $request->old_file;
            $request->filepath = $request->old_filepath;
        }
        $workspec->file = $request->file;
        $workspec->filepath = $request->filepath;

        $workspec->quantity = $request->quantity;
        $workspec->unit = $request->unit;
        $workspec->save();

        // 親の申請書の制作物点数を更新する
        $workspecs = Workspec::where('application_id', '=', $request->application_id)->get();
        $works_quantity = count($workspecs);
        $Workspec2Application = Application::find($request->application_id);
        $Workspec2Application->works_quantity = $works_quantity;
        $Workspec2Application->save();

        $user = Auth::user();
        if ($user->roll == 'creator') {
            return redirect()
                ->route('creator.workspecs.index', ['application' => $request->application_id])
                ->with(['message' => '更新しました。', 'status' => 'info']);
        } else {
            return redirect()
                ->route('user.workspecs.index', ['application' => $request->application_id])
                ->with(['message' => '更新しました。', 'status' => 'info']);
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
        $workspec = Workspec::findOrFail($id);
        $application_id = $workspec->application_id;

        // 添付ファイルが存在したら削除

        if (!is_null($workspec->file)) {
            $deletefile = 'public/application/' . $workspec->application_id . '/' . $workspec->file;
            Storage::delete($deletefile);
            $workspec->file = null;
        }

        // データの物理削除
        $workspec->forceDelete();

        // 親の申請書の制作物点数を更新する
        $workspecs = Workspec::where('application_id', '=', $application_id)->get();
        $works_quantity = count($workspecs);
        $Workspec2Application = Application::find($application_id);
        $Workspec2Application->works_quantity = $works_quantity;
        $Workspec2Application->save();

        $user = Auth::user();
        if ($user->roll == 'creator') {
            return redirect()
                ->route('creator.workspecs.index', ['application' => $application_id])
                ->with(['message' => '削除しました。', 'status' => 'alert']);
        } else {
            return redirect()
                ->route('user.workspecs.index', ['application' => $application_id])
                ->with(['message' => '削除しました。', 'status' => 'alert']);
        }
    }
}
