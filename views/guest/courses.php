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
            <div class="flex items-center gap-1">
                <img class="w-14" src="../../assets/img/logo.png" alt="Logo de Youdemy Plateforme">
                <h1 class="text-2xl font-semibold">You<span class="text-blue-800">Demy</span></h1>
            </div>
            <div class="hidden lg:flex items-center justify-between gap-20">
                <ul class="flex items-center gap-10 text-md">
                    <a href="index.php"><li class="cursor-pointer duration-300 hover:text-blue-600 hover:font-medium hover:border-b-2 hover:border-blue-600 hover:pb-3">Accueil</li></a>
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
                <a href="#" class="block py-2 px-4 text-sm hover:bg-blue-600 hover:text-white">Accueil</a>
                <a href="#" class="block py-2 px-4 text-sm hover:bg-blue-600 hover:text-white">Catégories</a>
                <a href="#" class="block py-2 px-4 text-sm hover:bg-blue-600 hover:text-white">Cours</a>
                <a href="#" class="block py-2 px-4 text-sm hover:bg-blue-600 hover:text-white">Contact</a>
                <a href="#" class="block py-2 px-4 text-sm hover:bg-blue-600 hover:text-white">Connexion</a>
                <a href="#" class="block py-2 px-4 text-sm hover:bg-blue-600 hover:text-white">Inscription</a>
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

    <main class="py-16 px-5">
    </main>

    <?php include_once '../../includes/footer.php'; ?>


    <script src="../../assets/js/main.js"></script>
</body>
</html>