<?php
session_start();

require_once 'requetes.php';

if (isset($_SESSION['user'])) {
    header('Location: index.php');
}

if(!empty($_POST['username']) && !empty($_POST['password'])){
    if(connexion(htmlentities($_POST['username']), htmlentities($_POST['password']))){
        header('Location: index.php');
    } 
}elseif((isset($_POST['username']) && $_POST['username'] === '') || (isset($_POST['password']) && $_POST['password'] === '')){
    $_SESSION['error'] = 'Veuillez remplir les champs';
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
    <div id="container">

        <h1>Connexion</h1>

        <?php if (!empty($_SESSION['error'])): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="form-control">    
            <label>Pseudo</label>
            <input type="text" placeholder="Entrer le nom d'utilisateur" name="username">

            <label>Mot de passe</label>
            <input type="password" placeholder="Entrer le mot de passe" name="password">

            <input type="submit" id='submit' value='LOGIN' >
        </form>
    </div>
</body>
</html>