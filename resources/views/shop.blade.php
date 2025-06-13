<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DarkShop - Главная</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        
        body {
            background-color: #121212;
            color: #e0e0e0;
        }
        
        .container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Сайдбар с категориями */
        .sidebar {
            width: 250px;
            background-color: #1e1e1e;
            padding: 20px;
            position: sticky;
            top: 0;
            height: 100vh;
            border-right: 1px solid #333;
        }
        
        .logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
            color: #bb86fc;
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 1px solid #333;
        }
        
        .categories h3 {
            color: #bb86fc;
            margin-bottom: 15px;
            font-size: 18px;
        }
        
        .categories ul {
            list-style: none;
        }
        
        .categories li {
            margin-bottom: 10px;
        }
        
        .categories a {
            color: #e0e0e0;
            text-decoration: none;
            display: block;
            padding: 8px 10px;
            border-radius: 4px;
            transition: all 0.3s;
        }
        
        .categories a:hover {
            background-color: #333;
            color: #bb86fc;
        }
        
        .user-panel {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #333;
        }
        
        .user-panel a {
            display: inline-block;
            background-color: #bb86fc;
            color: #121212;
            padding: 10px 15px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s;
        }
        
        .user-panel a:hover {
            background-color: #9a67cb;
        }
        
        /* Основное содержимое */
        .main-content {
            flex: 1;
            padding: 20px;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid #333;
        }
        
        .search-bar {
            display: flex;
            width: 50%;
        }
        
        .search-bar input {
            flex: 1;
            padding: 10px;
            background-color: #1e1e1e;
            border: 1px solid #333;
            border-radius: 4px 0 0 4px;
            color: #e0e0e0;
            outline: none;
        }
        
        .search-bar button {
            padding: 10px 15px;
            background-color: #bb86fc;
            color: #121212;
            border: none;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
            font-weight: bold;
        }
        
        .cart-icon {
            position: relative;
            color: #e0e0e0;
            font-size: 24px;
            cursor: pointer;
        }
        
        .cart-count {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: #bb86fc;
            color: #121212;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .product-card {
            background-color: #1e1e1e;
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.3s;
            border: 1px solid #333;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        
        .product-image {
            height: 200px;
            background-color: #2d2d2d;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #555;
        }
        
        .product-info {
            padding: 15px;
        }
        
        .product-title {
            font-size: 16px;
            margin-bottom: 10px;
            color: #e0e0e0;
        }
        
        .product-price {
            font-size: 18px;
            font-weight: bold;
            color: #bb86fc;
            margin-bottom: 15px;
        }
        
        .product-actions {
            display: flex;
            justify-content: space-between;
        }
        
        .add-to-cart {
            background-color: #bb86fc;
            color: #121212;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        
        .add-to-cart:hover {
            background-color: #9a67cb;
        }
        
        .wishlist {
            background: none;
            border: none;
            color: #e0e0e0;
            font-size: 20px;
            cursor: pointer;
            transition: color 0.3s;
        }
        
        .wishlist:hover {
            color: #ff5555;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Сайдбар с категориями -->
        <div class="sidebar">
            <div class="logo">DarkShop</div>
            
            <div class="categories">
                <h3>Категории</h3>
                <ul>
                    @foreach ($categories as $category)
                        <li><a href="/shop/category_id={{ $category['id'] }}">{{ $category['name'] }}</a></li>
                    @endforeach
                </ul>
            </div>
            
            <div class="user-panel">
                <a href="{{ route('dashboard') }}">Личный кабинет</a>
            </div>
        </div>
        
        <!-- Основное содержимое -->
        <div class="main-content">
            <div class="header">
                <div class="search-bar">
                    <input type="text" placeholder="Поиск товаров...">
                    <button>Найти</button>
                </div>
                <div class="cart-icon">
                    🛒
                    <span class="cart-count">3</span>
                </div>
            </div>
            
            <div class="products-grid">
                @foreach ($products as $product)
                <a href="/product/productName={{ $product['name'] }}">
                    <div class="product-card">
                        <div class="product-image">
                            [Изображение товара]
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">{{ $product['name'] }}</h3>
                            <div class="product-price">{{ $product['price'] }}₽</div>
                            <div class="product-actions">
                                <button class="add-to-cart">В корзину</button>
                                <button class="wishlist">♥</button>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>