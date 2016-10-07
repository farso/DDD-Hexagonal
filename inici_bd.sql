 -- Table: hexagonal.tipus_centres

-- DROP TABLE hexagonal.tipus_centres;
CREATE DATABASE hexagonal;

CREATE SCHEMA hexagonal;

CREATE TABLE hexagonal.tipus_centres
(
  id serial NOT NULL,
  uuid uuid NOT NULL,
  descri_cat character varying(32),
  descri_esp character varying(32),
  descri_eng character varying(32),
  CONSTRAINT tipus_centres__pkey PRIMARY KEY (uuid)
)
WITH (
  OIDS=FALSE
);


-- Table: hexagonal.centros

-- DROP TABLE hexagonal.centros;

CREATE TABLE hexagonal.centros
(
  codigo serial NOT NULL,
  uuid uuid NOT NULL,
  nombre character varying(80),
  tipus uuid,
  mail_centre character varying(50),
  cod_centro character varying(50),
  color character varying(8),
  codigo_oficial character varying(8),
  CONSTRAINT centros__pkey PRIMARY KEY (uuid),
  CONSTRAINT centros__tipus_centres__fkey FOREIGN KEY (tipus)
      REFERENCES hexagonal.tipus_centres (uuid) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);

-- Table: hexagonal.departamentos

-- DROP TABLE hexagonal.departamentos;

CREATE TABLE hexagonal.departamentos
(
  codigo serial NOT NULL,
  uuid uuid NOT NULL,
  nombre character varying(50),
  uuid_centro uuid,
  codigo_mec integer,
  uuid_centro_oficial uuid,
  CONSTRAINT departamentos__pkey PRIMARY KEY (uuid),
  CONSTRAINT departamentos__centros__fkey FOREIGN KEY (uuid_centro)
      REFERENCES hexagonal.centros (uuid) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT departamentos__centros_oficial__fkey FOREIGN KEY (uuid_centro_oficial)
      REFERENCES hexagonal.centros (uuid) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);

ALTER TABLE "hexagonal"."centros"
  ADD COLUMN "address_carrer" VARCHAR;

COMMENT ON COLUMN "hexagonal"."centros"."address_carrer"
IS 'carrer';


CREATE TABLE "public"."event" (
  "event_id" INTEGER, 
  "event_body" TEXT, 
  "type_name" "varchar", 
  "occurred_on" TIMESTAMP WITHOUT TIME ZONE, 
  PRIMARY KEY("event_id")
) WITH OIDS;



