


$(document).ready(function () {
  $("#myInput").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

function Admin(Id) {
var para = document.createElement("div");

	$.ajax({
      type: "GET",
      url: "/Datos/Admi/"+Id,
      success: function(response) {
      	var obj = JSON.parse(response);

      	para.setAttribute("id","Tabla_Admin");
      	para.innerHTML += "<table><tr><th>Nombre</th><td>"+obj[0].firstName+"</td></tr>"+
      					  "<tr><th>Usuario</th><td>"+obj[0].username+"</td></tr>"+
      					  "<tr><th>Correo</th><td>"+obj[0].emailuser+"</td></tr>"+
      					  "<tr><th>Empresa</th><td>"+obj[0].name+"</td></tr>"+
      					  "<tr><th>Direccion</th><td>"+obj[0].address+"</td></tr>"+
      					  "<tr><th>Telefono</th><td>"+obj[0].phoneNumber+"</td></tr>"+
      					  "<tr><th>Correo de la Empresa</th><td>"+obj[0].emailcompany+"</td></tr>";

      	para.innerHTML += "</table>";   
	    swal({
			title: 'Datos del Administrador',
			icon: "info",
			content: para
		});

		 $(".swal-button").hover(function(){
		    $(this).css("background-color", "#4962B3");
		    });
	  }
    });
}

function Admin_Activa(Id,Token) {
swal({
  title: "Atecion",
  text: "Se cambiara el status de este usuario, Estas seguro?!",
  icon: "warning",
  buttons: true,
  dangerMode: true
})
.then((willDelete) => {
  if (willDelete) {

  	var ban = $("#A"+Id).hasClass("Si");
 	
 	var Status = "1";
	if(ban) Status = "0";

	$.ajax({
		type: "PUT",
		url: "superAdmin/viewcustomersuperadmin/delete",
		data: { 
			"_token": Token,
			"id" : Id,
			"status" : Status
		},
		success: function(response){

			if(ban){
				$("#A"+Id).removeClass("Si");
				$("#A"+Id).addClass("No");
				$("#A"+Id).attr("src", "imagenes/No.png");
			}else{
				$("#A"+Id).removeClass("No");
				$("#A"+Id).addClass("Si");
				$("#A"+Id).attr("src", "imagenes/Si.png");
			}

			swal("Se a modificado el status de este usuario", {
			  icon: "success",
			});

		}

	});

  } else {
    swal("Okey continua con tu trabajo");
  }
});
	
}

function AddAdmin() {

	var para = document.createElement("div");
  	para.innerHTML = 'Nombre: <br> <input id="swal-input1" class="form-control"><br>'+
  					 'Apellido: <br> <input id="swal-input1" class="form-control"><br>'+
  					 'Usuario: <br> <input id="swal-input1" class="form-control"><br>'+
  					 'Email: <br> <input id="swal-input1" class="form-control"><br>'+
  					 'Telefono: <br> <input id="swal-input1" class="form-control">';


    swal({
		title: 'Datos del Administrador',
		content: para
	}).then((willDelete) => {

		if(willDelete){
			swal(document.getElementById('swal-input1').value);
		}else{

		}

	});
	  
}