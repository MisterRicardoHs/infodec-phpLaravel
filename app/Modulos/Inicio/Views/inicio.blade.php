<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Promedio de Notas</title>
</head>
<body>
    
    <div class="container">
        <div class="row mt-5" id="contenedorListado">
            <div class="col-xs-12 col-md-2 col-lg-2"></div>
            <div class="col-xs-12 col-md-8 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <button type="button" style="float:right;" class="btn btn-success" onclick=" crearRegistro(1)">Registrar Nuevo</button>
                        <h3>Promedio de Notas</h3>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Aplicativo para calcular el promedio de notas.</h5>
                        <p class="card-text">Listado de resultados anteriores.</p>
                       <table class="table table-light">
                           <thead class="thead-light">
                               <tr>
                                   <th>Nombres</th>
                                   <th>Parcial 1</th>
                                   <th>Parcial 2</th>
                                   <th>Parcial 3</th>
                                   <th>Final</th>
                                   <th>Eliminar</th>
                               </tr>
                           </thead>
                           <tbody id="listado">

                               @foreach ($listado as $lista)     
                                    <tr>
                                        <td>{{$lista->nombre}}</td>
                                        <td>{{$lista->parcial1}}</td>
                                        <td>{{$lista->parcial2}}</td>
                                        <td>{{$lista->parcial3}}</td>
                                        <td>{{$lista->final}}</td>
                                        <td><button class="btn btn-danger" type="button" onclick="eliminarRegistro({{$lista->id}})">Eliminar</button></td>
                                    </tr>
                               @endforeach
                           </tbody>
                       </table>
                       
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-2 col-lg-2"></div>
        </div>

        <div class="row mt-5" id="contenedorRegistro" style="display: none">
            <div class="col-xs-12 col-md-3 col-lg-3"></div>
            <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <button type="button" style="float:right;" class="btn btn-info" onclick=" crearRegistro(2)">Volver</button>
                        <h3>Promedio de Notas</h3>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Aplicativo para calcular el promedio de notas.</h5>
                        <p class="card-text">Por favor digite su nombre, y posteriormente las 3 notas.</p>

                        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alerta" style="display: none">
                            <strong>Información! </strong>Complete los campos.
                          </div>
                        <form action="" method="">
                            <div class="form-group">
                                <input required type="text" placeholder="Digite Nombre" class="form-control" id="nombre" onkeypress="return Solo_Texto(event);">
                            </div>
                            <div class="form-group">
                                <input required type="number" placeholder="Digite Primer Nota En Decimal ej: 4.1" class="form-control" autocomplete="off" id="nota1" onkeypress="return filterFloat(event,this);">
                            </div>
                            <div class="form-group">
                                <input required type="number" placeholder="Digite Segunda Nota En Decimal ej: 4.1" class="form-control" autocomplete="off" id="nota2"  onkeypress="return filterFloat(event,this);">
                            </div>
                            <div class="form-group">
                                <input required type="number" placeholder="Digite Tercer Nota En Decimal ej: 4.1" class="form-control" autocomplete="off" id="nota3"  onkeypress="return filterFloat(event,this);">
                            </div>
                        </form>
                       
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success" onclick="calcular()">Calcular</button>
                        <div class="spinner-border mt-2" role="status" style="display: none;" id="load">
                            <span class=""><i>Calculando resultado...</i></span>
                          </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-3 col-lg-3"></div>
        </div>

        <div class="row mt-2" id="resultado" style="display: none">
            <div class="col-xs-12 col-md-4 col-lg-4"></div>
            <div class="col-xs-12 col-md-4 col-lg-4">
                <h3 class="text-center">Resultado Final: </h3>
                <h5 id="puntajeFinal"></h5>
            </div>
            <div class="col-xs-12 col-md-4 col-lg-4"></div>
        </div>

    </div>


    <script src="{{asset('js/jquery-3.3.1.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script>
        function crearRegistro(opcion){
            if(opcion == 1){
                $("#contenedorListado").hide();
                $("#contenedorRegistro").show();
            }else{
                $("#contenedorListado").show();
                $("#contenedorRegistro").hide();
                $("#resultado").hide();
                $("#load").hide();
            }
           
        }

        function calcular(){
            let valida = validarCampos();
            if(valida){
                $("#alerta").show();
            }else{  
                $("#alerta").hide();
            let nombre = $("#nombre").val();
            let nota1 = $("#nota1").val();
            let nota2 = $("#nota2").val();
            let nota3 = $("#nota3").val();
                console.log(parseFloat(nota1));
            if(parseFloat(nota1) < 1.0  || parseFloat(nota1) > 5.0 || parseFloat(nota2) < 1.0  || parseFloat(nota2) > 5.0 || parseFloat(nota3) < 1.0  || parseFloat(nota3) > 5.0 ){
                alert("La notas deben ser mayor o igual a 1.0 y menor o igual a 5.0");
            }else{

            let final = calcularPromedio(nota1,nota2,nota3);

            var token = '{{csrf_token()}}';
            $("#load").show();
            $.ajax({
                    type:  'POST',
                    async: true,
                    url: "inicio", 
                    data: {'nombre':nombre,'parcial1':nota1,'parcial2':nota2,'parcial3':nota3,'final':final, _token:token},
                    cache: false,
                    success: function(response){
                        if(response != 2){
                            document.getElementById("listado").innerHTML = response;
                             $("#resultado").show();
                             $("#puntajeFinal").text(final);
                        }else{
                            alert("Ha ocurrido un error");
                        }
                        console.log(response);
                      
                    },
                    error:function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status);
                        alert(thrownError);
                    }
                });
            }

                
            }
           
         }

         function calcularPromedio(nota1, nota2, nota3)
         {
            let promedio = 0;
            promedio = (parseFloat(nota1) + parseFloat(nota2) + parseFloat(nota3)) / 3;

            return promedio.toFixed(1);
         }

         function validarCampos()
         {
             let campos = ["#nombre", "#nota1", "#nota2", "#nota3"];
             let valida = false;
             for(var i=0; i < campos.length; i++){
                 console.log(campos[i]);
                 if($(campos[i]).val() == ""){
                    valida = true;
                    $(campos[i]).css({'border': '1px solid red'});
                 }
             }

             return valida;
         }

         function eliminarRegistro(id)
         {
            var token = '{{csrf_token()}}';
            $.ajax({
                    type:  'POST',
                    async: true,
                    url: "eliminarregistro", 
                    data: {'id':id, _token:token},
                    cache: false,
                    success: function(response){
                        if(response != 2){
                            document.getElementById("listado").innerHTML = response;
                        }else{
                            alert("Ha ocurrido un error");
                        }
                        console.log(response);
                      
                    },
                    error:function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status);
                        alert(thrownError);
                    }
                });
         }

         function Solo_Texto(e) {
            var code;
            if (!e) var e = window.event;
            if (e.keyCode) code = e.keyCode;
            else if (e.which) code = e.which;
            var character = String.fromCharCode(code);
            var AllowRegex  = /^[\ba-zA-Z\s-]$/;
            if (AllowRegex.test(character)) return true;     
            return false; 
        }

        function filterFloat(evt,input){
            // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
            var key = window.Event ? evt.which : evt.keyCode;    
            var chark = String.fromCharCode(key);
            var tempValue = input.value+chark;
            if(key >= 48 && key <= 57){
                if(filter(tempValue)=== false){
                    return false;
                }else{       
                    return true;
                }
            }else{
                if(key == 8 || key == 13 || key == 0) {     
                    return true;              
                }else if(key == 46){
                        if(filter(tempValue)=== false){
                            return false;
                        }else{       
                            return true;
                        }
                }else{
                    return false;
                }
            }
        }
    function filter(__val__){
        var preg = /^([0-9]+\.?[0-9]{0,1})$/; 
        if(preg.test(__val__) === true){
            return true;
        }else{
        return false;
        }
        
    }


        

    </script>
</body>
</html>