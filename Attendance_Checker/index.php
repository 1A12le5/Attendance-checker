<?php include 'includes/header.php'; ?>

<!-- Login Section -->
<section id="login-section" class="active">
    <h2>Login</h2>
    <form id="login-form" autocomplete="off">
        <label>ID Number:</label>
        <input type="text" id="idnumber" required autocomplete="off">
        <label>Password:</label>
        <input type="password" id="password" required autocomplete="off">
        <label>Role:</label>
        <select id="role" required>
            <option value="student">Student</option>
            <option value="teacher">Teacher</option>
        </select>
        <button type="submit">Login</button>
    </form>
    <div id="login-error" class="error" style="margin-top:10px;"></div>
</section>

<!-- Dashboard Section -->
<section id="dashboard-section">
    <h2>Welcome, <span id="user-name"></span></h2>
    <p style="margin:0 0 10px 0; color:var(--primary); font-weight:500;">
        ID Number: <span id="user-id"></span>
    </p>
    <p style="margin:0 0 10px 0; color:#22313F; font-weight:500;">
        Subject: <span id="class-subject"></span>
    </p>
    <?php include 'includes/nav.php'; ?>
    <p style="color:#22313F;" class="center">This is your dashboard. Select an option above.</p>
</section>

<!-- Add Student Section -->
<section id="add-student-section">
    <h2>Add Student</h2>
    <form id="add-student-form" autocomplete="off">
        <label>ID Number:</label>
        <input type="text" id="student-idnumber" required autocomplete="off">
        <label>Name:</label>
        <input type="text" id="student-name" required autocomplete="off">
        <label>Password:</label>
        <input type="password" id="student-password" required autocomplete="off">
        <button type="submit">Add Student</button>
        <button type="button" onclick="showSection('dashboard-section')">Back to Dashboard</button>
    </form>
    <div id="add-student-success" class="success" style="margin-top:10px;"></div>
    <div id="add-student-error" class="error" style="margin-top:10px;"></div>
</section>

<!-- Update Subject Section -->
<section id="update-subject-section">
    <h2>Update Subject</h2>
    <form id="update-subject-form" autocomplete="off">
        <label>Subject:</label>
        <input type="text" id="teacher-subject" required autocomplete="off">
        <button type="submit">Save Subject</button>
        <button type="button" onclick="showSection('dashboard-section')">Back to Dashboard</button>
    </form>
    <div id="update-subject-success" class="success" style="margin-top:10px;"></div>
    <div id="update-subject-error" class="error" style="margin-top:10px;"></div>
</section>

<!-- Search Student Section -->
<section id="search-student-section">
    <h2>Search Student</h2>
    <input type="text" id="search-student-input" placeholder="Enter student name or ID number" style="width:80%;padding:8px;">
    <button onclick="searchStudent()">Search</button>
    <button type="button" onclick="showSection('dashboard-section')">Back to Dashboard</button>
    <div id="search-student-results" style="margin-top:15px;"></div>
</section>

<!-- Mark Attendance Section -->
<section id="mark-attendance-section">
    <h2>Mark Attendance</h2>
    <form id="attendance-form">
        <label>Date:</label>
        <input type="date" id="attendance-date" required>
        <table>
            <tr>
                <th>Student Name</th>
                <th>Present</th>
                <th>Absent</th>
                <th>Late</th>
            </tr>
            <tbody id="attendance-students"></tbody>
        </table>
        <button type="submit">Submit Attendance</button>
        <button type="button" onclick="showSection('dashboard-section')">Back to Dashboard</button>
    </form>
    <div id="attendance-success" class="success" style="margin-top:10px;"></div>
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
    </table>
    <button onclick="showSection('dashboard-section')">Back to Dashboard</button>
</section>

<?php include 'includes/footer.php'; ?>
