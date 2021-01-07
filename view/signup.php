<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/tienda.css" />
    <link rel="stylesheet" href="../css/splide.min.css" />
    <link rel="stylesheet" href="../css/materialize.min.css" />
    <link rel="shortcut icon" href="../image/logo.ico" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>iZi Pedidos</title>
</head>

<body style="background-color: unset;">
    <div class="container card-signup">
        <div class="row" style="border-radius: 30px; height: 100%;">
            <div class="col s12 center-align" style="height: 100%; border-radius: 0px 30px 30px 0px;">
                <h3 style="font-weight: bold; color: #1461a3; margin: 2vh;">Crear cuenta</h3>
                <p>Completa la informaci&oacute;n solicitada para crear tu cuenta</p>
                <!-- <div style="width: 90%; margin: auto;"> -->
                <form class="col s12">
                    <div class="input-field col s12 m6 l6 xl6">
                        <i class="material-icons prefix" style="color: #1461a3;">business_center</i>
                        <input id="txt_ruc" type="number" placeholder="RUC o DNI">
                    </div>
                    <div class="input-field col s12 m6 l6 xl6">
                        <i class="material-icons prefix" style="color: #1461a3;">business</i>
                        <input id="txt_razon_social" type="text" placeholder="Razón Social o Nombres">
                    </div>
                    <div class="input-field col s12 m6 l6 xl6">
                        <i class="material-icons prefix" style="color: #1461a3;">phone</i>
                        <input id="txt_telefono" type="number" placeholder="Teléfono">
                    </div>
                    <div class="input-field col s12 m6 l6 xl6">
                        <i class="material-icons prefix" style="color: #1461a3;">email</i>
                        <input id="txt_email" type="email" placeholder="Email">
                    </div>
                    <div class="input-field col s12 m6 l6 xl6">
                        <i class="material-icons prefix" style="color: #1461a3;">lock</i>
                        <input id="txt_password" type="password" placeholder="Contraseña">
                    </div>
                    <div class="input-field col s12 m6 l6 xl6">
                        <i class="material-icons prefix" style="color: #1461a3;">lock</i>
                        <input id="txt_repeat_password" type="password" placeholder="Repetir contraseña">
                    </div>
                </form>
                <!-- </div> -->
                <button class="btn" style="background: #ffffff; border: 1px solid #1461a3; color: #1461a3; font-weight: bold;">REGISTRARSE</button>
            </div>
        </div>
    </div>
</body>

<script src="../js/tienda.js"></script>
<script src="../libraries/splide.min.js"></script>
<script src="../libraries/jquery-3.5.1.min.js"></script>
<script src="../libraries/materialize.min.js"></script>
<script src="../libraries/sweetalert2@9.js"></script>
<script>

</script>

</html>