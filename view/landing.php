<!DOCTYPE html>
<html lang="en">
<?php require_once "../config/connection.php"; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../libraries/jquery-3.5.1.min.js">
    </script>
    <script src="../libraries/materialize.min.js"></script>
    <script src="../libraries/sweetalert2@9.js"></script>
    <script src="../js/tienda.js"></script>
    <link rel="stylesheet" href="../styles/tienda.scss" />
    <link rel="stylesheet" href="../styles/materialize.min.css" />
    <link rel="stylesheet" href="../styles/material-design-iconic-font.min.css" />
    <link rel="shortcut icon" href="../image/logo.ico" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../styles/material-design-iconic-font.min.css" />

    <title>iZi Pedidos | Productos</title>
    <script>
        /**Verificar sesión */
        verificar_sesion();
    </script>
</head>

<body style="background-color: unset;">
    <!-- Botón flotante -->
    <a href="https://api.whatsapp.com/send?phone=51924182041&text=Vengo%20de%20la%20web%20iZiPedidos,%20quiero%20saber%20sobre%20" target="_blank">
        <img src="../image/whatsapp.png" style="width: 50px; position: fixed; z-index: 100; bottom: 10px; left: 10px; cursor: pointer;" />
    </a>


    <!-- Buscador productos -->
    <nav id="buscador" class="ocultar_buscador" style="background-color: #ffffff;">
        <div class="nav-wrapper">
            <form>
                <div class="input-field">
                    <input id="txt_buscar" type="search" placeholder="¿Qué necesitas comprar hoy?" required style="font-family: Quicksand;">
                    <label class="label-icon" for="search">
                        <i class="zmdi zmdi-search" style="color: #003c82;"></i>
                    </label>
                    <i class="material-icons" onclick="ocultar_buscador();" style="color: #003c82;">close</i>
                </div>
            </form>
        </div>
    </nav>

    

    <!-- Nav bar large -->
    <nav style="box-shadow: unset; background-color: #ffffff !important; position: fixed; z-index: 10; height: 70px;" id="nav_cambiar_color">
        <div class="nav-wrapper">
            <img onclick="inicio();" src="../image/logo.png" width="70" alt="iZiPedidos" title="iZiPedidos" class="hide-on-med-and-down" style="padding: 15px; cursor: pointer;" />
            <i class="zmdi zmdi-search hide-on-large-only" style="color: #003c82; right: 15px; position: absolute;" onclick="mostrar_buscador();"></i>
            <i class="zmdi zmdi-truck hide-on-large-only" style="color: #003c82; right: 55px; position: absolute;" onclick="mostrar_buscador_fabricante();"></i>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="zmdi zmdi-menu" style="color: #003c82"></i></a>
            <ul class="right hide-on-med-and-down">
                <li><a href="#" onclick="mostrar_buscador();"><i class="zmdi zmdi-search" style="color: #003c82"></i></a></li>
                <li><a href="#" onclick="mostrar_buscador_fabricante();"><i class="zmdi zmdi-truck" style="color: #003c82"></i></a></li>
                <li><a href="#" onclick="mis_pedidos();"><i class="zmdi zmdi-assignment" style="color: #003c82"></i></a></li>
                <li>
                    <a href="#" onclick="mi_carrito();">
                        <i class="zmdi zmdi-shopping-cart" style="color: #003c82">
                            <h5 id="cantidad_carrito" style="background: white; color: #003c82; border-radius: 100px; height: 15px;
                                        width: 15px; margin: unset; padding: unset; text-align: center;
                                        font-family: 'Quicksand', sans-serif !important; font-size: 12px; font-weight: bold;
                                        position: absolute; top: 10px; right: 54px; line-height: 1.2;">0</h5>
                        </i>
                    </a>
                </li>
                <li><a href="#" onclick="logout()"><i class="zmdi zmdi-power" style="color: #003c82"></i></a></li>
            </ul>
        </div>
    </nav>

    <!-- Desplegable small -->
    <ul class="sidenav" id="mobile-demo">
        <li><a href="#" onclick="mis_pedidos();"><i class="zmdi zmdi-assignment" style="color: #003c82;"></i>Mis pesdsdsdidos</a></li>
        <li><a href="#" onclick="mi_carrito();"><i class="zmdi zmdi-shopping-cart" style="color: #003c82;"></i>Carrito de compras</a></li>
        <li><a href="#" onclick="logout()"><i class="zmdi zmdi-power" style="color: #003c82;"></i>Cerrar sesi&oacute;n</a></li>
    </ul>

    <!-- Slider -->
    <div class="custom_slider" id="banners">
    </div>

    <!-- Cards de los productos -->
    <div class="row" style="position: relative; top: 111vh; width: 100%; text-align:center; display: flow-root;" id="lista_productos">
    </div>
    <!-- Footer -->
    <footer class="page-footer" style="position: relative; width: 100%; top: 111vh; font-weight: bold;">
        <div class="row">
            <div class="col l6 m6 s12" style="text-align: center">
                <img src="../image/logo_blanco.png" width="150" alt="iZiPedidos" title="iZiPedidos" />
            </div>
            <div class="col l6 m6 s12" style="text-align: center">
                <p style="letter-spacing: 5px; font-size: 20px; margin: 0 0 15px 0;">CONT&Aacute;CTANOS</p>
                <div id="datos_fabricantes" style="height: 15vh; overflow-y: scroll;">

                </div>
            </div>
        </div>
        <div class="footer-copyright" style="justify-content: center">
            &copy; <?php echo date("Y") ?> Todos los derechos reservados
        </div>
    </footer>

    <!-- Vista rápida -->
    <!-- Modal Structure -->
    <div id="vista_rapida" class="modal">
        <div class="modal-content" style="padding: 40px;">
            <div class="row">
                <div class="col s12">
                    <h4 id="nombre_producto">Nombre del producto</h4>
                </div>
                <div class="col s12">
                    <div class="row">
                        <div class="col s4" style="text-align: center;">
                            <img id="foto" style="width: 125px; height: 225px;" />
                        </div>
                        <div class="col s8">
                            <p style="margin: unset; text-align: left;" id="fabricante">Fabricante</p>
                            <p style="margin: unset; text-align: left;" id="marca">Marca</p>
                            <p style="margin: unset; text-align: left;" id="stock">Stock</p>
                            <p style="margin: unset; text-align: left;" id="precio_compra">Precio de compra</p>
                            <p style="margin: unset; text-align: left;" id="precio_venta">Precio de venta</p>
                            <p style="margin: unset; text-align: left;" id="precio_oferta">Precio de oferta</p>
                            <p style="margin: unset; text-align: left;" id="inicio_oferta">Inicio de oferta</p>
                            <p style="margin: unset; text-align: left;" id="fin_oferta">Fin de oferta</p>
                        </div>
                    </div>
                </div>
                <div class="col s12 right-align">
                    <button class="btn modal-close" style="background: #F44336; box-shadow: unset; border-radius: 30px;">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Comprar ahora -->
    <!-- Modal Structure -->
    <div id="comprar_ahora" class="modal" style="width: 500px; max-width: 500px;">
        <div class="modal-content" id="comprar_ahora_modal">

        </div>
    </div>

</body>

<script>
    /**----------- Landing -----------*/
    /**Leer distribuidor */
    distribuidor_read(store.getItem("usuario_id"));

    // Activar modal
    $(document).ready(function() {
        $(".modal").modal();
    });
    // Hover
    function mostrar_div(id) {
        if (screen.width < 1024) {
            console.log("Pequeña")
        } else
        if (screen.width < 1280) {
            console.log("Mediana")
        } else {
            $("#card_" + id).addClass("hide");
            $("#div_" + id).removeClass("hide");
        }
    }

    function ocultar_div(id) {
        if (screen.width < 1024) {
            console.log("Pequeña")
        } else
        if (screen.width < 1280) {
            console.log("Mediana")
        } else {
            $("#div_" + id).addClass("hide");
            $("#card_" + id).removeClass("hide");
        }
    }

    // Hover button
    function boton_vista_enter(id) {
        document.getElementById("btn_vista_" + id).style.background = "#00b0ff";
        document.getElementById("btn_vista_" + id).style.color = "#04a6ef ";
        document.getElementById("btn_vista_" + id).innerHTML = "<i class='zmdi zmdi-eye' style='color: #ffffff'></i>";
    }

    function boton_vista_leave(id) {
        document.getElementById("btn_vista_" + id).style.background = "#04a6ef ";
        document.getElementById("btn_vista_" + id).style.color = "#00b0ff";
        document.getElementById("btn_vista_" + id).innerHTML = "<span style='color: #ffffff'>Vista rápida</span>";
    }

    // Hover button
    function boton_compra_enter(id) {
        document.getElementById("btn_compra_" + id).style.background = "#00b0ff";
        document.getElementById("btn_compra_" + id).style.color = "#04a6ef ";
        document.getElementById("btn_compra_" + id).innerHTML = "<i class='zmdi zmdi-shopping-cart' style='color: #ffffff'></i>";
    }

    function boton_compra_leave(id) {
        document.getElementById("btn_compra_" + id).style.background = "#04a6ef";
        document.getElementById("btn_compra_" + id).style.color = "#00b0ff";
        document.getElementById("btn_compra_" + id).innerHTML = "<span style='color: #ffffff'>Comprar ahora</span>";
    }

    // // Cambiar color del nav
    // function cambiar_color_nav() {
    //     if (window.scrollY > (window.screen.height - 200)) {
    //         document.getElementById("nav_cambiar_color").style.background = "#ffffff";
    //         document.getElementById("nav_cambiar_color").style.boxShadow = "0 2px 2px 0 rgba(0,0,0,0.14), 0 3px 1px -2px rgba(0,0,0,0.12), 0 1px 5px 0 rgba(0,0,0,0.2)"
    //     } else {
    //         document.getElementById("nav_cambiar_color").style.background = "unset";
    //         document.getElementById("nav_cambiar_color").style.boxShadow = "unset";
    //     }
    // }

    // Ver producto
    function ver_producto(producto) {
        console.log(producto)
        document.getElementById("nombre_producto").innerHTML = producto["pro_nombre"];
        document.getElementById("foto").src = producto["pro_foto"];
        document.getElementById("foto").alt = producto["pro_nombre"];
        document.getElementById("foto").title = producto["pro_nombre"];
        document.getElementById("fabricante").innerHTML = "<b>Fabricante: </b>" + producto["pro_fabricante"];
        document.getElementById("marca").innerHTML = "<b>Marca: </b>" + producto["pro_marca"];
        document.getElementById("stock").innerHTML = "<b>Stock: </b>" + producto["pro_stock"];
        document.getElementById("precio_compra").innerHTML = "<b>Precio de comora: </b> S/" + producto["pro_precio_compra"];
        document.getElementById("precio_venta").innerHTML = "<b>Precio de venta: </b> S/" + producto["pro_precio_venta"];
        if (producto["pro_precio_oferta"] == "") {
            document.getElementById("precio_oferta").style.display = "none";
            document.getElementById("inicio_oferta").style.display = "none";
            document.getElementById("fin_oferta").style.display = "none";
        } else {
            document.getElementById("precio_oferta").innerHTML = "<b>Precio de oferta: </b>S/" + producto["pro_precio_oferta"];
            document.getElementById("inicio_oferta").innerHTML = "<b>Inicio de oferta: </b>" + producto["pro_oferta_inicio"];
            document.getElementById("fin_oferta").innerHTML = "<b>Fin de oferta: </b>" + producto["pro_oferta_fin"];
        }
    }

    // Comprar ahora
    function comprar_ahora_(producto) {
        document.getElementById("comprar_ahora_modal").innerHTML =
            '<div class="row">' +
            '<div class="col s12 center-align">' +
            '<h4 id="nombre_producto">' + producto["pro_nombre"] + '</h4>' +
            '</div>' +
            '<div class="col s5 right-align">' +
            '<button class="btn" style="border-radius: 30px 0px 0px 30px; width: 40px; box-shadow: unset; background: #00b0ff" onclick="less_large(' + producto["pro_id"] + ');"' +
            '<b><i class="zmdi zmdi-minus"></i></b>' +
            '</button>' +
            '</div>' +
            '<div class="col s2 center-align " style="font-size: 24px;">' +
            '<span id="cantidad_large_' + producto["pro_id"] + '">1</span>' +
            '</div>' +
            '<div class="col s5 left-align">' +
            '<button class="btn" style="border-radius: 0px 30px 30px 0px; width: 40px; box-shadow: unset; background: #00b0ff" onclick="plus_large(' + producto["pro_id"] + ', ' + parseInt(producto["pro_stock"]) + ');">' +
            '<b><i class="zmdi zmdi-plus"></i></b>' +
            '</button>' +
            '</div>' +
            '<div class="col s12 center-align">' +
            '<div class="row" style="margin-top: 40px">' +
            '<div class="col s6 center-align">' +
            '<button class="btn modal-close" style="background: #F44336; box-shadow: unset; border-radius: 30px;">Cancelar</button>' +
            '</div>' +
            '<div class="col s6 center-align">' +
            '<button class="btn" style="box-shadow: unset; border-radius: 30px;" onclick="agregar_carrito_large(' + producto["pro_id"] + ');">Añadir <i class="zmdi zmdi-shopping-cart-plus"></i></button>' +
            '</div>' +
            '</div>' +
            // '<p style="color: #003c82 !important; cursor: pointer; margin: 5px; font-size: 24px; font-weight: bold" onclick="agregar_carrito_large(' + producto["pro_id"] + ');">' +

            // '</p>' +
            // ' </div>' +
            // '<div class="col s12 center-align">' +

            '</div>' +
            '</div>';
    }
</script>
<script src="../js/tienda.js"></script>

</html>