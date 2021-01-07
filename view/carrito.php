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
    <title>iZi Pedidos | Carrito de compras</title>
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
                <li><a href="#" onclick="mis_pedidos();"><i class="zmdi zmdi-assignment"></i></a></li>
                <li><a href="#" onclick="inicio();"><i class="zmdi zmdi-home"></i></a></li>
                <li><a href="#" onclick="logout()"><i class="zmdi zmdi-power"></i></a></li>
            </ul>
        </div>
    </nav>

    <!-- Desplegable small -->
    <ul class="sidenav" id="mobile-demo">
        <li><a href="#" onclick="mis_pedidos();"><i class="zmdi zmdi-assignment"></i>Mis pedidos</a></li>
        <li><a href="#" onclick="inicio();"><i class="zmdi zmdi-home"></i>Inicio</a></li>
        <li><a href="#" onclick="logout()"><i class="zmdi zmdi-power"></i>Cerrar sesi&oacute;n</a></li>
    </ul>

    <!-- Resumen carrito -->
    <div class="row">
        <div class="col l4 m12 s12" style="padding: 50px;">
            <div id="resumen" class="resumen" style="height: 55vh !important;">
                <div class="row">
                    <div class="col s12">
                        <h3 style="margin-top: 10px;">RESUMEN</h3>
                    </div>
                    <div class="col s12">
                        <div class="row">
                            <div class="col s9">
                                <h5 style="margin: unset;">SUBTOTAL</h5>
                            </div>
                            <div class="col s3">
                                <h5 style="margin: unset;" id="subtotal"></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="row">
                            <div class="col s9">
                                <h5 style="margin: unset;">IGV</h5>
                            </div>
                            <div class="col s3">
                                <h5 style="margin: unset;" id="igv"></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="row" style="margin-bottom: unset;">
                            <div class="col s12">
                                <div class="divider" style="width: 95%;"></div>
                            </div>
                            <div class="col s9">
                                <h5>TOTAL</h5>
                            </div>
                            <div class="col s3">
                                <h5 id="total"></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 center-align">
                        <div class="row" style="text-align: center;">
                            <div class="preloader-wrapper big active hide" style="width: 50px; height: 50px;" id="loader_finalizar_pedido">
                                <div class="spinner-layer spinner-blue-only">
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
                        <button class="btn" id="btn_finalizar_pedido" onclick="finalizar_pedido();">Realizar pedido</button>
                    </div>
                </div>
            </div>
        </div>
        <div style="background: #999999;width: 1px;height: 73vh;position: absolute;margin-top: 15px; left: 34%" class="hide-on-med-and-down"></div>
        <div class="col l8 m12 s12" style="padding: 50px;">
            <div id="productos" class="productos">
                <div class="row">
                    <div class="col s12">
                        <h4 style="margin: 1%;" id="tu_carrito">TU CARRITO (0)</h4>
                    </div>
                    <div class="col s12" style="height: 65vh; overflow-y: scroll;">
                        <ul class="collection" id="tus_productos" style="border: unset;">

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

    // /**Mostrar carrito */
    mostrar_carrito(store.getItem("usuario_id"));
</script>

</html>