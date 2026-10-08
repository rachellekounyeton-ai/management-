<?php
$title = "Formulaire des étudiants";
require_once '../includes/header.php';
require_once '../config/database.php';

// Récupérer les classes
$stmt = $db_connect->prepare("SELECT * FROM classes");
$stmt->execute();
$classes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Traitement du formulaire
if (isset($_POST['inscription'])) {

    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $phone = htmlspecialchars($_POST['phone']);
    $birth_date = htmlspecialchars($_POST['birth_date']);
    $created_at = !empty($_POST['created_at']) ? $_POST['created_at'] : date('Y-m-d H:i:s');
    $gender = htmlspecialchars($_POST['gender']);
    $classe_id = (int) $_POST['classes_id'];

    $stmt = $db_connect->prepare("
        INSERT INTO students
        (classes_id, first_name, phone, birth_date, created_at, gender, last_name)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->execute([
        $classe_id,
        $first_name,
        $phone,
        $birth_date,
        $created_at,
        $gender,
        $last_name
    ]);

    echo '<div class="alert alert-success">Inscription réussie !</div>';
}
?>

<div class="main-content">

    <div class="container-fluid p-4">

        <div class="row">

            <div class="col-lg-8 offset-lg-2 mb-4">

                <div class="card shadow-sm">

                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">
                            <i class="bi bi-plus-circle me-2"></i>
                            Inscription
                        </h5>
                    </div>

                    <div class="card-body">

                        <form action="" method="POST">

                            <div class="mb-3">
                                <label class="form-label">Nom</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="first_name"
                                    value="<?= $_POST['first_name'] ?? '' ?>"
                                    placeholder="Nom"
                                    >
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Prénom</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="last_name"
                                    value="<?= $_POST['last_name'] ?? '' ?>"
                                    placeholder="Prénom"
                                    >
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Téléphone</label>
                                <input
                                    type="tel"
                                    class="form-control"
                                    name="phone"
                                    value="<?= $_POST['phone'] ?? '' ?>"
                                    placeholder="01 00 00 00 00"
                                    >
                            </div>

                            <div class="row">

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Date de naissance</label>
                                    <input
                                        type="date"
                                        class="form-control"
                                        name="birth_date"
                                        value="<?= $_POST['birth_date'] ?? '' ?>"
                                        >
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Sexe</label>

                                    <select class="form-control" name="gender" >
                                        <option value="F">Féminin</option>
                                        <option value="M">Masculin</option>
                                        <option value="Autre">Autre</option>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Date d'inscription</label>
                                    <input
                                        type="datetime-local"
                                        class="form-control"
                                        name="created_at"
                                        value="<?= $_POST['created_at'] ?? '' ?>">
                                </div>

                            </div>

                            <div class="mb-3">
                                <label class="form-label">Classe</label>

                                <select class="form-control" name="classes_id" >

                                    <?php foreach ($classes as $classe) : ?>

                                        <option value="<?= $classe['id']; ?>">
                                            <?= $classe['name']; ?>
                                        </option>

                                    <?php endforeach; ?>

                                </select>
                            </div>

                            <button
                                type="submit"
                                class="btn btn-success w-100"
                                name="inscription">

                                <i class="bi bi-send me-2"></i>
                                S'inscrire

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php require_once '../includes/footer.php'; ?>