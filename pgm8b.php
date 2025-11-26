<?php
$conn = new mysqli("localhost", "root", "", "studentadv_db");
if ($conn->connect_error) {
    die("DB connection failed: " . $conn->connect_error);
}

$r = $conn->query("SELECT * FROM student");
if (!$r) {
    die("Query failed: " . $conn->error);
}

$student = [];
while ($row = $r->fetch_assoc()) {
    $student[] = $row;
}

// Selection sort function
function selSort(&$a, $k) {
    $n = count($a);
    for ($i = 0; $i < $n - 1; $i++) {
        $m = $i;
        for ($j = $i + 1; $j < $n; $j++) {
            if ($a[$j][$k] < $a[$m][$k]) {
                $m = $j;
            }
        }
        if ($m != $i) {
            $t = $a[$i];
            $a[$i] = $a[$m];
            $a[$m] = $t;
        }
    }
}

selSort($student, 'marks');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sorted Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }
        table {
            width: 50%;
            margin: auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, .1);
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }
        th {
            background: #f4b400;
            color: #fff;
        }
        tr:hover {
            background: #f1f1f1;
        }
    </style>
</head>
<body>
    <h1 style="text-align:center;">Students Sorted by Marks</h1>
    <table>
        <tr><th>ID</th><th>Name</th><th>Marks</th></tr>
        <?php foreach ($student as $s): ?>
            <tr>
                <td><?= htmlspecialchars($s['id']) ?></td>
                <td><?= htmlspecialchars($s['name']) ?></td>
                <td><?= htmlspecialchars($s['marks']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>