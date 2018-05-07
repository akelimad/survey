<form action="" method="GET" id="candidatures-filter" class="chm-simple-form">
	<input type="hidden" name="page" value="1" />
	<?php if(!empty($url_params)) : 
		unset(
			$url_params['module'],
			$url_params['controller'],
			$url_params['action'],
			$url_params['id']
		);
		foreach ($url_params as $key => $value) :
		$field_key = array_search($key, array_column($fields, 'name'));
		if( $field_key === false ) :
		if( $key == 'page') continue;
	?>
	<input type="hidden" name="<?= $key; ?>" value="<?= $value; ?>" />
	<?php endif; endforeach; endif; ?>

	<div class="row">
		<?php 
		$i=1;
		$first = true;
		$countFields = count($fields);
		foreach ($fields as $key => $field) : 
		$name = $field['name'];
		?>
		<div class="col-xs-12 col-md-4<?= (!$first) ? ' pl-0 pl-xs-15' : ''; ?>">
			<div class="form-group mb-0">
				<?php if(isset($field['template'])) : ?>
					<?= $field['template']; ?>
				<?php elseif(in_array($field['type'], ['text', 'date', 'number'])) : ?>
					<label for="filter_<?= $field['name']; ?>"><?= $field['label']; ?></label>
					<input type="<?= $field['type']; ?>" name="<?= $field['name']; ?>" value="<?php echo (isset($url_params[$name])) ? $url_params[$name] : $field['value']; ?>" id="filter_<?= $field['name']; ?>" class="form-control mb-5">
				<?php elseif($field['type']=='select') : ?>
					<label for="filter_<?= $field['name']; ?>"><?= $field['label']; ?></label>
					<select name="<?= $field['name']; ?>" id="filter_<?= $field['name']; ?>" class="form-control mb-5">
						<option value=""></option>
						<?php 
							if(!empty($field['options'])) : foreach ($field['options'] as $key => $option) :
								$value = (isset($option->value)) ? $option->value : $key;
								$text = (isset($option->text)) ? $option->text : $option;							
								$selected = ((isset($url_params[$name]) && $url_params[$name] == $value) || $field['value']==$value) ? 'selected' : '';
						?>
							<option <?=$selected;?> value="<?= $value; ?>"><?= $text; ?></option>
						<?php endforeach; endif; ?>
					</select>
				<?php endif; ?>
			</div>
		</div>
	
		<?php if($i%3==0 && $i < $countFields) : $first = true; ?>
			</div><div class="row">
		<?php else : $first = false; ?>
		<?php endif; ?>

		<?php $i++; endforeach; ?>
	</div>
	<div class="row mt-5">
		<div class="col-md-12">
			<button type="submit" class="espace_candidat"><?php trans_e("Filtrer"); ?></button>
			<a href="<?= strtok($_SERVER['HTTP_REFERER'], '?'); ?>" type="button" class="espace_candidat"><?php trans_e("Actualiser"); ?></a>
			<div class="ligneBleu"></div>
		</div>
	</div>
</form>