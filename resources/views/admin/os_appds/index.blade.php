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
                                            <th rowspan="2" class="px-0 pb-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">中間<br>承認</th>
                                            <th rowspan="2" class="px-0 pb-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">最終<br>承認</th>
                                        </tr>
                                        <tr>
                                            <th class="p-2 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">枚数</th>
                                        </tr>
                                    </thead>
                                    @foreach($works as $work)
                                    <tbody class="border">
                                        <tr>
                                            <td rowspan="3" class="px-2 pt-1">
                                                <a href="{{ route('admin.os_appds.show', $work->os_appd_id) }}" class="text-blue-500 underline">{{ $work->os_appd_id }}</a>
                                            </td>
                                            <td rowspan="3" class="p-2">{{ $work->creator_name }}</td>
                                            <td rowspan="3" class="px-2 pt-1 text-start">{!! nl2br($work->os_comment) !!}</td>
                                            <td rowspan="3" class="p-2">{{ $work->subject }}</td>
                                            <td class="p-2">{{ $work->size }}</td>
                                            <td class="px-2 pt-1">
                                                @if(!is_null($work->os_price_exc))￥{{ number_format($work->os_price_exc) }}@endif
                                            </td>
                                            <td rowspan="3" class="w-10 pb-1 text-center">
                                                <p class="text-xs mb-0">{{ $work->creator_name }}</p>
                                                @if(!is_null($work->os_requested_at))
                                                <p class="mx-auto w-10 p-1 text-white text-sm bg-indigo-300 rounded">済</p>
                                                @else
                                                <p class="mx-auto w-10 p-1 text-white text-sm bg-pink-200 rounded">未</p>
                                                @endif
                                            </td>
                                            <td rowspan="3" class="w-10 pb-1 text-center">
                                                @foreach($admins as $admin)
                                                @if($admin->id === $work->appd1_id)
                                                <p class="text-xs mb-0">{{ $admin->name }}</p>
                                                @endif
                                                @endforeach
                                                @if(!is_null($work->appd1_approval))
                                                <p class="mx-auto w-10 p-1 text-white text-sm bg-indigo-500 rounded">済</p>
                                                @else
                                                <p class="mx-auto w-10 p-1 text-white text-sm bg-pink-200 rounded">未</p>
                                                @endif
                                            </td>
                                            <td rowspan="3" class="w-10 pb-1 text-center">
                                                @foreach($admins as $admin)
                                                @if($admin->id === $work->appd2_id)
                                                <p class="text-xs mb-0">{{ $admin->name }}</p>
                                                @endif
                                                @endforeach
                                                @if(!is_null($work->appd2_approval))
                                                <p class="mx-auto w-10 p-1 text-white text-sm bg-indigo-700 rounded">済</p>
                                                @else
                                                <p class="mx-auto w-10 p-1 text-white text-sm bg-pink-200 rounded">未</p>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-2">{{ $work->format }}</td>
                                            <td rowspan="2" class="px-2 pb-1">
                                                @if(!is_null($work->os_price_incl))￥{{ number_format($work->os_price_incl) }}@endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-2">{{ $work->quantity }}{{ $work->unit }}</td>
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