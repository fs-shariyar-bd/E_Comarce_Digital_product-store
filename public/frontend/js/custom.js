// Add to cart AJAX for home page products
document.addEventListener('click', function(e) {
    if (e.target && e.target.closest('.add-to-cart-link')) {
        e.preventDefault();
        var link = e.target.closest('.add-to-cart-link');
        var productId = link.dataset.productId;

        fetch("/cart/add", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'product_id=' + productId,
            credentials: 'same-origin'
        }).then(response => response.json()).then(data => {
            if (data.success) {
                // Update cart count in header
                var cartCountEl = document.querySelector('.cart-item-count');
                if (cartCountEl) {
                    cartCountEl.textContent = data.count;
                }
                // Update minicart items
                var minicartList = document.querySelector('.minicart-product-list');
                if (minicartList && data.items) {
                    var html = '';
                    data.items.forEach(function(item) {
                        html += '<li>';
                        html += '<a href="/product-details/' + item.id + '" class="minicart-product-image">';
                        html += '<img src="' + (item.image ? '/' + item.image : '/frontend/images/product/default.jpg') + '" alt="' + item.name + '">';
                        html += '</a>';
                        html += '<div class="minicart-product-details">';
                        html += '<h6><a href="/product-details/' + item.id + '">' + item.name + '</a></h6>';
                        html += '<span>$' + parseFloat(item.price).toFixed(2) + ' x ' + item.quantity + '</span>';
                        html += '</div>';
                        html += '<form action="/cart/remove/' + item.id + '" method="POST" style="display:inline;" class="mini-cart-remove-form">';
                        html += '<input type="hidden" name="_token" value="' + document.querySelector('meta[name="csrf-token"]').getAttribute('content') + '">';
                        html += '<button class="close" title="Remove" type="submit"><i class="fa fa-close"></i></button>';
                        html += '</form>';
                        html += '</li>';
                    });
                    minicartList.innerHTML = html;
                }
                // Update subtotal
                var subtotalEl = document.querySelector('.minicart-total span');
                if (subtotalEl && data.subtotal !== undefined) {
                    subtotalEl.textContent = '$' + parseFloat(data.subtotal).toFixed(2);
                }
                alert('Product added to cart successfully!');
            } else {
                alert(data.message || 'Error adding to cart');
            }
        }).catch(err => {
            alert('Error adding to cart');
        });
    }
});

// Quickview add to cart AJAX
document.addEventListener('submit', function(e) {
    if (e.target && e.target.id === 'quickviewAddToCartForm') {
        e.preventDefault();
        var form = e.target;
        var formData = new FormData(form);
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(response => response.json()).then(data => {
            if (data.success) {
                var cartCountEl = document.querySelector('.cart-item-count');
                if (cartCountEl) {
                    cartCountEl.textContent = data.count;
                }
                alert('Product added to cart successfully!');
                location.reload();
            } else {
                alert(data.message || 'Error adding to cart');
            }
        }).catch(err => {
            alert('Error adding to cart');
        });
    }
});

// Product details add to cart AJAX
document.addEventListener('submit', function(e) {
    if (e.target && e.target.matches('.single-add-to-cart form')) {
        e.preventDefault();
        var form = e.target;
        var formData = new FormData(form);
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(response => response.json()).then(data => {
            if (data.success) {
                var cartCountEl = document.querySelector('.cart-item-count');
                if (cartCountEl) {
                    cartCountEl.textContent = data.count;
                }
                alert('Product added to cart successfully!');
                location.reload();
            } else {
                alert(data.message || 'Error adding to cart');
            }
        }).catch(err => {
            alert('Error adding to cart');
        });
    }
});

// Shopping cart quantity update AJAX
document.addEventListener('submit', function(e) {
    if (e.target && e.target.matches('.quantity-update-form')) {
        e.preventDefault();
        var form = e.target;
        var formData = new FormData(form);
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(response => response.json()).then(data => {
            if (data.success) {
                var cartCountEl = document.querySelector('.cart-item-count');
                if (cartCountEl) {
                    cartCountEl.textContent = data.count;
                }
                location.reload();
            } else {
                alert(data.message || 'Error updating quantity');
            }
        }).catch(err => {
            alert('Error updating quantity');
        });
    }
});

// Mini-cart remove AJAX
document.addEventListener('submit', function(e) {
    if (e.target && e.target.matches('.mini-cart-remove-form')) {
        e.preventDefault();
        var formData = new FormData(e.target);
        fetch(e.target.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(r => r.json()).then(data => {
            if (data.success) {
                var cartCountEl = document.querySelector('.cart-item-count');
                if (cartCountEl) {
                    cartCountEl.textContent = data.count;
                }
                location.reload();
            } else {
                alert(data.message || 'Error removing item');
            }
        }).catch(() => alert('Error removing item'));
    }
});

// Add to wishlist AJAX
document.addEventListener('click', function(e) {
    if (e.target && e.target.closest('.add-to-wishlist-link')) {
        e.preventDefault();
        var link = e.target.closest('.add-to-wishlist-link');
        var productId = link.dataset.productId;

        fetch("/wishlist/add", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'product_id=' + productId,
            credentials: 'same-origin'
        }).then(response => response.json()).then(data => {
            if (data.success) {
                var wishlistCountEl = document.getElementById('wishlist-count');
                if (wishlistCountEl) {
                    wishlistCountEl.textContent = data.wishlistCount;
                }
                alert('Product added to wishlist successfully!');
            } else {
                alert(data.message || 'Error adding to wishlist');
            }
        }).catch(err => {
            alert('Error adding to wishlist');
        });
    }
});

// Remove from wishlist AJAX
document.addEventListener('submit', function(e) {
    if (e.target && e.target.matches('.remove-from-wishlist-form')) {
        e.preventDefault();
        var form = e.target;
        var formData = new FormData(form);
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(response => response.json()).then(data => {
            if (data.success) {
                var wishlistCountEl = document.getElementById('wishlist-count');
                if (wishlistCountEl) {
                    wishlistCountEl.textContent = data.wishlistCount;
                }
                if (document.querySelector('.wishlist-area')) {
                    var row = form.closest('tr');
                    if (row) {
                        row.remove();
                        var tbody = document.querySelector('.wishlist-area tbody');
                        if (tbody && tbody.children.length === 0) {
                            tbody.innerHTML = '<tr><td colspan="6" style="text-align: center; padding: 30px;">Your wishlist is empty</td></tr>';
                        }
                    }
                }
                alert('Product removed from wishlist successfully!');
            } else {
                alert(data.message || 'Error removing from wishlist');
            }
        }).catch(err => {
            alert('Error removing from wishlist');
        });
    }
});

// Wishlist add to cart AJAX
document.addEventListener('submit', function(e) {
    if (e.target && e.target.matches('.wishlist-add-to-cart-form')) {
        e.preventDefault();
        var form = e.target;
        var formData = new FormData(form);
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(response => response.json()).then(data => {
            if (data.success) {
                var cartCountEl = document.querySelector('.cart-item-count');
                if (cartCountEl) {
                    cartCountEl.textContent = data.count;
                }
                alert('Product added to cart successfully!');
            } else {
                alert(data.message || 'Error adding to cart');
            }
        }).catch(err => {
            alert('Error adding to cart');
        });
    }
});

// Checkout form AJAX
document.addEventListener('submit', function(e) {
    if (e.target && e.target.id === 'checkout-form') {
        e.preventDefault();
        var form = e.target;
        var formData = new FormData(form);
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(response => response.json()).then(data => {
            if (data.success) {
                alert(data.message || 'Order placed successfully!');
                window.location.href = '/my-orders';
            } else {
                var errorMsg = data.message || 'Error placing order';
                if (data.errors) {
                    var errors = Object.values(data.errors).flat();
                    errorMsg = errors.join(' ');
                }
                alert(errorMsg);
            }
        }).catch(err => {
            alert('Error placing order. Please try again.');
        });
    }
});