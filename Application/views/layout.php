<?php 
// $css = ['header','home','footer'];  //add file css
// $javascript = ['home']; // add file javascript

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
            <?php $this->view('blocks/sidebar');?> 
            <!-- Content -->
            <?php $this->view('pages/'.$data['page']);?>
        </div>
    </div>
</body>