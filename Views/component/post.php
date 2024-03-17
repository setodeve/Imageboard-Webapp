<div class="images-container">
  <?php if (empty($post)){ 
    header("Location: no-exist");
    exit;
  }?>
  <?php foreach ($post as $key => $value) { ?>
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
            <?php } ?>
        <?php } ?>
        <div class="container">
          <form enctype="multipart/form-data" id="create-form"  action="#" method="post">
              <div class="form-group">
                <label for="subject">subject</label>
                <input type="text" name="subject" id="subject" value="">
              </div>
              <div class="form-group">
                <label for="content">content<strong class="content-aleart">must</strong></label>
                <input type="text" name="content" id="content" value="">
              </div>
              <div class="form-group">
                <label for="img">image<span class="image-aleart"> support only <strong>png, jpeg, jpg, gif (by 20Mbyte)</strong></span></label>
                <input name="img" accept=".png,.jpeg,.jpg,.gif,.PNG,.JPEG,.JPG,.GIF" id="fileUpload" type="file">
                <div id="image-holder"></div>
              </div>
              <input type="hidden" name="reply_to_id" id="reply_to_id" value=<?php echo $value[0]->getId()?>>
              <button type="submit" name="submit">Register</button>
          </form>
        </div>
    </div>
  <?php } ?>
</div>
<script src="/js/upload.js"></script>
<script src="/js/reply.js"></script>