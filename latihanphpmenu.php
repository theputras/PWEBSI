<!DOCTYPE html>
<html lang="en">
<head>
  <title>UAS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>
<body>

<nav class="navbar navbar-expand-sm bg-danger navbar-light ">
  <div class="container-fluid">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" id="item">ITEM</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="supplier">SUPPLIER</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="penjualan">PENJUALAN</a>
      </li>
    </ul>
  </div>
</nav>

<div class="container-fluid mt-3">
    <div id="isi">
    </div>
  </div>
<script>
    $("#isi").load("latihanphp016.php");

</script>    
</body>
</html>
