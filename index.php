<?php
// Memasukkan file fetch.php untuk menggunakan fungsi fetchContent
require_once 'fetch.php';
$url = 'https://www.suarasurabaya.net/potret-netter/evakuasi-kecelakaan-bus-di-trowulan-mojokerto/';

// Validasi URL
$url = filter_var($url, FILTER_VALIDATE_URL);
if ($url === false) {
    header('HTTP/1.1 400 Bad Request');
    echo 'Invalid URL.';
    exit;
}

// Menyusun opsi penggantian kata (sesuaikan sesuai kebutuhan)
$options = [
    'replace_words' => [
        ['replacing' => 'oldWord', 'replacement' => 'newWord'],
        ['replacing' => 'anotherOldWord', 'replacement' => 'anotherNewWord']
    ]
];


// Memanggil fungsi fetchContent
$result = fetchContent($url, $options);

// Mengatur header dan menyajikan konten
header('HTTP/1.1 ' . $result['status']);
if ($result['status'] === 200) {
    header('Content-Type: ' . $result['contentType']);
}
echo $result['content'];
?>
