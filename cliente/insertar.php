<?php require_once 'php/template/header.php'; //Importando cabecera?>

<div class="col-12 row justify-content-center">
            <h1>Añadir libro</h1>
            <form class="col-12 col-sm-12  col-lg-12 col-xl-3 row" action="insertar.php" >
                <div class="mb-3">
                    <label for="nombre" class="form-label">Título*</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" required="required" aria-describedby="titulo">
                </div>
                <div class="mb-3">
                    <label for="autor" class="form-label">Autor</label>
                    <input type="text" class="form-control" id="autor" name="autor" aria-describedby="autor">
                </div>
                <div class="mb-3">
                    <label for="editorial" class="form-label">Editorial</label>
                    <input type="text" class="form-control" id="editorial" name="editorial" aria-describedby="editorial">
                </div>
                <div class="mb-3">
                    <label for="edicion" class="form-label">Edición</label>
                    <input type="text" class="form-control" id="edicion" name="edicion" aria-describedby="edicion">
                </div>
                <div class="mb-3">
                    <label for="isbn" class="form-label">isbn</label>
                    <input type="number" class="form-control" id="isbn" name="isbn" aria-describedby="isbn">
                </div>
                
                <p style="font-size: 13px; letter-spacing: -1px"><strong >Los datos marcados con * son obligatorios.</strong></p>
                <div class="text-center"><button type="submit" class="btn btn-dark w-100">Añadir libro</button></div>
            </form>
        </div>

<?php require_once 'php/template/footer.php'; //Importando pie?>