<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo site_url(); ?>">
                <img src="<?php echo base_url(); ?>assets/images/logo.jpg" alt="logo" />
                Eminutes Track
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav eminutes-menu pull-right">
                <li><a href="<?php echo site_url('home/about'); ?>">About Us</a></li>
                <?php if(isset($links)): ?>
                    <?php if(count($links) > 0): ?>
                        <?php foreach ($links as $key => $value) { ?>
                            <li><a href="<?php echo $value; ?>"><?php echo $key; ?></a></li>
                        <?php } ?>
                    <?php endif; ?>
                <?php endif; ?>
                <li><a href="<?php echo site_url('home/contact'); ?>">Contact Us</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<?php if(isset($success)): ?>
    <div class="alert alert-success">
        <?php echo $success; ?>
    </div>
<?php endif; ?>

<?php if(isset($error)): ?>
    <div class="alert alert-error">
        <?php echo $error; ?>
    </div>
<?php endif; ?>