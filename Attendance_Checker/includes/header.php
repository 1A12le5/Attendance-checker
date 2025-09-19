<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Attendance Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    :root {
        --primary: #2980b9;
        --secondary: #1abc9c;
        --danger: #e74c3c;
        --success: #27ae60;
        --bg: #f4f8fb;
        --card: #fff;
        --shadow: 0 8px 32px rgba(44,62,80,0.13);
    }
    body {
        font-family: 'Segoe UI', Arial, sans-serif;
        margin: 0;
        min-height: 100vh;
        background: url('images/f841cd4f-6063-4cd8-9968-b9d77f63dcd8.jfif') no-repeat center center fixed;
        background-size: cover;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    body::before {
        content: "";
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(34, 49, 63, 0.7);
        z-index: 0;
    }
    .container {
        width: 100%;
        max-width: 480px;
        margin: 40px auto;
        background: var(--card);
        border-radius: 18px;
        box-shadow: var(--shadow);
        padding: 32px 28px 28px 28px;
        position: relative;
        z-index: 1;
        transition: box-shadow 0.2s;
    }
    section { display: none; }
    section.active { display: block; }
    h2 {
        margin-top: 0;
        color: var(--primary);
        letter-spacing: 1px;
        text-align: center;
    }
    nav {
        margin-bottom: 10px;
        text-align: center;
    }
    nav a {
        margin: 0 10px;
        cursor: pointer;
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s;
        display: inline-block;
        padding: 6px 12px;
        border-radius: 5px;
    }
    nav a:hover { background: var(--secondary); color: #fff; }
    .logout { color: var(--danger) !important; }
    label {
        font-weight: 500;
        color: #22313F;
        display: block;
        margin-bottom: 4px;
    }
    input[type="text"], input[type="password"], input[type="date"], select {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #bfc9d1;
        border-radius: 6px;
        font-size: 1em;
        margin-bottom: 16px;
        background: #f7fafd;
        transition: border 0.2s;
        box-sizing: border-box;
    }
    input[type="text"]:focus, input[type="password"]:focus, input[type="date"]:focus, select:focus {
        border: 1.5px solid var(--primary);
        outline: none;
    }
    button {
        background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 10px 22px;
        font-size: 1em;
        font-weight: 500;
        margin-right: 10px;
        margin-top: 8px;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(44,62,80,0.08);
        transition: background 0.2s, box-shadow 0.2s;
    }
    button[type="button"] {
        background: #bfc9d1;
        color: #22313F;
    }
    button:hover {
        background: linear-gradient(90deg, var(--secondary) 0%, var(--primary) 100%);
        box-shadow: 0 4px 16px rgba(44,62,80,0.13);
    }
    .error { color: var(--danger); font-weight: 500; text-align: center; }
    .success { color: var(--success); font-weight: 500; text-align: center; }
    table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 10px;
        background: #f7fafd;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(44,62,80,0.06);
    }
    th, td {
        border: 1px solid #e1e8ed;
        padding: 10px 6px;
        text-align: center;
        font-size: 1em;
    }
    th {
        background: #eaf6fb;
        color: #22313F;
        font-weight: 600;
    }
    tr:nth-child(even) td { background: #f2f6fa; }
    @media (max-width: 600px) {
        .container { max-width: 98vw; padding: 18px 6vw 18px 6vw; }
        table, th, td { font-size: 0.95em; }
        nav a { display: block; margin: 8px 0; }
    }
    input[type="radio"] {
        accent-color: var(--secondary);
        width: 18px; height: 18px;
    }
    #user-name {
        color: var(--secondary);
        font-weight: 600;
    }
    .center { text-align: center; }
    </style>
</head>
<body>
<div class="container">
