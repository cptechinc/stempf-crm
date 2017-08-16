<?php
	if ($input->urlSegment(1)) {
		if ($input->urlSegment(1) == 'add') {
			$page->title = "Add Customer";
			$page->body = $config->paths->content.'customer/add/outline.php';
		} else {
			$page->contact = false; //WHETHER OR NOT TO LOAD CONTACT PAGE
			$custID = $sanitizer->text($input->urlSegment(1));
			$shipID = '';
			$customer = get_customer_name($input->urlSegment(1));
			$page->title = $input->urlSegment1 . ' - ' . $customer;
			$user->hascustomeraccess = has_access_to_customer($user->loginid, $user->hascontactrestrictions, $custID, false);
			$config->scripts->append($config->urls->templates.'scripts/pages/customer-page.js');
			$config->scripts->append($config->urls->templates.'scripts/dplusnotes/order-notes.js');
		    $config->scripts->append($config->urls->templates.'scripts/dplusnotes/quote-notes.js');

			if ($input->urlSegment(2)) {
				if (strpos($input->urlSegment(2), 'contacts') !== FALSE) {
					$contactID = $input->get->text('id');
					$page->title = $contactID .", " . $customer;
					$shipID = "";
					$user->hasshiptoaccess = false;
					$page->contact = true;
				} elseif (strpos($input->urlSegment(2), 'shipto-') !== FALSE) {
					$shipID = urldecode(str_replace('shipto-', '', $input->urlSegment(2)));
					$user->hasshiptoaccess = has_access_to_customer_shipto($user->loginid, $user->hascontactrestrictions, $custID, $shipID, false);
				}

				if (strpos($input->urlSegment(3), 'contacts') !== FALSE) {
					$contactID = $input->get->text('id');
					$page->title = $contactID .", " . $customer;
					$shipID = urldecode(str_replace('shipto-', '', $input->urlSegment(2)));
					$page->contact = true;
				}

				if ($page->contact) {
					$page->body = $config->paths->content.'customer/contact/contact-page.php';
				} else {
					if (!empty($shipID)) {
						if ($user->hasshiptoaccess) {
							$page->body = $config->paths->content.'customer/cust-page/customer-page-outline.php';
						} else {
							$page->body = $config->paths->content.'customer/cust-page/customer-access-denied.php';
						}
					} else {
						if ($user->hascustomeraccess) {
							$page->body = $config->paths->content.'customer/cust-page/customer-page-outline.php';
						} else {
							$page->body = $config->paths->content.'customer/cust-page/customer-access-denied.php';
						}
					}
				}

			}
		}
	} else {
		if ($input->get->q) {
			$page->title = "Searching for '".$input->get->text('q')."'";
		} else {
			$page->title = "Customer Index";
		}
		$page->body = $config->paths->content.'customer/cust-index/customer-index.php';
	}

	if ($config->ajax) {
		if ($config->modal) {
			include $config->paths->content."common/modals/include-ajax-modal.php";
		} else {
			include $page->body;

		}
	} else {
		include $config->paths->content."common/include-page.php";
	}
?>
