# Sistema Matricula
 
 Sistema de Gestão de Cursos e Matrículas
 
# Login
 
 Realizar o login com o usuário padrão para obter o token de acesso:
 
 URL: http://34.73.203.137/login/make
 Login: admin@match.com
 Senha: 1234

 Parametros: 
 "login"
 "password"
 
 Retorno:
 "erro": true or false
 "msg": mesagem se o login foi efetuado ou não
 "token": token a ser utilizado para acessar as outras funcionalidades da api
 
 
 # Usuários
 
 *Para criar novos usuários:*
 
 URl: http://34.73.203.137/user/insert
 
 Parametros: 
 "name": nome do usuario
 "mail": email do usuario
 "status": status da conta. 0 desativado e 1 para ativado
 "password": senha do usuario
 
 Retorno:
 "erro": true or false
 "msg": mesagem se o cadastro foi efetuado ou não
 
 
