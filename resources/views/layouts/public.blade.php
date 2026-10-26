<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Conheça o SilentVoice: uma proposta de comunicação assistiva que transforma intenções em fala. Cadastre seu interesse no projeto.">
    <title>SilentVoice — Sua intenção ganha voz</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/symbol.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-slate-900">
<a href="#conteudo" class="sr-only focus:not-sr-only focus:fixed focus:z-50 focus:bg-white focus:p-4">Pular para o conteúdo</a>
<header class="border-b border-slate-100 bg-white" x-data="{ open: false }">
    <div class="page-shell flex min-h-24 items-center justify-between gap-4">
        <a href="{{ route('home') }}" aria-label="SilentVoice — início"><x-application-logo /></a>
        <nav aria-label="Navegação principal" class="hidden items-center gap-7 text-sm font-medium text-slate-600 lg:flex">
            <a class="hover:text-brand-700" href="{{ route('home') }}#comunicacao">O projeto</a><a class="hover:text-brand-700" href="{{ route('home') }}#aplicativo">Aplicativo</a>
            <a class="hover:text-brand-700" href="{{ route('home') }}#para-quem">Para quem</a><a class="hover:text-brand-700" href="{{ route('home') }}#faq">Perguntas frequentes</a>
        </nav>
        <div class="hidden items-center gap-5 sm:flex">@auth
            <a href="{{ route('dashboard') }}" class="btn-primary">Meu painel <span aria-hidden="true">↗︎</span></a>
        @else
            <a href="{{ route('login') }}" class="text-sm font-semibold hover:text-brand-700">Entrar</a>
            <a href="{{ route('register') }}" class="btn-primary">Participe <span aria-hidden="true">↗︎</span></a>
        @endauth</div>
        <button type="button" class="rounded-xl border border-slate-200 px-3 py-2 sm:hidden" @click="open = !open" :aria-expanded="open" aria-controls="mobile-nav" aria-label="Abrir menu">☰</button>
    </div>
    <nav id="mobile-nav" x-cloak x-show="open" class="page-shell space-y-4 pb-5 sm:hidden" aria-label="Menu para celular">
        <a class="block" href="{{ route('home') }}#comunicacao" @click="open = false">O projeto</a><a class="block" href="{{ route('home') }}#faq" @click="open = false">Perguntas frequentes</a>
        @auth <a class="btn-primary" href="{{ route('dashboard') }}">Meu painel</a>
        @else <a class="mr-5 font-semibold" href="{{ route('login') }}">Entrar</a><a class="btn-primary" href="{{ route('register') }}">Participe</a> @endauth
    </nav>
</header>
<main id="conteudo">@yield('content')</main>
<x-site-footer />
</body>
</html>
