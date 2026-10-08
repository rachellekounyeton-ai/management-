<?php require_once('../config/database.php'); ?>

<?php session_start(); ?>
<?php $title = 'Login'; ?>

<!doctype html>
<html lang="fr" data-bs-theme="light">

<head>
    <title><?= isset($title) ? $title : ""; ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS v5.3.8 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="../assets/css.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">



</head>

<body class="text-center">
    <main class="form-signin">
        <style>
            #iconpassword {
                position: absolute;
                top: 20px;
                right: 20px;
                cursor: pointer;
            }
        </style>

        <?php
        $email_error = '';
        $password_error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sign'])) {



            $email = htmlspecialchars(trim($_POST['email']));
            $mot_de_passe = $_POST['password'];

            if (strlen($email) < 2 || strlen($email) > 100) {
                $email_error = 'L\'email doit comporter entre 2 et 100 caractères.<br>';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_error = 'L\'email n\'est pas valide.<br>';
            } elseif (strlen($mot_de_passe) < 4) {
                $password_error = 'Le mot de passe doit comporter au moins 6 caractères.<br>';
            } else {


                $stmt = $db_connect->prepare("SELECT * FROM admins WHERE email = :email");
                $stmt->execute(['email' => $email]);

                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user && password_verify($mot_de_passe, $user['password'])) {

                    $_SESSION['admins_id'] = $user['id'];
                    $_SESSION['email'] = $user['email'];

                    header('Location: ../dashboard/dashboard.php');
                    exit;
                } else {
                    $email_error = 'Email ou mot de passe incorrect.';
                }
            }
        }

        ?>
        <form method="POST" action="">
            <a href="../pages/accueil.php">
                <img
                    class="mb-4 rounded-circle"
                    src="../assets/black-graduation-cap-golden-tassel-600w-2760512981.webp"
                    alt="Logo"
                    width="70"
                    height="70">
            </a>
            <h1 class="h3 mb-3 fw-normal">Veuillez vous connecter</h1>

            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
                <label for="floatingInput">Adresse email</label>
            </div>
            <?php if ($email_error): ?>
                <div class="text-danger">
                    <?= $email_error; ?>
                </div>
            <?php endif; ?>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                <label for="floatingPassword">Mot de passe</label>
                <i class="bi bi-eye-slash" id="iconpassword"></i>
            </div>
            <?php if ($password_error): ?>
                <div class="text-danger">
                    <?= $password_error; ?>
                </div>
            <?php endif; ?>

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Se rappeler de moi
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-success" type="submit" name="sign">Se connecter</button>

        </form>
    </main>


    <script src="../assets/js.js"></script>





</body>