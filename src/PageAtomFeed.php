<?php
require_once('src/ModelEntities.php');
?>
<?php echo '<?xml version="1.0" encoding="utf-8"?>' ?>

<feed xmlns="http://www.w3.org/2005/Atom">

  <title>mxs_area</title>
  <subtitle><?php echo TITLE ?></subtitle>
  <link href="http://aimxhaisse.com/"/>
  <author>
    <name>Sebastien Rannou</name>
    <email>rannou.sebastien@gmail.com</email>
  </author>

  <?php foreach (Entities::retrieveGroupedEntities(ARTICLES) as $article) : ?>
  <entry>
    <title><?php echo $article->getTitle() ?></title>
    <link href="<?php echo ROOT_URI .
		Common::urlFor('view_article',
		array('token' => $article->getToken())) ?>"/>
    <updated><?php echo date(DATE_ATOM, $article->getTimestamp()); ?></updated>
    <summary type="xhtml"><?php echo substr(Ascii::generateHTML($article->getContent()), 0, 512); ?>...</summary>
  </entry>
  <?php endforeach; ?>

</feed>
<?php exit; ?>
