<?php include('header.php'); ?>
<main>
    <h2>Форма реєстрації</h2>
    <form method="POST" action="form.php">
        <label for="name">Ім'я:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="gender">Стать:</label>
        <input type="radio" id="male" name="gender" value="male"> Чоловік
        <input type="radio" id="female" name="gender" value="female"> Жінка
        <br>
        <label for="dob">Дата народження:</label>
        <input type="text" id="day" name="day" placeholder="ДД" maxlength="2" required>
        <input type="text" id="month" name="month" placeholder="ММ" maxlength="2" required>
        <input type="text" id="year" name="year" placeholder="РРРР" maxlength="4" required>
        <br>
        <button type="submit">Відправити</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $age = date_diff(date_create($dob), date_create('today'))->y;

        if (($gender == 'male' && $age < 21) || ($gender == 'female' && $age < 18)) {
            echo "<p style='color:red;'>Не можна зареєструватися</p>";
        } else {
            echo "<p>Форма успішно надіслана. Ваша інформація: Ім'я: $name, Стать: $gender, Дата народження: $dob</p>";
        }
    }
    ?>
</main>
<?php include('footer.php'); ?>