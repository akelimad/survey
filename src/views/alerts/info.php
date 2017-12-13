<?php $classes = (!empty($classes)) ? implode(' ', $classes) : ''; ?>
<div class="eta-alerts alert alert-info alert-white rounded <?php echo $classes; ?>">
    <?php if( !isset($dismissible) || $dismissible === true ) : ?>
	    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">x</button>
	<?php endif; ?>
    <div class="icon"><i class="fa fa-info-circle"></i></div>
    <ul>
    <?php foreach ($messages as $key => $message) : ?>
		<li><?php echo $message; ?></li>
    <?php endforeach; ?>
    </ul>
</div>