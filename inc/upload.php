<?php

function upload2($file, $rep = "uploads/")
{
    $uploadDir = __DIR__ . '/../' . $rep;

    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0755, true)) {
            return null;
        }
    }

    $maxSize = 50 * 1024 * 1024;
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];


    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($file) && is_array($file)) {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        if ($file['size'] > $maxSize) {
            return null;
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        if (!$finfo) {
            return null;
        }

        $mime = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!in_array($mime, $allowedMimeTypes)) {
            return null;
        }

        $originalName = pathinfo(basename($file['name']), PATHINFO_FILENAME);
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $newName = $originalName . '_' . uniqid() . '.' . $extension;
        $destination = $uploadDir . $newName;
        $destination2 = $rep . $newName;


        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return $destination2;
        }
    }

    return null;
}