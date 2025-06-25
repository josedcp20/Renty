<?php
$password_plano = "admin123";
$hash = password_hash($password_plano, PASSWORD_DEFAULT);
echo "Hash generado: " . $hash;
?>
