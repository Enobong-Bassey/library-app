<?php
    session_start();
    require './includes/upHead.php';  
?>

    <title>Readers Library - Home</title>
    <meta name="description" content="">
    
<?php 
    require './includes/downHead.php'; 
    require './includes/header.php';
?>

<style>

   

    :root {

    --step--2: clamp(0.69rem, calc(0.58rem + 0.60vw), 1.00rem);

    --step--1: clamp(0.83rem, calc(0.67rem + 0.81vw), 1.25rem);

    --step-0: clamp(1.00rem, calc(0.78rem + 1.10vw), 1.56rem);

    --step-1: clamp(1.20rem, calc(0.91rem + 1.47vw), 1.95rem);

    --step-2: clamp(1.44rem, calc(1.05rem + 1.95vw), 2.44rem);

    --step-3: clamp(1.73rem, calc(1.21rem + 2.58vw), 3.05rem);

    --step-4: clamp(2.07rem, calc(1.39rem + 3.40vw), 3.82rem);

    --step-5: clamp(2.49rem, calc(1.60rem + 4.45vw), 4.77rem);

       

        --color-primary: #0092ca;

        --color-secondary: #20447d;

        --color-primary-dark:#192294;

        --color-error:#cc3333;

        --color-success:#4bb544;

        --color-link:#606470;

        --color-link-dark:#3c4245;

        --color-background:#f5f9ee;

        --color-border-sc:#ececec;

        --color-border-focus:#a9d7f6;

        --color-border:#eeeeee;

        --bs:#ffa857;

        --color-dark-grey:#a4a3a3;

        --gradient: linear-gradient(135deg var(--color-primary), var(--color-secondary));

       

        --main-color: #6dd5ed;

    --secondary-color: #20447d;

    --gradient: linear-gradient(

        135deg,

        var(--main-color),

        var(--secondary-color)

    );  

    }

 

    /* Remove default margin */

    body,

    h1,

    h2,

    h3,

    h4,

    p,

    figure,

    blockquote,

    dl,

    dd {

    margin: 0;

    }

 

    /* Make images easier to work with */

    img,

    picture {

    max-width: 100%;

    display: block;

    }

 

    /* Inherit fonts for inputs and buttons */

    input,

    button,

    textarea,

    select {

    font: inherit;

    }

 

    /* Remove all animations, transitions and smooth scroll for people that prefer not to see them */

    @media (prefers-reduced-motion: reduce) {

    html:focus-within {

    scroll-behavior: auto;

    }

   

    *,

    *::before,

    *::after {

        animation-duration: 0.01ms !important;

        animation-iteration-count: 1 !important;

        transition-duration: 0.01ms !important;

        scroll-behavior: auto !important;

    }

    }

    .container {

        position: relative;

        width: 100%;

        max-width: 780px;

        height: 450px;

        background: #fff;

        border-radius: 1rem;

        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);

        padding: 3rem 0;

        overflow: hidden;

    }

    .form-container {

        position: absolute;

        top: 0;

        width: 50%;

        height: 100%;

        -webkit-transition: all .6s ease-in-out;

        transition: all .6s ease-in-out;

    }

    form {

        width: 100%;

        height: 100%;

        display: flex;

        -ms-flex-pack: center;

        justify-content: center;

        -ms-flex-align: center;

        align-items: center;

        flex-direction: column;

        background-color: #fff;

        padding: 0 2.5rem;

        text-align: center;

    }

    .header {

        color: var(--color-primary-dark);

        font-size: var(--step-1);

        font-weight: 500;

        text-align: center;

        letter-spacing: 1px;

    }

 

    .sign-in-container {

        width: 50%;

        height: 100%;

        left: 0;

        z-index: 2;

    }

 

    .container.right-panel-active .sign-in-container {

        -webkit-transform: translateX(100%);

        transform: translateX(100%);

    }

 

    .sign-up-container {

        left: 0;

        width: 50%;

        height: 100%;

        opacity: 0;

        z-index: 1;

    }

 

    .container.right-panel-active .sign-up-container {

        -webkit-transform: translateX(100%);

        transform: translateX(100%);

        opacity: 1;

        z-index: 5;

        animation: show 0.6s;

    }

 

    @keyframes show {

    0%,

    49.99% {

        opacity: 0;

        z-index: 1;

    }

    50%,

    100% {

        opacity: 1;

        z-index: 5;

    }

    }

    .overlay-container {

        position: absolute;

        top: 0;

        left: 50%;

        width: 50%;

        height: 100%;

        overflow: hidden;

        transition: transform .6s ease-in-out;

        z-index: 100;

    }

    .container.right-panel-active .overlay-container {

        transform: translateX(-100%);

    }

    .overlay {

        position: relative;

        top: 0;

        left: -100%;

        width: 200%;

        height: 100%;

        color: #fff;

        -webkit-transform: translateX(0);

        transform: translateX(0);

        background: var(--secondary-color);

        background: var(--gradient);

        background-repeat: no-repeat;

        background-size: cover;

        -webkit-transition: transform .6s ease-in-out;

        transition: transform .6s ease-in-out;

    }

    .container.right-panel-active .overlay {

        -webkit-transform: translateX(50%);

        transform: translateX(50%);

    }

    .overlay-panel {

        position: absolute;

        top: 0;

        width: 50%;

        height: 100%;

        display: flex;

        -ms-flex-pack: center;

        justify-content: center;

        -ms-flex-align: center;

        align-items: center;

        flex-direction: column;

        text-align: center;

        padding: 0 4.4rem;

        -webkit-transform: translateX(0);

        transform: translateX(0);

        -webkit-transition: transform .6s ease-in-out;

        transition: transform .6s ease-in-out;

    }

 

    .overlay-left {

        -webkit-transform: translateX(-15%);

        transform: translateX(-15%);

    }

    .container.right-panel-active .overlay-left {

        -webkit-transform: translateX(0);

        transform: translateX(0);

    }

    .overlay-right {

        right: 0;

        top: 0;

        left: 50%;

        transform: translateX(0);

    }

    .container.right-panel-active .overlay-right {

        -webkit-transform: translateX(-15%);

        transform: translateX(-15%);

    }

 

    span.under__social {

        display: grid;

        place-items: center;

        letter-spacing: 1px;

        margin-top: 1.8rem;

    }

 

    a.link,

    a.login-link {

        color: var(--color-link);

    }

 

    a.link:hover,

    a.login-link:hover {

        color: var(--color-link-dark);

        text-decoration: underline;

        -webkit-transition: all .4s ease;

        transition: all .4s ease;

    }

    .button-input-group {

        width: 100%;

        display: grid;

        place-items: center;

        margin-top: .5rem;

    }

    .group {

        width: 100%;

        height: 47px;

        margin-bottom: 1.3rem;

    }

    .group input,

    .group button {

        width: 100%;

        height: 100%;

        border: none;

        outline: none;

        border-radius: .4rem;

    }

    .group input {

        border: 2px solid var(--color-border);

        padding: 0 1.1rem;

    }

    .group input::placeholder {

        opacity: .8;

    }

    .alert-text .help__text{

        position: absolute;

        left: 3.2rem;

        font-size: var(--step--2);

        margin-top: -1rem;

        opacity: .5;

    }

    .alert-text.signup__alert {

        margin-bottom: 2.2rem;

    }

    .form-link.forgot {
        margin: -.3rem 0 1.5rem 0;
    } 

    input:focus,
    input:not(:placeholder-shown) {
        background-color: var(--color-background);
        border-color: var(--color-border-focus);
    } 

    input:focus,
    input:placeholder-shown {
        box-shadow: 0 0 0 2px var(--color-border-focus);
    } 

    input:focus:valid {
        box-shadow: 0 0 0 2px var(--color-success);
    } 

    input:valid:not(:placeholder-shown) {
        border-color: var(--color-success);
    } 

    input:focus:invalid {
        box-shadow: 0 0 0 2px var(--color-error);
    }

 

    input:invalid:not(:placeholder-shown) {

        border-color: var(--color-error);

    }

 

    .group.button-group {

        width: 70%;

    }

    button {

        width: 80%;

        height: 10%;

        color: #fff;

        margin-top: 55px;

        background-color: var(--color-primary);

        cursor: pointer;

        -webkit-transition: all .3s ease;

        transition: all .3s ease;

    }

    .group button:hover {

        background-color: var(--color-secondary);

    }

    .group button:hover {

    background: var(--color-secondary);

    }

    .group button:active {

    transform: scale(0.95);

    }

    .group button:focus {

    outline: none;

    }

    .group button.ghost {

    background-color: transparent;

    border: 1px solid #fff;

    margin-top: 1.8rem;

    }

    .group button.ghost:hover {

    background: #fff;

    color: var(--color-primary);

    }

</style>
<li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
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
  </div>
</nav>
<h1 style="font-family: 'Roboto', sans-serif; font-size: 2em; font-weight: 700; text-align: left; padding-left: 60px; margin-top: -150px; color: cyan; z-index: auto;">Readers Library, Fredericton</h1>
</header>


    <main>
      <h3 style="color: red; text-align: center;">
        <?php
          if(isset($_SESSION["accessError"])) {
            echo $_SESSION["accessError"];
            $_SESSION["accessError"] = "";
          }
          if(isset($_SESSION["message"])) {
            echo $_SESSION["message"];
            $_SESSION["message"] = "";
          }
          if(isset($_SESSION["invalidUser"])) {
            echo $_SESSION["invalidUser"];
            $_SESSION["invalidUser"] = "";
          }
        ?>
      </h3>
      <h3 style="color: green; text-align: center;">
        <?php
          if(isset($_SESSION["logout"])) {
            echo $_SESSION["logout"];
            $_SESSION["logout"] = "";
          }
        ?>
      </h3>
        <div class="container" id="container">
          <div class="form-container sign-up-container">
            <form action="./signupProcess.php" method="POST">
              <div class="header">Sign Up</div>

              <!-- <div class="social_media_container">
                <a href="#" class="social facebook">
                  <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="social google">
                  <i class="fab fa-google-plus-g"></i>
                </a>
                <a href="#" class="social linkedin">
                  <i class="fab fa-linkedin-in"></i>
                </a>
              </div> -->

              <!-- <span class="under__social">
                <a href="#" class="link signin-link">or use your email for registration</a>
              </span> -->

              <div class="button-input-group">
                <div class="group input-group">
                  <input type="text" name="fname" placeholder="First name" required />
                </div>
                <div class="group input-group">
                  <input type="text" name="lname" placeholder="Last name" required />
                </div>
                <div class="group input-group">
                  <input type="email" name="email" placeholder="Email" required />
                </div>
                <div class="group input-group">
                  <input type="password" name="pass" placeholder="Password" required />
                </div>
                <input type="hidden" name="secret" value="signup">
                <div class="group button-group">
                  <input type="submit" name="signup" class="signup-btn" value="Sign Up">
                </div>
              </div>        
            </form>
          </div>

          <div class="form-container sign-in-container">
            <form action="./signupProcess.php" method="POST">
              <div class="header">Sign In</div>

              <!-- <div class="social_media_container">
                <a href="#" class="social facebook">
                  <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="social google">
                  <i class="fab fa-google-plus-g"></i>
                </a>
                <a href="#" class="social linkedin">
                  <i class="fab fa-linkedin-in"></i>
                </a>
              </div>

              <span>or use your email account</span> -->

              <div class="button-input-group">
                <div class="group input-group">
                  <input type="email" name="email" placeholder="Email" required />
                </div>
                <div class="group input-group">
                  <input type="password" name="pass" placeholder="Password" required />
                </div>
                <input type="hidden" name="secret" value="signin">
                <div class="group button-group">
                  <input type="submit" name="signin" class="signin-btn" value="Sign In">
                </div>
              </div>
            </form>
          </div>

          <div class="overlay-container">
            <div class="overlay">
              <div class="overlay-panel overlay-left">
                <h1>Welcome!</h1>
                <p>Please sign up to start</p>
                <button class="ghost" id="SignIn">Sign In</button>
              </div>
              <div class="overlay-panel overlay-right">
                <h1>Welcome back!</h1>
                <p>Sign in to continue . . .</p>
                <button class="ghost" id="SignUp">Sign Up</button>
              </div>
            </div>

          </div>
        </div>
    </main>
<?php
    include './includes/footer.php';
?>
<script>
  // scripts for signin - signup page begins here
    const SignUpButton = document.getElementById("SignUp");
    const SignInButton = document.getElementById("SignIn");
    const container = document.getElementById("container");

    SignUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active")
    });

    SignInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active")
    });
</script>