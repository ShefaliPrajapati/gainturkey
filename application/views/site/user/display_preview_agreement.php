<?php $this->load->view('site/templates/header'); ?>


  <link rel="stylesheet" type="text/css" href="css/site/jquery.ad-gallery.css">
  <script type="text/javascript" src="js/site/jquery.ad-gallery.js"></script>
  <script type="text/javascript">
  $(function() {
    var galleries = $('.ad-gallery').adGallery();
	    galleries[0].slideshow.toggle();
  });
  </script>
  <style type="text/css">
  #gallery {
    padding: 30px;
    background: #e1eef5;
  }
  #descriptions {
    position: relative;
    height: 50px;
    background: #EEE;
    margin-top: 10px;
    width: 100%;
    padding: 10px;
    overflow: hidden;
  }
  #descriptions .ad-image-description {
      position: absolute;
  }
  #descriptions .ad-image-description .ad-description-title {
      display: block;
  }
  </style>
  
<div class="listing_content" style="margin-top:20px;">
	
   <?php $previewImg = @explode(',',$PreviewOptions->row()->preview_images); ?>
	
  	<div id="gallery" class="ad-gallery">
    <h1 style="">Preview</h1>
    
    <a href="confirmagreement/<?php echo $this->uri->segment(2).'/'.$this->uri->segment(3); ?>" class="detail_btn" style="text-decoration:none; margin-left:5px; padding:3px 11px 3px 11px;">Submit</a>
    <a href="viewagreement/<?php echo $this->uri->segment(2).'/'.$this->uri->segment(3); ?>" class="detail_btn" style="text-decoration:none; margin-left:5px; padding:3px 11px 3px 11px;">Edit</a>
    
    <div class="clear"></div>
   
    
      <div class="ad-image-wrapper">
      </div>
      <div class="ad-controls">
      </div>
      <div class="ad-nav">
        <div class="ad-thumbs">
          <ul class="ad-thumb-list">
          
          	<?php foreach($previewImg as $previewImgs){ ?>
            <li>
              <a href="preview-images/<?php echo $previewImgs; ?>">
                <img src="preview-images/<?php echo $previewImgs; ?>" class="image0" width="100">
              </a>
            </li>
			<?php } ?>
           <?php /*?> <li>
              <a href="images/10.jpg">
                <img src="images/thumbs/t10.jpg" title="A title for 10.jpg" alt="This is a nice, and incredibly descriptive, description of the image 10.jpg" class="image1">
              </a>
            </li>
            <li>
              <a href="images/11.jpg">
                <img src="images/thumbs/t11.jpg" title="A title for 11.jpg" longdesc="http://coffeescripter.com" alt="This is a nice, and incredibly descriptive, description of the image 11.jpg" class="image2">
              </a>
            </li>
            <li>
              <a href="images/12.jpg">
                <img src="images/thumbs/t12.jpg" title="A title for 12.jpg" alt="This is a nice, and incredibly descriptive, description of the image 12.jpg" class="image3">
              </a>
            </li>
            <li>
              <a href="images/13.jpg">
                <img src="images/thumbs/t13.jpg" title="A title for 13.jpg" alt="This is a nice, and incredibly descriptive, description of the image 13.jpg" class="image4">
              </a>
            </li>
            <li>
              <a href="images/14.jpg">
                <img src="images/thumbs/t14.jpg" title="A title for 14.jpg" alt="This is a nice, and incredibly descriptive, description of the image 14.jpg" class="image5">
              </a>
            </li>
            <li>
              <a href="images/2.jpg">
                <img src="images/thumbs/t2.jpg" title="A title for 2.jpg" alt="This is a nice, and incredibly descriptive, description of the image 2.jpg" class="image6">
              </a>
            </li>
            <li>
              <a href="images/3.jpg">
                <img src="images/thumbs/t3.jpg" title="A title for 3.jpg" alt="This is a nice, and incredibly descriptive, description of the image 3.jpg" class="image7">
              </a>
            </li>
            <li>
              <a href="images/4.jpg">
                <img src="images/thumbs/t4.jpg" title="A title for 4.jpg" alt="This is a nice, and incredibly descriptive, description of the image 4.jpg" class="image8">
              </a>
            </li>
            <li>
              <a href="images/5.jpg">
                <img src="images/thumbs/t5.jpg" title="A title for 5.jpg" alt="This is a nice, and incredibly descriptive, description of the image 5.jpg" class="image9">
              </a>
            </li>
            <li>
              <a href="images/6.jpg">
                <img src="images/thumbs/t6.jpg" title="A title for 6.jpg" alt="This is a nice, and incredibly descriptive, description of the image 6.jpg" class="image10">
              </a>
            </li>
            <li>
              <a href="images/7.jpg">
                <img src="images/thumbs/t7.jpg" title="A title for 7.jpg" alt="This is a nice, and incredibly descriptive, description of the image 7.jpg" class="image11">
              </a>
            </li>
            <li>
              <a href="images/8.jpg">
                <img src="images/thumbs/t8.jpg" title="A title for 8.jpg" alt="This is a nice, and incredibly descriptive, description of the image 8.jpg" class="image12">
              </a>
            </li>
            <li>
              <a href="images/9.jpg">
                <img src="images/thumbs/t9.jpg" title="A title for 9.jpg" alt="This is a nice, and incredibly descriptive, description of the image 9.jpg" class="image13">
              </a>
            </li><?php */?>
          </ul>
        </div>
      </div>
    </div> 
  
</div>
<?php $this->load->view('site/templates/footer'); ?>