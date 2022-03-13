<?php

	//
    namespace App\Controller;
    
    //
    use App\files\DatabaseMysql;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    use PDO;

    //
    require_once "baseini.php";

    //
    class AuthController extends BaseIni
    {
        public function AuthController()
        {
            parent::BaseIni();
        }

        /**
		 * @Route("/")
         */
        public function login()
        {
            //
            $this->AuthController();

            $c = new DatabaseMysql();
            $result = $c->getQuery();
            $params= array();
            $cont = 0;
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $cont++;
                $params[$cont]['id'] = $row['id'];
                $params[$cont]['name'] = $row['name'];
                $params[$cont]['mail'] = $row['mail'];
            }

            //get jwt
            $token = $this->_jwt->encodeJwt($params);


            return new Response($token);
        }
    }
?>