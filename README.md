# SISTEMA MATRÍCULA
 
 O arquivo sql está na pasta raiz do projeto. Banco de dados utilizado foi o MySql
 Arquivo: matricula-sql.zip
 
 Sistema de Gestão de Cursos e Matrículas
 
 Todos os parametros devem ser passado pela url dentro da variavel "param":
 
 EX: http://34.73.203.137/login/make?param=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJsb2dpbiI6ImFkbWluQG1hdGNoLm10IiwicGFzc3dvcmQiOiIxMjM0In0.aY9xYlCmvDmIf_ZVI8j3m3--q-jX9zuKLyFNQZYcXCc
 
 EX: http://34.73.203.137/course/insert?param=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ0aXRsZSI6ImNpZW5jaWFzIiwiZGVzY3JpcHRpb24iOiJtYXRlcmlhIGRlIGNpZW5jaWFzIiwiZGF0ZXN0YXJ0IjoiMjAyMi0xMC0xMCIsImRhdGVlbmQiOiIyMDIyLTExLTEwIiwibHRva2VuIjoiZXlKMGVYQWlPaUpLVjFRaUxDSmhiR2NpT2lKSVV6STFOaUo5In0.S_RkSY7nyfu55WkcjQBL80EWYR4u8qzO5KBvx8fRnsE 
 
 
 Todas as respostas da api estão utilizando JWT: HS256 e a senha: @#4!#09$
 
 
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
 
 ## Adicionar Matricula
 
 URl: http://34.73.203.137/registration/insert
 
 
 Parametros: 
 
 "course": token do curso
 
 "student": token do aluno
 
 "ltoken": token de acesso a api
 
 
 Retorno:
 
{

  "msg": "Matricula cadastrada com sucesso",
  
  "status": "true"
  
}
 
 
 ## Obter Matricula
 
   URl: http://34.73.203.137/registration/get


 Parametros: 
 
 "token": token da matricula
 
 "ltoken": token de acesso a api
 
 
 Retorno:
 
{

  "registration": 
  {
  
    "regi_id": "23",
    
    "regi_stud_id": "5",
    
    "regi_cour_id": "7",
    
    "regi_user_id": "9",
    
    "regi_date": "2022-03-13",
    
    "regi_token": "c8d6b50f17bcc1d8985c715e3daddfe5",
    
    "user_id": "9",
    
    "user_name": "Admin",
    
    "user_mail": "admin@match.mt",
    
    "user_status": "1",
    
    "user_token": "FtTz3yJ9gdSDrT-J2EE3Mgt4ykVUKkRCiBLx9rg625E",
    
    "user_password": "81dc9bdb52d04dc20036dbd8313ed055",
    
    "user_token_access": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9",
    
    "stud_id": "5",
    
    "stud_name": "thiago",
    
    "stud_mail": "thiago bellandi",
    
    "stud_birthday": "1981-10-27",
    
    "stud_status": "1",
    
    "stud_token": "75c9920a9e28b3013da9447c4daba24d",
    
    "cour_id": "7",
    
    "cour_title": "matematica2222",
    
    "cour_description": "curso de matematica",
    
    "cour_date_start": "2022-12-10",
    
    "cour_date_end": "2022-12-30",
    
    "cour_token": "03b5e555807ae5e9b5176cc5e97767dd"
    
  },
  
  "msg": "",
  
  "status": "true"
  
}
    
    
  ## Listar Matriculas
  
   URl: http://34.73.203.137/registration/getall
 
 
 Parametros: 
 
 "ltoken": token de acesso a api
 
 
 Retorno:
 
{

  "registrations": [
  
    {
    
      "regi_id": "23",
      
      "regi_stud_id": "5",
      
      "regi_cour_id": "7",
      
      "regi_user_id": "9",
      
      "regi_date": "2022-03-13",
      
      "regi_token": "c8d6b50f17bcc1d8985c715e3daddfe5",
      
      "user_id": "9",
      
      "user_name": "Admin",
      
      "user_mail": "admin@match.mt",
      
      "user_status": "1",
      
      "user_token": "FtTz3yJ9gdSDrT-J2EE3Mgt4ykVUKkRCiBLx9rg625E",
      
      "user_password": "81dc9bdb52d04dc20036dbd8313ed055",
      
      "user_token_access": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9",
      
      "stud_id": "5",
      
      "stud_name": "thiago",
      
      "stud_mail": "thiago bellandi",
      
      "stud_birthday": "1981-10-27",
      
      "stud_status": "1",
      
      "stud_token": "75c9920a9e28b3013da9447c4daba24d",
      
      "cour_id": "7",
      
      "cour_title": "matematica2222",
      
      "cour_description": "curso de matematica",
      
      "cour_date_start": "2022-12-10",
      
      "cour_date_end": "2022-12-30",
      
      "cour_token": "03b5e555807ae5e9b5176cc5e97767dd"
      
      
    }
    
  ]
  
}


## Excluir Matricula
 
 URl: http://34.73.203.137/registration/delete
 
 
 Parametros: 
 
 "token": token da matricula
 
 "ltoken": token de acesso a api
 
 
 Retorno:
 
{

  "msg": "Matrícula excluida",
  
  "status": "true"
  
}
 
 
 
  ## Editar Matricula
  
 URl: http://34.73.203.137/registration/edit
 
 
 Parametros: 
 
 "course": token do curso
 
 "student": token do aluno
 
 "token": token da matricula
 
 "ltoken": token de acesso a api
 
 
 Retorno:
 
{

  "msg": "Matricula editada com sucesso",
  
  "status": "true"
  
}

