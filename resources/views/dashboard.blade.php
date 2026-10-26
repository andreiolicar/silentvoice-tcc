<x-app-layout>
<x-slot name="header"><p class="eyebrow">{{ auth()->user()->is_admin ? 'Administração' : 'Sua conexão com o projeto' }}</p><h1 class="mt-2 text-2xl font-semibold tracking-tight">Olá, {{ auth()->user()->name }}.</h1></x-slot>
<div class="page-shell grid gap-6 py-8 md:grid-cols-2">
    <section class="panel"><p class="eyebrow">Minha conta</p><h2 class="mt-3 text-xl font-semibold">{{ auth()->user()->interestLabel() }}</h2><p class="mt-2 break-all text-sm text-slate-500">{{ auth()->user()->email }}</p><a href="{{ route('profile.edit') }}" class="mt-5 inline-flex text-sm font-semibold text-brand-800 hover:underline">Consultar e editar meu perfil →</a></section>
    @if(auth()->user()->is_admin)<section class="panel bg-brand-950 text-white"><p class="eyebrow text-brand-200">Comunidade SilentVoice</p><div class="mt-3 flex items-baseline gap-3"><span class="text-4xl font-medium">{{ $totalInteressados }}</span><h2 class="text-base text-brand-100">interessados cadastrados</h2></div><a href="{{ route('admin.interessados.index') }}" class="mt-5 inline-flex text-sm font-semibold text-white hover:underline">Gerenciar interessados →</a></section>
    @else<section class="panel"><p class="eyebrow">Obrigado por participar</p><h2 class="mt-3 text-xl font-semibold">Mais possibilidades começam com uma conexão.</h2><p class="body-copy mt-2">Conheça abaixo a proposta completa do SilentVoice ou fale com a equipe pelo e-mail de contato.</p></section>@endif
</div>
<section class="border-t border-slate-200 bg-white"><div class="page-shell py-7"><p class="eyebrow">Sobre o projeto</p><p class="mt-2 text-sm text-slate-500">Todas as informações institucionais, reunidas no seu painel.</p></div><x-project-overview :dashboard="true" /></section>
</x-app-layout>
