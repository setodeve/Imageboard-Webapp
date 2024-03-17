
<div class="images-container">
  <?php if (empty($posts)){ 
    header("Location: no-exist");
    exit;
  }?>
  <?php foreach ($posts as $key => $value) { ?>
    <div class="image-item">

        <h4 class="parent-subject">
          <?php 
          if($value[0]->getSubject()!=null){
            echo "{$value[0]->getSubject()}";
          }
          ?>
        </h4>
        <div><?php echo "{$value[0]->getContent()}"; ?></div>
        <?php if($value[0]->getImg()!=null){?>
          <?php if(file_exists("Images/" . $value[0]->getImg())){?>
            <img class="image-single" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode(file_get_contents("Images/" . $value[0]->getImg()))?>" /> 
          <?php }else{ ?>
            <img class="image-single" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode(file_get_contents("Images/noimage.png"))?>" /> 
          <?php } ?>
        <?php } ?>
        <?php if (count($value)!=1){ ?>
            <?php $count = 0 ?>
            <span>
              <h5 class="comments-title">
                <i class="fa-regular fa-comments parent-icon"></i>
                Comments(<?php echo count($value)-1; ?>)
              </h5>
            </span>

            <?php foreach ($value as $v){?>
              <?php if ($v->getReplyId()!=null){ ?>
                <?php $count += 1 ?>
                <div class="post-child">
                  <span>
                    <?php echo $count; ?>
                  </span>
                  <h5>
                    <?php 
                      if($v->getSubject()!=null){
                        echo "{$v->getSubject()}";
                      }
                    ?>
                  </h5>
                  <div><?php echo "{$v->getContent()}"; ?></div>
                  <?php if($v->getImg()!=null){?>
                    <?php if(file_exists("Images/" . $v->getImg())){?>
                      <img class="image-single" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode(file_get_contents("Images/" . $v->getImg()))?>" /> 
                    <?php }else{ ?>
                      <img class="image-single" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode(file_get_contents("Images/noimage.png"))?>" /> 
                    <?php } ?>
                  <?php } ?>
                </div>
              <?php } ?>
              <?php 
                if($count==3){
                  break;
                } 
              ?>
            <?php } ?>
        <?php } ?>
        <a href="post?id=<?php echo $value[0]->getId() ?>" class="post-detail">
          For more details
          <i class="fa-solid fa-arrow-up-right-from-square post-detail-icon"></i>
        </a>
    </div>
  <?php } ?>
</div>
