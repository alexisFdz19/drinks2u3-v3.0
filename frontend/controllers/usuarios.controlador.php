<?php

class ControladorUsuarios{

	/*=============================================
	= Registro de usuarios =
	=============================================*/

	public function ctrRegistroUsuario(){

		if (isset($_POST["regUsuario"])){
			
			if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]*$/', $_POST["regUsuario"]) &&
				preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["regEmail"]) &&
				preg_match('/^[0-9]*$/', $_POST["regTelefono"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["regPassword"])){

				$encriptar = crypt($_POST["regPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datos = array("nombre" => $_POST["regUsuario"],
						    	"password" => $encriptar,
						    	"email" => $_POST["regEmail"],
						    	"telefono" => $_POST["regTelefono"],
						    	"modo" => "directo",
						    	"verificacion" => 1);

				$tabla = "usuarios";

				$respuesta = ModeloUsuarios::mdlRegistroUsuario($tabla, $datos);

				if($respuesta == "ok"){
					
					echo '<script> 

						swal({
							  title: "¡Registro exitoso!",
							  text: "Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico '.$_POST["regEmail"].' para continuar con la verificación de su cuenta",
							  type:"success",
							  confirmButtonText: "Cerrar",
							  closeOnConfirm: false
							},

							function(isConfirm){

								if(isConfirm){
									history.back();
								}
						});

					</script>';

				}
				

			}else{

				echo '<script> 

						swal({
							  title: "¡ERROR!",
							  text: "Error al registrar el usuario, no se permiten carácteres especiales",
							  type:"error",
							  confirmButtonText: "Cerrar",
							  closeOnConfirm: false
							},

							function(isConfirm){

								if(isConfirm){
									history.back();
								}
						});

				</script>';
			}

		}

	}

}