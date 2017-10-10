<h1>Please log in</h1>

<?php echo $this->Form->create('LoggerUser'); ?>
    <?php
        echo $this->Form->input('username');
        echo $this->Form->input('password');
    ?>
<?php echo $this->Form->end(__('Login')); ?>
