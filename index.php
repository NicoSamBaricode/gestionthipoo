
<?php
	//inicia la sesion
	session_start();

	//si entra redirige
	if(isset($_SESSION['user'])){
		header('location:panel.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>thi gestion</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
</head>
<body>
<div class="container">
	
	<div class="row">
		<div class="col-md-4 col-md-offset-4"style="padding-top: 20px;margin: auto; margin-top: 3rem; margin-bottom: 3rem; width: fit-content; border: solid;">
		    <div class="login-panel panel panel-primary">
		        <div class="panel-heading">
				<h1 class="row text-center " style="margin: auto;  width:fit-content  ">Gestion THI</h1>
				<h2 class="row text-center " style="margin: auto;  width:fit-content  ">Log In</h2>
				<div class="row"style="margin: auto;  width:fit-content  ">
				<div class="col"style="margin: auto;  width:fit-content  ">
				<img src="assets/img/logo-cnea2.png" style="max-width:10rem;margin-bottom: 15px;margin-top: 15px;" alt="LogoCNEA">
				</div>
				</div>
				
		            
		        </div>
		    	<div class="panel-body">
		        	<form method="POST" action="login.php">
		            	<fieldset>
		                	<div class="form-group">
		                    	<input class="form-control" placeholder="Username" type="text" name="alias" autofocus required>
		                	</div>
		                	<div class="form-group">
		                    	<input class="form-control" placeholder="Password" type="password" name="pasword" required>
		                	</div>
		                	<button type="submit" name="login" class="btn  btn-primary btn-block" style="margin-bottom: 15px;"><span class="glyphicon glyphicon-log-in"></span> Ingresar</button>
		            	</fieldset>
		        	</form>
		    	</div>
		    </div>
		    <?php
		    	if(isset($_SESSION['message'])){
		    		?>
		    			<div class="alert alert-info text-center">
					        <?php echo $_SESSION['message']; ?>
					    </div>
		    		<?php

		    		unset($_SESSION['message']);
		    	}
		    ?>
		</div>
	</div>
	<body>
   
</div>
</body>
</html>