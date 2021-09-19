<div class="wrapper fadeInDown">
  <div id="formContent">
    <form method="POST" action="<?php echo genUrl('login') ?>">
      <?php if($this->hasErrors()): ?>
        <?php foreach($this->getErrors() as $key => $value): ?>
          <p class="error fadeIn first"><?php echo $this->getError($key); ?></p>
        <?php endforeach; ?>
      <?php endif; ?>
      <input type="email" required="true" id="email" class="fadeIn second" name="email" placeholder="Email">
      <input type="password" required="true" id="password" class="fadeIn third" name="password" placeholder="Password">
      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>

    <div id="formFooter">
      <a class="underlineHover m-4" href="#">Forgot Password?</a>
      <a class="underlineHover" href="<?php echo genUrl('register'); ?>">Register</a>
    </div>

  </div>
</div>