<?php
    //ASOCIACION DE USUARIOS
    if(isset($_POST["in_padre"])){
        $padre=$_POST["in_padre"];
        $hijo=$_POST["in_hijo"];
        //console.log("padre . $padre.");
        //console.log("hijo ".$hijo);
        //falta asociarlos
        if($padre===$hijo){
            echo "<div class=\"alert alert-warning\"><strong>Error!</strong> No se puede asociar el mismo usuario!.</div>";
        }else{
            $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "analisis1", "3306");
            $result = mysqli_query($connection, 
            "insert into asociaciones(id_padre,id_hijo) values ($padre,$hijo);") or die("Query fail: " . mysqli_error());
            if(!result){
                echo "<div class=\"alert alert-warning\"><strong>Error!</strong> Posiblemente ya existe esta asociacion!.</div>";    
            }else{
                echo "<div class=\"alert alert-success\"><strong>Exito!</strong> Asociacion exitosa!.</div>";
            }
        }
    }
    //RESGISTRAR USUARIO
    if(isset($_POST["nombre"])){
                
        $nombre=$_POST["nombre"];
        $direccion=$_POST["direccion"];
        $email=$_POST["email"];
        $telefono=$_POST["telefono"];
        $fecha_nacimiento=$_POST["fecha_nacimiento"]." 00:00:00";
        $pass=$_POST["pass"];
        $pass2=$_POST["pass2"];
        $fecha_hoy=date("Y-m-d H:i:s");                   // 2001-03-10 17:16:18 (el formato DATETIME de MySQL);
        if($pass2!=$pass){
            echo "<div class=\"alert alert-warning\"><strong>Error!</strong> No coinciden las contraseñas!.</div>";
        }else{
            $bandera=0;
            //connect to database
            $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "analisis1", "3306");
            //verificar si existe usuario
            $result = mysqli_query($connection, 
                "select * from socios where nombre=\"$nombre\"") or die("Query fail: " . mysqli_error());
            while ($row = mysqli_fetch_array($result)){ 
                    echo "<div class=\"alert alert-warning\"><strong>Error!</strong> Correo ya registrado!.</div>";
                    $bandera=1;
                    break;
            }
            if($bandera==0){
                $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "analisis1", "3306");
                //run the store proc
                //pnombre, pcorreo, ptelefono, prol, ppassword
                //echo "CALL usuario_alta('$nombre','$email',$telefono,'normal',0,'$pass')";
                $result = mysqli_query($connection,"insert into socios (nombre,telefono,email,fecha_nacimiento,direccion,fecha_inicio) values ('$nombre',$telefono,'$email','$fecha_nacimiento','$direccion','$fecha_hoy');");
                //loop the result set
                
                if (!$result) {
                    die('Invalid query: ' . mysql_error());
                }else{
                    echo "<div class=\"alert alert-success\"><strong>Exito!</strong> Registro exitoso!.</div>";
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SCREEN-JUNKIES</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/stylish-portfolio.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle"><i class="fa fa-bars"></i></a>
    <nav id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle"><i class="fa fa-times"></i></a>
            <li class="sidebar-brand">
                <a href="#top"  onclick = $("#menu-close").click(); >SCREEN-JUNKIES</a>
            </li>
            <li>
                <a href="#top" onclick = $("#menu-close").click(); >Home</a>
            </li>
            <li>
                <a href="#about" onclick = $("#menu-close").click(); >Registrarte</a>
            </li>
            <li>
                <a href="#services" onclick = $("#menu-close").click(); >Asociar Usuarios</a>
            </li>
        </ul>
    </nav>

    <!-- Header -->
    <header id="top" class="header">
        <div class="text-vertical-center">
            <h1>SCREEN-JUNKIES</h1>
            <h3>Tu opción en videos</h3>
            <br>
            <a href="#about" class="btn btn-dark btn-lg">Registrate</a>
        </div>
    </header>

    <!-- About -->
    <section id="about" class="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 text-center">
		<form class="form-signin" method="post">
		        <h2 class="form-signin-heading">Registrate!</h2>
		        Nombre: <input type="text"  name="nombre" placeholder="Bilbo Bolson" class="form-control"  required>
		        Dirección: <input type="text" name="direccion" class="form-control" placeholder="3ra colina, La comarca" required>
		        Correo: <input type="email" name="email" class="form-control" placeholder="smaug@robamos_oro.com" required>
		        Telefono: <input type="number" name="telefono" class="form-control" placeholder="77778888" required>
		        Fecha nacimiento: <input type="date" name="fecha_nacimiento" class="form-control" required>
		        Password: <input type="password" id="pass" name="pass" class="form-control" placeholder="gema_del_arca" required>
		        Confirma Password: <input type="password" id="pass2"name="pass2" class="form-control" placeholder="gema_del_arca" required>
		        <br><button class="btn btn-lg btn-primary btn-block" type="submit" >Registrarme</button>
              
		</form>
                </div>
		<div class="col-lg-6 text-center">
<br><br><br><br><br>
              		<img class="img-portfolio img-responsive" src="img/bg2.jpg">
		</div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>

    <!-- Services -->
    <!-- The circle icons use Font Awesome's stacked icon classes. For more information, visit http://fontawesome.io/examples/ -->
    <section id="services" class="services bg-primary">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-10 col-lg-offset-1">
                    <h2>Asociar usuarios</h2>
                    <hr class="small">
                    <div class="row">
	            	<form method="post">
                        	<div class="col-md-3 col-sm-6">
                                	<div class="dropup">
                                  		<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" id="padre">Usuario Principal
                                  		<span class="caret"></span></button>
				                  <input type="hidden" name="in_padre" name="id_padre" id="in_padre"/>
				                  <ul class="dropdown-menu">
				                      <?php
				                        $connection1 = mysqli_connect("127.0.0.1", "ingeusac", "", "analisis1", "3306");
				                        //verificar si existe usuario
				                        $result1 = mysqli_query($connection1, 
				                            "select * from socios;") or die("Query fail: " . mysqli_error());
				                        while ($row = mysqli_fetch_array($result1)){ 
				                                echo "<li><a onclick=\"padre($row[0],'$row[1]')\">".$row[1]."</a></li>";
				                        }
				                      ?>
				                  </ul>
                               		</div>
                            	</div>
                        	<div class="col-md-3 col-sm-6">
	                                Asociar a:
				</div>
                        	<div class="col-md-3 col-sm-6">
                                	<div class="dropup">
		                          <button class="btn btn-success dropdown-toggle" type="button" name="hijo" id="hijo" data-toggle="dropdown">Usuarios
		                          <span class="caret"></span></button>
		                          <input type="hidden" name="in_hijo" id="in_hijo"/>
		                          <ul class="dropdown-menu">
		                            <?php
		                                $connection = mysqli_connect("127.0.0.1", "ingeusac", "", "analisis1", "3306");
		                                //verificar si existe usuario
		                                $result = mysqli_query($connection, 
		                                    "select * from socios;") or die("Query fail: " . mysqli_error());
		                                while ($row = mysqli_fetch_array($result)){ 
		                                        echo "<li><a onclick=\"hijo($row[0],'$row[1]')\">".$row[1]."</a></li>";
		                                }
		                              ?>
		                          </ul>
                                	</div>
                           	</div>
                        	<div class="col-md-3 col-sm-6">
                            		<button class="btn btn-default" type="submit" >Asociar</button>
                        	</div>
                    </form>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.col-lg-10 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>

   

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 text-center">
                    <h4><strong>SCREEN-JUNKIES</strong>
                    </h4>
                    <p>3481 Melrose Place<br>Beverly Hills, CA 90210</p>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-phone fa-fw"></i> (123) 456-7890</li>
                        <li><i class="fa fa-envelope-o fa-fw"></i>  <a href="mailto:name@example.com">name@example.com</a>
                        </li>
                    </ul>
                    <br>
                    <ul class="list-inline">
                        <li>
                            <a href="#"><i class="fa fa-facebook fa-fw fa-3x"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter fa-fw fa-3x"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-dribbble fa-fw fa-3x"></i></a>
                        </li>
                    </ul>
                    <hr class="small">
                    <p class="text-muted">Copyright &copy; SCREEN-JUNKIES</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script>
    // Closes the sidebar menu
    $("#menu-close").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Opens the sidebar menu
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Scrolls to the selected menu item on the page
    $(function() {
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });
    </script>
    <script type="text/javascript">
        
        function padre(id,nombre){
            document.getElementById('padre').innerHTML=""+nombre;
            document.getElementById('in_padre').value=""+id;
        }
        function hijo(id,nombre){
            document.getElementById('hijo').innerHTML=""+nombre;
            document.getElementById('in_hijo').value=""+id;
        }
    
    </script>
</body>

</html>