<form action="/hitungnilaiakhir" method="POST">
    @csrf
    <input type="text" name="uts" placeholder="Masukkan Nilai UTS">
    <input type="text" name="uas" placeholder="Masukkan Nilai UAS">
    <input type="text" name="tugas" placeholder="Masukkan Nilai Tugas">
    <button type="submit">Hitung Nilai Akhir</button>
</form>
