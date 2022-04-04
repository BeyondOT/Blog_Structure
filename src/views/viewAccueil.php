<div>
<?php $this->_t = 'Mon Blog';
foreach($articles as $article): ?>
<h2>
    <?= $article->title() ?>
</h2>
<?php endforeach; ?>
</div>