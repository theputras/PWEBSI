// Mendapatkan tahun saat ini dan memasukkannya ke elemen dengan id "year"
document.getElementById('year').textContent = new Date().getFullYear();

// Ambil elemen form berdasarkan ID
const form = document.getElementById('myForm');

// Tambahkan event listener untuk menangani pengiriman form
form.addEventListener('submit', function(event) {
    // Mencegah form melakukan pengiriman default
    event.preventDefault();

    // Ambil data dari input
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const gender = document.getElementById('gender').value;

    // Tampilkan data di alert
    alert(`Nama: ${name}\nEmail: ${email}\nNomor Telephone: ${phone}\nJenis Kelamin: ${gender}`);
});