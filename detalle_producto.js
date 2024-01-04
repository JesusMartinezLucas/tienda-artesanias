product = JSON.parse(window.localStorage.getItem("product"));

console.log("product", product);

document.getElementById('main-photo').src = product.fotoPrincipal;
const photoContainer = document.getElementById('product-photos');

product.fotosSecundarias.forEach(photo => {
    const image = document.createElement('img');
    image.src = photo;
    image.alt = product.nombre;

    photoContainer.appendChild(image);
});

document.getElementById('product-name').innerHTML = product.nombre;
document.getElementById('product-price').innerHTML = `<span>Precio:</span> $${product.precio}`;
document.getElementById('product-size').innerHTML = `<span>Peso:</span> ${product.peso} kg`;
document.getElementById('product-dimensions').innerHTML = `<span>Dimensiones:</span> Alto: ${product.alto} cm, Ancho: ${product.ancho} cm, Diámetro: ${product.diametro} cm`;
document.getElementById('product-category').innerHTML = `Categoría: ${product.categoria}`;
