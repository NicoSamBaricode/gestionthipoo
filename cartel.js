
function confirmBorrar()
{
   var respuesta = confirm("Estas seguro que queres eliminar el registro?");

   if (respuesta){
     return true;
   }
   else{
     return false;
   }
}


