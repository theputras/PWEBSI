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