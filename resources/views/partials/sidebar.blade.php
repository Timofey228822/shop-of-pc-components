    <div class="sidebar">
        <div class="sidebar-header">
            <h2>Магазин Продуктов</h2>
            <p>Административная панель</p>
        </div>
        <div class="sidebar-menu">
            <a href="{{ route('admin_dashboard') }}">
                <div class="menu-item" data-tab="dashboard">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Дашборд</span>
                </div>
            </a>
            <a href="{{ route('admin_products') }}">
                <div class="menu-item" data-tab="products">
                    <i class="fas fa-shopping-basket"></i>
                    <span>Товары</span>
                </div>
            </a>
            <a href="{{ route('admin_categories') }}">
                <div class="menu-item" data-tab="categories">
                    <i class="fas fa-list"></i>
                    <span>Категории</span>
                </div>
            </a>
            <a href="{{ route('admin_users') }}">
                <div class="menu-item" data-tab="users">
                    <i class="fas fa-users"></i>
                    <span>Пользователи</span>
                </div>
            </a>
            <a href="{{ route('admin_admins') }}">
                <div class="menu-item" data-tab="admins">
                    <i class="fas fa-user-shield"></i>
                    <span>Администраторы</span>
                </div>
            </a>
        </div>
    </div>