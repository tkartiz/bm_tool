<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            制作物仕様編集（ユーザー）
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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

                        <div class="p-3 flex flex-wrap bg-white">
                            <!-- 申請内容・内訳 -->
                            <BreezeValidationErrors :errors="errors" />
                            <form method="POST" action="{{ route('user.workspecs.store') }}">
                                @csrf
                                <input type="integer" name="application_id" value="{{ $application->id }}" class="hidden" />
                                <div class="w-full pt-3 text-center">
                                    <div class="mb-5 w-full flex">
                                        <div class="p-1 w-2/12">
                                            <div class="relative">
                                                <label for="work_size">サイズ</label>
                                                <select id="work_size" name="size" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    <option selected value="">選択してください</option>
                                                    <option value="A1">A1</option>
                                                    <option value="A2">A2</option>
                                                    <option value="A3">A3</option>
                                                    <option value="A4">A4</option>
                                                    <option value="A5以下">A5以下</option>
                                                    <option value="名刺">名刺</option>
                                                    <option value="バナー">バナー</option>
                                                    <option value="1cA3">1cA3</option>
                                                    <option value="1CA5以下">1CA5以下</option>
                                                    <option value="1c名刺">1c名刺</option>
                                                    <option value="シール">シール</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="p-1 w-2/12">
                                            <div class="relative">
                                                <label for="work_format">出力形式</label>
                                                <select id="work_format" name="format" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    <option selected value="">選択してください</option>
                                                    <option value="紙だけ">紙だけ</option>
                                                    <option value="ラミ">ラミ</option>
                                                    <option value="パネル">パネル</option>
                                                    <option value="ラミパネ">ラミパネ</option>
                                                    <option value="データ提出">データ提出</option>
                                                    <option value="入稿">入稿</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="p-1 w-3/12">
                                            <div class="relative">
                                                <label for="work_article">品目</label>
                                                <select id="work_article" name="article" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    <option selected value="">選択してください／選択なし</option>
                                                    <option value="出力のみ">出力のみ</option>
                                                    <option value="文字校【軽】500">文字校【軽】500</option>
                                                    <option value="文字校【重】1500">文字校【重】1500</option>
                                                    <option value="注意・誘導【片面】3000">注意・誘導【片面】3000</option>
                                                    <option value="注意・誘導【両面】5000">注意・誘導【両面】5000</option>
                                                    <option value="シンプルなPOP【片面】15000">シンプルなPOP【片面】15000</option>
                                                    <option value="シンプルなPOP【両面】25000">シンプルなPOP【両面】25000</option>
                                                    <option value="複雑なPOP・チラシ【片面】30000">複雑なPOP・チラシ【片面】30000</option>
                                                    <option value="複雑なPOP・チラシ【両面】50000">複雑なPOP・チラシ【両面】50000</option>
                                                    <option value="パンフレット・メニュー【片面】50000">パンフレット・メニュー【片面】50000</option>
                                                    <option value="パンフレット・メニュー【両面】80000">パンフレット・メニュー【両面】80000</option>
                                                    <option value="撮影1～5カット15000">撮影1～5カット15000</option>
                                                    <option value="撮影6～15カット30000">撮影6～15カット30000</option>
                                                    <option value="ヒアリング10000">ヒアリング10000</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="p-1 w-5/12">
                                            <label for="work_content">内容（品目にない場合に記載）</label>
                                            <textarea id="work_content" name="content" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-24 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea><br>
                                            <div class="flex w-full">
                                                <button class="w-1/5 bg-red-500 hover:bg-red-700 text-white rounded-l-xl">削除</button>
                                                <input type="file" @input="file = $event.target.files[0]" class="w-4/5">
                                            </div>
                                        </div>
                                        <div class="p-1 w-1/12">
                                            <div class="relative">
                                                <label for="work_quantity">数量</label>
                                                <input type="integer" id="work_quantity" name="quantity" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>
                                        <div class="p-1 w-1/12">
                                            <div class="relative">
                                                <label for="work_unit">単位</label>
                                                <input type="integer" id="work_unit" name="unit" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-3/4 flex mx-auto my-10">
                                        <button type="submit" class="w-1/2 py-2 text-white bg-indigo-500 border-0 focus:outline-none hover:bg-indigo-600 rounded-l-xl">入力する</button>
                                        <a href="{{ route('user.workspecs.index', ['application'=>$application->id]) }}" class="w-1/2 py-2 text-white bg-pink-500 border-0 focus:outline-none hover:bg-pink-600 rounded-r-xl">
                                        戻る</a>
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