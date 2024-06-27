<!DOCTYPE html>
<html>
<head>
    <style>
        .header {
            background-color: #060737;
            color: white;
            padding: 10px;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>¡Haz recibido un nuevo contacto!</h1>
    </div>
    <div class="content">
        <p>Nombre: {{ $contact->name }}</p>
        <p>Email: {{ $contact->email }}</p>
        <p>Teléfono: {{ $contact->phone }}</p>
        <p>Comentario: {{ $messageContent }}</p>
    </div>
</body>
</html>
