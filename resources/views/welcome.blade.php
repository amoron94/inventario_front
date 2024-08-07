<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="icon" href="{{ asset('img/icons/entradadoc.png') }}" type="image/x-icon"/>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.css')}}">

</head>
<body>
    <div class="col-lg-4" style="background: #fff; padding:2rem" >
        <select class="selectpicker show-tick form-control form-control-sm" data-live-search="true">
            <option>Alan</option>
            <option>David</option>
            <option>Moron</option>
            <option>Flores</option>
        </select>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('js/bootstrap-select.js')}}"></script>
</body>
</html>
