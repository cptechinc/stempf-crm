<legend>Ship-To Info | <?php echo $shiptocount; ?> Ship-Tos</legend>
<table class="table table-striped table-bordered table-condensed">
	<tr>
		<td class="control-label">Ship-To:</td>
		<td>
			<select name="shipTo" class="form-control input-sm" onChange="refreshshipto(this.value,'<?php echo $custID; ?>')">
            	<option value=" " <?php if ($shipID == '') { echo 'selected'; } ?>>Company Totals</option>
               	<?php $shiptos = get_customershiptos($custID, $user->loginid, $user->hascontactrestrictions, false); ?>
                <?php foreach ($shiptos as $shipto) : ?>
				<?php $address = $shipto['addr1'] . ' ' .$shipto['addr2']; $whole_address = $address.', '.$shipto['ccity'].', '.$shipto['cst']; ?>
				<?php $show = $shipto['name'].' - '.$shipto['ccity'].', '.$shipto['cst']; ?>
            		<option value="<?= $shipto['shiptoid']; ?>" <?php if ($shipto['shiptoid'] == $shipID) { echo 'selected'; } ?>><?= $show; ?> </option>
            	<?php endforeach; ?>
            </select>
        </td>
	</tr>
    <?php $shipto = get_shiptoinfo($custID, $shipID, false); ?>
    <tr> <td class="control-label">Ship-To ID: </td> <td><?php echo $shipto['shiptoid']; ?></td> </tr>
	<?php if ($shipID != '') : ?>
		<tr> <td></td> <td><?php //$withshipto = true; include $config->paths->content."customer/shop-as-form.php"; ?></td> </tr>
	<?php endif; ?>
    <tr> <td class="control-label">Ship-To Name: </td> <td><?php echo $shipto['name']; ?></td> </tr>
    <tr> <td class="control-label">Address: </td> <td><?php echo $shipto['addr1']; ?></td> </tr>
    <?php if ($shipTo['addr2'] != '') : ?>
        <tr> <td class="control-label">Address 2: </td> <td><?php echo $shipto['addr2']; ?></td> </tr>
    <?php endif; ?>
    <tr> <td class="control-label">City, St. Zip: </td> <td><?php echo $shipto['ccity'].', '.$shipto['cst'].' '.$shipto['czip']; ?></td> </tr>
    <tr> <td class="control-label">Ship-To Contact: </td> <td><?php echo $shipto['contact']; ?></td> </tr>
    <tr> <td class="control-label">Phone: </td> <td><a href="tel:<?php echo $shipto['cphone']; ?>"><?php echo $shipto['cphone']; ?></a></td> </tr>
	<tr> <td class="control-label">Email: </td> <td><a href="mailto:<?php echo $shipto['email']; ?>"><?php echo $shipto['email']; ?></a></td> </tr>
	<tr><td colspan="2"><h4>Ship-To Sales data last 12 months</h4></td></tr>
	<tr>
		<td class="control-label">Last Sale Date: </td>
		<td>
	    	<div class="input-group" style="width: 180px;">
	        	<div class="input-group-addon input-sm"><span class="glyphicon glyphicon-calendar"></span></div>
	        	<input type="text" placeholder="MM/DD/YYYY" class="form-control input-sm text-right" value="<?= DplusDateTime::formatdate($shipto['lastsaledate']); ?>">
	        </div>
	    </td>
	</tr>
	<tr>
	   <td class="control-label">Amount Sold</td> <td class="text-right">$ <?php echo formatmoney($shipto['amountsold']); ?></td>
	</tr>
	<tr>
	  <td class="control-label">Times Sold</td> <td class="text-right"><?php echo $shipto['timesold']; ?></td>
	</tr>

</table>
