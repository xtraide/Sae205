<?php
$path = "../utile/";
include $path."html/header.php"; ?>

<a href="sign-in.php">Créer son compte</a>
<form action="login.php" method="post">
Email: <input type="email" name="email" id="" placeholder="exemple@gmail.com" value="<?= !empty($_POST['email']) ?  $_POST['email'] : '' ?>">
  <div class="eremail"></div>
Mot de passe: <input type="password" placeholder="Mot de passe de 6 caracteres" name="mdp" value="<?= !empty($_POST['mdp']) ?  $_POST['mdp'] : '' ?>">
  <div class="ermdp"></div>
<input type="submit">
  <div class="er"></div>
</form>
<?php
include $path . "link/link.php";
include $path . "function.php";
$email = isvalid('email',false);
$password = isvalid('mdp',false);
if (!empty($email) && !empty($password)) {
  $password = crypte($password);
  $result = execute("Select * from `utilisateur` where email = '{$email}' AND mdp = '{$password}';");
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      setcookie("id", $row['id'], time() + 604800, '/');
    }
    header('Location: index.php');
  } else {
    ?> 
        <script type="text/javascript">
            document.getElementsByClassName('er')[0].innerHTML = "l'e-mail ou le Mot de passe est incorecte";
        </script>
    <?php
  }
}
?><button name="admin" value="YAMETE"></button><?php /** a suprimer  */
if(!empty($_POST['admin']) && $_POST['admin']=="YAMETE"){
  setcookie("id", "", time() + 604800, '/');
  header('Location: index.php');
}/** */
include $path . "html/footer.php"; ?>