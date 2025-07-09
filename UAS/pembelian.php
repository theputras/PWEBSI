<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PHP ERROR</title>

    <script
      async
      data-id="five-server"
      data-file="{filePath}"
      type="application/javascript"
      src="/fiveserver.js"
    ></script>

    <link rel="stylesheet" href="/fiveserver/serve-preview/vs.min.css" />
    <script src="/fiveserver/serve-preview/highlight.min.js"></script>
  <!-- Code injected by Five-server -->
  <script async data-id="five-server" data-file="d:\Github\PWEBSI\uas\controller.php" type="application/javascript" src="/fiveserver.js"></script>
  </head>
  <body>
    <style>
      html,
      body {
        font-family: Arial, Helvetica, sans-serif;
        color: #555;
        background-color: #efecec;
      }
      body {
        text-align: center;
      }
      #content {
        text-align: left;
        display: inline-block;
      }
      .is-code {
        background: #e0e0e0;
        padding: 2px 5px;
        border-radius: 2px;
      }
    </style>

    <div id="content">
      <h2>PHP ERROR</h2>
      <div style="margin-right: 8px">
        <pre
          margin="0px;"
        ><code style="padding: 16px; border: 1px gray solid; font-size: 16px;" class="language-bash"><p>error: Command failed: "D:\Data C\PHP\php.exe" "d:\Github\PWEBSI\uas\controller.php"
PHP Warning:  Undefined array key "kode" in D:\Github\PWEBSI\UAS\controller.php on line 6
PHP Warning:  Undefined array key "nama" in D:\Github\PWEBSI\UAS\controller.php on line 7
PHP Warning:  Undefined array key "satuan" in D:\Github\PWEBSI\UAS\controller.php on line 8
PHP Warning:  Undefined array key "harga" in D:\Github\PWEBSI\UAS\controller.php on line 9
PHP Fatal error:  Uncaught mysqli_sql_exception: Column 'kode' cannot be null in D:\Github\PWEBSI\UAS\controller.php:13
Stack trace:
#0 D:\Github\PWEBSI\UAS\controller.php(13): mysqli_stmt->execute()
#1 {main}
  thrown in D:\Github\PWEBSI\UAS\controller.php on line 13
</p></code></pre>
      </div>
    </div>
    <script>
      hljs.highlightAll();
    </script>
  </body>
</html>