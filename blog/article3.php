<?php
// article1.php
// Fungsi untuk membersihkan dan mengganti entitas bermasalah
function cleanXmlBeforeParsing($xmlContent) {
    // Ganti entitas yang tidak dikenal dengan versi aman
    $xmlContent = preg_replace('/&(?!amp;|lt;|gt;|quot;|apos;)/', '&amp;', $xmlContent);
    
    // Hapus karakter kontrol yang tidak valid
    $xmlContent = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', '', $xmlContent);
    
    return $xmlContent;
}

// Baca file XML dan bersihkan
$xmlFile = './assets/article/article3.xml';
$xmlContent = file_get_contents($xmlFile);
$cleanedXmlContent = cleanXmlBeforeParsing($xmlContent);

// Gunakan file sementara atau parsing langsung
libxml_use_internal_errors(true);
$xml = simplexml_load_string($cleanedXmlContent);

if ($xml === false) {
    $errors = libxml_get_errors();
    echo "XML Loading Errors:\n";
    foreach ($errors as $error) {
        echo $error->message . "\n";
    }
    libxml_clear_errors();
    exit;
}   

// Extract content from XML
$title = $xml->title;
$user = $xml->informationBar->user->name;
$date = $xml->informationBar->calendar->date;
$time = $xml->informationBar->clock->time;

$sections = $xml->content->section;
$subsections = $xml->content->subsection;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
     <!-- Bootstrap 5 JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
     <!-- Include Iconify Script -->
     <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
     
     <link rel="stylesheet" href="./assets/article.css">
     <script src="./assets/article.js" defer></script>
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

<!-- Section for the article content -->
        <main class="container mt-4">
        
<!-- Breadcrumb navigation -->
       <nav aria-label="Breadcrumb" class="mb-4 flex items-center gap-1">
    <a class="text-xs font-semibold" style="color: #6393c9;" href="./" dtr-evt="breadcrumb" dtr-sec="breadcrumbkanal" dtr-act="breadcrumb kanal" onclick="_pt(this)" dtr-ttl="home">
        THE PUTRAS News
    </a>
    <svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M2.33288 7.00506C2.49621 7.16839 2.75955 7.16839 2.92288 7.00506L5.69288 4.23506C5.82288 4.10506 5.82288 3.89506 5.69288 3.76506L2.92288 0.995059C2.75955 0.831725 2.49621 0.831725 2.33288 0.995059C2.16955 1.15839 2.16955 1.42173 2.33288 1.58506L4.74621 4.00172L2.32955 6.41839C2.16955 6.57839 2.16955 6.84506 2.33288 7.00506Z" fill="#FFFFFF"></path>
    </svg>
    <a class="text-xs font-semibold" style="color: #6393c9;" href="" dtr-evt="breadcrumb" dtr-sec="breadcrumbkanal" dtr-act="breadcrumb kanal" onclick="_pt(this)" dtr-ttl="Tech">
        Tech     
    </a>
    <svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M2.33288 7.00506C2.49621 7.16839 2.75955 7.16839 2.92288 7.00506L5.69288 4.23506C5.82288 4.10506 5.82288 3.89506 5.69288 3.76506L2.92288 0.995059C2.75955 0.831725 2.49621 0.831725 2.33288 0.995059C2.16955 1.15839 2.16955 1.42173 2.33288 1.58506L4.74621 4.00172L2.32955 6.41839C2.16955 6.57839 2.16955 6.84506 2.33288 7.00506Z" fill="#FFFFFF"></path>
    </svg>
    <a aria-current="page" class="text-xs font-semibold" style="color: #6393c9;" href="">
        Berita Tech    
    </a>
</nav>
            <article>
                <h2 class="mb-3 text-center"><?php echo $title; ?></h2>
                <div class="d-flex justify-content-center align-items-center mb-4">
    <div class="d-flex align-items-center pe-3 me-3 gap-1 border-end border-white">
        <span class="iconify" data-icon="mdi:account" style="font-size: 20px;" class="me-4"></span>
        <span><?php echo $user; ?></span>
    </div>
    <div class="d-flex align-items-center pe-3 me-3 gap-1 border-end border-white">
        <span class="iconify" data-icon="bx:calendar" style="font-size: 20px;" class="me-4"></span>
        <span><?php echo $date; ?></span>
    </div>
    <div class="d-flex align-items-center gap-1">
        <span class="iconify" data-icon="mdi:clock" style="font-size: 20px;" class="me-4"></span>
        <span><?php echo $time; ?></span>
    </div>
</div>


<!-- Main Content Article -->
                <div class="mt-5 article-content">
                   <?php
                   
                   
// Function to parse and apply text styling
function applyTextStyling($text) {
    // Replace styling markers with HTML tags
    
    // Figcaption: Wrap text between [figcaption] tags
    $styledText = preg_replace('/\[figcaption\](.*?)\[\/figcaption\]/i', '<figcaption>$1</figcaption>', $text);
    
    // Bold: Wrap text between <strong> tags
    $styledText = preg_replace('/\[bold\](.*?)\[\/bold\]/i', '<strong>$1</strong>', $styledText);
    
    // Em (emphasized): Wrap text between <em> tags
    $styledText = preg_replace('/\[em\](.*?)\[\/em\]/i', '<em>$1</em>', $styledText);
    
    // Italic: Wrap text between <i> tags
    $styledText = preg_replace('/\[italic\](.*?)\[\/italic\]/i', '<i>$1</i>', $styledText);
    
    // Underline: Wrap text between <u> tags
    $styledText = preg_replace('/\[underline\](.*?)\[\/underline\]/i', '<u>$1</u>', $styledText);
    
    // Strikethrough: Wrap text between <s> tags
    $styledText = preg_replace('/\[strikethrough\](.*?)\[\/strikethrough\]/i', '<s>$1</s>', $styledText);
    
    return $styledText;
}

// Modify the existing paragraph rendering loops
foreach ($sections as $section) {
        // Render image with figcaption
    echo "<figure class='mb-5'>";
    echo "<img src='" . $section->image['src'] . "' alt='" . $section->image['alt'] . "' class='img-fluid mb-3 d-block mx-auto' style='border-radius: 10px;'>";
    
    // Check if image has a caption attribute from XML
    if (!empty($section->image['caption'])) {
        echo "<figcaption class='text-center mt-2 small' style='color:#6d8591;'>" . $section->image['caption'] . "</figcaption>";
    }
    
    // Add separate figcaption if exists
    if (!empty($section->figcaption)) {
        echo "<figcaption class='text-center mt-2 small' style='color:#6d8591;'>" . applyTextStyling($section->figcaption) . "</figcaption>";
    }
    
    echo "</figure>";

    // Loop through paragraphs in this section with styling
    foreach ($section->paragraph as $paragraph) {
        echo "<p class='text-justify' style='margin-bottom: 10px;'>" . applyTextStyling($paragraph) . "</p>";
    }
}

// Similar modification for subsections
foreach ($subsections as $subsection) {
    echo "<p class='mt-3 text-left' style='font-weight: bold; font-size: 20px;'>" . $subsection->title . "</p>";
    
       echo "<figure>";
    echo "<img src='" . $subsection->image['src'] . "' alt='" . $subsection->image['alt'] . "' class='img-fluid mb-5 d-block mx-auto' style='border-radius: 10px;'>";
    
    // Check if image has a caption attribute from XML
    if (!empty($subsection->image['caption'])) {
        echo "<figcaption class='text-center mt-2 small' style='color:#6d8591;'>" . $subsection->image['caption'] . "</figcaption>";
    }
    
    // Add separate figcaption if exists
    if (!empty($subsection->figcaption)) {
        echo "<figcaption class='text-center mt-2 small' style='color:#6d8591;'>" . applyTextStyling($subsection->figcaption) . "</figcaption>";
    }
    
    echo "</figure>";
    
    foreach ($subsection->paragraph as $subParagraph) {
        echo "<p class='text-justify' style='margin-bottom: 10px;'>" . applyTextStyling($subParagraph) . "</p>";
    }
}
?>
                </div>
            </article>
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
