<?php
session_start();
session_destroy(); // Encerra a sessão
header("Location: login.html"); // Redireciona para a página de login
exit();
