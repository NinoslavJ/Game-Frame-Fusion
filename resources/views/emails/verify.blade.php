<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Email Verification</title>
</head>
<body>
    <h1>Email Verification</h1>
    <p>Hello {{ $user->firstname }},</p>
    <p>Please click the following link to verify your email:</p>
    <a href="{{ route('verify.email', ['token' => $user->verification_token]) }}">Verify Email</a>
    <p>If you did not create an account, no further action is required.</p>
</body>
</html>
