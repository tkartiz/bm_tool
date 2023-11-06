<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            申請書一覧（ユーザー）
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="w-1/6 ms-auto px-5 mt-4">
                    <a href="{{ route('user.applications.create') }}" class="w-full btn p-2 text-white bg-indigo-500 border-0 focus:outline-none hover:bg-indigo-600 rounded-xl">
                        申請書の新規登録</a>
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
                                                詳細</th>
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                申請書番号</th>
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                品名</th>
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                制作点数</th>
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
                                                <a href={{ route('user.applications.show', $application->id) }} class="w-full py-1 px-2 btn text-white bg-indigo-500 border-0 focus:outline-none hover:bg-indigo-600 rounded-xl">
                                                    詳細
                                                </a>
                                            </td>
                                            @else
                                            <td class="px-2 py-3 bg-gray-100">
                                                <a href="" class="w-full py-1 px-2 btn text-white bg-pink-500 border-0 focus:outline-none hover:bg-pink-600 rounded-xl">
                                                    問合せ
                                                </a>
                                            </td>
                                            @endif

                                            @if($application->applicated_at == null)
                                            <td class="px-2 py-3">{{ $application->id }}</td>
                                            <td class="px-2 py-3 text-start">{{ $application->subject }}</td>
                                            <td class="px-2 py-3">{{ $application->works_quantity }}</td>
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
</x-app-layout>