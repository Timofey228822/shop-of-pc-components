<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Компьютерные комплектующие</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }
        
        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        
        header {
            background-color: #2c3e50;
            color: white;
            padding: 20px 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 24px;
            font-weight: bold;
        }
        
        .categories-nav {
            background-color: #34495e;
            padding: 15px 0;
        }
        
        .categories {
            display: flex;
            list-style: none;
            gap: 10px;
            overflow-x: auto;
            padding: 5px 0;
        }
        
        .category-link {
            display: block;
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 20px;
            background-color: rgba(255,255,255,0.1);
            transition: all 0.3s ease;
            white-space: nowrap;
        }
        
        .category-link:hover, .category-link.active {
            background-color: #e74c3c;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            margin: 30px 0;
        }
        
        .product-card {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
        }
        
        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .product-info {
            padding: 15px;
        }
        
        .product-title {
            font-size: 18px;
            margin-bottom: 10px;
            color: #2c3e50;
        }
        
        .product-price {
            font-size: 20px;
            font-weight: bold;
            color: #e74c3c;
            margin: 10px 0;
        }
        
        .product-category {
            display: inline-block;
            background-color: #f1f1f1;
            color: #7f8c8d;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 12px;
            margin-top: 5px;
        }
        
        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 40px;
        }
        
        @media (max-width: 768px) {
            .categories {
                flex-wrap: nowrap;
                overflow-x: auto;
                padding-bottom: 10px;
            }
            
            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container header-content">
            <div class="logo">PC Components</div>
            <div class="cart">Корзина (0)</div>
        </div>
    </header>
    
    <nav class="categories-nav">
        <div class="container">
            <ul class="categories">
                <li><a href="/shop" class="category-link">Все товары</a></li>
                @foreach ($data as $dat)
                    <li><a href="/shop/category_id={{ $dat->id }}" class="category-link">{{ $dat->name }}</a></li>
                @endforeach
                <!-- <li><a href="/products?category=материнские платы" class="category-link">Материнские платы</a></li>
                <li><a href="/products?category=оперативные памяти" class="category-link">Оперативная память</a></li>
                <li><a href="/products?category=блоки питания" class="category-link">Блоки питания</a></li>
                <li><a href="/products?category=процессоры" class="category-link">Процессоры</a></li>
                <li><a href="/products?category=видеокарты" class="category-link">Видеокарты</a></li>
                <li><a href="/products?category=кулеры" class="category-link">Кулеры</a></li>
                <li><a href="/products?category=прикольные кулеры" class="category-link">Прикольные кулеры</a></li> -->
            </ul>
        </div>
    </nav>
    
    <main class="container">
        <h1>Каталог товаров</h1>
        
        <div class="products-grid">
            @foreach ($result as $line)
                <div class="product-card">
                    <!-- <img src="https://via.placeholder.com/300x200?text=Материнская+плата" alt="Материнская плата" class="product-image"> -->
                    <div class="product-info">
                        <h3 class="product-title">{{ $line['name'] }}</h3>
                        <p class="product-description">{{ $line['description'] }}</p>
                        <div class="product-price">{{ $line['price'] }}</div>
                    </div>
                </div>
            @endforeach
            
            
            <!-- Пример товара 2 -->
            <!-- <div class="product-card">
                <img src="https://via.placeholder.com/300x200?text=Оперативная+память" alt="Оперативная память" class="product-image">
                <div class="product-info">
                    <h3 class="product-title">Оперативная память Kingston 16GB</h3>
                    <p class="product-description">DDR4, 3200MHz, 2x8GB</p>
                    <div class="product-price">5 499 ₽</div>
                    <span class="product-category">оперативные памяти</span>
                </div>
            </div>
            

            <div class="product-card">
                <img src="https://via.placeholder.com/300x200?text=Процессор" alt="Процессор" class="product-image">
                <div class="product-info">
                    <h3 class="product-title">Процессор Intel Core i7-10700K</h3>
                    <p class="product-description">8 ядер, 16 потоков, 3.8 ГГц</p>
                    <div class="product-price">24 999 ₽</div>
                    <span class="product-category">процессоры</span>
                </div>
            </div>
            

            <div class="product-card">
                <img src="https://via.placeholder.com/300x200?text=Видеокарта" alt="Видеокарта" class="product-image">
                <div class="product-info">
                    <h3 class="product-title">Видеокарта NVIDIA RTX 3070</h3>
                    <p class="product-description">8GB GDDR6, 5888 ядер</p>
                    <div class="product-price">59 999 ₽</div>
                    <span class="product-category">видеокарты</span>
                </div>
            </div>


            <div class="product-card">
                <img src="https://via.placeholder.com/300x200?text=Блок+питания" alt="Блок питания" class="product-image">
                <div class="product-info">
                    <h3 class="product-title">Блок питания Cooler Master 750W</h3>
                    <p class="product-description">80+ Gold, модульный</p>
                    <div class="product-price">7 299 ₽</div>
                    <span class="product-category">блоки питания</span>
                </div>
            </div>
            

            <div class="product-card">
                <img src="https://via.placeholder.com/300x200?text=Кулер" alt="Кулер" class="product-image">
                <div class="product-info">
                    <h3 class="product-title">Кулер для процессора DeepCool</h3>
                    <p class="product-description">Тихий, RGB подсветка</p>
                    <div class="product-price">2 999 ₽</div>
                    <span class="product-category">кулеры</span>
                </div>
            </div>  -->
        </div>
    </main>
    
    <footer>
        <div class="container">
            <p>© 2023 PC Components. Все права защищены.</p>
        </div>
    </footer>

    <script>
        // Подсветка активной категории
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const currentCategory = urlParams.get('category');
            
            const categoryLinks = document.querySelectorAll('.category-link');
            categoryLinks.forEach(link => {
                const linkCategory = link.getAttribute('href').split('=')[1];
                if (linkCategory === currentCategory || 
                   (!currentCategory && link.textContent.trim() === 'Все товары')) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>