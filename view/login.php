<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="libraries/jquery-3.5.1.min.js"></script>
  <script src="libraries/materialize.min.js"></script>
  <script src="libraries/sweetalert2@9.js"></script>
  <script src="js/tienda.js"></script>
  <link rel="stylesheet" href="styles/tienda.scss" />
  <link rel="stylesheet" href="styles/materialize.min.css" />
  <link rel="stylesheet" href="styles/material-design-iconic-font.min.css" />
  <link rel="shortcut icon" href="image/logo.ico" type="image/x-icon" />
  <title>iZi Pedidos | Inicia sesi&oacute;n</title>
</head>
<style>
  .row {
    margin-bottom: unset !important;
  }
</style>

<body>
  <div class="row" style="margin-top: 40px;">
    <div class="col s12" style="text-align: center;">
      <img src="image/logo.png" width="100" alt="iZiPedidos" title="iZiPedidos" />
    </div>
    <div class="col s12">
      <form id="form_login" class="card-panel" style="border-radius: 10px; margin: auto; width: 300px !important; min-width: 300px !important; max-width: 300px !important;">
        <div class="row">
          <div class="input-field col s2">
            <i class="zmdi zmdi-account-circle prefix" style="color: #0072ff;"></i>
          </div>
          <div class="input-field col s10">
            <input type="number" id="txt_documento" maxlength="11" minlength="8" required />
            <label class="active" for="txt_documento">RUC | DNI</label>
            <span class="spin"></span>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s2">
            <i class="zmdi zmdi-lock prefix" style="color: #0072ff;"></i>
          </div>
          <div class="input-field col s10">
            <input type="password" id="txt_password" required />
            <label class="active" for="txt_password">Contraseña</label>
            <i class="zmdi zmdi-eye-off" style="color: #0072ff; position: absolute; right: 15px; top: 15px; cursor: pointer;" id="off_password"></i>
            <i class="zmdi zmdi-eye hide" style="color: #0072ff; position: absolute; right: 15px; top: 15px; cursor: pointer;" id="see_password"></i>
            <span class="spin"></span>
          </div>

        </div>
        <div class="row">
          <div class="col s12">
            <p>
              <label>
                <input type="checkbox" class="filled-in" checked="checked" id="recuerdame" />
                <span>Recu&eacute;rdame</span>
              </label>
            </p>
          </div>
        </div>
        <div class="row">
          <div class="col s12" style="text-align: center;">
            <div class="preloader-wrapper big active hide" style="width: 50px; height: 50px;" id="loader_login">
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
          <div class="col s12" style="text-align: center;">
            <button type="submit" id="btn_login" class="btn" style="box-shadow: unset; border-radius: 30px; width: 70%;">Ingresar</button>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col s12 center-align padding-null">
            <a href="https://api.whatsapp.com/send?phone=51924040568&text=Quisiera recuperar mi contraseña, mi usuario número de RUC/DNI es " target="_blank">
              <b>Olvid&eacute; mi acceso</b>
            </a>
          </div>
        </div>
      </form>
    </div>
    <div class="col s12" style="text-align: center; padding-top: 1%; color: white;">
      &copy; <?php echo date("Y") ?> Todos los derechos reservados
    </div>
  </div>
</body>
<script>
  /**Verificar sesión */
  verificar_sesion_login();
</script>

</html>