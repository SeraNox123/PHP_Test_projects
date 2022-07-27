<?php

session_start();

require "../../../vendor/autoload.php";
require "../util/sanitize_input.php";

use App\Product\Boots;
use App\Product\Camera;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productType = $_POST['productType'];
    $product = null;
    switch ($productType) {
        case 'Ботинки':
        {
            $product = new Boots();
            $product->setSize($_POST['size']);
            $product->setColor(sanitize_input($_POST['color']));
            break;
        }
        case 'Фотоаппарат':
        {
            $product = new Camera();
            $product->setDigital($_POST['type'] ?? false);
            $product->setMegapixelCount($_POST['megapixelCount']);
            break;
        }
    }
    $product->setName(sanitize_input($_POST['name']));
    $product->setPrice($_POST['price']);
    $product->setDiscount($_POST['discount']);
    $_SESSION['products'][] = serialize($product);
}

$title = "Добавить товар";
include "../util/header.php";
?>
<body>
<div class="container">
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <fieldset>
            <legend>Добавить товар</legend>
            <div class="form-group">
                <label for="name">Наименование</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Введите наименование товара"
                       required>
            </div>
            <div class="form-group">
                <label for="price">Цена</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="Введите цену товара"
                       required>
            </div>
            <div class="form-group">
                <label for="discount">Размер скидки (%)</label>
                <input type="number" class="form-control" id="discount" name="discount"
                       placeholder="Введите размер скидки на товар" required>
            </div>
            <div class="form-group">
                <label for="productType">Выберите тип товара</label>
                <select class="form-select" id="productType" name="productType" onchange="changeFields(this.value)">
                    <option>Ботинки</option>
                    <option>Фотоаппарат</option>
                </select>
            </div>
            <fieldset name="boots">
                <div class="form-group" id="divSize">
                    <label for="size">Размер</label>
                    <input type="number" class="form-control" id="size" name="size" placeholder="Введите размер обуви"
                           required>
                </div>
                <div class="form-group" id="divColor">
                    <label for="color">Цвет</label>
                    <input type="text" class="form-control" id="color" name="color" placeholder="Введите цвет обуви">
                </div>
            </fieldset>
            <fieldset name="camera" hidden disabled>
                <div class="form-group mt-2 mb-2" id="divType">
                    <label for="type">Цифровой</label>
                    <input type="checkbox" class="form-check-input" id="type" name="type" value=true>
                </div>
                <div class="form-group" id="divMegapixelCount">
                    <label for="megapixelCount">Количество мегапикселей</label>
                    <input type="number" class="form-control" id="megapixelCount" name="megapixelCount"
                           placeholder="Введите количество мегапикселей в фотоаппарате" required>
                </div>
            </fieldset>
            <script>
                function changeFields(value) {
                    const form = document.forms[0];
                    const boots = form.elements.namedItem('boots');
                    const camera = form.elements.namedItem('camera');

                    switch (value) {
                        case 'Ботинки': {
                            boots.removeAttribute('hidden');
                            boots.removeAttribute('disabled');
                            camera.setAttribute('hidden', 'hidden');
                            camera.setAttribute('disabled', 'disabled');
                            break;
                        }
                        case 'Фотоаппарат': {
                            boots.setAttribute('hidden', 'hidden');
                            boots.setAttribute('disabled', 'disabled');
                            camera.removeAttribute('hidden');
                            camera.removeAttribute('disabled');
                            break;
                        }
                    }
                }
            </script>
            <br>
            <button type="submit" class="btn btn-primary">Добавить</button>
        </fieldset>
    </form>
    <br>
    <a href="../../../public/index.php" class="btn btn-primary">Вернуться на главную</a>
</div>
<script src="../../../public/js/bootstrap.min.js"></script>
</body>
<?php include "../util/footer.php"; ?>


