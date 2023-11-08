<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            問合せフォーム（ユーザー）
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="py-3 text-gray-900">
                    <section class="text-gray-600 body-font relative">
                        <div class="container px-5 py-24 mx-auto">

                            <form method="POST" action="{{ route('user.contacts.store') }}">
                                @csrf
                                @method('POST')
                                <input type="integer" name="application_id" value="{{ $application->id }}" class="hidden" />
                                <input type="integer" name="user_id" value="{{ $user->id }}" class="hidden" />

                                <div class="flex flex-col text-center w-full mb-12">
                                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">
                                        <small>制作ご依頼</small>
                                         「{{ $application->subject }}」<small>に関する</small>お問い合わせ
                                    </h1>
                                    <p class="lg:w-2/3 mx-auto leading-relaxed text-base"></p>
                                </div>
                                <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                    <div class="flex flex-wrap -m-2">
                                        <div class="p-2 w-full">
                                            <p class="leading-7 text-gray-600">お名前</p>
                                            <p class="w-full border border-gray-300 text-base outline-none text-gray-700 py-1 px-3 leading-8">{{ $user->name }}</p>
                                        </div>
                                        <div class="p-2 w-full flex flex-wrap">
                                            <div class="w-1/2 pe-10">
                                                <p class="leading-7 text-gray-600">ご登録Eメール</p>
                                                <p class="w-full border border-gray-300text-base outline-none text-gray-700 py-1 px-3 leading-8">{{ $user->email }}</p>
                                                <input name="email" value="{{ $user->email }}" class="hidden" />
                                            </div>
                                            <div class="w-1/2">
                                                <label for="email2" class="leading-7 text-gray-600">返信用のEメール（任意）</label>
                                                <input type="email" id="email2" name="email2" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>
                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="title" class="leading-7 text-gray-600">件名</label>
                                                <input id="title" name="title" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>
                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="message" class="leading-7 text-gray-600">お問い合わせ内容</label>
                                                <textarea id="message" name="message" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-48 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                                            </div>
                                        </div>
                                        <div class="p-2 w-full flex text-white">
                                            <button type="submit" class="w-3/4 py-2 bg-indigo-500 border-0 focus:outline-none hover:bg-indigo-600 text-lg rounded-l-xl">送信する</button>
                                            <a href="{{ route('user.applications.index', ['application' => $application->id]) }}" class="w-1/4 py-2 btn text-center bg-pink-500 border-0 focus:outline-none hover:bg-pink-600 rounded-r-xl">
                                            戻る</a>
                                        </div>
                                        <div class="p-2 w-full pt-8 mt-8 border-t border-gray-200 text-center">
                                            <p class="text-indigo-500">example@email.com</p>
                                            <p class="leading-normal my-5">
                                                住所記載<br>
                                                電話番号記載
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>