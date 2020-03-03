<?php include("includes/header.php"); ?>
<?php 

  $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
  $items_per_page = 8;
  $items_total_count = Photo::countAll();

  $paginate = new Paginate($page, $items_per_page, $items_total_count);

  $sql = "SELECT * FROM photos LIMIT {$items_per_page} OFFSET {$paginate->offset()}";

  $photos = Photo::findByQuery($sql);
 ?>

<div class="row">
  <!-- Blog Entries Column -->
  <div class="col-md-12">
    <div class="row thumbnails">
      <?php foreach ($photos as $photo) : ?>
      <div class="col-xs-6 col-md-3">
        <a href="photo.php?id=<?php echo $photo->id; ?>" class="thumbnail">
          <img class="img-responsive home-picture" src="admin/<?php echo $photo->picturePath(); ?>" alt="">
        </a>
      </div>
      <?php endforeach; ?> 
    </div>
    <div class="row">
      <ul class="pager">
        <?php 

          if($paginate->pageTotal() > 1) {
            if($paginate->hasNext()) {
              echo '<li class="next"><a href="index.php?page={$paginate->next()}">Next</a></li>';
            } 

            for ($i=1; $i <= $paginate->pageTotal(); $i++) { 
              if ($i == $paginate->current_page) {
                echo '<li class="active"><a href="index.php?page="{$i}">{$i}</a></li>';
              } else {
                echo '<li><a href="index.php?page="{$i}">{$i}</a></li>';
              }
            }

            if($paginate->hasPrevious()) {
              echo '<li class="previous"><a href="index.php?page={$paginate->previous()}">Previous</a></li>';
            }
          }

         ?>
      </ul>
    </div>
  </div>
</div> 
<!-- /.row -->

<?php include("includes/footer.php"); ?>
