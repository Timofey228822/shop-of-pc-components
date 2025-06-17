<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет | Магазин</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        body {
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        header {
            background-color: #2c3e50;
            color: white;
            padding: 15px 0;
            margin-bottom: 30px;
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
        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #3498db;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        .tabs {
            display: flex;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }
        .tab {
            padding: 10px 20px;
            cursor: pointer;
            background-color: #eee;
            margin-right: 5px;
            border-radius: 5px 5px 0 0;
        }
        .tab.active {
            background-color: #3498db;
            color: white;
        }
        .tab-content {
            display: none;
            background-color: white;
            padding: 20px;
            border-radius: 0 0 5px 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .tab-content.active {
            display: block;
        }
        .product-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        .product-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            transition: transform 0.2s;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .product-image {
            height: 150px;
            background-color: #eee;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
        }
        .product-title {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .product-price {
            color: #e74c3c;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .btn {
            padding: 8px 15px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #3498db;
            color: white;
        }
        .btn-danger {
            background-color: #e74c3c;
            color: white;
        }
        .cart-item, .purchased-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        .cart-item:last-child, .purchased-item:last-child {
            border-bottom: none;
        }
        .cart-total, .purchase-date {
            font-weight: bold;
            text-align: right;
            padding: 15px;
            background-color: #f9f9f9;
        }
        .empty-message {
            text-align: center;
            padding: 40px;
            color: #999;
        }
    </style>
</head>
<body>
    <header>
        <div class="container header-content">
            <div class="logo">Магазин того, что каждый бы хотел себе приобрести</div> 
            <div class="user-info">
                <span>{{ $data->name ?? 'guest' }}</span>
                <div class="avatar"></div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="tabs">
            <div class="tab active" data-tab="profile">Профиль</div>
            <div class="tab" data-tab="cart">Корзина</div>
            <div class="tab" data-tab="purchases">Мои покупки</div>
            <div class="tab" data-tab="shop">Магаз</div>
        </div>

        <div id="profile" class="tab-content active">
            <h2>Личные данные</h2>
            <form method="POST" action="{{ route('update') }}">
                @csrf
                @method('PUT')
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">ФИО</label>
                    <input name="name" type="text" value="{{ $data->name ?? 'guest' }}" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Email</label>
                    <input name="email" type="email" value="{{ $data->email ?? 'guest' }}" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Телефон</label>
                    <input name="phone" type="tel" value="{{ $data->phone ?? '' }}" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Пароль</label>
                    <input name="password" type="pass" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
                </div>
                <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                <form method="GET" action="{{ route('exit') }}">
                    <button type="submit" class="btn btn-primary">Выйти из Аккаунта</button>
                </form>
        </div>
            </form>
        </div>

        <div id="cart" class="tab-content">
            <h2>Корзина</h2>
            <div id="cart-items">
                <div class="cart-item">
                    <div>
                        <div class="product-title">Смартфон XYZ Pro</div>
                        <div class="product-price">32 990 ₽</div>
                    </div>
                    <div>
                        <button class="btn btn-danger">Удалить</button>
                    </div>
                </div>
                <div class="cart-item">
                    <div>
                        <div class="product-title">Наушники Premium Sound</div>
                        <div class="product-price">7 490 ₽</div>
                    </div>
                    <div>
                        <button class="btn btn-danger">Удалить</button>
                    </div>
                </div>
                <div class="cart-total">
                    Итого: 40 480 ₽
                </div>
            </div>
            <button class="btn btn-primary" style="margin-top: 20px; width: 100%; padding: 12px;">Оформить заказ</button>
        </div>

        <div id="purchases" class="tab-content">
            <h2>История покупок</h2>
            <div id="purchased-items">
                <div class="purchased-item">
                    <div>
                        <div class="product-title">Ноутбук UltraBook 15</div>
                        <div>Количество: 1</div>
                        <div class="product-price">64 990 ₽</div>
                    </div>
                    <div class="purchase-date">
                        15.05.2023
                    </div>
                </div>
                <div class="purchased-item">
                    <div>
                        <div class="product-title">Беспроводная мышь</div>
                        <div>Количество: 2</div>
                        <div class="product-price">1 990 ₽ (за шт)</div>
                    </div>
                    <div class="purchase-date">
                        02.04.2023
                    </div>
                </div>
                <div class="purchased-item">
                    <div>
                        <div class="product-title">Чехол для смартфона</div>
                        <div>Количество: 1</div>
                        <div class="product-price">890 ₽</div>
                    </div>
                    <div class="purchase-date">
                        12.03.2023
                    </div>
                </div>
            </div>
        </div>
        <div id="shop" class="tab-content">
            <form method="GET" action="{{ route('shop') }}">
                <button type="submit" class="btn btn-primary">Перейти в магаз</button>
            </form>
        </div>
    </div>

    <script>
        // Переключение между вкладками
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', () => {
                // Удаляем активный класс у всех вкладок и контента
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
                
                // Добавляем активный класс к выбранной вкладке и соответствующему контенту
                tab.classList.add('active');
                const tabId = tab.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
            });
        });

        // Здесь можно добавить логику для работы с корзиной и покупками
    </script>
</body>
</html>