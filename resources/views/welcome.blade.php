<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- displays site properly based on user's device -->

  <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon-32x32.png">
  <link rel="stylesheet" href="{{ asset('style/style.css') }}">
  
  <script src="https://kit.fontawesome.com/c0bc3cdbee.js" crossorigin="anonymous"></script>
  

  <title>Frontend Mentor | Simase landing page with two column layout</title>

  <!-- Feel free to remove these styles or customise in your own stylesheet 👍 -->
</head>
<body>

  <div class="container">
    <div class="first">
      <nav>
        <h1>SIMASE</h1>
        <ul>
            <li><a href="{{ route('register') }}" >Register</a></li> 
            <li><a href="{{ route('login') }}">Login</a></li> 
        </ul>
      </nav>
      <div class="content-first">
        <div class="left">
          <h1>All your files in one secure location, accessible anywhere.</h1>
          <p>Simase stores your most important files in one secure location. 
            Access them wherever you need, share and collaborate with friends, 
            family, and co-workers.</p>
          <form action="">
            {{-- <input type="email" placeholder="Enter your email..."> --}}
            <button>Get Started</button>
          </form>
        </div>
        <div class="right">
          <img src="{{ asset('images/illustration-1.svg') }}" alt="">
        </div>
      </div>
    </div>
    <div class="second">
      <div class="kiri">
        <h1>Stay productive, wherever you are</h1>
        <p>
          Never let location be an issue when accessing your files. Simase has you 
          covered for all of your file storage needs.
        </p>
        <p>
          Securely share files and folders with friends, family and colleagues for 
          live collaboration. No email attachments required!
        </p>
        <a href="">See how Simase works</a>
        <div class="testimonial-box">
          <img src="images/icon-quotes.svg" alt="">
          <p>Simase has improved our team productivity by an order of magnitude. Since 
            making the switch our team has become a well-oiled collaboration machine.</p>
          <div class="inline">
            <img src="images/avatar-testimonial.jpg" alt="" class="avatar-testimonial">
            <div class="inline-inline">
              <h3>Kyle Burton</h3>
              <p>Founder & CEO, Huddle</p>
            </div>
          </div>
        </div>
      </div>
      <div class="kanan">
        <img src="images/illustration-2.svg" alt="">
      </div>
    </div>
    <div class="third">
      <div class="kirilah">
        <h1>Get early access today</h1>
        <p>It only takes a minute to sign up and our free starter tier is extremely generous. 
          If you have any questions, our support team would be happy to help you.</p>
      </div>
      <div class="kananlah">
        <input type="email" placeholder="example@example">
        <button>Get Started For Free</button>
      </div>
    </div>
    <footer>
      <h1>SIMASE</h1>
      <div class="content">
        <div class="satu">
          <img src="images/icon-phone.svg" alt="">
          <p>+1-543-123-4567</p>
          <img src="images/icon-email.svg" alt="">
          <p>example@Simase.com</p>
        </div>
        <div class="dua">
          <p>About Us</p>
          <p>Jobs</p>
          <p>Press</p>
          <p>Blog</p>
        </div>
        <div class="tiga">
          <p>Contact Us</p>
          <p>Terms</p>
          <p>Privacy</p>
        </div>
        <div class="hilang">
          <p>About Us</p>
          <p>Jobs</p>
          <p>Press</p>
          <p>Blog</p>
          <p>Contact Us</p>
          <p>Terms</p>
          <p>Privacy</p>
        </div>
        <div class="empat">
          <i class="fa-brands fa-facebook-f"></i>
          <i class="fa-brands fa-twitter"></i>
          <i class="fa-brands fa-instagram"></i>
        </div>
      </div>
    </footer>
  </div>

  <!-- <footer>
    <p class="attribution">
      Challenge by <a href="https://www.frontendmentor.io?ref=challenge" target="_blank">Frontend Mentor</a>. 
      Coded by <a href="#">Kevin Almer</a>.
    </p>
  </footer> -->
</body>
</html>