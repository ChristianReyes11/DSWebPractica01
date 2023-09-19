CREATE USER myuser;
CREATE DATABASE mydb;
GRANT ALL PRIVILEGES ON DATABASE mydb TO myuser;

ALTER DATABASE mydb OWNER TO myuser;

\connect mydb
CREATE TABLE mytable
(
    clave SERIAL PRIMARY KEY,
    nombre character varying,
    direccion character varying,
    telefono character varying
);

CREATE TABLE usuario
(
    clave SERIAL PRIMARY KEY,
    username character varying,
    contra character varying

);

ALTER TABLE mytable OWNER TO myuser;
ALTER TABLE usuario OWNER TO myuser;