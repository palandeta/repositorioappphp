<?php
require 'database.php';
$codigo = null;
if (!empty($_GET['codigo'])) {
    $codigo = $_REQUEST['codigo'];
}

if (null == $codigo) {
    header("Location: index.php");
} else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM producto where codigo = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($codigo));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link   href="css/bootstrap.min.css" rel="stylesheet">
        <script src="js/bootstrap.min.js"></script>
    </head>

    <body>
        <div class="container">

            <div class="span10 offset1">
                <div class="row">
                    <h3>Read a producto</h3>
                </div>

                <div class="form-horizontal" >
                    <div class="control-group">
                        <label class="control-label">Codigo</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['codigo']; ?>
                            </label>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Nombre</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['nombre']; ?>
                            </label>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Precio</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['precio']; ?>
                            </label>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Cantidad</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['cantidad']; ?>
                            </label>
                        </div>
                    </div>
                    <div class="form-actions">
                        <a class="btn" href="index.php">Back</a>
                    </div>

                </div>
            </div>

        </div> <!-- /container -->
    </body>
</html>