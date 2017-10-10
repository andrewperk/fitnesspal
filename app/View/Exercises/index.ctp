<h1>Exercises Example Page for Testing</h1>

<ul>
<?php foreach($exercises as $exercise): ?>
	<li><?php echo $exercise['Exercise']['name']; ?></li>
<?php endforeach; ?>
</ul>