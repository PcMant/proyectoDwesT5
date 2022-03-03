<?php
/**
 * Clase para mostrar aletas, las cuales usan clases de bootstrap
 * 
 * @Author Juan Molina
 */
class Alertas{

    /**
     * Alerta para errores que se monstrará al usuario
     *
     * @param string $mensaje
     * 
     * @return string
     * 
     */
    public function error($mensaje){
        return "
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Error!</strong> {$mensaje}
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
    }

    /**
     * Aleta para avisar al usuario
     *
     * @param string $mensaje
     * 
     * @return string
     * 
     */
    public function aviso($mensaje){
        return "
        <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Aviso!</strong> {$mensaje}
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
    }
}

?>