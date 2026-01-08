<!DOCTYPE html>
<html>
<head>
    <title>Student Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
            font-family: Arial, sans-serif;
        }

        .portal-header {
            background-color: #0056b3;
            color: white;
            padding: 25px;

            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

            text-align: center;
        }

        .card {
            margin-top: 80px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<div class="portal-header">
    <h2>Appteq</h2>
    <p>Student Registration Portal</p>
    <a href="<?= base_url('logout') ?>" class="btn btn-danger btn-sm">
    Logout</a>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card text-center">
                <h4>Welcome</h4>
                <p>Click below to register students</p>

                <a href="<?= base_url('student') ?>" class="btn btn-primary btn-lg mt-3">
                    Register Student
                </a>
            </div>

        </div>
    </div>
</div>
</body>
</html>
