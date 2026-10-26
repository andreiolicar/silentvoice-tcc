<?php

// Execute na raiz do projeto: php docs/demo-crud.php
// Exemplo reproduzível de CRUD no backend, usando somente uma conta fictícia temporária.
require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

if (! $app->environment(['local', 'testing'])) {
    fwrite(STDERR, "Esta demonstração só pode ser executada em ambiente local ou de testes.\n");
    exit(1);
}

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

function mostrarEtapa(string $etapa, mixed $dados): void
{
    echo $etapa.PHP_EOL;
    echo json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES).PHP_EOL.PHP_EOL;
}

$totalAntes = User::count();

DB::transaction(function () {
    $conta = User::create([
        'name' => 'Demonstração Backend',
        'email' => 'demo.'.Str::uuid().'@example.test',
        'interest_type' => 'usuario',
        'password' => Str::random(32),
    ]);
    mostrarEtapa('CREATE — conta inserida', $conta->only('id', 'name', 'email', 'interest_type'));

    $consulta = User::findOrFail($conta->id);
    mostrarEtapa('READ — conta consultada no banco', $consulta->only('id', 'name', 'interest_type'));

    $conta->update(['name' => 'Demonstração Backend Atualizada', 'interest_type' => 'investidor']);
    mostrarEtapa('UPDATE — dados relidos após atualização', $conta->fresh()->only('id', 'name', 'interest_type'));

    $id = $conta->id;
    $conta->delete();
    mostrarEtapa('DELETE — ausência confirmada no banco', ['id' => $id, 'existe_no_banco' => User::whereKey($id)->exists()]);
});

$totalDepois = User::count();
if ($totalAntes !== $totalDepois) {
    throw new RuntimeException('A demonstração alterou a quantidade original de contas.');
}
mostrarEtapa('CONFERÊNCIA — contas originais preservadas', ['antes' => $totalAntes, 'depois' => $totalDepois]);
