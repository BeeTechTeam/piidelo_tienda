<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/piidelo.css" />
    <link rel="stylesheet" href="../css/materialize.min.css" />
    <link rel="shortcut icon" href="../image/logo.ico" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Piidelo.com</title>
</head>

<body style="background-color: unset;">
    <!-- Div de información  -->
    <div class="container" style="width: 80%;">
        <diw class="row">
            <div class="col s1">
                <img onclick="inicio();" src="../image/logo.png" width="200px" style="cursor: pointer;" />
            </div>
        </diw>
        <diw class="row">
            <div class="col s12 m12 l7 xl7">
                <div class="row">
                    <div class="col s12">
                        <h5>Informaci&oacute;n de contacto</h5>
                        <ul class="collection" style="border: unset;">
                            <li class="collection-item avatar">
                                <img src="../image/avatar.png" alt="" class="circle">
                                <span class="title" id="cliente_nombre"></span>
                                <p id="cliente_email"></p>
                                <p>
                                    <a href="#" onclick="logout();">Cerrar sesi&oacute;n</a>
                                </p>
                            </li>
                        </ul>
                    </div>
                    <div class="col s12">
                        <h5>Direcci&oacute;n de env&iacute;o</h5>
                        <div class="input-field" style="margin-top: 2rem;">
                            <select id="select_direcciones">
                            </select>
                            <label>Direcciones guardadas</label>
                            <p>
                                <button class="btn" style="background: #ffffff; border: 1px solid #1461a3; color: #1461a3; font-weight: bold;">
                                    <a id="abrir_modal_direcciones" href="#modal_direcciones" class="modal-trigger" style="color: #1461a3;">Agregar nueva direcci&oacute;n</a>
                                </button>
                            </p>
                            <p id="zona_no_disponible" class="hide" style="color: #F44336; font-weight: bold;">Su distrito no está dentro de nuestra zona de cobertura, lamentamos no poder atenderlo por ahora. Revisar nuestras zonas de cobertura disponibles, gracias. </p>
                            <p><a href="#modal_zonas_cobertura" class="modal-trigger" style="color: #1461a3; font-weight: bold; background: #f8f300;">Zonas de cobertura</a></p>
                        </div>
                        <form>
                            <div class="input-field col s12 m12 l8 xl8" style=" padding: 0px 5px 0px 0px; margin: unset;">
                                <input readonly id="txt_nombres" type="text" placeholder="Nombres">
                            </div>
                            <div class="input-field col s12 m12 l4 xl4" style=" padding: 0px 5px 0px 0px; margin: unset;">
                                <input readonly id="txt_dni" type="text" placeholder="DNI">
                            </div>
                            <div class="input-field col s12 m12 l8 xl8" style=" padding: 0px 5px 0px 0px; margin: unset;">
                                <input readonly id="txt_direccion" type="text" placeholder="Direcci&oacute;n completa">
                            </div>
                            <div class="input-field col s12 m12 l4 xl4" style=" padding: 0px 5px 0px 0px; margin: unset;">
                                <input readonly id="txt_interior" type="text" placeholder="N&uacute;mero de interior">
                            </div>
                            <div class="input-field col s12 m6 l6 xl6" style=" padding: 0px 5px 0px 0px; margin: unset;">
                                <input readonly id="txt_departamento" type="text" placeholder="Departamento">
                            </div>
                            <div class="input-field col s12 m6 l6 xl6" style=" padding: 0px 5px 0px 0px; margin: unset;">
                                <input readonly id="txt_provincia" type="text" placeholder="Provincia">
                            </div>
                            <div class="input-field col s12 m6 l6 xl6" style=" padding: 0px 5px 0px 0px; margin: unset;">
                                <input readonly id="txt_distrito" type="text" placeholder="Distrito">
                            </div>
                            <div class="input-field col s12 m6 l6 xl6" style=" padding: 0px 5px 0px 0px; margin: unset;">
                                <input readonly id="txt_telefono" type="text" placeholder="Tel&eacute;fono">
                            </div>
                        </form>
                        <div class="input-field">
                            <div id="mapa_view" style="width: 100%; height: 250px; border-radius: 10px"></div>
                        </div>
                        <div class="row">
                            <div class="col s12 center-align">
                                <button onclick="continuar();" id="btn_continuar" class="btn" style="margin: 15px; background: #ffffff; border: 1px solid #1461a3; color: #1461a3; font-weight: bold;">Continuar</button>
                                <a id="abrir_modal_direcciones_mensaje" href="#modal_direcciones" class="modal-trigger hide" style="color: red">Para finalizar tu pedido debes agregar una direcci&oacute;n de entrega</a>
                            </div>
                            <div class="col s12 center-align">
                                <a class="tooltipped" data-position="bottom" data-tooltip="Inicio" href="#" onclick="inicio();" style="color: #1461a3;"><i class="material-icons">home</i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col s12 m12 l5 xl5">
                <div class="row">
                    <div class="col s12">
                        <div class="row">
                            <div class="col s12 m12 l7 xl7">
                                <h5 style="margin: unset;">Detalle del carrito</h5>
                            </div>
                            <div class="col s12 m12 l5 xl5 center-align">
                                <button class="btn" style="background: #1461a3; border: 1px solid #1461a3; color: #ffffff; font-weight: bold; font-size: 10px;" onclick="inicio();">
                                    Seguir comprando
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col s12">
                        <ul class="collection" id="carrito_checkout" style="border: unset;">

                        </ul>
                        <ul class="collection" id="subtotal_checkout" style="border: unset;">

                        </ul>
                        <ul class="collection" id="total_checkout" style="border: unset;">

                        </ul>
                    </div>
                </div>
            </div>
        </diw>
    </div>

    <!-- Modal para agregar direcciones -->
    <div id="modal_direcciones" class="modal" style="padding: 10px;">
        <i class="material-icons modal-close hide" id="close_modal_direcciones">close</i>
        <div class="row" style="border-radius: 30px; height: 100%; margin: unset; ">
            <div class="col s12 center-align" style="height: 100%; border-radius: 0px 30px 30px 0px; background: #ffffff;">
                <h5 style="font-weight: bold; color: #1461a3; margin: 2vh;">Crear direcci&oacute;n</h5>
                <p>Completa la informaci&oacute;n solicitada para crear una nueva direcci&oacute;n, Mueve el marcador en el mapa para obtener la direcci&oacute;n y coordenadas</p>
                <form>
                    <div class="input-field col s12 m12 l8 xl8" style=" padding: 0px 5px 0px 0px; margin: unset;">
                        <input id="txt_nombres_add" type="text" placeholder="Nombres">
                    </div>
                    <div class="input-field col s12 m12 l4 xl4" style=" padding: 0px 5px 0px 0px; margin: unset;">
                        <input id="txt_dni_add" type="number" placeholder="DNI">
                    </div>
                    <div class="input-field col s12 m12 l8 xl8" style=" padding: 0px 5px 0px 0px; margin: unset;">
                        <input id="txt_direccion_add" type="text" placeholder="Direcci&oacute;n completa">
                    </div>
                    <div class="input-field col s12 m12 l4 xl4" style=" padding: 0px 5px 0px 0px; margin: unset;">
                        <input id="txt_interior_add" type="text" placeholder="N&uacute;mero de interior">
                    </div>
                    <div class="input-field col s12 m6 l6 xl6" style=" padding: 0px 5px 0px 0px; margin: unset;">
                        <select id="select_departamento_add">
                        </select>
                    </div>
                    <div class="input-field col s12 m6 l6 xl6" style=" padding: 0px 5px 0px 0px; margin: unset;">
                        <select id="select_provincia_add">
                        </select>
                    </div>
                    <div class="input-field col s12 m6 l6 xl6" style=" padding: 0px 5px 0px 0px; margin: unset;">
                        <select id="select_distrito_add">
                        </select>
                    </div>
                    <div class="input-field col s12 m6 l6 xl6" style=" padding: 0px 5px 0px 0px; margin: unset;">
                        <input id="txt_telefono_add" type="number" placeholder="Tel&eacute;fono">
                    </div>
                    <div class="input-field col s12" style=" padding: 0px 5px 0px 0px; margin: unset;">
                        <div id="mapa_add" style="width: 100%; height: 250px; border-radius: 10px"></div>
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
                    <div class="col s12" style="padding: 5px;">
                        <button id="btn_direccion" onclick="agregar_direccion();" class="btn" style="width: 145px; background: #ffffff; border: 1px solid #1461a3; color: #1461a3; font-weight: bold;">GUARDAR</button>
                        <button style="bottom: 30px; left: 0px; width: 36px; padding: unset;" class="btn" onclick="my_location()"><i class="material-icons">location_searching</i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de vista de zonas de cobertura -->
    <div id="modal_zonas_cobertura" class="modal">
        <h5 style="margin: auto; background: #0c489a; color: #ffffff; font-weight: bold; text-align: center; padding: 15px;">Zonas de cobertura</h5>
        <div class="modal-content">
            <img src="../image/zonas_cobertura.jpg" width="100%" class="materialboxed">
        </div>
    </div>

</body>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAocjUvXvZ17oARl290-1eQbtuMQvt1WzA"></script>
<script src="../js/piidelo.js"></script>
<script src="../libraries/jquery-3.5.1.min.js"></script>
<script src="../libraries/materialize.min.js"></script>
<script src="../libraries/sweetalert2@9.js"></script>
<script>
    /**Activar componentes */
    $(document).ready(function() {
        /**Activar select */
        $("#select_direcciones").formSelect();
        /**Activar modal */
        $(".modal").modal();
        /**Activar tooltip */
        $(".tooltipped").tooltip();
        if (!store.getItem("cliente") || !store.getItem("carrito") || JSON.parse(store.getItem("carrito")).length === 0) {
            inicio();
        }
    });

    /**Lanzar funciones */
    mostrar_carrito_checkout();
    mostrar_datos_del_usuario();
    listar_departamentos();
    get_current_position();

    /**Limitar entrada de caracteres */
    document.getElementById("txt_telefono_add").addEventListener("input", function() {
        if (this.value.length > 9)
            this.value = this.value.slice(0, 9);
    });
    document.getElementById("txt_dni_add").addEventListener("input", function() {
        if (this.value.length > 8)
            this.value = this.value.slice(0, 8);
    });

    /**Listar provincias */
    $("#select_departamento_add").on("change", function() {
        listar_provincias($(this).val());
    });

    /**Listar distritos */
    $("#select_provincia_add").on("change", function() {
        listar_distritos($(this).val());
    });

    var latitud = 0,
        longitud = 0;

    function get_current_position() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(success, error, option);
        } else {
            Swal.fire({
                title: "Piidelo.com",
                icon: "warning",
                text: "Su navegador no es compatible con la geolocalizaci&oacute;n",
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

    /**Iniciar el mapa de agregar direcci&oacute;n */
    var mapa, current_position, marker, geocoder;
    $("#abrir_modal_direcciones").on("click", function() {
        current_position = {
            lat: latitud,
            lng: longitud
        };
        mapa = new google.maps.Map(
            document.getElementById("mapa_add"), {
                zoom: 15,
                center: current_position,
                mapTypeControl: true,
                zoomControl: true
            });
        marker = new google.maps.Marker({
            position: current_position,
            map: mapa,
            draggable: true
        });
        geocoder = new google.maps.Geocoder();
        geocoder.geocode({
            "latLng": marker.getPosition()
        }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var address = results[0]["formatted_address"];
                $("#txt_direccion_add").val(address);
            }
        });
        marker.addListener("dragend", function(event) {
            geocoder.geocode({
                "latLng": marker.getPosition()
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    var address = results[0]["formatted_address"];
                    $("#txt_direccion_add").val(address);
                }
            });
            latitud = marker.position.lat();
            longitud = marker.position.lng();
        });
    });

    /**Función para regresar el mapa a la ubicación actual */
    function my_location() {
        mapa.setCenter(current_position);
        marker.setPosition(current_position);
        geocoder.geocode({
            "latLng": marker.getPosition()
        }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var address = results[0]["formatted_address"];
                $("#txt_direccion_add").val(address);
            }
        });
    }

    /**Listar direcciones */
    listar_direcciones();

    function listar_direcciones() {
        $("#select_direcciones").html("");
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
                direcciones.forEach(direccion => {
                    var direccion_completa =
                        direccion.direccion + " (" +
                        direccion.nombres + ", " +
                        direccion.dni + ")";
                    var select = document.getElementById("select_direcciones");
                    var option = document.createElement("option");
                    option.appendChild(document.createTextNode(direccion_completa));
                    option.value = direccion.codigo;
                    select.appendChild(option);
                });
                $("#select_direcciones").formSelect();
                if (direcciones.length > 0) {
                    leer_direccion(direcciones[0].codigo);
                    store.setItem("direccion_envio", direcciones[0].codigo);
                    $("#abrir_modal_direcciones_mensaje").addClass("hide");
                    $("#btn_continuar").removeClass("hide");
                    return;
                } else {
                    $("#abrir_modal_direcciones_mensaje").removeClass("hide");
                    $("#btn_continuar").addClass("hide");
                }

            }
        });
    }

    /**Agregar direcci&oacute;n */
    function agregar_direccion() {
        var nombres = $("#txt_nombres_add").val();
        var dni = $("#txt_dni_add").val();
        var direccion = $("#txt_direccion_add").val();
        var interior = $("#txt_interior_add").val();
        var distrito = $("#select_distrito_add").val();
        var telefono = $("#txt_telefono_add").val();
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
        } else if (interior === "") {
            Swal.fire({
                title: "Piidelo.com",
                icon: "warning",
                text: "Ingresa el número de interior",
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
                interior: interior,
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

    /**Leer direccion */
    $("#select_direcciones").on("change", function() {
        leer_direccion($("#select_direcciones").val());
    });

    function leer_direccion(codigo) {
        parametros = {
            metodo: "LeerDireccion",
            codigo: codigo
        }
        $.ajax({
            url: "../config/direccion/direccion",
            data: parametros,
            type: "post",
            cache: false,
            success: function(resultado) {
                var direccion = JSON.parse(resultado);
                store.setItem("direccion_envio", direccion.codigo);
                mostrar_envio(direccion.codigo);
                calcular_total_checkout();
                $("#txt_nombres").val(direccion.nombres);
                $("#txt_dni").val(direccion.dni);
                $("#txt_direccion").val(direccion.direccion);
                $("#txt_interior").val(direccion.interior);
                $("#txt_departamento").val(direccion.departamento);
                $("#txt_provincia").val(direccion.provincia);
                $("#txt_distrito").val(direccion.distrito);
                $("#txt_telefono").val(direccion.telefono);
                var current_position = {
                    lat: parseFloat(direccion.latitud),
                    lng: parseFloat(direccion.longitud)
                };
                var mapa = new google.maps.Map(
                    document.getElementById("mapa_view"), {
                        zoom: 17,
                        center: current_position,
                        mapTypeControl: true,
                        zoomControl: true
                    });
                var marker = new google.maps.Marker({
                    position: current_position,
                    map: mapa,
                    draggable: false
                });
                if (direccion.envio === "0.00") {
                    $("#btn_continuar").addClass("hide");
                    Swal.fire({
                        title: "Piidelo.com",
                        icon: "error",
                        text: "Envío no disponible a esta dirección, consulte nuestra zona de cobertura",
                        showConfirmButton: false,
                        timer: 2000
                    });
                    $("#zona_no_disponible").removeClass("hide");
                    return;
                } else {
                    $("#btn_continuar").removeClass("hide");
                    $("#zona_no_disponible").addClass("hide");
                }
            }
        });
    }

    /**Guardamos la direccion de envio en el localstorage */
    function continuar() {
        store.setItem("direccion_envio", $("#select_direcciones").val());
        window.location.href = ruta_servidor + "/view/envio_pago";
    }
</script>

</html>