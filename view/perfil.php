<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/tienda.css" />
    <link rel="stylesheet" href="../css/materialize.min.css" />
    <link rel="shortcut icon" href="../image/logo.ico" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Piidelo.com</title>
    <style>
        .dropdown-content {
            height: 101px !important;
        }
    </style>
</head>

<body style="background-color: unset;">
    <div class="container" style="width: 80%;">
        <diw class="row">
            <div class="col s12 center-align">
                <img onclick="inicio();" src="../image/logo.png" width="200px" alt="Piidelo.com" title="Piidelo.com" style="cursor: pointer;" />
            </div>
        </diw>
        <div class="row">
            <div class="col s12">
                <h5 style="margin: unset;">
                    <a class="tooltipped" data-position="bottom" data-tooltip="Inicio" href="#" onclick="inicio();" style="color: #1461a3;"><i class="material-icons">home</i></a>
                    <a class="tooltipped" data-position="bottom" data-tooltip="Cerrar sesión" href="#" onclick="logout();" style="color: #1461a3;"><i class="material-icons">power_settings_new</i></a>
                </h5>
            </div>
        </div>
        <div class="row">
            <div class="col s12" style="font-weight: bold;">
                <ul class="tabs">
                    <li class="tab col s4"><a class="active" href="#datos_personales">Datos personales</a></li>
                    <li class="tab col s4"><a href="#pedidos">Pedidos</a></li>
                    <li class="tab col s4"><a href="#direcciones">Direcciones de env&iacute;o</a></li>
                </ul>
            </div>
            <div id="datos_personales" class="col s12">
                <div class="row">
                    <div class="col s12" style="padding-top: 5vh;">
                        <form>
                            <div class="row">
                                <div class="input-field col s12 m6 l6 xl6">
                                    <input style="width: 90%;" readonly placeholder="Nombres" id="txt_nombres" type="text" class="validate">
                                    <label for="txt_nombres">Nombres</label>
                                </div>
                                <div class="input-field col s12 m6 l6 xl6">
                                    <input style="width: 90%;" readonly placeholder="Apellidos" id="txt_apellidos" type="text" class="validate">
                                    <label for="txt_apellidos">Apellidos</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6 l6 xl6">
                                    <input style="width: 90%;" readonly placeholder="DNI" id="txt_dni" type="text" class="validate">
                                    <label for="txt_dni">DNI</label>
                                </div>
                                <div class="input-field col s12 m6 l6 xl6">
                                    <input style="width: 90%;" readonly placeholder="Tel&eacute;fono" id="txt_telefono" type="text" class="validate">
                                    <label for="txt_telefono">Tel&eacute;fono</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6 l6 xl6">
                                    <input style="width: 90%;" readonly placeholder="Email" id="txt_email" type="text" class="validate">
                                    <label for="txt_email">Email</label>
                                </div>
                                <div class="input-field col s12 m6 l6 xl6">
                                    <input style="width: 90%;" readonly placeholder="Raz&oacute;n Social" id="txt_razon_social" type="text" class="validate">
                                    <label for="txt_razon_social">Raz&oacute;n Social</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6 l6 xl6">
                                    <input style="width: 90%;" readonly placeholder="Direccion" id="txt_direccion" type="text" class="validate">
                                    <label for="txt_direccion">Direcci&oacute;n</label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col s12">
                        <a class="dropdown-trigger btn" href="#" data-target="dropdown1">Actualizar datos</a>
                        <ul id="dropdown1" class="dropdown-content">
                            <li><a class="modal-trigger" href="#modal_datos_personales">Datos personales</a></li>
                            <li><a class="modal-trigger" href="#modal_contraseña">Contraseña</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="pedidos" class="col s12">
                <div class="row">
                    <div class="col s12" style="padding-top: 5vh;">
                        <ul class="collection" id="lista_pedidos" style="border: unset;">

                        </ul>
                    </div>
                </div>
            </div>
            <div id="direcciones" class="col s12">
                <div class="row">
                    <div class="col s12" style="padding-top: 5vh;">
                        <ul class="collection" id="lista_direcciones" style="border: unset;">

                        </ul>
                    </div>
                    <div class="col 12">
                        <a class="btn modal-trigger" id="agregar_direcciones" href="#modal_direcciones">Agregar direcci&oacute;n</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de datos personales -->
    <div id="modal_datos_personales" class="modal" style="width: 80%; height: 75vh; background: #ffffff;">
        <i class="material-icons modal-close hide" id="close_modal_datos_personales">close</i>
        <div class="row" style="border-radius: 30px; height: 100%; margin: unset; ">
            <div class="col s12 center-align" style="height: 100%; border-radius: 0px 30px 30px 0px; background: #ffffff;">
                <h5 style="font-weight: bold; color: #1461a3; margin: 2vh;">Actualiza tu informaci&oacute;n</h5>
                <p style="margin: unset;">Completa la informaci&oacute;n solicitada para actualizar tus datos</p>
                <form class="col s12">
                    <div class="input-field col s12 m6 l6 xl6">
                        <input id="txt_update_nombres" type="text" placeholder="Nombres">
                        <label for="txt_update_nombres">Nombres</label>
                    </div>
                    <div class="input-field col s12 m6 l6 xl6">
                        <input id="txt_update_apellidos" type="text" placeholder="Apellidos">
                        <label for="txt_update_apellidos">Apellidos</label>
                    </div>
                    <div class="input-field col s12 m6 l6 xl6">
                        <input id="txt_update_dni" type="number" placeholder="DNI">
                        <label for="txt_update_dni">DNI</label>
                    </div>
                    <div class="input-field col s12 m6 l6 xl6">
                        <input id="txt_update_telefono" type="number" placeholder="Tel&eacute;fono">
                        <label for="txt_update_telefono">Tel&eacute;fono</label>
                    </div>
                    <div class="input-field col s12 m6 l6 xl6">
                        <input id="txt_update_email" type="email" placeholder="Email">
                        <label for="txt_update_email">Email</label>
                    </div>
                    <div class="input-field col s12 m6 l6 xl6">
                        <input id="txt_update_razon_social" type="text" placeholder="Raz&oacute;n Social">
                        <label for="txt_update_razon_social">Raz&oacute;n Social</label>
                    </div>
                    <div class="input-field col s12 m6 l6 xl6">
                        <input id="txt_update_direccion" type="email" placeholder="Direccion">
                        <label for="txt_update_direccion">Direcci&oacute;n</label>
                    </div>
                </form>
                <div class="row">
                    <div class="col s12" style="text-align: center;">
                        <div class="preloader-wrapper big active hide" style="width: 50px; height: 50px;" id="loader_update">
                            <div class="spinner-layer" style="border-color: #1461a3;">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div>
                                <div class="gap-patch">
                                    <div class="circle"></div>
                                </div>
                                <div class="circle-clipper right">
                                    <div class="circle"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col s12" style="padding: 5px;">
                        <button id="btn_update" onclick="actualizar_informacion();" class="btn" style="width: 145px; background: #ffffff; border: 1px solid #1461a3; color: #1461a3; font-weight: bold;">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de contraseña -->
    <div id="modal_contraseña" class="modal" style="background: #ffffff;">
        <i class="material-icons modal-close hide" id="close_modal_contraseña">close</i>
        <div class="row" style="border-radius: 30px; height: 100%; margin: unset; ">
            <div class="col s12 center-align" style="height: 100%; border-radius: 0px 30px 30px 0px; background: #ffffff;">
                <h5 style="font-weight: bold; color: #1461a3; margin: 2vh;">Actualiza tu informaci&oacute;n</h5>
                <p style="margin: unset;">Completa la informaci&oacute;n solicitada para actualizar tus datos</p>
                <form class="row" style="margin: auto;">
                    <div class="input-field col s12 m12 l4 xl4">
                        <input id="txt_password_old" type="password" autocomplete="on" placeholder="Contraseña actual">
                        <i class="material-icons hide" style="position: absolute; right: 11px; top: 11px; cursor: pointer; color: #1461a3;" id="ver_password_old">remove_red_eye
                        </i>
                        <i class="material-icons" style="position: absolute; right: 11px; top: 11px; cursor: pointer;" id="ocultar_password_old">remove_red_eye
                        </i>
                    </div>
                    <div class="input-field col s12 m12 l4 xl4">
                        <input id="txt_password_new" type="password" autocomplete="on" placeholder="Contraseña nueva">
                        <i class="material-icons hide" style="position: absolute; right: 11px; top: 11px; cursor: pointer; color: #1461a3;" id="ver_password_new">remove_red_eye
                        </i>
                        <i class="material-icons" style="position: absolute; right: 11px; top: 11px; cursor: pointer;" id="ocultar_password_new">remove_red_eye
                        </i>
                    </div>
                    <div class="input-field col s12 m12 l4 xl4">
                        <input id="txt_password_repeat" type="password" autocomplete="on" placeholder="Repetir contraseña">
                        <i class="material-icons hide" style="position: absolute; right: 11px; top: 11px; cursor: pointer; color: #1461a3;" id="ver_password_repeat">remove_red_eye
                        </i>
                        <i class="material-icons" style="position: absolute; right: 11px; top: 11px; cursor: pointer;" id="ocultar_password_repeat">remove_red_eye
                        </i>
                    </div>
                </form>
                <div class="row">
                    <div class="col s12" style="text-align: center;">
                        <div class="preloader-wrapper big active hide" style="width: 50px; height: 50px;" id="loader_contraseña">
                            <div class="spinner-layer" style="border-color: #1461a3;">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div>
                                <div class="gap-patch">
                                    <div class="circle"></div>
                                </div>
                                <div class="circle-clipper right">
                                    <div class="circle"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col s12" style="padding: 5px;">
                        <button id="btn_contraseña" onclick="cambiar_password();" class="btn" style="width: 145px; background: #ffffff; border: 1px solid #1461a3; color: #1461a3; font-weight: bold;">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de detalle de pedido -->
    <div class="modal" id="modal_pedido">
        <i class="material-icons modal-close hide" id="close_modal_pedido">close</i>
        <div class="modal-content">
            <div class="col s12 m12 l5 xl5">
                <div class="row">
                    <div class="col s12">
                        <h5 id="detalle_titulo">Detalle del pedido</h5>
                    </div>
                    <div class="col s12">
                        <ul class="collection" id="pedido_detalle" style="border: unset;">

                        </ul>
                        <ul class="collection" style="border: unset;">
                            <li class="divider"></li>
                            <li class="collection-item" style="border: unset;">
                                <span style="font-weight: bold;">Total</span>
                                <span class="secondary-content" style="color: #000000;"><b>S/<span id="total_detalle"></span></b></span>
                            </li>
                        </ul>
                    </div>

                    <div class="col s12" id="opciones_pedido">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="modal-trigger hide" href="#modal_pedido" id="abrir_detalle"></a>

    <!-- Modal confirmación de eliminación -->
    <div class="modal" id="modal_confirmacion_eliminacion" style="margin-top: 20vh;">
        <div class="modal-content center-align">
            <h5 id="titulo_confirmacion">¿Está seguro de eliminar el pedido N° 1?</h5>
            <p>Esta acci&oacute;n no se puede revertir</p>
            <div class="row">
                <div class="col s12 m6 l6 xl6 center-align" style="padding: 10px;">
                    <button id="btn_cancelar_pedido" class="btn" style="width: 150px; background: #ffffff; border: 1px solid #f44336; color: #f44336; font-weight: bold;">ELIMINAR</button>
                    <div class="preloader-wrapper big active hide" style="width: 50px; height: 50px;" id="loader_cancelar_pedido">
                        <div class="spinner-layer" style="border-color: #1461a3;">
                            <div class="circle-clipper left">
                                <div class="circle"></div>
                            </div>
                            <div class="gap-patch">
                                <div class="circle"></div>
                            </div>
                            <div class="circle-clipper right">
                                <div class="circle"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6 l6 xl6 center-align" style="padding: 10px;">
                    <button id="close_confirmacion" class="btn modal-close" style="width: 150px; background: #ffffff; border: 1px solid #1461a3; color: #1461a3; font-weight: bold;">CANCELAR</button>
                </div>
            </div>
        </div>
    </div>
    <a class="modal-trigger hide" href="#modal_confirmacion_eliminacion" id="abrir_confirmacion_eliminacion"></a>

    <!-- Modal para agregar direcciones -->
    <div id="modal_direcciones" class="modal" style="padding: 10px;">
        <div class="modal-content">
            <i class="material-icons modal-close hide" id="close_modal_direcciones">close</i>
            <div class="row" style="border-radius: 30px; height: 100%; margin: unset; ">
                <div class="col s12 center-align" style="height: 100%; border-radius: 0px 30px 30px 0px; background: #ffffff;">
                    <h5 style="font-weight: bold; color: #1461a3; margin: 2vh;">Crear direcci&oacute;n</h5>
                    <p>Completa la informaci&oacute;n solicitada para crear una nueva direcci&oacute;n, Mueve el marcador en el mapa para obtener la direcci&oacute;n y coordenadas</p>
                    <div class="input-field" style="margin-top: 2rem;">
                        <p><a href="#modal_zonas_cobertura" class="modal-trigger" style="color: #1461a3; font-weight: bold; background: yellow;">Zonas de cobertura</a></p>
                    </div>
                    <form>
                        <div class="input-field col s12 m12 l8 xl8" style=" padding: 0px 5px 0px 0px; margin: unset;">
                            <input id="txt_nombres_new" type="text" placeholder="Nombres">
                        </div>
                        <div class="input-field col s12 m12 l4 xl4" style=" padding: 0px 5px 0px 0px; margin: unset;">
                            <input id="txt_dni_new" type="number" placeholder="DNI">
                        </div>
                        <div class="input-field col s12" style=" padding: 0px 5px 0px 0px; margin: unset;">
                            <input id="txt_direccion_new" type="text" placeholder="Direcci&oacute;n completa">
                        </div>
                        <div class="input-field col s12 m6 l6 xl6" style=" padding: 0px 5px 0px 0px; margin: unset;">
                            <select id="select_departamento_new">
                            </select>
                        </div>
                        <div class="input-field col s12 m6 l6 xl6" style=" padding: 0px 5px 0px 0px; margin: unset;">
                            <select id="select_provincia_new">
                            </select>
                        </div>
                        <div class="input-field col s12 m6 l6 xl6" style=" padding: 0px 5px 0px 0px; margin: unset;">
                            <select id="select_distrito_new">
                            </select>
                        </div>
                        <div class="input-field col s12 m6 l6 xl6" style=" padding: 0px 5px 0px 0px; margin: unset;">
                            <input id="txt_telefono_new" type="number" placeholder="Tel&eacute;fono">
                        </div>
                        <div class="input-field col s12" style=" padding: 0px 5px 0px 0px; margin: unset;">
                            <div id="mapa_new" style="width: 100%; height: 150px; border-radius: 10px"></div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col s12" style="text-align: center;">
                            <div class="preloader-wrapper big active hide" style="width: 50px; height: 50px;" id="loader_direccion">
                                <div class="spinner-layer" style="border-color: #1461a3;">
                                    <div class="circle-clipper left">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="gap-patch">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="circle-clipper right">
                                        <div class="circle"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col s12" style="padding: 15px;">
                            <button id="btn_direccion" onclick="agregar_direccion();" class="btn" style="width: 145px; background: #ffffff; border: 1px solid #1461a3; color: #1461a3; font-weight: bold;">GUARDAR</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de editar direccion -->
    <div class="modal" id="modal_editar_direccion">
        <i class="material-icons modal-close hide" id="cerrar_editar_direccion">close</i>
        <div class="modal-content center-align">
            <h5>Editar direcci&oacute;n</h5>
            <div class="input-field" style="margin-top: 2rem;">
                <p><a href="#modal_zonas_cobertura" class="modal-trigger" style="color: #1461a3; font-weight: bold; background: yellow;">Zonas de cobertura</a></p>
            </div>
            <form>
                <div class="row">
                    <div class="input-field col s12 m6 l6 xl6">
                        <input id="txt_direccion_nombres" type="text" placeholder="Nombres">
                    </div>
                    <div class="input-field col s12 m6 l6 xl6">
                        <input id="txt_direccion_dni" type="text" placeholder="DNI">
                    </div>
                    <div class="input-field col s12">
                        <input id="txt_direccion_direccion" type="text" placeholder="Direcci&oacute;n completa">
                    </div>
                    <div class="input-field col s12 m6 l6 xl6">
                        <select id="select_departamento_add__">
                        </select>
                    </div>
                    <div class="input-field col s12 m6 l6 xl6">
                        <select id="select_provincia_add__">
                        </select>
                    </div>
                    <div class="input-field col s12 m6 l6 xl6">
                        <select id="select_distrito_add__">
                        </select>
                    </div>
                    <div class="input-field col s12 m6 l6 xl6">
                        <input id="txt_direccion_telefono" type="text" placeholder="Tel&eacute;fono">
                    </div>
                </div>
            </form>
            <div class="input-field">
                <div id="mapa" style="width: 100%; height: 150px; border-radius: 10px"></div>
            </div>
            <div class="row">
                <div class="col s12 center-align">
                    <button id="btn_editar_direccion" class="btn" style="margin: 15px; background: #ffffff; border: 1px solid #1461a3; color: #1461a3; font-weight: bold;">Guardar</button>
                </div>
                <div class="col s12" style="text-align: center;">
                    <div class="preloader-wrapper big active hide" style="width: 50px; height: 50px;" id="loader_editar_direccion">
                        <div class="spinner-layer" style="border-color: #1461a3;">
                            <div class="circle-clipper left">
                                <div class="circle"></div>
                            </div>
                            <div class="gap-patch">
                                <div class="circle"></div>
                            </div>
                            <div class="circle-clipper right">
                                <div class="circle"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="modal-trigger hide" href="#modal_editar_direccion" id="abrir_editar_direccion"></a>

    <!-- Modal de vista de zonas de cobertura -->
    <div id="modal_zonas_cobertura" class="modal">
        <h5 style="margin: auto; background: #0c489a; color: #ffffff; font-weight: bold; text-align: center; padding: 15px;">Zonas de cobertura</h5>
        <div class="modal-content">
            <img src="../image/zonas_cobertura.jpg" width="100%" class="materialboxed">
        </div>
    </div>

    <!-- Modal confirmación de eliminación de dirección -->
    <div class="modal" id="modal_confirmacion_eliminacion_direccion" style="margin-top: 20vh;">
        <div class="modal-content center-align">
            <h5 id="titulo_confirmacion_eliminacion_direccion">¿Está seguro de eliminar la direccion?</h5>
            <p>Esta acci&oacute;n no se puede revertir</p>
            <div class="row">
                <div class="col s12 m6 l6 xl6 center-align" style="padding: 10px;">
                    <button id="btn_eliminar_direccion" class="btn" style="width: 150px; background: #ffffff; border: 1px solid #f44336; color: #f44336; font-weight: bold;">ELIMINAR</button>
                    <div class="preloader-wrapper big active hide" style="width: 50px; height: 50px;" id="loader_eliminar_direccion">
                        <div class="spinner-layer" style="border-color: #1461a3;">
                            <div class="circle-clipper left">
                                <div class="circle"></div>
                            </div>
                            <div class="gap-patch">
                                <div class="circle"></div>
                            </div>
                            <div class="circle-clipper right">
                                <div class="circle"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6 l6 xl6 center-align" style="padding: 10px;">
                    <button id="close_eliminar_direccion" class="btn modal-close" style="width: 150px; background: #ffffff; border: 1px solid #1461a3; color: #1461a3; font-weight: bold;">CANCELAR</button>
                </div>
            </div>
        </div>
    </div>
    <a class="modal-trigger hide" href="#modal_confirmacion_eliminacion_direccion" id="abrir_confirmacion_eliminacion_direccion"></a>
</body>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAocjUvXvZ17oARl290-1eQbtuMQvt1WzA"></script>
<script src="../js/tienda.js"></script>
<script src="../libraries/jquery-3.5.1.min.js"></script>
<script src="../libraries/materialize.min.js"></script>
<script src="../libraries/sweetalert2@9.js"></script>
<script src="../libraries/moment.js"></script>
<script>
    /**Activar componentes */
    $(document).ready(function() {
        // $("#select_direcciones").formSelect();
        /**Activar tabs */
        $(".tabs").tabs();
        /**Activar desplegable */
        $(".dropdown-trigger").dropdown();
        /**Activar el modal */
        $(".modal").modal();
        /**Activar tooltip */
        $(".tooltipped").tooltip();
        /**Validar entrada de caracteres */
        /**Limitar el RUC */
        document.getElementById("txt_update_dni").addEventListener("input", function() {
            if (this.value.length > 11)
                this.value = this.value.slice(0, 11);
        });

        /**Limitar el tel&eacute;fono */
        document.getElementById("txt_update_telefono").addEventListener("input", function() {
            if (this.value.length > 9)
                this.value = this.value.slice(0, 9);
        });

        /**Contraseñas */
        /**Ver contraseña */
        $("#ver_password_old").on("click", function() {
            $("#ver_password_old").addClass("hide");
            $("#ocultar_password_old").removeClass("hide");
            $("#txt_password_old").prop("type", "password");
        });

        /**Ocultar contraseña */
        $("#ocultar_password_old").on("click", function() {
            $("#txt_password_old").prop("type", "text")
            $("#ocultar_password_old").addClass("hide");
            $("#ver_password_old").removeClass("hide");
        });
        /**Ver contraseña */
        $("#ver_password_new").on("click", function() {
            $("#ver_password_new").addClass("hide");
            $("#ocultar_password_new").removeClass("hide");
            $("#txt_password_new").prop("type", "password");
        });

        /**Ocultar contraseña */
        $("#ocultar_password_new").on("click", function() {
            $("#txt_password_new").prop("type", "text")
            $("#ocultar_password_new").addClass("hide");
            $("#ver_password_new").removeClass("hide");
        });

        /**Ver contraseña */
        $("#ver_password_repeat").on("click", function() {
            $("#ver_password_repeat").addClass("hide");
            $("#ocultar_password_repeat").removeClass("hide");
            $("#txt_password_repeat").prop("type", "password")
        });

        /**Ocultar contraseña */
        $("#ocultar_password_repeat").on("click", function() {
            $("#txt_password_repeat").prop("type", "text")
            $("#ocultar_password_repeat").addClass("hide");
            $("#ver_password_repeat").removeClass("hide");
        });
        if (!store.getItem("cliente")) {
            inicio();
        }
    });

    llenar_datos_personales();

    function llenar_datos_personales() {
        var cliente = JSON.parse(store.getItem("cliente"));
        $("#txt_nombres").val(cliente.nombres);
        $("#txt_apellidos").val(cliente.apellidos);
        $("#txt_dni").val(cliente.ruc);
        $("#txt_telefono").val(cliente.telefono);
        $("#txt_email").val(cliente.email);
        $("#txt_razon_social").val(cliente.razon_social);
        $("#txt_direccion").val(cliente.direccion);
        $("#txt_update_nombres").val(cliente.nombres);
        $("#txt_update_apellidos").val(cliente.apellidos);
        $("#txt_update_dni").val(cliente.ruc);
        $("#txt_update_telefono").val(cliente.telefono);
        $("#txt_update_email").val(cliente.email);
        $("#txt_update_razon_social").val(cliente.razon_social);
        $("#txt_update_direccion").val(cliente.direccion);
    }

    /**Actualizar información */
    function actualizar_informacion() {
        var nombres = document.getElementById("txt_update_nombres").value;
        var apellidos = document.getElementById("txt_update_apellidos").value;
        var dni = document.getElementById("txt_update_dni").value;
        var telefono = document.getElementById("txt_update_telefono").value;
        var email = document.getElementById("txt_update_email").value;
        var razon_social = document.getElementById("txt_update_razon_social").value;
        var direccion = document.getElementById("txt_update_direccion").value;
        var cliente = JSON.parse(store.getItem("cliente")).codigo;
        var usuario = JSON.parse(store.getItem("cliente")).codigo_usuario;

        if (nombres === "") {
            Swal.fire({
                title: "Piidelo.com",
                icon: "warning",
                text: "Ingresa tu nombre",
                showConfirmButton: false,
                timer: 2000
            });
        } else if (apellidos === "") {
            Swal.fire({
                title: "Piidelo.com",
                icon: "warning",
                text: "Ingresa tus apellidos",
                showConfirmButton: false,
                timer: 2000
            });
        } else if (dni === "") {
            Swal.fire({
                title: "Piidelo.com",
                icon: "warning",
                text: "Ingresa tu DNI",
                showConfirmButton: false,
                timer: 2000
            });
        } else if (telefono === "") {
            Swal.fire({
                title: "Piidelo.com",
                icon: "warning",
                text: "Ingresa tu teléfono",
                showConfirmButton: false,
                timer: 2000
            });
        } else if (email === "") {
            Swal.fire({
                title: "Piidelo.com",
                icon: "warning",
                text: "Ingresa tu email",
                showConfirmButton: false,
                timer: 2000
            });
        } else if (!validar_email(email)) {
            Swal.fire({
                title: "Piidelo.com",
                icon: "warning",
                text: "Ingresa un email válido",
                showConfirmButton: false,
                timer: 2000
            });
        } else {
            $("#btn_update").addClass("hide");
            $("#loader_update").removeClass("hide");
            parametros = {
                metodo: "ActualizarInformacion",
                nombres: nombres,
                apellidos: apellidos,
                dni: dni,
                telefono: telefono,
                email: email,
                razon_social: razon_social,
                direccion: direccion,
                cliente: cliente,
                usuario: usuario
            };
            // console.log(parametros);
            $.ajax({
                url: "../config/perfil/perfil",
                data: parametros,
                type: "post",
                cache: false,
                success: function(resultado) {
                    $("#btn_update").removeClass("hide");
                    $("#loader_update").addClass("hide");
                    var response = JSON.parse(resultado);
                    var codigo = response.codigo;
                    var mensaje = response.mensaje;
                    var cliente = response.cliente;
                    if (codigo === 110) {
                        Swal.fire({
                            title: "Piidelo.com",
                            icon: "error",
                            text: mensaje,
                            showConfirmButton: false,
                            timer: 2000
                        });
                        return;
                    }
                    if (codigo === 111) {
                        Swal.fire({
                            title: "Piidelo.com",
                            icon: "success",
                            text: mensaje,
                            showConfirmButton: false,
                            timer: 2000
                        });
                        store.setItem("cliente", JSON.stringify(cliente));
                        llenar_datos_personales();
                        document.getElementById("close_modal_datos_personales").click();
                        return;
                    }
                }
            });
        }
    }

    /**Actualizar contraseña*/
    function cambiar_password() {
        var password_old = document.getElementById("txt_password_old").value;
        var password_new = document.getElementById("txt_password_new").value;
        var password_repeat = document.getElementById("txt_password_repeat").value;
        var usuario = JSON.parse(store.getItem("cliente")).codigo_usuario;

        if (password_old === "") {
            Swal.fire({
                title: "Piidelo.com",
                icon: "warning",
                text: "Ingresa tu contraseña actual",
                showConfirmButton: false,
                timer: 2000
            });
        } else if (password_new === "") {
            Swal.fire({
                title: "Piidelo.com",
                icon: "warning",
                text: "Ingresa tu nueva contraseña",
                showConfirmButton: false,
                timer: 2000
            });
        } else if (password_repeat != password_new) {
            Swal.fire({
                title: "Piidelo.com",
                icon: "warning",
                text: "Las contraseñas no coinciden",
                showConfirmButton: false,
                timer: 2000
            });
        } else {
            $("#btn_contraseña").addClass("hide");
            $("#loader_contraseña").removeClass("hide");
            parametros = {
                metodo: "ActualizarPassword",
                password_old: password_old,
                password_new: password_new,
                usuario: usuario
            };
            $.ajax({
                url: "../config/perfil/perfil",
                data: parametros,
                type: "post",
                cache: false,
                success: function(resultado) {
                    $("#btn_contraseña").removeClass("hide");
                    $("#loader_contraseña").addClass("hide");
                    var response = JSON.parse(resultado);
                    var codigo = response.codigo;
                    var mensaje = response.mensaje;
                    if (codigo === 110 || codigo === 113) {
                        Swal.fire({
                            title: "Piidelo.com",
                            icon: "error",
                            text: mensaje,
                            showConfirmButton: false,
                            timer: 2000
                        });
                        return;
                    }
                    if (codigo === 109) {
                        Swal.fire({
                            title: "Piidelo.com",
                            icon: "success",
                            text: mensaje,
                            showConfirmButton: false,
                            timer: 2000
                        });
                        document.getElementById("close_modal_contraseña").click();
                        return;
                    }
                }
            });
        }
    }

    /**Listar los pedidos */
    listar_pedidos();

    function listar_pedidos() {
        $("#lista_pedidos").html("");
        var cliente = JSON.parse(store.getItem("cliente")).codigo;
        parametros = {
            metodo: "ListarPedidos",
            codigo: cliente
        };
        $.ajax({
            url: "../config/pedido/pedido",
            data: parametros,
            type: "post",
            cache: false,
            success: function(resultado) {
                var pedidos = JSON.parse(resultado);
                if (pedidos.length > 0) {
                    for (var i = 0; i < pedidos.length; i++) {
                        var fecha_entregado = pedidos[i].fecha_entregado;
                        var tipo = pedidos[i].tipo;
                        if (fecha_entregado === null) {
                            fecha_entregado = "Sin entregar";
                        };
                        var estado = pedidos[i].estado;
                        var color = "";
                        switch (estado) {
                            case "EN PROCESO":
                                // color = "rgb(250, 92, 32, 1)";
                                color = "#fa5c20";
                                break;
                            case "RECIBIDO":
                                // color = "rgb(42, 98, 247, 1)";
                                color = "#2a62f7";
                                break;
                            case "ATENDIDO":
                                // color = "rgb(0, 107, 39, 1)";
                                color = "#4CAF50;"
                                break;
                            case "RECHAZADO":
                                // color = "rgb(255, 51, 51, 1)";
                                color = "#F44336";
                                break;
                            case "ELIMINADO":
                                // color = "rgb(103, 58, 183, 1)";
                                color = "#000000";
                                break;
                        }
                        if (tipo === "Programado") {
                            document.getElementById("lista_pedidos").innerHTML +=
                                `
                                <li class="collection-item avatar" style="border: unset;">
                                    <i class="material-icons circle" style="background: ${color};">local_shipping</i>
                                    <span class="title"><b>Pedido N° ${pedidos[i].codigo}</b></span>
                                    <p>Estado: <span style="color: ${color}; font-weight: bold;">${pedidos[i].estado}</span></p>
                                    <p>Tipo de pedido: ${tipo}</p>
                                    <p>Fecha de solicitud: ${pedidos[i].fecha_solicitud}</p>
                                    <p>Fecha de programación: ${pedidos[i].fecha_programacion}</p>
                                    <p>Fecha de entrega: ${fecha_entregado}</p>
                                    <p>Dirección de entrega: ${pedidos[i].direccion}</p>
                                    <p>Subtotal: S/${pedidos[i].subtotal}</p>
                                    <p>IGV: S/${pedidos[i].igv}</p>
                                    <p>Total: S/${pedidos[i].total}</p>
                                    <a onclick="leer_pedido(${pedidos[i].codigo}, '${estado}')" href="#!" class="secondary-content"><i class="material-icons" style="color: ${color};">remove_red_eye</i></a>
                                </li>
                                <li class="divider"></li>
                            `;
                        } else {
                            document.getElementById("lista_pedidos").innerHTML +=
                                `
                                <li class="collection-item avatar" style="border: unset;">
                                    <i class="material-icons circle" style="background: ${color};">local_shipping</i>
                                    <span class="title"><b>Pedido N° ${pedidos[i].codigo}</b></span>
                                    <p>Estado: <span style="color: ${color}; font-weight: bold;">${pedidos[i].estado}</span></p>
                                    <p>Tipo de pedido: ${tipo}</p>
                                    <p>Fecha de solicitud: ${pedidos[i].fecha_solicitud}</p>
                                    <p>Fecha de entrega: ${fecha_entregado}</p>
                                    <p>Dirección de entrega: ${pedidos[i].direccion}</p>
                                    <p>Subtotal: S/${pedidos[i].subtotal}</p>
                                    <p>IGV: S/${pedidos[i].igv}</p>
                                    <p>Total: S/${pedidos[i].total}</p>
                                    <a onclick="leer_pedido(${pedidos[i].codigo}, '${estado}')" href="#!" class="secondary-content"><i class="material-icons" style="color: ${color};">remove_red_eye</i></a>
                                </li>
                                <li class="divider"></li>
                            `;
                        }

                    }
                } else {
                    document.getElementById("lista_pedidos").innerHTML =
                        `
                            <li class="collection-item" style="border: unset; text-align: center;">
                                <img src="../image/pedidos.png" alt="Piidelo.com" title="Piidelo.com" style="width: 15%; filter: opacity(0.2);"/>
                                <h5>Aún no has realizado ningún pedido</h5>
                            </li>
                        `;
                }
            }
        });
    }
    /**Lerr pedido */
    function leer_pedido(codigo, estado) {
        parametros = {
            metodo: "LeerPedido",
            codigo: codigo
        };
        $.ajax({
            url: "../config/pedido/pedido",
            data: parametros,
            type: "post",
            cache: false,
            success: function(resultado) {
                var pedido = JSON.parse(resultado);
                mostrar_detalle(pedido, codigo, estado);
            }
        });
    }

    function mostrar_detalle(pedido, codigo, estado) {
        $("#pedido_detalle").html("");
        $("#detalle_titulo").html("Detalle del pedido N° " + codigo);
        var total = 0;
        for (var i = 0; i < pedido.length; i++) {
            total += parseFloat(pedido[i].subtotal);
            document.getElementById("pedido_detalle").innerHTML +=
                `
                    <li class="collection-item avatar" style="border: unset;">
                        <img src="${pedido[i].foto}" alt="${pedido[i].producto}" title="${pedido[i].producto}"class="circle">
                        <span style="font-weight: bold;">${pedido[i].producto}</span>
                        <p>Cantidad: ${pedido[i].cantidad}</p>
                        <p class="secondary-content" style="color: #000000;">S/${parseFloat(pedido[i].precio).toFixed(2)}</i></p>
                    </li>
                    <li class="divider"></li>
                `;
        }
        document.getElementById("total_detalle").innerHTML = total.toFixed(2)
        if (estado === "EN PROCESO") {
            document.getElementById("opciones_pedido").innerHTML =
                `
                    <li class="divider"></li>
                    <div class="row" style="padding-top: 20px;">
                        <div class="col s12 m6 l6 xl6 center-align" style="padding: 10px;">
                            <button id="btn_cancelar_pedido_${codigo}" onclick="cancelar_pedido(${codigo});" class="btn" style="width: 150px; background: #ffffff; border: 1px solid #f44336; color: #f44336; font-weight: bold;">CANCELAR</button>
                            <div class="preloader-wrapper big active hide" style="width: 50px; height: 50px;" id="loader_cancelar_pedido_${codigo}">
                                <div class="spinner-layer" style="border-color: #1461a3;">
                                    <div class="circle-clipper left">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="gap-patch">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="circle-clipper right">
                                        <div class="circle"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m6 l6 xl6 center-align" style="padding: 10px;">
                            <button onclick='repetir_pedido(${JSON.stringify(pedido)});' class="btn" style="width: 150px; background: #ffffff; border: 1px solid #1461a3; color: #1461a3; font-weight: bold;">PEDIR</button>
                        </div>
                    </div>
                `;
        } else {
            document.getElementById("opciones_pedido").innerHTML =
                `
                    <li class="divider"></li>
                    <div class="row" style="padding-top: 20px;">
                        <div class="col s12 center-align" style="padding: 10px;">
                            <button onclick='repetir_pedido(${JSON.stringify(pedido)});' class="btn" style="width: 150px; background: #ffffff; border: 1px solid #1461a3; color: #1461a3; font-weight: bold;">PEDIR</button>
                        </div>
                    </div>
                `;
        }
        document.getElementById("abrir_detalle").click();
    }

    /**Función para eliminar el pedido */
    function cancelar_pedido(codigo) {
        document.getElementById("abrir_confirmacion_eliminacion").click();
        document.getElementById("titulo_confirmacion").innerHTML = "¿Está seguro de eliminar el pedido N° " + codigo;
        $("#btn_cancelar_pedido").on("click", function() {
            eliminar_pedido(codigo);
        });
    }

    function eliminar_pedido(codigo) {
        parametros = {
            metodo: "EliminarPedido",
            codigo: codigo
        }
        $.ajax({
            url: "../config/pedido/pedido",
            data: parametros,
            type: "post",
            cache: false,
            success: function(resultado) {
                var response = JSON.parse(resultado);
                var codigo = response.codigo;
                var mensaje = response.mensaje;
                if (codigo === 112) {
                    Swal.fire({
                        title: "Piidelo.com",
                        icon: "error",
                        text: mensaje,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    return;
                } else if (codigo === 111) {
                    Swal.fire({
                        title: "Piidelo.com",
                        icon: "success",
                        text: mensaje,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    listar_pedidos();
                    document.getElementById("close_modal_pedido").click();
                    document.getElementById("close_confirmacion").click();
                    return;
                }
            }
        });
    }

    /**Función de volver a pedir el pedido */
    function repetir_pedido(pedido) {
        for (var i = 0; i < pedido.length; i++) {
            comprar_ahora(pedido[i].codigo_producto, pedido[i].cantidad, pedido[i].stock, "repetir");
        }
        window.location.href = ruta_servidor + "/view/checkout";
    }

    /**Listar las direcciones */
    listar_direcciones();

    function listar_direcciones() {
        $("#lista_direcciones").html("");
        parametros = {
            metodo: "ListarDirecciones",
            codigo: JSON.parse(store.getItem("cliente")).codigo
        }
        $.ajax({
            url: "../config/direccion/direccion",
            data: parametros,
            type: "post",
            cache: false,
            success: function(resultado) {
                var direcciones = JSON.parse(resultado);
                if (direcciones.length > 0) {
                    for (var i = 0; i < direcciones.length; i++) {
                        document.getElementById("lista_direcciones").innerHTML +=
                            `
                            <li class="collection-item avatar" style="border: unset;">
                                <i class="material-icons circle" style="background: #1461a3;">map</i>
                                <span class="title"><b>${direcciones[i].direccion}</b></span>
                                <p>Nombres: ${direcciones[i].nombres}</p>
                                <p>DNI: ${direcciones[i].dni}</p>
                                <p>Teléfono: ${direcciones[i].telefono}</p>
                                <p>Distrito: ${direcciones[i].distrito}</p>
                                <p>Provincia: ${direcciones[i].provincia}</p>
                                <p>Departamento: ${direcciones[i].departamento}</p>
                                <p>Costo de envío: ${direcciones[i].envio}</p>                               
                                <div style="display: inline-flex; height: 40px; width: 120px;" class="secondary-content hide-on-med-and-down">
                                    <button onclick='editar_direccion(${JSON.stringify(direcciones[i])});' style="margin: 5px;" class="less_plus"><i style="color: #4caf50;" class="material-icons" style="cursor: pointer;">edit</i></button>
                                    <button onclick="eliminar_direccion(${direcciones[i].codigo});" style="margin: 5px;" class="less_plus"><i style="color: #f44336;" class="material-icons" style="cursor: pointer;">delete</i></button>
                                </div>
                                <div style="display: inline-flex; height: 40px; width: 120px;" class="hide-on-large-only">
                                    <button onclick='editar_direccion(${JSON.stringify(direcciones[i])});' style="margin: 5px;" class="less_plus"><i style="color: #4caf50;" class="material-icons" style="cursor: pointer;">edit</i></button>
                                    <button onclick="eliminar_direccion(${direcciones[i].codigo});" style="margin: 5px;" class="less_plus"><i style="color: #f44336;" class="material-icons" style="cursor: pointer;">delete</i></button>
                                </div>
                            </li>
                            <li class="divider"></li>
                        `;
                    }
                } else {
                    document.getElementById("lista_direcciones").innerHTML =
                        `
                            <li class="collection-item" style="border: unset; text-align: center;">
                                <img src="../image/mapa.png" alt="Piidelo.com" title="Piidelo.com" style="width: 15%; filter: opacity(0.2);"/>
                                <h5>No tienes direcciones registradas</h5>
                            </li>
                        `;
                }
            }
        });
    }
    /**Función para editar direccion */
    listar_departamentos();

    function editar_direccion(direccion) {
        /**Listamos los departamentos */
        console.log(direccion);
        var codigo = direccion.codigo;
        $("#txt_direccion_nombres").val(direccion.nombres);
        $("#txt_direccion_dni").val(direccion.dni);
        $("#txt_direccion_direccion").val(direccion.direccion);
        $("#txt_direccion_telefono").val(direccion.telefono);
        $("#select_departamento_add__").find("option[value='" + direccion.departamento_id + "']").prop("selected", true).change();
        $("#select_departamento_add__").formSelect();
        $("#select_provincia_add__").find("option[value='" + direccion.provincia_id + "']").prop("selected", true).change();
        $("#select_provincia_add__").formSelect();
        $("#select_distrito_add__").find("option[value='" + direccion.distrito_id + "']").prop("selected", true).change();
        $("#select_distrito_add__").formSelect();
        var latitud = parseFloat(direccion.latitud),
            longitud = parseFloat(direccion.longitud);
        var current_position = {
            lat: parseFloat(direccion.latitud),
            lng: parseFloat(direccion.longitud)
        };
        var mapa = new google.maps.Map(
            document.getElementById("mapa"), {
                zoom: 15,
                center: current_position,
                mapTypeControl: false,
            });
        var marker = new google.maps.Marker({
            position: current_position,
            map: mapa,
            draggable: true
        });
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({
            "latLng": marker.getPosition()
        }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var address = results[0]["formatted_address"];
                $("#txt_direccion_direccion").val(address);
            }
        });
        marker.addListener("dragend", function(event) {
            geocoder.geocode({
                "latLng": marker.getPosition()
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    var address = results[0]["formatted_address"];
                    $("#txt_direccion_direccion").val(address);
                }
            });
            latitud = marker.position.lat();
            longitud = marker.position.lng();
        });
        document.getElementById("abrir_editar_direccion").click();

        $("#btn_editar_direccion").on("click", function() {
            var nombres = $("#txt_direccion_nombres").val();
            var dni = $("#txt_direccion_dni").val();
            var direccion = $("#txt_direccion_direccion").val();
            var distrito = $("#select_distrito_add__").val();
            var telefono = $("#txt_direccion_telefono").val();
            var cliente = JSON.parse(store.getItem("cliente")).codigo;
            if (nombres === "") {
                Swal.fire({
                    title: "Piidelo.com",
                    icon: "warning",
                    text: "Ingresa los nombres",
                    showConfirmButton: false,
                    timer: 2000
                });
            } else if (dni === "") {
                Swal.fire({
                    title: "Piidelo.com",
                    icon: "warning",
                    text: "Ingresa el DNI",
                    showConfirmButton: false,
                    timer: 2000
                });
            } else if (direccion === "") {
                Swal.fire({
                    title: "Piidelo.com",
                    icon: "warning",
                    text: "Ingresa la dirección",
                    showConfirmButton: false,
                    timer: 2000
                });
            } else if (distrito === "") {
                Swal.fire({
                    title: "Piidelo.com",
                    icon: "warning",
                    text: "Selecciona un distrito",
                    showConfirmButton: false,
                    timer: 2000
                });
            } else if (telefono === "") {
                Swal.fire({
                    title: "Piidelo.com",
                    icon: "warning",
                    text: "Ingresa el teléfono",
                    showConfirmButton: false,
                    timer: 2000
                });
            } else if (latitud === 0 || longitud === 0) {
                Swal.fire({
                    title: "Piidelo.com",
                    icon: "warning",
                    text: "Mueve el marcador en el mapa para obtener la latitud y longitud de tu dirección",
                    showConfirmButton: false,
                    timer: 2000
                });
            } else {
                $("#btn_editar_direccion").addClass("hide");
                $("#loader_editar_direccion").removeClass("hide");
                parametros = {
                    metodo: "EditarDireccion",
                    codigo: codigo,
                    nombres: nombres,
                    dni: dni,
                    telefono: telefono,
                    direccion: direccion,
                    latitud: latitud,
                    longitud: longitud,
                    distrito: distrito,
                    cliente: cliente
                };
                $.ajax({
                    url: "../config/direccion/direccion",
                    data: parametros,
                    type: "post",
                    cache: false,
                    success: function(resultado) {
                        $("#btn_editar_direccion").removeClass("hide");
                        $("#loader_editar_direccion").addClass("hide");
                        var response = JSON.parse(resultado);
                        var codigo = response.codigo;
                        var mensaje = response.mensaje;
                        var cliente = response.cliente;
                        if (codigo === 112) {
                            Swal.fire({
                                title: "Piidelo.com",
                                icon: "error",
                                text: mensaje,
                                showConfirmButton: false,
                                timer: 2000
                            });
                            return;
                        }
                        if (codigo === 111) {
                            Swal.fire({
                                title: "Piidelo.com",
                                icon: "success",
                                text: mensaje,
                                showConfirmButton: false,
                                timer: 2000
                            });
                            listar_direcciones();
                            document.getElementById("cerrar_editar_direccion").click();
                            return;
                        }
                    }
                });
            }
        });
    }

    /**Listar departamentos */
    function listar_departamentos() {
        parametros = {
            metodo: "ListarDepartamentos"
        }
        $.ajax({
            url: "../config/dep_pro_dis/listar_dep_pro_dis",
            data: parametros,
            type: "post",
            cache: false,
            success: function(resultado) {
                var departamentos = JSON.parse(resultado);
                departamentos.forEach(departamento => {
                    var select = document.getElementById("select_departamento_add__");
                    var option = document.createElement("option");
                    option.appendChild(document.createTextNode(departamento.nombre));
                    option.value = departamento.codigo;
                    select.appendChild(option);
                });

                $("#select_departamento_add__").formSelect();
                listar_provincias(departamentos[0].codigo);
            }
        });
    }

    /**Listar provincias */
    function listar_provincias(departamento) {
        var select = document.getElementById("select_provincia_add__");
        $("#select_provincia_add__").html("");
        parametros = {
            metodo: "ListarProvincias",
            departamento: departamento
        }
        $.ajax({
            url: "../config/dep_pro_dis/listar_dep_pro_dis",
            data: parametros,
            type: "post",
            cache: false,
            success: function(resultado) {
                var provincias = JSON.parse(resultado);
                provincias.forEach(provincia => {
                    var option = document.createElement("option");
                    option.appendChild(document.createTextNode(provincia.nombre));
                    option.value = provincia.codigo;
                    select.appendChild(option);
                });

                $("#select_provincia_add__").formSelect();
                listar_distritos(provincias[0].codigo);
                // $("#select_distrito_add__").change();
            }
        });
    }

    /**Listar distritos */
    function listar_distritos(provincia) {
        var select = document.getElementById("select_distrito_add__");
        $("#select_distrito_add__").html("");
        parametros = {
            metodo: "ListarDistritos",
            provincia: provincia
        }
        $.ajax({
            url: "../config/dep_pro_dis/listar_dep_pro_dis",
            data: parametros,
            type: "post",
            cache: false,
            success: function(resultado) {
                var distritos = JSON.parse(resultado);
                distritos.forEach(distrito => {
                    var option = document.createElement("option");
                    option.appendChild(document.createTextNode(distrito.nombre));
                    option.value = distrito.codigo;
                    select.appendChild(option);
                });
                $("#select_distrito_add__").formSelect();
            }
        });
    }
    /**Listar provincias */
    $("#select_departamento_add__").on("change", function() {
        listar_provincias($(this).val());
    });

    /**Listar distritos */
    $("#select_provincia_add__").on("change", function() {
        listar_distritos($(this).val());
    });

    /**Función para eliminar dirección */
    function eliminar_direccion(codigo) {
        // console.log(codigo);
        document.getElementById("abrir_confirmacion_eliminacion_direccion").click();
        document.getElementById("titulo_confirmacion_eliminacion_direccion").innerHTML = "¿Está seguro de eliminar el la dirección?";
        $("#btn_eliminar_direccion").on("click", function() {
            borrar_direccion(codigo);
        });
    }

    function borrar_direccion(codigo) {
        parametros = {
            metodo: "EliminarDireccion",
            codigo: codigo
        }
        $.ajax({
            url: "../config/direccion/direccion",
            data: parametros,
            type: "post",
            cache: false,
            success: function(resultado) {
                var response = JSON.parse(resultado);
                var codigo = response.codigo;
                var mensaje = response.mensaje;
                if (codigo === 112) {
                    Swal.fire({
                        title: "Piidelo.com",
                        icon: "error",
                        text: mensaje,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    return;
                } else if (codigo === 111) {
                    Swal.fire({
                        title: "Piidelo.com",
                        icon: "success",
                        text: mensaje,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    listar_direcciones();
                    document.getElementById("close_eliminar_direccion").click();
                    return;
                }
            }
        });
    }

    /**Función para agregar direcciones */
    /**Listar departamentos */
    /**Iniciar el mapa para agregar direcciones */
    var latitud = 0,
        longitud = 0;

    get_current_position();

    function get_current_position() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(success, error, option);
        } else {
            Swal.fire({
                title: "Piidelo.com",
                icon: "warning",
                text: "Su navegador no es compatible con la geolocalización",
                showConfirmButton: false,
                timer: 2000
            });
        }
    }

    function success(position) {
        latitud = position.coords.latitude;
        longitud = position.coords.longitude;
    }

    var option = {
        enableHighAccuracy: true,
        timeout: 5000,
        maximumAge: 0
    }

    function error(error) {
        console.log("ERROR (" + error.code + "): " + error.message);
    }

    $("#agregar_direcciones").on("click", function() {
        /**Limitar entrada de caracteres */
        document.getElementById("txt_telefono_new").addEventListener("input", function() {
            if (this.value.length > 9)
                this.value = this.value.slice(0, 9);
        });
        document.getElementById("txt_dni_new").addEventListener("input", function() {
            if (this.value.length > 8)
                this.value = this.value.slice(0, 8);
        });

        listar_departamentos_new();
        var current_position = {
            lat: latitud,
            lng: longitud
            // lat: -8.0827657,
            // lng: -79.0486612
        };
        console.log(current_position);
        var mapa = new google.maps.Map(
            document.getElementById("mapa_new"), {
                zoom: 15,
                center: current_position,
                mapTypeControl: false,
            });
        var marker = new google.maps.Marker({
            position: current_position,
            map: mapa,
            draggable: true
        });
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({
            "latLng": marker.getPosition()
        }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var address = results[0]["formatted_address"];
                $("#txt_direccion_new").val(address);
            }
        });
        marker.addListener("dragend", function(event) {
            geocoder.geocode({
                "latLng": marker.getPosition()
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    var address = results[0]["formatted_address"];
                    $("#txt_direccion_new").val(address);
                }
            });
            latitud = marker.position.lat();
            longitud = marker.position.lng();
        });
    });

    function listar_departamentos_new() {
        parametros = {
            metodo: "ListarDepartamentos"
        }
        $.ajax({
            url: "../config/dep_pro_dis/listar_dep_pro_dis",
            data: parametros,
            type: "post",
            cache: false,
            success: function(resultado) {
                var departamentos = JSON.parse(resultado);
                departamentos.forEach(departamento => {
                    var select = document.getElementById("select_departamento_new");
                    var option = document.createElement("option");
                    option.appendChild(document.createTextNode(departamento.nombre));
                    option.value = departamento.codigo;
                    select.appendChild(option);
                });

                $("#select_departamento_new").formSelect();
                listar_provincias_new(departamentos[0].codigo);
            }
        });
    }

    /**Listar provincias */
    function listar_provincias_new(departamento) {
        var select = document.getElementById("select_provincia_new");
        $("#select_provincia_new").html("");
        parametros = {
            metodo: "ListarProvincias",
            departamento: departamento
        }
        $.ajax({
            url: "../config/dep_pro_dis/listar_dep_pro_dis",
            data: parametros,
            type: "post",
            cache: false,
            success: function(resultado) {
                var provincias = JSON.parse(resultado);
                provincias.forEach(provincia => {
                    var option = document.createElement("option");
                    option.appendChild(document.createTextNode(provincia.nombre));
                    option.value = provincia.codigo;
                    select.appendChild(option);
                });

                $("#select_provincia_new").formSelect();
                listar_distritos_new(provincias[0].codigo);
            }
        });
    }

    /**Listar distritos */
    function listar_distritos_new(provincia) {
        var select = document.getElementById("select_distrito_new");
        $("#select_distrito_new").html("");
        parametros = {
            metodo: "ListarDistritos",
            provincia: provincia
        }
        $.ajax({
            url: "../config/dep_pro_dis/listar_dep_pro_dis",
            data: parametros,
            type: "post",
            cache: false,
            success: function(resultado) {
                var distritos = JSON.parse(resultado);
                distritos.forEach(distrito => {
                    var option = document.createElement("option");
                    option.appendChild(document.createTextNode(distrito.nombre));
                    option.value = distrito.codigo;
                    select.appendChild(option);
                });
                $("#select_distrito_new").formSelect();
            }
        });
    }
    /**Listar provincias */
    $("#select_departamento_new").on("change", function() {
        listar_provincias_new($(this).val());
    });

    /**Listar distritos */
    $("#select_provincia_new").on("change", function() {
        listar_distritos_new($(this).val());
    });

    /**Agregar direcci&oacute;n */
    function agregar_direccion() {
        var nombres = $("#txt_nombres_new").val();
        var dni = $("#txt_dni_new").val();
        var direccion = $("#txt_direccion_new").val();
        var distrito = $("#select_distrito_new").val();
        var telefono = $("#txt_telefono_new").val();
        var cliente = JSON.parse(store.getItem("cliente")).codigo;
        if (nombres === "") {
            Swal.fire({
                title: "Piidelo.com",
                icon: "warning",
                text: "Ingresa los nombres",
                showConfirmButton: false,
                timer: 2000
            });
        } else if (dni === "") {
            Swal.fire({
                title: "Piidelo.com",
                icon: "warning",
                text: "Ingresa el DNI",
                showConfirmButton: false,
                timer: 2000
            });
        } else if (direccion === "") {
            Swal.fire({
                title: "Piidelo.com",
                icon: "warning",
                text: "Ingresa la dirección",
                showConfirmButton: false,
                timer: 2000
            });
        } else if (distrito === "") {
            Swal.fire({
                title: "Piidelo.com",
                icon: "warning",
                text: "Selecciona un distrito",
                showConfirmButton: false,
                timer: 2000
            });
        } else if (telefono === "") {
            Swal.fire({
                title: "Piidelo.com",
                icon: "warning",
                text: "Ingresa el teléfono",
                showConfirmButton: false,
                timer: 2000
            });
        } else if (latitud === 0 || longitud === 0) {
            Swal.fire({
                title: "Piidelo.com",
                icon: "warning",
                text: "Mueve el marcador en el mapa para obtener la latitud y longitud de tu dirección",
                showConfirmButton: false,
                timer: 2000
            });
        } else {
            $("#btn_direccion").addClass("hide");
            $("#loader_direccion").removeClass("hide");
            parametros = {
                metodo: "AgregarDireccion",
                nombres: nombres,
                dni: dni,
                telefono: telefono,
                direccion: direccion,
                latitud: latitud,
                longitud: longitud,
                distrito: distrito,
                cliente: cliente
            };
            $.ajax({
                url: "../config/direccion/direccion",
                data: parametros,
                type: "post",
                cache: false,
                success: function(resultado) {
                    $("#btn_direccion").removeClass("hide");
                    $("#loader_direccion").addClass("hide");
                    var response = JSON.parse(resultado);
                    var codigo = response.codigo;
                    var mensaje = response.mensaje;
                    var cliente = response.cliente;
                    if (codigo === 108) {
                        Swal.fire({
                            title: "Piidelo.com",
                            icon: "error",
                            text: mensaje,
                            showConfirmButton: false,
                            timer: 2000
                        });
                        return;
                    }
                    if (codigo === 107) {
                        Swal.fire({
                            title: "Piidelo.com",
                            icon: "success",
                            text: mensaje,
                            showConfirmButton: false,
                            timer: 2000
                        });
                        listar_direcciones();
                        document.getElementById("close_modal_direcciones").click();
                        return;
                    }
                }
            });
        }
    }
</script>

</html>