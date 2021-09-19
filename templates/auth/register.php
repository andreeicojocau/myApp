<div class="wrapper fadeInDown">
  <div id="formContent">
    <form method="POST" action="<?php genUrl('register') ?>">
      <?php if($this->hasErrors()): ?>
        <?php foreach($this->getErrors() as $key => $value): ?>
          <p class="error fadeIn first"><?php echo $this->getError($key); ?></p>
        <?php endforeach; ?>
      <?php endif; ?>
      <input type="email" required="true" id="email" class="fadeIn second" name="email" placeholder="Email">
      <input type="password" required="true" id="password" class="fadeIn third" name="password" placeholder="Password">
      <input type="password" required="true" id="confirmed_password" class="fadeIn third" name="confirmed_password" placeholder="Confirm password">
      <input type="submit" class="fadeIn fourth" value="Create account">
    </form>

    <div id="formFooter">
      <a class="underlineHover" href="<?php genUrl('login'); ?>">Login</a>
    </div>

  </div>
</div>