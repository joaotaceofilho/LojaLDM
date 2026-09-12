<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busca por blusa | Mercado Livre</title>
    <style>
        :root {
            --yellow: #ffe600;
            --blue: #3483fa;
            --green: #00a650;
            --ink: #333;
            --muted: #666;
            --line: #e5e5e5;
            --canvas: #ebebeb;
        }

        * { box-sizing: border-box; }
        body { margin: 0; color: var(--ink); background: var(--canvas); font: 13px Arial, Helvetica, sans-serif; }
        button, input { font: inherit; }
        a { color: inherit; text-decoration: none; }
        .topbar { background: var(--yellow); }
        .topbar-inner, .header-inner, .content { width: min(1200px, calc(100% - 32px)); margin: auto; }
        .topbar-inner { display: flex; align-items: center; gap: 28px; min-height: 96px; }
        .logo { display: flex; align-items: center; gap: 9px; min-width: 170px; color: #222; font-size: 22px; font-weight: 700; letter-spacing: -1px; }
        .logo-mark { display: grid; place-items: center; width: 42px; height: 42px; border-radius: 50%; background: #fff; box-shadow: 0 1px 2px #c6ae00; font-size: 24px; }
        .search { display: flex; flex: 1; height: 46px; max-width: 650px; border-radius: 4px; overflow: hidden; background: #fff; box-shadow: 0 1px 2px #c5b300; }
        .search input { width: 100%; border: 0; padding: 0 18px; outline: none; color: #555; font-size: 15px; }
        .search button { width: 54px; border: 0; border-left: 1px solid #eee; background: white; color: #777; font-size: 22px; cursor: pointer; }
        .account { margin-left: auto; font-size: 12px; white-space: nowrap; }
        .account strong { display: block; font-size: 13px; }
        .account span { color: #555; }
        .nav { background: var(--yellow); border-top: 1px solid rgba(0,0,0,.08); }
        .nav-inner { width: min(1200px, calc(100% - 32px)); margin: auto; display: flex; align-items: center; min-height: 42px; gap: 28px; color: #555; font-size: 12px; }
        .nav-inner span:first-child { color: #333; font-weight: 600; }
        .content { padding: 18px 0 52px; }
        .related { color: #777; font-size: 11px; margin-bottom: 13px; }
        .layout { display: grid; grid-template-columns: 190px 1fr; gap: 18px; }
        aside { padding-top: 4px; }
        .crumbs { color: #777; font-size: 11px; line-height: 1.7; }
        .crumbs strong { color: #333; display: block; font-size: 17px; }
        .result-count { font-size: 11px; color: #888; }
        .filter { border-bottom: 1px solid #ddd; padding: 15px 0; }
        .filter h3 { margin: 0 0 9px; font-size: 13px; }
        .filter label, .filter li { display: block; margin: 7px 0; color: #666; font-size: 12px; }
        .filter ul { list-style: none; padding: 0; margin: 0; }
        .tag { display: inline-block; padding: 5px 8px; border-radius: 3px; background: #fff; color: #777; font-size: 11px; }
        .more { color: var(--blue) !important; font-size: 11px !important; }
        .price-inputs { display: flex; gap: 5px; align-items: center; }
        .price-inputs input { width: 62px; padding: 7px; border: 1px solid #ccc; border-radius: 4px; background: #fff; font-size: 11px; }
        .results { min-width: 0; }
        .store-banner { display: grid; grid-template-columns: 220px 1fr; min-height: 120px; border-radius: 5px; background: #fff; box-shadow: 0 1px 2px #d0d0d0; overflow: hidden; }
        .store-info { display: flex; align-items: center; gap: 10px; padding: 17px; border-right: 1px solid #eee; }
        .store-avatar { display: grid; place-items: center; width: 58px; height: 58px; border: 1px solid #f2d8dd; border-radius: 50%; color: #d95e7f; text-align: center; font-size: 8px; font-weight: bold; }
        .store-info strong { display: block; font-size: 13px; }
        .store-info small { color: #777; font-size: 10px; }
        .visit { display: inline-block; margin-top: 8px; padding: 7px 9px; border-radius: 3px; background: #e8f0ff; color: var(--blue); font-size: 10px; font-weight: 700; }
        .deal-strip { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; padding: 9px 14px; }
        .deal { position: relative; display: flex; gap: 7px; align-items: center; overflow: hidden; background: #f5f5f5; }
        .deal img { width: 60px; height: 86px; object-fit: cover; }
        .deal b { position: absolute; top: 3px; right: 3px; padding: 3px; background: var(--green); color: white; font-size: 8px; }
        .deal span { color: #555; font-size: 10px; }
        .toolbar { display: flex; justify-content: flex-end; align-items: center; height: 52px; color: #555; font-size: 11px; }
        .toolbar select { margin-left: 5px; padding: 8px 28px 8px 10px; border: 1px solid #ccc; border-radius: 4px; background: #fff; color: #444; }
        .grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 12px; }
        .product { position: relative; min-width: 0; overflow: hidden; border-radius: 5px; background: #fff; box-shadow: 0 1px 2px #d0d0d0; transition: box-shadow .2s, transform .2s; }
        .product:hover { transform: translateY(-2px); box-shadow: 0 5px 14px #c8c8c8; }
        .product-image { position: relative; height: 230px; overflow: hidden; background: #f3f3f3; }
        .product-image img { width: 100%; height: 100%; object-fit: cover; }
        .badge { position: absolute; left: 8px; bottom: 7px; padding: 3px 5px; background: var(--blue); color: white; font-size: 9px; font-weight: 700; }
        .badge.orange { background: #ff6d00; }
        .product-info { min-height: 154px; padding: 10px; border-top: 1px solid #eee; }
        .product-name { display: -webkit-box; overflow: hidden; min-height: 33px; color: #444; line-height: 1.3; -webkit-box-orient: vertical; -webkit-line-clamp: 2; }
        .rating { margin: 6px 0; color: #555; font-size: 11px; }
        .rating b { color: var(--blue); }
        .old-price { color: #999; font-size: 10px; text-decoration: line-through; }
        .price { display: inline-block; margin-top: 2px; font-size: 20px; }
        .discount { margin-left: 5px; color: var(--green); font-size: 11px; font-weight: 700; }
        .shipping { margin-top: 5px; color: var(--green); font-size: 11px; font-weight: 700; }
        .section-title { margin: 28px 0 12px; font-size: 18px; font-weight: 400; }
        @media (max-width: 900px) { .account, .nav-inner span:nth-child(n+4) { display: none; } .grid { grid-template-columns: repeat(3, minmax(0, 1fr)); } .deal span { display: none; } }
        @media (max-width: 680px) { .topbar-inner { flex-wrap: wrap; gap: 10px; padding: 13px 0; } .logo { min-width: 130px; } .search { order: 3; flex-basis: 100%; } .layout { grid-template-columns: 1fr; } aside { display: none; } .store-banner { grid-template-columns: 1fr; } .store-info { border-right: 0; border-bottom: 1px solid #eee; } .deal-strip { grid-template-columns: repeat(4, 1fr); } .grid { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 9px; } .product-image { height: 190px; } .content { width: min(100% - 20px, 560px); } }
    </style>
</head>
<body>
    <main class="content">
        <div class="related">Buscas relacionadas: blusa roxa &nbsp;·&nbsp; blusa peplum &nbsp;·&nbsp; blusa tricot &nbsp;·&nbsp; blusa stitch &nbsp;·&nbsp; blusa babado</div>
        <div class="layout">
            <aside>
                <div class="crumbs">Calçados, Roupas e Bolsas<strong>Blusas</strong>
                    <span class="result-count">+9.999 resultados</span>
                </div>
                <div class="filter">
                    <span class="tag">Novo ×</span> 
                    <span class="tag">Adultos ×</span>
                </div>
                <div class="filter">
                    <h3>Tamanho</h3>
                    <label>P</label>
                    <label>M</label>
                    <label>G</label>
                    <label>XG</label>
                    <label>GG</label>
                    <label>XGG</label>
                    <a class="more" href="#">Mostrar mais</a>
                </div>
                <div class="filter">
                    <h3>Gênero</h3>
                    <label>Feminino</label>
                    <label>Masculino</label>
                </div>
                <div class="filter">
                    <h3>Categorias</h3>
                    <ul>
                        <li>Camisas</li>
                        <li>Bermudas e Shorts</li>
                        <li>Kimonos</li>
                        <li>Ternos</li>
                        <li>Agasalhos</li>
                        <li>Camisetas e Regatas</li>
                        <li>Calças</li>
                        <li>Moda fitness</li>
                        <li class="more">Mostrar mais</li>
                    </ul>
                </div>
                <div class="filter">
                    <h3>Marca</h3>
                    <ul>
                        <li>Melvee</li>
                        <li>Lupo</li>
                        <li>Dash</li>
                        <li>Mulher Única</li>
                        <li>Bold</li>
                        <li>Plez Store</li>
                        <li>Selene</li>
                        <li class="more">Mostrar mais</li>
                    </ul>
                </div>
                <div class="filter">
                    <h3>Preço</h3>
                    <div class="price-inputs">
                        <input placeholder="Mínimo">
                        <span>-</span>
                        <input placeholder="Máximo">
                    </div>
                </div>
            </aside>

            <section class="results">
                <div class="store-banner">
                    <div class="store-info">
                        <div class="store-avatar">PANTERA<br>ROSE</div>
                        <div><strong>PANTERA ROSE</strong><small>+3.800 seguidores</small><br>
                            <a class="visit" href="#">Ir para a loja</a>
                        </div>
                    </div>
                    <div class="deal-strip">
                        <div class="deal">
                            <img src="https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?auto=format&fit=crop&w=140&q=80" alt="Oferta de blusa preta">
                            <b>16% OFF</b>
                            <span>R$ 33,04</span>
                        </div>
                        <div class="deal">
                            <img src="https://images.unsplash.com/photo-1551488831-00ddcb6c6bd3?auto=format&fit=crop&w=140&q=80" alt="Oferta de roupas">
                            <b>56% OFF</b>
                            <span>R$ 35,37</span>
                        </div>
                        <div class="deal">
                            <img src="https://images.unsplash.com/photo-1583743814966-8936f37f3846?auto=format&fit=crop&w=140&q=80" alt="Oferta de camiseta">
                            <b>11% OFF</b>
                            <span>R$ 35,57</span>
                        </div>
                        <div class="deal">
                            <img src="https://images.unsplash.com/photo-1576566588028-4147f3842f27?auto=format&fit=crop&w=140&q=80" alt="Oferta de blusa vermelha">
                            <b>22% OFF</b>
                            <span>R$ 34,88</span>
                        </div>
                    </div>
                </div>
                <div class="toolbar">Ordenar por 
                    <select>
                        <option>Mais relevantes</option>
                        <option>Menor preço</option>
                        <option>Maior preço</option>
                    </select>
                </div>
                
                <div class="grid">
                    <article class="product">
                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1556821840-3a63f95609a7?auto=format&fit=crop&w=500&q=85" alt="Moletom preto">
                            <span class="badge">OFERTA IMPERDÍVEL</span>
                        </div>
                        <div class="product-info">
                            <div class="product-name">Moletom Plus Size Canguru Liso Básico Premium Várias Cores</div>
                            <div class="rating">★ 4.7</div>
                            <div class="old-price">R$ 63,00</div>
                            <span class="price">R$ 48,99</span>
                            <span class="discount">23% OFF</span>
                            <div class="shipping">Frete grátis & FULL</div>
                        </div>
                    </article>

                    <article class="product"><div class="product-image"><img src="https://images.unsplash.com/photo-1551028719-00167b16eac5?auto=format&fit=crop&w=500&q=85" alt="Blusa feminina preta"><span class="badge">OFERTA IMPERDÍVEL</span></div><div class="product-info"><div class="product-name">Blusa Feminina Segunda Pele Gola Alta com Abertura no Dedo</div><div class="rating">★ 4.8</div><div class="old-price">R$ 70,90</div><span class="price">R$ 38,80</span><span class="discount">45% OFF</span><div class="shipping">Frete grátis & FULL</div></div></article>
                    <article class="product"><div class="product-image"><img src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=500&q=85" alt="Camiseta feminina preta"><span class="badge">OFERTA IMPERDÍVEL</span></div><div class="product-info"><div class="product-name">Camiseta Feminina Algodão Ecológico Presidente Brasil Lula</div><div class="rating">★ 4.8</div><div class="old-price">R$ 55,00</div><span class="price">R$ 49,67</span><span class="discount">7% OFF no Pix</span><div class="shipping">Frete grátis</div></div></article>
                    <article class="product"><div class="product-image"><img src="https://images.unsplash.com/photo-1586790170083-2f9ceadc732d?auto=format&fit=crop&w=500&q=85" alt="Camiseta masculina preta"><span class="badge" style="background:#f5b400">⚡ 01:32:02</span></div><div class="product-info"><div class="product-name">Camiseta Masculina Básica Preta Algodão Mercado Livre Basics</div><div class="rating">★ 4.9</div><div class="old-price">R$ 55,00</div><span class="price">R$ 39,45</span><span class="discount">44% OFF</span><div class="shipping">Frete grátis</div></div></article>
                    <article class="product"><div class="product-image"><img src="https://images.unsplash.com/photo-1583744946564-b52d01e7f922?auto=format&fit=crop&w=500&q=85" alt="Blusa marrom"><span class="badge">OFERTA IMPERDÍVEL</span></div><div class="product-info"><div class="product-name">Cropped Halter Decote Gringa Frente Única Blusa Feminina</div><div class="rating">★ 4.5</div><div class="old-price">R$ 39,90</div><span class="price">R$ 21,90</span><span class="discount">25% OFF</span><div class="shipping">Frete grátis & FULL</div></div></article>
                    <article class="product"><div class="product-image"><img src="https://images.unsplash.com/photo-1610652492500-ded49ceeb378?auto=format&fit=crop&w=500&q=85" alt="Camisetas oversized"><span class="badge orange">ÚLTIMAS 3</span></div><div class="product-info"><div class="product-name">Kit 3 Regata Machão Oversized Masculina Lisa 100% Algodão BOLD</div><div class="rating">★ 4.6</div><div class="old-price">R$ 109,90</div><span class="price">R$ 63,92</span><span class="discount">41% OFF</span><div class="shipping">Frete grátis & FULL</div></div></article>
                    <article class="product"><div class="product-image"><img src="https://images.unsplash.com/photo-1551489186-cf8726f514f8?auto=format&fit=crop&w=500&q=85" alt="Moletom preto com capuz"><span class="badge">OFERTA IMPERDÍVEL</span></div><div class="product-info"><div class="product-name">Blusa De Tricô Waffle Com Capuz E Cordão Estilo Streetwear</div><div class="rating">★ 4.8</div><div class="old-price">R$ 52,90</div><span class="price">R$ 39,90</span><span class="discount">25% OFF</span><div class="shipping">Frete grátis & FULL</div></div></article>
                    <article class="product"><div class="product-image"><img src="https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?auto=format&fit=crop&w=500&q=85" alt="Moletom preto liso"><span class="badge">OFERTA IMPERDÍVEL</span></div><div class="product-info"><div class="product-name">Moletom Gola Careca Redonda Algodão Flanelado Super Unissex</div><div class="rating">★ 4.7</div><div class="old-price">R$ 79,90</div><span class="price">R$ 43,90</span><span class="discount">45% OFF</span><div class="shipping">Frete grátis & FULL</div></div></article>
                </div>
            </section>
        </div>
    </main>
</body>
</html>