
function modificar(id){   
    
    document.getElementById("form_modif").setAttribute("action","{{path('modificar')}}"+"/"+id) ;    

    
    document.getElementById("form_agreg").style.visibility="hidden";
    document.getElementById("form_modif").style.visibility="visible";
    document.getElementById("btn_cancelar").style.visibility="visible";
    
    "{{path('modificar',{'id':item.id})}}"
}