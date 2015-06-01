<?php
  // assign current menu group to a specific menu column (with class)
  $list_type_prefix = substr($list_type_prefix, 0, -1);
  reset($rows);
  $firstRowId = key($rows);  // id of first row in group

  // term id of first row in group
  //(Lehrgänge = 63, Management und Führung=62, Marketing und Verkauf=63, Organisation und Personal=64,
  // Finanzen=65, Höhere Fachschule = 66, Fachhochschule=67)
  $columnClass = ' class = "menu-view-column-';
  if ($title === 'Lehrgänge' || $title === 'Management und Organisation' || $title === 'Leadership und Personal') {
    $columnClass .= '1">';
  } elseif ($title === 'Finanzen' || $title === 'Marketing, Verkauf u. Tourismus') {
    $columnClass .= '2">';
  } else if ($title === 'Diplomstudium HF' || $title === 'Bachelor-Studium' || $title === 'Nachdiplomstudiengänge HF'){
    $columnClass .= '3">';
  }
  // create prefix with column class and print it
  $list_type_prefix .= $columnClass;
  print $list_type_prefix;
?>
  <?php if ($title === 'Management und Organisation'): ?>
    <li class="nolink-main clearfix"><?php print "Berufsakademie"; ?></li>
    <li class="nolink clearfix"><?php print $title; ?></li>
  <?php elseif ($title === 'Diplomstudium HF'): ?>
    <li class="nolink-main clearfix"><?php print "Höhere Fachschule für Wirtschaft"; ?></li>
    <li class="nolink clearfix"><?php print $title; ?></li>
  <?php else: ?>
    <li class="nolink clearfix"><?php print $title; ?></li>
  <?php endif; ?>
	<?php foreach ($rows as $id => $row): ?>
	  <li class="<?php print $classes_array[$id]; ?>"><?php print $row; ?></li>
	<?php endforeach; ?>
<?php print $list_type_suffix; ?>