<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teacher Dashboard - Attendance System</title>
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
    label {
        font-weight: 500;
        color: #22313F;
        display: block;
        margin-bottom: 4px;
    }
    input, select, textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #bfc9d1;
        border-radius: 6px;
        margin-bottom: 16px;
        box-sizing: border-box;
        font-size: 1em;
    }
    input:focus, select:focus, textarea:focus {
        border: 1.5px solid var(--primary);
        outline: none;
    }
    button {
        background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 500;
        margin-right: 10px;
        margin-top: 8px;
    }
    button:hover {
        background: linear-gradient(90deg, var(--secondary) 0%, var(--primary) 100%);
    }
    button.secondary {
        background: #bfc9d1;
        color: #22313F;
    }
    button.secondary:hover {
        background: #a8b3bd;
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
    .error { color: var(--danger); font-weight: 500; }
    input[type="radio"] {
        accent-color: var(--secondary);
        width: 18px;
        height: 18px;
        margin-right: 5px;
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
    <h1>Teacher Dashboard</h1>
    <p>Welcome, <strong>{{ session('user_name') }}</strong></p>
</div>

<div class="container">
    <div class="nav">
        <button onclick="showSection('dashboard')">Dashboard</button>
        <button onclick="showSection('add-student')">Add Student</button>
        <button onclick="showSection('mark-attendance')">Mark Attendance</button>
        <button onclick="showSection('view-attendance')">View Attendance</button>
        <a href="{{ route('logout') }}" class="logout">Logout</a>
    </div>

    <!-- Dashboard Section -->
    <section id="dashboard" class="active">
        <div class="card">
            <h2>Dashboard</h2>
            @if (session('success'))
                <p class="success">{{ session('success') }}</p>
            @endif
            <p>Total Students: <strong>{{ count($students) }}</strong></p>
            <p>Total Attendance Records: <strong>{{ count($attendances) }}</strong></p>
            <p>Select an option from the menu above to manage students and attendance.</p>
        </div>
    </section>

    <!-- Add Student Section -->
    <section id="add-student">
        <div class="card">
            <h2>Add Student</h2>
            <form method="POST" action="{{ route('students.store') }}">
                @csrf
                <label>Student ID Number:</label>
                <input type="text" name="student_number" required>
                
                <label>Student Name:</label>
                <input type="text" name="name" required>
                
                <label>Email:</label>
                <input type="email" name="email" required>
                
                <button type="submit">Add Student</button>
                <button type="button" class="secondary" onclick="showSection('dashboard')">Cancel</button>
            </form>
        </div>
    </section>

    <!-- Mark Attendance Section -->
    <section id="mark-attendance">
        <div class="card">
            <h2>Mark Attendance</h2>
            <form method="POST" action="{{ route('attendance.store') }}">
                @csrf
                <label>Date:</label>
                <input type="date" name="date" required>
                
                <table>
                    <tr>
                        <th>Student Name</th>
                        <th>Present</th>
                        <th>Absent</th>
                        <th>Late</th>
                    </tr>
                    @foreach($students as $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            <td><input type="radio" name="status[{{ $student->id }}]" value="present"></td>
                            <td><input type="radio" name="status[{{ $student->id }}]" value="absent"></td>
                            <td><input type="radio" name="status[{{ $student->id }}]" value="late"></td>
                        </tr>
                    @endforeach
                </table>
                
                <button type="submit">Submit Attendance</button>
                <button type="button" class="secondary" onclick="showSection('dashboard')">Cancel</button>
            </form>
        </div>
    </section>

    <!-- View Attendance Section -->
    <section id="view-attendance">
        <div class="card">
            <h2>Attendance Records</h2>
            <table>
                <tr>
                    <th>Date</th>
                    <th>Student</th>
                    <th>Status</th>
                </tr>
                @forelse($attendances as $attendance)
                    <tr>
                        <td>{{ $attendance->date->format('Y-m-d') }}</td>
                        <td>{{ $attendance->student->name }}</td>
                        <td>{{ ucfirst($attendance->status) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="text-align: center;">No attendance records yet</td>
                    </tr>
                @endforelse
            </table>
            <button type="button" class="secondary" onclick="showSection('dashboard')">Back</button>
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

