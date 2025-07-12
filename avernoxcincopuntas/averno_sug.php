<?php
// Conexión a la base de datos
$mysqli = new mysqli('localhost','root','','averno_sug');
if($mysqli->connect_errno) {
  die("Error de conexión: " . $mysqli->connect_error);
}

// Sanitizar datos
$email   = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ?: null;
$mensaje = trim($_POST['mensaje']);

// Preparar e insertar
$stmt = $mysqli->prepare(
  "INSERT INTO sugerencias (email, mensaje) VALUES (?, ?)"
);
$stmt->bind_param('ss', $email, $mensaje);

if($stmt->execute()) {
  // Redirigir a página de “gracias” (crea gracias.html)
  header('Location: gracias/');
  exit;
} else {
  echo "Error al guardar la sugerencia, inténtalo de nuevo.";
}
