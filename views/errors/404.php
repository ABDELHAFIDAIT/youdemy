<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Introuvable</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'bounce-slow': 'bounce 2s infinite',
                        'pulse-slow': 'pulse 2s infinite',
                    },
                    keyframes: {
                        bounce: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        pulse: {
                            '0%, 100%': { transform: 'scale(1)' },
                            '50%': { transform: 'scale(1.05)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-purple-600 to-blue-500 min-h-screen flex items-center justify-center overflow-hidden">
    <div class="container mx-auto px-4 text-center relative">
        <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-3xl p-8 md:p-16 shadow-2xl max-w-2xl mx-auto">
            <h1 class="text-9xl font-bold text-white mb-4 animate-bounce-slow">
                404
            </h1>
            <h2 class="text-4xl font-semibold text-white mb-6 animate-pulse">
                Oups ! Page Introuvable
            </h2>
            <p class="text-xl text-white opacity-80 mb-8 max-w-md mx-auto">
                La page que vous recherchez semble avoir disparu dans le néant numérique. 
                Ne vous inquiétez pas, nous pouvons vous aider à retrouver votre chemin.
            </p>
            <?php

            session_start();
            
            if(isset($_SESSION['id_user']) && isset($_SESSION['role'])){
                if($_SESSION['role'] == 'Admin'){
                    $path = '../admin/dashboard.php';
                }else if($_SESSION['role'] == 'Enseignant'){
                    $path = '../teacher/dashboard.php';
                }else if($_SESSION['role'] == 'Etudiant'){
                    $path = '../student/index.php';
                }
            }else{
                $path = '../../index.php';
            }
            
            ?>
            <a href="<?php echo $path ?>" class="inline-block bg-white text-purple-600 font-semibold py-3 px-8 rounded-full 
                hover:bg-purple-50 transition duration-300 ease-in-out transform 
                hover:-translate-y-1 hover:scale-110 shadow-lg animate-pulse-slow">
                Retour à l'Accueil
            </a>
        </div>

        <!-- Floating Elements -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute w-32 h-32 bg-white bg-opacity-10 rounded-full animate-float top-10 left-10"></div>
            <div class="absolute w-24 h-24 bg-white bg-opacity-10 rounded-full animate-float top-1/2 right-20"></div>
            <div class="absolute w-16 h-16 bg-white bg-opacity-10 rounded-full animate-float bottom-20 left-1/3"></div>
        </div>
    </div>

    <script>
        // Additional floating elements animation
        function createFloatingElements() {
            const container = document.body;
            for (let i = 0; i < 15; i++) {
                const element = document.createElement('div');
                element.classList.add('absolute', 'bg-white', 'bg-opacity-5', 'rounded-full', 'animate-float');
                
                const size = Math.random() * 50 + 10;
                element.style.width = `${size}px`;
                element.style.height = `${size}px`;
                
                element.style.left = `${Math.random() * 100}%`;
                element.style.top = `${Math.random() * 100}%`;
                
                container.appendChild(element);
            }
        }

        createFloatingElements();
    </script>
</body>
</html>
