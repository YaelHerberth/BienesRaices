<?php
// Conexion a la base de datos
require 'includes/app.php';
$db = conectarDB();

//Autenticar el formulario

$errores = [];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // var_dump($_POST);

    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) );
    $password = mysqli_real_escape_string($db, $_POST['password'] );

    if(!$email){
        $errores[] = 'El email es obligatorio o no es valido';
    }

    if(!$password){
        $errores[] = 'El password es obligatorio';
    }

    if(empty($errores)){
        //Revisar si el usuario existe

        $query = "SELECT * FROM usuarios WHERE email = '{$email}'";
        $resultado = mysqli_query($db,$query);
        
        if($resultado->num_rows){
            // Revisar la contraseña
            $usuario = mysqli_fetch_assoc($resultado);
            //Verificar si el password es correcto o no
            $auth = password_verify($password,$usuario['password']);
            var_dump($auth);
            if($auth){
                //El usuario esta autenticado
                session_start();
                //Llenar el arreglo de la sesion
                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['login'] = true;
                header('Location: admin/index.php');
            }else{
                $errores[] = 'El password es incorrecto';
            }
        }else{
            $errores[] = 'El usuario no existe';
        }
    }
}

//Incluye el header
incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesion</h1>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?= $error ?>
        </div>
    <?php endforeach ?>

    <form class="formulario" method="POST" action="">
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">E-Mail:</label>
            <input type="email" name="email" placeholder="Tu Correo Electrónico" id="email">

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Tu Password" id="password">

        </fieldset>
        <input type="submit" value="Iniciar Sesion" class="boton boton-verde">
    </form>
</main>

<?php
incluirTemplate('footer');
?>