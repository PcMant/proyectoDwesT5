<?php require_once 'php/template/header.php'; //Importando cabecera?>

<div class="col-12 row justify-content-center">
            <h1>Consultar</h1>
            <form class="col-12 col-sm-12  col-lg-12 col-xl-3 row" action="consultar.php" >
                <div class="mb-3">
                    <label for="campo" class="form-label">Campo</label>
                    <select class="form-select" name="campo" aria-label="campo">
                        <option value="titulo">Título</option>
                        <option value="autor">Autor</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Criterio</label>
                    <input type="text" class="form-control" id="criterio" name="criterio" aria-describedby="criterio">
                </div>
                
                <div class="text-center"><button type="submit" class="btn btn-dark w-100">Consultar</button></div>
            </form>

            <?php if(!empty($_GET['campo']) && !empty($_SESSION['token']) && $clienteSOAP->call('Metodo.tokenCheck', array('token' => $_SESSION['token']))): ?>

                <hr class="my-3" />

                <table class="table table table-striped table-bordered">
                <tr class="text-center">
                    <th>Id</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Editorial</th>
                    <th>Edicion</th>
                    <th>isbn</th>
                </tr>


                <?php if(count($resultados) < 1): //En caso de 0 resultados muestro una fila vacia?>
                    <tr>
                        <td>ㅤ</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php endif; ?>

                <?php foreach ($resultados as $dato): //Listando datos?>
                    <tr>
                        <td><?=$dato['id']?></td>
                        <td><?=$dato['titulo']?></td>
                        <td><?=$dato['autor']?></td>
                        <td><?=$dato['editorial']?></td>
                        <td><?=$dato['edicion']?></td>
                        <td><?=$dato['isbn']?></td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <?php endif; ?>
        </div>

<?php require_once 'php/template/footer.php'; //Importando pie?>