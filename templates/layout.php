<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ProExpert Serwis AGD</title>
    <link rel ="icon" href ="public/images/icon.png" type= image/x-icon">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
</head>
<body class="background">
    <nav class="navbar navbar-expand-lg navbar-light font-fam-12">
        <a class="navbar-brand" href="?page=home">
            <div class="logo"></div>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainmenu">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item h5 mx-2">
                    <a class="nav-link nav-button" href="?page=home">Strona główna</a>
                </li>
                <li class="nav-item h5 mx-2">
                    <a class="nav-link nav-button" href="?page=about">O serwisie</a>
                </li>
                <li class="nav-item h5 mx-2">
                    <a class="nav-link nav-button" href="?page=coverage">Zasięg usług</a>
                </li>
                <li class="nav-item h5 mx-2">
                    <a class="nav-link nav-button" href="?page=contact">Kontakt z nami</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container page-animation">
        <?php require ("pages/{$page}.html"); ?>
    </div>
    <hr class="mt-5" href="{{ path('panel') }}">
    <footer class="pl-5"  href="{{ path('panel') }}">
        <div class="container">
            <div class="row mt-4">
                <div class="col-12 col-md-9 font-fam-12 h5 contact-footer">
                    <a class="nav-footer" href="?page=home">Strona główna</a>
                    <span class="mx-2">|</span>
                    <a class="nav-footer"  href="?page=about">O serwisie</a>
                    <span class="mx-2">|</span>
                    <a class="nav-footer"  href="?page=coverage">Zasięg usług</a>
                    <span class="mx-2">|</span>
                    <a class="nav-footer"  href="?page=contact">Kontakt z nami</a>
                </div>
                <div class="col-12 col-md-3">
                    <ul class="float-right mt-3 mt-md-0 font-fam-14 contact-footer font-color-db">
                        <li class="h6">Kontakt</li>
                        <li>Od poniedziałku do piątku</li>
                        <li>Od 8:00 do 16:00</li>
                        <li>Tel: (+48) 666-357-653</li>
                        <li>E-mail: agd.naprawa.serwis@gmail.com</li>
                    </ul>
                </div>
            </div>
            <row>
                <div class="col-12">
                    <span class="copyright d-block text-center font-fam-15 font-color-db my-2">Copyright 2022 &#x24B8 Damian Niedźwiecki</span>
                </div>
            </row>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>

</html>
