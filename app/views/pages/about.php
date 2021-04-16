<?php require APPROOT . "/views/inc/header.php"; ?>
<div class="jumbotron jumbotron-flud">
<div class="container">
<h1 class="display-3"><?php echo $data["title"]; ?></h1>
<p><?php echo $data["description"]; ?></p>
<P>Version:  <strong><?PHP echo APPVERSION ?></strong></P>
</div>
</div>
<?php require APPROOT . "/views/inc/footer.php"; ?>