
<?php $this->_t = 'Articles'; ?>
<div class="cards">
<?php foreach($articles as $article): ?>

<a class="card" href="article&id=<?=$article->id()?>">
    <!-- <img class="card-image" src="../../../Projet/img/articleDefault.jpg" alt="FillerPicture"></img> -->
    <h2 class="card-title"><?= $article->title()?></h2>
    <div class="card-description">
        <p><?= $article->content()?></p>
    </div>
    <h3 class="card-date"><?= $article->date()?></h3>
</a>

<?php endforeach; ?>

</div>