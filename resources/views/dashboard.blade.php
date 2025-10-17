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
    <!-- Login Section -->
    <section id="login-section" class="active">
        <h2>Login</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label>ID Number:</label>
            <input type="text" name="idnumber" id="idnumber" required>
            <label>Password:</label>
            <input type="password" name="password" id="password" required>
            <label>Role:</label>
            <select name="role" id="role" required>
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
            </select>
            <button type="submit">Login</button>
        </form>
        @if ($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif
    </section>

    <!-- Dashboard Section -->
    <section id="dashboard-section">
        <h2>Welcome, <span id="user-name">{{ session('user_name', 'User') }}</span></h2>
        <p style="margin:0 0 10px 0; color:var(--primary); font-weight:500;">
            ID Number: <span id="user-id">{{ session('user_id', 'N/A') }}</span>
        </p>
        <p style="margin:0 0 10px 0; color:#22313F; font-weight:500;">
            Role: <span id="role-display">{{ session('role', 'N/A') }}</span>
        </p>
        <nav id="dashboard-nav">
            <a onclick="showSection('add-student-section')">Add Student</a>
            <a onclick="showSection('update-subject-section')">Update Subject</a>
            <a onclick="showSection('search-student-section')">Search Student</a>
            <a onclick="showSection('mark-attendance-section')">Mark Attendance</a>
            <a onclick="showSection('view-attendance-section')">View Attendance</a>
            <a class="logout" href="{{ route('logout') }}">Logout</a>
        </nav>
        <hr>
        <p style="color:#22313F;" class="center">This is your dashboard. Select an option above.</p>
        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif
    </section>

    <!-- Add Student Section -->
    <section id="add-student-section">
        <h2>Add Student</h2>
        <form method="POST" action="{{ route('students.store') }}">
            @csrf
            <label>ID Number:</label>
            <input type="text" name="student_number" id="student-idnumber" required>
            <label>Name:</label>
            <input type="text" name="name" id="student-name" required>
            <label>Email:</label>
            <input type="email" name="email" required>
            <button type="submit">Add Student</button>
            <button type="button" onclick="showSection('dashboard-section')">Back to Dashboard</button>
        </form>
        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif
    </section>

    <!-- Update Subject Section -->
    <section id="update-subject-section">
        <h2>Update Subject</h2>
        <form method="POST" action="{{ route('subjects.store') }}">
            @csrf
            <label>Subject Name:</label>
            <input type="text" name="name" id="teacher-subject" required>
            <label>Code:</label>
            <input type="text" name="code" required>
            <label>Description:</label>
            <input type="text" name="description" required>
            <button type="submit">Save Subject</button>
            <button type="button" onclick="showSection('dashboard-section')">Back to Dashboard</button>
        </form>
    </section>

    <!-- Search Student Section -->
    <section id="search-student-section">
        <h2>Search Student</h2>
        <form method="GET" action="{{ route('students.index') }}">
            <input type="text" name="search" placeholder="Enter student name or ID number">
            <button type="submit">Search</button>
        </form>
        <button type="button" onclick="showSection('dashboard-section')">Back to Dashboard</button>
        <div id="search-student-results">
            @if(isset($students))
                <table>
                    <tr><th>Name</th><th>ID</th><th>Email</th></tr>
                    @foreach($students as $student)
                        <tr><td>{{ $student->name }}</td><td>{{ $student->student_number }}</td><td>{{ $student->email }}</td></tr>
                    @endforeach
                </table>
            @endif
        </div>
    </section>

    <!-- Mark Attendance Section -->
    <section id="mark-attendance-section">
        <h2>Mark Attendance</h2>
        <form method="POST" action="{{ route('attendance.store') }}">
            @csrf
            <label>Date:</label>
            <input type="date" name="date" id="attendance-date" required>
            <table>
                <tr>
                    <th>Student Name</th>
                    <th>Present</th>
                    <th>Absent</th>
                    <th>Late</th>
                </tr>
                <tbody id="attendance-students">
                    @foreach($students ?? [] as $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            <td><input type="radio" name="status[{{ $student->id }}]" value="present"></td>
                            <td><input type="radio" name="status[{{ $student->id }}]" value="absent"></td>
                            <td><input type="radio" name="status[{{ $student->id }}]" value="late"></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit">Submit Attendance</button>
            <button type="button" onclick="showSection('dashboard-section')">Back to Dashboard</button>
        </form>
    </section>

    <!-- View Attendance Section -->
    <section id="view-attendance-section">
        <h2>Attendance Records</h2>
        <table id="attendance-records">
            <tr>
                <th>Date</th>
                <th>Student</th>
                <th>Status</th>
            </tr>
            @foreach($attendances ?? [] as $attendance)
                <tr>
                    <td>{{ $attendance->date }}</td>
                    <td>{{ $attendance->student->name }}</td>
                    <td>{{ ucfirst($attendance->status) }}</td>
                </tr>
            @endforeach
        </table>
        <button onclick="showSection('dashboard-section')">Back to Dashboard</button>
    </section>
</div>
<script>
// Utility: Show only the selected section
function showSection(sectionId) {
    document.querySelectorAll('section').forEach(sec => sec.classList.remove('active'));
    document.getElementById(sectionId).classList.add('active');
}

// Setup dashboard navigation
function setupDashboardNav() {
    // For prototype, assume teacher role
    const nav = document.getElementById('dashboard-nav');
    nav.innerHTML = `
        <a onclick="showSection('add-student-section')">Add Student</a>
        <a onclick="showSection('update-subject-section')">Update Subject</a>
        <a onclick="showSection('search-student-section')">Search Student</a>
        <a onclick="showSection('mark-attendance-section')">Mark Attendance</a>
        <a onclick="showSection('view-attendance-section')">View Attendance</a>
        <a class="logout" onclick="showSection('login-section')">Logout</a>
    `;
}

// Logout function
function logout() {
    showSection('login-section');
    window.location.href = '{{ route("logout") }}';
}

// Load dashboard on page load if authenticated
@if(Auth::check())
    document.addEventListener('DOMContentLoaded', function() {
        showSection('dashboard-section');
        setupDashboardNav();
    });
@endif
</script>
</body>
</html>
