<?php 
$css = null;
$javascript = ['user.js','sv.js']; // add file javascript

$this->view('blocks/headHTML',['css'=>$css,
                               'js'=>$javascript
                              ]);

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
            <?php $this->view('blocks/sidebar-sv');?> 
            <!-- Content -->
            <?php $this->view('pages/sv/'.$data['page']);?>
        </div>
    </div>
</body>