<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto Eliminado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #e74c3c;
            text-align: center;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            font-size: 16px;
            margin-bottom: 10px;
        }
        li strong {
            color: #333;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #888;
            margin-top: 30px;
        }
        .footer a {
            color: #e74c3c;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Notificación de Producto Eliminado</h1>
        <p>Se ha eliminado el siguiente producto del sistema:</p>

        <ul>
            <li><strong>Nombre:</strong> {{ $product->name }}</li>
            <li><strong>Descripción:</strong> {{ $product->description }}</li>
            <li><strong>Stock:</strong> {{ $product->quantity }}</li>
            <li><strong>Precio:</strong> ${{ $product->price }}</li>
        </ul>

        <p>La acción de eliminación ha sido registrada en el sistema.</p>

        <div class="footer">
            <p>Este es un correo automático, por favor no respondas.</p>
        </div>
    </div>

</body>
</html>
