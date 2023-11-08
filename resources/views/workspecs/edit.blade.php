<?php
$array_sizes = ["A1", "A2", "A3", "A4", "A5以下", "名刺", "バナー", "1cA3", "1CA5以下", "1c名刺", "シール"];
$array_formats = ["紙だけ", "ラミ", "パネル", "ラミパネ", "データ提出", "入稿"];
$array_articles = ["", "出力のみ", "文字校【軽】500", "文字校【重】1500", "注意・誘導【片面】3000", "注意・誘導【両面】5000", "シンプルなPOP【片面】15000", "シンプルなPOP【両面】25000", "複雑なPOP・チラシ【片面】30000", "複雑なPOP・チラシ【両面】50000", "パンフレット・メニュー【片面】50000", "パンフレット・メニュー【両面】80000", "撮影1～5カット15000", "撮影6～15カット30000", "ヒアリング10000"];

?>
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
                            <form method="POST" action="{{ route('user.workspecs.update', $workspec->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="integer" name="application_id" value="{{ $application->id }}" class="hidden" />
                                <div class="w-full pt-3 text-center">
                                    <div class="mb-5 w-full flex">
                                        <div class="p-1 w-2/12">
                                            <div class="relative">
                                                <label for="work_size">サイズ</label>
                                                <select id="work_size" name="size" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    @foreach($array_sizes as $array_size)
                                                    @if($array_size == $workspec->size)
                                                    <option selected value="{{ $array_size }}">{{ $array_size }}</option>
                                                    @else
                                                    <option value="{{ $array_size }}">{{ $array_size }}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="p-1 w-2/12">
                                            <div class="relative">
                                                <label for="work_format">出力形式</label>
                                                <select id="work_format" name="format" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    @foreach($array_formats as $array_format)
                                                    @if($array_format == $workspec->format)
                                                    <option selected value="{{ $array_format }}">{{ $array_format }}</option>
                                                    @else
                                                    <option value="{{ $array_format }}">{{ $array_format }}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="p-1 w-3/12">
                                            <div class="relative">
                                                <label for="work_article">品目</label>
                                                <select id="work_article" name="article" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    @foreach($array_articles as $array_article)
                                                    @if($array_article == $workspec->article)
                                                    <option selected value="{{ $array_article }}">{{ $array_article }}</option>
                                                    @else
                                                    <option value="{{ $array_article }}">{{ $array_article }}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="p-1 w-5/12">
                                            <label for="work_content">内容（品目にない場合に記載）</label>
                                            <textarea id="work_content" name="content"" class=" w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-24 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ $workspec->content }}</textarea><br>
                                            <div class="flex w-full">
                                                <input type="file" name="file" class="w-3/4">
                                                <input type="hidden" name="old_file" value="{{ $workspec->file }}">
                                                <input type="hidden" name="old_filepath" value="{{ $workspec->filepath }}">
                                            </div>
                                            <div class="flex w-full">
                                                <p class="w-3/4 text-start">現ファイル：{{ $workspec->file }}</p>
                                                <div class="w-1/4">
                                                    <input type="checkbox" name="delete" class="w-5 h-5 me-1 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 p-1 leading-8 transition-colors duration-200 ease-in-out">削除
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-1 w-1/12">
                                            <div class="relative">
                                                <label for="work_quantity">数量</label>
                                                <input type="integer" id="work_quantity" name="quantity" value="{{ $workspec->quantity }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>
                                        <div class="p-1 w-1/12">
                                            <div class="relative">
                                                <label for="work_unit">単位</label>
                                                <input type="integer" id="work_unit" name="unit" value="{{ $workspec->unit }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-3/4 flex mx-auto my-10">
                                        <button type="submit" class="w-1/2 py-2 text-white bg-indigo-500 border-0 focus:outline-none hover:bg-indigo-600 rounded-l-xl">更新する</button>
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