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
    <div class="container mx-auto px-4 py-12 max-w-4xl">
        <!-- Course Header -->
        <header class="text-center mb-12">
            <a href="../student/" class="flex items-center justify-center gap-1 mb-10">
                <img class="w-14" src="../../assets/img/logo.png" alt="Logo de Youdemy Plateforme">
                <h1 class="text-2xl font-semibold">You<span class="text-blue-800">Demy</span></h1>
            </a>
            <div class="bg-gradient-to-r from-purple-600 to-blue-500 text-white px-4 py-2 rounded-full inline-block mb-4">
                <span class="font-semibold">Développement Web</span>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-6 leading-tight">
                Maîtrisez le Développement Web Moderne
            </h1>
            
            <!-- Instructor and Publication Info -->
            <div class="flex justify-center items-center space-x-6 text-gray-600">
                <div class="flex items-center space-x-3">
                    <img src="https://source.unsplash.com/random/100x100?face,men" 
                         alt="Professeur" 
                         class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-md">
                    <div>
                        <p class="font-semibold text-gray-800">Jean Dupont</p>
                        <p class="text-sm">Expert en Développement Web</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <i data-feather="calendar" class="w-5 h-5"></i>
                    <span class="text-sm">15 Janvier 2024</span>
                </div>
            </div>
        </header>

        <!-- Course Cover Image -->
        <div class="mb-12 rounded-2xl overflow-hidden shadow-2xl">
            <img src="https://source.unsplash.com/random/1200x600?web,development" 
                 alt="Course Cover" 
                 class="w-full h-[500px] object-cover">
        </div>

        <!-- Course Overview -->
        <section class="bg-white shadow-lg rounded-xl p-8 mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 border-b-2 border-purple-500 pb-4">
                Description du Cours
            </h2>
            <p class="text-gray-700 leading-relaxed mb-6">
                Ce cours complet vous guidera à travers les dernières technologies de développement web. 
                Vous apprendrez à créer des applications web modernes, responsives et performantes en utilisant 
                les technologies les plus récentes du marché.
            </p>

            <!-- Learning Objectives -->
            <div class="bg-purple-50 rounded-xl p-6">
                <h3 class="text-xl font-semibold mb-4 text-purple-800">
                    Ce que vous allez apprendre
                </h3>
                <ul class="space-y-3">
                    <li class="flex items-center space-x-3">
                        <i data-feather="check-circle" class="text-green-500 w-6 h-6"></i>
                        <span class="text-gray-700">HTML5 & CSS3 avancés</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <i data-feather="check-circle" class="text-green-500 w-6 h-6"></i>
                        <span class="text-gray-700">JavaScript moderne et frameworks</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <i data-feather="check-circle" class="text-green-500 w-6 h-6"></i>
                        <span class="text-gray-700">Développement responsive</span>
                    </li>
                </ul>
            </div>
        </section>

        <!-- Detailed Course Modules -->
        <section class="bg-white shadow-lg rounded-xl p-8 mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 border-b-2 border-purple-500 pb-4">
                Contenu Détaillé du Cours
            </h2>

            <!-- Module 1 -->
            <div class="mb-10">
                <h3 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">
                    <i data-feather="code" class="mr-3 text-purple-500 w-8 h-8"></i>
                    Module 1: Fondamentaux du Développement Web
                </h3>
                <div class="text-gray-700 leading-relaxed space-y-4">
                    <p>
                        Commencez votre parcours avec les bases solides du développement web. 
                        Ce module couvre en profondeur les principes fondamentaux de HTML5 et CSS3.
                    </p>
                    <ul class="list-disc list-inside space-y-2">
                        <li>Structure sémantique des documents HTML</li>
                        <li>Techniques avancées de mise en page avec CSS Grid et Flexbox</li>
                        <li>Design responsive et adaptabilité multi-écrans</li>
                        <li>Optimisation des performances web</li>
                    </ul>
                </div>
            </div>

            <!-- Module 2 -->
            <div class="mb-10">
                <h3 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">
                    <i data-feather="layers" class="mr-3 text-blue-500 w-8 h-8"></i>
                    Module 2: JavaScript Moderne
                </h3>
                <div class="text-gray-700 leading-relaxed space-y-4">
                    <p>
                        Plongez dans le JavaScript contemporain et maîtrisez les techniques 
                        de programmation web côté client.
                    </p>
                    <ul class="list-disc list-inside space-y-2">
                        <li>Syntaxe ES6+ et fonctionnalités avancées</li>
                        <li>Programmation asynchrone avec Promises et Async/Await</li>
                        <li>Manipulation du DOM et événements interactifs</li>
                        <li>Introduction aux frameworks modernes (React, Vue.js)</li>
                    </ul>
                </div>
            </div>

            <!-- Module 3 -->
            <div>
                <h3 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">
                    <i data-feather="smartphone" class="mr-3 text-green-500 w-8 h-8"></i>
                    Module 3: Design Responsive et Mobile-First
                </h3>
                <div class="text-gray-700 leading-relaxed space-y-4">
                    <p>
                        Apprenez à concevoir des interfaces web qui s'adaptent parfaitement 
                        à tous les appareils et tailles d'écran.
                    </p>
                    <ul class="list-disc list-inside space-y-2">
                        <li>Principes du design mobile-first</li>
                        <li>Media queries et breakpoints</li>
                        <li>Techniques de responsive design</li>
                        <li>Optimisation pour différents appareils</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Tags -->
        <section class="bg-white shadow-lg rounded-xl p-6">
            <h3 class="text-xl font-semibold mb-4 border-b pb-2">Mots-clés</h3>
            <div class="flex flex-wrap gap-2">
                <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm">Web</span>
                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">JavaScript</span>
                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Frontend</span>
                <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">Responsive</span>
                <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm">HTML5</span>
                <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm">CSS3</span>
            </div>
        </section>
    </div>

    <script>
        // Initialize Feather Icons
        feather.replace();
    </script>
</body>
</html>
