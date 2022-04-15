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
                <button class="submit-btn" type="submit">Envoyer</button>
            </form>
        </div>
        
        <div class="comments-preview">
            <?php foreach($comments as $comment): ?>
            <div class="single-comment" id="<?= $comment->id()?>">
                <h4><?= $comment->author()?></h4>
                <p><?= nl2br($comment->content())?></p>
                <?php if(isLoggedIn()):?>
                <div class="row">
                    <a class="reply-btn" id="<?= $comment->id()?>" href="comments&reply=<?= $comment->id()?>" page="article&id=<?=$article[0]->id()?>"><i class="fa-solid fa-reply"></i> Répondre</a>
                    <a class="delete-comment" id="<?= $comment->id()?>" href="comments&delete=<?= $comment->id()?>"><i class="fa-solid fa-trash-can"></i> Supprimer</a>   
                </div>
                <?php endif;?>
                <?php foreach($replies as $reply):?>
                    <?php if($reply->commentId() == $comment->id()):?>
                    <div class="single-comment">
                        <h4><?= $reply->author()?></h4>
                        <p><?= nl2br($reply->content())?></p>
                    </div>
                    <?php endif;?>
                <?php endforeach;?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
