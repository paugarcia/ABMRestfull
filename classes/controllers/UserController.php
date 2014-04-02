<?php
require "userSPDO.php";
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserController
 *
 * @author alumnes
 */
class UserController extends AbstractController {
     protected $gdb = NULL;
     
     function __construct() {
         $this->gdb=userSPDO::singleton();
     }
    //Mostrem la informacio del usuaris 
    public function usuaris(){
            $sql="SELECT id, User, Password FROM Users";
            $query=$this->gdb->prepare($sql);
            $query->execute();
            $rows = $query->fetchAll();
            return $rows;
    }
    //Creem un usuari amb les dades que ens passen
    public function crearUsuari($request){
        $usr = $request->parameters['User'];        
        $password = $request->parameters['Password'];
        $sql="INSERT INTO Users(User, Password) VALUES ('".$usr."','".$password."')"; 
        $query=$this->gdb->prepare($sql);
        $query->execute();
        $rows = $query->fetchAll();
        if(!empty($rows))
        {
             $resposta = array('msg' => 'Error, User not created!');
            return $resposta;
        }
        else{
            $resposta = array('msg' => 'User Created!');
            return $resposta;
        }
    }
    //Fem un login amb una comprovacio de les dades que ens donen
    public function login($request){
        $usr = $request->parameters['User'];        
        $password = $request->parameters['Password'];
        $sql="SELECT * FROM Users WHERE User = '".$usr."' and Password = '".$password."';"; 
        $query=$this->gdb->prepare($sql);
        $query->execute();
        $rows = $query->fetchAll();
        if(empty($rows))
        {
             $resposta = array('msg' => 'Error, User not Login!');
            return $resposta;
        }
        else{
            $resposta = array('msg' => 'User Login!');
            return $resposta;
        }
    }
    //Editem-Actualitzem la taula de usuaris amb el id del usuari
    public function actualitzarNom($request){
        $usr = $request->parameters['User'];
        $id = $request->url_elements[1];
        $sql="UPDATE Users SET User = '".$usr."' WHERE id = '".$id."';"; 
        $query=$this->gdb->prepare($sql);
        $query->execute();
        $rows = $query->fetchAll();
        if(!empty($rows))
        {
            $resposta = array('msg' => 'USSER NOT CHANGED');
            return $resposta;
        }
        else{
            $resposta = array('msg' => 'User edit!');
            return $resposta;
        }
    }
    //Editem-Esborrem un usuari'fila'de la taula de la base de dades
    public function esborrarUsuari($request){
        $id = $request->url_elements[1];
        $sql="DELETE FROM Users WHERE id = '".$id."';"; 
        $query=$this->gdb->prepare($sql);
        $query->execute();
        $rows = $query->fetchAll();
        if(empty($rows))
        {
            $resposta = array('msg' => 'USER NOT DELETED');
            return $resposta;
        }
        else{
            $resposta = array('msg' => 'USER DELETED!');
            return $resposta;
        }
       
        
    }
}
?>
