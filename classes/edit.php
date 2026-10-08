<?php
require_once '../config/database.php';

$id = $_GET['edit'];

$stmt = $db_connect->prepare("SELECT * FROM classes WHERE  id=?");
$stmt->execute([$id]);
$classe = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['modifier'])) {

    $name = $_POST['name'];
    $description = $_POST['description'];
    $created_at = $_POST['created_at'];
   
    $stmt = $db_connect->prepare("
    UPDATE classes
    SET
        name=?,
        description=?,
        created_at=?
    WHERE id=?
");

    $stmt->execute([
        $name,
        $description,
        $created_at,
        $id
    ]);

    header('Location: index.php');
    exit();
}
 
?>
<?php
 require_once '../includes/header.php'; 
 ?>
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
<form action="" method="POST">
    <div class="main-content">



        <!-- PAGE CONTENT -->
        <div class="container-fluid p-4">

            <div class="row">

                <div class="col-lg-8 offset-lg-2 mb-4">

                    <div class="card shadow-sm">

                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0">
                                <i class="bi bi-pencil me-2"></i>
                                Modifier classe
                            </h5>
                        </div>

                        <div class="card-body">

                            <form method="POST">

                                <div class="mb-3">
                                    <label class="form-label">Nom</label>
                                    <input type="text" name="name" class="form-control"
                                        value="<?= $classe['name'] ?>">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <input type="text" name="description" class="form-control"
                                        value="<?= $classe['description'] ?>">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Date de modification</label>
                                    <input type="datetime-local" name="created_at" class="form-control"
                                        value="<?= $classe['created_at'] ?>">
                                </div>

                                <div class="row">

                              

                                <button type="submit" name="modifier" class="btn btn-success w-100">
                                    Mettre à jour
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>
</form>
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

<?php require_once '../includes/footer.php'; ?>