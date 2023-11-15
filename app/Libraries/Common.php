<?php

namespace app\Libraries;

use Illuminate\Support\Facades\Storage;
use App\Models\Application;
use App\Models\Workspec;
use App\Models\Work;
use App\Models\Outsourcing;

class Common
{
    public static function countWorks($id)
    {
        // 親の申請書の制作物点数を更新する
        $workspecs = Workspec::where('application_id', '=', $id)->get();
        $works_quantity = count($workspecs);
        $Workspec2Application = Application::find($id);
        $Workspec2Application->works_quantity = $works_quantity;
        $Workspec2Application->save();
    }

    public static function WorksArray()
    {
        $works = Work::join('workspecs', function ($join) {
            $join->on('works.work_spec_id', 'workspecs.id');
        })
            ->join('creators', function ($join) {
                $join->on('works.creator_id', 'creators.id');
            })
            ->join('os_appds', function ($join) {
                $join->on('works.id', 'os_appds.work_id');
            })
            ->join('applications', function ($join) {
                $join->on('applications.id', 'workspecs.application_id');
            })
            ->join('users', function ($join) {
                $join->on('users.id', 'applications.user_id');
            })
            ->distinct()
            ->select(
                'works.*',
                'workspecs.*',
                'creators.name as creator_name',
                'creators.email as creator_email',
                'os_appds.comment as os_comment',
                'os_appds.spec as os_spec',
                'os_appds.order_recipient',
                'os_appds.price_exc as os_price_exc',
                'os_appds.price_incl as os_price_incl',
                'os_appds.price_list as os_price_list',
                'os_appds.comp_num',
                'os_appds.remarks as os_remarks',
                'os_appds.requested_at as os_requested_at',
                'os_appds.appd1_id',
                'os_appds.appd1_approval',
                'os_appds.appd1_comment',
                'os_appds.appd1_appd_at',
                'os_appds.appd2_id',
                'os_appds.appd2_approval',
                'os_appds.appd2_comment',
                'os_appds.appd2_appd_at',
                'applications.*',
                'users.name as user_name',
                'users.affiliation as user_affiliation',
                'users.email as user_email',
            )
            ->get();

        return $works;
    }

    public static function saveFile($request, $kind)
    {
        // $kind: application
        // $file_path = 'https://ff-server.site/bm_tool/'; // サーバーの場合
        $file_path = 'http://127.0.0.1:8000/'; // ローカルの場合

        $dir_pub_path = 'public/' . $kind . '/';
        $dir_storage_path = $file_path . 'storage/' . $kind . '/';

        $directory = $dir_pub_path . $request->application_id;
        Storage::makeDirectory($directory);
        $file_name = $request->file('file')->getClientOriginalName();
        $request->file('file')->storeAs($directory, $file_name);

        if ($kind == 'application') {
            $request->file = $file_name;
            $request->filepath = $dir_storage_path . $request->application_id . '/' . $file_name;
        }
    }

    public static function delFile($request, $kind)
    {
        // $kind: application
        $dir_pub_path = 'public/' . $kind . '/';

        $deletefile = $dir_pub_path . $request->application_id . '/' . $request->old_file;
        Storage::delete($deletefile);
    }

    public static function updateOsFile($request)
    {
        // $file_path = 'https://ff-server.site/bm_tool/'; // サーバーの場合
        $file_path = 'http://127.0.0.1:8000/'; // ローカルの場合
        $dir_pub_path = 'public/outsourcing/';
        $dir_storage_path = $file_path . 'storage/outsourcing/';

        for ($i = 0; $i < 3; $i++) {
            $tmp = 'outsourcing' . ($i + 1) . '_id';
            $comp[$i] = Outsourcing::where('id', '=', $request->$tmp)->first();
        }

        for ($i = 0; $i < 9; $i++) {
            if ($i < 3) {
                $j = 0;
            } elseif ($i > 2 && $i < 6) {
                $j = 1;
            } else {
                $j = 2;
            }

            $tmp = 'comp_file' . ($i + 1 - 3 * $j);
            $tmp_path = 'comp_file' . ($i + 1 - 3 * $j) . 'path';
            $tmp_delFile = 'delFile' . $i;

            // ファイル添付がある場合
            if ($request->file('file') != null && array_key_exists($i, $request->file('file'))) {
                $directory = $dir_pub_path . $comp[$j]->id;
                Storage::makeDirectory($directory);
                $file_name = $request->file('file')[$i]->getClientOriginalName();
                $file_path = $dir_storage_path . $comp[$j]->id . '/' . $file_name;
                $request->file('file')[$i]->storeAs($directory, $file_name);

                $comp[$j]->$tmp = $file_name;
                $comp[$j]->$tmp_path = $file_path;
            }

            // 添付ファイル削除がある場合
            if ($request->$tmp_delFile == 'on' && !is_null($comp[$j]->$tmp_path)) {
                $file_path = $dir_pub_path . $comp[$j]->id . '/' . $comp[$j]->$tmp;
                Storage::delete($file_path);
                $comp[$j]->$tmp = null;
                $comp[$j]->$tmp_path = null;
            }
        }

        // ファイル以外の変更
        for ($j = 0; $j < 3; $j++) {
            $tmp_comp_name = 'comp' . ($j + 1) . '_name';
            $tmp_comp_price_exc = 'comp' . ($j + 1) . '_price_exc';
            $tmp_comp_price_incl = 'comp' . ($j + 1) . '_price_incl';
            $tmp_comp_remarks = 'comp' . ($j + 1) . '_remarks';

            $comp[$j]->comp_name = $request->$tmp_comp_name;
            $comp[$j]->comp_price_exc = $request->$tmp_comp_price_exc;
            $comp[$j]->comp_price_incl = $request->$tmp_comp_price_incl;
            $comp[$j]->comp_remarks = $request->$tmp_comp_remarks;
            $comp[$j]->save();
        }
    }
}
