<nav>
    <?php
        //Käyttäjän tila
        if($_SESSION['sloggedIn']=="yes"){
            echo("<p>** User: " .$_SESSION['suserName']);
            echo("<a href=\"logOutUser.php\"> Log out </a>");
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
