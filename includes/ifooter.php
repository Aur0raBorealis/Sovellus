<footer>
    <hr/>
    <p>
        Validointi:
        <a href="https://validator.w3.org/check/referer" rel="nofollow" title="Validate as HTML5">
            HTML5
        </a>
        <a href="https://jigsaw.w3.org/css-validator/validator?uri=<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>" rel="nofollow" title="Validate as CSS3">
            CSS3
        </a>
    </p>
    <p>
        <?php
            echo("Päiväys " . date("d. m. Y"));
        ?>
    </p>
    <hr/>
</footer>
</body>
</html>
