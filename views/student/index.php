<?php

    session_start();

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
    <header>
        <!-- Navbar Section -->
        <nav class="px-5 py-3 flex items-center justify-between gap-5 shadow-md bg-white bg-opacity-90 shadow-lg fixed w-full z-50">
            <a href="#" class="flex items-center gap-1">
                <img class="w-14" src="../../assets/img/logo.png" alt="Logo de Youdemy Plateforme">
                <h1 class="text-2xl font-semibold">You<span class="text-blue-800">Demy</span></h1>
            </a>
            <div class="hidden lg:flex items-center justify-between gap-20">
                <ul class="flex items-center gap-10 text-md">
                    <a href="#"><li class="active cursor-pointer duration-300">Accueil</li></a>
                    <a href="categories.php"><li class="cursor-pointer duration-300 hover:text-blue-600 hover:font-medium hover:border-b-2 hover:border-blue-600 hover:pb-3">Catégories</li></a>
                    <a href="courses.php"><li class="cursor-pointer duration-300 hover:text-blue-600 hover:font-medium hover:border-b-2 hover:border-blue-600 hover:pb-3">Cours</li></a>
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
                <a href="#" class="block py-2 px-4 text-sm hover:bg-blue-600 hover:text-white">Accueil</a>
                <a href="categories.php" class="block py-2 px-4 text-sm hover:bg-blue-600 hover:text-white">Catégories</a>
                <a href="courses.php" class="block py-2 px-4 text-sm hover:bg-blue-600 hover:text-white">Cours</a>
                <a href="contact.php" class="block py-2 px-4 text-sm hover:bg-blue-600 hover:text-white">Contact</a>
                <a href="my_courses.php" class="block py-2 px-4 text-sm hover:bg-blue-600 hover:text-white">Mes Cours</a>
                <button name="disconnect" class="block py-2 px-4 text-sm hover:bg-blue-600 hover:text-white">Déconnexion</button>
            </div>
        </nav>
        
        <!-- Hero Section -->
        <section class="hero h-screen pt-24 flex justify-center items-center text-white text-center">
            <div class="flex flex-col items-center gap-5">
                <h1 class="font-semibold text-4xl">Apprenez Sans Limite</h1>
                <p class="text-xl font-extralight">Découvrez des Dizaines de Cours en Ligne Dispensés par des Experts</p>
                <button class="bg-blue-600 py-1 px-5 text-lg mt-3 rounded-sm duration-500 hover:bg-blue-800 hover:scale-105 hover:px-6">Commencer</button>
            </div>
        </section>  
    </header>

    <main>
        <!-- About Section -->
        <section class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Pourquoi choisir Youdemy ?</h2>
                    <p class="text-gray-600">Une plateforme conçue pour votre réussite</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                        <i class="fas fa-laptop-code text-4xl text-blue-600 mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2">Cours de qualité</h3>
                        <p class="text-gray-600">Des cours créés par des experts de l'industrie.</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                        <i class="fas fa-clock text-4xl text-blue-600 mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2">Apprentissage flexible</h3>
                        <p class="text-gray-600">Apprenez à votre rythme, où que vous soyez.</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                        <i class="fas fa-certificate text-4xl text-blue-600 mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2">Certificats reconnus</h3>
                        <p class="text-gray-600">Obtenez des certificats validés par l'industrie.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Categories Section -->
        <section class="py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-center mb-16">Explorez nos catégories</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                        <div class="bg-blue-600 h-2"></div>
                        <div class="p-6">
                            <i class="fas fa-code text-3xl text-blue-600 mb-4"></i>
                            <h3 class="text-xl font-semibold mb-2">Développement</h3>
                            <p class="text-gray-600">Web, Mobile, DevOps</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                        <div class="bg-blue-600 h-2"></div>
                        <div class="p-6">
                            <i class="fas fa-chart-line text-3xl text-blue-600 mb-4"></i>
                            <h3 class="text-xl font-semibold mb-2">Business</h3>
                            <p class="text-gray-600">Marketing, Finance, Entrepreneuriat</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                        <div class="bg-blue-600 h-2"></div>
                        <div class="p-6">
                            <i class="fas fa-palette text-3xl text-blue-600 mb-4"></i>
                            <h3 class="text-xl font-semibold mb-2">Design</h3>
                            <p class="text-gray-600">UI/UX, Graphisme, 3D</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                        <div class="bg-blue-600 h-2"></div>
                        <div class="p-6">
                            <i class="fas fa-brain text-3xl text-blue-600 mb-4"></i>
                            <h3 class="text-xl font-semibold mb-2">Data Science</h3>
                            <p class="text-gray-600">IA, Machine Learning, Big Data</p>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end items-center mt-8 mr-5">
                    <a href="categories.php" class="flex items-center gap-3 text-lg font-medium text-blue-500 hover:text-blue-800">Voir Plus <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </section>

        <!-- Courses Section -->
        <section class="py-10 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-center mb-16">Cours populaires</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Course 1 -->
                    <div class="course-card bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="relative">
                            <img src="https://cdn.mindmajix.com/courses/javascript-training-120620.png" alt="Course" class="w-full h-48 object-cover">
                            <div class="absolute top-0 right-0 bg-blue-600 text-white px-3 py-1 m-2 rounded-full text-sm">
                                Populaire
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">JavaScript Moderne</h3>
                            <p class="text-gray-600 mb-4">Maîtrisez JavaScript de zéro à expert</p>
                            <div class="flex items-center justify-between">
                                <span class="text-blue-600 font-bold">Développement</span>
                                <div class="flex items-center">
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <span class="ml-1">4.8</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Course 2 -->
                    <div class="course-card bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="relative">
                            <img src="https://media.geeksforgeeks.org/wp-content/cdn-uploads/20210215160315/FREE-Python-Course-For-Beginners.png" alt="Course" class="w-full h-48 object-cover">
                            <div class="absolute top-0 right-0 bg-blue-600 text-white px-3 py-1 m-2 rounded-full text-sm">
                                Populaire
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">Python pour Data Science</h3>
                            <p class="text-gray-600 mb-4">Analyse de données et visualisation</p>
                            <div class="flex items-center justify-between">
                                <span class="text-blue-600 font-bold">Data Science</span>
                                <div class="flex items-center">
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <span class="ml-1">4.9</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Course 3 -->
                    <div class="course-card bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="relative">
                            <img src="https://media.licdn.com/dms/image/v2/D4D12AQG_Q-OQ8Qqisg/article-cover_image-shrink_720_1280/article-cover_image-shrink_720_1280/0/1680181974410?e=2147483647&v=beta&t=TMXqJDFZorHs9XsK882PXpH58nK6mvtYBGD5kxJT2DI" alt="Course" class="w-full h-48 object-cover">
                            <div class="absolute top-0 right-0 bg-blue-600 text-white px-3 py-1 m-2 rounded-full text-sm">
                                Populaire
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">UI/UX Design</h3>
                            <p class="text-gray-600 mb-4">Créez des interfaces modernes</p>
                            <div class="flex items-center justify-between">
                                <span class="text-blue-600 font-bold">Design</span>
                                <div class="flex items-center">
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <span class="ml-1">4.7</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end items-center mt-8 mr-5">
                    <a href="courses.php" class="flex items-center gap-3 text-lg font-medium text-blue-500 hover:text-blue-800">Voir Plus <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </section>

        <!-- Top Instructors Section -->
        <section class="py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-center mb-16">Nos meilleurs professeurs</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Instructor 1 -->
                    <div class="text-center">
                        <div class="relative mb-4">
                            <div class="instructor-image">
                                <img src="https://images.unsplash.com/photo-1700156246325-65bbb9e1dc0d?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8dGVhY2hlcnxlbnwwfDF8MHx8fDI%3D" alt="Instructor" class="w-32 h-32 rounded-full mx-auto">
                            </div>
                            <div class="absolute bottom-0 right-1/3 bg-blue-600 text-white p-2 rounded-full animate-pulse">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold">Sarah Martin</h3>
                        <p class="text-gray-600">Expert en Web Development</p>
                    </div>
                    <!-- Instructor 2 -->
                    <div class="text-center">
                        <div class="relative mb-4">
                            <div class="instructor-image">
                                <img src="https://images.unsplash.com/photo-1700156246325-65bbb9e1dc0d?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8dGVhY2hlcnxlbnwwfDF8MHx8fDI%3D" alt="Instructor" class="w-32 h-32 rounded-full mx-auto">
                            </div>
                            <div class="absolute bottom-0 right-1/3 bg-blue-600 text-white p-2 rounded-full animate-pulse">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold">John Doe</h3>
                        <p class="text-gray-600">Expert en Data Science</p>
                    </div>
                    <!-- Instructor 3 -->
                    <div class="text-center">
                        <div class="relative mb-4">
                            <div class="instructor-image">
                                <img src="https://images.unsplash.com/photo-1700156246325-65bbb9e1dc0d?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8dGVhY2hlcnxlbnwwfDF8MHx8fDI%3D" alt="Instructor" class="w-32 h-32 rounded-full mx-auto">
                            </div>
                            <div class="absolute bottom-0 right-1/3 bg-blue-600 text-white p-2 rounded-full animate-pulse">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold">Emma Wilson</h3>
                        <p class="text-gray-600">Expert en UI/UX Design</p>
                    </div>
                    <!-- Instructor 4 -->
                    <div class="text-center">
                        <div class="relative mb-4">
                            <div class="instructor-image">
                                <img src="https://images.unsplash.com/photo-1700156246325-65bbb9e1dc0d?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8dGVhY2hlcnxlbnwwfDF8MHx8fDI%3D" alt="Instructor" class="w-32 h-32 rounded-full mx-auto">
                            </div>
                            <div class="absolute bottom-0 right-1/3 bg-blue-600 text-white p-2 rounded-full animate-pulse">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold">Alex Chen</h3>
                        <p class="text-gray-600">Expert en Mobile Dev</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-center mb-16">Ce que disent nos étudiants</h2>
                <div class="testimonials-carousel relative">
                    <div class="testimonials-container overflow-hidden">
                        <div class="testimonials-track flex transition-transform duration-500">
                            <!-- Testimonial 1 -->
                            <div class="testimonial-card min-w-full md:min-w-[33.333%] p-4">
                                <div class="bg-white p-6 rounded-lg shadow-lg">
                                    <div class="flex items-center mb-4">
                                        <img src="../../uploads/user.png" alt="Student" class="w-12 h-12 rounded-full">
                                        <div class="ml-4">
                                            <h4 class="font-semibold">Marie Dubois</h4>
                                            <div class="flex text-yellow-400">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-gray-600">"Une excellente plateforme pour apprendre. Les cours sont bien structurés et les instructeurs."</p>
                                </div>
                            </div>
                            <!-- Testimonial 2 -->
                            <div class="testimonial-card min-w-full md:min-w-[33.333%] p-4">
                                <div class="bg-white p-6 rounded-lg shadow-lg">
                                    <div class="flex items-center mb-4">
                                        <img src="../../uploads/user.png" alt="Student" class="w-12 h-12 rounded-full">
                                        <div class="ml-4">
                                            <h4 class="font-semibold">Pierre Martin</h4>
                                            <div class="flex text-yellow-400">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-gray-600">"J'ai pu changer de carrière grâce aux cours sur Youdemy. Le contenu est vraiment de qualité professionnelle."</p>
                                </div>
                            </div>
                            <!-- Testimonial 3 -->
                            <div class="testimonial-card min-w-full md:min-w-[33.333%] p-4">
                                <div class="bg-white p-6 rounded-lg shadow-lg">
                                    <div class="flex items-center mb-4">
                                        <img src="../../uploads/user.png" alt="Student" class="w-12 h-12 rounded-full">
                                        <div class="ml-4">
                                            <h4 class="font-semibold">Sophie Bernard</h4>
                                            <div class="flex text-yellow-400">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-gray-600">"La flexibilité de l'apprentissage et la qualité des cours sont exceptionnelles. Je recommande vivement!"</p>
                                </div>
                            </div>
                            <!-- Testimonial 4 -->
                            <div class="testimonial-card min-w-full md:min-w-[33.333%] p-4">
                                <div class="bg-white p-6 rounded-lg shadow-lg">
                                    <div class="flex items-center mb-4">
                                        <img src="../../uploads/user.png" alt="Student" class="w-12 h-12 rounded-full">
                                        <div class="ml-4">
                                            <h4 class="font-semibold">Lucas Petit</h4>
                                            <div class="flex text-yellow-400">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-gray-600">"Les projets pratiques m'ont permis d'acquérir une véritable expérience. Une formation complète et professionnelle."</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Navigation Buttons -->
                    <button class="testimonial-prev absolute top-1/2 -left-4 transform -translate-y-1/2 bg-blue-600 text-white w-10 h-10 rounded-full flex items-center justify-center shadow-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="testimonial-next absolute top-1/2 -right-4 transform -translate-y-1/2 bg-blue-600 text-white w-10 h-10 rounded-full flex items-center justify-center shadow-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    <!-- Dots Navigation -->
                    <div class="testimonial-dots flex justify-center mt-8 space-x-2">
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include_once '../../includes/footer.php'; ?>


    <script src="../../assets/js/main.js"></script>
</body>
</html>