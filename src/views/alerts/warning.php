<?php $classes = (!empty($classes)) ? implode(' ', $classes) : ''; ?>
<div class="chm-alerts alert alert-warning alert-white rounded <?php echo $classes; ?>">
	<?php if( !isset($dismissible) || $dismissible === true ) : ?>
	    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">x</button>
	<?php endif; ?>
    <div class="icon"><i class="fa fa-warning"></i></div>
    <ul>
    <?php foreach ($messages as $key => $message) : ?>
		<li><?php echo $message; ?></li>
    <?php endforeach; ?>
    </ul>
</div>