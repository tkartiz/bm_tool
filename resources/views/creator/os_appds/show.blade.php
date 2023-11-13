<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            外注承認書（制作者用）
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                                    <th class="w-1/3 border border-slate-300">承認者</th>
                                    <th class="w-1/3 border border-slate-300">承認者</th>
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
                                    <td class="h-20 border border-slate-300 text-xl">{{ $user->name }}</td>
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
                        @if(is_null($os_appd->requested_at))
                        <a href="{{ route('creator.os_appds.edit', $os_appd->id ) }}" class="w-1/2 p-2 text-center text-white bg-indigo-500 border-0 focus:outline-none hover:bg-indigo-600 rounded-l-xl">
                            編集する</a>
                        <div class="w-1/2 p-2 text-center text-white bg-amber-500 border-0 focus:outline-none hover:bg-amber-600">
                            <form id="request_{{ $os_appd->id }}" method="POST" action="{{ route('creator.os_appds.update', $os_appd->id) }}">
                                @csrf
                                @method('PUT')
                                <a href="#" data-id="{{ $os_appd->id }}" onclick="requestedPost(this)">承認申請する</a>
                                <input type="hidden" name="request_check" value="true">

                                <input type="hidden" name="work_id" value="{{ $os_appd->work_id }}">
                                <input type="hidden" name="comment" value="{{ $os_appd->comment }}">
                                <input type="hidden" name="spec" value="{{ $os_appd->spec }}">
                                <input type="hidden" name="order_recipient" value="{{ $os_appd->order_recipient }}">
                                <input type="hidden" name="price_exc" value="{{ $os_appd->price_exc }}">
                                <input type="hidden" name="price_incl" value="{{ $os_appd->price_incl }}">
                                <input type="hidden" name="price_list" value="{{ $os_appd->price_list }}">
                                <input type="hidden" name="remarks" value="{{ $os_appd->remarks }}">
                                <input type="hidden" name="comp_num" value="{{ $os_appd->comp_num }}">
                                <input type="hidden" name="appd1_id" value="{{ $os_appd->appd1_id }}">
                                <input type="hidden" name="appd2_id" value="{{ $os_appd->appd2_id }}">
                            </form>
                        </div>
                        @else
                        <p class="w-1/2 p-2 text-center text-white bg-indigo-300 border-0 rounded-l-xl">編集する</p>
                        <p class="w-1/2 p-2 text-center text-white bg-amber-300 border-0">承認申請する</p>
                        @endif
                        <a href="{{ route('creator.works.index') }}" class="w-1/2 p-2 btn text-center text-white bg-pink-500 border-0 focus:outline-none hover:bg-pink-600 rounded-r-xl">
                            戻る</a>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script>
        function deleteWork(e) {
            'use strict';
            if (confirm('本当に削除してもいいですか？')) {
                document.getElementById('delete_' + e.dataset.id).submit();
            }
        }

        function requestedPost(e) {
            'use strict';
            if (confirm('本当に申請してもいいですか？')) {
                document.getElementById('request_' + e.dataset.id).submit();
            }
        }
    </script>
</x-app-layout>