
<div class="container">
    <div id="container" class="container login">
      <p>
			<span class="article-header">Login</span>
	  </p>
      <br />
      <?php if(strlen(validation_errors()) > 0): ?>
        <div class="alert alert-danger">
          <?php echo validation_errors(); ?>
        </div>
      <?php endif; ?>

      <?php 
      $attributes = array('class' => 'form-signin');
      echo form_open('home/signin', $attributes);
      echo "<p>&nbsp;</p>";
      echo form_input('username', '', 'placeholder="Username"');
      echo "<br />";
      echo form_password('password', '', 'placeholder="Password"');
      echo "<br />";
      echo "<br />";
      echo form_submit('submit', 'Login', 'class="btn btn-large btn-primary"');
      echo form_close();
      ?>      
    </div><!--container-->
</div>