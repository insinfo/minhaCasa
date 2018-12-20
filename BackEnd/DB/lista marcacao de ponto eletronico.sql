-- SELECT * FROM "biometrias" WHERE nm_pessoa ilike '%Isaque%'  --  to_char(i,'YYYY-MM-DD') as "data" to_char(i,'day ') as "week",
select to_char(i,'DD') as "dia",
CASE EXTRACT( DOW FROM i)
             WHEN 0 THEN 'Domingo'
             WHEN 1 THEN 'Segunda'
             WHEN 2 THEN 'Terça'
             WHEN 3 THEN 'Quarta'
             WHEN 4 THEN 'Quinta'
             WHEN 5 THEN 'Sexta'
             WHEN 6 THEN 'Sábado'
        END AS "diaSemana", ponto.*
from generate_series(date_trunc('MONTH',now())::DATE, (date_trunc('month', CURRENT_DATE) + interval '1 month' - interval '1 day')::date,'1 day') as i
LEFT JOIN (

select data_ponto,matricula,cpf, nome, entrada1,saida1,
entrada2, saida2, entrada3,saida3, entrada4, saida4
from marcacao
where cpf  ='13128250731'
and extract(month FROM data_ponto) = '9'
and extract(YEAR FROM data_ponto) = '2018'

) as ponto on ponto.data_ponto = i;

-- to_char(i,'YYYY-MM-DD');

