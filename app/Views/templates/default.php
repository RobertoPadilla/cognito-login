<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cognito Users App</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- ROBOTO FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;700&display=swap" rel="stylesheet"> 

    <style>
        body {
            background-color: darkslateblue;
            color: gainsboro;
            font-family: 'Roboto', sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            height: 100vh;
            width: 100vw;
        }
        #header {
            position: absolute;
            top: 10px;
            right: 100px;
            color: gainsboro;
            text-decoration: none;
        }
        #header:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php if(session()->get('logged_in')) : ?>
        <a id="header" href="<?= base_url('/logout')?>">logout</a>
    <?php endif; ?>
    <div class="centered-container">
        <?= $this->renderSection('content') ?>
    </div>
</body>
</html>