
<?php 
include ('../app/config.php');

$email = $_POST['email'];
$user_password = $_POST['user_password'];


$sql = "SELECT * FROM users WHERE email = :email AND user_state = 1"; 
$query = $pdo->prepare($sql);
$query->bindParam(':email', $email);
$query->execute();

$users = $query->fetchAll(PDO::FETCH_ASSOC);

if (count(value: $users) > 0) {
    $user_password_table = $users[0]['user_password'];

    if (password_verify(password: $user_password, hash: $user_password_table)) {
        session_start();
        $_SESSION['message'] = "Bienvenido al sistema";
        $_SESSION['icon'] = "success";
        $_SESSION['session_email'] = $email;
        header(header: 'Location: ' . APP_URL . "/admin");
        exit(); 
    } else {
        session_start();
        $_SESSION['message'] = "Credenciales incorrectas. Por favor, inténtalo de nuevo.";
        $_SESSION['icon'] = "error";
        header(header: 'Location: ' . APP_URL . "/login");
        exit(); 
    }
} else {
    session_start();
    $_SESSION['message'] = "Credenciales incorrectas. Por favor, inténtalo de nuevo.";
    header(header: 'Location: ' . APP_URL . "/login");
    $_SESSION['icon'] = "error";
    exit(); 
}
?>