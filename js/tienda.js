var rutcon = "../config/",
    rutview = "../view/",
    store = localStorage;
var parametros, distribuidor;



/**-------------------------------------------- INDEX -------------------------------------------- */
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
            productos = JSON.parse(resultado);
            for (var i = 0; i < productos.length; i++) {
                document.getElementById("favoritos_del_mes").innerHTML +=
                    `<div class="col s12 m6 l4 xl4" style="margin: 10px 0px;">

                        <div class="card" style="min-height: 500px; max-height: 500px; height: 500px; width: 100%; box-shadow: unset; position: relative;">
                            <div class="card-image">
                                <img src="${productos[i].prod_foto}" title="${productos[i].prod_nombre}" alt="${productos[i].prod_nombre}" style="height: 400px; width: 350px; margin: auto;">
                            </div>
                            <div class="card-content" style="text-align: center; padding: unset;">
                                <p style="font-weight: bold;">${productos[i].prod_nombre}</p>
                                <p>S/${productos[i].prod_precio_regular}</p>
                                <div class="row" style="width: 100%; margin: unset;">
                                    <div class="col s6 m6 l6 xl6" style="margin: 5px 0px 5px 0px;">
                                        <button id="btn_vista_rapida${productos[i].prod_id}" onmouseenter="btn_vista_rapida_enter(${productos[i].prod_id});" onmouseleave="btn_vista_rapidaleave(${productos[i].prod_id});" href="#modal_vista_rapida" onclick='vista_rapida(${JSON.stringify(productos[i])})' class="btn modal-trigger button_vr_ca" style="color: black; font-weight: bold; font-family: 'Quicksand'; text-transform: none;">
                                            <i class="material-icons">remove_red_eye</i>
                                        </button>
                                    </div>
                                    <div class="col s6 m6 l6 xl6" style="margin: 5px 0px 5px 0px;">
                                        <button id="btn_comprar_ahora${productos[i].prod_id}" onmouseenter="btn_comprar_ahora_enter(${productos[i].prod_id});" onmouseleave="btn_comprar_ahora_leave(${productos[i].prod_id});" onclick="comprar_ahora(${productos[i].prod_id}, 1, ${productos[i].prod_stock})" class="btn button_vr_ca" style="color: black; font-weight: bold; font-family: 'Quicksand'; text-transform: none;">
                                            <i class="material-icons">add_shopping_cart</i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                    </div>`;
            }
            var longitud = productos.length;
            if (longitud > 0) {
                $("#titulo_favoritos").html("Favoritos del mes");
            }
        }
    });
}

/**Productos nuevos */
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
            productos = JSON.parse(resultado);
            for (var i = 0; i < productos.length; i++) {
                document.getElementById("nuevos").innerHTML +=
                    `<div class="col s12 m6 l4 xl4" style="margin: 10px 0px;">
                        
                        <div class="card" style="min-height: 500px; max-height: 500px; height: 500px; box-shadow: unset;">
                            <div class="card-image">
                                <img src="${productos[i].prod_foto}" title="${productos[i].prod_nombre}" alt="${productos[i].prod_nombre}" style="height: 400px; width: 350px; margin: auto;">
                            </div>
                            <div class="card-content" style="text-align: center; padding: unset;">
                                <p style="font-weight: bold;">${productos[i].prod_nombre}</p>
                                <p>S/${productos[i].prod_precio_regular}</p>
                                <div class="row" style="width: 100%; margin: unset;">
                                    <div class="col s6 m6 l6 xl6" style="margin: 5px 0px 5px 0px;">
                                        <button id="btn_vista_rapida${productos[i].prod_id}" onmouseenter="btn_vista_rapida_enter(${productos[i].prod_id});" onmouseleave="btn_vista_rapidaleave(${productos[i].prod_id});" href="#modal_vista_rapida" onclick='vista_rapida(${JSON.stringify(productos[i])})' class="btn modal-trigger button_vr_ca" style="color: black; font-weight: bold; font-family: 'Quicksand'; text-transform: none;">
                                            <i class="material-icons">remove_red_eye</i>
                                        </button>
                                    </div>
                                    <div class="col s6 m6 l6 xl6" style="margin: 5px 0px 5px 0px;">
                                        <button id="btn_comprar_ahora${productos[i].prod_id}" onmouseenter="btn_comprar_ahora_enter(${productos[i].prod_id});" onmouseleave="btn_comprar_ahora_leave(${productos[i].prod_id});" onclick="comprar_ahora(${productos[i].prod_id}, 1, ${productos[i].prod_stock})" class="btn button_vr_ca" style="color: black; font-weight: bold; font-family: 'Quicksand'; text-transform: none;">
                                            <i class="material-icons">add_shopping_cart</i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                    </div>`;
            }
            var longitud = productos.length;
            if (longitud > 0) {
                $("#titulo_nuevos").html("Nuevos");
            }
        }
    });
}

/**Ofertas */
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
            productos = JSON.parse(resultado);
            for (var i = 0; i < productos.length; i++) {
                document.getElementById("ofertas").innerHTML +=
                    `<div class="col s12 m6 l4 xl4" style="margin: 10px 0px;">

                        <div class="card" style="min-height: 500px; max-height: 500px; height: 500px; width: 100%; box-shadow: unset; position: relative;">
                            <div class="card-image">
                                <img src="${productos[i].prod_foto}" title="${productos[i].prod_nombre}" alt="${productos[i].prod_nombre}" style="height: 400px; width: 350px; margin: auto;">
                            </div>
                            <div class="card-content" style="text-align: center; padding: unset;">
                                <p style="font-weight: bold;">${productos[i].prod_nombre}</p>
                                <p>S/${productos[i].prod_precio_regular}</p>
                                <div class="row" style="width: 100%; margin: unset;">
                                    <div class="col s6 m6 l6 xl6" style="margin: 5px 0px 5px 0px;">
                                        <button id="btn_vista_rapida${productos[i].prod_id}" onmouseenter="btn_vista_rapida_enter(${productos[i].prod_id});" onmouseleave="btn_vista_rapidaleave(${productos[i].prod_id});" href="#modal_vista_rapida" onclick='vista_rapida(${JSON.stringify(productos[i])})' class="btn modal-trigger button_vr_ca" style="color: black; font-weight: bold; font-family: 'Quicksand'; text-transform: none;">
                                            <i class="material-icons">remove_red_eye</i>
                                        </button>
                                    </div>
                                    <div class="col s6 m6 l6 xl6" style="margin: 5px 0px 5px 0px;">
                                        <button id="btn_comprar_ahora${productos[i].prod_id}" onmouseenter="btn_comprar_ahora_enter(${productos[i].prod_id});" onmouseleave="btn_comprar_ahora_leave(${productos[i].prod_id});" onclick="comprar_ahora(${productos[i].prod_id}, 1, ${productos[i].prod_stock})" class="btn button_vr_ca" style="color: black; font-weight: bold; font-family: 'Quicksand'; text-transform: none;">
                                            <i class="material-icons">add_shopping_cart</i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                </div>`;
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
                            document.getElementById("favoritos_del_mes").innerHTML +=
                                `<div class="col s12 m6 l4 xl4" style="margin: 10px 0px;">
    
                                        <div class="card" style="min-height: 500px; max-height: 500px; height: 500px; width: 100%; box-shadow: unset; position: relative;">
                                            <div class="card-image">
                                                <img src="${productos[i].prod_foto}" title="${productos[i].prod_nombre}" alt="${productos[i].prod_nombre}" style="height: 400px; width: 350px; margin: auto;">
                                            </div>
                                            <div class="card-content" style="text-align: center; padding: unset;">
                                                <p style="font-weight: bold;">${productos[i].prod_nombre}</p>
                                                <p>S/${productos[i].prod_precio_regular}</p>
                                                <div class="row" style="width: 100%; margin: unset;">
                                                    <div class="col s6 m6 l6 xl6" style="margin: 5px 0px 5px 0px;">
                                                        <button id="btn_vista_rapida${productos[i].prod_id}" onmouseenter="btn_vista_rapida_enter(${productos[i].prod_id});" onmouseleave="btn_vista_rapidaleave(${productos[i].prod_id});" href="#modal_vista_rapida" onclick='vista_rapida(${JSON.stringify(productos[i])})' class="btn modal-trigger button_vr_ca" style="color: black; font-weight: bold; font-family: 'Quicksand'; text-transform: none;">
                                                            <i class="material-icons">remove_red_eye</i>
                                                        </button>
                                                    </div>
                                                    <div class="col s6 m6 l6 xl6" style="margin: 5px 0px 5px 0px;">
                                                        <button id="btn_comprar_ahora${productos[i].prod_id}" onmouseenter="btn_comprar_ahora_enter(${productos[i].prod_id});" onmouseleave="btn_comprar_ahora_leave(${productos[i].prod_id});" onclick="comprar_ahora(${productos[i].prod_id}, 1, ${productos[i].prod_stock} )" class="btn button_vr_ca" style="color: black; font-weight: bold; font-family: 'Quicksand'; text-transform: none;">
                                                            <i class="material-icons">add_shopping_cart</i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
        
                                    </div>`;
                            break;
                        case "Nuevo":
                            document.getElementById("nuevos").innerHTML +=
                                `<div class="col s12 m6 l4 xl4" style="margin: 10px 0px;">
    
                                        <div class="card" style="min-height: 500px; max-height: 500px; height: 500px; width: 100%; box-shadow: unset; position: relative;">
                                            <div class="card-image">
                                                <img src="${productos[i].prod_foto}" title="${productos[i].prod_nombre}" alt="${productos[i].prod_nombre}" style="height: 400px; width: 350px; margin: auto;">
                                            </div>
                                            <div class="card-content" style="text-align: center; padding: unset;">
                                                <p style="font-weight: bold;">${productos[i].prod_nombre}</p>
                                                <p>S/${productos[i].prod_precio_regular}</p>
                                                <div class="row" style="width: 100%; margin: unset;">
                                                    <div class="col s6 m6 l6 xl6" style="margin: 5px 0px 5px 0px;">
                                                        <button id="btn_vista_rapida${productos[i].prod_id}" onmouseenter="btn_vista_rapida_enter(${productos[i].prod_id});" onmouseleave="btn_vista_rapidaleave(${productos[i].prod_id});" href="#modal_vista_rapida" onclick='vista_rapida(${JSON.stringify(productos[i])})' class="btn modal-trigger button_vr_ca" style="color: black; font-weight: bold; font-family: 'Quicksand'; text-transform: none;">
                                                            <i class="material-icons">remove_red_eye</i>
                                                        </button>
                                                    </div>
                                                    <div class="col s6 m6 l6 xl6" style="margin: 5px 0px 5px 0px;">
                                                        <button id="btn_comprar_ahora${productos[i].prod_id}" onmouseenter="btn_comprar_ahora_enter(${productos[i].prod_id});" onmouseleave="btn_comprar_ahora_leave(${productos[i].prod_id});" onclick="comprar_ahora(${productos[i].prod_id}, 1, ${productos[i].prod_stock} )" class="btn button_vr_ca" style="color: black; font-weight: bold; font-family: 'Quicksand'; text-transform: none;">
                                                            <i class="material-icons">add_shopping_cart</i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            
                                    </div>`;
                            break;
                        case "Oferta":
                            document.getElementById("ofertas").innerHTML +=
                                `<div class="col s12 m6 l4 xl4" style="margin: 10px 0px;">
    
                                        <div class="card" style="min-height: 500px; max-height: 500px; height: 500px; width: 100%; box-shadow: unset; position: relative;">
                                            <div class="card-image">
                                                <span style="background: #ff5722; z-index: 1; width: 100px; position: absolute;" class="btn pulse">OFERTA</span>
                                                <img src="${productos[i].prod_foto}" title="${productos[i].prod_nombre}" alt="${productos[i].prod_nombre}" style="height: 400px; width: 350px; margin: auto;">
                                            </div>
                                            <div class="card-content" style="text-align: center; padding: unset;">
                                                <p style="font-weight: bold;">${productos[i].prod_nombre}</p>
                                                <p>S/${productos[i].prod_precio_regular}</p>
                                                <div class="row" style="width: 100%; margin: unset;">
                                                    <div class="col s6 m6 l6 xl6" style="margin: 5px 0px 5px 0px;">
                                                        <button id="btn_vista_rapida${productos[i].prod_id}" onmouseenter="btn_vista_rapida_enter(${productos[i].prod_id});" onmouseleave="btn_vista_rapidaleave(${productos[i].prod_id});" href="#modal_vista_rapida" onclick='vista_rapida(${JSON.stringify(productos[i])})' class="btn modal-trigger button_vr_ca" style="color: black; font-weight: bold; font-family: 'Quicksand'; text-transform: none;">
                                                            <i class="material-icons">remove_red_eye</i>
                                                        </button>
                                                    </div>
                                                    <div class="col s6 m6 l6 xl6" style="margin: 5px 0px 5px 0px;">
                                                        <button id="btn_comprar_ahora${productos[i].prod_id}" onmouseenter="btn_comprar_ahora_enter(${productos[i].prod_id});" onmouseleave="btn_comprar_ahora_leave(${productos[i].prod_id});" onclick="comprar_ahora(${productos[i].prod_id}, 1, ${productos[i].prod_stock} )" class="btn button_vr_ca" style="color: black; font-weight: bold; font-family: 'Quicksand'; text-transform: none;">
                                                            <i class="material-icons">add_shopping_cart</i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            
                                </div>`;
                            break;
                    }
                }
            }
        });
    });
}

/**Cambiar contenido de los botones */
/**Vista rápida */
function btn_vista_rapida_enter(id) {
    document.getElementById("btn_vista_rapida" + id).style.background = `#000000`;
    document.getElementById("btn_vista_rapida" + id).style.color = `#ffffff`;
    document.getElementById("btn_vista_rapida" + id).innerHTML = `Vista rápida `;
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

/**Vista rápida */
function vista_rapida(producto) {

    document.getElementById("foto").src = producto.prod_foto;
    document.getElementById("nombre").innerHTML = producto.prod_nombre;
    document.getElementById("descripcion").innerHTML = producto.prod_descripcion;
    document.getElementById("precio_regular").innerHTML = "S/" + producto.prod_precio_regular;
    document.getElementById("less_and_add").innerHTML =
        `
        <button class="less_plus"><i class="material-icons" style="cursor: pointer;" onclick="less(${producto.prod_id}, ${producto.prod_stock});">delete</i></button>
        <input type="number" class="cantidad_a_comprar" id="cantidad_a_comprar" value="1" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
        <button class="less_plus"><i class="material-icons" style="cursor: pointer;" onclick="plus(${producto.prod_id}, ${producto.prod_stock});">add</i></button>
        `;
    document.getElementById("vr_ca").innerHTML = `<span onclick="comprar_ahora(${producto.prod_id}, ${parseInt(document.getElementById("cantidad_a_comprar").value)}, ${producto.prod_stock});" style="cursor: pointer; margin: auto; color: #ffffff; font-weight: bold;">COMPRAR AHORA</span>`;
    var detalles = JSON.parse(producto.prod_detalles);
    document.getElementById("detalles").innerHTML = "";
    for (var i = 0; i < detalles.length; i++) {
        if (detalles[i].detalle === "none") {
            document.getElementById("detalles").innerHTML +=
                `<tr id=${i} style="border: unset;">
                    <td colspan="2">No hay información adicional sobre este producto</td>
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
        document.getElementById("vr_ca").innerHTML = `<span onclick="comprar_ahora(${producto.prod_id}, ${$("#cantidad_a_comprar").val()}, ${producto.prod_stock});" style="cursor: pointer; margin: auto; color: #ffffff; font-weight: bold;">COMPRAR AHORA</span>`
    });
}


/**Comprar ahora */
var carrito = [];

function comprar_ahora(codigo, cantidad, stock) {
    parametros = {
        metodo: "LeerProducto",
        producto: codigo
    };
    $.ajax({
        url: "config/producto/producto",
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
                document.getElementById("close_vista_rapida").click();
                if (carrito.length === 0) {
                    carrito.push({ producto: producto, cantidad: cantidad, precio: parseFloat(precio) });
                    document.getElementById("cantidad_carrito").innerText = carrito.length;
                    mostrar_carrito();
                } else {
                    for (var i = 0; i < carrito.length; i++) {
                        if (carrito[i].producto.prod_id == codigo) {
                            carrito.splice(i, 1, { producto: carrito[i].producto, cantidad: (carrito[i].cantidad + cantidad), precio: precio });
                            mostrar_carrito();
                            return;
                        }
                    }
                    carrito.push({ producto: producto, cantidad: cantidad, precio: precio });
                    document.getElementById("cantidad_carrito").innerText = carrito.length;
                    mostrar_carrito();
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
    document.getElementById("vr_ca").innerHTML = `<span onclick="comprar_ahora(${codigo}, ${cantidad_actual}, ${stock});" style="cursor: pointer; margin: auto; color: #ffffff; font-weight: bold;">COMPRAR AHORA</span>`
    document.getElementById("cantidad_a_comprar").value = cantidad_actual;
}

/**Disminuir cantidad */
function less(codigo, stock) {
    var cantidad_actual = parseInt(document.getElementById("cantidad_a_comprar").value);
    if (cantidad_actual === 1) {
        return;
    }
    cantidad_actual = cantidad_actual - 1;
    document.getElementById("vr_ca").innerHTML = `<span onclick="comprar_ahora(${codigo}, ${cantidad_actual}, ${stock});" style="cursor: pointer; margin: auto; color: #ffffff; font-weight: bold;">COMPRAR AHORA</span>`
    document.getElementById("cantidad_a_comprar").value = cantidad_actual;
}

/**Mostrar el carrito */

function mostrar_carrito() {
    console.log(carrito);
    document.getElementById("subtotal").innerHTML = "<b>Subtotal:</b> S/" + calcular_total();
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
                                            <input type="number" class="cantidad_a_comprar" id="cantidad_${carrito[i].producto.prod_id}" value="${carrito[i].cantidad}" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                            <button class="less_plus" onclick="_plus_item(${carrito[i].producto.prod_id}, ${carrito[i].producto.prod_stock}, ${i}, ${carrito[i].precio})">
                                                <i class="material-icons" style="cursor: pointer;">add</i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col s12 center-align" style="padding: unset;">
                                        <button class="less_plus"><i class="material-icons" style="cursor: pointer; color: red;" onclick="eliminar_item(${carrito[i].producto.prod_id});">delete</i></button>
                                    </div>
                                </div>
                            </div>
                        </div>                    
                    </li>
                `;
        }
    }
    document.getElementById("abrir").click();
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
function calcular_total() {
    var total = 0;
    for (var i = 0; i < carrito.length; i++) {
        total += (carrito[i].precio * carrito[i].cantidad);
    }
    return parseFloat(total).toFixed(2);
}