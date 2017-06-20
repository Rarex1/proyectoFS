$(function(){
  $("input[name='foto']").on("change", function(){
    datosFormulario = new FormData($("#formulario")[0]);
    ruta = "script/operaciones/actualizarImagen.php";
    $.ajax({
      url: ruta,
      type: "POST",
      data: datosFormulario,
      contentType: false,
      processData: false,
      success: function(datos)
      {
        $("#imgTagPerfil").attr("src", datos);
      }
    });
  });
});
