<!DOCTYPE html>
<html lang="sr">
<head>
    <title>Obaveštenje</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>    
    <div class="container"> 
        <div class="top-bar">
            <?php                    
               require_once 'login/logovanje.php';
               logovanje();
            ?>
            <a class="logout" href="login/logout.php">Odjavi se</a>
        </div>

        <section class="notice">
            <header>
                <a href="#">Nalog Vam još nije aktiviran. Molimo sačekajte da administrator potvrdi vašu registraciju.</a>
            </header>
        </section>    
    </div>
</body>
</html>