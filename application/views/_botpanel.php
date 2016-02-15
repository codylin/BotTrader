<?php
/*
 * This is a 3x3 panel of bot pieces
 */
?>
<h2>Pieces<h2>
<table class="table">
    <tr>
        <th>Piece</th>
        <th>Quantity</th>
    </tr>
    {pieces}
    <tr>
        <td><img src="/assets/images/{piece}.jpeg" style="width:100px;height:41px;"></td>
        <td>{quantity}</td>
    </tr>
    {/pieces}
</table>

