<?php require 'partials/head.php' ?>

<?php require 'partials/nav.php' ?>
<div class="py-10">
  <?php require 'partials/banner.php' ?>
  <main>
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="mt-8 px-4 sm:px-6 lg:px-8">
      <a href='/'><button type="button" class="rounded bg-indigo-600 px-2 py-1 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Back to Lisitng</button></a>
        <div class="mt-4 flow-root">
          <div class="-mx-2 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
              <table class="min-w-full divide-y divide-gray-300">
                <thead>
                  <tr>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">FDA ID</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Fireman</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Cause</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date Discovery</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Time Discovery</th>

                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                  <?php foreach ($forests as $row) : ?>
                    <tr>
                      <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0"><?= $row['FPA_ID'] ?></td>
                      <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><?= $row['FIRE_NAME'] ?></td>
                      <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><?= $row['STAT_CAUSE_DESCR'] ?></td>
                      <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><?= $row['DISCOVERY_DATE'] ?></td>
                      <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><?= $row['DISCOVERY_TIME'] ?></td>

                    </tr>
                  <?php endforeach; ?>


                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>


      <div class="ml-3">
        <?php if ($start_display_page > 1) : ?>
          <a href="?page=1&forest=<?= $forest ?>" class="text-blue-800 hover:text-blue-300">1</a>
          <span>...</span>
        <?php endif; ?>

        <?php for ($page = $start_display_page; $page <= $end_display_page; $page++) : ?>
          <a href="?page=<?php echo $page; ?>&forest=<?= $forest ?>" class="text-blue-800 hover:text-blue-300"><?php echo $page; ?></a>
        <?php endfor; ?>

        <?php if ($end_display_page < $total_pages) : ?>
          <span>...</span>
          <a href="?page=<?php echo $total_pages; ?>&forest=<?= $forest ?>" class="text-blue-800 hover:text-blue-300"><?php echo $total_pages; ?></a>
        <?php endif; ?>
      </div>


    </div>


  </main>
</div>
<?php require 'partials/foot.php' ?>