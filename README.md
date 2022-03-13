# SISTEMA MATRÍCULA
 
 Sistema de Gestão de Cursos e Matrículas
 
# LOGIN
 
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
 
 
 # USUÁRIOS
 
 ## Novos Usuários
 
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
 
 
 ## Exibir usuário
 
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
    
    
  
  ## Listar Usuários
  
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


 ## Excluir Usuário
 
 URl: http://34.73.203.137/user/delete
 
 
 Parametros: 
 
 "token": token do usuario
 
 "ltoken": token de acesso a api
 
 
 Retorno:
 
 "erro": true or false
 
 "msg": mesagem se ousuario foi excluido ou nao
 
 
  ## Editar Usuário
 
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
 

 # CURSOS
 
 ## Adicionar Curso
 
 URl: http://34.73.203.137/user/insert
 
 
 Parametros: 
 
 "title": titulo do curso
 
 "description": descricao do curso
 
 "datestart": data inicio do curso
 
 "dateend": data termino do curso
 
 "ltoken": token de acesso a api
 
 
 Retorno:
 
{

  "msg": mensagem se o curso foi cadastrado
  
  "status": statusonfirmacao de cadastro
  
}
 
 
 ## Obter Curso
 
   URl: http://34.73.203.137/course/get


 Parametros: 
 
 "token": token do curso
 
 "ltoken": token de acesso a api
 
 
 Retorno:
 
{
  "course": {
  
    "cour_id": "6",
    
    "cour_title": "matematica",
    
    "cour_description": "curso matematica",
    
    "cour_date_start": "2022-10-10",
    
    "cour_date_end": "2022-11-10",
    
    "cour_token": "7a93f6ff70eaf9abf0c8f7f4729d1c76"
    
  },
  
  "msg": "",
  
  "status": "true"
}
    
    
  ## Listar Cursos
  
   URl: http://34.73.203.137/course/getall
 
 
 Parametros: 
 
 "ltoken": token de acesso a api
 
 
 Retorno:
 
{
  "courses": [
    {
      "cour_id": "6",
      "cour_title": "matematica",
      "cour_description": "cursomatematica",
      "cour_date_start": "2022-10-10",
      "cour_date_end": "2022-11-10",
      "cour_token": "7a93f6ff70eaf9abf0c8f7f4729d1c76"
    }
  ]
}


## Excluir Curso
 
 URl: http://34.73.203.137/course/delete
 
 
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
 
