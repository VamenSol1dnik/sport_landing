<?php include('header.php'); ?>
<main>
    <h2>Виведення змінних серверу</h2>
    
    <h3>$_SERVER:</h3>
    <pre>
    <?php
        foreach ($_SERVER as $key => $value) {
            echo "$key => $value\n";
        }
    ?>
    </pre>

    <h3>$_GET:</h3>
    <pre>
    <?php
        foreach ($_GET as $key => $value) {
            echo "$key => $value\n";
        }
    ?>
    </pre>

    <h3>$_POST:</h3>
    <pre>
    <?php
        foreach ($_POST as $key => $value) {
            echo "$key => $value\n";
        }
    ?>
    </pre>
</main>
<?php include('footer.php'); ?>