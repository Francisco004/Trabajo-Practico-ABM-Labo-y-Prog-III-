///Parte 2 del TP
function AdministrarValidaciones() : boolean
{
    var retorno = true;
    var sexo : string = (<HTMLInputElement> document.getElementById("sexo")).value;
    var nombre : string = (<HTMLInputElement> document.getElementById("txtNombre")).value;
    var foto : string = (<HTMLInputElement> document.getElementById("imagenEmpleado")).value;
    var dni : number = parseInt((<HTMLInputElement> document.getElementById("txtDni")).value);
    var apellido : string = (<HTMLInputElement> document.getElementById("txtApellido")).value;
    var legajo : number = parseInt((<HTMLInputElement> document.getElementById("txtLegajo")).value);
    var sueldo : number = parseInt((<HTMLInputElement> document.getElementById("txtSueldo")).value);

    AdministrarSpanError("spanSexo",ValidarCombo(sexo,"---"));
    AdministrarSpanError("spanNombre",ValidarCamposVacios(nombre));
    AdministrarSpanError("spanApellido",ValidarCamposVacios(apellido));
    AdministrarSpanError("spanFoto",ValidarCamposVacios(foto.toString()));
    AdministrarSpanError("spanLegajo",ValidarRangoNumerico(legajo,100,550));
    AdministrarSpanError("spanDNI",ValidarRangoNumerico(dni,1000000,55000000));
    AdministrarSpanError("spanSueldo",ValidarRangoNumerico(sueldo,8000,ObtenerSueldoMaximo(ObtenerTurnoSeleccionado())));
        
    if(!VerificarValidacionesLogin())
    {
        console.log("Apellido: " + apellido + "\nNombre: " + nombre + "\nDNI: " + dni + "\nSexo: " + sexo + "\nLegajo: " + legajo + "\nSueldo: " + sueldo + "\nTurno: " + ObtenerTurnoSeleccionado());
        window.alert("Apellido: " + apellido + "\nNombre: " + nombre + "\nDNI: " + dni + "\nSexo: " + sexo + "\nLegajo: " + legajo + "\nSueldo: " + sueldo + "\nTurno: " + ObtenerTurnoSeleccionado());
    }
    else
    {
        alert("Se encontraron uno o mas campos errones, fueron marcados con *");
        retorno = false;
    }

    return retorno;
}

function ValidarCamposVacios(cadena : string) : boolean
{
    let retorno : boolean = true;

    if(cadena != "" || cadena == null)
    {
        retorno = false;
    }

    return retorno;
}

function ValidarRangoNumerico(numero : number, minimo : number, maximo : number) : boolean
{
    let retorno : boolean = true;

    if(!ValidarCamposVacios(numero.toString()) && numero >= minimo && numero <= maximo)
    {
        retorno = false;
    }

    return retorno;
}

function ValidarCombo(sexo : string, error : string) : boolean
{
    let retorno : boolean = true;

    if(sexo != error)
    {
        retorno = false;
    }
    else
    {
        (<HTMLInputElement> document.getElementById("sexo")).value = "";
    }

    return retorno;
}

function ObtenerTurnoSeleccionado() : string
{
    var retorno : string = "";
    var turno = document.getElementsByName('radioTurno');    

    for(var i : number = 0; i < turno.length; i++)
    {
        if((turno[i] as HTMLInputElement).checked)
        {
            retorno = (turno[i] as HTMLInputElement).value;
            break;
        }
    }

    return retorno;
}

function ObtenerSueldoMaximo(valorTurno : string) : number
{
    let retorno : number = 0;

    if(valorTurno === "mañana")
    {
        retorno = 20000;
    }
    else if(valorTurno === "tarde")
    {
        retorno = 18500;
    }
    else
    {
        retorno = 25000;
    }

    return retorno;
}

///Parte 4 del TP

function AdministrarValidacionesLogin() : void
{
    var dni : number = parseInt((<HTMLInputElement> document.getElementById("txtDni")).value);
    var apellido : string = (<HTMLInputElement> document.getElementById("txtApellido")).value;

    AdministrarSpanError("spanApellido",ValidarCamposVacios(apellido));

    AdministrarSpanError("spanDNI",ValidarRangoNumerico(dni,1000000,55000000));

    if(VerificarValidacionesLogin())
    {
        alert("Se encontraron uno o mas campos errones, fueron marcados con *");
    }

}

function AdministrarSpanError(id : string, accion : boolean) : void
{
    if(accion)
    {
        (<HTMLInputElement> document.getElementById(id)).style.display = 'block';
    }
    else
    {
        (<HTMLInputElement> document.getElementById(id)).style.display = 'none';
    }
}

function VerificarValidacionesLogin () : boolean
{
    let retorno : boolean = false;
    var divs = document.getElementsByTagName("span");

    for (let i = 0; i < divs.length; i++) 
    {
        if(divs[i].style.display == 'block')
        {
            retorno = true;
            break;
        }
    }

    return retorno;
}


///Parte 5 del TP

function AdministrarModificar(dni : string)
{
    (<HTMLInputElement> document.getElementById("dniHidden")).value = dni;
    var formulario = (<HTMLFormElement> document.getElementById("modificarForm"));

    formulario.submit();
}