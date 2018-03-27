<?php

// ERRORS
$lang['_cannot_complete'] = "No se pudo completar la operación.";

$lang['_invalid_token'] = "El token ingresado no es válido.";

$lang['_invalid_format_token'] = "El token ingresado no es del formato válido.";


// PAGINATION

$lang['_no_results'] = "NO SE ENCONTRARON RESULTADOS.";

$lang['_no_result_task'] = "NO TIENE REGISTROS DE TAREO.";







//SETTING

$_controller = 'settings';
$lang[$_controller . '_validate_not_tax'] = "El 'IGV'  no es válido.";

$lang[$_controller . '_validate_empty_serie_factura'] = "Debe completar 'Serie Factura'.";

$lang[$_controller . '_validate_empty_serie_boleta'] = "Debe completar 'Serie Boleta'.";

$lang[$_controller . '_validate_empty_serie_ticket'] = "Debe completar 'Serie Ticket'.";

$lang[$_controller . '_validate_not_valid_price'] = "El  'Formato de Precio' ingresado no es válida.";

$lang[$_controller . '_validate_empty_ticketera'] = "Debe completar el campo 'Serie'.";

$lang[$_controller . '_validate_empty_code'] = "Debe completar 'Serie Comprobante'.";

$lang[$_controller . '_validate_empty_company'] = "Debe completar 'Nombre Empresa'.";

$lang[$_controller . '_validate_empty_manager'] = "Debe completar 'Nombre Gerente'.";

$lang[$_controller . '_validate_empty_address'] = "Debe completar 'Dirección'.";

$lang[$_controller . '_validate_empty_phone'] = "Debe completar 'Teléfono'.";


$lang[$_controller . '_validate_empty_ruc'] = "Debe completar el campo 'RUC'.";

$lang[$_controller . '_validate_length_ruc'] = "El campo 'RUC' debe tener 11 caracteres.";

$lang[$_controller . '_validate_numeric_ruc'] = "El formato ingresado en el campo 'RUC' no es válido.";

$lang[$_controller . '_validate_format_ruc'] = "El número del 'RUC' debe iniciar con 10 y/o 20.";



//USERS

$_controller = 'users';

$lang[$_controller . '_validate_empty_name'] = "Debe completar el campo 'Nombre'.";

$lang[$_controller . '_validate_empty_lastname'] = "Debe completar el campo 'Apellidos'.";

$lang[$_controller . '_validate_empty_dni'] = "Debe completar el campo 'DNI'.";


$lang[$_controller . '_validate_length_dni'] = "El campo 'DNI' debe tener 8 caracteres.";

$lang[$_controller . '_validate_if_exists_dni'] = "El 'DNI' ingresado ya está registrado.";

$lang[$_controller . '_validate_numeric_phone'] = "Debe completar el campo 'Teléfono'.";

$lang[$_controller . '_validate_email'] = "El 'EMAIL'  ingresado no es válido.";

$lang[$_controller . '_validate_empty_user_group'] = "Debe Seleccionar el campo 'Tipo de Usuario'.";

$lang[$_controller . '_validate_empty_username'] = "Debe completar el campo 'Username'.";

$lang[$_controller . '_validate_if_exists_username'] = "El usuario ingresado ya esta registrado.";

$lang[$_controller . '_validate_if_exists_user_admin'] = "Ya está registrado un  'Usuario Administrador en la Base de Datos'.";

$lang[$_controller . '_validate_empty_password'] = "Debe completar el campo 'Password'.";

$lang[$_controller . '_validate_if_exists_user_id'] = "El 'Id del Usuario'  no está registrado en la Base de Datos.";

$lang[$_controller . '_validate_if_exists_user_group_id'] = "El 'Id del Grupo de Usuarios'  no está registrado en la Base de Datos.";

$lang[$_controller . '_validate_if_exist_tasks_id'] = "Esta Tarea no está registrada.";



// contacto
$_controller = 'contacto';

$lang[$_controller . '_validate_if_exists_customer_id'] = "El 'Id del Cliente'  no está registrado en la Base de Datos.";

$lang[$_controller . '_validate_empty_name'] = "Debe completar campo Nombre";

$lang[$_controller . '_validate_empty_lastname'] = "Debe completar campo Apellidos";


$lang[$_controller . '_validate_empty_clinic_history'] = "Debe ingresar historia clinica";

$lang[$_controller . '_validate_empty_address'] = "Debe ingresar la dirección";

$lang[$_controller . '_validate_empty_id_vip'] = "Debe seleccionar si es cliente vip";

$lang[$_controller . '_validate_empty_country_id'] = "Debe seleccionar Pais";

$lang[$_controller . '_validate_empty_city_id'] = "Debe seleccionar Ciudad";

$lang[$_controller . '_validate_empty_postal_code'] = "Debe ingresar codigo postal";


$lang[$_controller . '_validate_empty_phone'] = "Debe completar campo Phone";

$lang[$_controller . '_validate_empty_email'] = "Debe completar campo Email";

 

 



// CATALOGO
$_controller = 'catalogo';

$lang[$_controller . '_validate_if_exists_catalogo_id'] = "El 'Id del Catalogo'  no está registrado en la Base de Datos.";

$lang[$_controller . '_validate_empty_name'] = "Debe completar campo Nombre";
$lang[$_controller . '_validate_empty_name_categoria'] = "Debe completar campo Nombre de Categoría";
$lang[$_controller . '_validate_empty_categorias'] = "Debe agregar al menos una Categoría";

 

// CATEGORIAS
$_controller = 'categoria';

$lang[$_controller . '_validate_empty_name_categoria'] = "Debe completar campo Nombre de Categoría";
$lang[$_controller . '_validate_empty_categorias'] = "Debe agregar al menos una Categoría";



// CATEGORIAS
$_controller = 'subcategoria';

$lang[$_controller . '_validate_empty_name_subcategoria'] = "Debe completar campo Nombre de SubCategoría";
$lang[$_controller . '_validate_empty_subcategorias'] = "Debe agregar al menos una Categoría";




// producto
$_controller = 'producto';

$lang[$_controller . '_validate_if_exists_customer_id'] = "El 'Id del Producto'  no está registrado en la Base de Datos.";

$lang[$_controller . '_validate_empty_name'] = "Debe completar campo Nombre";

$lang[$_controller . '_validate_empty_description'] = "Debe completar campo Descripción";

$lang[$_controller . '_validate_empty_description_detalle'] = "Debe completar campo Descripción del Detalle del Atributo";
 
 

// color
$_controller = 'color';

$lang[$_controller . '_validate_if_exists_color_id'] = "El 'Id del Color'  no está registrado en la Base de Datos.";

$lang[$_controller . '_validate_empty_name'] = "Debe completar campo Nombre";

$lang[$_controller . '_validate_empty_code'] = "Debe completar campo Código";
 