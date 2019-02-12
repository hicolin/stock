<?php?>
主账户：<select style="margin: 0 auto">
    <?php
    foreach ($account as $list) { ?>
        <option style="width: 200px;" value="<?=$list->id?>"><?=$list->account?></option>
    <?php }
    ?>
</select>
