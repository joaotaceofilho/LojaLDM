# Estrutura de pastas para um site de e-commerce em Laravel

Este arquivo mostra as pastas que você vai trabalhar de verdade para montar um e-commerce. A ideia é manter a organização por responsabilidade: regras de negócio, telas, rotas, banco de dados e testes.

> Observação: não é necessário mexer em todas as pastas do Laravel. Foque nas áreas abaixo para começar.

---

## 1. app/

Responsável pela lógica do sistema.

### app/Http/Controllers
Use esta pasta para criar os controladores que recebem a requisição web e decidem o que mostrar ou salvar.

O que colocar aqui:
- HomeController
- ProductController
- CategoryController
- CartController
- CheckoutController
- OrderController
- AuthController
- Admin/ProductController
- Admin/OrderController

Função:
- listar produtos
- abrir página do produto
- adicionar ao carrinho
- finalizar pedido
- mostrar pedidos do cliente
- painel administrativo

### app/Models
Aqui ficam os modelos do banco, que representam as tabelas.

O que colocar aqui:
- User
- Product
- Category
- Order
- OrderItem
- Cart
- Coupon
- Review
- Payment

Função:
- definir relacionamentos
- regras de acesso aos dados
- métodos úteis como calcular preço, verificar estoque ou status do pedido

### app/Services
Use esta pasta para regras de negócio mais complexas, separadas dos controladores.

O que colocar aqui:
- ProductService
- CartService
- CheckoutService
- PaymentService
- ShippingService
- OrderService
- InventoryService

Função:
- validar estoque
- aplicar cupom de desconto
- calcular frete
- processar pagamento
- confirmar pedido

### app/Repositories (opcional, mas muito útil)
Pasta para separar acesso ao banco e consultas SQL/ORM.

O que colocar aqui:
- ProductRepository
- OrderRepository
- UserRepository
- CategoryRepository

Função:
- listar itens com filtros
- buscar produtos por categoria
- buscar pedidos por usuário
- centralizar acesso ao banco

### app/Providers
Aqui ficam os serviços registrados na aplicação.

O que colocar aqui:
- bindings de serviços
- configurações globais
- registro de eventos ou jobs
- inicializações customizadas

Função:
- registrar classes do carrinho
- registrar pagamento
- registrar cálculos de frete
- iniciar serviços do sistema

### app/Policies (opcional)
Controle de permissões.

O que colocar aqui:
- ProductPolicy
- OrderPolicy
- UserPolicy

Função:
- definir quem pode ver, editar ou excluir produtos/pedidos
- garantir segurança do painel administrativo

---

## 2. routes/

Responsável por definir as URLs do site e o que cada rota faz.

### routes/web.php
Pasta principal para as rotas públicas do site.

O que colocar aqui:
- página inicial
- listagem de produtos
- página do produto
- carrinho
- checkout
- login/cadastro
- conta do cliente
- painel admin

Exemplos de rotas:
- /
- /produtos
- /produto/{slug}
- /carrinho
- /checkout
- /meus-pedidos
- /admin/pedidos

### routes/api.php
Use quando o site tiver API para frontend moderno, mobile ou integração externa.

O que colocar aqui:
- endpoints para produtos
- busca de CEP
- integração com pagamento
- endpoints do painel/admin

---

## 3. resources/

Responsável pela parte visual do sistema.

### resources/views
Aqui ficam os arquivos Blade, que são as páginas HTML do site.

O que colocar aqui:
- layouts/
  - app.blade.php
  - admin.blade.php
- home.blade.php
- products/index.blade.php
- products/show.blade.php
- cart/index.blade.php
- checkout/index.blade.php
- auth/login.blade.php
- auth/register.blade.php
- account/orders.blade.php
- admin/products/index.blade.php
- admin/orders/index.blade.php

Função:
- renderizar as páginas do e-commerce
- mostrar catálogo, carrinho, checkout e painel

### resources/css
Aqui ficam os estilos do site.

O que colocar aqui:
- app.css
- home.css
- products.css
- cart.css
- checkout.css
- admin.css
- variables.css

Função:
- design do layout
- responsividade
- estilos dos botões, cards, banners, menus e checkout

### resources/js
Aqui ficam os scripts JavaScript do frontend.

O que colocar aqui:
- app.js
- cart.js
- search.js
- product-filters.js
- checkout.js
- admin.js

Função:
- adicionar itens ao carrinho sem recarregar
- atualizar quantidade
- busca dinâmica
- validação de formulário
- efeitos de interface

### resources/lang (opcional)
Use para tradução do sistema.

O que colocar aqui:
- mensagens de interface
- textos de botões e alerts
- tradução para português/inglês

---

## 4. config/

Aqui ficam as configurações gerais do aplicativo.

### config/app.php
Configuração principal da aplicação.

O que configurar aqui:
- nome da loja
- ambiente de desenvolvimento/produção
- fuso horário
- timezone
- locale

### config/database.php
Configuração do banco de dados.

O que configurar aqui:
- host
- banco
- usuário
- senha
- conexão com MySQL/PostgreSQL

### config/auth.php
Configuração de autenticação.

O que configurar aqui:
- login de cliente
- login de admin
- controle de sessão
- reset de senha

### config/filesystems.php
Configuração de upload de imagens e arquivos.

O que configurar aqui:
- imagens de produtos
- banners
- fotos de usuários
- armazenamento local ou S3

### config/services.php
Configuração de integrações externas.

O que configurar aqui:
- Stripe ou PagSeguro
- PayPal
- envio de e-mail
- integração com ERP ou logística

---

## 5. database/

Responsável por tudo relacionado ao banco e dados iniciais.

### database/migrations
Aqui ficam as tabelas do sistema.

O que criar aqui:
- users
- products
- categories
- orders
- order_items
- payments
- coupons
- reviews
- addresses
- carts

Função:
- criar estrutura do banco
- definir colunas, tipos e relações

### database/seeders
Use para popular o banco com dados iniciais.

O que colocar aqui:
- DatabaseSeeder
- UserSeeder
- CategorySeeder
- ProductSeeder
- AdminUserSeeder

Função:
- criar usuário admin
- criar categorias
- criar produtos de exemplo
- popular o site com dados para teste

### database/factories
Use para gerar dados fictícios para testes.

O que colocar aqui:
- ProductFactory
- UserFactory
- OrderFactory

Função:
- criar dados fake para testes automatizados

---

## 6. public/

Diretório público do Laravel e arquivos acessíveis pelo navegador.

### public/
O que colocar aqui:
- imagens do site
- logotipo
- favicons
- banners
- arquivos de build gerados pelo Vite

Função:
- expor imagens e assets para o frontend
- servir arquivos públicos diretamente

> Normalmente você não cria a lógica da aplicação aqui. Apenas arquivos públicos e assets finais.

---

## 7. storage/

Local de arquivos gerados pelo sistema e uploads do usuário.

### storage/app/public
Use aqui para imagens de produtos e arquivos enviados pelo cliente.

O que colocar aqui:
- imagens de produtos
- fotos de perfil
- arquivos de banners

### storage/framework
Arquivos do Laravel usados em cache, sessão e views.

Não precisa mexer manualmente na maioria das vezes.

### storage/logs
Logs de erro e atividades da aplicação.

Função:
- guardar erros
- registrar eventos importantes
- auxiliar na depuração

---

## 8. tests/

Diretório para validar o comportamento da aplicação.

### tests/Feature
Teste de fluxos reais do sistema.

O que testar aqui:
- cadastro de usuário
- visualização de produto
- adicionar ao carrinho
- finalizar compra
- login do admin
- fluxo de pedido

### tests/Unit
Teste de regras isoladas.

O que testar aqui:
- cálculo de desconto
- controle de estoque
- status do pedido
- validação de preço

---

## 9. bootstrap/

Pasta de inicialização da aplicação.

O que geralmente fica aqui:
- bootstrap/app.php
- providers e inicialização da app

Você raramente precisa mexer aqui, a menos que queira customizar a inicialização do sistema.

---

## 10. Pastas que você provavelmente vai usar primeiro

Para começar um e-commerce simples, as mais importantes são:

- app/Http/Controllers
- app/Models
- app/Services
- routes/web.php
- resources/views
- resources/css
- resources/js
- database/migrations
- database/seeders
- public/
- tests/Feature

---

## 11. Estrutura mínima sugerida para o projeto

Se você quiser começar organizado, a base do projeto pode ficar assim:

- app/
  - Http/Controllers/
  - Models/
  - Services/
- routes/
  - web.php
- resources/
  - views/
  - css/
  - js/
- database/
  - migrations/
  - seeders/
- public/
- tests/
- config/

---

## 12. Dica prática

Para um e-commerce, o ideal é separar assim:

- Controllers = recebem e respondem as requisições
- Models = representam o banco
- Services = pensam a regra de negócio
- Views = mostram a interface
- Migrations = criam tabelas
- Seeders = preenchem dados
- Tests = validam o funcionamento

Essa separação torna o projeto mais fácil de crescer e de manter.
