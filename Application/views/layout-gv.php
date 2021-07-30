<?php 
// $css = ['header.css','home.css','footer.css'];  //add file css
// $javascript = ['home.js']; // add file javascript

// $this->view('blocks/headHTML',['css'=>$css,
//                                'js'=>$javascript
//                               ]);
$this->view('blocks/headHTML');
?>                            
<body>
    <div>
        <!-- Header -->
        <?php  $this->view('blocks/header');?> 
    </div>
    <div class="page-main container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?php $this->view('blocks/sidebar-gv');?> 
            <!-- Content -->
            <?php $this->view('pages/gv/'.$data['page']);?>
        </div>
    </div>
</body>