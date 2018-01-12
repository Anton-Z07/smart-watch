<div class="title"> <h1>Отзывы</h1> </div>

<? foreach (array_reverse($reviews) as $r) { ?>
  <div class="review"> 
    <h2><?= $r->title; ?></h2>
    <p><?= $r->text; ?></p>
    <span class="author"><?= $r->name . date(', d.m.Y', strtotime($r->date)); ?></span>
    <div style="clear: both;"></div>
  </div>
<? } ?>


<form method="POST">
  <?= $message; ?> <br /><br />
  <div>
    <input type="text" placeholder='Заголовок' name="title" value="<?= $review->title; ?>">
  </div>
  <div>
    <input type="text" placeholder='Ваше имя' name="name" value="<?= $review->name; ?>">
  </div>
  <div>
    <textarea rows="5" placeholder='Ваш отзыв' name="text"><?= $review->text; ?></textarea>
  </div>
  <input type="submit" style="float: right;" class="submit" value="Оставить отзыв">
</form>
<div style="clear: both;"></div>