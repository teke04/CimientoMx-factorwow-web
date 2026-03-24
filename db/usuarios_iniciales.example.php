<?php

/**
 * Archivo de ejemplo para usuarios iniciales
 * 
 * INSTRUCCIONES:
 * 1. Copia este archivo como 'usuarios_iniciales.php' en la misma carpeta (db/)
 * 2. Edita las credenciales según tus necesidades
 * 3. Al ejecutar las migraciones, los usuarios se insertarán automáticamente
 * 4. En producción, el archivo usuarios_iniciales.php se eliminará automáticamente
 * 
 * Formato: [username, password, email]
 * 
 * IMPORTANTE: No versiones el archivo usuarios_iniciales.php (está en .gitignore)
 */

return [
    ['admin', 'cambiar_password_aqui', 'admin@example.com'],
    // Agregar más usuarios aquí si es necesario
    // ['usuario2', 'password2', 'usuario2@example.com'],
];

?>
