<x-guest-layout>
<p class="eyebrow">Bem-vindo de volta</p><h1 class="mt-3 text-3xl font-semibold tracking-tight">Entre na sua conta</h1><p class="mb-8 mt-3 text-sm text-slate-500">Acompanhe o projeto e gerencie seu cadastro.</p>
<x-auth-session-status class="mb-4" :status="session('status')" />
<form method="POST" action="{{ route('login') }}" class="space-y-5">@csrf
<div><x-input-label for="email" value="E-mail" /><x-text-input id="email" class="mt-2 block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" /><x-input-error :messages="$errors->get('email')" class="mt-2" /></div>
<div><div class="flex items-center justify-between gap-3"><x-input-label for="password" value="Senha" /><a href="{{ route('password.request') }}" class="text-xs font-semibold text-brand-800 hover:underline">Esqueci minha senha</a></div><x-text-input id="password" class="mt-2 block w-full" type="password" name="password" required autocomplete="current-password" /><x-input-error :messages="$errors->get('password')" class="mt-2" /></div>
<label class="flex items-center gap-2 text-sm text-slate-600"><input type="checkbox" name="remember" class="rounded border-slate-300 text-brand-700 focus:ring-brand-500"> Manter conectado</label>
<button class="btn-primary w-full justify-center" type="submit">Entrar <span aria-hidden="true">→</span></button>
</form><p class="mt-7 text-center text-sm text-slate-500">Ainda não participa? <a class="font-semibold text-brand-800 hover:underline" href="{{ route('register') }}">Crie sua conta</a></p>
</x-guest-layout>
