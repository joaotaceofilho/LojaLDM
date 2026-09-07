# LDM Agent Instructions

## Language

- Responda ao usuário em português do Brasil, salvo pedido explícito em outro idioma.
- Mantenha textos visíveis da aplicação, mensagens de validação, comentários e documentação em português do Brasil.
- Preserve nomes de classes, métodos, variáveis e conceitos técnicos nas convenções do Laravel/PHP/JavaScript; não traduza APIs ou identificadores sem necessidade.
- Use `pt-BR`/`pt-br` de forma consistente com o arquivo que estiver sendo alterado; a interface Blade atual usa `lang="pt-br"`.

## Projeto

- É uma aplicação Laravel 13 com PHP 8.3+, Blade, Tailwind CSS 4 e Vite.
- Rotas web ficam em `routes/`, lógica PHP em `app/`, telas em `resources/views/`, estilos em `resources/css/` e JavaScript em `resources/js/`.
- Consulte [ESTRUTURA_ECOMMERCE_LARAVEL.md](ESTRUTURA_ECOMMERCE_LARAVEL.md) antes de criar novas áreas do e-commerce.
- Preserve a organização por responsabilidade e siga os padrões existentes antes de introduzir novas abstrações.

## Comandos

- Instale dependências com `composer install` e `npm install`.
- Execute a suíte PHP com `composer test` ou `php artisan test`.
- Gere os assets com `npm run build`; use `npm run dev` durante o desenvolvimento frontend.
- Antes de concluir alterações PHP, execute `vendor/bin/pint --test` quando aplicável.

## Implementação

- Prefira alterações pequenas e focadas, sem reformatar arquivos não relacionados.
- Para mudanças de interface, mantenha o português do Brasil e valide as versões desktop e mobile.
- Adicione ou ajuste testes para comportamento novo, priorizando `tests/Feature` para rotas e páginas.
