<?php 
$error = $_GET['error'];
 ?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Express Medical</title>
        <link href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="./CSS/index.css">
        <link rel="icon" type="image/png" href="./Images/favicon.ico.png">
    </head>
    <body>
        <div class="container-fluid full-page">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-lg-3 col-sm-4 form-box">
				<form action="Include/login.inc.php" method="post">
					<div class="col">
                        <div class="row justify-content-center>">
                            <img src="./Images/randomlogo.png" alt="Logo" class="logo">
                        </div>
                        <div class="row justify-content-center">
							<h1 class="h3 mb-3 font-weight-normal login-text">LOG IN</h1>
						</div>
						<div class="row justify-content-center error">
							<h6><?php echo $error; ?></h6>
						</div>
                        <div class="row justify-content-center">
                            <label for="inputUsername" class="sr-only">Username</label>
                            <input type="username" id="inputUsername" class="form-control" placeholder="Username" name="username" required autofocus>
                        </div>
                        <div class="row justify-content-center">
                            <label for="inputPassword" class="sr-only">Password</label>
                            <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
                        </div>
                        <div class="row justify-content-center">
                            <button class="btn btn-lg btn-primary btn-block login-button" type="submit" name="login-submit">Log In</button>
                        </div>
                        <div class="row justify-content-center">
                            <p>Forgot Password</p>
                        </div>
					</form>
                </div>
            </div>
        </div>
    </body>
</html>