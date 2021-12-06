<?php

namespace App\Model\Admin;

use App\Core\Db\Database\Database;
use App\Model\View\Model;

/**
 * UserAdmin class responsável do usuario admin
 */
class UserAdmin extends Model{

    const SESSION_USER_ADMIN = 'User';
    /**
     * VERIFICA SE A SESSÃO EXISTE
     */
    public static function User()
    {
        // checa se a sessão existe ou se está vazia
        if($_SESSION[UserAdmin::SESSION_USER_ADMIN] === false
        ||
           empty($_SESSION[UserAdmin::SESSION_USER_ADMIN])
        || 
           !isset($_SESSION[UserAdmin::SESSION_USER_ADMIN])
        || 
         $_SESSION[UserAdmin::SESSION_USER_ADMIN]["admin"] !==  'Y'
        ){
            header("Location: /" . ROUTER_DEFAULT . "/login");exit;
        }

    }

    /**
     * Método responsável por verificar e criar sessão do administrador
     * @param string $login
     * @param string $password
     * @return void
     */
    public function loginAdmin($login, $password)
    {

       // PESQUISA NO BANCO DE DADOS O USUARIO
       $db = new DataBase();
       $userDb = $db->select("SELECT id,iduser,nome,email,senha,admin FROM db_admin_usuarios WHERE login = :login",
       [":login" => $login]);

       // VERIFICA SE O USUARIO EXISTE
       if(!isset($userDb[0]) || !count($userDb[0]) > 0){
            return ["false" => true, "messege" => "Usuario/Senha Invalida"]; 
       }
       
       // VERIFICA SE A SENHA COMBINA
       if(!password_verify($password, $userDb[0]["senha"])){
            return ["false" => true, "messege" => "Usuario/Senha Invalida"] ; 
       }

       // VERIFICA SE USUARIO TEM ACESSO AO ADMIN
       if($userDb[0]['admin'] === "Y"){
           $_SESSION[UserAdmin::SESSION_USER_ADMIN] = $userDb[0];
           return ["login" => true, "messege" => "Sucesso"];
       }


       // DESTROI AS VARIAVEIS DE ACESSO
       unset($userDb, $db);

       // E NÃO ENTROU EM NEM UM DESSES IF, RETORNA FALSO
       return ["login" => false, "messege" => "Login Invalido"];

    }
    
}