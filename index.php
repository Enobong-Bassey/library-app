<?php require './includes/upHead.php'; ?>

<title>Readers Library - Home</title>
<meta name="description" content="">

<?php 
    require './includes/downHead.php'; 
    require './includes/header.php';
?>


        <li class="nav-item">
          <a class="nav-link active" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="start-a-borrow.php">Start a Borrow</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Manage Staff</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="newStaff.php">New Staff</a></li>
            <li><a class="dropdown-item" href="assignStaff.php">Assign Staff</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Member Activity</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="borrowBook.php">Borrow a Book</a></li>
            <li><a class="dropdown-item" href="returnBook.php">Return a Book</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Manage Books</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="newBook.php">New Book</a></li>
            <li><a class="dropdown-item" href="editBook.php">Edit a Book</a></li>
            <li><a class="dropdown-item" href="deleteBook.php">Delete a Book</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <a class="btn btn-primary" href="./signup.php" style="margin-right: 100px;">Sign up</a>
  </div>
</nav>
    
  </div>
</nav>
<h1 style="font-family: 'Roboto', sans-serif; font-size: 2em; font-weight: 700; text-align: left; padding-left: 60px; margin-top: -150px; color: cyan; z-index: auto;">Readers Library, Fredericton</h1>
</header>
<main>
  <div class="container text-center" style="margin-top: 150px;">
    <h2><span style="text-align: center;"><i class="fa-solid fa-book-open-reader"></i><br>Readers Library</span></h2>
  </div>
  <div class="container" id="briefhistory"></div>
  <div class="container" id="">
    <div class="row">
      <h4 id="bookSearchHeader">Brief History</h4><hr>
      <p>Libraries are cornerstones of our communities as hubs for knowledge, research, history, and so much more. They are places where people can connect with others and invest in their own future.
        Since its inception way back in 1761, when Readers Library first opened its doors to the its first knowledge seeking readers, she has remained a huge resource to her community, not only by way of 
        the daily physical visitors but also to its numerous members online.
      </p>
    </div>    
  </div>   
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-6 text-center">
        <img src="./assets/images/appimg/very apt for researchers.jpg" width="100%">
        <h6>A researcher's number 1 choice.</h6>
      </div>
      <div class="col-md-3 col-sm-6 text-center">
        <img src="./assets/images/appimg/neat environments.jpg" width="100%">
        <h6>Neat, tidy and very hygenic environment.</h6>
      </div>
      <div class="col-md-3 col-sm-6 text-center">
        <img src="./assets/images/appimg/suitable for you n friend.jpg" width="100%">
        <h6>Achieve higher results with a friend</h6>
      </div>
      <div class="col-md-3 col-sm-6 text-center">
        <img src="./assets/images/appimg/private just like home.jpg" width="100%">
        <h6>Pick the spot meant just for you.</h6>
      </div>
    </div>
  </div> 
  <div class="container"></div>
</main>