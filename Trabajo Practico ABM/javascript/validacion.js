///Parte 2 del TP
function AdministrarValidaciones() {
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
    }
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
    if (valorTurno === "Mañana") {
        retorno = 20000;
    }
    else if (valorTurno === "Tarde") {
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
