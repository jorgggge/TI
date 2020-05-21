

function Admin_Activa(Id) {
swal({
  title: "Atención",
  text: "Se cambiara el status de este usuario,¿Estas seguro?",
  icon: "warning",
  buttons: ["Cancelar", "Si"],
  dangerMode: true
})
.then((willDelete) => {
  if (willDelete) {
  
    A = $("#btn-"+Id).hasClass("btn-success") ? 0 : 1;

    $.ajax({
      type: "GET",
      url: "/superAdmin/viewcustomersuperadmin/delete/"+Id+"/"+A,
      success: function(response) {
        
      }
    });

    if(A == 0){
       $("#btn-"+Id).removeClass("btn-success");
       $("#btn-"+Id).addClass("btn-warning");  
       $("#mc-"+Id).text("lock");
       $("#s-"+Id).text("Bloquear");

    }else{
       $("#btn-"+Id).addClass("btn-success");
       $("#btn-"+Id).removeClass("btn-warning");
       $("#mc-"+Id).text("work");
       $("#s-"+Id).text("Habilitar");
    } 

  } else {
  }
});
	
}
