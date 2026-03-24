<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detalles del Lead</title>
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
        .info {
            margin-bottom: 10px;
        }
        .info span {
            font-weight: bold;
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
            <h2>Detalles del Lead</h2>
        </div>
        <div class="content">
            <p>Hola, aquí están los detalles del lead que llenó el formulario:</p>
            <div class="info">
                <p><span>Keyword:</span>  <?= isset($keyword)  ? $keyword  : "N/A" ?></p>
                <p><span>Nombre:</span>   <?= isset($nombre)   ? $nombre   : "N/A" ?></p>
                <p><span>Telefono:</span> <?= isset($telefono) ? $telefono : "N/A" ?></p>
                <p><span>Correo:</span>   <?= isset($correo)   ? $correo   : "N/A" ?></p>
                <p><span>interes:</span>  <?= isset($interes)  ? $interes  : "N/A" ?></p>
                <p><span>Estado:</span>   <?= isset($estado)   ? $estado   : "N/A" ?></p>
            </div>
        </div>
        <div class="footer">
            <p>Este es un correo automático, por favor no respondas.</p>
        </div>
    </div>
</body>
</html>