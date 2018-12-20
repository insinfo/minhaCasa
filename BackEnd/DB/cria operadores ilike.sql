-- SELECT * FROM pg_operator where "oprname" ilike'~~*';
-- CREATE OPERATOR ~~* (LEFTARG=text, RIGHTARG=text,PROCEDURE=texticlike);
/********************** SO PODE EXECUTAR UMA VEZ **************************/
-- remove os operadores ilike originais
DELETE FROM pg_operator where "oprname" ='~~*';

-- cria os operadores ilike
INSERT INTO pg_operator ("oprname", "oprnamespace", "oprowner", "oprkind", "oprcanmerge", "oprcanhash", "oprleft", "oprright", "oprresult", "oprcom", "oprnegate", "oprcode", "oprrest", "oprjoin") VALUES ('~~*', 11, 10, 'b', 'f', 'f', 19, 25, 16, 0, 1626, 'nameiclike', 'iclikesel', 'iclikejoinsel');
INSERT INTO pg_operator("oprname", "oprnamespace", "oprowner", "oprkind", "oprcanmerge", "oprcanhash", "oprleft", "oprright", "oprresult", "oprcom", "oprnegate", "oprcode", "oprrest", "oprjoin") VALUES ('~~*', 11, 10, 'b', 'f', 'f', 25, 25, 16, 0, 1628, 'text_ilike', 'iclikesel', 'iclikejoinsel');
INSERT INTO pg_operator("oprname", "oprnamespace", "oprowner", "oprkind", "oprcanmerge", "oprcanhash", "oprleft", "oprright", "oprresult", "oprcom", "oprnegate", "oprcode", "oprrest", "oprjoin") VALUES ('~~*', 11, 10, 'b', 'f', 'f', 1042, 25, 16, 0, 1630, 'bpchariclike', 'iclikesel', 'iclikejoinsel');

/************************************************/
-- cria uma função para remoção de acentos
CREATE OR REPLACE FUNCTION "remove_acentos"(varchar)
  RETURNS "varchar" AS $BODY$
SELECT TRANSLATE(($1),

                 'áéíóúàèìòùãõâêîôôäëïöüçÁÉÍÓÚÀÈÌÒÙÃÕÂÊÎÔÛÄËÏÖÜÇ',
                 'aeiouaeiouaoaeiooaeioucAEIOUAEIOUAOAEIOOAEIOUC')
$BODY$
LANGUAGE sql VOLATILE
COST 100;

-- cria função de comparação de string que ignora case e acentos
CREATE OR REPLACE FUNCTION "text_ilike"("leftop" text, "rightop" text)
  RETURNS "bool" AS $BODY$ SELECT texticlike(remove_acentos($1), remove_acentos($2)) ;$BODY$
LANGUAGE sql VOLATILE
COST 100;

-- cria função de comparação de bool e text para operador ilike
CREATE OR REPLACE FUNCTION "boolean_ilike"("leftop" bool, "rightop" text)
  RETURNS "bool" AS $BODY$ SELECT texticlike($1::text, $2);$BODY$
LANGUAGE sql VOLATILE
COST 100;

-- cria função de comparação de int4 e text para operador ilike
CREATE OR REPLACE FUNCTION "int_ilike"("leftop" integer, "rightop" text)
  RETURNS "bool" AS $BODY$ SELECT texticlike($1::text, $2);$BODY$
LANGUAGE sql VOLATILE
COST 100;

-- cria função de comparação de date e text  para operador ilike
CREATE OR REPLACE FUNCTION "date_ilike"("leftop" date, "rightop" text)
  RETURNS "bool" AS $BODY$ SELECT  texticlike(to_char($1,'DD/MM/YYYY'), $2) ;$BODY$
LANGUAGE sql VOLATILE
COST 100;

-- cria função de comparação de money e text  para operador ilike
CREATE OR REPLACE FUNCTION "money_ilike"("leftop" money, "rightop" text)
  RETURNS "bool" AS $BODY$SELECT texticlike($1::text, $2);$BODY$
LANGUAGE sql VOLATILE
COST 100;

-- cria função de comparação de int4 e text para operador like
CREATE OR REPLACE FUNCTION "int_like"("leftop" integer, "rightop" text)
  RETURNS "bool" AS $BODY$ SELECT texticlike($1::text, $2);$BODY$
LANGUAGE sql VOLATILE
COST 100;


-- cria operador ilike para boolean
CREATE OPERATOR ~~* (LEFTARG=boolean, RIGHTARG=text,PROCEDURE=boolean_ilike);
-- cria operador ilike para date
CREATE OPERATOR ~~* (LEFTARG=date, RIGHTARG=text,PROCEDURE=date_ilike);
-- cria operador ilike para integer
CREATE OPERATOR ~~* (LEFTARG=integer, RIGHTARG=text,PROCEDURE=int_ilike);
-- cria operador ilike para money
CREATE OPERATOR ~~* (LEFTARG=money, RIGHTARG=text,PROCEDURE=money_ilike);
-- cria operador like para integer
CREATE OPERATOR ~~ (LEFTARG=integer, RIGHTARG=text,PROCEDURE=int_like);


