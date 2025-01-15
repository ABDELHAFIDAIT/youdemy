<?php
require_once __DIR__ . './../config/db.php';
require_once __DIR__ . './../config/validator.php';

class User {
    protected int $id;
    protected string $nom;
    protected string $prenom;
    protected string $telephone;
    protected string $email;
    protected string $password;
    protected string $role;
    protected string $photo;
    protected string $status;
    protected $database;

    public function __construct() {
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

}