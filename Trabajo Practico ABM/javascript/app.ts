/// <reference path="validacion.ts" />
/// <reference path="ajax.ts" />

window.onload = (): void =>
{
   Main.RefrescarPaginaSuccess();
};

function DeleteEmployee(legajo:number):void{
    Main.EliminarEmpleado(legajo);  
}

namespace Main 
{  
    export function RefrescarPaginaSuccess():void
    {                
        MostrarForm();
        MostrarEmpleados();
    }

    export function MostrarEmpleados():void
    {
        let ajax : Ajax = new Ajax();
        ajax.Post("../backend/mostrar.php",MostrarEmpleadosSuccess);     
    }

    export function MostrarForm():void
    {     
        let ajax : Ajax = new Ajax();
        ajax.Post("../html/index.php",MostrarFormSuccess);   
    }
    
    export function MostrarEmpleadosSuccess(empleados:string):void
    {      
        (<HTMLDivElement>document.getElementById("divMostrar")).innerHTML = empleados; 
    }

    export function MostrarFormSuccess(respuesta: string):void
    {
        (<HTMLDivElement>document.getElementById("divAlta")).innerHTML = respuesta; 
    }
    
    export function EliminarEmpleado(legajo:number):void
    {
        let ajax = new Ajax();
        let parametros: string = `legajo=${legajo}`;
        ajax.Get("../php/eliminar.php",DeleteSuccess,parametros,Fail);
    }

    export function DeleteSuccess(retorno: string):void {
        console.clear();
        console.log(retorno);
        MostrarEmpleados();
    }

    export function Fail(retorno:string):void {
        console.clear();
        console.log(retorno);
        alert("Ha ocurrido un ERROR!!!");
    } 

    export function ModificarEmpleado(dni: number): void
    {
        let ajax : Ajax = new Ajax();
        let parametros: string = `dniHidden=${dni}`;

        ajax.Post("../html/index.php",    MostrarFormSuccess,        parametros,        Fail        );
    } 

    export function CargarDatos(): void
    {           
        if(AdministrarValidaciones())
        {
            let turno: string = ObtenerTurnoSeleccionado();
            let sexo: string = (<HTMLInputElement> document.getElementById("sexo")).value;
            let dni: string = (<HTMLInputElement> document.getElementById("txtDni")).value;
            let modificar = (<HTMLInputElement>document.getElementById("hdnModificar")).value;
            let nombre: string = (<HTMLInputElement> document.getElementById("txtNombre")).value;
            let sueldo: string = (<HTMLInputElement> document.getElementById("txtSueldo")).value;
            let legajo: string = (<HTMLInputElement> document.getElementById("txtLegajo")).value;
            let apellido: string = (<HTMLInputElement> document.getElementById("txtApellido")).value;
            let foto : any = (<HTMLInputElement> document.getElementById("imagenEmpleado"));
    
            let form: FormData = new FormData();
    
            form.append("txtDni",dni);
            form.append("txtNombre",nombre);
            form.append("txtApellido",apellido);
            form.append("sexo",sexo);
    
            form.append("txtSueldo",sueldo);
            form.append("txtLegajo",legajo);
            form.append("radioTurno",turno);
    
            form.append("imagenEmpleado", foto.files[0]);
            form.append("hdnModificar",modificar);
    
            MandarEmpleado(form);
        }
    }

    const MandarEmpleado = (form: FormData) =>
    {
        let ajax = new Ajax();
        ajax.Post("../php/administracion.php", RefrescarPaginaSuccess, form, Fail);
    } 

}