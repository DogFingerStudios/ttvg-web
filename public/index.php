<?php

$config = parse_ini_file("./config.ini");

function build_path(...$segments) 
{
  return join(DIRECTORY_SEPARATOR, $segments);
}

function human_filesize($bytes, $decimals = 2) 
{
  $factor = floor((strlen($bytes) - 1) / 3);
  if ($factor > 0) $sz = 'KMGT';
  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor - 1] . 'B';
}

define("PRODUCTION", 0);
define("DOWNLOAD_PATH", $config['download_path']);
define("DOWNLOAD_URL", $config['download_url']);


function getWindowsDownloadFilename()
{
    $dir = glob(build_path(DOWNLOAD_PATH, 'tooter-*.exe'));
    usort($dir, create_function('$a,$b', 'return filemtime($b) - filemtime($a);'));
    if (count($dir) > 0)
    {
        return basename($dir[0]);
    }

    return '';
}

function getMacDownloadFilename()
{
    $dir = glob(build_path(DOWNLOAD_PATH, 'tooter-*-darwin*.zip'));
    usort($dir, create_function('$a,$b', 'return filemtime($b) - filemtime($a);'));
    if (count($dir) > 0)
    {
        return basename($dir[0]);
    }

    return '';
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Tommy Tucson</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <style>
      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 300;
        src: local('Open Sans Light'), local('OpenSans-Light'), url(fonts/DXI1ORHCpsQm3Vp6mXoaTXhCUOGz7vYGh680lGh-uXM.woff) format('woff');
      }

      @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 400;
        src: local('Open Sans'), local('OpenSans'), url(fonts/cJZKeOuBrn4kERxqtaUH3T8E0i7KZn-EPnyo3HZu7kw.woff) format('woff');
      }

      body, h1, h2, h3, h4, p 
      {
        font-family: "Helvetica Neue",Helvetica,Arial,sans-serif !important;
        font-weight: 300;
        margin: 5px;
        padding: 5px;
      }

    .tg  { border-collapse:collapse; border-spacing:0; width: 50%; margin-left: auto; margin-right: auto;}
    .tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
      overflow:hidden;padding:10px 5px;word-break:normal;}
    .tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
      font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
    .tg .tg-yg9r{border-color:inherit;font-size:18px;font-weight:bold;text-align:left;vertical-align:top}
    .tg .tg-0pky{border-color:inherit;text-align:center;vertical-align:top}
  
    .myButton 
    {
      box-shadow:inset 0px 1px 0px 0px #54a3f7;
      background:linear-gradient(to bottom, #007dc1 5%, #0061a7 100%);
      background-color:#007dc1;
      border-radius:3px;
      border:1px solid #124d77;
      display:inline-block;
      cursor:pointer;
      color:#ffffff;
      font-family:Arial;
      font-size:14px;
      padding:6px 24px;
      text-decoration:none;
      text-shadow:0px 1px 0px #154682;
      width: 100px;
    }
    .myButton:hover 
    {
      background:linear-gradient(to bottom, #0061a7 5%, #007dc1 100%);
      background-color:#0061a7;
    }
    .myButton:active 
    {
      position:relative;
      top:1px;
    }

    .div_text_shadow
    {
      color: rgb(0, 0, 0);
      font-size: 48px;
      background-color: rgb(247, 249, 250);
      text-shadow: rgb(255, 255, 255) -3px 2px 1px;
    }

    .div_text_shadow_small
    {
      color: rgb(0, 0, 0);
      font-size: 32px;
      background-color: rgb(249, 249, 249);
      text-shadow: rgb(255, 255, 255) -3px 2px 1px;
      margin-left: auto;
      margin-right: auto;
      text-align: center;
    }

  </style>
  
</head>

<body>

<center>
  <div class="div_text_shadow">Tommy Tucson</div>
  <br/>
  <a href="https://github.com/zethon/ttvg/wiki" target="_blank">Wiki</a>&nbsp;&nbsp;&nbsp;
  <a href="https://github.com/zethon/ttvg" target="_blank">GitHub</a>&nbsp;&nbsp;&nbsp;
  <a href="https://www.youtube.com/channel/UC817umzuXFvE18cnsVx9JuA/videos" target="_blank">Videos</a>&nbsp;&nbsp;&nbsp;
  <a href="https://amb.dog" target="_blank">Forum</a>&nbsp;&nbsp;&nbsp;
  <br/>
  <br/>
  <img src="https://github.com/zethon/ttvg/raw/master/docs/images/screenshot1.png" width="45%">
</center>

<a id="downloads"/>
<div class="div_text_shadow_small">Download</div>

<table class="tg">
<thead>
  <tr>
    <th class="tg-yg9r">OS</th>
    <th class="tg-yg9r"></th>
    <th class="tg-yg9r">Size</th>
    <th class="tg-yg9r">Released</th>
  </tr>
</thead>
<tbody>

<!-- Windows -->
  <tr>
    <td class="tg-0pky"><img style="width:50px;height:50px;" src="https://code.visualstudio.com/assets/images/windows-logo.png"/></td>
    <td class="tg-0pky">
<?php 
      $downloadChar = "\u{21e9}";
      $filename = getWindowsDownloadFilename();
      $fileurl = build_path(DOWNLOAD_URL, $filename);
      echo "<a href='$fileurl' class='myButton'>$downloadChar &nbsp; Windows<br/>(64 bit)</a>";
?>
    </td>
    <td class="tg-0pky">
<?php
      $filesize = human_filesize(filesize(build_path(DOWNLOAD_PATH, $filename)));
      echo $filesize;
?>
    </td>
    <td class="tg-0pky">
<?php
      $filedate = date("d F Y", filemtime(build_path(DOWNLOAD_PATH, $filename)));
      $filetime = date("H:i", filemtime(build_path(DOWNLOAD_PATH, $filename)));
      echo $filedate . '<br/>' . $filetime . ' GMT';
?>
    </td>
  </tr>

<!-- OSX -->
  <tr>
    <td class="tg-0pky"><img style="width:50px;height:50px;" src="https://code.visualstudio.com/assets/images/apple-logo.svg"/></td>
    <td class="tg-0pky">
<?php 
      $downloadChar = "\u{21e9}";
      $filename = getMacDownloadFilename();
      $fileurl = build_path(DOWNLOAD_URL, $filename);
      echo "<a href='$fileurl' class='myButton'>$downloadChar &nbsp; OS X<br/>(64 bit)</a>";
?>
    </td>
    <td class="tg-0pky">
<?php
      $filesize = human_filesize(filesize(build_path(DOWNLOAD_PATH, $filename)));
      echo $filesize;
?>
    </td>
    <td class="tg-0pky">
<?php
      $filedate = date("d F Y", filemtime(build_path(DOWNLOAD_PATH, $filename)));
      $filetime = date("H:i", filemtime(build_path(DOWNLOAD_PATH, $filename)));
      echo $filedate . '<br/>' . $filetime . ' GMT';
?>
    </td>
  </tr>

<!-- Linux -->
  <tr>
    <td class="tg-0pky"><img style="width:50px;height:50px;" src="https://code.visualstudio.com/assets/images/linux-logo.png"/></td>
    <td colspan="3" style="text-align:center;">Coming Soon</td>
  </tr>
</tbody>
</table>

</body>

<script src="https://code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

</html>
