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

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // if (isset($_POST['registerBtn'])) {
            $nom = htmlspecialchars($_POST['nom'], ENT_QUOTES, 'UTF-8');
            $prenom = htmlspecialchars($_POST['prenom'], ENT_QUOTES, 'UTF-8');
            $phone = htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8');
            $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
            $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
            $role = htmlspecialchars($_POST['role'], ENT_QUOTES, 'UTF-8');

            switch (true){
                case !Validator::required($nom, 'Nom') 
                    || !Validator::required($prenom, 'Prenom')
                    || !Validator::required($phone, 'Numéro de Téléphone')
                    || !Validator::required($email, 'Email')
                    || !Validator::required($password, 'Password'):
                        $error_message = "Veuillez remplir tous les champs.";
                        break;
                case !Validator::minLength($nom,2,'Nom')
                    || !Validator::maxLength($nom,20,'Nom'):
                    echo'<script>alert("le Nom doit contenir au moins 3 caractères et 20 caractères au max !")</script>';
                    break;
                case !Validator::minLength($prenom,2,'Prenom') 
                    || !Validator::maxLength($prenom,20,'Prenom'):
                    echo'<script>alert("le Prenom doit contenir au moins 3 caractères !")</script>';
                    break;
                case !Validator::validateEmail($email):
                    echo '<script>alert("Email entré est invalide !")</script>';
                    break;
                case !Validator::validatePassword($password):
                    echo '<script>alert("Le mot de passe doit contenir au moins une lettre minuscule, une lettre majuscule, un chiffre et un caractère spécial.")</script>';
                    break;
                default :
                    $user = new User($nom,$prenom,$phone,$email,$password,$role,"","");
                    $user->register($user->getNom(), $user->getPrenom(), $user->getTelephone(), $user->getEmail(), $user->getPassword(), $user->getRole());
                    header("location: ./login.php");
                    break;
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
                <h2 class="mt-4 text-2xl font-semibold text-gray-800">Créez votre compte</h2>
            </div>

            <?php if (isset($error_message)): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Erreur!</strong>
                    <span class="block sm:inline"><?php echo $error_message; ?></span>
                </div>
            <?php endif; ?>
            <!-- Register Form -->
            <form method="POST" action="" id="registerForm" class="space-y-6">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom</label>
                        <div class="mt-1">
                            <input type="text" id="firstName" name="prenom" required 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                    <div>
                        <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                        <div class="mt-1">
                            <input type="text" id="lastName" name="nom" required 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                    <div class="mt-1">
                        <input type="tel" id="phone" name="phone" required 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700">Rôle</label>
                    <div class="mt-1">
                        <select name="role" id="role" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="2">Etudiant</option>
                            <option value="3">Enseignat</option>
                        </select>
                    </div>
                </div>
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
                        <input type="password" id="password" name="password" required 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <div>
                    <div class="flex items-center">
                        <input id="terms" name="terms" type="checkbox" required
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="terms" class="ml-2 block text-sm text-gray-900">
                            J'accepte les conditions d'utilisation et la politique de confidentialité
                        </label>
                    </div>
                </div>
                <div>
                    <button type="submit" name="registerBtn"
                        class="bg-blue-500 w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white duration-500 hover:bg-blue-700">
                        Créer un compte
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
                            Déjà un compte ?
                        </span>
                    </div>
                </div>
                <div class="mt-6">
                    <a href="login.php" 
                        class="w-full flex justify-center py-2 px-4 border border-blue-300 rounded-md shadow-sm text-sm font-medium text-blue-600 hover:bg-blue-50">
                        Se connecter
                    </a>
                </div>
            </div>
        </div>
    </section>

    <script src="../../assets/js/main.js"></script>
</body>
</html>
