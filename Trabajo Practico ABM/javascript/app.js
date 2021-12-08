/// <reference path="validacion.ts" />
/// <reference path="ajax.ts" />
window.onload = function () {
    Main.RefrescarPaginaSuccess();
};
function DeleteEmployee(legajo) {
    Main.EliminarEmpleado(legajo);
}
var Main;
(function (Main) {
    function RefrescarPaginaSuccess() {
        MostrarForm();
        MostrarEmpleados();
    }
    Main.RefrescarPaginaSuccess = RefrescarPaginaSuccess;
    function MostrarEmpleados() {
        var ajax = new Ajax();
        ajax.Post("../backend/mostrar.php", MostrarEmpleadosSuccess);
    }
    Main.MostrarEmpleados = MostrarEmpleados;
    function MostrarForm() {
        var ajax = new Ajax();
        ajax.Post("../html/index.php", MostrarFormSuccess);
    }
    Main.MostrarForm = MostrarForm;
    function MostrarEmpleadosSuccess(empleados) {
        document.getElementById("divMostrar").innerHTML = empleados;
    }
    Main.MostrarEmpleadosSuccess = MostrarEmpleadosSuccess;
    function MostrarFormSuccess(respuesta) {
        document.getElementById("divAlta").innerHTML = respuesta;
    }
    Main.MostrarFormSuccess = MostrarFormSuccess;
    function EliminarEmpleado(legajo) {
        var ajax = new Ajax();
        var parametros = "legajo=" + legajo;
        ajax.Get("../php/eliminar.php", DeleteSuccess, parametros, Fail);
    }
    Main.EliminarEmpleado = EliminarEmpleado;
    function DeleteSuccess(retorno) {
        console.clear();
        console.log(retorno);
        MostrarEmpleados();
    }
    Main.DeleteSuccess = DeleteSuccess;
    function Fail(retorno) {
        console.clear();
        console.log(retorno);
        alert("Ha ocurrido un ERROR!!!");
    }
    Main.Fail = Fail;
    function ModificarEmpleado(dni) {
        var ajax = new Ajax();
        var parametros = "dniHidden=" + dni;
        ajax.Post("../html/index.php", MostrarFormSuccess, parametros, Fail);
    }
    Main.ModificarEmpleado = ModificarEmpleado;
    function CargarDatos() {
        AdministrarValidaciones();
        if (!VerificarValidacionesLogin()) {
            var turno = ObtenerTurnoSeleccionado();
            var sexo = document.getElementById("sexo").value;
            var dni = document.getElementById("txtDni").value;
            var modificar = document.getElementById("hdnModificar").value;
            var nombre = document.getElementById("txtNombre").value;
            var sueldo = document.getElementById("txtSueldo").value;
            var legajo = document.getElementById("txtLegajo").value;
            var apellido = document.getElementById("txtApellido").value;
            var foto = document.getElementById("imagenEmpleado");
            var form = new FormData();
            form.append("txtDni", dni);
            form.append("txtNombre", nombre);
            form.append("txtApellido", apellido);
            form.append("sexo", sexo);
            form.append("txtSueldo", sueldo);
            form.append("txtLegajo", legajo);
            form.append("radioTurno", turno);
            form.append("imagenEmpleado", foto.files[0]);
            form.append("hdnModificar", modificar);
            MandarEmpleado(form);
        }
    }
    Main.CargarDatos = CargarDatos;
    var MandarEmpleado = function (form) {
        var ajax = new Ajax();
        ajax.Post("../php/administracion.php", RefrescarPaginaSuccess, form, Fail);
    };
})(Main || (Main = {}));
