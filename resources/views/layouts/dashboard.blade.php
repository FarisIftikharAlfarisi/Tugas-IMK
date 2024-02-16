<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    {{-- @vite(['resources/css/app.css','resources/js/app.js']) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-slate-200">

  @include('partials.navbar')
  @include('partials.sidebar')

  <div class="p-4 sm:ml-64 ">
    @yield('container')
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/datepicker.min.js"></script>
</body>

{{-- <script src="{{ asset('DashboardTemplate/tailwind.config.js') }}"></script>
<script src="{{ asset('DashboardTemplate/src/sidebar.js') }}"></script>
<script src="{{ asset('DashboardTemplate/src/index.js') }}"></script>
<script src="{{ asset('DashboardTemplate/webpack.config.js') }}"></script> --}}
<script src="{{ asset('JS/jam.js') }}"></script>
</html>
