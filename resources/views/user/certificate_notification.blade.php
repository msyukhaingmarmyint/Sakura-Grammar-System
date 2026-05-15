<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; line-height: 1.6; color: #333; }
        .highlight { color: #d81b60; font-weight: bold; }
    </style>
</head>
<body>
   <span class="highlight"><h2>おめでとうございます!</h2></span>
    <p>Hello {{ $user->name }},</p>
    <p>Congratulations on passing your exam! We have attached your official certificate for <strong>{{ $topic ?? 'your level' }}</strong> to this email.</p>
    <br>
    <p>Best regards,<br>The Sakura Grammar Team</p>
</body>
</html>