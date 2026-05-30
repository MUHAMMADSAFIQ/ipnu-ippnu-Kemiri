<?php
/**
 * Autocrop and center IPNU & IPPNU logos perfectly.
 * Generates transparent square PNGs for both logos and a perfect square favicon.
 */

function autocrop_and_square($src_img) {
    $width = imagesx($src_img);
    $height = imagesy($src_img);
    
    $min_x = $width;
    $min_y = $height;
    $max_x = 0;
    $max_y = 0;
    
    // Find the bounding box of non-transparent pixels
    for ($x = 0; $x < $width; $x++) {
        for ($y = 0; $y < $height; $y++) {
            $color = imagecolorat($src_img, $x, $y);
            $alpha = ($color >> 24) & 0x7F;
            if ($alpha < 115) { // 127 is fully transparent, so < 115 is mostly solid
                if ($x < $min_x) $min_x = $x;
                if ($x > $max_x) $max_x = $x;
                if ($y < $min_y) $min_y = $y;
                if ($y > $max_y) $max_y = $y;
            }
        }
    }
    
    // Check if the image is completely empty
    if ($max_x < $min_x || $max_y < $min_y) {
        return $src_img; 
    }
    
    $cropped_w = $max_x - $min_x + 1;
    $cropped_h = $max_y - $min_y + 1;
    
    // Create a perfect square canvas
    $dim = max($cropped_w, $cropped_h);
    $squared = imagecreatetruecolor($dim, $dim);
    imagealphablending($squared, false);
    imagesavealpha($squared, true);
    
    $transparent = imagecolorallocatealpha($squared, 0, 0, 0, 127);
    imagefill($squared, 0, 0, $transparent);
    
    // Center the cropped image inside the square canvas
    $dx = (int)(($dim - $cropped_w) / 2);
    $dy = (int)(($dim - $cropped_h) / 2);
    
    imagecopy($squared, $src_img, $dx, $dy, $min_x, $min_y, $cropped_w, $cropped_h);
    
    return $squared;
}

// Ensure the directory exists
$source_path = 'public/images/LOGO RESMI IPNUIPPNU by diqies 2.png';
if (!file_exists($source_path)) {
    die("Error: Source image not found at $source_path\n");
}

$src = imagecreatefrompng($source_path);
$w = imagesx($src);
$h = imagesy($src);
$half_w = (int)($w / 2);

echo "Processing source image: {$w}x{$h}...\n";

// 1. IPNU logo (left half)
$ipnu_raw = imagecreatetruecolor($half_w, $h);
imagealphablending($ipnu_raw, false);
imagesavealpha($ipnu_raw, true);
$trans = imagecolorallocatealpha($ipnu_raw, 0, 0, 0, 127);
imagefill($ipnu_raw, 0, 0, $trans);
imagecopy($ipnu_raw, $src, 0, 0, 0, 0, $half_w, $h);

echo "Autocropping IPNU (Left Half)...\n";
$ipnu_square = autocrop_and_square($ipnu_raw);
imagepng($ipnu_square, 'public/images/ipnu-logo.png');
echo "Saved IPNU logo to public/images/ipnu-logo.png\n";

// 2. IPPNU logo (right half)
$ippnu_raw = imagecreatetruecolor($half_w, $h);
imagealphablending($ippnu_raw, false);
imagesavealpha($ippnu_raw, true);
imagefill($ippnu_raw, 0, 0, $trans);
imagecopy($ippnu_raw, $src, 0, 0, $half_w, 0, $half_w, $h);

echo "Autocropping IPPNU (Right Half)...\n";
$ippnu_square = autocrop_and_square($ippnu_raw);
imagepng($ippnu_square, 'public/images/ippnu-logo.png');
echo "Saved IPPNU logo to public/images/ippnu-logo.png\n";

// 3. Create perfect favicon using only the round IPNU logo
// Resize the autocropped IPNU square to standard 64x64 or 128x128 for crisp tab display
$fav_dim = 128;
$fav = imagecreatetruecolor($fav_dim, $fav_dim);
imagealphablending($fav, false);
imagesavealpha($fav, true);
imagefill($fav, 0, 0, $trans);

imagecopyresampled(
    $fav, $ipnu_square, 
    0, 0, 0, 0, 
    $fav_dim, $fav_dim, 
    imagesx($ipnu_square), imagesy($ipnu_square)
);

imagepng($fav, 'public/favicon.png');
echo "Saved circular Favicon to public/favicon.png\n";

// Clean up
imagedestroy($src);
imagedestroy($ipnu_raw);
imagedestroy($ipnu_square);
imagedestroy($ippnu_raw);
imagedestroy($ippnu_square);
imagedestroy($fav);

echo "Autocrop operations completed successfully!\n";
