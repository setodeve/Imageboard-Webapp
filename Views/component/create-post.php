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
      <input type="hidden" name="reply_to_id" id="reply_to_id" value=0>
      <button type="submit" name="submit">Register</button>
  </form>
</div>

<script src="/js/upload.js"></script>
<script src="/js/app.js"></script>