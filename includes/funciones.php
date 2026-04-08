<?php
/**
 * Sube una imagen al servidor y retorna el nombre generado
 * @param array $archivo  $_FILES["imagen"]
 * @return string|false   Nombre del archivo guardado o false si falla
 */
function subirImagen(array $archivo): string|false {
  // Sin archivo
  if ($archivo["error"] === UPLOAD_ERR_NO_FILE) return false;

  if ($archivo["error"] !== UPLOAD_ERR_OK) {
    error_log("Upload error: " . $archivo["error"]);
    return false;
  }

  // Tipos permitidos
  $tipos_ok = ["image/jpeg","image/png","image/webp","image/gif"];
  $finfo    = new finfo(FILEINFO_MIME_TYPE);
  $tipo     = $finfo->file($archivo["tmp_name"]);

  if (!in_array($tipo, $tipos_ok)) return false;

  // Tamaño máximo: 3 MB
  if ($archivo["size"] > 3 * 1024 * 1024) return false;

  // Crear directorio si no existe
  $dir = __DIR__ . "/../uploads/";
  if (!is_dir($dir)) mkdir($dir, 0755, true);

  // Nombre único con fecha
  $ext  = strtolower(pathinfo($archivo["name"], PATHINFO_EXTENSION));
  $ext  = ($ext === "jpg") ? "jpeg" : $ext; // Normalizar
  $nombre = date("Ymd_His") . "_" . bin2hex(random_bytes(4)) . "." . $ext;

  if (!move_uploaded_file($archivo["tmp_name"], $dir . $nombre)) {
    return false;
  }

  return $nombre;
}
