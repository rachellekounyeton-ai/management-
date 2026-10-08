<?php
$title = "Tableau de bord";
require_once '../config/database.php';
?>

<div class="main-content">
 <?php require_once '../includes/navbar.php'; ?>
   

    <?php

    // Total étudiants
    $stmt2 = $db_connect->prepare("SELECT COUNT(*) AS total FROM students");
    $stmt2->execute();
    $total_students = $stmt2->fetch(PDO::FETCH_ASSOC);

    // Total classes
    $stmt3 = $db_connect->prepare("SELECT COUNT(*) AS total FROM classes");
    $stmt3->execute();
    $total_classes = $stmt3->fetch(PDO::FETCH_ASSOC);

    // Les 2 derniers étudiants ajoutés avec le nom de la classe
    $stmt4 = $db_connect->prepare("  SELECT students.*, classes.name AS classe FROM students  LEFT JOIN classes ON students.classes_id = classes.id ORDER BY students.created_at DESC  LIMIT 2");
      
    $stmt4->execute();
    $derniers_etudiants = $stmt4->fetchAll(PDO::FETCH_ASSOC);

    ?>

    <nav class="navbar navbar-expand-lg top-navbar px-3 py-3">

        <button class="btn btn-dark d-lg-none" id="menuBtn">
            <i class="bi bi-list"></i>
        </button>

        <h5 class="ms-3 mb-0">
            <?= isset($title) ? $title : 'Tableau de bord' ?>
        </h5>

    </nav>

    <div class="container-fluid p-4">

        <!-- STATS -->
        <div class="row g-4 mb-4">

            <div class="col-md-6">
                <div class="card stat-card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">Total étudiant</small>
                            <h3><?= $total_students['total']; ?></h3>
                        </div>
                        <div class="stat-icon">
                            <i class="bi bi-people-fill"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card stat-card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">Total classe</small>
                            <h3><?= $total_classes['total']; ?></h3>
                        </div>
                        <div class="stat-icon">
                            <i class="bi bi-building"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- TABLE -->
        <div class="row">

            <div class="col-lg-12">

                <div class="card shadow-sm">

                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">
                            <i class="bi bi-list-task me-2"></i>
                            Derniers étudiants ajoutés
                        </h5>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-hover align-middle">

                                <thead>
                                    <tr>
                                        <th>Noms</th>
                                        <th>Prénoms</th>
                                        <th>Téléphone</th>
                                        <th>Date de naissance</th>
                                        <th>Sexes</th>
                                        <th>Classes</th>
                                        <th>Date d'inscription</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php foreach ($derniers_etudiants as $etudiant) : ?>

                                        <tr>
                                            <td><?= $etudiant['first_name']; ?></td>
                                            <td><?= $etudiant['last_name']; ?></td>
                                            <td><?= $etudiant['phone']; ?></td>
                                            <td><?= $etudiant['birth_date']; ?></td>
                                            <td><?= $etudiant['gender']; ?></td>
                                            <td><?= $etudiant['classe']; ?></td>
                                            <td><?= $etudiant['created_at']; ?></td>
                                        </tr>

                                    <?php endforeach; ?>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('overlay');
const menuBtn = document.getElementById('menuBtn');

menuBtn.addEventListener('click', () => {
    sidebar.classList.toggle('show');
    overlay.classList.toggle('show');
});

overlay.addEventListener('click', () => {
    sidebar.classList.remove('show');
    overlay.classList.remove('show');
});
</script>

</body>
</html>