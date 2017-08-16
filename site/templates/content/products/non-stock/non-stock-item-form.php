<?php
    $vendors = getvendors(false);
?>
    <h3>Choose Vendor</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-condensed" id="vendors-table">
        	<thead>
        		<tr>
        			<th>VendorID</th> <th>Name</th> <th>Address1</th> <th>Address2</th> <th>Address3</th> <th>City, State Zip</th> <th>Country</th> <th>Phone</th>
        		</tr>
        	</thead>
        	<tbody>
        		<?php foreach ($vendors as $vendor) : ?>
        			<tr id="tr-<?= $vendor['vendid']; ?>">
        				<td><button class="btn btn-sm btn-primary" onClick="choosevendor('<?= $vendor['vendid']; ?>')"><?= $vendor['vendid']; ?></button></td>
        				<td class="name"><?= $vendor['name']; ?></td>
        				<td><?= $vendor['address1']; ?></td>
        				<td><?= $vendor['address2']; ?></td>
                        <td><?= $vendor['address3']; ?></td>
        				<td><?= $vendor['city'].', '.$vendor['state'].' '.$vendor['zip']; ?></td>
        				<td><?= $vendor['country']; ?></td>
        				<td><?= $vendor['phone']; ?></td>
        			</tr>
        		<?php endforeach; ?>
        	</tbody>
        </table>
    </div>
    <h3>Item Details</h3>
    <div class="row">
        <div class="col-sm-10">
            <form action="<?= $formaction; ?>">
                <input type="hidden" name="action" value="add-nonstock">
                <input type="hidden" name="custID" value="custID">
                <?php if ($addtype == 'order') : ?>
                    <input type="hidden" name="ordn" value="<?= $ordn; ?>">
                <?php elseif ($addtype == 'quote') : ?>
                    <input type="hidden" name="qnbr" value="<?= $qnbr; ?>">
                <?php endif; ?>
                <table class="table table-condensed table-bordered table-striped">
                    <tr>
                        <td class="control-label">Vend ID:</td>
                        <td>
                            <input type="hidden" class="required" id="vendorID">
                            <p class="form-control-static" id="vendortext"></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="control-label">Ship From</td>
                        <td> <select class="form-control input-sm" id="shipfrom"> <option value="n/a">Choose a Vendor</option> </select> </td>
                    </tr>
                    <tr>
                        <td class="control-label">Item ID</td>
                        <td> <input type="text" class="form-control input-sm required" name="itemID"> </td>
                    </tr>
                    <tr>
                        <td class="control-label">Qty</td>
                        <td> <input type="text" class="form-control input-sm qty" name="qty"> </td>
                    </tr>
                    <tr>
                        <td class="control-label">Price</td>
                        <td>
                            <div class="pull-right">
                                <div class="input-group">
                                    <div class="input-group-addon input-sm">$</div>
                                    <input type="text" class="form-control input-sm text-right price" name="price">
                                </div>
                            </div>

                        </td>

                    </tr>
                    <tr>
                        <td class="control-label">Cost</td>
                        <td>
                            <div class="pull-right">
                                <div class="input-group">
                                    <div class="input-group-addon input-sm">$</div>
                                    <input type="text" class="form-control input-sm text-right price" name="cost">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="control-label">Unit of Measurement</td>
                        <td>
                            <?php $measurements = getunitofmeasurements(false); ?>
                            <select name="uofm" class="form-control input-sm">
                                <?php foreach ($measurements as $measurement) : ?>
                                    <option value="<?= $measurement['code']; ?>"><?= $measurement['desc']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="control-label">Group</td>
                        <td>
                            <?php $groups = getitemgroups(false); ?>
                            <select name="itemgroup" class="form-control input-sm">
                                <option value="">None</option>
                                <?php foreach ($groups as $group) : ?>
                                    <option value="<?= $group['code']; ?>"><?= $group['desc']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="control-label">PO Nbr</td> <td><input type="text" class="form-control input-sm" name="ponumberr"></td>
                    </tr>
                    <tr>
                        <td class="control-label">Reference</td> <td><input type="text" class="form-control input-sm" name="poref"></td>
                    </tr>
                </table>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>


<script>
	$(function() {
		$('#vendors-table').DataTable();
        $('#vendorID').change(function(){
            var vendorID = $(this).val();
            var url = config.urls.json.vendorshipfrom + '?vendorID=' + urlencode(vendorID);
            $('#shipfrom option').remove();
            $.getJSON(url, function( json ) {
                if (json.response.shipfroms.length) {
                    $('<option value="n/a">Choose A Ship-from</option>').appendTo('#shipfrom');
                        $('<option value="n/a">None</option>').appendTo('#shipfrom');
                    $.each( json.response.shipfroms, function( key, shipfrom ) {
                        $('<option value="'+shipfrom.shipfrom+'">'+shipfrom.name+'</option>').appendTo('#shipfrom');
                    });
                } else {
                    $('<option value="N/A">No Ship-froms found</option>').appendTo('#shipfrom');
                }
            });
        })
	});
    function choosevendor(vendorID) {
        $('#vendors-table_filter input').val(vendorID).keyup();
        $('#vendorID').val(vendorID).change();
        $('#vendortext').text($('#tr-'+vendorID).find('.name').text());
    }
</script>
