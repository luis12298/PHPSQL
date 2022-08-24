function validar() {
  var usuario = document.getElementById("txtusuario");
  var pass = document.getElementById("txtpass");
  if (trim(usuario.value == "") || usuario.value == null) {
    alert("Campo Vacio");
    usuario.focus();
    return false;
  } else if (trim(pass.value == "") || pass.value == null) {
    alert("Campo Vacio");
    pass.focus();
    return false;
  } else {
    return true;
  }
}
$(document).ready(function () {
  (function ($) {
    $("#txtbuscar").keyup(function () {
      var ValorBusqueda = new RegExp($(this).val(), "i");
      $(".busqueda tr").hide();
      $(".busqueda tr")
        .filter(function () {
          return ValorBusqueda.test($(this).text());
        })
        .show();
    });
  })(jQuery);
});

document.querySelector("#dgvDatos").addEventListener("click", (event) => {
  let fila = event.target.parentNode;
  let valor = fila.querySelectorAll("td")[0].innerText;
  document.getElementById("txtId").value = valor;
});
function actualizar() {
  h = document.getElementById("url1");
  h.setAttribute("href", "actualizar_usuario.php?id=" + document.getElementById("txtId").value);
}
function eliminar() {
  h = document.getElementById("url2");
  var r = window.confirm("Desea eliminar este registro?");
  if (r) {
    h.setAttribute("href", "eliminar_usuario.php?id=" + document.getElementById("txtId").value);
  }
}
