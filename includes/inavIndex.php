<nav>
    <?php
        //Käyttäjän tila
        if($_SESSION['sloggedIn']=="yes"){
            echo("<p>** User: " .$_SESSION['suserName']);
            echo(" ** Logout</p>");
        }else{
    ?>
    <a href="createAccount.php">
        Create account
    </a> 
    <a href="logInUser.php">
        Log in
    </a>
    <?php
        }
    ?>
</nav>
