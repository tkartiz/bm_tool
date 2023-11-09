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
                                <dd class="ps-3 py-1">￥{{ $application->price_incl }}</dd>
                            </dl>
                            <dl class="flex">
                                <dt class="w-32 py-1 flex">見積金額（税込）<p class="ms-auto">：</p>
                                </dt>
                                <dd class="ps-3 py-1">￥{{ $application->price_exc }}</dd>
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
                                <td>￥{{ $os_appd->price_exc }}</td>
                            </tr>
                            <tr>
                                <th class="text-start">金額（税込）</th>
                                <th>：</th>
                                <td>￥{{ $os_appd->price_incl }}</td>
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
                        <div class="w-1/3 ms-auto">
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
                                    <td class="h-20 border border-slate-300">
                                        @foreach($admins as $admin)
                                        @if($admin->id == $os_appd->appd2_id)
                                        <p><span v-if="">{{ $admin->name }}</span></p>
                                        @endif
                                        @endforeach
                                    </td>
                                    <td class="h-20 border border-slate-300">
                                        @foreach($admins as $admin)
                                        @if($admin->id == $os_appd->appd1_id)
                                        <p><span v-if="admin.id === $os_appd->appd1_id">{{ $admin->name }}</span></p>
                                        @endif
                                        @endforeach
                                    </td>
                                    <td class="h-20 border border-slate-300">{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td class="border border-slate-300 text-sm">承認可(日付)/否</td>
                                    <td class="border border-slate-300 text-sm">承認可(日付)/否</td>
                                    <td class="border border-slate-300 text-sm">申請日付</td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full mx-auto overflow-auto">
                            <table class="w-full flex">
                                @foreach($outsourcings as $outsourcing)
                                <tbody class="w-1/3 p-5">
                                    <tr class="w-full flex">
                                        <th class="w-40 py-1 flex bg-gray-100">発注先<p class="ms-auto">：</p>
                                        </th>
                                        <td class="w-full py-1 block text-center items-center pl-4 dark:border-gray-700 bg-gray-100">
                                            @if($outsourcing->id == $os_appd->order_recipient)
                                            <p class="font-medium">＊</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="w-full flex">
                                        <th class="w-40 py-1 flex">競合先<p class="ms-auto">：</p>
                                        </th>
                                        <td class="w-full px-5 py-1">
                                            @if(!is_null($outsourcing->comp_name)){{ $outsourcing->comp_name }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="w-full flex">
                                        <th class="w-40 py-1 flex bg-gray-100">
                                            金額（税抜）<p class="ms-auto">：</p>
                                        </th>
                                        <td class="w-full block px-5 py-1 bg-gray-100">
                                            @if(!is_null($outsourcing->comp_price_exc))￥{{ $outsourcing->comp_price_exc }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="w-full flex">
                                        <th class="w-40 py-1 flex">
                                            金額（税込）<p class="ms-auto">：</p>
                                        </th>
                                        <td v-if=" !== null" class="w-full block px-5 py-1">
                                            @if(!is_null($outsourcing->comp_price_incl))￥{{ $outsourcing->comp_price_incl }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="w-full flex">
                                        <th class="w-40 py-1 flex bg-gray-100">備考<p class="ms-auto">：</p>
                                        </th>
                                        <td class="w-full block px-5 py-1 bg-gray-100">
                                            @if(!is_null($outsourcing->remarks)){{ $outsourcing->remarks }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="w-full flex">
                                        <th class="w-40 py-1 flex">見積もり<p class="ms-auto">：</p>
                                        </th>
                                        <td class="w-full block p-3 py-1">
                                            @if(!is_null($outsourcing->comp_file1))<p>{{ $outsourcing->comp_file1 }}</p>
                                            @endif
                                            @if(!is_null($outsourcing->comp_file2))<p>{{ $outsourcing->comp_file2 }}</p>
                                            @endif
                                            @if(!is_null($outsourcing->comp_file3))<p>{{ $outsourcing->comp_file3 }}</p>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="w-3/4 flex mx-auto my-10">
                        <a href="{{ route('creator.os_appds.edit', $os_appd->id ) }}" class="w-1/2 p-2 text-center text-white bg-indigo-500 border-0 focus:outline-none hover:bg-indigo-600 rounded-l-xl">
                            編集する</a>
                        <a href="#" class="w-1/2 p-2 text-center text-white bg-amber-500 border-0 focus:outline-none hover:bg-amber-600">
                            承認申請する</a>
                        <a href="{{ route('creator.works.show', $work->id) }}" class="w-1/2 p-2 btn text-center text-white bg-pink-500 border-0 focus:outline-none hover:bg-pink-600 rounded-r-xl">
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
    </script>
</x-app-layout>