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
                <img onclick="inicio();" src="../image/logo.png" width="200px" alt="Piidelo.com" title="Piidelo.com" style="cursor: pointer;" />
            </div>
        </diw>
        <diw class="row">
            <div class="col s12 m12 l7 xl7">
                <div class="row">
                    <div class="col s12">
                        <h5>Programa tu pedido</h5>
                        <div class="row">
                            <div class="col s12">
                                <form style="display: inline-flex;" id="radio">
                                    <p style="margin: 10px;">
                                        <label>
                                            <input name="tipo_pedido" type="radio" value="Express" checked />
                                            <span>Env&iacute;o express</span>
                                        </label>
                                    </p>
                                    <p style="margin: 10px;">
                                        <label>
                                            <input name="tipo_pedido" value="Programado" type="radio" />
                                            <span>Env&iacute;o programado</span>
                                        </label>
                                    </p>
                                </form>
                            </div>
                            <div class="col s12" style="padding-left: 55px; padding-right: 55px;">
                                <span id="pedido_express">Tu pedido ser&aacute; entregado dentro las siguientes 48 horas.</span>
                                <div id="pedido_programado" style="text-align: justify;" class="hide">
                                    <p>
                                        Ingresa la fecha y hora en la que deseas recibir tu pedido.
                                        Recuerda que el horario de env&iacute;o es de 8:00am a 7:00pm de lunes a viernes.
                                        Tienes un plazo m&aacute;ximo de 1 mes para programar tu pedido.
                                    </p>
                                    <div class="row">
                                        <div class="col s12 m6 l6 xl6 input-field">
                                            <input type="date" id="fecha_programacion">
                                        </div>
                                        <div class="col s12 m6 l6 xl6 input-field">
                                            <input type="time" id="hora_programacion" min="08:00" max="19:00">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col s12">
                        <h5>Elige tu comprobante de pago</h5>
                        <div class="row">
                            <div class="col s12">
                                <form style="display: inline-flex;" id="radio_comprobante">
                                    <p style="margin: 10px;">
                                        <label>
                                            <input name="tipo_comprobante" type="radio" value="Boleta" checked />
                                            <span>BOLETA</span>
                                        </label>
                                    </p>
                                    <p style="margin: 10px;">
                                        <label>
                                            <input name="tipo_comprobante" value="Factura" type="radio" />
                                            <span>FACTURA</span>
                                        </label>
                                    </p>
                                </form>
                            </div>
                            <div class="col s12" style="padding-left: 55px; padding-right: 55px;">
                                <div id="comprobante_boleta">
                                    <form class="row">
                                        <div class="input-field col s12 m12 l12 x12">
                                            <input id="txt_dni" type="number" placeholder="DNI">
                                        </div>
                                        <div class="input-field col s12 m6 l6 xl6">
                                            <input id="txt_nombres_apellidos" type="text" placeholder="Nombres y apellidos">
                                        </div>
                                        <div class="input-field col s12 m6 l6 xl6">
                                            <input id="txt_direccion_boleta" type="text" placeholder="Dirección">
                                        </div>
                                    </form>
                                </div>
                                <div id="comprobante_factura" class="hide">
                                    <form class="row">
                                        <div class="input-field col s12 m12 l12 x12">
                                            <input id="txt_ruc" type="number" placeholder="RUC">
                                        </div>
                                        <div class="input-field col s12 m6 l6 xl6">
                                            <input id="txt_razon_social" type="text" placeholder="Razón social">
                                        </div>
                                        <div class="input-field col s12 m6 l6 xl6">
                                            <input id="txt_direccion_factura" type="text" placeholder="Dirección">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col s12">
                        <h5>Informaci&oacute;n para el repartidor</h5>
                        <div class="row">
                            <div class="col s12">
                                <form class="col s12">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <textarea id="txt_informacion" class="materialize-textarea"></textarea>
                                            <label for="txt_informacion">Agrega informaci&oacute;n adicional para el repartidor</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col s12">
                        <h5>Informaci&oacute;n de pago</h5>
                        <p>Cuentas bancarias de piidelo.com afiliadas a nombre de: <b>Solange Arce Silvera</b></p>
                        <div class="row" style="border: 2px solid #1461a3;">
                            <div class="col s12 m6 l6 xl6 center-align">
                                <p style="color: #1461a3; font-weight: bold;">BANCO DE CR&Eacute;DITO (BCP)</p>
                                <p style="margin: unset; font-weight: bold;">Cuenta: 194-40034041-0-24</p>
                                <p style="margin: unset; font-weight: bold;">CCI: 002-19414003404102491</p>
                            </div>
                            <div class="col s12 m6 l6 xl6 center-align">
                                <p style="color: #1461a3; font-weight: bold;">BANCO INTERBANK</p>
                                <p style="margin: unset; font-weight: bold;">Cuenta: 270-3107391102</p>
                                <p style="margin: unset; font-weight: bold;">CCI: 003-270-013107391102-69</p>
                            </div>
                            <div class="col s12 m6 l6 xl6 center-align">
                                <p style="color: #1461a3; font-weight: bold;">BANCO CONTINENTAL</p>
                                <p style="margin: unset; font-weight: bold;">Cuenta: 0011-0564-0200294502</p>
                                <p style="margin: unset; font-weight: bold;">CCI: 011-564-000200294502-26</p>
                            </div>
                            <div class="col s12 m6 l6 xl6 center-align">
                                <p style="color: #1461a3; font-weight: bold;">MONEDERO DIGITAL</p>
                                <p style="margin: unset; font-weight: bold;">Celular: 920 545 986</p>
                                <div>
                                    <img src="../image/monedero_digital.png" alt="Piidelo.com" title="Piidelo.com" style="width: 200px;">
                                </div>
                            </div>
                        </div>
                        <p style="text-align: center;"><b>NOTA:</b> Por favor luego de haber realizado el abono, enviar constancia al WhatsApp
                            <a href="https://api.whatsapp.com/send?phone=51920545986&text=Constancia%20de%20pago" target="_blank">
                                920545986
                            </a>
                        </p>
                    </div>
                    <div class="col s12">
                        <div class="row">
                            <div class="col s12 center-align">
                                <button onclick="verificar_datos_de_entrega();" id="btn_verificar" class="btn" style="margin: 15px; background: #ffffff; border: 1px solid #1461a3; color: #1461a3; font-weight: bold;">Finalizar pedido</button>
                            </div>
                            <div class="col s12 center-align">
                                <a href="checkout.php" style="font-weight: bold; color: #1461a3;">Regresar</a>
                            </div>
                            <div class="col s12" style="text-align: center;">
                                <div class="preloader-wrapper big active hide" style="width: 50px; height: 50px;" id="loader_verificar">
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
            </div>

            <div class="col s12 m12 l5 xl5">
                <div class="row">
                    <div class="col s12">
                        <h5>Detalle del carrito</h5>
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
</body>
<script src="../js/piidelo.js"></script>
<script src="../libraries/jquery-3.5.1.min.js"></script>
<script src="../libraries/materialize.min.js"></script>
<script src="../libraries/sweetalert2@9.js"></script>
<script src="../libraries/moment.js"></script>
<script>
    /**Activar componentes */
    $(document).ready(function() {
        /**Activar select */
        $("#select_direcciones").formSelect();
        /**Activar modal */
        $(".modal").modal();
        if (!store.getItem("cliente") || !store.getItem("carrito") || JSON.parse(store.getItem("carrito")).length === 0) {
            inicio();
        }
    });

    /**Lanzar funciones */
    mostrar_envio(store.getItem("direccion_envio"));
    mostrar_carrito_checkout();
    tipo_pedido();
    tipo_comprobante();

    function tipo_pedido() {
        if ($("input[name=tipo_pedido]:checked", "#radio").val() === "Programado") {
            $("#pedido_express").addClass("hide");
            $("#pedido_programado").removeClass("hide");
        } else {
            $("#pedido_express").removeClass("hide");
            $("#pedido_programado").addClass("hide");
        }
    }

    function tipo_comprobante() {
        if ($("input[name=tipo_comprobante]:checked", "#radio_comprobante").val() === "Boleta") {
            $("#comprobante_factura").addClass("hide");
            $("#comprobante_boleta").removeClass("hide");
        } else {
            $("#comprobante_factura").removeClass("hide");
            $("#comprobante_boleta").addClass("hide");
        }
    }

    $(document).ready(function() {
        $("#radio input[name=tipo_pedido]").on("change", function() {
            tipo_pedido();
        });
        $("#radio_comprobante input[name=tipo_comprobante]").on("change", function() {
            tipo_comprobante();
        });
        document.getElementById("txt_dni").addEventListener("input", function() {
            if (this.value.length > 8)
                this.value = this.value.slice(0, 8);
        });
        document.getElementById("txt_ruc").addEventListener("input", function() {
            if (this.value.length > 11)
                this.value = this.value.slice(0, 11);
        });
        var today = new Date();
        var min_dd = today.getDate();
        var min_mm = today.getMonth() + 1;
        var max_mm = today.getMonth() + 2;
        var min_yyyy = today.getFullYear();
        if (min_dd < 10) {
            min_dd = "0" + min_dd
        }
        if (min_mm < 10) {
            min_mm = "0" + min_mm
        }
        if (max_mm < 10) {
            max_mm = "0" + max_mm
        }
        var min = min_yyyy + "-" + min_mm + "-" + min_dd;
        var max = min_yyyy + "-" + max_mm + "-" + min_dd;
        $("#fecha_programacion").attr({
            "max": max,
            "min": min,
        });
    });

    $("#fecha_programacion").change(function() {
        var dia = $(this).val().substr(8);
        var mes = $(this).val().substr(5, 2);
        var year = $(this).val().substr(0, 4);
        if (dia_de_semana(dia, mes, year) === "domingo" || dia_de_semana(dia, mes, year) === "sabado") {
            Swal.fire({
                title: "Piidelo.com",
                icon: "error",
                text: "Los días de entrega de pedidos son de lunes a viernes",
                showConfirmButton: false,
                timer: 2000
            });
            return;
        }
    });

    $("#hora_programacion").change(function() {
        var hora_inicio = moment("08:00 am", "HH:mm a");
        var hora_fin = moment("19:00 pm", "HH:mm a");
        var hora_seleccionada = moment($(this).val(), "HH:mm a");
        if (hora_seleccionada.isBetween(hora_inicio, hora_fin) === false) {
            Swal.fire({
                title: "Piidelo.com",
                icon: "error",
                text: "La hora entrega de pedidos es de 8:00am a 7:00pm",
                showConfirmButton: false,
                timer: 2000
            });
            return;
        };
    });

    /**Verificamos que los datos ingresados cumplan con las reglas del negocio */
    function verificar_datos_de_entrega() {
        if ($("input[name=tipo_pedido]:checked", "#radio").val() === "Programado") {
            if ($("#fecha_programacion").val() === "") {
                Swal.fire({
                    title: "Piidelo.com",
                    icon: "error",
                    text: "Elija la fecha para la entrega de su pedido",
                    showConfirmButton: false,
                    timer: 2000
                });
                return;
            } else if ($("#hora_programacion").val() === "") {
                Swal.fire({
                    title: "Piidelo.com",
                    icon: "error",
                    text: "Elija la hora para la entrega de su pedido",
                    showConfirmButton: false,
                    timer: 2000
                });
                return;
            } else {
                var dia = $("#fecha_programacion").val().substr(8);
                var mes = $("#fecha_programacion").val().substr(5, 2);
                var year = $("#fecha_programacion").val().substr(0, 4);
                if (dia_de_semana(dia, mes, year) === "domingo" || dia_de_semana(dia, mes, year) === "sabado") {
                    Swal.fire({
                        title: "Piidelo.com",
                        icon: "error",
                        text: "Los días de entrega de pedidos son de lunes a viernes",
                        showConfirmButton: false,
                        timer: 2000
                    });
                    return;
                }
                var hora_inicio = moment("08:00 am", "HH:mm a");
                var hora_fin = moment("19:00 pm", "HH:mm a");
                var hora_seleccionada = moment($("#hora_programacion").val(), "HH:mm a");
                if (hora_seleccionada.isBetween(hora_inicio, hora_fin) === false) {
                    Swal.fire({
                        title: "Piidelo.com",
                        icon: "error",
                        text: "La hora entrega de pedidos es de 8:00am a 7:00pm",
                        showConfirmButton: false,
                        timer: 2000
                    });
                    return;
                };
                finalizar_pedido();
            }

        } else {
            finalizar_pedido();
        }
    }

    /**Finalizamos el pedido */
    function finalizar_pedido() {
        $("#btn_verificar").addClass("hide");
        $("#loader_verificar").removeClass("hide");
        var tipo = $("input[name=tipo_pedido]:checked", "#radio").val();
        var fecha, hora, fecha_programacion;
        if (tipo === "Programado") {
            fecha = $("#fecha_programacion").val();
            hora = $("#hora_programacion").val();
            fecha_programacion = fecha + "T" + hora;
        } else {
            fecha_programacion = "";
        }
        var cliente = JSON.parse(store.getItem("cliente")).codigo;
        var direccion = store.getItem("direccion_envio");
        var carrito = JSON.parse(store.getItem("carrito"));
        var total = parseFloat(document.getElementById("total_final").innerText);
        var informacion = $("#txt_informacion").val();
        var documento, razon_social_nombres, direccion_comprobante, tipo_comprobante;
        if ($("input[name=tipo_comprobante]:checked", "#radio_comprobante").val() === "Boleta") {
            tipo_comprobante = "Boleta";
            documento = $("#txt_dni").val();
            razon_social_nombres = $("#txt_nombres_apellidos").val();
            direccion_comprobante = $("#txt_direccion_boleta").val();
        } else {
            tipo_comprobante = "Factura";
            documento = $("#txt_ruc").val();
            razon_social_nombres = $("#txt_razon_social").val();
            direccion_comprobante = $("#txt_direccion_factura").val();
        }
        parametros = {
            metodo: "FinalizarPedido",
            carrito: carrito,
            cliente: cliente,
            direccion: direccion,
            tipo: tipo,
            fecha_programacion: fecha_programacion,
            total: total,
            informacion: informacion,
            tipo_comprobante: tipo_comprobante,
            documento: documento,
            razon_social_nombres: razon_social_nombres,
            direccion_comprobante: direccion_comprobante
        };
        $.ajax({
            url: "../config/pedido/pedido",
            data: parametros,
            type: "post",
            cache: false,
            success: function(response) {
                $("#btn_verificar").removeClass("hide");
                $("#loader_verificar").addClass("hide");
                var resultado = JSON.parse(response);
                console.log(resultado);  
                var codigo = resultado.codigo;
                var mensaje = resultado.mensaje;
                if (codigo === 108) {
                    Swal.fire({
                        title: "Piidelo.com",
                        icon: "error",
                        text: mensaje,
                        showConfirmButton: true,
                        timer: 2000
                    });
                    return;
                }
                if (codigo === 107) {
                    Swal.fire({
                        title: "Piidelo.com",
                        icon: "success",
                        text: mensaje,
                        showConfirmButton: true,
                        timer: 3000
                    });
                    setTimeout(function() {
                        store.removeItem("carrito");
                        store.removeItem("direccion_envio");
                        window.location.href = ruta_servidor + "/landing";
                    }, 3000);
                    return;
                }
            }
        });
    }

    /**Llenamos la información de facturación */
    llenar_informacion_facturacion();
    function llenar_informacion_facturacion() {
        var cliente = JSON.parse(store.getItem("cliente"))
        $("#txt_dni").val(cliente.ruc);
        $("#txt_nombres_apellidos").val(cliente.nombres);
        $("#txt_direccion_boleta").val(cliente.direccion);
        $("#txt_ruc").val(cliente.ruc);
        $("#txt_razon_social").val(cliente.razon_social);
        $("#txt_direccion_factura").val(cliente.direccion);
    }
</script>

</html>