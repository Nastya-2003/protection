<?php
session_start();
$servername = "lab1";
$username = "root";
$password = "";
$dbname = "user";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Обработка сообщения об успехе или ошибке
$success_message = "";
$error_message = "";

if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

$sql = "SELECT * FROM contacts";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель Администратора</title>
    <link href="https://fonts.cdnfonts.com/css/manrope" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="1.css">
</head>
<body>
    <div class="container">
        <h2>Панель Администратора</h2>

        <?php if ($success_message !== ""): ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <?php if ($error_message !== ""): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <h2>Создать новую заявку</h2>
        <form action="admin_action.php" method="post">
            <input type="hidden" name="action" value="create">
            <div class="form">
                <label for="name">Имя:</label>
                <input type="text" id="name" name="name" required>
                <label for="phone">Телефон:</label>
                <input type="text" id="phone" name="phone" required>
                <button type="submit">Создать</button>
            </div>
        </form>

        <h2>Список заявок</h2>
        <table>
            <tr>
                <th class="form_1">ID</th>
                <th class="form_1">Имя</th>
                <th class="form_1">Телефон</th>
                <th class="form1">Действия</th>
            </tr>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td>
                            <form action="admin_action.php" method="post" style="display:inline;">
                                <input class="form_1" type="hidden" name="action" value="edit">
                                <input class="form_1" type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input class="form_1" type="text" name="name" value="<?php echo $row['name']; ?>" required>
                                <input class="form_1" type="text" name="phone" value="<?php echo $row['phone']; ?>" required>
                                <button type="submit">Обновить</button>
                            </form>
                            <form action="admin_action.php" method="post" style="display:inline;">
                                <input class="form" type="hidden" name="action" value="delete">
                                <input  type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit">Удалить</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Заявок не найдено</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>
<?php
$conn->close();
?>
