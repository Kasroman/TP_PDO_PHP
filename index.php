<?php
session_start();

require_once 'requetes.php';

$data = requete_lire_table_users();

if (!empty($_GET['pseudo'])) {
    $data2 = requete_findUser(htmlentities($_GET['pseudo']));
}elseif((isset($_GET['pseudo']) && $_GET['pseudo'] === '')){
    $_SESSION['error'] = 'Veuillez remplir les champs';
}

if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
}

if(!empty($_GET['deconnexion'])){
    deconnexion();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Document</title>
</head>

<body>
    <div class="container">
        <h1>Liste des utilisateurs</h1>
        <div class="container"> 
            <?php if (!empty($_SESSION['error'])): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_SESSION['error'];
                    unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($_SESSION['success'])): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION['success'];
                    unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>
        </div>
    
        <table class="table table-striped">
            <thead>
                <th>Id</th>
                <th>Pseudo</th>
                <th>E-mail</th>
            </thead>
            <tbody>
                <?php foreach ($data as $value) : ?>
                    <tr>
                        <td><?= $value->id ?></td>
                        <td><?= $value->pseudo ?></td>
                        <td><?= $value->mail ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="container">
        <form action="index.php" method="GET" class="form-control d-flex">
            <div class="">
                <label for="pseudo">Entrez un pseudo : </label>
                <input type="text" name="pseudo" id="pseudo">
            </div>
            <div class="ms-2">
                <input type="submit" value="Chercher">
            </div>
        </form>
    </div>

    <?php if(!empty($_GET['pseudo']) && $data2): ?>
        <div class="container">
            <p>Pseudo : <?= $data2->pseudo ?></p>
            <p>E-mail : <?= $data2->mail ?></p>
        </div>
    <?php endif; ?>

    <div class="container">
        <form action="" class="form-control d-flex">
            <div class="ms-2">
                <input type="submit" name="deconnexion" value="Deconnexion">
            </div>
        </form>
    </div>
</body>

</html>