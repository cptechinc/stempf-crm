<?php
    if (!isset($actiontype)) {$actiontype = 'all';}
	if (!isset($partialid)) {$partialid = 'actions';}
    if (!isset($assigneduserID)) {$assigneduserID = $user->loginid;}
    $actionpanel = new UserActionPanel('quote', $actiontype, $partialid, '#ajax-modal', $config->ajax, $config->modal);
    $actionpanel->changeassignedtouserID($assigneduserID);
    $actionpanel->setupquotepanel($qnbr);
    $actionpanel->setuptasks($input->get->text('action-status'));
    $actionpanel->querylinks = UserAction::getlinkarray();

    $actionpanel->querylinks['assignedto'] = $assigneduserID;
    $actionpanel->querylinks['completed'] = $actionpanel->databasetaskstatus();
    $actionpanel->querylinks['quotelink'] = $qnbr;
    if ($actiontype != 'all') {
        $actionpanel->querylinks['actiontype'] = $actiontype;
    }
    $actionpanel->count = getuseractionscount($user->loginid, $actionpanel->querylinks, false);

    if (file_exists($config->paths->content."actions/$config->cptechcustomer-actions-panel.php")) {
        include $config->paths->content."actions/$config->cptechcustomer-actions-panel.php";
    } else {
        include $config->paths->content."actions/actions-panel.php";
    }
