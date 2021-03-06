<table class="table table-bordered table-striped table-condensed">
    <tr> <td>Price </td> <td class="text-right">$ <?= formatmoney($linedetail['quotprice']); ?></td> </tr>
    <tr> <td>Unit of Measurement</td> <td> <?= $linedetail['uom'] ?></td> </tr>
    <tr> <td>Qty</td> <td><input type="text" class="form-control pull-right input-sm text-right qty" name="qty" value="<?= $linedetail['quotunit']+0; ?>"></td> </tr>
    <tr> <td>Original Ext. Amt.</td> <td class="text-right">$ <?= formatmoney($linedetail['quotprice'] * $linedetail['quotunit']); ?></td> </tr>
    <?php if ($soconfig['config']['show_originalprice']) : ?>
        <tr> <td>Original Price</td> <td class="text-right">$ <?= formatmoney($linedetail['quotprice']); ?></td> </tr>
    <?php endif; ?>
    <?php if ($soconfig['config']['show_listprice']) : ?>
        <tr> <td>List Price</td> <td class="text-right">$ <?= formatmoney($linedetail['listprice']); ?></td> </tr>
    <?php endif; ?>
    <?php if ($soconfig['config']['show_cost']) : ?>
        <tr> <td>Cost</td> <td class="text-right">$ <?= formatmoney($linedetail['cost']); ?></td> </tr>
    <?php endif; ?>
    <tr><td>Kit:</td><td><?php echo $linedetail['kititemflag']; ?></td></tr>
</table>
