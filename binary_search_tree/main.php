<?php
require_once "BinarySearchTree.php";

$bst = new BinarySearchTree(2);

$bst->add($bst->root, 3);
$bst->add($bst->root, 5);
$bst->add($bst->root, 6);
$bst->add($bst->root, 10);
$bst->add($bst->root, 11);

$found = $bst->search($bst->root,2);
if ($found) {
    echo "Элемент найден";
} else {
    echo "False";
}

echo "<br>";

$tree = $bst->walk();
foreach ($tree as $node) {
    echo "{$node->number}\n";
}