<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item"><a class="page-link" href="?page=1">First</a></li>
    <?php if($page > 1): ?>
      <li class="page-item"><a class="page-link" href="?page=<?php echo ($page - 1); ?>">Prev</a></li>
    <?php endif; ?>

<!--      Проверяет, если страница 1-я или 2-я, то выводит только две следующие-->
      <?php if($page <= 2): ?>
              <li class="page-item"><a class="page-link" href="?page=<?= $page; ?>"><?= $page; ?></a></li>
        <?php if($total_pages - $page == 1 or $total_pages - $page == 0): ?>
        <?php else: ?>
              <?php for($i = 1; $i <= 2; $i++): ?>
                  <li class="page-item"><a class="page-link" href="?page=<?= ($page + $i); ?>"><?= ($page + $i); ?></a></li>
              <?php endfor; ?>
          <?php endif; ?>
<!--Если страница 3-я и далее, то выводит две предыдущие и две следующие-->
          <?php else: ?>
            <?php for($i = 2; $i >= 1; $i--): ?>
                  <li class="page-item"><a class="page-link" href="?page=<?= ($page - $i); ?>"><?= ($page - $i); ?></a></li>
            <?php endfor; ?>
                  <li class="page-item"><a class="page-link" href="?page=<?= $page; ?>"><?= $page; ?></a></li>
<!--      Проверяет, если страница последняя, то не выводит две следующие страницы-->
            <?php if($page == $total_pages): ?>
            <?php else: ?>
            <?php for($i = 1; $i <= 2; $i++): ?>
                  <li class="page-item"><a class="page-link" href="?page=<?= ($page + $i); ?>"><?= ($page + $i); ?></a></li>
            <?php endfor; ?>
          <?php endif; ?>
      <?php endif; ?>

    <?php if($page != $total_pages): ?>
       <li class="page-item"><a class="page-link" href="?page=<?php echo ($page + 1); ?>">Next</a></li>
    <?php endif; ?>
    <li class="page-item"><a class="page-link" href="?page=<?php echo $total_pages; ?>">Last</a></li>
  </ul>
</nav>
