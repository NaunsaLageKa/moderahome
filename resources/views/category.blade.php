<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $categoryData['title'] }} Furniture - ModeraHome</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: #F7F9FC;
            color: #0F172A;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        header {
            padding: 1.5rem 2.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: white;
            border-bottom: 1px solid #E2E8F0;
        }
        .brand {
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #1D4ED8;
        }
        .brand span {
            width: 36px;
            height: 36px;
            border-radius: 12px;
            background: #2563EB;
            color: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }
        .actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .actions a,
        .actions form button {
            border: none;
            border-radius: 999px;
            padding: 0.6rem 1.25rem;
            font-weight: 600;
            cursor: pointer;
        }
        .actions a {
            background: #E0E7FF;
            color: #1D4ED8;
            text-decoration: none;
        }
        .actions form button {
            background: #1D4ED8;
            color: white;
        }
        main {
            flex: 1;
            padding: 2.5rem;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }
        .hero {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            height: 360px;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.15);
        }
        .hero img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(120deg, rgba(15,23,42,0.8), rgba(15,23,42,0.4));
        }
        .hero-content {
            position: absolute;
            inset: 0;
            padding: 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            color: white;
            gap: 0.75rem;
        }
        .hero-content h1 {
            font-size: 2.5rem;
            font-weight: 700;
        }
        .hero-content p {
            max-width: 600px;
            font-size: 1.05rem;
            line-height: 1.6;
            color: rgba(255,255,255,0.85);
        }
        .products {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 1.5rem;
        }
        @media (max-width: 1200px) {
            .products { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        }
        @media (max-width: 900px) {
            .products { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }
        @media (max-width: 600px) {
            .products { grid-template-columns: repeat(1, minmax(0, 1fr)); }
        }
        .product-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(15, 23, 42, 0.08);
            display: flex;
            flex-direction: column;
            min-height: 360px;
        }
        .product-card.placeholder {
            align-items: center;
            justify-content: center;
            color: #94A3B8;
            font-style: italic;
            font-weight: 500;
        }
        .product-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }
        .product-info {
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            flex: 1;
        }
        .product-info h3 {
            font-size: 1.05rem;
            font-weight: 600;
            color: #0F172A;
        }
        .product-info p {
            color: #64748B;
            font-size: 0.95rem;
        }
        .product-footer {
            margin-top: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .product-footer span {
            font-weight: 700;
            color: #1D4ED8;
            font-size: 1.1rem;
        }
        .product-footer button {
            border: none;
            background: #1D4ED8;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 999px;
            cursor: pointer;
            font-weight: 600;
        }
        .breadcrumbs {
            font-size: 0.95rem;
            color: #475569;
        }
        .breadcrumbs a {
            color: #1D4ED8;
            text-decoration: none;
        }
        @media (max-width: 768px) {
            header { flex-direction: column; gap: 1rem; }
            main { padding: 1.5rem; }
            .hero-content h1 { font-size: 2rem; }
        }
    </style>
</head>
<body>
    <header>
        <div class="brand">
            <span>🏠</span> ModeraHome
        </div>
        <div class="actions">
            <a href="{{ route('dashboard') }}">Back to Dashboard</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </header>

    <main>
        <div class="breadcrumbs">
            <a href="{{ route('dashboard') }}">Dashboard</a> &nbsp;/&nbsp; {{ $categoryData['title'] }}
        </div>

        <section class="hero">
            <img src="{{ $categoryData['image'] }}" alt="{{ $categoryData['title'] }} hero image">
            <div class="hero-content">
                <p>Curated selection</p>
                <h1>{{ $categoryData['title'] }} Collection</h1>
                <p>Discover pieces chosen for comfort, aesthetics, and everyday living. Browse the latest designs and mix-and-match ideas to elevate your {{ strtolower($categoryData['title']) }}.</p>
            </div>
        </section>

        <section>
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem;">
                <h2 style="font-size:1.5rem;font-weight:700;">Featured {{ $categoryData['title'] }} Pieces</h2>
                <button style="border:none;background:#E0E7FF;color:#1D4ED8;padding:0.5rem 1rem;border-radius:999px;font-weight:600;cursor:pointer;">Filter</button>
            </div>
            @foreach ($products as $chunk)
                <div class="products" style="margin-bottom:1.5rem;">
                    @foreach ($chunk as $product)
                        @if ($product)
                            <article class="product-card">
                                <img src="{{ $product['image'] }}" alt="{{ $product['title'] }}">
                                <div class="product-info">
                                    <h3>{{ $product['title'] }}</h3>
                                    <p>{{ $product['desc'] }}</p>
                                    <div class="product-footer">
                                        <span>{{ $product['price'] }}</span>
                                        <button>Add to Cart</button>
                                    </div>
                                </div>
                            </article>
                        @else
                            <article class="product-card placeholder">
                                Coming soon
                            </article>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </section>
    </main>
</body>
</html>

