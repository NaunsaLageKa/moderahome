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
            background: #F5F6FA;
            color: #111827;
            min-height: 100vh;
            display: flex;
        }
        .sidebar {
            width: 260px;
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
            background: #2563EB;
            color: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }
        .profile {
            text-align: center;
        }
        .avatar {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: #E0E7FF;
            margin: 0 auto 0.75rem;
            font-size: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .menu {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }
        .menu a {
            text-decoration: none;
            color: #4B5563;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
        }
        .menu a.active {
            background: #E0E7FF;
            color: #1E3A8A;
        }
        .menu a:hover {
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
            background: white;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            border: 1px solid #E5E7EB;
            width: 320px;
        }
        .cards {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        .card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
        }
        .section-title {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        .progress {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 1rem;
        }
        .progress-line {
            flex: 1;
            height: 4px;
            background: #E5E7EB;
            margin: 0 0.5rem;
            position: relative;
        }
        .progress-line::before {
            content: '';
            position: absolute;
            height: 100%;
            width: 50%;
            background: #2563EB;
            border-radius: 4px;
        }
        .order-history table {
            width: 100%;
            border-collapse: collapse;
        }
        .order-history th,
        .order-history td {
            text-align: left;
            padding: 0.75rem 0;
            border-bottom: 1px solid #F1F5F9;
            font-size: 0.95rem;
        }
        .status {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        .status.processing { background: #DFE7FF; color: #1D4ED8; }
        .status.completed { background: #DCFCE7; color: #15803D; }
        .status.cancelled { background: #FEE2E2; color: #B91C1C; }
        .wishlist-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid #F1F5F9;
        }
        .wishlist-item:last-child { border-bottom: none; }
        .wishlist-item strong { display: block; font-size: 0.95rem; }
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.25rem;
        }
        .product-card {
            background: white;
            border-radius: 16px;
            padding: 1rem;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }
        .product-image {
            width: 100%;
            height: 160px;
            border-radius: 12px;
            background-size: cover;
            background-position: center;
        }
        .btn {
            background: #2563EB;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 0.5rem 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }
        .btn:hover { background: #1D4ED8; }
        @media (max-width: 1024px) {
            body { flex-direction: column; }
            .sidebar { width: 100%; border-right: none; border-bottom: 1px solid #E5E7EB; flex-direction: row; flex-wrap: wrap; }
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
            <a class="active" href="#">Dashboard</a>
            <a href="#">My Orders</a>
            <a href="#">Wishlist</a>
            <a href="#">Recently Viewed</a>
            <a href="#">Profile Settings</a>
        </nav>
        <div class="sidebar-bottom">
            <a href="#" class="menu-link">Support</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="menu-link" style="background:none;border:none;width:100%;text-align:left;padding:0.75rem 1rem;border-radius:10px;cursor:pointer;">Logout</button>
            </form>
        </div>
    </aside>
    <main class="main">
        <header>
            <div>
                <p style="color:#6B7280;">Welcome back,</p>
                <h1 style="font-size:1.5rem;font-weight:700;">{{ Auth::user()->name ?? 'Guest' }}!</h1>
            </div>
            <input class="search" type="text" placeholder="Search orders, products..." />
        </header>

        <div class="cards">
            <div class="card">
                <div class="section-title">Track Your Order <small style="float:right;color:#2563EB;">Order #3065</small></div>
                <div class="progress">
                    <div>Order Placed</div>
                    <div class="progress-line"></div>
                    <div>Processing</div>
                    <div class="progress-line" style="opacity:0.3"></div>
                    <div>Shipped</div>
                    <div class="progress-line" style="opacity:0.1"></div>
                    <div>Delivered</div>
                </div>
            </div>

            <div class="card" style="display:grid;grid-template-columns:2fr 1fr;gap:1.5rem;">
                <div class="order-history">
                    <div class="section-title">Order History</div>
                    <table>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#3065</td>
                                <td>12/05/2024</td>
                                <td><span class="status processing">Processing</span></td>
                                <td>$150.00</td>
                            </tr>
                            <tr>
                                <td>#3061</td>
                                <td>08/05/2024</td>
                                <td><span class="status completed">Completed</span></td>
                                <td>$320.50</td>
                            </tr>
                            <tr>
                                <td>#3058</td>
                                <td>02/05/2024</td>
                                <td><span class="status completed">Completed</span></td>
                                <td>$89.99</td>
                            </tr>
                            <tr>
                                <td>#3055</td>
                                <td>25/04/2024</td>
                                <td><span class="status cancelled">Cancelled</span></td>
                                <td>$112.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <div class="section-title">Your Wishlist</div>
                    <div class="wishlist-item">
                        <div>
                            <strong>Modern Beige Sofa</strong>
                            <small>$899.00</small>
                        </div>
                        <span>♡</span>
                    </div>
                    <div class="wishlist-item">
                        <div>
                            <strong>Minimalist Floor Lamp</strong>
                            <small>$120.00</small>
                        </div>
                        <span>♡</span>
                    </div>
                    <div class="wishlist-item">
                        <div>
                            <strong>Oak Wood Coffee Table</strong>
                            <small>$250.00</small>
                        </div>
                        <span>♡</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="section-title">You Might Also Like</div>
            <div class="products-grid">
                <div class="product-card">
                    <div class="product-image" style="background-image:url('/images/products/armchair.jpg');"></div>
                    <strong>Elegant Armchair</strong>
                    <small style="color:#6B7280;">Perfect for any living room.</small>
                    <div style="display:flex;justify-content:space-between;align-items:center;">
                        <span style="font-weight:700;">$399</span>
                        <button class="btn">Add to Cart</button>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image" style="background-image:url('/images/products/desk.jpg');"></div>
                    <strong>Scandi-Style Sofa</strong>
                    <small style="color:#6B7280;">Comfort and style combined.</small>
                    <div style="display:flex;justify-content:space-between;align-items:center;">
                        <span style="font-weight:700;">$1,199</span>
                        <button class="btn">Add to Cart</button>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image" style="background-image:url('/images/products/round.jpg');"></div>
                    <strong>Wooden Bookshelf</strong>
                    <small style="color:#6B7280;">Organize your favorite reads.</small>
                    <div style="display:flex;justify-content:space-between;align-items:center;">
                        <span style="font-weight:700;">$180</span>
                        <button class="btn">Add to Cart</button>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image" style="background-image:url('/images/products/gray.jpg');"></div>
                    <strong>Velvet Accent Chair</strong>
                    <small style="color:#6B7280;">A touch of luxury.</small>
                    <div style="display:flex;justify-content:space-between;align-items:center;">
                        <span style="font-weight:700;">$249</span>
                        <button class="btn">Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>

