<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            制作物編集（制作管理者用）
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <section class="text-gray-600 body-font">
                        <div class="px-5 py-2 bg-white mb-5">
                            <!-- 依頼者情報 -->
                            <div class="p-2 w-full flex flex-wrap text-sm text-gray-600">
                                <p class="w-1/3">申請番号：{{ $application->id }} </p>
                                <p class="w-1/3">依頼者：{{ $client->name }}</p>
                                <p class="w-1/3">所属：{{ $client->affiliation }}</p>
                            </div>
                        </div>
                        <div class="px-5 py-2 bg-white mb-5">
                            <!-- 申請書情報 -->
                            <div class="p-2 w-full flex flex-wrap text-sm text-gray-600">
                                <p class="w-2/6">品名：{{ $application->subject }}</p>
                                <p class="w-1/6">申請日：{{ $application->applicated_at }}</p>
                                <p class="w-1/6">希望納期：{{ $application->desired_dlvd_at }}</p>
                                <p class="w-1/6">依頼点数：{{ $application->works_quantity }}</p>
                                <p class="w-1/6">緊急度：{{ $application->severity }}</p>
                            </div>
                            <div class="p-2 w-full flex flex-wrap text-sm text-gray-600">
                                <p class="w-4/6"></p>
                                <p class="w-1/6">見積金額（税抜）:￥{{ $application->price_exc }}</p>
                                <p class="w-1/6">見積金額（税込）:￥{{ $application->price_incl }}</p>
                            </div>
                        </div>

                        <div class="px-5 py-2 bg-white mb-0">
                            <div class="p-2 w-full mx-auto overflow-auto">
                                <p class="font-medium">仕様</p>
                                <table class="table-auto w-full text-center whitespace-no-wrap">
                                    <thead>
                                        <tr>
                                            <th class="pe-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                仕様番号</th>
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                サイズ</th>
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                出力形式</th>
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                品目</th>
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                内容</th>
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                添付ファイル</th>
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                数量</th>
                                            <th class="ps-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                                                単位</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="px-2 py-3">{{ $workspec->id }}</td>
                                            <td class="px-2 py-3">{{ $workspec->size }}</td>
                                            <td class="px-2 py-3">{{ $workspec->format }}</td>
                                            <td class="px-2 py-3">{{ $workspec->article }}</td>
                                            <td class="px-2 py-3">{{ $workspec->content }}</td>
                                            <td class="px-2 py-3">
                                                @if(!is_null($workspec->file))
                                                <a href="{{$workspec->filepath}}" target="_BLANK">
                                                    <img src="{{$workspec->filepath}}" class="mx-auto h-auto" style="width:100px; height:auto" />
                                                    <p>{{ $workspec->file }}</p>
                                                </a>
                                                @endif
                                            </td>
                                            <td class="px-2 py-3">{{ $workspec->quantity }}</td>
                                            <td class="px-2 py-3">{{ $workspec->unit }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="px-5 py-2 bg-white mb-5">
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <form method="POST" action="{{ route('creator.works.update', $work->id) }}" class="w-full">
                                @csrf
                                @method('PUT')
                                <input id="work_id" value="$work->id" type="hidden">
                                <input id="user_roll" value="$user->roll" type="hidden">
                                <div class="p-2 w-full mx-auto overflow-auto">
                                    <p class="font-medium">情報</p>
                                    <table class="table-auto w-full text-center whitespace-no-wrap">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" class="w-40 pe-2 py-2 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                    制作者名</th>
                                                <th rowspan="2" class="w-24 px-2 py-2 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                    外注有無</th>
                                                <th rowspan="2" class="w-28 px-2 py-2 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                    外注承認ID</th>
                                                <th class="w-28 px-2 pt-2 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                    制作開始日</th>
                                                <th class="w-28 px-2 pt-2 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                    金額（税抜）</th>
                                                <th rowspan="2" class="ps-2 py-2 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                                                    連絡事項</th>
                                            </tr>
                                            <tr>
                                                <th class="px-2 pb-2 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                    制作完了日</th>
                                                <th class="px-2 pb-2 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                                                    金額（税込）</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="w-full">
                                                <td rowspan="2" class="pe-2 py-2">
                                                    <select name="creator_id" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                        @if($user->roll == 'admin')
                                                        <option selected disabled value="">選択してください</option>
                                                        @foreach($creators as $creator)
                                                        <option value="{{ $creator->id }}">{{ $creator->name }}</option>
                                                        @endforeach
                                                        @elseif($user->roll === 'creator')
                                                        <option value="{{ $creators->id }}">{{ $creators->name }}</option>
                                                        @endif
                                                    </select>
                                                </td>
                                                <td rowspan="2" class="px-2 pt-1">
                                                    <select name="outsourcing" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 leading-8 transition-colors duration-200 ease-in-out">
                                                        @if($work->outsourcing == 0)
                                                        <option selected value="0">なし</option>
                                                        <option value="1">あり</option>
                                                        @else
                                                        <option value="0">なし</option>
                                                        <option selected value="1">あり</option>
                                                        @endif
                                                    </select>
                                                    <p></p>
                                                </td>
                                                <td class="px-2 pt-1">{{ $work->os_appd_id }}</td>
                                                <td class="px-2 pt-1">
                                                    <input type="date" name="started_at" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                </td>
                                                <td class="px-2 pt-1 w-28">
                                                    @if(!is_null($work->price_exc))￥{{ number_format($work->price_exc) }}@endif
                                                </td>
                                                <td rowspan="2" class="ps-2 py-2 w-auto">
                                                    <textarea name="message" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-24 text-base outline-none text-gray-700 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ $work->message }}</textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-2 pb-1">
                                                    @if(!is_null($work->os_appd_id) && $os_appd->id == $work->os_appd_id)
                                                        @if(!is_null($os_appd->requested_at) && !is_null($os_appd->appd2_appd_at))<span class="p-1 text-white text-sm bg-indigo-700 rounded-xl">承認済</span>
                                                        @elseif(!is_null($os_appd->requested_at) && is_null($os_appd->appd2_appd_at))<span class="p-1 text-white text-sm bg-indigo-500 rounded-xl">申請中</span>
                                                        @else<span class="p-1 text-white text-sm bg-pink-500 rounded-xl">申請前</span>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td class="px-2 pb-1">
                                                    <input type="date" name="completed_at" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 leading-8 transition-colors duration-200 ease-in-out">
                                                </td>
                                                <td class="px-2 pb-1">
                                                    @if(!is_null($work->price_incl))￥{{ number_format($work->price_incl) }}@endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="w-3/4 flex mx-auto my-10">
                                    <button type="submit" class="w-1/2 p-2 text-white bg-indigo-500 border-0 focus:outline-none hover:bg-indigo-600 rounded-l-xl">
                                        更新する
                                    </button>
                                    <a href="{{ route('creator.works.index')}}" class="w-1/2 p-2 btn text-center text-white bg-pink-500 border-0 focus:outline-none hover:bg-pink-600 rounded-r-xl">
                                        戻る
                                    </a>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>