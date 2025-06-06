<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Головна сторінка</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .centered-text {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .centered-text h1 {
            font-size: 4rem; /* Збільшуємо розмір шрифту */
            margin-bottom: 30px;
        }

        .centered-text h1 span {
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        .centered-text h1 span:nth-child(1) {
            animation-delay: 0s;
        }

        .centered-text h1 span:nth-child(2) {
            animation-delay: 1s;
        }

        .centered-text h1 span:nth-child(3) {
            animation-delay: 2s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .btn-custom {
            margin: 5px;
        }
    </style>
</head>
<body>
    <div class="container centered-text">
        <h1>
            <span>Welcome</span>
            <span>to</span>
            <span>test</span>
        </h1>
        <div>
            <a href="/register" class="btn btn-primary btn-lg btn-custom">Реєстрація</a>
            <a href="/users" class="btn btn-secondary btn-lg btn-custom">Перегляд користувачів</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
