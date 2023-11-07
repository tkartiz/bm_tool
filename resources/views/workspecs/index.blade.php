<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            制作物一覧（ユーザー）
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="w-40 ms-auto flex px-5 mt-4">
                    <a href="" class="w-full btn p-2 text-center text-white bg-indigo-500 border-0 focus:outline-none hover:bg-indigo-600 rounded-xl">
                        新規作成</a>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <section class="text-gray-600 body-font">
                        <div class="px-5 py-2 bg-white mb-5">
                            <!-- 依頼者情報 -->
                            <div class="p-2 w-full flex flex-wrap text-sm text-gray-600">
                                <p class="w-1/3">申請番号：{{ $application->id }} </p>
                                <p class="w-1/3">依頼者：{{ $user->name }}</p>
                                <p class="w-1/3">所属：{{ $user->affiliation }}</p>
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
                                        @foreach($workspecs as $workspec)
                                        <tr v-for="workspec in workspecs" :key="$workspec->id">
                                            <td class="px-2 py-3">
                                                <form id="delete_{{ $workspec->id }}" method="post" action="{{ route('user.workspecs.destroy', $workspec->id) }}">
                                                    @csrf
                                                    @method('put')
                                                    <a href="#" data-id="{{ $workspec->id }}" onclick="deleteWorkspec(this)" class="w-full p-1 text-center">
                                                        <span class="i-fa6-regular-trash-can bg-red-500 w-5 h-5"></span>
                                                    </a>
                                                </form>
                                            </td>
                                            <td class="px-2 py-3">
                                                <a href="{{ route('user.workspecs.edit', $workspec->id) }}" class="w-full p-1 text-center">
                                                    <span class="i-fa6-regular-pen-to-square bg-blue-500 w-5 h-5"></span>
                                                </a>
                                            </td>
                                            <td class="px-2 py-3">
                                                <a class="text-blue-400" href="{{ route('user.workspecs.show', $workspec->id) }}">
                                                    {{ $workspec->id }}
                                                </a>
                                            </td>
                                            <td class="px-2 py-3">{{ $workspec->size }}</td>
                                            <td class="px-2 py-3">{{ $workspec->format }}</td>
                                            <td class="px-2 py-3">{{ $workspec->article }}</td>
                                            <td class="px-2 py-3">{{ $workspec->content }}</td>
                                            <td class="px-2 py-3">
                                                <span v-if="$workspec->file"><img class="mx-auto" :src="'/storage/'+ $workspec->application_id + '/' + $workspec->file" style="width: 100px" /></span>
                                                <p>{{ $workspec->file }}</p>
                                            </td>
                                            <td class="px-2 py-3">{{ $workspec->quantity }}</td>
                                            <td class="px-2 py-3">{{ $workspec->unit }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="w-3/4 flex mx-auto mt-5">
                                <a href="{{ route('user.workspecs.create', ['application'=>$application->id]) }}" class="w-1/2 py-2 text-center text-white bg-indigo-500 border-0 focus:outline-none hover:bg-indigo-600 rounded-l-xl">
                                    制作物仕様の入力
                                </a>
                                <a href="{{ route('user.applications.index', $application->id) }}" class="w-1/2 py-2 text-center text-white bg-pink-500 border-0 focus:outline-none hover:bg-pink-600 rounded-r-xl">
                                    戻る
                                </a>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <script>
        function deleteWorkspec(e) {
            'use strict';
            if (confirm('本当に削除してもいいですか？')) {
                document.getElementById('delete_' + e.dataset.id).submit();
            }
        }
    </script>
</x-app-layout>