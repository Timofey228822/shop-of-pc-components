<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Подробное описание продукта | Название товара</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }
        
        .product-page {
            max-width: 1200px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        
        .product-header {
            display: flex;
            gap: 30px;
            margin-bottom: 30px;
        }
        
        .product-gallery {
            flex: 1;
        }
        
        .main-image {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        
        .thumbnails {
            display: flex;
            gap: 10px;
        }
        
        .thumbnail {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
            cursor: pointer;
            border: 2px solid transparent;
        }
        
        .thumbnail:hover {
            border-color: #4CAF50;
        }
        
        .product-info {
            flex: 1;
        }
        
        .product-title {
            font-size: 28px;
            margin-bottom: 10px;
            color: #222;
        }
        
        .product-price {
            font-size: 24px;
            font-weight: bold;
            color: #e53935;
            margin-bottom: 15px;
        }
        
        .product-rating {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 15px;
        }
        
        .stars {
            color: #FFD700;
        }
        
        .reviews {
            color: #777;
            font-size: 14px;
        }
        
        .add-to-cart {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 20px;
            transition: background 0.3s;
        }

        .back-to-shop {
            background:rgb(129, 111, 233);
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 20px;
            transition: background 0.3s;
        }
        
        .add-to-cart:hover {
            background: #45a049;
        }

        .back-to-shop:hover {
            background:rgb(47, 56, 185);
        }
        
        .product-description {
            margin-bottom: 30px;
        }
        
        .specs-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        
        .specs-table th, .specs-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        .specs-table th {
            background: #f9f9f9;
            width: 30%;
        }
        
        .related-products {
            margin-top: 40px;
        }
        
        .related-title {
            font-size: 22px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        
        .related-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }
        
        .related-item {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        
        .related-item:hover {
            transform: translateY(-5px);
        }
        
        .related-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        
        .related-item-info {
            padding: 15px;
        }
        
        .related-item-title {
            font-size: 16px;
            margin-bottom: 5px;
        }
        
        .related-item-price {
            color: #e53935;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="product-page">
        <div class="product-header">
            <div class="product-gallery">
                <img src="https://via.placeholder.com/600x400" alt="Основное изображение товара" class="main-image">
            </div>
            
            <div class="product-info">
                <h1 class="product-title">{{ $product->name }}</h1>
                <div class="product-price">{{ $product->price }}₽</div>
                
                <div class="product-rating">
                </div>
                
                <button class="add-to-cart">Добавить в корзину</button>
                <form method="GET" action="{{ route('shop') }}">
                    <button type="submit" class="back-to-shop">Обратно</button>
                </form>
                
                <div class="product-description">
                    <p>{{ $product->description }}</p>
                </div>
            </div>
        </div>
</body>
</html>