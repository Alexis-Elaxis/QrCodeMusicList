<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$get_config = json_decode(file_get_contents('./config/config.json'));

if($get_config->place_name === "" && $get_config->place_description === "") header('Location: ./install/');

$config_data = json_decode(file_get_contents("./config/config.json"));
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>QrCodeMusicList &bull; <?= $config_data->place_name ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="theme-color" content="#712cf9">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>
  </head>
  <body>
    
<div class="col-lg-8 mx-auto p-3 py-md-5">
  <header class="d-flex align-items-center pb-3 mb-5 border-bottom">
    <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
      <span class="fs-4">QrCodeMusicList &bull; <?= $config_data->place_name ?></span>
    </a>
  </header>

  <main>
    <h3>The current playlist :</h3>
    <?php
    $database_data = json_decode(file_get_contents("./config/database.json"));
    $conn = new mysqli($database_data->serveradress, $database_data->username, $database_data->password, $database_data->database);
    if ($conn->connect_error) {
        header('Location: ?e=database');
    } else {
        $sql = "SELECT * FROM `realtime` WHERE `id` = '1'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            while($row = $result->fetch_assoc()) {
                $sql = "SELECT * FROM `songs` WHERE `id` = '".$row["current_listening_id"]."'";
                $result = $conn->query($sql);
                if ($result->num_rows == 1) {
                    while($row = $result->fetch_assoc()) {
                        ?>
                        <div class="container-sm bg-light rounded">
                            <span>En cours de lecture</span>
                            <h3><?= $row["video_title"]; ?> &bull; <?= $row["video_author"]; ?></h3>
                        </div>
                        <?php
                    }
                }
            }
        } else {
            echo "erreur";
        }
    }
    ?>
    
  </main>
  <footer class="pt-5 my-5 text-muted border-top">
    Open source project made by Alexis R. using Bootstrap &middot; &copy; 2022
  </footer>
</div>


    <script src="/docs/5.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

      
  </body>
</html>