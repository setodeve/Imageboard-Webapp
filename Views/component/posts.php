
<div class="images-container">
  <?php if (empty($posts)){ 
    header("Location: no-exist");
    exit;
  }?>
  <?php foreach ($posts as $key => $value) { ?>
    <div href="/image?name=<?php echo "{}"; ?>" class="image-item">
        <h4><i class="fa-regular fa-comments parent-icon"></i><?php echo "{$value[0]->getSubject()}"; ?></h4>
        <div><?php echo "{$value[0]->getContent()}"; ?></div>
        <?php if(file_exists("Images/" . $value[0]->getImg())){?>
          <img class="image-single" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode(file_get_contents("Images/" . $value[0]->getImg()))?>" /> 
        <?php }else{ ?>
          <img class="image-single" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode(file_get_contents("Images/noimage.png"))?>" /> 
        <?php } ?>
        <?php if (count($value)!=1){ ?>
          <div class="post-child">
            <?php foreach ($value as $v){?>
              <?php if ($v->getReplyId()!=null){ ?>
                <h4><?php echo "{$v->getSubject()}"; ?></h4>
                <div><?php echo "{$v->getContent()}"; ?></div>
                <?php if(file_exists("Images/" . $v->getImg())){?>
                  <img class="image-single" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode(file_get_contents("Images/" . $v->getImg()))?>" /> 
                <?php }else{ ?>
                  <img class="image-single" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode(file_get_contents("Images/noimage.png"))?>" /> 
          </div>
        <?php }}}} ?>
    </div>
  <?php } ?>
</div>
