CREATE TABLE jubarte.activate_codes (
  code character varying(6) NOT NULL,
  expire timestamp without time zone NOT NULL,
  pessoa_id integer
);
