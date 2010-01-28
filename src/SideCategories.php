<?php foreach (Entities::retrieveCategories() as $category) : ?>
<h2>/<?php echo $category ?></h2>
<div class="last_articles">
  <?php foreach (Entities::retrieveEntities(ARTICLES . '/' . $category) as $article) : ?>
  <h3>
    <a href="<?php echo Common::urlFor('view_article', array('token' => $article->getToken())) ?>">
   <?php echo substr($article->getTitle(), 0, 16) . "..." ?>
    </a>
  </h3>
  <?php endforeach; ?>
</div>
<?php endforeach; ?>
