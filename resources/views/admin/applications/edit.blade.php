<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            申請書編集（ユーザー）
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="py-3 text-gray-900">
                    <section class="text-gray-600 body-font relative">
                        <!-- 依頼者情報 -->
                        <div class="px-5 py-2 bg-white mb-5">
                            <div class="p-2 w-full flex flex-wrap text-sm text-gray-600">
                                <p class="w-1/3">申請書番号：作成後取得</p>
                                <p class="w-1/3">依頼者：{{ $user->name }}</p>
                                <p class="w-1/3">
                                    所属：{{ $user->affiliation }}
                                </p>
                            </div>
                        </div>

                        <!-- 申請内容 -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form method="POST" action="{{ route('user.applications.update', ['application' => $application->id]) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}">
                            <div class="p-3 flex bg-white">
                                <div class="p-2 w-2/6">
                                    <label for="subject" class="leading-7 text-sm text-gray-600">品名</label>
                                    <input type="text" id="subject" name="subject" value="{{ $application->subject }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                </div>
                                <div class="p-2 w-1/6">
                                    <label for="applicated_at" class="leading-7 text-sm text-gray-600">申請日</label>
                                    <div id="works_quantity" class="w-full">{{ $application->applicated_at }}</div>
                                </div>
                                <div class="p-2 w-1/6">
                                    <label for="desired_dlvd_at" class="leading-7 text-sm text-gray-600">希望納期</label>
                                    <input type="date" id="desired_dlvd_at" name="desired_dlvd_at" value="{{ $application->desired_dlvd_at }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                </div>
                                <div class="p-2 w-1/6">
                                    <label for="works_quantity" class="leading-7 text-sm text-gray-600">依頼点数</label><br>
                                    <div id="works_quantity" class="w-full">{{ $application->works_quantity }}</div>
                                </div>
                                <div class="p-2 w-1/6">
                                    <label for="severity" class="leading-7 text-sm text-gray-600">緊急度</label>
                                    <select id="severity" name="severity" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        @if($application->severity == '急ぎ'){
                                        <option value="通常">通常</option>
                                        <option selected value="急ぎ">急ぎ</option>
                                        <option value="超急ぎ">超急ぎ</option>
                                        }
                                        @elseif($application->severity == '超急ぎ'){
                                        <option value="通常">通常</option>
                                        <option value="急ぎ">急ぎ</option>
                                        <option selected value="超急ぎ">超急ぎ</option>
                                        }
                                        @else {
                                        <option selected value="通常">通常</option>
                                        <option value="急ぎ">急ぎ</option>
                                        <option value="超急ぎ">超急ぎ</option>
                                        }
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="w-3/4 flex mx-auto my-10">
                                <button type="submit" class="w-1/2 p-2 text-white bg-indigo-500 border-0 focus:outline-none hover:bg-indigo-600 rounded-l-xl">
                                    更新する
                                </button>
                                <a href="{{ route('user.applications.index') }}" class="w-1/2 p-2 btn text-center text-white bg-pink-500 border-0 focus:outline-none hover:bg-pink-600 rounded-r-xl">
                                    戻る
                                </a>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>