<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require_once "scripts.php" ?>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card text-left">
                    <div class="card-header">
                        <span class="btn btn-primary" > <span class="fas fa-plus-circle" data-toggle="modal" data-target="#AgregarDatosModal">Agregar Nuevo</span></span>
                    </div>
                    <div class="card-body">
                     <hr>
                     <div id="tablaDatatable"></div>
                    </div>
                    <div class="card-footer text-muted">
                        Prueba
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="AgregarDatosModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Juego</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formNuevo">
            <label for="nombre">Nombre</label>
            <input class="form-control input-sm" type="text" id="nombre" name="nombre">
            <label for="anio">Año</label>
            <input class="form-control input-sm" type="text" id="anio" name="anio">
            <label for="empresa">Empresa</label>
            <input class="form-control input-sm" type="text" id="empresa"  name="empresa">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" id="btnGuardar" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Juego</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      <form id="formActualizar">
      <input type="text" id="idjuego" hidden="" name="idjuego">
            <label for="nombreAct">Nombre</label>
            <input class="form-control input-sm" type="text" id="nombreAct" name="nombreAct">
            <label for="anioAct">Año</label>
            <input class="form-control input-sm" type="text" id="anioAct" name="anioAct">
            <label for="empresaAct">Empresa</label>
            <input class="form-control input-sm" type="text" id="empresaAct"  name="empresaAct">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" id="btnActualizar" class="btn btn-warning">Actualizar</button>
      </div>
    </div>
  </div>
</div>
</body>

</html>
<script type="text/javascript">
$(document).ready(function(){
    $('#btnGuardar').click(function(){
        datos= $('#formNuevo').serialize();
        $.ajax({
            type:"POST",
            data:datos,
            url:"procesos/agregar.php",
            success:function(r){
                if(r==1){
                  $('#formNuevo')[0].reset();
                    $('#tablaDatatable').load('tabla.php');
                    alertify.success("agregado con exito");
                }else{
                    alertify.error("Fallo al agregar");
                }
            }
        });
    });
  $('#btnActualizar').click(function(){
    datos= $('#formActualizar').serialize();
        $.ajax({
            type:"POST",
            data:datos,
            url:"procesos/actualizar.php",
            success:function(r){
                if(r==1){
                    $('#tablaDatatable').load('tabla.php');
                    alertify.success("Actualizado con exito");
                }else{
                    alertify.error("Fallo al actualizar");
                }
            }
        });
  });
});

</script>

<script type="text/javascript">
$(document).ready(function(){
    $('#tablaDatatable').load('tabla.php');
});
</script>
<script type="text/javascript">
function obtenerActualizar(idjuego){
    $.ajax({
        type:"POST",
        data:"idjuego=" + idjuego,
        url:"procesos/obtenerDatos.php",
        success:function(r){
            datos= jQuery.parseJSON(r);
            $('#idjuego').val(datos['id_juego']);
            $('#nombreAct').val(datos['nombre']);
            $('#anioAct').val(datos['anio']);
            $('#empresaAct').val(datos['empresa']);
        }
    });

}
function eliminar(idjuego){
  alertify.confirm('Eliminar un juego',
                   'Seguro de eliminar este juego?',
   function(){ 
    $.ajax({
        type:"POST",
        data:"idjuego=" + idjuego,
        url:"procesos/eliminar.php",
        success:function(r){
            if(r==1){
              $('#tablaDatatable').load('tabla.php');
              alertify.success("Eliminado con exito");
            }else{
              alertify.error("no se pudo eliminar");
            }
        }
    });
    }
                , function(){ });

}
</script>