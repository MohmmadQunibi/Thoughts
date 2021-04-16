<nav class="navbar navbar-expand-lg navbar-light bg-light rounded mb-3" aria-label="Eleventh navbar example">
      <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo URLROOT; ?>"><?php echo SITENAME; ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample09">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="<?php echo URLROOT; ?>">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo URLROOT; ?>/pages/about">About</a>
            </li>
            <!--<li class="nav-item">
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>-->
            <!--<li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</a>
              <ul class="dropdown-menu" aria-labelledby="dropdown09">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>-->
          </ul>
          <!--<form>
            <input class="form-control" type="text" placeholder="Search" aria-label="Search">
          </form>-->

          <ul class="navbar-nav m1-auto mb-2 mb-lg-0">
          <?php if(isset($_SESSION["user_id"])) :  ?>
          <li class="nav_item">
          <a href="" class="nav-link" aria-current="page">Welcome <?php echo $_SESSION["user_name"] ?></a>
          </li>
          <li class="nav_item">
          <a href="<?php echo URLROOT ?>/users/logout" class="nav-link" aria-current="page">Logout</a>
          </li>
          <?php else : ?>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="<?php echo URLROOT; ?>/users/register">register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo URLROOT; ?>/users/login">Login</a>
            </li>
            <?php endif; ?>
            </ul>
        </div>
      </div>
    </nav>