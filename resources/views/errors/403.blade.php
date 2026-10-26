@extends('layouts.public')
@section('content')
<section class="page-shell py-24 text-center"><p class="text-7xl font-medium tracking-tight text-brand-700">403</p><h1 class="mt-6 text-3xl font-semibold">Você não tem permissão para acessar esta página.</h1><p class="mt-4 text-slate-500">A gestão dos interessados é exclusiva do administrador.</p><a class="btn-primary mt-8" href="{{ route('dashboard') }}">Voltar ao painel</a></section>
@endsection
