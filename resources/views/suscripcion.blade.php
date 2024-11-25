<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestock</title>
    <link rel="icon" href="{{ asset('img/photos/logo_gestock_b.png') }}" type="image/x-icon"/>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/login.css')}}" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap");

        body {
            font-family: 'Poppins', sans-serif !important;
        }

        b {
            color: #4CAF50;
        }
    </style>
</head>
<body>

    <div class="login-box">
        <div class="cont-box">
            <img src="{{asset('img/photos/logo_gestock.png')}}" alt="logo" width="90" height="90">
            <h3><b>Tu suscripción ha expirado.</b><br>
                Por favor, renueva tu plan para continuar usando la plataforma.<br>
                Si necesitas ayuda o más información, contáctanos por <b>WhatsApp.</b></h3>
            <br>
            <br>
            <center>
                <a href="https://wa.me/59177695508" target="_blank">
                    <img src="{{asset('img/photos/wp.png')}}" alt="logwp" width="350" height="100">
                </a>
            </center>

        </div>

    </div>
    <div class="image-box-s"></div>

</body>
</html>
