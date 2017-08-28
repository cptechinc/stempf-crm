<?php
	/**
	* NOTES REDIRECT
	* @param string $action
	*
	*/
	$date = date('Ymd');
	$time = date('His');

	$action = ($input->post->action ? $input->post->text('action') : $input->get->text('action'));

	$session->{'from-redirect'} = $page->url;
	$filename = session_id();
	$session->action = $action;

	/**
	* NOTES REDIRECT
	*
	*
	*
	*
	* switch ($action) {
	*	case 'get-order-notes':
	*		DBNAME=$config->DBNAME
	*		LQNOTE=SORD
	*		KEY1=$ordn
	*		KEY2=$linenbr
	*		break;
	*	case 'get-quote-notes':
	*		DBNAME=$config->DBNAME
	*		LQNOTE=QUOT
	*		KEY1=$qnbr
	*		KEY2=$linenbr
	*		break;
	*	case 'get-cart-notes':
	*		DBNAME=$config->DBNAME
	*		LOAD CART NOTES
	*		break;
	*	case 'write-order-notes':
	*		DBNAME=$config->DBNAME
	*		RQNOTE=SORD
	*		KEY1=$ordn
	*		KEY2=$linenbr
	*		FORM1=$form1
	*		FORM2=$form2
	*		FORM3=$form3
	*		FORM4=$form4
	*		FORM5=$form5
	*		break;
	*	case 'write-quote-notes':
	*		DBNAME=$config->DBNAME
	*		RQNOTE=QUOT
	*		KEY1=$qnbr
	*		KEY2=$linenbr
	*		FORM1=$form1
	*		FORM2=$form2
	*		FORM3=$form3
	*		FORM4=$form4
	*		FORM5=$form5
	*		break;
	*	case 'write-cart-notes':
	*		DBNAME=$config->DBNAME
	*		WRITING CART NOTES
	*		break;
	* }
	*
	**/

	switch ($action) {
		case 'get-order-notes':
			$ordn = $input->get->text('ordn');
			$linenbr = $input->get->text('linenbr');
			$data = array('DBNAME' => $config->dbName, 'LQNOTE' => 'SORD', 'KEY1' => $ordn, 'KEY2' => $linenbr);
			$session->loc = $config->pages->ajax."load/notes/dplus/order/?ordn=".$ordn."&linenbr=".$linenbr;
			if ($config->modal) {$session->loc .= "&modal=modal";}
			break;
		case 'get-quote-notes':
			$qnbr = $input->get->text('qnbr');
			$linenbr = $input->get->text('linenbr');
			$data = array('DBNAME' => $config->dbName, 'LQNOTE' => 'QUOT', 'KEY1' => $qnbr, 'KEY2' => $linenbr);
			$session->loc = $config->pages->ajax."load/notes/dplus/quote/?qnbr=".$qnbr."&linenbr=".$linenbr;
			if ($config->modal) {$session->loc .= "&modal=modal";}
			break;
		case 'get-cart-notes':
			$linenbr = $input->get->text('linenbr');
			$data = array('DBNAME' => $config->dbName, 'LOAD CART NOTES' => false);
			$session->loc = $config->pages->ajax."load/notes/dplus/cart/?linenbr=".$linenbr;
			if ($config->modal) {$session->loc .= "&modal=modal";}
			break;
		case 'write-order-note':
			$form1 = $input->post->form1 ? "Y": "N";  $form2 = $input->post->form2 ? "Y": "N";
			$form3 = $input->post->form3 ? "Y": "N";  $form4 = $input->post->form4 ? "Y": "N";  $form5 = '';
			$key1 = $input->post->text('key1'); $key2 = $input->post->text('key2');
			$note = addslashes($input->post->text('note'));
			$editorinsert = $input->post->text('editorinsert');
			$session->action = 'write-sales-order-note';
			$notetype = $config->dplusnotes['order']['type'];
			$notewidth = $config->dplusnotes['order']['width'];
			$data = array('DBNAME' => $config->dbName, 'RQNOTE' => 'SORD', 'KEY1' => $key1, "KEY2" => $key2);
			$data['FORM1'] = $form1; $data['FORM2'] = $form2; $data['FORM3'] = $form3; $data['FORM4'] = $form4;
			$session->data = $data;

			if ($editorinsert == 'edit') {
				$recnbr = $input->post->text('recnbr');
				$session->sql = edit_note(session_id(), $key1, $key2, $form1, $form2, $form3, $form4, $form5, $note, $recnbr, $date, $time, $notewidth);
			} else {
				$recnbr = get_next_note_recno(session_id(), $key1, $key2, $notetype);
				$session->nextrec = $recnbr;
				$session->sql = insert_note(session_id(), $key1, $key2, $form1, $form2, $form3, $form4, $form5, $note, $notetype, $recnbr, $date, $time, $notewidth);
			}
			break;
		case 'write-quote-note':
			$form1 = $input->post->form1 ? "Y": "N";  $form2 = $input->post->form2 ? "Y": "N";
			$form3 = $input->post->form3 ? "Y": "N";  $form4 = $input->post->form4 ? "Y": "N";  $form5 = $input->post->form5 ? "Y": "N";

			$key1 = $input->post->text('key1'); $key2 = $input->post->text('key2');
			$note = addslashes($input->post->text('note'));
			$editorinsert = $input->post->text('editorinsert');
			$notetype = $config->dplusnotes['quote']['type'];
			$note_width = $config->dplusnotes['quote']['width'];
			$data = array('DBNAME' => $config->dbName, 'RQNOTE' => 'QUOT', 'KEY1' => $key1, "KEY2" => $key2);
			$data['FORM1'] = $form1; $data['FORM2'] = $form2; $data['FORM3'] = $form3; $data['FORM4'] = $form4; $data['FORM5'] = $form5;
			if ($editorinsert == 'edit') {
				$recnbr = $input->post->text('recnbr');
				$session->sql = edit_note(session_id(), $key1, $key2, $form1, $form2, $form3, $form4, $form5, $note, $recnbr, $date, $time, $note_width);
			} else {
				$recnbr = get_next_note_recno(session_id(), $key1, $key2, $notetype);
				$session->nextrec = $recnbr;
				$session->sql = insertdplusnote(session_id(), $key1, $key2, $form1, $form2, $form3, $form4, $form5, $note, $notetype, $recnbr, $date, $time, $note_width);
			}
			break;
		case 'write-cart-note':
			$form1 = $input->post->form1 ? "Y": "N";  $form2 = $input->post->form2 ? "Y": "N";
			$form3 = $input->post->form3 ? "Y": "N";  $form4 = $input->post->form4 ? "Y": "N";  $form5 = $input->post->form5 ? "Y": "N";

			$key1 = $input->post->text('key1'); $key2 = $input->post->text('key2');
			$note = addslashes($input->post->text('note'));
			$editorinsert = $input->post->text('editorinsert');
			$notetype = $config->dplusnotes['cart']['type'];
			$note_width = $config->dplusnotes['cart']['width'];
			$data = array('DBNAME' => $config->dbName, 'WRITING CART NOTES' => false);
			//$data['FORM1'] = $form1; $data['FORM2'] = $form2; $data['FORM3'] = $form3; $data['FORM4'] = $form4; $data['FORM5'] = $form5;
			if ($editorinsert == 'edit') {
				$recnbr = $input->post->text('recnbr');
				$session->sql = edit_note(session_id(), $key1, $key2, $form1, $form2, $form3, $form4, $form5, $note, $recnbr, $date, $time, $note_width);
			} else {
				$recnbr = get_next_note_recno(session_id(), $key1, $key2, $notetype);
				$session->nextrec = $recnbr;
				$session->sql = insertdplusnote(session_id(), $key1, $key2, $form1, $form2, $form3, $form4, $form5, $note, $notetype, $recnbr, $date, $time, $note_width);
			}
			break;
	}

	writedplusfile($data, $filename);
	header("location: /cgi-bin/" . $config->cgi . "?fname=" . $filename);
 	exit;
