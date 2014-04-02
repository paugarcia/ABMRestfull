<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of UserModel
 *
 * @author alumnes
 */
class UserModel extends AbstractController {
    //put your code here
    //protected static $dsn = null;
    const dsn  = 'mysql:dbname=abmrestfull;host=localhost';
    const usuari = "root";
    const password = "";
    function __construct()
    {
        $this->conectar();
    }
    protected function conectar(){
        try {
            $this->__conn = new PDO(dsn, usuari, password);
        }
        catch(PDOException $e){
            echo 'Connection failed: '.$e->getMessage();
        }
        
    }
     private function usuarios() {  
     if ($_SERVER['REQUEST_METHOD'] != "GET") {  
         $Metodo = "Metodo erroneo, utilize METODO GET";
       $this->Respuesta($Metodo);  
     }  
     $query = $this->_conn->query("SELECT id, User, Password FROM Users");  
     $filas = $query->fetchAll(PDO::FETCH_ASSOC);  
     //num de usuaris a la taula
     $num = count($filas);  
     if ($num > 0) {  
       //$respuesta['estado'] = 'correcto';  
       $respuesta['usuarios'] = $filas;  
       $this->Respuesta($this->convertirJson($query));  
     }  
     $Error = "No existen usr";
     $this->Respuesta($Error);  
   }
    //public function Respuesta($data, $estado) {  
    public function Respuesta($data) {  
     echo $data;  
     exit;  
   }  
    protected function convertirJson($data) {  
     return json_encode($data);  
   } 
    
    
    
    

}

?>
