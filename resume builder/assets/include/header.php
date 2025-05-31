<?php
// 🚫 DO NOT add blank lines above this line!

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require './assets/class/function.class.php';
require './assets/class/database.class.php';

$fn = new Functions();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= @$title ?></title>
    
    <!-- CSS and Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="icon" href="./assets/images/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* Your existing styles */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            background-attachment: fixed;
            position: relative;
            min-height: 100vh;
        }
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("data:image/svg+xml,...");
            z-index: -1;
        }
        .main-container {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            background-color: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
        .form-signin {
            max-width: 380px;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            background: rgba(255, 255, 255, 0.9);
            transition: all 0.3s ease;
        }
        .form-signin:hover {
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
            transform: translateY(-5px);
        }
        .form-signin input {
            height: 50px;
            font-size: 14px;
            border: 1px solid #e1e5eb;
            background-color: #f9fafc;
            transition: all 0.3s ease;
        }
        .form-signin input:focus {
            background-color: #fff;
            box-shadow: 0 0 0 4px rgba(80, 102, 224, 0.1);
            border-color: #5066e0;
        }
        .btn-primary {
            background: linear-gradient(45deg, #4776E6, #8E54E9);
            border: none;
            box-shadow: 0 4px 15px rgba(79, 114, 205, 0.3);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(79, 114, 205, 0.4);
            background: linear-gradient(45deg, #3967e0, #7549d4);
        }
        .fade-in {
            animation: fadeIn 0.8s ease-in forwards;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .spinner-grow {
            animation-duration: 1s;
        }
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #c4c9d4;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #a0a8b9;
        }
    </style>
</head>
<body class="">
<div class="">
<!-- Your content continues here -->
