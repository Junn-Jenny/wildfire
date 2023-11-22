<?php require 'partials/head.php' ?>

<?php require 'partials/nav.php' ?>
<div class="py-10">
  <?php require 'partials/banner.php' ?>
  <main>
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
    <ul class="mt-2 ml-3 mb-5">
   <?php foreach ($fires as $fire): ?>
       <li class='underline '>
          <a href="/details?forest=<?php echo "{$fire['NWCG_REPORTING_UNIT_NAME']}"; ?>" class="text-blue-800 hover:text-blue-300">
            <?php echo "{$fire['NWCG_REPORTING_UNIT_NAME']}"; ?>
          </a>
      </li>
   <?php endforeach; ?>
    </ul>

    <div class="ml-3">
    <?php if ($start_display_page > 1): ?>
          <a href="?page=1" class="text-blue-800 hover:text-blue-300">1</a>
          <span>...</span>
      <?php endif; ?>

      <?php for ($page = $start_display_page; $page <= $end_display_page; $page++): ?>
          <a href="?page=<?php echo $page; ?>" class="text-blue-800 hover:text-blue-300"><?php echo $page; ?></a>
      <?php endfor; ?>

      <?php if ($end_display_page < $total_pages): ?>
          <span>...</span>
          <a href="?page=<?php echo $total_pages; ?>" class="text-blue-800 hover:text-blue-300"><?php echo $total_pages; ?></a>
      <?php endif; ?>
    </div>

    </div>
    

  </main>
</div>
<?php require 'partials/foot.php' ?>