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

$action = $_POST['action'];
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$name = isset($_POST['name']) ? $_POST['name'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';

if ($action == "create") {
    if (!preg_match("/^\d{11}$/", $phone)) {
        $_SESSION['error_message'] = "Некорректный номер телефона";
    } else {
        $sql = "INSERT INTO contacts (name, phone) VALUES ('$name', '$phone')";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['success_message'] = "Заявка успешно создана";
        } else {
            $_SESSION['error_message'] = "Ошибка: " . $conn->error;
        }
    }
} elseif ($action == "edit" && $id > 0) {
    if (!preg_match("/^\d{11}$/", $phone)) {
        $_SESSION['error_message'] = "Некорректный номер телефона";
    } else {
        $sql = "UPDATE contacts SET name='$name', phone='$phone' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['success_message'] = "Заявка успешно обновлена";
        } else {
            $_SESSION['error_message'] = "Ошибка: " . $conn->error;
        }
    }
} elseif ($action == "delete" && $id > 0) {
    $sql = "DELETE FROM contacts WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['success_message'] = "Заявка успешно удалена";
    } else {
        $_SESSION['error_message'] = "Ошибка: " . $conn->error;
    }
}

$conn->close();

header("Location: admin.php");
exit();
?>
