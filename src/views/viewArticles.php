
    <?php $this->_t = 'Articles';
    foreach($articles as $article): ?>
    <h2 class="articles-title"><a href="article&id=<?=$article->id()?>"><?= $article->title()?></a></h2>

    <?php endforeach; ?>
