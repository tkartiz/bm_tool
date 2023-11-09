<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            外注承認書（制作管理者用）
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <section class="text-gray-600 body-font">
                        <div class="flex p-5 bg-white mb-5">
                            <div class="w-1/3 text-sm text-gray-600">
                                <dl class="flex">
                                    <dt class="w-32 py-1 flex">申請番号<p class="ms-auto">：</p>
                                    </dt>
                                    <dd class="ps-3 py-1">{{ application.id }} </dd>
                                </dl>
                                <dl class="flex">
                                    <dt class="w-32 py-1 flex">依頼者<p class="ms-auto">：</p>
                                    </dt>
                                    <dd class="ps-3 py-1">{{ client.name }}</dd>
                                </dl>
                                <dl class="flex">
                                    <dt class="w-32 py-1 flex">所属<p class="ms-auto">：</p>
                                    </dt>
                                    <dd class="ps-3 py-1">{{ client.affiliation }}</dd>
                                </dl>
                            </div>
                            <div class="w-1/3 text-sm text-gray-600">
                                <dl class="flex">
                                    <dt class="w-32 py-1 flex">品名<p class="ms-auto">：</p>
                                    </dt>
                                    <dd class="ps-3 py-1">{{ application.subject }}</dd>
                                </dl>
                                <dl class="flex">
                                    <dt class="w-32 py-1 flex">サイズ<p class="ms-auto">：</p>
                                    </dt>
                                    <dd class="ps-3 py-1">{{ workspec.size }}</dd>
                                </dl>
                                <dl class="flex">
                                    <dt class="w-32 py-1 flex">出力形式<p class="ms-auto">：</p>
                                    </dt>
                                    <dd class="ps-3 py-1">{{ workspec.format }}</dd>
                                </dl>
                                <dl class="flex">
                                    <dt class="w-32 py-1 flex">数量<p class="ms-auto">：</p>
                                    </dt>
                                    <dd class="ps-3 py-1">{{ workspec.quantity }}{{ workspec.unit }}</dd>
                                </dl>
                            </div>
                            <div class="w-1/3 flex-wrap text-sm text-gray-600">
                                <dl class="flex">
                                    <dt class="w-32 py-1 flex">希望納期<p class="ms-auto">：</p>
                                    </dt>
                                    <dd class="ps-3 py-1">{{ application.desired_dlvd_at }}</dd>
                                </dl>
                                <dl class="flex">
                                    <dt class="w-32 py-1 flex">依頼総点数<p class="ms-auto">：</p>
                                    </dt>
                                    <dd class="ps-3 py-1">{{ application.works_quantity }}</dd>
                                </dl>
                                <dl class="flex">
                                    <dt class="w-32 py-1 flex">緊急度<p class="ms-auto">：</p>
                                    </dt>
                                    <dd class="ps-3 py-1">{{ application.severity }}</dd>
                                </dl>
                                <dl class="flex">
                                    <dt class="w-32 py-1 flex">見積金額（税抜）<p class="ms-auto">：</p>
                                    </dt>
                                    <dd class="ps-3 py-1">￥{{ application.price_incl }}</dd>
                                </dl>
                                <dl class="flex">
                                    <dt class="w-32 py-1 flex">見積金額（税込）<p class="ms-auto">：</p>
                                    </dt>
                                    <dd class="ps-3 py-1">￥{{ application.price_exc }}</dd>
                                </dl>
                            </div>
                        </div>

                        <div class="p-5 bg-white">
                            <div class="flex">
                                <div class="w-3/4 me-auto overflow-auto">
                                    <dl class="flex w-full mb-10">
                                        <dt class="w-32 py-1 flex">コメント<p class="ms-auto">：</p>
                                        </dt>
                                        <dd class="w-full ps-3 py-1">{{ os_appd.comment }}</dd>
                                    </dl>
                                    <div class="w-full mb-10">
                                        <dl class="flex">
                                            <dt class="w-32 py-1 flex">品名<p class="ms-auto">：</p>
                                            </dt>
                                            <dd class="ps-3 py-1">{{ application.subject }}</dd>
                                        </dl>
                                        <dl class="flex">
                                            <dt class="w-32 py-1 flex">サイズ<p class="ms-auto">：</p>
                                            </dt>
                                            <dd class="ps-3 py-1">{{ workspec.size }}</dd>
                                        </dl>
                                        <dl class="flex">
                                            <dt class="w-32 py-1 flex">出力形式<p class="ms-auto">：</p>
                                            </dt>
                                            <dd class="ps-3 py-1">{{ workspec.format }}</dd>
                                        </dl>
                                        <dl class="flex">
                                            <dt class="w-32 py-1 flex">数量<p class="ms-auto">：</p>
                                            </dt>
                                            <dd class="ps-3 py-1">{{ workspec.quantity }}{{ workspec.unit }}</dd>
                                        </dl>
                                        <dl class="flex">
                                            <dt class="w-32 py-1 flex">仕様詳細<p class="ms-auto">：</p>
                                            </dt>
                                            <dd class="w-full ps-3 py-1">{{ os_appd.spec }}</dd>
                                        </dl>
                                    </div>
                                    <div class="w-full mb-10">
                                        <dl class="flex">
                                            <dt class="w-32 py-1 flex">発注先<p class="ms-auto">：</p>
                                            </dt>
                                            <dd class="w-full ps-3 py-1">
                                                <div v-for="outsourcing in outsourcings" :key="outsourcing.id">
                                                    <p v-if="outsourcing.id == os_appd.order_recipient">{{
                                                        outsourcing.comp_name }}</p>
                                                    <p v-else></p>
                                                </div>
                                            </dd>
                                        </dl>
                                        <dl class="flex">
                                            <dt class="w-32 py-1 flex">金額（税抜）<p class="ms-auto">：</p>
                                            </dt>
                                            <dd class="w-full ps-3 py-1">￥{{ os_appd.price_exc }}</dd>
                                        </dl>
                                        <dl class="flex">
                                            <dt class="w-32 py-1 flex">金額（税込）<p class="ms-auto">：</p>
                                            </dt>
                                            <dd class="w-full ps-3 py-1">￥{{ os_appd.price_incl }}</dd>
                                        </dl>
                                        <dl class="flex">
                                            <dt class="w-32 py-1 flex">価格明細<p class="ms-auto">：</p>
                                            </dt>
                                            <dd class="w-full ps-3 py-1">{{ os_appd.price_list }}</dd>
                                        </dl>
                                        <dl class="flex">
                                            <dt class="w-32 py-1 flex">備考<p class="ms-auto">：</p>
                                            </dt>
                                            <dd class="w-full ps-3 py-1">{{ os_appd.remarks }}</dd>
                                        </dl>
                                        <dl class="flex">
                                            <dt class="w-32 py-1 flex">競合数<p class="ms-auto">：</p>
                                            </dt>
                                            <dd class="w-full ps-3 py-1">{{ os_appd.comp_num }}</dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="w-1/4 ms-auto">
                                    <table class="w-full border-separate border border-slate-400 text-center">
                                        <tr>
                                            <th colspan="3" class="border border-slate-300">承認欄</th>
                                        </tr>
                                        <tr>
                                            <th class="w-1/3 border border-slate-300">承認者</th>
                                            <th class="w-1/3 border border-slate-300">承認者</th>
                                            <th class="w-1/3 before:border border-slate-300">担当者</th>
                                        </tr>
                                        <tr>
                                            <td class="h-20 border border-slate-300">
                                                <p v-for="admin in admins" :key="admin.id">
                                                    <span v-if="admin.id === os_appd.appd2_id">{{ admin.name }}</span>
                                                    <span v-else></span>
                                                </p>
                                            </td>
                                            <td class="h-20 border border-slate-300">
                                                <p v-for="admin in admins" :key="admin.id">
                                                    <span v-if="admin.id === os_appd.appd1_id">{{ admin.name }}</span>
                                                    <span v-else></span>
                                                </p>
                                            </td>
                                            <td class="h-20 border border-slate-300">{{ user.name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border border-slate-300 text-sm">承認可(日付)/否</td>
                                            <td class="border border-slate-300 text-sm">承認可(日付)/否</td>
                                            <td class="border border-slate-300 text-sm">申請日付</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="w-full mx-auto overflow-auto">
                                <div class="w-full">
                                    <table v-if="outsourcings !== null" class="w-full flex">
                                        <tbody v-for="outsourcing in outsourcings" :key="outsourcing.id" class="w-1/3 p-5">
                                            <tr class="w-full flex">
                                                <th class="w-40 py-1 flex bg-gray-100">発注先<p class="ms-auto">：</p>
                                                </th>
                                                <td class="w-full py-1 block text-center items-center pl-4 dark:border-gray-700 bg-gray-100">
                                                    <p v-if="outsourcing.id == os_appd.order_recipient" class="font-medium">
                                                        ＊</p>
                                                    <p v-else></p>
                                                </td>
                                            </tr>
                                            <tr class="w-full flex">
                                                <th class="w-40 py-1 flex">競合先<p class="ms-auto">：</p>
                                                </th>
                                                <td v-if="outsourcing.comp_name !== null" class="w-full px-5 py-1">
                                                    {{ outsourcing.comp_name }}
                                                </td>
                                                <td v-else class="w-full px-5 py-1">&nbsp;</td>
                                            </tr>
                                            <tr class="w-full flex">
                                                <th class="w-40 py-1 flex bg-gray-100">
                                                    金額（税抜）<p class="ms-auto">：</p>
                                                </th>
                                                <td v-if="outsourcing.comp_price_exc !== null" class="w-full block px-5 py-1 bg-gray-100">
                                                    ￥{{ outsourcing.comp_price_exc }}</td>
                                                <td v-else class="w-full block px-5 py-1">&nbsp;</td>
                                            </tr>
                                            <tr class="w-full flex">
                                                <th class="w-40 py-1 flex">
                                                    金額（税込）<p class="ms-auto">：</p>
                                                </th>
                                                <td v-if="outsourcing.comp_price_incl !== null" class="w-full block px-5 py-1">￥{{ outsourcing.comp_price_incl
                                                    }}
                                                </td>
                                                <td v-else class="w-full px-5 py-1">&nbsp;</td>
                                            </tr>
                                            <tr class="w-full flex">
                                                <th class="w-40 py-1 flex bg-gray-100">備考<p class="ms-auto">：</p>
                                                </th>
                                                <td v-if="outsourcing.remarks !== null" class="w-full block px-5 py-1 bg-gray-100">
                                                    {{ outsourcing.remarks }}
                                                </td>
                                                <td v-else class="w-full block px-5 py-1 bg-gray-100">&nbsp;</td>
                                            </tr>
                                            <tr class="w-full flex">
                                                <th class="w-40 py-1 flex">見積もり<p class="ms-auto">：</p>
                                                </th>
                                                <td class="w-full block p-3 py-1">
                                                    <p v-if="outsourcing.comp_file1 !== null">{{
                                                        outsourcing.comp_file1 }}</p>
                                                    <p v-else>&emsp;</p>

                                                    <p v-if="outsourcing.comp_file2 !== null">{{
                                                        outsourcing.comp_file2 }}</p>
                                                    <p v-else>&emsp;</p>

                                                    <p v-if="outsourcing.comp_file3 !== null">{{
                                                        outsourcing.comp_file3 }}</p>
                                                    <p v-else>&emsp;</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="w-full mx-auto">
                            <Link as="button" :href="route('admin.os_appds.edit', { os_appd: os_appd.id })" class="w-1/2 py-2 text-white bg-indigo-500 border-0 focus:outline-none hover:bg-indigo-600 rounded-l-xl">
                            編集する</Link>
                            <Link as="button" :href="route('admin.works.show', { work: work.id })" class="w-1/2 py-2 text-white bg-pink-500 border-0 focus:outline-none hover:bg-pink-600 rounded-r-xl">
                            戻る</Link>
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