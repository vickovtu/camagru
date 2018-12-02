<?php include ROOT . '/views/header.php'; ?>

<section class="wrap form">
    <?php if ($result): ?>
        <p class="name">confirm email!</p>
    <?php else: ?>
            <form action="#" method="post">
                <h2>Registration</h2>
                <?php if (isset($errors) && isset($errors['name'])): ?>
                    <p> <?php echo $errors['name']; ?></p>
                    <?php endif; ?>
                <input type="text" name="name" placeholder="Имя" value="<?php echo $name; ?>" class="textbox" required/>
               <?php if (isset($errors) && isset($errors['email'])): ?>
                    <p> <?php echo $errors['email']; ?></p>
                    <?php endif; ?>
                    <?php if (isset($errors) && isset($errors['email1'])): ?>
                    <p> <?php echo $errors['email1']; ?></p>
                    <?php endif; ?>
                    <?php if (isset($errors) && isset($errors['email2'])): ?>
                    <p> <?php echo $errors['email2']; ?></p>
                    <?php endif; ?>
                <input type="email" name="email" placeholder="E-mail" value="<?php echo $email; ?>" class="textbox" required/>
                <?php if (isset($errors) && isset($errors['password'])): ?>
                    <p> <?php echo $errors['password']; ?></p>
                    <?php endif; ?>
                <input type="password" name="password" placeholder="Пароль" value="<?php echo $password; ?>" class="textbox" required/>
                <input type="submit" name="submit" class="button" value="Регистрация" />
            </form>
    <?php endif; ?>
</section>
</div>
 <?php include ROOT.'/views/footer.php';?>
    </body>
</html>