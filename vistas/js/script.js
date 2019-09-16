function uncheck(){
    function valFormul(){
        var contador=0;
        var nombre=document.getElementById('nombre'),
            apellido=document.getElementById('apellido'),
            documento=document.getElementById('documento'),
            correo=document.getElementById('correo');
            telefono=document.getElementById('telefono'),
            clave=document.getElementById('clave'),
            confirmaclave=document.getElementById('confirmaclave');
        

        var infonombre=document.getElementById('infonombre'),
            infoapellido=document.getElementById('infoapellido'),
            infodocumento=document.getElementById('infodocumento'),
            infotelefono=document.getElementById('infotelefono'),
            infocorreo=document.getElementById('infocorreo'),
            infoclave=document.getElementById('infoclave'),
            infoclaveconfirma=document.getElementById('infoclaveconfirma'),
            prueba=document.getElementById('prueba');

            debugger;
            if(!isNaN(nombre.value)){
                infonombre.innerHTML='Nombre Inválido';
                infonombre.style.color='red';
                contador++;
            }else{
                if(nombre.selectionStart<3 || nombre.selectionStart>50){
                    infonombre.innerHTML='Nombre Inválido';
                    infonombre.style.color='red';
                    contador++;
                }else{
                    infonombre.style.display='none';
                    contador--;
                }
            }
            if(!isNaN(apellido.value)){
                infoapellido.innerHTML='Apellido Inválido';
                infoapellido.style.color='red';
                contador++;
            }else{
                if(apellido.selectionStart<4 || apellido.selectionStart>50){
                    infoapellido.innerHTML='Apellido Inválido';
                    infoapellido.style.color='red';
                    contador++;  
                }else{
                    infoapellido.style.display='none';
                    contador--;
                }
            }
            if(isNaN(documento.value)){
                infodocumento.innerHTML='Documento Inválido';
                infodocumento.style.color='red';
                contador++;
            }else{
                if(documento.selectionStart<8 || documento.selectionStart>10){
                    infodocumento.innerHTML='Documento Inválido';
                    infodocumento.style.color='red';  
                    contador++;
                }else{
                    infodocumento.style.display='none';
                    contador--;
                }
            }if(correo.value==""){
                infocorreo.innerHTML='Correo Inválido';
                infocorreo.style.color='red';
                contador++;
            }else{
               infocorreo.style.display='none';
               contador--;
            }
            if(isNaN(telefono.value)){
                infotelefono.innerHTML='Telefono Inválido';
                infotelefono.style.color='red';
                contador++;
            }else{
                if(telefono.selectionStart!=10){
                    infotelefono.innerHTML='Telefono Inválido';
                    infotelefono.style.color='red';
                    contador++;
                }else{
                    infotelefono.style.display='none';
                    contador--;
                }
            }
            if(clave.value!=confirmaclave.value || clave.value=="" ||confirmaclave==""){
                infoclaveconfirma.innerHTML='Contraseñas no coinciden';
                infoclaveconfirma.style.color='red';
                contador++;
            }else{
                infoclaveconfirma.style.display='none';
                contador--;
            }
    };
    valFormul();
}
function factura(){
    function buscarFactura(){
        var codigo=document.getElementById('codigo').value;
        var consulta="";
    }
    buscarFactura();
}