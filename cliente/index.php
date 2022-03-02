<?php require_once 'php/template/header.php'; //Importando cabecera?>

<div class="col-12 row justify-content-center">
    <div class="col-12 col-sm-12  col-lg-12 col-xl-3">
        <h1>Inicio de sesión</h1>
        <form method="get" action="index.php">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Usuario</label>
                <input type="name" class="form-control" id="usuario" name="usuario" aria-describedby="usuario">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" aria-describedby="password">
            </div>
            <button type="submit" class="btn btn-dark w-100">Iniciar sesión</button>
        </form>
    </div>
</div>

<?php require_once 'php/template/footer.php'; //Importando pie?>