-- public.archivo definition

-- Drop table

-- DROP TABLE public.archivo;

CREATE TABLE public.archivo (
	id int4 NOT NULL,
	nombre varchar(255) DEFAULT NULL::character varying NULL,
	extencion varchar(10) DEFAULT NULL::character varying NULL,
	"path" varchar(255) DEFAULT NULL::character varying NULL,
	web_p bool NULL,
	tipo varchar(20) DEFAULT NULL::character varying NULL,
	no_editar bool NULL,
	slug varchar(255) DEFAULT NULL::character varying NULL,
	CONSTRAINT archivo_pkey PRIMARY KEY (id)
);
CREATE UNIQUE INDEX uniq_3529b482989d9b62 ON public.archivo USING btree (slug);


-- public.configuracion definition

-- Drop table

-- DROP TABLE public.configuracion;

CREATE TABLE public.configuracion (
	id int4 NOT NULL,
	compra_porciento float8 NULL,
	dolar_cambio float8 NULL,
	desactivar_pagina bool NULL,
	CONSTRAINT configuracion_pkey PRIMARY KEY (id)
);


-- public.contacto definition

-- Drop table

-- DROP TABLE public.contacto;

CREATE TABLE public.contacto (
	id int4 NOT NULL,
	nombre varchar(255) NOT NULL,
	email varchar(255) NOT NULL,
	texto text NOT NULL,
	created_at timestamp(0) NOT NULL,
	updated_at timestamp(0) NOT NULL,
	CONSTRAINT contacto_pkey PRIMARY KEY (id)
);


-- public.countries definition

-- Drop table

-- DROP TABLE public.countries;

CREATE TABLE public.countries (
	id serial4 NOT NULL,
	"name" varchar(100) NOT NULL,
	iso3 bpchar(3) DEFAULT NULL::bpchar NULL,
	iso2 bpchar(2) DEFAULT NULL::bpchar NULL,
	phonecode varchar(255) DEFAULT NULL::character varying NULL,
	capital varchar(255) DEFAULT NULL::character varying NULL,
	currency varchar(255) DEFAULT NULL::character varying NULL,
	currency_symbol varchar(255) DEFAULT NULL::character varying NULL,
	tld varchar(255) DEFAULT NULL::character varying NULL,
	native varchar(255) DEFAULT NULL::character varying NULL,
	region varchar(255) DEFAULT NULL::character varying NULL,
	subregion varchar(255) DEFAULT NULL::character varying NULL,
	timezones text NULL,
	translations text NULL,
	latitude numeric(10, 8) DEFAULT NULL::numeric NULL,
	longitude numeric(11, 8) DEFAULT NULL::numeric NULL,
	emoji varchar(191) DEFAULT NULL::character varying NULL,
	"emojiU" varchar(191) DEFAULT NULL::character varying NULL,
	created_at timestamp NULL,
	updated_at timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
	flag int2 DEFAULT '1'::smallint NOT NULL,
	"wikiDataId" varchar(255) DEFAULT NULL::character varying NULL,
	CONSTRAINT countries_pkey PRIMARY KEY (id)
);


-- public.departamento definition

-- Drop table

-- DROP TABLE public.departamento;

CREATE TABLE public.departamento (
	id int4 NOT NULL,
	nombre varchar(80) NOT NULL,
	slug varchar(110) NOT NULL,
	created_at timestamp(0) NOT NULL,
	updated_at timestamp(0) NOT NULL,
	prioridad int2 NULL,
	activo bool NULL,
	CONSTRAINT departamento_pkey PRIMARY KEY (id)
);
CREATE UNIQUE INDEX uniq_40e497eb989d9b62 ON public.departamento USING btree (slug);


-- public.doctrine_migration_versions definition

-- Drop table

-- DROP TABLE public.doctrine_migration_versions;

CREATE TABLE public.doctrine_migration_versions (
	"version" varchar(191) NOT NULL,
	executed_at timestamp(0) DEFAULT NULL::timestamp without time zone NULL,
	execution_time int4 NULL,
	CONSTRAINT doctrine_migration_versions_pkey PRIMARY KEY (version)
);


-- public.empresa definition

-- Drop table

-- DROP TABLE public.empresa;

CREATE TABLE public.empresa (
	id int4 NOT NULL,
	nombre varchar(255) DEFAULT NULL::character varying NULL,
	nombre_comercial varchar(255) DEFAULT NULL::character varying NULL,
	direccion varchar(255) DEFAULT NULL::character varying NULL,
	nit varchar(20) DEFAULT NULL::character varying NULL,
	empresa_id int8 NULL,
	alias varchar(100) DEFAULT NULL::character varying NULL,
	sat_id int4 NULL,
	slug varchar(255) DEFAULT NULL::character varying NULL,
	activa bool NULL,
	CONSTRAINT empresa_pkey PRIMARY KEY (id)
);


-- public.ext_translations definition

-- Drop table

-- DROP TABLE public.ext_translations;

CREATE TABLE public.ext_translations (
	id serial4 NOT NULL,
	locale varchar(8) NOT NULL,
	object_class varchar(191) NOT NULL,
	field varchar(32) NOT NULL,
	foreign_key varchar(64) NOT NULL,
	"content" text NULL,
	CONSTRAINT ext_translations_pkey PRIMARY KEY (id)
);
CREATE INDEX general_translations_lookup_idx ON public.ext_translations USING btree (object_class, foreign_key);
CREATE UNIQUE INDEX lookup_unique_idx ON public.ext_translations USING btree (locale, object_class, field, foreign_key);
CREATE INDEX translations_lookup_idx ON public.ext_translations USING btree (locale, object_class, foreign_key);


-- public.factura definition

-- Drop table

-- DROP TABLE public.factura;

CREATE TABLE public.factura (
	id int4 NOT NULL,
	dte varchar(255) DEFAULT NULL::character varying NULL,
	"uuid" varchar(255) NULL,
	fecha timestamp(0) DEFAULT NULL::timestamp without time zone NULL,
	id_sistema int8 NULL,
	pdf varchar(255) DEFAULT NULL::character varying NULL,
	serie varchar(255) DEFAULT NULL::character varying NULL,
	CONSTRAINT factura_pkey PRIMARY KEY (id)
);


-- public.lock_keys definition

-- Drop table

-- DROP TABLE public.lock_keys;

CREATE TABLE public.lock_keys (
	key_id varchar(64) NOT NULL,
	key_token varchar(44) NOT NULL,
	key_expiration int4 NOT NULL,
	CONSTRAINT lock_keys_pkey PRIMARY KEY (key_id)
);


-- public.monitor_datos definition

-- Drop table

-- DROP TABLE public.monitor_datos;

CREATE TABLE public.monitor_datos (
	id int4 NOT NULL,
	visitas int8 NULL,
	created_at timestamp(0) NOT NULL,
	updated_at timestamp(0) NOT NULL,
	ip varchar(255) DEFAULT NULL::character varying NULL,
	session_id varchar(255) DEFAULT NULL::character varying NULL,
	CONSTRAINT monitor_datos_pkey PRIMARY KEY (id)
);


-- public.slider definition

-- Drop table

-- DROP TABLE public.slider;

CREATE TABLE public.slider (
	id int4 NOT NULL,
	nombre varchar(100) DEFAULT NULL::character varying NULL,
	CONSTRAINT slider_pkey PRIMARY KEY (id)
);


-- public.transferencia definition

-- Drop table

-- DROP TABLE public.transferencia;

CREATE TABLE public.transferencia (
	id int4 NOT NULL,
	ida_vuelta bool NULL,
	paso_completado int2 NULL,
	precio float8 NULL,
	transaccion_id varchar(100) DEFAULT NULL::character varying NULL,
	status varchar(255) DEFAULT NULL::character varying NULL,
	moneda varchar(255) DEFAULT NULL::character varying NULL,
	boleto_ticket_id int4 NULL,
	anular_intentos int2 NULL,
	precio_dolar float8 NULL,
	compra_porciento_actual float8 NULL,
	dolar_cambio_actual float8 NULL,
	precio_real float8 NULL,
	status_cybersources varchar(255) DEFAULT NULL::character varying NULL,
	email_enviado bool NULL,
	locale varchar(5) DEFAULT NULL::character varying NULL,
	factura_conjunta bool NULL,
	created_at timestamp(0) NOT NULL,
	updated_at timestamp(0) NOT NULL,
	nota text NULL,
	cantidad float8 NULL,
	uri varchar(255) DEFAULT NULL::character varying NULL,
	click_pagar bool NULL,
	requests int4 NULL,
	CONSTRAINT transferencia_pkey PRIMARY KEY (id)
);


-- public."user" definition

-- Drop table

-- DROP TABLE public."user";

CREATE TABLE public."user" (
	id int4 NOT NULL,
	username varchar(180) NOT NULL,
	roles json NOT NULL,
	"password" varchar(255) NOT NULL,
	CONSTRAINT user_pkey PRIMARY KEY (id)
);
CREATE UNIQUE INDEX uniq_8d93d649f85e0677 ON public."user" USING btree (username);


-- public.estacion definition

-- Drop table

-- DROP TABLE public.estacion;

CREATE TABLE public.estacion (
	id int4 NOT NULL,
	departamento_id int4 NULL,
	nombre varchar(100) NOT NULL,
	alias varchar(20) DEFAULT NULL::character varying NULL,
	direccion varchar(255) DEFAULT NULL::character varying NULL,
	slug varchar(110) NOT NULL,
	created_at timestamp(0) NOT NULL,
	updated_at timestamp(0) NOT NULL,
	activa bool NULL,
	prioridad int2 NULL,
	estacion_id int8 NULL,
	CONSTRAINT estacion_pkey PRIMARY KEY (id),
	CONSTRAINT fk_32b2395f5a91c08d FOREIGN KEY (departamento_id) REFERENCES public.departamento(id)
);
CREATE INDEX idx_32b2395f5a91c08d ON public.estacion USING btree (departamento_id);
CREATE UNIQUE INDEX uniq_32b2395f989d9b62 ON public.estacion USING btree (slug);


-- public.ruta_reservacion definition

-- Drop table

-- DROP TABLE public.ruta_reservacion;

CREATE TABLE public.ruta_reservacion (
	id int4 NOT NULL,
	estacion_salida_id int4 NOT NULL,
	estacion_llegada_id int4 NOT NULL,
	created_at timestamp(0) NOT NULL,
	updated_at timestamp(0) NOT NULL,
	precio float8 NULL,
	CONSTRAINT ruta_reservacion_pkey PRIMARY KEY (id),
	CONSTRAINT fk_b6ed46f4c0d6fc9 FOREIGN KEY (estacion_llegada_id) REFERENCES public.estacion(id),
	CONSTRAINT fk_b6ed46fa9d01a1 FOREIGN KEY (estacion_salida_id) REFERENCES public.estacion(id)
);
CREATE INDEX idx_b6ed46f4c0d6fc9 ON public.ruta_reservacion USING btree (estacion_llegada_id);
CREATE INDEX idx_b6ed46fa9d01a1 ON public.ruta_reservacion USING btree (estacion_salida_id);


-- public.salida_reservacion definition

-- Drop table

-- DROP TABLE public.salida_reservacion;

CREATE TABLE public.salida_reservacion (
	id int4 NOT NULL,
	bus_clase varchar(255) DEFAULT NULL::character varying NULL,
	minutos int4 NULL,
	salida_id int8 NULL,
	salida_fecha date NOT NULL,
	hora varchar(10) NULL,
	empresa_id int4 NULL,
	regreso bool NULL,
	cliente_nota text NULL,
	CONSTRAINT salida_reservacion_pkey PRIMARY KEY (id),
	CONSTRAINT fk_f6e347e2521e1991 FOREIGN KEY (empresa_id) REFERENCES public.empresa(id)
);
CREATE INDEX idx_f6e347e2521e1991 ON public.salida_reservacion USING btree (empresa_id);


-- public.servicio definition

-- Drop table

-- DROP TABLE public.servicio;

CREATE TABLE public.servicio (
	id int4 NOT NULL,
	imagen_id int4 NULL,
	nombre varchar(255) DEFAULT NULL::character varying NULL,
	texto text NULL,
	slug varchar(255) DEFAULT NULL::character varying NULL,
	inicio bool NULL,
	prioridad int2 NULL,
	CONSTRAINT servicio_pkey PRIMARY KEY (id),
	CONSTRAINT fk_cb86f22a763c8aa7 FOREIGN KEY (imagen_id) REFERENCES public.archivo(id) ON DELETE SET NULL
);
CREATE INDEX idx_cb86f22a763c8aa7 ON public.servicio USING btree (imagen_id);


-- public.slider_archivo definition

-- Drop table

-- DROP TABLE public.slider_archivo;

CREATE TABLE public.slider_archivo (
	slider_id int4 NOT NULL,
	archivo_id int4 NOT NULL,
	CONSTRAINT slider_archivo_pkey PRIMARY KEY (slider_id, archivo_id),
	CONSTRAINT fk_4bd2912e2ccc9638 FOREIGN KEY (slider_id) REFERENCES public.slider(id) ON DELETE CASCADE,
	CONSTRAINT fk_4bd2912e46ebf93b FOREIGN KEY (archivo_id) REFERENCES public.archivo(id) ON DELETE CASCADE
);
CREATE INDEX idx_4bd2912e2ccc9638 ON public.slider_archivo USING btree (slider_id);
CREATE INDEX idx_4bd2912e46ebf93b ON public.slider_archivo USING btree (archivo_id);


-- public.states definition

-- Drop table

-- DROP TABLE public.states;

CREATE TABLE public.states (
	id serial4 NOT NULL,
	"name" varchar(255) NOT NULL,
	country_id int4 NOT NULL,
	country_code bpchar(2) NOT NULL,
	fips_code varchar(255) DEFAULT NULL::character varying NULL,
	iso2 varchar(255) DEFAULT NULL::character varying NULL,
	latitude numeric(10, 8) DEFAULT NULL::numeric NULL,
	longitude numeric(11, 8) DEFAULT NULL::numeric NULL,
	created_at timestamp NULL,
	updated_at timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
	flag int2 DEFAULT '1'::smallint NOT NULL,
	"wikiDataId" varchar(255) DEFAULT NULL::character varying NULL,
	CONSTRAINT states_pkey PRIMARY KEY (id),
	CONSTRAINT country_region_final FOREIGN KEY (country_id) REFERENCES public.countries(id)
);
CREATE INDEX country_region ON public.states USING btree (country_id);


-- public.tarjeta definition

-- Drop table

-- DROP TABLE public.tarjeta;

CREATE TABLE public.tarjeta (
	id int4 NOT NULL,
	imagen_id int4 NULL,
	nombre varchar(255) NOT NULL,
	codigo varchar(10) DEFAULT NULL::character varying NULL,
	prioridad int2 NULL,
	activo bool NULL,
	CONSTRAINT tarjeta_pkey PRIMARY KEY (id),
	CONSTRAINT fk_ae90b786763c8aa7 FOREIGN KEY (imagen_id) REFERENCES public.archivo(id) ON DELETE SET NULL
);
CREATE INDEX idx_ae90b786763c8aa7 ON public.tarjeta USING btree (imagen_id);


-- public.asiento definition

-- Drop table

-- DROP TABLE public.asiento;

CREATE TABLE public.asiento (
	id int4 NOT NULL,
	numero int2 NULL,
	asiento_id int4 NOT NULL,
	precio float8 NULL,
	salida_reservacion_id int4 NOT NULL,
	boleto_sistema_id int8 NULL,
	CONSTRAINT asiento_pkey PRIMARY KEY (id),
	CONSTRAINT fk_71d6d35c4a1cab08 FOREIGN KEY (salida_reservacion_id) REFERENCES public.salida_reservacion(id)
);
CREATE INDEX idx_71d6d35c4a1cab08 ON public.asiento USING btree (salida_reservacion_id);


-- public.cities definition

-- Drop table

-- DROP TABLE public.cities;

CREATE TABLE public.cities (
	id serial4 NOT NULL,
	"name" varchar(255) NOT NULL,
	state_id int4 NOT NULL,
	state_code varchar(255) NOT NULL,
	country_id int4 NOT NULL,
	country_code bpchar(2) NOT NULL,
	latitude numeric(10, 8) NOT NULL,
	longitude numeric(11, 8) NOT NULL,
	created_at timestamp DEFAULT '2014-01-01 01:01:01'::timestamp without time zone NOT NULL,
	updated_at timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
	flag int2 DEFAULT '1'::smallint NOT NULL,
	"wikiDataId" varchar(255) DEFAULT NULL::character varying NULL,
	CONSTRAINT cities_pkey PRIMARY KEY (id),
	CONSTRAINT cities_ibfk_1 FOREIGN KEY (state_id) REFERENCES public.states(id),
	CONSTRAINT cities_ibfk_2 FOREIGN KEY (country_id) REFERENCES public.countries(id)
);
CREATE INDEX cities_test_ibfk_1 ON public.cities USING btree (state_id);
CREATE INDEX cities_test_ibfk_2 ON public.cities USING btree (country_id);


-- public.cliente_reservacion definition

-- Drop table

-- DROP TABLE public.cliente_reservacion;

CREATE TABLE public.cliente_reservacion (
	id int4 NOT NULL,
	nit varchar(25) DEFAULT NULL::character varying NULL,
	nombre varchar(255) NOT NULL,
	email varchar(100) DEFAULT NULL::character varying NULL,
	telefono varchar(20) DEFAULT NULL::character varying NULL,
	apellido varchar(100) DEFAULT NULL::character varying NULL,
	direccion varchar(255) NOT NULL,
	codigo_postal varchar(50) DEFAULT NULL::character varying NULL,
	cliente_id int4 NULL,
	pais_id int4 NULL,
	provincia_id int4 NULL,
	ciudad_id int4 NULL,
	nombre_factura varchar(100) DEFAULT NULL::character varying NULL,
	CONSTRAINT cliente_reservacion_pkey PRIMARY KEY (id),
	CONSTRAINT fk_5d97bd854e7121af FOREIGN KEY (provincia_id) REFERENCES public.states(id),
	CONSTRAINT fk_5d97bd85c604d5c6 FOREIGN KEY (pais_id) REFERENCES public.countries(id),
	CONSTRAINT fk_5d97bd85e8608214 FOREIGN KEY (ciudad_id) REFERENCES public.cities(id)
);
CREATE INDEX idx_5d97bd854e7121af ON public.cliente_reservacion USING btree (provincia_id);
CREATE INDEX idx_5d97bd85c604d5c6 ON public.cliente_reservacion USING btree (pais_id);
CREATE INDEX idx_5d97bd85e8608214 ON public.cliente_reservacion USING btree (ciudad_id);


-- public.reservacion definition

-- Drop table

-- DROP TABLE public.reservacion;

CREATE TABLE public.reservacion (
	id int4 NOT NULL,
	ruta_id int4 NULL,
	salida_id int4 NULL,
	regreso_id int4 NULL,
	ida_vuelta bool NULL,
	paso_completado int2 NULL,
	cliente_id int4 NULL,
	created_at timestamp(0) DEFAULT NULL::timestamp without time zone NOT NULL,
	updated_at timestamp(0) DEFAULT NULL::timestamp without time zone NOT NULL,
	precio float8 NULL,
	transaccion_id varchar(100) DEFAULT NULL::character varying NULL,
	status varchar(255) DEFAULT NULL::character varying NULL,
	moneda varchar(255) DEFAULT NULL::character varying NULL,
	boleto_ticket_id int4 NULL,
	anular_intentos int2 NULL,
	precio_dolar float8 NULL,
	compra_porciento_actual float8 NULL,
	dolar_cambio_actual float8 NULL,
	precio_real float8 NULL,
	tarjeta_id int4 NULL,
	status_cybersources varchar(255) DEFAULT NULL::character varying NULL,
	email_enviado bool NULL,
	factura_id int4 NULL,
	locale varchar(5) DEFAULT NULL::character varying NULL,
	empresa_factura_id int4 NULL,
	factura_conjunta bool NULL,
	uri varchar(255) DEFAULT NULL::character varying NULL,
	click_pagar bool NULL,
	requests int4 NULL,
	CONSTRAINT reservacion_pkey PRIMARY KEY (id),
	CONSTRAINT fk_8f06267326a36e51 FOREIGN KEY (salida_id) REFERENCES public.salida_reservacion(id) ON DELETE SET NULL,
	CONSTRAINT fk_8f06267330f9a360 FOREIGN KEY (empresa_factura_id) REFERENCES public.empresa(id),
	CONSTRAINT fk_8f062673abbc4845 FOREIGN KEY (ruta_id) REFERENCES public.ruta_reservacion(id) ON DELETE SET NULL,
	CONSTRAINT fk_8f062673ba156e19 FOREIGN KEY (regreso_id) REFERENCES public.salida_reservacion(id) ON DELETE SET NULL,
	CONSTRAINT fk_8f062673d8720997 FOREIGN KEY (tarjeta_id) REFERENCES public.tarjeta(id) ON DELETE SET NULL,
	CONSTRAINT fk_8f062673de734e51 FOREIGN KEY (cliente_id) REFERENCES public.cliente_reservacion(id) ON DELETE SET NULL,
	CONSTRAINT fk_8f062673f04f795f FOREIGN KEY (factura_id) REFERENCES public.factura(id)
);
CREATE INDEX idx_8f06267330f9a360 ON public.reservacion USING btree (empresa_factura_id);
CREATE INDEX idx_8f062673abbc4845 ON public.reservacion USING btree (ruta_id);
CREATE INDEX idx_8f062673d8720997 ON public.reservacion USING btree (tarjeta_id);
CREATE INDEX idx_8f062673de734e51 ON public.reservacion USING btree (cliente_id);
CREATE UNIQUE INDEX uniq_8f06267326a36e51 ON public.reservacion USING btree (salida_id);
CREATE UNIQUE INDEX uniq_8f062673ba156e19 ON public.reservacion USING btree (regreso_id);
CREATE UNIQUE INDEX uniq_8f062673f04f795f ON public.reservacion USING btree (factura_id);


-- public.error_fdn definition

-- Drop table

-- DROP TABLE public.error_fdn;

CREATE TABLE public.error_fdn (
	id int4 NOT NULL,
	error text NULL,
	reservacion_id int4 NULL,
	created_at timestamp(0) NOT NULL,
	updated_at timestamp(0) NOT NULL,
	CONSTRAINT error_fdn_pkey PRIMARY KEY (id),
	CONSTRAINT fk_6b60c3101a4b35a7 FOREIGN KEY (reservacion_id) REFERENCES public.reservacion(id) ON DELETE SET NULL
);
CREATE INDEX idx_6b60c3101a4b35a7 ON public.error_fdn USING btree (reservacion_id);
