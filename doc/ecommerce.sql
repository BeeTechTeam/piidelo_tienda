create table if not exists departamento(
    dep_id int(10) unique not null auto_increment,
    dep_nombre varchar(100) not null,
    constraint deppk primary key(dep_id)
);

create table if not exists provincia(
    provi_id int(10) unique not null auto_increment,
    provi_nombre varchar(100) not null,
    provi_departamento int(10) not null,
    constraint provipk primary key(provi_id),
    constraint provifk foreign key(provi_departamento)
        references departamento(dep_id)
);

create table if not exists distrito(
    dis_id int(10) unique not null auto_increment,
    dis_nombre varchar(100) not null,
    dis_provincia int(10) not null,
    dis_ubigeo varchar(10),
    dis_delivery decimal(9, 2), 
    constraint dispk primary key(dis_id),
    constraint disfk foreign key(dis_provincia)
        references provincia(provi_id)
);

create table if not exists proveedor(
    prove_id int(10) unique not null auto_increment,
    prove_ruc varchar(11) not null,
    prove_razon_social varchar(100) not null,
    prove_telefono varchar(9),
    prove_email varchar(50),
    prove_foto varchar(200),
    prove_direccion varchar(100) not null,
    prove_estado varchar(10) not null,
    prove_distrito int(10) not null,
    constraint provepk primary key(prove_id),
    constraint provefk foreign key(prove_distrito)
        references distrito(dis_id)
);

create table if not exists cliente(
    cli_id int(10) unique not null auto_increment,
    cli_ruc varchar(11) null,
    cli_razon_social varchar(100) not null,
    cli_telefono varchar(9),
    cli_email varchar(50),
    cli_foto varchar(200),
    cli_direccion varchar(100) null,
    cli_estado varchar(10) not null,
    -- cli_distrito int(10) null,
    constraint clipk primary key(cli_id)
    -- constraint clifk foreign key(cli_distrito)
    --     references distrito(dis_id)
);

create table if not exists direccion(
    dir_id int(10) unique not null auto_increment,
    dir_nombres varchar(100) not null,
    dir_dni varchar(8) not null,
    dir_telefono varchar(9) not null,
    dir_direccion varchar(200) not null,
    dir_latitud float,
    dir_longitud float,
    dir_estado varchar(20) not null,
    dir_distrito int(10) not null,
    dir_cliente int(10) not null,
    constraint dir_pk primary key(dir_id),
    constraint dirfk1 foreign key(dir_distrito)
        references distrito(dis_id),
    constraint dirfk2 foreign key(dir_cliente)
        references cliente(cli_id)
);

create table if not exists usuario(
    usu_id int(10) unique not null auto_increment,
    usu_nombres varchar(100) not null,
    usu_apellidos varchar(100) not null,
    usu_usuario varchar(100) not null,
    usu_password varchar(20) not null,
    usu_foto varchar(100) null,
    usu_estado varchar(10) not null,
    usu_funcion varchar(20) not null,
    usu_proveedor int(10),
    usu_cliente int(10),
    constraint usupk primary key(usu_id),
    constraint usufk1 foreign key(usu_proveedor)
        references proveedor(prove_id),
    constraint usufk2 foreign key(usu_cliente)
        references cliente(cli_id)
);

create table if not exists categoria(
    cat_id int(10) unique not null auto_increment,
    cat_nombre varchar(100) not null,
    cat_foto varchar(200),
    cat_estado varchar(10),
    constraint catpk primary key(cat_id)
);

create table if not exists subcategoria(
    subcat_id int(10) unique not null auto_increment,
    subcat_nombre varchar(100) not null,
    subcat_foto varchar(200),
    subcat_estado varchar(10),
    subcat_categoria int(10) not null,
    constraint subcatpk primary key(subcat_id),
    constraint subcatfk foreign key(subcat_categoria)
        references categoria(cat_id)
);

create table if not exists marca(
    mar_id int(10) unique not null auto_increment,
    mar_nombre varchar(100) not null,
    mar_foto varchar(200),
    mar_estado varchar(10),
    constraint marpk primary key(mar_id)
);

create table if not exists producto(
    prod_id int(10) unique not null auto_increment,
    prod_nombre varchar(100) not null,
    prod_descripcion varchar(300) not null,
    prod_detalles varchar(1000) null,
    prod_foto varchar(1000) not null,
    prod_estado varchar(10) not null,
    prod_marca int(10) not null,
    prod_categoria int(10),
    prod_subcategoria int (10),
    prod_stock int(10) not null,
    prod_precio_regular decimal(9, 2) not null,
    prod_precio_oferta decimal(9, 2) not null,
    prod_oferta_inicio date, 
    prod_oferta_fin date,
    prod_oferta_especial varchar(2),
    prod_nuevo varchar(2),
    prod_proveedor int(10),
    constraint prodpk primary key(prod_id),
    constraint prodfk1 foreign key(prod_marca)
        references marca(mar_id),
    constraint prodfk2 foreign key(prod_categoria)
        references categoria(cat_id),
    constraint prodfk3 foreign key(prod_subcategoria)
        references subcategoria(subcat_id),
    constraint prodfk4 foreign key(prod_proveedor)
        references proveedor(prove_id)
);

create table if not exists favoritos(
    fav_cli_id int(10) not null,
    fav_prod_id int(10) not null,
    constraint favfk1 foreign key(fav_cli_id)
        references cliente(cli_id),
    constraint favfk2 foreign key(fav_prod_id)
        references producto(prod_id)
);

create table if not exists pedido(
    ped_id int(10) unique not null auto_increment,
    ped_fecha_solicitud datetime,
    ped_fecha_entregado datetime,
    ped_estado varchar(50) not null,
    ped_subtotal decimal(9, 2) not null,
    ped_igv decimal(9, 2) not null,
    ped_total decimal(9, 2) not null,
    ped_cliente int(10) not null,
    ped_direccion int(10) not null,
    ped_tipo varchar(20) not null,
    ped_fecha_programacion datetime null,
    constraint pedpk primary key(ped_id),
    constraint pedfk1 foreign key(ped_cliente)
        references cliente(cli_id),
    constraint pedfk2 foreign key(ped_direccion)
        references direccion(dir_id)
);

create table if not exists linea_de_pedido(
    lp_id int(10) unique not null auto_increment,
    lp_cantidad int(10) not null,
    lp_precio decimal(9, 2) not null,
    lp_subtotal decimal(9, 2) not null,
    lp_pedido int(10) not null,
    lp_producto int(10) not null,
    constraint lppk primary key(lp_id),
    constraint lpfk1 foreign key(lp_pedido)
        references pedido(ped_id),
    constraint lpfk2 foreign key(lp_producto)
        references producto(prod_id)
);

-- create table if not exists kardex(
--     kar_id int(10) unique not null auto_increment,
--     kar_movimiento varchar(50) not null,
--     kar_fecha date not null,
--     kar_stock_inicial int(10) not null,
--     kar_stock_movimiento int(10) not null,
--     kar_stock_final int(10) not null,
--     kar_producto int(10) not null,
--     constraint karpk primary key(kar_id),
--     constraint karfk foreign key(kar_producto)
--         references producto(prod_id)
-- );

create table if not exists sliders(
    sli_id int(10) unique not null auto_increment,
    sli_foto varchar(100) not null,
    sli_inicio date not null,
    sli_fin date not null,
    constraint spk primary key(sli_id)
);