<?php
    session_start();
    
    require_once '../../config/db.php';
    require_once '../../config/validator.php';
    require_once '../../classes/user.php';
    
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    if (isset($_SESSION["role"])){
        if($_SESSION['role'] === 'Admin'){
            header("Location: ../admin/dashboard.php");
        }else if($_SESSION['role'] === 'Enseignant'){
            header("Location: ../teacher/dashboard.php");
        }else{
            header("Location: ../student/");
        }
        exit;
    }

    if($_SERVER['REQUEST_METHOD']==='POST'){
        if(isset($_POST['loginBtn'])){
            $email = htmlspecialchars(trim($_POST['email']), ENT_QUOTES, 'UTF-8');
            $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

            if (!Validator::required($email, 'Email') || !Validator::required($password, 'Password')) {
                $alert =  '<script>alert("Veuillez remplir tous les champs.")</script>';
                echo $alert ;
            } else {
                $user = new User("","","",$email,$password,"","","");
    
                $loggedInUser = $user->login((string)$user->getEmail(), (string)$user->getPassword());
    
                if ($loggedInUser) {
                    if($loggedInUser->getStatus() == 'Actif'){
                        $_SESSION['id_user'] = htmlspecialchars($loggedInUser->getId(), ENT_QUOTES, 'UTF-8');
                        $_SESSION['prenom'] = htmlspecialchars($loggedInUser->getPrenom(), ENT_QUOTES, 'UTF-8');
                        $_SESSION['nom'] = htmlspecialchars($loggedInUser->getNom(), ENT_QUOTES, 'UTF-8');
                        $_SESSION['email'] = htmlspecialchars($loggedInUser->getEmail(), ENT_QUOTES, 'UTF-8');
                        $_SESSION['phone'] = htmlspecialchars($loggedInUser->getTelephone(), ENT_QUOTES, 'UTF-8');
                        $_SESSION['role'] = htmlspecialchars($loggedInUser->getRole(), ENT_QUOTES, 'UTF-8');
                        $_SESSION['photo'] = htmlspecialchars($loggedInUser->getPhoto(), ENT_QUOTES, 'UTF-8');
                        $_SESSION['status'] = htmlspecialchars($loggedInUser->getStatus(), ENT_QUOTES, 'UTF-8');

                        if($_SESSION['role'] === 'Admin'){
                            header("Location: ../admin/dashboard.php");
                        } else if($_SESSION['role'] === 'Enseignant'){
                            header("Location: ../teacher/dashboard.php");
                        } else if($_SESSION['role'] === 'Etudiant'){
                            header("Location: ../student");
                        }
                        exit;
                    }else if($loggedInUser->getStatus() == 'Bloqué'){
                        echo '<script>alert("Votre Compte est Bloqué pour le Moment !")</script>';
                    }else{
                        echo '<script>alert("Votre Compte n\'est pas encore Confirmé !")</script>';
                    }
                }
            }
        }
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
</head>
<body class="bg-gray-50 font-sans">

    <section class="min-h-screen flex items-center justify-center px-4 py-8">
        <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-8">
            <div class="text-center mb-8">
                <a href="../guest" class="text-3xl font-bold gradient-text">Youdemy</a>
                <h2 class="mt-4 text-2xl font-semibold text-gray-800">Connectez-vous à votre compte</h2>
            </div>


            <!-- Login Form -->
            <form method="POST" action="" id="loginForm" class="space-y-6">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <div class="mt-1">
                        <input type="email" id="email" name="email" required 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                    <div class="mt-1">
                        <input type="password" id="password" name="password"  
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox" 
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                            Se souvenir de moi
                        </label>
                    </div>
                    <div class="text-sm">
                        <a href="#" class="font-medium text-blue-600 hover:text-blue-500">
                            Mot de passe oublié ?
                        </a>
                    </div>
                </div>
                <div>
                    <button type="submit" name="loginBtn"
                        class="bg-blue-500 w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white duration-500 hover:bg-blue-700">
                        Se connecter
                    </button>
                </div>
            </form>


            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">
                            Pas encore de compte ?
                        </span>
                    </div>
                </div>
                <div class="mt-6">
                    <a href="register.php" 
                        class="w-full flex justify-center py-2 px-4 border border-blue-300 rounded-md shadow-sm text-sm font-medium text-blue-600 hover:bg-blue-50">
                        Créer un compte
                    </a>
                </div>
            </div>
        </div>
    </section>

    <script src="../../assets/js/main.js"></script>
</body>
</html>
