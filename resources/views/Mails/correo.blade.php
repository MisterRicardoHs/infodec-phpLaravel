<!DOCTYPE html>
<html lang="en">
<head>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <title>Document</title>
</head>
<body>
    
</body>
</html>
<div class="card" >
    <div class="card-header" style="background: rgb(208, 255, 80); height:70px; text-align:center">
        <img src="{{asset('img/logo.png')}}" width="40px" alt="">
    </div>
    <div class="card-body">
        <h2 class="card-title" style="text-align: center">PRUEBA de CORREO</h2>

        <h4>Listado de Usuario</h4>
        <ul>
            @foreach ($usuarios as $usu)
                    <li>{{$usu->username}}</li>
            @endforeach
        </ul>
        <p>Para ver mas detales presione a continuación:</p>
        <button style="background: darkblue; color:white">Ver detalles</button>
    </div>
    <div class="card-footer" style="background: rgb(208, 255, 80); height:70px">
        Footer
    </div>
</div>