<br>
<label for="type_<?php echo $t . '_' . $q ?>">Type</label>
<select id="type_<?php echo $t . '_' . $q ?>"
        name="q[<?php echo $t . '][' . $q ?>][type]"
        value="<?php echo $aQuerys[$t][$q]['type'] ?>">
    <option></option>
    <?php foreach ($aQueryTypes as $type) : ?>
        <option<?php $aQuerys[$t][$q]['type'] === $type && print ' selected' ?>>
            <?php echo $type ?></option>
    <?php endforeach; ?>
</select>
<?php
if (isset($aQuerys[$t][$q]['type']) && $aQuerys[$t][$q]['type']) :
    for ($f = 0; $f < $aFieldsByType[array_search($aQuerys[$t][$q]['type'], $aQueryTypes)]; $f++) : ?>
        <input type="number"
               min="1" minlength="1"
               max="100" maxlength="3"
               name="q[<?php echo $t . '][' . $q . '][fields][' . $f ?>]"
               value="<?php echo $aQuerys[$t][$q]['fields'][$f] ?>">
    <? endfor;
endif;
