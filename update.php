<?php
require 'database.php';

$codigo = null;
if (!empty($_GET['codigo'])) {
    $codigo = $_REQUEST['codigo'];
}

if (null == $codigo) {
    header("Location: index.php");
}

if (!empty($_POST)) {
    // keep track validation errors
    $nombreError = null;
    $precioError = null;
    $cantidadError = null;

    // keep track post values
    //$codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];

    // validate input
    $valid = true;
    if (empty($nombre)) {
        $nombreError = 'Please enter nombre';
        $valid = false;
    }

    if (empty($precio)) {
        $precioError = 'Please enter precio';
        $valid = false;
        /* } else if ( !filter_var($precio,FILTER_VALIDATE_EMAIL) ) {
          $precioError = 'Please enter a valid Email Address';
          $valid = false; */
    }

    if (empty($cantidad)) {
        $cantidadError = 'Please enter cantidad';
        $valid = false;
    }

    // update data
    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE producto  set nombre = ?, precio = ?, cantidad =? WHERE codigo = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($nombre, $precio, $cantidad, $codigo));
        Database::disconnect();
        header("Location: index.php");
    }
} else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM producto where codigo = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($codigo));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $codigo = $data['codigo'];
    $nombre = $data['nombre'];
    $precio = $data['precio'];
    $cantidad = $data['cantidad'];
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
                    <h3>Update a producto</h3>
                </div>

                <form class="form-horizontal" action="update.php?codigo=<?php echo $codigo ?>" method="post">
                    <div class="control-group <?php echo!empty($nombreError) ? 'error' : ''; ?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input name="nombre" type="text"  placeholder="Nombre" value="<?php echo!empty($nombre) ? $nombre : ''; ?>">
                            <?php if (!empty($nombreError)): ?>
                                <span class="help-inline"><?php echo $nombreError; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="control-group <?php echo!empty($precioError) ? 'error' : ''; ?>">
                        <label class="control-label">Email Address</label>
                        <div class="controls">
                            <input name="precio" type="text" placeholder="Precio" value="<?php echo!empty($precio) ? $precio : ''; ?>">
                            <?php if (!empty($precioError)): ?>
                                <span class="help-inline"><?php echo $precioError; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="control-group <?php echo!empty($cantidadError) ? 'error' : ''; ?>">
                        <label class="control-label">Mobile Number</label>
                        <div class="controls">
                            <input name="cantidad" type="text"  placeholder="Cantidad" value="<?php echo!empty($cantidad) ? $cantidad : ''; ?>">
                            <?php if (!empty($cantidadError)): ?>
                                <span class="help-inline"><?php echo $cantidadError; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a class="btn" href="index.php">Back</a>
                    </div>
                </form>
            </div>

        </div> <!-- /container -->
    </body>
</html>