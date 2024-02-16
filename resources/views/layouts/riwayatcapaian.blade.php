<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Hasil Produksi</title>
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
</head>

<body>
    @include('partials.navbar')

    <!-- Card -->

    <div class="w-full max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800 mx-auto mt-10">
        <p class="flex items-center justify-center mb-8 text-2xl font-semibold lg:mb-10 dark:text-white">
            <span>Riwayat Capaian</span>
        </p>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Tanggal
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Brand / Produk
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jumlah
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($my_prod as $items)
                        <tr class="bg-white dark:bg-gray-800">
                            <td class="px-6 py-4">
                                {{ (new DateTime($items->tanggal_pelaporan))->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $items->produk->brand }} / {{ $items->produk->nama_produk }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $items->total_produksi }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>

{{-- <script src="{{ asset('DashboardTemplate/tailwind.config.js') }}"></script>
<script src="{{ asset('DashboardTemplate/src/sidebar.js') }}"></script>
<script src="{{ asset('DashboardTemplate/src/index.js') }}"></script>
<script src="{{ asset('DashboardTemplate/webpack.config.js') }}"></script> --}}

</html>
