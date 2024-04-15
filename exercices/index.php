<?php
// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "testdb");
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Validation et insertion des données
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validation de l'email avec une expression régulière
    if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
        displayResponse("Format d'email invalide.");
    }
    // Le mot de passe contient exactement une lettre miniscule, une lettre majuscule, un chiffre: on le specifie avec cette assertion
    elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?!(.*[a-z].*){2,})(?!(.*[A-Z].*){2,})(?!(.*[\d].*){2,})[a-zA-Z\d@#!$%^&*]{8,}$/", $password)) {
        displayResponse("Le mot de passe doit contenir au moins 8 caractères, dont une majuscule, une minuscule, un chiffre et des caracteres speciaux: @#!$%^&*");
    } else {
        // Hachage du mot de passe
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (email, password) VALUES (?, ?)";

        // Requête préparée pour l'insertion sécurisée des données
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $hash);

        if ($stmt->execute()) {
            displayResponse("Nouvel utilisateur enregistré avec succès!");
        } else {
            displayResponse("Erreur lors de l'enregistrement de l'utilisateur.");
        }
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <style>
        form {
            text-align: center;
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px; 
        }
        .response-message {
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f0f0f0;
            text-align: center;
        }

    </style>
</head>
<body>
    <div class="container-form">
        <form method="post">
            <h1>Inscription</h1>
            <label for="email">Email:</label><br>
            <input type="text" name="email" id="email" style="margin-bottom: 10px;"><br>
            <label for="password">Mot de passe:</label><br>
            <input type="password" name="password" id="password" style="margin-bottom: 10px;"><br>
            <input type="submit" value="S'inscrire" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
        </form>
    </div>
    <?php
    function displayResponse($message)
    {
        echo "<div class='response-container'><div class='response-message'>$message</div></div>";
    }
    ?>
</body>
</html>
