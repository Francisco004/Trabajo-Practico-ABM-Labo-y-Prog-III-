"use strict";
var Ajax = /** @class */ (function () {
    function Ajax() {
        var _this = this;
        this.Get = function (ruta, success, params, error) {
            if (params === void 0) { params = ""; }
            var parametros = params.length > 0 ? params : "";
            ruta = params.length > 0 ? ruta + "?" + parametros : ruta;
            _this.xhr.open('GET', ruta);
            _this.xhr.send();
            _this.xhr.onreadystatechange = function () {
                if (_this.xhr.readyState === Ajax.DONE) {
                    if (_this.xhr.status === Ajax.OK) {
                        success(_this.xhr.responseText);
                    }
                    else {
                        if (error !== undefined) {
                            error(_this.xhr.status);
                        }
                    }
                }
            };
        };
        this.Post = function (ruta, success, params, error) {
            if (params === void 0) { params = ""; }
            _this.xhr.open('POST', ruta, true);
            if (typeof (params) == "string") {
                _this.xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
            }
            else {
                _this.xhr.setRequestHeader("enctype", "multipart/form-data");
            }
            _this.xhr.send(params);
            _this.xhr.onreadystatechange = function () {
                if (_this.xhr.readyState === Ajax.DONE) {
                    if (_this.xhr.status === Ajax.OK) {
                        success(_this.xhr.responseText);
                    }
                    else {
                        if (error !== undefined) {
                            error(_this.xhr.status);
                        }
                    }
                }
            };
        };
        this.xhr = new XMLHttpRequest();
        Ajax.DONE = 4;
        Ajax.OK = 200;
    }
    return Ajax;
}());
///Parte 2 del TP
function AdministrarValidaciones() {
    var retorno = true;
    var sexo = document.getElementById("sexo").value;
    var nombre = document.getElementById("txtNombre").value;
    var foto = document.getElementById("imagenEmpleado").value;
    var dni = parseInt(document.getElementById("txtDni").value);
    var apellido = document.getElementById("txtApellido").value;
    var legajo = parseInt(document.getElementById("txtLegajo").value);
    var sueldo = parseInt(document.getElementById("txtSueldo").value);
    AdministrarSpanError("spanSexo", ValidarCombo(sexo, "---"));
    AdministrarSpanError("spanNombre", ValidarCamposVacios(nombre));
    AdministrarSpanError("spanApellido", ValidarCamposVacios(apellido));
    AdministrarSpanError("spanFoto", ValidarCamposVacios(foto.toString()));
    AdministrarSpanError("spanLegajo", ValidarRangoNumerico(legajo, 100, 550));
    AdministrarSpanError("spanDNI", ValidarRangoNumerico(dni, 1000000, 55000000));
    AdministrarSpanError("spanSueldo", ValidarRangoNumerico(sueldo, 8000, ObtenerSueldoMaximo(ObtenerTurnoSeleccionado())));
    if (!VerificarValidacionesLogin()) {
        console.log("Apellido: " + apellido + "\nNombre: " + nombre + "\nDNI: " + dni + "\nSexo: " + sexo + "\nLegajo: " + legajo + "\nSueldo: " + sueldo + "\nTurno: " + ObtenerTurnoSeleccionado());
        window.alert("Apellido: " + apellido + "\nNombre: " + nombre + "\nDNI: " + dni + "\nSexo: " + sexo + "\nLegajo: " + legajo + "\nSueldo: " + sueldo + "\nTurno: " + ObtenerTurnoSeleccionado());
    }
    else {
        alert("Se encontraron uno o mas campos errones, fueron marcados con *");
        retorno = false;
    }
    return retorno;
}
function ValidarCamposVacios(cadena) {
    var retorno = true;
    if (cadena != "" || cadena == null) {
        retorno = false;
    }
    return retorno;
}
function ValidarRangoNumerico(numero, minimo, maximo) {
    var retorno = true;
    if (!ValidarCamposVacios(numero.toString()) && numero >= minimo && numero <= maximo) {
        retorno = false;
    }
    return retorno;
}
function ValidarCombo(sexo, error) {
    var retorno = true;
    if (sexo != error) {
        retorno = false;
    }
    else {
        document.getElementById("sexo").value = "";
    }
    return retorno;
}
function ObtenerTurnoSeleccionado() {
    var retorno = "";
    var turno = document.getElementsByName('radioTurno');
    for (var i = 0; i < turno.length; i++) {
        if (turno[i].checked) {
            retorno = turno[i].value;
            break;
        }
    }
    return retorno;
}
function ObtenerSueldoMaximo(valorTurno) {
    var retorno = 0;
    if (valorTurno === "mañana") {
        retorno = 20000;
    }
    else if (valorTurno === "tarde") {
        retorno = 18500;
    }
    else {
        retorno = 25000;
    }
    return retorno;
}
///Parte 4 del TP
function AdministrarValidacionesLogin() {
    var dni = parseInt(document.getElementById("txtDni").value);
    var apellido = document.getElementById("txtApellido").value;
    AdministrarSpanError("spanApellido", ValidarCamposVacios(apellido));
    AdministrarSpanError("spanDNI", ValidarRangoNumerico(dni, 1000000, 55000000));
    if (VerificarValidacionesLogin()) {
        alert("Se encontraron uno o mas campos errones, fueron marcados con *");
    }
}
function AdministrarSpanError(id, accion) {
    if (accion) {
        document.getElementById(id).style.display = 'block';
    }
    else {
        document.getElementById(id).style.display = 'none';
    }
}
function VerificarValidacionesLogin() {
    var retorno = false;
    var divs = document.getElementsByTagName("span");
    for (var i = 0; i < divs.length; i++) {
        if (divs[i].style.display == 'block') {
            retorno = true;
            break;
        }
    }
    return retorno;
}
///Parte 5 del TP
function AdministrarModificar(dni) {
    document.getElementById("dniHidden").value = dni;
    var formulario = document.getElementById("modificarForm");
    formulario.submit();
}
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
        if (AdministrarValidaciones()) {
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
//# sourceMappingURL=funciones.js.map