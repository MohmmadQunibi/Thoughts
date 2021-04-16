<?php require APPROOT . "/views/inc/header.php"?>
<?php flash("post_message"); ?>
<div class="row">
<div class="col-md-6">
<h1>posts</h1>
</div>
<div class="col-md-6">
<a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary pull-right">
<i class="fa fa-pencil"></i> Add Post
</a>
</div>
</div>
<?php foreach($data["posts"] as $post) : ?>
<div class="card card-body mb-3 mt-3">
<h4 class="card-title"><?php echo $post->title ?></h4>
<div class="bg-light p-2 mv-3">
written by <?php echo $post->name; ?> on <?php echo $post->postCreation; ?>
</div>
<p class="card-dev mt-3 mb-3"><?php echo $post->body; ?></p>
<a href="<?php echo URLROOT ?>/posts/show/<?php echo $post->postId; ?>" class="btn btn-dark">Show more</a>
</div>
<?php endforeach; ?>
<?php require APPROOT . "/views/inc/footer.php"?>