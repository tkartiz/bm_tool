<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            制作物一覧（制作管理者用）
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-8 mx-auto">
                            <x-flash-message status="session('status')" />
                            <div class="px-5 py-2 bg-white mb-5">
                                <div class="p-2 w-full mx-auto overflow-auto">
                                    <table class="table-auto w-full text-center whitespace-no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                    削除</th>
                                                <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                    編集</th>
                                                <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                    番号</th>
                                                <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                    制作物番号</th>
                                                <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                    制作者名</th>
                                                <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                    外注有無</th>
                                                <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                    外注承認ID</th>
                                                <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                    制作開始日</th>
                                                <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                    制作完了日</th>
                                                <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                    金額（税抜）</th>
                                                <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                                                    金額（税込）</th>
                                                <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                                                    連絡事項</th>
                                            </tr>
                                        </thead>
                                        @foreach($works as $work)
                                        <tbody>
                                            <tr>
                                                <td class="px-2 py-3">
                                                    <form id="delete_{{ $work->id }}" method="post" action="{{ route('admin.works.destroy', $work->id) }}">
                                                        @csrf
                                                        @method('delete')
                                                        <a href="#" data-id="{{ $work->id }}" onclick="deleteWork(this)" class="w-full p-1 text-center">
                                                            <span class="i-fa6-regular-trash-can bg-red-500 w-5 h-5"></span>
                                                        </a>
                                                    </form>
                                                </td>
                                                <td class="px-2 py-3">
                                                    <a href="{{ route('admin.works.edit', $work->id) }}" class="w-full p-1 text-center">
                                                        <span class="i-fa6-regular-pen-to-square bg-blue-500 w-5 h-5"></span>
                                                    </a>
                                                </td>
                                                <td class="px-2 py-3"><a href="{{ route('admin.works.show', $work->id) }}" class="text-blue-500 underline">{{ $work->id }}</a></td>
                                                <td class=" px-2 py-3">{{ $work->work_spec_id }}</td>
                                                <td class="px-2 py-3">
                                                    @if($user->roll == 'admin')
                                                    @foreach($creators as $creator)
                                                    @if($creator->id == $work->creator_id)
                                                    <p>{{ $creator->name }}</p>
                                                    @endif
                                                    @endforeach
                                                    @elseif($user->roll == 'creator')
                                                    @if($creator->id == $work->creator_id)
                                                    <p>{{ $creators->name }}</p>
                                                    @endif
                                                    @endif
                                                </td>
                                                <td class="px-2 py-3">
                                                    @if($work->outsourcing == 1)
                                                    <a href="{{ route('admin.os_appds.index', $work->os_appd_id) }}" class="text-blue-500 underline">あり</a>
                                                    @elseif($work->outsourcing == 0)
                                                    <p>なし</p>
                                                    @endif
                                                </td>
                                                <td class="px-2 py-3">{{ $work->os_appd_id }}</td>
                                                <td class="px-2 py-3">{{ $work->started_at }}</td>
                                                <td class="px-2 py-3">{{ $work->completed_at }}</td>
                                                <td class="px-2 py-3">{{ $work->price_exc }}</td>
                                                <td class="px-2 py-3">{{ $work->price_incl }}</td>
                                            </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
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