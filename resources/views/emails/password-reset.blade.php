<!DOCTYPE html>
<html>

<head>
    <title>Password Reset</title>
</head>

<body>
    <p>Hello,</p>
    <p>You requested a password reset. Click the link below to reset your password:</p>

    <p>
        <a href="{{ url('/set-password?token=' . $token) }}"
            style="display: inline-block; padding: 10px 20px; background-color: #3498db;
                  color: #fff; text-decoration: none; border-radius: 5px;">
            Reset Password
        </a>
    </p>

    <p>If you didn't request this, please ignore this email.</p>

    <p>Thanks,<br> {{ config('app.name') }}</p>
</body>

</html>
