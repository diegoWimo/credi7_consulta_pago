<?php
require_once "../modelo/conexion.php";

if (preg_match('/^[0-9]+$/', $_POST["buscar"])) {
    $conexion = Conectar::conexion();
//$query ="SELECT C.nombre_cliente, F.Fecha_Financ FROM clientes WHERE nombre_cliente LIKE LOWER('%".$_POST["buscar"]."%')";
    $query = "SELECT CLI.NOMBRE_CLIENTE ,FIN.FECHA_FINANC, FIN.IMEI, ART.DESCRIPCION_ART, OPPAGO.CODIGO_BLOQUEO,OPPAGO.MONTO_ADEUDO,OPPAGO.OPCION_1
    FROM FINANCIAMIENTOS FIN 
    INNER JOIN CLIENTES CLI 
    ON FIN.NUM_CLIENTE = CLI.NUM_CLIENTE 
    INNER JOIN ARTICULOS ART
    ON FIN.CODIGO_ART= ART.CODIGO_ART
    INNER JOIN OPCIONES_PAGO OPPAGO
    ON OPPAGO.ORDEN_FINANC=FIN.ORDEN_FINANC
    WHERE FIN.ORDEN_FINANC= " . $_POST['buscar'] . "";
//$query ="SELECT C.nombre_cliente, F.Fecha_Financ FROM clientes WHERE nombre_cliente LIKE LOWER('%".$_POST["buscar"]."%')";
//$query ="SELECT * FROM clientes WHERE nombre_cliente LIKE LOWER('%".$_POST["buscar"]."%')";
    $sentencia = $conexion->prepare($query);
    $sentencia->execute(array());
    $resultado_consulta = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    $query = "SELECT NUM_PAGO, FECHA_PAGO,FECHA_VENC
FROM PAGOS
WHERE ORDEN_FINANC=" . $_POST['buscar'] . "";
    $sentencia = $conexion->prepare($query);
    $sentencia->execute(array());
    $arrayPagos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    $sentencia->closeCursor();
    $conexion = null;
} else {
    echo '
    <script>
        swal({
            type: "error",
            title: "No puedes usar caracteres especiales. Sólo letras y números",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
        }).then(function(result){
            if(result.value){
                window.location = "index.php";
            }
        });
    </script>';
    $resultado_consulta=null;
}

if ($resultado_consulta == null) {
    echo "<h5>El codigo de financiemiento no coincide con algun financiamineto con adeudo, porfavor ingrese un codigo valido.</h5>";
} else {?>

<div class="row">
    <div class=col-6>
        <h5>Nombre:</h5>
        <p><?php echo $resultado_consulta[0]["NOMBRE_CLIENTE"]; ?></p>
    </div>
    <div class=col-6>
        <h5>Fecha Venta:</h5>
        <p><?php echo $resultado_consulta[0]["FECHA_FINANC"]; ?></p>
    </div>
</div>
<div class="row">
    <div class=col-6>
        <h5>IMEI:</h5>
        <p><?php echo $resultado_consulta[0]["IMEI"] ;?></p>
    </div>
    <div class=col-6>
        <h5>Modelo:</h5>
        <p><?php echo $resultado_consulta[0]["DESCRIPCION_ART"]; ?></p>
    </div>
</div>
<div class="row">
    <div class=col-6>
        <h5>Codigo de bloqueo:</h5>
        <p><?php echo$resultado_consulta[0]["CODIGO_BLOQUEO"]; ?></p>
    </div>
    <div class=col-6>
        <h5>Monto de adeudo:</h5>
        <p>$ <?php echo $resultado_consulta[0]["MONTO_ADEUDO"]; ?></p>
    </div>
</div>
<div class="row">
    <div class=col-6>
        <h5>Referencia bancomer :</h5>
        <p>1213452212334341</p>
    </div>
    <div class=col-6>
        <h5>Monto de pago:</h5>
        <p>$ <?php echo $resultado_consulta[0]["OPCION_1"]; ?>.00</p>
    </div>
</div>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Num. pago</th>
            <th scope="col">Fecha de pago</th>
            <th scope="col">Fecha de vencimiento</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach($arrayPagos as $pago){
           echo "<tr>";
           foreach($pago as $columna){
            echo "<td>".$columna."</td>";
           }
           echo "</tr>";
        }
        
        ?>
    </tbody>
</table>
<?php
}

/*   echo
"<div class=col-6>".
"<h5>Nombre:</h5>".
"<p>". $resultado_consulta[0]["NOMBRE_CLIENTE"] ."</p>".
"</div>".
"<div class=col-6>".
"<h5>Fecha Inicial:</h5>".
"<p>". $resultado_consulta[0]["FECHA_FINANC"] ."</p>".
"</div>";
}
 */

?>