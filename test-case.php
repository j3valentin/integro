<br>
<label for="n_<?php echo $t ?>">N</label>
<input type="number" id="n_<?php echo $t ?>"
       min="1" minlength="1"
       max="100" maxlength="3"
       placeholder="1 <= N <= 100">

<label for="m_<?php echo $t ?>">M</label>
<input type="number" id="m_<?php echo $t ?>"
       name="m[<?php echo $t ?>]"
       min="1" minlength="1"
       max="1000" maxlength="4"
       placeholder="1 <= M <= 1000"
       value="<?php $nQuerysByTc != null && isset($nQuerysByTc[$t]) && print $nQuerysByTc[$t]; ?>">
<?php
if ($nQuerysByTc != null && isset($nQuerysByTc[$t])) {
    //foreach ($aQuerys[$t] as $q) {
    for ($q = 0; $q < $nQuerysByTc[$t]; $q++) {
        require './query.php';
    }
}
?>
<br>