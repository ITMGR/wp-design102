<?php

$categories = get_terms([
  'orderby' => 'name',
  'taxonomy' => 'project_category',
  'value_field' => 'slug',
]);

$filter_url = function($category = false) {
  $args = [];
  if ($category) {
    $args['category'] = $category;
  }
  return add_query_arg($args, get_the_permalink());
};

$project_category = get_query_var('category');
if (!empty($project_category)) {
  $project_category = get_term_by('slug', $project_category, 'project_category');
  $selected = $project_category->name;
}
else {
  $selected = 'All';
}

?>

<div class="case-study-filter">
  Viewing

  <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?= wptexturize(strtolower($selected)) ?> projects
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" href="<?php the_permalink(); ?>">All projects</a>
    <div class="dropdown-divider"></div>
    <h6 class="dropdown-header">Filter by</h6>
    <?php foreach ($categories as $category): ?>
      <a class="dropdown-item" href="<?= $filter_url($category->slug) ?>">
        <?= wptexturize($category->name) ?>
      </a>
    <?php endforeach; ?>
  </div>
</div>
