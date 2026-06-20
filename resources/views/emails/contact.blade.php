<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nouveau message de contact</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #03045e; border-bottom: 2px solid #0096c7; padding-bottom: 10px;">
            Nouveau message de contact - HROC RDC
        </h2>
        
        <div style="background-color: #f5f5f5; padding: 20px; border-radius: 5px; margin: 20px 0;">
            <p><strong>Nom:</strong> {{ $name }}</p>
            <p><strong>E-mail:</strong> {{ $email }}</p>
            <p><strong>Sujet:</strong> {{ $subject }}</p>
        </div>
        
        <div style="margin: 20px 0;">
            <h3 style="color: #03045e;">Message:</h3>
            <p style="background-color: #f9f9f9; padding: 15px; border-left: 4px solid #0096c7; white-space: pre-wrap;">{{ $message }}</p>
        </div>
        
        <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd; font-size: 12px; color: #666;">
            <p>Ce message a été envoyé depuis le formulaire de contact du site web HROC RDC.</p>
            <p>Vous pouvez répondre directement à cet e-mail pour contacter {{ $name }} à l'adresse {{ $email }}.</p>
        </div>
    </div>
</body>
</html>

