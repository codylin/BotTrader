<?php
// This is the trading activity panels
?>
<h2>Trading Activity<h2>
<table class="table">
    <tr>
        <th>DateTime</th>
        <th>Activity</th>
        <th>Series</th>
    </tr>

    {history}
    <tr>
        <td>{time}</td>
        <td>{act}</td>
        <td>{series}</td>
    </tr>
    {/history}
</table>