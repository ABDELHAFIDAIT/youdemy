<?php

    session_start();

    require_once "../../classes/Tag.php";
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
        //add
        if(isset($_POST["add-tag"])) {
            $tag = new Tag($_POST['nom-tag']);
            $tag->addTag($tag->getNom());
        }
        //add multiple tags
        if(isset($_POST["add-multiple-tags"])) {
            $tags_string = $_POST['tags-list'];
            $tags_array = explode(',', $tags_string);
            $tag = new Tag('');
            foreach($tags_array as $tag_name) {
                $tag_name = trim($tag_name);
                if(!empty($tag_name)) {
                    $tag->addTag($tag_name);
                }
            }
        }
        //delete
        if(isset($_POST["delete-tag"])) {
            $tag = new Tag('');
            $id= $_POST["tag-id"];
            $tag->deleteTag($id);
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
                <a href="#" class="flex items-center gap-3 duration-300 hover:bg-gray-200 w-full pl-5 hover:border-r-4 hover:border-gray-400 py-3">
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
        <section class="flex items-center justify-between gap-5 p-5">
            <button id="open-add-tag" type="button" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 ">Ajouter un Tag</button>
            <button type="button" class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 shadow-lg shadow-purple-500/50 dark:shadow-lg dark:shadow-purple-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Ajouter Multiple Tags</button>
        </section>

        <!-- TAGS -->
        <section class="z-[0] grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 py-5 gap-5">

            <?php
                $tg = new Tag('');
                $tags = $tg->allTags();
                foreach ($tags as $tag) {
                    $tg->setNom($tag['nom_tag']);
                    $id_tag = $tag['id_tag'];
                    $courses = $tag['course_count'];
            ?>

            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition duration-300 border border-purple-100 transform hover:-translate-y-1" data-tag-id="<?php echo $id_tag ?>">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="w-3 h-3 rounded-full bg-gradient-to-r from-purple-500 to-pink-500"></span>
                        <h3 class="text-md font-semibold text-purple-900"><?php echo $tg->getNom() ?></h3>
                    </div>
                    <span class="text-xs px-3 py-1 rounded-full bg-yellow-100 text-gray-900"><?php echo $courses ?> Cours</span>
                </div>
                
                <div class="flex justify-end gap-2 mt-4">
                    <button onclick="openEditModal(<?php echo $id_tag ?>, '<?php echo $tg->getNom() ?>')" class="p-2 text-blue-600 hover:bg-purple-50 rounded-lg transition duration-200 hover:scale-110" 
                            title="Modifier">
                        <i class="fas fa-edit"></i>
                    </button>
                    <form method="POST">
                        <input name="tag-id" type="hidden" value="<?php echo $id_tag ?>">
                        <button name="delete-tag" class="p-2 text-red-500 hover:bg-pink-50 rounded-lg transition duration-200 hover:scale-110" title="Supprimer">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>

            <?php } ?>
        </section>


        <!-- ADD TAG -->
        <div style="display: none;"  id="add-tag-form" class="z-10 fixed inset-0 bg-gray-900 bg-opacity-80 flex justify-center items-center ">
            <div class="max-w-md w-full space-y-8 bg-white px-8 py-5 rounded-lg shadow-lg animate__animated animate__fadeIn">
                <div>
                    <h2 class="text-center text-2xl font-extrabold text-gray-900">
                        Nouveau Tag
                    </h2>
                </div>
                <form method="POST" action="" id="addTagForm" class="mt-8 space-y-6">
                    <div class="rounded-md shadow-sm flex flex-col gap-5">
                        <div>
                            <label for="nom-tag" class="sr-only">Nom</label>
                            <input id="nom-tag" name="nom-tag" type="text" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm" placeholder="Nom du Tag">
                        </div>
                    </div>

                    <div class="flex items-center gap-10">
                        <button type="submit" name="add-tag" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium  text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                            Enregister
                        </button>
                        <button type="button" name="cancel-tag" id="cancel-tag" class="group relative w-full flex justify-center py-2 px-4 border border-gray-800 text-sm font-medium text-black bg-transparent duration-500 hover:bg-red-700 hover:border-none hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-transparent">
                            Annuler
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- ADD MULTIPLE TAGS -->
        <div style="display: none;" id="add-multiple-tags-form" class="z-10 fixed inset-0 bg-gray-900 bg-opacity-80 flex justify-center items-center">
            <div class="max-w-md w-full space-y-8 bg-white px-8 py-5 rounded-lg shadow-lg animate__animated animate__fadeIn">
                <div>
                    <h2 class="text-center text-2xl font-extrabold text-gray-900">
                        Ajouter Plusieurs Tags
                    </h2>
                    <p class="mt-2 text-center text-sm text-gray-600">
                        Séparez les tags par des virgules
                    </p>
                </div>
                <form method="POST" action="" id="addMultipleTagsForm" class="mt-8 space-y-6">
                    <div class="rounded-md shadow-sm flex flex-col gap-5">
                        <div>
                            <label for="tags-list" class="sr-only">Tags</label>
                            <textarea id="tags-list" name="tags-list" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm" placeholder="tag1, tag2, tag3, ..."></textarea>
                        </div>
                    </div>

                    <div class="flex items-center gap-10">
                        <button type="submit" name="add-multiple-tags" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                            Enregistrer
                        </button>
                        <button type="button" id="cancel-multiple-tags" class="group relative w-full flex justify-center py-2 px-4 border border-gray-300 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                            Annuler
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- EDIT TAG MODAL -->
        <div style="display: none;" id="edit-tag-modal" class="z-10 fixed inset-0 bg-gray-900 bg-opacity-80 flex justify-center items-center">
            <div class="max-w-md w-full space-y-8 bg-white px-8 py-5 rounded-lg shadow-lg animate__animated animate__fadeIn">
                <div>
                    <h2 class="text-center text-2xl font-extrabold text-gray-900">
                        Modifier le Tag
                    </h2>
                </div>
                <form id="editTagForm" class="mt-8 space-y-6">
                    <input type="hidden" id="edit-tag-id">
                    <div class="rounded-md shadow-sm flex flex-col gap-5">
                        <div>
                            <label for="edit-tag-name" class="sr-only">Nom</label>
                            <input id="edit-tag-name" name="edit-tag-name" type="text" required 
                                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm" 
                                placeholder="Nouveau nom du tag">
                        </div>
                    </div>

                    <div class="flex items-center gap-10">
                        <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                            Modifier
                        </button>
                        <button type="button" onclick="closeEditModal()" class="group relative w-full flex justify-center py-2 px-4 border border-gray-300 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                            Annuler
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>


    <script src="../../assets/js/admin.js"></script>
    <script>
            
    </script>
</body>
</html>