<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteque PUBLIC</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <!--<link rel="stylesheet" href="https://bootswatch.com/5/united/bootstrap.min.css">-->
    
</head>
<body>
<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= URL ?>accueil" class="text-uppercase">BIBLIOTHEQUE PUBLIC</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor02">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="<?= URL ?>accueil">Accueil
            <span class="visually-hidden">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= URL ?>livres">Livres</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= URL ?>auteurs">Auteurs</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Réservations</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Acheter</a>
            <a class="dropdown-item" href="#">Emprinter</a>
            <a class="dropdown-item" href="#">Confirmer</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Historiques</a>
          </div>
        </li>
      </ul>
      <form method="POST" action="<?= URL ?>livres/rechercher" class="d-flex">
        <input class="form-control me-sm-2" type="search" name="search" id="search" placeholder="Rechercher titre ou auteur ..." required>
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Rechercher</button>
      </form>
    </div>
  </div>
</nav>

<!-- Debut Body page -->
    <div class="container">
      <h1 class="rounded border bg-primary text-white p-2 m-2 text-center"><?= $title; ?></h1>
       <?= $content; ?>
    </div>

<!-- Fin Body page -->

    <!-- JS BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>