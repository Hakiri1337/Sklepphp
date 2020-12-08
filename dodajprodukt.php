
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
   $stmt=$poloczenie->query('SELECT * FROM produkt');
   $stnt=$poloczenie->query('SELECT data from produkty_img');
   }
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
   <li class="logo"><a href="#">Ciuszek</a>  </li>
   <li class="item"><a href="#">Sklep</a>  </li>
   <li class="item"><a href="dodajprodukt.php">Dodaj Produkt</a></li>
   <li class="item"><a href="#">Kategorie</a></li>
   <li class="item"><a href="#">Koszyk</a></li>
   <li class="item button"><a href="logout.php">Wyloguj się</a></li>
   <li class="toggle"><span class="bars"></span></li>
</ul>

END;

$poloczenie = @new mysqli($host,$db_user,$db_password,$db_name);
$msg="";
$result = $poloczenie->query("SELECT img_id FROM images ");
$result1 = $poloczenie->query("SELECT id_produktu FROM produkt");
$id_p=$result1->num_rows;
$ile_img=$result->num_rows;
if(isset($_POST['upload']))
{
$marka=$_POST['marka'];
$kategoria=$_POST['kategoria'];
$cena=$_POST['Cena'];
$nazwa=$_POST['Nazwa'];
$ile_sztuk=$_POST['ile_sztuk'];
$id_kategorii=$_POST['kategoria'];
$id_marki=$_POST['marka'];



$target="images/".basename($_FILES['image']['name']);
$image=$_FILES['image']['name'];
$sql="INSERT INTO images (img_id,name_img) VALUES ($ile_img+1,'$image')";
$sql1="INSERT INTO produkt (id_produktu,cena,nazwa,id_kategorii,id_marki,ilosc_na_stanie) VALUES ($id_p+1,'$cena','$nazwa','$id_kategorii','$id_marki','$ile_sztuk')";
mysqli_query($poloczenie,$sql); 
mysqli_query($poloczenie,$sql1); 

if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
$msg="<p class='p-add'>Udało się dodać produkt</p>";
echo $msg;
}
else{
    $msg="<p class='p-add'>Wystąpił problem z dodawaniem produktu</p>";
    echo $msg;
}

}
echo<<<END
</nav>
</header>
<main>
<section>
<div class="container-dd">
<h1>Dodawanie Produktu! </h1>
<div class="add_item">
<form method="post" action="dodajprodukt.php" enctype="multipart/form-data">
<input type="hidden" name="size" value="1000000"  >
<div>
<input type="file" name="image" class="add-select">
</div>
<div>
<input type="text" name="Nazwa" placeholder="Nazwa" class="add-p-1">
  
</div>
<div>
<input type="number" name="Cena" placeholder="Cena" class="add-p-2">
</div>
<div>
<input type="number" name="ile_sztuk" placeholder="Ilość sztuk" class="add-p-3">
</div>
<div>

</div>
<div>
END;

echo"<select name='kategoria' class='select-add-1'>";



$select2=$poloczenie->query("SELECT id_kategorii,nazwa FROM kategoria");
while ($row = $select2->fetch_assoc()){    
    unset($id, $name);
    $id = $row['id_kategorii'];
    $name = $row['nazwa']; 
    echo '<option value="'.$id.'">'.$name.'</option>';
}

echo"</select>";


echo"<select name='marka' class='select-add-2'>";



$select1=$poloczenie->query("SELECT id_marki,nazwa FROM marka");
while ($row = $select1->fetch_assoc()){
    unset($id, $name);
    $id = $row['id_marki'];
    $name = $row['nazwa']; 
    echo '<option value="'.$id.'">'.$name.'</option>';
}

echo"</select>";
echo<<<END
</div>
<div>

<input type="submit" name="upload" value="Dodaj Produkt" class="add-pic">
</div>
</form>
</div>
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

?>




    
</body>
</html>