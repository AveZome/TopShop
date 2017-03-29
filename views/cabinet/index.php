<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <h3>Your cabinet.</h3>
            
            <h4>Hello, <?php echo $user['name'];?>!</h4>
            <ul>
                <li><a href="/cabinet/edit">Update account</a></li>
            </ul>
            
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>