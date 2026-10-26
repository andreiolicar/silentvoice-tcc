@props(['dashboard' => false])
<section class="overflow-hidden bg-brand-50" aria-labelledby="project-heading">
    <div class="page-shell grid items-center gap-10 pb-0 pt-12 lg:grid-cols-[1.1fr_1fr] lg:gap-12 lg:pt-16">
        <div class="pb-8 lg:pb-16">
            <p class="eyebrow"><span class="h-2 w-2 rounded-full bg-brand-500"></span> Revolução da fala assistiva</p>
            <{{ $dashboard ? 'h2' : 'h1' }} id="project-heading" class="mt-6 max-w-2xl text-[2.5rem] font-medium leading-[1.12] tracking-[-.045em] sm:text-5xl lg:text-[3.65rem]">
                A inteligência biomédica que <span class="text-brand-700">transforma intenções em fala</span> em tempo real.
            </{{ $dashboard ? 'h2' : 'h1' }}>
            <p class="mt-6 max-w-lg text-base leading-relaxed text-slate-600">Combinando EMG, visão computacional e IA de borda, o SilentVoice propõe decodificar microssinais musculares em palavras, com latência inferior a 300 ms.</p>
            <div class="mt-8 flex flex-wrap gap-3"><a href="#comunicacao" class="btn-primary">Conheça o projeto <span aria-hidden="true">↓</span></a>
                <a href="mailto:contato@silentvoice.com.br" class="btn-white">Fale com a equipe <span aria-hidden="true">↗︎</span></a></div>
            <p class="mt-8 flex items-center gap-2 text-xs font-medium uppercase tracking-widest text-brand-800"><span class="h-px w-8 bg-brand-500"></span> Tecnologia a favor da autonomia</p>
        </div>
        <div class="hero-art relative mx-auto w-full max-w-[480px] self-end">
            <div class="absolute inset-x-3 bottom-0 top-12 rounded-t-[130px] bg-brand-500"></div>
            <div class="absolute right-0 top-16 z-10 rounded-2xl border border-white/70 bg-white/90 px-4 py-3 shadow-sm"><span class="block text-[10px] font-bold uppercase tracking-widest text-slate-500">Uma nova conexão</span><span class="text-sm font-semibold text-brand-800">Sua intenção ganha voz.</span></div>
            <img src="{{ asset('images/hero.png') }}" class="relative mx-auto w-full" alt="Mulher mostrando o aplicativo SilentVoice em um celular" width="888" height="1220" fetchpriority="high">
        </div>
    </div>
</section>
<section class="border-b border-slate-200 bg-white" aria-label="SilentVoice em números">
    <dl class="page-shell grid grid-cols-2 gap-7 py-9 lg:grid-cols-4">
        @foreach (['3' => 'Tecnologias integradas', '01' => 'Dispositivo vestível', '1' => 'App para conectar', '100%' => 'Foco em autonomia'] as $number => $label)
        <div class="border-l-2 border-brand-100 pl-5"><dd class="text-3xl font-medium tracking-tight text-brand-800">{{ $number }}</dd><dt class="mt-1 text-sm text-slate-500">{{ $label }}</dt></div>
        @endforeach
    </dl>
</section>
<section id="comunicacao" class="page-shell section-space grid items-center gap-10 lg:grid-cols-2 lg:gap-20" aria-labelledby="communication-heading">
    <div class="overflow-hidden rounded-[2rem] bg-slate-50 p-6 sm:p-10"><img src="{{ asset('images/device.webp') }}" alt="Dispositivo vestível SilentVoice" class="w-full" width="1296" height="880" loading="lazy"></div>
    <div><p class="eyebrow">Comunicação assistiva</p><h2 id="communication-heading" class="section-title mt-4">Transforme suas intenções em fala, em tempo real.</h2>
        <p class="body-copy mt-5">O SilentVoice combina EMG, visão computacional e IA de borda para transformar intenções em palavras e ampliar as possibilidades de comunicação no dia a dia.</p>
        <ul class="mt-6 space-y-4 text-sm text-slate-700"><li class="check-item">Comunique-se com mais autonomia no dia a dia.</li><li class="check-item">Transforme sinais musculares em fala em tempo real.</li></ul>
        <a href="{{ auth()->check() ? route('profile.edit') : route('register') }}" class="mt-7 inline-flex items-center gap-3 font-semibold text-brand-800 hover:underline">Quero acompanhar o projeto <span aria-hidden="true">↗︎</span></a>
    </div>
</section>
<section class="bg-slate-50 py-12" aria-label="Tecnologias do projeto"><div class="page-shell grid gap-6 md:grid-cols-3">
    @foreach ([['01', 'EMG', 'Captação de microssinais musculares que participam da intenção de fala.'], ['02', 'Visão computacional', 'Informações visuais complementam a interpretação dos sinais.'], ['03', 'IA de borda', 'Processamento próximo ao dispositivo para apoiar a comunicação em tempo real.']] as [$number, $title, $text])
    <article class="rounded-2xl border border-slate-200 bg-white p-7"><span class="text-xs font-semibold tracking-widest text-brand-700">{{ $number }} / TECNOLOGIA</span><h3 class="mt-4 text-xl font-semibold">{{ $title }}</h3><p class="mt-3 text-sm leading-relaxed text-slate-500">{{ $text }}</p></article>
    @endforeach
</div></section>
<section id="aplicativo" class="page-shell section-space grid items-center gap-10 lg:grid-cols-2 lg:gap-20" aria-labelledby="app-heading">
    <div><p class="eyebrow">Conectado a você</p><h2 id="app-heading" class="section-title mt-4">Seu celular, um centro de acessibilidade e voz.</h2>
        <p class="body-copy mt-5">Conecte o SilentVoice ao seu celular e tenha a comunicação ao seu alcance, com mais autonomia em cada conversa.</p>
        <ul class="mt-6 space-y-4 text-sm text-slate-700"><li class="check-item">Conecte seu dispositivo em poucos toques.</li><li class="check-item">Leve sua voz e suas conexões para onde você for.</li></ul>
        <a href="mailto:contato@silentvoice.com.br" class="mt-7 inline-flex items-center gap-3 font-semibold text-brand-800 hover:underline">Saiba mais sobre o aplicativo <span aria-hidden="true">↗︎</span></a>
    </div>
    <div class="overflow-hidden rounded-[2rem] bg-brand-50"><img src="{{ asset('images/app.webp') }}" alt="Celular com o aplicativo e dispositivo SilentVoice" class="mx-auto max-h-[430px] w-full object-contain" width="1080" height="1080" loading="lazy"></div>
</section>
<section id="para-quem" class="bg-brand-950 py-16 text-white" aria-labelledby="audience-heading"><div class="page-shell">
    <div class="mb-10 flex flex-col justify-between gap-5 sm:flex-row sm:items-end"><div><p class="eyebrow text-brand-200">Pessoas no centro</p><h2 id="audience-heading" class="section-title mt-4">Mais voz. Mais possibilidades.</h2></div><p class="max-w-sm text-sm leading-relaxed text-brand-100">Na comunicação, no cuidado e em cada pequena conexão do dia a dia.</p></div>
    <div class="grid gap-5 md:grid-cols-3">@foreach ([['Para quem usa', 'Sua intenção ganha voz.', 'Transforme sinais em palavras e se comunique com mais autonomia.'], ['Para quem cuida', 'Cada conversa aproxima.', 'Mais possibilidades de cuidado e conexão em cada conversa.'], ['Para o dia a dia', 'Tecnologia que acompanha você.', 'EMG, visão computacional e IA de borda transformam intenção em fala.']] as [$title, $lead, $text])
        <article class="rounded-2xl border border-white/15 bg-white/5 p-7"><h3 class="text-sm font-medium text-brand-200">{{ $title }}</h3><p class="mt-5 text-xl font-medium">{{ $lead }}</p><p class="mt-3 text-sm leading-relaxed text-brand-100">{{ $text }}</p></article>
    @endforeach</div>
</div></section>
<section id="faq" class="page-shell section-space grid gap-10 lg:grid-cols-[.8fr_1.2fr] lg:gap-20" aria-labelledby="faq-heading">
    <div><p class="eyebrow">Perguntas frequentes</p><h2 id="faq-heading" class="section-title mt-4">Ainda tem dúvidas?</h2><p class="body-copy mt-5">Conheça a proposta e converse com quem está construindo o SilentVoice.</p><a class="btn-primary mt-7" href="mailto:contato@silentvoice.com.br">Fale com a equipe <span aria-hidden="true">↗︎</span></a></div>
    <div class="divide-y divide-slate-200 border-y border-slate-200">
        @foreach ([
            ['O que é o SilentVoice?', 'O SilentVoice é uma solução de comunicação assistiva que transforma intenções em fala em tempo real. Combinando EMG, visão computacional e IA de borda, ele decodifica microssinais musculares em palavras e amplia as possibilidades de comunicação no dia a dia.'],
            ['Como o SilentVoice funciona?', 'A tecnologia combina sinais de EMG, visão computacional e inteligência artificial de borda. Esses recursos trabalham juntos para interpretar microssinais musculares e transformá-los em palavras.'],
            ['Para quem ele foi pensado?', 'Para quem busca mais autonomia na comunicação e para quem acompanha seu cuidado. A proposta é ampliar as possibilidades de conversa e conexão no dia a dia.'],
            ['A resposta acontece em tempo real?', 'O SilentVoice foi pensado para transformar intenções em fala em tempo real, com latência inferior a 300 ms, conforme a proposta apresentada pelo projeto.'],
            ['O SilentVoice é um dispositivo vestível?', 'Sim. A solução inclui um dispositivo vestível, que faz parte da experiência de comunicação assistiva do SilentVoice. Você pode conhecer seu design na seção de comunicação acima.'],
            ['É preciso estar conectado à internet?', 'A solução utiliza IA de borda. Para conhecer os requisitos de conexão e as condições de uso do dispositivo, fale com a equipe.'],
            ['Como posso conhecer melhor o SilentVoice?', 'Escreva para contato@silentvoice.com.br para tirar dúvidas sobre disponibilidade, demonstrações e detalhes de uso. A equipe pode ajudar você a conhecer a proposta do SilentVoice.']
        ] as [$question, $answer])
        <details class="group py-5" {{ $loop->first ? 'open' : '' }}><summary class="flex cursor-pointer list-none items-center justify-between gap-5 font-medium">{{ $question }}<span aria-hidden="true" class="text-xl font-normal text-brand-700 group-open:rotate-45">+</span></summary><p class="mt-4 pr-5 text-sm leading-relaxed text-slate-500">{{ $answer }}</p></details>
        @endforeach
    </div>
</section>
<section class="page-shell pb-16"><div class="flex flex-col items-start justify-between gap-6 rounded-[2rem] bg-brand-50 p-8 sm:flex-row sm:items-center sm:p-12"><div><p class="eyebrow">Faça parte dessa conversa</p><h2 class="mt-3 text-2xl font-semibold tracking-tight sm:text-3xl">Um futuro com mais formas de se comunicar.</h2><p class="mt-3 text-sm text-slate-600">Possíveis usuários, investidores e pessoas que acreditam no projeto.</p></div><a class="btn-primary shrink-0" href="{{ auth()->check() ? route('profile.edit') : route('register') }}">{{ auth()->check() ? 'Minha conta' : 'Quero participar' }} <span aria-hidden="true">↗︎</span></a></div></section>
