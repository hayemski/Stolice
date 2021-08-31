<?php
    require_once 'login/loginProvera.php';
?>
<!DOCTYPE html>
<html lang="sr">
<head>
    <title>Dodavanje</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="js/jquery.validate.min.js"></script>
	<script>
		(function($,W,D) {
			var JQUERY4U = {};
			JQUERY4U.UTIL = {
				setupFormValidation: function() {
					$('.form').validate({
					    rules: {
					        naziv: {
					            required: true,
					            minlength: 2,
					            maxlength: 50
					        },
					        tip: {
					            required: true
					        },
					        velicina: {
					            required: true,
					            minlength: 2,
					            maxlength: 25
					        },
                            boja: {
                                required: true,
                                minlength: 2,
                                maxlength: 25
                            },
                            materijal: {
					            required: true,
					            minlength: 2,                         
					            maxlength: 25
					        },
                            cena: {
					            required: true
                            }
					    },
					    messages: {
					        naziv: {
					            required: 'Ovo polje je obavezno!',
					            minlength: 'Polje mora imati minimum 2 karaktera!',
					            maxlength: 'Polje može imati maksimum 50 karaktera!'
					        },
					        tip: {
					            required: 'Ovo polje je obavezno!'
					        },
					        velicina: {
					            required: 'Ovo polje je obavezno!',
					            minlength: 'Polje mora imati minimum 2 karaktera!',
					            maxlength: 'Polje može imati maksimum 25 karaktera!'
					        },
                            boja: {
                                required: 'Ovo polje je obavezno!',
                                minlength: 'Polje mora imati minimum 2 karaktera!',
                                maxlength: 'Polje može imati maksimum 25 karaktera!'
                            },
                            materijal: {
					            required: 'Ovo polje je obavezno!',
					            minlength: 'Polje mora imati minimum 2 karaktera!',
					            maxlength: 'Polje može imati maksimum 25 karaktera!'
					        },
                            cena: {
					            required: 'Ovo polje je obavezno!'
                            }
					    },
						submitHandler: function(form) {
						    form.submit();
						}
					});
				}
			};
			$(D).ready(function($) {
				JQUERY4U.UTIL.setupFormValidation();
			});
		})(jQuery, window, document);
	</script>
</head>
<body>    
    <div class="container">
        <div class="top-bar">
            <?php                    
                require_once 'login/logovanje.php';
                logovanje();
                if($_SESSION['tipKorisnika'] == '1') {
                    echo '<a href="admin.php">Administratorski deo</a>';
                }
            ?>
            <a class="logout" href="login/logout.php">Odjavi se</a>
        </div>
        
        <?php require_once 'template.php';?>
        
        <section>   
			<div class="azuriranje">
				<?php
					if(isset($_GET['message'])) {
						$message = $_GET['message'];
						if($message == 'Novi proizvod je uspešno unet!') {
							echo '<h3 style="color: green;">' . $message . '</h3>';
						} else {
							echo '<h3 style="color: red;">' . $message . '</h3>';
						}
					}
				?>                        
				<form class="form" method="POST" action="ubaciProizvod.php">
					<div>
						<label for="naziv">Naziv:</label>
						<input type="text" name="naziv" id="naziv">
					</div>

					<div>
						<label for="tip">Tip:</label>    
						<select name="tip" id="tip">
							<option value=''></option>
							<?php
								require_once 'konekcija/konekcija.php';
								$sql = "SELECT * FROM tipovi";
								if($doQuery = $mysqli3->query($sql)) {
									if(mysqli_num_rows($doQuery) > 0) {
										while($tip = $doQuery->fetch_object()) {
											echo "<option value='$tip->idtip'>$tip->tip</option>";
										}                
										$mysqli3->close();
									} else {
										echo '<option value=""></option>';
									}
								} else {
									echo 'Greška!';
								}                        
							?>  
						</select>
					</div>

					<div>
						<label for="velicina">Veličina:</label>
						<input type="text" name="velicina" id="velicina">
					</div>

					<div>
						<label for="boja">Boja:</label>
						<input type="text" name="boja" id="boja">
					</div>

					<div>
						<label for="materijal">Materijal:</label>
						<input type="text" name="materijal" id="materijal">
					</div>
					
					<div>
						<label for="cena">Cena:</label>
						<input type="number" name="cena" id="cena">
					</div>

					<button type="submit" class="button-success">Potvrdi</button>
				</form> 
			</div>            
        </section>
    </div>
</body>
</html>