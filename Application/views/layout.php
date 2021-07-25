<?php 
$css = ['header','home','footer'];  //add file css
$javascript = ['home']; // add file javascript

$this->view('blocks/headHTML',['css'=>$css,
                               'js'=>$javascript
                              ]);
?>                              
<body>
    <div>
        <?php $this->view('blocks/header');?> 
    </div>
    <div>
         <?php //$this->view('pages/'.$data['pages']);?> 
         <?php $this->view('pages/home');?> 
    </div>
    <div>
        <?php $this->view('blocks/footer');?> 
    </div>
</body>
</html>