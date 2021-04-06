<nav>
    <?php
        //Käyttäjän tila
        if($_SESSION['sloggedIn']=="yes"){
<<<<<<< HEAD
            echo("<p>User: " .$_SESSION['suserName']);
            echo("<a href=\"logOutUser.php\"> logout </a>");
            echo("<a href=\"removeAccount.php\"> remove acc </a>");
=======
            echo("<p>** User: " .$_SESSION['suserName']);
            echo("<a href=\"logOutUser.php\"> Log out </a>");
>>>>>>> 6e50236739eed07a850738a1035a0daf119e316a
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
