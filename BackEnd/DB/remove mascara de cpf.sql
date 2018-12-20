

-- (regexp_matches(usuarios_ldap.cpf, '[0-9]+\.?[0-9]*'))[1]
-- select (regexp_matches('999.963.837-68', '\D*', '', 'g'));
-- select regexp_replace('999.963.837-68', '[^[:digit:]]','','g');


UPDATE usuarios_ldap set cpf= regexp_replace(usuarios_ldap.cpf ,'[^[:digit:]]','','g');