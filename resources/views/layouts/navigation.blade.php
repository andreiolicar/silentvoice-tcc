<nav class="border-b border-slate-200 bg-white" x-data="{ open: false }" aria-label="Navegação da conta">
<div class="page-shell flex min-h-20 flex-wrap items-center justify-between gap-5 py-4">
    <a href="{{ route('home') }}" aria-label="SilentVoice — início"><x-application-logo /></a>
    <div class="hidden items-center gap-6 text-sm sm:flex">
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'font-bold text-brand-800' : 'text-slate-600' }}">Painel</a>
        @if(auth()->user()->is_admin)<a href="{{ route('admin.interessados.index') }}" class="{{ request()->routeIs('admin.*') ? 'font-bold text-brand-800' : 'text-slate-600' }}">Interessados</a>@endif
        <a href="{{ route('profile.edit') }}" class="text-slate-600">Meu perfil</a>
        <form method="POST" action="{{ route('logout') }}">@csrf<button class="btn-secondary py-2" type="submit">Sair</button></form>
    </div>
    <button type="button" class="rounded-xl border border-slate-200 px-3 py-2 sm:hidden" @click="open = !open" :aria-expanded="open" aria-controls="account-nav" aria-label="Abrir menu">☰</button>
</div>
<div id="account-nav" x-cloak x-show="open" class="page-shell space-y-4 pb-5 text-sm sm:hidden"><a class="block" href="{{ route('dashboard') }}">Painel</a>@if(auth()->user()->is_admin)<a class="block" href="{{ route('admin.interessados.index') }}">Interessados</a>@endif<a class="block" href="{{ route('profile.edit') }}">Meu perfil</a><form method="POST" action="{{ route('logout') }}">@csrf<button type="submit">Sair da conta</button></form></div>
</nav>
