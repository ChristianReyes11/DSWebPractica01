CREATE USER myuser;
CREATE DATABASE mydb;
GRANT ALL PRIVILEGES ON DATABASE mydb TO myuser;

ALTER DATABASE mydb OWNER TO myuser;

\connect mydb
CREATE TABLE pejemplo
(
    clave SERIAL PRIMARY KEY,
    nombre character varying,
    direccion character varying,
    telefono character varying
);

ALTER TABLE pejemplo OWNER TO myuser;
