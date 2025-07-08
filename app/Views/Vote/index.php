<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote - Voting System</title>
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

        <?php if (session()->has('error')): ?>
            <div class="alert alert-danger"><?= session('error') ?></div>
        <?php endif; ?>

        <h2 class="mb-4">Active Elections</h2>

        <?php foreach ($elections as $electionId => $election): ?>
            <div class="card mb-4">
                <div class="card-header">
                    <h3><?= esc($election['title']) ?></h3>
                </div>
                <div class="card-body">
                    <form action="/vote/submit" method="post">
                        <input type="hidden" name="election_id" value="<?= $electionId ?>">
                        <div class="row">
                            <?php foreach ($election['candidates'] as $candidate): ?>
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body text-center">
                                            <h5 class="card-title"><?= esc($candidate['name']) ?></h5>
                                            <p class="card-text"><?= esc($candidate['description']) ?></p>
                                            <button type="submit" name="candidate_id" value="<?= $candidate['id'] ?>" 
                                                class="btn btn-primary">Vote</button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
