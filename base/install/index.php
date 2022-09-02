<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$get_config = json_decode(file_get_contents('../config/config.json'));

if($get_config->place_name !== "" && $get_config->place_description !== "") header('Location: ./');

//DEBUG
// echo "DB_host: " .$_GET["db_host"];
// echo "<br>DB_name: " .$_GET["db_name"];
// echo "<br>DB_user: " .$_GET["db_user"];
// echo "<br>DB_pass: " .$_GET["db_pass"];
// echo "<br>place_name: " .$_GET["place_name"];
// echo "<br>place_description: " .$_GET["place_description"];
// echo "<br>place_location: " .$_GET["place_location"];
// echo "<br>language: " .$_GET["language"];
// echo "<br>login-type: ". $_GET["login-type"];
// echo "<br>youtube_api_key_1: " .$_GET["youtube_api_key_1"];

if(isset($_GET["db_host"]) && isset($_GET["db_user"]) && isset($_GET["db_name"]) && isset($_GET["db_pass"]) && isset($_GET["place_name"]) && isset($_GET["place_description"]) && isset($_GET["place_location"]) && isset($_GET["language"]) && isset($_GET["login-type"]) && isset($_GET["youtube_api_key_1"]) && isset($_GET["admin_username"]) && isset($_GET["admin_password"]) && isset($_GET["admin_email"])) {
    $servername = $_GET["db_host"];
    $username = $_GET["db_user"];
    $password = $_GET["db_pass"];
    $dbname = $_GET["db_name"];

    $place_name = $_GET["place_name"];
    $place_description = $_GET["place_description"];
    $place_location = $_GET["place_location"];
    $language = $_GET["language"];
    $login_type = $_GET["login-type"];

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        header('Location: ?e=database');
    } else {
        $sql = "CREATE TABLE IF NOT EXISTS `users` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `firstname` varchar(255) NOT NULL,
<<<<<<< HEAD
            `lastname` varchar(255),
            `password` varchar(255) NOT NULL,
            `email` varchar(255) NOT NULL,
            `type` varchar(255) NOT NULL DEFAULT 'normal',
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
      
        if ($conn->query($sql) === TRUE) {
          $sql = "CREATE TABLE IF NOT EXISTS `songs`( 
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `video_id` varchar(255) NOT NULL,
            `video_title` varchar(255) NOT NULL,
            `video_thumbnail` varchar(255) NOT NULL,
            `video_author` varchar(255) NOT NULL,
            `video_duration` varchar(255) NOT NULL,
            `video_rounded_duration` varchar(255) NOT NULL,
            `likes` varchar(255) NOT NULL,
            `lastlike` varchar(255) NOT NULL,
            `warn` varchar(255) NOT NULL,
            `lastwarn` varchar(255) NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
          if ($conn->query($sql) === TRUE) {
            $sql = "CREATE TABLE IF NOT EXISTS `realtime` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `current_listening_id` varchar(255) NOT NULL,
              `current_video_duration` varchar(255) NOT NULL,
              `video_pause` boolean NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

            if ($conn->query($sql) === TRUE) {
              $rslt = $conn->query("SELECT * FROM realtime WHERE id = 1");
              if($rslt->num_rows > 0){
                header('Location: ?e=configalready');
              } else {
                $sql = "INSERT INTO `realtime` (`current_listening_id`, `current_video_duration`, `video_pause`) VALUES ('1', '0', 0);";
                if ($conn->query($sql) === TRUE) {
                  $sql = "INSERT INTO `users` (`firstname`, `password`, `email`, `type`) VALUES ('".$_GET["admin_username"]."', '".password_hash($_GET["admin_password"], PASSWORD_BCRYPT)."', '".$_GET["admin_email"]."', 'admin');";

                  if ($conn->query($sql) === TRUE) {
                    $conn->close();

                  $database_data = json_decode(file_get_contents("../config/database.json"));

                  $database_data->serveradress = $servername;
                  $database_data->username = $username;
                  $database_data->password = $password;
                  $database_data->database = $dbname;

                  $ytb_token1 = $_GET["youtube_api_key_1"];
                  $ytb_token2 = $_GET["youtube_api_key_2"];
                  $ytb_token3 = $_GET["youtube_api_key_3"];
=======
            `lastname` varchar(255) NOT NULL,
            `password` varchar(255) NOT NULL,
            `email` varchar(255) NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        if ($conn->query($sql) === TRUE) {
          $sql = "CREATE TABLE IF NOT EXISTS `songs`( 
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `video_id` varchar(255) NOT NULL,
            `video_title` varchar(255) NOT NULL,
            `video_thumbnail` varchar(255) NOT NULL,
            `video_author` varchar(255) NOT NULL,
            `video_duration` varchar(255) NOT NULL,
            `video_rounded_duration` varchar(255) NOT NULL,
            `likes` varchar(255) NOT NULL,
            `lastlike` varchar(255) NOT NULL,
            `warn` varchar(255) NOT NULL,
            `lastwarn` varchar(255) NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
          if ($conn->query($sql) === TRUE) {
            $sql = "CREATE TABLE IF NOT EXISTS `realtime` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `current_listening_id` varchar(255) NOT NULL,
              `current_video_duration` varchar(255) NOT NULL,
              `video_pause` boolean NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

            if ($conn->query($sql) === TRUE) {
              $rslt = $conn->query("SELECT * FROM realtime WHERE id = 1");
              if($rslt->num_rows > 0){

              } else {
                $sql = "INSERT INTO `realtime` (`current_listening_id`, `current_video_duration`, `video_pause`) VALUES ('1', '0', 0);";
                if ($conn->query($sql) === TRUE) {
                  $conn->close();

                  $database_data = json_decode(file_get_contents("../config/database.json"));

                  $database_data->serveradress = $servername;
                  $database_data->username = $username;
                  $database_data->password = $password;
                  $database_data->database = $dbname;
>>>>>>> b4e1184d4d0c61082e1d4a9645cbc5dfd11053fa

                  $newJsonString = json_encode($database_data);
                  if(file_put_contents("../config/database.json", $newJsonString) >= 1){
                    $config_data = json_decode(file_get_contents("../config/config.json"));

                    $config_data->place_name = $place_name;
                    $config_data->place_description = $place_description;
                    $config_data->place_location = $place_location;
                    $config_data->language = $language;
                    $config_data->login_system = $login_type;

<<<<<<< HEAD
                    $config_data->ytb_token_1 = $ytb_token1;
                    $config_data->ytb_token_2 = $ytb_token2;
                    $config_data->ytb_token_3 = $ytb_token3;

=======
>>>>>>> b4e1184d4d0c61082e1d4a9645cbc5dfd11053fa
                    $newJsonString = json_encode($config_data);
                    if(file_put_contents("../config/config.json", $newJsonString) >= 1){
                      header('Location: ?s=all');
                    } else {
                      header('Location: ?e=writingfiles#2');
                    }

                  } else {
                    header('Location: ?e=writingfiles#1');
                  }
<<<<<<< HEAD
                  } else {
                    header('Location: ?e=');
                  }

                  
=======
>>>>>>> b4e1184d4d0c61082e1d4a9645cbc5dfd11053fa

                } else {
                  header('Location: ?e=');
                }
                
              } 
            } else {
              header('Location: ?e=database');
            }
          } else {
            header('Location: ?e=tabledatabase');
          }
        } else {
          header('Location: ?e=tabledatabase');
        }
    }
}
?>

<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>QrCodeMusicList &bull; Configuration</title>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

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

    
    <!-- Custom styles for this template -->
    <link href="sticky-footer.css" rel="stylesheet">
  </head>
  <body class="d-flex flex-column h-100">
    
    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">QrCodeMusicList &bull; Configuration</h1>
            <p class="lead">Welcome to the QrCodeMusicList installation page, follow the instructions to complete your installation.</p>

            <?php

            if(isset($_GET["e"]) && $_GET["e"] == "database") {
                echo '<div class="alert alert-danger" role="alert">
                <strong>Oh snap!</strong> Something went wrong with the database connection, please check your credentials and try again.
              </div>';
            }
            if(isset($_GET["e"]) && $_GET["e"] == "writingfiles") {
                echo '<div class="alert alert-danger" role="alert">
                <strong>Oh snap!</strong> Something went wrong with writing the files, please check your permissions and try again.
              </div>';
            }
            if(isset($_GET["e"]) && $_GET["e"] == "tabledatabase") {
                echo '<div class="alert alert-danger" role="alert">
                <strong>Oh snap!</strong> Something went wrong with creating the tables in database, please check your permissions and try again.
              </div>';
            }
<<<<<<< HEAD
            if(isset($_GET["e"]) && $_GET["e"] == "configalready"){
                echo '<div class="alert alert-danger" role="alert">
                <strong>Oh snap!</strong> Something went wrong with creating the tables in database, please check your database configuration and try again.
              </div>';
            }
=======
>>>>>>> b4e1184d4d0c61082e1d4a9645cbc5dfd11053fa


            if(isset($_GET["s"]) && $_GET["s"] == "all") {
                echo '<div class="alert alert-success" role="alert">This is a success, config has been saved!<br>You will be redirected in main page in few seconds...</div>';
                sleep(5);
                header('Location: ../');
            }

            ?>
            <form>

                <h2>Main Configuration</h2>
                <input type="text" class="form-control" name="place_name" placeholder="Place Name" required>
                <input type="text" class="form-control" name="place_description" placeholder="Place Description" required>
                <input type="text" class="form-control" name="place_location" placeholder="Place City" required>
                <select class="form-control" name="language">
                    <option name="en" selected>English</option>
                    <option name="fr">French</option>
                </select>

                <h2>Database Configuration</h2>
                <input type="text" class="form-control" name="db_host" placeholder="Database Host" required>
                <input type="text" class="form-control" name="db_name" placeholder="Database Name" required>
                <input type="text" class="form-control" name="db_user" placeholder="Database User" required>
                <input type="password" class="form-control" name="db_pass" placeholder="Database Password" required>

                <h2>Login Configuration</h2>
                <select class="form-control" name="login-type">
                    <option value="uuid" selected>Login using a uuid (recommended)</option>
                    <option value="token" disabled>Login using MDLsys (Not avaible)</option>
                    <option value="no">No login system for users (Not recommended)</option>
                </select>

                <h2>Admin Configuration</h2>
                <input type="text" class="form-control" name="admin_username" placeholder="Admin Username" required>
                <input type="password" class="form-control" name="admin_password" placeholder="Admin Password" required>
                <input type="text" class="form-control" name="admin_email" placeholder="Admin Email" required>

                <h2>Youtube API v2 credentials</h2>
                <input type="text" class="form-control" name="youtube_api_key_1" placeholder="Youtube API v2 Key" required>
                <input type="text" class="form-control" name="youtube_api_key_2" placeholder="Youtube API v2 Key (Recommanded)">
                <input type="text" class="form-control" name="youtube_api_key_3" placeholder="Youtube API v2 Key (Recommanded)">

                <br><input type="submit" class="btn btn-primary" value="Install & Check Database Connexion">

            </form>
        </div>
    </main>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">QrCodeMusicList &bull; <a href="https://github.com/Alexis-Elaxis/QrCodeMusicList">Open source project developed by Alexis R.</a></span>
        </div>
    </footer>


    
  </body>
</html>