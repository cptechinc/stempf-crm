<?php 
    class EditSalesOrderDisplay extends SalesOrderDisplay {
        protected $ordn;
        protected $modal;
        public $canedit;
        use SalesOrderDisplayTraits;
        
        public function __construct($sessionID, \Purl\Url $pageurl, $modal, $ordn) {
            parent::__construct($sessionID, $pageurl, $modal, $ordn);
        }
        
        public function generate_unlockurl(Order $order) {
            $url = $this->generate_ordersredirurl();
            $url->query->set('action', 'unlock-order');
            $url->query->set('ordn', $order->orderno);
            return $url->getUrl();
        }
        
        public function generate_confirmationurl(Order $order) {
            $url = new \Purl\Url(wire('config')->pages->confirmorder);
            $url->query->set('ordn', $order->orderno);
            return $url->getUrl();
        }
        
        public function generate_documentsrequesturl(Order $order, OrderDetail $orderdetail = null) {
            $url = $this->generate_ordersredirurl();
            $url->query->setData(array('action' => 'get-order-documents', 'ordn' => $order->orderno, 'page' => 'edit'));
            if ($orderdetail) {
                $url->query->set('itemdoc', $orderdetail->itemid);
            }
            return $url->getUrl();
        }
        
        public function generate_discardchangeslink(Order $order) {
            $bootstrap = new Contento();
            $href = $this->generate_unlockurl($order);
            $icon = $bootstrap->createicon('glyphicon glyphicon-floppy-remove');
            return $bootstrap->openandclose('a', "href=$href|class=btn btn-block btn-warning", $icon. " Discard Changes, Unlock Order");
        }
        
        public function generate_saveunlocklink(Order $order) {
            $bootstrap = new Contento();
            $href = $this->generate_unlockurl($order);
            $icon = $bootstrap->createicon('fa fa-unlock');
            return $bootstrap->openandclose('a', "href=$href|class=btn btn-block btn-emerald save-unlock-order|data-form=#orderhead-form", $icon. " Save and Unlock Order");
        }
        
        public function generate_confirmationlink(Order $order) {
            $href = $this->generate_confirmationurl($order);
            $bootstrap = new Contento();
            $href = $this->generate_unlockurl($order);
            $icon = $bootstrap->createicon('fa fa-arrow-right');
            return $bootstrap->openandclose('a', "href=$href|class=btn btn-block btn-success", $icon. " Finished with Order");
        }
        
        public function generate_loaddplusnoteslink(Order $order, $linenbr = '0') {
            $bootstrap = new Contento();
            $href = $this->generate_dplusnotesrequesturl($order, $linenbr);
            
            if ($order->can_edit()) {
                $title = ($order->has_notes()) ? "View and Create Order Notes" : "Create Order Notes";
            } else {
                $title = ($order->has_notes()) ? "View Order Notes" : "View Order Notes";
            }
            
            if (intval($linenbr) > 0) {
                $content = $bootstrap->createicon('material-icons md-36', '&#xE0B9;');
    			$link = $bootstrap->openandclose('a', "href=$href|class=load-notes|title=$title|data-modal=$this->modal", $content);
            } else {
                $content = $bootstrap->createicon('material-icons', '&#xE0B9;') . ' ' . $title;
                $link = $bootstrap->openandclose('a', "href=$href|class=btn btn-default load-notes|title=$title|data-modal=$this->modal", $content);
            }
            
            return $link;
        }

        public function generate_detailvieweditlink(Order $order, OrderDetail $detail) {
            $bootstrap = new Contento();
            $href = $this->generate_detailviewediturl($order, $detail);
            $icon = $bootstrap->openandclose('button', 'class=btn btn-sm btn-warning', $bootstrap->createicon('glyphicon glyphicon-pencil'));
            return $bootstrap->openandclose('a', "href=$href|class=update-line|data-kit=$detail->kititemflag|data-itemid=$detail->itemid|data-custid=$order->custid|aria-label=View Detail Line", $icon);    
        }
        
        
        
        public function generate_deletedetailform(Order $order, OrderDetail $detail) {
            $url = $this->generate_ordersredirurl();
            $action = $url->getUrl();
            $form = new FormMaker("class=inline-block|action=$action|method=post");
            $form->input("class=hidden|name=action|value=remove-line");
            $form->input("class=hidden|name=ordn|value=$order->orderno");
            $form->input("class=hidden|name=linenbr|value=$detail->linenbr");
            $icon = $form->createicon('fa fa-trash fa-1-5x') . $form->openandclose('span', 'class=sr-only', 'Delete Line');
            $form->button('type=submit|class=btn btn-sm btn-danger', $icon);
            return $form->finish();
        }
        
        public function generate_readonlyalert() {
            $bootstrap = new Contento();
            $msg = $bootstrap->openandclose('b', '', 'Attention!') . ' This order will open in read-only mode, you will not be able to save changes.';
            return $bootstrap->createalert('warning', $msg);
        }
        
        public function generate_erroralert($order) {
            $bootstrap = new Contento();
            $msg = $bootstrap->openandclose('b', '', 'Error!') . $order->errormsg;
            return $bootstrap->createalert('danger', $msg, false);
        }
    }
