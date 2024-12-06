fetch('http://localhost/cuoiki/backend/products.php')
    .then(response => response.json())
    .then(products => {
        let productHtml = '';
        products.forEach(product => {
            productHtml += `<div>
                <h2>${product.name}</h2>
                <p>Giá: ${product.price}</p>
                <p>Tồn kho: ${product.inventory}</p>
            </div>`;
        });
        document.getElementById('products').innerHTML = productHtml;
    });
