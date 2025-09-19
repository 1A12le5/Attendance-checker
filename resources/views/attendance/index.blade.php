<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Attendance Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    body {
        font-family: 'Segoe UI', Arial, sans-serif;
        margin: 0;
        min-height: 100vh;
        background: url('{{ asset('images/f841cd4f-6063-4cd8-9968-b9d77f63dcd8.jfif') }}') no-repeat center center fixed;
        background-size: cover;
        position: relative;
    }
    body::before {
        content: "";
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(34, 49, 63, 0.7);
        z-index: 0;
    }
    section {
        position: relative;
        z-index: 1;
        max-width: 450px;
        margin: 40px auto 0 auto;
        background: rgba(255,255,255,0.97);
        border-radius: 18px;
        box-shadow: 0 8px 32px rgba(44,62,80,0.18);
        padding: 32px 28px 28px 28px;
        transition: box-shadow 0.2s;
    }
    section.hidden { display: none; }
    h2 {
        margin-top: 0;
        color: #22313F;
        letter-spacing: 1px;
    }
    nav {
        margin-bottom: 10px;
    }
    nav a {
        margin-right: 18px;
        cursor: pointer;
        color: #2980b9;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s;
    }
    nav a:hover { color: #1abc9c; }
    .logout { color: #e74c3c !important; }
    label { font-weight: 500; color: #22313F; }
    input[type="text"], input[type="password"], input[type="date"] {
        width: 95%;
        padding: 9px 10px;
        margin-top: 4px;
        border: 1px solid #bfc9d1;
        border-radius: 6px;
        font-size: 1em;
        margin-bottom: 12px;
        background: #f7fafd;
        transition: border 0.2s;
    }
    input[type="text"]:focus, input[type="password"]:focus, input[type="date"]:focus {
        border: 1.5px solid #2980b9;
        outline: none;
    }
    button {
        background: linear-gradient(90deg, #2980b9 0%, #1abc9c 100%);
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
    button[type="button"] { background: #bfc9d1; color: #22313F; }
    button:hover {
        background: linear-gradient(90deg, #1abc9c 0%, #2980b9 100%);
        box-shadow: 0 4px 16px rgba(44,62,80,0.13);
    }
    .error { color: #e74c3c; font-weight: 500; }
    .success { color: #27ae60; font-weight: 500; }
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
        section { max-width: 98vw; padding: 18px 6vw 18px 6vw; }
        table, th, td { font-size: 0.95em; }
        nav a { display: block; margin: 8px 0; }
    }
    input[type="radio"] { accent-color: #1abc9c; width: 18px; height: 18px; }
    #user-name { color: #1abc9c; font-weight: 600; }
    </style>
</head>
<body>
    <!-- Login Section -->
    <section id="login-section">
        <h2>Login</h2>
        <form id="login-form" autocomplete="off">
            <label>ID Number:</label>
            <input type="text" id="idnumber" required><br>
            <label>Password:</label>
            <input type="password" id="password" required><br>
            <button type="submit">Login</button>
        </form>
        <div id="login-error" class="error"></div>
    </section>

    <!-- Set Password Section -->
    <section id="set-password-section" class="hidden">
        <h2>Set Your Password</h2>
        <form id="set-password-form" autocomplete="off">
            <label>New Password:</label>
            <input type="password" id="new-password" required><br>
            <label>Confirm Password:</label>
            <input type="password" id="confirm-password" required><br>
            <button type="submit">Set Password</button>
        </form>
        <div id="set-password-error" class="error"></div>
    </section>

    <!-- Dashboard Section -->
    <section id="dashboard-section" class="hidden">
        <h2>Welcome, <span id="user-name"></span></h2>
        <p>ID Number: <span id="user-id"></span></p>
        <p>Subject: <span id="class-subject">Integrative Programming</span></p>
        <nav id="dashboard-nav"></nav>
        <hr>
        <p>This is your dashboard. Select an option above.</p>
    </section>

    <!-- Mark Attendance Section -->
    <section id="mark-attendance-section" class="hidden">
        <h2>Mark Attendance</h2>
        <form id="attendance-form">
            <label>Date:</label>
            <input type="date" id="attendance-date" required><br>
            <table>
                <tr>
                    <th>Student Name</th><th>Present</th><th>Absent</th><th>Late</th>
                </tr>
                <tbody id="attendance-students"></tbody>
            </table>
            <button type="submit">Submit Attendance</button>
            <button type="button" onclick="showSection('dashboard-section')">Back</button>
        </form>
        <div id="attendance-success" class="success"></div>
    </section>

    <!-- View Attendance Section -->
    <section id="view-attendance-section" class="hidden">
        <h2>Attendance Records</h2>
        <table id="attendance-records">
            <tr><th>Date</th><th>Student</th><th>Status</th></tr>
        </table>
        <button onclick="showSection('dashboard-section')">Back</button>
    </section>

    <script>
        const users = [
            { idnumber: "21-01410", password: "", name: "Jhai Rey", role: "teacher" },
            { idnumber: "21-01411", password: "", name: "Angel Clifford", role: "student" },
            { idnumber: "21-01412", password: "", name: "Benito Alejandro", role: "student" },
            { idnumber: "21-01413", password: "", name: "Domocmat, Jonathan", role: "student" },
            { idnumber: "21-01414", password: "", name: "Bolares, Coryl Kain", role: "student" },
            { idnumber: "21-01415", password: "", name: "Ego Gibson", role: "student" },
            { idnumber: "21-01416", password: "", name: "Naia Jasmin", role: "student" },
            { idnumber: "21-01417", password: "", name: "Jenny Ruis", role: "student" }
        ];
        const students = users.filter(u => u.role==="student").map(u=>u.name);
        let currentUser=null, attendanceData=[], userToSetPassword=null;

        function showSection(id){
            document.querySelectorAll('section').forEach(s => s.classList.add('hidden'));
            document.getElementById(id).classList.remove('hidden');
            if(id==='mark-attendance-section') renderAttendanceForm();
            if(id==='view-attendance-section') renderAttendanceRecords();
        }

        document.getElementById('login-form').onsubmit=e=>{
            e.preventDefault();
            const id=document.getElementById('idnumber').value.trim();
            const pwd=document.getElementById('password').value;
            const user=users.find(u=>u.idnumber===id);
            if(!user){document.getElementById('login-error').innerText='ID number not found.';return;}
            if(!user.password){userToSetPassword=user;showSection('set-password-section');}
            else if(user.password===pwd){
                currentUser=user;
                document.getElementById('user-name').innerText=user.name;
                document.getElementById('user-id').innerText=user.idnumber;
                renderDashboardNav();showSection('dashboard-section');
            }else{
                document.getElementById('login-error').innerText='Invalid password.';
            }
        };

        document.getElementById('set-password-form').onsubmit=e=>{
            e.preventDefault();
            const np=document.getElementById('new-password').value;
            const cp=document.getElementById('confirm-password').value;
            if(np.length<4){document.getElementById('set-password-error').innerText="Password must be at least 4 characters.";return;}
            if(np!==cp){document.getElementById('set-password-error').innerText="Passwords do not match.";return;}
            userToSetPassword.password=np;alert("Password set successfully! Please log in.");showSection('login-section');
        };

        function renderDashboardNav(){
            const nav=document.getElementById('dashboard-nav');
            nav.innerHTML=currentUser.role==="teacher" ?
                `<a onclick="showSection('mark-attendance-section')">Mark Attendance</a>
                 <a onclick="showSection('view-attendance-section')">View Attendance</a>
                 <a onclick="logout()" class="logout">Logout</a>`
                :
                `<a onclick="showSection('view-attendance-section')">View My Attendance</a>
                 <a onclick="logout()" class="logout">Logout</a>`;
        }

        function logout(){currentUser=null;document.getElementById('login-form').reset();showSection('login-section');}

        function renderAttendanceForm(){
            const tbody=document.getElementById('attendance-students');tbody.innerHTML='';
            students.forEach(s=>{
                const safe=s.replace(/[^a-zA-Z0-9]/g,'_');
                tbody.innerHTML+=`
                  <tr>
                    <td>${s}</td>
                    <td><input type="radio" name="status_${safe}" value="Present" required></td>
                    <td><input type="radio" name="status_${safe}" value="Absent"></td>
                    <td><input type="radio" name="status_${safe}" value="Late"></td>
                  </tr>`;
            });
            document.getElementById('attendance-date').value=new Date().toISOString().split('T')[0];
        }

        document.getElementById('attendance-form').onsubmit=e=>{
            e.preventDefault();
            const date=document.getElementById('attendance-date').value;
            let tempData=[],valid=true;
            students.forEach(s=>{
                const safe=s.replace(/[^a-zA-Z0-9]/g,'_');
                const radios=document.getElementsByName('status_'+safe);
                let status=[...radios].find(r=>r.checked)?.value;
                if(status) tempData.push({date,student:s,status}); else valid=false;
            });
            if(valid){attendanceData=attendanceData.filter(r=>r.date!==date).concat(tempData);
                document.getElementById('attendance-success').innerText="Attendance submitted!";
            }else{document.getElementById('attendance-success').innerText="Please mark for all students.";}
        };

        function renderAttendanceRecords(){
            const t=document.getElementById('attendance-records');
            while(t.rows.length>1)t.deleteRow(1);
            attendanceData
                .filter(r=>currentUser.role==="teacher"||r.student===currentUser.name)
                .forEach(r=>{
                    let row=t.insertRow();
                    row.insertCell(0).innerText=r.date;
                    row.insertCell(1).innerText=r.student;
                    row.insertCell(2).innerText=r.status;
                });
        }
        showSection('login-section');
    </script>
</body>
</html>