<?php
/**
 * Санация строки, полученной от пользователя
 * @param string $data
 * @return string
 */
function sanitize_input(string $data): string
{
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data);
}