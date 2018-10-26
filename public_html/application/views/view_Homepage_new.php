<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title><?php writePageTitle($pageTitle); ?></title>
  <?php
    linkSiteIcon(base_url('images/fav/Vectorizeimages-Iconpack-Map.ico'),'ico');
    load_UI_library([
      'j_query',
      'bootstrap',
      'font-awesome',
      'j-confirm',
      'j_query_ui',
    ]);
  ?>
</head>
<body>
  <section class="login-ribbon">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h1 class="text-center text-success">Codigniter <?php echo CI_VERSION; ?></h1>
              <h2 class="text-center text-warning">Now you can start your project</h2>
              <div class="libs">
                <h4>Library included:</h4>
                <ol>
                  <li>Bootstrap 4</li>
                  <li>Jquery</li>
                  <li>Font Awesome</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>
</html>