<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recuperación de cuenta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: #1E2540;
        }
        .header {
            text-align: center;
            padding: 10px 0;
            background-color: #38426E;
            color: #ffffff;
            border-radius: 8px 8px 0 0;
        }
        .header h2 {
            margin: 0;
        }
        .content {
            padding: 20px;
        }
        .button {
            display: inline-block;
            background-color: #1E2540;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            margin: 20px 0;
        }
        .button:hover {
            background-color: #2563EB;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #888888;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Recuperación de cuenta</h2>
        </div>
        <div class="content">
            <p>Hola, <?=isset($user)?$user:""?></p>
            <p>Has solicitado un link de recuperacíon.</p>
            <p><a href="https://your-website.com/reset?token=YOUR_UNIQUE_TOKEN" class="button">Cambiar mi contraseña.</a></p>
            <p>Si no solicitaste este email, por favor ignoralo</p>
            <p>No compartas este link con nadie.</p>
            <p>Es link es de un solo uso.</p>
        </div>
        <div class="footer">
            <p>ESte es un correo automático, porfavor, no respondas.</p>
        </div>
    </div>
</body>
</html>