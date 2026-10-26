<footer class="border-t border-slate-200 bg-white">
    <div class="page-shell flex flex-col gap-6 py-9 sm:flex-row sm:items-center sm:justify-between">
        <div><a href="{{ route('home') }}" aria-label="SilentVoice — início"><x-application-logo /></a>
            <p class="mt-3 text-sm text-slate-500">Sua intenção ganha voz. Mais autonomia para se comunicar.</p></div>
        <div class="text-sm sm:text-right"><a href="mailto:contato@silentvoice.com.br" class="font-semibold text-brand-800 hover:underline">contato@silentvoice.com.br</a>
            <p class="mt-2 text-slate-500">© {{ date('Y') }} SilentVoice · Projeto de TCC</p></div>
    </div>
</footer>
