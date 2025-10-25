<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Attendance Management System - Login</title>
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
        background: url('{{ asset("images/f841cd4f-6063-4cd8-9968-b9d77f63dcd8.jfif") }}') no-repeat center center fixed;
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
    }
    h2 {
        margin-top: 0;
        color: var(--primary);
        letter-spacing: 1px;
        text-align: center;
    }
    label {
        font-weight: 500;
        color: #22313F;
        display: block;
        margin-bottom: 4px;
    }
    input[type="text"], input[type="password"], select {
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
    input[type="text"]:focus, input[type="password"]:focus, select:focus {
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
        width: 100%;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(44,62,80,0.08);
        transition: background 0.2s, box-shadow 0.2s;
    }
    button:hover {
        background: linear-gradient(90deg, var(--secondary) 0%, var(--primary) 100%);
        box-shadow: 0 4px 16px rgba(44,62,80,0.13);
    }
    .error { 
        color: var(--danger); 
        font-weight: 500; 
        text-align: center;
        margin-bottom: 16px;
        padding: 10px;
        background: #fadbd8;
        border-radius: 6px;
    }
    .info {
        color: #22313F;
        font-size: 0.9em;
        text-align: center;
        margin-top: 16px;
    }
    @media (max-width: 600px) {
        .container { max-width: 98vw; padding: 18px 6vw 18px 6vw; }
    }
    </style>
</head>
<body>
<div class="container">
    <h2>Student Attendance System</h2>
    <h3 style="text-align: center; color: #22313F; margin-top: 0;">Login</h3>
    
    <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <label>ID Number:</label>
        <input type="text" name="idnumber" id="idnumber" required autofocus>
        
        <label>Password:</label>
        <input type="password" name="password" id="password" required>
        
        <label>Role:</label>
        <select name="role" id="role" required>
            <option value="">-- Select Role --</option>
            <option value="student">Student</option>
            <option value="teacher">Teacher</option>
        </select>
        
        <button type="submit">Login</button>
    </form>
    
    @if ($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif
    
    <div class="info">
        <strong>Demo Credentials:</strong><br>
        Teacher: ID: 23-00125, Password: password<br>
        Student: ID: STU001, Password: password
    </div>
</div>
</body>
</html>

