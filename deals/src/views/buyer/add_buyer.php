<?php

session_start();
require "../../../vendor/autoload.php";
require "../util/sanitize_input.php";

use App\Participant;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $buyer = new Participant();
    $buyer->setName(sanitize_input($_POST['name']));
    $buyer->setAddress(sanitize_input($_POST['address']));
    $_SESSION['buyers'][] = serialize($buyer);
}

$title = "Добавить покупателя";
include "../util/header.php";
?>

    <body>
    <div class="container">
        <form method="POST" action="<?php
        echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <fieldset>
                <legend>Добавить покупателя</legend>
                <div class="form-group">
                    <label for="name">Имя</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Введите имя" required>
                </div>
                <div class="form-group">
                    <label for="address">Адрес</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Введите адрес">
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Добавить</button>
            </fieldset>
        </form>
        <br>
        <a href="../../../public/index.php" class="btn btn-primary">Вернуться на главную</a>
    </div>
    <script src="../../../public/js/bootstrap.min.js"></script>
    </body>
<?php
include_once "../util/footer.php" ?>