<?php $contacts = get_customercontacts($user->loginid, $user->hascontactrestrictions, $custID, false); ?>
<div class="panel panel-primary not-round" id="contacts-panel">
    <div class="panel-heading not-round">
        <a href="#contacts-div" class="panel-link" data-parent="#contacts-panel" data-toggle="collapse" ><i class="fa fa-address-book" aria-hidden="true"></i> &nbsp; Customer Contacts <span class="caret"></span></a>
    </div>
    <div id="contacts-div" class="collapse" data-tableloaded="no" data-shipid="<?php echo $shipID; ?>">
        <div class="panel-body">
        	<div class="row">
        		<div class="col-sm-4">
                	<div class="form-group">
                    	<label class="control-label">Show only this ShipTo's contacts?</label><br>
                     <input type="checkbox" id="limit-shiptos" class="check-toggle" data-size="small" data-width="73px" value="<?php echo $shipID; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                	<div class="form-group">
                    	<label class="control-label">Show only Customer Contacts</label><br>
                     <input type="checkbox" id="limit-cc" class="check-toggle" data-size="small" data-width="73px" value="CC">
                    </div>
                </div>
        	</div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="contacts-table">
                <thead> <tr>  <th>Name</th> <th>Shipto</th> <th>Phone</th> <th>Email</th> <th>Address</th> <th>Contact Type</th>  </tr> </thead>
                <tbody>
                    <?php foreach ($contacts as $contact) : ?>
                        <tr>

                            <td><a href="<?php echo $contact->generatecontacturl(); ?>"><?php echo $contact->contact; ?></a></td>
                            <td><a href="<?php $contact->generateshiptourl();?>"><?php echo $contact->shiptoid; ?></a></td>
                            <td><?php echo $contact->generatephonedisplay(); ?></td>
                            <td><a href="<?php echo $contact->generatecontactmethodurl('email'); ?>"><?php echo $contact->email; ?></td>
                            <td><?php echo $contact->generateaddress(); ?></td>
                            <td><?php echo $contact->source; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot> <tr>  <th>Name</th> <th>Shipto</th> <th>Phone</th> <th>Email</th> <th>Address</th> <th>Contact Type</th> </tr> </tfoot>
            </table>
        </div>
    </div>
</div>
