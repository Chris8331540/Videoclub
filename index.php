<?php
if(isset($_GET["error"])){
    echo "<p style='color: darkred'>Los datos introducidos son incorrectos</p>";
}
?>
<form method="post" action = "login.php">
    <input type="text" placeholder="usuario" name="usuario"><br><br>
    <input type="password" placeholder="password" name="password"><br><br>
    <input type="submit" value="Enviar">
</form>