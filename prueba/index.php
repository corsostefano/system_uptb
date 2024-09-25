<?php 

$hashedPassword = '$2y$10$jFjNXWctX1BznTSDtkW1Du5KgQAbA5G7fyUfMoYGT5xikNIcxiY86';
$password = '12345678';

if (password_verify($password, $hashedPassword)) {
    echo 'La contraseña es correcta.';
} else {
    echo 'La contraseña es incorreeecta.';
}

?>

