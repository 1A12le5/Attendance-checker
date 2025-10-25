<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard - Attendance System</title>
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
        background: var(--bg);
    }
    .header {
        background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
        color: white;
        padding: 20px;
        box-shadow: var(--shadow);
    }
    .header h1 { margin: 0; }
    .header p { margin: 5px 0 0 0; opacity: 0.9; }
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    .nav {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    .nav a, .nav button {
        padding: 10px 20px;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        text-decoration: none;
        font-weight: 500;
        transition: background 0.2s;
    }
    .nav a:hover, .nav button:hover {
        background: var(--secondary);
    }
    .nav .logout {
        background: var(--danger);
        margin-left: auto;
    }
    .nav .logout:hover {
        background: #c0392b;
    }
    section { display: none; }
    section.active { display: block; }
    .card {
        background: var(--card);
        border-radius: 8px;
        padding: 20px;
        box-shadow: var(--shadow);
        margin-bottom: 20px;
    }
    h2 {
        color: var(--primary);
        margin-top: 0;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        background: #f7fafd;
        border-radius: 8px;
        overflow: hidden;
    }
    th, td {
        border: 1px solid #e1e8ed;
        padding: 12px;
        text-align: left;
    }
    th {
        background: #eaf6fb;
        color: #22313F;
        font-weight: 600;
    }
    tr:nth-child(even) td { background: #f2f6fa; }
    .success { color: var(--success); font-weight: 500; }
    .info {
        background: #d6eaf8;
        border-left: 4px solid var(--primary);
        padding: 12px;
        border-radius: 4px;
        margin-bottom: 16px;
    }
    button {
        background: var(--primary);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 500;
        margin-top: 8px;
    }
    button:hover {
        background: var(--secondary);
    }
    @media (max-width: 600px) {
        .nav { flex-direction: column; }
        .nav .logout { margin-left: 0; }
        table { font-size: 0.9em; }
    }
    </style>
</head>
<body>
<div class="header">
    <h1>Student Dashboard</h1>
    <p>Welcome, <strong>{{ session('user_name') }}</strong></p>
</div>

<div class="container">
    <div class="nav">
        <button onclick="showSection('dashboard')">Dashboard</button>
        <button onclick="showSection('my-attendance')">My Attendance</button>
        <a href="{{ route('logout') }}" class="logout">Logout</a>
    </div>

    <!-- Dashboard Section -->
    <section id="dashboard" class="active">
        <div class="card">
            <h2>Dashboard</h2>
            @if (session('success'))
                <p class="success">{{ session('success') }}</p>
            @endif
            <div class="info">
                <strong>Welcome to the Student Attendance System</strong><br>
                You can view your attendance records here. Your teacher will mark your attendance during class.
            </div>
            <p><strong>Your ID:</strong> {{ session('user_id') }}</p>
            <p><strong>Your Name:</strong> {{ session('user_name') }}</p>
        </div>
    </section>

    <!-- My Attendance Section -->
    <section id="my-attendance">
        <div class="card">
            <h2>My Attendance Records</h2>
            <table>
                <tr>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
                @php
                    $myAttendances = $attendances->filter(function($a) {
                        return $a->student_id == session('user_id');
                    });
                @endphp
                @forelse($myAttendances as $attendance)
                    <tr>
                        <td>{{ $attendance->date->format('Y-m-d') }}</td>
                        <td>
                            @if($attendance->status === 'present')
                                <span style="color: var(--success); font-weight: 600;">✓ Present</span>
                            @elseif($attendance->status === 'absent')
                                <span style="color: var(--danger); font-weight: 600;">✗ Absent</span>
                            @else
                                <span style="color: #f39c12; font-weight: 600;">⏱ Late</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" style="text-align: center;">No attendance records yet</td>
                    </tr>
                @endforelse
            </table>
            <button type="button" onclick="showSection('dashboard')">Back</button>
        </div>
    </section>
</div>

<script>
function showSection(sectionId) {
    document.querySelectorAll('section').forEach(sec => sec.classList.remove('active'));
    document.getElementById(sectionId).classList.add('active');
}
</script>
</body>
</html>

