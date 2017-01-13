<?php
require 'database.php';

if (!empty($_POST)) {
    // keep track validation errors
    $nombreError = null;
    $precioError = null;
    $cantidadError = null;

    // keep track post values
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];

    // validate input
    $valid = true;
    if (empty($nombre)) {
        $nombreError = 'Please enter Name';
        $valid = false;
    }

    if (empty($precio)) {
        $precioError = 'Please enter precio';
        $valid = false;
        /* } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
          $emailError = 'Please enter a valid Email Address';
          $valid = false;
          } */
    }
        if (empty($cantidad)) {
            $cantidadError = 'Please enter cantidad';
            $valid = false;
        }

        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO producto (codigo,nombre,precio,cantidad) values(?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($codigo, $nombre, $precio, $cantidad));
            Database::disconnect();
            header("Location: index.php");
        }
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
                        <h3>Crear un producto</h3>
                    </div>

                    <form class="form-horizontal" action="create.php" method="post">
                        <div class="control-group">
                            <label class="control-label">Codigo</label>
                            <div class="controls">
                                <input name="codigo" type="text"  placeholder="Codigo" value="<?php echo!empty($codigo) ? $codigo : ''; ?>">
                            </div>
                        </div>	  
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
                            <label class="control-label">Precio</label>
                            <div class="controls">
                                <input name="precio" type="text" placeholder="Precio" value="<?php echo!empty($precio) ? $precio : ''; ?>">
                                <?php if (!empty($precioError)): ?>
                                    <span class="help-inline"><?php echo $precioError; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="control-group <?php echo!empty($cantidadError) ? 'error' : ''; ?>">
                            <label class="control-label">Cantidad</label>
                            <div class="controls">
                                <input name="cantidad" type="text"  placeholder="Cantidad" value="<?php echo!empty($cantidad) ? $cantidad : ''; ?>">
                                <?php if (!empty($cantidadError)): ?>
                                    <span class="help-inline"><?php echo $cantidadError; ?></span>
                                <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success">Create</button>
                        <a class="btn" href="index.php">Back</a>
                    </div>
                </form>
            </div>

        </div> <!-- /container -->
    </body>
    </html>
    