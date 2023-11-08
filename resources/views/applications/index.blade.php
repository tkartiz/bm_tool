<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            申請書一覧（ユーザー）
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="w-40 ms-auto flex px-5 mt-4">
                    <a href="{{ route('user.applications.create') }}" class="w-full btn p-2 text-center text-white bg-indigo-500 border-0 focus:outline-none hover:bg-indigo-600 rounded-xl">
                        新規作成</a>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-8 mx-auto">
                            <x-flash-message status="session('status')" />
                            <div class="w-full mx-auto overflow-auto">
                                <table class="table-auto w-full text-center whitespace-no-wrap">
                                    <thead>
                                        <tr>
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                削除</th>
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                編集</th>
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                申請</th>
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                申請書番号</th>
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                品名</th>
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                制作点数</th>
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                制作一覧</th>
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                緊急度</th>
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                申請日</th>
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                希望納期</th>
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                合計金額（税抜）</th>
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                合計金額（税込）</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($applications as $application)
                                        <tr>
                                            @if($application->applicated_at == null)
                                            <td class="px-2 py-3">
                                                <form id="delete_{{ $application->id }}" method="post" action="{{ route('user.applications.destroy', $application->id) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="#" data-id="{{ $application->id }}" onclick="deletePost(this)" class="w-full p-1 text-center">
                                                        <span class="i-fa6-regular-trash-can bg-red-500 w-5 h-5"></span>
                                                    </a>
                                                </form>
                                            </td>
                                            <td class="px-2 py-3">
                                                <a href="{{ route('user.applications.edit', $application->id) }}" class="w-full p-1 text-center">
                                                    <span class="i-fa6-regular-pen-to-square bg-blue-500 w-5 h-5"></span>
                                                </a>
                                            </td>
                                            <td class="px-2 py-3">
                                                <form id="applicate_{{ $application->id }}" method="POST" action="{{ route('user.applications.update', $application->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <a href="#" data-id="{{ $application->id }}" onclick="applicatePost(this)" class="w-full p-1 text-center">
                                                        <span class="i-fa6-regular-envelope bg-black-500 w-5 h-5"></span>
                                                    </a>
                                                    <input type="hidden" name="user_id" value="{{ $user }}">
                                                    <input type="hidden" name="subject" value="{{ $application->subject }}">
                                                    <input type="hidden" name="severity" value="{{ $application->severity }}">
                                                    <input type="hidden" name="desired_dlvd_at" value="{{ $application->desired_dlvd_at }}">
                                                    <input type="hidden" name="check" value="true">
                                                </form>
                                            </td>
                                            @else
                                            <td class="px-2 py-3 bg-gray-100"></td>
                                            <td class="px-2 py-3 bg-gray-100"></td>
                                            <td class="px-2 py-3 bg-gray-100">
                                                <a href="" class="w-full p-1 text-center">
                                                    <span class="i-fa6-solid-envelope bg-green-500 w-5 h-5 -mb-3"></span><br><small>問合せ</small>
                                                </a>
                                            </td>
                                            @endif

                                            @if($application->applicated_at == null)
                                            <td class="px-2 py-3">{{ $application->id }}</td>
                                            <td class="px-2 py-3 text-start">{{ $application->subject }}</td>
                                            <td class="px-2 py-3">{{ $application->works_quantity }}</td>
                                            <td class="px-2 py-3">
                                                <a href="{{ route('user.workspecs.index', ['application'=>$application->id]) }}" class="w-full p-1 text-center">
                                                    <span class="i-fa6-regular-rectangle-list bg-black-500 w-5 h-5"></span>
                                                </a>
                                            </td>
                                            <td class="px-2 py-3">{{ $application->severity }}</td>
                                            <td class="px-2 py-3">{{ $application->applicated_at }}</td>
                                            <td class="px-2 py-3">{{ $application->desired_dlvd_at }}</td>
                                            <td class="px-2 py-3">{{ $application->ttl_price_exc }}</td>
                                            <td class="px-2 py-3">{{ $application->ttl_price_incl }}</td>
                                            @else
                                            <td class="px-2 py-3 bg-gray-100">
                                                <p>{{ $application->id }}</p>
                                            </td>
                                            <td class="px-2 py-3 text-start bg-gray-100">{{ $application->subject }}</td>
                                            <td class="px-2 py-3 bg-gray-100">{{ $application->works_quantity }}</td>
                                            <td class="px-2 py-3 bg-gray-100">{{ $application->severity }}</td>
                                            <td class="px-2 py-3 bg-gray-100">{{ $application->applicated_at }}</td>
                                            <td class="px-2 py-3 bg-gray-100">{{ $application->desired_dlvd_at }}</td>
                                            <td class="px-2 py-3 bg-gray-100">{{ $application->ttl_price_exc }}</td>
                                            <td class="px-2 py-3 bg-gray-100">{{ $application->ttl_price_incl }}</td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <script>
        function deletePost(e) {
            'use strict';
            if (confirm('本当に削除してもいいですか？')) {
                document.getElementById('delete_' + e.dataset.id).submit();
            }
        }

        function applicatePost(e) {
            'use strict';
            if (confirm('本当に申請してもいいですか？')) {
                document.getElementById('applicate_' + e.dataset.id).submit();
            }
        }
    </script>
</x-app-layout>