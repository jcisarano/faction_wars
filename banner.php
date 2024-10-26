<div id="banner"><div id="bannerBorderTop"></div><div id="bannerBody">
<?php
$permission = $facebook->api_client
              ->fql_query('SELECT bookmarked FROM permissions WHERE uid=' 
                                  . $player->userid . '');
$fan = $facebook->api_client->pages_isFan(119272236708,$player->userid);
echo 'api fan= ' . $fan;
if(isset($_REQUEST['fb_sig_is_fan']))
{
    $isFan = $_REQUEST['fb_sig_is_fan'];
    echo 'setsetset';
}

//echo http_build_query(', ', $_POST);
echo 'fan= ' . $isFan;
echo '<link rel="stylesheet" media="screen"
            type="text/css" href="'.ROOT.STYLE.'fw_banner_style.css?v=' 
            . $js_ver . '" />';
echo '<iframe scrolling="no" frameborder="0" src="' . ROOT . HANDLER_PATH
     . 'fan.html" style="border: none; width: 300px; height: 85px;"></iframe>';

if(!$permission[0]['bookmarked'])
{
    echo '<div id="bookmark">Add Faction Wars to your bookmarks for quicker 
               access. <fb:bookmark /></div>';
}
?>
</div><div id="bannerBorderBottom"></div></div>