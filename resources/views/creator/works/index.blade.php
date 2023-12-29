<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            制作物一覧（制作者用）
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-8 mx-auto">
                            <x-flash-message status="session('status')" />
                            <div class="w-full mx-auto overflow-auto">
                                <table class="table-auto w-full text-center whitespace-no-wrap">
                                    <thead class="border">
                                        <tr>
                                            <th rowspan="2" class="w-16 p-2 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                編集</th>
                                            <th rowspan="2" class="w-24 p-2 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                制作物番号</th>
                                            <th rowspan="2" class="w-24 p-2 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                仕様番号</th>
                                            <th rowspan="2" class="w-28 p-2 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                制作者名</th>
                                            <th rowspan="2" class="w-12 p-2 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                外注有無</th>
                                            <th colspan="3" class="w-30 px-2 pt-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                外注承認ID</th>
                                            <th class="w-28 px-2 pt-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                制作開始日</th>
                                            <th class="w-28 px-2 pt-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                金額（税抜）</th>
                                            <th rowspan="2" class="w-80 p-2 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                                                連絡事項</th>
                                        </tr>
                                        <tr>
                                            <th class="px-0 pb-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">承認<br>申請</th>
                                            <th class="px-0 pb-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">部長<br>承認</th>
                                            <th class="px-0 pb-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">社長<br>承認</th>
                                            <th class="px-2 pb-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">制作完了日</th>
                                            <th class="px-2 pb-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">金額（税込）</th>
                                        </tr>
                                    </thead>
                                    @foreach($works as $work)
                                    <tbody class="border">
                                        <tr>
                                            <td rowspan="2" class="p-2">
                                                <a href="{{ route('creator.works.edit', $work->id) }}" class="w-full p-1 text-center">
                                                    <span class="i-fa6-regular-pen-to-square bg-blue-500 w-5 h-5"></span>
                                                </a>
                                            </td>
                                            <td rowspan="2" class="p-2"><a href="{{ route('creator.works.show', $work->id) }}" class="text-blue-500 underline">{{ $work->id }}</a></td>
                                            <td rowspan="2" class="p-2">{{ $work->work_spec_id }}</td>
                                            <td rowspan="2" class="p-2">
                                                @if($user->role == 'admin')
                                                @foreach($creators as $creator)
                                                @if($creator->id == $work->creator_id)
                                                <p>{{ $creator->name }}</p>
                                                @endif
                                                @endforeach
                                                @elseif($user->role == 'creator')
                                                @if($creator->id == $work->creator_id)
                                                <p>{{ $creator->name }}</p>
                                                @endif
                                                @endif
                                            </td>
                                            <td rowspan="2" class="p-2">
                                                @if($work->outsourcing == 1)<p>あり</p>
                                                @elseif($work->outsourcing == 0)<p>なし</p>
                                                @endif
                                            </td>
                                            <td colspan="3" class="px-2 pt-1">
                                                @if($work->outsourcing == 1)
                                                <a href="{{ route('creator.os_appds.show', $work->os_appd_id) }}" class="text-blue-500 underline">{{ $work->os_appd_id }}</a>
                                                @endif
                                            </td>
                                            <td class="px-2 pt-1">{{ $work->started_at }}</td>
                                            <td class="px-2 pt-1">
                                                @if(!is_null($work->price_exc))￥{{ number_format($work->price_exc) }}@endif
                                            </td>
                                            <td rowspan="2" class="p-2 text-start text-sm">{!! nl2br($work->message) !!}</td>
                                        </tr>
                                        <tr>
                                            <td class="w-10 pb-1">
                                                @foreach($os_appds as $os_appd)
                                                @if(!is_null($work->os_appd_id) && $os_appd->id === $work->os_appd_id && !is_null($os_appd->requested_at))
                                                <p class="w-10 p-1 text-white text-sm bg-indigo-300 rounded">済</p>
                                                @endif
                                                @endforeach
                                            </td>
                                            <td class="w-10 pb-1">
                                                @foreach($os_appds as $os_appd)
                                                @if(!is_null($work->os_appd_id) && $os_appd->id === $work->os_appd_id && !is_null($os_appd->appd1_approval))
                                                <p class="w-10 p-1 text-white text-sm bg-indigo-500 rounded">済</p>
                                                @endif
                                                @endforeach
                                            </td>
                                            <td class="w-10 pb-1">
                                                @foreach($os_appds as $os_appd)
                                                @if(!is_null($work->os_appd_id) && $os_appd->id === $work->os_appd_id && !is_null($os_appd->appd2_approval))
                                                <p class="w-10 p-1 text-white text-sm bg-indigo-700 rounded">済</p>
                                                @endif
                                                @endforeach
                                            </td>
                                            <td class="px-2 pb-1">{{ $work->completed_at }}</td>
                                            <td class="px-2 pb-1">
                                                @if(!is_null($work->price_incl))￥{{ number_format($work->price_incl) }}@endif
                                            </td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>