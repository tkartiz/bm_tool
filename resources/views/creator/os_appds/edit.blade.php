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
                    <form method="POST" action="{{ route('creator.os_appds.update', $os_appd->id) }}" enctype="multipart/form-data" class="w-full">
                        @csrf
                        @method('PUT')
                        <input name="work_id" value="{{ $work->id }}" type="hidden">
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
                                    <td class="pe-5"><textarea name="comment" class="w-full h-16 py-1 px-3 leading-8 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-sm outline-none text-gray-700 transition-colors duration-200 ease-in-out">{{ $os_appd->comment }}</textarea></td>
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
                                    <td class="pe-5"><textarea name="spec" class="w-full h-24 py-1 px-3 resize-none leading-6 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-sm outline-none text-gray-700 transition-colors duration-200 ease-in-out">{{ $os_appd->spec }}</textarea></td>
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
                                    <td class="pe-5"><textarea name="price_list" class="w-full h-16 py-1 px-3 leading-8 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-sm outline-none text-gray-700 transition-colors duration-200 ease-in-out">{{ $os_appd->price_list }}</textarea></td>
                                </tr>
                                <tr>
                                    <th class="text-start">備考</th>
                                    <th>：</th>
                                    <td class="pe-5"><textarea name="remarks" class="w-full h-24 py-1 px-3 leading-8 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-sm outline-none text-gray-700 transition-colors duration-200 ease-in-out">{{ $os_appd->remarks }}</textarea></td>
                                </tr>
                                <tr>
                                    <th class="text-start">&emsp;</th>
                                    <th></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th class="text-start">競合数</th>
                                    <th>：</th>
                                    <td>自動カウント</td>
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
                                            <select type="integer" name="appd2_id" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                <option selected value=""></option>
                                                @foreach($admins as $admin)
                                                @if($os_appd->appd2_id == $admin->id)<option selected value="{{ $admin->id }}">{{ $admin->name }}</option>
                                                @else<option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="h-20 border border-slate-300">
                                            <select type="integer" name="appd1_id" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                <option selected value=""></option>
                                                @foreach($admins as $admin)
                                                @if($os_appd->appd1_id == $admin->id)<option selected value="{{ $admin->id }}">{{ $admin->name }}</option>
                                                @else<option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
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
                            <div class="w-full mt-20 mx-auto overflow-auto">
                                <table class="w-full flex">
                                    @for($n = 0; $n < 3 ; $n++) @if($n==0)<tbody class="w-5/12">
                                        @else<tbody class="w-3/12">
                                            @endif
                                            <tr class="w-full flex">
                                                @if($n == 0)
                                                <th class="w-40 py-1 flex">発注先</th>
                                                <th class="py-1">：</th>
                                                @endif
                                                <td class="w-full py-1 block text-center items-center pl-4 dark:border-gray-700">
                                                    @if($os_appd->order_recipient == $outsourcings[$n]->id)
                                                    <input type="radio" name="order_recipient" value="{{ $outsourcings[$n]->id }}" checked class="w-4 h-4 text-blue-600 bg-gray-300 border-gray-500 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    @else
                                                    <input type="radio" name="order_recipient" value="{{ $outsourcings[$n]->id }}" class="w-4 h-4 text-blue-600 bg-gray-300 border-gray-500 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    @endif
                                                </td>
                                            </tr>
                                            <input type="hidden" name="outsourcing{{ $n+1 }}_id" value="{{ $outsourcings[$n]->id }}">
                                            <tr class="w-full flex">
                                                @if($n == 0)
                                                <th class="w-40 py-1 flex">競合先</th>
                                                <th class="py-1">：</th>
                                                @endif
                                                <td class="w-full py-1">
                                                    <input type="text" name="comp{{ $n+1 }}_name" value="{{ $outsourcings[$n]->comp_name }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                                </td>
                                            </tr>
                                            <tr class="w-full flex">
                                                @if($n == 0)
                                                <th class="w-40 py-1 flex">金額（税抜）</th>
                                                <th class="py-1">：</th>
                                                @endif
                                                <td class="w-full block py-1">
                                                    <input type="text" name="comp{{ $n+1 }}_price_exc" value="{{ $outsourcings[$n]->comp_price_exc }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                                </td>
                                            </tr>
                                            <tr class="w-full flex">
                                                @if($n == 0)
                                                <th class="w-40 py-1 flex">金額（税込）</th>
                                                <th class="py-1">：</th>
                                                @endif
                                                <td v-if=" !== null" class="w-full block py-1">
                                                    <input type="text" name="comp{{ $n+1 }}_price_incl" value="{{ $outsourcings[$n]->comp_price_incl }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                                </td>
                                            </tr>
                                            <tr class="w-full flex">
                                                @if($n == 0)
                                                <th class="w-40 py-1 flex">備考</th>
                                                <th class="py-1">：</th>
                                                @endif
                                                <td class="w-full block py-1">
                                                    <textarea name="comp{{ $n+1 }}_remarks" class="w-full h-36 py-1 px-3 leading-6 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-sm outline-none text-gray-700 transition-colors duration-200 ease-in-out">{{ $outsourcings[$n]->comp_remarks }}</textarea>
                                                </td>
                                            </tr>
                                            <tr class="w-full flex">
                                                @if($n == 0)
                                                <th class="w-40 py-1 flex">見積もり添付</th>
                                                <th class="py-1">：</th>
                                                @endif
                                                <td class="w-full block py-1">
                                                    <div class="mb-2">
                                                        <input type="file" name="file[]" multiple="multiple" class="w-full" />
                                                        <p class="ps-2">現(&nbsp;削除<input type="checkbox" name="delFile{{ $n*3 }}" multiple="multiple" class="w-4 h-4 ms-1 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 p-1 leading-8 transition-colors duration-200 ease-in-out">&nbsp;)：&nbsp;{{ $outsourcings[$n]->comp_file1 }}</p>
                                                    </div>
                                                    <div class="mb-2">
                                                        <input type="file" name="file[]" multiple="multiple" class="w-full" />
                                                        <p class="ps-2">現(&nbsp;削除<input type="checkbox" name="delFile{{ $n*3+1 }}" multiple="multiple" class="w-4 h-4 ms-1 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 p-1 leading-8 transition-colors duration-200 ease-in-out">&nbsp;)：&nbsp;{{ $outsourcings[$n]->comp_file2 }}</p>
                                                    </div>
                                                    <div class="mb-2">
                                                        <input type="file" name="file[]" multiple="multiple" class="w-full" />
                                                        <p class="ps-2">現(&nbsp;削除<input type="checkbox" name="delFile{{ $n*3+2 }}" multiple="multiple" class="w-4 h-4 ms-1 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 p-1 leading-8 transition-colors duration-200 ease-in-out">&nbsp;)：&nbsp;{{ $outsourcings[$n]->comp_file3 }}</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                        @endfor
                                </table>
                            </div>
                        </div>
                        <div class="w-3/4 flex mx-auto my-10">
                            <button type="submit" class="w-1/2 p-2 text-center text-white bg-indigo-500 border-0 focus:outline-none hover:bg-indigo-600 rounded-l-xl">
                                更新する</button>
                            <a href="{{ route('creator.os_appds.show', $os_appd->id) }}" class="w-1/2 p-2 btn text-center text-white bg-pink-500 border-0 focus:outline-none hover:bg-pink-600 rounded-r-xl">
                                戻る</a>
                        </div>
                    </form>
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