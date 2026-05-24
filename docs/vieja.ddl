-- TerminalOmnibus.dbo.Job definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.Job;
CREATE TABLE TerminalOmnibus.dbo.Job (
	id int IDENTITY(1, 1) NOT NULL,
	name nvarchar(255) COLLATE Modern_Spanish_CI_AS NULL,
	serviceId nvarchar(255) COLLATE Modern_Spanish_CI_AS NOT NULL,
	proxy varchar(MAX) COLLATE Modern_Spanish_CI_AS NOT NULL,
	nextExecutionDate datetime2(6) NOT NULL,
	insertionDate datetime2(6) NOT NULL,
	firstExecutionDate datetime2(6) NOT NULL,
	lastExecutionDate datetime2(6) NULL,
	repeatEvery nvarchar(255) COLLATE Modern_Spanish_CI_AS NULL,
	executionCount bigint NOT NULL,
	status nvarchar(10) COLLATE Modern_Spanish_CI_AS NOT NULL,
	lastException varchar(MAX) COLLATE Modern_Spanish_CI_AS NULL,
	CONSTRAINT PK__Job__3213E83F7EA8EA7D PRIMARY KEY (id)
);
CREATE NONCLUSTERED INDEX IDX_C395A6187B00651C63DF5747 ON TerminalOmnibus.dbo.Job (status ASC, nextExecutionDate ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.JobTag definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.JobTag;
CREATE TABLE TerminalOmnibus.dbo.JobTag (
	id int IDENTITY(1, 1) NOT NULL,
	name nvarchar(255) COLLATE Modern_Spanish_CI_AS NOT NULL,
	CONSTRAINT PK__JobTag__3213E83F6641525B PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_51C97FCC5E237E06 ON TerminalOmnibus.dbo.JobTag (name ASC)
WHERE ([name] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.agencia_deposito_estado definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.agencia_deposito_estado;
CREATE TABLE TerminalOmnibus.dbo.agencia_deposito_estado (
	id smallint IDENTITY(1, 1) NOT NULL,
	nombre nvarchar(40) COLLATE Modern_Spanish_CI_AS NOT NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__agencia___3213E83FA064800C PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_F85A53903A909126 ON TerminalOmnibus.dbo.agencia_deposito_estado (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.alquiler_estado definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.alquiler_estado;
CREATE TABLE TerminalOmnibus.dbo.alquiler_estado (
	id smallint IDENTITY(1, 1) NOT NULL,
	nombre nvarchar(40) COLLATE Modern_Spanish_CI_AS NOT NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__alquiler__3213E83F33E3CCFF PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_B7417563A909126 ON TerminalOmnibus.dbo.alquiler_estado (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.autorizacion_operacion_estado definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.autorizacion_operacion_estado;
CREATE TABLE TerminalOmnibus.dbo.autorizacion_operacion_estado (
	id smallint NOT NULL,
	nombre nvarchar(40) COLLATE Modern_Spanish_CI_AS NOT NULL,
	CONSTRAINT PK__autoriza__3213E83FEE120288 PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_3BFACD073A909126 ON TerminalOmnibus.dbo.autorizacion_operacion_estado (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.autorizacion_operacion_tipo definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.autorizacion_operacion_tipo;
CREATE TABLE TerminalOmnibus.dbo.autorizacion_operacion_tipo (
	id smallint NOT NULL,
	nombre nvarchar(50) COLLATE Modern_Spanish_CI_AS NOT NULL,
	descripcion nvarchar(100) COLLATE Modern_Spanish_CI_AS NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__autoriza__3213E83F24FCEA9D PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_96D757DD3A909126 ON TerminalOmnibus.dbo.autorizacion_operacion_tipo (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.banco definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.banco;
CREATE TABLE TerminalOmnibus.dbo.banco (
	id bigint IDENTITY(1, 1) NOT NULL,
	alias nvarchar(40) COLLATE Modern_Spanish_CI_AS NOT NULL,
	nombre nvarchar(100) COLLATE Modern_Spanish_CI_AS NOT NULL,
	telefono nvarchar(15) COLLATE Modern_Spanish_CI_AS NULL,
	direccion nvarchar(200) COLLATE Modern_Spanish_CI_AS NULL,
	CONSTRAINT PK__banco__3213E83FEB9E3D62 PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_77DEE1D1E16C6B94 ON TerminalOmnibus.dbo.banco (alias ASC)
WHERE ([alias] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.boleto_documento_tipo definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.boleto_documento_tipo;
CREATE TABLE TerminalOmnibus.dbo.boleto_documento_tipo (
	id int IDENTITY(1, 1) NOT NULL,
	nombre nvarchar(40) COLLATE Modern_Spanish_CI_AS NOT NULL,
	descripcion varchar(MAX) COLLATE Modern_Spanish_CI_AS NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__boleto_d__3213E83FD95E033E PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_F6684EE53A909126 ON TerminalOmnibus.dbo.boleto_documento_tipo (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.boleto_estado definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.boleto_estado;
CREATE TABLE TerminalOmnibus.dbo.boleto_estado (
	id bigint IDENTITY(1, 1) NOT NULL,
	nombre nvarchar(40) COLLATE Modern_Spanish_CI_AS NOT NULL,
	descripcion varchar(MAX) COLLATE Modern_Spanish_CI_AS NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__boleto_e__3213E83FCF1F663E PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_B09BE8F53A909126 ON TerminalOmnibus.dbo.boleto_estado (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.boleto_pagina_asiento_temp definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.boleto_pagina_asiento_temp;
CREATE TABLE TerminalOmnibus.dbo.boleto_pagina_asiento_temp (
	reservacion_id bigint NOT NULL,
	asiento_id bigint NOT NULL,
	id bigint IDENTITY(1, 1) NOT NULL,
	boleto_pagina_temp_id bigint NULL,
	salida_id bigint NULL,
	fecha_creacion datetime2(3) NULL
);
-- TerminalOmnibus.dbo.boletos_ticket definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.boletos_ticket;
CREATE TABLE TerminalOmnibus.dbo.boletos_ticket (
	id bigint IDENTITY(1, 1) NOT NULL,
	identificador_ticket bigint NOT NULL,
	boletos varchar(MAX) COLLATE Modern_Spanish_CI_AS NOT NULL,
	fecha_creacion datetime2(6) NULL,
	CONSTRAINT PK_boletos_ticket PRIMARY KEY (id)
);
-- TerminalOmnibus.dbo.bus_asiento_estados definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.bus_asiento_estados;
CREATE TABLE TerminalOmnibus.dbo.bus_asiento_estados (
	id bigint IDENTITY(1, 1) NOT NULL,
	nombre nvarchar(20) COLLATE Modern_Spanish_CI_AS NOT NULL,
	descripcion varchar(MAX) COLLATE Modern_Spanish_CI_AS NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__bus_asie__3213E83FADAD73AF PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_80F8900A3A909126 ON TerminalOmnibus.dbo.bus_asiento_estados (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.bus_clase definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.bus_clase;
CREATE TABLE TerminalOmnibus.dbo.bus_clase (
	id bigint IDENTITY(1, 1) NOT NULL,
	nombre nvarchar(25) COLLATE Modern_Spanish_CI_AS NOT NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__bus_clas__3213E83FEE89635E PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_8FC9093F3A909126 ON TerminalOmnibus.dbo.bus_clase (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.bus_estado definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.bus_estado;
CREATE TABLE TerminalOmnibus.dbo.bus_estado (
	id bigint IDENTITY(1, 1) NOT NULL,
	nombre nvarchar(20) COLLATE Modern_Spanish_CI_AS NOT NULL,
	activo bit NOT NULL,
	descripcion varchar(MAX) COLLATE Modern_Spanish_CI_AS NULL,
	CONSTRAINT PK__bus_esta__3213E83FF2E4356C PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_EC7175CC3A909126 ON TerminalOmnibus.dbo.bus_estado (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.bus_marca definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.bus_marca;
CREATE TABLE TerminalOmnibus.dbo.bus_marca (
	id bigint IDENTITY(1, 1) NOT NULL,
	nombre nvarchar(20) COLLATE Modern_Spanish_CI_AS NOT NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__bus_marc__3213E83FB8BC31C9 PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_915CA4E23A909126 ON TerminalOmnibus.dbo.bus_marca (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.bus_senal_tipo definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.bus_senal_tipo;
CREATE TABLE TerminalOmnibus.dbo.bus_senal_tipo (
	id bigint IDENTITY(1, 1) NOT NULL,
	nombre nvarchar(20) COLLATE Modern_Spanish_CI_AS NOT NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__bus_sena__3213E83F4BE9A05C PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_D477DDFA3A909126 ON TerminalOmnibus.dbo.bus_senal_tipo (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.bus_servicio definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.bus_servicio;
CREATE TABLE TerminalOmnibus.dbo.bus_servicio (
	id bigint IDENTITY(1, 1) NOT NULL,
	nombre nvarchar(20) COLLATE Modern_Spanish_CI_AS NOT NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__bus_serv__3213E83FFDC7459A PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_2EF857363A909126 ON TerminalOmnibus.dbo.bus_servicio (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.caja_estado definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.caja_estado;
CREATE TABLE TerminalOmnibus.dbo.caja_estado (
	id bigint IDENTITY(1, 1) NOT NULL,
	nombre nvarchar(40) COLLATE Modern_Spanish_CI_AS NOT NULL,
	descripcion varchar(MAX) COLLATE Modern_Spanish_CI_AS NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__caja_est__3213E83F3EE07C91 PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_B9A5C9A3A909126 ON TerminalOmnibus.dbo.caja_estado (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.caja_operacion_tipo definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.caja_operacion_tipo;
CREATE TABLE TerminalOmnibus.dbo.caja_operacion_tipo (
	id bigint IDENTITY(1, 1) NOT NULL,
	nombre nvarchar(40) COLLATE Modern_Spanish_CI_AS NOT NULL,
	descripcion varchar(MAX) COLLATE Modern_Spanish_CI_AS NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__caja_ope__3213E83F035D4742 PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_50FD0E0C3A909126 ON TerminalOmnibus.dbo.caja_operacion_tipo (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.clase_asiento definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.clase_asiento;
CREATE TABLE TerminalOmnibus.dbo.clase_asiento (
	id bigint IDENTITY(1, 1) NOT NULL,
	nombre nvarchar(10) COLLATE Modern_Spanish_CI_AS NOT NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__clase_as__3213E83F0C1A8CF8 PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_6B798F5B3A909126 ON TerminalOmnibus.dbo.clase_asiento (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.conexiones definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.conexiones;
CREATE TABLE TerminalOmnibus.dbo.conexiones (
	codigo nvarchar(6) COLLATE Modern_Spanish_CI_AS NOT NULL,
	nombre nvarchar(100) COLLATE Modern_Spanish_CI_AS NOT NULL,
	horario nvarchar(50) COLLATE Modern_Spanish_CI_AS NOT NULL,
	precio nvarchar(50) COLLATE Modern_Spanish_CI_AS NOT NULL,
	descripcion nvarchar(500) COLLATE Modern_Spanish_CI_AS NOT NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__conexion__40F9A207C5539630 PRIMARY KEY (codigo)
);
-- TerminalOmnibus.dbo.custom_log_code definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.custom_log_code;
CREATE TABLE TerminalOmnibus.dbo.custom_log_code (
	codigo nvarchar(6) COLLATE Modern_Spanish_CI_AS NOT NULL,
	descripcion varchar(MAX) COLLATE Modern_Spanish_CI_AS NOT NULL,
	CONSTRAINT PK__custom_l__40F9A207A5A98086 PRIMARY KEY (codigo)
);
-- TerminalOmnibus.dbo.custom_rol definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.custom_rol;
CREATE TABLE TerminalOmnibus.dbo.custom_rol (
	nombre nvarchar(255) COLLATE Modern_Spanish_CI_AS NOT NULL,
	descripcion nvarchar(255) COLLATE Modern_Spanish_CI_AS NOT NULL,
	CONSTRAINT PK__custom_r__72AFBCC750A34EFC PRIMARY KEY (nombre)
);
-- TerminalOmnibus.dbo.departamento definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.departamento;
CREATE TABLE TerminalOmnibus.dbo.departamento (
	id smallint IDENTITY(1, 1) NOT NULL,
	nombre nvarchar(50) COLLATE Modern_Spanish_CI_AS NOT NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__departam__3213E83F408CA1AC PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_40E497EB3A909126 ON TerminalOmnibus.dbo.departamento (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.dia_semana definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.dia_semana;
CREATE TABLE TerminalOmnibus.dbo.dia_semana (
	id int IDENTITY(1, 1) NOT NULL,
	nombre nvarchar(10) COLLATE Modern_Spanish_CI_AS NOT NULL,
	CONSTRAINT PK__dia_sema__3213E83F3AE8C550 PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_9F6CDC843A909126 ON TerminalOmnibus.dbo.dia_semana (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.doctrine_migration_versions definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.doctrine_migration_versions;
CREATE TABLE TerminalOmnibus.dbo.doctrine_migration_versions (
	version nvarchar(191) COLLATE Modern_Spanish_CI_AS NOT NULL,
	executed_at datetime2(6) NULL,
	execution_time int NULL,
	CONSTRAINT PK__doctrine__79B5C94C268B8B06 PRIMARY KEY (version)
);
-- TerminalOmnibus.dbo.empresa definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.empresa;
CREATE TABLE TerminalOmnibus.dbo.empresa (
	id bigint IDENTITY(1, 1) NOT NULL,
	nombre nvarchar(255) COLLATE Modern_Spanish_CI_AS NOT NULL,
	representanteLegal nvarchar(255) COLLATE Modern_Spanish_CI_AS NOT NULL,
	activo bit NOT NULL,
	color nvarchar(6) COLLATE Modern_Spanish_CI_AS NOT NULL,
	nombreComercial nvarchar(255) COLLATE Modern_Spanish_CI_AS NOT NULL,
	denominacionSocial nvarchar(255) COLLATE Modern_Spanish_CI_AS NOT NULL,
	direccion varchar(MAX) COLLATE Modern_Spanish_CI_AS NOT NULL,
	nit nvarchar(20) COLLATE Modern_Spanish_CI_AS NOT NULL,
	formaPagoISR nvarchar(255) COLLATE Modern_Spanish_CI_AS NOT NULL,
	correos varchar(MAX) COLLATE Modern_Spanish_CI_AS NULL,
	alias nvarchar(15) COLLATE Modern_Spanish_CI_AS NULL,
	id_externo bigint NULL,
	telefonos varchar(MAX) COLLATE Modern_Spanish_CI_AS NULL,
	logo varchar(MAX) COLLATE Modern_Spanish_CI_AS NULL,
	id_usuario_externo bigint NULL,
	id_cliente_externo bigint NULL,
	url_externo nvarchar(250) COLLATE Modern_Spanish_CI_AS NULL,
	reportar_boleto_facturado bit NULL,
	id_producto_boleto_externo bigint NULL,
	reportar_encomienda_facturado bit NULL,
	id_producto_encomienda_externo bigint NULL,
	obligatorio_control_tarjetas bit NULL,
	no_bono bit NULL,
	CONSTRAINT PK__empresa__3213E83FA89F5E6A PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_B8D75A5037085B7E ON TerminalOmnibus.dbo.empresa (nombreComercial ASC)
WHERE ([nombreComercial] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_B8D75A503A909126 ON TerminalOmnibus.dbo.empresa (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_B8D75A505E5F5AF3 ON TerminalOmnibus.dbo.empresa (nit ASC)
WHERE ([nit] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_B8D75A50665648E9 ON TerminalOmnibus.dbo.empresa (color ASC)
WHERE ([color] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_B8D75A50E16C6B94 ON TerminalOmnibus.dbo.empresa (alias ASC)
WHERE ([alias] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.encomienda_documento_tipo definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.encomienda_documento_tipo;
CREATE TABLE TerminalOmnibus.dbo.encomienda_documento_tipo (
	id bigint IDENTITY(1, 1) NOT NULL,
	nombre nvarchar(40) COLLATE Modern_Spanish_CI_AS NOT NULL,
	descripcion varchar(MAX) COLLATE Modern_Spanish_CI_AS NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__encomien__3213E83F8D7D537A PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_825CF65F3A909126 ON TerminalOmnibus.dbo.encomienda_documento_tipo (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.encomienda_especiales_tipo definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.encomienda_especiales_tipo;
CREATE TABLE TerminalOmnibus.dbo.encomienda_especiales_tipo (
	id bigint IDENTITY(1, 1) NOT NULL,
	nombre nvarchar(100) COLLATE Modern_Spanish_CI_AS NOT NULL,
	descripcion varchar(MAX) COLLATE Modern_Spanish_CI_AS NULL,
	activo bit NOT NULL,
	permiteAutorizacionCortesia bit NOT NULL,
	permiteAutorizacionInterna bit NOT NULL,
	permitePorCobrar bit NOT NULL,
	permiteFactura bit NOT NULL,
	CONSTRAINT PK__encomien__3213E83F3BE6CAB4 PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_224C61643A909126 ON TerminalOmnibus.dbo.encomienda_especiales_tipo (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.encomienda_estado definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.encomienda_estado;
CREATE TABLE TerminalOmnibus.dbo.encomienda_estado (
	id bigint IDENTITY(1, 1) NOT NULL,
	nombre nvarchar(40) COLLATE Modern_Spanish_CI_AS NOT NULL,
	descripcion varchar(MAX) COLLATE Modern_Spanish_CI_AS NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__encomien__3213E83FC4C92A36 PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_93286EC53A909126 ON TerminalOmnibus.dbo.encomienda_estado (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.encomienda_tipo definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.encomienda_tipo;
CREATE TABLE TerminalOmnibus.dbo.encomienda_tipo (
	id bigint IDENTITY(1, 1) NOT NULL,
	nombre nvarchar(40) COLLATE Modern_Spanish_CI_AS NOT NULL,
	descripcion varchar(MAX) COLLATE Modern_Spanish_CI_AS NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__encomien__3213E83FD4B1DEF8 PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_3A8FCB603A909126 ON TerminalOmnibus.dbo.encomienda_tipo (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.estacion_servicio definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.estacion_servicio;
CREATE TABLE TerminalOmnibus.dbo.estacion_servicio (
	id bigint IDENTITY(1, 1) NOT NULL,
	nombre nvarchar(100) COLLATE Modern_Spanish_CI_AS NOT NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__estacion__3213E83F9CBBA4B6 PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_2C7789943A909126 ON TerminalOmnibus.dbo.estacion_servicio (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.estacion_tipo definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.estacion_tipo;
CREATE TABLE TerminalOmnibus.dbo.estacion_tipo (
	id int IDENTITY(1, 1) NOT NULL,
	nombre nvarchar(50) COLLATE Modern_Spanish_CI_AS NOT NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__estacion__3213E83FAAECFDC7 PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_31C2FC623A909126 ON TerminalOmnibus.dbo.estacion_tipo (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.estacion_tipo_pago definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.estacion_tipo_pago;
CREATE TABLE TerminalOmnibus.dbo.estacion_tipo_pago (
	id smallint IDENTITY(1, 1) NOT NULL,
	nombre nvarchar(40) COLLATE Modern_Spanish_CI_AS NOT NULL,
	CONSTRAINT PK__estacion__3213E83FF8780D49 PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_D2CEE78B3A909126 ON TerminalOmnibus.dbo.estacion_tipo_pago (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.factura_emisor definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.factura_emisor;
CREATE TABLE TerminalOmnibus.dbo.factura_emisor (
	id bigint IDENTITY(1, 1) NOT NULL,
	afiliacion_iva nvarchar(255) COLLATE Modern_Spanish_CI_AS NULL,
	correo_emisor nvarchar(255) COLLATE Modern_Spanish_CI_AS NULL,
	nit_emisor nvarchar(255) COLLATE Modern_Spanish_CI_AS NULL,
	nombre_comercial nvarchar(255) COLLATE Modern_Spanish_CI_AS NULL,
	nombre_emisor nvarchar(255) COLLATE Modern_Spanish_CI_AS NULL,
	direccion nvarchar(255) COLLATE Modern_Spanish_CI_AS NULL,
	codigo_postal nvarchar(255) COLLATE Modern_Spanish_CI_AS NULL,
	departamento nvarchar(255) COLLATE Modern_Spanish_CI_AS NULL,
	pais nvarchar(255) COLLATE Modern_Spanish_CI_AS NULL,
	activo bit NULL,
	user_forcon nvarchar(255) COLLATE Modern_Spanish_CI_AS NULL,
	password_forcon nvarchar(255) COLLATE Modern_Spanish_CI_AS NULL,
	empresa_id bigint NULL,
	CONSTRAINT PK_factura_emisor PRIMARY KEY (id)
);
CREATE NONCLUSTERED INDEX IX_factura_emisor ON TerminalOmnibus.dbo.factura_emisor (user_forcon ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IX_factura_emisor_1 ON TerminalOmnibus.dbo.factura_emisor (password_forcon ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.galeria definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.galeria;
CREATE TABLE TerminalOmnibus.dbo.galeria (
	id int IDENTITY(1, 1) NOT NULL,
	orden int NOT NULL,
	nombre nvarchar(100) COLLATE Modern_Spanish_CI_AS NOT NULL,
	descripcion nvarchar(255) COLLATE Modern_Spanish_CI_AS NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__galeria__3213E83FCC442B81 PRIMARY KEY (id)
);
-- TerminalOmnibus.dbo.horario_ciclico definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.horario_ciclico;
CREATE TABLE TerminalOmnibus.dbo.horario_ciclico (
	id bigint IDENTITY(1, 1) NOT NULL,
	hora time(0) NOT NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__horario___3213E83F00A64AEA PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_830ECAADBBE1C657 ON TerminalOmnibus.dbo.horario_ciclico (hora ASC)
WHERE ([hora] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.impresora_plugin definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.impresora_plugin;
CREATE TABLE TerminalOmnibus.dbo.impresora_plugin (
	id int IDENTITY(1, 1) NOT NULL,
	nombre nvarchar(50) COLLATE Modern_Spanish_CI_AS NOT NULL,
	CONSTRAINT PK__impresor__3213E83F4E2FAB95 PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_3E8EA1613A909126 ON TerminalOmnibus.dbo.impresora_plugin (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.impresora_tipo definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.impresora_tipo;
CREATE TABLE TerminalOmnibus.dbo.impresora_tipo (
	id int IDENTITY(1, 1) NOT NULL,
	nombre nvarchar(50) COLLATE Modern_Spanish_CI_AS NOT NULL,
	CONSTRAINT PK__impresor__3213E83F33F99551 PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_9CB5DCC73A909126 ON TerminalOmnibus.dbo.impresora_tipo (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.log definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.log;
CREATE TABLE TerminalOmnibus.dbo.log (
	id bigint IDENTITY(1, 1) NOT NULL,
	tipo varchar(100) COLLATE Modern_Spanish_CI_AS NULL,
	fecha datetime2(0) NULL,
	user_id bigint NOT NULL,
	address varchar(100) COLLATE Modern_Spanish_CI_AS NULL
);
-- TerminalOmnibus.dbo.moneda definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.moneda;
CREATE TABLE TerminalOmnibus.dbo.moneda (
	id int IDENTITY(1, 1) NOT NULL,
	sigla nvarchar(3) COLLATE Modern_Spanish_CI_AS NOT NULL,
	nombre nvarchar(40) COLLATE Modern_Spanish_CI_AS NOT NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__moneda__3213E83F97F5748C PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_B00B2B2D3A909126 ON TerminalOmnibus.dbo.moneda (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_B00B2B2D801B7D4B ON TerminalOmnibus.dbo.moneda (sigla ASC)
WHERE ([sigla] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.nacionalidad definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.nacionalidad;
CREATE TABLE TerminalOmnibus.dbo.nacionalidad (
	id smallint IDENTITY(1, 1) NOT NULL,
	nombre nvarchar(50) COLLATE Modern_Spanish_CI_AS NOT NULL,
	activo bit NOT NULL,
	sigla nvarchar(3) COLLATE Modern_Spanish_CI_AS NULL,
	CONSTRAINT PK__nacional__3213E83F83908140 PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_931D5FC33A909126 ON TerminalOmnibus.dbo.nacionalidad (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.notificacion definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.notificacion;
CREATE TABLE TerminalOmnibus.dbo.notificacion (
	id int IDENTITY(1, 1) NOT NULL,
	texto nvarchar(300) COLLATE Modern_Spanish_CI_AS NOT NULL,
	segundos int NOT NULL,
	oficinas bit NOT NULL,
	agencias bit NOT NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__notifica__3213E83F5D699DAA PRIMARY KEY (id)
);
-- TerminalOmnibus.dbo.pais definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.pais;
CREATE TABLE TerminalOmnibus.dbo.pais (
	id smallint IDENTITY(1, 1) NOT NULL,
	sigla nvarchar(3) COLLATE Modern_Spanish_CI_AS NULL,
	nombre nvarchar(50) COLLATE Modern_Spanish_CI_AS NOT NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__pais__3213E83F9DD3496C PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_7E5D2EFF3A909126 ON TerminalOmnibus.dbo.pais (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.reservacion_estado definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.reservacion_estado;
CREATE TABLE TerminalOmnibus.dbo.reservacion_estado (
	id bigint IDENTITY(1, 1) NOT NULL,
	nombre nvarchar(20) COLLATE Modern_Spanish_CI_AS NOT NULL,
	descripcion varchar(MAX) COLLATE Modern_Spanish_CI_AS NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__reservac__3213E83F61C05566 PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_E96179303A909126 ON TerminalOmnibus.dbo.reservacion_estado (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.salida_estado definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.salida_estado;
CREATE TABLE TerminalOmnibus.dbo.salida_estado (
	id bigint IDENTITY(1, 1) NOT NULL,
	nombre nvarchar(20) COLLATE Modern_Spanish_CI_AS NOT NULL,
	descripcion varchar(MAX) COLLATE Modern_Spanish_CI_AS NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__salida_e__3213E83F661271F9 PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_934DF4793A909126 ON TerminalOmnibus.dbo.salida_estado (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.sexo definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.sexo;
CREATE TABLE TerminalOmnibus.dbo.sexo (
	id smallint IDENTITY(1, 1) NOT NULL,
	sigla nvarchar(1) COLLATE Modern_Spanish_CI_AS NOT NULL,
	nombre nvarchar(40) COLLATE Modern_Spanish_CI_AS NOT NULL,
	CONSTRAINT PK__sexo__3213E83F8ABC62DD PRIMARY KEY (id)
);
-- TerminalOmnibus.dbo.systranschemas definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.systranschemas;
CREATE TABLE TerminalOmnibus.dbo.systranschemas (
	tabid int NOT NULL,
	startlsn binary(10) NOT NULL,
	endlsn binary(10) NOT NULL,
	typeid int DEFAULT 52 NOT NULL
);
CREATE UNIQUE CLUSTERED INDEX uncsystranschemas ON TerminalOmnibus.dbo.systranschemas (startlsn ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.talonario_corte_venta_estado definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.talonario_corte_venta_estado;
CREATE TABLE TerminalOmnibus.dbo.talonario_corte_venta_estado (
	id smallint NOT NULL,
	nombre nvarchar(40) COLLATE Modern_Spanish_CI_AS NOT NULL,
	CONSTRAINT PK__talonari__3213E83FB53A4BE6 PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_83D598033A909126 ON TerminalOmnibus.dbo.talonario_corte_venta_estado (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.tarjeta_estado definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.tarjeta_estado;
CREATE TABLE TerminalOmnibus.dbo.tarjeta_estado (
	id smallint NOT NULL,
	nombre nvarchar(40) COLLATE Modern_Spanish_CI_AS NOT NULL,
	CONSTRAINT PK__tarjeta___3213E83FA1313E5A PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_4FD5B3433A909126 ON TerminalOmnibus.dbo.tarjeta_estado (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.tipo_cambio_tipo definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.tipo_cambio_tipo;
CREATE TABLE TerminalOmnibus.dbo.tipo_cambio_tipo (
	id int IDENTITY(1, 1) NOT NULL,
	nombre nvarchar(40) COLLATE Modern_Spanish_CI_AS NOT NULL,
	descripcion varchar(MAX) COLLATE Modern_Spanish_CI_AS NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__tipo_cam__3213E83F323D8756 PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_9AF4EFAE3A909126 ON TerminalOmnibus.dbo.tipo_cambio_tipo (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.tipo_documento definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.tipo_documento;
CREATE TABLE TerminalOmnibus.dbo.tipo_documento (
	id smallint IDENTITY(1, 1) NOT NULL,
	sigla nvarchar(3) COLLATE Modern_Spanish_CI_AS NULL,
	nombre nvarchar(50) COLLATE Modern_Spanish_CI_AS NOT NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__tipo_doc__3213E83F36DAF716 PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_54DF91893A909126 ON TerminalOmnibus.dbo.tipo_documento (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.tipo_pago definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.tipo_pago;
CREATE TABLE TerminalOmnibus.dbo.tipo_pago (
	id bigint IDENTITY(1, 1) NOT NULL,
	nombre nvarchar(50) COLLATE Modern_Spanish_CI_AS NOT NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__tipo_pag__3213E83F69D05718 PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_FEF0887B3A909126 ON TerminalOmnibus.dbo.tipo_pago (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.tipo_tarjeta definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.tipo_tarjeta;
CREATE TABLE TerminalOmnibus.dbo.tipo_tarjeta (
	id smallint NOT NULL,
	sigla nvarchar(3) COLLATE Modern_Spanish_CI_AS NOT NULL,
	nombre nvarchar(50) COLLATE Modern_Spanish_CI_AS NOT NULL,
	CONSTRAINT PK__tipo_tar__3213E83F99F07464 PRIMARY KEY (id)
);
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_BD6996263A909126 ON TerminalOmnibus.dbo.tipo_tarjeta (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_BD699626801B7D4B ON TerminalOmnibus.dbo.tipo_tarjeta (sigla ASC)
WHERE ([sigla] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.banco_cuenta definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.banco_cuenta;
CREATE TABLE TerminalOmnibus.dbo.banco_cuenta (
	id int IDENTITY(1, 1) NOT NULL,
	empresa_id bigint NOT NULL,
	banco_id bigint NOT NULL,
	moneda_id int NULL,
	referencia_externa nvarchar(100) COLLATE Modern_Spanish_CI_AS NULL,
	nombre nvarchar(100) COLLATE Modern_Spanish_CI_AS NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__banco_cu__3213E83F06E6E544 PRIMARY KEY (id),
	CONSTRAINT FK_D875C187521E1991 FOREIGN KEY (empresa_id) REFERENCES TerminalOmnibus.dbo.empresa(id),
	CONSTRAINT FK_D875C187B77634D2 FOREIGN KEY (moneda_id) REFERENCES TerminalOmnibus.dbo.moneda(id),
	CONSTRAINT FK_D875C187CC04A73E FOREIGN KEY (banco_id) REFERENCES TerminalOmnibus.dbo.banco(id)
);
CREATE NONCLUSTERED INDEX IDX_D875C187521E1991 ON TerminalOmnibus.dbo.banco_cuenta (empresa_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_D875C187B77634D2 ON TerminalOmnibus.dbo.banco_cuenta (moneda_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_D875C187CC04A73E ON TerminalOmnibus.dbo.banco_cuenta (banco_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.bus_clase_union_asiento_clase definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.bus_clase_union_asiento_clase;
CREATE TABLE TerminalOmnibus.dbo.bus_clase_union_asiento_clase (
	clasebus_id bigint NOT NULL,
	claseasiento_id bigint NOT NULL,
	CONSTRAINT PK__bus_clas__996BAE9DE8B2906E PRIMARY KEY (clasebus_id, claseasiento_id),
	CONSTRAINT FK_D237424D4DA71743 FOREIGN KEY (clasebus_id) REFERENCES TerminalOmnibus.dbo.bus_clase(id),
	CONSTRAINT FK_D237424DA642C302 FOREIGN KEY (claseasiento_id) REFERENCES TerminalOmnibus.dbo.clase_asiento(id)
);
CREATE NONCLUSTERED INDEX IDX_D237424D4DA71743 ON TerminalOmnibus.dbo.bus_clase_union_asiento_clase (clasebus_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_D237424DA642C302 ON TerminalOmnibus.dbo.bus_clase_union_asiento_clase (claseasiento_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.bus_tipo definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.bus_tipo;
CREATE TABLE TerminalOmnibus.dbo.bus_tipo (
	id bigint IDENTITY(1, 1) NOT NULL,
	clase_id bigint NULL,
	alias nvarchar(10) COLLATE Modern_Spanish_CI_AS NOT NULL,
	descripcion varchar(MAX) COLLATE Modern_Spanish_CI_AS NOT NULL,
	nivel2 bit NOT NULL,
	totalAsientos int NOT NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__bus_tipo__3213E83F9E76FD3E PRIMARY KEY (id),
	CONSTRAINT FK_2F20620D9F720353 FOREIGN KEY (clase_id) REFERENCES TerminalOmnibus.dbo.bus_clase(id)
);
CREATE NONCLUSTERED INDEX IDX_2F20620D9F720353 ON TerminalOmnibus.dbo.bus_tipo (clase_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_2F20620DE16C6B94 ON TerminalOmnibus.dbo.bus_tipo (alias ASC)
WHERE ([alias] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.custom_log definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.custom_log;
CREATE TABLE TerminalOmnibus.dbo.custom_log (
	id bigint IDENTITY(1, 1) NOT NULL,
	username nvarchar(255) COLLATE Modern_Spanish_CI_AS NOT NULL,
	channel nvarchar(255) COLLATE Modern_Spanish_CI_AS NOT NULL,
	[level] nvarchar(255) COLLATE Modern_Spanish_CI_AS NOT NULL,
	message nvarchar(1000) COLLATE Modern_Spanish_CI_AS NOT NULL,
	createdAt datetime2(6) NOT NULL,
	[method] nvarchar(10) COLLATE Modern_Spanish_CI_AS NOT NULL,
	isAjax bit NOT NULL,
	scheme nvarchar(10) COLLATE Modern_Spanish_CI_AS NOT NULL,
	httpHost nvarchar(1000) COLLATE Modern_Spanish_CI_AS NOT NULL,
	clientIp nvarchar(20) COLLATE Modern_Spanish_CI_AS NOT NULL,
	isSecure bit NOT NULL,
	codigo nvarchar(6) COLLATE Modern_Spanish_CI_AS NULL,
	entity varchar(MAX) COLLATE Modern_Spanish_CI_AS NULL,
	entityIds nvarchar(200) COLLATE Modern_Spanish_CI_AS NULL,
	CONSTRAINT PK__custom_l__3213E83FF1219DBC PRIMARY KEY (id),
	CONSTRAINT FK_2286938420332D99 FOREIGN KEY (codigo) REFERENCES TerminalOmnibus.dbo.custom_log_code(codigo)
);
CREATE NONCLUSTERED INDEX IDX_2286938420332D99 ON TerminalOmnibus.dbo.custom_log (codigo ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.estacion definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.estacion;
CREATE TABLE TerminalOmnibus.dbo.estacion (
	id bigint IDENTITY(1, 1) NOT NULL,
	nombre nvarchar(50) COLLATE Modern_Spanish_CI_AS NOT NULL,
	direccion varchar(MAX) COLLATE Modern_Spanish_CI_AS NOT NULL,
	alias nvarchar(3) COLLATE Modern_Spanish_CI_AS NOT NULL,
	activo bit NOT NULL,
	tipoEstacion_id int NULL,
	publicidad bit NOT NULL,
	facturacion_especial bit NULL,
	ping_facturacion_especial nvarchar(8) COLLATE Modern_Spanish_CI_AS NULL,
	porciento_tarifa_agencia numeric(10, 8) NULL,
	inicia_ruta bit NULL,
	tipo_pago_id smallint NULL,
	agencia_moneda_id int NULL,
	agencia_porciento_bonificacion numeric(10, 8) NULL,
	agencia_saldo numeric(7, 2) NULL,
	agencia_bonificacion numeric(7, 2) NULL,
	destino bit NULL,
	id_externo bigint NULL,
	enviosEncomiendasPorCobrar bit NULL,
	id_externo_encomienda bigint NULL,
	pluginJavaActivo bit NULL,
	aplicar_porciento_tarifa_agencia bit NULL,
	permitirVoucherBoleto bit NULL,
	permitirTarjeta bit NULL,
	pais_id smallint NULL,
	longitude numeric(15, 10) NULL,
	latitude numeric(15, 10) NULL,
	departamento_id smallint NULL,
	control_tarjetas_en_ruta bit NULL,
	numEstablecimientoSat bigint NULL,
	numEstablecimientoSatMayaDeOro bigint NULL,
	numEstablecimientoSatRosita bigint NULL,
	numEstablecimientoSatMitocha bigint NULL,
	factura_emisor_id bigint NULL,
	numEstablecimientoStarbus tinyint NULL,
	precio numeric(7, 2) NULL,
	CONSTRAINT PK__estacion__3213E83F930284F2 PRIMARY KEY (id),
	CONSTRAINT FK_32B2395F41136D8B FOREIGN KEY (agencia_moneda_id) REFERENCES TerminalOmnibus.dbo.moneda(id),
	CONSTRAINT FK_32B2395F5A91C08D FOREIGN KEY (departamento_id) REFERENCES TerminalOmnibus.dbo.departamento(id),
	CONSTRAINT FK_32B2395F5E1B8E12 FOREIGN KEY (tipoEstacion_id) REFERENCES TerminalOmnibus.dbo.estacion_tipo(id),
	CONSTRAINT FK_32B2395F7002A220 FOREIGN KEY (tipo_pago_id) REFERENCES TerminalOmnibus.dbo.estacion_tipo_pago(id),
	CONSTRAINT FK_32B2395FC604D5C6 FOREIGN KEY (pais_id) REFERENCES TerminalOmnibus.dbo.pais(id),
	CONSTRAINT estacion_FK_1 FOREIGN KEY (factura_emisor_id) REFERENCES TerminalOmnibus.dbo.factura_emisor(id)
);
CREATE NONCLUSTERED INDEX IDX_32B2395F41136D8B ON TerminalOmnibus.dbo.estacion (agencia_moneda_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_32B2395F5A91C08D ON TerminalOmnibus.dbo.estacion (departamento_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_32B2395F5E1B8E12 ON TerminalOmnibus.dbo.estacion (tipoEstacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_32B2395F7002A220 ON TerminalOmnibus.dbo.estacion (tipo_pago_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_32B2395FC604D5C6 ON TerminalOmnibus.dbo.estacion (pais_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IX_estacion ON TerminalOmnibus.dbo.estacion (factura_emisor_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_32B2395F3A909126 ON TerminalOmnibus.dbo.estacion (nombre ASC)
WHERE ([nombre] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_32B2395FE16C6B94 ON TerminalOmnibus.dbo.estacion (alias ASC)
WHERE ([alias] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.estacion_correo definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.estacion_correo;
CREATE TABLE TerminalOmnibus.dbo.estacion_correo (
	id bigint IDENTITY(1, 1) NOT NULL,
	estacion_id bigint NULL,
	correo nvarchar(60) COLLATE Modern_Spanish_CI_AS NOT NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__estacion__3213E83F3657D407 PRIMARY KEY (id),
	CONSTRAINT FK_48FA482F2A4AF395 FOREIGN KEY (estacion_id) REFERENCES TerminalOmnibus.dbo.estacion(id)
);
CREATE NONCLUSTERED INDEX IDX_48FA482F2A4AF395 ON TerminalOmnibus.dbo.estacion_correo (estacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_48FA482F77040BC9 ON TerminalOmnibus.dbo.estacion_correo (correo ASC)
WHERE ([correo] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.estacion_distancias definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.estacion_distancias;
CREATE TABLE TerminalOmnibus.dbo.estacion_distancias (
	id bigint IDENTITY(1, 1) NOT NULL,
	estacion_origen_id bigint NULL,
	estacion_destino_id bigint NULL,
	kilometros int NOT NULL,
	CONSTRAINT PK__estacion__3213E83F8CC0255B PRIMARY KEY (id),
	CONSTRAINT FK_72FA924A59A7CA66 FOREIGN KEY (estacion_destino_id) REFERENCES TerminalOmnibus.dbo.estacion(id),
	CONSTRAINT FK_72FA924ABF6CF13D FOREIGN KEY (estacion_origen_id) REFERENCES TerminalOmnibus.dbo.estacion(id)
);
CREATE NONCLUSTERED INDEX IDX_72FA924A59A7CA66 ON TerminalOmnibus.dbo.estacion_distancias (estacion_destino_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_72FA924ABF6CF13D ON TerminalOmnibus.dbo.estacion_distancias (estacion_origen_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.estacion_servicio_union definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.estacion_servicio_union;
CREATE TABLE TerminalOmnibus.dbo.estacion_servicio_union (
	estacion_id bigint NOT NULL,
	servicio_id bigint NOT NULL,
	CONSTRAINT PK__estacion__AA6A2D7B5BD9ABA6 PRIMARY KEY (estacion_id, servicio_id),
	CONSTRAINT FK_54069E812A4AF395 FOREIGN KEY (estacion_id) REFERENCES TerminalOmnibus.dbo.estacion(id),
	CONSTRAINT FK_54069E8171CAA3E7 FOREIGN KEY (servicio_id) REFERENCES TerminalOmnibus.dbo.estacion_servicio(id)
);
CREATE NONCLUSTERED INDEX IDX_54069E812A4AF395 ON TerminalOmnibus.dbo.estacion_servicio_union (estacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_54069E8171CAA3E7 ON TerminalOmnibus.dbo.estacion_servicio_union (servicio_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.estacion_telefono definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.estacion_telefono;
CREATE TABLE TerminalOmnibus.dbo.estacion_telefono (
	id bigint IDENTITY(1, 1) NOT NULL,
	estacion_id bigint NULL,
	telefono nvarchar(25) COLLATE Modern_Spanish_CI_AS NOT NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__estacion__3213E83F4073D6EF PRIMARY KEY (id),
	CONSTRAINT FK_261671C12A4AF395 FOREIGN KEY (estacion_id) REFERENCES TerminalOmnibus.dbo.estacion(id)
);
CREATE NONCLUSTERED INDEX IDX_261671C12A4AF395 ON TerminalOmnibus.dbo.estacion_telefono (estacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_261671C1C1E70A7F ON TerminalOmnibus.dbo.estacion_telefono (telefono ASC)
WHERE ([telefono] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.factura_emisor_empresas definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.factura_emisor_empresas;
CREATE TABLE TerminalOmnibus.dbo.factura_emisor_empresas (
	factura_emisor_id bigint NOT NULL,
	empresa_id bigint NOT NULL,
	CONSTRAINT IX_factura_emisor_empresas_2 UNIQUE (factura_emisor_id, empresa_id),
	CONSTRAINT FK_factura_emisor_empresas_empresa FOREIGN KEY (empresa_id) REFERENCES TerminalOmnibus.dbo.empresa(id),
	CONSTRAINT FK_factura_emisor_empresas_factura_emisor FOREIGN KEY (factura_emisor_id) REFERENCES TerminalOmnibus.dbo.factura_emisor(id)
);
-- TerminalOmnibus.dbo.galeria_imagen definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.galeria_imagen;
CREATE TABLE TerminalOmnibus.dbo.galeria_imagen (
	id bigint IDENTITY(1, 1) NOT NULL,
	galeria_id int NOT NULL,
	descripcion nvarchar(255) COLLATE Modern_Spanish_CI_AS NULL,
	imagen_normal varchar(MAX) COLLATE Modern_Spanish_CI_AS NULL,
	imagen_pequena varchar(MAX) COLLATE Modern_Spanish_CI_AS NULL,
	formato nvarchar(10) COLLATE Modern_Spanish_CI_AS NOT NULL,
	CONSTRAINT PK__galeria___3213E83F45747978 PRIMARY KEY (id),
	CONSTRAINT FK_1E6E6C37D31019C FOREIGN KEY (galeria_id) REFERENCES TerminalOmnibus.dbo.galeria(id)
);
CREATE NONCLUSTERED INDEX IDX_1E6E6C37D31019C ON TerminalOmnibus.dbo.galeria_imagen (galeria_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.impresora definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.impresora;
CREATE TABLE TerminalOmnibus.dbo.impresora (
	id int IDENTITY(1, 1) NOT NULL,
	nombre nvarchar(100) COLLATE Modern_Spanish_CI_AS NOT NULL,
	activo bit NOT NULL,
	idTamanoPagina int NOT NULL,
	[path] nvarchar(100) COLLATE Modern_Spanish_CI_AS NOT NULL,
	espacioLetras bit NULL,
	tipo_id int NULL,
	estacion_id bigint NULL,
	autoPrint bit NULL,
	CONSTRAINT PK__impresor__3213E83FF35766F3 PRIMARY KEY (id),
	CONSTRAINT FK_BBCADB322A4AF395 FOREIGN KEY (estacion_id) REFERENCES TerminalOmnibus.dbo.estacion(id),
	CONSTRAINT FK_BBCADB32A9276E6C FOREIGN KEY (tipo_id) REFERENCES TerminalOmnibus.dbo.impresora_tipo(id)
);
CREATE NONCLUSTERED INDEX IDX_BBCADB322A4AF395 ON TerminalOmnibus.dbo.impresora (estacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_BBCADB32A9276E6C ON TerminalOmnibus.dbo.impresora (tipo_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.impresora_auxiliares definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.impresora_auxiliares;
CREATE TABLE TerminalOmnibus.dbo.impresora_auxiliares (
	id int IDENTITY(1, 1) NOT NULL,
	estacion_id bigint NOT NULL,
	impresora_boleto_id int NULL,
	impresora_encomienda_id int NULL,
	CONSTRAINT PK__impresor__3213E83F8BCCC08B PRIMARY KEY (id),
	CONSTRAINT FK_FAB47EAC1B366C2 FOREIGN KEY (impresora_boleto_id) REFERENCES TerminalOmnibus.dbo.impresora(id),
	CONSTRAINT FK_FAB47EAC2A4AF395 FOREIGN KEY (estacion_id) REFERENCES TerminalOmnibus.dbo.estacion(id),
	CONSTRAINT FK_FAB47EACA639169B FOREIGN KEY (impresora_encomienda_id) REFERENCES TerminalOmnibus.dbo.impresora(id)
);
CREATE NONCLUSTERED INDEX IDX_FAB47EAC1B366C2 ON TerminalOmnibus.dbo.impresora_auxiliares (impresora_boleto_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_FAB47EAC2A4AF395 ON TerminalOmnibus.dbo.impresora_auxiliares (estacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_FAB47EACA639169B ON TerminalOmnibus.dbo.impresora_auxiliares (impresora_encomienda_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.impresora_operaciones definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.impresora_operaciones;
CREATE TABLE TerminalOmnibus.dbo.impresora_operaciones (
	id int IDENTITY(1, 1) NOT NULL,
	estacion_id bigint NOT NULL,
	empresa_id bigint NOT NULL,
	impresora_boleto_reservacion_id int NOT NULL,
	impresora_boleto_cortesia_id int NOT NULL,
	impresora_boleto_factura_id int NOT NULL,
	impresora_encomienda_factura_id int NOT NULL,
	impresora_encomienda_cortesia_id int NOT NULL,
	impresora_encomienda_guia_interna_id int NOT NULL,
	impresora_encomienda_por_cobrar_id int NOT NULL,
	impresora_otros_id int NOT NULL,
	impresora_boleto_otros_id int NOT NULL,
	impresora_encomienda_otros_id int NOT NULL,
	impresoras_boleto bit NOT NULL,
	impresoras_encomiendas bit NOT NULL,
	auto_print_boleto bit NOT NULL,
	auto_print_encomienda bit NOT NULL,
	impresora_boleto_agencia_id int NULL,
	CONSTRAINT PK__impresor__3213E83F4DFF60CD PRIMARY KEY (id),
	CONSTRAINT FK_4E1720BC1D3841A5 FOREIGN KEY (impresora_encomienda_guia_interna_id) REFERENCES TerminalOmnibus.dbo.impresora(id),
	CONSTRAINT FK_4E1720BC2A4AF395 FOREIGN KEY (estacion_id) REFERENCES TerminalOmnibus.dbo.estacion(id),
	CONSTRAINT FK_4E1720BC2AA07423 FOREIGN KEY (impresora_boleto_reservacion_id) REFERENCES TerminalOmnibus.dbo.impresora(id),
	CONSTRAINT FK_4E1720BC2B4140AC FOREIGN KEY (impresora_boleto_factura_id) REFERENCES TerminalOmnibus.dbo.impresora(id),
	CONSTRAINT FK_4E1720BC336244A2 FOREIGN KEY (impresora_encomienda_por_cobrar_id) REFERENCES TerminalOmnibus.dbo.impresora(id),
	CONSTRAINT FK_4E1720BC521E1991 FOREIGN KEY (empresa_id) REFERENCES TerminalOmnibus.dbo.empresa(id),
	CONSTRAINT FK_4E1720BC65A679B7 FOREIGN KEY (impresora_encomienda_otros_id) REFERENCES TerminalOmnibus.dbo.impresora(id),
	CONSTRAINT FK_4E1720BC7DF9AF4D FOREIGN KEY (impresora_boleto_agencia_id) REFERENCES TerminalOmnibus.dbo.impresora(id),
	CONSTRAINT FK_4E1720BC8AFD42DB FOREIGN KEY (impresora_boleto_cortesia_id) REFERENCES TerminalOmnibus.dbo.impresora(id),
	CONSTRAINT FK_4E1720BCA4DC224D FOREIGN KEY (impresora_otros_id) REFERENCES TerminalOmnibus.dbo.impresora(id),
	CONSTRAINT FK_4E1720BCD023B08C FOREIGN KEY (impresora_encomienda_cortesia_id) REFERENCES TerminalOmnibus.dbo.impresora(id),
	CONSTRAINT FK_4E1720BCE926DDFD FOREIGN KEY (impresora_boleto_otros_id) REFERENCES TerminalOmnibus.dbo.impresora(id),
	CONSTRAINT FK_4E1720BCF06C0C52 FOREIGN KEY (impresora_encomienda_factura_id) REFERENCES TerminalOmnibus.dbo.impresora(id)
);
CREATE NONCLUSTERED INDEX IDX_4E1720BC1D3841A5 ON TerminalOmnibus.dbo.impresora_operaciones (impresora_encomienda_guia_interna_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_4E1720BC2A4AF395 ON TerminalOmnibus.dbo.impresora_operaciones (estacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_4E1720BC2AA07423 ON TerminalOmnibus.dbo.impresora_operaciones (impresora_boleto_reservacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_4E1720BC2B4140AC ON TerminalOmnibus.dbo.impresora_operaciones (impresora_boleto_factura_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_4E1720BC336244A2 ON TerminalOmnibus.dbo.impresora_operaciones (impresora_encomienda_por_cobrar_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_4E1720BC521E1991 ON TerminalOmnibus.dbo.impresora_operaciones (empresa_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_4E1720BC65A679B7 ON TerminalOmnibus.dbo.impresora_operaciones (impresora_encomienda_otros_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_4E1720BC7DF9AF4D ON TerminalOmnibus.dbo.impresora_operaciones (impresora_boleto_agencia_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_4E1720BC8AFD42DB ON TerminalOmnibus.dbo.impresora_operaciones (impresora_boleto_cortesia_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_4E1720BCA4DC224D ON TerminalOmnibus.dbo.impresora_operaciones (impresora_otros_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_4E1720BCD023B08C ON TerminalOmnibus.dbo.impresora_operaciones (impresora_encomienda_cortesia_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_4E1720BCE926DDFD ON TerminalOmnibus.dbo.impresora_operaciones (impresora_boleto_otros_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_4E1720BCF06C0C52 ON TerminalOmnibus.dbo.impresora_operaciones (impresora_encomienda_factura_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.job_jobtag definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.job_jobtag;
CREATE TABLE TerminalOmnibus.dbo.job_jobtag (
	job_id int NOT NULL,
	jobtag_id int NOT NULL,
	CONSTRAINT PK__job_jobt__599732C418A1E91A PRIMARY KEY (job_id, jobtag_id),
	CONSTRAINT FK_3E2C119B31B632FD FOREIGN KEY (jobtag_id) REFERENCES TerminalOmnibus.dbo.JobTag(id) ON DELETE CASCADE,
	CONSTRAINT FK_3E2C119BBE04EA9 FOREIGN KEY (job_id) REFERENCES TerminalOmnibus.dbo.Job(id) ON DELETE CASCADE
);
CREATE NONCLUSTERED INDEX IDX_3E2C119B31B632FD ON TerminalOmnibus.dbo.job_jobtag (jobtag_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_3E2C119BBE04EA9 ON TerminalOmnibus.dbo.job_jobtag (job_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.piloto definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.piloto;
CREATE TABLE TerminalOmnibus.dbo.piloto (
	id bigint IDENTITY(1, 1) NOT NULL,
	codigo nvarchar(10) COLLATE Modern_Spanish_CI_AS NOT NULL,
	nombre nvarchar(20) COLLATE Modern_Spanish_CI_AS NOT NULL,
	apellidos nvarchar(40) COLLATE Modern_Spanish_CI_AS NULL,
	fechaNacimiento date NULL,
	numeroLicencia nvarchar(40) COLLATE Modern_Spanish_CI_AS NOT NULL,
	fechaVencimientoLicencia date NULL,
	dpi nvarchar(40) COLLATE Modern_Spanish_CI_AS NOT NULL,
	seguroSocial nvarchar(50) COLLATE Modern_Spanish_CI_AS NULL,
	activo bit NOT NULL,
	telefono nvarchar(15) COLLATE Modern_Spanish_CI_AS NULL,
	empresa_id bigint NULL,
	nacionalidad_id smallint NULL,
	sexo_id smallint NULL,
	nombre2 nvarchar(20) COLLATE Modern_Spanish_CI_AS NULL,
	apellido2 nvarchar(40) COLLATE Modern_Spanish_CI_AS NULL,
	CONSTRAINT PK__piloto__3213E83F5847320C PRIMARY KEY (id),
	CONSTRAINT FK_8AE7BDC32B32DB58 FOREIGN KEY (sexo_id) REFERENCES TerminalOmnibus.dbo.sexo(id),
	CONSTRAINT FK_8AE7BDC3521E1991 FOREIGN KEY (empresa_id) REFERENCES TerminalOmnibus.dbo.empresa(id),
	CONSTRAINT FK_8AE7BDC3AB8DC0F8 FOREIGN KEY (nacionalidad_id) REFERENCES TerminalOmnibus.dbo.nacionalidad(id)
);
CREATE NONCLUSTERED INDEX IDX_8AE7BDC32B32DB58 ON TerminalOmnibus.dbo.piloto (sexo_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_8AE7BDC3521E1991 ON TerminalOmnibus.dbo.piloto (empresa_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_8AE7BDC3AB8DC0F8 ON TerminalOmnibus.dbo.piloto (nacionalidad_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_8AE7BDC320332D99 ON TerminalOmnibus.dbo.piloto (codigo ASC)
WHERE ([codigo] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.ruta definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.ruta;
CREATE TABLE TerminalOmnibus.dbo.ruta (
	codigo nvarchar(6) COLLATE Modern_Spanish_CI_AS NOT NULL,
	estacion_origen_id bigint NULL,
	estacion_destino_id bigint NULL,
	nombre nvarchar(255) COLLATE Modern_Spanish_CI_AS NOT NULL,
	kilometros int NOT NULL,
	descripcion varchar(MAX) COLLATE Modern_Spanish_CI_AS NOT NULL,
	activo bit NOT NULL,
	internacional bit NULL,
	obligatorioClienteDetalle bit NULL,
	codigoFrontera nvarchar(10) COLLATE Modern_Spanish_CI_AS NULL,
	CONSTRAINT PK__ruta__40F9A207AD46D00A PRIMARY KEY (codigo),
	CONSTRAINT FK_C3AEF08C59A7CA66 FOREIGN KEY (estacion_destino_id) REFERENCES TerminalOmnibus.dbo.estacion(id),
	CONSTRAINT FK_C3AEF08CBF6CF13D FOREIGN KEY (estacion_origen_id) REFERENCES TerminalOmnibus.dbo.estacion(id)
);
CREATE NONCLUSTERED INDEX IDX_C3AEF08C59A7CA66 ON TerminalOmnibus.dbo.ruta (estacion_destino_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_C3AEF08CBF6CF13D ON TerminalOmnibus.dbo.ruta (estacion_origen_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.ruta_estacion_item definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.ruta_estacion_item;
CREATE TABLE TerminalOmnibus.dbo.ruta_estacion_item (
	id bigint IDENTITY(1, 1) NOT NULL,
	ruta_codigo nvarchar(6) COLLATE Modern_Spanish_CI_AS NOT NULL,
	estacion_id bigint NOT NULL,
	posicion int NULL,
	CONSTRAINT PK__ruta_est__3213E83F3CB71A07 PRIMARY KEY (id),
	CONSTRAINT FK_EB308E3E28CB339A FOREIGN KEY (ruta_codigo) REFERENCES TerminalOmnibus.dbo.ruta(codigo),
	CONSTRAINT FK_EB308E3E2A4AF395 FOREIGN KEY (estacion_id) REFERENCES TerminalOmnibus.dbo.estacion(id)
);
CREATE NONCLUSTERED INDEX IDX_EB308E3E28CB339A ON TerminalOmnibus.dbo.ruta_estacion_item (ruta_codigo ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_EB308E3E2A4AF395 ON TerminalOmnibus.dbo.ruta_estacion_item (estacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.ruta_estaciones_intermedias definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.ruta_estaciones_intermedias;
CREATE TABLE TerminalOmnibus.dbo.ruta_estaciones_intermedias (
	ruta_codigo nvarchar(6) COLLATE Modern_Spanish_CI_AS NOT NULL,
	estacion_id bigint NOT NULL,
	CONSTRAINT PK__ruta_est__E79F7844820B64E5 PRIMARY KEY (ruta_codigo, estacion_id),
	CONSTRAINT FK_3F2DD228CB339A FOREIGN KEY (ruta_codigo) REFERENCES TerminalOmnibus.dbo.ruta(codigo),
	CONSTRAINT FK_3F2DD22A4AF395 FOREIGN KEY (estacion_id) REFERENCES TerminalOmnibus.dbo.estacion(id)
);
CREATE NONCLUSTERED INDEX IDX_3F2DD228CB339A ON TerminalOmnibus.dbo.ruta_estaciones_intermedias (ruta_codigo ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_3F2DD22A4AF395 ON TerminalOmnibus.dbo.ruta_estaciones_intermedias (estacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.sistema definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.sistema;
CREATE TABLE TerminalOmnibus.dbo.sistema (
	codigo nvarchar(40) COLLATE Modern_Spanish_CI_AS NOT NULL,
	estacion_id bigint NOT NULL,
	valor nvarchar(100) COLLATE Modern_Spanish_CI_AS NOT NULL,
	CONSTRAINT PK__sistema__E7F03AD91B2636D0 PRIMARY KEY (codigo, estacion_id),
	CONSTRAINT FK_91C2AB612A4AF395 FOREIGN KEY (estacion_id) REFERENCES TerminalOmnibus.dbo.estacion(id)
);
CREATE NONCLUSTERED INDEX IDX_91C2AB612A4AF395 ON TerminalOmnibus.dbo.sistema (estacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.tiempo definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.tiempo;
CREATE TABLE TerminalOmnibus.dbo.tiempo (
	id int IDENTITY(1, 1) NOT NULL,
	ruta_codigo nvarchar(6) COLLATE Modern_Spanish_CI_AS NULL,
	estacion_destino_id bigint NULL,
	clasebus_id bigint NULL,
	minutos int NOT NULL,
	CONSTRAINT PK__tiempo__3213E83F6DF47712 PRIMARY KEY (id),
	CONSTRAINT FK_B96A13528CB339A FOREIGN KEY (ruta_codigo) REFERENCES TerminalOmnibus.dbo.ruta(codigo),
	CONSTRAINT FK_B96A1354DA71743 FOREIGN KEY (clasebus_id) REFERENCES TerminalOmnibus.dbo.bus_clase(id),
	CONSTRAINT FK_B96A13559A7CA66 FOREIGN KEY (estacion_destino_id) REFERENCES TerminalOmnibus.dbo.estacion(id)
);
CREATE NONCLUSTERED INDEX IDX_B96A13528CB339A ON TerminalOmnibus.dbo.tiempo (ruta_codigo ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_B96A1354DA71743 ON TerminalOmnibus.dbo.tiempo (clasebus_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_B96A13559A7CA66 ON TerminalOmnibus.dbo.tiempo (estacion_destino_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.tipo_cambio definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.tipo_cambio;
CREATE TABLE TerminalOmnibus.dbo.tipo_cambio (
	id int IDENTITY(1, 1) NOT NULL,
	moneda_id int NOT NULL,
	tipo_tipo_cambio_id int NOT NULL,
	fecha date NOT NULL,
	tasa numeric(10, 8) NOT NULL,
	CONSTRAINT PK__tipo_cam__3213E83F8B28A0F6 PRIMARY KEY (id),
	CONSTRAINT FK_E564E8053021143B FOREIGN KEY (tipo_tipo_cambio_id) REFERENCES TerminalOmnibus.dbo.tipo_cambio_tipo(id),
	CONSTRAINT FK_E564E805B77634D2 FOREIGN KEY (moneda_id) REFERENCES TerminalOmnibus.dbo.moneda(id)
);
CREATE NONCLUSTERED INDEX IDX_E564E8053021143B ON TerminalOmnibus.dbo.tipo_cambio (tipo_tipo_cambio_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_E564E805B77634D2 ON TerminalOmnibus.dbo.tipo_cambio (moneda_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.agencia_credito definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.agencia_credito;
CREATE TABLE TerminalOmnibus.dbo.agencia_credito (
	id bigint IDENTITY(1, 1) NOT NULL,
	estacion_id bigint NOT NULL,
	importe numeric(7, 2) NOT NULL,
	CONSTRAINT PK__agencia___3213E83F171ED5BC PRIMARY KEY (id),
	CONSTRAINT FK_FC19971F2A4AF395 FOREIGN KEY (estacion_id) REFERENCES TerminalOmnibus.dbo.estacion(id)
);
CREATE NONCLUSTERED INDEX IDX_FC19971F2A4AF395 ON TerminalOmnibus.dbo.agencia_credito (estacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.boleto_voucher_internet definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.boleto_voucher_internet;
CREATE TABLE TerminalOmnibus.dbo.boleto_voucher_internet (
	id bigint IDENTITY(1, 1) NOT NULL,
	empresa_id bigint NOT NULL,
	moneda_id int NOT NULL,
	estacion_id bigint NOT NULL,
	importeTotal numeric(10, 2) NOT NULL,
	fecha datetime2(6) NOT NULL,
	CONSTRAINT PK__boleto_v__3213E83FEC15B281 PRIMARY KEY (id),
	CONSTRAINT FK_5496529A2A4AF395 FOREIGN KEY (estacion_id) REFERENCES TerminalOmnibus.dbo.estacion(id),
	CONSTRAINT FK_5496529A521E1991 FOREIGN KEY (empresa_id) REFERENCES TerminalOmnibus.dbo.empresa(id),
	CONSTRAINT FK_5496529AB77634D2 FOREIGN KEY (moneda_id) REFERENCES TerminalOmnibus.dbo.moneda(id)
);
CREATE NONCLUSTERED INDEX IDX_5496529A2A4AF395 ON TerminalOmnibus.dbo.boleto_voucher_internet (estacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_5496529A521E1991 ON TerminalOmnibus.dbo.boleto_voucher_internet (empresa_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_5496529AB77634D2 ON TerminalOmnibus.dbo.boleto_voucher_internet (moneda_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.bus definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.bus;
CREATE TABLE TerminalOmnibus.dbo.bus (
	codigo nvarchar(6) COLLATE Modern_Spanish_CI_AS NOT NULL,
	marca_id bigint NOT NULL,
	estado_id bigint NOT NULL,
	piloto_id bigint NULL,
	placa nvarchar(10) COLLATE Modern_Spanish_CI_AS NOT NULL,
	numeroSeguro nvarchar(30) COLLATE Modern_Spanish_CI_AS NULL,
	numeroTarjetaRodaje nvarchar(30) COLLATE Modern_Spanish_CI_AS NULL,
	numeroTarjetaOperaciones nvarchar(30) COLLATE Modern_Spanish_CI_AS NULL,
	descripcion varchar(MAX) COLLATE Modern_Spanish_CI_AS NULL,
	anoFabricacion int NOT NULL,
	tipo_id bigint NOT NULL,
	empresa_id bigint NOT NULL,
	fechaVencimientoTarjetaOperaciones date NULL,
	piloto_aux_id bigint NULL,
	CONSTRAINT PK__bus__40F9A207357E8FFA PRIMARY KEY (codigo),
	CONSTRAINT FK_2F566B69521E1991 FOREIGN KEY (empresa_id) REFERENCES TerminalOmnibus.dbo.empresa(id),
	CONSTRAINT FK_2F566B6981EF0041 FOREIGN KEY (marca_id) REFERENCES TerminalOmnibus.dbo.bus_marca(id),
	CONSTRAINT FK_2F566B699AAD4A8D FOREIGN KEY (piloto_id) REFERENCES TerminalOmnibus.dbo.piloto(id),
	CONSTRAINT FK_2F566B699F5A440B FOREIGN KEY (estado_id) REFERENCES TerminalOmnibus.dbo.bus_estado(id),
	CONSTRAINT FK_2F566B69A9276E6C FOREIGN KEY (tipo_id) REFERENCES TerminalOmnibus.dbo.bus_tipo(id),
	CONSTRAINT FK_2F566B69CE51A91C FOREIGN KEY (piloto_aux_id) REFERENCES TerminalOmnibus.dbo.piloto(id)
);
CREATE NONCLUSTERED INDEX IDX_2F566B69521E1991 ON TerminalOmnibus.dbo.bus (empresa_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_2F566B6981EF0041 ON TerminalOmnibus.dbo.bus (marca_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_2F566B699AAD4A8D ON TerminalOmnibus.dbo.bus (piloto_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_2F566B699F5A440B ON TerminalOmnibus.dbo.bus (estado_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_2F566B69A9276E6C ON TerminalOmnibus.dbo.bus (tipo_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_2F566B69CE51A91C ON TerminalOmnibus.dbo.bus (piloto_aux_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_2F566B695264C407 ON TerminalOmnibus.dbo.bus (numeroTarjetaRodaje ASC)
WHERE ([numeroTarjetaRodaje] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_2F566B69737097D4 ON TerminalOmnibus.dbo.bus (placa ASC)
WHERE ([placa] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_2F566B697BA2E6DA ON TerminalOmnibus.dbo.bus (numeroSeguro ASC)
WHERE ([numeroSeguro] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_2F566B69AC006394 ON TerminalOmnibus.dbo.bus (numeroTarjetaOperaciones ASC)
WHERE ([numeroTarjetaOperaciones] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.bus_asiento definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.bus_asiento;
CREATE TABLE TerminalOmnibus.dbo.bus_asiento (
	id bigint IDENTITY(1, 1) NOT NULL,
	clase_id bigint NULL,
	nivel2 bit NOT NULL,
	numero int NOT NULL,
	coordenadaX int NOT NULL,
	coordenadaY int NOT NULL,
	tipoBus_id bigint NULL,
	CONSTRAINT PK__bus_asie__3213E83F33FA7A2B PRIMARY KEY (id),
	CONSTRAINT FK_DACDC2919F720353 FOREIGN KEY (clase_id) REFERENCES TerminalOmnibus.dbo.clase_asiento(id),
	CONSTRAINT FK_DACDC291AE6E007F FOREIGN KEY (tipoBus_id) REFERENCES TerminalOmnibus.dbo.bus_tipo(id)
);
CREATE NONCLUSTERED INDEX IDX_DACDC291AE6E007F ON TerminalOmnibus.dbo.bus_asiento (tipoBus_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX bus_asiento_clase_id_IDX ON TerminalOmnibus.dbo.bus_asiento (clase_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.bus_senal definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.bus_senal;
CREATE TABLE TerminalOmnibus.dbo.bus_senal (
	id bigint IDENTITY(1, 1) NOT NULL,
	nivel2 bit NOT NULL,
	tipoBus_id bigint NULL,
	tipo_id bigint NULL,
	coordenadaX int NOT NULL,
	coordenadaY int NOT NULL,
	CONSTRAINT PK__bus_sena__3213E83F9256D260 PRIMARY KEY (id),
	CONSTRAINT FK_98555E7DA9276E6C FOREIGN KEY (tipo_id) REFERENCES TerminalOmnibus.dbo.bus_senal_tipo(id),
	CONSTRAINT FK_98555E7DAE6E007F FOREIGN KEY (tipoBus_id) REFERENCES TerminalOmnibus.dbo.bus_tipo(id)
);
CREATE NONCLUSTERED INDEX IDX_98555E7DA9276E6C ON TerminalOmnibus.dbo.bus_senal (tipo_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_98555E7DAE6E007F ON TerminalOmnibus.dbo.bus_senal (tipoBus_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.bus_servicio_union definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.bus_servicio_union;
CREATE TABLE TerminalOmnibus.dbo.bus_servicio_union (
	bus_id bigint NOT NULL,
	servicio_id bigint NOT NULL,
	CONSTRAINT PK__bus_serv__B03D587D053CF070 PRIMARY KEY (bus_id, servicio_id),
	CONSTRAINT FK_80A99D5F2546731D FOREIGN KEY (bus_id) REFERENCES TerminalOmnibus.dbo.bus_tipo(id),
	CONSTRAINT FK_80A99D5F71CAA3E7 FOREIGN KEY (servicio_id) REFERENCES TerminalOmnibus.dbo.bus_servicio(id)
);
CREATE NONCLUSTERED INDEX IDX_80A99D5F2546731D ON TerminalOmnibus.dbo.bus_servicio_union (bus_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_80A99D5F71CAA3E7 ON TerminalOmnibus.dbo.bus_servicio_union (servicio_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.calendario_factura_ruta definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.calendario_factura_ruta;
CREATE TABLE TerminalOmnibus.dbo.calendario_factura_ruta (
	id bigint IDENTITY(1, 1) NOT NULL,
	ruta_codigo nvarchar(6) COLLATE Modern_Spanish_CI_AS NOT NULL,
	empresa_id bigint NULL,
	constante bit NOT NULL,
	CONSTRAINT PK__calendar__3213E83F4C45019F PRIMARY KEY (id),
	CONSTRAINT FK_BC3BD21628CB339A FOREIGN KEY (ruta_codigo) REFERENCES TerminalOmnibus.dbo.ruta(codigo),
	CONSTRAINT FK_BC3BD216521E1991 FOREIGN KEY (empresa_id) REFERENCES TerminalOmnibus.dbo.empresa(id)
);
CREATE NONCLUSTERED INDEX IDX_BC3BD21628CB339A ON TerminalOmnibus.dbo.calendario_factura_ruta (ruta_codigo ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_BC3BD216521E1991 ON TerminalOmnibus.dbo.calendario_factura_ruta (empresa_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.custom_user definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.custom_user;
CREATE TABLE TerminalOmnibus.dbo.custom_user (
	id bigint IDENTITY(1, 1) NOT NULL,
	username nvarchar(255) COLLATE Modern_Spanish_CI_AS NOT NULL,
	username_canonical nvarchar(255) COLLATE Modern_Spanish_CI_AS NOT NULL,
	email nvarchar(255) COLLATE Modern_Spanish_CI_AS NOT NULL,
	email_canonical nvarchar(255) COLLATE Modern_Spanish_CI_AS NOT NULL,
	enabled bit NOT NULL,
	salt nvarchar(255) COLLATE Modern_Spanish_CI_AS NOT NULL,
	password nvarchar(255) COLLATE Modern_Spanish_CI_AS NOT NULL,
	last_login datetime2(6) NULL,
	locked bit NOT NULL,
	expired bit NOT NULL,
	expires_at datetime2(6) NULL,
	confirmation_token nvarchar(255) COLLATE Modern_Spanish_CI_AS NULL,
	password_requested_at datetime2(6) NULL,
	roles varchar(MAX) COLLATE Modern_Spanish_CI_AS NOT NULL,
	credentials_expired bit NOT NULL,
	credentials_expire_at datetime2(6) NULL,
	names nvarchar(100) COLLATE Modern_Spanish_CI_AS NOT NULL,
	surnames nvarchar(100) COLLATE Modern_Spanish_CI_AS NOT NULL,
	ipRanges varchar(MAX) COLLATE Modern_Spanish_CI_AS NULL,
	dateCreate datetime2(6) NOT NULL,
	dateLastUdate datetime2(6) NOT NULL,
	phone nvarchar(15) COLLATE Modern_Spanish_CI_AS NULL,
	estacion_id bigint NULL,
	intentosFallidos int NOT NULL,
	accessAppWeb bit NOT NULL,
	accessAppMovil bit NOT NULL,
	voucherPermitidosEnElDia int NULL,
	reasignaciones int NULL,
	CONSTRAINT PK__custom_u__3213E83F6DC68FF0 PRIMARY KEY (id),
	CONSTRAINT FK_8CE51EB42A4AF395 FOREIGN KEY (estacion_id) REFERENCES TerminalOmnibus.dbo.estacion(id)
);
CREATE NONCLUSTERED INDEX IDX_8CE51EB42A4AF395 ON TerminalOmnibus.dbo.custom_user (estacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_8CE51EB492FC23A8 ON TerminalOmnibus.dbo.custom_user (username_canonical ASC)
WHERE ([username_canonical] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_8CE51EB4A0D96FBF ON TerminalOmnibus.dbo.custom_user (email_canonical ASC)
WHERE ([email_canonical] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.custom_user_empresa definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.custom_user_empresa;
CREATE TABLE TerminalOmnibus.dbo.custom_user_empresa (
	user_id bigint NOT NULL,
	empresa_id bigint NOT NULL,
	CONSTRAINT PK__custom_u__8C8889454663A9AB PRIMARY KEY (user_id, empresa_id),
	CONSTRAINT FK_9B5D5341521E1991 FOREIGN KEY (empresa_id) REFERENCES TerminalOmnibus.dbo.empresa(id),
	CONSTRAINT FK_9B5D5341A76ED395 FOREIGN KEY (user_id) REFERENCES TerminalOmnibus.dbo.custom_user(id)
);
CREATE NONCLUSTERED INDEX IDX_9B5D5341521E1991 ON TerminalOmnibus.dbo.custom_user_empresa (empresa_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_9B5D5341A76ED395 ON TerminalOmnibus.dbo.custom_user_empresa (user_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.custom_user_estacion definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.custom_user_estacion;
CREATE TABLE TerminalOmnibus.dbo.custom_user_estacion (
	user_id bigint NOT NULL,
	estacion_id bigint NOT NULL,
	CONSTRAINT PK__custom_u__1EB7AFD1010F3C69 PRIMARY KEY (user_id, estacion_id),
	CONSTRAINT FK_582193A42A4AF395 FOREIGN KEY (estacion_id) REFERENCES TerminalOmnibus.dbo.estacion(id),
	CONSTRAINT FK_582193A4A76ED395 FOREIGN KEY (user_id) REFERENCES TerminalOmnibus.dbo.custom_user(id)
);
CREATE NONCLUSTERED INDEX IDX_582193A42A4AF395 ON TerminalOmnibus.dbo.custom_user_estacion (estacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_582193A4A76ED395 ON TerminalOmnibus.dbo.custom_user_estacion (user_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.factura definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.factura;
CREATE TABLE TerminalOmnibus.dbo.factura (
	id bigint IDENTITY(1, 1) NOT NULL,
	estacion_id bigint NOT NULL,
	empresa_id bigint NOT NULL,
	serieResolucionFactura nvarchar(6) COLLATE Modern_Spanish_CI_AS NOT NULL,
	activo bit NOT NULL,
	nombreResolucionFactura nvarchar(255) COLLATE Modern_Spanish_CI_AS NOT NULL,
	fechaEmisionResolucionFactura date NOT NULL,
	nombreResolucionSISTEMA nvarchar(255) COLLATE Modern_Spanish_CI_AS NOT NULL,
	fechaEmisionResolucionSISTEMA date NOT NULL,
	fechaVencimientoResolucionFactura date NOT NULL,
	fechaVencimientoResolucionSISTEMA date NOT NULL,
	minimoResolucionFactura bigint NOT NULL,
	maximoResolucionFactura bigint NOT NULL,
	valorResolucionFactura bigint NOT NULL,
	servicio_estacion_id bigint NOT NULL,
	impresora_id int NULL,
	CONSTRAINT PK__factura__3213E83F28BEDF52 PRIMARY KEY (id),
	CONSTRAINT FK_F9EBA0092A4AF395 FOREIGN KEY (estacion_id) REFERENCES TerminalOmnibus.dbo.estacion(id),
	CONSTRAINT FK_F9EBA009521E1991 FOREIGN KEY (empresa_id) REFERENCES TerminalOmnibus.dbo.empresa(id),
	CONSTRAINT FK_F9EBA00958D3C30F FOREIGN KEY (impresora_id) REFERENCES TerminalOmnibus.dbo.impresora(id),
	CONSTRAINT FK_F9EBA00986D7488C FOREIGN KEY (servicio_estacion_id) REFERENCES TerminalOmnibus.dbo.estacion_servicio(id)
);
CREATE NONCLUSTERED INDEX IDX_F9EBA0092A4AF395 ON TerminalOmnibus.dbo.factura (estacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_F9EBA009521E1991 ON TerminalOmnibus.dbo.factura (empresa_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_F9EBA00958D3C30F ON TerminalOmnibus.dbo.factura (impresora_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_F9EBA00986D7488C ON TerminalOmnibus.dbo.factura (servicio_estacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.factura_generada definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.factura_generada;
CREATE TABLE TerminalOmnibus.dbo.factura_generada (
	id bigint IDENTITY(1, 1) NOT NULL,
	factura_id bigint NOT NULL,
	servicio_estacion_id bigint NOT NULL,
	usuario_id bigint NOT NULL,
	estacion_id bigint NOT NULL,
	consecutivo bigint NULL,
	moneda_id int NOT NULL,
	tipo_cambio_id int NOT NULL,
	importeTotal numeric(10, 2) NOT NULL,
	fecha datetime2(6) NOT NULL,
	autorizacionTarjeta nvarchar(20) COLLATE Modern_Spanish_CI_AS NULL,
	referenciaExterna nvarchar(20) COLLATE Modern_Spanish_CI_AS NULL,
	fecha_creacion datetime2(6) NULL,
	observacion varchar(MAX) COLLATE Modern_Spanish_CI_AS NULL,
	usuario_anulacion_id bigint NULL,
	fecha_anulacion datetime2(6) NULL,
	sAutorizacionUUIDsat nvarchar(255) COLLATE Modern_Spanish_CI_AS NULL,
	sNumeroDTEsat bigint NULL,
	sSerieDTEsat nvarchar(255) COLLATE Modern_Spanish_CI_AS NULL,
	sFechaCertificaDTEsat datetime2(6) NULL,
	CONSTRAINT PK__factura___3213E83F971753BC PRIMARY KEY (id),
	CONSTRAINT FK_ADBD1B782A4AF395 FOREIGN KEY (estacion_id) REFERENCES TerminalOmnibus.dbo.estacion(id),
	CONSTRAINT FK_ADBD1B7886D7488C FOREIGN KEY (servicio_estacion_id) REFERENCES TerminalOmnibus.dbo.estacion_servicio(id),
	CONSTRAINT FK_ADBD1B78B77634D2 FOREIGN KEY (moneda_id) REFERENCES TerminalOmnibus.dbo.moneda(id),
	CONSTRAINT FK_ADBD1B78BAF036CE FOREIGN KEY (usuario_anulacion_id) REFERENCES TerminalOmnibus.dbo.custom_user(id),
	CONSTRAINT FK_ADBD1B78BCF2DB9B FOREIGN KEY (tipo_cambio_id) REFERENCES TerminalOmnibus.dbo.tipo_cambio(id),
	CONSTRAINT FK_ADBD1B78DB38439E FOREIGN KEY (usuario_id) REFERENCES TerminalOmnibus.dbo.custom_user(id),
	CONSTRAINT FK_ADBD1B78F04F795F FOREIGN KEY (factura_id) REFERENCES TerminalOmnibus.dbo.factura(id)
);
CREATE UNIQUE NONCLUSTERED INDEX CUSTOM_IDX_FACTURA_CONSECUTIVO ON TerminalOmnibus.dbo.factura_generada (factura_id ASC, consecutivo ASC)
WHERE (
		[factura_id] IS NOT NULL
		AND [consecutivo] IS NOT NULL
	) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_ADBD1B782A4AF395 ON TerminalOmnibus.dbo.factura_generada (estacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_ADBD1B7886D7488C ON TerminalOmnibus.dbo.factura_generada (servicio_estacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_ADBD1B78B77634D2 ON TerminalOmnibus.dbo.factura_generada (moneda_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_ADBD1B78BAF036CE ON TerminalOmnibus.dbo.factura_generada (usuario_anulacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_ADBD1B78BCF2DB9B ON TerminalOmnibus.dbo.factura_generada (tipo_cambio_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_ADBD1B78DB38439E ON TerminalOmnibus.dbo.factura_generada (usuario_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_ADBD1B78F04F795F ON TerminalOmnibus.dbo.factura_generada (factura_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.itineario definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.itineario;
CREATE TABLE TerminalOmnibus.dbo.itineario (
	id bigint IDENTITY(1, 1) NOT NULL,
	ruta_codigo nvarchar(6) COLLATE Modern_Spanish_CI_AS NULL,
	tipo_bus_id bigint NULL,
	activo bit NOT NULL,
	tipoItinerario int NOT NULL,
	empresa_id bigint NULL,
	CONSTRAINT PK__itineari__3213E83FD870BE58 PRIMARY KEY (id),
	CONSTRAINT FK_FE0CA36528CB339A FOREIGN KEY (ruta_codigo) REFERENCES TerminalOmnibus.dbo.ruta(codigo),
	CONSTRAINT FK_FE0CA365521E1991 FOREIGN KEY (empresa_id) REFERENCES TerminalOmnibus.dbo.empresa(id),
	CONSTRAINT FK_FE0CA365B0FF8505 FOREIGN KEY (tipo_bus_id) REFERENCES TerminalOmnibus.dbo.bus_tipo(id)
);
CREATE NONCLUSTERED INDEX IDX_FE0CA36528CB339A ON TerminalOmnibus.dbo.itineario (ruta_codigo ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_FE0CA365521E1991 ON TerminalOmnibus.dbo.itineario (empresa_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_FE0CA365B0FF8505 ON TerminalOmnibus.dbo.itineario (tipo_bus_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.itineario_especial definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.itineario_especial;
CREATE TABLE TerminalOmnibus.dbo.itineario_especial (
	id bigint NOT NULL,
	estacion_origen_id bigint NULL,
	fecha datetime2(6) NOT NULL,
	motivo varchar(MAX) COLLATE Modern_Spanish_CI_AS NOT NULL,
	CONSTRAINT PK__itineari__3213E83FD36E58BB PRIMARY KEY (id),
	CONSTRAINT FK_D8E0E2D2BF396750 FOREIGN KEY (id) REFERENCES TerminalOmnibus.dbo.itineario(id) ON DELETE CASCADE,
	CONSTRAINT FK_D8E0E2D2BF6CF13D FOREIGN KEY (estacion_origen_id) REFERENCES TerminalOmnibus.dbo.estacion(id)
);
CREATE NONCLUSTERED INDEX IDX_D8E0E2D2BF6CF13D ON TerminalOmnibus.dbo.itineario_especial (estacion_origen_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.itinerario_ciclico definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.itinerario_ciclico;
CREATE TABLE TerminalOmnibus.dbo.itinerario_ciclico (
	id bigint NOT NULL,
	dia_semana_id int NULL,
	horario_ciclico_id bigint NULL,
	CONSTRAINT PK__itinerar__3213E83F62777E98 PRIMARY KEY (id),
	CONSTRAINT FK_2F45B236614C1943 FOREIGN KEY (horario_ciclico_id) REFERENCES TerminalOmnibus.dbo.horario_ciclico(id),
	CONSTRAINT FK_2F45B236BF396750 FOREIGN KEY (id) REFERENCES TerminalOmnibus.dbo.itineario(id) ON DELETE CASCADE,
	CONSTRAINT FK_2F45B236E9F4D193 FOREIGN KEY (dia_semana_id) REFERENCES TerminalOmnibus.dbo.dia_semana(id)
);
CREATE NONCLUSTERED INDEX IDX_2F45B236614C1943 ON TerminalOmnibus.dbo.itinerario_ciclico (horario_ciclico_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_2F45B236E9F4D193 ON TerminalOmnibus.dbo.itinerario_ciclico (dia_semana_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.job_sync definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.job_sync;
CREATE TABLE TerminalOmnibus.dbo.job_sync (
	id bigint IDENTITY(1, 1) NOT NULL,
	usuario_creacion_id bigint NULL,
	nivel int NOT NULL,
	web1estado smallint NOT NULL,
	web2estado smallint NOT NULL,
	[data] varchar(MAX) COLLATE Modern_Spanish_CI_AS NOT NULL,
	fecha_creacion datetime2(6) NOT NULL,
	web3estado smallint NOT NULL,
	web4estado smallint NOT NULL,
	[type] nvarchar(6) COLLATE Modern_Spanish_CI_AS NULL,
	CONSTRAINT PK__job_sync__3213E83F7A531DC9 PRIMARY KEY (id),
	CONSTRAINT FK_ABE7833BAEADF654 FOREIGN KEY (usuario_creacion_id) REFERENCES TerminalOmnibus.dbo.custom_user(id)
);
CREATE NONCLUSTERED INDEX IDX_ABE7833BAEADF654 ON TerminalOmnibus.dbo.job_sync (usuario_creacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.salida definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.salida;
CREATE TABLE TerminalOmnibus.dbo.salida (
	id bigint IDENTITY(1, 1) NOT NULL,
	itinerario_id bigint NOT NULL,
	tipo_bus_id bigint NOT NULL,
	estado_id bigint NOT NULL,
	bus_codigo nvarchar(6) COLLATE Modern_Spanish_CI_AS NULL,
	piloto_id bigint NULL,
	fecha datetime2(6) NOT NULL,
	reasignado bit NOT NULL,
	motivoReasignado varchar(MAX) COLLATE Modern_Spanish_CI_AS NULL,
	empresa_id bigint NULL,
	piloto_aux_id bigint NULL,
	cancelacion_interna bit NULL,
	CONSTRAINT PK__salida__3213E83F45F87FF6 PRIMARY KEY (id),
	CONSTRAINT FK_95F4C748521E1991 FOREIGN KEY (empresa_id) REFERENCES TerminalOmnibus.dbo.empresa(id),
	CONSTRAINT FK_95F4C7489AAD4A8D FOREIGN KEY (piloto_id) REFERENCES TerminalOmnibus.dbo.piloto(id),
	CONSTRAINT FK_95F4C7489F5A440B FOREIGN KEY (estado_id) REFERENCES TerminalOmnibus.dbo.salida_estado(id),
	CONSTRAINT FK_95F4C748B0FF8505 FOREIGN KEY (tipo_bus_id) REFERENCES TerminalOmnibus.dbo.bus_tipo(id),
	CONSTRAINT FK_95F4C748B824E717 FOREIGN KEY (itinerario_id) REFERENCES TerminalOmnibus.dbo.itineario(id),
	CONSTRAINT FK_95F4C748CE51A91C FOREIGN KEY (piloto_aux_id) REFERENCES TerminalOmnibus.dbo.piloto(id),
	CONSTRAINT FK_95F4C748EA1FB9B6 FOREIGN KEY (bus_codigo) REFERENCES TerminalOmnibus.dbo.bus(codigo)
);
CREATE NONCLUSTERED INDEX IDX_95F4C748521E1991 ON TerminalOmnibus.dbo.salida (empresa_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_95F4C7489AAD4A8D ON TerminalOmnibus.dbo.salida (piloto_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_95F4C7489F5A440B ON TerminalOmnibus.dbo.salida (estado_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_95F4C748B0FF8505 ON TerminalOmnibus.dbo.salida (tipo_bus_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_95F4C748B824E717 ON TerminalOmnibus.dbo.salida (itinerario_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_95F4C748CE51A91C ON TerminalOmnibus.dbo.salida (piloto_aux_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_95F4C748EA1FB9B6 ON TerminalOmnibus.dbo.salida (bus_codigo ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.salida_bitacora definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.salida_bitacora;
CREATE TABLE TerminalOmnibus.dbo.salida_bitacora (
	id bigint IDENTITY(1, 1) NOT NULL,
	salida_id bigint NOT NULL,
	estado_id bigint NOT NULL,
	usuario_id bigint NULL,
	fecha datetime2(6) NOT NULL,
	descripcion nvarchar(255) COLLATE Modern_Spanish_CI_AS NOT NULL,
	CONSTRAINT PK__salida_b__3213E83FB3954D0C PRIMARY KEY (id),
	CONSTRAINT FK_76F4CD9226A36E51 FOREIGN KEY (salida_id) REFERENCES TerminalOmnibus.dbo.salida(id) ON DELETE CASCADE,
	CONSTRAINT FK_76F4CD929F5A440B FOREIGN KEY (estado_id) REFERENCES TerminalOmnibus.dbo.salida_estado(id),
	CONSTRAINT FK_76F4CD92DB38439E FOREIGN KEY (usuario_id) REFERENCES TerminalOmnibus.dbo.custom_user(id)
);
CREATE NONCLUSTERED INDEX IDX_76F4CD9226A36E51 ON TerminalOmnibus.dbo.salida_bitacora (salida_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_76F4CD929F5A440B ON TerminalOmnibus.dbo.salida_bitacora (estado_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_76F4CD92DB38439E ON TerminalOmnibus.dbo.salida_bitacora (usuario_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.tarifas_boleto definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.tarifas_boleto;
CREATE TABLE TerminalOmnibus.dbo.tarifas_boleto (
	id bigint IDENTITY(1, 1) NOT NULL,
	estacion_origen_id bigint NOT NULL,
	estacion_destino_id bigint NOT NULL,
	clase_asiento_id bigint NOT NULL,
	usuario_creacion bigint NOT NULL,
	fechaEfectividad datetime2(6) NOT NULL,
	tarifaValor numeric(7, 2) NOT NULL,
	fecha_creacion datetime2(6) NOT NULL,
	clase_bus_id bigint NOT NULL,
	horaInicialSalida time(0) NULL,
	horaFinalSalida time(0) NULL,
	agencia_tarifa_moneda_base numeric(7, 2) NULL,
	CONSTRAINT PK__tarifas___3213E83FF0DAC045 PRIMARY KEY (id),
	CONSTRAINT FK_85BAD0EF50CE0909 FOREIGN KEY (clase_bus_id) REFERENCES TerminalOmnibus.dbo.bus_clase(id),
	CONSTRAINT FK_85BAD0EF59A7CA66 FOREIGN KEY (estacion_destino_id) REFERENCES TerminalOmnibus.dbo.estacion(id),
	CONSTRAINT FK_85BAD0EF72E118CB FOREIGN KEY (usuario_creacion) REFERENCES TerminalOmnibus.dbo.custom_user(id),
	CONSTRAINT FK_85BAD0EF936A4916 FOREIGN KEY (clase_asiento_id) REFERENCES TerminalOmnibus.dbo.clase_asiento(id),
	CONSTRAINT FK_85BAD0EFBF6CF13D FOREIGN KEY (estacion_origen_id) REFERENCES TerminalOmnibus.dbo.estacion(id)
);
CREATE NONCLUSTERED INDEX IDX_85BAD0EF50CE0909 ON TerminalOmnibus.dbo.tarifas_boleto (clase_bus_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_85BAD0EF59A7CA66 ON TerminalOmnibus.dbo.tarifas_boleto (estacion_destino_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_85BAD0EF72E118CB ON TerminalOmnibus.dbo.tarifas_boleto (usuario_creacion ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_85BAD0EF936A4916 ON TerminalOmnibus.dbo.tarifas_boleto (clase_asiento_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_85BAD0EFBF6CF13D ON TerminalOmnibus.dbo.tarifas_boleto (estacion_origen_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.tarifas_encomienda definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.tarifas_encomienda;
CREATE TABLE TerminalOmnibus.dbo.tarifas_encomienda (
	id bigint IDENTITY(1, 1) NOT NULL,
	usuario_creacion bigint NOT NULL,
	fecha_creacion datetime2(6) NOT NULL,
	tipoTarifa int NOT NULL,
	CONSTRAINT PK__tarifas___3213E83F882EC47D PRIMARY KEY (id),
	CONSTRAINT FK_F7D2708272E118CB FOREIGN KEY (usuario_creacion) REFERENCES TerminalOmnibus.dbo.custom_user(id)
);
CREATE NONCLUSTERED INDEX IDX_F7D2708272E118CB ON TerminalOmnibus.dbo.tarifas_encomienda (usuario_creacion ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.tarifas_encomienda_distancia definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.tarifas_encomienda_distancia;
CREATE TABLE TerminalOmnibus.dbo.tarifas_encomienda_distancia (
	id bigint NOT NULL,
	estacion_origen_id bigint NOT NULL,
	estacion_destino_id bigint NOT NULL,
	fechaEfectividad datetime2(6) NOT NULL,
	tarifaValor numeric(7, 2) NOT NULL,
	CONSTRAINT PK__tarifas___3213E83F33C855F8 PRIMARY KEY (id),
	CONSTRAINT FK_648F1EA159A7CA66 FOREIGN KEY (estacion_destino_id) REFERENCES TerminalOmnibus.dbo.estacion(id),
	CONSTRAINT FK_648F1EA1BF396750 FOREIGN KEY (id) REFERENCES TerminalOmnibus.dbo.tarifas_encomienda(id) ON DELETE CASCADE,
	CONSTRAINT FK_648F1EA1BF6CF13D FOREIGN KEY (estacion_origen_id) REFERENCES TerminalOmnibus.dbo.estacion(id)
);
CREATE NONCLUSTERED INDEX IDX_648F1EA159A7CA66 ON TerminalOmnibus.dbo.tarifas_encomienda_distancia (estacion_destino_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_648F1EA1BF6CF13D ON TerminalOmnibus.dbo.tarifas_encomienda_distancia (estacion_origen_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.tarifas_encomienda_efectivo definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.tarifas_encomienda_efectivo;
CREATE TABLE TerminalOmnibus.dbo.tarifas_encomienda_efectivo (
	id bigint NOT NULL,
	importeMinimo numeric(7, 2) NULL,
	importeMaximo numeric(7, 2) NULL,
	fechaEfectividad datetime2(6) NOT NULL,
	tarifaPorcentual bit NOT NULL,
	tarifaValor numeric(7, 2) NOT NULL,
	tarifaPorcentualValorMinimo numeric(7, 2) NULL,
	tarifaPorcentualValorMaximo numeric(7, 2) NULL,
	CONSTRAINT PK__tarifas___3213E83F22699C39 PRIMARY KEY (id),
	CONSTRAINT FK_6A2F3934BF396750 FOREIGN KEY (id) REFERENCES TerminalOmnibus.dbo.tarifas_encomienda(id) ON DELETE CASCADE
);
-- TerminalOmnibus.dbo.tarifas_encomienda_especiales definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.tarifas_encomienda_especiales;
CREATE TABLE TerminalOmnibus.dbo.tarifas_encomienda_especiales (
	id bigint NOT NULL,
	tipo_encomienda_especial_id bigint NOT NULL,
	fechaEfectividad datetime2(6) NOT NULL,
	tarifaValor numeric(7, 2) NOT NULL,
	CONSTRAINT PK__tarifas___3213E83F48457CD1 PRIMARY KEY (id),
	CONSTRAINT FK_14F7525CA6426DFA FOREIGN KEY (tipo_encomienda_especial_id) REFERENCES TerminalOmnibus.dbo.encomienda_especiales_tipo(id),
	CONSTRAINT FK_14F7525CBF396750 FOREIGN KEY (id) REFERENCES TerminalOmnibus.dbo.tarifas_encomienda(id) ON DELETE CASCADE
);
CREATE NONCLUSTERED INDEX IDX_14F7525CA6426DFA ON TerminalOmnibus.dbo.tarifas_encomienda_especiales (tipo_encomienda_especial_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.tarifas_encomienda_paquetes_peso definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.tarifas_encomienda_paquetes_peso;
CREATE TABLE TerminalOmnibus.dbo.tarifas_encomienda_paquetes_peso (
	id bigint NOT NULL,
	pesoMinimo numeric(7, 2) NULL,
	pesoMaximo numeric(7, 2) NULL,
	fechaEfectividad datetime2(6) NOT NULL,
	tarifaPorcentual bit NOT NULL,
	tarifaValor numeric(10, 5) NOT NULL,
	tarifaPorcentualValorMinimo numeric(7, 2) NULL,
	tarifaPorcentualValorMaximo numeric(7, 2) NULL,
	CONSTRAINT PK__tarifas___3213E83FAD5500C2 PRIMARY KEY (id),
	CONSTRAINT FK_62D4F7EABF396750 FOREIGN KEY (id) REFERENCES TerminalOmnibus.dbo.tarifas_encomienda(id) ON DELETE CASCADE
);
-- TerminalOmnibus.dbo.tarifas_encomienda_paquetes_volumen definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.tarifas_encomienda_paquetes_volumen;
CREATE TABLE TerminalOmnibus.dbo.tarifas_encomienda_paquetes_volumen (
	id bigint NOT NULL,
	volumenMinimo numeric(12, 2) NULL,
	volumenMaximo numeric(12, 2) NULL,
	fechaEfectividad datetime2(6) NOT NULL,
	tarifaPorcentual bit NOT NULL,
	tarifaValor numeric(10, 5) NOT NULL,
	tarifaPorcentualValorMinimo numeric(7, 2) NULL,
	tarifaPorcentualValorMaximo numeric(7, 2) NULL,
	CONSTRAINT PK__tarifas___3213E83FB980532F PRIMARY KEY (id),
	CONSTRAINT FK_6CA7C78BBF396750 FOREIGN KEY (id) REFERENCES TerminalOmnibus.dbo.tarifas_encomienda(id) ON DELETE CASCADE
);
-- TerminalOmnibus.dbo.tarjeta definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.tarjeta;
CREATE TABLE TerminalOmnibus.dbo.tarjeta (
	id bigint IDENTITY(1, 1) NOT NULL,
	salida_id bigint NOT NULL,
	estado_id smallint NOT NULL,
	usuario_conciliacion_id bigint NULL,
	estacion_creacion_id bigint NULL,
	usuario_creacion_id bigint NOT NULL,
	numero bigint NOT NULL,
	fecha_conciliacion datetime2(6) NULL,
	observacion_conciliacion varchar(MAX) COLLATE Modern_Spanish_CI_AS NULL,
	fecha_creacion datetime2(6) NOT NULL,
	tipo_id smallint NULL,
	CONSTRAINT PK__tarjeta__3213E83F10BFA611 PRIMARY KEY (id),
	CONSTRAINT FK_AE90B78626A36E51 FOREIGN KEY (salida_id) REFERENCES TerminalOmnibus.dbo.salida(id) ON DELETE CASCADE,
	CONSTRAINT FK_AE90B7865F37B590 FOREIGN KEY (estacion_creacion_id) REFERENCES TerminalOmnibus.dbo.estacion(id),
	CONSTRAINT FK_AE90B7869F5A440B FOREIGN KEY (estado_id) REFERENCES TerminalOmnibus.dbo.tarjeta_estado(id),
	CONSTRAINT FK_AE90B786A9276E6C FOREIGN KEY (tipo_id) REFERENCES TerminalOmnibus.dbo.tipo_tarjeta(id),
	CONSTRAINT FK_AE90B786AEADF654 FOREIGN KEY (usuario_creacion_id) REFERENCES TerminalOmnibus.dbo.custom_user(id),
	CONSTRAINT FK_AE90B786D049F308 FOREIGN KEY (usuario_conciliacion_id) REFERENCES TerminalOmnibus.dbo.custom_user(id)
);
CREATE UNIQUE NONCLUSTERED INDEX CUSTOM_IDX_TARJETA_TIPO_NUMERO ON TerminalOmnibus.dbo.tarjeta (tipo_id ASC, numero ASC)
WHERE (
		[tipo_id] IS NOT NULL
		AND [numero] IS NOT NULL
	) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_AE90B7865F37B590 ON TerminalOmnibus.dbo.tarjeta (estacion_creacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_AE90B7869F5A440B ON TerminalOmnibus.dbo.tarjeta (estado_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_AE90B786A9276E6C ON TerminalOmnibus.dbo.tarjeta (tipo_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_AE90B786AEADF654 ON TerminalOmnibus.dbo.tarjeta (usuario_creacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_AE90B786D049F308 ON TerminalOmnibus.dbo.tarjeta (usuario_conciliacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_AE90B78626A36E51 ON TerminalOmnibus.dbo.tarjeta (salida_id ASC)
WHERE ([salida_id] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.tarjeta_bitacora definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.tarjeta_bitacora;
CREATE TABLE TerminalOmnibus.dbo.tarjeta_bitacora (
	id bigint IDENTITY(1, 1) NOT NULL,
	tarjeta_id bigint NOT NULL,
	usuario_id bigint NULL,
	fecha datetime2(6) NOT NULL,
	descripcion nvarchar(255) COLLATE Modern_Spanish_CI_AS NOT NULL,
	CONSTRAINT PK__tarjeta___3213E83F5424CDA4 PRIMARY KEY (id),
	CONSTRAINT FK_BBE51B40D8720997 FOREIGN KEY (tarjeta_id) REFERENCES TerminalOmnibus.dbo.tarjeta(id) ON DELETE CASCADE,
	CONSTRAINT FK_BBE51B40DB38439E FOREIGN KEY (usuario_id) REFERENCES TerminalOmnibus.dbo.custom_user(id)
);
CREATE NONCLUSTERED INDEX IDX_BBE51B40D8720997 ON TerminalOmnibus.dbo.tarjeta_bitacora (tarjeta_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_BBE51B40DB38439E ON TerminalOmnibus.dbo.tarjeta_bitacora (usuario_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.agencia_deposito definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.agencia_deposito;
CREATE TABLE TerminalOmnibus.dbo.agencia_deposito (
	id bigint IDENTITY(1, 1) NOT NULL,
	estacion_id bigint NOT NULL,
	estado_id smallint NOT NULL,
	usuario_creacion_id bigint NOT NULL,
	fecha date NOT NULL,
	importe numeric(7, 2) NOT NULL,
	numero_boleta nvarchar(15) COLLATE Modern_Spanish_CI_AS NOT NULL,
	motivo_rechazo nvarchar(100) COLLATE Modern_Spanish_CI_AS NULL,
	fecha_creacion datetime2(6) NOT NULL,
	moneda_id int NULL,
	aplica_bono bit NULL,
	bono numeric(7, 2) NULL,
	observacion nvarchar(200) COLLATE Modern_Spanish_CI_AS NULL,
	CONSTRAINT PK__agencia___3213E83FCCD2E4A5 PRIMARY KEY (id),
	CONSTRAINT FK_8CE0C2042A4AF395 FOREIGN KEY (estacion_id) REFERENCES TerminalOmnibus.dbo.estacion(id),
	CONSTRAINT FK_8CE0C2049F5A440B FOREIGN KEY (estado_id) REFERENCES TerminalOmnibus.dbo.agencia_deposito_estado(id),
	CONSTRAINT FK_8CE0C204AEADF654 FOREIGN KEY (usuario_creacion_id) REFERENCES TerminalOmnibus.dbo.custom_user(id),
	CONSTRAINT FK_8CE0C204B77634D2 FOREIGN KEY (moneda_id) REFERENCES TerminalOmnibus.dbo.moneda(id)
);
CREATE NONCLUSTERED INDEX IDX_8CE0C2042A4AF395 ON TerminalOmnibus.dbo.agencia_deposito (estacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_8CE0C2049F5A440B ON TerminalOmnibus.dbo.agencia_deposito (estado_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_8CE0C204AEADF654 ON TerminalOmnibus.dbo.agencia_deposito (usuario_creacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_8CE0C204B77634D2 ON TerminalOmnibus.dbo.agencia_deposito (moneda_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.alquiler definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.alquiler;
CREATE TABLE TerminalOmnibus.dbo.alquiler (
	id bigint IDENTITY(1, 1) NOT NULL,
	empresa_id bigint NOT NULL,
	bus_codigo nvarchar(6) COLLATE Modern_Spanish_CI_AS NOT NULL,
	piloto_id bigint NOT NULL,
	piloto_aux_id bigint NULL,
	estado_id smallint NOT NULL,
	usuario_creacion_id bigint NOT NULL,
	usuario_efectuado_id bigint NULL,
	estacion_efectuado_id bigint NULL,
	usuario_cancelado_id bigint NULL,
	fecha_inicial datetime2(6) NOT NULL,
	fecha_final datetime2(6) NOT NULL,
	importe numeric(7, 2) NOT NULL,
	observacion varchar(MAX) COLLATE Modern_Spanish_CI_AS NOT NULL,
	fecha_creacion datetime2(6) NOT NULL,
	fecha_efectuado datetime2(6) NULL,
	fecha_cancelado datetime2(6) NULL,
	CONSTRAINT PK__alquiler__3213E83F3709567C PRIMARY KEY (id),
	CONSTRAINT FK_655BED39521E1991 FOREIGN KEY (empresa_id) REFERENCES TerminalOmnibus.dbo.empresa(id),
	CONSTRAINT FK_655BED3974B07C85 FOREIGN KEY (estacion_efectuado_id) REFERENCES TerminalOmnibus.dbo.estacion(id),
	CONSTRAINT FK_655BED3994F94353 FOREIGN KEY (usuario_cancelado_id) REFERENCES TerminalOmnibus.dbo.custom_user(id),
	CONSTRAINT FK_655BED399AAD4A8D FOREIGN KEY (piloto_id) REFERENCES TerminalOmnibus.dbo.piloto(id),
	CONSTRAINT FK_655BED399F5A440B FOREIGN KEY (estado_id) REFERENCES TerminalOmnibus.dbo.alquiler_estado(id),
	CONSTRAINT FK_655BED39AEADF654 FOREIGN KEY (usuario_creacion_id) REFERENCES TerminalOmnibus.dbo.custom_user(id),
	CONSTRAINT FK_655BED39CE51A91C FOREIGN KEY (piloto_aux_id) REFERENCES TerminalOmnibus.dbo.piloto(id),
	CONSTRAINT FK_655BED39E848E06F FOREIGN KEY (usuario_efectuado_id) REFERENCES TerminalOmnibus.dbo.custom_user(id),
	CONSTRAINT FK_655BED39EA1FB9B6 FOREIGN KEY (bus_codigo) REFERENCES TerminalOmnibus.dbo.bus(codigo)
);
CREATE NONCLUSTERED INDEX IDX_655BED39521E1991 ON TerminalOmnibus.dbo.alquiler (empresa_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_655BED3974B07C85 ON TerminalOmnibus.dbo.alquiler (estacion_efectuado_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_655BED3994F94353 ON TerminalOmnibus.dbo.alquiler (usuario_cancelado_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_655BED399AAD4A8D ON TerminalOmnibus.dbo.alquiler (piloto_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_655BED399F5A440B ON TerminalOmnibus.dbo.alquiler (estado_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_655BED39AEADF654 ON TerminalOmnibus.dbo.alquiler (usuario_creacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_655BED39CE51A91C ON TerminalOmnibus.dbo.alquiler (piloto_aux_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_655BED39E848E06F ON TerminalOmnibus.dbo.alquiler (usuario_efectuado_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_655BED39EA1FB9B6 ON TerminalOmnibus.dbo.alquiler (bus_codigo ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.alquiler_fecha definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.alquiler_fecha;
CREATE TABLE TerminalOmnibus.dbo.alquiler_fecha (
	id bigint IDENTITY(1, 1) NOT NULL,
	alquiler_id bigint NOT NULL,
	fecha datetime2(6) NOT NULL,
	CONSTRAINT PK__alquiler__3213E83FED5B9429 PRIMARY KEY (id),
	CONSTRAINT FK_2AB18F265A921E97 FOREIGN KEY (alquiler_id) REFERENCES TerminalOmnibus.dbo.alquiler(id)
);
CREATE NONCLUSTERED INDEX IDX_2AB18F265A921E97 ON TerminalOmnibus.dbo.alquiler_fecha (alquiler_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.autorizacion_interna definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.autorizacion_interna;
CREATE TABLE TerminalOmnibus.dbo.autorizacion_interna (
	id bigint IDENTITY(1, 1) NOT NULL,
	usuario_creacion bigint NULL,
	estacion_origen_id bigint NULL,
	usuario_utilizacion bigint NULL,
	motivo varchar(MAX) COLLATE Modern_Spanish_CI_AS NOT NULL,
	codigo nvarchar(20) COLLATE Modern_Spanish_CI_AS NOT NULL,
	fecha_creacion datetime2(6) NOT NULL,
	fecha_utilizacion datetime2(6) NULL,
	activo bit NOT NULL,
	CONSTRAINT PK__autoriza__3213E83FE158B696 PRIMARY KEY (id),
	CONSTRAINT FK_5388A2362C0F023 FOREIGN KEY (usuario_utilizacion) REFERENCES TerminalOmnibus.dbo.custom_user(id),
	CONSTRAINT FK_5388A2372E118CB FOREIGN KEY (usuario_creacion) REFERENCES TerminalOmnibus.dbo.custom_user(id),
	CONSTRAINT FK_5388A23BF6CF13D FOREIGN KEY (estacion_origen_id) REFERENCES TerminalOmnibus.dbo.estacion(id)
);
CREATE NONCLUSTERED INDEX IDX_5388A2362C0F023 ON TerminalOmnibus.dbo.autorizacion_interna (usuario_utilizacion ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_5388A2372E118CB ON TerminalOmnibus.dbo.autorizacion_interna (usuario_creacion ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_5388A23BF6CF13D ON TerminalOmnibus.dbo.autorizacion_interna (estacion_origen_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_5388A2320332D99 ON TerminalOmnibus.dbo.autorizacion_interna (codigo ASC)
WHERE ([codigo] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.boleto_pagina_temp definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.boleto_pagina_temp;
CREATE TABLE TerminalOmnibus.dbo.boleto_pagina_temp (
	salida_id bigint NOT NULL,
	fecha_creacion datetime2(3) NULL,
	fecha_actualizacion datetime2(3) NULL,
	reservacion_id bigint NULL,
	regreso bit NULL,
	fecha_salida datetime2(3) NULL,
	id bigint IDENTITY(1, 1) NOT NULL,
	CONSTRAINT boleto_pagina_asiento_temp_FK FOREIGN KEY (salida_id) REFERENCES TerminalOmnibus.dbo.salida(id)
);
-- TerminalOmnibus.dbo.boleto_voucher_agencia definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.boleto_voucher_agencia;
CREATE TABLE TerminalOmnibus.dbo.boleto_voucher_agencia (
	id bigint IDENTITY(1, 1) NOT NULL,
	empresa_id bigint NOT NULL,
	moneda_id int NOT NULL,
	tipo_cambio_id int NOT NULL,
	usuario_id bigint NOT NULL,
	estacion_id bigint NOT NULL,
	bono bit NOT NULL,
	importeTotal numeric(10, 2) NOT NULL,
	fecha datetime2(6) NOT NULL,
	referenciaExterna nvarchar(20) COLLATE Modern_Spanish_CI_AS NULL,
	usuario_anulacion_id bigint NULL,
	fecha_anulacion datetime2(6) NULL,
	CONSTRAINT PK__boleto_v__3213E83FD65ED9E1 PRIMARY KEY (id),
	CONSTRAINT FK_8CC67EA12A4AF395 FOREIGN KEY (estacion_id) REFERENCES TerminalOmnibus.dbo.estacion(id),
	CONSTRAINT FK_8CC67EA1521E1991 FOREIGN KEY (empresa_id) REFERENCES TerminalOmnibus.dbo.empresa(id),
	CONSTRAINT FK_8CC67EA1B77634D2 FOREIGN KEY (moneda_id) REFERENCES TerminalOmnibus.dbo.moneda(id),
	CONSTRAINT FK_8CC67EA1BAF036CE FOREIGN KEY (usuario_anulacion_id) REFERENCES TerminalOmnibus.dbo.custom_user(id),
	CONSTRAINT FK_8CC67EA1BCF2DB9B FOREIGN KEY (tipo_cambio_id) REFERENCES TerminalOmnibus.dbo.tipo_cambio(id),
	CONSTRAINT FK_8CC67EA1DB38439E FOREIGN KEY (usuario_id) REFERENCES TerminalOmnibus.dbo.custom_user(id)
);
CREATE NONCLUSTERED INDEX IDX_8CC67EA12A4AF395 ON TerminalOmnibus.dbo.boleto_voucher_agencia (estacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_8CC67EA1521E1991 ON TerminalOmnibus.dbo.boleto_voucher_agencia (empresa_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_8CC67EA1B77634D2 ON TerminalOmnibus.dbo.boleto_voucher_agencia (moneda_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_8CC67EA1BAF036CE ON TerminalOmnibus.dbo.boleto_voucher_agencia (usuario_anulacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_8CC67EA1BCF2DB9B ON TerminalOmnibus.dbo.boleto_voucher_agencia (tipo_cambio_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_8CC67EA1DB38439E ON TerminalOmnibus.dbo.boleto_voucher_agencia (usuario_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.boleto_voucher_estacion definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.boleto_voucher_estacion;
CREATE TABLE TerminalOmnibus.dbo.boleto_voucher_estacion (
	id bigint IDENTITY(1, 1) NOT NULL,
	empresa_id bigint NOT NULL,
	moneda_id int NOT NULL,
	tipo_cambio_id int NOT NULL,
	usuario_id bigint NOT NULL,
	estacion_id bigint NOT NULL,
	importeTotal numeric(10, 2) NOT NULL,
	fecha datetime2(6) NOT NULL,
	CONSTRAINT PK__boleto_v__3213E83F5BBBCC90 PRIMARY KEY (id),
	CONSTRAINT FK_1AD72B942A4AF395 FOREIGN KEY (estacion_id) REFERENCES TerminalOmnibus.dbo.estacion(id),
	CONSTRAINT FK_1AD72B94521E1991 FOREIGN KEY (empresa_id) REFERENCES TerminalOmnibus.dbo.empresa(id),
	CONSTRAINT FK_1AD72B94B77634D2 FOREIGN KEY (moneda_id) REFERENCES TerminalOmnibus.dbo.moneda(id),
	CONSTRAINT FK_1AD72B94BCF2DB9B FOREIGN KEY (tipo_cambio_id) REFERENCES TerminalOmnibus.dbo.tipo_cambio(id),
	CONSTRAINT FK_1AD72B94DB38439E FOREIGN KEY (usuario_id) REFERENCES TerminalOmnibus.dbo.custom_user(id)
);
CREATE NONCLUSTERED INDEX IDX_1AD72B942A4AF395 ON TerminalOmnibus.dbo.boleto_voucher_estacion (estacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_1AD72B94521E1991 ON TerminalOmnibus.dbo.boleto_voucher_estacion (empresa_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_1AD72B94B77634D2 ON TerminalOmnibus.dbo.boleto_voucher_estacion (moneda_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_1AD72B94BCF2DB9B ON TerminalOmnibus.dbo.boleto_voucher_estacion (tipo_cambio_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_1AD72B94DB38439E ON TerminalOmnibus.dbo.boleto_voucher_estacion (usuario_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.caja definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.caja;
CREATE TABLE TerminalOmnibus.dbo.caja (
	id bigint IDENTITY(1, 1) NOT NULL,
	moneda_id int NOT NULL,
	usuario_id bigint NOT NULL,
	estacion_id bigint NOT NULL,
	estado_id bigint NOT NULL,
	fecha_apertura datetime2(6) NULL,
	fecha_cierre datetime2(6) NULL,
	fecha_cancelacion datetime2(6) NULL,
	fecha_creacion datetime2(6) NOT NULL,
	CONSTRAINT PK__caja__3213E83FE0985352 PRIMARY KEY (id),
	CONSTRAINT FK_E465F4052A4AF395 FOREIGN KEY (estacion_id) REFERENCES TerminalOmnibus.dbo.estacion(id),
	CONSTRAINT FK_E465F4059F5A440B FOREIGN KEY (estado_id) REFERENCES TerminalOmnibus.dbo.caja_estado(id),
	CONSTRAINT FK_E465F405B77634D2 FOREIGN KEY (moneda_id) REFERENCES TerminalOmnibus.dbo.moneda(id),
	CONSTRAINT FK_E465F405DB38439E FOREIGN KEY (usuario_id) REFERENCES TerminalOmnibus.dbo.custom_user(id)
);
CREATE NONCLUSTERED INDEX IDX_E465F4052A4AF395 ON TerminalOmnibus.dbo.caja (estacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_E465F4059F5A440B ON TerminalOmnibus.dbo.caja (estado_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_E465F405B77634D2 ON TerminalOmnibus.dbo.caja (moneda_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_E465F405DB38439E ON TerminalOmnibus.dbo.caja (usuario_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.caja_operacion definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.caja_operacion;
CREATE TABLE TerminalOmnibus.dbo.caja_operacion (
	id bigint IDENTITY(1, 1) NOT NULL,
	caja_id bigint NOT NULL,
	tipo_operacion_id bigint NOT NULL,
	importe numeric(10, 2) NOT NULL,
	fecha datetime2(6) NOT NULL,
	descripcion varchar(MAX) COLLATE Modern_Spanish_CI_AS NULL,
	empresa_id bigint NULL,
	CONSTRAINT PK__caja_ope__3213E83FF6765C83 PRIMARY KEY (id),
	CONSTRAINT FK_DB041D5F2D82B651 FOREIGN KEY (caja_id) REFERENCES TerminalOmnibus.dbo.caja(id) ON DELETE CASCADE,
	CONSTRAINT FK_DB041D5F521E1991 FOREIGN KEY (empresa_id) REFERENCES TerminalOmnibus.dbo.empresa(id),
	CONSTRAINT FK_DB041D5F5586C9C3 FOREIGN KEY (tipo_operacion_id) REFERENCES TerminalOmnibus.dbo.caja_operacion_tipo(id)
);
CREATE NONCLUSTERED INDEX IDX_DB041D5F2D82B651 ON TerminalOmnibus.dbo.caja_operacion (caja_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_DB041D5F521E1991 ON TerminalOmnibus.dbo.caja_operacion (empresa_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_DB041D5F5586C9C3 ON TerminalOmnibus.dbo.caja_operacion (tipo_operacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.calendario_factura_fecha definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.calendario_factura_fecha;
CREATE TABLE TerminalOmnibus.dbo.calendario_factura_fecha (
	id bigint IDENTITY(1, 1) NOT NULL,
	calendario_factura_ruta_id bigint NOT NULL,
	empresa_id bigint NOT NULL,
	fecha date NOT NULL,
	CONSTRAINT PK__calendar__3213E83F059612C9 PRIMARY KEY (id),
	CONSTRAINT FK_110D58A1521E1991 FOREIGN KEY (empresa_id) REFERENCES TerminalOmnibus.dbo.empresa(id),
	CONSTRAINT FK_110D58A17CEF54F7 FOREIGN KEY (calendario_factura_ruta_id) REFERENCES TerminalOmnibus.dbo.calendario_factura_ruta(id)
);
CREATE NONCLUSTERED INDEX IDX_110D58A1521E1991 ON TerminalOmnibus.dbo.calendario_factura_fecha (empresa_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_110D58A17CEF54F7 ON TerminalOmnibus.dbo.calendario_factura_fecha (calendario_factura_ruta_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.cliente definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.cliente;
CREATE TABLE TerminalOmnibus.dbo.cliente (
	id bigint IDENTITY(1, 1) NOT NULL,
	nit nvarchar(20) COLLATE Modern_Spanish_CI_AS NULL,
	dpi nvarchar(40) COLLATE Modern_Spanish_CI_AS NULL,
	nombre nvarchar(100) COLLATE Modern_Spanish_CI_AS NOT NULL,
	direccion nvarchar(150) COLLATE Modern_Spanish_CI_AS NULL,
	telefono nvarchar(21) COLLATE Modern_Spanish_CI_AS NULL,
	correo nvarchar(40) COLLATE Modern_Spanish_CI_AS NULL,
	nacionalidad_id smallint NULL,
	usuario_creacion_id bigint NULL,
	fecha_creacion datetime2(6) NULL,
	tipo_documento_id smallint NULL,
	sexo_id smallint NULL,
	fecha_vencimiento_documento date NULL,
	detallado bit NULL,
	nombre1 nvarchar(50) COLLATE Modern_Spanish_CI_AS NULL,
	nombre2 nvarchar(50) COLLATE Modern_Spanish_CI_AS NULL,
	apellido1 nvarchar(50) COLLATE Modern_Spanish_CI_AS NULL,
	apellido2 nvarchar(50) COLLATE Modern_Spanish_CI_AS NULL,
	empleado bit NULL,
	fecha_nacimiento date NULL,
	nitCreacionCopia nvarchar(20) COLLATE Modern_Spanish_CI_AS NULL,
	nombreCreacionCopia nvarchar(100) COLLATE Modern_Spanish_CI_AS NULL,
	CONSTRAINT PK__cliente__3213E83FE41AB83E PRIMARY KEY (id),
	CONSTRAINT FK_F41C9B252B32DB58 FOREIGN KEY (sexo_id) REFERENCES TerminalOmnibus.dbo.sexo(id),
	CONSTRAINT FK_F41C9B25AB8DC0F8 FOREIGN KEY (nacionalidad_id) REFERENCES TerminalOmnibus.dbo.nacionalidad(id),
	CONSTRAINT FK_F41C9B25AEADF654 FOREIGN KEY (usuario_creacion_id) REFERENCES TerminalOmnibus.dbo.custom_user(id),
	CONSTRAINT FK_F41C9B25F6939175 FOREIGN KEY (tipo_documento_id) REFERENCES TerminalOmnibus.dbo.tipo_documento(id)
);
CREATE UNIQUE NONCLUSTERED INDEX CUSTOM_IDX_CLIENTE_NIT_NOMBRE_DPI ON TerminalOmnibus.dbo.cliente (nit ASC, nombre ASC, dpi ASC)
WHERE (
		[nit] IS NOT NULL
		AND [nombre] IS NOT NULL
		AND [dpi] IS NOT NULL
	) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_F41C9B252B32DB58 ON TerminalOmnibus.dbo.cliente (sexo_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_F41C9B25AB8DC0F8 ON TerminalOmnibus.dbo.cliente (nacionalidad_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_F41C9B25AEADF654 ON TerminalOmnibus.dbo.cliente (usuario_creacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_F41C9B25F6939175 ON TerminalOmnibus.dbo.cliente (tipo_documento_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.encomienda_bitacora definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.encomienda_bitacora;
CREATE TABLE TerminalOmnibus.dbo.encomienda_bitacora (
	id bigint IDENTITY(1, 1) NOT NULL,
	encomienda_id bigint NOT NULL,
	estacion bigint NOT NULL,
	estado_id bigint NOT NULL,
	usuario_id bigint NOT NULL,
	salida_id bigint NULL,
	cliente_id bigint NULL,
	fecha datetime2(6) NOT NULL,
	CONSTRAINT PK__encomien__3213E83F8C2513AF PRIMARY KEY (id),
	CONSTRAINT FK_2E5E561926A36E51 FOREIGN KEY (salida_id) REFERENCES TerminalOmnibus.dbo.salida(id) ON DELETE
	SET NULL,
		CONSTRAINT FK_2E5E561932B2395F FOREIGN KEY (estacion) REFERENCES TerminalOmnibus.dbo.estacion(id),
		CONSTRAINT FK_2E5E56199F5A440B FOREIGN KEY (estado_id) REFERENCES TerminalOmnibus.dbo.encomienda_estado(id),
		CONSTRAINT FK_2E5E5619DB38439E FOREIGN KEY (usuario_id) REFERENCES TerminalOmnibus.dbo.custom_user(id),
		CONSTRAINT FK_2E5E5619DE734E51 FOREIGN KEY (cliente_id) REFERENCES TerminalOmnibus.dbo.cliente(id) ON DELETE CASCADE
);
CREATE NONCLUSTERED INDEX IDX_2E5E561926A36E51 ON TerminalOmnibus.dbo.encomienda_bitacora (salida_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_2E5E561932B2395F ON TerminalOmnibus.dbo.encomienda_bitacora (estacion ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_2E5E56199F5A440B ON TerminalOmnibus.dbo.encomienda_bitacora (estado_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_2E5E5619CBC1B2DF ON TerminalOmnibus.dbo.encomienda_bitacora (encomienda_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_2E5E5619DB38439E ON TerminalOmnibus.dbo.encomienda_bitacora (usuario_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_2E5E5619DE734E51 ON TerminalOmnibus.dbo.encomienda_bitacora (cliente_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.reservacion definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.reservacion;
CREATE TABLE TerminalOmnibus.dbo.reservacion (
	id bigint IDENTITY(1, 1) NOT NULL,
	asiento_bus_id bigint NOT NULL,
	cliente bigint NOT NULL,
	salida_id bigint NOT NULL,
	estado_id bigint NOT NULL,
	estacion_creacion_id bigint NULL,
	usuario_creacion_id bigint NULL,
	usuario_actualizacion_id bigint NULL,
	observacion varchar(MAX) COLLATE Modern_Spanish_CI_AS NULL,
	fecha_creacion datetime2(6) NOT NULL,
	fecha_actualizacion datetime2(6) NULL,
	externa bit NULL,
	referencia_externa nvarchar(30) COLLATE Modern_Spanish_CI_AS NULL,
	CONSTRAINT PK__reservac__3213E83FF3DEAFB9 PRIMARY KEY (id),
	CONSTRAINT FK_8F06267326A36E51 FOREIGN KEY (salida_id) REFERENCES TerminalOmnibus.dbo.salida(id) ON DELETE CASCADE,
	CONSTRAINT FK_8F0626735F37B590 FOREIGN KEY (estacion_creacion_id) REFERENCES TerminalOmnibus.dbo.estacion(id),
	CONSTRAINT FK_8F062673799C34DC FOREIGN KEY (asiento_bus_id) REFERENCES TerminalOmnibus.dbo.bus_asiento(id),
	CONSTRAINT FK_8F0626739F5A440B FOREIGN KEY (estado_id) REFERENCES TerminalOmnibus.dbo.reservacion_estado(id),
	CONSTRAINT FK_8F062673AEADF654 FOREIGN KEY (usuario_creacion_id) REFERENCES TerminalOmnibus.dbo.custom_user(id),
	CONSTRAINT FK_8F062673CCED81D FOREIGN KEY (usuario_actualizacion_id) REFERENCES TerminalOmnibus.dbo.custom_user(id),
	CONSTRAINT FK_8F062673F41C9B25 FOREIGN KEY (cliente) REFERENCES TerminalOmnibus.dbo.cliente(id) ON DELETE CASCADE
);
CREATE UNIQUE NONCLUSTERED INDEX CUSTOM_IDX_RESERVACION_SALIDA_ASIENTO_ESTADO ON TerminalOmnibus.dbo.reservacion (
	salida_id ASC,
	asiento_bus_id ASC,
	estado_id ASC
)
WHERE (
		[salida_id] IS NOT NULL
		AND [asiento_bus_id] IS NOT NULL
		AND [estado_id] =(1)
	) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_8F06267326A36E51 ON TerminalOmnibus.dbo.reservacion (salida_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_8F0626735F37B590 ON TerminalOmnibus.dbo.reservacion (estacion_creacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_8F062673799C34DC ON TerminalOmnibus.dbo.reservacion (asiento_bus_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_8F0626739F5A440B ON TerminalOmnibus.dbo.reservacion (estado_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_8F062673AEADF654 ON TerminalOmnibus.dbo.reservacion (usuario_creacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_8F062673CCED81D ON TerminalOmnibus.dbo.reservacion (usuario_actualizacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.talonario definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.talonario;
CREATE TABLE TerminalOmnibus.dbo.talonario (
	id bigint IDENTITY(1, 1) NOT NULL,
	tarjeta_id bigint NOT NULL,
	usuario_creacion_id bigint NOT NULL,
	inicial bigint NOT NULL,
	[final] bigint NOT NULL,
	fecha_creacion datetime2(6) NOT NULL,
	CONSTRAINT PK__talonari__3213E83FD47BFD7B PRIMARY KEY (id),
	CONSTRAINT FK_796CF41FAEADF654 FOREIGN KEY (usuario_creacion_id) REFERENCES TerminalOmnibus.dbo.custom_user(id),
	CONSTRAINT FK_796CF41FD8720997 FOREIGN KEY (tarjeta_id) REFERENCES TerminalOmnibus.dbo.tarjeta(id) ON DELETE CASCADE
);
CREATE NONCLUSTERED INDEX IDX_796CF41FAEADF654 ON TerminalOmnibus.dbo.talonario (usuario_creacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_796CF41FD8720997 ON TerminalOmnibus.dbo.talonario (tarjeta_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.talonario_corte_venta definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.talonario_corte_venta;
CREATE TABLE TerminalOmnibus.dbo.talonario_corte_venta (
	id bigint IDENTITY(1, 1) NOT NULL,
	talonario_id bigint NOT NULL,
	estado_id smallint NULL,
	inspector bigint NOT NULL,
	estacion_creacion_id bigint NULL,
	usuario_creacion_id bigint NOT NULL,
	inicial bigint NOT NULL,
	[final] bigint NOT NULL,
	importe_total numeric(10, 2) NOT NULL,
	importe_total_items numeric(10, 2) NOT NULL,
	fecha date NOT NULL,
	fecha_creacion datetime2(6) NOT NULL,
	CONSTRAINT PK__talonari__3213E83F4D829DD4 PRIMARY KEY (id),
	CONSTRAINT FK_9771EFD445EF28CE FOREIGN KEY (talonario_id) REFERENCES TerminalOmnibus.dbo.talonario(id) ON DELETE CASCADE,
	CONSTRAINT FK_9771EFD45F37B590 FOREIGN KEY (estacion_creacion_id) REFERENCES TerminalOmnibus.dbo.estacion(id),
	CONSTRAINT FK_9771EFD472DD518B FOREIGN KEY (inspector) REFERENCES TerminalOmnibus.dbo.custom_user(id),
	CONSTRAINT FK_9771EFD49F5A440B FOREIGN KEY (estado_id) REFERENCES TerminalOmnibus.dbo.talonario_corte_venta_estado(id),
	CONSTRAINT FK_9771EFD4AEADF654 FOREIGN KEY (usuario_creacion_id) REFERENCES TerminalOmnibus.dbo.custom_user(id)
);
CREATE NONCLUSTERED INDEX IDX_9771EFD445EF28CE ON TerminalOmnibus.dbo.talonario_corte_venta (talonario_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_9771EFD45F37B590 ON TerminalOmnibus.dbo.talonario_corte_venta (estacion_creacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_9771EFD472DD518B ON TerminalOmnibus.dbo.talonario_corte_venta (inspector ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_9771EFD49F5A440B ON TerminalOmnibus.dbo.talonario_corte_venta (estado_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_9771EFD4AEADF654 ON TerminalOmnibus.dbo.talonario_corte_venta (usuario_creacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.talonario_corte_venta_item definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.talonario_corte_venta_item;
CREATE TABLE TerminalOmnibus.dbo.talonario_corte_venta_item (
	id bigint IDENTITY(1, 1) NOT NULL,
	corte_venta_talonario bigint NOT NULL,
	usuario_creacion_id bigint NOT NULL,
	usuario_actualizacion_id bigint NULL,
	numero bigint NOT NULL,
	importe numeric(7, 2) NOT NULL,
	fecha_creacion datetime2(6) NOT NULL,
	fecha_actualizacion datetime2(6) NULL,
	CONSTRAINT PK__talonari__3213E83F87E7DC9E PRIMARY KEY (id),
	CONSTRAINT FK_DB64C348AEADF654 FOREIGN KEY (usuario_creacion_id) REFERENCES TerminalOmnibus.dbo.custom_user(id),
	CONSTRAINT FK_DB64C348BC4BA8DB FOREIGN KEY (corte_venta_talonario) REFERENCES TerminalOmnibus.dbo.talonario_corte_venta(id) ON DELETE CASCADE,
	CONSTRAINT FK_DB64C348CCED81D FOREIGN KEY (usuario_actualizacion_id) REFERENCES TerminalOmnibus.dbo.custom_user(id)
);
CREATE NONCLUSTERED INDEX IDX_DB64C348AEADF654 ON TerminalOmnibus.dbo.talonario_corte_venta_item (usuario_creacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_DB64C348BC4BA8DB ON TerminalOmnibus.dbo.talonario_corte_venta_item (corte_venta_talonario ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_DB64C348CCED81D ON TerminalOmnibus.dbo.talonario_corte_venta_item (usuario_actualizacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.autorizacion_cortesia definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.autorizacion_cortesia;
CREATE TABLE TerminalOmnibus.dbo.autorizacion_cortesia (
	id bigint IDENTITY(1, 1) NOT NULL,
	usuario_creacion bigint NULL,
	usuario_utilizacion bigint NULL,
	restriccion_estacion_origen_id bigint NULL,
	restriccion_cliente bigint NULL,
	motivo varchar(MAX) COLLATE Modern_Spanish_CI_AS NOT NULL,
	codigo nvarchar(20) COLLATE Modern_Spanish_CI_AS NOT NULL,
	notificar_cliente bit NOT NULL,
	fecha_creacion datetime2(6) NOT NULL,
	fecha_utilizacion datetime2(6) NULL,
	restriccionFechaUso date NULL,
	activo bit NOT NULL,
	servicioEstacion bigint NULL,
	restriccion_clase_asiento bigint NULL,
	restriccion_estacion_destino_id bigint NULL,
	restriccion_salida_id bigint NULL,
	restriccion_asiento_bus_id bigint NULL,
	CONSTRAINT PK__autoriza__3213E83F50691EFC PRIMARY KEY (id),
	CONSTRAINT FK_E75268E51CAA5A0E FOREIGN KEY (restriccion_clase_asiento) REFERENCES TerminalOmnibus.dbo.clase_asiento(id),
	CONSTRAINT FK_E75268E521AECBA9 FOREIGN KEY (restriccion_estacion_destino_id) REFERENCES TerminalOmnibus.dbo.estacion(id),
	CONSTRAINT FK_E75268E53E219BAE FOREIGN KEY (restriccion_salida_id) REFERENCES TerminalOmnibus.dbo.salida(id) ON DELETE CASCADE,
	CONSTRAINT FK_E75268E562C0F023 FOREIGN KEY (usuario_utilizacion) REFERENCES TerminalOmnibus.dbo.custom_user(id),
	CONSTRAINT FK_E75268E562EA4272 FOREIGN KEY (restriccion_asiento_bus_id) REFERENCES TerminalOmnibus.dbo.bus_asiento(id),
	CONSTRAINT FK_E75268E56BF2068 FOREIGN KEY (servicioEstacion) REFERENCES TerminalOmnibus.dbo.estacion_servicio(id),
	CONSTRAINT FK_E75268E572E118CB FOREIGN KEY (usuario_creacion) REFERENCES TerminalOmnibus.dbo.custom_user(id),
	CONSTRAINT FK_E75268E5B1A49C75 FOREIGN KEY (restriccion_estacion_origen_id) REFERENCES TerminalOmnibus.dbo.estacion(id),
	CONSTRAINT FK_E75268E5F33CB60D FOREIGN KEY (restriccion_cliente) REFERENCES TerminalOmnibus.dbo.cliente(id)
);
CREATE NONCLUSTERED INDEX IDX_E75268E51CAA5A0E ON TerminalOmnibus.dbo.autorizacion_cortesia (restriccion_clase_asiento ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_E75268E521AECBA9 ON TerminalOmnibus.dbo.autorizacion_cortesia (restriccion_estacion_destino_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_E75268E53E219BAE ON TerminalOmnibus.dbo.autorizacion_cortesia (restriccion_salida_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_E75268E562C0F023 ON TerminalOmnibus.dbo.autorizacion_cortesia (usuario_utilizacion ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_E75268E562EA4272 ON TerminalOmnibus.dbo.autorizacion_cortesia (restriccion_asiento_bus_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_E75268E56BF2068 ON TerminalOmnibus.dbo.autorizacion_cortesia (servicioEstacion ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_E75268E572E118CB ON TerminalOmnibus.dbo.autorizacion_cortesia (usuario_creacion ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_E75268E5B1A49C75 ON TerminalOmnibus.dbo.autorizacion_cortesia (restriccion_estacion_origen_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_E75268E5F33CB60D ON TerminalOmnibus.dbo.autorizacion_cortesia (restriccion_cliente ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_E75268E520332D99 ON TerminalOmnibus.dbo.autorizacion_cortesia (codigo ASC)
WHERE ([codigo] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.boleto definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.boleto;
CREATE TABLE TerminalOmnibus.dbo.boleto (
	id bigint IDENTITY(1, 1) NOT NULL,
	asiento_bus_id bigint NULL,
	reasignado_id bigint NULL,
	cliente_documento bigint NOT NULL,
	cliente_boleto bigint NOT NULL,
	salida_id bigint NOT NULL,
	tipo_pago_id bigint NULL,
	estacion_origen_id bigint NOT NULL,
	estacion_destino_id bigint NOT NULL,
	tipo_documento_id int NOT NULL,
	tarifa_id bigint NULL,
	moneda_id int NULL,
	tipo_cambio_id int NULL,
	factura_generada_id bigint NULL,
	autorizacion_cortesia_id bigint NULL,
	estado_id bigint NOT NULL,
	estacion_creacion_id bigint NULL,
	usuario_creacion_id bigint NULL,
	usuario_actualizacion_id bigint NULL,
	revendidoEnEstacion bit NOT NULL,
	revendidoEnCamino bit NOT NULL,
	observacionDestinoIntermedio varchar(MAX) COLLATE Modern_Spanish_CI_AS NULL,
	precioCalculado numeric(7, 2) NULL,
	observacion varchar(MAX) COLLATE Modern_Spanish_CI_AS NULL,
	fecha_creacion datetime2(6) NOT NULL,
	fecha_actualizacion datetime2(6) NULL,
	precioCalculadoMonedaBase numeric(7, 2) NULL,
	utilizarDesdeEstacionOrigenSalida bit NULL,
	estacion_facturacion_especial bigint NULL,
	ping_facturacion_especial nvarchar(8) COLLATE Modern_Spanish_CI_AS NULL,
	camino bit NULL,
	voucher_agencia_id bigint NULL,
	voucher_estacion_id bigint NULL,
	tarifaAdicionalMonedaBase numeric(7, 2) NULL,
	identificador_web nvarchar(80) COLLATE Modern_Spanish_CI_AS NULL,
	pagina_web_reserva_id bigint NULL,
	enviar_factura_email int NULL,
	voucher_internet_id bigint NULL,
	CONSTRAINT PK__boleto__3213E83FFF5A617A PRIMARY KEY (id),
	CONSTRAINT FK_462E6E25177859DB FOREIGN KEY (estacion_facturacion_especial) REFERENCES TerminalOmnibus.dbo.estacion(id),
	CONSTRAINT FK_462E6E252045F8DE FOREIGN KEY (factura_generada_id) REFERENCES TerminalOmnibus.dbo.factura_generada(id) ON DELETE
	SET NULL,
		CONSTRAINT FK_462E6E252906F2DD FOREIGN KEY (voucher_agencia_id) REFERENCES TerminalOmnibus.dbo.boleto_voucher_agencia(id) ON DELETE
	SET NULL,
		CONSTRAINT FK_462E6E2559A7CA66 FOREIGN KEY (estacion_destino_id) REFERENCES TerminalOmnibus.dbo.estacion(id),
		CONSTRAINT FK_462E6E255F37B590 FOREIGN KEY (estacion_creacion_id) REFERENCES TerminalOmnibus.dbo.estacion(id),
		CONSTRAINT FK_462E6E257002A220 FOREIGN KEY (tipo_pago_id) REFERENCES TerminalOmnibus.dbo.tipo_pago(id),
		CONSTRAINT FK_462E6E25799C34DC FOREIGN KEY (asiento_bus_id) REFERENCES TerminalOmnibus.dbo.bus_asiento(id),
		CONSTRAINT FK_462E6E259F5A440B FOREIGN KEY (estado_id) REFERENCES TerminalOmnibus.dbo.boleto_estado(id),
		CONSTRAINT FK_462E6E25A1BCA103 FOREIGN KEY (cliente_documento) REFERENCES TerminalOmnibus.dbo.cliente(id),
		CONSTRAINT FK_462E6E25AEADF654 FOREIGN KEY (usuario_creacion_id) REFERENCES TerminalOmnibus.dbo.custom_user(id),
		CONSTRAINT FK_462E6E25B77634D2 FOREIGN KEY (moneda_id) REFERENCES TerminalOmnibus.dbo.moneda(id),
		CONSTRAINT FK_462E6E25BCF2DB9B FOREIGN KEY (tipo_cambio_id) REFERENCES TerminalOmnibus.dbo.tipo_cambio(id),
		CONSTRAINT FK_462E6E25BF6CF13D FOREIGN KEY (estacion_origen_id) REFERENCES TerminalOmnibus.dbo.estacion(id),
		CONSTRAINT FK_462E6E25CCED81D FOREIGN KEY (usuario_actualizacion_id) REFERENCES TerminalOmnibus.dbo.custom_user(id),
		CONSTRAINT FK_462E6E25E12906EB FOREIGN KEY (autorizacion_cortesia_id) REFERENCES TerminalOmnibus.dbo.autorizacion_cortesia(id) ON DELETE
	SET NULL,
		CONSTRAINT FK_462E6E25F6939175 FOREIGN KEY (tipo_documento_id) REFERENCES TerminalOmnibus.dbo.boleto_documento_tipo(id),
		CONSTRAINT FK_462E6E25F92D826E FOREIGN KEY (cliente_boleto) REFERENCES TerminalOmnibus.dbo.cliente(id),
		CONSTRAINT FK_462E6E25FE3B76B FOREIGN KEY (tarifa_id) REFERENCES TerminalOmnibus.dbo.tarifas_boleto(id),
		CONSTRAINT FK_462E6E25FE7E3213 FOREIGN KEY (voucher_estacion_id) REFERENCES TerminalOmnibus.dbo.boleto_voucher_estacion(id) ON DELETE
	SET NULL
);
CREATE UNIQUE NONCLUSTERED INDEX CUSTOM_IDX_BOLETO_SALIDA_ASIENTO_ESTADO ON TerminalOmnibus.dbo.boleto (
	salida_id ASC,
	asiento_bus_id ASC,
	estado_id ASC
)
WHERE (
		[salida_id] IS NOT NULL
		AND [asiento_bus_id] IS NOT NULL
		AND ([estado_id] IN ((1), (2), (3)))
	) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_462E6E25177859DB ON TerminalOmnibus.dbo.boleto (estacion_facturacion_especial ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_462E6E2526A36E51 ON TerminalOmnibus.dbo.boleto (salida_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_462E6E2559A7CA66 ON TerminalOmnibus.dbo.boleto (estacion_destino_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_462E6E255F37B590 ON TerminalOmnibus.dbo.boleto (estacion_creacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_462E6E257002A220 ON TerminalOmnibus.dbo.boleto (tipo_pago_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_462E6E25799C34DC ON TerminalOmnibus.dbo.boleto (asiento_bus_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_462E6E259F5A440B ON TerminalOmnibus.dbo.boleto (estado_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_462E6E25A1BCA103 ON TerminalOmnibus.dbo.boleto (cliente_documento ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_462E6E25AEADF654 ON TerminalOmnibus.dbo.boleto (usuario_creacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_462E6E25B77634D2 ON TerminalOmnibus.dbo.boleto (moneda_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_462E6E25BCF2DB9B ON TerminalOmnibus.dbo.boleto (tipo_cambio_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_462E6E25BF6CF13D ON TerminalOmnibus.dbo.boleto (estacion_origen_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_462E6E25CCED81D ON TerminalOmnibus.dbo.boleto (usuario_actualizacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_462E6E25F6939175 ON TerminalOmnibus.dbo.boleto (tipo_documento_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_462E6E25F92D826E ON TerminalOmnibus.dbo.boleto (cliente_boleto ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_462E6E25FE3B76B ON TerminalOmnibus.dbo.boleto (tarifa_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_462E6E252045F8DE ON TerminalOmnibus.dbo.boleto (factura_generada_id ASC)
WHERE ([factura_generada_id] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_462E6E252906F2DD ON TerminalOmnibus.dbo.boleto (voucher_agencia_id ASC)
WHERE ([voucher_agencia_id] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_462E6E254D31BCD6 ON TerminalOmnibus.dbo.boleto (reasignado_id ASC)
WHERE ([reasignado_id] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_462E6E25E12906EB ON TerminalOmnibus.dbo.boleto (autorizacion_cortesia_id ASC)
WHERE ([autorizacion_cortesia_id] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX boleto_enviar_factura_email_IDX ON TerminalOmnibus.dbo.boleto (enviar_factura_email ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX boleto_pagina_web_reserva_id_IDX ON TerminalOmnibus.dbo.boleto (pagina_web_reserva_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX boleto_voucher_internet_id_IDX ON TerminalOmnibus.dbo.boleto (voucher_internet_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.boleto_bitacora definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.boleto_bitacora;
CREATE TABLE TerminalOmnibus.dbo.boleto_bitacora (
	id bigint IDENTITY(1, 1) NOT NULL,
	boleto_id bigint NOT NULL,
	estado_id bigint NOT NULL,
	usuario_id bigint NULL,
	fecha datetime2(6) NOT NULL,
	descripcion nvarchar(255) COLLATE Modern_Spanish_CI_AS NOT NULL,
	CONSTRAINT PK__boleto_b__3213E83FBE747035 PRIMARY KEY (id),
	CONSTRAINT FK_F5C3654C7F6F0A9B FOREIGN KEY (boleto_id) REFERENCES TerminalOmnibus.dbo.boleto(id) ON DELETE CASCADE,
	CONSTRAINT FK_F5C3654C9F5A440B FOREIGN KEY (estado_id) REFERENCES TerminalOmnibus.dbo.boleto_estado(id),
	CONSTRAINT FK_F5C3654CDB38439E FOREIGN KEY (usuario_id) REFERENCES TerminalOmnibus.dbo.custom_user(id)
);
CREATE NONCLUSTERED INDEX IDX_F5C3654C7F6F0A9B ON TerminalOmnibus.dbo.boleto_bitacora (boleto_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_F5C3654C9F5A440B ON TerminalOmnibus.dbo.boleto_bitacora (estado_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_F5C3654CDB38439E ON TerminalOmnibus.dbo.boleto_bitacora (usuario_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.encomienda definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.encomienda;
CREATE TABLE TerminalOmnibus.dbo.encomienda (
	id bigint IDENTITY(1, 1) NOT NULL,
	tipo_encomienda_id bigint NOT NULL,
	ruta_codigo nvarchar(6) COLLATE Modern_Spanish_CI_AS NOT NULL,
	tipo_encomienda_especial_id bigint NULL,
	cliente_remitente bigint NOT NULL,
	cliente_destinatario bigint NOT NULL,
	estacion_origen_id bigint NOT NULL,
	estacion_destino_id bigint NOT NULL,
	tipo_documento_id bigint NOT NULL,
	tarifa1_id bigint NULL,
	tarifa2_id bigint NULL,
	tarifa_distancia_id bigint NULL,
	moneda_id int NULL,
	tipo_cambio_id int NULL,
	tipo_pago_id bigint NULL,
	factura_generada_id bigint NULL,
	autorizacion_cortesia_id bigint NULL,
	autorizacion_interna_id bigint NULL,
	ultima_bitacora_id bigint NULL,
	primera_salida_id bigint NULL,
	boleto_id bigint NULL,
	empresa_id bigint NOT NULL,
	estacion_creacion_id bigint NOT NULL,
	usuario_creacion_id bigint NOT NULL,
	cantidad int NOT NULL,
	valor_declarado_porciento numeric(5, 2) NULL,
	valor_declarado int NULL,
	peso numeric(5, 0) NULL,
	alto numeric(5, 0) NULL,
	ancho numeric(5, 0) NULL,
	profundidad numeric(5, 0) NULL,
	volumen numeric(10, 0) NULL,
	descripcion varchar(MAX) COLLATE Modern_Spanish_CI_AS NULL,
	precioCalculadoMonedaBase numeric(7, 2) NULL,
	precioCalculado numeric(7, 2) NULL,
	por_cobrar_sin_facturar bit NULL,
	codigo nvarchar(50) COLLATE Modern_Spanish_CI_AS NOT NULL,
	observacion varchar(MAX) COLLATE Modern_Spanish_CI_AS NULL,
	transito bit NULL,
	fecha_creacion datetime2(6) NOT NULL,
	cliente_documento bigint NULL,
	identificador_web nvarchar(80) COLLATE Modern_Spanish_CI_AS NULL,
	codigo_externo_cliente nvarchar(50) COLLATE Modern_Spanish_CI_AS NULL,
	CONSTRAINT PK__encomien__3213E83F87AFF7B9 PRIMARY KEY (id),
	CONSTRAINT FK_36A271EE1EB6D91A FOREIGN KEY (tarifa2_id) REFERENCES TerminalOmnibus.dbo.tarifas_encomienda(id),
	CONSTRAINT FK_36A271EE2045F8DE FOREIGN KEY (factura_generada_id) REFERENCES TerminalOmnibus.dbo.factura_generada(id) ON DELETE
	SET NULL,
		CONSTRAINT FK_36A271EE28CB339A FOREIGN KEY (ruta_codigo) REFERENCES TerminalOmnibus.dbo.ruta(codigo),
		CONSTRAINT FK_36A271EE38B49CAE FOREIGN KEY (primera_salida_id) REFERENCES TerminalOmnibus.dbo.salida(id) ON DELETE
	SET NULL,
		CONSTRAINT FK_36A271EE3F85FB74 FOREIGN KEY (tarifa_distancia_id) REFERENCES TerminalOmnibus.dbo.tarifas_encomienda(id),
		CONSTRAINT FK_36A271EE46A82360 FOREIGN KEY (cliente_remitente) REFERENCES TerminalOmnibus.dbo.cliente(id),
		CONSTRAINT FK_36A271EE521E1991 FOREIGN KEY (empresa_id) REFERENCES TerminalOmnibus.dbo.empresa(id),
		CONSTRAINT FK_36A271EE59A7CA66 FOREIGN KEY (estacion_destino_id) REFERENCES TerminalOmnibus.dbo.estacion(id),
		CONSTRAINT FK_36A271EE5F37B590 FOREIGN KEY (estacion_creacion_id) REFERENCES TerminalOmnibus.dbo.estacion(id),
		CONSTRAINT FK_36A271EE7002A220 FOREIGN KEY (tipo_pago_id) REFERENCES TerminalOmnibus.dbo.tipo_pago(id),
		CONSTRAINT FK_36A271EE7BF277D8 FOREIGN KEY (ultima_bitacora_id) REFERENCES TerminalOmnibus.dbo.encomienda_bitacora(id) ON DELETE
	SET NULL,
		CONSTRAINT FK_36A271EE7F6F0A9B FOREIGN KEY (boleto_id) REFERENCES TerminalOmnibus.dbo.boleto(id),
		CONSTRAINT FK_36A271EEA1BCA103 FOREIGN KEY (cliente_documento) REFERENCES TerminalOmnibus.dbo.cliente(id),
		CONSTRAINT FK_36A271EEA6426DFA FOREIGN KEY (tipo_encomienda_especial_id) REFERENCES TerminalOmnibus.dbo.encomienda_especiales_tipo(id),
		CONSTRAINT FK_36A271EEAEADF654 FOREIGN KEY (usuario_creacion_id) REFERENCES TerminalOmnibus.dbo.custom_user(id),
		CONSTRAINT FK_36A271EEB524F5D3 FOREIGN KEY (autorizacion_interna_id) REFERENCES TerminalOmnibus.dbo.autorizacion_interna(id) ON DELETE CASCADE,
		CONSTRAINT FK_36A271EEB77634D2 FOREIGN KEY (moneda_id) REFERENCES TerminalOmnibus.dbo.moneda(id),
		CONSTRAINT FK_36A271EEBCF2DB9B FOREIGN KEY (tipo_cambio_id) REFERENCES TerminalOmnibus.dbo.tipo_cambio(id),
		CONSTRAINT FK_36A271EEBF6CF13D FOREIGN KEY (estacion_origen_id) REFERENCES TerminalOmnibus.dbo.estacion(id),
		CONSTRAINT FK_36A271EEC0376F4 FOREIGN KEY (tarifa1_id) REFERENCES TerminalOmnibus.dbo.tarifas_encomienda(id),
		CONSTRAINT FK_36A271EECB72E181 FOREIGN KEY (tipo_encomienda_id) REFERENCES TerminalOmnibus.dbo.encomienda_tipo(id),
		CONSTRAINT FK_36A271EEE12906EB FOREIGN KEY (autorizacion_cortesia_id) REFERENCES TerminalOmnibus.dbo.autorizacion_cortesia(id),
		CONSTRAINT FK_36A271EEF3355735 FOREIGN KEY (cliente_destinatario) REFERENCES TerminalOmnibus.dbo.cliente(id),
		CONSTRAINT FK_36A271EEF6939175 FOREIGN KEY (tipo_documento_id) REFERENCES TerminalOmnibus.dbo.encomienda_documento_tipo(id)
);
CREATE NONCLUSTERED INDEX IDX_36A271EE1EB6D91A ON TerminalOmnibus.dbo.encomienda (tarifa2_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_36A271EE2045F8DE ON TerminalOmnibus.dbo.encomienda (factura_generada_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_36A271EE28CB339A ON TerminalOmnibus.dbo.encomienda (ruta_codigo ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_36A271EE38B49CAE ON TerminalOmnibus.dbo.encomienda (primera_salida_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_36A271EE3F85FB74 ON TerminalOmnibus.dbo.encomienda (tarifa_distancia_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_36A271EE46A82360 ON TerminalOmnibus.dbo.encomienda (cliente_remitente ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_36A271EE521E1991 ON TerminalOmnibus.dbo.encomienda (empresa_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_36A271EE59A7CA66 ON TerminalOmnibus.dbo.encomienda (estacion_destino_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_36A271EE5F37B590 ON TerminalOmnibus.dbo.encomienda (estacion_creacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_36A271EE7002A220 ON TerminalOmnibus.dbo.encomienda (tipo_pago_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_36A271EE7BF277D8 ON TerminalOmnibus.dbo.encomienda (ultima_bitacora_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_36A271EE7F6F0A9B ON TerminalOmnibus.dbo.encomienda (boleto_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_36A271EEA1BCA103 ON TerminalOmnibus.dbo.encomienda (cliente_documento ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_36A271EEA6426DFA ON TerminalOmnibus.dbo.encomienda (tipo_encomienda_especial_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_36A271EEAEADF654 ON TerminalOmnibus.dbo.encomienda (usuario_creacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_36A271EEB77634D2 ON TerminalOmnibus.dbo.encomienda (moneda_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_36A271EEBCF2DB9B ON TerminalOmnibus.dbo.encomienda (tipo_cambio_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_36A271EEBF6CF13D ON TerminalOmnibus.dbo.encomienda (estacion_origen_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_36A271EEC0376F4 ON TerminalOmnibus.dbo.encomienda (tarifa1_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_36A271EECB72E181 ON TerminalOmnibus.dbo.encomienda (tipo_encomienda_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_36A271EEF3355735 ON TerminalOmnibus.dbo.encomienda (cliente_destinatario ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_36A271EEF6939175 ON TerminalOmnibus.dbo.encomienda (tipo_documento_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_36A271EE20332D99 ON TerminalOmnibus.dbo.encomienda (codigo ASC)
WHERE ([codigo] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_36A271EEB524F5D3 ON TerminalOmnibus.dbo.encomienda (autorizacion_interna_id ASC)
WHERE ([autorizacion_interna_id] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
CREATE UNIQUE NONCLUSTERED INDEX UNIQ_36A271EEE12906EB ON TerminalOmnibus.dbo.encomienda (autorizacion_cortesia_id ASC)
WHERE ([autorizacion_cortesia_id] IS NOT NULL) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
-- TerminalOmnibus.dbo.encomienda_ruta definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.encomienda_ruta;
CREATE TABLE TerminalOmnibus.dbo.encomienda_ruta (
	id bigint IDENTITY(1, 1) NOT NULL,
	encomienda_id bigint NOT NULL,
	ruta_codigo nvarchar(6) COLLATE Modern_Spanish_CI_AS NOT NULL,
	estacion bigint NOT NULL,
	posicion int NOT NULL,
	CONSTRAINT PK__encomien__3213E83FB916DCB7 PRIMARY KEY (id),
	CONSTRAINT FK_890C26AB28CB339A FOREIGN KEY (ruta_codigo) REFERENCES TerminalOmnibus.dbo.ruta(codigo),
	CONSTRAINT FK_890C26AB32B2395F FOREIGN KEY (estacion) REFERENCES TerminalOmnibus.dbo.estacion(id),
	CONSTRAINT FK_890C26ABCBC1B2DF FOREIGN KEY (encomienda_id) REFERENCES TerminalOmnibus.dbo.encomienda(id) ON DELETE CASCADE
);
CREATE NONCLUSTERED INDEX IDX_890C26AB28CB339A ON TerminalOmnibus.dbo.encomienda_ruta (ruta_codigo ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_890C26AB32B2395F ON TerminalOmnibus.dbo.encomienda_ruta (estacion ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_890C26ABCBC1B2DF ON TerminalOmnibus.dbo.encomienda_ruta (encomienda_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
-- TerminalOmnibus.dbo.autorizacion_operacion definition
-- Drop table
-- DROP TABLE TerminalOmnibus.dbo.autorizacion_operacion;
CREATE TABLE TerminalOmnibus.dbo.autorizacion_operacion (
	id bigint IDENTITY(1, 1) NOT NULL,
	estacion_id bigint NOT NULL,
	boleto_id bigint NOT NULL,
	tipo_id smallint NULL,
	estado_id smallint NULL,
	estacion_creacion_id bigint NULL,
	usuario_creacion_id bigint NULL,
	usuario_actualizacion_id bigint NULL,
	motivo nvarchar(150) COLLATE Modern_Spanish_CI_AS NOT NULL,
	observacion nvarchar(150) COLLATE Modern_Spanish_CI_AS NULL,
	fecha_creacion datetime2(6) NOT NULL,
	fecha_actualizacion datetime2(6) NULL,
	CONSTRAINT PK__autoriza__3213E83F860FCEF6 PRIMARY KEY (id),
	CONSTRAINT FK_A41AAA522A4AF395 FOREIGN KEY (estacion_id) REFERENCES TerminalOmnibus.dbo.estacion(id),
	CONSTRAINT FK_A41AAA525F37B590 FOREIGN KEY (estacion_creacion_id) REFERENCES TerminalOmnibus.dbo.estacion(id),
	CONSTRAINT FK_A41AAA527F6F0A9B FOREIGN KEY (boleto_id) REFERENCES TerminalOmnibus.dbo.boleto(id) ON DELETE CASCADE,
	CONSTRAINT FK_A41AAA529F5A440B FOREIGN KEY (estado_id) REFERENCES TerminalOmnibus.dbo.autorizacion_operacion_estado(id),
	CONSTRAINT FK_A41AAA52A9276E6C FOREIGN KEY (tipo_id) REFERENCES TerminalOmnibus.dbo.autorizacion_operacion_tipo(id),
	CONSTRAINT FK_A41AAA52AEADF654 FOREIGN KEY (usuario_creacion_id) REFERENCES TerminalOmnibus.dbo.custom_user(id),
	CONSTRAINT FK_A41AAA52CCED81D FOREIGN KEY (usuario_actualizacion_id) REFERENCES TerminalOmnibus.dbo.custom_user(id)
);
CREATE UNIQUE NONCLUSTERED INDEX CUSTOM_IDX_AUTORIZACION_ESTACION_BOLETO_TIPO ON TerminalOmnibus.dbo.autorizacion_operacion (
	estacion_id ASC,
	boleto_id ASC,
	tipo_id ASC
)
WHERE (
		[estacion_id] IS NOT NULL
		AND [boleto_id] IS NOT NULL
		AND [tipo_id] IS NOT NULL
	) WITH (
		PAD_INDEX = OFF,
		FILLFACTOR = 100,
		SORT_IN_TEMPDB = OFF,
		IGNORE_DUP_KEY = OFF,
		STATISTICS_NORECOMPUTE = OFF,
		ONLINE = OFF,
		ALLOW_ROW_LOCKS = ON,
		ALLOW_PAGE_LOCKS = ON
	) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_A41AAA522A4AF395 ON TerminalOmnibus.dbo.autorizacion_operacion (estacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_A41AAA525F37B590 ON TerminalOmnibus.dbo.autorizacion_operacion (estacion_creacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_A41AAA527F6F0A9B ON TerminalOmnibus.dbo.autorizacion_operacion (boleto_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_A41AAA529F5A440B ON TerminalOmnibus.dbo.autorizacion_operacion (estado_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_A41AAA52A9276E6C ON TerminalOmnibus.dbo.autorizacion_operacion (tipo_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_A41AAA52AEADF654 ON TerminalOmnibus.dbo.autorizacion_operacion (usuario_creacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
CREATE NONCLUSTERED INDEX IDX_A41AAA52CCED81D ON TerminalOmnibus.dbo.autorizacion_operacion (usuario_actualizacion_id ASC) WITH (
	PAD_INDEX = OFF,
	FILLFACTOR = 100,
	SORT_IN_TEMPDB = OFF,
	IGNORE_DUP_KEY = OFF,
	STATISTICS_NORECOMPUTE = OFF,
	ONLINE = OFF,
	ALLOW_ROW_LOCKS = ON,
	ALLOW_PAGE_LOCKS = ON
) ON [PRIMARY ];
