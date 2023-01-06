<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Credi7</title>
    <style>
    .blue {
        background: #0080BD;
    }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-5 p-1">
                <h2>Ayuda de recuperación a cliente </h3>
                    <!-- <img src="https://credi7.com.mx/wp-content/uploads/2022/01/logo_credi_7.png" alt="" class="img-fluid"> -->
            </div>
            <!-- https://credi7.com.mx/wp-content/uploads/2022/01/logo_credi_7.png -->
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-7 p-4 border white border-secundary rounded">
                <div class="col-12 col-md-5 blue rounded p-2 mb-4">
                    <a href="https://credi7.com.mx/">
                        <img src="https://credi7.com.mx/wp-content/uploads/2022/01/logo_credi_7.png" alt=""
                            class="img-fluid">
                    </a>
                </div>
                <!-- <div class="col-4 p-5 col-md-4 col-sm-10 col-10 border white border-secundary border-3 rounded mt-5 p-3"> -->
                <div class="mb-3">
                    <label class="form-label">Numero de orden Financiamiento:</label>
                    <input type="codigobloqueo" class="form-control" id="buscar" name="buscar">
                </div>
                <div class="row justify-content-center">
                    <div class="col-3">
                        <button onclick="buscar_bd($('#buscar').val());" class="btn btn-primary">Buscar</button>
                    </div>
                </div>
            </div>

        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-7 border white border-secundary rounded">

                    <div id="datos_buscador" class="container pl-5 pr-5"></div>
                
            </div>
            <!-- <div class="card col-12 col-md-5">
                <div class="card-body">
                    <div id="datos_buscador" class="container pl-5 pr-5"></div>
                </div>
            </div> -->
        </div>
    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script> -->
    <script type="text/javascript">
    function buscar_bd(buscar) {
        var parametros = {
            "buscar": buscar
        };
        $.ajax({
            data: parametros,
            type: 'POST',
            url: 'controlador/Buscador_Financiamiento_controlador.php',
            success: function(data) {
                document.getElementById("datos_buscador").innerHTML = data;
            }
        });
    }
    </script>
    
</body>

</html>