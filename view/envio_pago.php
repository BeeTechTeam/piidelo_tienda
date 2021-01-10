<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/tienda.css" />
    <link rel="stylesheet" href="../css/materialize.min.css" />
    <link rel="shortcut icon" href="../image/logo.ico" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>iZi Pedidos</title>
</head>

<body style="background-color: unset;">
    <!-- Div de informaci&oacute;n  -->
    <div class="container" style="width: 80%;">
        <diw class="row">
            <div class="col s1">
                <img onclick="inicio();" src="../image/logo.png" width="70px" alt="iZiPedidos" title="iZiPedidos" style="cursor: pointer; margin-top: 10px;" />
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
                        <h5>Informaci&oacute;n de pago</h5>
                        <div class="row">
                            <div class="col s12 center-align">
                                <button onclick="verificar_datos_de_entrega();" id="btn_verificar" class="btn" style="margin: 15px; background: #ffffff; border: 1px solid #1461a3; color: #1461a3; font-weight: bold;">Finalizar pedido</button>
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
<script src="../js/tienda.js"></script>
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
    mostrar_carrito_checkout();
    tipo_pedido();

    function tipo_pedido() {
        if ($("input[name=tipo_pedido]:checked", "#radio").val() === "Programado") {
            $("#pedido_express").addClass("hide");
            $("#pedido_programado").removeClass("hide");
        } else {
            $("#pedido_express").removeClass("hide");
            $("#pedido_programado").addClass("hide");
        }
    }

    $(document).ready(function() {
        $("#radio input").on("change", function() {
            tipo_pedido();
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
                title: "iZi Pedidos",
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
                title: "iZi Pedidos",
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
                    title: "iZi Pedidos",
                    icon: "error",
                    text: "Elija la fecha para la entrega de su pedido",
                    showConfirmButton: false,
                    timer: 2000
                });
                return;
            } else if ($("#hora_programacion").val() === "") {
                Swal.fire({
                    title: "iZi Pedidos",
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
                        title: "iZi Pedidos",
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
                        title: "iZi Pedidos",
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
        parametros = {
            metodo: "FinalizarPedido",
            carrito: carrito,
            cliente: cliente,
            direccion: direccion,
            tipo: tipo,
            fecha_programacion: fecha_programacion,
            total: total
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
                var codigo = resultado.codigo;
                var mensaje = resultado.mensaje;
                if (codigo === 108) {
                    Swal.fire({
                        title: "iZi Pedidos",
                        icon: "error",
                        text: mensaje,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    return;
                }
                if (codigo === 107) {
                    Swal.fire({
                        title: "iZi Pedidos",
                        icon: "success",
                        text: mensaje,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    store.removeItem("carrito");
                    
                    return;
                }
            }
        });
    }
</script>

</html>