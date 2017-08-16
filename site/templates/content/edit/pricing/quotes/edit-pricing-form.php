<?php
	if ($input->get->vendorID) {
		$linedetail['vendorid'] = $vendorID;
		$linedetail['shipfrom'] = '';
	}
?>
<?php if ($config->ajax) : ?>
	<p>
		<a href="<?php echo $config->filename; ?>" target="_blank"><i class="glyphicon glyphicon-print" aria-hidden="true"></i> View Printable Version</a>
		&nbsp; &nbsp;
		<a href="<?= $config->pages->products.'redir/?action=ii-select&itemID='.urlencode($linedetail['itemid']); ?>" target="_blank"><i class="material-icons" aria-hidden="true">&#xE051;</i> View In II</a>
	</p>
<?php endif; ?>
<form action="<?php echo $formaction; ?>" method="post" id="<?= $linedetail['itemid'].'-form'; ?>">
    <input type="hidden" name="action" value="update-line">
    <input type="hidden" name="qnbr" value="<?= $qnbr; ?>">
    <input type="hidden" class="linenumber" name="linenbr" value="<?= $linedetail['linenbr']; ?>">
	<input type="hidden" class="minprice" value="<?= formatmoney($linedetail['minprice']); ?> ">
	<?php if ($input->get->text('quote-to-order') == 'true') : ?>
		<input type="hidden" name="page" value="<?= $config->pages->orderquote."?qnbr=".$qnbr; ?>">
	<?php endif; ?>
    <?php if ($soconfig['config']['use_discount'] != 'Y'): ?>
        <input type="hidden" class="discpct" name="discount" value="<?= formatmoney($linedetail['discpct']); ?>">
    <?php endif; ?>
	<?php if (!$soconfig['config']['change_price']) : ?>
        <input type="hidden" name="price" value="<?= formatmoney($linedetail['price']); ?>">
    <?php endif; ?>
    <div class="row">
    	<div class="col-sm-8">
    		<div class="jumbotron item-detail-heading"> <div> <h4>Item Info</h4> </div> </div>
            <?php include $config->paths->content."edit/pricing/item-info.php"; ?>

            <br><br>
            <div class="row">
            	<div class="col-sm-6">
            		<div class="jumbotron item-detail-heading"> <div> <h4>Item Pricing</h4> </div> </div>
            		<?php include $config->paths->content."edit/pricing/item-price-breaks.php"; ?>
            	</div>
            	<div class="col-sm-6">
            		<div class="jumbotron item-detail-heading"> <div class=""> <h4><?php echo get_customer_name($custID); ?> History</h4> </div> </div>
          			<?php include $config->paths->content."edit/pricing/item-history.php"; ?>
            	</div>
            </div>

            <div class="jumbotron item-detail-heading"> <div class=""> <h4>Item Availability</h4> </div> </div>
            <?php include $config->paths->content."edit/pricing/item-stock.php"; ?>
    	</div>
    	<div class="col-sm-4">
			<?php
                if ($soconfig['config']['change_price']) {
                    include $config->paths->content."edit/pricing/quotes/simple/edit-pricing-table.php";
                } else {
                    include $config->paths->content."edit/pricing/quotes/static-pricing-table.php";
                }

            ?>

    		<table class="table table-bordered table-striped table-condensed">
				<tr>
					<td>Requested Ship Date</td>
					<td>
						<div class="input-group date" style="width: 180px;">
							<?php $name = 'rqstdate'; $value = $linedetail['rshipdate'];?>
							<?php include $config->paths->content."common/date-picker.php"; ?>

						</div>
					</td>
				</tr>
				<tr>
					<td>Warehouse</td><td><input type="text" class="form-control input-sm qty <?= $linedetail['itemid']."-whse"; ?>" name="whse" value="<?= $linedetail['whse']; ?>"></td>
				</tr>
				<?php if (1 == 100) : ?>
					<tr>
						<td>
							On Order
						</td>
						<td>
							<input type="checkbox" name="form1" id="so-form1" class="check-toggle" data-size="small" data-width="73px" value="Y">
						</td>
					</tr>
				<?php endif; ?>
				<tr>
					<td>
						Special Order
					</td>
					<td>
						<select name="specialorder" class="form-control input-sm">
							<?php foreach ($config->specialordertypes as $spectype => $specdesc) : ?>
								<?php if ($linedetail['spcord'] == $spectype) : ?>
									<option value="<?= $spectype; ?>" selected><?= $specdesc; ?></option>
								<?php else : ?>
									<option value="<?= $spectype; ?>"><?= $specdesc; ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</td>
				</tr>
			</table>
			<div class="<?php if (!in_array($linedetail['spcord'], $soconfig['config']['special_orders'])) {echo 'hidden';} ?>">
				<h4>Special Order Details</h4>
				<table class="table table-bordered table-striped table-condensed">
					<tr>
						<td>VendorID</td>
						<td>
							<input type="hidden" name="vendorID" value="<?= $linedetail['vendorid']; ?>">
							<?= $linedetail['vendorid']; ?>
							<a href="<?= $config->pages->ajax.'load/products/choose-vendor/?returnpage='.$page->fullURL; ?>" class="btn btn-sm btn-warning load-into-modal" data-modal="#ajax-modal">
								<i class="fa fa-pencil" aria-hidden="true"></i> Change Vendor
							</a>
						</td>
					</tr>
					<tr>
						<td>Ship-from</td>
						<td>
							<select name="shipfromid" class="form-control input-sm" id="">
								<?php $shipfroms = getvendorshipfroms($linedetail['vendorid'], false); ?>
								<?php foreach ($shipfroms as $shipfrom) : ?>
									<option value="<?= $shipfrom['shipfromid']; ?>" <?php if ($shipfrom['shipfromid'] == $linedetail['shipfromid']) {echo 'selected';} ?>><?= $shipfrom['shipfromid'].' - '.$shipfrom['name']; ?></option>
								<?php endforeach; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Vendor ItemID</td>
						<td><input type="text" name="itemID" class="form-control input-sm" value="<?= $linedetail['vendoritemid']; ?>"></td>
					</tr>
				</table>
			</div>

			<?php if ($linedetail['can-edit']) :?>
		    	<button type="submit" class="btn btn-success btn-block"><i class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></i> Save Changes</button>
				<br>
				<button type="button" class="btn btn-danger btn-block remove-item"><i class="fa fa-trash" aria-hidden="true"></i> Delete Line</button>
		    <?php endif; ?>
    	</div>
    </div>





</form>
