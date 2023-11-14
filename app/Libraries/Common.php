<?php

namespace app\Libraries;

use App\Models\Work;

class Common
{
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
}
