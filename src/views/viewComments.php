<?php $this->_t = 'Commentaires';?>
<div class="admin-comments-container">
    <div class="admin-comments-wrapper comments-preview">
        <h1>Commentaires en attente de vérification</h1>
        <?php foreach($pendingComments as $pendingComment):?>
        <div class="admin-comment-wrapper single-comment" id="<?= $pendingComment->id()?>">
            <h3><?= $pendingComment->author()?></h3>
            <h5><?= $pendingComment->date()?></h5>
            <p><?= $pendingComment->content()?></p>
            <div class="row">
                <a class="approve-comment" href="comments&approve=<?= $pendingComment->id()?>"><i class="fa-solid fa-check"></i> Approuver</a>
                <a class="delete-comment" id="<?= $pendingComment->id()?>" href="comments&delete=<?= $pendingComment->id()?>"><i class="fa-solid fa-trash-can"></i> Supprimer</a>
            </div>
            <?php foreach($replies as $reply):?>
                <?php if($reply->commentId() == $pendingComment->id()):?>
                <div class="single-comment">
                    <h4><?= $reply->author()?></h4>
                    <p><?= nl2br($reply->content())?></p>
                </div>
                <?php endif;?>
            <?php endforeach;?>
        </div>
        <?php endforeach;?>
    </div>

    <div class="admin-comments-wrapper comments-preview">
        <h1>Commentaires vérifiés</h1>
        <?php foreach($verifiedComments as $verifiedComment):?>
        <div class="admin-comment-wrapper single-comment" id="<?= $verifiedComment->id()?>">
            <h3><?= $verifiedComment->author()?></h3>
            <h5><?= $verifiedComment->date()?></h5>
            <p><?= $verifiedComment->content()?></p>
            <div class="row">
                <a class="reply-btn" id="<?= $verifiedComment->id()?>" href="comments&reply=<?= $verifiedComment->id()?>" page="comments"><i class="fa-solid fa-reply"></i> Répondre</a>
                <a class="delete-comment" id="<?= $verifiedComment->id()?>" href="comments&delete=<?= $verifiedComment->id()?>"><i class="fa-solid fa-trash-can"></i> Supprimer</a>   
            </div>
            <?php foreach($replies as $reply):?>
                <?php if($reply->commentId() == $verifiedComment->id()):?>
                <div class="single-comment">
                    <h4><?= $reply->author()?></h4>
                    <p><?= nl2br($reply->content())?></p>
                </div>
                <?php endif;?>
            <?php endforeach;?>
        </div>
        <?php endforeach;?>
    </div>
    
</div>