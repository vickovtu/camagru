<?php include ROOT . '/views/header.php'; ?>

<section class="wrap form">
    <form action="#" method="post">
            <?php if (isset($errors) && isset($errors['fal'])): ?>
            <p> <?php echo $errors['fal']; ?></p>
            <?php endif; ?>
        <h2>Login</h2>
            <?php if (isset($errors) && isset($errors['email'])): ?>
            <p> <?php echo $errors['email']; ?></p>
            <?php endif; ?>
        <input type="email" name="email" placeholder="E-mail" value="<?php echo $email; ?>" class="textbox" required/>
            <?php if (isset($errors) && isset($errors['password'])): ?>
            <p> <?php echo $errors['password']; ?></p>
            <?php endif; ?>
        <input type="password" name="password" placeholder="Пароль" value="" class="textbox" required/>
        <input type="submit" name="submit" class="button" value="Login" />
    </form>
</section>
</div>
 <?php include ROOT.'/views/footer.php';?>
    </body>
</html>
