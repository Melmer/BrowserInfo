<?php
  
  list($path_flat) = explode('?', trim(@$_SERVER['REQUEST_URI'], '/'), 2);
  $path = $path_flat ? explode('/', $path_flat) : array();

  $data = null;

  if(isset($path[2])){
      //try to load an existing json file
    $load = 'load';
    $file_path = "./results/{$path[2]}.json";
    $data = json_decode(@ file_get_contents($file_path), true);

  } else {
      //new one
    $load = 'none';

  }

?>

<!doctype html>
<!--[if IE 9]>    <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browser Info</title>
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/app_override.css">
    
    <script src="bower_components/modernizr/modernizr.js"></script>

  </head>
  <body>

    <div class="row">
      <div class="small-12 small-centered medium-12 medium-centered large-12 large-centered columns panel">
        <h1>Browser Info</h1>

        <form method="post" id="browser-info" <?php echo "class='".$load."'"; ?>>

          <?php if(!$data){ ?>
          <fieldset>
            <legend>Share this URL</legend>
            <label>URL
              <input type="text" id="url" name="url" value="">
            </label>
          </fieldset>
          <?php
            }
          ?>
          <fieldset>
            <legend>Browser &amp; OS</legend>

            <label>Browser
              <input type="text" id="browser" name="browser" readonly value="<?php echo $data?$data['browser']:''; ?>">
            </label>
            <label>Operating system
              <input type="text" class="get-info" name="os" data-info="browser.os" readonly value="<?php echo $data?$data['os']:''; ?>">
            </label>
            <label>Locale (Country)
              <input type="text" class="get-info" name="locale-country" data-info="locale.country" readonly value="<?php echo $data?$data['locale-country']:''; ?>">
            </label>
            <label>Locale (Country)
              <input type="text" class="get-info" name="locale-lang" data-info="locale.lang" readonly value="<?php echo $data?$data['locale-lang']:''; ?>">
            </label>
            
          </fieldset>
          <fieldset>
            <legend>Window</legend>
            <label>Browser size
              <input type="text" class="get-info" name="browser-size" data-info="device.screen.width" data-info-separator="x" data-info-second="device.screen.height" readonly value="<?php echo $data?$data['browser-size']:''; ?>">
            </label>
            <label>Viewport size
              <input type="text" class="get-info" name="screen-size" data-info="device.viewport.width" data-info-separator="x" data-info-second="device.viewport.height" readonly value="<?php echo $data?$data['screen-size']:''; ?>">
            </label>
            <label>Color depth
              <input type="text" class="get-info" name="screen-pixelDepth" data-info="window.screen.colorDepth" readonly value="<?php echo $data?$data['screen-pixelDepth']:''; ?>">
            </label>
          </fieldset>

          <fieldset>
            <legend>Device</legend>
            <label>Tablet
              <input type="text" class="get-info" name="tablet" data-info="device.is_tablet" readonly value="<?php echo $data?$data['tablet']:''; ?>">
            </label>
            <label>Mobile
              <input type="text" class="get-info" name="mobile" data-info="device.is_mobile" readonly value="<?php echo $data?$data['mobile']:''; ?>">
            </label>
            <label>Phone
              <input type="text" class="get-info" name="phone" data-info="device.is_phone" readonly value="<?php echo $data?$data['phone']:''; ?>">
            </label>
          </fieldset>

          <fieldset>
            <legend>Plugins</legend>

            <label>Flash support
              <input type="text" class="get-info" name="flash" data-info="plugins.flash" readonly value="<?php echo $data?$data['flash']:''; ?>">
            </label>
            <label>Java support
              <input type="text" class="get-info" name="java" data-info="plugins.java" readonly value="<?php echo $data?$data['java']:''; ?>">
            </label>
            <label>Silverlight support
              <input type="text" class="get-info" name="silverlight" data-info="plugins.silverlight" readonly value="<?php echo $data?$data['silverlight']:''; ?>">
            </label>
            <label>Quicktime support
              <input type="text" class="get-info" name="quicktime" data-info="plugins.quicktime" readonly value="<?php echo $data?$data['quicktime']:''; ?>">
            </label>
          </fieldset>

          <fieldset>
            <legend>Extra</legend>

            <label>Full user agent string
              <input type="text" id="agent-string" name="agent" readonly value="<?php echo $data?$data['agent']:''; ?>">
            </label>
          </fieldset>

        </form>

        <h2 class="text-right">
          <a href="https://github.com/Melmer/BrowserInfo"><i class="fa fa-github"></i></a>
        </h2>

      </div>
      
    </div>

    
    <script src="bower_components/jquery/dist/jquery.js"></script>
    
    <script src="bower_components/foundation/js/foundation.js"></script>

    <script src="js/vendor/session.js/session.js"></script>
    <script src="js/app.js"></script>
    
  </body>
</html>