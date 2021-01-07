-- Tabla de usuarios
create table if not exists usuario(
    usu_id int(10) unique not null auto_increment, 
    usu_documento varchar(11) unique not null, 
    usu_password varchar(20) not null, 
    usu_funcion varchar(20) not null, 
    usu_nombre varchar(100) not null, 
    usu_apellidos varchar(100) not null, 
    usu_celular varchar(9) not null,
    usu_estado varchar(20) not null, 
    usu_sesion varchar(20) not null default 'INACTIVO', 
    usu_avatar varchar(100) not null default '../image/interface/avatar.png', 
    constraint usuariopk primary key(usu_id)
);

-- Tabla de notificaciones
create table if not exists notificacion( 
    not_id int(10) unique not null auto_increment, 
    not_asunto varchar(100) not null, 
    not_cuerpo text not null,
    not_fecha datetime not null, 
    not_usu_id int(10) not null, 
    not_tipo varchar(50), 
    constraint notificacionpk primary key(not_id), 
    constraint notificacionfk foreign key(not_usu_id) 
        references usuario(usu_id)
);

-- Tabla de tips
create table if not exists tip(
    tip_id int(10) unique not null auto_increment, 
    tip_titulo varchar(100), 
    tip_descripcion varchar(300), 
    tip_link varchar(300), 
    constraint tippk primary key(tip_id)
);

-- Notificaciones por usuario
create table notificacion_usuario(
    nu_usu_id int(10),
    nu_not_id int(10),
    constraint nu_pk primary key (nu_usu_id, nu_not_id),
    constraint nu_usu_fk foreign key (nu_usu_id) references usuario (usu_id),
    constraint nu_not_fk foreign key (nu_not_id) references notificacion(not_id)
);

-- Tabla de departamentos
create table if not exists departamento(
    dep_id int(10) unique not null auto_increment, 
    dep_nombre varchar(50) not null, 
    constraint departamentopk primary key(dep_id) 
);

-- Tabla de provincias
create table if not exists provincia( 
    provincia_id int(10) unique not null auto_increment, 
    provincia_nombre varchar(50) not null,
    provincia_dep_id int(5) not null, 
    constraint provinciapk primary key(provincia_id), 
    constraint provinciafk foreign key(provincia_dep_id) 
        references departamento(dep_id)
);

-- Tabla de distritos
create table if not exists distrito( 
    distrito_id int(10) unique not null auto_increment, 
    distrito_nombre varchar(50) not null,
    distrito_provincia_id int(10) not null, 
    constraint distritopk primary key(distrito_id), 
    constraint distritofk foreign key(distrito_provincia_id)
        references provincia(provincia_id)
);

-- Tabla de fabricantes
create table if not exists fabricante(
    fab_id int(10) unique not null auto_increment, 
    fab_razon_social varchar(300)not null, 
    fab_ruc varchar(11) not null, 
    fab_direccion varchar(200) not null,
    fab_latitud decimal(9, 7) not null, 
    fab_longitud decimal(9, 7) not null,
    fab_distrito_id int(10) not null, 
    fab_telefono varchar(9) not null, 
    fab_email varchar(100) not null, 
    fab_estado varchar(20) not null, 
    fab_avatar varchar(200) not null default '../image/interface/fabrica.png', 
    fab_usu_id int(10) not null, 
    constraint fabricantepk primary key (fab_id), 
    constraint fabricantefk_1 foreign key(fab_usu_id) 
        references usuario(usu_id), 
    constraint fabricantefk_2 foreign key (fab_distrito_id) 
        references distrito(distrito_id)
);

-- Tabla de distribuidores
create table if not exists distribuidor( 
    dis_id int(10) unique not null auto_increment,
    dis_cod int(4) unique not null, 
    dis_razon_social varchar(300) not null,
    dis_ruc varchar(20) not null, 
    dis_direccion varchar(200) not null, 
    dis_latitud decimal(9, 7) not null, 
    dis_longitud decimal(9, 7) not null, 
    dis_distrito_id int(10) not null, 
    dis_telefono varchar(9) not null,
    dis_email varchar(50) not null, 
    dis_estado varchar(20) not null, 
    dis_avatar varchar(100) not null default '../image/interface/distribuidor.png', 
    dis_usu_id int(10) not null,
    constraint distribuidorpk primary key(dis_id), 
    constraint distribuidorfk_1 foreign key(dis_usu_id) 
        references usuario(usu_id), 
    constraint distribuidorfk_2 foreign key(dis_distrito_id) 
        references distrito(distrito_id)
);

-- Tabla de vendedores
create table if not exists vendedor( 
    ven_id int(10) unique not null auto_increment, 
    ven_documento varchar(20) not null, 
    ven_apellidos varchar(100) not null, 
    ven_nombres varchar(100) not null, 
    ven_dis_id int(10) not null,
    constraint vendedorpk primary key(ven_id), 
    constraint vendedorfk foreign key(ven_dis_id) 
        references distribuidor(dis_id)
);

-- Tabla de categorias
create table if not exists categoria( 
    cat_id int(10) unique not null auto_increment, 
    cat_nombre varchar(100) not null, 
    cat_tipo varchar(15) not null, 
    cat_foto varchar(100) not null default '../image/interface/categoria.png', 
    cat_padre int(10), 
    constraint categoriapk primary key(cat_id), 
    constraint tipo check( cat_tipo = "CATEGORIA" or cat_tipo = "SUBCATEGORIA" )
);

-- Tabla de productos
create table if not exists producto( 
    pro_id int(10) unique not null auto_increment, 
    pro_nombre varchar(100) not null,
    pro_marca varchar(100), 
    pro_mostrar varchar(1), 
    pro_fab_id int(10) not null,
    pro_cat_id int(10) not null, 
    pro_estado varchar(20) not null, 
    pro_foto varchar(100) not null default '../image/interface/productos.png', 
    constraint productopk primary key(pro_id), 
    constraint productofk_1 foreign key(pro_cat_id)
        references categoria(cat_id), 
    constraint productofk_2 foreign key(pro_fab_id)
        references fabricante(fab_id)
);

-- Tabla de productos por distribuidor
create table if not exists producto_distribuidor(
    pd_pro_id int(10), 
    pd_dis_id int(10), 
    pro_stock int(10) not null, 
    pro_precio_venta decimal(9, 2) not null, 
    pro_precio_oferta decimal(9, 2), 
    pro_precio_sugerido decimal(9, 2), 
    oferta_fecha_inicio date,
    oferta_fecha_fin date, 
    pro_estado varchar(10), 
    pro_oferta_especial varchar(2),
    constraint pdpk primary key(pd_pro_id, pd_dis_id), 
    constraint pdfk_1 foreign key(pd_pro_id) 
        references producto(pro_id), 
    constraint pdfk_2 foreign key(pd_dis_id) 
        references distribuidor(dis_id) 
);

-- Tabla de kardex
create table if not exists kardex(
    kar_id int(10) unique not null auto_increment, 
    kar_movimiento varchar(30) not null, 
    kar_fecha datetime not null, 
    kar_stock_inicial int(10) not null,
    kar_stock_movimiento int(10) not null, 
    kar_stock_final int(10) not null,
    kar_factura_lote varchar(60), 
    kar_fecha_vencimiento date, 
    kar_usu_id int(10) not null, 
    kar_pro_id int(10) not null, 
    kar_dis_id int(10), 
    constraint kardexpk primary key(kar_id), 
    constraint kardexfk_1 foreign key(kar_pro_id) 
        references producto (pro_id), 
    constraint kardexfk_2 foreign key(kar_usu_id) 
        references usuario(usu_id), 
    constraint kardexfk_3 foreign key(kar_dis_id)
        references distribuidor(dis_id)
);

-- Tabla de zonas
create table if not exists zona( 
    zon_id int(10) unique not null auto_increment, 
    zon_nombre varchar(200) not null, 
    zon_fab_id int(10) not null, 
    zon_dis_id int(10) not null, 
    constraint zonapk primary key(zon_id), 
    constraint zonafk_1 foreign key(zon_fab_id) 
        references fabricante(fab_id), 
    constraint zonafk_2 foreign key(zon_dis_id) 
        references distribuidor(dis_id)
);

-- Tabla de rutas
create table if not exists ruta(
    ruta_id int(10) unique not null auto_increment, 
    ruta_nombre varchar(200) not null, 
    ruta_lunes varchar(2) not null, 
    ruta_martes varchar(2) not null, 
    ruta_miercoles varchar(2) not null,
    ruta_jueves varchar(2) not null, 
    ruta_viernes varchar(2) not null, 
    ruta_sabado varchar(2) not null, 
    ruta_domingo varchar(2) not null, 
    ruta_dis_id int(10), 
    constraint rutapk primary key(ruta_id), 
    constraint rutafk foreign key(ruta_dis_id) 
        references distribuidor(dis_id)
);

-- Tabla de bodegueros
create table if not exists bodeguero( 
    bod_id int(10) unique not null auto_increment, 
    bod_cod varchar(5) unique not null, 
    bod_razon_social varchar(300) not null, 
    bod_ruc varchar(11) not null, 
    bod_comprobante varchar(20) not null, 
    bod_direccion varchar(200) not null, 
    bod_ruta varchar(200), 
    bod_latitud decimal(9, 7) not null, 
    bod_longitud decimal(9, 7) not null, 
    bod_distrito_id int(10) not null, 
    bod_usu_id int(10) not null, 
    bod_estado varchar(20) not null, 
    bod_avatar varchar(100) not null default '../image/interface/tienda.png', 
    constraint bodegueropk primary key(bod_id), 
    constraint bodeguerofk_2 foreign key(bod_usu_id) 
        references usuario(usu_id), 
    constraint bodeguerofk_3 foreign key(bod_distrito_id) 
        references distrito(distrito_id)
);

-- Tabla de vendedores por bodeguero
create table if not exists bodeguero_vendedor(
    bv_id_bodeguero int(10) not null, 
    bv_id_vendedor int(10) not null,
    bv_fecha_creacion date not null, 
    constraint bvpk primary key(bv_id_bodeguero, bv_id_vendedor), 
    constraint bvfk_1 foreign key(bv_id_bodeguero) 
        references bodeguero(bod_id), 
    constraint bvfk_2 foreign key(bv_id_vendedor) 
        references vendedor(ven_id)
);

-- Tabla de rutas por bodeguero
create table if not exists ruta_bodeguero( 
    rt_ruta_id int(10) not null, 
    rt_bod_id int(10) not null, 
    constraint rtpk primary key(rt_ruta_id, rt_bod_id), 
    constraint rtfk_1 foreign key(rt_ruta_id) 
        references ruta(ruta_id), 
    constraint rtfk_2 foreign key(rt_bod_id) 
        references vendedor(ven_id)
);

-- Tabla de bodegueros por distribuidor
create table if not exists bodeguero_distribuidor( 
    bd_bod_id int(10) not null, 
    bd_dis_id int(10) not null, 
    bd_linea_credito decimal(9, 2) not null, 
    monto_minimo decimal(9, 2), 
    constraint bdpk primary key(bd_bod_id, bd_dis_id), 
    constraint bdfk_1 foreign key(bd_bod_id) 
        references bodeguero(bod_id), 
    constraint bdfk_2 foreign key(bd_dis_id) 
        references distribuidor(dis_id)
);

-- Tabla grande
create table if not exists bodeguero_zona_distribuidor_fabricante(
    bzdf_id_bod int(10) not null, 
    bzdf_id_dis int(10) not null, 
    bzdf_id_zon int(10) not null, 
    bzdf_id_fab int(10) not null, 
    constraint bzdfpk primary key(bzdf_id_bod, bzdf_id_fab), 
    constraint bzdffk_1 foreign key(bzdf_id_bod)
        references bodeguero(bod_id), 
    constraint bzdffk_2 foreign key(bzdf_id_dis)
        references distribuidor(dis_id), 
    constraint bzdffk_3 foreign key(bzdf_id_zon)
        references zona(zon_id), 
    constraint bzdffk_4 foreign key(bzdf_id_fab)
        references fabricante(fab_id) 
);

-- Tabla de grupo de pedidos
create table if not exists grupo_pedido(
    gp_id int(10) unique not null auto_increment, 
    gp_total decimal(9, 2), 
    gp_bod_id int(10), 
    constraint gp_bod_id_fk foreign key(gp_bod_id) 
        references bodeguero(bod_id), 
    constraint gppk primary key(gp_id) 
);

-- Tabla de pedidos
create table if not exists pedido( 
    ped_id int(10) unique not null auto_increment,
    ped_fecha_solicitud datetime not null, 
    ped_fecha_limite datetime not null,
    ped_fecha_entregado datetime, 
    ped_estado varchar(50) not null, 
    ped_subtotal decimal(9, 2) not null, 
    ped_igv decimal(9, 2) not null, 
    ped_total decimal(9,2) not null, 
    ped_forma_pago varchar(50) not null, 
    ped_bod_id int(10) not null,
    ped_dis_id int(10) not null, 
    ped_ven_id int(10) not null, 
    ped_gp_id int(10),
    constraint pedidopk primary key(ped_id), 
    constraint pedidofk_1 foreign key(ped_bod_id) 
        references bodeguero(bod_id), 
    constraint pedidofk_2 foreign key(ped_dis_id) 
        references distribuidor(dis_id), 
    constraint pedidofk_3 foreign key(ped_gp_id) 
        references grupo_pedido(gp_id), 
    constraint pedidofk_4 foreign key(ped_ven_id) 
        references vendedor(ven_id) 
);

-- Tabla de detalle de pedido
create table if not exists detalle_pedido( 
    dp_id int(10) unique not null auto_increment, 
    dp_cantidad int(10) not null, 
    dp_precio decimal(9, 2) not null, 
    dp_subtotal decimal(9, 2) not null, 
    dp_ped_id int(10) not null, 
    dp_pro_id int(10) not null, 
    constraint dppk primary key(dp_id), 
    constraint dppedfk foreign key(dp_ped_id) 
        references pedido(ped_id), 
    constraint dpprofk foreign key(dp_pro_id) 
        references producto(pro_id)
);

-- Tabla de distribuidores por fabricante
create table if not exists fabricante_distribuidor( 
    fd_fab_id int(10) not null, 
    fd_dis_id int(10) not null, 
    fd_pedido_minimo decimal(9, 2),
    constraint fdpk primary key(fd_fab_id, fd_dis_id), 
    constraint fdfk_1 foreign key(fd_fab_id) 
        references fabricante(fab_id), 
    constraint fdfk_2 foreign key(fd_dis_id) 
        references distribuidor(dis_id)
);

-- Tabla de numeracion legal
create table if not exists numeracion_legal(
    nl_id int(10) unique not null auto_increment, 
    nl_id_dis int(10) not null,
    nl_codigo varchar(20) not null, 
    nl_descripcion varchar(50) not null, 
    nl_serie varchar(10) not null, 
    nl_tipo varchar(2) not null, 
    nl_correlativo_inicial int(10) not null, 
    nl_correlativo_actual int(10) not null,
    nl_correlativo_final int(10) not null, 
    nl_estado varchar(10) not null,
    constraint nlpk primary key(nl_id), 
    constraint nlfk foreign key(nl_id_dis) 
        references distribuidor(dis_id)
);

-- Tabla de ofertas textuales
create table if not exists oferta(
    of_id int(10) unique not null auto_increment,
    of_cuerpo text not null, 
    of_fecha_inicio date, 
    of_fecha_fin date, 
    of_dis_id int(10) not null, 
    constraint ofpx primary key(of_id), 
    constraint offk foreign key(of_dis_id) 
        references distribuidor(dis_id)
);

-- Tabla de configuración
create table if not exists configuracion(
    conf_id int(10) unique not null auto_increment, 
    conf_tipo varchar(50),
    conf_detalle varchar(50),
    constraint confpk primary key(conf_id)
);

-- Tabla de PSE
create table if not exists pse(
    ps_id int(10) unique not null auto_increment, 
    ps_nombre varchar(100),
    ps_link_boleta varchar(100), 
    ps_link_factura varchar(100), 
    constraint pspk primary key(ps_id)
);

-- Tabla de pse por distribuidor
create table if not exists pse_distribuidor(
    pse_dis_pse_id int(10) not null, 
    pse_dis_dis_id int(10) not null,
    pse_dis_usuario varchar(100) not null, 
    pse_dis_clave varchar(100) not null,
    pse_dis_token varchar(1000), 
    constraint pse_dis_pk primary key(pse_dis_pse_id, pse_dis_dis_id), 
    constraint pse_dis_fk_1 foreign key(pse_dis_pse_id) 
        references pse(ps_id), 
    constraint pse_dis_fk_2 foreign key (pse_dis_dis_id) 
        references distribuidor(dis_id)
);

-- Tabla de grupo de pedido de fabricantes
create table if not exists grupo_pedido_fd( 
    gpfd_id int(10) not null auto_increment, 
    gpfd_total decimal(9, 2) not null,
    gpfd_dis_id int(10) not null, 
    constraint gpfd_pk primary key(gpfd_id),
    constraint gpfd_fk foreign key(gpfd_dis_id) 
        references distribuidor(dis_id)
);

-- Tabla de pedidos de fabricantes
create table if not exists pedido_fd( 
    pfd_id int(10) not null auto_increment,
    pfd_fecha_solicitud date, 
    pfd_fecha_limite date, 
    pfd_fecha_entregado date,
    pfd_estado varchar(50) not null, 
    pfd_subtotal decimal(9, 2) not null, 
    pfd_igv decimal(9, 2) not null, 
    pfd_total decimal(9, 2) not null, 
    pfd_forma_pago varchar(50), 
    pfd_comprobante varchar(50), 
    pfd_fab_id int(10) not null,
    pfd_dis_id int(10) not null, 
    pfd_gpfd_id int(10), 
    constraint pfd_pk primary key(pfd_id), 
    constraint pfd_fk_1 foreign key(pfd_dis_id) 
        references distribuidor(dis_id), 
    constraint pfd_fk_2 foreign key(pfd_fab_id) 
        references fabricante(fab_id)
);

-- Tabla de detalle de pedidos de fabricantes
create table if not exists detalle_pedido_fd( 
    dpfd_id int(10) unique not null auto_increment, 
    dpfd_cantidad int(10) not null,
    dpfd_precio decimal(9, 2) not null, 
    dpfd_subtotal decimal(9, 2) not null,
    dpfd_ped_id int(10) not null, 
    dpfd_pro_id int(10) not null, 
    constraint dpfdpk primary key(dpfd_id), 
    constraint dpfdfk_1 foreign key(dpfd_ped_id) 
        references pedido_fd(pfd_id), 
    constraint dpfdfk_2 foreign key(dpfd_pro_id) 
        references producto(pro_id)
);

-- Tabla de productos por fabricantes
create table if not exists producto_fabricante( 
    pf_pro_id int(10) not null, 
    pf_fab_id int(10) not null, 
    pf_stock int(10) not null,
    pf_precio_compra decimal(9, 1) not null, 
    pf_precio_venta decimal(9, 2) not null, 
    pf_precio_oferta decimal(9, 2), 
    pf_oferta_inicio date, 
    pf_oferta_fin date, 
    pf_nuevo varchar(2),
    pf_estado varchar(10), 
    constraint pfpk primary key(pf_pro_id, pf_fab_id), 
    constraint pffk_1 foreign key(pf_pro_id) 
        references producto(pro_id), 
    constraint pffk_2 foreign key(pf_fab_id) 
        references fabricante(fab_id)
);

-- Tabla de sliders
create table if not exists publicidad_fabricante( 
    pf_id int(10) unique auto_increment not null, 
    pf_slider longtext,
    pf_fecha_inicio date not null, 
    pf_fecha_fin date not null,
    pf_fab_id int(10) not null,
    constraint pfpk primary key(pf_id), 
    constraint pffk foreign key(pf_fab_id)
        references fabricante(fab_id)
);