<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="Styles/index.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body style="background-color: rgb(215, 236, 254);">
    <div class="container topic ">
        <h1> INTE 22242 - Assignment 02 </h1>
    </div>

    <!-- Login Form Container -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="login-container">
                    <!-- Login Header -->
                    <h2>Login</h2>
                    <!-- Login Form -->
                    <form class="login-form" action="Middleware/login.php" method="post">
                        <!-- Username Input -->
                        <div class="mb-3">
                            <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
                        </div>
                        <!-- Password Input -->
                        <div class="mb-3">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <!-- Form Buttons Container -->
                        <div class="form-buttons">
                            <!-- Login Button -->
                            <button type="submit" class="btn btn-primary">Login</button>
                            <!-- Clear Button -->
                            <button type="button" class="btn btn-danger" onclick="clearForm()">Clear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- JavaScript Function to Clear Form Fields -->
    <script>
        function clearForm() {
            document.getElementById("username").value = "";
            document.getElementById("password").value = "";
        }
    </script>
</body>

</html>