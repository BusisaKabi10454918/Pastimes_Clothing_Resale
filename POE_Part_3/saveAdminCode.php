<?php
$admin_code = "POEadminPriv";
$hash = password_hash($admin_code, PASSWORD_DEFAULT);
file_put_contents(__DIR__ . "/.admin_code", $hash);
$htaccess_content = "<Files \".admin_code\">
    Require all denied
</Files>";
file_put_contents(__DIR__ . "/.htaccess", $htaccess_content);
echo "Admin code has been saved and .htaccess file has been created to protect it.";
?>