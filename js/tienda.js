var rutcon = "../config/",
    rutview = "../view/",
    store = localStorage,
    // ruta_servidor = "http://192.168.1.4/piidelo/piidelo_tienda";
    ruta_servidor = "http://localhost/piidelo/piidelo_tienda";
var parametros, distribuidor, origen = "perfil";

// document.getElementById("nav").style.width = window.screen.width;

/**Funcion para obtener el dia de la semana */
function dia_de_semana(dia, mes, year) {
    var dias = ["domingo", "lunes", "martes", "mieercoles", "jueves", "viernes", "sabado"];
    var dt = new Date(mes + " " + dia + ", " + year + " 12:00:00");
    return dias[dt.getUTCDay()];
};

/**Funci&oacute;n de validar email */
function validar_email(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
}

function inicio() {
    if (store.getItem("cliente")) {
        window.location.href = ruta_servidor + "/landing";
    } else {
        window.location.href = ruta_servidor;
    }
}

function perfil() {
    window.location.href = ruta_servidor + "/view/perfil";
}

function logout() {
    store.clear();
    window.location.href = ruta_servidor;
}
/**-------------------------------------------- INDEX -------------------------------------------- */
/**Signup */
function signup() {
    document.getElementById("abrir_signup").click();
}

function registrarse() {
    var ruc_dni = document.getElementById("txt_ruc_dni").value;
    var razon_social_nombres = document.getElementById("txt_razon_social_nombres").value;
    var telefono = document.getElementById("txt_telefono").value;
    var email = document.getElementById("txt_email").value;
    var password = document.getElementById("txt_password").value;
    var repeat_password = document.getElementById("txt_repeat_password").value;
    if (ruc_dni === "") {
        Swal.fire({
            title: "iZi Pedidos",
            icon: "warning",
            text: "Ingresa tu RUC",
            showConfirmButton: false,
            timer: 2000
        });
    } else if (razon_social_nombres === "") {
        Swal.fire({
            title: "iZi Pedidos",
            icon: "warning",
            text: "Ingresa la Razón Social o Nombres",
            showConfirmButton: false,
            timer: 2000
        });
    } else if (telefono === "") {
        Swal.fire({
            title: "iZi Pedidos",
            icon: "warning",
            text: "Ingresa tu teléfono",
            showConfirmButton: false,
            timer: 2000
        });
    } else if (email === "") {
        Swal.fire({
            title: "iZi Pedidos",
            icon: "warning",
            text: "Ingresa tu email",
            showConfirmButton: false,
            timer: 2000
        });
    } else if (password === "") {
        Swal.fire({
            title: "iZi Pedidos",
            icon: "warning",
            text: "Ingresa la contraseña",
            showConfirmButton: false,
            timer: 2000
        });
    } else if (!validar_email(email)) {
        Swal.fire({
            title: "iZi Pedidos",
            icon: "warning",
            text: "Ingresa un email válido",
            showConfirmButton: false,
            timer: 2000
        });
    } else if (password !== repeat_password) {
        Swal.fire({
            title: "iZi Pedidos",
            icon: "warning",
            text: "Las contraseñas no coinciden",
            showConfirmButton: false,
            timer: 2000
        });
    } else {
        $("#btn_signup").addClass("hide");
        $("#loader_signup").removeClass("hide");
        parametros = {
            metodo: "Signup",
            ruc_dni: ruc_dni,
            razon_social_nombres: razon_social_nombres,
            telefono: telefono,
            email: email,
            password: password
        };
        $.ajax({
            url: "config/signup/signup",
            data: parametros,
            type: "post",
            cache: false,
            success: function(resultado) {
                $("#btn_signup").removeClass("hide");
                $("#loader_signup").addClass("hide");
                var response = JSON.parse(resultado);
                var codigo = response.codigo;
                var mensaje = response.mensaje;
                var cliente = response.cliente;
                if (codigo === 106 || codigo === 108) {
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
                    // Swal.fire({
                    //     title: "iZi Pedidos",
                    //     icon: "success",
                    //     // text: mensaje,
                    //     text: "Bienvenido",
                    //     showConfirmButton: false,
                    //     timer: 2000
                    // });
                    // setTimeout(function() {
                    login(email, password, )
                        // }, 500);

                    return;
                }
            }
        });
    }
}

/**Signin */
function signin() {
    document.getElementById("abrir_signin").click();
    document.getElementById("close_modal_registrarse").click();
}

function login(email, password) {
    parametros = {
        usuario: email,
        password: password
    };
    $.ajax({
        url: "config/login/login",
        data: parametros,
        type: "post",
        cache: false,
        success: function(resultado) {
            $("#btn_login").removeClass("hide");
            $("#loader_login").addClass("hide");
            var response = JSON.parse(resultado);
            var codigo = response.codigo;
            var usuario = response.usuario;
            var cliente = response.cliente;
            store.setItem("cliente", JSON.stringify(cliente));
            if (codigo === 100) {
                Swal.fire({
                    title: "iZi Pedidos",
                    icon: "error",
                    text: "El usuario ingresado no existe",
                    showConfirmButton: false,
                    timer: 2000
                });
            } else if (codigo === 101) {
                Swal.fire({
                    title: "iZi Pedidos",
                    icon: "error",
                    text: "La contraseña es incorrecta",
                    showConfirmButton: false,
                    timer: 2000
                });
            } else if (codigo === 102) {
                Swal.fire({
                    title: "iZi Pedidos",
                    icon: "error",
                    text: "Tu usuario ha sido eliminado",
                    showConfirmButton: false,
                    timer: 2000
                });
            } else if (codigo === 103) {
                store.setItem("cliente", JSON.stringify(cliente));
                Swal.fire({
                    title: "iZi Pedidos",
                    icon: "success",
                    text: "Bienvenido " + usuario.usu_nombres,
                    showConfirmButton: false,
                    timer: 3000
                });
                if (origen === "perfil") {
                    window.location.href = ruta_servidor + "/view/perfil";
                } else {
                    window.location.href = ruta_servidor + "/view/checkout";
                }
            } else if (codigo === 105) {
                Swal.fire({
                    title: "iZi Pedidos",
                    icon: "error",
                    text: "Sólo los clientes pueden ingresar",
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        }
    });
}

function iniciar_sesion() {
    var email_login = document.getElementById("txt_email_login").value;
    var password_login = document.getElementById("txt_password_login").value;
    if (email_login === "") {
        Swal.fire({
            title: "iZi Pedidos",
            icon: "warning",
            text: "Ingresa tu email",
            showConfirmButton: false,
            timer: 2000
        });
    } else if (!validar_email(email_login)) {
        Swal.fire({
            title: "iZi Pedidos",
            icon: "warning",
            text: "Ingresa un email válido",
            showConfirmButton: false,
            timer: 2000
        });
    } else if (password_login === "") {
        Swal.fire({
            title: "iZi Pedidos",
            icon: "warning",
            text: "Ingresa la contraseña",
            showConfirmButton: false,
            timer: 2000
        });
    } else {
        $("#btn_login").addClass("hide");
        $("#loader_login").removeClass("hide");
        login(email_login, password_login);
    }
}

/**Leer sliders */
function leer_sliders() {
    parametros = {
        metodo: "LeerSliders",
    };
    $.ajax({
        url: "config/slider/slider",
        data: parametros,
        type: "post",
        cache: false,
        success: function(resultado) {
            $(".splide__list").html(resultado);
            new Splide(".splide", {
                type: "loop",
                perPage: 1,
                autoplay: true,
                rewind: true,
            }).mount();
        }
    });
}

/**Mostrar buscador */
function mostrar_buscador() {
    $("#buscador").removeClass("ocultar_buscador");
    $("#buscador").addClass("mostrar_buscador");
    $("#txt_buscar").focus();
}

/**Ocultar buscador */
function ocultar_buscador() {
    $("#buscador").removeClass("mostrar_buscador");
    $("#buscador").addClass("ocultar_buscador");
    $("#txt_buscar").val("");
    /**Favoritos del mes */
    favoritos_del_mes();
    /**Productos nuevos */
    productos_nuevos();
    /**Ofertas */
    ofertas();
}

/**Favoritos del mes */
function imprimir_favoritos(producto) {
    var stock = parseInt(producto.prod_stock);
    if (stock === 0) {
        document.getElementById("favoritos_del_mes").innerHTML +=
            `<div class="col s12 m6 l4 xl4" style="margin: 10px 0px;">
        
                <div class="card" style="min-height: 500px; max-height: 500px; height: 500px; width: 100%; box-shadow: unset; position: relative;">
                    <div class="card-image">
                        <img src="${producto.prod_foto}" title="${producto.prod_nombre}" alt="${producto.prod_nombre}" style="height: 400px; width: 350px; margin: auto;">
                    </div>
                    <div class="card-content" style="text-align: center; padding: unset;">
                        <p style="font-weight: bold;">${producto.prod_nombre}</p>
                        <p>S/${producto.prod_precio_regular}</p>
                        <div class="row" style="width: 100%; margin: unset;">
                            <div class="col s6 m6 l6 xl6" style="margin: 5px 0px 5px 0px;">
                                <button id="btn_vista_rapida${producto.prod_id}" onmouseenter="btn_vista_rapida_enter(${producto.prod_id});" onmouseleave="btn_vista_rapidaleave(${producto.prod_id});" href="#modal_vista_rapida" onclick='vista_rapida(${JSON.stringify(producto)})' class="btn modal-trigger button_vr_ca" style="color: black; font-weight: bold; font-family: 'Quicksand'; text-transform: none;">
                                    <i class="material-icons">remove_red_eye</i>
                                </button>
                            </div>
                            <div class="col s6 m6 l6 xl6" style="margin: 5px 0px 5px 0px;">
                                <button class="btn button_vr_ca" style="color: black; font-weight: bold; font-family: 'Quicksand'; text-transform: none;">
                                    AGOTADO
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>`;
    } else {
        document.getElementById("favoritos_del_mes").innerHTML +=
            `<div class="col s12 m6 l4 xl4" style="margin: 10px 0px;">
        
                <div class="card" style="min-height: 500px; max-height: 500px; height: 500px; width: 100%; box-shadow: unset; position: relative;">
                    <div class="card-image">
                        <img src="${producto.prod_foto}" title="${producto.prod_nombre}" alt="${producto.prod_nombre}" style="height: 400px; width: 350px; margin: auto;">
                    </div>
                    <div class="card-content" style="text-align: center; padding: unset;">
                        <p style="font-weight: bold;">${producto.prod_nombre}</p>
                        <p>S/${producto.prod_precio_regular}</p>
                        <div class="row" style="width: 100%; margin: unset;">
                            <div class="col s6 m6 l6 xl6" style="margin: 5px 0px 5px 0px;">
                                <button id="btn_vista_rapida${producto.prod_id}" onmouseenter="btn_vista_rapida_enter(${producto.prod_id});" onmouseleave="btn_vista_rapidaleave(${producto.prod_id});" href="#modal_vista_rapida" onclick='vista_rapida(${JSON.stringify(producto)})' class="btn modal-trigger button_vr_ca" style="color: black; font-weight: bold; font-family: 'Quicksand'; text-transform: none;">
                                    <i class="material-icons">remove_red_eye</i>
                                </button>
                            </div>
                            <div class="col s6 m6 l6 xl6" style="margin: 5px 0px 5px 0px;">
                                <button id="btn_comprar_ahora${producto.prod_id}" onmouseenter="btn_comprar_ahora_enter(${producto.prod_id});" onmouseleave="btn_comprar_ahora_leave(${producto.prod_id});" onclick="comprar_ahora(${producto.prod_id}, 1, ${producto.prod_stock}, 'nuevo')" class="btn button_vr_ca" style="color: black; font-weight: bold; font-family: 'Quicksand'; text-transform: none;">
                                    <i class="material-icons">add_shopping_cart</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>`;
    }
}

function favoritos_del_mes() {
    $("#favoritos_del_mes").html("");
    parametros = {
        metodo: "FavoritosDelMes",
    };
    $.ajax({
        url: "config/producto/producto",
        data: parametros,
        type: "post",
        cache: false,
        success: function(resultado) {
            var productos = JSON.parse(resultado);
            for (var i = 0; i < productos.length; i++) {
                imprimir_favoritos(productos[i])
            }
            var longitud = productos.length;
            if (longitud > 0) {
                $("#titulo_favoritos").html("Favoritos del mes");
            }
        }
    });
}

/**Productos nuevos */
function imprimir_nuevos(producto) {
    var stock = parseInt(producto.prod_stock);
    if (stock === 0) {
        document.getElementById("nuevos").innerHTML +=
            `<div class="col s12 m6 l4 xl4" style="margin: 10px 0px;">
                    
                            <div class="card" style="min-height: 500px; max-height: 500px; height: 500px; box-shadow: unset;">
                                <div class="card-image">
                                    <img src="${producto.prod_foto}" title="${producto.prod_nombre}" alt="${producto.prod_nombre}" style="height: 400px; width: 350px; margin: auto;">
                                </div>
                                <div class="card-content" style="text-align: center; padding: unset;">
                                    <p style="font-weight: bold;">${producto.prod_nombre}</p>
                                    <p>S/${producto.prod_precio_regular}</p>
                                    <div class="row" style="width: 100%; margin: unset;">
                                        <div class="col s6 m6 l6 xl6" style="margin: 5px 0px 5px 0px;">
                                            <button id="btn_vista_rapida${producto.prod_id}" onmouseenter="btn_vista_rapida_enter(${producto.prod_id});" onmouseleave="btn_vista_rapidaleave(${producto.prod_id});" href="#modal_vista_rapida" onclick='vista_rapida(${JSON.stringify(producto)})' class="btn modal-trigger button_vr_ca" style="color: black; font-weight: bold; font-family: 'Quicksand'; text-transform: none;">
                                                <i class="material-icons">remove_red_eye</i>
                                            </button>
                                        </div>
                                        <div class="col s6 m6 l6 xl6" style="margin: 5px 0px 5px 0px;">
                                            <button class="btn button_vr_ca" style="color: black; font-weight: bold; font-family: 'Quicksand'; text-transform: none;">
                                                AGOTADO
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                        </div>`;

    } else {
        document.getElementById("nuevos").innerHTML +=
            `<div class="col s12 m6 l4 xl4" style="margin: 10px 0px;">
                        
                        <div class="card" style="min-height: 500px; max-height: 500px; height: 500px; box-shadow: unset;">
                            <div class="card-image">
                                <img src="${producto.prod_foto}" title="${producto.prod_nombre}" alt="${producto.prod_nombre}" style="height: 400px; width: 350px; margin: auto;">
                            </div>
                            <div class="card-content" style="text-align: center; padding: unset;">
                                <p style="font-weight: bold;">${producto.prod_nombre}</p>
                                <p>S/${producto.prod_precio_regular}</p>
                                <div class="row" style="width: 100%; margin: unset;">
                                    <div class="col s6 m6 l6 xl6" style="margin: 5px 0px 5px 0px;">
                                        <button id="btn_vista_rapida${producto.prod_id}" onmouseenter="btn_vista_rapida_enter(${producto.prod_id});" onmouseleave="btn_vista_rapidaleave(${producto.prod_id});" href="#modal_vista_rapida" onclick='vista_rapida(${JSON.stringify(producto)})' class="btn modal-trigger button_vr_ca" style="color: black; font-weight: bold; font-family: 'Quicksand'; text-transform: none;">
                                            <i class="material-icons">remove_red_eye</i>
                                        </button>
                                    </div>
                                    <div class="col s6 m6 l6 xl6" style="margin: 5px 0px 5px 0px;">
                                        <button id="btn_comprar_ahora${producto.prod_id}" onmouseenter="btn_comprar_ahora_enter(${producto.prod_id});" onmouseleave="btn_comprar_ahora_leave(${producto.prod_id});" onclick="comprar_ahora(${producto.prod_id}, 1, ${producto.prod_stock}, 'nuevo')" class="btn button_vr_ca" style="color: black; font-weight: bold; font-family: 'Quicksand'; text-transform: none;">
                                            <i class="material-icons">add_shopping_cart</i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                    </div>`;
    }
}

function productos_nuevos() {
    $("#nuevos").html("");
    parametros = {
        metodo: "Nuevos",
    };
    $.ajax({
        url: "config/producto/producto",
        data: parametros,
        type: "post",
        cache: false,
        success: function(resultado) {
            var productos = JSON.parse(resultado);
            for (var i = 0; i < productos.length; i++) {
                imprimir_nuevos(productos[i]);
            }
            var longitud = productos.length;
            if (longitud > 0) {
                $("#titulo_nuevos").html("Nuevos");
            }
        }
    });
}

/**Ofertas */
function imprimir_ofertas(producto) {
    var stock = parseInt(producto.prod_stock);
    if (stock === 0) {
        document.getElementById("ofertas").innerHTML +=
            `<div class="col s12 m6 l4 xl4" style="margin: 10px 0px;">

                    <div class="card" style="min-height: 500px; max-height: 500px; height: 500px; width: 100%; box-shadow: unset; position: relative;">
                        <div class="card-image">
                            <img src="${producto.prod_foto}" title="${producto.prod_nombre}" alt="${producto.prod_nombre}" style="height: 400px; width: 350px; margin: auto;">
                        </div>
                        <div class="card-content" style="text-align: center; padding: unset;">
                            <p style="font-weight: bold;">${producto.prod_nombre}</p>
                            <p>S/${producto.prod_precio_regular}</p>
                            <div class="row" style="width: 100%; margin: unset;">
                                <div class="col s6 m6 l6 xl6" style="margin: 5px 0px 5px 0px;">
                                    <button id="btn_vista_rapida${producto.prod_id}" onmouseenter="btn_vista_rapida_enter(${producto.prod_id});" onmouseleave="btn_vista_rapidaleave(${producto.prod_id});" href="#modal_vista_rapida" onclick='vista_rapida(${JSON.stringify(producto)})' class="btn modal-trigger button_vr_ca" style="color: black; font-weight: bold; font-family: 'Quicksand'; text-transform: none;">
                                        <i class="material-icons">remove_red_eye</i>
                                    </button>
                                </div>
                                <div class="col s6 m6 l6 xl6" style="margin: 5px 0px 5px 0px;">
                                    <button class="btn button_vr_ca" style="color: black; font-weight: bold; font-family: 'Quicksand'; text-transform: none;">
                                        AGOTADO
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
        
            </div>`;
    } else {
        document.getElementById("ofertas").innerHTML +=
            `<div class="col s12 m6 l4 xl4" style="margin: 10px 0px;">

                    <div class="card" style="min-height: 500px; max-height: 500px; height: 500px; width: 100%; box-shadow: unset; position: relative;">
                        <div class="card-image">
                            <img src="${producto.prod_foto}" title="${producto.prod_nombre}" alt="${producto.prod_nombre}" style="height: 400px; width: 350px; margin: auto;">
                        </div>
                        <div class="card-content" style="text-align: center; padding: unset;">
                            <p style="font-weight: bold;">${producto.prod_nombre}</p>
                            <p>S/${producto.prod_precio_regular}</p>
                            <div class="row" style="width: 100%; margin: unset;">
                                <div class="col s6 m6 l6 xl6" style="margin: 5px 0px 5px 0px;">
                                    <button id="btn_vista_rapida${producto.prod_id}" onmouseenter="btn_vista_rapida_enter(${producto.prod_id});" onmouseleave="btn_vista_rapidaleave(${producto.prod_id});" href="#modal_vista_rapida" onclick='vista_rapida(${JSON.stringify(producto)})' class="btn modal-trigger button_vr_ca" style="color: black; font-weight: bold; font-family: 'Quicksand'; text-transform: none;">
                                        <i class="material-icons">remove_red_eye</i>
                                    </button>
                                </div>
                                <div class="col s6 m6 l6 xl6" style="margin: 5px 0px 5px 0px;">
                                    <button id="btn_comprar_ahora${producto.prod_id}" onmouseenter="btn_comprar_ahora_enter(${producto.prod_id});" onmouseleave="btn_comprar_ahora_leave(${producto.prod_id});" onclick="comprar_ahora(${producto.prod_id}, 1, ${producto.prod_stock}, 'nuevo')" class="btn button_vr_ca" style="color: black; font-weight: bold; font-family: 'Quicksand'; text-transform: none;">
                                        <i class="material-icons">add_shopping_cart</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
        
            </div>`;
    }
}

function ofertas() {
    $("#ofertas").html("");
    parametros = {
        metodo: "Ofertas",
    };
    $.ajax({
        url: "config/producto/producto",
        data: parametros,
        type: "post",
        cache: false,
        success: function(resultado) {
            var productos = JSON.parse(resultado);
            for (var i = 0; i < productos.length; i++) {
                imprimir_ofertas(productos[i]);
            }
            var longitud = productos.length;
            if (longitud > 0) {
                $("#titulo_ofertas").html("Ofertas");
            }
        }
    });
}

/**Buscador de productos */
function buscador() {
    /**Buscar productos */
    $("#txt_buscar").keydown(function() {
        if ($("#txt_buscar").val() != "") {
            $("#favoritos_del_mes").html("");
            $("#nuevos").html("");
            $("#ofertas").html("");
            parametros = {
                metodo: "BuscarProductos",
                nombre: $("#txt_buscar").val()
            };
            $.ajax({
                url: "config/producto/producto",
                data: parametros,
                type: "post",
                cache: false,
                success: function(resultado) {
                    var productos = JSON.parse(resultado);
                    for (var i = 0; i < productos.length; i++) {
                        switch (productos[i].prod_tipo) {
                            case "Favorito":
                                imprimir_favoritos(productos[i]);
                                break;
                            case "Nuevo":
                                imprimir_nuevos(productos[i]);
                                break;
                            case "Oferta":
                                imprimir_ofertas(productos[i]);
                                break;
                        }
                    }
                }
            });
        }
    });
}

/**Cambiar contenido de los botones */
/**Vista r&aacute;pida */
function btn_vista_rapida_enter(id) {
    document.getElementById("btn_vista_rapida" + id).style.background = `#000000`;
    document.getElementById("btn_vista_rapida" + id).style.color = `#ffffff`;
    document.getElementById("btn_vista_rapida" + id).innerHTML = `Vista r&aacute;pida `;
}

function btn_vista_rapidaleave(id) {
    document.getElementById("btn_vista_rapida" + id).style.background = `#ffffff`;
    document.getElementById("btn_vista_rapida" + id).style.color = `#000000`;
    document.getElementById("btn_vista_rapida" + id).innerHTML = `<i class="material-icons">remove_red_eye</i>`;
}

/**Comprar ahora */
function btn_comprar_ahora_enter(id) {
    document.getElementById("btn_comprar_ahora" + id).style.background = `#000000`;
    document.getElementById("btn_comprar_ahora" + id).style.color = `#ffffff`;
    document.getElementById("btn_comprar_ahora" + id).innerHTML = `Comprar ahora`;
}

function btn_comprar_ahora_leave(id) {
    document.getElementById("btn_comprar_ahora" + id).style.background = `#ffffff`;
    document.getElementById("btn_comprar_ahora" + id).style.color = `#000000`;
    document.getElementById("btn_comprar_ahora" + id).innerHTML = `<i class="material-icons">add_shopping_cart</i>`;
}

/**Vista r&aacute;pida */
function vista_rapida(producto) {

    document.getElementById("foto").src = producto.prod_foto;
    document.getElementById("nombre").innerHTML = producto.prod_nombre;
    document.getElementById("descripcion").innerHTML = producto.prod_descripcion;
    document.getElementById("precio_regular").innerHTML = "S/" + producto.prod_precio_regular;
    if (parseInt(producto.prod_stock) > 0) {
        document.getElementById("less_and_add").innerHTML =
            `
                <div style="display: inline-flex; height: 40px; width: 120px;">
                    <button class="less_plus"><i class="material-icons" style="cursor: pointer;" onclick="less(${producto.prod_id}, ${producto.prod_stock});">delete</i></button>
                    <input type="number" class="cantidad_a_comprar" id="cantidad_a_comprar" value="1" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    <button class="less_plus"><i class="material-icons" style="cursor: pointer;" onclick="plus(${producto.prod_id}, ${producto.prod_stock});">add</i></button>
                </div>
        
        `;
        document.getElementById("vr_ca").innerHTML = `
            <div onclick="comprar_ahora(${producto.prod_id}, ${parseInt(document.getElementById("cantidad_a_comprar").value)}, ${producto.prod_stock}, 'nuevo');" style="cursor: pointer; border: 1px solid #1461a3; background: #1461a3; display: inline-flex; border-radius: 30px; height: 40px; width: 160px;">
                <span style="margin: auto; color: #ffffff; font-weight: bold;">COMPRAR AHORA</span>
            </div>
        `;
    } else {
        document.getElementById("less_and_add").innerHTML = "";
        document.getElementById("vr_ca").innerHTML = "";
    }

    var detalles = JSON.parse(producto.prod_detalles);
    document.getElementById("detalles").innerHTML = "";
    for (var i = 0; i < detalles.length; i++) {
        if (detalles[i].detalle === "none") {
            document.getElementById("detalles").innerHTML +=
                `<tr id=${i} style="border: unset;">
                    <td colspan="2">No hay informaci&oacute;n adicional sobre este producto</td>
                </tr>`;
        } else {
            document.getElementById("detalles").innerHTML +=
                `<tr id=${i} style="border: unset;">
                    <td style="font-weight: bold; padding: unset;">${detalles[i].detalle}</td>
                    <td style="padding: unset;">${detalles[i].valor}</td>
                </tr>`;
        }

    }
    $("#cantidad_a_comprar").keyup(function() {
        document.getElementById("vr_ca").innerHTML = `
            <div onclick="comprar_ahora(${producto.prod_id}, ${$("#cantidad_a_comprar").val()}, ${producto.prod_stock}, 'nuevo');" style="cursor: pointer; border: 1px solid #1461a3; background: #1461a3; display: inline-flex; border-radius: 30px; height: 40px; width: 160px;">
                <span style="margin: auto; color: #ffffff; font-weight: bold;">COMPRAR AHORA</span>
            </div>
        `;
    });
}


/**Comprar ahora */
var carrito = [];

function crear_carrito() {
    if (!store.getItem("carrito")) { store.setItem("carrito", JSON.stringify(carrito)); } else {
        carrito = JSON.parse(store.getItem("carrito"));
        document.getElementById("cantidad_carrito").innerText = carrito.length;
    }
}

function comprar_ahora(codigo, cantidad, stock, origen) {
    if (origen === "nuevo") {
        if (!store.getItem("carrito")) {
            store.setItem("carrito", JSON.stringify([]));
        } else {
            carrito = JSON.parse(store.getItem("carrito"));
            if (origen === "nuevo") {
                document.getElementById("cantidad_carrito").innerText = carrito.length;
            }
        }
    } else {
        store.setItem("carrito", JSON.stringify([]));
    }
    parametros = {
        metodo: "LeerProducto",
        producto: codigo
    };
    var url = "";
    if (origen === "nuevo") {
        url = "config/producto/producto";
    } else {
        url = "../config/producto/producto";
    }
    $.ajax({
        url: url,
        data: parametros,
        type: "post",
        cache: false,
        success: function(resultado) {
            var producto = JSON.parse(resultado);
            var precio = 0;
            switch (producto.prod_tipo) {
                case "Favorito":
                    precio = producto.prod_precio_regular;
                    break;
                case "Nuevo":
                    precio = producto.prod_precio_regular;
                    break;
                case "Oferta":
                    precio = producto.prod_precio_oferta;
                    break;
            }
            if (!cantidad || cantidad === 0) {
                Swal.fire({
                    title: "iZi Pedidos",
                    icon: "error",
                    text: "Ingresa una cantidad válida mayor a 0",
                    showConfirmButton: false,
                    timer: 2000
                });
                return;
            }
            if (cantidad <= stock) {
                if (origen === "nuevo") {
                    document.getElementById("close_vista_rapida").click();
                }
                if (carrito.length === 0) {
                    carrito.push({ producto: producto, cantidad: cantidad, precio: parseFloat(precio) });
                    store.setItem("carrito", JSON.stringify(carrito));
                    if (origen === "nuevo") {
                        document.getElementById("cantidad_carrito").innerText = carrito.length;
                        mostrar_carrito();
                    }
                } else {
                    for (var i = 0; i < carrito.length; i++) {
                        if (carrito[i].producto.prod_id == codigo) {
                            carrito.splice(i, 1, { producto: carrito[i].producto, cantidad: (carrito[i].cantidad + cantidad), precio: precio });
                            if (origen === "nuevo") { mostrar_carrito(); }
                            return;
                        }
                    }
                    carrito.push({ producto: producto, cantidad: cantidad, precio: precio });
                    store.setItem("carrito", JSON.stringify(carrito));
                    if (origen === "nuevo") {
                        document.getElementById("cantidad_carrito").innerText = carrito.length;
                        mostrar_carrito();
                    }

                }
            } else {
                Swal.fire({
                    title: "iZi Pedidos",
                    icon: "error",
                    text: "No hay suficiente stock, sólo quedan " + stock + " unidades",
                    showConfirmButton: false,
                    timer: 2000
                });
                return;
            }
        }
    });

}

/**Aumentar cantidad */
function plus(codigo, stock) {
    var cantidad_actual = parseInt(document.getElementById("cantidad_a_comprar").value);
    cantidad_actual = cantidad_actual + 1;
    document.getElementById("vr_ca").innerHTML =
        `
            <div onclick="comprar_ahora(${codigo}, ${cantidad_actual}, ${stock}, 'nuevo');" style="cursor: pointer; border: 1px solid #1461a3; background: #1461a3; display: inline-flex; border-radius: 30px; height: 40px; width: 160px;">
                <span style="margin: auto; color: #ffffff; font-weight: bold;">COMPRAR AHORA</span>
            </div>
        `;
    document.getElementById("cantidad_a_comprar").value = cantidad_actual;
}

/**Disminuir cantidad */
function less(codigo, stock) {
    var cantidad_actual = parseInt(document.getElementById("cantidad_a_comprar").value);
    if (cantidad_actual === 1) {
        return;
    }
    cantidad_actual = cantidad_actual - 1;
    document.getElementById("vr_ca").innerHTML =
        `
            <div onclick="comprar_ahora(${codigo}, ${cantidad_actual}, ${stock}, 'nuevo');" style="cursor: pointer; border: 1px solid #1461a3; background: #1461a3; display: inline-flex; border-radius: 30px; height: 40px; width: 160px;">
                <span style="margin: auto; color: #ffffff; font-weight: bold;">COMPRAR AHORA</span>
            </div>
        `;
    document.getElementById("cantidad_a_comprar").value = cantidad_actual;
}

/**Mostrar el carrito */

function mostrar_carrito() {
    carrito = JSON.parse(store.getItem("carrito"));
    document.getElementById("subtotal").innerHTML = "<b>Subtotal:</b> S/" + calcular_subtotal();
    $("#items_carrito").html("");
    if (carrito.length === 0) {
        $("#checkout").addClass("hide");
        document.getElementById("items_carrito").innerHTML =
            `
                <li class="collection-item" style="padding: 10px 0px;">
                    <div class="row" style="margin: unset;">
                        <div class="col s12 center-align">
                            <i class="medium material-icons" style="cursor: pointer; color: #0c489a;">remove_shopping_cart</i>
                        </div>
                        <div class="col s12 center-align">
                            <h5 style="color: #0c489a;">Tu carrito de compras est&aacute; vac&iacute;o</h5>
                        </div>
                    </div>                    
                </li>
            `;
    } else {
        $("#checkout").removeClass("hide");
        for (var i = 0; i < carrito.length; i++) {
            document.getElementById("items_carrito").innerHTML +=
                `
                    <li class="collection-item" style="padding: 10px 0px;">
                        <div class="row" style="margin: unset;">
                            <div class="col s4 center-align">
                                <img src="${carrito[i].producto.prod_foto}" alt="${carrito[i].producto.prod_nombre}" title="${carrito[i].producto.prod_nombre}" style="width: 120px;">
                            </div>
                            <div class="col s8 center-align">
                                <p style="font-weight: bold; margin: unset;">${carrito[i].producto.prod_nombre}</p>
                                <p style="margin: unset;">Precio: S/${carrito[i].precio}</p>
                                <p style="margin: unset;">Cantidad: ${carrito[i].cantidad}</p>
                                <p style="margin: unset;">Subtotal: S/${parseFloat(carrito[i].cantidad * carrito[i].precio).toFixed(2)}</p>
                                <div class="row">
                                    <div class="col s12 center-align" style="padding: unset;">
                                        <div style="display: flex; width: 70%; margin: auto; padding: 10px;">
                                            <button class="less_plus" onclick="_less_item(${carrito[i].producto.prod_id}, ${carrito[i].producto.prod_stock}, ${i}, ${carrito[i].precio})">
                                                <i class="material-icons" style="cursor: pointer;">remove</i>
                                            </button>
                                            <input type="number" readonly class="cantidad_a_comprar" id="cantidad_${carrito[i].producto.prod_id}" value="${carrito[i].cantidad}" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                            <button class="less_plus" onclick="_plus_item(${carrito[i].producto.prod_id}, ${carrito[i].producto.prod_stock}, ${i}, ${carrito[i].precio})">
                                                <i class="material-icons" style="cursor: pointer;">add</i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col s12 center-align" style="padding: unset;">
                                        <button class="less_plus" onclick="eliminar_item(${carrito[i].producto.prod_id});"><i class="material-icons" style="cursor: pointer; color: red;">delete</i></button>
                                    </div>
                                </div>
                            </div>
                        </div>                    
                    </li>
                `;
        }
    }
    document.getElementById("abrir_carrito").click();
}

/**Aumentar cantidad en el carrito */
function _plus_item(codigo, stock, index, precio) {
    $("#loader").removeClass("hide_loader");
    $("#items_carrito").addClass("disabled");
    var cantidad_actual = parseInt(document.getElementById("cantidad_" + codigo).value);
    cantidad_actual = cantidad_actual + 1;
    if (cantidad_actual <= stock) {
        document.getElementById("cantidad_" + codigo).value = cantidad_actual;
        carrito.splice(index, 1, { producto: carrito[index].producto, cantidad: cantidad_actual, precio: precio });
        store.setItem("carrito", JSON.stringify(carrito));
        mostrar_carrito();
        setTimeout(function() {
            $("#loader").addClass("hide_loader");
            $("#items_carrito").removeClass("disabled");
        }, 500);
    } else {
        Swal.fire({
            title: "iZi Pedidos",
            icon: "error",
            text: "No hay sufuciente stock, sólo queda(n) " + stock + " unidad(es)",
            showConfirmButton: false,
            timer: 2000
        });
        mostrar_carrito();
        setTimeout(function() {
            $("#loader").addClass("hide_loader");
            $("#items_carrito").removeClass("disabled");
        }, 500);
        return;
    }
}

/**Disminuir cantidad en el carrito */
function _less_item(codigo, stock, index, precio) {
    $("#loader").removeClass("hide_loader");
    $("#items_carrito").addClass("disabled");
    var cantidad_actual = parseInt(document.getElementById("cantidad_" + codigo).value);
    if (cantidad_actual === 1) {
        mostrar_carrito();
        setTimeout(function() {
            $("#loader").addClass("hide_loader");
            $("#items_carrito").removeClass("disabled");
        }, 500);
        return;
    }
    cantidad_actual = cantidad_actual - 1;
    document.getElementById("cantidad_" + codigo).value = cantidad_actual;
    carrito.splice(index, 1, { producto: carrito[index].producto, cantidad: cantidad_actual, precio: precio });
    store.setItem("carrito", JSON.stringify(carrito));
    mostrar_carrito();
    setTimeout(function() {
        $("#loader").addClass("hide_loader");
        $("#items_carrito").removeClass("disabled");
    }, 500);
}

/**Eliminar item del carrito */
function eliminar_item(codigo) {
    $("#loader").removeClass("hide_loader");
    $("#items_carrito").addClass("disabled");
    for (var i = 0; i < carrito.length; i++) {
        if (carrito[i].producto.prod_id == codigo) {
            carrito.splice(i, 1);
            store.setItem("carrito", JSON.stringify(carrito));
            document.getElementById("cantidad_carrito").innerText = carrito.length;
            mostrar_carrito();
            setTimeout(function() {
                $("#loader").addClass("hide_loader");
                $("#items_carrito").removeClass("disabled");
            }, 500);
            return;
        }
    }
}

/**Calcular total del carrito */
function calcular_subtotal() {
    carrito = JSON.parse(store.getItem("carrito"));
    var total = 0;
    for (var i = 0; i < carrito.length; i++) {
        total += (carrito[i].precio * carrito[i].cantidad);
    }
    return parseFloat(total).toFixed(2);
}

/**Checkout */
function checkout() {
    var usuario = []
    if (store.getItem("cliente")) {
        usuario = JSON.parse(store.getItem("cliente"));
        window.location.href = "http://192.168.1.4/piidelo/piidelo_tienda/view/checkout";
    } else {
        signup();
        origen = "carrito";
    }
}

/**Mostrar el carrito en el checkout */
function mostrar_carrito_checkout() {
    $("#carrito_checkout").html("");
    carrito = JSON.parse(store.getItem("carrito"));
    for (var i = 0; i < carrito.length; i++) {
        document.getElementById("carrito_checkout").innerHTML +=
            `
                <li class="collection-item avatar" style="border: unset;">
                    <img src="${carrito[i].producto.prod_foto}" alt="${carrito[i].producto.prod_nombre}" title="${carrito[i].producto.prod_nombre}"class="circle">
                    <span style="font-weight: bold;">${carrito[i].producto.prod_nombre}</span>
                    <p>Cantidad: ${carrito[i].cantidad}</p>
                    <p class="secondary-content" style="color: #000000;">S/${parseFloat(carrito[i].precio).toFixed(2)}</i></p>
                </li>
                <li class="divider"></li>
            `;
    }
    document.getElementById("subtotal_checkout").innerHTML +=
        `
            <li class="collection-item" style="border: unset;">
                <span">Subtotal</span>
                <span class="secondary-content" style="color: #000000;">S/${calcular_subtotal()}</span>
            </li>
            <li class="collection-item" style="border: unset;">
                <span">Costo de env&iacute;o</span>
                <span class="secondary-content" style="color: #000000;">S/<span id="envio_final">0</span></span>
            </li>
            <li class="divider"></li>
        `;
    document.getElementById("total_checkout").innerHTML +=
        `
            <li class="collection-item" style="border: unset;">
                <span style="font-weight: bold;">Total</span>
                <span class="secondary-content" style="color: #000000;"><b>S/<span id="total_final">${calcular_subtotal()}</span></b></span>
            </li>
        `;

}

/**Mostrar datos del usuario */
function mostrar_datos_del_usuario() {
    var cliente = JSON.parse(store.getItem("cliente"));
    document.getElementById("cliente_nombre").innerText = cliente.razon_social;
    document.getElementById("cliente_email").innerText = cliente.email;
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
                var select = document.getElementById("select_departamento_add");
                var option = document.createElement("option");
                option.appendChild(document.createTextNode(departamento.nombre));
                option.value = departamento.codigo;
                select.appendChild(option);
            });

            $("#select_departamento_add").formSelect();
            listar_provincias(departamentos[0].codigo);
        }
    });
}

/**Listar provincias */
function listar_provincias(departamento) {
    var select = document.getElementById("select_provincia_add");
    $("#select_provincia_add").html("");
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

            $("#select_provincia_add").formSelect();
            listar_distritos(provincias[0].codigo);
            // $("#select_distrito_add").change();
        }
    });
}

/**Listar distritos */
function listar_distritos(provincia) {
    var select = document.getElementById("select_distrito_add");
    $("#select_distrito_add").html("");
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
            $("#select_distrito_add").formSelect();
        }
    });
}

/**Calcular toal checkout */
function calcular_total_checkout() {
    var subtotal = parseFloat(calcular_subtotal());
    var envio = parseFloat(document.getElementById("envio_final").innerText);
    var total = parseFloat(subtotal + envio).toFixed(2);
    document.getElementById("total_final").innerText = total;
}