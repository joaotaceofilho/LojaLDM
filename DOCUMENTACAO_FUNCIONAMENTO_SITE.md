# Documentação do funcionamento do site LDM

## 1. Visão geral

O LDM é uma aplicação de catálogo de produtos construída com Laravel 13, PHP, Blade, banco relacional, Vite, CSS e JavaScript. O fluxo atual permite:

- visualizar produtos no catálogo;
- pesquisar por nome, descrição, SKU, marca ou categoria;
- cadastrar produtos com marca, categoria, preço, estoque, descrição e imagens;
- abrir a página de detalhes de um produto específico;
- visualizar a galeria de imagens e produtos relacionados.

Carrinho, checkout, pagamento, autenticação e edição ou exclusão de produtos ainda não fazem parte do fluxo implementado.

## 2. Requisitos e execução

Requisitos mínimos:

- PHP 8.3 ou superior;
- Composer;
- Node.js e npm;
- banco de dados configurado no arquivo `.env`.

Na raiz do projeto:

```bash
composer install
npm install
php artisan migrate
php artisan storage:link
npm run build
php artisan serve
```

A aplicação fica disponível em `http://127.0.0.1:8000`.

Durante o desenvolvimento frontend, use:

```bash
npm run dev
```

## 3. Fluxos principais

### 3.1 Página inicial

URL: `/`

1. A requisição chega ao método `index()` de `LDMcontroller`.
2. O controller consulta os produtos com categoria, marca e imagens.
3. A view `welcome.blade.php` monta o catálogo.
4. O componente `components/cart-itens.blade.php` mostra a imagem principal do banco.
5. Se o produto não tiver imagem cadastrada, é usada uma imagem de fallback em `public/img/toddy.jpg`.
6. O botão `Ver produto` aponta para `/product/{id}`.

### 3.2 Busca de produtos

URL: `/pesquisa?search=termo`

A busca procura o termo em:

- `product.name`;
- `product.description`;
- `product.sku`;
- `brands.name`;
- `categories.name`.

A consulta considera apenas produtos com `active = true` e carrega as relações `category`, `brand` e `images`. Os resultados são exibidos na view `welcome.blade.php`, usando o mesmo componente do catálogo.

### 3.3 Cadastro de produto

Tela: `GET /pagina/add`

O controller carrega as marcas e categorias disponíveis e envia esses dados para `pagina/add.blade.php`.

Envio: `POST /pagina/add`

Campos principais:

| Campo | Obrigatório | Regra |
|---|---:|---|
| `name` | Sim | Texto com até 100 caracteres |
| `brand_id` | Sim | Deve existir em `brands` |
| `category_id` | Sim | Deve existir em `categories` |
| `price` | Sim | Número maior ou igual a zero |
| `qty` | Sim | Inteiro maior ou igual a zero |
| `description` | Sim | Texto |
| `private` | Sim | Booleano |
| `images[]` | Não | Até 10 imagens JPG, PNG ou WEBP, com até 5 MB cada |

Após a validação:

1. O slug é gerado automaticamente.
2. O produto é criado na tabela `product`.
3. Cada imagem é salva no disco `public`, em `storage/app/public/products/{id}`.
4. Cada arquivo gera um registro em `product_images`.
5. A primeira imagem recebe `is_main = true` e `position = 0`.
6. O usuário retorna para `/` com uma mensagem de sucesso.

Para exibir os arquivos no navegador, o link simbólico deve existir:

```bash
php artisan storage:link
```

### 3.4 Página de detalhes

URL principal: `/product/{product}`

O ID do produto é resolvido pelo model binding do Laravel. O controller carrega:

- produto;
- categoria;
- marca;
- imagens ordenadas pela imagem principal e pela posição;
- até três produtos ativos da mesma categoria.

A view `pagina/detallsProducts.blade.php` mostra:

- nome, preço, SKU e descrição;
- marca, categoria e estoque;
- imagem principal;
- miniaturas das demais imagens;
- produtos relacionados.

O arquivo `resources/js/detallsProducts.js` troca a imagem principal quando uma miniatura é selecionada. O CSS da tela fica em `resources/css/detalssProducts.css`.

A URL antiga `/pagina/detallsProducts` continua disponível. Quando acessada sem um produto, ela usa o primeiro produto ativo cadastrado.

## 4. Banco de dados

As principais tabelas são:

- `users`: usuários padrão do Laravel;
- `categories`: categorias dos produtos;
- `brands`: marcas dos produtos;
- `product`: dados principais do produto;
- `product_images`: imagens relacionadas ao produto;
- `product_variants`: variações de produto;
- `cache`, `cache_locks` e `jobs`: recursos internos do Laravel.

Relações principais:

- uma categoria possui muitos produtos;
- uma marca possui muitos produtos;
- um produto pertence a uma categoria;
- um produto pertence opcionalmente a uma marca;
- um produto possui muitas imagens;
- uma imagem pertence a um produto;
- um produto possui muitas variantes.

## 5. Validação e segurança

O cadastro utiliza:

- token CSRF com `@csrf`;
- validação no controller;
- validação de existência de marca e categoria;
- validação de tipo e tamanho dos arquivos;
- `$fillable` nos models;
- transação de banco para criar produto e imagens juntos;
- armazenamento público controlado pelo filesystem do Laravel.

## 6. Funcionalidades ainda pendentes

- autenticação de clientes e administradores;
- carrinho funcional;
- checkout e pagamento;
- pedidos e histórico de compras;
- edição e exclusão de produtos;
- filtros avançados;
- seleção de quantidade na compra;
- gerenciamento de imagens já cadastradas;
- avaliações reais de produtos.
