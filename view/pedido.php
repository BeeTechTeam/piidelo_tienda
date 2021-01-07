<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../libraries/jquery-3.5.1.min.js"></script>
    <script src="../libraries/materialize.min.js"></script>
    <script src="../libraries/sweetalert2@9.js"></script>
    <script src="../js/tienda.js"></script>
    <link rel="stylesheet" href="../styles/tienda.scss" />
    <link rel="stylesheet" href="../styles/materialize.min.css" />
    <link rel="stylesheet" href="../styles/material-design-iconic-font.min.css" />
    <link rel="shortcut icon" href="../image/logo.ico" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>iZi Pedidos | Mis pedidos</title>
    <script>
        /**Verificar sesión */
        verificar_sesion();
    </script>
</head>

<body style="background-color: unset;">
    <!-- Nav bar large -->
    <nav>
        <div class="nav-wrapper">
            <img onclick="inicio();" src="../image/logo.png" alt="iZiPedidos" title="iZiPedidos" class="hide-on-med-and-down" style="width: 50px; height: 50px; margin: 7px; cursor: pointer;" />
            <i onclick="inicio();" class="zmdi zmdi-home hide-on-large-only" style="right: 15px; position: absolute;"></i>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="zmdi zmdi-menu"></i></a>
            <ul class="right hide-on-med-and-down">
                <li><a href="#" onclick="inicio();"><i class="zmdi zmdi-home"></i></a></li>
                <li>
                    <a href="#" onclick="mi_carrito();">
                        <i class="zmdi zmdi-shopping-cart">
                            <h5 id="cantidad_carrito" style="background: white; color: #0072ff; border-radius: 100px; height: 15px;
                                        width: 15px; margin: unset; padding: unset; text-align: center;
                                        font-family: 'Quicksand', sans-serif !important; font-size: 12px; font-weight: bold;
                                        position: absolute; top: 10px; right: 54px; line-height: 1.2;">0</h5>
                        </i>
                    </a>
                </li>
                <li><a href="#" onclick="logout()"><i class="zmdi zmdi-power"></i></a></li>
            </ul>
        </div>
    </nav>

    <!-- Desplegable small -->
    <ul class="sidenav" id="mobile-demo">
        <li><a href="#" onclick="inicio();"><i class="zmdi zmdi-home"></i>Inicio</a></li>
        <li><a href="#" onclick="mi_carrito();"><i class="zmdi zmdi-shopping-cart"></i>Carrito de compras</a></li>
        <li><a href="#" onclick="logout()"><i class="zmdi zmdi-power"></i>Cerrar sesi&oacute;n</a></li>
    </ul>

    <!-- Lista de pedidos -->
    <div class="row">
        <div class="col l6 m12 s12" style="padding: 50px;">
            <div id="productos" class="productos">
                <div class="row">
                    <div class="col s12">
                        <h4 style="margin: 1%;" id="cantidad_pedidos">TUS PEDIDOS (0)</h4>
                    </div>
                    <div class="col s12" style="height: 65vh; overflow-y: scroll;">
                        <ul class="collection" id="tus_pedidos" style="border: unset;">

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div style="background: #999999;width: 1px;height: 73vh;position: absolute;margin-top: 15px; left: 51%" class="hide-on-med-and-down"></div>
        <div class="col l6 m12 s12" style="padding: 50px;">
            <div id="resumen" class="resumen">
                <div class="row">
                    <div class="col s12">
                        <h4 style="margin: 1%;" id="detalle">DETALLE DEL PEDIDO N° 0</h4>
                    </div>
                    <div class="col s12">
                        <div class="row" style="margin: unset;">
                            <div class="col s9">
                                <h5 style="margin: unset;">SUBTOTAL</h5>
                            </div>
                            <div class="col s3">
                                <h5 style="margin: unset;" id="subtotal">S/0.00</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="row" style="margin: unset;">
                            <div class="col s9">
                                <h5 style="margin: unset;">IGV</h5>
                            </div>
                            <div class="col s3">
                                <h5 style="margin: unset;" id="igv">S/0.00</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="row" style="margin: unset;">
                            <div class="col s12">
                                <div class="divider" style="width: 95%;"></div>
                            </div>
                            <div class="col s9">
                                <h5>TOTAL</h5>
                            </div>
                            <div class="col s3">
                                <h5 id="total">S/0.00</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col s12" style="height: 45vh; overflow-y: scroll;">
                        <ul class="collection" id="pedido_detalle" style="border: unset; font-family: 'Quicksand', sans-serif;">
                            <li class="collection-item avatar" style="background: unset; padding: unset;">
                                <div class="row" style="text-align: center; font-weight: bold;">
                                    <div class="col s12">
                                        <img src="../image/lupa.png" width="30px" alt="Carrito vacío" title="Carrito vacío" style="opacity: 0.5;" />
                                    </div>
                                    <div class="col s12">Selecciona un pedido para ver su detalle</div>
                                    <div class="col s12">
                                        <p style="color: #0072ff; cursor: pointer" onClick="inicio();">Ir a comprar
                                            <i class="zmdi zmdi-shopping-cart-plus"></i>
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer -->
    <footer class='page-footer' style='position: fixed; width: 100%; bottom: 0'>
        <div class='footer-copyright' style='justify-content: center'>
            &copy; <?php echo date("Y") ?> Todos los derechos reservados
        </div>
    </footer>
</body>
<script>
    /**Para que funcione el desplegable */
    $(document).ready(function() {
        $(".sidenav").sidenav();
    });

    /**Cantidad de productos en el carrito */
    var carrito = JSON.parse(store.getItem("carrito_" + store.getItem("usuario_id"))),
        distribuidor = 0,
        pedidos = [];
    document.getElementById("cantidad_carrito").innerText = carrito.length;

    /**Leer pedidos */
    leer_pedidos(store.getItem("usuario_id"));

    function leer_pedidos(usuario) {
        /**Leemos al distribuidor */
        parametros = {
            metodo: "DistribuidorRead",
            usuario: usuario
        };
        $.ajax({
            url: rutcon + "distribuidor/distribuidor",
            data: parametros,
            type: "post",
            cache: false,
            success: function(resultado) {
                distribuidor = resultado;
                mostrar_pedidos(distribuidor);
            }
        });

        function mostrar_pedidos(distribuidor) {
            parametros = {
                metodo: "LeerPedidos",
                distribuidor: distribuidor
            };
            $.ajax({
                url: rutcon + "pedido/pedido",
                data: parametros,
                type: "post",
                cache: false,
                success: function(resultado) {
                    pedidos = JSON.parse(resultado);
                    var tus_pedidos = document.getElementById("tus_pedidos");
                    tus_pedidos.innerHTML = "";
                    if (pedidos.length > 0) {
                        document.getElementById("cantidad_pedidos").innerText = "TUS PEDIDOS (" + pedidos.length + ")";
                        for (var i = 0; i < pedidos.length; i++) {
                            if (pedidos[i]["estado"] === "ELIMINADO POR DISTRIBUIDOR") {
                                tus_pedidos.innerHTML +=
                                    "<li class='collection-item avatar' id='" + pedidos[i]["codigo"] + "' style='margin: 1%; padding-left: 20px;'>" +
                                    "<span class='title' style='font-weight: bold; color: #0072ff;'> Pedido N°: " + pedidos[i]["codigo"] + "</span>" +
                                    "<p>" +
                                    "Total: S/" + pedidos[i]["total"] + "<br>" +
                                    "Fecha: " + pedidos[i]["fecha"] + "<br>" +
                                    "Estado: " + pedidos[i]["estado"] +
                                    "</p>" +
                                    "<a href='#!' class='secondary-content'>" +
                                    "<div class='row' style='position: relative; top: 2.5vh'>" +
                                    "<div class='col s6'>" +
                                    "<i class='zmdi zmdi-eye' style='color: #a6ce3a; font-size: 25px;' onclick='ver_pedido(" + pedidos[i]["codigo"] + ")'></i>" +
                                    "</div>" +
                                    "<div class='col s6'>" +
                                    "<i class='zmdi zmdi-delete' style='color: #f6821f; font-size: 25px;'></i>" +
                                    "</div>" +
                                    "</div>" +
                                    "</a>" +
                                    "</li>";
                            } else {
                                tus_pedidos.innerHTML +=
                                    "<li class='collection-item avatar' id='" + pedidos[i]["codigo"] + "' style='margin: 1%; padding-left: 20px;'>" +
                                    "<span class='title' style='font-weight: bold; color: #0072ff;'> Pedido N°: " + pedidos[i]["codigo"] + "</span>" +
                                    "<p>" +
                                    "Total: S/" + pedidos[i]["total"] + "<br>" +
                                    "Fecha: " + pedidos[i]["fecha"] + "<br>" +
                                    "Estado: " + pedidos[i]["estado"] +
                                    "</p>" +
                                    "<a href='#!' class='secondary-content'>" +
                                    "<div class='row' style='position: relative; top: 2.5vh'>" +
                                    "<div class='col s6'>" +
                                    "<i class='zmdi zmdi-eye' style='color: #a6ce3a; font-size: 25px;' onclick='ver_pedido(" + pedidos[i]["codigo"] + ")' ></i>" +
                                    "</div>" +
                                    "<div class='col s6'>" +
                                    "<i class='zmdi zmdi-delete' style='color: #f6821f; font-size: 25px;' onclick='eliminar_pedido(" + pedidos[i]["codigo"] + ")' ></i>" +
                                    "</div>" +
                                    "</div>" +
                                    "</a>" +
                                    "</li>";
                            }
                        }
                    } else {
                        document.getElementById("cantidad_pedidos").innerText = "TUS PEDIDOS (" + pedidos.length + ")";
                        tus_pedidos.innerHTML =
                            "<li class='collection-item avatar'>" +
                            "<div class='row' style='text-align: center; font-weight: bold;'>" +
                            "<div class='col s12'>" +
                            "<img src='../image/carrito_vacio.png' width='25%' alt='Carrito vacío' title='Carrito vacío' style='opacity: 0.5;' />" +
                            "</div>" +
                            "<div class='col s12'>No tienes pedidos</div>" +
                            "<div class='col s12'>" +
                            "<p style='color: #0072ff; cursor: pointer' onClick='inicio();'>Ir a comprar" +
                            "<i class='zmdi zmdi-shopping-cart-plus'></i>" +
                            "</p>" +
                            "</div>" +
                            "</div>" +
                            "</li>";
                    }
                }
            });
        }
    }

    /**Leer detalle del pedido */
    function ver_pedido(pedido) {
        for (var i = 0; i < pedidos.length; i++) {
            if (pedidos[i]["codigo"] == pedido) {
                document.getElementById(pedido).style.background = "#9e9e9e69";
            } else {
                document.getElementById(pedidos[i]["codigo"]).style.background = "#ffffff";
            }
        }
        parametros = {
            metodo: "LeerPedido",
            pedido: pedido
        };
        $.ajax({
            url: rutcon + "pedido/pedido",
            data: parametros,
            type: "post",
            cache: false,
            success: function(resultado) {
                var grupo = JSON.parse(resultado);
                var pedido_detalle = document.getElementById("pedido_detalle");
                var total = grupo[0]["total"];
                var subtotal = total / 1.18;
                var igv = total - subtotal;
                document.getElementById("total").innerHTML = "S/" + parseFloat(total).toFixed(2);
                document.getElementById("subtotal").innerHTML = "S/" + parseFloat(subtotal).toFixed(2);
                document.getElementById("igv").innerHTML = "S/" + parseFloat(igv).toFixed(2);
                pedido_detalle.innerHTML = "";
                document.getElementById("detalle").innerHTML = "DETALLE DEL PEDIDO N° " + pedido;
                for (var i = 0; i < grupo.length; i++) {
                    pedido_detalle.innerHTML +=
                        "<li class='collection-item avatar' id='" + grupo[i]["codigo"] + "' style='margin: 1%; height: 20vh;'>" +
                        "<img src='" + grupo[i]["foto"] + "' class='circle' alt='" + grupo[i]["producto"] + "' title='" + grupo[i]["producto"] + "' style='height: 15vh; width: 50px; border-radius: unset;'>" +
                        "<span class='title' style='font-weight: bold; color: #0072ff;'>" + grupo[i]["producto"] + "</span>" +
                        "<p style='font-weight: bold; color: black;'>" +
                        "Precio: S/" + grupo[i]["precio"] + " | Cantidad: " + grupo[i]["cantidad"] + " <br>" +
                        "Marca: " + grupo[i]["marca"] + "<br>" +
                        "Fabricante: " + grupo[i]["fabricante"] +
                        "</p>" +
                        "</li>";
                }
            }
        });
    }

    /**Eliminar pedido */
    function eliminar_pedido(pedido) {
        Swal.fire({
            title: "iZi Pedidos",
            text: "¿Está seguro de eliminar su pedido?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#f6821f",
            cancelButtonColor: "#a6ce3a",
            confirmButtonText: "SI",
            cancelButtonText: "NO"
        }).then((result) => {
            if (result.value) {
                parametros = {
                    metodo: "EliminarPedido",
                    pedido: pedido
                };
                $.ajax({
                    url: rutcon + "pedido/pedido",
                    data: parametros,
                    type: "post",
                    cache: false,
                    success: function(resultado) {
                        if (resultado.match("ERROR")) {
                            Swal.fire({
                                title: "iZi Pedidos",
                                icon: "success",
                                text: resultado,
                                showConfirmButton: false,
                                timer: 1000
                            });
                        } else {
                            Swal.fire({
                                title: "iZi Pedidos",
                                icon: "success",
                                text: "Pedido eliminado",
                                showConfirmButton: false,
                                timer: 1000
                            });
                            leer_pedidos(store.getItem("usuario_id"));
                        }
                    }
                });
            }
        });
    }
</script>

</html>