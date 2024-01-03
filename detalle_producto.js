product = JSON.parse(window.localStorage.getItem("product"));

console.log("product", product);

document.getElementById('product-name').innerHTML = product.nombre;
