<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>To-Do List Sederhana</title>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f5f5f5;
      padding: 50px;
    }
    .container {
      max-width: 500px;
      margin: 0 auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    input[type="text"] {
      width: 80%;
      padding: 10px;
      margin-right: 5px;
      border: 1px solid #ddd;
      border-radius: 5px;
    }
    button {
      padding: 10px 15px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    ul {
      list-style: none;
      padding: 0;
    }
    li {
      background: #eee;
      margin: 10px 0;
      padding: 10px;
      border-radius: 5px;
      position: relative;
    }
    .remove {
      position: absolute;
      right: 10px;
      color: red;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>📝 To-Do List jQuery</h2>
    <input type="text" id="task" placeholder="Tambah tugas...">
    <button id="add">Tambah</button>
    <ul id="list"></ul>
  </div>

  <script>
    $(document).ready(function() {
      $('#add').click(function() {
        let task = $('#task').val().trim();
        if (task !== '') {
          $('#list').append(`<li>${task}<span class="remove">❌</span></li>`);
          $('#task').val('');
        }
      });

      $('#list').on('click', '.remove', function() {
        $(this).parent().fadeOut(300, function() {
          $(this).remove();
        });
      });

      $('#task').keypress(function(e) {
        if (e.which === 13) {
          $('#add').click();
        }
      });
    });
  </script>
</body>
</html>
