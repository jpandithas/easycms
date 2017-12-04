<html>
<head>
    <title> EasyCms </title>
    <link rel="stylesheet" type="text/css" href="themes/default/style.css">
</head>
<body>
<div id="site-wrapper">
    <div id="header">Header
        <?php print_header() ?>
        <h1>EasyCMS</h1>
    </div>
    <div id="inner">
        <div id="sidebar-left"><?php print_left_sidebar()?></div>
        <div id="content"><?php print_content()?>
        </div>
    </div>
    <div id="footer">Footer</div>
</div>
</body>
</html>
