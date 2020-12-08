
<?php
 
 session_start();
  if(!isset($_SESSION['zalogowany']))
 {
header('location: index.php');

 }
require "connect.php";
$poloczenie = @new mysqli($host,$db_user,$db_password,$db_name);

if($poloczenie->connect_errno!=0) 
    {
        echo "Error: ".$poloczenie->connect_errno;
    }
else{
  
   
 ?> 
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="sklep.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
	<title>Sklep internetowy </title>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script>
   $(document).ready(function() {

      $(".toggle").on("click",function(){

         if($(".item").hasClass("active")){
            $(".item").removeClass("active");
         }
         else{
            $(".item").addClass("active");
         }

      })
      
   });
   </script>
	<meta charset="utf-8"/>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta http-equiv="X-UA-COMPATIBLE" content="ie=edge">
   
</head>
<body>
 

<?php
if(isset($_SESSION['zalogowany']))
{
echo<<<END

<header class="navbar">

<nav>
<ul class="menu">
   <li class="logo"><a href="adminpage.php">Ciuszek</a>  </li>
   <li class="adminpage.php"><a href="#">Sklep</a>  </li>
   <li class="dodajprodukt.php"><a href="dodajprodukt.php">Dodaj Produkt</a></li>
   <li class="item"><a href="#">Kategorie</a></li>
   <li class="item"><a href="#">Koszyk</a></li>
   <li class="item button"><a href="logout.php">Wyloguj się</a></li>
   <li class="toggle"><span class="bars"></span></li>
</ul>

END;

echo<<<END
</nav>
</header>
<main>
<section>
END;
if(isset($_POST['nazwa']&& $_POST['nazwa']))
$_SESSION['koszyk']=array();
$nazwa=$_POST['nazwa'];
$cena=$_POST['cena']." zł";
$img=$_POST['img'];
array_push($_SESSION['koszyk'],$nazwa,$cena,$img);

echo '<div class="container">';
echo '<table class="table">';
echo '<tr>' ;
for($i=0; $i<count($_SESSION['koszyk']);$i++)
{
echo'<td>'  .$_SESSION['koszyk'][$i]. ' </td>';

}
echo '</tr>';
echo '</table>';


echo<<<END



</div>
</section>
</main>
<footer class="footer-distributed">

			<div class="footer-left">
   
				<h3>O <span>Ciuszku</span></h3>

				<p class="footer-links">
					<a href="#">Home</a>
					|
					<a href="#">Blog</a>
					|
					<a href="#">About</a>
					|
					<a href="#">Contact</a>
				</p>

				<p class="footer-company-name">© 2020 Projekt na witryny i bazy danych</p>
			</div>

			<div class="footer-center">
				<div>
					<i class="fa fa-map-marker"></i>
					  <p><span>Konarskiego 11,
						 Sala. Nr. 210, i sala 153</span>
						Siedlce, Zespół Szkoł Ponadgimnazjalnych Nr 1 - Elektryk</p>
				</div>

				<div>
					<i class="fa fa-phone"></i>
					<p>+45 998 123 455</p>
				</div>
				<div>
					<i class="fa fa-envelope"></i>
					<p><a href="#">Jakis@mail@wp.pl</a></p>
				</div>
			</div>
			<div class="footer-right">
				<p class="footer-company-about">
					<span>Informacje o autorze</span>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
				<div class="footer-icons">
					<a href="#"><i class="fa fa-facebook"></i></a>
					<a href="#"><i class="fa fa-twitter"></i></a>
					<a href="#"><i class="fa fa-instagram"></i></a>
					<a href="#"><i class="fa fa-linkedin"></i></a>
					<a href="#"><i class="fa fa-youtube"></i></a>
				</div>
			</div>
		</footer>
END;
}
}
?>




    
</body>
</html>