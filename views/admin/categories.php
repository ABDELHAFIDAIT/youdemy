<?php

    session_start();

    require_once "../../classes/teacher.php";
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
        // disconnect
        if(isset($_POST['disconnect'])) {
            session_unset();
            session_destroy();
            header("Location: ../guest");
            exit();
        }
        // add
        if(isset($_POST["add-cat"])) {
            $categorie = new Categorie($_POST['nom-cat'],$_POST['description']);
            $categorie->addCategory($categorie->getName(),$categorie->getDescription());
        }
        // delete
        if(isset($_POST['delete-cat'])) {
            $categorie = new Categorie('','');
            $id = $_POST['id-cat'];
            $categorie->deleteCategory( $id );
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
                <a href="#" class="flex items-center gap-3 duration-300 hover:bg-gray-200 w-full pl-5 hover:border-r-4 hover:border-gray-400 py-3">
                    <i class="fa-solid fa-layer-group"></i>
                    <p>Catégories</p>
                </a>
                <a href="tags.php" class="flex items-center gap-3 duration-300 hover:bg-gray-200 w-full pl-5 hover:border-r-4 hover:border-gray-400 py-3">
                    <i class="fa-solid fa-tags"></i>
                    <p>Tags</p>
                </a>
                <a href="students.php" class="flex items-center gap-3 duration-300 hover:bg-gray-200 w-full pl-5 hover:border-r-4 hover:border-gray-400 py-3">
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
        <section class="flex items-center justify-end py-3">
            <button id="open-add-cat" type="button" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-sm text-sm px-5 py-2.5 me-2 mb-2">Ajouter une Catégorie</button>
        </section>

        <!-- SHOW CATEGORIES -->
        <section class="flex items-center p-3">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-blue-500 divide-y divide-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nom</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Cours</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
            <?php
                $ctg = new Categorie('','');
                $ctgs = $ctg->allCategories();
                foreach ($ctgs as $ct) {
                    $ctg->setName($ct['nom_categorie']);
                    $ctg->setDescription($ct['description']);
                    $id_cat = $ct['id_categorie'];
                    $courses = $ct['nombre_cours'];
            ?>

            
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $ctg->getName() ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $ctg->getDescription() ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"><?php echo $courses ?> Cours</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap flex gap-1">
                            <button class="px-3 py-1 text-xs font-medium text-white bg-blue-600 rounded-sm hover:bg-blue-500 focus:outline-none focus:shadow-outline-blue active:bg-blue-600 transition duration-150 ease-in-out">Modifier</button>
                            <form method="POST" action="">
                                <input type="hidden" name="id-cat" value="<?php echo $id_cat ?>">
                                <button name="delete-cat" class="ml-2 px-3 py-1 text-xs font-medium text-white bg-red-600 rounded-sm hover:bg-red-500 focus:outline-none focus:shadow-outline-red active:bg-red-600 transition duration-150 ease-in-out">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                

            <?php
                }
            ?>
            </tbody>
            </table>
        </section>

        <!-- ADD CATEGORY FORM -->
        <section style="display:none;" id="add-cat-form" class="z-10 fixed inset-0 bg-gray-900 bg-opacity-80 flex justify-center items-center ">
            <div class="max-w-md w-full space-y-8 bg-white px-8 py-5 rounded-lg shadow-lg animate__animated animate__fadeIn">
                <div>
                    <h2 class="text-center text-3xl font-extrabold text-gray-900">
                        Nouvelle Catégorie
                    </h2>
                </div>
                <form method="POST" action="" id="addCategoryForm" class="mt-8 space-y-6">
                    <div class="rounded-md shadow-sm flex flex-col gap-5">
                        <div>
                            <label for="nom-cat" class="sr-only">Nom</label>
                            <input id="nom-cat" name="nom-cat" type="text" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm" placeholder="Nom de Catégorie">
                        </div>
                        <div>
                            <label for="description" class="sr-only">Description</label>
                            <textarea id="description" name="description" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm" placeholder="Entrer le Contenu de votre Article ici.."></textarea>
                        </div>
                    </div>

                    <div class="flex items-center gap-10">
                        <button type="submit" name="add-cat" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium  text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                            Enregister
                        </button>
                        <button type="button" name="cancel-cat" id="cancel-cat" class="group relative w-full flex justify-center py-2 px-4 border border-gray-800 text-sm font-medium text-black bg-transparent duration-500 hover:bg-red-700 hover:border-none hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-transparent">
                            Annuler
                        </button>
                    </div>
                </form>
            </div>
        </section>
        
    </main>


    <!-- <script src="../../assets/js/admin.js"></script> -->
    <script>
            let list = document.querySelector('#links');
            const menu = document.querySelector('#burger-menu');

            menu.addEventListener('click',function(){
                list.classList.toggle('left-0');
                list.classList.toggle('left-[-500px]');
            });

            const cancelButtonCategory = document.querySelector('#cancel-cat');
            const CategoryFormContainer = document.querySelector('#add-cat-form');
            const openCategoryForm = document.querySelector('#open-add-cat');
            const CategoryForm = document.querySelector('#addCategoryForm');

            cancelButtonCategory.addEventListener('click', function() {
                CategoryFormContainer.style.display = 'none';
                CategoryForm.reset();
            });

            openCategoryForm.addEventListener('click', function() {
                CategoryFormContainer.style.display = 'flex';
            });
    </script>
</body>
</html>