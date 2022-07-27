<?php
$connection = require_once 'Connection.php';
$notes = $connection->getNotes();

$currentNote = ['id' => '', 'title' => '', 'description' => ''];

if (isset($_GET['id'])) {
    $currentNote = $connection->getNoteById($_GET['id']);
}

?>
<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Document</title>

    <link rel="stylesheet" href="app.css">
</head>

<body>
<div>
    <form class="new-note" action="save.php" method="post">
        <input type="hidden" name="id" value="<?php echo $currentNote['id'] ?>"
        <label>
            <input type="text" name="title" placeholder="Note title" autocomplete="off"
                   value="<?php echo $currentNote['title'] ?>">
        </label>
        <label>
            <textarea name="description" cols="30" rows="4" placeholder="Note Description"
            ><?php echo $currentNote['description'] ?></textarea>
        </label>
        <button>
            <?php if ($currentNote['id']): ?>
                Update Note
            <?php else: ?>
                New Note
            <?php endif; ?>
        </button>
    </form>
    <div class="notes">
        <?php foreach ($notes as $note): ?>
            <div class="note">
                <div class="title">
                    <a href="?id=<?php echo $note['id'] ?>"><?php echo $note['title'] ?></a>
                </div>
                <div class="description">
                    <?php echo $note['description'] ?>
                </div>
                <small><?php echo $note['create_date'] ?></small>
                <form action="delete.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $note['id'] ?>">
                    <button class="close">X</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>