<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Email Verification Required</title>
    <!-- Include your CSS stylesheets or CDN links here -->
</head>
<body>
    <div class="container">
        <h1>Email Verification Required</h1>
        <p>Your email is not yet verified. Please verify your email to continue.</p>
        <form action="{{ route('login') }}" method="get">
            <button type="submit">Back to Login</button>
        </form>
    </div>
</body>
</html>
