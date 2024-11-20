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
</head>
<body>

        <div class="login-box">
            <div class="cont-box">
                <img src="{{asset('img/photos/logo_gestock.png')}}" alt="logo" width="90" height="90">
                <h1>Iniciar sesión</h1>
                <form action="{{route('acceder')}}" method="POST">
                    @csrf
                    <input type="email" name="email" placeholder="Dirección de correo electrónico" value="alan.developer13@gmail.com" required>
                    <div style="position: relative;">
                        <input type="password" id="contra" name="pass" placeholder="Contraseña" value="Alan1234" required>
                        <i class="ti ti-eye-off" id="togglePassword" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;color: black;"></i>
                    </div>

                    <button type="submit">Acceso</button>
                </form>
            </div>

        </div>
        <div class="image-box"></div>


    <script>
        $(document).ready(function() {
            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session('error') }}'
                });
            @endif
        });


        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#contra');

        togglePassword.addEventListener('click', function () {
            // Toggle the type attribute using getAttribute() method
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // Toggle the eye / eye slash icon
            this.classList.toggle('ti-eye-off');
            this.classList.toggle('ti-eye');
        });
    </script>



</body>
</html>
