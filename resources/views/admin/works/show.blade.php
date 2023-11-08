<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            制作物詳細（制作管理者用）
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <section class="text-gray-600 body-font">
                        <div class="px-5 py-2 mb-5 bg-white">
                            <!-- 依頼者情報 -->
                            <div class="p-2 w-full flex flex-wrap text-sm text-gray-600">
                                <p class="w-1/3">申請番号：{{ $application->id }} </p>
                                <p class="w-1/3">依頼者：{{ $client->name }}</p>
                                <p class="w-1/3">所属：{{ $client->affiliation }}</p>
                            </div>
                        </div>

                        <div class="p-3 mb-5 flex flex-wrap bg-white">
                            <div class="p-2 w-2/6">
                                <div class="relative">
                                    <label for="subject" class="leading-7 text-sm text-gray-600">品名</label>
                                    <div id="subject" class="w-full text-base outline-none text-gray-700 py-1 px-3 leading-8">
                                        {{ $application->subject }}
                                    </div>
                                </div>
                            </div>
                            <div class="p-2 w-1/6"></div>
                            <div class="p-2 w-1/6">
                                <div class="relative">
                                    <label for="desired_dlvd_at" class="leading-7 text-sm text-gray-600">希望納期</label>
                                    <div id="desired_dlvd_at" class="w-full text-base outline-none text-gray-700 py-1 px-3 leading-8">
                                        {{ $application->desired_dlvd_at }}
                                    </div>
                                </div>
                            </div>
                            <div class="p-2 w-1/6">
                                <div class="relative">
                                    <label for="works_quantity" class="leading-7 text-sm text-gray-600">依頼点数</label>
                                    <div id="works_quantity" class="w-full text-base outline-none text-gray-700 py-1 px-3 leading-8">
                                        {{ $application->works_quantity }}
                                    </div>
                                </div>
                            </div>
                            <div class="p-2 w-1/6">
                                <div class="relative">
                                    <label for="severity" class="leading-7 text-sm text-gray-600">緊急度</label>
                                    <div id="severity" class="w-full text-base outline-none text-gray-700 py-1 px-3 leading-8">
                                        {{ $application->severity }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="px-5 py-2 bg-white mb-0">
                            <div class="p-2 w-full mx-auto overflow-auto">
                                <p class="font-medium">仕様</p>
                                <table class="table-auto w-full text-center whitespace-no-wrap">
                                    <thead>
                                        <tr>
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                制作物番号</th>
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
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                                                単位</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="px-2 py-3 w-1/12">{{ $workspec->id }}</td>
                                            <td class="px-2 py-3 w-1/12">{{ $workspec->size }}</td>
                                            <td class="px-2 py-3 w-1/12">{{ $workspec->format }}</td>
                                            <td class="px-2 py-3 w-2/12">{{ $workspec->article }}</td>
                                            <td class="px-2 py-3">{{ $workspec->content }}</td>
                                            <td class="px-2 py-3 w-2/12">{{ $workspec->file }}</td>
                                            <td class="px-2 py-3 w-1/12">{{ $workspec->quantity }}</td>
                                            <td class="px-2 py-3 w-1/12">{{ $workspec->unit }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="px-5 py-2 bg-white mb-5">
                            <div class="p-2 w-full mx-auto overflow-auto">
                                <p class="font-medium">情報</p>
                                <table class="table-auto w-full text-center whitespace-no-wrap">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="pe-2 py-2 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                制作者名</th>
                                            <th rowspan="2" class="px-2 py-2 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                外注有無</th>
                                            <th rowspan="2" class="px-2 py-2 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                外注承認ID</th>
                                            <th class="px-2 pt-2 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                制作開始日</th>
                                            <th class="px-2 pt-2 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
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
                                            <td rowspan="2" class="pe-2 py-2 w-40">
                                                <p>
                                                    @if(!is_null($creator))
                                                    {{ $creator->name }}
                                                    @endif
                                                </p>
                                            </td>
                                            <td rowspan="2" class="px-2 pt-1 w-24">
                                                @if($work->outsourcing == 1)
                                                <a href="{{ route('admin.os_appds.index', $work->os_appd_id) }}" class="text-blue-500 underline">あり</a>
                                                @elseif($work->outsourcing == 0)
                                                <p>なし</p>
                                                @endif
                                            </td>
                                            <td rowspan="2" class="px-2 py-2 w-20">{{ $work->os_appd_id }}</td>
                                            <td class="px-2 pt-2 w-24">{{ $work->started_at }}</td>
                                            <td class="px-2 pt-2 w-28">{{ $work->price_incl }}</td>
                                            <td rowspan="2" class="ps-2 py-2 w-auto">{{ $work->message }}</td>
                                        </tr>
                                        <tr>
                                            <td class="px-2 pb-2 w-24">{{ $work->completed_at }}</td>
                                            <td class="px-2 pb-2 w-28">{{ $work->price_exc }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="w-3/4 flex mx-auto my-10">
                            <a href="{{ route('admin.works.index')}}" class="w-full p-2 btn text-center text-white bg-pink-500 border-0 focus:outline-none hover:bg-pink-600 rounded-xl">
                                戻る
                            </a>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>