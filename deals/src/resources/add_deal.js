async function getProducts(sellerSelectValue) {
    const productSelect = document.querySelector('#product');
    document.querySelectorAll('#product option').forEach(option => option.remove())
    const response = await fetch("http://localhost/deals/src/views/seller/sellers.php?s="
        + sellerSelectValue);
    const responseText = await response.text();
    if (responseText === "Товары не найдены") {
        productSelect.setAttribute('disabled', 'disabled');
        return;
    }
    const productsArray = responseText.split(';');
    if (productsArray[0] === '') {
        const option = document.createElement("option");
        option.innerHTML = "У выбранного продавца нет товаров";
        productSelect.appendChild(option);
        productSelect.setAttribute('disabled', 'disabled');
        return;
    }
    productsArray.pop();
    productsArray.forEach(element => createOption(element));
    productSelect.removeAttribute('disabled');
}

function createOption(product) {
    const option = document.createElement("option");
    product = product.split(', ');
    option.innerHTML = "Наименование товара: " + product[0] + ", доступное количество: " + product[1];
    const productSelect = document.querySelector('#product');
    productSelect.appendChild(option);
}
