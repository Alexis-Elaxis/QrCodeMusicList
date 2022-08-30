<?php

ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

include('./installModules/checkCompatibility.php');
include('./installModules/configFolders.php');

?>
<html lang="fr">
<style>
@import url('https://fonts.googleapis.com/css2?family=Nunito&display=swap');

body {
    margin: 5vw;
    font-family: 'Nunito', sans-serif;
    text-align: center;
}

.meter {
    box-sizing: content-box;
    height: 20px; /* Can be anything */
    position: relative;
    background: #555;
    border-radius: 25px;
    padding: 10px;
    box-shadow: inset 0 -1px 1px rgba(255, 255, 255, 0.3);
  }
  .meter > span {
    display: block;
    height: 100%;
    border-top-right-radius: 8px;
    border-bottom-right-radius: 8px;
    border-top-left-radius: 20px;
    border-bottom-left-radius: 20px;
    background-color: rgb(43, 194, 83);
    background-image: linear-gradient(
      center bottom,
      rgb(43, 194, 83) 37%,
      rgb(84, 240, 84) 69%
    );
    box-shadow: inset 0 2px 9px rgba(255, 255, 255, 0.3),
      inset 0 -2px 6px rgba(0, 0, 0, 0.4);
    position: relative;
    overflow: hidden;
  }
  .meter > span:after,
  .animate > span > span {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    background-image: linear-gradient(
      -45deg,
      rgba(255, 255, 255, 0.2) 25%,
      transparent 25%,
      transparent 50%,
      rgba(255, 255, 255, 0.2) 50%,
      rgba(255, 255, 255, 0.2) 75%,
      transparent 75%,
      transparent
    );
    z-index: 1;
    background-size: 50px 50px;
    animation: move 2s linear infinite;
    border-top-right-radius: 8px;
    border-bottom-right-radius: 8px;
    border-top-left-radius: 20px;
    border-bottom-left-radius: 20px;
    overflow: hidden;
  }
</style>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QrCodeMusicList &bull; Installation</title>

    <link rel="stylesheet" href="https://cdn.alexiis.fr/projects/qrcodemusiclist/css/install.css">
</head>
<body>
    <h1>QrCodeMusicList &bull; Installation</h1>
    <span class="presentation">QRCodeMusicList est une application permettant de pouvoir mettre à contribution plusieurs utilisateurs afin de créer une playlist de musique originale et dédiée à un évènement ou un lieu.</span>

    <br><hr>

    <span id="desc">Chargement de l'installateur...</span>
    <div class="meter">
        <span id="loading-bar" style="width: 0%"></span>
    </div>
</body>
<script>
setTimeout(() => {
  document.getElementById("desc").innerHTML="Vérification de la compatibilité du serveur";
  console.log('[QrCodeMusicList] - Vérification de la compatibilité du serveur');

  <?php
  if (checkCompatibility() === true) {
      ?>console.log('[QrCodeMusicList] - La version de PHP est valide et les extensions nécessaires sont installées. Serveur compatible. Lancement de l\'installation.');
      document.getElementById("desc").innerHTML="Le serveur est compatible avec QrCodeMusicList. Lancement de l\'installation.";
      document.getElementById("loading-bar").style.width="1%";<?php

      if(configFolders() === true) {
          ?>console.log('[QrCodeMusicList] - Les fichiers nécéssaires à l\'installation ont été créés. Poursuite de l\'installation.');
          document.getElementById("desc").innerHTML="Les fichiers nécéssaires à l\'installation ont été créés. Poursuite de l\'installation.";
          document.getElementById("loading-bar").style.width="5%";<?php

          if(install() === true) {
              ?>console.log('[QrCodeMusicList] - Les fichiers nécéssaires à l\'installation ont été téléchargés. Redirection vers la page de configuration.');
              document.getElementById("desc").innerHTML="Les fichiers nécéssaires à l\'installation ont été téléchargés. Vous allez être redirigé vers la page de configuration dans quelques instants.";
              document.getElementById("loading-bar").style.width="90%";<?php
          } else {
              ?>console.error('[QrCodeMusicList] - Erreur lors du téléchargement des fichiers. Installation annulée.');
              document.getElementById("desc").innerHTML="Erreur lors du téléchargement des fichiers. Installation annulée.";
              document.getElementById("loading-bar").style.width="0%";<?php
          }

      } else {
          ?>console.error('[QrCodeMusicList] - Erreur lors de la création des dossiers de configuration. Installation annulée.');
          document.getElementById("desc").innerHTML="Erreur lors de la création des dossiers de configuration. Installation annulée.";
          document.getElementById("loading-bar").style.width="0%";<?php
      }
  } else {
      ?> console.error("Votre serveur ne semble pas compatible avec QrCodeMusicList. Veuillez vous rendre sur le site officiel pour plus d'informations.");
      document.getElementById("desc").innerHTML="Votre serveur n'est pas compatible avec QrCodeMusicList. Veuillez vous rendre sur le site officiel pour plus d'informations.";
      document.getElementById("loading-bar").style.width="0%";<?php
  }
  ?>
}, 5000);
</script>
</html>