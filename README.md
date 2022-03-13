# Sistema Matricula
 
 Sistema de Gestão de Cursos e Matrículas
 
# Login
 
 [Realizar o login com o usuário padrão para obter o token de acesso:]
 
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
 
 ##NOVOS USUÁRIOS
 
 URl: http://34.73.203.137/user/insert
 
 
 Parametros: 
 
 "name": nome do usuario
 
 "mail": email do usuario
 
 "status": status da conta. 0 desativado e 1 para ativado
 
 "password": senha do usuario
 
 "ltoken": token de acesso a api
 
 
 Retorno:
 
 "erro": true or false
 
 "msg": mesagem se o cadastro foi efetuado ou não
 
 
 ##EXIBIR USUÁRIO
 
   URl: http://34.73.203.137/user/get
 
 
 Parametros: 
 
 "token": token do usuario
 
 "ltoken": token de acesso a api
 
 
 Retorno:
 
 "users": lista de usuarios
 
    {
    
      "user_id": id do usuario,
      
      "user_name": nome do usuario,
      
      "user_mail": email do usuario,
      
      "user_status": satus do usuario,
      
      "user_token": token do usuario,
      
      "user_password": senha do usuario criptografada
      
    }
    
    
  
  ##LISTAR USUÁRIOS
  
   URl: http://34.73.203.137/user/getall
 
 
 Parametros: 
 
 "ltoken": token de acesso a api
 
 
 Retorno:
 
 "users": lista de usuarios
 
    {
    
      "user_id": id do usuario,
      
      "user_name": nome do usuario,
      
      "user_mail": email do usuario,
      
      "user_status": satus do usuario,
      
      "user_token": token do usuario,
      
      "user_password": senha do usuario criptografada
      
    }


 ##EXCLUIR USUÁRIO
 
 URl: http://34.73.203.137/user/delete
 
 
 Parametros: 
 
 "token": token do usuario
 
 "ltoken": token de acesso a api
 
 
 Retorno:
 
 "erro": true or false
 
 "msg": mesagem se ousuario foi excluido ou nao
 
 
  ##EDITAR USUÁRIO
 
 URl: http://34.73.203.137/user/edit
 
 
 Parametros: 
 
 "name": nome do usuario
 
 "mail": email do usuario
 
 "status": status da conta. 0 desativado e 1 para ativado
 
 "password": senha do usuario
 
 "token": token do usuario
 
 "ltoken": token de acesso a api
 
 
 Retorno:
 
 "erro": true or false
 
 "msg": mesagem se o usuario foi editado ou não
 

 # Cursos
 
 *NOVOS USUÁRIOS:*
 
 URl: http://34.73.203.137/user/insert
 
 
 Parametros: 
 
 "name": nome do usuario
 
 "mail": email do usuario
 
 "status": status da conta. 0 desativado e 1 para ativado
 
 "password": senha do usuario
 
 "ltoken": token de acesso a api
 
 
 Retorno:
 
 "erro": true or false
 
 "msg": mesagem se o cadastro foi efetuado ou não
 
 
 *EXIBIR USUÁRIO:*
 
   URl: http://34.73.203.137/user/get


 Parametros: 
 
 "token": token do usuario
 
 "ltoken": token de acesso a api
 
 
 Retorno:
 
 "users": lista de usuarios
 
    {
    
      "user_id": id do usuario,
      
      "user_name": nome do usuario,
      
      "user_mail": email do usuario,
      
      "user_status": satus do usuario,
      
      "user_token": token do usuario,
      
      "user_password": senha do usuario criptografada
      
    }
    
    
  *LISTAR USUÁRIOS:*
  
   URl: http://34.73.203.137/user/getall
 
 
 Parametros: 
 
 "ltoken": token de acesso a api
 
 
 Retorno:
 
 "users": lista de usuarios
 
    {
    
      "user_id": id do usuario,
      
      "user_name": nome do usuario,
      
      "user_mail": email do usuario,
      
      "user_status": satus do usuario,
      
      "user_token": token do usuario,
      
      "user_password": senha do usuario criptografada
      
    }


 *EXCLUIR USUÁRIO:*
 
 URl: http://34.73.203.137/user/delete
 
 
 Parametros: 
 
 "token": token do usuario
 
 "ltoken": token de acesso a api
 
 
 Retorno:
 
 "erro": true or false
 
 "msg": mesagem se ousuario foi excluido ou nao
 
 
  *EDITAR USUÁRIO:*
 
 URl: http://34.73.203.137/user/edit
 
 
 Parametros: 
 
 "name": nome do usuario
 
 "mail": email do usuario
 
 "status": status da conta. 0 desativado e 1 para ativado
 
 "password": senha do usuario
 
 "token": token do usuario
 
 "ltoken": token de acesso a api
 
 
 Retorno:
 
 "erro": true or false
 
 "msg": mesagem se o usuario foi editado ou não
 
