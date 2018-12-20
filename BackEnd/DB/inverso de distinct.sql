select login, count(login)
from usuarios
group by login -- , "idSistema" -- ,"idPerfil"
having count(login) > 1