
document.addEventListener('DOMContentLoaded', function () {
    const minusBtn = document.querySelector('.minus-btn');
    const plusBtn = document.querySelector('.plus-btn');
    const quantityInput = document.querySelector('.quantity-input');

    minusBtn.addEventListener('click', function () {
        let currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
            quantityInput.value = (currentValue - 1).toString().padStart(2, '0');
        }
    });

    plusBtn.addEventListener('click', function () {
        let currentValue = parseInt(quantityInput.value);
        quantityInput.value = (currentValue + 1).toString().padStart(2, '0');
    });
});
function addToCart(){
    var alertBox = document.createElement('div');
    alertBox.innerText = 'Item added to cart';
    alertBox.style.position = 'fixed';
    alertBox.style.top = '50px';
    alertBox.style.right = '20px';
    alertBox.style.padding = '10px 20px';
    alertBox.style.backgroundColor = '#183134';
    alertBox.style.color = '#FFFF';
    alertBox.style.borderRadius = '5px';
    alertBox.style.boxShadow = '0 2px 5px rgba(0,0,0,0.3)';
    alertBox.style.zIndex = '9999'; 
    document.body.appendChild(alertBox);

    
    setTimeout(function() {
        document.body.removeChild(alertBox);
    }, 3000);
}
function addToFav(index) {
    
    var formData = new FormData();
    formData.append('action', 'add');
    formData.append('item_name', items[index].name); // ضع هنا القيم الفعلية للمنتج
    formData.append('item_img', items[index].img); // ضع هنا القيم الفعلية للمنتج

    // إعداد طلب AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'fav.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            showAlert('Item added to favorites');
        } else {
            console.error('Error adding to favorites');
        }
    };
    xhr.send(formData);
}

function showAlert(message) {
    var alertBox = document.createElement('div');
    alertBox.innerText = 'Item added to cart';
    alertBox.style.position = 'fixed';
    alertBox.style.top = '50px';
    alertBox.style.right = '20px';
    alertBox.style.padding = '10px 20px';
    alertBox.style.backgroundColor = '#183134';
    alertBox.style.color = '#FFFF';
    alertBox.style.borderRadius = '5px';
    alertBox.style.boxShadow = '0 2px 5px rgba(0,0,0,0.3)';
    document.body.appendChild(alertBox);

    
    setTimeout(function() {
        document.body.removeChild(alertBox);
    }, 3000);
}


