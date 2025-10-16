<!DOCTYPE html>
<html>
<head>
    <title>Hitung Keliling Segitiga</title>
</head>
<body>
    <h2>Hitung Keliling Segitiga</h2>
    <form action="{{ route('segitiga.hitung') }}" method="POST">
        @csrf
        <label>Sisi 1:</label>
        <input type="number" name="sisi1" step="any" required><br><br>

        <label>Sisi 2:</label>
        <input type="number" name="sisi2" step="any" required><br><br>

        <label>Sisi 3:</label>
        <input type="number" name="sisi3" step="any" required><br><br>

        <button type="submit">Hitung</button>
    </form>
</body>
</html>
