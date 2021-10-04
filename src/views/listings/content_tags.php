<div class="container">
  <div class="newsHeader">
		<h1>
      <?php printf( __( 'Notizie/Eventi su: %s', 'wpnk' ), single_tag_title( '', false ) ); ?>
    </h1>
  </div>
  <div class="newsContent">
    <div class="newsContent__list">
      <?php
      wpnk_tagsList();
      ?>
    </div>
    <div class="newsContent__sidebar">
      <?php
      wpnk_newsTags();
      ?>
    </div>
  </div>
</div>