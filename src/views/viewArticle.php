<?php $this->_t = $article[0]->title()?>
<div class="l-article article">
    <div class="article-header">
        <h1><?= $article[0]->title()?></h1>
        <h2><?= $article[0]->date()?></h2>
    </div>

    <div class="article-content">
        <article><?= nl2br($article[0]->content())?></article>
    </div>

    <!-- Section Commentaire : ------------- -->
    <div class="comment-section">
        <h2>Section coommentaire </h2>
        <div class="l-comment-form comment-form">
            <h3>Votre Commentaire :</h3>
            <form method="post" action="article&id=<?=$article[0]->id()?>&status=new_comment">
                <div>
                    <label for="pseudo">Pseudo :</label>
                    <input class="input-pseudo" type="text" name="pseudo" placeholder="Votre pseudo">
                    <span class="invalidFeedback">
                    <?php echo $data['authorError']?>
                    </span>
                </div>
                <div>
                    <label for="comment">Commentaire :</label>
                    <textarea class="input-comment" name="comment" placeholder="Votre commentaire..."></textarea>
                    <span class="invalidFeedback">
                    <?php echo $data['commentError']?>
                    </span>
                </div>
                <button type="submit">Envoyer</button>
            </form>

            <?php foreach($comments as $comment): ?>
            <div class="comment">
                <h3><?= $comment->author()?></h3>
                <p><?= $comment->content()?></p>
            </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>
