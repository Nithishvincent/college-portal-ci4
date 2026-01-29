<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?? 'College Portal' ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* LEFT SIDEBAR */
        .sidebar {
            width: 230px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background-color: #374151;
            padding-top: 20px;
        }

        .sidebar h4 {
            color: white;
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            color: #d1d5db;
            padding: 12px 20px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #4b5563;
            color: white;
        }

        .sidebar a.active {
            background-color: #2563eb;
            color: white;
            font-weight: bold;
        }

        /* RIGHT CONTENT */
        .content {
            margin-left: 230px;
            padding: 30px;
            background-color: #f4f6f9;
            min-height: 100vh;
        }

        hr {
            border-color: #4b5563;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h4>College Portal</h4>

    <!-- ================= ADMIN MENU ================= -->
    <?php if (session()->get('role') === 'admin'): ?>

        <a href="<?= site_url('admin/dashboard') ?>"
           class="<?= ($activePage ?? '') === 'admin_dashboard' ? 'active' : '' ?>">
            Admin Dashboard
        </a>

        <a href="<?= site_url('admin/users') ?>"
           class="<?= ($activePage ?? '') === 'users' ? 'active' : '' ?>">
            User Management
        </a>

        <a href="<?= site_url('student') ?>"
           class="<?= ($activePage ?? '') === 'student' ? 'active' : '' ?>">
            Student Registration
        </a>

        <a href="<?= site_url('student/list') ?>"
           class="<?= ($activePage ?? '') === 'student_list' ? 'active' : '' ?>">
            Student Table
        </a>

    <?php endif; ?>

    <!-- ================= FACULTY MENU ================= -->
    <?php if (session()->get('role') === 'faculty'): ?>

        <a href="<?= site_url('student/list') ?>"
           class="<?= ($activePage ?? '') === 'student_list' ? 'active' : '' ?>">
            Student Table
        </a>

    <?php endif; ?>

    <!-- ================= STUDENT MENU ================= -->
    <?php if (session()->get('role') === 'student'): ?>

        <a href="<?= site_url('project') ?>"
           class="<?= ($activePage ?? '') === 'project_submit' ? 'active' : '' ?>">
            Submit Project
        </a>

    <?php endif; ?>

    <!-- ================= PROJECT LIST (ALL ROLES) ================= -->
    <a href="<?= site_url('project/list') ?>"
       class="<?= ($activePage ?? '') === 'project_list' ? 'active' : '' ?>">
        Project List
    </a>

    <hr>

    <!-- LOGOUT -->
    <button class="btn btn-danger mx-3 my-2 w-75"
            onclick="window.location='<?= site_url('logout') ?>'">
        Logout
    </button>
    <button class="btn btn-secondary mx-3 my-2 w-75"
            onclick="window.location='<?= site_url('password/change') ?>'">
        Change Password
    </button>
</div>

<div class="content">
    <?= $this->renderSection('content') ?>
</div>

</body>
</html>
