<!DOCTYPE html>
<html lang="id_ID">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Hasil Produksi</title>
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css"  rel="stylesheet" />
</head>

<body>
    @include('partials.navbar')

    @if (session()->has('login-success'))
        <div id="modal_login" aria-hidden="true" data-modal-backdrop="static" tabindex="-1"
            class=" overflow-y-hidden overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full shadow-3xl bg-slate-700 bg-opacity-25">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button" id="tutup2"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="modal_login">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center ">
                        <svg class="w-[72px] h-[72px] my-4 text-green-700 dark:text-white mx-auto" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m8 12 2 2 5-5m4.5 5.3 1-.9a2 2 0 0 0 0-2.8l-1-.9a2 2 0 0 1-.6-1.4V7a2 2 0 0 0-2-2h-1.2a2 2 0 0 1-1.4-.5l-.9-1a2 2 0 0 0-2.8 0l-.9 1a2 2 0 0 1-1.4.6H7a2 2 0 0 0-2 2v1.2c0 .5-.2 1-.5 1.4l-1 .9a2 2 0 0 0 0 2.8l1 .9c.3.4.6.9.6 1.4V17a2 2 0 0 0 2 2h1.2c.5 0 1 .2 1.4.5l.9 1a2 2 0 0 0 2.8 0l.9-1a2 2 0 0 1 1.4-.6H17a2 2 0 0 0 2-2v-1.2c0-.5.2-1 .5-1.4Z"/>
                          </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400 text-center">
                            Halo, Selamat datang <br> <b> {{ Auth::user()->username }} </b> <br> selamat melaporkan capaian produksi anda. lakukan secara tepat dan teliti. <br> semoga harimu menyenangkan</h3>
                        <div class="flex items-center justify-evenly">
                            <button data-modal-hide="modal_login" id="tutup" type="button"
                                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Lanjutkan</button>
                        </div>
                        <script text="javascript">
                            let tutup = document.getElementById('tutup');
                            let tutup2 = document.getElementById('tutup2');
                            let modal = document.getElementById('modal_login');
                            tutup.addEventListener("click", function () {
                                modal.classList.add('hidden');
                            });
                            tutup2.addEventListener("click", function () {
                                modal.classList.add('hidden');
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    @endif



    <div class="flex flex-col items-center justify-center px-6 pt-5 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
        @if (session()->has('success'))
            <div id="toast-success"
                class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
                role="alert">
                <div
                    class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                    </svg>
                    <span class="sr-only">Check icon</span>
                </div>
                <div class="ms-3 text-sm font-normal">{{ session()->get('success') }}</div>
                <button type="button" id="success-colse"
                    class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                    data-dismiss-target="#toast-success" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif

        <script text="javascript">
            let tutup = document.getElementById('success-close');
            let toast = document.getElementById('toast-success');
            tutup.addEventListener("click", function () {
                toast.classList.add('hidden');
            });
        </script>

        <!-- Card -->

        <div class="w-full max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
            <p class="flex items-center justify-center mb-8 text-2xl font-semibold lg:mb-10 dark:text-white">
                {{-- <img src="{{ asset('images/logo_jahit_transparent.png') }}" class="mr-4 h-11" alt="Logo jahit"> --}}
                <span>Laporan Hasil Produksi</span>
            </p>
            {{-- <h2 class="text-2xl font-bold text-center text-gray-900 dark:text-white">
                Masuk
            </h2> --}}
            <form class="mt-8 space-y-6" action="{{ route('proses-simpan-capaian') }}" method="POST">
                @csrf
                <div>
                    <label for="Brand"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Merek/Brand</label>
                    <select
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        id="grid-state" name="brand">
                        @foreach ($products as $produk)
                            <option value="{{ $produk->id }}"> [{{ $produk->kode_produk }}] - {{ $produk->brand }} -
                                {{ $produk->nama_produk }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="Jumlah Produksi"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total Produksi</label>
                    <input type="text" name="jumlah_produksi" id="jumlah_produksi"
                        placeholder="Masukkan jumlah yang telah anda kerjakan"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        required>
                </div>

                <button type="submit"
                    class="w-full inset-x-0 bottom-0 px-5 py-3 text-base font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan
                </button>

            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
{{-- <script src="{{ asset('DashboardTemplate/tailwind.config.js') }}"></script>
<script src="{{ asset('DashboardTemplate/src/sidebar.js') }}"></script>
<script src="{{ asset('DashboardTemplate/src/index.js') }}"></script>
<script src="{{ asset('DashboardTemplate/webpack.config.js') }}"></script> --}}
</html>
