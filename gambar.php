<?php
// Mengambil URL gambar dari parameter query string
if (!isset($_GET['s']) || empty($_GET['s'])) {
    header('HTTP/1.1 400 Bad Request');
    echo 'URL parameter is missing.';
    exit;
}

// Validasi URL
$imageUrl = filter_var($_GET['s'], FILTER_VALIDATE_URL);
if ($imageUrl === false) {
    header('HTTP/1.1 400 Bad Request');
    echo 'Invalid URL.';
    exit;
}

// Mengambil konten gambar dengan cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $imageUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);

// Menyeting user agent agar tampak seperti browser Chrome
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');

$imageContent = curl_exec($ch);

// Cek jika terjadi kesalahan saat pengambilan gambar
if (curl_errno($ch)) {
    header('HTTP/1.1 500 Internal Server Error');
    echo 'Error fetching the image.';
    curl_close($ch);
    exit;
}

$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
//$info = curl_getinfo($ch);

curl_close($ch);

// Jika gambar tidak ditemukan, kirimkan status 404
if ($httpCode != 200) {
    header('HTTP/1.1 404 Not Found');
    echo 'Image not found.';
    exit;
}

// Menentukan tipe konten gambar dari header respons cURL
header('Content-Type: ' . $contentType);

// Menyajikan konten gambar kepada pengguna
//print_r ($info);
echo $imageContent;
?>
