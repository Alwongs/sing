<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .flex-container {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-top: 40px;
        }
        .block {
            width: 200px;
            height: 200px;
        }
        .first {
            background-color: red;
        }
        .second {
            background-color: green;
        }
        .third {
            background-color: blue;
        }
    </style>
</head>
<body>
    <div class="flex-container">
        <div class="block first"></div>
        <div class="block second"></div>
        <div class="block third"></div>
    </div>
</body>
</html>