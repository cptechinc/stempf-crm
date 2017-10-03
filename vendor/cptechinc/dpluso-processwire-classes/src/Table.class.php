<?php  


/**
 * Based off Kyle Gadd's Table class http://www.php-ease.com/classes/table.html
 * 	Modified to suit DPluso
 */
class Table {
	private $tropen = false; // after the first row in a table this $var stays true
	private $tdopen = false; // after the first cell in a row this $var stays true
	private $thopen = false; // after the first cell in a row this $var stays true
	private $opensection = false;
	private $tablestring = '';
	private static $count = 0;

	function __construct ($vars = '') {
		self::$count++;
		$this->tablestring = $this->indent() . '<table' . $this->values($vars) . '>';
	}
	
	/**
	 * [tablesection description]
	 * @param  string $section [Which table section to use tbody|thead|tfoot]
	 * 
	 */
	public function tablesection($section = 'tbody') {
		$this->opensection = $section;
		$this->tablestring .= $this->indent() . '<'.$section.'>';
		return $this;
	}
	
	/**
	 * [closetablesection description]
	 * @param string $section [Which table section to close tbody|thead|tfoot]
	 */
	public function closetablesection($section) {
		$add = '';
		$this->opensection = false;
		if ($this->tropen) {
			if ($opensection = 'thead') {
				$add .= '</th></tr>';
			} else {
				$add .= '</td></tr>';
			}
		}
		$this->tablestring .= $add . $this->indent() . '</'.$section.'>';
		return $this;
	}
	
	/**
	 * [tr description]
	 * @param string $vars string of attribute values separated by | 
	 */
	public function tr($vars = '') { // (across the board in every cell)
		$add = '';
		if ($this->tropen) {
			if ($this->opensection = 'thead') {
				$add .= '</th></tr>';
			} else {
				$add .= '</td></tr>';
			}
		} 
		$this->tropen = true;
		$this->tdopen = false;
		$this->thopen = false;
		$this->tablestring .= $add . $this->indent() . '<tr' . $this->values($vars) . '>';
		return $this;
	}
	
	/**
	 * [td description]
	 * @param string $vars    string of attribute values separated by | 
	 * @param string $content Content that will be in the cell
	 */
	public function td($vars = '', $content = '&nbsp; ') {
		$add = '';
		if (!$this->tropen) $this->tr();
		if ($this->tdopen) $add .= '</td>';
		$this->tdopen = true;
		$this->tablestring .= $add . $this->indent() . '<td' . $this->values($vars) . '>' . $content;
		return $this;
	}
	
	/**
	 * [th description]
	 * @param string $vars    string of attribute values separated by | 
	 * @param string $content Content that will be in the cell
	 */
	public function th($vars = '', $content='') {
		$add = '';
		if (!$this->tropen) $add .= $this->tr();
		if ($this->thopen) $add .= '</th>';
		$this->thopen = true;
		$this->tablestring .= $add . $this->indent() . '<th' . $this->values($vars) . '>' . $content;
		return $this;
	}
	
	public function tclose($element) {
		return '</'.$element.'>';
	}
	
	/**
	 * does some housekeeping closes out open rows and cells then closesout table string to return it
	 * @return string the tables string
	 */
	public function close() {
		$add = '';
		if (!$this->tdopen) $this->td();
		$add .= '</td></tr>' . $this->indent() . '</table>';
		self::$count--;
		$this->tablestring .= $add;
		return $this->tablestring;
	}
	
	/**
	 * Generates the celldata based of the column, column type and the json array it's in, looks at if the data is numeric
	 * @param string $type the type of data D = Date, N = Numeric, string
	 * @param string $parent the array in which the data is contained
	 * @param string $column the key in which we use to look up the value 
	 */
	static public function generatejsoncelldata($type, $parent, $column) {
		$celldata = '';
		if ($type == 'D') {
			if (strlen($parent[$column['id']]) > 0) {$celldata = date($column['date-format'], strtotime($parent[$column['id']]));} else {$celldata = $parent[$column['id']];}
		} elseif ($type == 'N') {
			if (is_string($parent[$column['id']])) {
				$celldata = number_format(floatval($parent[$column['id']]), $column['after-decimal']);
			} else {
				$celldata = number_format($parent[$column['id']], $column['after-decimal']);
			}
		} else {
			$celldata = $parent[$column['id']];
		}
		return $celldata;
	}
	
	/**
	 * Takes a string of attributes and parses it out by a delimiter (|)
	 * @param  [type] $vars string of attributes separated by | 
	 * @return [type]       string of atrributes and values like class=""
	 */
	private function values($vars) {
		$put = array();
		if (!empty($vars)) {
			$values = explode('|', $vars);
			foreach ($values as $value) {
				$pieces = explode('=', $value);
				$put[array_shift($pieces)] = implode('=', $pieces);
			}
		}
		$attributes = '';
		if (!empty($put)) {
			foreach ($put as $key => $value) {
				$attributes .= ' ' . $key . '="' . $value . '"';
			}
		}
		return $attributes;
	}
	
	/** 
	 * Makes a new line and adds four spaces to format a string in html
	 * @return string new line and four spaces
	 */
	private function indent() {
		$indent = "\n";
		for ($i = 0; $i < self::$count; $i++) {
			$indent .= '  ';
		}
		return $indent;
	}
	
}

?>
