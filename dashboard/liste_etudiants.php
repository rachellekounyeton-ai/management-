<?php  session_start();?>
<?php    
require_once '../config/database.php';
?>
<?php $title = "Liste des étudiants"; ?>

<?php require_once '../includes/header.php'; ?>
<!-- CONTENT -->
<?php

$stmt = $db_connect->prepare("
    SELECT students.*, classes.name AS classe
    FROM students
    LEFT JOIN classes ON students.classes_id = classes.id
");
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
          .btn-supprimer, .btn-modifier {
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 13px;
    text-decoration: none;
    color: white;
}
.btn-supprimer { background: #ef4444; }
.btn-modifier { background: #f59e0b; }
    </style>
<div class="main-content">

   
    <!-- PAGE CONTENT -->
    
    <div class="container-fluid p-4">


      

        <div class="row">



            <!-- TABLE -->
            <div class="col-lg-12">

                <div class="card shadow-sm">

                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">
                            <i class="bi bi-list-task me-2"></i>
                           Liste des étudiants
                        </h5>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-hover align-middle">

                                <thead>
                                    <tr>
                                        <th>Noms</th>
                                        <th>Prénoms</th>
                                        <th>Téléphones</th>
                                        <th>Date de naissance</th>
                                        <th>Sexes</th>
                                        <th>Classes</th>
                                        <th>Date d'inscription</th>
                                        <th>Actions</th>
                                
                                    </tr>
                                </thead>

                                <tbody>

<?php foreach ($students as $student) : ?>
<tr>
    <td><?= $student['first_name']; ?></td>
    <td><?= $student['last_name']; ?></td>
    <td><?= $student['phone']; ?></td>
    <td><?= $student['birth_date']; ?></td>
    <td><?= $student['gender']; ?></td>

    <!-- Afficher le nom de la classe -->
    <td><?= $student['classe']; ?></td>

    <td><?= $student['created_at']; ?></td>

    <td>
        <a href="../student/delete.php?delete=<?= $student['id'] ?>"
           class="btn-supprimer"
           onclick="return confirm('Supprimer cet étudiant ?')">
           Supprimer
        </a>

        <a href="../student/edit.php?edit=<?= $student['id'] ?>"
           class="btn-modifier">
           Modifier
        </a>
    </td>
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
<?php require_once '../includes/footer.php'; ?>