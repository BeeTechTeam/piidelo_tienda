<!DOCTYPE html>
<html lang="en">

<head>
meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/piidelo.css" />
    <link rel="stylesheet" href="css/splide.min.css" />
    <link rel="stylesheet" href="css/materialize.min.css" />
    <link rel="shortcut icon" href="image/logo.ico" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Piidelo.com</title>
    <meta property="og:url" content="https://www.piidelo.com">
    <meta property="og:title" content="Piidelo.com">
    <meta property="og:type" content="website">
    <meta property="og:description" content="En Piidelo.com podrás encontrar todos los productos de los principales productores peruanos; con el único propósito de impulsar el consumo nacional y ayudar a la pequeña y mediana empresa." />
    <meta property="og:image" itemprop="image primaryImageOfPage" content="https://www.piidelo.com/image/banner_default.png">
</head>

<body style="background-color: unset;">
    <!-- WhatsApp -->
    <a href="https://api.whatsapp.com/send?phone=51922944350&text=Vengo%20de%20la%20web%20Piidelo.com,%20quiero%20saber%20sobre%20" target="_blank">
        <img src="image/whatsapp.png" style="width: 50px; position: fixed; z-index: 100; bottom: 10px; left: 10px; cursor: pointer;" />
    </a>

    <!-- Sliders -->
    <div class="splide" style="position: relative; z-index: 2;">
        <div class="splide__track">
            <ul class="splide__list" id="sliders">
            </ul>
        </div>
    </div>

    <!-- Nav -->
    <nav class="transparente" id="nav" style="z-index: 2;">
        <div class="nav-wrapper">
            <div class="row">
                <div class="col s4">
                    <a href="#" data-target="opciones_movil" class="sidenav-trigger"><i class="material-icons" style="color: #003c82">menu</i></a>
                </div>
                <div class="col s4 center-align hide-on-med-and-down">
                    <img onclick="inicio();" src="image/logo.png" width="200px" alt="Piidelo.com" title="Piidelo.com" style="cursor: pointer;" />
                </div>
                <div class="col s8 right-align hide-on-large-only">
                    <i onclick="mostrar_buscador();" class="material-icons options-header">search</i>
                </div>
                <div class="col s4 right-align hide-on-med-and-down">
                    <i onclick="mostrar_buscador();" class="material-icons options-header">search</i>
                    <i onclick="mostrar_carrito();" class="material-icons options-header">shopping_cart<h5 id="cantidad_carrito" class="count-items">0</h5></i>
                    <i onclick="signup();" class="material-icons options-header">account_circle</i>
                </div>
            </div>
        </div>
    </nav>

    <!-- Desplegable small -->
    <ul class="sidenav" id="opciones_movil">
        <li onclick="mostrar_carrito();"><a href="#"><i class="material-icons options-header">shopping_cart</i>Mi carrito</a></li>
        <li onclick="signup();"><a href="#"><i class="material-icons options-header">account_circle</i>Iniciar sesi&oacute;n</a></li>
    </ul>

    <!-- Buscador -->
    <nav id="buscador" class="ocultar_buscador" style="background: #ffffff;">
        <div class="nav-wrapper">
            <form>
                <div class="input-field">
                    <input id="txt_buscar" type="search" placeholder="¿Qu&eacute; necesitas comprar hoy?" style="font-family: Quicksand;">
                    <label class="label-icon" for="search">
                        <i class="material-icons" style="color: #000000;">search</i>
                    </label>
                    <i class="material-icons" onclick="ocultar_buscador();" style="color: #000000;">close</i>
                </div>
            </form>
        </div>
    </nav>

    <!-- Ofertas -->
    <div class="row" style="margin-top: 50px;">
        <div class="col s12 center-align">
            <h4 style="font-weight: bold;" id="titulo_ofertas"></h4>
        </div>
        <div class="col s12">
            <div class="row" id="ofertas">
            </div>
        </div>
    </div>

    <!-- Nuevos -->
    <div class="row" style="margin-top: 50px;">
        <div class="col s12 center-align">
            <h4 style="font-weight: bold;" id="titulo_nuevos"></h4>
        </div>
        <div class="col s12">
            <div class="row" id="nuevos">
            </div>
        </div>
    </div>

    <!-- Todos los productos -->
    <div class="row" style="margin-top: 50px;">
        <div class="col s12 center-align">
            <h4 style="font-weight: bold;" id="titulo_todos"></h4>
        </div>
        <div class="col s12">
            <div class="row" id="todos">
            </div>
        </div>
    </div>


    <!-- Modal de vista r&aacute;pida -->
    <div id="modal_vista_rapida" class="modal">
        <div class="modal-content">
            <div style="text-align: end;">
                <i class="material-icons modal-close" id="close_vista_rapida">close</i>
            </div>
            <diw class="row">
                <div class="col s12 m12 l6 xl6">
                    <img id="foto" width="100%" class="materialboxed">
                </div>
                <div class="col s12 m12 l6 xl6">
                    <div class="row">
                        <div class="col s12 m12 l12 xl12">
                            <span id="nombre" style="font-size: 1.8rem; font-weight: bold;"></span>
                            <p id="descripcion" style="margin: unset"></p>
                        </div>
                        <div class="col s12 m12 l12 xl12" style="margin-bottom: 20px;">
                            <span id="precio_regular" style="font-size: 1.25rem; font-weight: bold; color: #757575;"></span>
                        </div>
                        <div class="col s12 m12 l5 xl5 center-align" style="margin-bottom: 15px;" id="less_and_add">
                        </div>
                        <div class="col s12 m12 l7 xl7 center-align" style="margin-bottom: 5px;" id="vr_ca">
                        </div>
                        <div class="col s12">
                            <ul class="collapsible" style="box-shadow: unset; border: unset;">
                                <li>
                                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> Ver detalles completos <i class="material-icons">arrow_drop_down</i>
                                    </div>
                                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                                        <span>
                                            <table style="width: 100%">
                                                <tbody id="detalles">

                                                </tbody>
                                            </table>
                                        </span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </diw>
        </div>
    </div>

    <!-- Modal de t&eacute;rminos y condiciones -->
    <div id="modal_terminos_condiciones" class="modal" style="text-align: justify;">
        <h5 style="margin: auto; background: #0c489a; color: #ffffff; font-weight: bold; text-align: center; padding: 15px;">T&eacute;rminos y condiciones</h5>
        <div class="modal-content">
            <p> En Piidelo.com queremos ofrecerle una experiencia de compra que sea relevante y personalizada. Por favor revisa los T&eacute;rminos y Condiciones Generales y las Pol&iacute;ticas de privacidad de Seven Corpsolutions S.A.C., ya que son las condiciones de venta que rigen en sus compras en nuestro portal Piidelo.com. Ellos establecen sus derechos y obligaciones con respecto a sus compras, incluyendo importantes limitaciones y exclusiones. La utilizaci&oacute;n del sitio y/o sus servicios constituye la aceptaci&oacute;n de que estas condiciones se aplican a sus compras, as&iacute; que aseg&uacute;rese que las entiende antes de realizar sus pedidos. </p>
            <p style="font-weight: bold; color: #1461a3;">T&Eacute;RMINOS Y CONDICIONES</p>
            <p> Este documento describe los t&eacute;rminos y condiciones generales (los "T&eacute;rminos y Condiciones Generales") y las pol&iacute;ticas de privacidad (las "Pol&iacute;ticas de Privacidad") aplicables al acceso y uso de los servicios ofrecidos por Seven Corpsolutions S.A.C. ("los Servicios") dentro del sitio www.Piidelo.com, sus subdominios y/u otros dominios (urls) relacionados (en adelante "Piidelo.com" o el "Sitio"), en donde estos T&eacute;rminos y Condiciones se encuentren. Cualquier persona que desee acceder y/o suscribirse y/o usar el Sitio o los Servicios podr&aacute; hacerlo sujet&aacute;ndose a los T&eacute;rminos y Condiciones Generales y las Pol&iacute;ticas de Privacidad, junto con todas las dem&aacute;s pol&iacute;ticas y principios que rigen Piidelo.com y que son incorporados al presente directamente o por referencia o que son explicados y/o detallados en otras secciones del Sitio. En consecuencia, todas las visitas y todos los contratos y transacciones que se realicen en este Sitio, as&iacute; como sus efectos jur&iacute;dicos, quedar&aacute;n regidos por estas reglas y sometidos a la legislaci&oacute;n aplicable en Per&uacute;.</p>
            <p> Los T&eacute;rminos y Condiciones y las Pol&iacute;ticas de Privacidad contenidos en este instrumento se aplicar&aacute;n y se entender&aacute;n como parte integral de todos los actos y contratos que se ejecuten o celebren mediante los sistemas de oferta y comercializaci&oacute;n comprendidos en este sitio entre los usuarios de este sitio y Seven Corpsolutions S.A.C. (en adelante " Seven Corpsolutions S.A.C.", "PIIDELO" o "la Empresa", indistintamente), y por cualquiera de las otras sociedades o empresas que sean filiales o vinculadas a ella, y que hagan uso de este sitio, a las cuales se las denominar&aacute; en adelante tambi&eacute;n en forma indistinta como las "Empresas", o bien la "Empresa Oferente", el "Proveedor" o la "Empresa Proveedora", seg&uacute;n convenga al sentido del texto.</p>
            <p> En caso que las Empresas hubieran fijado sus propios T&eacute;rminos y Condiciones y sus Pol&iacute;ticas de Privacidad para los actos y contratos que realicen en este sitio, ellas aparecer&aacute;n en esta p&aacute;gina señalada con un link o indicada como parte de la promoci&oacute;n de sus ofertas y promociones y prevalecer&aacute;n sobre &eacute;stas. CUALQUIER PERSONA QUE NO ACEPTE ESTOS T&eacute;RMINOS Y CONDICIONES GENERALES Y LAS POL&iacute;TICAS DE PRIVACIDAD, LOS CUALES TIENEN UN CAR&aacute;CTER OBLIGATORIO Y VINCULANTE, DEBER&aacute; ABSTENERSE DE UTILIZAR EL SITIO Y/O LOS SERVICIOS.</p>
            <p> El Usuario debe leer, entender y aceptar todas las condiciones establecidas en los T&eacute;rminos y Condiciones Generales y en las Pol&iacute;ticas de Privacidad de Seven Corpsolutions S.A.C. as&iacute; como en los dem&aacute;s documentos incorporados a los mismos por referencia, previo a su registro como Usuario de Piidelo.com y/o a la adquisici&oacute;n de productos y/o entrega de cualquier dato, quedando sujetos a lo señalado y dispuesto en los T&eacute;rminos y Condiciones.</p>
            <p> Cuando usted visita Piidelo.com se est&aacute; comunicando con PIIDELO de manera electr&oacute;nica. En ese sentido, usted brinda su consentimiento para recibir comunicaciones de PIIDELO por correo electr&oacute;nico o mediante la publicaci&oacute;n de avisos en su portal.</p>
            <p>
            <ul class="collapsible" style="box-shadow: unset; border: unset;">
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> 1. Capacidad Legal <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p> Los Servicios s&oacute;lo est&aacute;n disponibles para personas que tengan capacidad legal para contratar. No podr&aacute;n utilizar los servicios las personas que no tengan esa capacidad entre estos los menores de edad o Usuarios de Piidelo.com que hayan sido suspendidos temporalmente o inhabilitados definitivamente en raz&oacute;n de lo dispuesto en la secci&oacute;n 2 “Registro y Uso del Sitio”. Los actos que los menores realicen en este sitio ser&aacute;n responsabilidad de sus padres, tutores, encargados o curadores, y por tanto se considerar&aacute;n realizados por &eacute;stos en ejercicio de la representaci&oacute;n legal con la que cuentan.</p>
                        <p> Quien registre un Usuario como empresa afirmar&aacute; que (i) cuenta con capacidad para contratar en representaci&oacute;n de tal entidad y de obligar a la misma en los t&eacute;rminos de este Acuerdo, (ii) la direcci&oacute;n señalada en el registro es el domicilio principal Legal y/o Fiscal de dicha entidad, y (iii) cualquier otra informaci&oacute;n presentada a PIIDELO es verdadera, precisa, actualizada, completa y oportuna.</p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> 2. Registro y Uso del Sitio <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p> Es obligatorio completar el formulario de registro en todos sus campos con datos v&aacute;lidos y verdaderos para convertirse en Usuario autorizado de Piidelo.com (el "Miembro" PIIDELO o el "Usuario"), de esta manera, podr&aacute; acceder a las promociones, y a la adquisici&oacute;n de productos y/o servicios ofrecidos en este sitio. El futuro Miembro PIIDELO deber&aacute; completar el formulario de registro con su informaci&oacute;n personal de manera exacta, precisa y verdadera ("Datos Personales") y asume el compromiso de actualizar los Datos Personales conforme resulte necesario. PIIDELO podr&aacute; utilizar diversos medios para identificar a sus Miembros, pero PIIDELO NO se responsabiliza por la certeza de los Datos Personales provistos por sus Usuarios. Los Usuarios garantizan y responden, en cualquier caso, de la exactitud, veracidad, vigencia y autenticidad de los Datos Personales ingresados. En ese sentido, la declaraci&oacute;n realizada por los Usuarios al momento de registrarse se entender&aacute; como una Declaraci&oacute;n Jurada.</p>
                        <p> Cada miembro s&oacute;lo podr&aacute; ser titular de una (1) cuenta PIIDELO, no pudiendo acceder a m&aacute;s de una (1) cuenta PIIDELO con distintas direcciones de correo electr&oacute;nico o falseando, modificando y/o alterando sus datos personales de cualquier manera posible. En caso se detecte esta infracci&oacute;n, PIIDELO se comunicar&aacute; con el cliente inform&aacute;ndole que todas sus cuentas ser&aacute;n agrupadas en una sola cuenta anul&aacute;ndose todas sus dem&aacute;s cuentas, ello se informara al usuario mediante correo electr&oacute;nico indicado por &eacute;l mismo o el &uacute;ltimo registrado en PIIDELO.</p>
                        <p> Si se verifica o sospecha alg&uacute;n uso fraudulento y/o malintencionado y/o contrario a estos T&eacute;rminos y Condiciones y/o contrarios a la buena fe, PIIDELO tendr&aacute; el derecho inapelable de dar por terminados los cr&eacute;ditos, no hacer efectiva las promociones, cancelar las transacciones en curso, dar de baja las cuentas y hasta de perseguir judicialmente a los infractores.</p>
                        <p> PIIDELO podr&aacute; realizar los controles que crea convenientes para verificar la veracidad de la informaci&oacute;n dada por el Usuario. En ese sentido, se reserva el derecho de solicitar alg&uacute;n comprobante y/o dato adicional a efectos de corroborar los Datos Personales, as&iacute; como de suspender temporal o definitivamente a aquellos Usuarios cuyos datos no hayan podido ser confirmados. En caso de suspensi&oacute;n temporal PIIDELO comunicara al cliente informando el tiempo de suspensi&oacute;n de la cuenta. En casos de inhabilitaci&oacute;n, PIIDELO podr&aacute; dar de baja la compra efectuada, sin que ello genere derecho alguno a resarcimiento, pago y/o indemnizaci&oacute;n.</p>
                        <p> El Miembro, una vez registrado, dispondr&aacute; de su direcci&oacute;n de email y una clave secreta (en adelante la "Clave") que le permitir&aacute; el acceso personalizado, confidencial y seguro. En caso de poseer estos datos, el Usuario tendr&aacute; la posibilidad de cambiar la Clave de acceso para lo cual deber&aacute; sujetarse al procedimiento establecido en el sitio respectivo. El Usuario se obliga a mantener la confidencialidad de su Clave de acceso, asumiendo totalmente la responsabilidad por el mantenimiento de la confidencialidad de su Clave secreta registrada en este sitio web, la cual le permite efectuar compras, solicitar servicios y obtener informaci&oacute;n (la “Cuenta”). Dicha Clave es de uso personal, y su entrega a terceros no involucra responsabilidad de Seven Corpsolutions S.A.C. o de las empresas en caso de utilizaci&oacute;n indebida, negligente y/o incorrecta.</p>
                        <p> El Usuario ser&aacute; responsable por todas las operaciones efectuadas en y desde su Cuenta, pues el acceso a la misma est&aacute; restringido al ingreso y uso de una Clave secreta, de uso y conocimiento exclusivo del Usuario. EL Usuario se compromete a notificar a Seven Corpsolutions S.A.C. en forma inmediata y por medio id&oacute;neo y fehaciente, cualquier uso indebido o no autorizado de su Cuenta y/o Clave, as&iacute; como el ingreso por terceros no autorizados a la misma. Se aclara que est&aacute; prohibida la venta, cesi&oacute;n, pr&eacute;stamo o transferencia de la Clave y/o Cuenta bajo ning&uacute;n t&iacute;tulo.</p>
                        <p> Seven Corpsolutions S.A.C. se reserva el derecho de rechazar cualquier solicitud de registro o de cancelar un registro previamente aceptado, sin que est&eacute; obligado a comunicar o exponer las razones de su decisi&oacute;n y sin que ello genere alg&uacute;n derecho a indemnizaci&oacute;n o resarcimiento. </p>
                        <p> El registro del Usuario es personal y no se puede transferir por ning&uacute;n motivo a terceras personas. En ese sentido, ning&uacute;n usuario podr&aacute; vender, intentar vender, ceder o transferir un usuario o contraseña. Por lo dicho, PIIDELO podr&aacute; suspender o cancelar definitivamente una cuenta en el caso de una venta, ofrecimiento de venta, cesi&oacute;n o transferencia, en infracci&oacute;n de lo dispuesto en el presente p&aacute;rrafo.</p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> 3. Modificaciones del Acuerdo <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p> Seven Corpsolutions S.A.C. podr&aacute; modificar los T&eacute;rminos y Condiciones Generales en cualquier momento, haciendo p&uacute;blicos en el Sitio los t&eacute;rminos modificados. Todos los t&eacute;rminos modificados entrar&aacute;n en vigencia a los 10 (diez) d&iacute;as h&aacute;biles despu&eacute;s de su publicaci&oacute;n. Dentro de los 5 (cinco) d&iacute;as h&aacute;biles siguientes a la publicaci&oacute;n de las modificaciones introducidas, el Usuario se deber&aacute; comunicar por e-mail a la siguiente direcci&oacute;n: hola@piidelo.com si no acepta las mismas; en ese caso quedar&aacute; disuelto el v&iacute;nculo contractual y ser&aacute; inhabilitado como Miembro. Vencido este plazo, se considerar&aacute; que el Usuario acepta los nuevos t&eacute;rminos y el contrato continuar&aacute; vinculando a ambas partes.</p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> 4. Procedimiento para Hacer Uso de Este Sitio de Internet <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p> En los contratos ofrecidos por medio del Sitio, Piidelo.com informar&aacute;, de manera inequ&iacute;voca y f&aacute;cilmente accesible, los pasos que deber&aacute;n seguirse para celebrarlos, e informar&aacute;, cuando corresponda, si el documento electr&oacute;nico en que se formalice el contrato ser&aacute; archivado y si &eacute;ste ser&aacute; accesible al Usuario. El s&oacute;lo hecho de seguir los pasos que para tales efectos se indiquen en este sitio para efectuar una compra, equivale a aceptar que efectivamente ha dado cumplimiento a las condiciones contenidas en este apartado. Indicar&aacute;, adem&aacute;s, su direcci&oacute;n de correo postal o electr&oacute;nico y los medios t&eacute;cnicos a disposici&oacute;n del Miembro para identificar y corregir errores en el env&iacute;o o en sus datos.</p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> 5. Medios de Pago que se Podr&aacute;n utiliar en el Sitio <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p> Los productos y servicios ofrecidos en el Sitio, salvo que se señale una forma diferente para casos particulares u ofertas de determinados bienes o servicios, s&oacute;lo pueden ser pagados con los medios que en cada caso espec&iacute;ficamente se indiquen. El uso de tarjetas de cr&eacute;ditos o d&eacute;bito se sujetar&aacute; a lo establecido en estos T&eacute;rminos y Condiciones y, en relaci&oacute;n con su emisor, y a lo pactado en los respectivos Contratos de Apertura y Reglamento de Uso. En caso de contradicci&oacute;n, predominar&aacute; lo expresado en ese &uacute;ltimo instrumento. Trat&aacute;ndose de tarjetas bancarias aceptadas en el Sitio, los aspectos relativos a &eacute;stas, tales como la fecha de emisi&oacute;n, caducidad, cupo, bloqueos, cobros de comisiones, inter&eacute;s de compra en cuotas etc., se regir&aacute;n por el respectivo Contrato de Apertura y Reglamento de Uso, de tal forma que las Empresas no tendr&aacute;n responsabilidad por cualquiera de los aspectos señalados. El Sitio podr&aacute; indicar determinadas condiciones de compra seg&uacute;n el medio de pago que se utilice por el usuario. PIIDELO podr&aacute; otorgar descuento en la forma de cr&eacute;ditos que los Usuarios podr&aacute;n descontar en su compra. En cada caso PIIDELO determinar&aacute; unilateralmente el monto m&aacute;ximo de cr&eacute;ditos que el Usuario podr&aacute; utilizar en una compra y lo detallar&aacute; en el sistema, previo a iniciar el proceso de pago. Los cr&eacute;ditos utilizados por los Usuarios ser&aacute;n reintegrados en aquellos casos en los que proceda conforme a la Pol&iacute;tica de Devoluciones y Garant&iacute;as, y de acuerdo con la regulaci&oacute;n.</p>
                        <p> Al utilizar una tarjeta de cr&eacute;dito o d&eacute;bito, el nombre del titular de dicha tarjeta debe coincidir con el nombre utilizado al registrarse en el portal de PIIDELO. De lo contrario, se podr&iacute;a anular la operaci&oacute;n. Bajo cualquier sospecha y/o confirmaci&oacute;n de compras no autorizadas PIIDELO cancelar&aacute; la compra, efectuar&aacute; el reverso a la tarjeta de forma autom&aacute;tica y estar&aacute; facultado para iniciar acciones judiciales en contra de la persona que haya llevado a cabo la transacci&oacute;n sospechosa. As&iacute; mismo, PIIDELO podr&aacute; en los t&eacute;rminos de la ley, entregar la informaci&oacute;n personal de quien haya realizado la transacci&oacute;n sospechosa a los tarjetahabientes afectados </p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> 6. Formaci&oacute;n del Consentimiento en los Contratos Celebrados a Trav&eacute;s de este Sito <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p> A trav&eacute;s del Sitio web las empresas realizar&aacute;n ofertas de bienes y servicios, que podr&aacute;n ser aceptadas a trav&eacute;s de la aceptaci&oacute;n, por v&iacute;a electr&oacute;nica, y utilizando los mecanismos que el mismo Sitio ofrece para ello. Toda aceptaci&oacute;n de oferta quedar&aacute; sujeta a la condici&oacute;n suspensiva de que la Empresa Oferente valide la transacci&oacute;n. En consecuencia, para toda operaci&oacute;n que se efect&uacute;e en este Sitio, la confirmaci&oacute;n y/o validaci&oacute;n o verificaci&oacute;n por parte de la Empresa, ser&aacute; requisito para la formaci&oacute;n del consentimiento. Para validar la transacci&oacute;n la empresa deber&aacute; verificar: a) Que exista stock disponible de los productos al momento en que se acepta la oferta, b) Que valida y acepta el medio de pago ofrecido por el usuario, c) Que los datos registrados por el cliente en el sitio coinciden con los proporcionados al efectuar su aceptaci&oacute;n de oferta, d) Que el pago es acreditado por el Usuario.</p>
                        <p> Para informar al Usuario o consumidor acerca de esta validaci&oacute;n, el Sitio deber&aacute; enviar una confirmaci&oacute;n escrita a la misma direcci&oacute;n electr&oacute;nica que haya registrado el Usuario aceptante de la oferta, o por cualquier medio de comunicaci&oacute;n que garantice el debido y oportuno conocimiento del consumidor, o mediante el env&iacute;o efectivo del producto. El consentimiento se entender&aacute; formado desde el momento en que se env&iacute;a esta confirmaci&oacute;n escrita al Usuario y en el lugar en que fue expedida. La oferta efectuada a el Usuario es irrevocable salvo en circunstancias excepcionales, tales como que PIIDELO cambie sustancialmente la descripci&oacute;n del art&iacute;culo despu&eacute;s de realizada alguna oferta, o que exista un claro error tipogr&aacute;fico.</p>
                        <p> Aviso Legal: La venta y despacho de los productos est&aacute; condicionada a su disponibilidad, y a las existencias de producto y/o a un claro error tipogr&aacute;fico. Cuando el producto no se encuentre disponible y/o haya tenido un error tipogr&aacute;fico, PIIDELO notificar&aacute; de inmediato al cliente y devolver&aacute; el valor total del precio pagado. </p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> 7. Plazo de Validez de la Oferta y Precio <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p> El plazo de validez de la oferta es aquel que coincide con la fecha de vigencia indicada en la promoci&oacute;n o en virtud del agotamiento de las cantidades de productos disponibles para esa promoci&oacute;n debidamente informados al Usuario, o mientras la oferta se mantenga disponible, el menor de estos plazos. Cuando quiera que en una promoci&oacute;n no se indique una fecha de terminaci&oacute;n se entender&aacute; que la actividad se extender&aacute; hasta el agotamiento de los inventarios correspondientes.</p>
                        <p> Los precios de los productos y servicios disponibles en el Sitio, mientras aparezcan como disponibles, solo tendr&aacute;n vigencia y aplicaci&oacute;n en &eacute;ste y no ser&aacute;n aplicables a otros canales de venta utilizados por las empresas, tales como, venta telef&oacute;nica, otros sitios de venta por v&iacute;a electr&oacute;nica, cat&aacute;logos u otros. Los precios de los productos ofrecidos en el Sitio est&aacute;n expresados en Soles o su conversi&oacute;n en moneda extranjera si fuera el caso. Los precios ofrecidos corresponden exclusivamente al valor del bien ofrecido y no incluyen gastos de transporte, manejo, env&iacute;o, accesorios que no se describan expresamente ni ning&uacute;n otro &iacute;tem adicional o cobro de intereses bancarios por el m&eacute;todo de pago utilizado.</p>
                        <p> Adicionalmente, es posible que cierto n&uacute;mero de productos puedan tener un precio incorrecto. De existir un error tipogr&aacute;fico en alguno de los precios de los productos, si el precio correcto del art&iacute;culo es m&aacute;s alto que el que figura en la p&aacute;gina, a nuestra discreci&oacute;n, Seven Corpsolutions S.A.C. lo contactar&aacute; antes de que el producto sea enviado, y/o cancelaremos el pedido y le notificaremos acerca de la cancelaci&oacute;n. En este caso el cliente podr&aacute; contar con un saldo a favor, Nota de Cr&eacute;dito o solicitar el reembolso de su dinero correspondiente al m&eacute;todo de pago utilizado.</p>
                        <p> Las empresas podr&aacute;n modificar cualquier informaci&oacute;n contenida en este Sitio, incluyendo las relacionadas con mercader&iacute;as, servicios, precios, existencias y condiciones, en cualquier momento y sin previo aviso; caso contrario se informar&aacute; a todos los clientes o clientes afectados sobre las modificaciones de informaci&oacute;n relevantes; la expedici&oacute;n de correo correspondiente a la compra de un producto no genera aceptaci&oacute;n u obligaci&oacute;n confirmatorio de una determinada transacci&oacute;n.</p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> 8. Promociones <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p> Las promociones que se ofrezcan en este Sitio web no son necesariamente las mismas que ofrezcan otros canales de venta utilizados por las empresas tales como venta telef&oacute;nica u otros, a menos que se señale expresamente en este sitio o en la publicidad que realicen las empresas para cada promoci&oacute;n. Cuando el Sitio ofrezca promociones que consistan en la entrega gratuita o rebajada de un producto por la compra de otro, el despacho del bien que se entregue gratuitamente o a precio rebajado, se har&aacute; en el mismo lugar en el cual se despacha el producto comprado. El Sitio somete sus promociones y actividades promocionales al cumplimiento de las normas vigentes.</p>
                        <p> Adem&aacute;s de los t&eacute;rminos y condiciones generales establecidos en este documento, cuando PIIDELO realice promociones en vallas publicitarias, radio, televisi&oacute;n u otros medios publicitarios, aplican adicionalmente los siguientes T&eacute;rminos y Comisiones espec&iacute;ficos:<br>
                        <ul>
                            <li>El uso del cup&oacute;n de descuento es completamente gratuito.</li>
                            <li>Cuando se ofrezcan cupones de descuento, se señalar&aacute; en la publicidad, el valor del cup&oacute;n, la suma m&iacute;nima o m&aacute;xima de compra para poder redimir el bono y las fechas v&aacute;lidas para su redenci&oacute;n.</li>
                            <li>El cup&oacute;n de descuento aplica para compras realizada exclusivamente en la p&aacute;gina www.Piidelo.com.</li>
                            <li>Los cupones de descuento no podr&aacute;n ser usados para la compra de productos distintos a los señalados y/o aplicarse en promociones distintas.</li>
                            <li>Podr&aacute; hacer uso del bono de descuento cualquier persona natural mayor de dieciocho (18) años, conforme a lo establecido en el punto 1. Capacidad Legal.</li>
                            <li>El cup&oacute;n de descuento no es v&aacute;lido para tarjetas de regalo ni ventas corporativas. Se entiende por ventas corporativas todas aquellas ventas realizadas a personas jur&iacute;dicas.</li>
                            <li>No es acumulable con otras promociones.</li>
                            <li>El uso del bono solamente podr&aacute; ser usado una vez por cada cliente y una vez vencido no podr&aacute; volver ser usado o reactivado.</li>
                            <li>PIIDELO solo considerar&aacute; validos aquellos cupones de descuento que cumplan con las condiciones espec&iacute;ficas de la promoci&oacute;n.</li>
                            <li>Al hacer una compra con el cup&oacute;n se entiende que el consumidor ha aceptado &iacute;ntegramente tanto los T&eacute;rminos y Condiciones generales de la p&aacute;gina, as&iacute; como estos T&eacute;rminos y Condiciones particulares de cada promoci&oacute;n.</li>
                        </ul>
                        </p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> 9. Despacho de los Productos <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p>
                            Los productos adquiridos a trav&eacute;s de la p&aacute;gina web se sujetar&aacute;n a las condiciones de despacho y entrega elegidas por el cliente y disponibles en el Sitio.
                        </p>
                        <p>
                        <ul>
                            <li>La informaci&oacute;n del lugar de env&iacute;o es de exclusiva responsabilidad del cliente. Por lo que ser&aacute; de tu responsabilidad la exactitud de los datos indicados para realizar una correcta y oportuna entrega de los productos a su domicilio o direcci&oacute;n de env&iacute;o. Si hubiera alg&uacute;n error en la direcci&oacute;n, su producto podr&iacute;a no llegar en la fecha indicada.</li>
                            <li>Los plazos elegidos para el despacho y entrega, se cuentan desde que PIIDELO Per&uacute; valida la orden de compra y el medio de pago utilizado, consider&aacute;ndose d&iacute;as h&aacute;biles para el cumplimiento de dicho plazo.</li>
                            <li>PIIDELO mantendr&aacute; informado a los clientes sobre el estado de su pedido.</li>
                            <li>El Usuario s&oacute;lo podr&aacute; solicitar el cambio de direcci&oacute;n antes de recibir el correo de confirmaci&oacute;n de PIIDELO, si en caso el cliente no ha ingresado la direcci&oacute;n correcta en el momento de realizar la compra y la orden ya se encuentre confirmada, el cliente tendr&iacute;a que solicitar a PIIDELO la cancelaci&oacute;n de la compra inicial y crear una nueva con la direcci&oacute;n correcta, teniendo en cuenta que la venta y despacho de los productos est&aacute; condicionada a su disponibilidad, nuevo precio del producto, los nuevos plazos de entrega, establecidos por PIIDELO y los costos asociados a esta nueva direcci&oacute;n.</li>
                            <li>Nota: Se recomienda al cliente realizar el cambio de la direcci&oacute;n en su cuenta de PIIDELO para que en pr&oacute;ximas compras no se genere error alguno.</li>
                            <li>PIIDELO realizar&aacute; hasta dos intentos de visita al domicilio indicado por el cliente.</li>
                            <li>El siguiente d&iacute;a &uacute;til de efectuada la primera visita, el transportista realizar&aacute; un &uacute;ltimo intento de entrega del pedido. Si en esta segunda entrega, al cliente se le vuelve a encontrar ausente, el pedido ser&aacute; retornado al Proveedor / Distribuidor y la compra ser&aacute; anulada.</li>
                            <li>Posteriormente le llegar&aacute; un correo electr&oacute;nico al cliente sobre la anulaci&oacute;n del pedido. En caso el cliente a&uacute;n quiera el pedido, deber&aacute; generar una nueva orden de compra, teniendo en cuenta la posible modificaci&oacute;n del precio del producto y su disponibilidad.</li>
                            <li>Con el fin de facilitar el seguimiento de los pedidos realizados por los clientes en la p&aacute;gina, PIIDELO podr&aacute; enviar informaci&oacute;n v&iacute;a mensajes de texto (SMS y/o MMS) o v&iacute;a “WhatsApp” acerca de la entrega y estado de los pedidos realizados en el Sitio. Los Clientes no podr&aacute;n presentar dudas acerca de sus pedidos ni interactuar v&iacute;a mensajes de texto (SMS y/o MMS) o v&iacute;a “WhatsApp”. En caso no desear recibir dichas confirmaciones a trav&eacute;s del canal mencionado, lo podr&aacute; comunicar mediante el correo electr&oacute;nico hola@piidelo.com o bien deber&aacute; bloquear el n&uacute;mero del emisor del mensaje.</li>
                            <li>PIIDELO cuenta con cobertura de despachos a nivel Lima Moderna, sin embargo, hay destinos de dif&iacute;cil acceso en los cuales no podr&aacute; efectuar despachos y esto ser&aacute; identificado por el cliente al momento de realizar su compra (aparecer&aacute; cuando el cliente selecciona DEPARTAMENTO/PROVINCIA/DISTRITO). En caso la ubicaci&oacute;n del domicilio del cliente no pueda atenderse porque est&aacute; en una calle o zona de dif&iacute;cil acceso, PIIDELO se comunicar&aacute; con el cliente para gestionar un cambio de domicilio y poder entregar el producto adquirido.</li>
                            <li>Cuando el cliente recibe un producto que no es de grandes dimensiones, deber&aacute; validar que la caja o bolsa que contenga el producto, est&eacute; sellado y no tenga signos de apertura previa; en caso detecte esto, no deber&aacute; recibir el producto y deber&aacute; ponerse en contacto inmediatamente con PIIDELO. En caso que el producto fuera recibido en buenas condiciones y completo, el cliente recibir&aacute; el producto, dejando as&iacute; conformidad de la entrega. Luego de la aceptaci&oacute;n del producto y firma documentaria, el cliente no podr&aacute; presentar reclamo por daño del producto o faltante del mismo, s&oacute;lo se atender&aacute;n reclamos por temas de garant&iacute;a o cualquiera descrita dentro de la Pol&iacute;tica de Devoluci&oacute;n y Cambios en los tiempos establecidos en estos T&eacute;rminos y Condiciones.</li>
                            <li>El transportista podr&aacute; realizar entrega de productos, siempre y cuando el acceso al mismo sea viable (escaleras amplias o ascensor de grandes dimensiones). Si el cliente no accede a la recepci&oacute;n del producto bajo las condiciones mencionadas, el transportista s&oacute;lo podr&aacute; dejarlo en el primer piso de su domicilio, dejando a decisi&oacute;n del cliente el rechazo o recepci&oacute;n del producto.</li>
                        </ul>
                        </p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> 10. Pol&iacute;tica de Devoluci&oacute;n o Cambio por Drecho de Devoluci&oacute;n <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p style="font-weight: bold; color: #1461a3;">10.1 Condiciones Generales</p>
                        <p>
                            Considerar que para ejercer el derecho de devoluci&oacute;n se debe tener en cuenta los siguientes puntos:
                        <ul>
                            <li>Todo cambio o devoluci&oacute;n se solicitar&aacute; hasta los primeros diez (10) d&iacute;as naturales (contabilizados de lunes a domingo incluido feriados), desde la entrega del producto.</li>
                            <li>Es indispensable contar con el producto completo tal y como fue entregado, es decir, con todos los elementos (etiquetas, accesorios, empaques, manuales originales, etc.).</li>
                            <li>Documentaci&oacute;n original (boleta de venta/factura, gu&iacute;a de remisi&oacute;n), es importante para solicitar una devoluci&oacute;n.</li>
                            <li>Importante: De no tener la documentaci&oacute;n del comprobante de pago, el reclamo de este documento deber&aacute; hacerse dentro de las 24 horas despu&eacute;s de recibir el producto.</li>
                            <li>En caso de p&eacute;rdida de documento por parte del cliente, tendr&iacute;a que realizar la Denuncia en la comisar&iacute;a m&aacute;s cercana y enviarlo junto con el producto.</li>
                            <li>En el caso de productos en promoci&oacute;n o combos, se requiere la entrega de todos los productos incluidos en la promoci&oacute;n correspondiente.</li>
                            <li>Si se trata de un producto termosellado, este no debe ser abierto de su empaque original a menos que la devoluci&oacute;n sea &uacute;nicamente por encontrarse el producto en mal estado. El cliente al solicitar la devoluci&oacute;n debe de proporcionar informaci&oacute;n veraz y completa a la empresa.</li>
                        </ul>
                        </p>
                        <p style="font-weight: bold; color: #1461a3;">10.2 Consideraciones</p>
                        <ul>
                            <li>Por regla general el cliente debe solicitar v&iacute;a correo electr&oacute;nico a hola@piidelo.com se le proporcione la direcci&oacute;n de env&iacute;o del producto, asumiendo los costos de courrier as&iacute; como los comprobantes de compra y el producto f&iacute;sico para iniciar el proceso de devoluci&oacute;n del mismo.</li>
                            <li>Si el producto no es entregado dentro de los cuatro (4) d&iacute;as h&aacute;biles desde que se entreg&oacute; el producto, esta vencer&aacute; y se considerar&aacute; como cancelada la solicitud.</li>
                            <li>En caso de que PIIDELO considere necesario el recojo, este ser&aacute; realizado directamente en la direcci&oacute;n donde el producto se entreg&oacute;.</li>
                            <li>Los servicios de recojo de productos a solicitud del cliente por motivos ajenos a responsabilidad de PIIDELO, tendr&aacute;n un costo adicional dependiendo del lugar de recojo, tamaño y peso del producto.</li>
                            <li>Si el producto no se encuentra embalado en su empaque original, no se proceder&aacute; con el recojo. Tampoco se concretar&aacute; el recojo si el cliente no cuenta con el comprobante de pago (boleta/factura y gu&iacute;a de remisi&oacute;n), la misma que deber&aacute; entregar al personal encargado del recojo, por lo tanto, se cancelar&aacute; la solicitud de devoluci&oacute;n.</li>
                        </ul>
                        <p style="font-weight: bold; color: #1461a3;">10.3 Motivos de Devoluci&oacute;n</p>
                        <ul>
                            <li>Producto defectuoso/no funciona bien</li>
                            <li>Producto diferente a la descripci&oacute;n en la p&aacute;gina web</li>
                            <li>Producto disponible a mejor precio en la p&aacute;gina web</li>
                            <li>El producto no cumple con las expectativas</li>
                            <li>Empaque exterior dañado o vencido</li>
                            <li>No es el producto comprado</li>
                            <li>Pedido accidental</li>
                            <li>Se excedi&oacute; la fecha de entrega estimada</li>
                        </ul>
                        <p style="font-weight: bold; color: #1461a3;">10.4 Proceso de Devoluci&oacute;n
                        <ul>
                            <li>Ingresar a www.Piidelo.com, secci&oacute;n “Mi cuenta”, “Mis pedidos”, “Ver detalles”, elegir producto que deseas devolver, y cont&aacute;ctese v&iacute;a correo electr&oacute;nico solicitando la devoluci&oacute;n.</li>
                            <li>Registra el motivo de la devoluci&oacute;n, c&oacute;mo deseas que se resuelva tu solicitud, mencionar descripci&oacute;n del problema con el producto; y por &uacute;ltimo haz clic en “Enviar”.</li>
                            <li>Imprimir la gu&iacute;a de devoluci&oacute;n que recibir&aacute;s mediante correo electr&oacute;nico. El tiempo m&aacute;ximo para recibirla es de 48 horas h&aacute;biles. Sigue las instrucciones que se detallan en la gu&iacute;a para empacar y enviar el producto.</li>
                            <li>De ser necesario PIIDELO solicitar&aacute; los documentos o im&aacute;genes que certifiquen el buen estado y embalaje correcto del producto.</li>
                            <li>Tener en cuenta que el plazo m&aacute;ximo de duraci&oacute;n del proceso de an&aacute;lisis del producto es de tres (3) d&iacute;as h&aacute;biles desde la recepci&oacute;n del producto. En caso de presentarse una demora excepcional, PIIDELO notificar&aacute; al cliente.</li>
                        </ul>
                        </p>
                        <p>
                            Si la devoluci&oacute;n del producto es aceptada, el cliente podr&aacute; solicitar:
                        <ul>
                            <li>El cambio del producto id&eacute;ntico (sujeto a disponibilidad de stock en la p&aacute;gina).</li>
                            <li>
                                En caso de ser una devoluci&oacute;n por los siguientes motivos:
                                <ul>
                                    <li>A) El producto vencido</li>
                                    <li>B) Pedido accidental</li>
                                    <li>C) Disponible a mejor precio</li>
                                </ul>
                            </li>
                            <li>PIIDELO proceder&aacute; con el reembolso o emitir&aacute; una nota de cr&eacute;dito dicho importe de acuerdo a la confirmaci&oacute;n del cliente.</li>
                            <li>Para poder ejercer el derecho de devoluci&oacute;n o cambio el cliente deber&aacute; cumplir con las condiciones generales (Ver punto 10.1) y Consideraciones (Ver punto 10.2).</li>
                        </ul>
                        </p>
                        <p> La devoluci&oacute;n de dinero (de acuerdo al m&eacute;todo de pago utilizado. Ver pol&iacute;tica de reembolsos). </p>
                        <p> En caso el producto no pase el control de calidad por parte del proveedor, te reenviaremos el producto en el mismo estado que lo enviaste.</p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> 11. Comprobantes de Pago <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p> Seg&uacute;n el reglamento de Comprobantes de Pago aprobado por la Resoluci&oacute;n de Superintendencia N° 007-99 / SUNAT (RCP) y el Texto &uacute;nico Ordenado de la Ley del Impuesto General a las Ventas e Impuesto Selectivo al Consumo, aprobado mediante Decreto Supremo N° 055-99-EF y normas modificatorias (TUO del IGV): “No existe ning&uacute;n procedimiento vigente que permita el canje de boletas de venta por facturas, m&aacute;s a&uacute;n las notas de cr&eacute;dito no se encuentran previstas para modificar al adquirente o usuario que figura en el comprobante de pago original”.</p>
                        <p> Teniendo en cuenta esta resoluci&oacute;n, es obligaci&oacute;n del consumidor decidir correctamente el documento que solicitar&aacute; como comprobante al momento de su compra, ya que seg&uacute;n los p&aacute;rrafos citados no proceder&aacute; cambio alguno.</p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> 12. Reembolsos <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p> Luego que el reembolso es aprobado y ejecutado, el tiempo de procesamiento var&iacute;a seg&uacute;n el m&eacute;todo de pago usado.</p>
                        <p> Para una compra con tarjeta de cr&eacute;dito, d&eacute;bito o m&eacute;todos que permitan la devoluci&oacute;n del dinero a trav&eacute;s de una cuenta asociada, se har&aacute; el reverso a la tarjeta o a la cuenta asociada por el total pagado.</p>
                        <p> Para una compra a trav&eacute;s de una transferencia, dep&oacute;sito bancario o pagos en efectivo, se har&aacute; una transferencia por el total pagado a cuenta bancaria del titular de la compra.</p>
                        <p> Tiempos de ejecuci&oacute;n: El tiempo de ejecuci&oacute;n del reembolso es de hasta un (1) d&iacute;a h&aacute;bil.</p>
                        <p> Tiempos de procesamiento: Reverso a la tarjeta: El tiempo del reembolso a una tarjeta puede ser hasta quince (15) d&iacute;as h&aacute;biles, el tiempo de procesamiento es responsabilidad de la entidad financiera que emiti&oacute; la tarjeta y es contado desde la ejecuci&oacute;n del reembolso.</p>
                        <p> Transferencia bancaria: Para recibir el dinero en una cuenta bancaria, el titular de la cuenta debe ser el mismo que realiz&oacute; la compra en PIIDELO. El tiempo de procesamiento es de tres (3) d&iacute;as h&aacute;biles desde su ejecuci&oacute;n. La informaci&oacute;n bancaria proporcionada por el cliente debe ser correcta para evitar retrasos en la atenci&oacute;n. De no ser as&iacute; los tiempos de ejecuci&oacute;n y procesamiento se prolongar&aacute;n.</p>
                        <p>
                            Los datos necesarios son:
                        <ul>
                            <li>Nombre y apellido</li>
                            <li>Documento de Identidad</li>
                            <li>N&uacute;mero de orden y/o detalle del producto</li>
                            <li>Correo electr&oacute;nico registrado en PIIDELO</li>
                            <li>Datos de la cuenta bancaria</li>
                        </ul>
                        *Tomar en cuenta que algunas cajas rurales y municipales la transacci&oacute;n del dep&oacute;sito se concretar&aacute; bajo disposici&oacute;n de la misma Entidad financiera. Para mayor informaci&oacute;n sobre la aceptaci&oacute;n de dep&oacute;sitos externos a estas cuentas, deber&aacute; contactar con dicha Entidad.
                        </p>
                        <p> Cabe precisar que PIIDELO no se responsabiliza por las demoras o dificultades que presente la Entidad Financiera para el cumplimiento del reembolso.</p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> 13. Propiedad Intelectual <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p> Todo el contenido incluido o puesto a disposici&oacute;n del Usuario en el Sitio, incluyendo textos, gr&aacute;ficas, logos, &iacute;conos, im&aacute;genes, archivos de audio, descargas digitales y cualquier otra informaci&oacute;n (el "Contenido"), es de propiedad de Seven Corpsolutions S.A.C. o ha sido licenciada a &eacute;sta por las Empresas Proveedoras. La compilaci&oacute;n del Contenido es propiedad exclusiva de Seven Corpsolutions S.A.C. y, en tal sentido, el Usuario debe abstenerse de extraer y/o reutilizar partes del Contenido sin el consentimiento previo y expreso de la Empresa.</p>
                        <p> Adem&aacute;s del Contenido, las marcas, denominativas o figurativas, marcas de servicio, diseños industriales y cualquier otro elemento de propiedad intelectual que haga parte del Contenido (la "Propiedad Industrial"), son de propiedad de Seven Corpsolutions S.A.C. o de las Empresas Proveedoras y, por tal raz&oacute;n, est&aacute;n protegidas por las leyes y los tratados internacionales de derecho de autor, marcas, patentes, modelos y diseños industriales. El uso indebido y la reproducci&oacute;n total o parcial de dichos contenidos quedan prohibidos, salvo autorizaci&oacute;n expresa y por escrito de Seven Corpsolutions S.A.C., asimismo, no pueden ser usadas por los Usuarios en conexi&oacute;n con cualquier producto o servicio que no sea provisto por Seven Corpsolutions S.A.C. En el mismo sentido, la Propiedad Industrial no podr&aacute; ser usada por los Usuarios en conexi&oacute;n con cualquier producto y servicio que no sea de aquellos que comercializa u ofrece Seven Corpsolutions S.A.C. o de forma que produzca confusi&oacute;n con sus clientes o que desacredite a la Empresa o a las Empresas Proveedoras.</p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> 14. Propiedad Intelectual de Terceros <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p> PIIDELO es una empresa respetuosa de las leyes y no pretende aprovecharse de la reputaci&oacute;n de terceros, apropi&aacute;ndose de la propiedad intelectual por ellos protegida. Por lo anterior contamos con herramientas que buscan asegurar que productos que se adquieran a trav&eacute;s de nuestra p&aacute;gina sean originales y/o de sus mismos productores. Teniendo en cuenta lo anterior, si usted sospecha que alg&uacute;n producto que se encuentra en nuestra p&aacute;gina infringe derecho de propiedad intelectual de terceros o infringe derechos legalmente protegido por usted, agradecemos notific&aacute;rnoslo para bajar dichos productos inmediatamente de nuestra p&aacute;gina e iniciar todas las acciones tendientes a evitar que esto siga sucediendo.</p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> 15. Responsabilidad de PIIDELO <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p> Seven Corpsolutions S.A.C. har&aacute; lo posible dentro de sus capacidades para que la transmisi&oacute;n del Sitio sea ininterrumpida y libre de errores. Sin embargo, dada la naturaleza de la Internet, dichas condiciones no pueden ser garantizadas. En el mismo sentido, el acceso del Usuario a la Cuenta puede ser ocasionalmente restringido o suspendido con el objeto de efectuar reparaciones, mantenimiento o introducir nuevos Servicios. Seven Corpsolutions S.A.C. no ser&aacute; responsable por p&eacute;rdidas (i) que no hayan sido causadas por el incumplimiento de sus obligaciones; (ii) lucro cesante o p&eacute;rdidas de oportunidades comerciales; (iii) cualquier daño indirecto.</p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> 16. T&eacute;rminos de Ley <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p> Este acuerdo ser&aacute; gobernado e interpretado de acuerdo con las leyes de Per&uacute;, sin dar efecto a cualquier principio de conflictos de ley. Si alguna disposici&oacute;n de estos T&eacute;rminos y Condiciones es declarada ilegal, o presenta un vac&iacute;o, o por cualquier raz&oacute;n resulta inaplicable, la misma deber&aacute; ser interpretada dentro del marco del mismo y en cualquier caso no afectar&aacute; la validez y la aplicabilidad de las provisiones restantes.</p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> 17. Notificaciones <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p> Cualquier comentario, inquietud o reclamaci&oacute;n respecto de los anteriores T&eacute;rminos y Condiciones, la Pol&iacute;tica de Privacidad, o la ejecuci&oacute;n de cualquiera de &eacute;stos, deber&aacute; ser notificada por escrito a Seven Corpsolutions S.A.C. a la siguiente direcci&oacute;n: Calle Juan del Carpio 286 Of. 101 - Lima - San Isidro</p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> 18. Jurisdicci&oacute;n y Ley Aplicable <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p> Este acuerdo estar&aacute; regido en todos sus puntos por las leyes vigentes en la Rep&uacute;blica del Per&uacute;.</p>
                        <p> Cualquier controversia derivada del presente acuerdo, su existencia, validez, interpretaci&oacute;n, alcance o cumplimiento, ser&aacute; sometida a los tribunales competentes de la ciudad de Lima, Per&uacute;.</p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> 19. Seguridad <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p> Tenemos en marcha medidas t&eacute;cnicas y de seguridad para evitar el acceso no autorizado o ilegal o la p&eacute;rdida accidental, destrucci&oacute;n u ocurrencia de daños a su informaci&oacute;n. Cuando se recogen datos a trav&eacute;s del Sitio, recogemos sus datos personales en un servidor seguro. Nosotros usamos programas de protecci&oacute;n en nuestros servidores. Cuando recopilamos informaci&oacute;n de tarjetas de pago electr&oacute;nico, se utilizan sistemas de cifrado Secure Socket Layer (SSL) que codifica la misma evitando usos fraudulentos. Si bien no es posible garantizar la consecuci&oacute;n de un resultado estos sistemas han probado ser efectivos en el manejo de informaci&oacute;n reservada, toda vez que cuentan con mecanismos que impiden el acceso de amenazas externas (i.e. hackers). Se recomienda no enviar todos los detalles de tarjetas de cr&eacute;dito o d&eacute;bito sin cifrar las comunicaciones electr&oacute;nicas con nosotros. Mantenemos las salvaguardias f&iacute;sicas, electr&oacute;nicas y de procedimiento en relaci&oacute;n con la recolecci&oacute;n, almacenamiento y divulgaci&oacute;n de su informaci&oacute;n. Nuestros procedimientos de seguridad exigen que en ocasiones podremos solicitarle una prueba de identidad antes de revelar informaci&oacute;n personal. Tenga en cuenta que Ud. es el &uacute;nico responsable de la protecci&oacute;n contra el acceso no autorizado a su contraseña y a su computadora.</p>
                    </div>
                </li>
            </ul>
            </p>
            <p> *Vigente a partir del 15 de diciembre de 2020 </p>
            <p> *Los t&eacute;rminos de uso y condiciones de entrega vigentes hasta el 15 de diciembre de 2020 se encuentran aqu&iacute;. </p>
        </div>
    </div>

    <!-- Modal de pol&iacute;tica de privacidad -->
    <div id="modal_politica_privacidad" class="modal" style="text-align: justify;">
        <h5 style="margin: auto; background: #0c489a; color: #ffffff; font-weight: bold; text-align: center; padding: 15px;">Pol&iacute;tica de Privacidad</h5>
        <div class="modal-content">
            <ul class="collapsible" style="box-shadow: unset; border: unset;">
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> I. Introducci&oacute;n <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p> Seven Corpsolutions S.A.C. tiene un firme compromiso por el respeto y el cumplimiento de todas las disposiciones legales y reglamentarias que les son aplicables. Asimismo, entiende que los datos personales, al ser parte integrante de la privacidad de las personas; y al ser, tambi&eacute;n, fundamentales para nuestra actividad, deben ser tratados de tal forma que no s&oacute;lo impliquen el cumplimiento del ordenamiento legal, sino que, adem&aacute;s, se deben tomar medidas que generen un ambiente de confianza y seguridad en el p&uacute;blico respecto a dicho tratamiento.</p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> II. Objetivo <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p> La presente Pol&iacute;tica tiene por objeto hacer de conocimiento del p&uacute;blico nuestro compromiso con la protecci&oacute;n de sus datos personales, as&iacute; como los lineamientos bajo los cuales realizamos el tratamiento de los mismos en ejercicio de nuestras actividades comerciales, la finalidad para la que lo hacemos, as&iacute; como los procedimientos para que los titulares de los mismos puedan ejercer los derechos previstos en la Normativa de Protecci&oacute;n de Datos Personales.</p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> III. Alcance <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p> La presente Pol&iacute;tica se aplica a toda actividad de tratamiento de datos personales realizada por parte de Seven Corpsolutions S.A.C. (en adelante “PIIDELO”). Ser&aacute; tambi&eacute;n de aplicaci&oacute;n para aquellas personas o empresas a las que PIIDELO requiera el tratamiento de datos personales de los cuales sea responsable.</p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> IV. Definiciones <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p> Los t&eacute;rminos que en esta pol&iacute;tica se usan con may&uacute;scula se encuentran definidos en el Anexo N°1.</p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> V. Principios Rectores <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p>
                            PIIDELO se compromete a respetar los principios rectores establecidos en la Normativa de Protecci&oacute;n de Datos Personales. Estos son:
                        <ul>
                            <li>Principio de legalidad: El tratamiento de los datos personales se hace conforme a lo establecido en la ley, estando prohibida la recopilaci&oacute;n de los datos personales por medios fraudulentos, desleales o il&iacute;citos.</li>
                            <li>Principio de consentimiento: Para el tratamiento de los datos personales debe mediar el consentimiento de su titular, salvo que medie alguna de las excepciones previstas en la ley. Dicho consentimiento debe cumplir con los requisitos de ser libre, previo a su recopilaci&oacute;n o tratamiento, expreso e inequ&iacute;voco, e informado.</li>
                            <li>Principio de finalidad: Los datos personales deben ser recopilados para una finalidad determinada, expl&iacute;cita y l&iacute;cita, y su tratamiento no debe extenderse a otra finalidad distinta a aquella para la cual fueron recopilados.</li>
                            <li>Principio de proporcionalidad: El tratamiento de datos personales debe ser adecuado, relevante y no excesivo a la finalidad para la que estos hubiesen sido recopilados.</li>
                            <li>Principio de calidad: Los datos personales que vayan a ser tratados deben ser veraces, exactos y, en la medida de lo posible, actualizados, necesarios, pertinentes y adecuados respecto de la finalidad para la que fueron recopilados.</li>
                            <li>Principio de seguridad: El titular del banco de datos personales y el Encargado del banco de datos personales deben adoptar las medidas t&eacute;cnicas, organizativas y legales necesarias para garantizar la seguridad de los datos personales.</li>
                            <li>Principio de disposici&oacute;n de recurso: El titular de datos personales debe contar con las v&iacute;as administrativas o jurisdiccionales necesarias para reclamar y hacer valer sus derechos, cuando estos sean vulnerados por el tratamiento de sus datos personales.</li>
                            <li>Principio de nivel de protecci&oacute;n adecuado: Para el flujo transfronterizo de datos personales, se debe garantizar un nivel suficiente de protecci&oacute;n para los datos personales que se vayan a tratar o, por lo menos, equiparable a lo previsto por la Ley de Protecci&oacute;n de Datos Personales o por los est&aacute;ndares internacionales en la materia.</li>
                        </ul>
                        </p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> VI. Finalidad del Tratamiento de los Datos Personales <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p> PIIDELO realiza tratamiento de datos personales de colaboradores, clientes y potenciales clientes, proveedores, empleados y dem&aacute;s personas que conforman sus p&uacute;blicos de inter&eacute;s, de conformidad con las finalidades autorizadas por cada uno de ellos en los consentimientos que han otorgado a PIIDELO, con las excepciones al requisito de obtenci&oacute;n del consentimiento previstas por la Normativa de Protecci&oacute;n de Datos Personales.</p>
                        <p>
                            PIIDELO informa que tratar&aacute; los datos personales, entre otras, para las siguientes finalidades de car&aacute;cter general:
                        <ul>
                            <li>Para cumplir con las obligaciones generadas por los v&iacute;nculos contractuales y no contractuales generados con el titular de datos personales.</li>
                            <li>Comunicar a sus p&uacute;blicos de inter&eacute;s informaci&oacute;n comercial sobre su actividad empresarial, sus bienes y servicios, seg&uacute;n el consentimiento que se obtenga del Titular de datos personales.</li>
                            <li>Cumplir con sus obligaciones legales como empleador.</li>
                            <li>Hacer seguimiento y monitoreo con fines de gesti&oacute;n de riesgos de seguridad a trav&eacute;s de sus dispositivos de video-vigilancia, de registro biom&eacute;trico, y otros que se dispongan.</li>
                            <li>Llevar a cabo actividades de debida diligencia y gesti&oacute;n de riesgos empresariales.</li>
                            <li>Suministrar los Datos Personales a terceros, en Per&uacute; o en el exterior, con los cuales PIIDELO tenga relaci&oacute;n contractual y que sea necesario entreg&aacute;rsela para el cumplimiento del objeto contratado. Por ejemplo, PIIDELO puede utilizar terceros para que le ayuden con la entrega de promoci&oacute;n de productos, recaudar sus pagos, enviar productos u operar nuestros sistemas de servicio al cliente.</li>
                            <li>Completar autom&aacute;ticamente los documentos asociados a las transacciones que realice el Titular en funci&oacute;n de los productos adquiridos y/o servicios utilizados o</li>
                            <li>Desarrollar acciones comerciales o servicios post venta, de car&aacute;cter general o dirigidas personalmente al Titular, tendientes a mejorar su experiencia como cliente a trav&eacute;s de los Canales de Comunicaci&oacute;n.</li>
                            <li>Mantener informado, a trav&eacute;s de los Canales de Comunicaci&oacute;n, al Titular de Datos Personales sobre el proceso de entrega y estado de los pedidos realizados.</li>
                        </ul>
                        </p>
                        <p> El tratamiento de datos personales para las anteriores finalidades, y para cualquier otra finalidad l&iacute;cita distinta a las antes mencionadas es debidamente informado a los Titulares de datos personales, requiri&eacute;ndoles una autorizaci&oacute;n espec&iacute;fica seg&uacute;n el p&uacute;blico de inter&eacute;s que corresponda, en cumplimiento del principio de consentimiento, con las excepciones previstas en la Normativa de Protecci&oacute;n de Datos Personales</p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> VII. Tratamiento por encargo <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p> PIIDELO puede encargar todo o parte del tratamiento de datos personales contenidos en los bancos de datos personales de los cuales es titular, a proveedores leg&iacute;timos para el cumplimiento de sus actividades empresariales, que se encuentren en el Per&uacute; o en el extranjero.</p>
                        <p> Cuando PIIDELO encargue el tratamiento de un banco de datos para la prestaci&oacute;n de alg&uacute;n servicio espec&iacute;fico a terceros contratados con posterioridad a la publicaci&oacute;n de la presente pol&iacute;tica, cumplir&aacute; con las exigencias establecidas para los encargados de tratamiento en la Normativa de Protecci&oacute;n de Datos Personales.</p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> VIII. Consentimiento <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p> PIIDELO requerir&aacute; del consentimiento libre, previo, expreso, inequ&iacute;voco e informado del titular de los datos personales para el tratamiento de los mismos, salvo en los casos de excepci&oacute;n expresamente establecidos por la Normativa de Protecci&oacute;n de Datos Personales.</p>
                        <p> PIIDELO no requerir&aacute; consentimiento para tratar sus datos personales obtenidos de fuentes accesibles al p&uacute;blico, gratuitas o no, para el uso por el cual dichas fueron hechas accesibles al p&uacute;blico; as&iacute; mismo, podr&aacute; tratar sus datos personales de fuentes no p&uacute;blicas, siempre que dichas fuentes cuenten con su consentimiento para tratar y transferir dichos datos personales.</p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> IX. Transferencia de Datos Personales <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p> En los casos en los que el titular de los datos lo haya autorizado expresamente, PIIDELO podr&aacute; transferir local e internacionalmente los datos personales a sus empresas relacionadas, y a sus aliados comerciales, para enviarle publicidad, realizar encuestas, invitaciones a eventos, conocer sus preferencias de consumo, elaborar estad&iacute;sticas y/o estudios de comportamiento, evaluar su capacidad de endeudamiento, comportamiento de pago de consumo y patrimonio.</p>
                        <p> Seven Corpsolutions S.A.C. tambi&eacute;n transfiere al exterior datos personales a terceros encargados de tratamiento, entre ellos a la empresa encargada de brindar los servicios de Host de la p&aacute;gina web.</p>
                        <p> Asimismo, PIIDELO podr&aacute; transferir datos personales a entidades p&uacute;blicas legalmente facultadas dentro del &aacute;mbito de sus competencias, en cumplimiento de normativa vigente o futura, o por requerimiento de &eacute;stas, o cuando medie alguna de las excepciones previstas en la ley.</p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> X. Drechos de los Titulares <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p>
                            De acuerdo con la Normativa de Protecci&oacute;n de Datos Personales, los titulares de datos personales tienen los siguientes derechos:
                        <ul>
                            <li> 1. Derecho de Acceso e informaci&oacute;n: Como consecuencia del derecho de acceso, el titular de datos personales tiene derecho a obtener la informaci&oacute;n que sobre s&iacute; mismo sea objeto de tratamiento en bancos de datos de titularidad de PIIDELO, la forma en que sus datos fueron recopilados, las razones que motivaron su recopilaci&oacute;n, las transferencias realizadas, o a qui&eacute;n se prev&eacute;n hacer, entre otras. El derecho de informaci&oacute;n, por su parte, otorga al titular el derecho de conocer de forma previa a la recopilaci&oacute;n de sus datos, la finalidad para la cual sus datos ser&aacute;n tratados, la existencia del banco de datos en que ser&aacute;n almacenados, la identidad y domicilio del titular del banco de datos y de los encargados del tratamiento, si se producir&aacute; la transferencia de datos personales y a quienes, el tiempo de conservaci&oacute;n, entre otros.</li>
                            <li> 2. Derecho de rectificaci&oacute;n, actualizaci&oacute;n e inclusi&oacute;n: El titular de datos personales tiene derecho a la actualizaci&oacute;n, inclusi&oacute;n y rectificaci&oacute;n de sus datos personales materia de tratamiento por parte de PIIDELO cuando estos sean parcial o totalmente inexactos, incompletos o cuando se hubiere advertido omisi&oacute;n, error o falsedad.</li>
                            <li> 3. Derecho de Cancelaci&oacute;n o Supresi&oacute;n: El titular de datos personales podr&aacute; solicitar la cancelaci&oacute;n o supresi&oacute;n de sus datos personales no relacionados o necesarios para la ejecuci&oacute;n de las obligaciones de cargo de PIIDELO PER&uacute; previstas en los contratos suscritos o las dispuestas por la normativa vigente.</li>
                            <li> 4. Derecho a impedir el suministro: El titular de datos personales tiene derecho a impedir que sus datos personales sean suministrados, especialmente cuando el suministro afecte sus derechos fundamentales, salvo que el suministro se ejecute entre el titular del banco de datos personales y un encargado del banco de datos personales, para efectos de su tratamiento.</li>
                            <li> 5. Derecho de Oposici&oacute;n: El titular de datos personales puede oponerse al tratamiento de sus datos personales en cualquier momento. La oposici&oacute;n proceder&aacute; en la medida que el tratamiento no tenga justificaci&oacute;n contractual o legal.</li>
                            <li> 6. Derecho de revocaci&oacute;n: El titular de datos personales puede retirar en cualquier momento el consentimiento otorgado de manera previa. La revocaci&oacute;n no alcanzar&aacute; a los usos y/o tratamientos que puedan ejecutarse en los escenarios autorizados por la regulaci&oacute;n.</li>
                            <li> 7. Derecho al tratamiento objetivo: El titular de datos personales tiene derecho a no ser afectado por una decisi&oacute;n que se sustente &uacute;nicamente en un tratamiento de datos personales destinado a evaluar determinados aspectos de su personalidad o conducta, salvo que ello ocurra en el marco de un contrato o en los casos de evaluaci&oacute;n con fines de incorporaci&oacute;n a una entidad p&uacute;blica, de acuerdo a ley, sin perjuicio de la posibilidad de defender su punto de vista, para salvaguardar su leg&iacute;timo inter&eacute;s.</li>
                            <li> 8. Derecho a la tutela: En caso de que el titular o el encargado del banco de datos personales deniegue al titular de datos personales, total o parcialmente, el ejercicio de los derechos establecidos en esta Ley, este puede recurrir ante la Autoridad Nacional de Protecci&oacute;n de Datos Personales en v&iacute;a de reclamaci&oacute;n o al Poder Judicial para los efectos de la correspondiente acci&oacute;n de h&aacute;beas data.</li>
                            <li> 9. Derecho a ser indemnizado: El titular de datos personales que sea afectado a consecuencia del incumplimiento de la presente Ley por el titular o por el encargado del banco de datos personales o por terceros, tiene derecho a obtener la indemnizaci&oacute;n correspondiente, conforme a ley.</li>
                        </ul>
                        </p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> XI. Procedimiento para el ejercicio de los derechos del Titular de los Datos Personales <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p> Los Titulares podr&aacute;n revocar su consentimiento o ejercer sus derechos de Ley, dirigi&eacute;ndose al correo hola@piidelo.com indicando su nombre completo, DNI y adjuntando copia de dicho DNI.</p>
                        <p> En caso que el titular del dato personal requiera ejercer sus derechos mediante un representante, &eacute;ste deber&aacute; enviar una carta poder legalizada por notario p&uacute;blico que lo faculte como tal y su documento de identidad.</p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> XII. Plazo del Tratamiento de Datos Personales <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p>Los datos personales tratados por PIIDELO ser&aacute;n almacenados por el tiempo necesario para cumplir las finalidades de tratamiento autorizadas por el titular, sin perjuicio de que este pueda ejercer en cualquier momento los derechos mencionados en el numeral X de esta pol&iacute;tica.</p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> XIII. Seguridad de los Datos Personales <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p> En cumplimiento de la normativa vigente, PIIDELO adopta las medidas jur&iacute;dicas, organizativas y t&eacute;cnicas apropiadas para garantizar la seguridad de los datos personales, evitando su alteraci&oacute;n, p&eacute;rdida, tratamiento indebido o acceso no autorizado.</p>
                        <p> Para este prop&oacute;sito, pone a disposici&oacute;n todos los recursos humanos y tecnol&oacute;gicos necesarios, aplic&aacute;ndolos en proporci&oacute;n a la naturaleza de los datos almacenados y los riesgos a los que se encuentran expuestos.</p>
                        <p> PIIDELO s&oacute;lo realizar&aacute; tratamiento sobre datos personales que est&eacute;n almacenados en repositorios que re&uacute;nan las condiciones de seguridad exigidas por la normativa vigente en protecci&oacute;n de datos personales.</p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> XIV. Cookies <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p> En PIIDELO usamos cookies y tecnolog&iacute;as similares para personalizar y mejorar su experiencia de cliente y para mostrarle publicidad online relevante. Las cookies son pequeños archivos de texto que contienen un identificador &uacute;nico que se almacena en el computador o aparato m&oacute;vil a trav&eacute;s del cual usted accede al Sitio, de manera que aquellos pueden ser reconocidos cada vez que usa el Sitio.</p>
                        <p> Usted puede deshabilitar el uso de cookies seg&uacute;n la configuraci&oacute;n de su navegador. Al respecto puede consultarnos en el correo hola@piidelo.com Tenga en cuenta que existen algunas cookies t&eacute;cnicas que al deshabilitarse podr&iacute;an incluso impedir el funcionamiento correcto del sitio web.</p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> XV. Modificaciones <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p> De producirse cualquier cambio o modificaci&oacute;n de la presente Pol&iacute;tica, el texto vigente de la misma ser&aacute; publicado en nuestro portal web: https://www.Piidelo.com en la secci&oacute;n Pol&iacute;tica de Privacidad.</p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> XVI. Informaci&oacute;n General <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p> Como parte de nuestra actividad, tratamos datos personales en cumplimiento con lo dispuesto en la Normativa de Protecci&oacute;n de Datos Personales.</p>
                        <p> Los datos personales cuyo tratamiento realizamos son almacenados en bancos de datos personales de titularidad de PIIDELO.</p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header" style="padding: unset; border: unset; font-weight: bold; color: #1461a3;"> Anexo N° 1 <i class="material-icons">arrow_drop_down</i>
                    </div>
                    <div class="collapsible-body" style="box-shadow: unset; border: unset; padding: unset;">
                        <p>
                            Definiciones
                            Las palabras y t&eacute;rminos que se definen seguidamente, cuando ellos se escriban con may&uacute;scula inicial seg&uacute;n se hace en sus respectivas definiciones que siguen m&aacute;s adelante, fuere o no necesario conforme a las reglas ortogr&aacute;ficas del uso de las may&uacute;sculas, e independientemente del lugar de esta pol&iacute;tica en que se utilicen, o si se emplean en una persona, n&uacute;mero, modo, tiempo o variable gramatical, seg&uacute;n sea necesario para el adecuado entendimiento de la misma, tendr&aacute;n los significados que a cada una de dichas palabras o t&eacute;rminos se les adscribe a continuaci&oacute;n:
                        <ul>
                            <li> Ley de Protecci&oacute;n de Datos Personales: Ley 29733 y sus modificatorias.</li>
                            <li> Reglamento de la Ley de Protecci&oacute;n de Datos Personales: Decreto Supremo N° 003-2013-JUS y sus modificatorias.</li>
                            <li> Banco de datos personales: Conjunto organizado de datos personales, automatizado o no, independientemente del soporte, sea este f&iacute;sico, magn&eacute;tico, digital, &oacute;ptico u otros que se creen, cualquiera fuere la forma o modalidad de su creaci&oacute;n, formaci&oacute;n, almacenamiento, organizaci&oacute;n y acceso.</li>
                            <li> Datos sensibles: Datos personales constituidos por los datos biom&eacute;tricos que por s&iacute; mismo pueden identificar al titular, datos referidos al origen racial y &eacute;tnico; ingresos econ&oacute;micos, opiniones o convicciones pol&iacute;ticas, religiosas, filos&oacute;ficas o morales; afiliaci&oacute;n sindical; e informaci&oacute;n relacionada a la salud o a la vida sexual.</li>
                            <li> Encargado del banco de datos personales: Toda persona natural, persona jur&iacute;dica de derecho privado o entidad p&uacute;blica que sola o actuando conjuntamente con otra realiza el tratamiento de los datos personales por encargo del titular del banco de datos personales.</li>
                            <li> Normativa de Protecci&oacute;n de Datos Personales: Se refiere la Ley de Protecci&oacute;n de Datos Personales. Al Reglamento de la Ley de Protecci&oacute;n de Datos Personales y a sus modificatorias y normas complementarias.</li>
                            <li> Titular de datos personales: Persona natural a quien corresponde los datos personales.</li>
                            <li> Titular del banco de datos personales: Persona natural, persona jur&iacute;dica de derecho privado o entidad p&uacute;blica que determina la finalidad y contenido del banco de datos personales, el tratamiento de estos y las medidas de seguridad.</li>
                            <li> Transferencia de datos personales: Toda transmisi&oacute;n, suministro o manifestaci&oacute;n de datos personales, de car&aacute;cter nacional o internacional, a una persona jur&iacute;dica de derecho privado, a una entidad p&uacute;blica o a una persona natural distinta del titular de datos personales.</li>
                            <li> Tratamiento de datos personales: Cualquier operaci&oacute;n o procedimiento t&eacute;cnico, automatizado o no, que permite la recopilaci&oacute;n, registro, organizaci&oacute;n, almacenamiento, conservaci&oacute;n, elaboraci&oacute;n, modificaci&oacute;n, extracci&oacute;n, consulta, utilizaci&oacute;n, bloqueo, supresi&oacute;n, comunicaci&oacute;n por transferencia o por difusi&oacute;n o cualquier otra forma de procesamiento que facilite el acceso, correlaci&oacute;n o interconexi&oacute;n de los datos personales”.</li>
                            <li> Derechos Arco: Derechos que ostenta toda persona natural en cuanto titular de datos personales.</li>
                            <li> Solicitud de ejercicio de Derecho ARCO: Es el pedido de acceso, rectificaci&oacute;n, actualizaci&oacute;n, inclusi&oacute;n, cancelaci&oacute;n, supresi&oacute;n u oposici&oacute;n, que formula el titular de datos personales respecto a su informaci&oacute;n.</li>
                            <li> Consentimiento del interesado: es toda manifestaci&oacute;n de voluntad libre, especifica, informada e inequ&iacute;voca por la que el interesado acepta, ya sea mediante una declaraci&oacute;n o una clara acci&oacute;n afirmativa, el tratamiento de datos personales que le conciernen.</li>
                            <li> Canales de Comunicaci&oacute;n: Correo f&iacute;sico, correo electr&oacute;nico, mensajes de texto (SMS y/o MMS), medios digitales tales como Facebook, o "WhatsApp" u otras plataformas similares, n&uacute;mero de celular o cualquier medio de comunicaci&oacute;n que el Titular de Datos Personales proporcione a PIIDELO.</li>
                        </ul>
                        </p>
                    </div>
                </li>

            </ul>
        </div>
    </div>

    <!-- Modal de vista de zonas de cobertura -->
    <div id="modal_zonas_cobertura" class="modal">
        <h5 style="margin: auto; background: #0c489a; color: #ffffff; font-weight: bold; text-align: center; padding: 15px;">Zonas de cobertura</h5>
        <div class="modal-content">
            <img src="image/zonas_cobertura.jpg" width="100%" class="materialboxed">
        </div>
    </div>

    <!-- Carrito de compras -->
    <ul id="side_carrito" class="sidenav">
        <li>
            <div class="row" style="margin: auto;">
                <di class="col s10">
                    <p style="font-weight: bold; color: #0c489a; margin: auto; padding: 5px;">CARRITO DE COMPRAS</p>
                </di>
                <div class="col s2" style="padding-top: 12px;">
                    <i data-target="side_carrito" style="font-weight: bold; color: #0c489a; margin: auto; padding: 5px; cursor: pointer;" class="material-icons sidenav-close">close</i>
                </div>
            </div>
        </li>
        <li class="hide" style="padding: 10px 0px;" id="checkout">
            <div class="divider"></div>
            <div class="row">
                <div class="col s12">
                    <h5 id="subtotal" style="font-size: 1.25rem;"></h5>
                </div>
                <div class="col s12 center-align">
                    <button onclick="checkout();" class="btn" style="border: 1px solid #1461a3; background: #1461a3; color: #ffffff; font-weight: bold; width: 80%;">
                        CHECKOUT
                    </button>
                </div>
            </div>
        </li>
        <li>
            <div class="progress hide_loader" id="loader">
                <div class="indeterminate"></div>
            </div>
        </li>
        <li>
            <ul class="collection" id="items_carrito">

            </ul>
        </li>
    </ul>
    <!-- Abrir carrito -->
    <a href="#" data-target="side_carrito" class="sidenav-trigger hide" id="abrir_carrito"></a>

    <!-- Modal de registrarse -->
    <div id="modal_registrarse" class="modal" style="width: 80%; height: 70vh; background: #ffffff;">
        <i class="material-icons modal-close hide" id="close_modal_registrarse">close</i>
        <div class="row" style="border-radius: 30px; height: 100%; margin: unset; ">
            <div class="col l4 xl4 center-align hide-on-med-and-down" style="color: #ffffff; height: 100%; background: #1461a3; border-radius: 30px 0px 0px 30px; padding-top: 17vh; padding-bottom: 17vh;">
                <h5 style="font-weight: bold; margin-bottom: 5vh;">¡Bienvenido!</h5>
                <p style="margin-bottom: 5vh;">Para mantenerse conectado con nosotros, inicie sesi&oacute;n con su informaci&oacute;n personal</p>
                <button onclick="signin();" class="btn" style="background: #1461a3; border: 1px solid #ffffff; ">INICIAR SESI&Oacute;N</button>
            </div>
            <div class="col s12 m12 l8 xl8 center-align" style="height: 100%; border-radius: 0px 30px 30px 0px; background: #ffffff;">
                <h3 style="font-weight: bold; color: #1461a3; margin: 2vh;">Crear cuenta</h3>
                <p>Completa la informaci&oacute;n solicitada para crear tu cuenta</p>
                <form class="col s12">
                    <div class="input-field col s12 m6 l6 xl6">
                        <i class="material-icons prefix" style="color: #1461a3;">business_center</i>
                        <input id="txt_ruc_dni" type="number" placeholder="RUC o DNI">
                    </div>
                    <div class="input-field col s12 m6 l6 xl6">
                        <i class="material-icons prefix" style="color: #1461a3;">business</i>
                        <input id="txt_razon_social_nombres" type="text" placeholder="Raz&oacute;n Social o Nombres">
                    </div>
                    <div class="input-field col s12 m6 l6 xl6">
                        <i class="material-icons prefix" style="color: #1461a3;">phone</i>
                        <input id="txt_telefono" type="number" placeholder="Tel&eacute;fono">
                    </div>
                    <div class="input-field col s12 m6 l6 xl6">
                        <i class="material-icons prefix" style="color: #1461a3;">email</i>
                        <input id="txt_email" type="email" placeholder="Email">
                    </div>
                    <div class="input-field col s12 m6 l6 xl6">
                        <i class="material-icons prefix" style="color: #1461a3;">lock</i>
                        <input id="txt_password" type="password" autocomplete="on" placeholder="Contraseña">
                        <i class="material-icons hide" style="position: absolute; right: 11px; top: 11px; cursor: pointer; color: #1461a3;" id="ver_password">remove_red_eye
                        </i>
                        <i class="material-icons" style="position: absolute; right: 11px; top: 11px; cursor: pointer;" id="ocultar_password">remove_red_eye
                        </i>
                    </div>
                    <div class="input-field col s12 m6 l6 xl6">
                        <i class="material-icons prefix" style="color: #1461a3;">lock</i>
                        <input id="txt_repeat_password" type="password" autocomplete="on" placeholder="Repetir contraseña">
                        <i class="material-icons hide" style="position: absolute; right: 11px; top: 11px; cursor: pointer; color: #1461a3;" id="ver_password_repeat">remove_red_eye
                        </i>
                        <i class="material-icons" style="position: absolute; right: 11px; top: 11px; cursor: pointer;" id="ocultar_password_repeat">remove_red_eye
                        </i>
                    </div>
                </form>
                <div class="row">
                    <div class="col s12" style="text-align: center;">
                        <div class="preloader-wrapper big active hide" style="width: 50px; height: 50px;" id="loader_signup">
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
                        <button id="btn_signup" onclick="registrarse();" class="btn" style="width: 145px; background: #ffffff; border: 1px solid #1461a3; color: #1461a3; font-weight: bold;">REGISTRARSE</button>
                    </div>
                    <div class="col s12 hide-on-large-only" style="padding: 5px;">
                        <button onclick="signin();" class="btn" style="background: #1461a3; border: 1px solid #ffffff; width: 145px;">INICIAR SESI&Oacute;N</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Abrir signup -->
    <a class="modal-trigger hide" href="#modal_registrarse" id="abrir_signup"></a>

    <!-- Modal de iniciar_sesion -->
    <div id="modal_iniciar_sesion" class="modal">
        <div class="row" style="border-radius: 30px; height: 100%;">
            <div class="col s12 center-align" style="height: 100%; border-radius: 0px 30px 30px 0px;">
                <h3 style="font-weight: bold; color: #1461a3; margin: 2vh;">Iniciar sesi&oacute;n</h3>
                <p>Para mantenerse conectado con nosotros, inicie sesi&oacute;n con su informaci&oacute;n personal</p>
                <form class="row" style="width: 70%; margin: auto;">
                    <div class="input-field col s12">
                        <i class="material-icons prefix" style="color: #1461a3;">email</i>
                        <input id="txt_email_login" type="email" placeholder="Email">
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix" style="color: #1461a3;">lock</i>
                        <input id="txt_password_login" type="password" autocomplete="on" placeholder="Contraseña">
                        <i class="material-icons hide" style="position: absolute; right: 11px; top: 11px; cursor: pointer; color: #1461a3;" id="ver_password_login">remove_red_eye
                        </i>
                        <i class="material-icons" style="position: absolute; right: 11px; top: 11px; cursor: pointer;" id="ocultar_password_login">remove_red_eye
                        </i>
                    </div>
                </form>
                <div class="row">
                    <div class="col s12" style="text-align: center;">
                        <div class="preloader-wrapper big active hide" style="width: 50px; height: 50px;" id="loader_login">
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
                        <button id="btn_login" onclick="iniciar_sesion();" class="btn" style="width: 150px; background: #ffffff; border: 1px solid #1461a3; color: #1461a3; font-weight: bold;">INICIAR SESI&Oacute;N</button>
                    </div>
                    <div class="col s12" style="padding: 5px;">
                        <a style="color: #1461a3;" href="https://api.whatsapp.com/send?phone=51922944350&text=Vengo%20de%20la%20web%20Piidelo.com,%20quiero%20saber%20sobre%20" target="_blank">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Abrir signup -->
    <a class="modal-trigger hide" href="#modal_iniciar_sesion" id="abrir_signin"></a>

    <!-- Footer -->
    <footer class="page-footer">
        <div class="row">
            <div class="col s0 m0 l4 xl4 center-align hide-on-med-and-down">
                <img onclick="inicio();" src="image/logo_footer.png" width="300px" alt="Piidelo.com" title="Piidelo.com" style="cursor: pointer;" />
            </div>
            <div class="col s12 m6 l4 xl4 center-align">
                <h5 class="white-text">Cont&aacute;ctanos</h5>
                <ul>
                    <li>
                        <span style="display: inline-flex;">
                            <i class="material-icons">email</i>&nbsp; hola@piidelo.com
                        </span>
                    </li>
                    <li>
                        <span style="display: inline-flex;">
                            <i class="material-icons">local_phone</i>&nbsp; 922 944 350
                        </span>
                    </li>
                    <li>
                        <span style="display: inline-flex;">
                            <a href="https://www.facebook.com/piidelo/" target="_blank" class="fa fa-facebook" style="color: #1461a3; background: #ffffff; padding: 5px; height: 24px; width: 24px; border-radius: 24px; font-size: 15px; font-weight: bold;"></a>
                            <a href="https://www.facebook.com/piidelo/" target="_blank" style="color: #ffffff;">&nbsp; Piidelo.com</a>
                        </span>
                    </li>
                </ul>
            </div>
            <div class="col s12 m6 l4 xl4 center-align">
                <h5 class="white-text">Informaci&oacute;n</h5>
                <ul>
                    <li>
                        <a class="grey-text text-lighten-3 modal-trigger" href="#modal_terminos_condiciones">T&eacute;minos y condiciones</a>
                    </li>
                    <li>
                        <a class="grey-text text-lighten-3 modal-trigger" href="#modal_politica_privacidad">Pol&iacute;tica de privacidad</a>
                    </li>
                    <li>
                        <a class="grey-text text-lighten-3 modal-trigger" href="#modal_zonas_cobertura">Zonas de cobertura</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="row">
                <div class="col s12">
                    Seven Corpsolutions <?php echo date("Y"); ?>
                </div>
            </div>
        </div>
    </footer>
</body>

<script src="js/piidelo.js"></script>
<script src="libraries/splide.min.js"></script>
<script src="libraries/jquery-3.5.1.min.js"></script>
<script src="libraries/materialize.min.js"></script>
<script src="libraries/sweetalert2@9.js"></script>
<script>
    /**Creamos el carrito */
    crear_carrito();

    $(document).ready(function() {
        /**Activar el sidenav */
        $(".sidenav").sidenav();
        /**Abrir el carrito en la derecha */
        $("#side_carrito").sidenav({
            edge: "right"
        });
        /**Activar el modal */
        $(".modal").modal();
        /**Activar media */
        $(".materialboxed").materialbox();
        /**Activar collapsible */
        $(".collapsible").collapsible();
        if (store.getItem("cliente")) {
            inicio();
        }
    });

    /**Leer los sliders promocionales */
    leer_sliders();

    /**Scroll */
    $(function() {
        $(window).scroll(function() {
            if ($(window).scrollTop() > 142) {
                $("#nav").removeClass("transparente");
                $("#nav").addClass("blanco");
            } else {
                $("#nav").removeClass("blanco");
                $("#nav").addClass("transparente");
            }
        });
    });

    /**Ofertas */
    ofertas();

    /**Productos nuevos */
    productos_nuevos();

    /**Todos */
    todos_general();

    /**Activar buscador */
    buscador();

    /**Contraseñas */
    /**Ver contraseña */
    $("#ver_password").on("click", function() {
        $("#ver_password").addClass("hide");
        $("#ocultar_password").removeClass("hide");
        $("#txt_password").prop("type", "password");
    });

    /**Ocultar contraseña */
    $("#ocultar_password").on("click", function() {
        $("#txt_password").prop("type", "text")
        $("#ocultar_password").addClass("hide");
        $("#ver_password").removeClass("hide");
    });
    /**Ver contraseña */
    $("#ver_password_login").on("click", function() {
        $("#ver_password_login").addClass("hide");
        $("#ocultar_password_login").removeClass("hide");
        $("#txt_password_login").prop("type", "password");
    });

    /**Ocultar contraseña */
    $("#ocultar_password_login").on("click", function() {
        $("#txt_password_login").prop("type", "text")
        $("#ocultar_password_login").addClass("hide");
        $("#ver_password_login").removeClass("hide");
    });

    /**Ver contraseña */
    $("#ver_password_repeat").on("click", function() {
        $("#ver_password_repeat").addClass("hide");
        $("#ocultar_password_repeat").removeClass("hide");
        $("#txt_repeat_password").prop("type", "password")
    });

    /**Ocultar contraseña */
    $("#ocultar_password_repeat").on("click", function() {
        $("#txt_repeat_password").prop("type", "text")
        $("#ocultar_password_repeat").addClass("hide");
        $("#ver_password_repeat").removeClass("hide");
    });

    /**Validar entrada de caracteres */
    /**Limitar el RUC */
    document.getElementById("txt_ruc_dni").addEventListener("input", function() {
        if (this.value.length > 11)
            this.value = this.value.slice(0, 11);
    });

    /**Limitar el tel&eacute;fono */
    document.getElementById("txt_telefono").addEventListener("input", function() {
        if (this.value.length > 9)
            this.value = this.value.slice(0, 9);
    });
</script>

</html>