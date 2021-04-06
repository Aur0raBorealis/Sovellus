<nav>
    <?php
        //Käyttäjän tila
        if($_SESSION['sloggedIn']=="yes"){
            echo("<p>User: " .$_SESSION['suserName']);
            echo("<a href=\"logOutUser.php\"> logout </a>");
            echo("<a href=\"removeAccount.php\"> remove acc </a>");
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
