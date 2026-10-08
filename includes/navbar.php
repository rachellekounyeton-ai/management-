    <?php  

    require_once '../config/app.php';
   

    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= APP_NAME; ?> - <?=   isset($title) ? $title : ''; ?> </title>

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
                margin-left:var(--sidebar-width);
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
    </head>
    <body>

    <div class="overlay" id="overlay"></div>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">

        <div class="logo">
            <i class="bi bi-megaphone-fill me-2"></i>
            <?= APP_NAME; ?>
        </div>

        <div class="menu">

            <a href="dashboard.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">
                <i class="bi bi-speedometer2"></i>
                Tableau de bord
            </a>

            <a href="../dashboard/formulaire_etudiant.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'formulaire_etudiant.php' ? 'active' : ''; ?>">
                <i class="bi bi-bullseye"></i>
            Formulaire des étudiants
            </a>

             <a href="../dashboard/formulaire_classe.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'formulaire_classe.php' ? 'active' : ''; ?>">
                <i class="bi bi-bullseye"></i>
          Formulaire des classes
            </a>

            <a href="../dashboard/liste_classe.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'liste_classe.php' ? 'active' : ''; ?>">
               <i class="bi bi-list-task me-2"></i>
          Liste des clasees
            </a>

            <a href="../dashboard/liste_etudiants.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'liste_etudiants.php' ? 'active' : ''; ?>">
              <i class="bi bi-list-task me-2"></i>
          liste de étudiants
            </a>
            <a href="../auth/login.php">
                <i class="bi bi-box-arrow-right"></i>
                Se déconnecter
            </a>
            

        </div>

    </aside>