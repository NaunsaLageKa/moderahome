<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ModeraHome - Modern Furniture for Your Home</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: #333;
        }
        
        /* Header */
        .header {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }
        
        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .logo-icon {
            width: 32px;
            height: 32px;
            background: #3B82F6;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        
        .logo-text {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1F2937;
        }
        
        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }
        
        .nav-links a {
            text-decoration: none;
            color: #6B7280;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .nav-links a:hover {
            color: #1F2937;
        }
        
        .nav-buttons {
            display: flex;
            gap: 1rem;
        }
        
        .btn-login {
            background: none;
            border: none;
            color: #6B7280;
            font-weight: 500;
            cursor: pointer;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: all 0.3s;
        }
        
        .btn-login:hover {
            background: #F3F4F6;
        }
        
        .btn-register {
            background: #3B82F6;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-register:hover {
            background: #2563EB;
        }
        
        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            padding: 8rem 2rem 4rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .hero-content {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }
        
        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }
        
        .hero p {
            font-size: 1.25rem;
            color: white;
            margin-bottom: 2rem;
            text-shadow: 0 1px 2px rgba(0,0,0,0.3);
        }
        
        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .btn-explore {
            background: #3B82F6;
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-explore:hover {
            background: #2563EB;
            transform: translateY(-2px);
        }
        
        .btn-account {
            background: rgba(255,255,255,0.2);
            color: white;
            border: 1px solid rgba(255,255,255,0.3);
            padding: 1rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-account:hover {
            background: rgba(255,255,255,0.3);
        }
        
        /* Why Section */
        .why-section {
            padding: 4rem 2rem;
            background: white;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            color: #1F2937;
            margin-bottom: 1rem;
        }
        
        .section-subtitle {
            text-align: center;
            font-size: 1.125rem;
            color: #6B7280;
            margin-bottom: 3rem;
        }
        
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .feature {
            text-align: center;
            padding: 2rem;
        }
        
        .feature-icon {
            width: 60px;
            height: 60px;
            background: #3B82F6;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 1.5rem;
        }
        
        .feature h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1F2937;
            margin-bottom: 0.5rem;
        }
        
        .feature p {
            color: #6B7280;
            line-height: 1.6;
        }
        
        /* Testimonials */
        .testimonials {
            background: #F8FAFC;
            padding: 4rem 2rem;
        }
        
        .testimonial {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            margin: 1rem 0;
            font-style: italic;
            color: #4B5563;
        }
        
        .testimonial-author {
            font-weight: 600;
            color: #1F2937;
            margin-top: 1rem;
        }
        
        /* Categories */
        .categories {
            padding: 4rem 2rem;
            background: white;
        }
        
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }
        
        .category-card {
            background: #F8FAFC;
            padding: 1.5rem;
            border-radius: 12px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            border: 2px solid transparent;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .category-image {
            width: 100%;
            height: 150px;
            border-radius: 10px;
            background-size: cover;
            background-position: center;
        }

        .category-card:hover {
            border-color: #3B82F6;
            transform: translateY(-4px);
        }
        
        .category-card h3 {
            font-weight: 600;
            color: #1F2937;
            margin-top: 1rem;
        }
        
        /* Products */
        .products {
            padding: 4rem 2rem;
            background: #F8FAFC;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        
        .product-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: all 0.3s;
        }
        
        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        
        .product-image {
            width: 100%;
            height: 200px;
            background: #E5E7EB;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9CA3AF;
            font-size: 3rem;
            background-size: cover;
            background-position: center;
        }
        
        .product-info {
            padding: 1.5rem;
        }
        
        .product-name {
            font-weight: 600;
            color: #1F2937;
            margin-bottom: 0.5rem;
        }
        
        .product-price {
            font-size: 1.25rem;
            font-weight: 700;
            color: #3B82F6;
        }
        
        /* Footer */
        .footer {
            background: #1F2937;
            color: white;
            padding: 3rem 2rem 1rem;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .footer-section h3 {
            font-weight: 600;
            margin-bottom: 1rem;
        }
        
        .footer-section p, .footer-section a {
            color: #D1D5DB;
            text-decoration: none;
            line-height: 1.6;
        }
        
        .footer-section a:hover {
            color: white;
        }
        
        .newsletter {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
        }
        
        .newsletter input {
            flex: 1;
            padding: 0.75rem;
            border: none;
            border-radius: 6px;
            background: #374151;
            color: white;
        }
        
        .newsletter button {
            background: #3B82F6;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            cursor: pointer;
        }
        
        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid #374151;
            color: #9CA3AF;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .nav {
                flex-direction: column;
                gap: 1rem;
            }
            
            .nav-links {
                display: none;
            }
            
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <nav class="nav">
            <div class="logo">
                <div class="logo-icon">🏠</div>
                <div class="logo-text">ModeraHome</div>
            </div>
            
            <ul class="nav-links">
                <li><a href="#shop">Shop</a></li>
                <li><a href="#new">New Arrivals</a></li>
                <li><a href="#sale">Sale</a></li>
                <li><a href="#inspiration">Inspiration</a></li>
            </ul>
            
            <div class="nav-buttons">
                <a href="{{ route('login') }}" class="btn-login">Log In</a>
                <a href="{{ route('register') }}" class="btn-register">Register</a>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Welcome to ModeraHome</h1>
            <p>Your space, beautifully redefined.</p>
            <div class="hero-buttons">
                <button class="btn-explore">Explore Furniture</button>
                <button class="btn-account">Create Account</button>
            </div>
        </div>
    </section>

    <!-- Why ModeraHome Section -->
    <section class="why-section">
        <div class="container">
            <h2 class="section-title">Why ModeraHome?</h2>
            <p class="section-subtitle">Discover furniture that blends form, function, and enduring style.</p>
            
            <div class="features">
                <div class="feature">
                    <div class="feature-icon">✓</div>
                    <h3>Curated Designs</h3>
                    <p>Each piece is handpicked for its modern aesthetic and quality craftsmanship.</p>
                </div>
                
                <div class="feature">
                    <div class="feature-icon">👍</div>
                    <h3>Uncompromising Quality</h3>
                    <p>We partner with the best manufacturers to ensure your furniture lasts a lifetime.</p>
                </div>
                
                <div class="feature">
                    <div class="feature-icon">🚚</div>
                    <h3>Seamless Delivery</h3>
                    <p>Enjoy hassle-free shipping and setup, so you can love your space sooner.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials">
        <div class="container">
            <h2 class="section-title">From Our Customers</h2>
            
            <div class="testimonial">
                "ModeraHome transformed my apartment. The quality and style are exceptional. The assembly service was a lifesaver!"
                <div class="testimonial-author">- Alex D.</div>
            </div>
            
            <div class="testimonial">
                "I was looking for a specific minimalist desk and found the perfect one at ModeraHome. The shopping experience was fantastic from start to finish."
                <div class="testimonial-author">- Sarah P.</div>
            </div>
        </div>
    </section>

    <!-- Shop by Category -->
    <section class="categories">
        <div class="container">
            <h2 class="section-title">Shop by Category</h2>
            
            <div class="categories-grid">
                <div class="category-card">
                    <div class="category-image" style="background-image: url('/images/categories/living-room.jpg');"></div>
                    <h3>Living Room</h3>
                </div>
                
                <div class="category-card">
                    <div class="category-image" style="background-image: url('/images/categories/bedroom.jpg');"></div>
                    <h3>Bedroom</h3>
                </div>
                
                <div class="category-card">
                    <div class="category-image" style="background-image: url('/images/categories/dining.jpg');"></div>
                    <h3>Dining</h3>
                </div>
                
                <div class="category-card">
                    <div class="category-image" style="background-image: url('/images/categories/office.jpg');"></div>
                    <h3>Office</h3>
                </div>
                
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="products">
        <div class="container">
            <h2 class="section-title">Featured Products</h2>
            
            <div class="products-grid">
                <div class="product-card">
                    <div class="product-image" style="background-image: url('/images/products/desk.jpg');"></div>
                    <div class="product-info">
                        <div class="product-name">Exclusive Desk</div>
                        <div class="product-price">$299.99</div>
                    </div>
                </div>
                
                <div class="product-card">
                    <div class="product-image" style="background-image: url('/images/products/wood).jpg');"></div>
                    <div class="product-info">
                        <div class="product-name">Dining Wood Table</div>
                        <div class="product-price">$450.00</div>
                    </div>
                </div>
                
                <div class="product-card">
                    <div class="product-image" style="background-image: url('/images/products/round.jpg');"></div>
                    <div class="product-info">
                        <div class="product-name">Round Dining Table</div>
                        <div class="product-price">$799.00</div>
                    </div>
                </div>
                
                <div class="product-card">
                    <div class="product-image" style="background-image: url('/images/products/gray.jpg');"></div>
                    <div class="product-info">
                        <div class="product-name">Comfy Gray Sofa</div>
                        <div class="product-price">$1,250.00</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>ModeraHome</h3>
                    <p>Modern furniture for modern living. Curated designs to inspire your dream space.</p>
                </div>
                
                <div class="footer-section">
                    <h3>Links</h3>
                    <p><a href="#about">About Us</a></p>
                    <p><a href="#contact">Contact</a></p>
                    <p><a href="#faq">FAQ</a></p>
                    <p><a href="#shipping">Shipping & Returns</a></p>
                </div>
                
                <div class="footer-section">
                    <h3>Newsletter</h3>
                    <p>Sign up for our newsletter to get the latest updates.</p>
                    <div class="newsletter">
                        <input type="email" placeholder="Your email">
                        <button>Sign Up</button>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>© 2024 ModeraHome. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
