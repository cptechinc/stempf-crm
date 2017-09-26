<?php
	 $creditfile = $config->jsonfilepath.session_id()."-cicredit.json";
	//$creditfile = $config->jsonfilepath."cicred-credit.json";

	if ($config->ajax) {
		echo '<p>' . makeprintlink($config->filename, 'View Printable Version') . '</p>';
	}

	if (file_exists($creditfile)) {
		$creditjson = json_decode(file_get_contents($creditfile), true);
		if (!$creditjson) { $creditjson = array('error' => true, 'errormsg' => 'The Customer Credit JSON contains errors'); }

		if ($creditjson['error']) {
			createalert('warning', $creditjson['errormsg']);
		} else {
			$leftcolumns = array_keys($creditjson['columns']['left']);
			$rightcolumns = array_keys($creditjson['columns']['right']);
			$notescolumns = array_keys($creditjson['columns']['notes']);

			if (sizeof($creditjson['data']) > 0) {
				echo '<div class="row">';
					echo '<div class="col-sm-6">';
						$tb = new Table('class=table table-striped table-bordered table-condensed table-excel');
						foreach ($leftcolumns as $column) {
							$tb->tr();
							$heading = '<b> '.$creditjson['columns']['left'][$column]['heading'].' &nbsp;</b>';
							$cell =  $creditjson['data']['left'][$column] . ' &nbsp;';
							$tb->td('class='.$config->textjustify[$creditjson['columns']['left'][$column]['headingjustify']], $heading);
							$tb->td('class='.$config->textjustify[$creditjson['columns']['left'][$column]['datajustify']], $cell);
						}
						echo $tb->close();
					echo '</div>';
					echo '<div class="col-sm-6">';
						$tb = new Table('class=table table-striped table-bordered table-condensed table-excel');
						foreach ($rightcolumns as $column) {
							$tb->tr();
							$tb->td('class='.$config->textjustify[$creditjson['columns']['right'][$column]['headingjustify']], $creditjson['columns']['right'][$column]['heading']);
							$tb->td('class='.$config->textjustify[$creditjson['columns']['right'][$column]['datajustify']], $creditjson['data']['right'][$column]);
						}
						echo $tb->close();
					echo '</div>';
				echo '</div>';
				
				echo '<h3>Notes</h3>';
				echo '<div class="row">';
					echo '<div class="col-sm-12">';
						$tb = new Table('class=table table-striped table-bordered table-condensed table-excel');
						$tb->tablesection('thead');
							$tb->tr();
							foreach ($notescolumns as $column) {
								$tb->th('class='.$config->textjustify[$creditjson['columns']['notes'][$column]['headingjustify']], $creditjson['columns']['notes'][$column]['heading']);
							}
						$tb->closetablesection('thead');
						$tb->tablesection('tbody');
						$tb->closetablesection('tbody');
							foreach ($creditjson['data']['notes'] as $note) {
								$tb->tr();
								foreach ($notescolumns as $column) {
									$tb->td('class='.$config->textjustify[$creditjson['columns']['notes'][$column]['datajustify']], $note[$column].' &nbsp;');
								}
							}
						echo $tb->close();
					echo '</div>';
				echo '</div>';
			} else {
				createalert('warning', 'Information Not Available');
			}
		}
	} else {
		createalert('warning', 'Customer has no Contacts');
	}

 ?>
