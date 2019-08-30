<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index.hr vijesti</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="https://kit.fontawesome.com/5e7382c972.js"></script>
</head>

<body>
    <header class="header-background-news">
        <div class="inline-left">
            <a class="left" href="landing.php"><i class="back fas fa-arrow-left"></i></a>
        </div>
        <div class="inline-right">
            <h1>HRT</h1>
        </div>
    </header>
    <form action="hrtFeed.php" method="POST" id="date">
        <div class="news-topic-wrapper">
            <div class="news-topic-icon">
                <input type="submit" name="news-submit" class="icon-text" id="news" value="Vijesti">
            </div>
            <div class="news-topic-icon">
                <input type="submit" name="world-submit" class="icon-text" id="world" value="Glazba">
            </div>
            <div class="news-topic-icon">
                <input type="submit" name="accident-submit" class="icon-text" id="accident" value="HRT prikazuje">
            </div>
            <div class="news-topic-icon">
                <input type="submit" name="sport-submit" class="icon-text" id="sport" value="Sport">
            </div>
            <div class="news-topic-icon">
                <input type="submit" name="magazine-submit" class="icon-text" id="magazine" value="Magazin">
            </div>
        </div>
    </form>
    <main>
    <?php
function get_rss_feed_as_html($feed_url, $max_item_cnt = 10, $show_date = true, $show_description = true, $max_words = 0, $cache_timeout = 7200, $cache_prefix = "")
{
    $result = "";
    // get feeds and parse items
    $rss = new DOMDocument();
    $cache_file = $cache_prefix . md5($feed_url);
    // load from file or load content
    if ($cache_timeout > 0 &&
        is_file($cache_file) &&
        (filemtime($cache_file) + $cache_timeout > time())) {
            $rss->load($cache_file);
    } else {
        $rss->load($feed_url);
        if ($cache_timeout > 0) {
            $rss->save($cache_file);
        }
    }
    $feed = array();
    foreach ($rss->getElementsByTagName('item') as $node) {
        $item = array (
            'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
            'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
            'content' => $node->getElementsByTagName('description')->item(0)->nodeValue,
            'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
            'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
        );
        $content = $node->getElementsByTagName('encoded'); // <content:encoded>
        if ($content->length > 0) {
            $item['content'] = $content->item(0)->nodeValue;
        }
        array_push($feed, $item);
    }
    // real good count
    if ($max_item_cnt > count($feed)) {
        $max_item_cnt = count($feed);
    }
    $result .= '<section class="section-wrapper">';
    for ($x=0;$x<$max_item_cnt;$x++) {
        $title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
        $link = $feed[$x]['link'];
        $result .= '<div class="feed-item">';
        
        if ($show_date) {
            $date = date('F d, Y', strtotime($feed[$x]['date']));
            $result .= '<small class="feed-date"><em> '.$date.'</em></small>';
        }
        if ($show_description) {
            $description = $feed[$x]['desc'];
            $content = $feed[$x]['content'];
            // find the img
            $has_image = preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $content, $image);
            // no html tags
            $description = strip_tags(preg_replace('/(<(script|style)\b[^>]*>).*?(<\/\2>)/s', "$1$3", $description), '');
            // whether cut by number of words
            if ($max_words > 0) {
                $arr = explode(' ', $description);
                if ($max_words < count($arr)) {
                    $description = '';
                    $w_cnt = 0;
                    foreach($arr as $w) {
                        $description .= $w . ' ';
                        $w_cnt = $w_cnt + 1;
                        if ($w_cnt == $max_words) {
                            break;
                        }
                    }
                    $description .= " ...";
                }
            }
            // add img if it exists
            if ($has_image == 1) {
                $description = '<a href="'.$link.'" title="'.$title.'" target="_blank"><img class="feed-item-image" src="' . $image['src'] . '" />' . '<div class="feed-title"><h3>'.$title.'</h3></div><hr/>' . '<p class="feed-item-text">'. $description . '</p></a>';
            }
            $result .= '<div class="feed-description">' . $description;
            $result .= '</div>';
            
        }
        $result .= '</div>';
    }
    $result .= '</section>';
    return $result;
}

function output_rss_feed($feed_url, $max_item_cnt = 10, $show_date = true, $show_description = true, $max_words = 0)
{
    echo get_rss_feed_as_html($feed_url, $max_item_cnt, $show_date, $show_description, $max_words);
}

?>
        <?php

$submitNews = isset($_POST["news-submit"]) ? $_POST["news-submit"] : "";
$submitWorld = isset($_POST["world-submit"]) ? $_POST["world-submit"] : "";
$submitAccident = isset($_POST["accident-submit"]) ? $_POST["accident-submit"] : "";
$submitSport = isset($_POST["sport-submit"]) ? $_POST["sport-submit"] : "";
$submitMagazine = isset($_POST["magazine-submit"]) ? $_POST["magazine-submit"] : "";
$submitHealth = isset($_POST["health-submit"]) ? $_POST["health-submit"] : "";

if ($submitNews == 'Vijesti') {
    output_rss_feed('https://www.hrt.hr/rss/vijesti/', 20, true, true, 200);
}elseif ($submitWorld == 'Glazba') {
    output_rss_feed('https://www.hrt.hr/rss/glazba/', 20, true, true, 200);
}elseif ($submitAccident == 'HRT prikazuje') {
    output_rss_feed('https://www.hrt.hr/rss/hrtprikazuje/', 20, true, true, 200);
}elseif ($submitSport == 'Sport') {
    output_rss_feed('https://www.hrt.hr/rss/sport/', 20, true, true, 200);
}elseif ($submitMagazine == 'Magazin') {
    output_rss_feed('https://www.hrt.hr/rss/blogovi/', 20, true, true, 200);
}else {
    output_rss_feed('https://www.hrt.hr/rss/vijesti/', 20, true, true, 200);
}

?>

    </main>
</body>

</html>