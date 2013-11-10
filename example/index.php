<?php

// Configure the include path for XPathDocument.
$path = realpath('../lib');
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

// Configure the autoloading of the XPathDocument classes.
spl_autoload_register(function ($class) {
    include_once sprintf('%s.php', join('/', explode('_', $class)));
});

$postsSelector      = '//p[@class="title"]/a';
$commentSelector    = 'parent::p/following-sibling::ul[contains(@class, "flat-list")]/li';

$url        = 'http://www.reddit.com/';
$content    = file_get_contents($url);
$xpath      = new XPathDocument_Page($content);
$posts      = $xpath->query($postsSelector);

?>

<h1>Reddit w/ XPathDocument</h1>
<ul>

    <?php foreach ($posts as $post): ?>

        <li>
            <div class="title" style="font-weight: bold;">
                <a target="_blank" href="<?php echo $post->getAttribute('href'); ?>">
                    <?php echo $post->getText(); ?>
                </a>
            </div>
            <em class="comments" style="color: #666;">
                <?php echo $post->query($commentSelector)->offsetGet(0)->getText(); ?>
            </em>
        </li>

    <?php endforeach; ?>

</ul>