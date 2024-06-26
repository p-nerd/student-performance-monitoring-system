<?php

$target = __DIR__ . '/../tmp/images';
$link = __DIR__ . '/../public/images';

// Check if the target directory exists
if (!is_dir($target)) {
    die("Target directory does not exist: $target");
}

// Check if the symbolic link already exists
if (is_link($link)) {
    echo "Symbolic link already exists: $link";
} else {
    // Create the symbolic link
    if (!symlink($target, $link)) {
        echo "Failed to create symbolic link: $link -> $target";
    }
}
