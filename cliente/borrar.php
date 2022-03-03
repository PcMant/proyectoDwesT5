<?php require_once 'php/template/header.php'; //Importando cabecera?>

<div class="col-12 row justify-content-center">
            <h1>Borrar libro</h1>
            <form class="col-12 col-sm-12  col-lg-12 col-xl-3 row" action="borrar.php" >
                <div class="mb-3">
                    <label for="id" class="form-label">Id</label>
                    <input type="number" class="form-control" id="id" name="id" aria-describedby="id">
                </div>
                <div class="text-center"><button type="submit" class="btn btn-dark w-100">Borrar libro</button></div>
            </form>
        </div>

<?php require_once 'php/template/footer.php'; //Importando pie?>