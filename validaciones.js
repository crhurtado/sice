function valida_correo(correo) {
  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(correo)){	
   return (true)
  } else {
   return (false);
  }
 }

function valida_numero(numero){
if (!/^([0-9])*$/.test(numero)){
		return false;
}else{
		return true;
	}
}


function valida_cadena(texto){
	var RegExPattern = "[0-9]";
	 if (texto.match(RegExPattern)){
		return false;
	 }else{
		return true;
	 }
}

function validar_cedula2(){
	var f=document.formulario;
	document.getElementById("ced_error").innerHTML="";
	
	if (f.ced.value==0){
		document.getElementById("ced_error").innerHTML="Debe ingresar un Nro de Cédula";
		f.ced.focus();
		return false
		}
	else{
		if (valida_numero(f.ced.value)==false){
		document.getElementById("ced_error").innerHTML="Debe ingresar un Nro de Cédula válido";
		f.ced.value="";
		f.ced.focus();
		return false;	
	} 
	else{
		if(f.ced.value.length<7){
		document.getElementById("ced_error").innerHTML="Ingrese Nro de Cédula válido";
		f.ced.focus();
		return false
		}
		else {
			f.submit();
			}
	}
}
}

function validar_cedula(){
	var f=document.form;
	document.getElementById("ced_error").innerHTML="";
	
	if (f.ced.value==0){
		document.getElementById("ced_error").innerHTML="Debe ingresar un Nro de Cédula";
		f.ced.focus();
		return false
		}
	else{
		if (valida_numero(f.ced.value)==false){
		document.getElementById("ced_error").innerHTML="Debe ingresar un Nro de Cédula válido";
		f.ced.value="";
		f.ced.focus();
		return false;	
	} 
	else{
		if(f.ced.value.length<7){
		document.getElementById("ced_error").innerHTML="Ingrese Nro de Cédula válido";
		f.ced.focus();
		return false
		}
		else {
			f.submit();
			}
	}
}
}

function validar_sesion(){
		var f=document.form;
		document.getElementById("pass_error").innerHTML="";
		document.getElementById("nick_error").innerHTML="";
		
		if (f.nick.value == 0){
			document.getElementById("nick_error").innerHTML="Ingrese Usuario";
			f.nick.value="";
			f.nick.focus();
			return false;
		}
		else{
			if (f.pass.value == 0){
				document.getElementById("pass_error").innerHTML="Ingrese su Contraseña";
				f.pass.value="";
				f.pass.focus();
				return false;
				}	
			else{
				if (f.pass.value.length < 6){
					document.getElementById("pass_error").innerHTML="Error de contraseña, su clave debe contener al menos 6 caracteres";
					f.pass.value="";
					f.pass.focus();
					return false;
					}
				else{
					f.submit();
					}
				}
		}
	}


function valida_registro_personal(){
	var f=document.form;
	document.getElementById("ced_personal_error").innerHTML="";
	document.getElementById("nomb_personal_error").innerHTML="";
	document.getElementById("apell_personal_error").innerHTML="";
	document.getElementById("tipo_error").innerHTML="";
	
	if (f.ced_personal.value == 0){
		document.getElementById("ced_personal_error").innerHTML="Ingrese un número de cédula";
		f.ced_personal.value="";
		f.ced_personal.focus();
		return false;
	}
	if (f.ced_personal.value.length <7){
		document.getElementById("ced_personal_error").innerHTML="Ingrese un número de cédula válido, de almeno 7 dígitos";
		f.ced_personal.focus();
		return false;
	}
	if (valida_numero(f.ced_personal.value) == false){
		document.getElementById("ced_personal_error").innerHTML="Ingrese solo números";
		f.ced_personal.value="";
		f.ced_personal.focus();
		return false;
	}
	
	
	
	if(f.nomb_personal.value ==0){
		document.getElementById("nomb_personal_error").innerHTML="Ingrese un Nombre";
		f.nomb_personal.value="";
		f.nomb_personal.focus();
		return false;
		}
	if(f.nomb_personal.value.length<3){
		document.getElementById("nomb_personal_error").innerHTML="Ingrese un Nombre válido, de al menos 3 letras";
		f.nomb_personal.focus();
		return false;
		}
	if( valida_cadena(f.nomb_personal.value)==false){
		document.getElementById("nomb_personal_error").innerHTML="Ingrese un Nombre válido, no se permiten números";
		f.nomb_personal.value="";
		f.nomb_personal.focus();
		return false;
		}
	
	
	
	if(f.apell_personal.value==0){
		document.getElementById("apell_personal_error").innerHTML="Ingrese un Apellido";
		f.apell_personal.value="";
		f.apell_personal.focus();
		return false;
		}
	if(f.apell_personal.value.length<3){
		document.getElementById("apell_personal_error").innerHTML="Ingrese un Apellido válido, de al menos 3 letras";
		f.apell_personal.focus();
		return false;
		}
	if( valida_cadena(f.apell_personal.value)==false){
		document.getElementById("apell_personal_error").innerHTML="Ingrese un Apellido válido, no se permiten números";
		f.apell_personal.value="";
		f.apell_personal.focus();
		return false;
		}
		
		
		
	if(f.tipo.value==0){
		document.getElementById("tipo_error").innerHTML="Seleccione el tipo de personal";
		f.tipo.focus();
		return false;
		}
		
	f.submit();
}



function validar_datos_rep(){
	var f=document.form;
	document.getElementById("ced_error").innerHTML="";
	document.getElementById("nombres_error").innerHTML="";
	document.getElementById("apellidos_error").innerHTML="";
	document.getElementById("telf_rep_error").innerHTML="";
	document.getElementById("direccion_rep_error").innerHTML="";
	
	if (f.ced_rep.value == 0){
		document.getElementById("ced_error").innerHTML="Ingrese un número de cédula";
		f.ced_rep.value="";
		f.ced_rep.focus();
		return false;
	}
	if (f.ced_rep.value.length <7){
		document.getElementById("ced_error").innerHTML="Ingrese un número de cédula válido, de almeno 7 dígitos";
		f.ced_rep.focus();
		return false;
	}
	if (valida_numero(f.ced_rep.value) == false){
		document.getElementById("ced_error").innerHTML="Ingrese solo números";
		f.ced_rep.value="";
		f.ced_rep.focus();
		return false;
	}
	
	
	
	if(f.nombres.value ==0){
		document.getElementById("nombres_error").innerHTML="Ingrese un Nombre";
		f.nombres.value="";
		f.nombres.focus();
		return false;
		}
	if(f.nombres.value.length<3){
		document.getElementById("nombres_error").innerHTML="Ingrese un Nombre válido, de al menos 3 letras";
		f.nombres.focus();
		return false;
		}
	if( valida_cadena(f.nombres.value)==false){
		document.getElementById("nombres_error").innerHTML="Ingrese un Nombre válido, no se permiten números";
		f.nombres.value="";
		f.nombres.focus();
		return false;
		}
	
	
	
	if(f.apellidos.value==0){
		document.getElementById("apellidos_error").innerHTML="Ingrese un Apellido";
		f.apellidos.value="";
		f.apellidos.focus();
		return false;
		}
	if(f.apellidos.value.length<3){
		document.getElementById("apellidos_error").innerHTML="Ingrese un Apellido válido, de al menos 3 letras";
		f.apellidos.focus();
		return false;
		}
	if( valida_cadena(f.apellidos.value)==false){
		document.getElementById("apellidos_error").innerHTML="Ingrese un Apellido válido, no se permiten números";
		f.apellidos.value="";
		f.apellidos.focus();
		return false;
		}
		
		
		
	if(f.telf_rep.value==0){
		document.getElementById("telf_rep_error").innerHTML="Ingrese un número telefonico";
		f.telf_rep.focus();
		return false;
		}
	
	if(f.direccion_rep.value==0){
		document.getElementById("direccion_rep_error").innerHTML="Ingrese la dirección del representante";
		f.direccion_rep.focus();
		return false;
		}
		
	f.submit();
}



function validar_registro_usuario(){
	var f=document.form;
	document.getElementById("nick_error").innerHTML="";
	document.getElementById("pass_error").innerHTML="";
	document.getElementById("pass2_error").innerHTML="";
	
	if (f.nick.value == 0){
		document.getElementById("nick_error").innerHTML="Ingrese Usuario";
		f.nick.value="";
		f.nick.focus();
		return false;
	}
	else{
		if (f.pass.value == 0){
			document.getElementById("pass_error").innerHTML="Ingrese su Contraseña";
			f.pass.value="";
			f.pass.focus();
			return false;
			}	
		else{
			if (f.pass.value.length < 6){
				document.getElementById("pass_error").innerHTML="Error de contraseña, su clave debe contener al menos 6 caracteres";
				f.pass.value="";
				f.pass.focus();
				return false;
				}
			else{
					if (f.pass2.value == 0){
					document.getElementById("pass2_error").innerHTML="Confirme su contraseña";
					f.pass2.value="";
					f.pass2.focus();
					return false;
					}	
				else{
					if (f.pass2.value.length < 6){
						document.getElementById("pass2_error").innerHTML="Error de confirmación, su clave debe contener al menos 6 caracteres";
						f.pass2.value="";
						f.pass2.focus();
						return false;
						}
					else{
						
						if(f.pass.value == f.pass2.value){						
						f.submit();
						return true;}
						else{
							document.getElementById("pass2_error").innerHTML="Error de confirmación, no coincide con su contraseña.";
							f.pass2.value="";
							f.pass2.focus();
							return false;
							}
						}
				}
			}
	}	
	
}




function validar_registro_personal(){
	var f=document.form;
	document.getElementById("ced_personal_error").innerHTML="";
	document.getElementById("nomb_personal_error").innerHTML="";
	document.getElementById("apell_personal_error").innerHTML="";
	document.getElementById("tipo_error").innerHTML="";
	
	if (f.ced_personal.value == 0){
		document.getElementById("ced_personal_error").innerHTML="Ingrese un número de cédula";
		f.ced_personal.value="";
		f.ced_personal.focus();
		return false;
	}
	if (f.ced_personal.value.length <7){
		document.getElementById("ced_personal_error").innerHTML="Ingrese un número de cédula válido, de almeno 7 dígitos";
		f.ced_personal.focus();
		return false;
	}
	if (valida_numero(f.ced_personal.value) == false){
		document.getElementById("ced_personal_error").innerHTML="Ingrese solo números";
		f.ced_personal.value="";
		f.ced_personal.focus();
		return false;
	}
	
	
	
	if(f.nomb_personal.value ==0){
		document.getElementById("nomb_personal_error").innerHTML="Ingrese un Nombre";
		f.nomb_personal.value="";
		f.nomb_personal.focus();
		}
	if(f.nomb_personal.value.length<2){
		document.getElementById("nomb_personal_error").innerHTML="Ingrese un Nombre válido, de al menos 3 letras";
		f.nomb_personal.focus();
		}
	if( valida_cadena(f.nomb_personal.value)==false){
		document.getElementById("nomb_personal_error").innerHTML="Ingrese un Nombre válido, no se permiten números";
		f.nomb_personal.value="";
		f.nomb_personal.focus();
		}
	
	
	
	if(f.apell_personal.value ==0){
		document.getElementById("apell_personal_error").innerHTML="Ingrese un Apellido";
		f.apell_personal.value="";
		f.apell_personal.focus();
		}
	if(f.apell_personal.value.length<2){
		document.getElementById("apell_personal_error").innerHTML="Ingrese un Apellido válido, de al menos 3 letras";
		f.apell_personal.focus();
		}
	if( valida_cadena(f.apell_personal.value)==false){
		document.getElementById("apell_personal_error").innerHTML="Ingrese un Apellido válido, no se permiten números";
		f.apell_personal.value="";
		f.apell_personal.focus();
		}
		
		
		
	if(f.tipo.value==0){
		document.getElementById("tipo_error").innerHTML="Seleccione el tipo de personal";
		f.tipo.focus();
		}
}
}