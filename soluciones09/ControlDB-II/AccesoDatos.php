<?php
include_once "Producto.php";
/*
 * Acceso a datos con BD y Patrón Singleton
 */
class AccesoDatos {
    
    private static $modelo = null;
    private $dbh = null;
    private $stmt = null;
    
    public static function initModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }
    
    // Creo un lista de alimentos, podría obtenerse de una base de datos
    private function __construct(){
        
        try {
            $dsn = "mysql:host=localhost;dbname=almacendb;charset=utf8";
            $this->dbh = new PDO($dsn, "root", "root");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
        // Construyo la consulta
        
        
    }
    
    // Devuelvo la lista de Productos 
    public function obtenerListaProductos ():array {
        $tobjproductos= [];
        // Todos los productos PRUEBA
        // $stmt = $this->dbh->prepare("select * from PRODUCTOS");
        // Todos los que no tienen pedidos
        $stmt = $this->dbh->prepare("select * from Productos where stock_disponible > 10 " );
        

        // Devuelvo una tabla de objetos 
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Producto');
        if ( $stmt->execute() ){
            $tobjproductos = $stmt->fetchAll();
        }
        return $tobjproductos;
    }
    /**
     * Rebaja el precio de los productos, haciendo un update de cada producto
     * @param mixed $lista - Lista código de producto
     * @return int - Número de productos modificados
     */
    public function actualizarPrecios($lista):int{
        $cont =0;
        $stmt = $this->dbh->prepare("UPDATE Productos SET precio_actual=precio_actual*0.9 where producto_no = ?");
        // Devuelvo una tabla de objetos
        foreach ($lista as $producto_no){
             $stmt->bindValue(1, $producto_no);
             if ( $stmt->execute() ){
                 $cont++;
             }
             }
        return $cont;
    }
    /**
     * Rebaja el precio de los productos, haciendo un único update
     * @param mixed $lista - Lista código de producto
     * @return int - Número de productos modificados
     */
    public function actualizarPrecios2($lista):int{
        $cont =0;
        $lista_productos = implode(",",$lista);
        $stmt = $this->dbh->prepare("UPDATE Productos SET precio_actual=precio_actual*0.9 where producto_no IN (".$lista_productos.")");
      if ( $stmt->execute() ){
            $cont = $stmt->rowCount();
       }
    
        return $cont;
    }


     // Evito que se pueda clonar el objeto.
    public function __clone()
    { 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }
}

