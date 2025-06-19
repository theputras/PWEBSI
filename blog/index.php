<?php  
// Fungsi untuk membersihkan dan men-decode XML  
function cleanAndDecodeXML($xmlPath) {  
    // Baca konten file  
    $xmlContent = file_get_contents($xmlPath);  
    
    // Ganti karakter khusus yang mungkin menyebabkan error  
    $xmlContent = preg_replace('/&(?!amp;|lt;|gt;|apos;|quot;)/', '&amp;', $xmlContent);  
    
    // Buat DOM Document  
    $dom = new DOMDocument();  
    $dom->preserveWhiteSpace = false;  
    
    // Nonaktifkan error reporting untuk XML parsing  
    libxml_use_internal_errors(true);  
    
    // Muat XML  
    if (!$dom->loadXML($xmlContent)) {  
        $errors = libxml_get_errors();  
        foreach ($errors as $error) {  
            echo "XML Error: ", $error->message;  
        }  
        libxml_clear_errors();  
        return [];  
    }  
    
    // Ambil semua artikel  
    $articles = $dom->getElementsByTagName('article');  
    $processedArticles = [];  
    
    // Proses artikel sesuai urutan di XML  
    foreach ($articles as $article) {  
        $processedArticle = [  
            'title' => html_entity_decode($article->getElementsByTagName('title')[0]->nodeValue),  
            'link' => html_entity_decode($article->getElementsByTagName('link')[0]->nodeValue),  
            'image' => html_entity_decode($article->getElementsByTagName('image')[0]->nodeValue),  
            'category' => html_entity_decode($article->getElementsByTagName('category')[0]->nodeValue),  
            'date' => html_entity_decode($article->getElementsByTagName('date')[0]->nodeValue)  
        ];  
        $processedArticles[] = $processedArticle;  
    }  
    
    return $processedArticles;  
}  

// Ambil artikel  
$articles = cleanAndDecodeXML('./assets/listArticle.xml');  
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Berita</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./assets/index.css">
    <script src="./assets/index.js" defer></script>
    <!-- Bootstrap 5 JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</head>
<body class="bg-dark">
    <div class="container">
    
        <nav class="mt-3 position-sticky top-0 navbar navbar-expand-xl navbar-dark rounded-3" style="z-index: 1020;">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <!-- Logo di kiri -->
                <div class="d-flex align-items-center justify-content-start">
                    <a class="navbar-brand" href="./">
                        <img src="./assets/logo.png" alt="" class="img-fluid" style="max-height: 20px;">
                    </a>
                </div>
                
                <!-- Button to toggle the menu on mobile -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <!-- Navigation bar buttons on the right -->
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <button class="btn btn-link nav-link">Berita Terbaru</button>
                        </li>
                        <li class="nav-item">
                            <button class="btn btn-link nav-link">Tentang Kami</button>
                        </li>
                        <li class="nav-item">
                            <button class="btn btn-link nav-link">Kontak</button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
       <section class="container mt-4">
    <div class="ad-box bg-dark border border-secondary rounded-3 overflow-hidden" style="height: 250px;">
        <div class="w-100 h-100 d-flex justify-content-center align-items-center" style="background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);">
            <div class="text-center text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="mb-3 opacity-70">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="3" y1="9" x2="21" y2="9"></line>
                    <line x1="9" y1="21" x2="9" y2="9"></line>
                </svg>
                <h4 class="mb-2">Ruang Iklan</h4>
                <p class="text-muted">728 x 250 px</p>
            </div>
        </div>
    </div>
</section>
        <main class="container mt-4">
        <h2 class="text-center text-white m-5">Portal Berita</h2>
            <!-- Portfolio Grid -->
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php foreach ($articles as $article): ?>
                    <a href="<?php echo htmlspecialchars($article['link']); ?>">
                        <div class="col">
                            <div class="card">
                                <div class="imgArticle">
                                    <img src="<?php echo htmlspecialchars($article['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($article['title']); ?>">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($article['title']); ?></h5>
                                    <div class="d-flex justify-content-between small" style='color:#6d8591;'>
                                        <span><?php echo htmlspecialchars($article['category']); ?></span>
                                        <span><?php echo htmlspecialchars($article['date']); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>

           
        </main>

         <footer class="d-flex align-items-center justify-content-center rounded-3 mt-5 py-3">
    <div class="container-fluid text-center">
        <span class="text-white">
            &copy; 2020 - <span id="currentYear"></span> THE PUTRAS News. All rights reserved.
        </span>
    </div>
</footer>
    </div>

    
</body>
</html>