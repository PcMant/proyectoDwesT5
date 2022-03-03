<?php require_once 'php/template/header.php'; //Importando cabecera?>
<?php
// Conexión con el API mediastack y optención de los datos devueltos
$url = 'http://api.mediastack.com/v1/news?access_key=34d1abb2ef45eb0ad98225ec5ffc9c55&languajes=es&keywords=libro&limit=20';

$file = file_get_contents($url);
$datos = json_decode($file, true);

?>
<h1>Noticias</h1>
<articles>
<?php forEach($datos['data'] as $value): ?>
    <article>
        <h3><a href="<?=$value['url']?>" target="_blank" rel="nofollow"><?=$value['title']?></a></h3>
        <p><?=$value['description']?></p>
    <article>
    <hr/>
<?php endforeach; ?>
</articles>

<?php require_once 'php/template/footer.php'; //Importando pie?>