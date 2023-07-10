<?php require_once HEADER;
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['name']) && isset($_SESSION['role'])) {
    header("Location:index.php"); 
}
?>
<div class="container">
    <div class="mx-auto card border-primary " style="max-width: 38rem;">
        <div class="card-header">Registrarse</div>
        <div class="card-body text-dark">
            <form action="index.php?c=auth&f=createUser" onSubmit=" return validar()" method="post">
                <div class="row">
                    <div class="col-sm-12 row">
                        <label for="username row" class="col-form-label">Nombre de usuario:</label>
                        <div>
                            <input type="text" class="form-control" id="username" name="username"
                                   onchange="showOrDissmissAlert(this, false)">
                        </div>
                        <small class="alert-danger invisible w-75  ms-2 mt-2">rol invalido</small>
                    </div>
                    <div class=" col-sm-6 row">
                        <label for="firstname" class="col-form-label">Nombre:</label>
                        <div>
                            <input type="text" class="form-control" id="firstname" name="firstname"
                                   onchange="showOrDissmissAlert(this, false)">
                        </div>
                        <small class="alert-danger invisible w-75  ms-2 mt-2">Nombre no es valido</small>
                    </div>
                    <div class="col-sm-6 row">
                        <label for="lastname" class="col-form-label">Apellido:</label>
                        <div>
                            <input type="text" class="form-control" id="lastname" name="lastname"
                                   onchange="showOrDissmissAlert(this, false)">
                        </div>
                        <small class="alert-danger invisible w-75  ms-2 mt-2">Apellido no es valido</small>
                    </div>
                    <div class="col-sm-12 row">
                        <label for="email" class=" col-form-label">Correo:</label>
                        <div>
                            <input type="text" class="form-control" id="email" name="email"
                                   onchange="showOrDissmissAlert(this, false)">
                        </div>
                        <small class="alert-danger invisible w-75  ms-2 mt-2">El correo es invalido</small>
                    </div>
                    <div class="col-sm-6 row">
                        <label for="password" class=" col-form-label">Contraseña</label>
                        <div>
                            <input type="password" class="form-control password" id="password" name="password"
                                   onchange="showOrDissmissAlert(this, false)">
                        </div>
                        <small class="alert-danger invisible w-75  ms-2 mt-2">Contraseña es invalido</small>
                    </div>
                    <div class="col-sm-6 row">
                        <label for="confirmpassword" class=" col-form-label">Confirmar Contraseña</label>
                        <div>
                            <input type="password" class="form-control password" id="confirmpassword" name="confirmpassword"
                                   onchange="showOrDissmissAlert(this, false)">
                        </div>
                        <small class="alert-danger invisible w-75  ms-2 mt-2">las contraseñas son diferentes</small>
                    </div>
                
                    <div class="mb-3 row">
                        <div class="form-check ms-3">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">Mostrar contraseña</label>
                        </div>
                    </div>
                </div><br>
                <div class="form-group col-sm-6">
                    <label for="valor">Escoja su rol</label>

                    <select id="disp" name="disp" required>
                        <option value="">seleccione</option>
                        <option value="2">Usuario</option>
                        <option value="3">Veterinario</option>
                    </select><br>
                </div>
                <div class="mb-3 row">
                    <div class="col-sm-6">

                        <button class="btn btn-outline-success w-75" type="submit">Crear Usuario</button>
                    </div>
                    <div class="col-sm-6">
                        <a class="btn btn-outline-primary w-75" href="index.php">Volver al Inicio</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    const $ = (element) => document.querySelector(element);
    const $$ = (element) => document.querySelectorAll(element);

    function validar() {
        let valido = true;
        const $username = $("#username");
        const $firstname = $("#firstname");
        const $lastname = $("#lastname");
        const $email = $("#email");
        const $password = $("#password");
        const $confirmPassword = $("#confirmpassword");

        //validacion del correo

        if (!validarText($username)) {
            valido = false;
        }
        if (!validarText($firstname)) {
            valido = false;
        }
        if (!validarText($lastname)) {
            valido = false;
        }
        if (!validarText($password)) {
            valido = false;
        }
        if (!validarText($confirmPassword)) {
            valido = false;
        }
        if (!validarEmail($email.value)) {
            showOrDissmissAlert($email, true);
            valido = false;
        } else {
            showOrDissmissAlert($email, false);
        }
        if ($password.value !== $confirmPassword.value) {
            showOrDissmissAlert($confirmPassword, true);
            valido = false;
        }

        return valido;
    }

    function validarEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }


    const validarText = (element) => {
        if (element.value === "" || element.value === null) {
            showOrDissmissAlert(element, true);
            return false;
        }
        showOrDissmissAlert(element, false);
        return true;

    }

    const $checkbox = $("#flexCheckDefault");
    const $passwords = $$(".password");
    $checkbox.addEventListener("change", () => {
        $passwords.forEach($password => {
            $password.type = $checkbox.checked ? "text" : "password";
        })
    });


    const showOrDissmissAlert = (element, show) => {
        element.style.border = show ? "1px solid red" : "1px solid #ccc";
        const textsReplace = show ? ["invisible", "alert"] : ["alert", "invisible"];
        const parentNode = element.parentNode;
        const $small = parentNode.nextElementSibling || parentNode.nextSibling;
        $small.className = $small.className.replaceAll(textsReplace[0], textsReplace[1]);
    };
</script>
