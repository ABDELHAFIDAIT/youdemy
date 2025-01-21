<?php

    session_start();

    require_once "../../classes/student.php";
    require_once "../../classes/admin.php";
    require_once "../../classes/category.php";
    require_once "../../classes/course.php";



    $administrator = new Admin((int)$_SESSION['id_user'],$_SESSION['nom'],$_SESSION['prenom'],$_SESSION['phone'],$_SESSION['email'],'',$_SESSION['role'],$_SESSION['status'],$_SESSION['photo']);


    if ($_SESSION['role'] !== 'Admin') {
        if ($_SESSION['role'] === 'Enseignant') {
            header("Location: ../teacher/dashboard.php");
        } else if ($_SESSION['role'] === 'Etudiant') {
            header("Location: ../student/");
        } else {
            header("Location: ../guest");
        }
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        //disconnect
        if(isset($_POST['disconnect'])) {
            session_unset();
            session_destroy();
            header("Location: ../guest");
            exit();
        }
        // activate
        if(isset($_POST["activate"])) {
            $id = $_POST['user'];
            $administrator->activateUser($id);
        }
        // suspend
        if(isset($_POST["suspend"])) {
            $id = $_POST['user'];
            $administrator->suspendUser($id);
        }
        // delete
        if(isset($_POST['delete'])) {
            $id = $_POST['user'];
            $administrator->deleteUser($id);
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
                <a href="#"><img class="w-14 rounded-full border-4 border-blue-500" src="../../uploads/<?php echo $administrator->getPhoto() ?>" alt=""></a>
            </div>
        </nav>

        <section id="links" style="height: calc(100vh - 80px);" class="z-10 absolute top-[80px] left-[-500px] transition-all ease-in duration-500 w-64 bg-white shadow-md py-8 flex flex-col justify-between overflow-auto">
            <div class="flex flex-col items-center justify-center gap-2">
                <img class="w-1/3 rounded-full border-4 border-white" src="../../uploads/<?php echo $administrator->getPhoto() ?>" alt="">
                <h1 class="font-semibold mt-2"><?php echo $administrator->getNom().' '.$administrator->getPrenom() ?></h1>
                <p class="text-xs">Espace Admin</p>
            </div>
            <div class="flex flex-col items-center justify-center gap-2 py-10">
                <a href="dashboard.php" class="flex items-center gap-3 duration-300 hover:bg-gray-200 w-full pl-5 hover:border-r-4 hover:border-gray-400 py-3">
                    <i class="fa-solid fa-chart-simple"></i>
                    <p>Statistiques</p>
                </a>
                <a href="courses.php" class="flex items-center gap-3 duration-300 hover:bg-gray-200 w-full pl-5 hover:border-r-4 hover:border-gray-400 py-3">
                    <i class="fa-solid fa-book-open "></i>
                    <p>Cours</p>
                </a>
                <a href="categories.php" class="flex items-center gap-3 duration-300 hover:bg-gray-200 w-full pl-5 hover:border-r-4 hover:border-gray-400 py-3">
                    <i class="fa-solid fa-layer-group"></i>
                    <p>Catégories</p>
                </a>
                <a href="tags.php" class="flex items-center gap-3 duration-300 hover:bg-gray-200 w-full pl-5 hover:border-r-4 hover:border-gray-400 py-3">
                    <i class="fa-solid fa-tags"></i>
                    <p>Tags</p>
                </a>
                <a href="#" class="flex items-center gap-3 duration-300 hover:bg-gray-200 w-full pl-5 hover:border-r-4 hover:border-gray-400 py-3">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <p>Etudiants</p>
                </a>
                <a href="teachers.php" class="flex items-center gap-3 duration-300 hover:bg-gray-200 w-full pl-5 hover:border-r-4 hover:border-gray-400 py-3">
                    <i class="fa-solid fa-chalkboard-user"></i>
                    <p>Enseignants</p>
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
        <!-- HEAD -->
        <section class="flex flex-wrap items-center justify-between gap-5 py-5">
            <h1 class="text-3xl text-gray-800 font-bold">Les Etudiants</h1>
            <div class="w-full max-w-lg">
                <form class="sm:flex sm:items-center">
                    <input class="inline w-full rounded-md border border-gray-300 bg-white py-2 pl-3 pr-3 leading-5 placeholder-gray-500 focus:border-indigo-500 focus:placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm" placeholder="Rechercher un Cours .." type="search">
                    <button type="submit" class="mt-3 inline-flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Search
                    </button>
                </form>
            </div>
        </section>

        <!-- STUDENTS -->
        <section class="p-8 grid md:grid-cols-2 lg:grid-cols-3 gap-5">
            <?php
                $students = $administrator->showUsers(2);
                if ($students) {
                    foreach ($students as $student) {
                        $etudiant = new Student($student['nom'],$student['prenom'],$student['phone'],$student['email'],$student['password'],'Etudiant',$student['statut'],$student['photo']);
                        $id = $student['id_user'];
            ?>

            <div class="">
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl p-6 animate__animated animate__fadeIn hover:shadow-lg transition-shadow duration-300">
                    <div class="flex items-center justify-center">
                        <div class="flex flex-col items-center gap-2">
                            <img src="../../uploads/<?php echo $etudiant->getPhoto() ?>" alt="Profile" class="h-16 w-16 rounded-full object-cover mb-4">
                            <p class="text-lg font-semibold text-gray-800"><?php echo $etudiant->getPrenom().' '.$etudiant->getNom() ?></p>
                            <a href="mailto: <?php echo $etudiant->getEmail() ?>"><p class="text-sm text-gray-600"><?php echo $etudiant->getEmail() ?></p></a>
                            <a href="tel: <?php echo $etudiant->getTelephone() ?>"><p class="text-sm text-gray-600"><?php echo $etudiant->getTelephone() ?></p></a>
                            
                            <?php
                                if($etudiant->getStatus() == 'Actif') {
                            ?>
                            <div class="flex items-center gap-3">
                                <form method="POST">
                                    <input type="hidden" name="user" value="<?php echo $id ?>">
                                    <button name="suspend" class="duration-300 text-white bg-gray-800 py-1 px-4 rounded-sm text-xs">Suspendre <i class="ml-1 fa-solid fa-ban"></i></button>
                                </form>
                                <form method="POST">
                                    <input type="hidden" name="user" value="<?php echo $id ?>">
                                    <button name="delete" class="duration-300 text-white bg-red-600 py-1 px-4 rounded-sm text-xs hover:bg-red-500">Supprimer <i class="ml-1 fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                            <?php
                                }else{
                            ?>
                            <form method="POST">
                                <input type="hidden" name="user" value="<?php echo $id ?>">
                                <button name="suspend" class="duration-300 text-white bg-green-600 py-1 px-4 rounded-sm text-xs hover:bg-green-500">Activer <i class="ml-1 fa-solid fa-square-check"></i></button>
                            </form>
                            <?php
                                }
                            ?>
                            
                        </div>
                    </div>
                </div>
            </div>

            <?php
                    }
                }
            ?>
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