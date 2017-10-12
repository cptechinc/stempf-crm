<?php
    if ($input->get->q) {
        $custresults = search_custindexpaged($user->loginid, $config->showonpage, $input->pageNum, $user->hascontactrestrictions, $input->get->text('q'),  false);
        $resultscount = count_searchcustindex($user->loginid, $user->hascontactrestrictions, $input->get->text('q'), false);
    }

?>


<div id="cust-results">
    <?php if ($input->get->q) : ?>
        <table id="cust-index" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th width="100">CustID</th> <th>Customer Name</th> <th>Ship-To</th> <th>Location</th><th width="100">Phone</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($resultscount > 0) : ?>
                    <?php foreach ($custresults as $cust) : ?>
                        <tr>
                            <td>
                                <button class="btn btn-sm btn-primary" type="button" onclick="<?= $cust->generateiifunction($function); ?>"> <?= $cust->custid; ?> </button>
                            </td>
                            <td><?= $page->stringerbell->highlight($cust->name, $input->get->q); ?></td>
                            <td><?= $page->stringerbell->highlight($cust->shiptoid, $input->get->q); ?></td>
                            <td><?= $page->stringerbell->highlight($cust->generateaddress(), $input->get->q); ?></td>
                            <td><a href="tel:<?= $cust->cphone; ?>" title="Click To Call"><?= $page->stringerbell->highlight($cust->cphone, $input->get->q); ?></a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <td colspan="5">
                        <h4 class="list-group-item-heading">No Customer Matches your query.</h4>
                    </td>
                <?php endif; ?>
            </tbody>
        </table>

    <?php endif; ?>
</div>
