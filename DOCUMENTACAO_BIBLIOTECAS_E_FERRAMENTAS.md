# Bibliotecas e ferramentas utilizadas no LDM

## 1. Objetivo

Este documento lista as bibliotecas, frameworks, plugins e ferramentas utilizadas no projeto LDM, indicando onde são configurados e qual função exercem.

As dependências PHP são controladas por `composer.json` e `composer.lock`. As dependências JavaScript são controladas por `package.json` e `package-lock.json`.

## 2. Tecnologias principais

| Tecnologia | Versão configurada | Função |
|---|---|---|
| PHP | `^8.3` | Linguagem do backend |
| Laravel Framework | `^13.17` | Framework web principal |
| Blade | Incluído no Laravel | Templates HTML do frontend |
| Eloquent ORM | Incluído no Laravel | Comunicação com o banco por models |
| Vite | `^8.0.0` | Build e servidor de desenvolvimento frontend |
| Tailwind CSS | `^4.0.0` | Utilitários e integração de estilos |
| SQLite/MySQL/MariaDB/PostgreSQL/SQL Server | Conforme `.env` | Opções de banco suportadas |

## 3. Bibliotecas PHP de produção

As bibliotecas abaixo estão em `composer.json`, na seção `require`.

### Laravel Framework

Pacote: `laravel/framework`

Fornece os recursos principais do sistema:

- roteamento;
- controllers;
- middleware;
- Blade;
- validação;
- sessões;
- migrations;
- filas;
- cache;
- filesystem;
- Eloquent ORM;
- comandos Artisan;
- testes de aplicação.

Versão configurada: `^13.17`.

### Laravel Tinker

Pacote: `laravel/tinker`

Permite executar código da aplicação pelo terminal usando o REPL do Laravel. É útil para consultar models, testar relações e verificar dados:

```bash
php artisan tinker
```

Versão configurada: `^3.0`.

## 4. Bibliotecas PHP de desenvolvimento

As bibliotecas abaixo ficam em `require-dev` e são usadas durante desenvolvimento e testes.

### Faker

Pacote: `fakerphp/faker`

Gera dados fictícios para factories e testes.

Versão configurada: `^1.23`.

### Laravel Pail

Pacote: `laravel/pail`

Auxilia na visualização de logs da aplicação pelo terminal.

Versão configurada: `^1.2.5`.

### Laravel Pao

Pacote: `laravel/pao`

Ferramenta adicional do ecossistema Laravel incluída no ambiente de desenvolvimento.

Versão configurada: `^1.0.6`.

### Laravel Pint

Pacote: `laravel/pint`

Formatador de código PHP baseado nas regras do Laravel. Pode ser executado com:

```bash
vendor/bin/pint
```

Para apenas verificar sem alterar os arquivos:

```bash
vendor/bin/pint --test
```

Versão configurada: `^1.27`.

### Mockery

Pacote: `mockery/mockery`

Biblioteca para mocks e objetos simulados em testes PHP.

Versão configurada: `^1.6`.

### Collision

Pacote: `nunomaduro/collision`

Melhora a apresentação de erros e exceções no terminal durante comandos Artisan e testes.

Versão configurada: `^8.6`.

### PHPUnit

Pacote: `phpunit/phpunit`

Framework de testes automatizados utilizado pela suíte em `tests/`.

Versão configurada: `^12.5.12`.

Execução:

```bash
php artisan test
```

## 5. Bibliotecas JavaScript e frontend

As dependências abaixo estão em `package.json`, principalmente em `devDependencies`.

### Vite

Pacote: `vite`

Responsável por:

- compilar CSS e JavaScript;
- gerar o manifest em `public/build/manifest.json`;
- fornecer servidor de desenvolvimento;
- atualizar assets durante o desenvolvimento.

Comandos:

```bash
npm run dev
npm run build
```

Versão configurada: `^8.0.0`.

### Laravel Vite Plugin

Pacote: `laravel-vite-plugin`

Integra o Vite com o Laravel e permite carregar os assets pelo helper Blade `@vite(...)`.

As entradas do projeto são definidas em `vite.config.js`, incluindo:

- arquivos CSS gerais;
- `resources/css/detalssProducts.css`;
- `resources/js/detallsProducts.js`;
- scripts do catálogo e dos cards.

Versão configurada: `^3.1`.

### Tailwind CSS

Pacote: `tailwindcss`

Framework de estilos utilizado como parte da configuração frontend. A versão configurada é `^4.0.0`.

### Plugin Tailwind para Vite

Pacote: `@tailwindcss/vite`

Integra o Tailwind CSS ao pipeline do Vite.

Versão configurada: `^4.0.0`.

### Concurrently

Pacote: `concurrently`

Permite executar vários comandos simultaneamente, por exemplo servidor backend e frontend. Está disponível no projeto para scripts de desenvolvimento.

Versão configurada: `^10.0.3`.

### Laravel Multiplex

Pacote opcional: `@laravel/multiplex`

Dependência opcional para recursos de desenvolvimento relacionados à execução de processos Laravel.

Versão configurada: `^0.4.1`.

## 6. Plugin de fontes

### Laravel Vite Plugin Fonts

A configuração em `vite.config.js` utiliza o recurso `fonts` do `laravel-vite-plugin` com a fonte Instrument Sans.

Configuração atual:

- família: `Instrument Sans`;
- pesos: `400`, `500` e `600`;
- origem otimizada pelo plugin de fontes Bunny.

O build pode exibir um aviso sobre o pacote opcional `fontaine`. Esse aviso não impede a compilação, mas o pacote pode ser instalado caso seja necessário otimizar os fallbacks de fonte.

## 7. Ferramentas de execução

### Composer

Gerenciador de dependências PHP.

Comandos principais:

```bash
composer install
composer update
composer test
```

O arquivo `composer.lock` fixa as versões instaladas.

### npm

Gerenciador de dependências JavaScript.

Comandos principais:

```bash
npm install
npm run dev
npm run build
```

O arquivo `package-lock.json` fixa as versões instaladas.

### Artisan

CLI do Laravel, executada pelo arquivo `artisan`.

Comandos usados no projeto:

```bash
php artisan migrate
php artisan migrate:status
php artisan storage:link
php artisan view:cache
php artisan route:list
php artisan test
php artisan serve
```

### Git

Sistema de controle de versão usado para acompanhar alterações do projeto. O repositório possui a pasta `.git`.

Comandos úteis:

```bash
git status
git diff
git log
```

### Visual Studio Code

Editor utilizado para desenvolver e administrar o projeto. É utilizado para:

- editar PHP, Blade, CSS e JavaScript;
- executar comandos no terminal integrado;
- acompanhar erros de sintaxe;
- navegar entre referências dos arquivos;
- executar testes e build.

## 8. Ferramentas e serviços do navegador

### Vite no navegador

Durante desenvolvimento, o servidor do Vite fornece os assets e atualizações rápidas. Em produção ou após `npm run build`, o Laravel usa os arquivos gerados em `public/build`.

### JavaScript nativo

O projeto utiliza JavaScript sem framework frontend dedicado para interações específicas, como:

- troca de imagens na galeria de detalhes;
- carrossel do catálogo;
- comportamento dos cards.

### CSS

Os estilos são organizados em arquivos CSS próprios em `resources/css`. Não há uma biblioteca de componentes visuais externa registrada no `package.json`.

## 9. Armazenamento de imagens

O upload utiliza o filesystem nativo do Laravel:

- configuração: `config/filesystems.php`;
- disco usado: `public`;
- diretório físico: `storage/app/public`;
- URL pública: `/storage`;
- link simbólico: `public/storage`.

Comando necessário após configurar o projeto:

```bash
php artisan storage:link
```

## 10. Bancos suportados

O arquivo `config/database.php` possui configurações para:

- SQLite;
- MySQL;
- MariaDB;
- PostgreSQL;
- SQL Server.

A conexão ativa é definida por `DB_CONNECTION` no `.env`.

Exemplo local com SQLite:

```env
DB_CONNECTION=sqlite
```

Exemplo atual do ambiente de desenvolvimento do projeto:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ldm
DB_USERNAME=root
DB_PASSWORD=
```

## 11. Arquivos de configuração relacionados

| Arquivo | Responsabilidade |
|---|---|
| `composer.json` | Dependências PHP e scripts Composer |
| `composer.lock` | Versões exatas das dependências PHP |
| `package.json` | Dependências JavaScript e scripts npm |
| `package-lock.json` | Versões exatas das dependências JavaScript |
| `vite.config.js` | Entradas, plugins e servidor Vite |
| `config/database.php` | Conexões de banco |
| `config/filesystems.php` | Discos e armazenamento de arquivos |
| `.env` | Configurações locais e credenciais do ambiente |
| `.env.example` | Modelo de variáveis de ambiente |
| `phpunit.xml` | Configuração dos testes |

## 12. Checklist de instalação

```bash
composer install
npm install
copy .env.example .env
php artisan key:generate
php artisan migrate
php artisan storage:link
npm run build
php artisan test
```

No PowerShell, o comando equivalente para copiar o ambiente pode ser:

```powershell
Copy-Item .env.example .env
```

## 13. Resumo

A aplicação utiliza Laravel e PHP no backend, Blade para renderização, Eloquent para acesso ao banco, Vite para o frontend, Tailwind para integração de estilos, CSS e JavaScript nativos para a interface, PHPUnit para testes, Composer para dependências PHP e npm para dependências JavaScript.
