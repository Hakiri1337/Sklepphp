
<?php
 require "connect.php";
 session_start();
 if(@$_SESSION['id']=='11'){  header('Location: adminpage.php');}
 else{  }

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
if(isset($_SESSION['zalogowany'])&& $_SESSION['zalogowany']==true)
{
   $btn="Wyloguj się";
}
else{
   $btn="Zaloguj się";
}
echo<<<END

<header class="navbar">

<nav>
<ul class="menu">
   <li class="logo"><a href="main.php">Ciuszek</a>  </li>
   <li class="item"><a href="main.php">Sklep</a>  </li>
   <li class="item"><a href="#">Kategorie</a></li>
   <li class="item"><a href="koszyk.php">Koszyk</a></li>
   <li class="item button"><a href="logout.php">$btn</a></li>
   <li class="toggle"><span class="bars"></span></li>
</ul>

END;

echo<<<END
</nav>
</header>
<main>
<section>
END;


echo '<div class="container">';
$db=mysqli_connect($host,$db_user,$db_password,$db_name);
$sql=("SELECT produkt.cena,produkt.nazwa,images.name_img FROM produkt INNER JOIN images on produkt.img_id=images.img_id");
$msql=mysqli_query($db,$sql);
while($row= mysqli_fetch_assoc($msql))
{
	echo "<form method='POST' action='adminpage.php'> ";
	echo "<div class='shop-item'>";
	echo"<img  name='produkt_img' class='produkt_img' src='images/".$row['name_img']."'>";
	echo"<input type='hidden' value=".$row['name_img']." name='img'>";
	echo" <span name='nazwa' class='nazwa'>".$row["nazwa"]."</span>
		  <span name='cena' class='cena'>".$row["cena"]."zł</span>";
		  echo"<input type='hidden' value=".$row['nazwa']."zł name='nazwa'>";
		  echo"<input type='hidden' value=".$row['cena']." name='cena'>";
	echo '<input name="dodaj" type="submit" value="Dodaj do koszyka" class="submit-buy">';       
	echo "</form>";

	echo "</div>";

}
/*/
$_SESSION['koszyk']=array();
$nazwa=$_POST['nazwa'];
$cena=$_POST['cena']." zł";
$img=$_POST['img'];
array_push($_SESSION['koszyk'],$nazwa,$cena,$img);/*/
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


?>




    

    
</body>
</html>