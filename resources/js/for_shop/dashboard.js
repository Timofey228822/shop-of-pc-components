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