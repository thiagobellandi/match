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
 
 "token": token do curso
 
 "ltoken": token de acesso a api
 
 
 Retorno:
 
{
  "msg": "Curso excluido"
  
  "status": "true"
}
 
 
 
  ## Editar Curso
  
 URl: http://34.73.203.137/course/edit
 
 
 Parametros: 
 
 "title": titulo do curso
 
 "description": descricao do curso
 
 "datestart": data inicio do curso
 
 "dateend": data termino do curso
 
 "ltoken": token de acesso a api
 
 
 
 Retorno:
 
{
  "msg": "Os dados do curso foram editados",
  
  "status": "true"
}
 
 
 # Estudantes
 
 ## Adicionar Aluno
 
 URl: http://34.73.203.137/student/inser
 
 
 Parametros: 
 
name: nome do aluno

mail: email do aluno

birthday: data de nascimento do aluno

status: status do aluno. 1 ativo e 2 desativado

ltoken: token de acesso da api
 
 
 Retorno:
 
{

  "msg": "Aluno cadastrado com sucesso",
  
  "status": "true"
  
}
 
 
 ## Obter Aluno
 
   URl: http://34.73.203.137/student/get


 Parametros: 
 
 "token": token do aluno
 
 "ltoken": token de acesso a api
 
 
 Retorno:
 
{
  "student": {
  
    "stud_id": "4",
    
    "stud_name": "thiago",
    
    "stud_mail": "thiago bellandi",
    
    "stud_birthday": "1981-10-27",
    
    "stud_status": "1",
    
    "stud_token": "d609b87ab24078b5b0b1d55166f468d7"
    
  },
  
  "msg": "",
  
  "status": "true"
}
    
    
  ## Listar Alunos
  
   URl: http://34.73.203.137/student/getall
 
 
 Parametros: 
 
 "ltoken": token de acesso a api
 
 
 Retorno:
 
{

  "students": [
    {
    
      "stud_id": "4",
      
      "stud_name": "thiago",
      
      "stud_mail": "thiago bellandi",
      
      "stud_birthday": "1981-10-27",
      
      "stud_status": "1",
      
      "stud_token": "d609b87ab24078b5b0b1d55166f468d7"
      
    }
  ]
}


## Excluir Aluno
 
 URl: http://34.73.203.137/student/delete
 
 
 Parametros: 
 
 "token": token do aluno
 
 "ltoken": token de acesso a api
 
 
 Retorno:
 
{
  "msg": "aluno excluido"
  
  "status": "true"
}
 
 
 
  ## Editar Aluno
  
 URl: http://34.73.203.137/student/edit
 
 
 Parametros: 
 
name: nome do aluno

mail: email do aluno

birthday: data de nascimento do aluno

status: status do aluno. 1 ativo e 2 desativado

ltoken: token de acesso da api
 
 
 Retorno:
 
{

  "msg": "Dados do aluno editado com sucesso",
  
  "status": "true"
  
}
 


# Matriculas
 
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
 
 "token": token do curso
 
 "ltoken": token de acesso a api
 
 
 Retorno:
 
{
  "msg": "Curso excluido"
  
  "status": "true"
}
 
 
 
  ## Editar Curso
  
 URl: http://34.73.203.137/course/edit
 
 
 Parametros: 
 
 "title": titulo do curso
 
 "description": descricao do curso
 
 "datestart": data inicio do curso
 
 "dateend": data termino do curso
 
 "ltoken": token de acesso a api
 
 
 
 Retorno:
 
{
  "msg": "Os dados do curso foram editados",
  
  "status": "true"
}
 

