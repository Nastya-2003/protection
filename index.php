<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Кварцвинил</title>
    <link href="https://fonts.cdnfonts.com/css/manrope" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="1.css">
</head>
<body>
    <div class="shape">
        <div class="shape_1">
            <?php
            session_start(); 

            $error_message = ""; 

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (!preg_match("/^\+?\d{0,3}\(?\d{3}\)?\s?\d{3}\s?\d{2}\s?\d{2}$/", $_POST['phone'])) {
                    $error_message = "Некорректный номер телефона";
                } else {
                    $servername = "lab1";
                    $username = "root"; 
                    $password = ""; 
                    $dbname = "user"; 

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $name = $_POST['name'];
                    $phone = $_POST['phone'];

                    $sql = "INSERT INTO contacts (name, phone) VALUES ('$name', '$phone')";

                    if ($conn->query($sql) === TRUE) {
                        $_SESSION['success_message'] = "Данные успешно сохранены"; 
                        header("Location: " . $_SERVER['PHP_SELF']); 
                        exit(); 
                    } else {
                        $error_message = "Ошибка: " . $sql . "<br>" . $conn->error;
                    }

                    $conn->close();
                }
            }

            if (isset($_SESSION['success_message'])) {
                echo "<div class='success-message'>" . $_SESSION['success_message'] . "</div>";
                unset($_SESSION['success_message']); 
            }

            if ($error_message !== "") {
                echo "<div class='error-message'>" . $error_message . "</div>";
            }
            ?>
            <div class="title-shape" id="typed-text">ОСТАЛИСЬ ВОПРОСЫ ИЛИ НУЖНА ПОМОЩЬ С ВЫБОРОМ?</div>
            <div class="text-shape" id="typed-text">Оставьте, пожалуйста, свои контакты, и мы перезвоним в ближайшее время</div>
            <form form id="requestForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-row">
                    <input class="form-input" type="text" id="name" name="name" placeholder="Имя">
                    <input class="form-input-tel" type="text" id="phone" name="phone" placeholder="+7(___) ___ __ __">
                    <button type="submit">Перезвоните мне</button>
                </div>
            </form>
            <input type="checkbox" id="chbx" class="checkbox-round">
            <label for="chbx" class="label-round">Даю согласие на обработку 
                персональных данных</label>
                <div class="text-shape" id="typed-text"><a href="admin.php">Вход для администратора</a></div>
        </div>
    </div>
    <footer>
        <div class="footer-items">
                <div class="ratinglogo">
                    <img class="logo" src="img\logo.png">
                    <img class="otz" src="img\1.jpg">
                </div>
                <div class="ratinglogo">
                    <div class="title" id="typed-text">Каталог</div>
                    <div class="title" id="typed-text">О компании</div>
                    <div class="title" id="typed-text">Услуги</div>
                    <div class="titlee" id="typed-text">Преимущества</div>
                </div>
                <div class="ratinglogo">
                    <div class="title" id="typed-text">Каталог</div>
                    <div class="title" id="typed-text">О компании</div>
                    <div class="title" id="typed-text">Услуги</div>
                    <div class="title" id="typed-text">Преимущества</div>
                </div>
                <div class="ratinglogo">
                    <div class="title" id="typed-text">Оплата и доставка</div>
                    <div class="title" id="typed-text">Отзывы</div>
                    <div class="title" id="typed-text">Вопросы и ответы</div>
                    <div class="title" id="typed-text">Контакты</div>
                </div>
                <div class="ratinglogo">
                    <div class="title3" id="typed-text">+7 (495) 032 08 12</div>
                    <div class="title3" id="typed-text">hello@royce-spc.ru</div>
                    <img class="soc" src="img\soc.png">
                </div>
                <div class="ratinglogo">
                    <div class="title2" id="typed-text">Политика конфиденциальности</div>
                </div>
                <div class="ratinglogo">
                    <div class="title" id="typed-text">Способы оплаты</div>
                        <div class="payment-icons">
                            <div class="tooltip">
                                <img src="img\2.png" alt="Tooltip Image">
                                <span class="tooltiptext">Оплата с помощью банковских карт Visa, Master Card или Мир возможна только, если на карте с обратной стороны есть 3х значный код защиты</span>
                            </div>
                            <div class="tooltip">
                                <img src="img\3.png" alt="Tooltip Image">
                                <span class="tooltiptext">Оплата с помощью банковских карт Visa, Master Card или Мир возможна только, если на карте с обратной стороны есть 3х значный код защиты</span>
                            </div>
                            <div class="tooltip">
                                <img src="img\4.png" alt="Tooltip Image">
                                <span class="tooltiptext">Оплата с помощью банковских карт Visa, Master Card или Мир возможна только, если на карте с обратной стороны есть 3х значный код защиты</span>
                            </div>
                            <div class="tooltip">
                                <img src="img\5.png" alt="Tooltip Image">
                                <span class="tooltiptext">Оплата с помощью банковских карт Visa, Master Card или Мир возможна только, если на карте с обратной стороны есть 3х значный код защиты</span>
                            </div>
                        </div>
                </div>
        </div>
    </footer>
</body>
</html>
