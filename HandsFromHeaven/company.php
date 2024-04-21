<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Hands From Heaven</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/favicon.png" rel="apple-touch-icon">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/css/company.css" rel="stylesheet">
</head>

<body>

<?php
include 'config.php';

$connection = pg_connect("host=localhost dbname=NGO_Fund_Management user=postgres password=aaditya");

if (!$connection) {
    die("Error: Unable to connect to the database");
}

$query = "SELECT * FROM company";
$result = pg_query($connection, $query);

// Initialize empty array to store company data
$companyData = array();

// Loop through result and fetch data into array
while ($row = pg_fetch_assoc($result)) {
    $row['verified'] = $row['verified'] === 't' ? true : false;
    $companyData[] = $row;
}

pg_close($connection);
?>

  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">
      <div class="logo me-auto">
        <h1><a href="index.php"><img src="assets/img/logo.png"></a></h1>
      </div>
      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto" href="index.php">HOME</a></li>
          <li><a class="nav-link scrollto" href="about.php">ABOUT US</a></li>
          <li><a class="nav-link scrollto active" href="company.php">COMPANIES</a></li>
          <li><a class="nav-link scrollto" href="ngo.php">NGOs</a></li>
          <li><a class="nav-link scrollto" href="projects.php">PROJECTS</a></li>
          <li><a class="nav-link scrollto" href="contact.php">CONTACT US</a></li>
          <li><a class="nav-link scrollto" href="login.php">LOGIN</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
    </div>
  </header>

  <div id="hero"></div>

  <div class="container1">
    <h1>Company Listing</h1>
    <div id="companyList" class="company-list">
      <!-- Companies will be dynamically added here -->
    </div>
  </div>

  <script>
    // PHP-generated JavaScript variable containing Company data
    const companyData = <?php echo json_encode($companyData); ?>;

    // Function to create HTML for each company item
    function createcompanyItem(company) {
      const verificationStatus = company.verified ? "Verified" : "Non-Verified";
      return `
          <div class="company-item">
              <h2>${company.companyname}</h2>
              <p>Email: ${company.email} | Phone: ${company.phone}</p>
              <p>Fund available: ${company.fundavailable}</p>
              <p>Verification Status: ${verificationStatus}</p>
          </div>
      `;
    }

    // Function to render the list of companies
    function rendercompanyList() {
      const companyListContainer = document.getElementById("companyList");
      let html = "";
      companyData.forEach(company => {
        html += createcompanyItem(company);
      });
      companyListContainer.innerHTML = html;
    }

    // Call rendercompanyList when page loads
    window.onload = rendercompanyList;
  </script>

  <!-- footer -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-6 footer-info">
            <h3>Hands From Heaven</h3>
            <p>We are a non-profit organization dedicated to providing shelter, food, and education to those in need. Join us in our mission to create a better world for all.</p>
          </div>
          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Quick Links</h4>
            <ul>
              <li><a href="index.php">HOME</a></li>
              <li><a href="about.php">ABOUT US</a></li>
              <li><a href="companies.php">COMPANIES</a></li>
              <li><a href="ngo.php">NGOs</a></li>
              <li><a href="projects.php">PROJECTS</a></li>
              <li><a href="contact.php">CONTACT US</a></li>
              <li><a href="login.php">LOGIN</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              KJ SOMAIYA,<br>
              KJ Somaiya Road<br>
              Ghatkopar East,<br>
              Mumbai- 400077 <br><br>
              <strong>Phone:</strong><a href="tel:9769319089"> 9769319089</a><br>
              <strong>Email:</strong><a href="mailto:HandsFromHeaven@gmail.com"> HandsFromHeaven@gmail.com</a><br>
            </p>
          </div>
          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Our Social Networks</h4>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container py-4">
      <div class="row">
        <div class="col-lg-6 text-center text-lg-start">
          <p> &copy; <strong><span>Hands From Heaven</span></strong>, 2024. All Rights Reserved</p>
        </div>
      </div>
    </div>
  </footer>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
</body>
</html>
