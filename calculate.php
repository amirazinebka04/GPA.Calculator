<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $courses = $_POST['course'];
    $credits = $_POST['credits'];
    $grades = $_POST['grade'];

    $totalPoints = 0;
    $totalCredits = 0;

    for ($i = 0; $i < count($credits); $i++) {
        $totalPoints += (float)$credits[$i] * (float)$grades[$i];
        $totalCredits += (float)$credits[$i];
    }

    $gpa = ($totalCredits > 0) ? ($totalPoints / $totalCredits) : 0;

    // Interpretation based on Lab 2
    $status = "Fail";
    if ($gpa >= 3.7) $status = "Distinction";
    else if ($gpa >= 3.0) $status = "Merit";
    else if ($gpa >= 2.0) $status = "Pass";

    echo "<div style='text-align:center; font-family:Arial; margin-top:50px;'>";
    echo "<h1>Calculation Result</h1>";
    echo "<h3>Your GPA is: " . number_format($gpa, 2) . "</h3>";
    echo "<h4>Interpretation: " . $status . "</h4>";
    echo "<br><a href='index.html'>Go Back</a>";
    echo "</div>";
}
?>
