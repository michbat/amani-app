<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Raleway:700);

        *,
        *:before,
        *:after {
            box-sizing: border-box;
        }

        html {
            height: 100%;
        }

        body {
            font-family: 'Raleway', sans-serif;
            background-color: #dbdbdb;
            height: 100%;
            padding: 10px;
        }

        a {
            color: #054b20 !important;
            text-decoration: none;
        }

        a:hover {
            color: #89c587 !important;
            text-decoration: none;
        }

        .text-wrapper {
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .title {
            font-size: 5em;
            font-weight: 700;
            color: #EE4B5E;
        }

        .subtitle {
            font-size: 40px;
            font-weight: 700;
            color: #3c995f;
        }

        .isi {
            font-size: 18px;
            text-align: center;
            margin: 30px;
            padding: 20px;
            color: white;
        }

        .buttons {
            margin: 30px;
            font-weight: 700;
            border: 2px solid #0e860a;
            text-decoration: none;
            padding: 15px;
            text-transform: uppercase;
            color: #11a319;
            border-radius: 26px;
            transition: all 0.2s ease-in-out;
            display: inline-block;

            .buttons:hover {
                background-color: #EE4B5E;
                color: white;
                transition: all 0.2s ease-in-out;
            }
        }
    </style>
</head>

<body>
    <div class="text-wrapper">
        <div class="title" data-content="405">
            ACCÈS INTERDIT
        </div>

        <div class="subtitle">
            Vous ne pouvez pas accéder à cette page!
        </div>

        <div class="buttons">
            <a class="button" href="{{ route('home') }}">Revenir à la page d'accueil</a>
        </div>
    </div>

</body>

</html>
