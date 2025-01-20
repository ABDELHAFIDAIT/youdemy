<?php

    session_start();

    require_once "../../classes/teacher.php";
    require_once "../../classes/category.php";
    require_once "../../classes/course.php";
    require_once "../../classes/Tag.php";



    $enseignant = new Teacher((int)$_SESSION['id_user'],$_SESSION['nom'],$_SESSION['prenom'],'',$_SESSION['email'],'',$_SESSION['role'],$_SESSION['status'],$_SESSION['photo']);

    $new_cour = new Course('','','','','','','');

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
        if(isset($_POST["delete"])) {
            $course = $_POST['course'];
            $delete = $new_cour->deleteCourse($course);
            if($delete) {
                echo '<script>alert("Cours Supprimé avec Succés !")</script>';
            } else {
                echo '<script>alert("Cours Non Supprimé !")</script>';
            }
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
    <header class="px-5 py-3 bg-white shadow-md fixed w-full z-10">
        <nav class="flex items-center justify-between gap-5 z-10">
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
                <a href="dashboard.php" class="flex items-center gap-3 duration-300 hover:bg-gray-200 w-full pl-5 hover:border-r-4 hover:border-gray-400 py-3">
                    <i class="fa-solid fa-chart-simple"></i>
                    <p>Statistiques</p>
                </a>
                <a href="#" class="flex items-center gap-3 duration-300 hover:bg-gray-200 w-full pl-5 hover:border-r-4 hover:border-gray-400 py-3">
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

    <main class="bg-gray-100 pt-28 pb-12 px-5">
        <!-- HEAD -->
        <section class="flex flex-wrap items-center justify-between gap-5">
            <h1 class="text-3xl text-gray-800 font-bold">Mes Cours</h1>
            <div class="w-full max-w-lg">
                <form class="sm:flex sm:items-center">
                    <input class="inline w-full rounded-md border border-gray-300 bg-white py-2 pl-3 pr-3 leading-5 placeholder-gray-500 focus:border-indigo-500 focus:placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm" placeholder="Rechercher un Cours .." type="search">
                    <button type="submit" class="mt-3 inline-flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Search
                    </button>
                </form>
            </div>
            <button id="add-course" type="button" class="bg-blue-600 text-md text-white py-1 px-4 rounded-md duration-300 hover:px-5 hover:bg-blue-800">Ajouter un Cours</button>
        </section>

        <!-- Courses -->
        <section class="z-[0] grid md:grid-cols-2 lg:grid-cols-3 gap-5 mt-10">
            <?php
                $courses = $enseignant->displayCourses($enseignant->getId());
                if ($courses) {
                    foreach ($courses as $course) {
                        $cours = new Course($course['titre'],$course['description'],$course['couverture'],$course['contenu'],$course['video'],$course['statut_cours'],$course['niveau']);
                        $cours->setDate($course['date_publication']);
                        $category = new Categorie($course['nom_categorie'],'');
            ?>

            <div class="relative pb-5 flex flex-col gap-5 rounded-md bg-white shadow-md hover:shadow-lg">
                <div class="">
                    <img src="../../uploads/<?php echo $cours->getCouverture() ?>" class="rounded-t-md w-full h-64">
                </div>
                <div class="flex items-center justify-between gap-3 px-4">
                    <div class="flex items-center gap-3">
                        <p class="py-[2px] px-4 bg-purple-500 text-white rounded-full text-sm"><?php echo $category->getName() ?></p>
                        <p class="text-sm">• <?php echo $cours->getNiveau() ?></p>
                    </div>
                    <p class="text-gray-700 text-sm"><?php echo $cours->getDate() ?></p>
                </div>
                <div class="flex flex-col gap-1 px-4">
                    <h1 class="text-xl font-semibold text-gray-900 "><?php echo $cours->getTitre() ?></h1>
                    <p class="text-gray-700"><?php echo $cours->getDescription() ?></p>
                </div>

                <div class="flex flex-wrap items-center gap-3 px-4">
                    <?php 
                        $tg = new Tag('');
                        $tags = $tg->showCourseTags($course['id_course']);
                        foreach ($tags as $tag) {
                            $tg->setNom($tag['nom_tag']);
                    ?>
                    <span class="text-white bg-blue-500 px-2 text-xs rounded-full"># <?php echo $tg->getNom() ?></span>
                    <?php } ?>
                </div>
                
                <div class="flex flex-wrap items-center justify-end gap-3 px-4 text-sm mt-5">
                    <a href="details.php?id=<?php echo $course['id_course'] ?>">
                        <i class="fa-solid fa-eye text-xl text-green-600 "></i>
                    </a>
                    <i class="fa-solid fa-file-pen text-xl text-blue-600"></i>
                    <form method="POST" action="">
                        <input type="hidden" name="course" value="<?php echo $course['id_course'] ?>">
                        <button name="delete"><i class="fa-solid fa-trash text-xl text-red-600"></i></button>
                    </form>
                </div>
                <?php 
                if($cours->getStatus() == 'Approuvé') {
                ?>
                <span class="absolute top-2 right-2 bg-green-600 rounded-full text-white py-1 px-3 text-xs"><?php echo $cours->getStatus() ?></span>
                <?php 
                }else if($cours->getStatus() == 'En Attente') {
                ?>
                <span class="absolute top-2 right-2 bg-yellow-500 rounded-full text-white py-1 px-3 text-xs"><?php echo $cours->getStatus() ?></span>
                <?php 
                }else {
                ?>
                <span class="absolute top-2 right-2 bg-red-500 rounded-full text-white py-1 px-3 text-xs"><?php echo $cours->getStatus() ?></span>
                <?php
                }
                ?>
            </div>

            <?php
                }
            }else{
            ?>

            <?php
            }
            ?>
        </section>

        <!-- Add Course -->
        <section id="popup" class="fixed inset-0 bg-black bg-opacity-80 z-10 hidden items-center justify-center">
            <div class="bg-white p-5 flex flex-col gap-5 w-[70vw] rounded-md scale-[0.9]">
                <div class="flex items-center justify-between px-3 pb-5 border-b border-gray-300">
                    <h1 class="text-2xl font-semibold">Ajouter un Nouveau Cours</h1>
                    <i id="close" class="fa-solid fa-xmark text-xl cursor-pointer"></i>
                </div>
                <form method="POST" id="add-form" class="flex flex-col gap-5">
                    <div class="flex gap-5">
                        <div class="flex flex-col gap-3 flex-1">
                            <!-- Titre -->
                            <div class="flex flex-col gap-2">
                                <label for="titre">Titre</label>
                                <input type="text" name="titre" class="border border-gray-500 text-black py-1 px-4 rounded-md outline-none focus:border-purple-800" placeholder="Entrer le Titre du Cours..">
                            </div>
                            <!-- Description -->
                            <div class="flex flex-col gap-2">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="h-32 border border-gray-500 text-black py-1 px-4 rounded-md outline-none focus:border-purple-800" placeholder="Entrer la Description du Cours.."></textarea>
                            </div>
                            <!-- Type -->
                            <div class="flex flex-col gap-2">
                                <label for="type">Type</label>
                                <select name="type" id="type" class="border border-gray-500 text-black py-1 px-4 rounded-md outline-none focus:border-purple-800">
                                    <option>Video</option>
                                    <option>Document</option>
                                </select>
                            </div>
                            <!-- Document -->
                            <div id="document" class="hidden flex-col gap-2">
                                <label for="document">Document (URL)</label>
                                <input type="url" name="document" class="border border-gray-500 text-black py-1 px-4 rounded-md outline-none focus:border-purple-800" placeholder="Entrer le Lien du Cours..">
                            </div>
                            <!-- Video -->
                            <div id="video" class="flex flex-col gap-2">
                                <label for="video">Vidéo</label>
                                <input type="file" accept="video/*" name="video" class="border border-gray-500 text-black py-1 px-4 rounded-md outline-none focus:border-purple-800" placeholder="Entrer le Lien du Cours..">
                            </div>
                        </div>
                        <div class="flex flex-col gap-3 flex-1">
                            <!-- Couverture -->
                            <div class="flex flex-col gap-2">
                                <label for="couverture">Couverture</label>
                                <input type="file" accept="image/*" name="couverture" class="border border-gray-500 text-black py-1 px-4 rounded-md outline-none focus:border-purple-800" placeholder="Entrer le Lien du Cours..">
                            </div>

                            <!-- Tags -->
                            <div class="flex items-center flex-wrap gap-3 h-40 overflow-auto border border-black px-4 rounded-md">
                                <div class="flex items-center gap-1">
                                    <input type="checkbox" id="tag" name="tags[]" value="'. $tag['id_tag'] .'">
                                    <label for="tag" class="mr-3">tag</label>
                                </div>
                                <div class="flex items-center gap-1">
                                    <input type="checkbox" id="tag" name="tags[]" value="'. $tag['id_tag'] .'">
                                    <label for="tag" class="mr-3">tag</label>
                                </div>
                                <div class="flex items-center gap-1">
                                    <input type="checkbox" id="tag" name="tags[]" value="'. $tag['id_tag'] .'">
                                    <label for="tag" class="mr-3">tag</label>
                                </div>
                                <div class="flex items-center gap-1">
                                    <input type="checkbox" id="tag" name="tags[]" value="'. $tag['id_tag'] .'">
                                    <label for="tag" class="mr-3">tag</label>
                                </div>
                                <div class="flex items-center gap-1">
                                    <input type="checkbox" id="tag" name="tags[]" value="'. $tag['id_tag'] .'">
                                    <label for="tag" class="mr-3">tag</label>
                                </div>
                                <div class="flex items-center gap-1">
                                    <input type="checkbox" id="tag" name="tags[]" value="'. $tag['id_tag'] .'">
                                    <label for="tag" class="mr-3">tag</label>
                                </div>
                                <div class="flex items-center gap-1">
                                    <input type="checkbox" id="tag" name="tags[]" value="'. $tag['id_tag'] .'">
                                    <label for="tag" class="mr-3">tag</label>
                                </div>
                            </div>
                            <!-- Catégorie -->
                            <div class="flex flex-col gap-2">
                                <label for="categorie">Catégorie</label>
                                <select name="categorie" id="categorie" class="border border-gray-500 text-black py-1 px-4 rounded-md outline-none focus:border-purple-800">
                                    <option value="1">categorie 1</option>
                                    <option value="2">categorie 2</option>
                                </select>
                            </div>
                            <!-- Niveau -->
                            <div class="flex flex-col gap-2">
                                <label for="niveau">Niveau</label>
                                <select name="niveau" id="niveau" class="border border-gray-500 text-black py-1 px-4 rounded-md outline-none focus:border-purple-800">
                                    <option>Facile</option>
                                    <option>Moyen</option>
                                    <option>Difficile</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <button name="save-add" class="py-1 px-5 text-white duration-500 bg-blue-600 hover:bg-blue-800 rounded-sm">Enregistrer</button>
                    </div>
                </form>
            </div>
        </section>
    </main>


    <!-- <script src="../../assets/js/main.js"></script> -->
    <script src="../../assets/js/teacher.js"></script>
    <script>
            

    </script>
</body>
</html>