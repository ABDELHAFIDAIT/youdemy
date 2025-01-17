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
            <a href="../student/" class="flex items-center gap-1">
                <img class="w-14" src="../../assets/img/logo.png" alt="Logo de Youdemy Plateforme">
                <h1 class="text-2xl font-semibold">You<span class="text-blue-800">Demy</span></h1>
            </a>
            <div class="hidden lg:flex items-center justify-between gap-20">
                <ul class="flex items-center gap-10 text-md">
                    <a href="../student/"><li class="cursor-pointer duration-300 hover:text-blue-600 hover:font-medium hover:border-b-2 hover:border-blue-600 hover:pb-3">Accueil</li></a>
                    <a href="categories.php"><li class="cursor-pointer duration-300 hover:text-blue-600 hover:font-medium hover:border-b-2 hover:border-blue-600 hover:pb-3">Catégories</li></a>
                    <a href="courses.php"><li class="cursor-pointer duration-300 hover:text-blue-600 hover:font-medium hover:border-b-2 hover:border-blue-600 hover:pb-3">Cours</li></a>
                    <a href="#"><li class="active cursor-pointer duration-300">Contact</li></a>
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
                <a href="courses.php" class="block py-2 px-4 text-sm hover:bg-blue-600 hover:text-white">Catégories</a>
                <a href="courses.php" class="block py-2 px-4 text-sm hover:bg-blue-600 hover:text-white">Cours</a>
                <a href="#" class="block py-2 px-4 text-sm hover:bg-blue-600 hover:text-white">Contact</a>
                <a href="my_courses.php" class="block py-2 px-4 text-sm hover:bg-blue-600 hover:text-white">Mes Cours</a>
                <form method="POST">
                    <button name="disconnect" class="block py-2 px-4 text-sm hover:bg-blue-600 hover:text-white">Déconnexion</button>
                </form>
            </div>
        </nav>
    </header>

    <main>

        <!-- Contact Section -->
        <section class="pt-24 bg-gradient-to-r from-blue-600 to-blue-400 relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 py-16 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <!-- Contact Information -->
                    <div class="text-white">
                        <h1 class="text-4xl md:text-5xl font-bold mb-6 animate-fade-in">Contactez-nous</h1>
                        <p class="text-xl mb-8 animate-fade-in">Nous sommes là pour vous aider. N'hésitez pas à nous contacter pour toute question.</p>
                        
                        <div class="space-y-6">
                            <div class="flex items-center space-x-4 animate-fade-in" style="animation-delay: 0.2s">
                                <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center">
                                    <i class="fas fa-map-marker-alt text-2xl"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-lg">Adresse</h3>
                                    <p class="text-blue-100">123 Rue du Commerce, 75015 Paris</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-4 animate-fade-in" style="animation-delay: 0.3s">
                                <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center">
                                    <i class="fas fa-phone text-2xl"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-lg">Téléphone</h3>
                                    <p class="text-blue-100">+33 1 23 45 67 89</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-4 animate-fade-in" style="animation-delay: 0.4s">
                                <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center">
                                    <i class="fas fa-envelope text-2xl"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-lg">Email</h3>
                                    <p class="text-blue-100">contact@youdemy.com</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-12">
                            <h3 class="font-semibold text-lg mb-4">Suivez-nous</h3>
                            <div class="flex space-x-4">
                                <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-white/20 transition-colors">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-white/20 transition-colors">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-white/20 transition-colors">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-white/20 transition-colors">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="bg-white rounded-2xl shadow-2xl p-8 animate-fade-in" style="animation-delay: 0.5s">
                        <form id="contact-form" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="form-group">
                                    <label class="block text-gray-700 font-medium mb-2" for="first-name">Prénom</label>
                                    <input type="text" id="first-name" name="first-name" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" required>
                                </div>
                                <div class="form-group">
                                    <label class="block text-gray-700 font-medium mb-2" for="last-name">Nom</label>
                                    <input type="text" id="last-name" name="last-name" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="block text-gray-700 font-medium mb-2" for="email">Email</label>
                                <input type="email" id="email" name="email" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" required>
                            </div>

                            <div class="form-group">
                                <label class="block text-gray-700 font-medium mb-2" for="subject">Sujet</label>
                                <select id="subject" name="subject" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" required>
                                    <option value="">Sélectionnez un sujet</option>
                                    <option value="general">Question générale</option>
                                    <option value="support">Support technique</option>
                                    <option value="billing">Facturation</option>
                                    <option value="partnership">Partenariat</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="block text-gray-700 font-medium mb-2" for="message">Message</label>
                                <textarea id="message" name="message" rows="5" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" required></textarea>
                            </div>

                            <button type="submit" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition-colors flex items-center justify-center space-x-2">
                                <span>Envoyer le message</span>
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 1440 320\"%3E%3Cpath fill=\"%23ffffff\" fill-opacity=\"0.05\" d=\"M0,96L48,112C96,128,192,160,288,186.7C384,213,480,235,576,213.3C672,192,768,128,864,128C960,128,1056,192,1152,208C1248,224,1344,192,1392,176L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z\"%3E%3C/path%3E%3C/svg%3E')] bg-cover bg-center opacity-20"></div>
        </section>

        <!-- Map Section -->
        <section class="py-16">
            <div class="max-w-7xl mx-auto px-4">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2625.476145276428!2d2.2922926!3d48.8417145!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6707980bd3947%3A0xd54fb6c5e1933333!2s123%20Rue%20du%20Commerce%2C%2075015%20Paris!5e0!3m2!1sfr!2sfr!4v1642152435289!5m2!1sfr!2sfr"
                        width="100%" 
                        height="450" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </section>

    </main>

    <?php include_once '../../includes/footer.php'; ?>


    <script src="../../assets/js/main.js"></script>
</body>
</html>