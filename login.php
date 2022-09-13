<?php
if(isset($_GET['msg']))
{
    echo"<divclass='msg'>".$_GET['msg']."</div>";
}
?>
<form action="backend/loginController.php"method="POST">
    
    <divc lass="form-group">
        <label for="username">Gebruikersnaam:</label>
        <input type="text"name="username"id="username">
    </div>
       
    <div class="form-group">
        <label for="password">Wachtwoord:</label>
        <input type="password"name="password"id="password">
    </div>
    
    <input type="submit"value="Login">
</form>