<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            外注承認書（制作管理者用）
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <section class="text-gray-600 body-font">
                        <div class="flex p-5">
                            <div class="w-1/3 p-3 border text-sm text-gray-600">
                                <p>【　申請者　】</p>
                                <dl class="flex">
                                    <dt class="w-32 py-1 flex">申請番号<p class="ms-auto">：</p>
                                    </dt>
                                    <dd class="ps-3 py-1">{{ $application->id }} </dd>
                                </dl>
                                <dl class="flex">
                                    <dt class="w-32 py-1 flex">依頼者<p class="ms-auto">：</p>
                                    </dt>
                                    <dd class="ps-3 py-1">{{ $client->name }}</dd>
                                </dl>
                                <dl class="flex">
                                    <dt class="w-32 py-1 flex">所属<p class="ms-auto">：</p>
                                    </dt>
                                    <dd class="ps-3 py-1">{{ $client->affiliation }}</dd>
                                </dl>
                            </div>
                            <div class="w-1/3 p-3 border text-sm text-gray-600">
                                <p>【　制作物　】</p>
                                <dl class="flex">
                                    <dt class="w-32 py-1 flex">品名<p class="ms-auto">：</p>
                                    </dt>
                                    <dd class="ps-3 py-1">{{ $application->subject }}</dd>
                                </dl>
                                <dl class="flex">
                                    <dt class="w-32 py-1 flex">サイズ<p class="ms-auto">：</p>
                                    </dt>
                                    <dd class="ps-3 py-1">{{ $workspec->size }}</dd>
                                </dl>
                                <dl class="flex">
                                    <dt class="w-32 py-1 flex">出力形式<p class="ms-auto">：</p>
                                    </dt>
                                    <dd class="ps-3 py-1">{{ $workspec->format }}</dd>
                                </dl>
                                <dl class="flex">
                                    <dt class="w-32 py-1 flex">数量<p class="ms-auto">：</p>
                                    </dt>
                                    <dd class="ps-3 py-1">{{ $workspec->quantity }}{{ $workspec->unit }}</dd>
                                </dl>
                            </div>
                            <div class="w-1/3 p-3 border flex-wrap text-sm text-gray-600">
                                <p>【　納品情報　】</p>
                                <dl class="flex">
                                    <dt class="w-32 py-1 flex">希望納期<p class="ms-auto">：</p>
                                    </dt>
                                    <dd class="ps-3 py-1">{{ $application->desired_dlvd_at }}</dd>
                                </dl>
                                <dl class="flex">
                                    <dt class="w-32 py-1 flex">依頼総点数<p class="ms-auto">：</p>
                                    </dt>
                                    <dd class="ps-3 py-1">{{ $application->works_quantity }}</dd>
                                </dl>
                                <dl class="flex">
                                    <dt class="w-32 py-1 flex">緊急度<p class="ms-auto">：</p>
                                    </dt>
                                    <dd class="ps-3 py-1">{{ $application->severity }}</dd>
                                </dl>
                                <dl class="flex">
                                    <dt class="w-32 py-1 flex">見積金額（税抜）<p class="ms-auto">：</p>
                                    </dt>
                                    <dd class="ps-3 py-1">@if(!is_null($application->price_incl))￥{{ number_format($application->price_incl) }}@endif</dd>
                                </dl>
                                <dl class="flex">
                                    <dt class="w-32 py-1 flex">見積金額（税込）<p class="ms-auto">：</p>
                                    </dt>
                                    <dd class="ps-3 py-1">@if(!is_null($application->price_exc))￥{{ number_format($application->price_exc) }}@endif</dd>
                                </dl>
                            </div>
                        </div>
                        <div class="p-5 flex flex-wrap">
                            <table class="w-2/3">
                                <tr>
                                    <th class="w-32"></th>
                                    <th class="w-6"></th>
                                    <td class="w-auto"></td>
                                </tr>
                                <tr>
                                    <th class="text-start">外注承認番号</th>
                                    <th>：</th>
                                    <td>{{ $os_appd->id }}</td>
                                </tr>
                                <tr>
                                    <th class="text-start">コメント</th>
                                    <th>：</th>
                                    <td>{!! nl2br($os_appd->comment) !!}</td>
                                </tr>
                                <tr>
                                    <th class="text-start">&emsp;</th>
                                    <th></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th class="text-start">品名</th>
                                    <th>：</th>
                                    <td>{{ $application->subject }}</td>
                                </tr>
                                <tr>
                                    <th class="text-start">サイズ</th>
                                    <th>：</th>
                                    <td>{{ $workspec->size }}</td>
                                </tr>
                                <tr>
                                    <th class="text-start">出力形式</th>
                                    <th>：</th>
                                    <td>{{ $workspec->format }}</td>
                                </tr>
                                <tr>
                                    <th class="text-start">数量</th>
                                    <th>：</th>
                                    <td>{{ $workspec->quantity }}&nbsp;{{ $workspec->unit }}</td>
                                </tr>
                                <tr>
                                    <th class="text-start">仕様詳細</th>
                                    <th>：</th>
                                    <td>{!! nl2br($os_appd->spec) !!}</td>
                                </tr>
                                <tr>
                                    <th class="text-start">&emsp;</th>
                                    <th></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th class="text-start">発注先</th>
                                    <th>：</th>
                                    <td>
                                        @foreach($outsourcings as $outsourcing)
                                        @if($outsourcing->id == $os_appd->order_recipient)
                                        <div>
                                            <p>{{ $outsourcing->comp_name }}</p>
                                        </div>
                                        @endif
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-start">金額（税抜）</th>
                                    <th>：</th>
                                    <td>@if(!is_null($os_appd->price_exc))￥{{ number_format($os_appd->price_exc) }}@endif</td>
                                </tr>
                                <tr>
                                    <th class="text-start">金額（税込）</th>
                                    <th>：</th>
                                    <td>@if(!is_null($os_appd->price_incl))￥{{ number_format($os_appd->price_incl) }}@endif</td>
                                </tr>
                                <tr>
                                    <th class="text-start">価格明細</th>
                                    <th>：</th>
                                    <td>{!! nl2br($os_appd->price_list) !!}</td>
                                </tr>
                                <tr>
                                    <th class="text-start">備考</th>
                                    <th>：</th>
                                    <td>{!! nl2br($os_appd->remarks) !!}</td>
                                </tr>
                                <tr>
                                    <th class="text-start">&emsp;</th>
                                    <th></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th class="text-start">競合数</th>
                                    <th>：</th>
                                    <td>
                                        {{ $os_appd->comp_num }}
                                    </td>
                                </tr>
                            </table>
                            <div class="w-1/3 ms-auto px-5">
                                <table class="w-full border-separate border border-slate-400 text-center">
                                    <tr>
                                        <th colspan="3" class="border border-slate-300">承認欄</th>
                                    </tr>
                                    <tr>
                                        <th class="w-1/3 border border-slate-300">承認者２</th>
                                        <th class="w-1/3 border border-slate-300">承認者１</th>
                                        <th class="w-1/3 border border-slate-300">担当者</th>
                                    </tr>
                                    <tr>
                                        <td class="h-20 border border-slate-300 text-2xl">
                                            @foreach($admins as $admin)
                                            @if($admin->id == $os_appd->appd2_id)
                                            <p><span v-if="">{{ $admin->name }}</span></p>
                                            @endif
                                            @endforeach
                                        </td>
                                        <td class="h-20 border border-slate-300 text-2xl">
                                            @foreach($admins as $admin)
                                            @if($admin->id == $os_appd->appd1_id)
                                            <p><span v-if="admin.id === $os_appd->appd1_id">{{ $admin->name }}</span></p>
                                            @endif
                                            @endforeach
                                        </td>
                                        <td class="h-20 border border-slate-300 text-xl">{{ $creator->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-slate-300 text-sm">
                                            @if(!is_null($os_appd->appd2_appd_at)){{ $os_appd->appd2_appd_at }}
                                            @else <p>承認可(日付)/否</p>
                                            @endif
                                        </td>
                                        <td class="border border-slate-300 text-sm">
                                            @if(!is_null($os_appd->appd1_appd_at)){{ $os_appd->appd1_appd_at }}
                                            @else <p>承認可(日付)/否</p>
                                            @endif
                                        </td>
                                        <td class="border border-slate-300 text-sm">
                                            @if(!is_null($os_appd->requested_at)){{ $os_appd->requested_at }}
                                            @else <p>申請日付</p>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full mt-10 mx-auto overflow-auto">
                                <table class="w-full flex">
                                    <?php $num = 0; ?>
                                    @foreach($outsourcings as $outsourcing)
                                    @if($num == 0)
                                    @if($outsourcing->id == $os_appd->order_recipient)<tbody class="w-5/12 p-3 border-double border-4 border-indigo-600 rounded">
                                        @else
                                    <tbody class="w-5/12 p-3">@endif
                                        @else
                                        @if($outsourcing->id == $os_appd->order_recipient)
                                    <tbody class="w-3/12 p-3 border-double border-4 border-indigo-600 rounded">
                                        @else
                                    <tbody class="w-3/12 p-3">@endif
                                        @endif
                                        <tr class="w-full flex bg-gray-100">
                                            @if($num == 0)
                                            <th class="w-40 py-1 flex">発注先</th>
                                            <th class="w-32 py-1">：</th>
                                            @endif
                                            <td class="w-full py-1 items-center pl-4 dark:border-gray-700">
                                                @if($outsourcing->id == $os_appd->order_recipient)<p class="font-medium">＊</p>
                                                @else<p class="font-medium">&nbsp;</p>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr class="w-full flex">
                                            @if($num == 0)
                                            <th class="w-40 py-1 flex">競合先</th>
                                            <th class="w-28 py-1">：</th>
                                            @endif
                                            <td class="w-full py-1">{{ $outsourcing->comp_name }}</td>
                                        </tr>
                                        <tr class="w-full flex bg-gray-100">
                                            @if($num == 0)
                                            <th class="w-40 py-1 flex">金額（税抜）</th>
                                            <th class="w-28 py-1">：</th>
                                            @endif
                                            <td class="w-full block py-1">
                                                @if(!is_null($outsourcing->comp_price_exc))￥{{ number_format($outsourcing->comp_price_exc) }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr class="w-full flex">
                                            @if($num == 0)
                                            <th class="w-40 py-1 flex">金額（税込）</th>
                                            <th class="w-28 py-1">：</th>
                                            @endif
                                            <td class="w-full block py-1">
                                                @if(!is_null($outsourcing->comp_price_incl))￥{{ number_format($outsourcing->comp_price_incl) }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr class="w-full flex bg-gray-100">
                                            @if($num == 0)
                                            <th class="w-40 py-1 flex">備考</th>
                                            <th class="w-28 py-1">：</th>
                                            @endif
                                            <td class="w-full block py-1">{!! nl2br($outsourcing->comp_remarks) !!}</td>
                                        </tr>
                                        <tr class="w-full flex">
                                            @if($num == 0)
                                            <th class="w-40 py-1 flex">見積もり</th>
                                            <th class="w-28 py-1">：</th>
                                            @endif
                                            <td class="w-full block py-1">
                                                @if(!is_null($outsourcing->comp_file1))<a href="{{ $outsourcing->comp_file1path }}" target="_BLANK">
                                                    <p>{{ $outsourcing->comp_file1 }}</p>
                                                </a>
                                                @endif
                                                @if(!is_null($outsourcing->comp_file2))<a href="{{ $outsourcing->comp_file2path }}" target="_BLANK">
                                                    <p>{{ $outsourcing->comp_file2 }}</p>
                                                </a>
                                                @endif
                                                @if(!is_null($outsourcing->comp_file3))<a href="{{ $outsourcing->comp_file3path }}" target="_BLANK">
                                                    <p>{{ $outsourcing->comp_file3 }}</p>
                                                </a>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                    <?php $num += 1; ?>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="w-3/4 flex mx-auto my-10">
                            @if(!is_null($os_appd->requested_at) && $user->id == $os_appd->appd1_id && $os_appd->appd1_approval !== 1)
                            <form id="approve_{{ $os_appd->id }}" method="POST" action="{{ route('admin.os_appds.update', $os_appd->id) }}" class="w-2/5">
                                @csrf
                                @method('PUT')
                                <div class="w-full p-2 text-center text-white bg-amber-500 border-0 focus:outline-none hover:bg-amber-600 rounded-l-xl">
                                    <a href="#" data-id="{{ $os_appd->id }}" onclick="approveOs_appd(this)">承認する</a>
                                    <input type="hidden" name="approve_check" value="true">
                                </div>
                                <div class="px-2">
                                    <p class="text-amber-500">【承認者１】コメント（任意）：</p>
                                    <input type="hidden" name="comment_by" value="appd1">
                                    <textarea name="appd1_comment" class="w-full border-amber-500">{!! nl2br($os_appd->appd1_comment) !!}</textarea>
                                </div>
                            </form>
                            <form id="reject_{{ $os_appd->id }}" method="POST" action="{{ route('admin.os_appds.update', $os_appd->id) }}" class="w-2/5">
                                @csrf
                                @method('PUT')
                                <div class="w-full p-2 text-center text-white bg-red-500 border-0 focus:outline-none hover:bg-red-600">
                                    <a href="#" data-id="{{ $os_appd->id }}" onclick="rejectOs_appd(this)">却下する</a>
                                    <input type="hidden" name="reject_check" value="true">
                                </div>
                                <div class="px-2">
                                    <p class="text-red-500">【承認者１】却下理由（任意）：</p>
                                    <input type="hidden" name="comment_by" value="appd1">
                                    <textarea name="appd1_comment" class="w-full border-red-500">{!! nl2br($os_appd->appd1_comment) !!}</textarea>
                                </div>
                            </form>
                            @elseif(!is_null($os_appd->requested_at) && $user->id == $os_appd->appd2_id && $os_appd->appd2_approval !== 1)
                            <form id="approve_{{ $os_appd->id }}" method="POST" action="{{ route('admin.os_appds.update', $os_appd->id) }}" class="w-2/5">
                                @csrf
                                @method('PUT')
                                <div class="w-full p-2 text-center text-white bg-amber-500 border-0 focus:outline-none hover:bg-amber-600 rounded-l-xl">
                                    <a href="#" data-id="{{ $os_appd->id }}" onclick="approveOs_appd(this)">承認する</a>
                                    <input type="hidden" name="approve_check" value="true">
                                </div>
                                <div class="px-2">
                                    <p class="text-amber-500">【承認者２】コメント（任意）：</p>
                                    <input type="hidden" name="comment_by" value="appd2">
                                    <textarea name="appd2_comment" class="w-full border-amber-500">{!! nl2br($os_appd->appd2_comment) !!}</textarea>
                                    <p class="text-amber-500">【承認者１】コメント（任意）：</p>
                                    <p>{!! nl2br($os_appd->appd1_comment) !!}</p>
                                </div>
                            </form>
                            <form id="reject_{{ $os_appd->id }}" method="POST" action="{{ route('admin.os_appds.update', $os_appd->id) }}" class="w-2/5">
                                @csrf
                                @method('PUT')
                                <div class="w-full p-2 text-center text-white bg-red-500 border-0 focus:outline-none hover:bg-red-600">
                                    <a href="#" data-id="{{ $os_appd->id }}" onclick="rejectOs_appd(this)">却下する</a>
                                    <input type="hidden" name="reject_check" value="true">
                                </div>
                                <div class="px-2">
                                    <p class="text-red-500">【承認者２】却下理由（任意）：</p>
                                    <input type="hidden" name="comment_by" value="appd2">
                                    <textarea name="appd2_comment" class="w-full border-red-500">{!! nl2br($os_appd->appd2_comment) !!}</textarea>
                                </div>
                            </form>
                            @else
                            <div class="w-2/5 p-2 text-center text-white bg-amber-200 border-0 focus:outline-none rounded-l-xl">承認する</div>
                            <div class="w-2/5 p-2 text-center text-white bg-red-200 border-0 focus:outline-none">却下する</div>
                            @endif
                            <a href="{{ route('admin.works.index') }}" class="w-1/5">
                                <div class="w-full p-2 btn text-center text-white bg-pink-500 border-0 focus:outline-none hover:bg-pink-600 rounded-r-xl">戻る</div>
                            </a>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <script>
        function approveOs_appd(e) {
            'use strict';
            if (confirm('再確認：承認してもいいですか？')) {
                document.getElementById('approve_' + e.dataset.id).submit();
            }
        }

        function rejectOs_appd(e) {
            'use strict';
            if (confirm('再確認：却下してもいいですか？')) {
                document.getElementById('reject_' + e.dataset.id).submit();
            }
        }
    </script>
</x-app-layout>