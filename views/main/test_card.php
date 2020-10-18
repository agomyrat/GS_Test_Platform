<!-- CARD -->
<div class="card">
    <div class="img-block">
        <img src="uploads/<?=$test_card['TEST_IMAGE']; ?>" alt="">
    </div>
    <article>
        <?=$test_card['TEST_NAME']; ?>
    </article>
    <div class="info-test">
        <span class="username"><?=$test_card['USER_NAME']; ?></span>
        <span class="date"><?=$test_card['CREATED_DATE']; ?></span>
    </div>
</div>