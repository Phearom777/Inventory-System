<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#1885ed">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/login.css" />

    <title>Register</title>
</head>

<body>
<!--ring div starts here-->
<div class="ring">
  <i style="--clr:#00ff0a;"></i>
  <i style="--clr:#ff0057;"></i>
  <i style="--clr:#fffd44;"></i>
  <form class="login" method="POST" action="/register">
    @csrf
    <h2>Register</h2>
    
    <div class="inputBx">
    @if(session('error'))
    <p style="color: white;">{{ session('error') }}</p>
    @endif
      <input type="text" placeholder="Username" name="name" required>
    </div>
    <div class="inputBx">
      <input type="email" placeholder="Email" name="email" required>
    </div>
    <div class="inputBx">
      <input type="password" placeholder="Password" name="password" id="password" required>
    </div>
    <div class="inputBx">
      <input type="password" placeholder="Confirm Password" id="confirm_password"  required>
      
    </div>
    <div class="inputBx">
      <input type="submit" value="Sign up" name="submit" id="submit">
    </div>
    <div class="links">
      <a href="/login">Already have account?</a>
      <a href="/login">Sign in</a>
    </div>
  </form>
</div>
<!--ring div ends here-->
</body>       
</html>
@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
 $(document).ready(function() {
    $('#submit').click(function(event) {
        var password = $('#password').val();
        var confirmPassword = $('#confirm_password').val();

        // Check if passwords match
        if (password !== confirmPassword) {
            alert('Passwords do not match!');
            event.preventDefault(); // Prevent form submission if passwords don't match
            return; // Exit the function
        }

        // Allow form submission if passwords match
        // No need to prevent the default action if passwords match
    });
});



</script>