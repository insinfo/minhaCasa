SELECT
matricula,cpf, nome, data_ponto, entrada1,saida1,
entrada2, saida2, entrada3,saida3,
entrada4, saida4,
hs_trabalhadas::time ,
extract(day FROM data_ponto) as dia,
 extract(epoch FROM hs_trabalhadas) /3600.00 as horas

FROM marcacao
WHERE  cpf = '11671350758'
and extract(month FROM data_ponto) = 01
and extract(YEAR FROM data_ponto) = 2018

-- extract(month FROM CURRENT_TIMESTAMP)
ORDER BY data_ponto
limit 40;

-- SELECT EXTRACT(month FROM CURRENT_DATE - '1 month'::interval);