<?php require_once(drupal_get_path('theme','megatron') . '/includes/panels-inc.php'); ?>
<!-- -*- mode: html-helper; before-save-hook: nil -*- -->

<div class="panel-display panel-three-four-adaptive clear-block" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
 <?php if ($content['full-width']): ?>
 <!-- full width content -->
 <div class="panel-panel line inflate">
   <div class="panel-panel unit span12">
     <?php print $content['full-width']; ?>
   </div>
 </div>
 <?php endif ?>
 <?php
   for ($i = 0; $i < 9; $i += 3):
     // Get the $content array keys of all non empty entries.
     $keys = array_keys(array_filter(array_slice($content, $i, 3, TRUE)));
     $h = megatron_hash($keys, 3, 'megatron_get_digit');
     // If all the row elements are empty then jump to the next row
     // immediately.
     if ($h == 0) continue;
 ?>

  <!-- 3x3 grid -->
  <?php if ($h == 1): ?><!-- 100% - 1 column -->
  <div class="panel-panel line">
    <div class="panel-panel span12">
      <?php print $content[$keys[0]]; ?>
    </div>
  </div>
  <?php endif; ?>
  
  <?php if ($h == 3 || $h == 5): ?><!-- 33/66% - 2 columns -->
  <div class="panel-panel line">
    <div class="panel-panel unit span4">
      <div class="inside">
        <?php print $content[$keys[0]]; ?>
      </div>
    </div>

    <div class="panel-panel unit span8">
      <div class="inside">
        <?php print $content[$keys[1]]; ?>
      </div>
    </div>
  </div>
  <?php endif; ?>
  
  <?php if ($h == 4): ?><!-- 66/33% - 2 columns -->
  <div class="panel-panel line">
    <div class="panel-panel unit span8">
      <div class="inside">
        <?php print $content[$keys[0]]; ?>
      </div>
    </div>

    <div class="panel-panel unit span4">
      <div class="inside">
        <?php print $content[$keys[1]]; ?>
      </div>
    </div>
  </div>
  <?php endif; ?>
  
  <?php if ($h == 6): ?><!-- 33/33/33% - 3 columns -->
  <div class="panel-panel line">
    <div class="panel-panel unit span4">
      <div class="inside">
        <?php print $content[$keys[0]]; ?>
      </div>
    </div>

    <div class="panel-panel unit span4">
      <div class="inside">
        <?php print $content[$keys[1]]; ?>
      </div>
    </div>

    <div class="panel-panel unit span4">
      <div class="inside">
        <?php print $content[$keys[2]]; ?>
      </div>
    </div>
  </div>
  <?php endif; ?>
 <?php endfor; ?>
 
 <?php if ($content['full-width-middle']): ?>
 <!-- full width content -->
 <div class="panel-panel line inflate">
   <div class="panel-panel unit span12">
     <?php print $content['full-width-middle']; ?>
   </div>
 </div>
 <?php endif ?>
  
 <!-- 4x4 grid -->
 <?php
   for ($j = 9; $j < 25; $j += 4): 
     // Get the $content array keys of all non empty entries.
     $keys = array_keys(array_filter(array_slice($content, $j, 4, TRUE)));
     $h = megatron_hash($keys, 4, 'megatron_get_digit');
     // If all the row elements are empty then jump to the next row
     // immediately.
     if ($h == 0) continue;
 ?>

  <?php if ($h == 1): ?><!-- 100% - 1 column -->
  <div class="panel-panel line">
    <div class="panel-panel unit span12">
      <?php print $content[$keys[0]]; ?>
    </div>
  </div>
  <?php endif; ?>
  
  <?php if ($h == 3): ?><!-- 25/75% - 2 columns -->
  <div class="panel-panel line">
    <div class="panel-panel unit span3">
      <div class="inside">
        <?php print $content[$keys[0]]; ?>
      </div>
    </div>

    <div class="panel-panel unit span9">
      <div class="inside">
        <?php print $content[$keys[1]]; ?>
      </div>
    </div>
  </div>
  <?php endif; ?>
  
  <?php if ($h == 4): ?><!-- 50/50% - 2 columns -->
  <div class="panel-panel line">
    <div class="panel-panel unit span6">
      <div class="inside">
        <?php print $content[$keys[0]]; ?>
      </div>
    </div>

    <div class="panel-panel unit span6">
      <div class="inside">
        <?php print $content[$keys[1]]; ?>
      </div>
    </div>
  </div>
  <?php endif; ?>
  
  <?php if ($h == 5): ?><!-- 75/25% - 2 columns -->
  <div class="panel-panel line">
    <div class="panel-panel unit span9">
      <div class="inside">
        <?php print $content[$keys[0]]; ?>
      </div>
    </div>

    <div class="panel-panel unit span3">
      <div class="inside">
        <?php print $content[$keys[1]]; ?>
      </div>
    </div>
  </div>
  <?php endif; ?>
  
  <?php if ($h ==6 || $h == 9): ?><!-- 25/25/50% - 3 columns -->
  <div class="panel-panel line">
    <div class="panel-panel unit span3">
      <div class="inside">
        <?php print $content[$keys[0]]; ?>
      </div>
    </div>

    <div class="panel-panel unit span3">
      <div class="inside">
        <?php print $content[$keys[1]]; ?>
      </div>
    </div>

    <div class="panel-panel unit span6">
      <div class="inside">
        <?php print $content[$keys[2]]; ?>
      </div>
    </div>
  </div>
  <?php endif; ?>
  
  <?php if ($h == 7): ?><!-- 25/50/25% - 3 columns -->
  <div class="panel-panel line">
    <div class="panel-panel unit span3">
      <div class="inside">
        <?php print $content[$keys[0]]; ?>
      </div>
    </div>

    <div class="panel-panel unit span6">
      <div class="inside">
        <?php print $content[$keys[1]]; ?>
      </div>
    </div>

    <div class="panel-panel unit span3">
      <div class="inside">
        <?php print $content[$keys[2]]; ?>
      </div>
    </div>
  </div>
  <?php endif; ?>
  
  <?php if ($h == 8): ?><!-- 50/25/25% - 3 columns -->
  <div class="panel-panel line">
    <div class="panel-panel unit span6">
      <div class="inside">
        <?php print $content[$keys[0]]; ?>
      </div>
    </div>

    <div class="panel-panel unit span3">
      <div class="inside">
        <?php print $content[$keys[1]]; ?>
      </div>
    </div>

    <div class="panel-panel unit span3">
      <div class="inside">
        <?php print $content[$keys[2]]; ?>
      </div>
    </div>
  </div>
  <?php endif; ?>
  
  <?php if ($h == 10): ?><!-- 25/25/25/25% - 4 columns -->
  <div class="panel-panel line">
    <div class="panel-panel unit span3">
      <div class="inside">
        <?php print $content[$keys[0]]; ?>
      </div>
    </div>

    <div class="panel-panel unit span3">
      <div class="inside">
        <?php print $content[$keys[1]]; ?>
      </div>
    </div>

    <div class="panel-panel unit span3">
      <div class="inside">
        <?php print $content[$keys[2]]; ?>
      </div>
    </div>

    <div class="panel-panel unit span3">
      <div class="inside">
        <?php print $content[$keys[3]]; ?>
      </div>
    </div>
  </div>
  <?php endif; ?>
 <?php endfor; ?>
 <?php if ($content['full-width-lower']): ?>
 <!-- full width content -->
 <div class="panel-panel line inflate">
   <div class="panel-panel unit span12">
     <?php print $content['full-width-lower']; ?>
   </div>
 </div>
 <?php endif ?>
</div>
