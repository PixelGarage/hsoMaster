<?php print $list_type_prefix; ?>
	<li class="selector nolink clearfix">Lehrg&#228;nge<span class="arrow_wrapper"><span class="arrow"></span></span></li>
	<?php foreach ($rows as $id => $row): ?>
		<li class="<?php print $classes_array[$id]; ?>"><?php print $row; ?></li>
	<?php endforeach; ?>
<?php print $list_type_suffix; ?>