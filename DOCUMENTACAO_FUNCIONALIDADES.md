# Documentação das funcionalidades do projeto LDM

## 1. Visão geral

O LDM é uma aplicação web desenvolvida com Laravel, PHP, Blade, Vite e SQLite. Atualmente, o projeto possui uma base de catálogo de produtos com consulta, busca e cadastro.

A aplicação está preparada para evoluir para um e-commerce, mas funcionalidades como autenticação, carrinho, pagamento e pedidos ainda não fazem parte do fluxo implementado.

## 2. Funcionalidades disponíveis

### 2.1 Página inicial

A página inicial está disponível em `/`.

Ela:

- consulta os produtos cadastrados na tabela `product`;
- exibe nome, descrição, categoria e quantidade de cada produto;
- disponibiliza um link para o cadastro de novos produtos.

O carregamento é feito pelo método `index()` do controller `LDMcontroller`.

### 2.2 Busca de produtos

A busca está disponível por meio da barra de pesquisa do layout principal.

O formulário envia uma requisição `GET` para `/produtos` com o parâmetro `search`.

A busca procura o texto informado nas seguintes colunas:

- `name`;
- `marca`;
- `description`;
- `category`.

Os resultados são exibidos na mesma view da página inicial. A busca não diferencia a origem do resultado: produtos encontrados por nome, marca, descrição ou categoria aparecem na listagem padrão.

Exemplo de URL:

```text
/produtos?search=cafe
```

### 2.3 Cadastro de produto

A tela de cadastro está disponível em `/pagina/add`.

O formulário envia os dados por `POST` para a mesma URL. Antes da gravação, o controller valida os campos e cria o produto no banco de dados.

Campos do formulário:

| Campo | Tipo | Regras principais |
|---|---|---|
| `name` | texto | obrigatório, até 100 caracteres |
| `marca` | texto | obrigatório, até 100 caracteres |
| `qty` | número | obrigatório, inteiro maior ou igual a zero |
| `description` | texto longo | obrigatório |
| `category` | seleção | obrigatório, até 100 caracteres |
| `private` | booleano | enviado como `0` pelo formulário |

Após o cadastro, o usuário é redirecionado para a página inicial e recebe uma mensagem de sucesso na sessão.

### 2.4 Página de detalhes

A rota `/pagina/detallsProducts` exibe uma página de detalhes visual com imagens de exemplo.

No estado atual, essa página não recebe um produto específico nem consulta dados do banco. O nome da rota e do método permanece `detallsProducts`/`detalls` para acompanhar a implementação existente.

### 2.5 Página de produto por ID

A rota `/product/{id?}` exibe uma página de produto baseada no ID recebido na URL.

Exemplo:

```text
/product/5
```

Atualmente, a página apresenta o ID informado e uma imagem fixa. Ela ainda não consulta o produto correspondente no banco de dados.

## 3. Rotas principais

| Método | URL | Responsabilidade |
|---|---|---|
| `GET` | `/` | Lista todos os produtos |
| `GET` | `/produtos` | Busca produtos pelo parâmetro `search` |
| `GET` | `/pagina/add` | Exibe o formulário de cadastro |
| `POST` | `/pagina/add` | Valida e grava um novo produto |
| `GET` | `/pagina/detallsProducts` | Exibe a tela de detalhes visual |
| `GET` | `/product/{id?}` | Exibe a página de produto pelo ID informado |
| `GET` | `/contato` | Exibe a página de contato |
| `GET` | `/search` | Exibe a página de busca legada |

A rota de busca possui o nome `produtos` e pode ser referenciada nas views com:

```blade
{{ route('produtos') }}
```

## 4. Organização do código

### Backend

- `app/Http/Controllers/LDMcontroller.php`: controla a listagem, tela de cadastro e gravação de produtos.
- `app/Models/Product.php`: representa o produto e aponta para a tabela `product`.
- `routes/web.php`: registra as rotas da aplicação.
- `database/migrations/2026_09_06_212720_create_product_table.php`: cria a tabela de produtos.

### Frontend

- `resources/views/layouts/main.blade.php`: layout compartilhado, cabeçalho, busca e rodapé.
- `resources/views/welcome.blade.php`: listagem de produtos da página inicial.
- `resources/views/pagina/add.blade.php`: formulário de cadastro.
- `resources/views/pagina/detallsProducts.blade.php`: página visual de detalhes.
- `resources/views/product.blade.php`: página de produto por ID.
- `resources/css/`: estilos da aplicação.
- `resources/js/`: scripts do frontend.

## 5. Banco de dados

O model `Product` utiliza explicitamente a tabela singular `product`:

```php
protected $table = 'product';
```

A tabela contém as colunas:

- `id`;
- `name`;
- `marca`;
- `qty`;
- `description`;
- `category`;
- `private`;
- `created_at`;
- `updated_at`.

Os campos permitidos para atribuição em massa estão definidos no model por meio de `$fillable`.

## 6. Como executar o projeto

Requisitos:

- PHP 8.3 ou superior;
- Composer;
- Node.js e npm;
- banco SQLite configurado no ambiente.

Na raiz do projeto:

```bash
composer install
npm install
php artisan migrate
npm run build
php artisan serve
```

Depois, acesse:

```text
http://127.0.0.1:8000
```

Durante o desenvolvimento frontend, pode ser usado:

```bash
npm run dev
```

## 7. Validação e segurança do cadastro

O cadastro utiliza:

- token CSRF com `@csrf`;
- validação dos dados no controller;
- `$fillable` no model para controlar atribuição em massa;
- redirecionamento após a gravação para evitar reenvio acidental do formulário.

## 8. Limitações atuais e próximos incrementos

As seguintes funcionalidades ainda não estão implementadas ou estão apenas como protótipo visual:

- edição de produtos;
- exclusão de produtos;
- consulta real de detalhes por ID;
- paginação da listagem;
- filtros avançados;
- autenticação de usuários;
- carrinho de compras;
- favoritos;
- checkout e pagamento;
- controle de estoque;
- upload de imagens;
- mensagens visuais de validação na tela do formulário;
- testes automatizados específicos para cadastro e busca.

Para continuar a evolução, recomenda-se criar um `ProductController` com operações CRUD completas e adicionar testes de feature para as rotas de listagem, busca e cadastro.

## 9. Documentação arquivo por arquivo

Esta seção descreve os arquivos de código que participam da aplicação atual e como eles se comunicam.

### 9.1 Rotas

#### `routes/web.php`

É o ponto de entrada das requisições web. Importa `LDMcontroller` e `Product` e registra as rotas públicas.

Comunicações:

- `/` chama `LDMcontroller@index`;
- `/pagina/add` com `GET` chama `LDMcontroller@add`;
- `/pagina/add` com `POST` chama `LDMcontroller@store`;
- `/pagina/detallsProducts` chama `LDMcontroller@detalls`;
- `/produtos` consulta diretamente `Product` e retorna `welcome`;
- `/contato` retorna diretamente a view `contact`;
- `/product/{id?}` retorna diretamente a view `product` com o parâmetro `$id`;
- `/search` retorna diretamente a view `search` com o parâmetro `$busca`.

As rotas `/produtos`, `/contato`, `/product/{id?}` e `/search` usam closures, portanto não passam pelo controller.

#### `routes/console.php`

Registra o comando Artisan `inspire`. Não participa das requisições web nem se comunica com as views ou com `LDMcontroller`.

### 9.2 Controller e models

#### `app/Http/Controllers/LDMcontroller.php`

Controller responsável pelo fluxo principal de produtos.

Comunicações:

- importa o model `App\Models\Product`;
- `index()` chama `Product::all()` e envia `$dados` para `resources/views/welcome.blade.php`;
- `add()` retorna `resources/views/pagina/add.blade.php`;
- `store()` recebe o formulário `POST`, valida os campos, chama `Product::create($dados)` e redireciona para `/`;
- `detalls()` retorna `resources/views/pagina/detallsProducts.blade.php`.

#### `app/Models/Product.php`

Representa os produtos persistidos no banco.

Comunicações:

- usa o Eloquent do Laravel;
- aponta para a tabela `product` por meio de `$table`;
- permite a gravação dos campos definidos em `$fillable`;
- é usado por `LDMcontroller` e diretamente pela rota `/produtos`.

#### `app/Models/User.php`

Representa usuários autenticáveis e usa `UserFactory` para testes ou geração de dados.

No fluxo atual, não é chamado por nenhuma rota de `web.php`, pois autenticação ainda não foi implementada.

### 9.3 Views Blade

#### `resources/views/layouts/main.blade.php`

Layout compartilhado pelas páginas que usam `@extends('layouts.main')`.

Comunicações:

- recebe o título de cada view por `@yield('title')`;
- insere o conteúdo por `@yield('content')`;
- carrega `resources/css/app.css` com `@vite`;
- oferece links para `/`, `/product/5` e `/pagina/add`;
- o formulário de busca chama a rota nomeada `produtos` com método `GET`;
- é usado por `welcome`, `search`, `product`, `pagina/add` e `pagina/detallsProducts`.

#### `resources/views/welcome.blade.php`

View da página inicial e dos resultados de busca.

Comunicações:

- recebe a variável `$dados` de `LDMcontroller@index` ou da rota `/produtos`;
- percorre `$dados` e mostra `name`, `description`, `category` e `qty`;
- herda o layout `layouts.main`;
- contém o link para `/pagina/add`.

#### `resources/views/pagina/add.blade.php`

View do formulário de cadastro de produto.

Comunicações:

- é retornada por `LDMcontroller@add` na rota `GET /pagina/add`;
- envia os dados para `POST /pagina/add`, atendida por `LDMcontroller@store`;
- usa `@csrf` para proteção contra requisições falsificadas;
- envia os campos `name`, `marca`, `qty`, `description`, `category` e `private`.

#### `resources/views/pagina/detallsProducts.blade.php`

View de detalhes visuais. É retornada por `LDMcontroller@detalls` e herda `layouts.main`.

Atualmente exibe imagens fixas de `/img/toddy.jpg`; não recebe um produto nem consulta `Product`.

#### `resources/views/product.blade.php`

View acessada pela rota `/product/{id?}`.

Recebe `$id` diretamente da closure em `routes/web.php`, mostra o ID e apresenta imagem fixa. Ainda não se comunica com `Product`.

#### `resources/views/search.blade.php`

View acessada pela rota legada `/search`.

Recebe `$busca` diretamente da closure e mostra o texto pesquisado. Não executa consulta no banco e não é usada pelo formulário principal, que aponta para `/produtos`.

#### `resources/views/contact.blade.php`

View da página de contato, retornada diretamente pela rota `/contato`. Não passa pelo controller.

### 9.4 Banco de dados

#### `database/migrations/2026_09_06_212720_create_product_table.php`

Cria e remove a tabela `product`, usada pelo model `Product`.

Campos criados: `id`, `name`, `marca`, `qty`, `description`, `category`, `private`, `created_at` e `updated_at`.

#### `database/migrations/0001_01_01_000000_create_users_table.php`

Cria as tabelas `users`, `password_reset_tokens` e `sessions`. Dá suporte ao model `User`, mas não é usada pelas rotas atuais.

#### `database/migrations/0001_01_01_000001_create_cache_table.php`

Cria as tabelas usadas pelo cache baseado em banco. É infraestrutura do Laravel e não participa diretamente do fluxo de produtos.

#### `database/migrations/0001_01_01_000002_create_jobs_table.php`

Cria as tabelas de filas do Laravel. Não há jobs relacionados aos produtos no fluxo atual.

#### `database/factories/UserFactory.php`

Define dados falsos para criar usuários, principalmente em testes e seeders. Não é chamado pelo fluxo público atual.

#### `database/seeders/DatabaseSeeder.php`

Cria um usuário de teste quando o seeding é executado. Não cria produtos.

### 9.5 Configuração e inicialização

#### `bootstrap/app.php`

Cria a aplicação Laravel, conecta `routes/web.php` às rotas web e `routes/console.php` aos comandos Artisan, além de configurar a rota de saúde `/up`.

#### `bootstrap/providers.php`

Registra `AppServiceProvider` na inicialização da aplicação.

#### `app/Providers/AppServiceProvider.php`

Ponto reservado para registrar serviços e inicializações globais. Atualmente não altera o fluxo de rotas, controllers ou models.

#### `config/*.php`

Arquivos de configuração do Laravel para aplicação, banco, cache, sessão, filas, e-mail, arquivos, autenticação e logs. São consumidos pelo framework, não diretamente pelas views.

### 9.6 Frontend e arquivos públicos

#### `resources/css/app.css`

Arquivo principal de estilos processado pelo Vite. Atualmente importa Tailwind CSS e define fontes e origens de arquivos Blade.

#### `resources/css/contact.css`, `navbar.css` e `product.css`

Arquivos de estilos específicos existentes para contato, navegação e produto. Devem ser importados pelo bundle ou pelas views para terem efeito; o layout principal atualmente chama apenas `resources/css/app.css` via Vite.

#### `resources/js/app.js`

Entrada JavaScript do frontend. Atualmente não contém lógica de interação.

### 9.6 Arquivos da raiz e arquivos públicos

#### `artisan`

Script de linha de comando do Laravel. Executa migrations, testes, servidor local, listagem de rotas e outros comandos. Não é chamado diretamente por uma rota web.

#### `composer.json`

Define a versão do PHP, dependências Laravel, scripts de instalação, testes e build. O autoload conecta o namespace `App\` à pasta `app/` e `Tests\` à pasta `tests/`.

#### `package.json`

Define as dependências e scripts do frontend, incluindo `npm run dev` e `npm run build`, usados pelo Vite.

#### `vite.config.js`

Configura a compilação dos arquivos de `resources/` que são carregados nas views por `@vite`.

#### `phpunit.xml`

Configura a suíte de testes. Os testes usam SQLite em memória no ambiente de teste.

#### `.env` e `.env.example`

Definem configurações de ambiente, como conexão com banco, chave da aplicação, cache, sessão e filas. O Laravel lê esses valores por meio dos arquivos em `config/`.

#### `AGENTS.md` e `CLAUDE.md`

Arquivos de instruções e contexto para desenvolvimento assistido. Não participam da execução da aplicação.

#### `README.md`

Documento inicial do projeto Laravel. Atualmente contém a documentação padrão do framework; este arquivo é complementado por `DOCUMENTACAO_FUNCIONALIDADES.md`.

#### `ESTRUTURA_ECOMMERCE_LARAVEL.md`

Documento de planejamento da estrutura futura do e-commerce. Orienta possíveis áreas como carrinho, checkout, pedidos e painel administrativo, mas esses módulos ainda não estão implementados.

#### `public/index.php`

Front controller público. Recebe as requisições HTTP e inicializa a aplicação definida em `bootstrap/app.php`.

#### `public/robots.txt`

Instruções para robôs de busca. Não se comunica com rotas, controllers ou models.

#### `public/build/`

Contém os assets compilados e o manifesto gerado pelo Vite. É utilizado quando a aplicação roda com os arquivos frontend construídos.

#### `public/css/style.css` e `public/js/script.js`

Assets estáticos antigos. Não são carregados pelo layout principal atual.

#### `public/img/`

Armazena imagens públicas usadas pelas views, como `/img/toddy.jpg` em `product.blade.php` e `detallsProducts.blade.php`.

### 9.7 Arquivos de configuração

Os arquivos abaixo são lidos pelo framework conforme a necessidade. Eles não são chamados diretamente pelas rotas, mas sustentam a execução dos controllers e models:

- `config/app.php`: nome, ambiente, URL, fuso horário e idioma da aplicação;
- `config/auth.php`: providers e configuração de autenticação do model `User`;
- `config/cache.php`: driver e prefixos de cache;
- `config/database.php`: conexões SQLite e demais bancos disponíveis;
- `config/filesystems.php`: discos para arquivos públicos e privados;
- `config/logging.php`: canais e destino dos logs;
- `config/mail.php`: configuração de envio de e-mails;
- `config/queue.php`: conexão e processamento de filas;
- `config/services.php`: credenciais de serviços externos;
- `config/session.php`: driver e duração das sessões.

### 9.8 Testes

#### `tests/TestCase.php`

Classe base dos testes da aplicação. Estende o caso de teste do Laravel.

#### `tests/Feature/ExampleTest.php`

Teste de feature que acessa `/` e espera resposta HTTP `200`. Como a página inicial consulta produtos, o banco de testes precisa executar as migrations antes da requisição.

#### `tests/Unit/ExampleTest.php`

Teste unitário de exemplo da instalação Laravel. Não testa diretamente rotas, controllers ou produtos.

## 10. Fluxos de comunicação

### Fluxo da página inicial

```text
GET /
	-> routes/web.php
	-> LDMcontroller@index
	-> Product::all()
	-> tabela product
	-> welcome.blade.php ($dados)
	-> layouts/main.blade.php
```

### Fluxo de busca

```text
Formulário em layouts/main.blade.php
	-> GET /produtos?search=...
	-> closure em routes/web.php
	-> Product::where(...)->orWhere(...)
	-> tabela product
	-> welcome.blade.php ($dados)
	-> layouts/main.blade.php
```

### Fluxo de cadastro

```text
GET /pagina/add
	-> routes/web.php
	-> LDMcontroller@add
	-> pagina/add.blade.php

POST /pagina/add
	-> pagina/add.blade.php
	-> routes/web.php
	-> LDMcontroller@store
	-> validação da Request
	-> Product::create($dados)
	-> tabela product
	-> redirect('/')
```

### Fluxos sem controller

```text
GET /contato
	-> routes/web.php
	-> contact.blade.php

GET /product/{id?}
	-> routes/web.php
	-> product.blade.php ($id)

GET /search
	-> routes/web.php
	-> search.blade.php ($busca)
```

## 11. Resumo das dependências

| Arquivo de origem | Comunica-se com | Forma da comunicação |
|---|---|---|
| `routes/web.php` | `LDMcontroller` | chamadas de métodos por rota |
| `routes/web.php` | `Product` | consulta direta na busca |
| `LDMcontroller` | `Product` | consulta, validação e criação |
| `LDMcontroller` | views Blade | `view()`, dados e redirecionamento |
| `welcome.blade.php` | `layouts/main.blade.php` | `@extends` |
| `add.blade.php` | `LDMcontroller@store` | formulário `POST` |
| `main.blade.php` | `/produtos` | formulário `GET` nomeado |
| `Product` | tabela `product` | Eloquent |
| `bootstrap/app.php` | arquivos de rotas | configuração da aplicação |
| `main.blade.php` | `resources/css/app.css` | diretiva `@vite` |
