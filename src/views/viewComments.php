<div class="admin-comments-container">
    <div class="admin-comments-wrapper">
        <h1>Pending</h1>
        <?php foreach($pendingComments as $pendingComment):?>
        <div class="admin-comment-wrapper" id="<?= $pendingComment->id()?>">
            <h3><?= $pendingComment->author()?></h3>
            <p><?= $pendingComment->content()?></p>
            <a href="comments&approve=<?= $pendingComment->id()?>">Approuver</a>
            <a class="delete-comment" id="<?= $pendingComment->id()?>" href="comments&delete=<?= $pendingComment->id()?>">Supprimer</a>
        </div>
        <?php endforeach;?>
    </div>

    <div class="admin-comments-wrapper">
        <h1>Verifed</h1>
        <?php foreach($verifiedComments as $verifiedComment):?>
        <div class="admin-comment-wrapper" id="<?= $verifiedComment->id()?>">
            <h3><?= $verifiedComment->author()?></h3>
            <p><?= $verifiedComment->content()?></p>
            <a class="delete-comment" id="<?= $verifiedComment->id()?>" href="comments&delete=<?= $verifiedComment->id()?>">Supprimer</a>   
        </div>
        <?php endforeach;?>
    </div>
    
</div>