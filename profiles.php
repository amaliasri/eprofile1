<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header('Location: index.php');
    exit;
}

include 'includes/db.php';

$sql = "SELECT * FROM profiles";
$result = $conn->query($sql);

$profiles = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $profiles[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profiles - Student E-Profile</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
		    <link href="styles.css" rel="stylesheet">
</head>
<body class="bg-light">
    <?php include 'includes/header.php'; ?>
    <div class="container mt-5">
        <h2 class="text-center mb-4">UiTM Student Profiles</h2>
        <div class="row">
            <?php foreach ($profiles as $profile): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow">
                        <div class="card-body">
						<img src="<?php echo htmlspecialchars($profile['image_path']); ?>" 
             width="128" 
             height="128" 
             class="rounded-circle mb-3"
             alt="<?php echo htmlspecialchars($profile['name']); ?>'s profile picture">
                            <h5 class="card-title"><?php echo $profile['name']; ?></h5>
                            <p class="card-text">Course : <?php echo $profile['course']; ?></p>
                            <a href="profile.php?id=<?php echo $profile['id']; ?>" class="btn btn-primary">View Profile</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>