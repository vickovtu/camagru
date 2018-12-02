<?php include ROOT . '/views/header.php'; ?>
    <section class="wrap form">
        <?php if ($result): ?><p>Данные изминены!</p>
        <?php else: ?>
            <form action="#" method="post">
                <h2>Data editing</h2>
                <?php if (isset($errors) && isset($errors['name'])): ?>
                <p> <?php echo $errors['name']; ?></p><?php endif; ?>
                <input type="text" name="name" placeholder="Имя" value="<?php echo $name; ?>" class="textbox" required/>
                <?php if (isset($errors) && isset($errors['password'])): ?>
                <p> <?php echo $errors['password']; ?></p>
                <?php endif; ?>
                <input type="password" name="password" placeholder="Пароль" value="" class="textbox" required/>
                <input type="submit" name="submit" class="button" value="Сохранить" />
            </form><!--/sign up form-->
        <?php endif; ?>
    </section>
<?php include ROOT.'/views/footer.php';?>
</body>
</html>
