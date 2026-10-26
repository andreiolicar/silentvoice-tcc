<!DOCTYPE html>
<html lang="pt-BR"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name') }} — Meu painel</title><link rel="icon" type="image/svg+xml" href="{{ asset('images/symbol.svg') }}">@vite(['resources/css/app.css', 'resources/js/app.js'])</head>
<body class="font-sans antialiased text-slate-900"><div class="min-h-screen bg-slate-50">
@include('layouts.navigation')
@isset($header)<header class="border-b border-slate-200 bg-white"><div class="page-shell py-7">{{ $header }}</div></header>@endisset
<main id="conteudo">@if(session('success'))<div class="page-shell pt-6"><div role="status" class="rounded-xl border border-brand-200 bg-brand-50 p-4 text-sm font-medium text-brand-800">{{ session('success') }}</div></div>@endif{{ $slot }}</main>
</div><x-site-footer /></body></html>
