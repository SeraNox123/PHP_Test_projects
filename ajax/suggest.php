<?php
$people[] = "Hal";
$people[] = "Ernie";
$people[] = "Johanna";
$people[] = "John";
$people[] = "Linda";

$q = $_REQUEST['q'];

$suggestion = "";

if ($q !== "") {
    $q = strtolower($q);
    $len = strlen($q);
    foreach ($people as $person) {
        if (stristr($q, substr($person, 0, $len))) {
            if ($suggestion === "") {
                $suggestion = $person;
            } else {
                $suggestion .= ", $person";
            }
        }
    }
}

echo $suggestion === "" ? "No Suggestion" : $suggestion;