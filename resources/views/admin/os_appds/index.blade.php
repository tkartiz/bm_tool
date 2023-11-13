<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            外注承認申請一覧（制作管理者用）
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
                                            <th rowspan="3" class="w-20 px-2 pt-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                外注承認ID</th>
                                            <th rowspan="3" class="w-28 p-2 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                申請者名</th>

                                            <th rowspan="3" class="w-80 p-2 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                                                コメント</th>
                                            <th rowspan="3" class="w-24 p-2 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                                                品名</th>
                                            <th class="w-24 p-2 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                                                サイズ</th>
                                            <th class="w-28 px-2 pt-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                金額（税抜）</th>
                                            <th colspan="3" class="px-2 pt-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                承認状況</th>
                                        </tr>
                                        <tr>
                                            <th class="p-2 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                                                出力形式</th>
                                            <th rowspan="2" class="px-2 pb-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">金額（税込）</th>
                                            <th rowspan="2" class="px-0 pb-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">承認<br>申請</th>
                                            <th rowspan="2" class="px-0 pb-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">部長<br>承認</th>
                                            <th rowspan="2" class="px-0 pb-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">社長<br>承認</th>
                                        </tr>
                                        <tr>
                                            <th class="p-2 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">枚数</th>
                                        </tr>
                                    </thead>
                                    @foreach($os_appds as $os_appd)
                                    <tbody class="border">
                                        <tr>
                                            <td rowspan="3" class="px-2 pt-1">
                                                <a href="{{ route('admin.os_appds.show', $os_appd->id) }}" class="text-blue-500 underline">{{ $os_appd->id }}</a>
                                            </td>
                                            <td rowspan="3" class="p-2">
                                                @foreach($works as $work)
                                                @if($work->os_appd_id === $os_appd->id)
                                                @foreach($creators as $creator)
                                                @if($creator->id === $work->creator_id){{ $creator->name }}
                                                @endif
                                                @endforeach
                                                @endif
                                                @endforeach
                                            </td>
                                            <td rowspan="3" class="px-2 pt-1">{!! nl2br($os_appd->comment) !!}</td>
                                            <td rowspan="3" class="p-2">
                                                @foreach($works as $work)
                                                @if($work->os_appd_id === $os_appd->id)
                                                @foreach($workspecs as $workspec)
                                                @if($workspec->id === $work->work_spec_id)
                                                @foreach($applications as $application)
                                                @if($application->id === $workspec->application_id)
                                                {{ $application->subject }}
                                                @endif
                                                @endforeach
                                                @endif
                                                @endforeach
                                                @endif
                                                @endforeach
                                            </td>
                                            <td class="p-2">
                                                @foreach($works as $work)
                                                @if($work->os_appd_id === $os_appd->id)
                                                @foreach($workspecs as $workspec)
                                                @if($workspec->id === $work->work_spec_id){{ $workspec->size }}
                                                @endif
                                                @endforeach
                                                @endif
                                                @endforeach
                                            </td>
                                            <td class="px-2 pt-1">
                                                @if(!is_null($os_appd->price_exc))￥{{ number_format($os_appd->price_exc) }}@endif
                                            </td>
                                            <td rowspan="3" class="w-10 pb-1">
                                                @if(!is_null($os_appd->requested_at))
                                                <p class="w-10 p-1 text-white text-sm bg-indigo-300 rounded">済</p>
                                                @endif
                                            </td>
                                            <td rowspan="3" class="w-10 pb-1">
                                                @if(!is_null($os_appd->appd1_approval))
                                                <p class="w-10 p-1 text-white text-sm bg-indigo-500 rounded">済</p>
                                                @endif
                                            </td>
                                            <td rowspan="3" class="w-10 pb-1">
                                                @if(!is_null($os_appd->appd2_approval))
                                                <p class="w-10 p-1 text-white text-sm bg-indigo-700 rounded">済</p>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-2">
                                                @foreach($works as $work)
                                                @if($work->os_appd_id === $os_appd->id)
                                                @foreach($workspecs as $workspec)
                                                @if($workspec->id === $work->work_spec_id){{ $workspec->format }}
                                                @endif
                                                @endforeach
                                                @endif
                                                @endforeach
                                            </td>
                                            <td rowspan="2" class="px-2 pb-1">
                                                @if(!is_null($os_appd->price_incl))￥{{ number_format($os_appd->price_incl) }}@endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-2">
                                                @foreach($works as $work)
                                                @if($work->os_appd_id === $os_appd->id)
                                                @foreach($workspecs as $workspec)
                                                @if($workspec->id === $work->work_spec_id){{ $workspec->quantity }}{{ $workspec->unit }}
                                                @endif
                                                @endforeach
                                                @endif
                                                @endforeach
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