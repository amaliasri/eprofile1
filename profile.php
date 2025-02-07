<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header('Location: index.php');
    exit;
}

include 'includes/db.php';

$id = $_GET['id'] ?? 0;

$sql = "SELECT * FROM profiles WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

$profile = $result->fetch_assoc();

$stmt->close();
$conn->close();

if (!$profile) {
    header('Location: profiles.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $profile['name']; ?> - Student E-Profile</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
		    <link href="styles.css" rel="stylesheet">
</head>
<body class="bg-light">
    <?php include 'includes/header.php'; ?>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3><?php echo $profile['name']; ?></h3>
            </div>
            <div class="card-body">
			<img src="<?php echo htmlspecialchars($profile['image_path']); ?>" 
             width="128" 
             height="128" 
             class="rounded-circle mb-3"
             alt="<?php echo htmlspecialchars($profile['name']); ?>'s profile picture">
                <p><strong>Course :</strong> <?php echo $profile['course']; ?></p>
                <p><strong>Email :</strong> <?php echo $profile['email']; ?></p>
                <p><strong>Phone :</strong> <?php echo $profile['phone']; ?></p>
                <a href="profiles.php" class="btn btn-secondary">Back to Profiles</a>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>