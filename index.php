<?php
$nTestCases = null;
$nQuerysByTc = null;
$aQuerys = null;
$aQueryTypes = ['UPDATE', 'QUERY'];
$aFieldsByType = [4, 6];

function t() {
    global $nTestCases;
    if (!filter_has_var(INPUT_GET, 't')) {
        return;
    }
    $nTestCases = filter_input(INPUT_GET, 't');
}
function m() {
    global $nQuerysByTc;
    if (!filter_has_var(INPUT_GET, 'm')) {
        return;
    }
    $nQuerysByTc = $_GET['m'];
}
function q() {
    global $aQuerys;
    if (!filter_has_var(INPUT_GET, 'q')) {
        return;
    }
    $aQuerys = $_GET['q'];
}

t();
m();
q();
?>
<div style="text-align:center"><h1>Welcome to Integro Test</h1></div>
<h2>Cube Summation</h2>
<form>
    <label for="t">T</label>
    <input type="number" id="t" name="t"
           min="1" minlength="1"
           max="50" maxlength="2"
           placeholder="1 <= T <= 50"
           value="<?php $nTestCases != null && print $nTestCases; ?>">
    <br>
    <?php
    if ($nTestCases != null && $nTestCases > 0) {
        for ($t = 0; $t < $nTestCases; $t++) {
            require './test-case.php';
        }
    } ?>
    <br>
    <input type="submit">
</form>
