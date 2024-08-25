<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quick Links</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    width: 80%;
    max-width: 1200px;
    text-align: center;
}

h1 {
    margin-bottom: 20px;
    font-size: 2.5em;
    color: #333;
}

.card-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.card {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin: 10px;
    width: 300px;
    transition: transform 0.2s;
}

.card:hover {
    transform: translateY(-10px);
}

.card-content {
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card h2 {
    font-size: 1.5em;
    color: #333;
}

.forward-icon {
    color: #007BFF;
    font-size: 1.5em;
    text-decoration: none;
}

.forward-icon:hover {
    color: #0056b3;
}

    </style>
</head>
<body>
    <div class="container">
        <h1>Quick Links</h1>
        <div class="card-container">
            <?php
            // Sample links array
            $links = [
                ["title" => "Deeksha Form", "url" => "guest_allotment.php"],
                ["title" => "Others Form", "url" => "other.php"]
               
            ];

            foreach ($links as $link) {
                echo '
                <div class="card">
                    <div class="card-content">
                        <h2>' . $link["title"] . '</h2>
                        <a href="' . $link["url"] . '" class="forward-icon"><i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                ';
            }
            ?>
        </div>
    </div>
</body>
</html>
