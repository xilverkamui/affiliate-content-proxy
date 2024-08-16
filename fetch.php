<?php
function fetchContent($url, $options = []) {
    // Mengambil konten dari URL dengan cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);

    // Mengatur user agent agar tampak seperti browser Chrome
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');

    $response = curl_exec($ch);

    // Cek jika terjadi kesalahan saat pengambilan konten
    if (curl_errno($ch)) {
        curl_close($ch);
        return ['status' => 500, 'content' => 'Error fetching the content.'];
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
    curl_close($ch);

    // Jika konten tidak ditemukan, kirimkan status 404
    if ($httpCode != 200) {
        return ['status' => 404, 'content' => 'Content not found.'];
    }

    // Memproses penggantian kata jika opsi "replace_words" disediakan
    if (isset($options['replace_words']) && is_array($options['replace_words'])) {
        foreach ($options['replace_words'] as $word) {
            if (isset($word['replacing']) && isset($word['replacement'])) {
                $response = str_replace($word['replacing'], $word['replacement'], $response);
            }
        }
    }
    
     // Mengganti URL gambar agar menggunakan proxy gambar.php
    $response = preg_replace_callback('/<img\s[^>]*src=["\']([^"\']+)["\'][^>]*>/i', function ($matches) {
        $originalUrl = $matches[1];
        $proxiedUrl = 'gambar.php?s=' . urlencode($originalUrl);
        return str_replace($originalUrl, $proxiedUrl, $matches[0]);
    }, $response);

    // Mengembalikan tipe konten dan konten yang diambil
    return ['status' => 200, 'content' => $response, 'contentType' => $contentType];
}

?>
