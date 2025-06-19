// Navbar Scroll Effect
    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.querySelector('.navbar');
        const container = document.querySelector('.container');

        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                // Tambahkan kelas saat di-scroll
                navbar.classList.add('navbar-scrolled');
                
                // Optional: Sesuaikan padding container
                if (container) {
                    container.style.paddingTop = '0px';
                }
            } else {
                // Hapus kelas saat kembali ke atas
                navbar.classList.remove('navbar-scrolled');
                
                // Kembalikan padding container
                if (container) {
                    container.style.paddingTop = '1rem';
                }
            }
        });
    });
    
    
// Tahun di footer
document.getElementById('currentYear').textContent = new Date().getFullYear();
// Load Article from XML
document.addEventListener('DOMContentLoaded', function() {
        const showMoreBtn = document.getElementById('showMoreBtn');
        
        if (showMoreBtn) {
            showMoreBtn.addEventListener('click', function() {
                const currentPage = parseInt(this.getAttribute('data-current-page'));
                const nextPage = currentPage + 1;

                // Fetch next page articles
                fetch(`?page=${nextPage}`, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    // Buat elemen temporary untuk parsing HTML
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = html;

                    // Ambil artikel baru
                    const newArticles = tempDiv.querySelectorAll('#articleContainer .col');
                    const articleContainer = document.getElementById('articleContainer');
                    
                    // Tambahkan artikel baru
                    newArticles.forEach(article => {
                        articleContainer.appendChild(article);
                    });

                    // Update tombol show more
                    const newShowMoreBtn = tempDiv.querySelector('#showMoreBtn');
                    if (newShowMoreBtn) {
                        showMoreBtn.setAttribute('data-current-page', newShowMoreBtn.getAttribute('data-current-page'));
                    } else {
                        // Sembunyikan tombol jika tidak ada artikel lagi
                        showMoreBtn.style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        }
    });