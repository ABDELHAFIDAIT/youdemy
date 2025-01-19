<?php

    session_start();

    require_once '../../classes/course.php';
    require_once '../../classes/tag.php';
    require_once '../../classes/student.php';
    require_once '../../classes/teacher.php';
    require_once '../../classes/category.php';

    $cours = new Course('','','','','','','');
    $tg = new Tag('');
    $etudiant = new Student('','','','','','','','');

    if ($_SESSION['role'] !== 'Etudiant') {
        if ($_SESSION['role'] === 'Admin') {
            header("Location: ../admin/dashboard.php");
        } else if ($_SESSION['role'] === 'Enseignant') {
            header("Location: ../teacher/dashboard.php");
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
        else if(isset($_POST['subscribe'])) {
            try {
                $course = $_POST['id_course'];
                $student = $_SESSION['id_user'];
                $subscribe = $etudiant->subscribeToCourse($student, $course);
                if ($subscribe) {
                    header('Location: ./my_courses.php');
                    exit();
                } else {
                    echo '<script>alert("Erreur lors de l\'inscription à ce cours !");</script>';
                }
            } catch (Exception $e) {
                echo '<script>alert("Une erreur est survenue : ' . $e->getMessage() . '");</script>';
            }
        }
    }

    $id_etudiant = $_SESSION['id_user'];

    $limit = 3;

    if(isset($_GET['page'])){
        $page = (int)$_GET['page'];
    }else{
        $page = 1;
    }

    $depart = ($page - 1) * $limit;

    $courses = $cours->getUnsubscribedCourses($id_etudiant,'Approuvé', $limit, $depart);

    $totalCourses = $cours->countUnsubscribedCourses($id_etudiant,'Approuvé');
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
            <a href="../student/" class="flex items-center gap-1">
                <img class="w-14" src="../../assets/img/logo.png" alt="Logo de Youdemy Plateforme">
                <h1 class="text-2xl font-semibold">You<span class="text-blue-800">Demy</span></h1>
            </a>
            <div class="hidden lg:flex items-center justify-between gap-20">
                <ul class="flex items-center gap-10 text-md">
                    <a href="../student/"><li class="cursor-pointer duration-300 hover:text-blue-600 hover:font-medium hover:border-b-2 hover:border-blue-600 hover:pb-3">Accueil</li></a>
                    <a href="categories.php"><li class="cursor-pointer duration-300 hover:text-blue-600 hover:font-medium hover:border-b-2 hover:border-blue-600 hover:pb-3">Catégories</li></a>
                    <a href="#"><li class="active cursor-pointer duration-300">Cours</li></a>
                    <a href="contact.php"><li class="cursor-pointer duration-300 hover:text-blue-600 hover:font-medium hover:border-b-2 hover:border-blue-600 hover:pb-3">Contact</li></a>
                    <a href="my_courses.php"><li class="cursor-pointer duration-300 hover:text-blue-600 hover:font-medium hover:border-b-2 hover:border-blue-600 hover:pb-3">Mes Cours</li></a>
                </ul>
                <form method="POST" class="flex gap-3">
                    <button name="disconnect" class="rounded-sm py-1 px-5 border border-blue-500 text-md text-white bg-blue-600 duration-500 hover:bg-blue-900 hover:border-blue-900">Déconnexion</button>
                </form>
            </div>
            <div class="lg:hidden flex items-center">
                <button class="mobile-menu-button">
                    <i class="fas fa-bars text-blue-600 text-2xl"></i>
                </button>
            </div>
            <div class="bg-white mobile-menu hidden lg:hidden absolute left-0 top-[70px] flex-1 w-full">
                <a href="../student/" class="block py-2 px-4 text-sm hover:bg-blue-600 hover:text-white">Accueil</a>
                <a href="categories.php" class="block py-2 px-4 text-sm hover:bg-blue-600 hover:text-white">Catégories</a>
                <a href="#" class="block py-2 px-4 text-sm hover:bg-blue-600 hover:text-white">Cours</a>
                <a href="contact.php" class="block py-2 px-4 text-sm hover:bg-blue-600 hover:text-white">Contact</a>
                <a href="my_courses.php" class="block py-2 px-4 text-sm hover:bg-blue-600 hover:text-white">Mes Cours</a>
                <form method="POST">
                    <button name="disconnect" class="block py-2 px-4 text-sm hover:bg-blue-600 hover:text-white">Déconnexion</button>
                </form>
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
            if (is_array($courses)) {
                foreach ($courses as $course) {
                    $cour = new Course(
                        $course['titre'],
                        $course['description'],
                        $course['couverture'],
                        $course['contenu'],
                        $course['video'],
                        $course['statut_cours'],
                        $course['niveau']
                    );

                    $teacher = new Teacher(
                        0,
                        $course['nom'],
                        $course['prenom'],
                        '',
                        '',
                        '',
                        '',
                        '',
                        $course['photo']
                    );

                    $ctg = new Categorie(
                        $course['categorie'],
                        ''
                    );
            ?>
            <div class="course-card bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300">
                <div class="relative">
                    <img src="../../uploads/<?php echo htmlspecialchars($cour->getCouverture()); ?>" alt="Course" class="w-full h-48 object-cover">
                </div>
                <div class="p-6">
                    <div class="flex items-center mb-2">
                        <span class="px-2 py-1 bg-blue-100 text-blue-600 rounded-full text-xs"><?php echo htmlspecialchars($ctg->getName()); ?></span>
                        <span class="ml-2 text-gray-500 text-sm">•</span>
                        <span class="ml-2 text-gray-500 text-sm"><?php echo htmlspecialchars($cour->getNiveau()); ?></span>
                    </div>
                    <div class="flex flex-wrap items-center gap-3 py-2">
                        <?php 
                        $tags = $tg->showCourseTags($course['id_course']);
                        foreach ($tags as $tag) {
                            $tg->setNom($tag['nom_tag']) ?>
                            <span class="text-white bg-blue-500 px-2 text-xs rounded-full"># <?php echo htmlspecialchars($tg->getNom()) ?></span>
                        <?php } ?>
                    </div>
                    <h3 class="text-xl font-bold mb-2"><?php echo htmlspecialchars($cour->getTitre()); ?></h3>
                    <p class="text-gray-600 mb-4 line-clamp-2"><?php echo htmlspecialchars($cour->getDescription()); ?></p>
                    <div class="flex items-center mb-4">
                        <img src="../../uploads/<?php echo htmlspecialchars($teacher->getPhoto()); ?>" alt="Instructor" class="w-8 h-8 rounded-full">
                        <span class="ml-2 text-gray-600"><?php echo htmlspecialchars($teacher->getPrenom() . ' ' . $teacher->getNom()); ?></span>
                    </div>
                    <div class="flex items-center justify-center">
                        <form method="POST" action="" class="w-full">
                            <input type="hidden" name="id_course" value="<?php echo htmlspecialchars($course['id_course']); ?>">
                            <button name="subscribe" type="submit" class="font-medium text-white bg-blue-600 w-full py-1 rounded-md hover:bg-blue-800">S'inscrire</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php
                }
            } else {
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