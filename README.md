# SilentVoice — Laravel Breeze / TCC

Site de apresentação do projeto **SilentVoice**, com cadastro de interessados e administração de contas. O público inclui possíveis usuários, investidores e outras pessoas interessadas na proposta de comunicação assistiva.

**Repositório:** [github.com/andreiolicar/silentvoice-tcc](https://github.com/andreiolicar/silentvoice-tcc)

O conteúdo, a marca e as imagens foram adaptados de [www.silentvoice.com.br](https://www.silentvoice.com.br/). O projeto acadêmico implementa o site e o CRUD de contas; o processamento biomédico, o dispositivo e o aplicativo apresentados são o tema institucional, e não funcionalidades implementadas neste sistema web.

![SilentVoice funcionando em localhost](docs/screenshots/01-home-localhost.png)

## Tecnologias

- Laravel **12.70.1**, PHP **8.2+** e Composer **2**.
- Laravel Breeze **2.4.2**, com autenticação por sessão.
- Blade, Tailwind CSS **3**, Alpine.js e Vite.
- SQLite, migrations, seeders e Eloquent.
- PHPUnit: **43 testes passando, com 170 verificações**.

Uma única aplicação MVC: as views Blade são o frontend; rotas, controllers, requests, middleware e Eloquent compõem o backend. Não há API ou frontend separado.

## Requisitos da atividade

| Exigência | Implementação |
| --- | --- |
| Laravel Breeze, Composer, Node.js e banco | Dependências registradas em `composer.json`, `package.json` e lockfiles; SQLite local |
| Login, registro, recuperação e dashboard | Rotas e controllers reais do Breeze, com telas em português |
| Rota fallback | `Route::fallback` no final de `routes/web.php`, com resposta HTTP 404 |
| Migrations e dependências frontend | Tabelas padrão do Laravel e migration dos campos de interesse; instalação por Composer e npm |
| Tailwind, Bootstrap ou Vue | Tailwind CSS, usando templates Blade |
| Controle de rotas com middleware | `auth` nas rotas da conta e `auth` + `admin` na gestão de interessados |
| Seeders ou CRUD com 10 registros | Seeder com 10 interessados fictícios e 1 administrador |
| Conteúdo do TCC na home e painel | Mesmo componente `project-overview` na página inicial e no dashboard |
| GitHub, explicação e prints | Este repositório, o README e a galeria de evidências abaixo |

## Executar em localhost

Pré-requisitos: PHP 8.2 ou superior, Composer 2, Node.js 22 ou superior e npm. O PHP deve ter as extensões usuais do Laravel, incluindo `pdo_sqlite`, `mbstring`, `openssl`, `fileinfo`, `curl`, `dom` e `xml`. Não é necessário iniciar o MySQL do XAMPP.

No PowerShell, CMD ou terminal, execute:

```bash
git clone https://github.com/andreiolicar/silentvoice-tcc.git
cd silentvoice-tcc
composer install
php -r "file_exists('.env') || copy('.env.example', '.env');"
php artisan key:generate
php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite');"
php artisan migrate --seed
npm ci
npm run build
php artisan serve
```

Acesse **[http://localhost:8000](http://localhost:8000)**. O banco é criado em `database/database.sqlite`. O arquivo `.env.example` já configura SQLite e o idioma português.

No Windows, caso o PowerShell bloqueie `npm.ps1`, use `npm.cmd ci` e `npm.cmd run build`.

O build gera os arquivos frontend antes de iniciar o servidor, portanto basta manter `php artisan serve` em execução. Para editar o frontend com atualização automática, use `composer run dev`, que inicia somente Laravel e Vite.

### Contas de demonstração

| Papel | E-mail | Senha |
| --- | --- | --- |
| Administrador | `admin@silentvoice.test` | `SilentVoice123!` |
| Interessado | `interessado1@example.test` | `SilentVoice123!` |

Os outros interessados vão de `interessado2@example.test` a `interessado10@example.test`, com a mesma senha fictícia. Os três tipos de interesse estão representados.

Essas credenciais são públicas e exclusivas da demonstração local. Repetir `php artisan db:seed` restaura os dados e as senhas das contas de demonstração sem duplicar os registros.

## Funcionalidades e permissões

**Visitante:** consulta a apresentação, as tecnologias, o dispositivo, o aplicativo, os públicos e as sete perguntas frequentes. Pode criar uma conta, entrar e solicitar recuperação de senha.

**Interessado:** acessa o dashboard e consulta ou altera nome, e-mail, tipo de interesse e senha no próprio perfil. Pode excluir sua conta informando a senha atual. Não acessa contas de outras pessoas.

**Administrador:** vê o total de interessados e pode cadastrar, listar, consultar detalhes, editar e excluir interessados. Ao editar, deixar a senha em branco mantém a atual. A exclusão exige confirmação na interface.

As contas administrativas ficam fora do CRUD de interessados e não podem ser excluídas. O cadastro público e a edição de perfil não aceitam promoção a administrador. E-mails são únicos, senhas são armazenadas com hash e os formulários usam validação no servidor e CSRF.

### Rotas principais

| Rota | Acesso | Finalidade |
| --- | --- | --- |
| `/` | Público | Apresentação completa do projeto |
| `/register`, `/login`, `/forgot-password` | Visitante | Autenticação Breeze |
| `/dashboard` | Autenticado | Dados da própria conta e conteúdo institucional |
| `/profile` | Autenticado | Consultar, editar ou excluir a própria conta |
| `/admin/interessados` | Administrador | Listar e cadastrar interessados |
| `/admin/interessados/{id}` | Administrador | Consultar, atualizar e excluir interessado |
| Endereço inexistente | Público | Página 404 personalizada |

O interessado que tenta acessar a administração recebe HTTP **403**. O visitante é direcionado para o login. A verificação de e-mail não é obrigatória para acessar o painel.

## Banco de dados

A tabela `users` do Breeze foi reutilizada, sem uma segunda tabela de contas. Além dos campos padrão, a migration acrescenta:

| Campo | Tipo / regra |
| --- | --- |
| `interest_type` | `usuario`, `investidor` ou `outro`; nulo para administrador |
| `is_admin` | Booleano, falso por padrão; definido internamente |

Arquivos para consultar:

- [Migration dos usuários](database/migrations/0001_01_01_000000_create_users_table.php).
- [Migration dos campos de interesse](database/migrations/2026_10_26_000001_add_interest_fields_to_users_table.php).
- [Seeder com 10 interessados e 1 administrador](database/seeders/DatabaseSeeder.php).

```bash
php artisan migrate:status
php artisan db:seed
```

O banco local, `.env`, logs, `vendor` e `node_modules` não são versionados. O professor ou outro integrante consegue recriar o ambiente pelos comandos de instalação.

## Recuperação de senha no ambiente local

1. Abra `/forgot-password` e informe o e-mail de uma conta existente.
2. O Breeze gera a mensagem de recuperação usando `MAIL_MAILER=log` e processamento síncrono.
3. Abra `storage/logs/laravel.log` e procure por `reset-password`. Use o link da parte de texto da mensagem, com o token e o e-mail completos.
4. Acesse o link no navegador e defina a nova senha.

No PowerShell, é possível acompanhar o arquivo com `Get-Content storage/logs/laravel.log -Tail 120`. A mensagem fica no log; nenhum serviço externo de e-mail é necessário.

## Verificações e demonstração do backend

```bash
php artisan test
npm run build
php artisan route:list --path=admin
php docs/demo-crud.php
```

A suíte cobre autenticação Breeze, recuperação e alteração de senha, CRUD com persistência no banco, acesso de visitantes e interessados, proteção de administradores, isolamento do perfil, validação, e-mail duplicado, senha opcional, seeders repetíveis e fallback. Os testes usam **SQLite em memória**, separado do banco de demonstração.

O script [docs/demo-crud.php](docs/demo-crud.php) demonstra **CREATE, READ, UPDATE e DELETE** diretamente com Eloquent, dentro de uma transação. Ele usa uma conta fictícia temporária e confirma que a quantidade original de contas foi preservada. Só funciona nos ambientes `local` e `testing`.

As saídas reais da verificação estão em [docs/evidence](docs/evidence), incluindo o CRUD e a consulta das contas sem senhas. O [relatório HTML](docs/backend-evidence.html) reúne essas saídas e os trechos de código capturados nos prints. É um registro estático da execução, e não outra tela administrativa do sistema.

### Fluxo para apresentar o CRUD

1. Entre como administrador e abra **Interessados**.
2. Clique em **Novo interessado**, preencha os dados e cadastre uma conta fictícia.
3. Confira a mensagem de sucesso e os detalhes da conta criada.
4. Edite nome ou interesse; mantenha a senha vazia para demonstrar que ela é preservada.
5. Clique em **Excluir interessado**, confirme e observe a lista e a mensagem de sucesso.
6. Entre como interessado e abra **Meu perfil** para mostrar a gestão da própria conta.
7. Tente acessar `/admin/interessados` como interessado para demonstrar o middleware.

## Prints da aplicação em localhost

As imagens foram capturadas no navegador com a aplicação em `http://localhost:8000`, em 26/10/2026. O CRUD demonstrado nas imagens usa uma conta fictícia descartável. Os dez registros do seeder foram preservados.

### Cadastro, login e dashboard

![Cadastro de interessados](docs/screenshots/02-cadastro.png)
![Login Laravel Breeze](docs/screenshots/03-login.png)
![Dashboard administrativo com conteúdo do projeto](docs/screenshots/04-dashboard.png)

### Frontend — operações CRUD

**Consultar / listar interessados:**

![Listagem de interessados](docs/screenshots/05-crud-lista.png)

**Criar e consultar o resultado:**

![Formulário de criação preenchido](docs/screenshots/06-crud-criar.png)
![Conta cadastrada com sucesso](docs/screenshots/07-crud-detalhes.png)

**Editar e confirmar a atualização:**

![Formulário de edição](docs/screenshots/08-crud-editar.png)
![Resultado da atualização](docs/screenshots/09-crud-atualizado.png)

**Excluir com confirmação e consultar o resultado:**

![Confirmação de exclusão](docs/screenshots/10-crud-confirmacao-exclusao.png)
![Exclusão concluída e dez interessados preservados](docs/screenshots/11-crud-excluido.png)

### Banco — migrations e seeders

Os prints abaixo mostram o relatório dos comandos e consultas reais executados no ambiente local, disponível também em `docs/backend-evidence.html`.

![Migrations executadas e campos dos interessados](docs/screenshots/16-migrations.png)
![Banco com dez interessados, um administrador e seeder](docs/screenshots/17-banco-seeders.png)

### Backend — operações CRUD

![CREATE, READ, UPDATE e DELETE executados com Eloquent](docs/screenshots/18-backend-crud.png)

<details>
<summary>Ver controller, rotas e resultado da suíte de testes</summary>

![Controller e rotas protegidas do CRUD](docs/screenshots/19-backend-controller.png)
![Resultado real dos testes](docs/screenshots/20-testes.png)

</details>

<details>
<summary>Ver celular, perfil, recuperação de senha e páginas de erro</summary>

![Home em tela de celular](docs/screenshots/12-home-celular.png)
![Cadastro em tela de celular](docs/screenshots/13-cadastro-celular.png)
![Solicitação de recuperação de senha](docs/screenshots/14-recuperacao-senha.png)
![Fallback 404](docs/screenshots/15-fallback-404.png)
![Perfil do interessado](docs/screenshots/22-perfil-interessado.png)
![Acesso administrativo bloqueado pelo middleware](docs/screenshots/23-middleware-403.png)

</details>

[Ver captura da página inicial completa](docs/screenshots/21-home-completa.png).

## Créditos

Conteúdo institucional, logo e imagens: [SilentVoice](https://www.silentvoice.com.br/), utilizados como referência do TCC solicitado. Fonte Inter, de Rasmus Andersson, distribuída sob [SIL Open Font License](resources/fonts/OFL.txt). Laravel e Breeze são distribuídos sob licença MIT.
