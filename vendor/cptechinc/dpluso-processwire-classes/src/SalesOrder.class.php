<?php 

	class SalesOrder extends Order {
		public $sessionid;
		public $recno;
		public $date;
		public $time;
		public $type;
		public $custid;
		public $shiptoid;
		public $custname;
		public $orderno;
		public $custpo;
		public $custref;
		public $status;
		public $orderdate;
		public $careof;
		public $quotdate;
		public $invdate;
		public $shipdate;
		public $revdate;
		public $expdate;
		public $havedoc;
		public $havetrk;
		public $odrsubtot;
		public $odrtax;
		public $odrfrt;
		public $odrmis;
		public $odrtotal;
		public $havenote;
		public $editord;
		public $error;
		public $errormsg;
		public $sconame;
		public $sname;
		public $saddress;
		public $saddress2;
		public $scity;
		public $sst;
		public $szip;
		public $scountry;
		public $contact;
		public $phintl;
		public $phone;
		public $extension;
		public $faxnumber;
		public $email;
		public $releasenbr;
		public $shipviacd;
		public $shipviadesc;
		public $priccode;
		public $pricdesc;
		public $pricdisp;
		public $taxcode;
		public $taxcodedesc;
		public $taxcodedisp;
		public $termcode;
		public $termtype;
		public $termdesc;
		public $rqstdate;
		public $shipcom;
		public $sp1;
		public $sp1name;
		public $sp2;
		public $sp2name;
		public $sp2disp;
		public $sp3;
		public $sp3name;
		public $sp3disp;
		public $fob;
		public $deliverydesc;
		public $whse;
		public $ccno;
		public $xpdate;
		public $ccvalidcode;
		public $ccapproval;
		public $costtot;
		public $totdisc;
		public $paytype;
		public $srcdatefrom;
		public $srcdatethru;
		public $btname;
		public $btadr1;
		public $btadr2;
		public $btadr3;
		public $btctry;
		public $btcity;
		public $btstate;
		public $btzip;
		public $prntfmt;
		public $prntfmtdisp;
		public $dummy;       
		
		public function __construct() {
			$this->update_properties();
		}
		
		public function update_properties() {
			
		}
		
		public function has_documents() {
			return $this->havedoc == 'Y' ? true : false;
		}

		public function has_tracking() {
			return $this->havetrk == 'Y' ? true : false;
		}

		public function has_notes() {
			return $this->havenote == 'Y' ? true : false;
		}

		public function can_edit() {
			return $this->editord == 'Y' ? true : false;
		}

		public function is_phoneintl() {
			return $this->phintl == 'Y' ? true : false;
		}

		public function has_error() {
			return $this->error == 'Y' ? true : false;
		}
		
		
		/* =============================================================
			OTHER CONSTRUCTOR FUNCTIONS 
		============================================================ */
		public static function create_fromarray(array $array) {
			$myClass = get_class();
			$object  = new $myClass(); 

			foreach ($array as $key => $val) {
			$object->$key = $val;
			}
			$object->update_properties();
			return $object;
	   }
	   
	   /* =============================================================
		   GENERATE ARRAY FUNCTIONS 
	   ============================================================ */
		public static function generate_classarray() {
			return SalesOrder::remove_nondbkeys(get_class_vars('SalesOrder'));
		}
		
		public static function remove_nondbkeys($array) {
			return $array;
		}
		
		public function toArray() {
			return (array) $this;
		}
	}
	
	
