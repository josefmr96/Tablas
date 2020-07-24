<?php 

require_once "clases/conexion.php";
$obj= new conectar();
$conexion=$obj->conexion();

$sql="SELECT id_juego,
    nombre,
    anio,
    empresa
    from t_juegos";
    $result=mysqli_query($conexion,$sql);
?>

<div>
    <table class="table table-hover table-condensed " id="iddatatable">
        <thead style="background-color: #dc3545;color: white; font-weight: bold;">
            <tr class="table-bordered">
                <td>Nombre</td>
                <td>Año</td>
                <td>Empresa</td>
                <td>Editar</td>
                <td>Eliminar</td>
            </tr>
        </thead>
        <tfoot style="background-color: #ccc;color: white; font-weight: bold;">
            <tr>
                <td>Nombre</td>
                <td>Año</td>
                <td>Empresa</td>
                <td>Editar</td>
                <td>Elimnar</td>
            </tr>
        </tfoot>
        <tbody style="background-color: white;">
            <?php
            while ($mostar=mysqli_fetch_row($result)) { ?>
            <tr >
                <td><?php echo $mostar[1] ?></td>
                <td><?php echo $mostar[2] ?></td>
                <td><?php echo $mostar[3] ?></td>
              <td style="text-align: center;">
                  <span class="btn btn-warning btn-sm" onclick="obtenerActualizar('<?php echo $mostar[0] ?>')" data-toggle="modal" data-target="#modalEditar"><span class="fas fa-edit"></span>
                </span></td>
                <td  style="text-align: center;">
                    <span onclick="eliminar('<?php echo $mostar[0] ?>')" class="btn btn-danger btn-sm"><span class="fas fa-trash"></span>
                </span></td> 
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#iddatatable').DataTable();
	} );
</script>