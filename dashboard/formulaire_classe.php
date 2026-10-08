<?php $title = "Formulaire des etudiants"; ?>

<?php require_once '../config/database.php'; ?>
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />



<!-- CONTENT -->
<form action="" method="POST">
    <div class="main-content">

       

        <!-- PAGE CONTENT -->
        <div class="container-fluid p-4">

<?php
if (isset($_POST['creer'])) {

    
    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $created_at = $_POST['created_at']?? date('Y-m-d H:i:s') ;
    $stmt = $db_connect->prepare("INSERT INTO classes (name, description, created_at) VALUES ( ?, ?, ?)");
    $stmt->execute([$name, $description, $created_at]);
   echo '<div class="alert alert-success"> Votre à été Classe créer en succès !</div>';
  
}

?>

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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

<div class="main-content">

            <div class="row">

                <!-- FORMULAIRE -->
                <div class="col-lg-8 offset-lg-2 mb-4">

                    <div class="card shadow-sm">

                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0">
                                <i class="bi bi-plus-circle me-2"></i>
                             Creer une classe
                            </h5>
                        </div>

                        <div class="card-body">

                            <form>

                                <div class="mb-3">
                                    <label class="form-label">
                                        Nom 
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="name"
                                           value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>"     
                                        placeholder="">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">
                                      Description
                                    </label>
                                    <textarea
                                        type="text"
                                        name="description"
                                        class="form-control"
                                        value="<?= isset($_POST['description']) ? $_POST['description'] : '' ?>"        
                                        placeholder=""></textarea>
                                </div>

                                     <div class="col-md-4 mb-3">
                                        <label class="form-label">
                                           Date de creation
                                        </label>
                                        <input
                                            type="datetime-local"
                                               value="<?= isset($_POST['created_at']) ? $_POST['created_at'] : '' ?>"     
                                            name="created_date"
                                            class="form-control">
                                    </div>

                                </div>
                                <button
                                    type="submit"
                                    class="btn btn-success w-100"
                                    name="creer">

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
</form>
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

<script>
    const quill = new Quill('#editor', {
        theme: 'snow'
    });

    document.querySelector('form').addEventListener('submit', function(e) {
        // e.preventDefault();
        document.querySelector('#content').value = quill.root.innerHTML;
        // this.submit();
    });
</script>
<?php require_once '../includes/footer.php'; ?>