-- recursão inversa traz os pais de um filho
with RECURSIVE arvore_organograma as(
	select "idPai" as pid, 1 as nivel,sigla,"idOrganograma" from organograma_historico where "idOrganograma" =  19
	union all
	select a."idPai" as pid, nivel+1,a.sigla,a."idOrganograma"
	from organograma_historico a
	inner join arvore_organograma b on a."idOrganograma" = b.pid and (a."idOrganograma" <> a."idPai" or a."idPai" is null)
-- 	and  a."idOrganograma" != 389
)
select *
from arvore_organograma
order by nivel desc;

-- lista servidores de uma determinada arvore de organograma
SELECT * FROM portal_rh."view_servidores" WHERE "idLotacao" in

		(with RECURSIVE arvore_organograma as(
			select "idPai" as pid, 1 as nivel,sigla,"idOrganograma" from organograma_historico where "idOrganograma" =  19
			union all
			select a."idPai" as pid, nivel+1,a.sigla,a."idOrganograma"
			from organograma_historico a
			inner join arvore_organograma b on a."idOrganograma" = b.pid and (a."idOrganograma" <> a."idPai" or a."idPai" is null )
		)
		select "idOrganograma"
		from arvore_organograma
		order by nivel desc)

limit 3;