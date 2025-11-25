<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ModeraHome Dashboard</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: #F7F9FC;
            color: #111827;
            min-height: 100vh;
            display: flex;
        }
        .sidebar {
            width: 240px;
            background: white;
            border-right: 1px solid #E5E7EB;
            padding: 2rem 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }
        .brand {
            font-weight: 700;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
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
        }
        .profile {
            text-align: center;
        }
        .avatar {
            width: 76px;
            height: 76px;
            border-radius: 50%;
            background: #DBEAFE;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 0.5rem;
        }
        .menu {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }
        .menu a,
        .menu button {
            background: none;
            border: none;
            text-align: left;
            width: 100%;
            padding: 0.85rem 1rem;
            border-radius: 12px;
            color: #4B5563;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }
        .menu a.active {
            background: #E0E7FF;
            color: #1D4ED8;
        }
        .menu a:hover,
        .menu button:hover {
            background: #F3F4F6;
        }
        .sidebar-bottom {
            margin-top: auto;
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }
        .main {
            flex: 1;
            padding: 2rem 3rem;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .search {
            width: 320px;
            border-radius: 999px;
            border: 1px solid #E5E7EB;
            padding: 0.85rem 1.25rem;
            background: white;
        }
        .hero-card {
            background: white;
            border-radius: 24px;
            padding: 1.75rem;
            box-shadow: 0 15px 40px rgba(15, 23, 42, 0.08);
        }
        .hero-card h1 {
            font-size: 1.75rem;
            margin-bottom: 0.25rem;
        }
        .hero-card p {
            color: #6B7280;
            margin-bottom: 1.25rem;
        }
        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }
        .category-card {
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            height: 220px;
            box-shadow: 0 20px 30px rgba(15, 23, 42, 0.12);
        }
        .category-card::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(0,0,0,0) 40%, rgba(0,0,0,0.65));
        }
        .category-card h3 {
            position: absolute;
            bottom: 1.25rem;
            left: 1.5rem;
            color: white;
            font-size: 1.15rem;
            font-weight: 600;
            z-index: 2;
        }
        .category-card .image {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
        }
        .products-section {
            background: white;
            border-radius: 24px;
            padding: 1.75rem;
            box-shadow: 0 15px 40px rgba(15, 23, 42, 0.08);
        }
        .products-section h2 {
            margin-bottom: 1rem;
            font-size: 1.25rem;
        }
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 1.25rem;
        }
        .product-card {
            border-radius: 18px;
            background: #F9FAFB;
            padding: 1rem;
            box-shadow: inset 0 0 0 1px rgba(15,23,42,0.04);
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }
        .product-card .image {
            height: 150px;
            border-radius: 14px;
            background-size: cover;
            background-position: center;
        }
        .product-card .price {
            font-weight: 700;
        }
        .product-card button {
            border: none;
            background: #2563EB;
            color: white;
            border-radius: 999px;
            padding: 0.5rem 1rem;
            font-weight: 600;
            cursor: pointer;
            align-self: flex-start;
        }
        .product-card button:hover { background: #1D4ED8; }
        @media(max-width:1024px) {
            body { flex-direction: column; }
            .sidebar { width: 100%; border-right: none; border-bottom: 1px solid #E5E7EB; flex-direction: row; flex-wrap: wrap; gap: 1rem; }
            .main { padding: 1.5rem; }
            header { flex-direction: column; gap: 1rem; align-items: flex-start; }
            .search { width: 100%; }
        }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="brand"><span>🏠</span> ModeraHome</div>
        <div class="profile">
            <div class="avatar">{{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}</div>
            <strong>{{ Auth::user()->name }}</strong>
            <small style="color:#6B7280;">{{ Auth::user()->email }}</small>
        </div>
        <nav class="menu">
            <a href="#" class="active">Dashboard</a>
            <a href="#">Profile Settings</a>
            <a href="#">Recently Viewed</a>
        </nav>
        <div class="sidebar-bottom">
            <a href="#" class="menu">Support</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </aside>
    <main class="main">
        <header>
            <div>
                <h3 style="font-weight:600;">Dashboard</h3>
            </div>
            <div style="display:flex; gap:1rem; align-items:center;">
                <input class="search" type="text" placeholder="Search for furniture, styles, and more..." />
                <div style="width:42px;height:42px;border-radius:50%;background:white;border:1px solid #E5E7EB;display:flex;align-items:center;justify-content:center;">🔔</div>
            </div>
        </header>

        <div class="hero-card">
            <p style="color:#6B7280;">Hello, {{ Auth::user()->name ?? 'Guest' }}!</p>
            <h1>What are you looking for today?</h1>
            <p>Discover personalized recommendations curated just for you.</p>
            <div class="category-grid" style="margin-top:1.25rem;">
                <div class="category-card">
                    <div class="image" style="background-image:url('/images/categories/livingRoom.jpg');"></div>
                    <h3>Living Room</h3>
                </div>
                <div class="category-card">
                    <div class="image" style="background-image:url('/images/categories/bedroom.png');"></div>
                    <h3>Bedroom</h3>
                </div>
                <div class="category-card">
                    <div class="image" style="background-image:url('/images/categories/dish.jpg');"></div>
                    <h3>Dining</h3>
                </div>
                <div class="category-card">
                    <div class="image" style="background-image:url('/images/categories/office.png');"></div>
                    <h3>Office</h3>
                </div>
            </div>
        </div>

        <div class="products-section">
            <h2>You Might Also Like</h2>
            <div class="product-grid">
                <div class="product-card">
                    <div class="image" style="background-image:url('/images/products/wood).jpg');"></div>
                    <strong>Modern Oak Chair</strong>
                    <small style="color:#6B7280;">Sleek & comfortable</small>
                    <div style="display:flex;justify-content:space-between;align-items:center;">
                        <span class="price">$180</span>
                        <button>Add to Cart</button>
                    </div>
                </div>
                <div class="product-card">
                    <div class="image" style="background-image:url('/images/products/gray.jpg');"></div>
                    <strong>Velvet Accent Sofa</strong>
                    <small style="color:#6B7280;">Plush and luxurious</small>
                    <div style="display:flex;justify-content:space-between;align-items:center;">
                        <span class="price">$750</span>
                        <button>Add to Cart</button>
                    </div>
                </div>
                <div class="product-card">
                    <div class="image" style="background-image:url('/images/products/round.jpg');"></div>
                    <strong>Minimalist Coffee Table</strong>
                    <small style="color:#6B7280;">Clean and modern design</small>
                    <div style="display:flex;justify-content:space-between;align-items:center;">
                        <span class="price">$250</span>
                        <button>Add to Cart</button>
                    </div>
                </div>
                <div class="product-card">
                    <div class="image" style="background-image:url('/images/products/desk.jpg');"></div>
                    <strong>Industrial Bookshelf</strong>
                    <small style="color:#6B7280;">Wood and metal fusion</small>
                    <div style="display:flex;justify-content:space-between;align-items:center;">
                        <span class="price">$420</span>
                        <button>Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>

