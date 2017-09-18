<form action="<?php echo $config->pages->ajax."load/ii/search-results/modal/"; ?>" method="POST" id="ii-item-lookup">
    <input type="hidden" name="action" value="ii-item-lookup">
    <input type="hidden" name="custID" class="custID" value="<?php echo $custID; ?>">
    <input type="hidden" name="shipID" class="shipID" value="<?php echo $shipID; ?>">
    <div class="form-group">
        <div class="input-group custom-search-form">
            <input type="text" class="form-control not-round itemID" name="itemID" placeholder="Search ItemID, X-ref" value="<?php echo $input->get->text('itemID'); ?>">
            <span class="input-group-btn">
            	<button type="submit" class="btn btn-default not-round"> <span class="glyphicon glyphicon-search"></span> </button>
            </span>
        </div>
    </div>
    <input type="hidden" class="prev-itemID" value="<?php echo getitembyrecno(getnextrecno($input->get->text('itemID'), "prev", false), false); ?>">
	<input type="hidden" class="next-itemID" value="<?php echo getitembyrecno(getnextrecno($input->get->text('itemID'), "next", false), false); ?>">
</form>
