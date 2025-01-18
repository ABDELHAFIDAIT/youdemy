<?php

    session_start();

    require_once '../../classes/course.php';
    require_once '../../classes/tag.php';

    $cours = new Course('','','','','','','');
    $tg = new Tag('');


    if (isset($_SESSION["role"])){
        if($_SESSION['role'] === 'Admin'){
            header("Location: ../admin/dashboard.php");
        }else if($_SESSION['role'] === 'Enseignant'){
            header("Location: ../teacher/dashboard.php");
        }else{
            header("Location: ../student");
        }
        exit;
    }


    $limit = 3;

    if(isset($_GET['page'])){
        $page = (int)$_GET['page'];
    }else{
        $page = 1;
    }

    $depart = ($page - 1) * $limit;

    $courses = $cours->getCourses('Approuvé', $limit, $depart);

    $totalCourses = $cours->countCourse('Approuvé');
    $totalPages = ceil($totalCourses / $limit);
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
    
    <header>
        <!-- Navbar Section -->
        <nav class="px-5 py-3 flex items-center justify-between gap-5 shadow-md bg-white bg-opacity-90 shadow-lg fixed w-full z-50">
            <a href="../guest/" class="flex items-center gap-1">
                <img class="w-14" src="../../assets/img/logo.png" alt="Logo de Youdemy Plateforme">
                <h1 class="text-2xl font-semibold">You<span class="text-blue-800">Demy</span></h1>
            </a>
            <div class="hidden lg:flex items-center justify-between gap-20">
                <ul class="flex items-center gap-10 text-md">
                    <a href="../guest/"><li class="cursor-pointer duration-300 hover:text-blue-600 hover:font-medium hover:border-b-2 hover:border-blue-600 hover:pb-3">Accueil</li></a>
                    <a href="categories.php"><li class="cursor-pointer duration-300 hover:text-blue-600 hover:font-medium hover:border-b-2 hover:border-blue-600 hover:pb-3">Catégories</li></a>
                    <a href="#"><li class="active cursor-pointer duration-300">Cours</li></a>
                    <a href="contact.php"><li class="cursor-pointer duration-300 hover:text-blue-600 hover:font-medium hover:border-b-2 hover:border-blue-600 hover:pb-3">Contact</li></a>
                </ul>
                <div class="flex gap-3">
                    <a href="../auth/login.php">
                        <button class="rounded-sm py-1 px-5 border border-black text-md duration-500 hover:text-white hover:bg-blue-700 hover:border-blue-500">Connexion</button>
                    </a>
                    <a href="../auth/register.php">
                        <button class="rounded-sm py-1 px-5 border border-blue-500 text-md text-white bg-blue-600 duration-500 hover:bg-blue-900 hover:border-blue-900">Inscription</button>
                    </a>
                </div>
            </div>
            <div class="lg:hidden flex items-center">
                <button class="mobile-menu-button">
                    <i class="fas fa-bars text-blue-600 text-2xl"></i>
                </button>
            </div>
            <div class="bg-white mobile-menu hidden lg:hidden absolute left-0 top-[70px] flex-1 w-full">
                <a href="../guest/" class="block py-2 px-4 text-sm hover:bg-blue-600 hover:text-white">Accueil</a>
                <a href="categories.php" class="block py-2 px-4 text-sm hover:bg-blue-600 hover:text-white">Catégories</a>
                <a href="#" class="block py-2 px-4 text-sm hover:bg-blue-600 hover:text-white">Cours</a>
                <a href="contact.php" class="block py-2 px-4 text-sm hover:bg-blue-600 hover:text-white">Contact</a>
                <a href="../auth/login.php" class="block py-2 px-4 text-sm hover:bg-blue-600 hover:text-white">Connexion</a>
                <a href="../auth/register.php" class="block py-2 px-4 text-sm hover:bg-blue-600 hover:text-white">Inscription</a>
            </div>
        </nav>

        <!-- Search Section -->
        <section class="course pt-24 relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 py-12 relative z-10">
                <div class="text-center text-white mb-8">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4 animate-fade-in">Explorez nos cours</h1>
                    <p class="text-xl animate-fade-in">Trouvez le cours parfait pour développer vos compétences</p>
                </div>
                <div class="max-w-3xl mx-auto">
                    <form class="relative">
                        <input type="text" id="search-input" placeholder="Rechercher un cours..." class="w-full px-6 py-2 rounded-lg shadow-lg text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button class="absolute right-4 top-1/2 transform -translate-y-1/2 text-blue-600">
                            <i class="fas fa-search text-xl"></i>
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </header>

    
    <main class="py-10 px-5">
        <section class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
            <?php 
            if(is_array($courses)){
                foreach($courses as $course){
            ?>
            <div class="course-card bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300">
                <div class="relative">
                    <img src="../../uploads/<?php echo $course['couverture'] ?>" alt="Course" class="w-full h-48 object-cover">
                </div>
                <div class="p-6">
                    <div class="flex items-center mb-2">
                        <span class="px-2 py-1 bg-blue-100 text-blue-600 rounded-full text-xs"><?php echo $course['categorie'] ?></span>
                        <span class="ml-2 text-gray-500 text-sm">•</span>
                        <span class="ml-2 text-gray-500 text-sm"><?php echo $course['niveau'] ?></span>
                    </div>
                    <div class="flex flex-wrap items-center gap-3 py-2">
                        <?php $tags = $tg->showCourseTags($course['id_course']);
                        foreach($tags as $tag){ ?>
                        <span class="text-white bg-blue-500 px-2 text-xs rounded-full"># <?php echo $tag['nom_tag'] ?></span>
                        <?php } ?>
                    </div>
                    <h3 class="text-xl font-bold mb-2"><?php echo $course['titre'] ?></h3>
                    <p class="text-gray-600 mb-4 line-clamp-2"><?php echo $course['description'] ?></p>
                    <div class="flex items-center mb-4">
                        <img src="../../uploads/<?php echo $course['photo'] ?>" alt="Instructor" class="w-8 h-8 rounded-full">
                        <span class="ml-2 text-gray-600"><?php echo $course['prenom'].' '.$course['nom'] ?></span>
                    </div>
                    <div class="flex items-center justify-center">
                        <a href="../auth/login.php" class="w-full">
                            <button type="button" class="font-medium text-white bg-blue-600 w-full py-1 rounded-md hover:bg-blue-800">S'inscrire</button>
                        </a>
                    </div>
                </div>
            </div>
            <?php
                }
            }else{
                echo "<p class='text-center col-span-3 font-semibold text-3xl text-red-600 animate-bounce mt-5'>Aucun cours disponible pour le moment.</p>";
            }
            ?>
        </section>

        <section class="flex justify-center mt-10">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>" class="px-4 py-2 bg-blue-600 text-white rounded-lg mr-2 hover:bg-blue-800">Précédent</a>
            <?php endif; ?>

            <?php if ($page < $totalPages): ?>
                <a href="?page=<?php echo $page + 1; ?>" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-800">Suivant</a>
            <?php endif; ?>
        </section>
    </main>

    <?php include_once '../../includes/footer.php'; ?>


    <script src="../../assets/js/main.js"></script>
</body>
</html>