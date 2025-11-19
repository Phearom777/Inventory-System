
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #f7f9fc;
        }

        .login-card {
            max-width: 420px;
            margin: 60px auto;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            background: #fff;
        }

        .social-btn {
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .input-group-text {
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <h3 class="text-center mb-4">Login</h3>

        <!-- Email & Password Form -->
        <form method="POST" action="/login">
            @csrf
            <p style="color: red;">{{ session()->get('error') }}</p>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
            </div>

            <!-- Password with Eye -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                    <span class="input-group-text" id="togglePassword">
                        <i class="fa-solid fa-eye"></i>
                    </span>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
                <a href="#">Forgot password?</a>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <div class="text-center my-3">or</div>

        <!-- Social Login Buttons -->
        <a href="/auth/redirect" class="btn btn-danger w-100 social-btn">
            <i class="fab fa-google me-2"></i> Continue with Google
        </a>
        <button class="btn btn-primary w-100 social-btn">
            <i class="fab fa-facebook-f me-2"></i> Continue with Facebook
        </button>

        <p class="text-center mt-3">Don’t have an account? <a href="/register">Sign up</a></p>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#togglePassword").click(function() {
                let input = $("#password");
                let icon = $(this).find("i");

                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                    icon.removeClass("fa-eye").addClass("fa-eye-slash");
                } else {
                    input.attr("type", "password");
                    icon.removeClass("fa-eye-slash").addClass("fa-eye");
                }
            });
        });
    </script>
</body>

</html>
