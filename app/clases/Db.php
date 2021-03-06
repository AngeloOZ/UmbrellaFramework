<?php
class Db
{
    private $link;
    private $engine;
    private $host;
    private $name;
    private $user;
    private $pass;
    private $charset;

    /*
    * Constructor para nuestra clase
    */
    public function __construct()
    {
        $this->engine  = IS_LOCAL ? LDB_ENGINE : DB_ENGINE;
        $this->name    = IS_LOCAL ? LDB_NAME : DB_NAME;
        $this->user    = IS_LOCAL ? LDB_USER : DB_USER;
        $this->pass    = IS_LOCAL ? LDB_PASS : DB_PASS;
        $this->charset = IS_LOCAL ? LDB_CHARSET : DB_CHARSET;
    }

    /* 
    * Método para abrir una conexión a la base de datos 
    */
    private function connect()
    {
        try {
            $this->link = new PDO($this->engine . ':host=' . $this->host . ';dbname=' . $this->name . ';charset=' . $this->charset, $this->user, $this->pass);
            return $this->link;
        } catch (PDOException $e) {
            die(sprintf('No  hay conexión a la base de datos, hubo un error: %s', $e->getMessage()));
        }
    }

    /*
    * Metodo que devuelve la conexión para pripias conexiones
    */
    public static function getConection()
    {
        $self = new self();
        return $self->connect();
    }

    /*
    * Metodo para Buscar un valor en un campo especifico
    */
    public static function unique($tabla, $campo, $dato){
        $stmt = Db::getConection()->prepare("SELECT * FROM $tabla WHERE $campo = :$campo");
        $stmt->bindParam(":$campo", $dato);
        if($stmt->execute()){
            return $stmt->rowCount() > 0 ? $stmt : null;
        }else{
            return $stmt->errorInfo();
        }
    }

    /*
    * Método para hacer un query a la base de datos
    */
    public static function query($sql, $params = [])
    {
        $db = new self();
        $link = $db->connect();
        $link->beginTransaction();
        $query = $link->prepare($sql);

        if (!$query->execute($params)) {

            $link->rollBack();
            $error = $query->errorInfo();
            throw new Exception($error[2]);
        }

        // SELECT | INSERT | UPDATE | DELETE 
        if (strpos($sql, 'SELECT') !== false) {

            return $query->rowCount() > 0 ? $query->fetchAll(PDO::FETCH_ASSOC) : false;

        } elseif (strpos($sql, 'INSERT') !== false) {

            $id = $link->lastInsertId();
            $link->commit();
            return $id;

        } elseif (strpos($sql, 'UPDATE') !== false) {

            $link->commit();
            return true;

        } elseif (strpos($sql, 'DELETE') !== false) {

            if ($query->rowCount() > 0) {
                $link->commit();
                return true;
            }

            $link->rollBack();
            return false;

        } else {
            // ALTER TABLE | DROP TABLE 
            $link->commit();
            return true;
        }
    }
}
