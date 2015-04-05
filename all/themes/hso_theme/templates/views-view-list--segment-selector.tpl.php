<?php print $wrapper_prefix; ?>
  <?php print $list_type_prefix; ?>
  		<li class="views-row"><a href="#all" rel="all" class="active">Alle</a></li>
    <?php foreach ($rows as $id => $row): ?>
      <li class="<?php print $classes_array[$id]; ?>"><?php print $row; ?></li>
    <?php endforeach; ?>
  <?php print $list_type_suffix; ?>
<?php print $wrapper_suffix; ?>