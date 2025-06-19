<?php
header('Content-Type: application/xml');

// Misalnya data artikel diambil dari database
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$articlesPerPage = 3;

// Contoh data artikel (biasanya diambil dari database)
$articles = [
    ['title' => 'Artikel Baru 1', 'link' => './article-baru-1.php', 'image' => 'https://contoh.com/gambar-1.jpg'],
    ['title' => 'Artikel Baru 2', 'link' => './article-baru-2.php', 'image' => 'https://contoh.com/gambar-2.jpg'],
    // ... artikel lainnya
];

// Mulai XML
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<articles>';

// Hitung offset berdasarkan halaman
$offset = ($page - 1) * $articlesPerPage;
$pageArticles = array_slice($articles, $offset, $articlesPerPage);

// Generate artikel XML
foreach ($pageArticles as $article) {
    echo '<article>';
    echo '<title>' . htmlspecialchars($article['title']) . '</title>';
    echo '<link>' . htmlspecialchars($article['link']) . '</link>';
    echo '<image>' . htmlspecialchars($article['image']) . '</image>';
    echo '</article>';
}

echo '</articles>';