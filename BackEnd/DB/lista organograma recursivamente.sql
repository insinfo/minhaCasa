-- SELECT * FROM "organograma_historico";
WITH RECURSIVE arvore_organograma ("idOrganograma", nome,nivel,nomecompleto) AS
(
-- Ancora
SELECT "idOrganograma", nome,1 AS nivel,CAST(sigla AS VARCHAR(255)) AS nomecompleto
FROM organograma_historico WHERE "idPai" is null

UNION ALL

-- Parte RECURSIVA
SELECT m."idOrganograma", m.nome,c.nivel + 1 AS nivel,
 CAST((c.nomecompleto || ' / ' || m.sigla) AS VARCHAR(255)) AS nomecompleto

FROM organograma_historico m

INNER JOIN arvore_organograma c ON c."idOrganograma" = m."idPai"

)
SELECT Nivel,NomeCompleto FROM arvore_organograma