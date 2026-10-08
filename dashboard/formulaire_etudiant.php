<?php
$title = "Formulaire des étudiants";
require_once '../config/database.php';



// Récupérer les classes
$stmt = $db_connect->prepare("SELECT * FROM classes");
$stmt->execute();
$classes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Traitement du formulaire
if (isset($_POST['inscription'])) {

    $first_name  = htmlspecialchars($_POST['first_name'] ?? '');
    $last_name   = htmlspecialchars($_POST['last_name'] ?? '');
    $phone       = htmlspecialchars($_POST['phone'] ?? '');
    $birth_date  = htmlspecialchars($_POST['birth_date'] ?? '');
    $created_at  = !empty($_POST['created_at']) ? $_POST['created_at'] : date('Y-m-d H:i:s');
    $gender      = htmlspecialchars($_POST['gender'] ?? '');
    $classe_id   = (int) ($_POST['classes_id'] ?? 0);

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
<!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
            
        <style>
            :root{
                --sidebar-width:280px;
                --primary:#0d6efd;
            }

            body{
                background:#f5f7fb;
                overflow-x:hidden;
            }

            .sidebar{
                position:fixed;
                top:0;
                left:0;
                width:var(--sidebar-width);
                height:100vh;
                background:#0d6efd;
                color:white;
                z-index:1040;
                transition:.3s;
            }

            .sidebar .logo{
                padding:25px;
                font-size:1.3rem;
                font-weight:700;
                border-bottom:1px solid rgba(255,255,255,.1);
            }

            .sidebar .menu{
                padding:15px;
            }

            .sidebar .menu a{
                display:flex;
                align-items:center;
                gap:12px;
                color:white;
                text-decoration:none;
                padding:14px 15px;
                border-radius:10px;
                margin-bottom:8px;
                transition:.3s;
            }

            .sidebar .menu a:hover,
            .sidebar .menu a.active{
                background:rgba(255,255,255,.1);
            }

            .main-content{
               
                transition:.3s;
            }

            .top-navbar{
                background:white;
                box-shadow:0 2px 15px rgba(0,0,0,.05);
            }

            .stat-card{
                border:none;
                border-radius:15px;
                box-shadow:0 2px 10px rgba(0,0,0,.05);
                transition:.3s;
            }

            .stat-card:hover{
                transform:translateY(-3px);
            }

            .stat-icon{
                width:55px;
                height:55px;
                border-radius:12px;
                display:flex;
                align-items:center;
                justify-content:center;
                font-size:1.4rem;
                background:rgba(13,110,253,.1);
                color:var(--primary);
            }

            .card{
                border:none;
                border-radius:15px;
            }

            .overlay{
                position:fixed;
                inset:0;
                background:rgba(0,0,0,.4);
                z-index:1030;
                display:none;
            }

            @media(max-width:992px){

                .sidebar{
                    left:-280px;
                }

                .sidebar.show{
                    left:0;
                }

                .main-content{
                    margin-left:0;
                }

                .overlay.show{
                    display:block;
                }
            }
        </style>
<div class="main-content">
 

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

                            <!-- NOM -->
                            <div class="mb-3">
                                <label class="form-label">Nom</label>
                                <input type="text"
                                       class="form-control"
                                       name="first_name"
                                       value="<?= htmlspecialchars($_POST['first_name'] ?? '') ?>"
                                       placeholder="Nom">
                            </div>

                            <!-- PRENOM -->
                            <div class="mb-3">
                                <label class="form-label">Prénom</label>
                                <input type="text"
                                       class="form-control"
                                       name="last_name"
                                       value="<?= htmlspecialchars($_POST['last_name'] ?? '') ?>"
                                       placeholder="Prénom">
                            </div>

                            <!-- TELEPHONE -->
                            <div class="mb-3">
                                <label class="form-label">Téléphone</label>
                                <input type="tel"
                                       class="form-control"
                                       name="phone"
                                       value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>"
                                       placeholder="01 00 00 00 00">
                            </div>

                            <div class="row">

                                <!-- DATE NAISSANCE -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Date de naissance</label>
                                    <input type="date"
                                           class="form-control"
                                           name="birth_date"
                                           value="<?= htmlspecialchars($_POST['birth_date'] ?? '') ?>">
                                </div>

                                <!-- SEXE -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Sexe</label>
                                    <select class="form-control" name="gender">
                                        <option value="F" <?= (($_POST['gender'] ?? '') == 'F') ? 'selected' : '' ?>>Féminin</option>
                                        <option value="M" <?= (($_POST['gender'] ?? '') == 'M') ? 'selected' : '' ?>>Masculin</option>
                                        <option value="Autre" <?= (($_POST['gender'] ?? '') == 'Autre') ? 'selected' : '' ?>>Autre</option>
                                    </select>
                                </div>

                                <!-- DATE INSCRIPTION -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Date d'inscription</label>
                                    <input type="datetime-local"
                                           class="form-control"
                                           name="created_at"
                                           value="<?= htmlspecialchars($_POST['created_at'] ?? '') ?>">
                                </div>

                            </div>

                            <!-- CLASSE -->
                            <div class="mb-3">
                                <label class="form-label">Classe</label>

                                <select class="form-control" name="classes_id">

                                    <?php foreach ($classes as $classe) : ?>
                                        <option value="<?= $classe['id']; ?>"
                                            <?= (($_POST['classes_id'] ?? '') == $classe['id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($classe['name']); ?>
                                        </option>
                                    <?php endforeach; ?>

                                </select>
                            </div>

                            <!-- BUTTON -->
                            <button type="submit"
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