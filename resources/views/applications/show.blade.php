<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            申請書内容（ユーザー）
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <x-flash-message status="info" />
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <section class="text-gray-600 body-font">
                        <!-- 申請内容 -->
                        <div class="px-5 py-2 mb-5 bg-white">
                            <div class="p-2 w-full flex flex-wrap text-sm text-gray-600">
                                <p class="w-1/3">申請書番号：{{ $application->id }}</p>
                                <p class="w-1/3">依頼者：{{ $user->name }}</p>
                                <p class="w-1/3">所属：{{ $user->affiliation }} </p>
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
                        <div class="w-full flex mx-auto my-10">
                            <a href="{{ route('user.applications.edit', $application->id) }}" class="w-1/2 p-2 btn text-center text-white bg-indigo-500 border-0 focus:outline-none hover:bg-indigo-600 rounded-l-xl">
                                編集する
                            </a>
                            <form id="delete_{{ $application->id }}" method="post" action="{{ route('user.applications.destroy', $application->id) }}" class="w-1/2 p-2 btn text-center text-white bg-red-500 border-0 focus:outline-none hover:bg-red-600">
                                @csrf
                                @method('delete')
                                <a href="#" data-id="{{ $application->id }}" onclick="deletePost(this)">
                                    削除する
                                </a>
                            </form>

                            <a href="{{ route('user.applications.index') }}" id="" class="w-1/2 p-2 btn text-center text-white bg-amber-500 border-0 focus:outline-none hover:bg-amber-600">
                                制作物一覧
                            </a>
                            <a href="{{ route('user.applications.index') }}" class="w-1/2 p-2 btn text-center text-white bg-pink-500 border-0 focus:outline-none hover:bg-pink-600 rounded-r-xl">
                                戻る
                            </a>
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
    </script>
</x-app-layout>