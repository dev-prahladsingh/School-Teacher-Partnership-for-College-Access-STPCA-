<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page with Loader</title>
    <style>
  /* Loader styling */
        .loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            display: none; /* Initially hidden */
            align-items: center; /* Center items vertically */
            justify-content: center; /* Center items horizontally */
            flex-direction: column; /* Arrange children vertically */
            z-index: 9999;
            font-family: 'Arial', sans-serif;
        }

        .spinner {
            border: 8px solid rgba(255, 255, 255, 0.3); /* Light transparent background */
            border-top: 8px solid #3498db; /* Blue spinner */
            border-radius: 50%; /* Circular spinner */
            width: 60px;
            height: 60px;
            animation: spin 1.5s linear infinite;
        }

        .loader-text {
            margin-top: 20px; /* Space between spinner and text */
            font-size: 20px;
            font-weight: bold;
        }

        /* Spinner animation */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>

    <!-- Loader -->
    <div id="loader" class="loader">
        <div class="spinner"></div><br>
        <p>Redirecting.....</p>
    </div>


    <script>
document.addEventListener('DOMContentLoaded', function () {
    var redirectLink = document.getElementById('redirect-link');
    var loader = document.getElementById('loader');

    redirectLink.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent default anchor behavior
        loader.style.display = 'flex'; // Show the loader
        setTimeout(function () {
            window.location.href = redirectLink.href; // Redirect after delay
        }, 500); // Adjust delay as needed
    });
});

</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var redirectLink = document.getElementById('redirect-link1');
    var loader = document.getElementById('loader');

    redirectLink.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent default anchor behavior
        loader.style.display = 'flex'; // Show the loader
        setTimeout(function () {
            window.location.href = redirectLink.href; // Redirect after delay
        }, 500); // Adjust delay as needed
    });
});

</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var redirectLink = document.getElementById('redirect-link2');
    var loader = document.getElementById('loader');

    redirectLink.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent default anchor behavior
        loader.style.display = 'flex'; // Show the loader
        setTimeout(function () {
            window.location.href = redirectLink.href; // Redirect after delay
        }, 500); // Adjust delay as needed
    });
});

</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var redirectLink = document.getElementById('redirect-link3');
    var loader = document.getElementById('loader');

    redirectLink.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent default anchor behavior
        loader.style.display = 'flex'; // Show the loader
        setTimeout(function () {
            window.location.href = redirectLink.href; // Redirect after delay
        }, 500); // Adjust delay as needed
    });
});

</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var redirectLink = document.getElementById('redirect-link4');
    var loader = document.getElementById('loader');

    redirectLink.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent default anchor behavior
        loader.style.display = 'flex'; // Show the loader
        setTimeout(function () {
            window.location.href = redirectLink.href; // Redirect after delay
        }, 500); // Adjust delay as needed
    });
});

</script>
</body>
</html>
