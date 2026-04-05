<?php
// PHP logic to handle the calculation if the form is submitted
$gpa = null;
$status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['calculate'])) {
    $credits = $_POST['credits'];
    $grades = $_POST['grade'];
    
    $totalPoints = 0;
    $totalCredits = 0;

    for ($i = 0; $i < count($credits); $i++) {
        $totalPoints += (float)$credits[$i] * (float)$grades[$i];
        $totalCredits += (float)$credits[$i];
    }

    if ($totalCredits > 0) {
        $gpa = $totalPoints / $totalCredits;
        
        // Interpretation mapping
        if ($gpa >= 3.7) $status = "Distinction";
        else if ($gpa >= 3.0) $status = "Merit";
        else if ($gpa >= 2.0) $status = "Pass";
        else $status = "Fail";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPA Calculator - Merged Version</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; }
        .calculator-card { max-width: 600px; margin: 50px auto; border-radius: 15px; }
        .result-box { border-left: 5px solid #0d6efd; background: #e9ecef; }
    </style>
</head>
<body>

<div class="container">
    <div class="card calculator-card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0 text-center">GPA Calculator (L2 CS)</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="index.php">
                <div id="course-rows">
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <input type="text" name="course[]" class="form-control" placeholder="Course Name" required>
                        </div>
                        <div class="col-md-3">
                            <input type="number" name="credits[]" class="form-control" placeholder="Credits" min="1" required>
                        </div>
                        <div class="col-md-3">
                            <select name="grade[]" class="form-select">
                                <option value="4.0">A (4.0)</option>
                                <option value="3.0">B (3.0)</option>
                                <option value="2.0">C (2.0)</option>
                                <option value="1.0">D (1.0)</option>
                                <option value="0.0">F (0.0)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" name="calculate" class="btn btn-success">Calculate Now</button>
                </div>
            </form>

            <?php if ($gpa !== null): ?>
                <div class="result-box p-3 mt-4">
                    <h5>Result:</h5>
                    <p class="mb-1"><strong>GPA:</strong> <?php echo number_format($gpa, 2); ?></p>
                    <p class="mb-0"><strong>Status:</strong> <?php echo $status; ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>
