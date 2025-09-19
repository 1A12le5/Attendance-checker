</div>
<script>
// Utility: Show only the selected section
function showSection(sectionId) {
    document.querySelectorAll('section').forEach(sec => sec.classList.remove('active'));
    document.getElementById(sectionId).classList.add('active');
}

// Utility: Setup dashboard navigation links based on role
function setupDashboardNav(role) {
    const nav = document.getElementById('dashboard-nav');
    if (role === 'teacher') {
        nav.innerHTML = `
            <a onclick="showSection('add-student-section')">Add Student</a>
            <a onclick="showSection('update-subject-section')">Update Subject</a>
            <a onclick="showSection('search-student-section')">Search Student</a>
            <a onclick="showSection('mark-attendance-section')">Mark Attendance</a>
            <a onclick="showSection('view-attendance-section')">View Attendance</a>
            <a class="logout" onclick="logout()">Logout</a>
        `;
    } else {
        nav.innerHTML = `
            <a onclick="showSection('view-attendance-section')">View Attendance</a>
            <a class="logout" onclick="logout()">Logout</a>
        `;
    }
}

// Logout function
function logout() {
    showSection('login-section');
    document.getElementById('login-form').reset();
    document.getElementById('dashboard-nav').innerHTML = '';
    document.getElementById('user-name').textContent = '';
    document.getElementById('user-id').textContent = '';
    document.getElementById('class-subject').textContent = '';
}

// LOGIN FORM SUBMIT
document.getElementById('login-form').onsubmit = async function(e) {
    e.preventDefault();
    document.getElementById('login-error').textContent = '';
    const idnumber = document.getElementById('idnumber').value.trim();
    const password = document.getElementById('password').value;
    const role = document.getElementById('role').value;

    try {
        const res = await fetch('login.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({idnumber, password, role})
        });
        const data = await res.json();

        if (data.success) {
            showSection('dashboard-section');
            document.getElementById('user-name').textContent = data.user.name;
            document.getElementById('user-id').textContent = data.user.idnumber;
            document.getElementById('class-subject').textContent = data.user.subject || '(Not set)';
            setupDashboardNav(data.user.role);
        } else {
            document.getElementById('login-error').textContent = data.error || "Login failed.";
        }
    } catch (err) {
        document.getElementById('login-error').textContent = "Network error.";
    }
};

document.querySelectorAll('button[onclick*="showSection"]').forEach(btn => {
    btn.addEventListener('click', function() {
        // Optionally clear form fields or messages here
    });
});
</script>
</body>
</html>
