<?php

$upper;
$diff;

$person1Value = $_POST['number1'];
$person2Value = $_POST['number2'];

switch($_POST['type']) {
    case "squat":
        $upper = false;
        $diff = 25;
        break;
    case "benchPress":
        $upper = true;
        $diff = 20;
        break;
    case "deadlift":
        $upper = false;
        $diff = 25;
        break;
    case "dumbellPress":
        $upper = true;
        $diff = 10;
        break;
    case "dumbellCurl":
        $upper = true;
        $diff = 10;
        break;
    case "tricepExtension":
        $upper = true;
        $diff = 5;
        break;
}

// Gender compensation
if ($_POST['gender1'] != $_POST['gender2']) {
    if ($_POST['gender1'] == "female") {
        if ($upper) {
            $person1Value = 1.40 * $person1Value;   
        }
        else {
            $person1Value = 1.33 * $person1Value; 
        }
    }
    else {
        if ($upper) {
            $person2Value = 1.40 * $person2Value;   
        }
        else {
            $person2Value = 1.33 * $person2Value; 
        }
    }
}

// Age compensation
$oldest = 0;
if ($_POST['age1'] > $_POST['age2']) {
    $oldest = 1;
}
else if ($_POST['age1'] < $_POST['age2']) {
    $oldest = 2;
}

if (abs($_POST['age1'] - $_POST['age2']) >= 10) {
    if (max($_POST['age1'],$_POST['age2']) > 30) {
        if ($_POST['age1'] > $_POST['age2']) {
            $person1Value = (((abs($_POST['age1'] - $_POST['age2']) / 10) * 0.03) + 1.0) * $person1Value;
        }
        else if ($_POST['age1'] < $_POST['age2']) {
            $person2Value = (((abs($_POST['age1'] - $_POST['age2']) / 10) * 0.03) + 1.0) * $person2Value;
        }
    }
    if (min($_POST['age1'],$_POST['age2']) < 25) {
        if ($_POST['age1'] < $_POST['age2']) {
            $person1Value = (((abs($_POST['age1'] - $_POST['age2']) / 10) * 0.03) + 1.0) * $person1Value;
        }
        else if ($_POST['age1'] > $_POST['age2']) {
            $person2Value = (((abs($_POST['age1'] - $_POST['age2']) / 10) * 0.03) + 1.0) * $person2Value;
        }
    }
}

// Weight compensation
if (abs($_POST['weight1'] - $_POST['weight2']) >= 15) {
    if ($_POST['weight1'] > $_POST['weight2']) {
        $person2Value = ((abs($_POST['weight1'] - $_POST['weight2']) / 15) * $diff) + $person2Value;
    }
    else if ($_POST['weight1'] < $_POST['weight2']) {
        $person1Value = ((abs($_POST['weight1'] - $_POST['weight2']) / 15) * $diff) + $person1Value;
    }
}

?>
    
<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Are You Actually Stronger?</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <a href="index.html"><div class="headerItem">COMPARE</div></a>
        <a href="research.html"><div class="headerItem">RESEARCH</div></a>
    </div>
    <h1>What is <span class="title">Are You Actually Stronger?</span></h1>
    <p><span class="title">Are You Actually Stronger</span> is an algorithm developed to test if somebody is actually stronger. It compensates for age, gender, and body weight to determine who is actually stronger. You can check our research <a href="research.php">here</a> and fork the codebase on <a href="https://github.com/rcobelli/AreYouActuallyStronger" target="_blank">GitHub</a>.</p>

    <hr />
    <table style="border-spacing: 15px;">
        <tr>
            <th></th>
            <th>Person #1</th>
            <th>Person #2</th>
        </tr>
        <tr>
            <td class="right"><label>Body Weight (lbs)</label></td>
            <td class="center"><?php echo $_POST['weight1']; ?></td>
            <td class="center"><?php echo $_POST['weight2']; ?></td>
        </tr>
        <tr>
            <td class="right"><label>Age (yrs)</label></td>
            <td class="center"><?php echo $_POST['age1']; ?></td>
            <td class="center"><?php echo $_POST['age2']; ?></td>
        </tr>
        <tr>
            <td class="right"><label>Gender</label></td>
            <td class="center"><?php echo $_POST['gender1']; ?></td>
            <td class="center"><?php echo $_POST['gender2']; ?></td>
        </tr>
        <tr>
            <td class="right"><label>Resistance (lbs)</label></td>
            <td class="center"><?php echo $_POST['number1']; ?></td>
            <td class="center"><?php echo $_POST['number2']; ?></td>
        </tr>
        <tr>
            <td class="right"><label>Lift Type</label></td>
            <td class="center" colspan="2"><?php echo $_POST['type']; ?></td>
        </tr>
        <tr>
            <th class="right"><label>Calculated Strength (lbs)</label></th>
            <th class="center"><?php echo $person1Value; ?></th>
            <th class="center"><?php echo $person2Value; ?></th>
        </tr>
    </table>
    <div style="text-align: center">
        <hr />
        <h3>Don't Believe It?</h3>
        <p><a href="research.html">Check our research!</a></p>
    </div>
</body>
</html>