<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Voting System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Voting System</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="/logout">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <?php if (session()->has('message')): ?>
            <div class="alert alert-success"><?= session('message') ?></div>
        <?php endif; ?>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Elections Management</h2>
            <a href="/admin/create" class="btn btn-primary">Create New Election</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($elections as $election): ?>
                        <tr>
                            <td><?= esc($election['title']) ?></td>
                            <td><?= date('M d, Y H:i', strtotime($election['start_date'])) ?></td>
                            <td><?= date('M d, Y H:i', strtotime($election['end_date'])) ?></td>
                            <td>
                                <span class="badge bg-<?= 
                                    $election['status'] === 'active' ? 'success' : 
                                    ($election['status'] === 'completed' ? 'secondary' : 'warning') ?>">
                                    <?= ucfirst($election['status']) ?>
                                </span>
                            </td>
                            <td>
                                <a href="/admin/election/<?= $election['id'] ?>" class="btn btn-sm btn-info">View</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
