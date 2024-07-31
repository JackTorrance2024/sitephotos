<?php
// Erreur de rapport pour débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$directory = 'photos';
$photos = array();

if (is_dir($directory)) {
    $iterator = new DirectoryIterator($directory);
    foreach ($iterator as $fileinfo) {
        if ($fileinfo->isFile()) {
            $photos[] = $fileinfo->getFilename();
        }
    }
} else {
    // Message d'erreur si le répertoire n'est pas trouvé
    echo json_encode(array('error' => 'Directory not found'));
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galerie de Photos</title>
    <link rel="stylesheet" href="gallery.css">
    <link rel="shortcut icon" type="image/x-icon" href="logo.jpg" />
</head>
<body>
<div class="gallery">
    <?php foreach ($photos as $photo): ?>
        <?php
        $filepath = $directory . '/' . htmlspecialchars($photo);
        $imagesize = getimagesize($filepath);
        $largeur = $imagesize[0];
        $hauteur = $imagesize[1];

        if ($hauteur > $largeur) {
            echo '<div class="blocv">';
            echo '<img src="' . $filepath . '" alt="Photo" class="verticale">';
            echo '</div>';
        } else {
            echo '<div class="bloch">';
            echo '<img src="' . $filepath . '" alt="Photo" class="horizontale">';
            echo '</div>';
        }
        ?>
    <?php endforeach; ?>
</div>
</body>
</html>
