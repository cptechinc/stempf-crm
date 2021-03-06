<div class="row">
	<div class="col-sm-6">
		<h3>Item Details</h3>
		<table class="table table-bordered table-condensed">
			<tr> <td>Item ID</td> <td><?= $linedetail['itemid']; ?></td> </tr>
			<tr> <td>Unit of Measurement</td> <td><?= $linedetail['uom']; ?></td> </tr>
			<tr> <td>Requested Ship Date</td> <td><?= $linedetail['rshipdate']; ?></td> </tr>
			<tr> <td>Kit Item</td> <td><?= $linedetail['kititemflag']; ?></td> </tr>
			<tr> <td>Special Order</td> <td><?= $linedetail['spcord']; ?></td> </tr>
			<tr> <td>Tax</td> <td><?= $linedetail['taxcode']; ?></td> </tr>
		</table>
	</div>
	<div class="col-sm-6">
		<?php if ($linedetail['kititemflag'] == 'Y') : ?>
			<?php include $config->paths->content."view/kit-item-table.php"; ?>
		<?php endif; ?>
	</div>
</div>
