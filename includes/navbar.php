<!-- Navbar -->
<nav class="bg-dark text-light px-5 py-3 d-flex justify-content-between align-items-center gap-5" style="width:100%;margin:0">
 
            <!-- Logo/Brand -->
            <div class="h-100 d-flex align-items-center  ">
                <a class="navbar-brand " href="index.php" >
                    <img src="../assets/images/basicbazaarlogo.png" alt="Logo" class="logo">
                </a>
            </div>
            
           

            <!-- Toggle button for mobile
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> -->

            <!-- Search Bar -->
            <div class="h-100  d-flex align-items-center flex-grow-1 " >
            <form class="d-flex col-12" method="GET" action="index.php">
                <input class="flex-grow-1 p-2 px-3 border border-0 rounded-start" 
                    type="search" 
                    placeholder="Search" 
                    name="search_input" 
                    aria-label="Search" 
                    value="<?php echo isset($_GET['search_input']) ? htmlspecialchars($_GET['search_input']) : ''; ?>" 
                    required>
                <button class="bg-primary-subtle p-2 px-2 border border-0 rounded-end" type="submit">Search</button>
            </form>

            </div>
            

            <!-- Navigation Links -->
            <div class="h-100 d-flex  justify-content-center align-items-center ">
                
                    <div class="d-flex align-middle list-unstyled gap-4 ">
                        <li  class="nav-item   h-100">
                            <a class="nav-link text-light" href="index.php">Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="cart.php"><i class="fas fa-shopping-cart fs-4"></i></a>
                        </li>

                        <li class="nav-item">
                           <?php if(!$_SESSION['logged_in']) {
                            echo '<a class="nav-link text-light" href="signup.php">Sign Up</a>';
                           }else{
                            echo '<a class="nav-link text-light" href="account.php"><i class="far fa-user-circle fs-4"></i></a>';
                           } 
                           ?>
                        </li>
                       
                    </div>
        
                
            </div>

            
  
    </nav>
