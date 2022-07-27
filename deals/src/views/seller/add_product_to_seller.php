<?php

session_start();

require_once "../../App/Participant/Seller.php";
require_once "../../App/Product/Product.php";
require_once "../../App/Product/Boots.php";
require_once "../../App/Product/Camera.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // свазять выбранный продукт и продавца
    function getSeller(): array
    {
        $count = 0;
        foreach ($_SESSION['sellers'] as $seller) {
            $seller = unserialize($seller);
            $sellerString = $seller->getName() . ", " . $seller->getAddress();
            if ($sellerString == $_POST['seller']) {
                return [$seller, $count];
            }
            $count++;
        }
        return [0];
    }

    function getProduct(): array
    {
        $count = 0;
        foreach ($_SESSION['products'] as $product) {
            $product = unserialize($product);
            $productString = $product->getName() . ", " . $product->getPrice() . " (доступно: " . $product->getAmount(
                ) . ")";
            if ($productString == $_POST['product']) {
                return [$product, $count];
            }
            $count++;
        }
        return [0];
    }

    $seller = getSeller()[0];
    $sellerIndex = getSeller()[1];
    $product = getProduct()[0];
    $productIndex = getProduct()[1];

    $seller->addProducts($product, $_POST['amount']);
    $product->setAmount($product->getAmount() - $_POST['amount']);

    $_SESSION['sellers'][$sellerIndex] = serialize($seller);
    $_SESSION['products'][$productIndex] = serialize($product);
}

$title = "Связать товар с продавцом";
include "../util/header.php";
?>

<body>
<div class="container">
    <form method="POST" action="<?php
    echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <fieldset>
            <legend>Связать товар с продавцом</legend>
            <div class="form-group">
                <label for="seller">Выберите продавца</label>
                <select class="form-select" id="seller" name="seller">
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
                <script>
                    const sellerSelect = document.querySelector('#seller');
                    const sellerSelectValue = sellerSelect.options[sellerSelect.selectedIndex].value;
                    if (sellerSelectValue === "no_sellers") {
                        sellerSelect.setAttribute('disabled', 'disabled');
                    } else {
                        sellerSelect.removeAttribute('disabled');
                    }
                </script>
            </div>
            <div class="form-group">
                <label for="product">Выберите товар</label>
                <select class="form-select" id="product" name="product" onchange="changeMax()">
                    <?php
                    if (!isset($_SESSION['products'])) {
                        echo "<option value='no_products'>Товары не добавлены</option>";
                    } else {
                        $count = 0;
                        foreach ($_SESSION['products'] as $product) {
                            $product = unserialize($product);
                            if ($product->getAmount() > 0) {
                                echo "<option>" . $product->getName() . ", " . $product->getPrice(
                                    ) . " (доступно: " . $product->getAmount() . ")" . "</option>";
                                $count++;
                            }
                        }
                        if ($count == 0) {
                            echo "<option value='no_products'>" . "Все товары были привязаны" . "</option>";
                        }
                    }
                    ?>
                </select>
                <script>
                    let productSelect = document.querySelector('#product');
                    let productSelectValue = productSelect.options[productSelect.selectedIndex].value;
                    if (productSelectValue === "no_products") {
                        productSelect.setAttribute('disabled', 'disabled');
                    } else {
                        productSelect.removeAttribute('disabled');
                    }
                </script>
            </div>
            <div class="form-group">
                <label for='amount'>Количество</label>;
                <input type='number' class='form-control' id='amount' name='amount' placeholder='Введите количество'
                       required min='1'>
            </div>
            <script>
                const amount = document.querySelector('#amount');

                if (productSelect.getAttribute('disabled')) {
                    amount.setAttribute('disabled', 'disabled');
                } else {
                    amount.removeAttribute('disabled');
                    changeMax();
                }

                // меняет аттрибут у количества 'max' в зависимости от выбранного товара
                function changeMax() {
                    let productSelectValue = productSelect.options[productSelect.selectedIndex].value;
                    const findColon = productSelectValue.search(":");
                    const findClosingBracket = productSelectValue.search("\\)");
                    const productAmount = productSelectValue.substring(findColon + 2, findClosingBracket);
                    amount.setAttribute("max", productAmount);
                }
            </script>
            <br>
            <button type="submit" class="btn btn-primary" id="submit">Добавить</button>
            <script>
                const submit = document.querySelector('#submit');
                const seller = document.querySelector('#seller');
                if (seller.getAttribute('disabled') || productSelect.getAttribute('disabled')) {
                    submit.setAttribute('disabled', 'disabled');
                }
            </script>
        </fieldset>
    </form>
    <br>
    <a href="../../../public/index.php" class="btn btn-primary">Вернуться на главную</a>
</div>
<script src="../../../public/js/bootstrap.min.js"></script>
</body>
<?php
include "../util/footer.php"; ?>
