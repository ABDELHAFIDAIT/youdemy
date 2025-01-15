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
            <form id="registerForm" class="space-y-6">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="firstName" class="block text-sm font-medium text-gray-700">Prénom</label>
                        <div class="mt-1">
                            <input type="text" id="firstName" name="firstName" required 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                    <div>
                        <label for="lastName" class="block text-sm font-medium text-gray-700">Nom</label>
                        <div class="mt-1">
                            <input type="text" id="lastName" name="lastName" required 
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
                    <button type="submit" 
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
</body>
</html>
