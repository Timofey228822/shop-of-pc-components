// Tab switching
document.querySelectorAll('.menu-item').forEach(item => {
    item.addEventListener('click', function() {
        // Remove active class from all menu items
        document.querySelectorAll('.menu-item').forEach(i => {
            i.classList.remove('active');
        });
        
        // Add active class to clicked item
        this.classList.add('active');
        
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.remove('active');
        });
        
        // Show selected tab
        const tabId = this.getAttribute('data-tab');
        document.getElementById(tabId).classList.add('active');
    });
});

// Product modal
document.getElementById('addProductBtn').addEventListener('click', function() {
    document.getElementById('addProductModal').style.display = 'flex';
});

document.getElementById('closeProductModal').addEventListener('click', function() {
    document.getElementById('addProductModal').style.display = 'none';
});

// категори модал
document.getElementById('addCategoryBtn').addEventListener('click', function() {
    document.getElementById('addCategoryModal').style.display = 'flex';
});

document.getElementById('closeCategoryModal').addEventListener('click', function() {
    document.getElementById('addCategoryModal').style.display = 'none';
});

// Admin modal
document.getElementById('addAdminBtn').addEventListener('click', function() {
    document.getElementById('addAdminModal').style.display = 'flex';
});

document.getElementById('closeAdminModal').addEventListener('click', function() {
    document.getElementById('addAdminModal').style.display = 'none';
});

// Close modals when clicking outside
window.addEventListener('click', function(event) {
    if (event.target === document.getElementById('addProductModal')) {
        document.getElementById('addProductModal').style.display = 'none';
    }
    
    if (event.target === document.getElementById('addAdminModal')) {
        document.getElementById('addAdminModal').style.display = 'none';
    }
});