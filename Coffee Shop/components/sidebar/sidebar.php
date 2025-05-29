<div class="sidebar">
    <p class="hideSidebarBtn center" title="Close"><i class="fas fa-chevron-left"></i></p>
<nav>
    <ul>
      <a href="index.php">
        <li class="active"><i class="fas fa-home"></i> Home</li>
      </a>
      <a href="./pages/cart.php">
        <li class="cartBtn"><span class="cartAlert"></span><i class="fas fa-shopping-cart"></i> Cart</li>
      </a>
      <a href="profile.php">
        <li><i class="fas fa-user-alt"></i>  Profile</li>
      </a>

      <a href="./pages/wishlist.php">
        <li class="wishListBtn"><span></span><i class="fas fa-heart"></i> Wish List</li>
      </a>

      <?php if(strlen($_SESSION['id'])==0){ ?>
      <a href="login.php">
        <li><i class="fas fa-sign-out-alt"></i> Sign In</li>
      </a>
      <?php 
      } else { ?>
      <a href="logout.php">
				<li><i class="fas fa-sign-out-alt"></i> Sign Out</li>
      </a>
			<?php } ?>	
</ul>
</nav>
</div>