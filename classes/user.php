<?php
require_once __DIR__ . './../config/db.php';
require_once __DIR__ . './../config/validator.php';

class User {
    protected int | null $id;
    protected string | null $nom;
    protected string | null $prenom;
    protected string | null $telephone;
    protected string | null $email;
    protected string | null $password;
    protected string | null $role;
    protected string | null $photo;
    protected string | null $status;
    protected $database;

    public function __construct($nom,$prenom,$telephone,$email,$password,$role,$status,$photo) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->telephone = $telephone;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->status = $status;
        $this->photo = $photo;
        $this->database = Database::getInstance()->getConnection();
    }

    // GETTERS
    public function getId(): int {
        return $this->id;
    }
    public function getNom(): string {
        return $this->nom;
    }
    public function getPrenom(): string {
        return $this->prenom;
    }
    public function getTelephone(): string {
        return $this->telephone;
    }
    public function getEmail(): string {
        return $this->email;
    }
    public function getPassword(): string {
        return $this->password;
    }
    public function getRole(): string {
        return $this->role;
    }
    public function getPhoto(): string {
        return $this->photo;
    }
    public function getStatus(): string {
        return $this->status;
    }

    // SETTERS
    public function setNom(string $nom): void {
        $this->nom = $nom;
    }
    public function setPrenom(string $prenom): void {
        $this->prenom = $prenom;
    }
    public function setTelephone(string $telephone): void {
        $this->telephone = $telephone;
    }
    public function setEmail(string $email): void {
        $this->email = $email;
    }
    public function setPassword(string $password): void {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
    public function setRole(string $role): void {
        $this->role = $role;
    }
    public function setStatus(string $status): void {
        $this->status = $status;
    }


    // LOGIN FUNCTION
    public function login(string $email, string $password) {
        try {
            $query = "SELECT * FROM users U JOIN roles R ON U.id_role = R.id_role WHERE email = :email";
            $stmt = $this->database->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if (password_verify($password, $row['password'])) {
                    $this->id = $row['id_user'];
                    $this->prenom = $row['prenom'];
                    $this->nom = $row['nom'];
                    $this->email = $row['email'];
                    $this->telephone = $row['phone'];
                    $this->role = $row['label'];
                    $this->photo = $row['photo'];
                    $this->status = $row['statut'];

                    return $this;
                } else {
                    echo '<script>alert("Le mot de passe est incorrect !")</script>';
                    return false;
                }
            } else {
                echo '<script>alert("Aucun utilisateur trouvé avec cet email !")</script>';
                return false;
            }
        } catch (PDOException $e) {
            echo '<script>alert("Erreur lors de l\'authentification : ' . $e->getMessage() . '")</script>';
            return false;
        }
    }


    // SIGNUP FUNCTION
    public function register(string $nom, string $prenom, string $phone, string $email, string $password, int $role){
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        
        if($stmt->rowCount() > 0){
            die('<script>alert("Email déjà Utilisé !")</script>');
        }
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        try {
            $test = $this->database;
            $stmt = $test->prepare("INSERT INTO users (prenom, nom, phone, email, password, id_role, statut) VALUES (:prenom, :nom, :phone, :email, :pw , :role, :statut)");
            $stmt->bindParam(":prenom", $prenom, PDO::PARAM_STR);
            $stmt->bindParam(":nom", $nom, PDO::PARAM_STR);
            $stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":pw", $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(":role", $role, PDO::PARAM_STR);
            if($role == 2){
                $stmt->bindValue(":statut", 'Actif', PDO::PARAM_STR);
            }else{
                $stmt->bindValue(":statut", 'En Attente', PDO::PARAM_STR);
            }
    
            $stmt->execute();
    
        } catch (PDOException $e) {
            return "Erreur lors de l'inscription : " . $e->getMessage();
        }
    }
}