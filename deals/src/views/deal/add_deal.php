<?php

session_start();
require "../../../vendor/autoload.php";

use App\Deal;
use App\Participant;
use App\Product\Boots;
use App\Product\Camera;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $deal = new Deal();
    function getSeller(): Participant
    {
        $count = 0;
        $seller = null;
        foreach ($_SESSION['sellers'] as $seller) {
            $seller = unserialize($seller);
            $sellerString = $seller->getName() . ", " . $seller->getAddress();
            if ($sellerString == $_POST['seller']) {
                return $seller;
            }
            $count++;
        }
        return $seller;
    }

    function getBuyer(): Participant
    {
        $buyer = null;
        $count = 0;
        foreach ($_SESSION['buyers'] as $buyer) {
            $buyer = unserialize($buyer);
            $buyerString = $buyer->getName() . ", " . $buyer->getAddress();
            if ($buyerString == $_POST['buyer']) {
                return $buyer;
            }
            $count++;
        }
        return $buyer;
    }

    function getProduct($productString): Boots|Camera
    {
        $product = null;
        $count = 0;
        foreach ($_SESSION['products'] as $product) {
            $product = unserialize($product);
            if ($product->getName() == $productString) {
                return $product;
            }
            $count++;
        }
        return $product;
    }

    $deal->setDate(date("d.m.Y"));
    $deal->setSeller(getSeller());
    $deal->setBuyer(getBuyer());

    $count = 0;
    $array = array();
    $hidden = $_POST['hidden'];
    $products = explode(";", $hidden);
    while (count($products) - 1 != $count) {
        $product = explode(",", $products[$count]);
        $amount = $product[1];
        $product = trim($product[0]);
        $product = getProduct($product);
        $array[] = [$product, $amount];
        $count++;
    }
    $deal->setProductAndAmount($array);

    $sum = 0;
    $count = 0;
    while (count($deal->getProductAndAmount()) != $count) {
        $sum += $deal->getProductAndAmount()[$count][0]->getCost(($deal->getProductAndAmount()[$count][1]));
        $count++;
    }
    $deal->setTotalSum($sum);
    $_SESSION['deals'][] = serialize($deal);
}

$title = "Добавить сделку";
include "../util/header.php";
?>

    <body>
    <script src="../../resources/add_deal.js"></script>
    <div class="container">
        <form method="POST" action="<?php
        echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="addDeal">
            <fieldset form="addDeal">
                <legend>Добавить сделку</legend>

                <div class="form-floating">
                    <select class="form-select mb-3" aria-label="Выбор продавца" id="seller" name="seller"
                            onchange="getProducts(this.value)">
                        <?php
                        if (!isset($_SESSION['sellers'])) {
                            echo "<option value='no_sellers'>Продавцы не добавлены</option>";
                        } else {
                            foreach ($_SESSION['sellers'] as $seller) {
                                $seller = unserialize($seller);
                                echo "<option>" . $seller->getName() . ", " . $seller->getAddress() . "</option>";
                            }
                        }
                        ?>
                    </select>
                    <label for="seller">Выберите продавца</label>
                </div>

                <div class="form-floating">
                    <select class="form-select mb-3" aria-label="Выбор покупателя" id="buyer" name="buyer">
                        <!--должны заполняться из $_SESSION['buyers']
                            если нет - вывести "Покупатели не добавлены", выключить fieldset-->
                        <?php
                        if (!isset($_SESSION['buyers'])) {
                            echo "<option value='no_buyers'>Продавцы не добавлены</option>";
                        } else {
                            foreach ($_SESSION['buyers'] as $buyer) {
                                $buyer = unserialize($buyer);
                                echo "<option>" . $buyer->getName() . ", " . $buyer->getAddress() . "</option>";
                            }
                        }
                        ?>
                    </select>
                    <label for="buyer">Выберите покупателя</label>
                </div>

                <div class="row g-3">
                    <div class="col-md-8">
                        <div class="form-floating">
                            <select class="form-select mb-3" aria-label="Выбор товара" id="product">
                                <?php
                                if (!isset($_SESSION['products'])) {
                                    echo "<option value='no_products'>Товары не добавлены</option>";
                                } else {
                                    foreach ($_SESSION['products'] as $product) {
                                        $product = unserialize($product);
                                        echo "<option>" . $product->getName() . ", " . $product->getPrice(
                                            ) . "</option>";
                                    }
                                }
                                ?>
                            </select>
                            <label for="product">Выберите товар</label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-floating">
                            <input type='number' class='form-control md-3' id='amount' name='amount'
                                   placeholder='Введите количество'
                                   required min='1'>
                            <label for="amount">Количество</label>
                        </div>
                    </div>
                    <script>
                        function addProductToDeal(product, amount) {
                            const productValue = product.value
                            product = productValue.split(',')
                            const productName = product[0].split(':')
                            //const productAmount = productName[1].trim()
                            if (amount.value === 1) {
                                alert("Количество не должно быть меньше 1")
                                return
                            }
                            // добавить выбранный товар и количество в list-group
                            let li = document.createElement("li");
                            li.setAttribute("class", "list-group-item d-flex justify-content-between align-items-start");

                            let divProductProperties = document.createElement("div");
                            divProductProperties.setAttribute("class", "ms-2 me-auto");
                            divProductProperties.innerText = "Остальные поля";

                            let divProductName = document.createElement("div");
                            divProductName.setAttribute("class", "fw-bold");
                            divProductName.innerText = productName[0];

                            divProductProperties.prepend(divProductName);
                            li.insertAdjacentElement("beforeend", divProductProperties);

                            let span = document.createElement("span");
                            span.setAttribute("class", "badge bg-primary rounded-pill align-self-center m-2");
                            span.innerHTML = amount.value;
                            li.insertAdjacentElement("beforeend", span);

                            let deleteButton = document.createElement("button");
                            deleteButton.setAttribute("class", "btn btn-primary align-self-center");
                            deleteButton.setAttribute("type", "button");
                            deleteButton.innerHTML = "Удалить товар";
                            deleteButton.setAttribute("onclick", "deleteProductFromDeal(this)");

                            li.insertAdjacentElement("beforeend", deleteButton);

                            let ul = document.querySelector("#list-group");
                            ul.appendChild(li);
                        }

                        function deleteProductFromDeal(element) {
                            element.closest("li").remove();
                        }
                    </script>
                    <div class="col-md-2 text-center align-self-center">
                        <button type="button" class="btn btn-primary align-self-center mb-3" id="add_product"
                                onclick="addProductToDeal(product, amount)">Добавить товар
                        </button>
                    </div>
                </div>


                <ul class="list-group mb-3" id="list-group">
                </ul>
                <input type="hidden" id="hidden" name="hidden">
                <button type="submit" class="btn btn-primary mb-3" onclick="insertHidden()">Добавить сделку</button>
                <script>
                    const fieldset = document.querySelector("fieldset[form='addDeal']")
                    const submit = document.querySelector('#submit');
                    const seller = document.querySelector('#seller');
                    const sellerValue = seller.options[seller.selectedIndex].value;
                    const buyer = document.querySelector('#buyer');
                    const buyerValue = buyer.options[buyer.selectedIndex].value;
                    const product = document.querySelector('#product');
                    const productValue = product.options[product.selectedIndex].value;
                    const amount = document.querySelector('#amount');
                    if (sellerValue === 'no_sellers' || buyerValue === 'no_buyers' || productValue === 'no_products') {
                        fieldset.setAttribute('disabled', 'disabled')
                    }
                    if (seller.getAttribute('disabled') || buyer.getAttribute('disabled') || product.getAttribute('disabled')) {
                        fieldset.setAttribute('disabled', 'disabled');
                    }

                    function insertHidden() {
                        let count = 0
                        const matchesDiv = document.querySelectorAll("div.fw-bold")
                        const matchesSpan = document.querySelectorAll("span.badge")
                        const hiddenInput = document.querySelector('#hidden')
                        while (matchesDiv.length !== count) {
                            hiddenInput.value += matchesDiv[count].innerHTML + "," + matchesSpan[count].innerHTML + ";"
                            count++
                        }
                    }
                </script>
            </fieldset>
        </form>
        <a href="../../../public/index.php" class="btn btn-primary mb-3">Вернуться на главную страницу</a>
    </div>
    <script src="../../../public/js/bootstrap.min.js"></script>
    </body>
<?php
include "../util/footer.php";
