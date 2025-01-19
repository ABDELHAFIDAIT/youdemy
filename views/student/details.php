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

    if(isset($_GET['id'])){
        $id_course = $_GET['id'];
        $course = $cours->getCourse($id_course);
    }

?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy</title>
    <link rel="icon" href="../../assets/img/logo.png">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
</head>
<body class="bg-gray-50 text-gray-900">
    <section class="container mx-auto px-4 py-12 max-w-4xl">
        <!-- Course Header -->
        <header class="text-center mb-12">
            <?php
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
                        $course['nom_categorie'],
                        ''
                    );
            ?>

            
            <a href="../student/" class="flex items-center justify-center gap-1 mb-10">
                <img class="w-14" src="../../assets/img/logo.png" alt="Logo de Youdemy Plateforme">
                <h1 class="text-2xl font-semibold">You<span class="text-blue-800">Demy</span></h1>
            </a>
            <div class="bg-gradient-to-r from-purple-600 to-blue-500 text-white px-4 py-2 rounded-full inline-block mb-4">
                <span class="font-semibold"><?php echo $ctg->getName() ?></span>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-6 leading-tight">
                <?php echo $cour->getTitre() ?>
            </h1>
            
            <!-- Instructor and Publication Info -->
            <div class="flex justify-center items-center space-x-6 text-gray-600">
                <div class="flex items-center space-x-3">
                    <img src="../../uploads/<?php echo $teacher->getPhoto() ?>" 
                         alt="Professeur" 
                         class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-md">
                    <div>
                        <p class="font-semibold text-gray-800"><?php echo $teacher->getPrenom().' '.$teacher->getNom() ?></p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <i data-feather="calendar" class="w-5 h-5"></i>
                    <span class="text-sm"><?php echo $course['date_publication'] ?></span>
                </div>
            </div>
        </header>

        <!-- Course Cover Image -->
        <div class="mb-12 rounded-2xl overflow-hidden shadow-2xl">
            <img src="../../uploads/<?php echo $cour->getCouverture() ?>" 
                 alt="Course Cover" 
                 class="w-full h-[500px] object-cover">
        </div>

        <!-- Course Overview -->
        <section class="bg-white shadow-lg rounded-xl p-8 mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 border-b-2 border-purple-500 pb-4">
                Description du Cours
            </h2>
            <p class="text-gray-700 leading-relaxed mb-6">
                <?php echo $cour->getDescription() ?>
            </p>
        </section>

        <!-- Detailed Course Modules -->
        <section class="bg-white shadow-lg rounded-xl p-8 mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 border-b-2 border-purple-500 pb-4">
                Contenu Détaillé du Cours
            </h2>

            <!-- Text  -->
            <?php if($cour->getContenu() != NULL){ ?>
            <div class="flex justify-between items-center mb-4">
                <a href="<?php echo $cour->getContenu() ?>" target="_blank" class="text-purple-500 hover:underline">
                    Voir en plein écran
                </a>
            </div>
            <div class="mb-10">
                <iframe src="<?php echo $cour->getContenu() ?>" 
                        width="100%" 
                        height="600" 
                        frameborder="0" 
                        allowfullscreen>
                </iframe>
            </div>

            <?php }else{ ?>
            
            <div class="mb-10">
                <video class="w-full" src="../../uploads/<?php echo $cour->getVideo() ?>" controls>

                </video>
            </div>
            
            <?php }?>
        </section>

        <!-- Tags -->
        <section class="bg-white shadow-lg rounded-xl p-6">
            <h3 class="text-xl font-semibold mb-4 border-b pb-2">Mots-clés</h3>
            <div class="flex flex-wrap gap-2">
                <?php 
                $tags = $tg->showCourseTags($course['id_course']);
                foreach ($tags as $tag) {
                    $tg->setNom($tag['nom_tag']) ?>
                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm"><?php echo $tg->getNom() ?></span>
                <?php } ?>
            </div>
        </section>
        
    </section>

    <script>
        // Initialize Feather Icons
        feather.replace();
    </script>
</body>
</html>
