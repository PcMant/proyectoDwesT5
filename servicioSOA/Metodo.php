<?php

/**
 * Clase con los métodos utilizados por el servidor SOA
 * 
 * @author Juan Molina
 */
class Metodo
{
    protected $host_db = 'localhost';
    protected $port_db = 3306;
    protected $database = 'biblioteca';
    protected $user_db = 'root';
    protected $pass_db = '';

    public function __construct()
    {
    }

    protected function conexionDB(){
        return new PDO("mysql:host={$this->host_db};port={$this->port_db};dbname={$this->database};charset=utf8", $this->user_db, $this->pass_db);
    }

    /**
     * Método para obtener un token.
     *
     * @param string $user
     * @param string $pass
     * 
     * @return string
     * 
     */
    function login($user, $pass)
    {
        $token = 'test';
        $pass = sha1($pass);

        try {
            // Conexion
            //$loginCheck = new PDO("mysql:host={$this->host_db};port={$this->port_db};dbname={$this->database};charset=utf8", $this->user_db, $this->pass_db);
            $loginCheck = $this->conexionDB();

            //Consulta
            $sqlLoginCheck = 'SELECT `user`,`pass` FROM `usuarios` WHERE `user`=:usser AND `pass`=:pass';
            $sentenciaLoginCheck = $loginCheck->prepare($sqlLoginCheck);
            $sentenciaLoginCheck->bindParam(':usser', $user);
            $sentenciaLoginCheck->bindParam(':pass', $pass);
            $resultadoLoginCheck = $sentenciaLoginCheck->execute();
            $resultadoDatosLoginCheck = $sentenciaLoginCheck->fetchAll();

            // Se comprueba si se ejecuto bien la sentencia sql
            if ($resultadoLoginCheck) {
                // Comprobar si existen las credenciales coincidentes en la base de datos
                if ($user == $resultadoDatosLoginCheck[0]['user'] && $pass == $resultadoDatosLoginCheck[0]['pass']) {

                    // Generando token
                    $token = sha1(bin2hex(random_bytes((100 - (100 % 2)) / 2)) . $user . $pass . date("Y-m-d H:i:s"));

                    try {
                        //$sqlToken = new PDO("mysql:host={$this->host_db};port={$this->port_db};dbname={$this->database};charset=utf8", $this->user_db, $this->pass_db);
                        $sqlToken = $this->conexionDB();

                        // Consulta
                        $sqlTokenConsulta = 'UPDATE `usuarios` SET `token` = :token WHERE `user` = :usser AND `pass` = :pass';
                        $sqlTokenSentencia = $sqlToken->prepare($sqlTokenConsulta);
                        $sqlTokenSentencia->bindParam(':token', $token);
                        $sqlTokenSentencia->bindParam(':usser', $user);
                        $sqlTokenSentencia->bindParam(':pass', $pass);
                        $sqlTokenSentencia->execute();
                    } catch (PDOException $e) {
                        $token = "¡Error!: " . $e->getMessage() . "<br/>";
                        print $token;
                        die();
                    }
                }
            } else {
                $loginCheck = null;
                $token = '¡Error! El usuario o la contraseña son incorrectos';
                throw new Exception('¡Error! El usuario o la contraseña son incorrectos');
            }
        } catch (PDOException $e) {
            $token = "¡Error!: " . $e->getMessage() . "<br/>";
            print $token;
            die();
        }

        return $token;
    }

    /**
     * Método para comprobar si el token es valido
     *
     * @param string $token
     * 
     * @return boll
     * 
     */
    public function tokenCheck($token)
    {
        try {
            // Conexion
            //$tokenCheck = new  new PDO("mysql:host={$this->host_db};port={$this->port_db};dbname={$this->database};charset=utf8", $this->user_db, $this->pass_db);
            $tokenCheck = $this->conexionDB();

            //Consulta
            $sqlTokenCheck = 'SELECT `token` FROM `usuarios` WHERE `token`=:token';
            $sentenciaTokenCheck = $tokenCheck->prepare($sqlTokenCheck);
            $sentenciaTokenCheck->bindParam(':token', $token);
            $resultadoTokenCheck = $sentenciaTokenCheck->execute();
            $resultadoDatosTokenCheck = $sentenciaTokenCheck->fetchAll();
            
            // Se comprueba si se ejecuto bien la sentencia sql
            if ($resultadoTokenCheck) {

                // Comprobar si existe el token
                if (!empty($resultadoDatosTokenCheck[0]['token']) && $token == $resultadoDatosTokenCheck[0]['token']) {
                    $tokenCheck = null;
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
                throw new Exception('¡Error! Token erroneo o ausencia de este');
            }
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
            return false;
        }
    }

    
    /**
     * Inserta libros a la base de datos
     *
     * @param string $token
     * @param string $titulo
     * @param string $autor
     * @param string $editiorial
     * @param string $edicion
     * @param string $isbn
     * 
     * @return bool
     * 
     */
    public function insertarLibro($token, $titulo, $autor, $editorial=null, $edicion=null, $isbn=null){
        $status = false;

        if($this->tokenCheck($token)){
            try {
                // Conexion
                //$tokenCheck = new  new PDO("mysql:host={$this->host_db};port={$this->port_db};dbname={$this->database};charset=utf8", $this->user_db, $this->pass_db);
                $pdo = $this->conexionDB();
    
                //Consulta
                $sql = 'INSERT INTO `libros` (`titulo`,`autor`,`editorial`,`edicion`,`isbn`) VALUES (:titulo, :autor, :editorial, :edicion, :isbn)';
                $sentencia = $pdo->prepare($sql);
                $sentencia->bindParam(':titulo', $titulo);
                $sentencia->bindParam(':autor', $autor);
                $sentencia->bindParam(':editorial', $editorial);
                $sentencia->bindParam(':edicion', $edicion);
                $sentencia->bindParam(':isbn', $isbn);
                $resultados = $sentencia->execute();
                
                // Se comprueba si se ejecuto bien la sentencia sql
                if ($resultados) {
                    $status = true;
                } else {
                    $status = false;
                    throw new Exception('¡Error! Error en la consulta, verifica la tabla');
                }
            } catch (PDOException $e) {
                print "¡Error!: " . $e->getMessage() . "<br/>";
                $status = false;
                die();
            }
        }else{
            $status = false;
        }

        return $status;
    }

    /**
     * Consulta en la tabla libros por el criterio de titulo
     *
     * @param string $token
     * @param string $titulo
     * 
     * @return array
     * 
     */
    public function selectTitulo($token,$titulo=''){
        $resultados = [];

        if($this->tokenCheck($token)){
            try {
                // Conexion
                //$tokenCheck = new  new PDO("mysql:host={$this->host_db};port={$this->port_db};dbname={$this->database};charset=utf8", $this->user_db, $this->pass_db);
                $pdo = $this->conexionDB();
    
                //Consulta
                $sql = 'SELECT * FROM `libros` WHERE `titulo`=:titulo';
                $sentencia = $pdo->prepare($sql);
                $sentencia->bindParam(':titulo', $titulo);
                $resultados = $sentencia->execute();
                
                // Se comprueba si se ejecuto bien la sentencia sql
                if ($resultados) {
                    $resultados;
                } else {
                    $resultados = $resultados['id'] = 'Error! Verifique la tabla';
                    throw new Exception('¡Error! Error en la consulta, verifica la tabla');
                }
            } catch (PDOException $e) {
                print "¡Error!: " . $e->getMessage() . "<br/>";
                $resultados['id'] = 'Error! '.$e->getMessage();
                die();
            }
        }else{
            $resultados['id'] = 'Error! token invalido, inicie sesión de nuevo';
        }

        return $resultados;
    }

    /**
     * Consulta select en la tabla libros por el criterio de autor
     *
     * @param string $token
     * @param string $autor
     * 
     * @return array
     * 
     */
    public function selectAutor($token, $autor=''){
        $resultados = [];

        if($this->tokenCheck($token)){
            try {
                // Conexion
                //$tokenCheck = new  new PDO("mysql:host={$this->host_db};port={$this->port_db};dbname={$this->database};charset=utf8", $this->user_db, $this->pass_db);
                $pdo = $this->conexionDB();
    
                //Consulta
                $sql = 'SELECT * FROM `libros` WHERE `titulo`=:autor';
                $sentencia = $pdo->prepare($sql);
                $sentencia->bindParam(':autor', $autor);
                $resultados = $sentencia->execute();
                
                // Se comprueba si se ejecuto bien la sentencia sql
                if ($resultados) {
                    $resultados;
                } else {
                    $resultados = $resultados['id'] = 'Error! Verifique la tabla';
                    throw new Exception('¡Error! Error en la consulta, verifica la tabla');
                }
            } catch (PDOException $e) {
                print "¡Error!: " . $e->getMessage() . "<br/>";
                $resultados['id'] = 'Error! '.$e->getMessage();
                die();
            }
        }else{
            $resultados['id'] = 'Error! token invalido, inicie sesión de nuevo';
        }

        return $resultados;
    }

    /**
     * Actualización de los datos de un libro mediante el criterio de id
     *
     * @param string $token
     * @param string $id
     * @param string $titulo=null
     * @param string $autor=null
     * @param string $editiorial=null
     * @param string $edicion=null
     * @param string $isbn=null
     * 
     * @return bool
     * 
     */
    public function updateLibroById($token, $id, $titulo, $autor, $editorial=null, $edicion=null, $isbn=null){
        $status = false;

        if($this->tokenCheck($token)){
            try {
                // Conexion
                //$tokenCheck = new  new PDO("mysql:host={$this->host_db};port={$this->port_db};dbname={$this->database};charset=utf8", $this->user_db, $this->pass_db);
                $pdo = $this->conexionDB();
    
                //Consulta
                $sql = 'UPDATE `libros` SET `titulo`=:titulo, `autor`=:autor, `editorial`=:editorial, `edicion`=:edicion, `isbn`=:isbn WHERE `id`=:id';
                $sentencia = $pdo->prepare($sql);
                $sentencia->bindParam(':id', $id);
                $sentencia->bindParam(':titulo', $titulo);
                $sentencia->bindParam(':autor', $autor);
                $sentencia->bindParam(':editorial', $editorial);
                $sentencia->bindParam(':edicion', $edicion);
                $sentencia->bindParam(':isbn', $isbn);
                $resultados = $sentencia->execute();
                
                // Se comprueba si se ejecuto bien la sentencia sql
                if ($resultados) {
                    $status = true;
                } else {
                    $status = false;
                    throw new Exception('¡Error! Error en la consulta, verifica la tabla');
                }
            } catch (PDOException $e) {
                print "¡Error!: " . $e->getMessage() . "<br/>";
                $status = false;
                die();
            }
        }else{
            $status = false;
        }

        return $status;
    }
}
?>