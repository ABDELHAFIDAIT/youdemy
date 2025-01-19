<?php

    session_start();

    require_once "../../classes/teacher.php";
    require_once "../../classes/category.php";
    require_once "../../classes/course.php";



    $enseignant = new Teacher((int)$_SESSION['id_user'],$_SESSION['nom'],$_SESSION['prenom'],'',$_SESSION['email'],'',$_SESSION['role'],$_SESSION['status'],$_SESSION['photo']);


    if ($_SESSION['role'] !== 'Enseignant') {
        if ($_SESSION['role'] === 'Admin') {
            header("Location: ../admin/dashboard.php");
        } else if ($_SESSION['role'] === 'Etudiant') {
            header("Location: ../student/");
        } else {
            header("Location: ../guest");
        }
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['disconnect'])) {
            session_unset();
            session_destroy();
            header("Location: ../guest");
            exit();
        }
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy</title>
    <link rel="icon" href="../../assets/img/logo.png">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <header class="px-5 py-3 bg-white shadow-md fixed w-full">
        <nav class="flex items-center justify-between gap-5">
            <div class="flex items-center gap-6">
                <div id="burger-menu">
                    <i class="fa-solid fa-bars text-2xl cursor-pointer"></i>
                </div>
                <div class="flex items-center gap-1">
                    <img class="w-10" src="../../assets/img/logo.png" alt="Logo de Youdemy Plateforme">
                    <h1 class="text-xl font-semibold">You<span class="text-blue-800">Demy</span></h1>
                </div>
            </div>
            <div class="flex items-center gap-6">
                <a href="#"><img class="w-14 rounded-full border-4 border-blue-500" src="../../uploads/<?php echo $enseignant->getPhoto() ?>" alt=""></a>
            </div>
        </nav>

        <section id="links" style="height: calc(100vh - 80px);" class="z-10 absolute top-[80px] left-[-500px] transition-all ease-in duration-500 w-64 bg-white shadow-md py-8 flex flex-col justify-between">
            <div class="flex flex-col items-center justify-center gap-2">
                <img class="w-1/3 rounded-full border-4 border-white" src="../../uploads/<?php echo $enseignant->getPhoto() ?>" alt="">
                <h1 class="font-semibold mt-2"><?php echo $enseignant->getNom().' '.$enseignant->getPrenom() ?></h1>
                <p class="text-xs">Espace Enseignant</p>
            </div>
            <div class="flex flex-col items-center justify-center gap-2">
                <a href="#" class="flex items-center gap-3 duration-300 hover:bg-gray-200 w-full pl-5 hover:border-r-4 hover:border-gray-400 py-3">
                    <i class="fa-solid fa-chart-simple"></i>
                    <p>Statistiques</p>
                </a>
                <a href="courses.php" class="flex items-center gap-3 duration-300 hover:bg-gray-200 w-full pl-5 hover:border-r-4 hover:border-gray-400 py-3">
                    <i class="fa-solid fa-book-open "></i>
                    <p>Mes Cours</p>
                </a>
            </div>
            <form method="POST" action="">
                <button name="disconnect" class="flex items-center gap-3 duration-300 hover:bg-gray-200 w-full pl-5 hover:border-r-4 hover:border-gray-400 py-3">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    Déconnexion
                </button>
            </form>
        </section>
    </header>

    <main class="bg-gray-100 pt-24 pb-12 px-5">
        <!-- Statistiques -->
        <section class="grid md:grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- Approved Courses -->
            <div class="flex item-center gap-5 bg-white shadow-md hover:shadow-lg rounded-md py-3 px-5">
                <div class="flex items-center">
                    <i class="fa-solid fa-circle-check text-3xl text-green-600"></i>
                </div>
                <div class="flex flex-col gap-2">
                    <h1 class="font-semibold text-lg">Cours Approuvés</h1>
                    <?php 
                    $count = $enseignant->countCourses($enseignant->getId(),'Approuvé');
                    ?>
                    <p class="text-sm"><?php echo $count ?> Cours</p>
                </div>
            </div>
            <!-- Pending Courses -->
            <div class="flex item-center gap-5 bg-white shadow-md hover:shadow-lg rounded-md py-3 px-5">
                <div class="flex items-center">
                    <i class="fa-regular fa-hourglass-half text-3xl text-yellow-500"></i>
                    <i class=""></i>
                </div>
                <div class="flex flex-col gap-2">
                    <h1 class="font-semibold text-lg">Cours En Attente</h1>
                    <?php 
                    $count = $enseignant->countCourses($enseignant->getId(),'En Attente');
                    ?>
                    <p class="text-sm"><?php echo $count ?> Cours</p>
                </div>
            </div>
            <!-- Refused Courses -->
            <div class="flex item-center gap-5 bg-white shadow-md hover:shadow-lg rounded-md py-3 px-5">
                <div class="flex items-center">
                    <i class="fa-solid fa-ban text-3xl text-red-600"></i>
                </div>
                <div class="flex flex-col gap-2">
                    <h1 class="font-semibold text-lg">Cours Refusés</h1>
                    <?php 
                    $count = $enseignant->countCourses($enseignant->getId(),'Refusé');
                    ?>
                    <p class="text-sm"><?php echo $count ?> Cours</p>
                </div>
            </div>
            <!-- Enrolled Students -->
            <div class="flex item-center gap-5 bg-white shadow-md hover:shadow-lg rounded-md py-3 px-5">
                <div class="flex items-center">
                    <i class="fa-solid fa-users text-3xl text-blue-600"></i>
                </div>
                <div class="flex flex-col gap-2">
                    <h1 class="font-semibold text-lg">Etudiants Inscris</h1>
                    <?php 
                    $count = $enseignant->countEnrolledStudents($enseignant->getId());
                    ?>
                    <p class="text-sm"><?php echo $count ?> Etudiants</p>
                </div>
            </div>
            <!-- Courses Per Category -->
            <div class="flex flex-col gap-5 lg:col-span-2 bg-white shadow-md hover:shadow-lg rounded-md px-10 py-7">
                <h1 class="text-lg font-medium text-purple-600 mb-3">Répartition Par Catégorie</h1>

                <?php 
                    $counts = $enseignant->countCoursesPerCategory($enseignant->getId());
                    foreach($counts as $count) {
                        $courses = $count['course_count'];
                        $category = new Categorie($count['nom_categorie'],'');
                ?>

                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-5">
                        <div class="h-10 w-10 rounded-full text-xl text-blue-600 bg-blue-100 flex items-center justify-center">
                            <i class="fa-solid fa-thumbtack"></i>
                        </div>
                        <h1 class="text-lg font-medium"><?php echo $category->getName() ?></h1>
                    </div>
                    <div>
                        <p><?php echo $courses ?> Cours</p>
                    </div>
                </div>

                <?php
                    }
                ?>
            </div>
            <!-- Last Courses -->
            <div class="flex flex-col gap-5 lg:col-span-2 bg-white shadow-md hover:shadow-lg rounded-md px-10 py-7">
                <div class="flex item-center justify-between text-lg font-medium text-purple-600 mb-3">
                    <h1>Cours Récents</h1>
                    <a href="courses.php">Voir Plus <i class="fa-solid fa-arrow-right ml-3"></i></a>
                </div>
                <?php
                    $courses = $enseignant->lastCourses($enseignant->getId());
                    if($courses){
                    foreach($courses as $course) {
                        $cours = new Course($course['titre'], '',$course['couverture'],'','',$course['statut_cours'],'');
                        $cours->setDate($course['date_publication']);
                ?>
                <div class="flex items-center bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <img src="../../uploads/<?php echo $cours->getCouverture() ?>" alt="Article" class="h-16 w-24 rounded-lg object-cover">
                    <div class="ml-4 flex-1 flex flex-col justify-between">
                        <h4 class="text-sm font-semibold text-gray-800"><?php echo $cours->getTitre() ?></h4>
                        <p class="text-sm text-gray-600"><?php echo $cours->getDate() ?></p>
                        <div class="flex items-center mt-1">
                            <?php
                            if ($cours->getStatus() == 'Approuvé') {
                                echo '<span class="text-xs bg-green-100 text-green-600 px-2 py-1 rounded-full">' . $cours->getStatus() . '</span>';
                            } else if ($cours->getStatus() == 'En Attente') {
                                echo '<span class="text-xs bg-yellow-100 text-yellow-600 px-2 py-1 rounded-full">' . $cours->getStatus() . '</span>';
                            } else {
                                echo '<span class="text-xs bg-red-100 text-red-600 px-2 py-1 rounded-full">' . $cours->getStatus() . '</span>';
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <?php 
                    }
                    }else{
                ?>
                
                <h1 class="text-red-600 font-semibold text-lg">Vous n'avez pas publié UN COURS pour le Moment !</h1>
                
                <?php 
                    }
                ?>
            </div>
        </section>
    </main>


    <script src="../../assets/js/main.js"></script>
    <script>
            let list = document.querySelector('#links');
            const menu = document.querySelector('#burger-menu');

            menu.addEventListener('click',function(){
                list.classList.toggle('left-0');
                list.classList.toggle('left-[-500px]');
            });
    </script>
</body>
</html>