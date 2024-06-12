<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Your Location</title>
</head>
<body>
<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $city_id = $_POST['city_id'];

    $sql = "INSERT INTO users (name, age, city_id) VALUES ('$name', '$age', '$city_id')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$citiesResult = $conn->query("SELECT * FROM cities");
$usersResult = $conn->query("SELECT users.id, users.name, users.age, cities.name as city FROM users LEFT JOIN cities ON users.city_id = cities.id");
?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <title>Location</title>
</head>
<body>
    <h1>Добавяне на нов потребител</h1>
    <form method="post" action="">
        <label for="name">Име:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="age">Възраст:</label>
        <input type="number" id="age" name="age" required><br><br>
        <label for="city_id">Град:</label>
        <select id="city_id" name="city_id" required>
            <?php while ($city = $citiesResult->fetch_assoc()): ?>
                <option value="<?php echo $city['id']; ?>"><?php echo $city['name']; echo $city['id']; ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <input type="submit" value="Добави">
    </form>

    <h2>Списък на потребители</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Име</th>
            <th>Възраст</th>
            <th>Град</th>
        </tr>
        <?php while ($user = $usersResult->fetch_assoc()): ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['name']; ?></td>
                <td><?php echo $user['age']; ?></td>
                <td><?php echo $user['city']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

</body>
</html>