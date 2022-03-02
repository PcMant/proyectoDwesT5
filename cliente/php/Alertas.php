<?php
class Alertas{

    public function error($mensaje){
        return "
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Error!</strong> {$mensaje}
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
    }

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