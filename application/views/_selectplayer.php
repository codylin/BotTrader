<?php
//a dropdown list containing all players
?>
<form method="post">
<select name="playerList" type="text" onChange="this.form.submit()">

    <option>select one</option>
        {options}
    <option value="{name}">{name}</option>
    {/options}
</select>
</form>



