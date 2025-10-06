<html>

<body>
    <form action="/advweb-week2/terimadata" method="POST">
        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
        <input type="text" name="nilai1">
        <br>
        <input type="text" name="nilai2">
        <br>
        <select name="operator" id="operator">
            <option value="tambah">+</option>
            <option value="kurang">-</option>
            <option value="kali">x</option>
            <option value="bagi">:</option>
        </select>
        <br>
        <input type="submit" name="proses" value="Proses">
</body>

</html>