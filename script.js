document.addEventListener('DOMContentLoaded', function () {
    // Llamada a la API para obtener los productos
    fetch('api/endpoint.php')
        .then(response => response.json())
        .then(products => {
            const productsContainer = document.getElementById('products-container');

            products.forEach(product => {
                const productCard = createProductCard(product);
                productsContainer.appendChild(productCard);

                productCard.addEventListener("click", productDetail);
                productCard.product = product;
            });
        })
        .catch(error => console.error('Error al obtener productos:', error));
});

function createProductCard(product) {
    const card = document.createElement('div');
    card.classList.add('card');

    const image = document.createElement('img');
    image.src = product.fotoPrincipal;
    image.alt = product.nombre;

    const content = document.createElement('div');
    content.classList.add('card-content');

    content.innerHTML = `
        <h2>${product.nombre}</h2>
        <p><span>Precio:</span> $${product.precio}</p>
        <p><span>Peso:</span> ${product.peso} kg</p>
        <p><span>Dimensiones:</span> Alto: ${product.alto} cm, Ancho: ${product.ancho} cm, Diámetro: ${product.diametro} cm</p>
        <p class="category">Categoría: ${product.nombreCategoria}</p>
    `;

    card.appendChild(image);
    card.appendChild(content);

    return card;
}

function productDetail(event){
    product = event.currentTarget.product;
    window.localStorage.setItem("product", JSON.stringify(product));
    window.location.href = `detalle_producto.html`;
}
