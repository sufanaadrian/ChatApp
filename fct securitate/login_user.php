<!DOCTYPE html>
<html >
<head>
<meta charset=utf-8>
<title>Chestionare | online | Sibiu | Turbureanu</title>
<link rel="stylesheet" href="stil_1.css" />


</head>

<body>
<!-- seventa php validare forma -->
<?php
include 'functii_conexiune.php';
// define variables and set to empty values
$nameErr = $emailErr = $verifErr = $foundErr = "";
$name = $email = "";
$passw = $passwErr = "";
$varsta=$varstaErr="";
$datanastere=$datanastereErr="";
$sex=$sexErr="";
$oras=$orasErr="";
$domiciliu=$domiciliuErr="";
include 'verificare_login.php';
$verifErr=verif_login($nameErr,$name,$emailErr,$email,$passwErr,$passw); // verificare date intrare
if ($verifErr=="OK")
 { // verificare existenta in baza de date
	$conn = conectare_mysql();
	// curata variabile de atacuri sql injectio si XSS (cross site sripting)
	$name=curata($name);
	$email=curata($email);
	$passw=curata($passw);
	$passw_md5 = md5($passw);
	$sql = "SELECT * FROM utilizatori where nume='$name' and e_mail='$email' and parola='$passw_md5' and tip=0";
	$rez = mysqli_query($conn,$sql);
	if (mysqli_num_rows($rez)== 0)
		$foundErr = "utilizator NEGASIT,  Nume,parola sau E-mail ERONAT";
	if (mysqli_num_rows($rez) == 1)
	{$foundErr = "Am gasit";
	 $row= mysqli_fetch_assoc($rez);
	 $id_util = $row['id_util'];
	 header('Location: utilizator.php?utilizator='.$name.'&id_util='.$id_util.'&rezultate=nu' );
	 }
 }
?>
 
 

<div id="wrapper">
<div id="header">
<h1>Chestionare on-line </h1>
</div>
 
<div id="left-column">
<h2 style="text-align:center" >  Navigare  </h2>
<ul id="navbar">
<li><a href="#">Chestionare</a></li>
<!--<li><a href="#">Administrare</a></li>-->
<li><a href="index.php">Home</a></li> 
<li><a href="CVbun.php">CV Turbureanu</a></li>
</ul>
</div>
 
<div id="right-column">
<h2 style="text-align:center" >Logare utilizator</h2>
<h3 style="text-align:right" >Daca NU aveti cont <a href="create_user.php">Creare Utilizator Nou</a></h3>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Nume Utilizator: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br>
  Varsta: <input type="text" name="varsta" value="<?php echo $varsta;?>">
  <span class="error">*<?php echo $varstaErr;?></span>
  <br>
  Data nastere: <input type="text" name="datanastere" value="<?php echo $datanastere;?>">
  <span class="error">*<?php echo $datanastereErr;?></span>
  <br>
  Sex: <input type="text" name="sex" value="<?php echo $sex;?>">
  <span class="error">*<?php echo $sexErr;?></span>
  <br>
  Oras: <input type="text" name="oras" value="<?php echo $oras;?>">
  <span class="error">*<?php echo $orasErr;?></span>
  <br>
  Domiciliu: <input type="text" name="domiciliu" value="<?php echo $domiciliu;?>">
  <span class="error">*<?php echo $domiciliuErr;?></span>
  <br>
  Adresa E-mail: <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br>
  Parola: <input type="password" size="10" name="passw" value="    "> 
  <span class="error">* <?php echo $passwErr?></span>
  <br>   <input id="input" type="submit" name="submit" value="Trimite">  
</form>

<?php
echo '<h3 class="error">'.$foundErr."</h3>";
?>

</div>
 <div id="push"></div>
<div id="footer">
<p>Copyright 2016 Turbureanu Georgiana</p>
</div>
</div><!--aici se termina wrapperul-->

</body>
</html>
