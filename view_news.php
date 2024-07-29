<?php
include 'database/config.php';

if (!isset($_GET['slug']) || empty($_GET['slug'])) {
    echo "
    Bài viết không tồn tại hoặc đã bị xoá.
    ";
    exit;
}

$slug = $conn->real_escape_string($_GET['slug']);
$sql = "SELECT * FROM news WHERE slug='$slug'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "
    Bài viết không tồn tại hoặc đã bị xoá.";
    exit;
}
$news = $result->fetch_assoc();

// Get total news count
$sql = "SELECT COUNT(*) as total FROM news";
$result_total_news = $conn->query($sql);
$data_total_news = $result_total_news->fetch_assoc();
$total_news = $data_total_news['total'];

// Since categories are removed, this part should be adjusted or removed
// Get all categories
// $sql_categories = "SELECT * FROM categories";
// $result_categories = $conn->query($sql_categories);
?>

<!DOCTYPE html>
<html lang="vi" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title><?php echo $news['title']; ?></title>
    <meta name="description" content="Dù Israel và Hezbollah đều muốn tránh kịch bản xung đột toàn diện, vụ tập kích rocket khiến 12 trẻ thiệt mạng có thể thổi bùng cuộc chiến tổng lực. - VnExpress"
    />
    <meta name="keywords" content="Israel, Hezbollah, Iran, Lebanon, Trung Đông" />
    <meta name="news_keywords" content="Israel, Hezbollah, Iran, Lebanon, Trung Đông" />
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=100" />
    <meta property="fb:app_id" content="1547540628876392" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-title" content="Vnexpress.net" />
    <meta name="tt_article_id" content="4775017" />
    <meta name="tt_category_id" content="1001142" />
    <meta name="tt_site_id" content="1000000" />
    <meta name="tt_site_id_new" content="1001002" />
    <meta name="tt_list_folder" content="1000000,1001002,1001142" />
    <meta name="tt_list_folder_name" content="VnExpress,Thế giới,Phân tích" />
    <meta name="tt_page_type" content="article" />
    <meta name="tt_page_type_new" content="3" />
    <!-- add meta for pvtt3334 -->
    <!-- end meta for pvtt -->
    <!-- META FOR FACEBOOK -->
    <meta property="og:site_name" content="vnexpress.net" />
    <meta property="og:rich_attachment" content="true" />
    <meta property="og:type" content="article" />
    <meta property="article:publisher" content="https://www.facebook.com/congdongvnexpress/" />
    <meta property="og:url" itemprop="url" content="https://vnexpress.net/vu-tap-kich-rocket-co-the-cham-ngoi-chien-tranh-israel-hezbollah-4775017.html" />
    <meta property="og:image" itemprop="thumbnailUrl" content="<?php echo $news['thumbnail'] ? $news['thumbnail'] : 'assets/images/no-image.jpg'; ?>" />
    <meta property="og:image:width" content="800" />
    <meta property="og:image:height" content="354" />
    <meta content="Vụ tập kích rocket có thể châm ngòi chiến tranh Israel - Hezbollah" itemprop="headline" property="og:title" />
    <meta content="Dù Israel và Hezbollah đều muốn tránh kịch bản xung đột toàn diện, vụ tập kích rocket khiến 12 trẻ thiệt mạng có thể thổi bùng cuộc chiến tổng lực." itemprop="description" property="og:description" />
    <meta property="article:tag" content="Israel,Iran,Lebanon,Trung Đông" />
    <meta name="liston_category" content="1001002,1001142" />
    <meta name="tt_site_id_detail" content="1001002" catename="Thế giới" />
    <!-- END META FOR FACEBOOK -->
    <meta content="news" itemprop="genre" name="medium" />
    <meta content="vi-VN" itemprop="inLanguage" />
    <meta content="Phân tích" itemprop="articleSection" />
    <meta content="Tin nhanh VnExpress" itemprop="sourceOrganization" name="source" />
    <meta content="2024-07-29T19:00:00+07:00" itemprop="datePublished" name="pubdate" />
    <meta content="2024-07-29T19:00:00+07:00" itemprop="dateModified" name="lastmod" />
    <meta content="2024-07-29T05:54:18+07:00" itemprop="dateCreated" />
    <meta name="copyright" content="VnExpress" />
    <meta name="author" content="VnExpress" />
    <meta name="robots" content="noarchive, max-image-preview:large, index" />
    <meta name="googlebot" content="noarchive" />
    <meta name="geo.placename" content="Ha Noi, Viet Nam" />
    <meta name="geo.region" content="VN-HN" />
    <meta name="geo.position" content="21.030624;105.782431" />
    <meta name="ICBM" content="21.030624, 105.782431" />
    <meta name="revisit-after" content="days" />
    <!-- Twitter Card -->
    <meta name="twitter:card" value="summary" />
    <meta name="twitter:url" content="https://vnexpress.net/vu-tap-kich-rocket-co-the-cham-ngoi-chien-tranh-israel-hezbollah-4775017.html" />
    <meta name="twitter:title" content="Vụ tập kích rocket có thể châm ngòi chiến tranh Israel - Hezbollah" />
    <meta name="twitter:description" content="Dù Israel và Hezbollah đều muốn tránh kịch bản xung đột toàn diện, vụ tập kích rocket khiến 12 trẻ thiệt mạng có thể thổi bùng cuộc chiến tổng lực." />
    <meta name="twitter:image" content="https://i2-vnexpress.vnecdn.net/2024/07/29/afp-20240715-364b2le-v1-highre-9385-9278-1722228849.jpg?w=1200&h=0&q=100&dpr=1&fit=crop&s=JSDclRTiIFtR9W94NB19lw" />
    <meta name="twitter:site" content="@VnEnews" />
    <meta name="twitter:creator" content="@VnEnews" />
    <!-- End Twitter Card -->
    <link rel="canonical" href="https://vnexpress.net/vu-tap-kich-rocket-co-the-cham-ngoi-chien-tranh-israel-hezbollah-4775017.html" />
    <link rel="alternate" href="https://vnexpress.net/vu-tap-kich-rocket-co-the-cham-ngoi-chien-tranh-israel-hezbollah-4775017.html" hreflang="vi-vn" />
    <link rel="dns-prefetch" href="https://s1.vnecdn.net" />
    <link rel="dns-prefetch" href="https://s.eclick.vn" />
    <link rel="dns-prefetch" href="https://gw.vnexpress.net" />
    <link rel="dns-prefetch" href="https://usi-saas.vnexpress.net" />
    <link rel="dns-prefetch" href="https://www.google-analytics.com" />
    <link rel="dns-prefetch" href="https://www.googletagmanager.com" />
    <link rel="preconnect" href="https://s1.vnecdn.net" />
    <link rel="preconnect" href="https://www.googletagmanager.com" />
    <link rel="preconnect" href="https://www.google-analytics.com" />
    <link rel="preconnect" href="https://gw.vnexpress.net" />
    <link rel="preconnect" href="https://usi-saas.vnexpress.net" />
    <link rel="preconnect" href="https://s.eclick.vn" />
    <link rel="preconnect" href="https://securepubads.g.doubleclick.net" />
    <link rel="preconnect" href="https://tpc.googlesyndication.com" />
    <!-- iPad icons -->
    <link rel="apple-touch-icon-precomposed" href="https://s1.vnecdn.net/vnexpress/restruct/i/v921/logos/72x72.png" sizes="72x72">
    <link rel="apple-touch-icon-precomposed" href="https://s1.vnecdn.net/vnexpress/restruct/i/v921/logos/114x114.png" sizes="144x144">
    <!-- iPhone and iPod touch icons -->
    <link rel="apple-touch-icon-precomposed" href="https://s1.vnecdn.net/vnexpress/restruct/i/v921/logos/57x57.png" sizes="57x57">
    <link rel="apple-touch-icon-precomposed" href="https://s1.vnecdn.net/vnexpress/restruct/i/v921/logos/114x114.png" sizes="114x114">
    <!-- Nokia Symbian -->
    <link rel="nokia-touch-icon" href="https://s1.vnecdn.net/vnexpress/restruct/i/v921/logos/57x57.png">
    <!-- Android icon precomposed so it takes precedence -->
    <link rel="apple-touch-icon-precomposed" href="https://s1.vnecdn.net/vnexpress/restruct/i/v921/logos/114x114.png" sizes="1x1">
    <!-- GOOGLE SEARCH META GOOGLE SEARCH STRUCTURED DATA FOR ARTICLE && GOOGLE BREADCRUMB STRUCTURED DATA-->
    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "NewsArticle",
            "mainEntityOfPage": {
                "@type": "WebPage",
                "@id": "https://vnexpress.net/vu-tap-kich-rocket-co-the-cham-ngoi-chien-tranh-israel-hezbollah-4775017.html"
            },
            "headline": "Vụ tập kích rocket có thể châm ngòi chiến tranh Israel - Hezbollah",
            "description": "Dù Israel và Hezbollah đều muốn tránh kịch bản xung đột toàn diện, vụ tập kích rocket khiến 12 trẻ thiệt mạng có thể thổi bùng cuộc chiến tổng lực.",
            "image": {
                "@type": "ImageObject",
                "url": "<?php echo $news['thumbnail'] ? $news['thumbnail'] : 'assets/images/no-image.jpg'; ?>",
                "width": 900,
                "height": 540
            },
            "datePublished": "2024-07-29T19:00:00+07:00",
            "dateModified": "2024-07-29T19:00:00+07:00",
            "author": {
                "@type": "Organization",
                "name": "VnExpress"
            },
            "publisher": {
                "@type": "Organization",
                "name": "Báo VnExpress",
                "logo": {
                    "@type": "ImageObject",
                    "url": "https://s1.vnecdn.net/vnexpress/restruct/i/v921/logos/vnexpress_500x110.png",
                    "width": 500,
                    "height": 112
                }
            },
            "about": ["Israel", "Iran", "Lebanon", "Trung Đông"]
        }
    </script>
    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": [{
                "@type": "ListItem",
                "position": 1,
                "item": {
                    "@id": "https://vnexpress.net/the-gioi",
                    "name": "Thế giới"
                }
            }, {
                "@type": "ListItem",
                "position": 2,
                "item": {
                    "@id": "https://vnexpress.net/the-gioi/phan-tich",
                    "name": "Phân tích"
                }
            }]
        }
    </script>
    <!-- END GOOGLE SEARCH META GOOGLE SEARCH STRUCTURED DATA FOR ARTICLE && GOOGLE BREADCRUMB STRUCTURED DATA-->
    <script type="text/javascript">
        function decodeNestedURI(o) {
            try {
                decodeURIComponent(o)
            } catch (n) {
                o = o.replace(/\s+/g, "").replace(/(%20)+/g, "")
            }
            let n = o,
                e = null;
            for (; e = decodeURIComponent(n), e != n;) n = e;
            return e
        }

        function strip_tags_data(o, n) {
            for (var e = ["onclick", "oncontextmenu", "ondblclick", "onmousedown", "onmouseenter", "onmouseleave", "onmousemove", "onmouseout", "onmouseover", "onmouseup", "oninput", "onload", "onerror", "onreadystatechange", "onfilterchange", "onpropertychange", "onqt_error", "onbegin", "formaction", "onfocus", "onkeyup", "onstart", "contentscripttype", "style", "onunload", "onafterprint", "onbeforeprint", "onbeforeunload", "onhashchange", "onmessage", "ononline", "onoffline", "onpagehide", "onpageshow", "onpopstate", "onresize", "onstorage", "onblur", "onchange", "oninvalid", "onreset", "onsearch", "onselect", "onsubmit", "onkeydown", "onkeypress", "onmousewheel", "onwheel", "ondragend", "ondragenter", "ondragleave", "ondragover", "ondragstart", "ondrag", "ondrop", "onscroll", "oncopy", "oncut", "onpaste", "onabort", "oncanplaythrough", "oncanplay", "oncuechange", "ondurationchange", "onemptied", "onended", "onloadeddata", "onloadedmetadata", "onloadstart", "onpause", "onplaying", "onplay", "onprogress", "onratechange", "onseeked", "onseeking", "onstalled", "onsuspend", "ontimeupdate", "onvolumechange", "onwaiting", "onshow", "ontoggle", "dynsrc", "javascript:", "prompt", "constructor.", ".prototype", "constructor[", "[prototype", "__proto__", "window.", "window[", "location.", "location[", "localstorage.", "localstorage[", "document.", "document[", "sessionstorage.", "sessionstorage[", "self.", "self["], t = o.toLowerCase(), a = 0; a < e.length; a++)
                if (t.indexOf(e[a]) > -1) return "data not allowed";
            n = (((n || "") + "").toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join("");
            return o.replace(/<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi, "").replace(/<\/?([a-z][a-z0-9]*)\b[^>]*>/gi, (function(o, e) {
                return n.indexOf("<" + e.toLowerCase() + ">") > -1 ? o : ""
            }))
        }

        function checkQueryXSS(o, n) {
            n = void 0 !== n && n ? 1 : 0;
            var e = decodeNestedURI(o);
            if (e != strip_tags_data(e)) {
                if (1 == n) {
                    var t = window.location.protocol + "//" + window.location.hostname + window.location.pathname;
                    return void(t != window.location.href && (window.location.href = t))
                }
                var a = e.indexOf("?");
                return -1 == a ? o : e.substr(0, a)
            }
            return 1 == n ? void 0 : o
        }
        checkQueryXSS(window.location.href, 1);
    </script>
    <script type="text/javascript">
        try {
            localStorage.setItem('check_storage', 'local storage');
            window.supportLS = true;
        } catch (e) {
            window.supportLS = false;
        }
    </script>
    <script type="text/javascript">
        try {
            if (typeof window.Worker === 'function') {
                window.apiWorker = new Worker(window.URL.createObjectURL(new Blob(['self.addEventListener("message",function(e){try{const l=JSON.parse(e.data),s=[];for(const a in l)for(const i in l[a]){var o;void 0===l[a][i].api_url||!1!==s.includes(l[a][i].api_url)||!1!==l[a][i].api_url.includes("${exclude}")||void 0!==l[a][i].skip_preload&&!1!==l[a][i].skip_preload||(s.push(l[a][i].api_url),o=!1===l[a][i].api_url.includes("https://")?location.origin+l[a][i].api_url:l[a][i].api_url,fetch(o).then(e=>{!0===e.ok&&e.json().then(e=>{self.postMessage({key:l[a][i].api_url,value:e})}).catch(e=>{console.log(e)})}).catch(e=>{console.log(e)}))}}catch(e){console.log(e)}},!1);'], {
                    type: "text/javascript"
                })));
                window.apiWorkerCached = {};
                apiWorker.addEventListener('message', function(e) {
                    if (typeof e.data !== 'undefined') {
                        window.apiWorkerCached[e.data.key] = e.data.value;
                    }
                }, false);
                apiWorker.addEventListener('error', function(e) {
                    apiWorker.terminate();
                }, false);
            }
        } catch (e) {
            console.log(e);
        }
    </script>
    <script type="text/javascript">
        if ((window.location.hash != '' && /vn_source=/.test(window.location.hash)) || (window.location.search != '' && /vn_source=/.test(window.location.search))) {
            var _itmSource = ((window.location.hash != '') ? window.location.hash : window.location.search).replace(/^[#,?]+/g, '').split('&');
            if (_itmSource) {
                window.itmSource = {};
                for (var i = 0; i < _itmSource.length; i++) {
                    var o = _itmSource[i].split('=');
                    if (o.length >= 2) window.itmSource[o[0]] = _itmSource[i].replace(o[0] + '=', '');
                }
                window.dataLayer = window.dataLayer || [];
                dataLayer.push({
                    'vn_source': window.itmSource.vn_source ? window.itmSource.vn_source : null
                });
                dataLayer.push({
                    'vn_medium': window.itmSource.vn_medium ? window.itmSource.vn_medium : null
                });
                dataLayer.push({
                    'vn_campaign': window.itmSource.vn_campaign ? window.itmSource.vn_campaign : null
                });
                dataLayer.push({
                    'vn_term': window.itmSource.vn_term ? window.itmSource.vn_term : null
                });
                dataLayer.push({
                    'vn_thumb': window.itmSource.vn_thumb ? window.itmSource.vn_thumb : null
                });
                if (window.itmSource.vn_zone) {
                    dataLayer.push({
                        'vn_zone': window.itmSource.vn_zone
                    });
                }
                if (window.itmSource.vn_segment) {
                    dataLayer.push({
                        'vn_segment': window.itmSource.vn_segment
                    });
                }
                if (window.itmSource.vn_topic) {
                    dataLayer.push({
                        'vn_topic': window.itmSource.vn_topic
                    });
                }
                if (window.itmSource.vn_aid) {
                    dataLayer.push({
                        'vn_aid': window.itmSource.vn_aid
                    });
                }
                if (window.itmSource.vn_test) {
                    dataLayer.push({
                        'vn_test': window.itmSource.vn_test
                    });
                }
                if (window.itmSource.vn_sign) {
                    dataLayer.push({
                        'vn_sign': window.itmSource.vn_sign
                    });
                }
            }
            window.history.replaceState(false, false, window.location.protocol + '//' + window.location.hostname + window.location.pathname + (window.location.search != '' && /vn_source=/.test(window.location.search) ? '' : window.location.search));
        }
        var appendTracking = function() {
            var dataItm = document.querySelectorAll('[data-itm-source]:not([data-itm-added="1"])');
            var dataItmLength = dataItm.length;
            if (dataItmLength > 0) {
                for (var di = 0; di < dataItmLength; di++) {
                    if (dataItm[di] !== null) {
                        dataItm[di].setAttribute('data-itm-added', 1);
                        dataItm[di].addEventListener('click', function(e) {
                            var is_UTM = !/\/\/(demo.)?vnexpress.net/.test(this.href) && /utm_source=/.test(this.href);
                            if (this.href && this.href != window.location.href && this.href != window.location.href + '#' && !is_UTM) {
                                var data_itm_source = this.getAttribute('data-itm-source');
                                var meta_ttaid = document.querySelector('meta[name="tt_article_id"]');
                                if (/vn_source=/.test(this.href)) {
                                    data_itm_source = '';
                                    if (meta_ttaid) {
                                        data_itm_source = '&vn_aid=' + meta_ttaid.getAttribute('content');
                                    }
                                    if (typeof dataLayerAB !== 'undefined') {
                                        data_itm_source += '&vn_test=' + dataLayerAB[0]['ABVariant'];
                                    }
                                    if (location.host === 'demo.vnexpress.net' && this.href.indexOf('demo.') < 0) {
                                        this.href = this.href.replace('vnexpress.net', 'demo.vnexpress.net');
                                    }
                                    this.setAttribute('href', this.href + data_itm_source);
                                } else {
                                    if (meta_ttaid) {
                                        data_itm_source = data_itm_source + '&vn_aid=' + meta_ttaid.getAttribute('content');
                                    }
                                    if (typeof dataLayerAB !== 'undefined') {
                                        data_itm_source += '&vn_test=' + dataLayerAB[0]['ABVariant'];
                                    }
                                    if (location.host === 'demo.vnexpress.net' && this.href.indexOf('demo.') < 0) {
                                        this.href = this.href.replace('vnexpress.net', 'demo.vnexpress.net');
                                    }
                                    this.setAttribute('href', this.href + (/^#/.test(data_itm_source) ? data_itm_source : '#' + data_itm_source));
                                }
                            }
                        });
                    }
                }
            }
        };
        window.addEventListener('DOMContentLoaded', function(event) {
            appendTracking();
        });
        var trackingLogoHome = function(type, href) {
            if (href == window.location.href || href == window.location.href + '#') {
                window.dataLayer = window.dataLayer || [];
                if (type == 'logo-header') {
                    return dataLayer.push({
                        "event": "iTMHometoHome",
                        "vn_source": "Home",
                        "vn_campaign": "Header",
                        "vn_medium": "Logo",
                        "vn_term": "Desktop",
                        "pageType": "Home"
                    });
                } else if (type == 'logo-header-menu') {
                    return dataLayer.push({
                        "event": "iTMHometoHome",
                        "vn_source": "Home",
                        "vn_campaign": "Header",
                        "vn_medium": "Menu-Home",
                        "vn_term": "Desktop",
                        "pageType": "Home"
                    });
                } else if (type == 'logo-footer-menu') {
                    return dataLayer.push({
                        "event": "iTMHometoHome",
                        "vn_source": "Home",
                        "vn_campaign": "Footer",
                        "vn_medium": "Menu-Home",
                        "vn_term": "Desktop",
                        "pageType": "Home"
                    });
                } else if (type == 'logo-footer') {
                    return dataLayer.push({
                        "event": "iTMHometoHome",
                        "vn_source": "Home",
                        "vn_campaign": "Footer",
                        "vn_medium": "Logo",
                        "vn_term": "Desktop",
                        "pageType": "Home"
                    });
                }
            }
        };
    </script>
    <script type="text/javascript">
        var site_id = 1000000,
            SITE_ID = 1000000,
            PAGE_FOLDER = 1001142,
            PAGE_DETAIL = 1,
            parser_autoplay = 1,
            PageHot = 0,
            topic_id_selected = 0;
        var LIST_TEAM_SHOW_FIXTURE = [1571, 1542, 1564, 12, 17, 1566, 1567, 78538, 78550, 78353, 78292, 78670, 78704, 78546, 78324, 78545, 78329, 78717, 78293, 78681, 78570, 78265, 78325, 78679, 78669, 78703, 78568, 78718, 78355, 78294, 78569, 78368, 78359, 78297, 78305, 78156, 78300, 71240, 78327, 78573, 78358, 78562, 78272, 78274, 71087, 78360, 78561];
        var DATA_FOOTBALL = {
            "6280": {
                "name": "Ngo\u1ea1i h\u1ea1ng Anh",
                "logo": "https:\/\/s1.vnecdn.net\/vnexpress\/restruct\/i\/v391\/v2_2019\/pc\/graphics\/logo_ngoai_hang_anh.png",
                "link": "\/the-thao\/du-lieu-bong-da\/giai-dau\/premier-league",
                "logo_bangdiem": "https:\/\/s.vnecdn.net\/thethao\/restruct\/i\/v67\/dulieubongda\/icons\/nha.svg",
                "class": "table-nha",
                "pos": 2,
                "code": "ngoai_hang_anh",
                "show_fixture_in_box": true,
                "tt_category_id": 1002580,
                "menu_schedule": 2
            },
            "6284": {
                "name": "La Liga",
                "logo": "https:\/\/s1.vnecdn.net\/vnexpress\/restruct\/i\/v391\/v2_2019\/pc\/graphics\/logo_laliga.png",
                "link": "\/the-thao\/du-lieu-bong-da\/giai-dau\/laliga",
                "logo_bangdiem": "https:\/\/s.vnecdn.net\/thethao\/restruct\/i\/v67\/dulieubongda\/icons\/laliga.svg",
                "class": "table-laliga",
                "pos": 3,
                "code": "la_liga",
                "show_fixture_in_box": true,
                "tt_category_id": 1002582,
                "menu_schedule": 3
            },
            "6374": {
                "name": "Serie A",
                "logo": "https:\/\/s1.vnecdn.net\/vnexpress\/restruct\/i\/v391\/v2_2019\/pc\/graphics\/logo_seria.png",
                "link": "\/the-thao\/du-lieu-bong-da\/giai-dau\/seriea",
                "logo_bangdiem": "https:\/\/s.vnecdn.net\/thethao\/restruct\/i\/v67\/dulieubongda\/icons\/seria.svg",
                "class": "table-seria",
                "pos": 4,
                "code": "seri_a",
                "show_fixture_in_box": true,
                "tt_category_id": 1002581,
                "sub_menu_schedule": 1
            },
            "5262": {
                "name": "Champions League",
                "logo": "https:\/\/s1.vnecdn.net\/vnexpress\/restruct\/i\/v391\/v2_2019\/pc\/graphics\/logo_champions_league.png",
                "link": "\/the-thao\/du-lieu-bong-da\/giai-dau\/champion-league",
                "isCup": true,
                "code": "uefa_champions_league",
                "show_fixture_in_box": true,
                "tt_category_id": 1002575,
                "sub_menu_schedule": 2
            },
            "5607": {
                "name": "Europa League",
                "logo": "https:\/\/s1.vnecdn.net\/vnexpress\/restruct\/i\/v391\/v2_2019\/pc\/graphics\/logo_europa.png",
                "link": "\/the-thao\/du-lieu-bong-da\/giai-dau\/europa-league",
                "isCup": true,
                "code": "uefa_europa_league",
                "show_fixture_in_box": true,
                "sub_menu_schedule": 5
            },
            "6375": {
                "name": "Bundesliga",
                "logo": "https:\/\/s1.vnecdn.net\/vnexpress\/restruct\/i\/v391\/v2_2019\/pc\/graphics\/logo_bundesliga.png",
                "link": "\/the-thao\/du-lieu-bong-da\/giai-dau\/bundesliga",
                "logo_bangdiem": "https:\/\/s.vnecdn.net\/thethao\/restruct\/i\/v67\/dulieubongda\/icons\/buldesliga.svg",
                "class": "table-bundesliga",
                "pos": 5,
                "code": "bundes_liga",
                "show_fixture_in_box": true,
                "tt_category_id": 1004691,
                "sub_menu_schedule": 4
            },
            "6315": {
                "name": "Ligue 1",
                "logo": "https:\/\/s1.vnecdn.net\/vnexpress\/restruct\/i\/v391\/v2_2019\/pc\/graphics\/logo_ligue1.png",
                "link": "\/the-thao\/du-lieu-bong-da\/giai-dau\/ligue1",
                "logo_bangdiem": "https:\/\/s.vnecdn.net\/thethao\/restruct\/i\/v67\/dulieubongda\/icons\/ligue1.svg",
                "class": "table-ligue1",
                "pos": 6,
                "code": "league1",
                "show_fixture_in_box": true,
                "sub_menu_schedule": 3
            },
            "5793": {
                "name": "V-League",
                "logo": "https:\/\/s1.vnecdn.net\/vnexpress\/restruct\/i\/v391\/v2_2019\/pc\/graphics\/logo_vleague.png",
                "link": "\/the-thao\/du-lieu-bong-da\/giai-dau\/vleague",
                "class": "table-vleague",
                "pos": 1,
                "code": "v_league",
                "show_fixture_in_box": true,
                "tt_category_id": 1004825,
                "group_standing": ["Nh\u00f3m tranh ch\u1ee9c v\u00f4 \u0111\u1ecbch", "Nh\u00f3m tranh su\u1ea5t tr\u1ee5 h\u1ea1ng"]
            },
            "5475": {
                "name": "Saudi Pro League",
                "logo": "https:\/\/s1.vnecdn.net\/vnexpress\/restruct\/c\/v2189\/dulieubongda\/pc\/images\/graphics\/saudi_pro_league.png",
                "link": "\/the-thao\/du-lieu-bong-da\/giai-dau\/saudi-pro-league",
                "code": "saudi_pro_league",
                "show_fixture_in_box": true
            },
            "5902": {
                "name": "MLS",
                "logo": "https:\/\/s1.vnecdn.net\/vnexpress\/restruct\/c\/v2189\/dulieubongda\/pc\/images\/graphics\/mls.png",
                "link": "\/the-thao\/du-lieu-bong-da\/giai-dau\/mls",
                "code": "mls",
                "show_fixture_in_box": true,
                "group_standing": ["B\u1ea3ng mi\u1ec1n \u0110\u00f4ng", "B\u1ea3ng mi\u1ec1n T\u00e2y"]
            },
            "5113": {
                "name": "League Cup",
                "logo": "https:\/\/s1.vnecdn.net\/vnexpress\/restruct\/c\/v2189\/dulieubongda\/pc\/images\/graphics\/league_cup.png",
                "link": "\/the-thao\/du-lieu-bong-da\/giai-dau\/league-cup",
                "code": "league_cup",
                "show_fixture_in_box": true
            },
            "6339": {
                "name": "Cup li\u00ean \u0111o\u00e0n Anh",
                "logo": "https:\/\/is.vnecdn.net\/objects\/flags\/gb.svg",
                "link": "\/the-thao\/du-lieu-bong-da\/giai-dau\/cup-lien-doan",
                "code": "cup_lien_doan_anh",
                "show_fixture_in_box": true
            },
            "6422": {
                "name": "Cup FA",
                "logo": "https:\/\/s1.vnecdn.net\/vnexpress\/restruct\/i\/v391\/v2_2019\/pc\/graphics\/logo_fa.png",
                "link": "\/the-thao\/du-lieu-bong-da\/giai-dau\/fa-cup",
                "isCup": true,
                "code": "fa_cup",
                "show_fixture_in_box": true
            },
            "5796": {
                "name": "Cup Nh\u00e0 vua",
                "logo": "https:\/\/s1.vnecdn.net\/vnexpress\/restruct\/i\/v391\/v2_2019\/pc\/graphics\/logo_coparey.png",
                "link": "\/the-thao\/du-lieu-bong-da\/giai-dau\/copa-rey",
                "isCup": true,
                "code": "copa_rey",
                "show_fixture_in_box": true
            },
            "6421": {
                "name": "Cup QG Italy",
                "logo": "https:\/\/s1.vnecdn.net\/vnexpress\/restruct\/i\/v391\/v2_2019\/pc\/graphics\/logo_copaitalia.png",
                "link": "\/the-thao\/du-lieu-bong-da\/giai-dau\/coppa-italia",
                "isCup": true,
                "code": "coppa_italia",
                "show_fixture_in_box": true
            },
            "6244": {
                "name": "Cup QG \u0110\u1ee9c",
                "logo": "https:\/\/s1.vnecdn.net\/vnexpress\/restruct\/i\/v391\/v2_2019\/pc\/graphics\/logo_dfb.png",
                "link": "\/the-thao\/du-lieu-bong-da\/giai-dau\/dfb-pokal",
                "isCup": true,
                "code": "dfb_pokal",
                "show_fixture_in_box": true
            },
            "5583": {
                "name": "V\u00f2ng lo\u1ea1i World Cup - ch\u00e2u \u00c1",
                "link": "\/the-thao\/du-lieu-bong-da\/giai-dau\/asia-world-cup-qualifier",
                "code": "asia_world_cup_qualifier",
                "show_fixture_in_box": true
            },
            "5260": {
                "name": "Asian Cup",
                "link": "\/the-thao\/du-lieu-bong-da\/giai-dau\/asian-cup",
                "code": "asian_cup",
                "show_fixture_in_box": true
            },
            "5847": {
                "name": "U23 Ch\u00e2u \u00c1",
                "link": "\/the-thao\/du-lieu-bong-da\/giai-dau\/u23-asian-cup",
                "code": "u23_asian_cup",
                "show_fixture_in_box": true
            },
            "3348": {
                "name": "Euro 2024",
                "link": "\/the-thao\/euro-2024",
                "code": "euro",
                "show_fixture_in_box": true,
                "ldp": true
            },
            "4844": {
                "name": "Copa America 2024",
                "link": "\/the-thao\/du-lieu-bong-da\/giai-dau\/copa-america",
                "code": "copa_america",
                "show_fixture_in_box": true
            }
        };
        var d_gat = new Date();
        d_gat.setTime(d_gat.getTime() + (7 * 24 * 60 * 60 * 1000));
        document.cookie = "sw_version=1;expires=" + d_gat.toUTCString() + ";domain=vnexpress.net;path=/";
        if (typeof(PAGE_FOLDER) == "undefined") {
            var PAGE_FOLDER;
        }
        if (PAGE_FOLDER == 1000000) {
            var _siteId = "6";
        } else {
            var _siteId = "5";
        }
        var blockAdsTop = 0;
        var uservar_token = "";
        var uservar_fosp_aid = "";
        if (typeof(PageHot) == "undefined") {
            var PageHot = 0;
        }
        if (window.supportLS === true && typeof Object.values === 'function') {
            var swapAID = 4775017;
            var d = new Date();
            var keyRead = 'swap_zone_readed_' + (d.getMonth() + 1) + d.getDate();
            try {
                var readed = localStorage.getItem(keyRead);
                if (readed !== null) {
                    readed = JSON.parse(readed);
                    if (Object.values(readed).indexOf(swapAID) < 0) {
                        readed[(+d)] = swapAID;
                        localStorage.setItem(keyRead, JSON.stringify(readed));
                    }
                } else {
                    readed = {};
                    readed[(+d)] = swapAID;
                    localStorage.setItem(keyRead, JSON.stringify(readed));
                }
            } catch (e) {
                console.log(e);
            }
        }
        window.dataLayer = window.dataLayer || [];
        dataLayer.push({
            'pageCategory': '1001002'
        });
        dataLayer.push({
            'pageType': 'Article'
        });
        dataLayer.push({
            'pagePlatform': 'Web'
        });
        dataLayer.push({
            'pageSubcategory': 'Phân tích'
        });
        dataLayer.push({
            'articleId': '4775017'
        });
        dataLayer.push({
            'articleTitle': 'Vụ tập kích rocket có thể châm ngòi chiến tranh Israel - Hezbollah'
        });
        dataLayer.push({
            'articleAuthor': '1700000455'
        });
        dataLayer.push({
            'articleAuthorName': ''
        });
        dataLayer.push({
            'articlePublishDate': '20240729190000'
        });
        dataLayer.push({
            'articleTags': 'Israel, Hezbollah, Iran, Lebanon, Trung Đông'
        });
        dataLayer.push({
            'tag_id': '13093, 128350, 3656, 742467, 117911'
        });
        dataLayer.push({
            'article_taxonomy': 'Israel, Iran, Lebanon, Trung Đông'
        });
        dataLayer.push({
            'article_taxonomyid': '2396, 718, 4531, 7392'
        });
        dataLayer.push({
            'pageSubcategoryId': '1001142'
        });
        dataLayer.push({
            'articleAds': '0'
        });
        dataLayer.push({
            'DataStory': '0'
        });
        dataLayer.push({
            'standard_type': '0'
        });
        dataLayer.push({
            'high_quality': '0'
        });
        dataLayer.push({
            'article_thumb': 'on'
        });
        dataLayer.push({
            'article_type': 'text'
        });
        dataLayer.push({
            'pageEmbed': 'tin_xemthem'
        });
        dataLayer.push({
            'VideoClassify': 'None'
        });
        var _noGTM = true;
        (function() {
            var ea_cdn = "//s1.vnecdn.net/vnexpress/restruct/j/v1290/eclick/ea3.js";
            if (typeof ZONE_ADS !== "undefined" && ZONE_ADS == 1) {
                ea_cdn = "//s1cdn.vnecdn.net/vnexpress/restruct/j/v1290/eclick/ea3.js";
            }
            var e = document.createElement("script");
            e.type = "text/javascript", e.async = !0, e.src = ea_cdn;
            var t = document.getElementsByTagName("script")[0];
            t.parentNode.insertBefore(e, t);
        })();
        (function() {
            var e = document.createElement("script");
            e.type = "text/javascript", e.async = !0, e.src = "https://s.eclick.vn/delivery/inventory.js";
            var t = document.getElementsByTagName("script")[0];
            t.parentNode.insertBefore(e, t);
        })();
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-N3FNJF');
        var article_topic_style = 1;
        var article_type = 1;
        var articleAds = 0;
        var new_privacy = 0;
        var article_with_video = 0;
        var list_tax_id = '2396, 718, 4531, 7392';
    </script>
    <meta name="tt_page_ads" content="1">
    <meta name="tt_page_special" content="0">
    <meta name="its_url" content="https://vnexpress.net/vu-tap-kich-rocket-co-the-cham-ngoi-chien-tranh-israel-hezbollah-4775017.html" />
    <meta name="its_id" content="4775017" />
    <meta name="its_title" content="Vụ tập kích rocket có thể châm ngòi chiến tranh Israel - Hezbollah" />
    <meta name="its_section" content="vnexpress" />
    <meta name="its_subsection" content="vnexpress, thế giới, phân tích" />
    <meta name="its_tag" content="israel, hezbollah, iran, lebanon, trung đông" />
    <meta name="its_topic" content="" />
    <meta name="its_object" content="" />
    <meta name="its_embed" content="0" />
    <meta name="its_author" content="1700000455" />
    <meta name="its_type" content="text" />
    <meta name="its_wordcount" content="1582" />
    <meta name="its_publication" content="1722254400" />
    <meta name="article_updatetime" content="1722247140" />
    <meta name="its_user_needs" content="2" />
    <script type="text/javascript">
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o), m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-29374284-4', 'auto', {
            'name': 't3'
        });
        ga('t3.send', 'pageview');
        ga('create', 'UA-29374284-30', 'auto', {
            'name': 't4'
        });
        ga('t4.send', 'pageview');
        ga('create', 'UA-50285069-16', 'auto', {
            'name': 'te'
        });
    </script>
    <style>
        .lazier {
            width: 1px;
            height: 1px
        }

        #_havien1_2.lazier,
        #_havien2_1.lazier,
        #_havien3_1.lazier {
            position: absolute;
            left: 0;
            top: 0
        }
    </style>
    <script type="text/javascript">
        var addScripts = function(filepath, runtype, callback, stype) {
            var el = document.createElement('script');
            if (typeof stype === 'undefined') {
                el.type = 'text/javascript';
            } else {
                el.type = stype;
            }
            el.src = filepath;
            el.async = runtype;
            el.onload = function() {
                el.setAttribute('loaded', 'loaded');
                if (typeof callback == 'function') {
                    callback();
                }
            }
            document.getElementsByTagName('head')[0].appendChild(el);
        }
        window.dontSupportES = !(window.Promise && window.HTMLPictureElement && [].includes && Object.keys && NodeList.prototype.forEach && window.IntersectionObserver);
        if (window.dontSupportES) {
            addScripts('https://pfjs.vnecdn.net/all.js?ua=' + encodeURIComponent(navigator.userAgent), true, function() {
                window.updateBrowser = true;
                setTimeout(function() {
                    window.dontSupportES = false;
                }, 1000);
            });
        }
        if (typeof window.supportLS === 'undefined') {
            try {
                localStorage.setItem('check_storage', 'local storage');
                window.supportLS = true;
            } catch (e) {
                console.log(e);
                window.supportLS = false;
            }
        }
        var cacheTimeUpdate = '1722254460000';
        var isValidateCachePage = false;
        var cookieName = '_efr';
        var getCookie = function(name) {
            var value = "; " + document.cookie;
            var parts = value.split("; " + name + "=");
            if (parts.length >= 2) {
                return parts.pop().split(";").shift();
            } else {
                return '';
            }
        }
        var setCookie = function(name, value, expire) {
            var date = new Date();
            date.setTime(date.getTime() + (expire * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
            document.cookie = name + "=" + value + expires + "; path=/";
        }
        var unixTimeWithTimeZone = function(offset) {
            var d = new Date();
            var utc = d.getTime() + (d.getTimezoneOffset() * 60000);
            var nd = new Date(utc + (3600000 * offset));
            return Date.parse(nd.toLocaleString());
        }
        var validateCachePage = function() {
            var isDetail = (typeof PAGE_DETAIL !== 'undefined' && PAGE_DETAIL === 1);
            if (isValidateCachePage === false && isDetail === false) {
                var cookieEFR = getCookie(cookieName);
                var datenow = unixTimeWithTimeZone('+7');
                isValidateCachePage = true;
                if ((datenow - cacheTimeUpdate) / (1000 * 60) > 60) {
                    if (cookieEFR != cacheTimeUpdate) {
                        setCookie(cookieName, cacheTimeUpdate, 60);
                        new Image(1, 1).src = "https://logperf.vnexpress.net/perf?lt=0&dclt=0&sr=0&url=vne_reload&iscache=0&device_env=4&domain=" + location.hostname + '&timeserver=' + cacheTimeUpdate + '&timecookie=' + cookieEFR + '&timeclient=' + datenow;
                        location.reload(true);
                    } else {
                        new Image(1, 1).src = "https://logperf.vnexpress.net/perf?lt=0&dclt=0&sr=0&url=vne_reload&iscache=0&device_env=4&domain=" + location.hostname + '&timeserver=' + cacheTimeUpdate + '&timecookie=' + cookieEFR + '&timeclient=' + datenow + '&action=no_reload';
                    }
                }
            }
        }
        validateCachePage();
        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                validateCachePage();
            }
        });
        window.lazyPrefix = '_VnE_202407291901';
        window.lazyKey = window.lazyPrefix + '_094d17b623fed2f731bae4533373049d_' + location.pathname + '_';
        window.registryArea = [];
        if (window.supportLS) {
            var runScripts = function(input) {
                if (typeof input != 'undefined' && input.toLowerCase().indexOf("<\/script>") > -1) {
                    var t = document.createElement('section');
                    t.innerHTML = input;
                    var scripts = t.querySelectorAll('script');
                    [].forEach.call(scripts, function(script) {
                        insertScript(script);
                    });
                }
            }
            var insertScript = function(sc) {
                var s = document.createElement('script');
                s.type = 'text/javascript';
                if (sc.src) {
                    s.onerror = function() {
                        console.log('Init script ' + sc.src + ' fail');
                    };
                    s.src = sc.src;
                } else {
                    s.textContent = sc.innerText;
                }
                document.head.appendChild(s);
                sc.parentNode.removeChild(sc);
            }
            try {
                var cacheData = sessionStorage.getItem(window.lazyKey);
                if (cacheData != null) {
                    cacheData = JSON.parse(cacheData);
                    window.addEventListener('DOMContentLoaded', function(e) {
                        for (var j = 0; j < cacheData.length; j++) {
                            var item = cacheData[j];
                            if (item !== null) {
                                window.registryArea.push(item['area']);
                                document.getElementById(item['area']) && document.getElementById(item['area']).insertAdjacentHTML('beforebegin', item['data']);
                                runScripts(item['data']);
                            }
                        }
                    });
                }
            } catch (e) {
                console.log(e);
            }
        }
        window.addEventListener('DOMContentLoaded', function() {
            var folderLazy = 'pc',
                folderLazyType = 'module';
            if (typeof ES6 !== 'undefined' && ES6 === 0) {
                folderLazy = 'production';
                folderLazyType = 'text/javascript';
            }
            if (window.dontSupportES === false) {
                window.lazyReady = true;
                addScripts(js_url_vne + '/v3/' + folderLazy + '/lazyload.js', true, null, folderLazyType);
            } else {
                var checkReady = setInterval(function() {
                    if (window.dontSupportES === false) {
                        clearInterval(checkReady);
                        window.lazyReady = true;
                        addScripts(js_url_vne + '/v3/' + folderLazy + '/lazyload.js', true, null, folderLazyType);
                    }
                }, 100);
                setTimeout(function() {
                    clearInterval(checkReady);
                    window.lazyReady = true;
                    addScripts(js_url_vne + '/v3/' + folderLazy + '/lazyload.js', true, null, folderLazyType);
                }, 5000);
            }
        });
        var myvne_js = 'https://s1.vnecdn.net/myvne/j/v304';
    </script>
    <script type="text/javascript">
        var inter_version = 2,
            ZONE_BRANDSAFE = '2,8,34,35',
            interactions_url = 'https://usi-saas.vnexpress.net',
            base_url_post = 'https://pm.vnexpress.net',
            base_url = 'https://vnexpress.net',
            css_url = 'https://s1.vnecdn.net/vnexpress/restruct/c/v2847',
            js_url = 'https://s1.vnecdn.net/vnexpress/restruct/j/v6055',
            flash_url = 'https://s1.vnecdn.net/vnexpress/restruct/f/v29',
            img_url = 'https://s1.vnecdn.net/vnexpress/restruct/i/v921',
            js_url_vne = 'https://s1.vnecdn.net/vnexpress/restruct/j/v6055',
            css_url_vne = 'https://s1.vnecdn.net/vnexpress/restruct/c/v2847',
            img_url_vne = 'https://s1.vnecdn.net/vnexpress/restruct/i/v921',
            flash_url_vne = 'https://s1.vnecdn.net/vnexpress/restruct/f/v29',
            device_env = 4,
            eid_authen_url = 'https://authen.eid.vn',
            ZONE_ADS = 0,
            isResizedPhoto = false,
            site_id_ads = 1001002,
            list_folder_show_pvtt = '',
            cacheVersion = 202407290701;
        document.domain = 'vnexpress.net';
        var region_news = 0;
        var groupArticle = 0;
        var articleType = 1;
        var fallback_adblock = 1001002;
    </script>
    <script async src="https://s.eclick.vn/delivery/eclick.js"></script>
    <script>
        var revisionJS = 'v277';
        var fetchCat = function(url) {
            var keyCat = 'fetchCat';
            var keyCatRev = 'fetchCatRev';
            var keyMenu = 'fetchMenu';
            var keyCatFull = 'fetchCatFull';
            var isLocalStorage = window.supportLS;
            var cacheCat = null;
            var cacheCatFull = null;
            var cacheMenu = null;
            if (isLocalStorage) {
                if (localStorage.getItem(keyCatRev) == revisionJS) {
                    cacheCat = localStorage.getItem(keyCat);
                    cacheMenu = localStorage.getItem(keyMenu);
                    cacheCatFull = localStorage.getItem(keyCatFull);
                }
            }
            if (cacheCat === null || cacheMenu === null) {
                var url = js_url_vne + '/v3/pc/config/category.js';
                if (typeof ES6 === 'undefined' || ES6 !== 1) {
                    url = js_url_vne + '/v3/production/config/category.js';
                }
                addScripts(url, true, function() {
                    localStorage.setItem(keyCat, JSON.stringify(window.categoryCustom));
                    localStorage.setItem(keyMenu, JSON.stringify(window.menuCustom))
                    localStorage.setItem(keyCatRev, revisionJS);
                });
            } else {
                try {
                    window.categoryCustom = JSON.parse(cacheCat);
                    window.menuCustom = JSON.parse(cacheMenu)
                } catch (e) {
                    console.log(e);
                }
            }
            if (cacheCatFull === null && isLocalStorage) {
                var xhr = new XMLHttpRequest;
                var url = '/microservice/fc';
                xhr.open("GET", url, true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        try {
                            localStorage.setItem(keyCatFull, xhr.responseText);
                            localStorage.setItem(keyCatRev, revisionJS);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                };
                xhr.send()
            }
        };
        fetchCat();
    </script>
    <script>
        var is_ads_new = 1;
        var googletag = googletag || {},
            pbjs = pbjs || {},
            Criteo = window.Criteo || {};
        googletag.cmd = googletag.cmd || [];
        pbjs.que = pbjs.que || [];
        Criteo.events = Criteo.events || [];
        var googTagCode = {
            display: [],
            config: null,
            video: {
                outstream: {
                    id: '',
                    code: ''
                },
                inarticle: {
                    id: '',
                    code: ''
                }
            },
            tag: {}
        };
    </script>
    <script async='async' type='text/javascript' src='https://securepubads.g.doubleclick.net/tag/js/gpt.js'></script>
    <script async='async' type='text/javascript' src='https://s.eclick.vn/delivery/dfp/dfpbrand.js'></script>
    <script async='async' type='text/javascript' src='https://s.eclick.vn/delivery/dfp/prebid.js'></script>
    <script async='async' type='text/javascript' src='https://s.eclick.vn/delivery/dfp/do_pc_vne_1001142_detail.js'></script>
    <script async='async' type='text/javascript' src='https://s.eclick.vn/zone/1001002/do_pc_detail_1001142.js'></script>
    <script async src="https://s1.vnecdn.net/vnexpress/restruct/j/v6055/v3/production/modules/detail.async.js"></script>
    <script async src="https://s1.vnecdn.net/vnexpress/restruct/j/v6055/v3/production/blocks/detail/1001002.js"></script>
    <style type="text/css">
        .icon_thumb_videophoto,
        .main-nav .parent,
        .wrap-all-menu .container,
        .top-header .right {
            display: -webkit-flex;
            display: -moz-flex;
            display: -ms-flex;
            display: -o-flex;
            display: flex
        }

        .flexbox {
            display: -webkit-flex;
            display: -moz-flex;
            display: -ms-flex;
            display: -o-flex;
            display: flex
        }

        .no-flexbox {
            display: inherit
        }

        .container:after {
            content: '';
            display: table;
            clear: both
        }

        .item-news .title-news,
        .list-sub-feature li .title_news,
        .title-folder,
        .wrapper-topstory-folder .list-sub-feature li .title_news,
        .info-author .meta-news .cat {
            font-feature-settings: 'pnum' on, 'lnum' on;
            -webkit-font-feature-settings: 'pnum' on, 'lnum' on;
            -moz-font-feature-settings: 'pnum' on, 'lnum' on;
            -ms-font-feature-settings: 'pnum' on, 'lnum' on
        }

        .ic {
            width: 16px;
            height: 16px;
            fill: #757575;
            display: inline-block;
            vertical-align: middle
        }

        .ic-in-title {
            width: 12px;
            height: 12px;
            fill: #757575;
            margin-right: 5px;
            margin-top: -1.5%
        }

        .ic-male {
            fill: #0083D6 !important
        }

        .ic-fermale {
            fill: #D71450 !important
        }

        svg.ic-confide {
            fill: #9F224E
        }

        .title-news svg.ic-confide {
            width: 20px;
            height: 20px;
            margin-right: 2px;
            margin-top: -5px
        }

        .ic-live {
            font-size: 14px;
            display: inline-block
        }

        .ic-live:before {
            -webkit-border-radius: 50%;
            border-radius: 50%;
            display: block;
            position: relative;
            top: 5px;
            width: 8px;
            height: 8px;
            content: '';
            background: #B52759;
            box-shadow: 0 0 0 rgba(231, 141, 172, 0.4);
            margin-right: 5px;
            vertical-align: initial;
            -webkit-animation: live-pulse 1s infinite;
            -moz-animation: live-pulse 1s infinite;
            -o-animation: live-pulse 1s infinite;
            animation: live-pulse 1s infinite;
            float: left
        }

        .ic-live:after {
            content: 'Trực tiếp';
            font-family: arial;
            font-style: normal;
            color: #9f224e
        }

        .ic-live.not-start:before {
            background: #757575;
            box-shadow: 0 0 0 rgba(117, 117, 117, 0.4);
            -webkit-animation: live-pulse-2 1s infinite;
            -moz-animation: live-pulse-2 1s infinite;
            -o-animation: live-pulse-2 1s infinite;
            animation: live-pulse-2 1s infinite
        }

        .ic-live.not-start:after {
            content: 'Chưa bắt đầu';
            color: #222
        }

        .ic-live.the-end:before {
            background: #757575;
            box-shadow: 0 0 0 rgba(117, 117, 117, 0.4);
            -webkit-animation: live-pulse-2 1s infinite;
            -moz-animation: live-pulse-2 1s infinite;
            -o-animation: live-pulse-2 1s infinite;
            animation: live-pulse-2 1s infinite
        }

        .ic-live.the-end:after {
            content: 'Đã kết thúc';
            color: #757575
        }

        .ic-live.ic-live-title {
            font-family: "Merriweather", serif;
            font-style: normal;
            color: #9F224E !important;
            margin-right: 5px;
            vertical-align: middle;
            font-weight: 700;
            position: relative;
            padding-left: 13px;
            line-height: 12px;
            margin-top: -4px
        }

        .ic-live.ic-live-title:after {
            content: ''
        }

        .ic-live.ic-live-title:before {
            top: 50%;
            margin-top: -4px;
            position: absolute;
            left: 0
        }

        @-webkit-keyframes live-pulse {
            0% {
                -webkit-box-shadow: 0 0 0 0 rgba(231, 141, 172, 0.4)
            }
            70% {
                -webkit-box-shadow: 0 0 0 10px rgba(231, 141, 172, 0)
            }
            100% {
                -webkit-box-shadow: 0 0 0 0 rgba(231, 141, 172, 0)
            }
        }

        @keyframes live-pulse {
            0% {
                -moz-box-shadow: 0 0 0 0 rgba(231, 141, 172, 0.4);
                box-shadow: 0 0 0 0 rgba(231, 141, 172, 0.4)
            }
            70% {
                -moz-box-shadow: 0 0 0 10px rgba(231, 141, 172, 0);
                box-shadow: 0 0 0 10px rgba(231, 141, 172, 0)
            }
            100% {
                -moz-box-shadow: 0 0 0 0 rgba(231, 141, 172, 0);
                box-shadow: 0 0 0 0 rgba(231, 141, 172, 0)
            }
        }

        @-webkit-keyframes live-pulse-2 {
            0% {
                -webkit-box-shadow: 0 0 0 0 rgba(117, 117, 117, 0.4)
            }
            70% {
                -webkit-box-shadow: 0 0 0 10px rgba(117, 117, 117, 0)
            }
            100% {
                -webkit-box-shadow: 0 0 0 0 rgba(117, 117, 117, 0)
            }
        }

        @keyframes live-pulse-2 {
            0% {
                -moz-box-shadow: 0 0 0 0 rgba(117, 117, 117, 0.4);
                box-shadow: 0 0 0 0 rgba(117, 117, 117, 0)
            }
            70% {
                -moz-box-shadow: 0 0 0 10px rgba(117, 117, 117, 0);
                box-shadow: 0 0 0 10px rgba(117, 117, 117, 0)
            }
            100% {
                -moz-box-shadow: 0 0 0 0 rgba(117, 117, 117, 0);
                box-shadow: 0 0 0 0 rgba(117, 117, 117, 0)
            }
        }

        html,
        body {
            text-rendering: optimizeLegibility
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -ms-box-sizing: border-box;
            text-rendering: optimizeLegibility
        }

        body {
            color: #222;
            font: 400 15px arial;
            min-height: 100vh;
            overflow-x: hidden;
            overflow-y: scroll
        }

        html {
            -webkit-text-size-adjust: none
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            line-height: inherit;
            font-size: inherit;
            font-weight: inherit
        }

        .has_transition,
        .title-news a {
            transition-duration: 200ms;
            transition-property: all;
            transition-timing-function: cubic-bezier(0.7, 1, 0.7, 1)
        }

        a:focus {
            outline: 1 !important
        }

        a {
            color: inherit;
            text-decoration: none;
            outline: 1
        }

        table {
            border-collapse: collapse
        }

        img {
            border: 0;
            font-size: 0;
            line-height: 0;
            max-width: 100%
        }

        ul,
        li {
            list-style-type: none
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="tel"],
        input[type="number"],
        textarea,
        select {
            background: #fff;
            width: 100%;
            height: 40px;
            border: 1px solid #e5e5e5;
            font-size: 15px;
            padding: 0 12px;
            outline: none;
            font-family: arial;
            transition-duration: 200ms;
            transition-property: all;
            transition-timing-function: cubic-bezier(0.7, 1, 0.7, 1)
        }

        input[type="text"]:focus,
        input[type="password"]:focus,
        input[type="email"]:focus,
        input[type="tel"]:focus,
        input[type="number"]:focus,
        textarea:focus,
        select:focus {
            border: 1px solid #4f4f4f
        }

        input[type="number"] {
            -moz-appearance: textfield
        }

        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0
        }

        button {
            border: none;
            outline: none;
            cursor: pointer
        }

        figure {
            margin: 0 auto 20px;
            max-width: 100%;
            clear: both
        }

        .clearfix:before,
        .clearfix:after {
            content: '';
            display: block;
            height: 0;
            overflow: hidden
        }

        .clearfix:after {
            clear: both
        }

        .left {
            float: left !important
        }

        .right {
            float: right !important
        }

        .width_common {
            width: 100%;
            float: left
        }

        .flex {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-wrap: wrap;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap
        }

        .no_wrap {
            white-space: nowrap
        }

        .txt_666 {
            color: #666
        }

        .txt_10 {
            font-size: 10px
        }

        .txt_11 {
            font-size: 11px
        }

        .txt_14 {
            font-size: 14px
        }

        .txt_16 {
            font-size: 16px
        }

        .txt_vne {
            color: #9f224e
        }

        .mb0 {
            margin-bottom: 0 !important
        }

        .mb5 {
            margin-bottom: 5px
        }

        .mb10 {
            margin-bottom: 10px
        }

        .mb15 {
            margin-bottom: 15px
        }

        .mb20 {
            margin-bottom: 20px
        }

        .mb30 {
            margin-bottom: 30px
        }

        .mb35 {
            margin-bottom: 35px !important
        }

        .mt5 {
            margin-top: 5px
        }

        .mt10 {
            margin-top: 10px
        }

        .mt15 {
            margin-top: 15px
        }

        .mt20 {
            margin-top: 20px !important
        }

        .thumb-art {
            position: relative;
            margin-right: 10px;
            float: left;
            width: 140px
        }

        .thumb {
            display: block;
            overflow: hidden;
            height: 0;
            position: relative;
            width: 100%;
            background: #f4f4f4
        }

        .thumb img {
            -o-object-fit: cover;
            object-fit: cover;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            height: 100%
        }

        .thumb iframe {
            width: 100%;
            height: 100%;
            position: absolute;
            left: 0;
            top: 0
        }

        .thumb-5x3 {
            padding-bottom: 60%
        }

        .thumb-5x2 {
            padding-bottom: 40%
        }

        .thumb-3x2 {
            padding-bottom: 66.66667%
        }

        .thumb-16x9 {
            padding-bottom: 56.25%
        }

        .thumb-1x1 {
            padding-bottom: 100%
        }

        .thumb-2x3 {
            padding-bottom: 150%
        }

        .thumb-video {
            width: 100%;
            height: 0;
            padding-bottom: 56.25%;
            margin-bottom: 0;
            position: relative;
            overflow: hidden
        }

        .thumb-video iframe {
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            top: 0
        }

        .icon_thumb_videophoto {
            width: 24px;
            display: block;
            height: 24px;
            line-height: 24px;
            text-align: center;
            position: absolute;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 3px;
            left: 5px;
            bottom: 5px;
            font-size: 12px;
            color: #fff;
            font-weight: 700;
            justify-content: center
        }

        .icon_thumb_videophoto .ic {
            align-self: center;
            fill: #fff;
            width: 14px;
            height: 14px
        }

        .title_news .icon_premium_vne,
        .title-news .icon_premium_vne {
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg width='18' height='18' viewBox='0 0 18 18' fill='none' xmlns='http://www.w3.org/2000/svg'%3e%3crect width='18' height='18' rx='2' fill='%23766123'/%3e%3cpath d='M5.35598 12.2754H12.6439C12.8079 12.2754 12.929 12.4287 12.8915 12.5883C12.7619 13.1401 12.6613 13.5687 12.6055 13.8044C12.5784 13.9192 12.476 13.9999 12.3581 13.9999H5.64231C5.52441 13.9999 5.42205 13.9193 5.39486 13.8046C5.33899 13.5688 5.23812 13.1402 5.10842 12.5884C5.07091 12.4287 5.19196 12.2754 5.35598 12.2754Z' fill='white'/%3e%3cpath d='M14.8044 4.42826C14.5147 5.66564 13.8644 8.44251 13.3372 10.6893C13.3103 10.8043 13.2078 10.8854 13.0896 10.8854H4.91036C4.79224 10.8854 4.68972 10.8043 4.66275 10.6893C4.13562 8.44251 3.48533 5.66564 3.19562 4.42826C3.14239 4.20092 3.39801 4.02838 3.58928 4.16228L6.94668 6.51247C7.06538 6.59556 7.22938 6.56289 7.30716 6.44066L8.78564 4.11779C8.88562 3.96072 9.11491 3.96074 9.21487 4.11782L10.6928 6.4406C10.7706 6.56284 10.9346 6.59553 11.0533 6.51244L14.4107 4.16228C14.602 4.02839 14.8576 4.20094 14.8044 4.42826Z' fill='white'/%3e%3c/svg%3e");
            background-size: contain;
            width: 18px;
            height: 18px;
            display: inline-block;
            vertical-align: text-top;
            margin-right: 3px
        }

        .box-player-video .item-news .title-news .icon_premium_vne {
            vertical-align: inherit
        }

        .thumb .icon_premium_vne {
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'%3e%3crect width='24' height='24' rx='3' fill='%23A57F0B'/%3e%3cpath d='M6.89842 16.5854H17.1015C17.3312 16.5854 17.5006 16.8 17.4481 17.0236C17.2667 17.796 17.1258 18.396 17.0478 18.7261C17.0098 18.8868 16.8664 18.9998 16.7013 18.9998H7.29928C7.13423 18.9998 6.99092 18.8869 6.95285 18.7263C6.87464 18.3963 6.73342 17.7962 6.55184 17.0236C6.49933 16.8001 6.6688 16.5854 6.89842 16.5854Z' fill='white'/%3e%3cpath d='M20.1261 5.59956C19.7205 7.33189 18.8101 11.2195 18.0722 14.3651C18.0344 14.5261 17.8909 14.6395 17.7255 14.6395H6.27452C6.10916 14.6395 5.96563 14.5261 5.92787 14.3651C5.18988 11.2195 4.27949 7.33189 3.87389 5.59956C3.79937 5.28129 4.15723 5.03973 4.42502 5.2272L9.12537 8.51746C9.29155 8.63378 9.52115 8.58804 9.63004 8.41692L11.6999 5.1649C11.8399 4.94501 12.1609 4.94504 12.3008 5.16495L14.37 8.41683C14.4789 8.58797 14.7085 8.63373 14.8747 8.51741L19.575 5.2272C19.8428 5.03975 20.2007 5.28131 20.1261 5.59956Z' fill='white'/%3e%3c/svg%3e");
            background-size: contain;
            width: 24px;
            height: 24px;
            position: absolute;
            bottom: 10px;
            left: 10px
        }

        .thumb .thumb-gif {
            width: 100%;
            -webkit-filter: unset;
            filter: unset;
            -webkit-transition: opacity 1s ease-out;
            -o-transition: opacity 1s ease-out;
            transition: opacity 1s ease-out
        }

        .wrap-main-nav {
            background: #fff;
            position: sticky;
            position: -webkit-sticky;
            top: 0;
            z-index: 999
        }

        @media screen and (max-width: 1280px) {
            .wrap-main-nav {
                min-height: auto !important
            }
        }

        .wrap-main-nav.show-all-menu .wrap-all-menu {
            top: calc(100% - 3px);
            visibility: visible;
            opacity: 1
        }

        .wrap-main-nav.show-all-menu .wrap-all-menu:after {
            opacity: 1;
            visibility: visible
        }

        .wrap-main-nav.show-all-menu .parent li {
            color: #bdbdbd
        }

        .wrap-main-nav.show-all-menu .all-menu {
            color: #9f224e !important
        }

        .wrap-main-nav.show-all-menu .hamburger {
            background: #9f224e !important
        }

        .wrap-main-nav.show-all-menu .hamburger:before,
        .wrap-main-nav.show-all-menu .hamburger:after {
            background: #9f224e !important
        }

        .wrap-main-nav.sticky {
            top: 0;
            position: fixed
        }

        .main-nav {
            width: 100%;
            float: left;
            clear: both;
            font-size: 14px;
            overflow: hidden;
            border-bottom: 1px solid #E5E5E5;
            transition-duration: 300ms;
            transition-property: all;
            transition-timing-function: cubic-bezier(0.7, 1, 0.7, 1)
        }

        .main-nav:hover {
            overflow: visible
        }

        .main-nav .parent {
            justify-content: space-between;
            max-width: 1440px;
            margin: 0 auto;
            padding: 0 15px
        }

        .main-nav .parent li {
            margin-right: 12px;
            position: relative;
            font-weight: 400;
            color: #222222;
            transition-duration: 200ms;
            transition-property: color;
            transition-timing-function: cubic-bezier(0.7, 1, 0.7, 1)
        }

        .main-nav .parent li a {
            padding: 16.5px 0;
            display: block;
            white-space: nowrap
        }

        .main-nav .parent li:hover .sub {
            opacity: 1;
            visibility: visible;
            top: 100%;
            border-top: 1px solid #9f224e
        }

        .main-nav .parent li.active a,
        .main-nav .parent li:hover a {
            color: #B52759
        }

        .main-nav .parent li.kinhdoanh:hover a,
        .main-nav .parent li.kinhdoanh.active a {
            color: #065E9D
        }

        .main-nav .parent li.giaitri:hover a,
        .main-nav .parent li.giaitri.active a {
            color: #EC326B
        }

        .main-nav .parent li.thethao:hover a,
        .main-nav .parent li.thethao.active a {
            color: #5FAE2E
        }

        .main-nav .parent li.phapluat:hover a,
        .main-nav .parent li.phapluat.active a {
            color: #923A3C
        }

        .main-nav .parent li.giaoduc:hover a,
        .main-nav .parent li.giaoduc.active a {
            color: #EB7600
        }

        .main-nav .parent li.suckhoe:hover a,
        .main-nav .parent li.suckhoe.active a {
            color: #049B93
        }

        .main-nav .parent li.doisong:hover a,
        .main-nav .parent li.doisong.active a {
            color: #309FC0
        }

        .main-nav .parent li.dulich:hover a,
        .main-nav .parent li.dulich.active a {
            color: #0083D6
        }

        .main-nav .parent li.khoahoc:hover a,
        .main-nav .parent li.khoahoc.active a {
            color: #AD9634
        }

        .main-nav .parent li.sohoa:hover a,
        .main-nav .parent li.sohoa.active a {
            color: #B88000
        }

        .main-nav .parent li.xe:hover a,
        .main-nav .parent li.xe.active a {
            color: #8392A0
        }

        .main-nav .parent li.cuoi:hover a,
        .main-nav .parent li.cuoi.active a {
            color: #E7776A
        }

        .main-nav .parent li.home {
            padding: 12px 0
        }

        .main-nav .parent li.home a {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #e5e5e5;
            justify-content: center;
            padding: 0;
            position: relative;
            transition-duration: 300ms;
            transition-property: all;
            transition-timing-function: cubic-bezier(0.7, 1, 0.7, 1)
        }

        .main-nav .parent li.home a .ic {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            transition-duration: 300ms;
            transition-property: all;
            transition-timing-function: cubic-bezier(0.7, 1, 0.7, 1)
        }

        .main-nav .parent li.home a .ic.ic-evne {
            opacity: 0;
            width: 20px;
            height: 20px
        }

        .main-nav .parent li.home:hover a,
        .main-nav .parent li.home.active a {
            background: #B52759
        }

        .main-nav .parent li.home:hover a .ic,
        .main-nav .parent li.home.active a .ic {
            fill: #fff
        }

        .main-nav .parent li.kinhdoanh .sub {
            border-top: 1px solid #04416d
        }

        .main-nav .parent li.giaitri .sub {
            border-top: 1px solid #d71450
        }

        .main-nav .parent li.thethao .sub {
            border-top: 1px solid #498523
        }

        .main-nav .parent li.phapluat .sub {
            border-top: 1px solid #6e2c2d
        }

        .main-nav .parent li.giaoduc .sub {
            border-top: 1px solid #B75C00
        }

        .main-nav .parent li.suckhoe .sub {
            border-top: 1px solid #03817B
        }

        .main-nav .parent li.doisong .sub {
            border-top: 1px solid #2D96B5
        }

        .main-nav .parent li.dulich .sub {
            border-top: 1px solid #0072bb
        }

        .main-nav .parent li.khoahoc .sub {
            border-top: 1px solid #867428
        }

        .main-nav .parent li.sohoa .sub {
            border-top: 1px solid #9c6d00
        }

        .main-nav .parent li.xe .sub {
            border-top: 1px solid #5D6C79
        }

        .main-nav .parent li.cuoi .sub {
            border-top: 1px solid #DC3926
        }

        .main-nav .parent li.newlest {
            opacity: 0;
            visibility: hidden;
            width: 0px;
            padding-right: 0;
            margin-right: 0;
            transition-duration: 200ms;
            transition-property: all;
            transition-timing-function: cubic-bezier(0.7, 1, 0.7, 1)
        }

        .main-nav .parent li.newlest a {
            color: #9f224e
        }

        .main-nav .parent li.newlest.active a,
        .main-nav .parent li.newlest:hover a {
            color: #B52759
        }

        .main-nav .parent li.newlest:after {
            content: "";
            width: 1px;
            height: 14px;
            background: #e5e5e5;
            position: absolute;
            top: 18px;
            right: 0
        }

        .main-nav .parent li.all-menu {
            font-size: 0
        }

        .main-nav .parent li.li-myvne {
            opacity: 0;
            visibility: hidden;
            width: 0px;
            margin-right: 0;
            margin-left: 0;
            transition-duration: 200ms;
            transition-property: all;
            transition-timing-function: cubic-bezier(0.7, 1, 0.7, 1)
        }

        .main-nav .parent li.li-myvne a {
            padding: 10px 0 8px 0;
            display: inline-block
        }

        .main-nav .sub {
            width: 190px;
            background: #fff;
            opacity: 0;
            visibility: hidden;
            position: absolute;
            z-index: 2;
            left: 0;
            top: calc(100% + 20px);
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.1);
            transition-duration: 200ms;
            transition-property: opacity, top, visible;
            transition-timing-function: cubic-bezier(0.7, 1, 0.7, 1)
        }

        .main-nav .sub li {
            font-weight: normal;
            color: #222
        }

        .main-nav .sub li a {
            padding: 10px 15px;
            color: #333 !important
        }

        .main-nav .sub li a:hover {
            text-decoration: underline
        }

        .main-nav .all-menu {
            margin-right: 0 !important;
            color: #bdbdbd !important;
            font-weight: normal !important
        }

        .main-nav .all-menu a {
            display: -webkit-flex !important;
            display: -moz-flex !important;
            display: -ms-flex !important;
            display: -o-flex !important;
            display: flex !important
        }

        .main-nav .all-menu .hamburger {
            width: 16px;
            height: 2px;
            position: relative;
            background: #bdbdbd;
            display: block;
            top: 2px;
            margin-left: 8px
        }

        .main-nav .all-menu .hamburger:before,
        .main-nav .all-menu .hamburger:after {
            content: "";
            width: 16px;
            height: 2px;
            background: #bdbdbd;
            position: absolute
        }

        .main-nav .all-menu .hamburger:before {
            left: 0;
            top: 10px
        }

        .main-nav .all-menu .hamburger:after {
            left: 0;
            top: 5px
        }

        .main-nav .all-menu:hover .hamburger {
            background: #B52759
        }

        .main-nav .all-menu:hover .hamburger:before,
        .main-nav .all-menu:hover .hamburger:after {
            background: #B52759
        }

        @media screen and (max-width: 1369px) {
            .main-nav .parent li {
                margin-right: 10px
            }
        }

        .wrap-main-nav.sticky .main-nav {
            background: linear-gradient(180deg, #fff 0%, rgba(255, 255, 255, 0) 100%), #fff;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.1)
        }

        .wrap-main-nav.sticky .main-nav .parent li.home a {
            background: none
        }

        .wrap-main-nav.sticky .main-nav .parent li.home a .ic-home {
            opacity: 0
        }

        .wrap-main-nav.sticky .main-nav .parent li.home a .ic-evne {
            opacity: 1
        }

        .wrap-main-nav.sticky .main-nav .parent li.newlest {
            opacity: 1;
            visibility: visible;
            width: 73.95px;
            padding-right: 15px;
            margin-right: 15px
        }

        .wrap-main-nav.sticky .main-nav .parent li.li-myvne {
            opacity: 1;
            visibility: visible;
            width: 61px;
            margin-left: 8px;
            display: block !important
        }

        .wrap-main-nav.sticky .main-nav .parent li:nth-last-of-type(-n+4) {
            display: none
        }

        .wrap-main-nav.sticky .main-nav .parent li.all-menu {
            display: block !important
        }

        .wrap-main-nav.sticky .main-nav .parent li ul.sub li:nth-last-of-type(-n+4) {
            display: block
        }

        @media screen and (max-width: 1439px) {
            .wrap-main-nav.sticky .main-nav .parent li:nth-last-of-type(-n+5) {
                display: none
            }
            .wrap-main-nav.sticky .main-nav .parent li ul.sub li:nth-last-of-type(-n+5) {
                display: block
            }
        }

        .wrap-all-menu {
            width: 100%;
            float: left;
            background: #f7f7f7;
            position: absolute;
            top: calc(100% + 10px);
            opacity: 0;
            visibility: hidden;
            transition-duration: 200ms;
            transition-property: opacity, top, visible;
            transition-timing-function: cubic-bezier(0.7, 1, 0.7, 1)
        }

        .wrap-all-menu:after {
            width: 100%;
            height: 300px;
            position: absolute;
            background: rgba(0, 0, 0, 0.75);
            bottom: -300px;
            left: 0;
            content: "";
            z-index: -1;
            opacity: 0;
            visibility: hidden;
            transition-duration: 700ms;
            transition-property: all;
            transition-timing-function: cubic-bezier(0.7, 1, 0.7, 1)
        }

        .wrap-all-menu .container {
            flex-wrap: wrap
        }

        .wrap-all-menu .header-menu {
            width: 100%;
            float: left;
            border-bottom: 1px solid #bdbdbd;
            padding: 13px 0
        }

        .wrap-all-menu .header-menu .name-header {
            font-size: 18px;
            line-height: 23px;
            color: #4f4f4f;
            display: inline-block;
            font-family: "Merriweather", serif;
            font-weight: 900
        }

        .wrap-all-menu .header-menu .close-menu {
            float: right;
            color: #076db6
        }

        .wrap-all-menu .header-menu .close-menu .icon-close {
            position: relative;
            width: 14px;
            height: 14px;
            display: block;
            float: right;
            top: 3px;
            margin-left: 10px
        }

        .wrap-all-menu .header-menu .close-menu .icon-close:before,
        .wrap-all-menu .header-menu .close-menu .icon-close:after {
            content: "";
            width: 20px;
            height: 2px;
            position: absolute;
            background: #076db6;
            left: -3px;
            top: 6px
        }

        .wrap-all-menu .header-menu .close-menu .icon-close:before {
            transform: rotate(45deg)
        }

        .wrap-all-menu .header-menu .close-menu .icon-close:after {
            transform: rotate(-45deg)
        }

        .wrap-all-menu .content-left {
            width: calc(100% - 160px);
            float: left;
            padding-top: 15px;
            padding-bottom: 15px
        }

        .wrap-all-menu .content-left .scroll-menu-expand {
            max-height: calc(100vh - 130px);
            overflow: hidden
        }

        .wrap-all-menu .content-right {
            width: 160px;
            padding-left: 12px;
            float: right;
            padding-top: 15px;
            border-left: 1px solid #bdbdbd
        }

        .wrap-all-menu .content-right .scroll-menu-expand {
            max-height: calc(100vh - 130px);
            overflow: hidden
        }

        .wrap-all-menu .row-menu {
            font-size: 0
        }

        .wrap-all-menu .cat-menu {
            display: inline-block;
            vertical-align: top;
            font-size: 14px;
            width: 150px;
            margin-bottom: 30px
        }

        .wrap-all-menu .cat-menu li.hidden {
            display: none
        }

        .wrap-all-menu .cat-menu li:first-child {
            color: #9f224e;
            font-size: 16px;
            font-weight: bold
        }

        .wrap-all-menu .cat-menu li:first-child a {
            padding-top: 0
        }

        .wrap-all-menu .cat-menu li:first-child a:hover,
        .wrap-all-menu .cat-menu li:first-child a.active {
            text-decoration: underline;
            color: #B52759
        }

        .wrap-all-menu .cat-menu li.view-more {
            color: #757575;
            font-size: 12px;
            position: relative;
            padding-top: 3px
        }

        .wrap-all-menu .cat-menu li.view-more:hover {
            color: #087cce
        }

        .wrap-all-menu .cat-menu li.view-more:before {
            content: "";
            width: 80px;
            height: 1px;
            background: #bdbdbd;
            position: absolute;
            top: 6px;
            left: 0
        }

        .wrap-all-menu .cat-menu li a {
            padding: 7.5px 0;
            display: inline-block
        }

        .wrap-all-menu .cat-menu li a:hover,
        .wrap-all-menu .cat-menu li a.active {
            text-decoration: underline
        }

        .wrap-all-menu .cat-menu li.kinhdoanh a:hover,
        .wrap-all-menu .cat-menu li.kinhdoanh a.active {
            color: #065E9D
        }

        .wrap-all-menu .cat-menu li.giaitri a:hover,
        .wrap-all-menu .cat-menu li.giaitri a.active {
            color: #EC326B
        }

        .wrap-all-menu .cat-menu li.thethao a:hover,
        .wrap-all-menu .cat-menu li.thethao a.active {
            color: #5FAE2E
        }

        .wrap-all-menu .cat-menu li.phapluat a:hover,
        .wrap-all-menu .cat-menu li.phapluat a.active {
            color: #923A3C
        }

        .wrap-all-menu .cat-menu li.giaoduc a:hover,
        .wrap-all-menu .cat-menu li.giaoduc a.active {
            color: #EB7600
        }

        .wrap-all-menu .cat-menu li.suckhoe a:hover,
        .wrap-all-menu .cat-menu li.suckhoe a.active {
            color: #049B93
        }

        .wrap-all-menu .cat-menu li.doisong a:hover,
        .wrap-all-menu .cat-menu li.doisong a.active {
            color: #309FC0
        }

        .wrap-all-menu .cat-menu li.dulich a:hover,
        .wrap-all-menu .cat-menu li.dulich a.active {
            color: #0083D6
        }

        .wrap-all-menu .cat-menu li.khoahoc a:hover,
        .wrap-all-menu .cat-menu li.khoahoc a.active {
            color: #AD9634
        }

        .wrap-all-menu .cat-menu li.sohoa a:hover,
        .wrap-all-menu .cat-menu li.sohoa a.active {
            color: #B88000
        }

        .wrap-all-menu .cat-menu li.xe a:hover,
        .wrap-all-menu .cat-menu li.xe a.active {
            color: #8392A0
        }

        .wrap-all-menu .cat-menu li.cuoi a:hover,
        .wrap-all-menu .cat-menu li.cuoi a.active {
            color: #E7776A
        }

        .wrap-all-menu .type-news {
            padding-bottom: 12px;
            border-bottom: 1px solid #bdbdbd;
            margin-bottom: 20px
        }

        .wrap-all-menu .type-news .item-type {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 17px
        }

        .wrap-all-menu .type-news .item-type:hover a {
            text-decoration: underline
        }

        .wrap-all-menu .list-link {
            padding-bottom: 12px;
            border-bottom: 1px solid #bdbdbd;
            margin-bottom: 20px
        }

        .wrap-all-menu .list-link .link {
            font-size: 14px;
            margin-bottom: 15px
        }

        .wrap-all-menu .list-link .link:hover a {
            text-decoration: underline
        }

        .wrap-all-menu .contact .ic {
            margin-right: 5px
        }

        .wrap-all-menu .contact p {
            margin-bottom: 10px
        }

        .wrap-all-menu .contact a {
            border: 1px solid #e5e5e5;
            background: #fff;
            border-radius: 3px;
            height: 32px;
            line-height: 32px;
            display: block;
            text-align: left;
            padding-left: 12px;
            margin-bottom: 10px;
            font-size: 14px
        }

        .wrap-all-menu .contact a:hover {
            color: #087cce
        }

        .wrap-all-menu .contact .mail {
            background: none;
            border-radius: 3px;
            height: 20px;
            line-height: 20px;
            padding-left: 0;
            display: block;
            text-align: left;
            border: none
        }

        .wrap-all-menu .contact .mail .ic {
            fill: #bdbdbd;
            margin-top: -2px
        }

        .wrap-all-menu .contact .ads {
            background: none;
            border-radius: 3px;
            height: 20px;
            line-height: 20px;
            padding-left: 0;
            display: block;
            text-align: left;
            border: none
        }

        .wrap-all-menu .contact .ads .ic {
            fill: none
        }

        .wrap-all-menu .contact .ads .ic.ic-ads {
            width: 13px;
            height: 14px;
            background: url(https://s1.vnecdn.net/vnexpress/restruct/c/v2847/v2_2019/images/graphics/icon-eclick.svg) no-repeat 0 0;
            margin-top: -2px;
            margin-right: 9px
        }

        .wrap-all-menu .contact .vlight {
            background: none;
            padding-left: 0;
            border: none;
            height: 20px;
            line-height: 20px
        }

        .wrap-all-menu .contact .vlight .ic-vlight {
            width: 14px;
            height: 16px;
            display: inline-block;
            vertical-align: middle;
            background: url(https://s1.vnecdn.net/vnexpress/restruct/c/v2847/v2_2019/images/graphics/logo_vlight.svg) no-repeat 0 0/contain;
            margin-right: 5px
        }

        .wrap-all-menu .contact .vlight:hover {
            color: #087cce
        }

        .wrap-all-menu .contact.downloadapp {
            padding-top: 20px;
            margin-top: 20px;
            border-top: 1px solid #bdbdbd
        }

        .wrap-all-menu .contact.downloadapp a .ic {
            margin-top: -3px
        }

        .wrap-all-menu .contact.downloadapp a:hover {
            color: #222;
            background: #e5e5e5
        }

        .wrap-main-nav.sticky+.section {
            margin-top: 50px
        }

        .lazy-blur {
            -webkit-filter: blur(2px);
            filter: blur(2px)
        }

        .lazy-unblur {
            opacity: 0;
            -webkit-filter: unset;
            filter: unset;
            will-change: opacity;
            -webkit-transition: opacity 1s ease-out;
            -o-transition: opacity 1s ease-out;
            transition: opacity 1s ease-out
        }

        .lazier {
            width: 1px;
            height: 1px;
            clear: both
        }

        .thumb-art {
            position: relative
        }

        .lazy {
            position: absolute;
            top: 0;
            left: 0
        }

        .loaded {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            -webkit-filter: unset;
            filter: unset;
            -webkit-transition: opacity 1s ease-out;
            -o-transition: opacity 1s ease-out;
            transition: opacity 1s ease-out
        }

        @keyframes fadeInUp {
            from {
                -webkit-transform: translate3d(0, 5px, 0);
                transform: translate3d(0, 5px, 0)
            }
            to {
                -webkit-transform: translate3d(0, 0, 0);
                transform: translate3d(0, 0, 0);
                opacity: 1
            }
        }

        @-webkit-keyframes fadeInUp {
            from {
                -webkit-transform: translate3d(0, 5px, 0);
                transform: translate3d(0, 5px, 0)
            }
            to {
                -webkit-transform: translate3d(0, 0, 0);
                transform: translate3d(0, 0, 0);
                opacity: 1
            }
        }

        .animated {
            animation-duration: 1s;
            animation-fill-mode: both;
            -webkit-animation-duration: 1s;
            -webkit-animation-fill-mode: both
        }

        .animatedFadeInUp {
            opacity: 0
        }

        .fadeInUp {
            opacity: 0;
            animation-name: fadeInUp;
            -webkit-animation-name: fadeInUp
        }

        .grecaptcha-badge {
            display: none !important
        }

        .banner-ads {
            width: 100%;
            float: left;
            text-align: center;
            overflow: hidden
        }

        .banner-ads.banner-height-360 {
            height: 360px
        }

        .banner-ads.banner-height-360 img {
            height: 360px
        }

        .banner-ads.banner-height-600 {
            height: 600px
        }

        .banner-ads.banner-height-600 img {
            height: 600px
        }

        .banner-ads.banner-height-250 {
            height: 250px
        }

        .banner-ads.banner-height-250 img {
            height: 250px
        }

        .banner-ads.banner-height-500 {
            height: 500px
        }

        .banner-ads.banner-height-500 img {
            height: 500px
        }

        .banner-ads.banner-height-90 {
            height: 90px
        }

        .banner-ads.banner-height-90 img {
            height: 90px
        }

        .section-ads-top {
            transition: all 0.6s ease-in-out;
            background: #f7f7f7;
            min-height: 270px !important;
            flex-direction: column
        }

        .container {
            width: 100%;
            max-width: 1130px;
            padding: 0 15px;
            margin: 0 auto;
            position: relative
        }

        .extra-container {
            width: 100%;
            max-width: 1340px;
            padding: 0 15px
        }

        .section {
            width: 100%;
            float: left
        }

        .hidden {
            display: none !important
        }

        .top-header {
            padding: 8.5px 0;
            border-bottom: 1px solid #E5E5E5
        }

        .top-header .right {
            align-items: center
        }

        .top-header .search {
            position: relative;
            margin-left: 10px;
            padding-left: 10px;
            line-height: 32px
        }

        .top-header .search input {
            height: 32px;
            line-height: 32px;
            border-radius: 16px;
            border: 1px solid #E5E5E5;
            padding: 0 30px 0 14px;
            margin: 0;
            width: 160px
        }

        .top-header .search input:focus {
            border: 1px solid #bdbdbd
        }

        .top-header .search button {
            background: none;
            position: absolute;
            right: 0;
            top: 0;
            width: 32px;
            height: 32px
        }

        .top-header .search button .ic {
            fill: #bdbdbd
        }

        .top-header .search:before {
            content: "";
            width: 1px;
            height: 24px;
            background: #e5e5e5;
            position: absolute;
            left: 0;
            top: 4px
        }

        .top-header .news-area {
            margin-top: -2px
        }

        .live-button {
            background: #ffffff;
            border: 1px solid #e5e5e5;
            border-radius: 3px;
            padding: 6px 10px 7px 10px;
            display: inline-block;
            margin-right: 15px;
            cursor: pointer;
            position: relative
        }

        .live-button .txt-live {
            text-transform: uppercase;
            color: #757575;
            font-size: 14px;
            line-height: 16px
        }

        .live-button .ic-live {
            display: none
        }

        .live-button .ic-live:after {
            content: ""
        }

        .live-button .ic-live:before {
            top: -1px;
            background: #ed1b24
        }

        .live-button.has-live {
            background: #fcf2f6;
            border: 1px solid #ed1b24
        }

        .live-button.has-live .txt-live {
            color: #ed1b24
        }

        .live-button.living {
            background: rgba(237, 27, 36, 0.1);
            border: 1px solid #ed1b24
        }

        .live-button.living .txt-live {
            color: #ed1b24
        }

        .live-button.living .ic-live {
            display: inline-block
        }

        .all-menu-tablet {
            float: left;
            width: 50px;
            height: 33px;
            text-align: center;
            margin-left: -15px;
            margin-top: -2px;
            cursor: pointer;
            display: none
        }

        .all-menu-tablet .hamburger {
            width: 20px;
            height: 2px;
            background: #bdbdbd;
            display: inline-block;
            position: relative
        }

        .all-menu-tablet .hamburger:before,
        .all-menu-tablet .hamburger:after {
            content: "";
            width: 20px;
            height: 2px;
            background: #bdbdbd;
            position: absolute;
            left: 0
        }

        .all-menu-tablet .hamburger:before {
            top: 6px
        }

        .all-menu-tablet .hamburger:after {
            top: 12px
        }

        .all-menu-tablet.close-menu-tablet {
            padding-top: 5px
        }

        .all-menu-tablet.close-menu-tablet .hamburger {
            transform: rotate(45deg);
            -webkit-transform: rotate(45deg)
        }

        .all-menu-tablet.close-menu-tablet .hamburger:before {
            display: none
        }

        .all-menu-tablet.close-menu-tablet .hamburger:after {
            transform: rotate(-90deg);
            -webkit-transform: rotate(-90deg);
            top: 0
        }

        .myvne_taskbar {
            margin-left: 15px
        }

        .myvne_taskbar .log_txt {
            height: 32px;
            line-height: 32px;
            color: #4f4f4f
        }

        .myvne_taskbar .log_txt .ic-user {
            fill: #bdbdbd;
            margin-right: 5px;
            margin-top: -2px
        }

        .myvne_taskbar .log_txt:hover {
            color: #087cce
        }

        .logo {
            display: inline-block;
            float: left;
            padding-top: 2px
        }

        .btn24hqua,
        .evne {
            height: 32px;
            line-height: 30px;
            padding: 0;
            border-radius: 3px;
            font-size: 14px;
            color: #757575;
            display: inline-block
        }

        .btn24hqua .ic,
        .evne .ic {
            margin-right: 5px;
            margin-top: -1px
        }

        .btn24hqua:hover,
        .evne:hover {
            color: #4f4f4f
        }

        .btn24hqua {
            position: relative
        }

        .btn24hqua:after {
            width: 1px;
            height: 20px;
            background: #efefef;
            content: '';
            position: absolute;
            top: 5px;
            right: -11px
        }

        .btn24hqua .ic {
            fill: #bdbdbd
        }

        .btn24hqua.active {
            color: #9f224e
        }

        .btn24hqua.active .ic {
            fill: #9f224e
        }

        .evne {
            margin-left: 20px;
            position: relative
        }

        .evne:after {
            width: 1px;
            height: 20px;
            background: #efefef;
            content: '';
            position: absolute;
            top: 5px;
            left: -11px
        }

        .time-now {
            font-size: 14px;
            line-height: 32px;
            color: #757575;
            position: relative;
            margin-left: 20px;
            padding-left: 15px;
            float: left
        }

        .time-now:before {
            content: "";
            width: 1px;
            height: 26px;
            background: #e5e5e5;
            position: absolute;
            left: 0;
            top: 2px
        }

        .news-area {
            position: relative;
            display: inline-block;
            margin-left: 20px;
            cursor: pointer;
            z-index: 1000;
            padding: 8px 0
        }

        .news-area .txt-area {
            display: flex;
            align-items: center;
            color: #757575;
            font-size: 14px;
            position: relative
        }

        .news-area .txt-area .dot-blue {
            width: 4px;
            height: 4px;
            background: #087ECA;
            position: absolute;
            border-radius: 50%;
            top: -3px;
            left: 13px
        }

        .news-area svg {
            margin-right: 5px
        }

        .news-area:hover .sub-area {
            opacity: 1;
            visibility: visible;
            top: 100%
        }

        .news-area .hint-area {
            background: #E0F3FE;
            border-radius: 4px;
            padding: 10px 40px 10px 10px;
            position: absolute;
            top: 100%;
            left: -15px;
            color: #076DB6;
            font-size: 14px;
            white-space: nowrap;
            z-index: 1
        }

        .news-area .hint-area:before {
            width: 0;
            height: 0;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-bottom: 8px solid #E0F3FE;
            content: '';
            position: absolute;
            top: -7px;
            left: 16px
        }

        .news-area .hint-area .close-hint {
            color: #076DB6;
            font-size: 25px;
            font-family: -webkit-body;
            cursor: pointer;
            text-align: center;
            width: 30px;
            height: 30px;
            line-height: 30px;
            position: absolute;
            top: 3px;
            right: 3px
        }

        .news-area .hint-area:hover+.sub-area {
            opacity: 0
        }

        .sub-area {
            width: 155px;
            background: #FFFFFF;
            box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.2);
            border-radius: 4px;
            position: absolute;
            left: 0;
            opacity: 0;
            visibility: hidden;
            top: 120%;
            transition-duration: 200ms;
            transition-property: all;
            transition-timing-function: cubic-bezier(0.7, 1, 0.7, 1)
        }

        .sub-area li a {
            display: block;
            padding: 12px 15px;
            color: #4F4F4F;
            font-size: 14px;
            line-height: 140%;
            font-weight: 700
        }

        .sub-area li:hover a {
            color: #B42652
        }

        .sub-area li.disable a {
            color: #9F9F9F
        }

        .weather-page .sub-area,
        .top-header .sub-area {
            width: 360px;
            padding: 20px 15px;
            line-height: 1.2
        }

        .weather-page .sub-area svg,
        .top-header .sub-area svg {
            fill: currentColor
        }

        .weather-page .sub-area .head,
        .top-header .sub-area .head {
            border-bottom: 1px solid #E5E5E5;
            padding: 0 10px 20px 15px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #4F4F4F
        }

        .weather-page .sub-area .head .title,
        .top-header .sub-area .head .title {
            display: flex;
            align-items: center
        }

        .weather-page .sub-area .head .title .ic-weather,
        .top-header .sub-area .head .title .ic-weather {
            width: 24px;
            height: 24px;
            fill: #9F9F9F
        }

        .weather-page .sub-area .head .title .note-location,
        .top-header .sub-area .head .title .note-location {
            color: #9F9F9F;
            font-size: 12px;
            margin-top: 8px
        }

        .weather-page .sub-area .btn-on-off .switch,
        .top-header .sub-area .btn-on-off .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 30px;
            margin-left: 4px
        }

        .weather-page .sub-area .btn-on-off .switch .slider,
        .top-header .sub-area .btn-on-off .switch .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(120, 120, 128, 0.16);
            -webkit-transition: .4s;
            transition: .4s
        }

        .weather-page .sub-area .btn-on-off .switch .slider.round,
        .top-header .sub-area .btn-on-off .switch .slider.round {
            border-radius: 34px
        }

        .weather-page .sub-area .btn-on-off .switch .slider.round::before,
        .top-header .sub-area .btn-on-off .switch .slider.round::before {
            border-radius: 50%
        }

        .weather-page .sub-area .btn-on-off .switch .slider::before,
        .top-header .sub-area .btn-on-off .switch .slider::before {
            position: absolute;
            content: "";
            height: 26px;
            width: 25px;
            left: 2px;
            top: 2px;
            background-color: white;
            box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.2);
            -webkit-transition: .4s;
            transition: .4s
        }

        .weather-page .sub-area .btn-on-off .switch input,
        .top-header .sub-area .btn-on-off .switch input {
            opacity: 0;
            width: 0;
            height: 0
        }

        .weather-page .sub-area .btn-on-off .switch input:checked+.slider,
        .top-header .sub-area .btn-on-off .switch input:checked+.slider {
            background-color: #C92A57
        }

        .weather-page .sub-area .btn-on-off .switch input:checked+.slider::before,
        .top-header .sub-area .btn-on-off .switch input:checked+.slider::before {
            transform: translateX(21px)
        }

        .weather-page .sub-area .search,
        .top-header .sub-area .search {
            position: relative;
            margin-bottom: 10px;
            margin-left: 0;
            padding-left: 0;
            line-height: 1.3
        }

        .weather-page .sub-area .search::before,
        .top-header .sub-area .search::before {
            display: none !important
        }

        .weather-page .sub-area .search button,
        .top-header .sub-area .search button {
            position: absolute;
            width: 35px;
            height: 40px;
            background: none;
            left: 2px;
            top: 0
        }

        .weather-page .sub-area .search button svg,
        .top-header .sub-area .search button svg {
            width: 20px;
            height: 20px;
            fill: #9F9F9F
        }

        .weather-page .sub-area .search input,
        .top-header .sub-area .search input {
            float: none;
            border: 1px solid #BDBDBD;
            border-radius: 8px;
            padding-left: 32px;
            width: 100%;
            height: 40px
        }

        .weather-page .sub-area .scroll-height,
        .top-header .sub-area .scroll-height {
            max-height: 200px;
            overflow-y: auto;
            scrollbar-color: #E5E5E5 #fff;
            scrollbar-width: thin
        }

        .weather-page .sub-area .scroll-height::-webkit-scrollbar,
        .top-header .sub-area .scroll-height::-webkit-scrollbar {
            width: 4px
        }

        .weather-page .sub-area .scroll-height::-webkit-scrollbar-thumb,
        .top-header .sub-area .scroll-height::-webkit-scrollbar-thumb {
            background-color: #E5E5E5;
            width: 4px;
            border-radius: 10px
        }

        .weather-page .sub-area .list-address .adrress,
        .top-header .sub-area .list-address .adrress {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            position: relative;
            border-radius: 8px;
            padding: 6px 16px;
            transition-duration: 300ms;
            transition-property: all;
            transition-timing-function: cubic-bezier(0.7, 1, 0.7, 1)
        }

        .weather-page .sub-area .list-address .adrress .location,
        .top-header .sub-area .list-address .adrress .location {
            font: 400 14px Arial;
            color: #4F4F4F;
            padding: 0;
            margin: 0
        }

        .weather-page .sub-area .list-address .adrress .option,
        .top-header .sub-area .list-address .adrress .option {
            display: flex;
            opacity: 0;
            visibility: hidden;
            transition-duration: 300ms;
            transition-property: all;
            transition-timing-function: cubic-bezier(0.7, 1, 0.7, 1)
        }

        .weather-page .sub-area .list-address .adrress .option a,
        .top-header .sub-area .list-address .adrress .option a {
            background: #FFFFFF;
            border-radius: 8px;
            color: #4F4F4F;
            font-size: 12px;
            font-weight: 400;
            padding: 4px 6px;
            margin-left: 8px;
            display: flex;
            align-items: center
        }

        .weather-page .sub-area .list-address .adrress .option a svg,
        .top-header .sub-area .list-address .adrress .option a svg {
            width: 20px;
            height: 20px;
            margin-right: 4px
        }

        .weather-page .sub-area .list-address .adrress .option a:hover,
        .weather-page .sub-area .list-address .adrress .option a.active,
        .top-header .sub-area .list-address .adrress .option a:hover,
        .top-header .sub-area .list-address .adrress .option a.active {
            background: #757575;
            color: #fff
        }

        .weather-page .sub-area .list-address .adrress .option a span+svg,
        .top-header .sub-area .list-address .adrress .option a span+svg {
            margin-left: 4px;
            margin-right: 0
        }

        .weather-page .sub-area .list-address .adrress .option .default,
        .top-header .sub-area .list-address .adrress .option .default {
            display: none
        }

        .weather-page .sub-area .list-address .adrress.active .option,
        .top-header .sub-area .list-address .adrress.active .option {
            opacity: 1;
            visibility: visible
        }

        .weather-page .sub-area .list-address .adrress.active .option a,
        .top-header .sub-area .list-address .adrress.active .option a {
            display: none
        }

        .weather-page .sub-area .list-address .adrress.active .option .default,
        .top-header .sub-area .list-address .adrress.active .option .default {
            display: flex
        }

        .weather-page .sub-area .list-address .adrress.active:hover a,
        .top-header .sub-area .list-address .adrress.active:hover a {
            display: flex
        }

        .weather-page .sub-area .list-address .adrress.active:hover .default,
        .top-header .sub-area .list-address .adrress.active:hover .default {
            display: none
        }

        .weather-page .sub-area .list-address .adrress.active:hover .default-check,
        .top-header .sub-area .list-address .adrress.active:hover .default-check {
            background: #757575;
            color: #fff
        }

        .weather-page .sub-area .list-address .adrress.active:hover .default-check svg,
        .top-header .sub-area .list-address .adrress.active:hover .default-check svg {
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg width='20' height='20' viewBox='0 0 20 20' fill='none' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M7.03212 13.9072L3.56056 10.0017C3.28538 9.69214 2.81132 9.66425 2.50174 9.93944C2.19215 10.2146 2.16426 10.6887 2.43945 10.9983L6.43945 15.4983C6.72614 15.8208 7.2252 15.8355 7.53034 15.5303L18.0303 5.03033C18.3232 4.73744 18.3232 4.26256 18.0303 3.96967C17.7374 3.67678 17.2626 3.67678 16.9697 3.96967L7.03212 13.9072Z' fill='white'/%3e%3c/svg%3e")
        }

        .weather-page .sub-area .list-address .adrress.active:hover .default-check svg use,
        .top-header .sub-area .list-address .adrress.active:hover .default-check svg use {
            display: none
        }

        .weather-page .sub-area .list-address .adrress:hover,
        .top-header .sub-area .list-address .adrress:hover {
            background: #EFEFEF
        }

        .weather-page .sub-area .list-address .adrress:hover .option,
        .top-header .sub-area .list-address .adrress:hover .option {
            opacity: 1;
            visibility: visible
        }

        .weather-page .news-area,
        .top-header .news-area {
            overflow: hidden
        }

        .weather-page .news-area:hover,
        .top-header .news-area:hover {
            overflow: visible
        }

        .top-header .time-now.weather-day {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center
        }

        .top-header .time-now.weather-day .news-area {
            padding: 0;
            margin-left: 0;
            margin-top: 0
        }

        .top-header .time-now.weather-day .news-area>span {
            position: relative;
            margin-right: 18px
        }

        .top-header .time-now.weather-day .news-area>span::after {
            content: "";
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg width='10' height='6' viewBox='0 0 10 6' fill='none' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M9.85408 0.646008C9.80764 0.599445 9.75246 0.562502 9.69172 0.537296C9.63097 0.512089 9.56585 0.499115 9.50008 0.499115C9.43432 0.499115 9.36919 0.512089 9.30845 0.537296C9.2477 0.562502 9.19253 0.599445 9.14608 0.646008L5.00008 4.79301L0.854083 0.646008C0.760197 0.552121 0.632858 0.499376 0.500083 0.499376C0.367308 0.499376 0.239969 0.552121 0.146083 0.646008C0.0521965 0.739895 -0.000548379 0.867232 -0.000548385 1.00001C-0.00054839 1.13278 0.0521965 1.26012 0.146083 1.35401L4.64608 5.85401C4.69253 5.90057 4.7477 5.93751 4.80845 5.96272C4.86919 5.98793 4.93432 6.0009 5.00008 6.0009C5.06585 6.0009 5.13097 5.98793 5.19172 5.96272C5.25246 5.93751 5.30764 5.90057 5.35408 5.85401L9.85408 1.35401C9.90065 1.30756 9.93759 1.25239 9.9628 1.19164C9.988 1.1309 10.001 1.06578 10.001 1.00001C10.001 0.934241 9.988 0.86912 9.9628 0.808375C9.93759 0.74763 9.90065 0.692454 9.85408 0.646008Z' fill='%23757575'/%3e%3c/svg%3e");
            width: 10px;
            height: 6px;
            position: absolute;
            top: 6px;
            right: -16px
        }

        .top-header .time-now.weather-day .news-area.active>span::after,
        .top-header .time-now.weather-day .news-area:hover>span::after {
            -webkit-transform: rotate(-180deg);
            -ms-transform: rotate(-180deg);
            transform: rotate(-180deg)
        }

        .top-header .time-now.weather-day .weather {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            margin: -1px 0 0 7px
        }

        .top-header .time-now.weather-day .weather svg {
            margin-right: 3px
        }

        .top-header .time-now.weather-day .weather span {
            margin: -4px 0 0 0
        }

        .top-header .search input {
            width: 0;
            padding: 0;
            border: 0
        }

        .top-header .search button {
            position: static;
            left: 22px;
            top: 6px;
            width: 20px;
            height: 20px
        }

        .top-header .search button svg {
            width: 20px;
            height: 20px
        }

        .top-header .search.active input {
            padding: 0 10px 0 30px;
            width: 180px;
            border-radius: 16px;
            border: 1px solid #E5E5E5
        }

        .top-header .search.active button {
            position: absolute
        }

        @media screen and (max-width: 979px) {
            .top-header .news-area {
                display: none
            }
        }

        @media screen and (max-width: 768px) {
            .top-header .time-now.weather-day {
                display: none
            }
            .top-header .news-area,
            .top-header .evne {
                margin-left: 15px
            }
        }

        .box-category {
            width: 100%;
            float: left;
            margin-bottom: 20px
        }

        .box-category.has-border {
            padding-bottom: 20px;
            border-bottom: 1px solid #e5e5e5
        }

        .box-last {
            margin-bottom: 0
        }

        .meta-news {
            color: #757575;
            font-size: 12px;
            line-height: 14px;
            font-weight: 400 !important;
            font-family: Arial
        }

        .meta-news .time-public {
            display: inline-block;
            margin-right: 10px
        }

        .meta-news .cat {
            display: inline-block;
            margin-right: 10px
        }

        .meta-news .cat:hover {
            color: #087cce
        }

        .meta-news .count_cmt,
        .meta-news .icon_commend {
            font-size: 12px;
            color: #076db6;
            display: inline-block;
            text-decoration: none !important
        }

        .meta-news .count_cmt .ic,
        .meta-news .icon_commend .ic {
            fill: #bdbdbd;
            width: 12px;
            height: 12px;
            margin-right: 1px
        }

        .meta-news .count_cmt:hover,
        .meta-news .icon_commend:hover {
            color: #087cce
        }

        .meta-news .count_cmt:hover .ic,
        .meta-news .icon_commend:hover .ic {
            fill: #999
        }

        .meta-news .icon_commend .ic {
            margin-right: 0
        }

        .meta-news .ic-time {
            vertical-align: top;
            width: 14px;
            height: 14px;
            margin-right: 5px;
            fill: #bdbdbd
        }

        .icon_commend {
            font-size: 12px;
            color: #076db6;
            display: inline-block;
            vertical-align: top;
            text-decoration: none
        }

        .icon_commend .ic {
            fill: #bdbdbd;
            width: 12px;
            height: 12px;
            margin-right: 0
        }

        .icon_commend:hover {
            color: #087cce
        }

        .icon_commend:hover .ic {
            fill: #999
        }

        .location-stamp {
            color: #757575 !important;
            font-size: 12px;
            text-transform: uppercase;
            margin-right: 12px;
            letter-spacing: -0.5px;
            position: relative
        }

        .location-stamp:before {
            content: "";
            position: absolute;
            bottom: 5px;
            width: 7px;
            height: 1px;
            background: #757575;
            right: -8px
        }

        .title-news a:hover {
            color: #087cce
        }

        .item-news {
            width: 100%;
            float: left;
            padding-bottom: 15px;
            margin-bottom: 15px;
            border-bottom: 1px solid #E5E5E5
        }

        .item-news .title-news {
            font-family: "Merriweather", serif;
            font-size: 14px;
            line-height: 160%;
            margin-bottom: 4px
        }

        .item-news .title-news .meta-news {
            float: none;
            display: inline-block;
            vertical-align: middle;
            margin-left: 8px;
            font-family: arial
        }

        .item-news .thumb-art {
            width: 260px;
            float: left;
            margin-right: 20px
        }

        .item-news.full-thumb .thumb-art {
            width: 100%;
            margin: 0 0 10px 0
        }

        .item-news.small-thumb .thumb-art {
            width: 110px;
            margin-right: 10px
        }

        .item-news .description {
            line-height: 140%;
            font-size: 14px;
            color: #4f4f4f
        }

        .item-news .description .meta-news {
            float: none;
            display: inline-block;
            vertical-align: middle;
            margin-left: 5px
        }

        .title_news svg,
        .title-news svg {
            margin: -2px 5px 0 0px
        }

        .label_red {
            color: #9f224e
        }

        .section_topstory {
            padding-top: 20px
        }

        .article-topstory {
            width: 550px;
            padding-bottom: 0;
            margin-bottom: 0;
            border: none
        }

        .article-topstory .description {
            clear: both;
            font-size: 14px;
            line-height: 140%
        }

        .article-topstory .location-stamp {
            font-size: 12px
        }

        .article-topstory .icon_thumb_videophoto {
            width: 32px;
            height: 32px;
            line-height: 32px;
            bottom: 10px;
            left: 10px
        }

        .article-topstory .icon_thumb_videophoto .ic {
            width: 18px;
            height: 18px
        }

        .article-topstory .title-news {
            width: 100%;
            float: left;
            font-size: 24px;
            font-weight: 400
        }

        .article-topstory.full-thumb .thumb-art {
            margin: 0 0 15px 0
        }

        .related_news {
            margin-top: 10px;
            font-size: 12px;
            line-height: 140%
        }

        .related_news a {
            color: #757575;
            position: relative;
            font-weight: 700;
            padding-left: 10px
        }

        .related_news a:before {
            width: 5px;
            height: 5px;
            background: #bdbdbd;
            content: "";
            border-radius: 50%;
            position: absolute;
            top: 4px;
            left: 0
        }

        .related_news a:hover {
            color: #087cce
        }

        .sub-news-top {
            width: 230px;
            padding-left: 20px;
            position: relative
        }

        .sub-news-top .inner-sub-news-top {
            position: absolute;
            height: 100%;
            top: 0;
            left: 20px;
            overflow: hidden
        }

        .sub-news-top .scroll-sub-featured {
            max-height: 100%
        }

        .list-sub-feature {
            padding-right: 15px
        }

        .list-sub-feature li {
            width: 100%;
            float: left;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #e5e5e5
        }

        .list-sub-feature li:first-child {
            margin-top: 0;
            padding-top: 0;
            border-top: none
        }

        .list-sub-feature li:last-child {
            margin-bottom: 10px;
            padding-bottom: 25px
        }

        .list-sub-feature li .title_news {
            font-size: 14px;
            line-height: 160%;
            font-family: "Merriweather", serif
        }

        .list-sub-feature li .title_news:hover {
            color: #087cce
        }

        .col-right-top {
            width: 320px;
            padding-left: 20px
        }

        .col-right-top .box-category:last-child {
            margin-bottom: 0
        }

        .col-left-top-home-v2 {
            padding-bottom: 20px;
            border-bottom: 1px solid #e5e5e5
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2.wrapper-topstory-home-v2 .article-topstory {
            background: none;
            padding-right: 0
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2.wrapper-topstory-home-v2 .article-topstory .thumb-art {
            width: 520px
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2.wrapper-topstory-home-v2 .article-topstory .title-news {
            padding-top: 0
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2.wrapper-topstory-home-v2 .extend-lead a:before {
            background: linear-gradient(45deg, rgba(247, 247, 247, 0) 0%, #fff 75.52%);
            background: -webkit-linear-gradient(45deg, rgba(247, 247, 247, 0) 0%, #fff 75.52%)
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2.wrapper-topstory-home-v2 .sub-news-top .list-sub-feature {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-left: 0;
            position: relative;
            padding-right: 240px
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2.wrapper-topstory-home-v2 .sub-news-top .list-sub-feature li {
            display: flex;
            flex-wrap: wrap;
            align-items: end;
            align-content: space-between;
            width: 100%;
            padding: 0;
            margin-right: 20px;
            position: relative
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2.wrapper-topstory-home-v2 .sub-news-top .list-sub-feature li>.thumb-art {
            width: 100%;
            margin: 0 0 0px 0;
            order: 2
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2.wrapper-topstory-home-v2 .sub-news-top .list-sub-feature li .title_news {
            order: 1;
            margin-bottom: 6px;
            min-height: 50px
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2.wrapper-topstory-home-v2 .sub-news-top .list-sub-feature .item-gocnhin {
            width: 240px;
            padding: 0 0 82px 0;
            margin-right: 0;
            display: block;
            position: absolute;
            right: 0;
            height: 100%
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2.wrapper-topstory-home-v2 .sub-news-top .list-sub-feature .item-gocnhin .description {
            position: relative;
            z-index: 1
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2.wrapper-topstory-home-v2 .sub-news-top .list-sub-feature .item-gocnhin .art-top-gn {
            position: initial
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2.wrapper-topstory-home-v2 .sub-news-top .list-sub-feature .item-gocnhin .info-author {
            position: absolute;
            right: 0;
            bottom: 0
        }

        @media screen and (max-width: 1129px) {
            .wrapper-topstory-folder.wrapper-topstory-folder-v2.wrapper-topstory-home-v2 {
                min-height: inherit
            }
            .wrapper-topstory-folder.wrapper-topstory-folder-v2.wrapper-topstory-home-v2 .article-topstory .thumb-art {
                width: 440px
            }
            .wrapper-topstory-folder.wrapper-topstory-folder-v2.wrapper-topstory-home-v2 .sub-news-top .list-sub-feature .item-gocnhin {
                background: #F7F7F7;
                padding: 16px;
                margin-right: 0
            }
            .wrapper-topstory-folder.wrapper-topstory-folder-v2.wrapper-topstory-home-v2 .sub-news-top .list-sub-feature .item-gocnhin .description {
                overflow: hidden;
                text-overflow: ellipsis;
                -webkit-line-clamp: 2;
                display: -webkit-box;
                -webkit-box-orient: vertical;
                min-height: inherit
            }
            .wrapper-topstory-folder.wrapper-topstory-folder-v2.wrapper-topstory-home-v2 .sub-news-top .list-sub-feature .item-gocnhin .info-author {
                position: static
            }
        }

        .build-home-topic {
            border-bottom: 1px solid #E5E5E5;
            background: #FCFAF6;
            padding: 20px 8px 20px 0;
            display: flex
        }

        .build-home-topic::after {
            content: '';
            display: table;
            clear: both
        }

        .build-home-topic__left {
            width: 630px;
            flex-shrink: 0
        }

        .build-home-topic__left .item-news {
            border-bottom: 0;
            padding-bottom: 0;
            margin-bottom: 0
        }

        .build-home-topic__left .item-news .thumb-art {
            width: 400px
        }

        .build-home-topic__left .item-news .title-news {
            font-weight: 700;
            font-size: 18px
        }

        .build-home-topic__right {
            width: 460px;
            position: relative
        }

        .build-home-topic__right .scroll-height {
            float: left;
            width: 100%;
            max-height: 240px;
            overflow-y: scroll;
            padding-right: 8px
        }

        .build-home-topic__right .scroll-height::-webkit-scrollbar {
            width: 4px
        }

        .build-home-topic__right .scroll-height::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.12);
            width: 4px;
            border-radius: 100px
        }

        .build-home-topic__right .item-news {
            margin-bottom: 0;
            padding-bottom: 15px;
            padding-left: 30px;
            border-bottom: 0;
            position: relative
        }

        .build-home-topic__right .item-news .meta-news {
            display: contents
        }

        .build-home-topic__right .item-news::after {
            display: block;
            content: "";
            background: #B42652;
            position: absolute;
            top: 8px;
            left: 13px;
            width: 6px;
            height: 6px;
            border-radius: 50%
        }

        .build-home-topic__right .item-news::before {
            content: "";
            width: 1px;
            background: #e5e5e5;
            position: absolute;
            top: 10px;
            bottom: -10px;
            left: 15px
        }

        .build-home-topic__right .item-news .thumb-art {
            width: 145px;
            margin-right: 10px;
            margin-top: 4px
        }

        .build-home-topic__right .item-news .title-news {
            font-weight: 400;
            font-size: 15px;
            margin-bottom: 0
        }

        .build-home-topic__right .item-news:first-child .title-news {
            font-weight: 700
        }

        .build-home-topic__right .item-news:last-child {
            padding-bottom: 0
        }

        .build-home-topic__right .item-news:last-child::before {
            display: none
        }

        .build-home-topic__right .gradient-layer-top {
            background: linear-gradient(180deg, rgba(252, 250, 246, 0) 0%, #FCFAF6 100%);
            transform: rotate(180deg);
            height: 30px;
            position: absolute;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1;
            display: none
        }

        .build-home-topic__right .gradient-layer-bottom {
            background: linear-gradient(180deg, rgba(252, 250, 246, 0) 0%, #FCFAF6 100%);
            height: 30px;
            position: absolute;
            width: 100%;
            bottom: 0;
            left: 0;
            z-index: 1
        }

        .build-home-topic__right .view-more {
            color: #9F9F9F;
            font-size: 15px;
            text-decoration-line: underline
        }

        .build-home-topic .tag-key {
            color: #C92A57;
            text-transform: uppercase;
            font-size: 12px;
            margin-bottom: 5px;
            display: flex;
            line-height: 18px
        }

        .build-home-topic .tag-key .icon {
            margin-right: 5px;
            height: 16px;
            width: 16px;
            min-width: 16px
        }

        .build-home-topic .tag-key .icon svg,
        .build-home-topic .tag-key .icon img {
            width: 16px
        }

        .build-home-topic.folder {
            padding-top: 10px;
            flex-wrap: wrap
        }

        .build-home-topic.folder .tag-key {
            text-transform: inherit;
            line-height: auto;
            margin-bottom: 10px;
            padding-left: 10px;
            font-size: 14px;
            font-weight: 700;
            color: #B42652;
            width: 100%
        }

        .build-home-topic.folder .build-home-topic__left {
            width: 660px
        }

        .build-home-topic.folder .build-home-topic__right {
            width: 432px;
            width: calc(100% - 660px)
        }

        .build-home-topic.folder .build-home-topic__right .item-news {
            padding-left: 40px
        }

        .build-home-topic.folder .build-home-topic__right .item-news::before {
            left: 21px
        }

        .build-home-topic.folder .build-home-topic__right .item-news::after {
            left: 19px
        }

        @media screen and (max-width: 1129px) {
            .build-home-topic__left {
                width: 60% !important
            }
            .build-home-topic__left .item-news .thumb-art {
                width: 300px
            }
            .build-home-topic__right {
                width: 40% !important
            }
            .build-home-topic__right .scroll-height {
                max-height: 200px
            }
        }

        @media screen and (max-width: 768px) {
            .build-home-topic .tag-key {
                width: 100%
            }
            .build-home-topic__left {
                width: 50% !important;
                padding-left: 8px
            }
            .build-home-topic__left .item-news .thumb-art {
                width: 100%;
                margin: 0 0 10px 0
            }
            .build-home-topic__left .item-news .title-news {
                margin-bottom: 0
            }
            .build-home-topic__left .item-news .description {
                display: none
            }
            .build-home-topic__right {
                width: 50% !important
            }
            .build-home-topic__right .scroll-height {
                max-height: 300px
            }
        }

        .has_border {
            margin-top: 20px;
            padding-top: 20px
        }

        .has_border:before {
            width: calc(100% - 30px);
            background: #e5e5e5;
            height: 1px;
            position: absolute;
            top: 0;
            left: 15px;
            content: ""
        }

        .col-left {
            padding-right: 15px;
            position: relative
        }

        .col-left:after {
            content: "";
            width: 1px;
            height: 100%;
            background: #e5e5e5;
            position: absolute;
            top: 0;
            right: 0
        }

        @media screen and (max-width: 979px) {
            .col-left::after {
                display: none
            }
        }

        .col-right {
            padding-left: 15px
        }

        .col-small {
            width: 420px
        }

        .col-medium {
            width: 680px
        }

        .col-center {
            padding-left: 15px;
            padding-right: 15px;
            position: relative
        }

        .col-center:after {
            content: "";
            width: 1px;
            height: 100%;
            background: #e5e5e5;
            position: absolute;
            top: 0;
            right: 0
        }

        .col-335 {
            width: 365px
        }

        .section_stream_home .col-small {
            width: 400px
        }

        .section_stream_home .col-left {
            padding-right: 20px
        }

        .section_stream_home .col-medium {
            width: 700px
        }

        .section_stream_home .col-right {
            padding-left: 20px
        }

        .item-news-common {
            border-top: 1px solid #e5e5e5;
            margin-top: 15px;
            padding-top: 12px;
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0
        }

        .item-news-common:first-of-type {
            border-top: none;
            margin-top: 0;
            padding-top: 0
        }

        .item-news-common .title-news {
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 4px
        }

        .item-news-common .thumb-art {
            width: 145px;
            margin-right: 10px;
            margin-top: 4px
        }

        .item-news-common .description {
            font-size: 14px;
            line-height: 140%
        }

        .item-news-common p.meta-news {
            margin-top: 10px
        }

        .top-header-folder {
            padding: 0;
            border: none
        }

        .top-header-folder .search {
            width: 300px;
            margin-left: 0;
            padding-left: 0
        }

        .top-header-folder .search:before {
            display: none
        }

        .text-calendar {
            font-size: 14px;
            line-height: 16px;
            color: #757575;
            padding: 3px 0 3px 0;
            cursor: pointer
        }

        .text-calendar .ic {
            fill: #bdbdbd;
            margin-right: 8px;
            margin-top: -3px
        }

        .text-calendar:hover,
        .text-calendar.active {
            color: #087cce
        }

        .text-calendar:hover .ic,
        .text-calendar.active .ic {
            fill: #087cce
        }

        .top-folder {
            align-items: center;
            padding: 20px 0 10px 0
        }

        .filter-date-search {
            margin-left: auto;
            align-items: center
        }

        .top-header-folder .filter-date-search .search input {
            width: 100%
        }

        .title-folder {
            font-family: "Merriweather", serif;
            font-weight: 700;
            color: #4f4f4f !important;
            font-size: 28px;
            line-height: 157%;
            white-space: nowrap;
            margin-right: 20px;
            height: 52px;
            flex-shrink: 0
        }

        .nav-folder {
            padding-top: 20px;
            align-items: flex-start;
            border-bottom: 1px solid #e5e5e5;
            flex-wrap: wrap
        }

        .nav-folder .ul-nav-folder {
            width: 100%;
            float: left;
            max-height: 42px;
            overflow: hidden;
            width: auto;
            flex-grow: 1;
            max-width: calc(100% - 170px)
        }

        .nav-folder .ul-nav-folder li {
            float: left;
            margin-right: 20px
        }

        .nav-folder .ul-nav-folder li a {
            display: block;
            padding: 19px 0 18px 0;
            font-size: 14px;
            line-height: 100%;
            color: #626262;
            font-weight: 700;
            position: relative
        }

        .nav-folder .ul-nav-folder li:hover a {
            color: #B42652
        }

        .nav-folder .ul-nav-folder li.active a {
            color: #9f224e
        }

        .nav-folder .ul-nav-folder li.active a:after {
            background: #9f224e
        }

        .nav-folder .ul-nav-folder li:last-child {
            margin-right: 0
        }

        .nav-folder .ul-nav-folder li.has-submn {
            position: relative
        }

        .nav-folder .ul-nav-folder li.has-submn a {
            position: relative;
            color: #9F9F9F;
            font-weight: 400;
            padding-right: 13px;
            display: inline-block
        }

        .nav-folder .ul-nav-folder li.has-submn a:before {
            border: solid #9F9F9F;
            border-width: 0 1px 1px 0;
            display: inline-block;
            padding: 3px;
            content: '';
            position: absolute;
            top: 21px;
            right: 0;
            transform: rotate(45deg);
            -webkit-transform: rotate(45deg)
        }

        .nav-folder .ul-nav-folder li.has-submn .sub-more {
            background: #FFFFFF;
            box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.2);
            width: 160px;
            position: absolute;
            top: 150%;
            left: 0;
            z-index: 2;
            opacity: 0;
            visibility: hidden;
            transition-duration: 300ms;
            transition-property: all;
            transition-timing-function: cubic-bezier(0.7, 1, 0.7, 1)
        }

        .nav-folder .ul-nav-folder li.has-submn .sub-more li {
            width: 100%;
            float: left
        }

        .nav-folder .ul-nav-folder li.has-submn .sub-more li a {
            display: block;
            padding: 11px 15px;
            font-weight: 700;
            color: #626262;
            line-height: 140%
        }

        .nav-folder .ul-nav-folder li.has-submn .sub-more li a::before {
            display: none
        }

        .nav-folder .ul-nav-folder li.has-submn .sub-more li.active a {
            color: #B42652
        }

        .nav-folder .ul-nav-folder li.has-submn .sub-more li.active a:after {
            display: none
        }

        .nav-folder .ul-nav-folder li.has-submn .sub-more li:hover a {
            color: #B42652
        }

        .nav-folder .ul-nav-folder li.has-submn:hover .sub-more {
            opacity: 1;
            visibility: visible;
            top: 100%
        }

        @media (max-width: 1129px) {
            .nav-folder .ul-nav-folder {
                max-width: calc(100% - 184px)
            }
        }

        .nav-folder .ul-nav-folder.ul-subfolder {
            width: 100%;
            border-top: 1px solid #e5e5e5;
            max-width: 100%;
            overflow: visible
        }

        .nav-folder .ul-nav-folder.ul-subfolder li {
            position: relative
        }

        .nav-folder .ul-nav-folder.ul-subfolder li a {
            font-weight: 400;
            padding: 12px 0
        }

        .nav-folder .ul-nav-folder.ul-subfolder li.active a {
            color: #9f224e
        }

        .nav-folder .ul-nav-folder.ul-subfolder li.active a:after {
            display: none
        }

        .nav-folder .ul-nav-folder.ul-subfolder li>.sub-2 {
            width: 190px;
            background: #fff;
            box-shadow: 0px 1px 4px 0px rgba(0, 0, 0, 0.2);
            position: absolute;
            top: 200%;
            opacity: 0;
            visibility: hidden;
            left: 0;
            transition-duration: 300ms;
            transition-property: all;
            transition-timing-function: cubic-bezier(0.7, 1, 0.7, 1)
        }

        .nav-folder .ul-nav-folder.ul-subfolder li>.sub-2 li {
            margin: 0;
            width: 100%
        }

        .nav-folder .ul-nav-folder.ul-subfolder li>.sub-2 li a {
            display: block;
            padding: 8px 8px 8px 16px;
            font-size: 14px;
            color: #626262
        }

        .nav-folder .ul-nav-folder.ul-subfolder li>.sub-2 li a:hover {
            color: #9f224e
        }

        .nav-folder .ul-nav-folder.ul-subfolder li:hover>.sub-2 {
            opacity: 1;
            visibility: visible;
            top: 102%
        }

        @media (max-width: 1129px) {
            .nav-folder .ul-nav-folder.ul-subfolder {
                max-width: 100%
            }
        }

        .section_topstory_folder {
            padding-top: 15px
        }

        .col-left-top {
            width: 780px
        }

        .wrapper-topstory-folder .article-topstory {
            width: 545px;
            padding-right: 15px
        }

        .wrapper-topstory-folder .article-topstory .description {
            font-size: 14px;
            line-height: 140%
        }

        .wrapper-topstory-folder .article-topstory p:not(.description),
        .wrapper-topstory-folder .article-topstory p:not(.meta-news) {
            margin-top: 10px;
            font-size: 14px;
            line-height: 140%
        }

        .wrapper-topstory-folder .article-topstory .location-stamp {
            font-size: 12px
        }

        .wrapper-topstory-folder .article-topstory .title-news {
            font-size: 20px
        }

        .wrapper-topstory-folder .sub-news-top {
            width: 235px;
            padding-left: 15px;
            height: 530px
        }

        .wrapper-topstory-folder .sub-news-top .inner-sub-news-top {
            left: 15px
        }

        .wrapper-topstory-folder .sub-news-top:before {
            left: 15px
        }

        .wrapper-topstory-folder .sub-news-top:after {
            content: "";
            width: 1px;
            height: 100%;
            background: #e5e5e5;
            position: absolute;
            top: 0;
            left: 0
        }

        .wrapper-topstory-folder .list-sub-feature li .title_news {
            font-size: 16px;
            font-weight: 400;
            font-family: "Merriweather", serif
        }

        .wrapper-topstory-folder .list-sub-feature li .description {
            font-size: 14px;
            line-height: 140%;
            margin-top: 5px;
            color: #4f4f4f
        }

        .wrapper-topstory-folder .list-sub-feature li p.meta-news {
            margin-top: 5px
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2 {
            flex-wrap: wrap;
            flex-direction: column;
            min-height: 530px
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2 .article-topstory {
            width: 100%;
            background: #f7f7f7;
            padding-right: 20px
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2 .article-topstory .thumb-art {
            width: 500px;
            margin: 0 20px 0 0
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2 .article-topstory .title-news {
            width: auto;
            float: none;
            margin-bottom: 10px;
            padding-top: 20px;
            font-weight: 700
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2 .article-topstory .description {
            clear: none
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2 .article-topstory p.meta-news {
            margin-top: 5px
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2 .related_news {
            margin-top: 15px
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2 .sub-news-top {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e5e5e5;
            width: 100%;
            padding-left: 0;
            height: auto
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2 .sub-news-top:after {
            display: none
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2 .sub-news-top .inner-sub-news-top {
            position: static
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2 .sub-news-top:before {
            display: none
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2 .scroll-sub-featured {
            width: 100%;
            float: left
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2 .list-sub-feature {
            width: calc(100% + 20px);
            margin-left: -20px;
            font-size: 0;
            padding-right: 0
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2 .list-sub-feature li {
            width: 33.333333%;
            float: none;
            padding-left: 20px;
            display: inline-block;
            vertical-align: top;
            margin-top: 0;
            padding-top: 0;
            border-top: none
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2 .list-sub-feature li .description {
            margin-top: 10px
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2 .list-sub-feature li .title_news {
            font-size: 15px;
            font-weight: 700
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2 .list-sub-feature li p.meta-news {
            margin-top: 10px
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2 .list-sub-feature li:last-child {
            margin-bottom: 0;
            padding-bottom: 0
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2.wrapper-topstory-home {
            min-height: inherit
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2.wrapper-topstory-home .article-topstory .thumb-art {
            width: 520px
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2.wrapper-topstory-home .article-topstory p.meta-news {
            margin-top: 10px
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2.wrapper-topstory-home .sub-news-top {
            padding-top: 0;
            border-top: none
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2.wrapper-topstory-home .list-sub-feature li {
            width: 32.5%
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2.wrapper-topstory-home .list-sub-feature li.item-gocnhin {
            width: 35%;
            padding-left: 40px;
            position: relative
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2.wrapper-topstory-home .list-sub-feature li.item-gocnhin:before {
            width: 2px;
            height: 100%;
            content: "";
            background: #e5e5e5;
            position: absolute;
            top: 0;
            left: 20px
        }

        .wrapper-topstory-folder.wrapper-topstory-folder-v2.wrapper-topstory-subfolder .article-topstory .thumb-art {
            width: 500px
        }

        .wrapper-topstory-folder .extend-lead a {
            position: relative;
            display: table
        }

        .wrapper-topstory-folder .extend-lead a:before {
            width: 100%;
            height: 20px;
            content: "";
            background: linear-gradient(45deg, rgba(247, 247, 247, 0) 0%, #f7f7f7 75.52%);
            background: -webkit-linear-gradient(45deg, rgba(247, 247, 247, 0) 0%, #f7f7f7 75.52%);
            position: absolute;
            right: 0;
            bottom: 0
        }

        .col-left-subfolder .wrapper-topstory-folder-v2 {
            height: auto;
            min-height: inherit
        }

        .pagination {
            align-items: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e5e5e5
        }

        .pagination .text-calendar {
            margin-right: 0;
            padding-right: 0;
            border-right: none
        }

        .pagination .paging {
            margin-left: auto
        }

        .pagination.pagination-folder {
            padding-right: 430px
        }

        .pagination.pagination-subfolder {
            padding-right: 360px
        }

        .paging {
            align-items: center
        }

        .paging .select-page {
            position: relative
        }

        .paging .select-page .selected-page {
            height: 40px;
            border-radius: 3px;
            line-height: 40px;
            font-size: 15px;
            color: #757575;
            position: relative;
            display: inline-block
        }

        .paging .select-page .box-open-select {
            width: 100%;
            position: absolute;
            bottom: 35px;
            left: 0;
            background: #fff;
            height: 215px;
            overflow: hidden;
            visibility: hidden;
            opacity: 0;
            transition-duration: 200ms;
            transition-property: all;
            transition-timing-function: cubic-bezier(0.7, 1, 0.7, 1);
            border: 1px solid #e5e5e5;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 3px
        }

        .paging .select-page .box-open-select .page-s {
            display: block;
            font-size: 15px;
            padding: 10px 15px
        }

        .paging .select-page .box-open-select .page-s:hover {
            background: #f7f7f7
        }

        .paging .select-page.active .box-open-select {
            bottom: 45px;
            opacity: 1;
            visibility: visible
        }

        .paging .select-page.active .selected-page {
            background: #f7f7f7
        }

        .paging .button-page {
            margin-left: 20px;
            align-items: center
        }

        .paging .button-page .btn-page {
            width: 40px;
            height: 40px;
            text-align: center;
            line-height: 36px;
            border: 1px solid #e5e5e5;
            border-radius: 3px;
            float: left;
            position: relative;
            margin-left: 10px;
            color: #757575
        }

        .paging .button-page .btn-page .ic {
            fill: #4f4f4f;
            width: 10px;
            height: 10px
        }

        .paging .button-page .btn-page:hover {
            background: #f7f7f7
        }

        .paging .button-page .btn-page.active {
            border: 1px solid #9f224e;
            background: #9f224e;
            color: #fff
        }

        .paging .button-page .btn-page.disable {
            background: #f7f7f7;
            border: 1px solid #f7f7f7
        }

        .paging .button-page .btn-page.disable .ic {
            fill: #bdbdbd
        }

        .paging .button-page .btn-page.type_page {
            -moz-appearance: none;
            -webkit-appearance: none;
            padding: 0;
            margin: 0 5px;
            text-align: center;
            font-size: 15px;
            font-weight: 700;
            color: #222;
            min-width: 40px !important;
            max-width: 99.99% !important;
            transition: width 0.25s
        }

        .paging .button-page .btn-page.type_page:focus {
            border: 1px solid #757575
        }

        .filter-date-search .pagination {
            margin-top: 0;
            padding-top: 0;
            border-top: none;
            position: relative;
            margin-right: 15px;
            padding-right: 15px
        }

        .filter-date-search .pagination:after {
            content: "";
            width: 1px;
            height: 22px;
            background: #e5e5e5;
            position: absolute;
            top: 9px;
            right: 0
        }

        .col-left-subfolder {
            width: 780px;
            padding-right: 20px;
            border-right: none
        }

        .col-left-subfolder .wrapper-topstory-folder {
            padding-bottom: 20px;
            margin-bottom: 20px;
            border-bottom: 1px solid #e5e5e5
        }

        .col-left-subfolder .wrapper-topstory-folder.no-border {
            padding-bottom: 0;
            border-bottom: 0
        }

        .col-right-subfolder {
            width: 320px;
            padding-left: 20px
        }

        .list-news-subfolder .item-news-common {
            padding-top: 20px;
            margin-top: 20px
        }

        .list-news-subfolder .item-news-common .title-news {
            margin-bottom: 5px;
            font-size: 18px;
            font-weight: bold
        }

        .list-news-subfolder .item-news-common .thumb-art {
            width: 220px;
            margin-right: 0;
            float: right;
            margin-left: 40px
        }

        .list-news-subfolder .item-news-common .description {
            font-size: 14px;
            line-height: 140%;
            color: #4f4f4f !important
        }

        .list-news-subfolder .item-news-common.off-thumb .title-news,
        .list-news-subfolder .item-news-common.off-thumb .description {
            max-width: 600px
        }

        .list-news-subfolder .item-news-common:first-of-type {
            margin-top: 0;
            padding-top: 0
        }

        .list-news-subfolder .item-news-common.thumb-left {
            padding-right: 20px
        }

        .list-news-subfolder .item-news-common.thumb-left .thumb-art {
            float: left;
            width: 240px;
            margin: 0 20px 0 0
        }

        .col-left-new {
            width: 780px;
            padding-right: 20px
        }

        @media screen and (max-width: 979px) {
            .col-left-new {
                width: 100%;
                padding-right: 0
            }
        }

        .col-right-new {
            padding-left: 20px;
            width: 320px
        }

        @media screen and (max-width: 979px) {
            .col-right-new {
                display: none;
                width: 100%;
                padding-left: 0
            }
        }

        .block-grid-news {
            display: -ms-grid;
            display: grid;
            column-gap: 20px;
            row-gap: 20px;
            width: 100%
        }

        .block-grid-news.grid__3 {
            grid-template-columns: repeat(3, 1fr)
        }

        .block-grid-news .article-item .thumb-art {
            width: 100%
        }

        .block-grid-news .article-item .thumb {
            margin-bottom: 8px
        }

        .block-grid-news .article-item .title-news {
            font: bold 15px/1.6 "Merriweather", serif
        }

        .col-left-border {
            padding-right: 20px;
            position: relative
        }

        .col-left-border:after {
            content: "";
            width: 1px;
            height: 100%;
            background: #e5e5e5;
            position: absolute;
            top: 0;
            right: 0
        }

        .wrapper-topstory-folder .sub-news-top-photo {
            height: auto
        }

        .wrapper-topstory-folder .sub-news-top-photo:before {
            display: none
        }

        .sub-news-top-photo .item-news:last-of-type {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none
        }

        .list-news-folder-photo {
            font-size: 0
        }

        .list-news-folder-photo .item-news {
            display: inline-block;
            vertical-align: top;
            border-bottom: none;
            padding-bottom: 0;
            width: 50%;
            float: none;
            margin-bottom: 20px
        }

        .list-news-folder-photo .item-news:nth-child(even) {
            padding-left: 10px
        }

        .list-news-folder-photo .item-news:nth-child(odd) {
            padding-right: 10px
        }

        .list-news-folder-photo .item-news:nth-last-of-type(-n+2) {
            margin-bottom: 0
        }

        .list-news-folder-photo .item-news .title-news {
            font-size: 15px;
            font-weight: 700;
            line-height: 160%
        }

        .list-news-folder-photo .item-news .icon_thumb_videophoto {
            width: 28px;
            height: 28px;
            line-height: 28px
        }

        .top-header-folder-dateview .top-folder {
            padding-bottom: 15px;
            border-bottom: 1px solid #e5e5e5
        }

        .select-cate-date .text-calendar {
            margin-right: 0;
            padding-right: 0;
            border-right: none
        }

        .select-cate-date .cate-select {
            align-items: center;
            color: #4f4f4f;
            font-size: 14px;
            margin-right: 20px
        }

        .select-cate-date .cate-select span {
            padding-right: 10px
        }

        .select-cate-date .option-cate {
            width: 190px;
            font-size: 14px;
            color: #4f4f4f;
            cursor: pointer
        }

        .select-cate-date .filter-date-search {
            margin-left: inherit
        }

        img:not([src]):not([srcset]) {
            visibility: hidden
        }

        .tip {
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            height: 24px;
            line-height: 24px;
            background: #17191a;
            color: #fff !important;
            font-size: 12px !important;
            text-decoration: none !important;
            white-space: nowrap;
            padding: 0 10px;
            border-radius: 3px
        }

        .social_pin {
            width: 65px;
            padding-top: 150px;
            position: sticky;
            position: -webkit-sticky;
            top: 0;
            left: 0;
            height: 100%;
            padding-bottom: 20px;
            opacity: 1;
            visibility: visible;
            z-index: 1;
            transition-duration: 250ms;
            transition-property: all;
            transition-timing-function: cubic-bezier(0.7, 1, 0.7, 1)
        }

        .social_pin.social_pin_folder {
            padding-top: 0;
            width: 70px;
            padding-left: 38px;
            top: 70px
        }

        .social_pin .social_left li {
            margin-top: 10px;
            width: 32px
        }

        .social_pin .social_left li a {
            width: 32px;
            height: 32px;
            align-items: center;
            border-radius: 50%;
            background: #fff;
            justify-content: center;
            position: relative;
            border: 1px solid #e5e5e5
        }

        .social_pin .social_left li a .ic {
            fill: #93908a;
            align-self: center
        }

        .social_pin .social_left li a:hover .ic {
            fill: #fff
        }

        .social_pin .social_left li a.social_fb:hover {
            background: #3b5999;
            border: 1px solid #3b5999
        }

        .social_pin .social_left li a.social_zalo:hover {
            background: #02A8FE;
            border: 1px solid #02A8FE
        }

        .social_pin .social_left li a.social_zalo:hover svg {
            fill: #fff
        }

        .social_pin .social_left li a.social_twit:hover {
            background: #55acee;
            border: 1px solid #55acee
        }

        .social_pin .social_left li a.social_in:hover {
            background: #0A66C2;
            border: 1px solid #0A66C2
        }

        .social_pin .social_left li a.social_save:hover {
            background: #087cce;
            border: 1px solid #087cce
        }

        .social_pin .social_left li a.social_save.active {
            background: #076db6;
            border: 1px solid #076db6
        }

        .social_pin .social_left li a.social_save.active .ic {
            fill: #fff
        }

        .social_pin .social_left li a.social_comment:hover {
            background: #b52759;
            border: 1px solid #b52759
        }

        .social_pin .social_left li a .number_cmt {
            font-size: 12px;
            color: #757575;
            position: absolute;
            bottom: -20px;
            left: 50%;
            transform: translateX(-50%)
        }

        .social_pin .social_left li a.social_back {
            overflow: hidden
        }

        .social_pin .social_left li a.social_back .ic {
            transform: rotate(180deg)
        }

        .social_pin .social_left li a.social_back .tip {
            left: 20px;
            transform: none;
            top: 0;
            opacity: 0;
            transition-duration: 200ms;
            transition-property: all;
            transition-timing-function: cubic-bezier(0.7, 1, 0.7, 1);
            visibility: hidden
        }

        .social_pin .social_left li a.social_back:hover {
            background: #087cce;
            border: 1px solid #087cce;
            overflow: visible
        }

        .social_pin .social_left li a.social_back:hover .tip {
            opacity: 1;
            top: -15px;
            visibility: visible
        }

        .social_pin .social_left li.border {
            padding-top: 10px;
            position: relative
        }

        .social_pin .social_left li.border:before {
            content: "";
            width: 23px;
            height: 1px;
            background: #e0e0e0;
            position: absolute;
            top: 0;
            left: 5px
        }

        .social_pin .social_left li.li_comment {
            padding-bottom: 20px
        }

        .social_pin .social_left li:first-child {
            margin-top: 0
        }

        .social_pin.hide_pin {
            opacity: 0;
            visibility: hidden
        }

        .breadcrumb {
            float: left
        }

        .breadcrumb li {
            position: relative;
            display: inline-block;
            line-height: 16px;
            font-size: 14px;
            color: #757575;
            margin-right: 25px
        }

        .breadcrumb li a {
            display: inline-block
        }

        .breadcrumb li:after {
            content: "";
            width: 7px;
            height: 7px;
            border-top: 1px solid #bdbdbd;
            border-right: 1px solid #bdbdbd;
            transform: rotate(45deg);
            position: absolute;
            left: -19px;
            top: 5px
        }

        .breadcrumb li:first-child {
            color: #076db6
        }

        .breadcrumb li:first-child:after {
            content: none
        }

        .box-gocnhin {
            padding-bottom: 15px !important;
            margin-bottom: 15px
        }

        .box-gocnhin .item-news .description {
            font-size: 14px;
            line-height: 140%
        }

        .box-gocnhin .title-news {
            font-size: 15px;
            font-weight: 700
        }

        .box-gocnhin .meta-news {
            font-size: 14px;
            line-height: 16px;
            color: #4f4f4f
        }

        .art-top-gn {
            width: 400px;
            padding-bottom: 0;
            margin-bottom: 0;
            border-bottom: none;
            padding-right: 20px
        }

        .info-author {
            align-items: flex-end;
            margin-top: 5px
        }

        .info-author .meta-news .cat {
            font-family: "Merriweather", serif;
            font-size: 14px;
            color: #757575;
            font-style: italic;
            line-height: 140%;
            margin-right: 0
        }

        .info-author .meta-news .cat:hover {
            color: #087cce
        }

        .sub-art-gn {
            width: 265px;
            padding-left: 20px;
            border-left: 1px solid #e5e5e5
        }

        .sub-art-gn .info-author {
            margin-top: 0
        }

        .sub-art-gn .item-news {
            padding-bottom: 10px;
            margin-bottom: 10px;
            border-bottom: 1px solid #e5e5e5
        }

        .sub-art-gn .item-news:last-of-type {
            padding-bottom: 0;
            margin-bottom: 0;
            border-bottom: none
        }

        .sub-art-gn .title-news {
            margin-bottom: 0
        }

        .thumb-author-gn.thumb-art {
            width: 90px;
            margin-left: 15px;
            margin-right: 0;
            margin-bottom: 0;
            float: right
        }

        .thumb-author-gn.thumb-art .thumb {
            border-radius: 50%
        }

        .item-gocnhin .title-link-gn {
            font-size: 14px;
            line-height: 16px;
            color: #9f224e;
            font-weight: bold;
            margin-bottom: 5px;
            width: 100%;
            float: left;
            margin-top: 4px
        }

        .item-gocnhin .art-top-gn {
            width: 100%;
            padding-right: 0;
            position: relative
        }

        .item-gocnhin .art-top-gn .title-news {
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 0
        }

        .item-gocnhin .art-top-gn .description {
            min-height: 57px;
            margin-top: 5px !important
        }

        .item-gocnhin .info-author {
            margin-top: 3px;
            display: flex;
            justify-content: space-between;
            align-items: center
        }

        .item-gocnhin .thumb-author-gn.thumb-art {
            width: 72px;
            margin-left: 0
        }

        .item-gocnhin p.meta-news {
            width: calc(100% - 72px);
            padding-right: 15px;
            margin-top: 0 !important
        }

        .item-gocnhin p.meta-news .count_cmt {
            margin-top: 8px
        }

        .box-list-live {
            width: 425px;
            background: #ffffff;
            border: 1px solid #efefef;
            box-sizing: border-box;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            position: absolute;
            top: 65px;
            left: -60px;
            z-index: 1000;
            padding: 20px;
            opacity: 0;
            visibility: hidden;
            transition-duration: 200ms;
            transition-property: all;
            transition-timing-function: cubic-bezier(0.7, 1, 0.7, 1)
        }

        .box-list-live:before {
            border: solid #efefef;
            border-width: 0 1px 1px 0;
            display: inline-block;
            padding: 7px;
            transform: rotate(-135deg);
            -webkit-transform: rotate(-135deg);
            background: #fff;
            content: "";
            position: absolute;
            top: -9px;
            left: 85px
        }

        .box-list-live .item-news .thumb-art {
            float: right;
            margin: 0 0 0 10px;
            width: 140px
        }

        .box-list-live .item-news .title-news {
            color: #222;
            font-size: 15px;
            font-weight: bold
        }

        .box-list-live .item-news .ic-live:before {
            top: 5px
        }

        .box-list-live .item-news .ic-live.ic-live-title {
            font-size: 12px;
            font-family: arial;
            text-transform: uppercase;
            color: #ed1b24 !important;
            font-weight: 400;
            margin-top: 1px
        }

        .box-list-live .more-live {
            font-size: 16px;
            color: #222;
            height: 40px;
            line-height: 40px;
            text-align: center;
            width: 100%;
            display: block;
            background: #f7f7f7;
            border-radius: 3px;
            float: left
        }

        .open-live .box-list-live {
            opacity: 1;
            top: 45px;
            visibility: visible
        }

        .meta-live {
            margin-bottom: 5px
        }

        .meta-live .label-time-live {
            font-size: 12px;
            line-height: 100%;
            background: rgba(91, 192, 222, 0.3);
            border-radius: 3px;
            display: inline-block;
            padding: 5px
        }

        .meta-live .label-time-live.no-bg {
            font-size: 14px;
            color: #757575;
            padding-left: 0;
            padding-right: 0;
            background: none
        }

        .top-folder-live {
            border-bottom: 1px solid #e5e5e5
        }

        .top-folder-live .title-folder {
            font-size: 24px;
            color: #222
        }

        .list-news-subfolder-live {
            padding-left: 26px;
            position: relative
        }

        .list-news-subfolder-live:before {
            width: 1px;
            height: 100%;
            background: #e5e5e5;
            content: "";
            position: absolute;
            top: 0;
            left: 0
        }

        .list-news-subfolder-live .item-news {
            padding-top: 0;
            margin-top: 35px;
            border-top: none;
            position: relative
        }

        .list-news-subfolder-live .item-news .meta-live {
            margin-bottom: 10px
        }

        .list-news-subfolder-live .item-news .title-news {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 10px
        }

        .list-news-subfolder-live .item-news .description {
            font-size: 16px;
            line-height: 150%
        }

        .list-news-subfolder-live .item-news:before {
            content: "";
            width: 9px;
            height: 9px;
            background: #9f224e;
            border-radius: 50%;
            position: absolute;
            top: 6px;
            left: -30px;
            z-index: 1
        }

        .list-news-subfolder-live .item-news:after {
            content: "";
            width: 1px;
            height: 26px;
            background: #fff;
            position: absolute;
            top: -3px;
            left: -26px;
            z-index: 0
        }

        .list-news-subfolder-live .ic-live {
            font-size: 14px;
            font-family: arial;
            text-transform: uppercase;
            color: #ed1b24 !important;
            font-weight: 400;
            font-style: normal
        }

        .list-news-subfolder-live .ic-live:before {
            background: #ed1b24;
            top: 4px
        }

        .list-news-subfolder-live .ic-live:after {
            display: none
        }

        .box-placeholder {
            font-size: 0;
            line-height: 0
        }

        .box-placeholder .text {
            display: inline-block;
            background-color: #444;
            height: 12px;
            border-radius: 100px;
            margin: 5px 0;
            min-width: 100px;
            opacity: .1;
            animation: fading 1.5s infinite
        }

        .box-placeholder .text:first-child {
            margin-top: 0
        }

        .box-placeholder .text:last-child {
            margin-bottom: 0
        }

        .box-placeholder .text.link {
            background-color: var(--blue);
            opacity: .4
        }

        .box-placeholder .text.line {
            width: 100%
        }

        .box-placeholder .text.category {
            width: 100px;
            margin-bottom: 10px
        }

        .box-placeholder h4.text {
            height: 20px;
            margin: 3px 0;
            opacity: .2
        }

        .box-placeholder .title-news .text {
            margin: 0
        }

        .box-placeholder.item-news-common .title-news+.thumb-art+.text {
            width: calc(100% - 100px)
        }

        .box-placeholder.item-news-common .title-news+.thumb-art+.text+.text {
            width: calc(100% - 130px);
            clear: both
        }

        .box-placeholder.item-news-common .title-news+.text {
            width: 100%
        }

        .box-placeholder.item-news-common .title-news+.text+.text {
            width: calc(100% - 30px);
            clear: both
        }

        .box-placeholder .title-box-category .text {
            height: 20px
        }

        .box-placeholder.box-gocnhin .title-news .text {
            height: 17px;
            width: calc(100% - 105px)
        }

        .box-placeholder.box-gocnhin .title-news+.text {
            width: calc(100% - 140px)
        }

        .box-placeholder.box-slide-topic {
            padding: 0
        }

        .box-placeholder.box-slide-topic .text {
            height: 25px;
            border-radius: 100px;
            margin-top: 11px
        }

        .section_video .box-placeholder .text.thumb-video {
            border-radius: 0;
            margin-bottom: 0
        }

        .section_video .box-placeholder .title-news {
            line-height: 100%
        }

        .section_video .box-placeholder .title-news .text {
            height: 17px
        }

        .section_video .box-placeholder .box-scroll-video .thumb-art+.text {
            width: calc(100% - 130px)
        }

        .section_video .box-placeholder .box-scroll-video .thumb-art+.text+.text {
            width: calc(100% - 160px);
            clear: both
        }

        .box-cate-featured-vertical.box-placeholder .sub-news-cate .thumb-art+.text {
            width: calc(100% - 86px)
        }

        .box-cate-featured-vertical.box-placeholder .sub-news-cate .thumb-art+.text+.text {
            width: calc(100% - 116px);
            clear: both
        }

        .box-placeholder .wrap-slide-photo .text {
            height: 503px;
            border-radius: 0;
            background-color: #aaa
        }

        .box-ebank-qt .box-placeholder .wrap-slide-bank-qt .text {
            height: 140px;
            border-radius: 0;
            background-color: #aaa
        }

        .box-news-other-site .box-placeholder .title-news {
            line-height: 120%
        }

        .box-news-other-site .box-placeholder .title-news .text {
            width: calc(100% - 280px);
            height: 17px
        }

        .box-news-other-site .box-placeholder .title-news .text+.text {
            width: 20%;
            height: 17px
        }

        .box-news-other-site .box-placeholder .title-news+.text {
            width: calc(100% - 280px);
            clear: both;
            margin-top: 10px
        }

        .box-placeholder.box-info-company .wrap-slide-business .text {
            height: 210px;
            border-radius: 0;
            background-color: #aaa
        }

        .box-placeholder.box-shop-sell .wrap-slide-business .text {
            height: 100px;
            border-radius: 0;
            background-color: #aaa
        }

        .box-placeholder.box-shop-sell-vertical .wrap-slide-business .text {
            height: 445px;
            border-radius: 0;
            background-color: #aaa
        }

        .box-placeholder.box-wiki-kidlab .wrap-slide-business .text {
            height: 212px
        }

        .list-news-subfolder .box-placeholder .title-news {
            line-height: 130%
        }

        .list-news-subfolder .box-placeholder .title-news .text {
            width: calc(100% - 260px);
            height: 15px
        }

        .list-news-subfolder .box-placeholder .title-news .text+.text {
            width: 100px;
            height: 15px
        }

        .list-news-subfolder .box-placeholder .title-news+.text {
            width: calc(100% - 260px)
        }

        .list-news-subfolder .box-placeholder .title-news+.text+.text {
            width: calc(100% - 260px);
            clear: both
        }

        .list-news-subfolder .box-placeholder .title-news+.text+.text+.text {
            width: 100px
        }

        .box-news-banner.box-placeholder .content-box-category .text.line {
            height: 56px;
            border-radius: 0
        }

        .block-item.box-placeholder .title-block-live {
            margin-top: 20px
        }

        .block-item.box-placeholder .title-block-live .text {
            height: 20px
        }

        .block-item.box-placeholder .title-block-live .text+.text {
            width: 80%
        }

        .block-item.box-placeholder .header-block+.text+.text {
            width: 80%;
            clear: both
        }

        .block-item.box-placeholder .header-block+.text+.text+.text {
            width: 60%;
            clear: both
        }

        .block-item.box-placeholder .header-block+.text+.text+.text+.text {
            width: 40%;
            clear: both;
            margin-right: 60%
        }

        .block-item.box-placeholder .header-block+.text+.text+.text+.text+.text {
            width: 10%;
            clear: both
        }

        .block-item.box-placeholder .social-block {
            margin-top: 25px
        }

        .block-item.box-placeholder .social-block .text {
            height: 20px
        }

        .ds-dienbien .box-placeholder .text {
            height: 17px
        }

        .ds-dienbien .box-placeholder .text+.text {
            height: 12px
        }

        .banner-ads.box-placeholder .text {
            border-radius: 10px;
            margin: 0
        }

        .banner-ads.box-placeholder.banner-height-250 .text {
            height: 250px
        }

        .banner-ads.box-placeholder.banner-height-500 .text {
            height: 500px
        }

        .banner-ads.box-placeholder.banner-height-600 .text {
            height: 600px
        }

        .banner-ads.box-placeholder.banner-height-90 .text {
            height: 90px
        }

        .slide-table-tt.box-placeholder .text {
            height: 134px;
            border-radius: 0
        }

        .box-placeholder .colbox-left .title-news {
            line-height: 29px;
            margin-bottom: 10px
        }

        .box-placeholder .colbox-left .title-news .text {
            height: 20px
        }

        .box-placeholder .colbox-right .title-news .text.line {
            width: calc(100% - 115px)
        }

        .box-placeholder.box-cate-featured-v2 .sub-news-cate .item-news:before {
            display: none
        }

        @keyframes fading {
            0% {
                opacity: .1
            }
            50% {
                opacity: .2
            }
            100% {
                opacity: .1
            }
        }
    </style>
    <link rel="preload" href="https://s1.vnecdn.net/vnexpress/restruct/c/v2847/v2_2019/pc/general-file.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://s1.vnecdn.net/vnexpress/restruct/c/v2847/v2_2019/pc/general-file.css" crossorigin="anonymous"></noscript>
    <style type="text/css">
        .wrap_pic,
        .wrap_pic .block_thumb_wrap,
        .social-com,
        .detail-live .fck_detail .wrap-img-content,
        .detail-live .header-live .social,
        .detail-live .wrap-notifile,
        .tab-comment .header-tab,
        .page-detail .container,
        .header-social .social,
        .score-table,
        .score-table .group {
            display: -moz-flex;
            display: -ms-flex;
            display: -o-flex;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex
        }

        .flexbox {
            display: -moz-flex;
            display: -ms-flex;
            display: -o-flex;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex
        }

        .no-flexbox {
            display: inherit
        }

        .wrap_pic .block_thumb_wrap:after,
        .page-detail.detail-photo .header-content:after,
        .page-detail.detail-photo .width-detail-photo:after,
        .page-detail.detail-photo .item_slide_show .block_thumb_slide_show:after,
        .detail-live .list-news:after {
            content: '';
            display: table;
            clear: both
        }

        .detail-live .tab-live,
        .detail-live .title-block-live,
        .tab-comment .header-tab,
        .box_note_join .tit_note,
        .box_about_author .name_au,
        .block-khachmoi .txt-km,
        .page-detail .related-list li,
        .page-detail .title-detail,
        .score-table,
        .block_reply_tv .tit_reply,
        .item_quiz .tittle_quiz {
            font-feature-settings: 'pnum' on, 'lnum' on;
            -webkit-font-feature-settings: 'pnum' on, 'lnum' on;
            -moz-font-feature-settings: 'pnum' on, 'lnum' on;
            -ms-font-feature-settings: 'pnum' on, 'lnum' on
        }

        .embed_video_new {
            position: relative
        }

        .embed_video_new .box_img_video {
            cursor: pointer
        }

        .embed_video_new .icon_blockvideo {
            bottom: 0;
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
            text-align: left
        }

        .embed_video_new .box_img_video img {
            width: 100% !important
        }

        .embed_video_new .img_icon {
            display: inline-block;
            vertical-align: middle;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-top: 22px solid rgba(255, 255, 255, 0);
            border-left: 35px solid #fff;
            border-bottom: 22px solid rgba(255, 255, 255, 0);
            border-radius: 5px 0 0 5px;
            -webkit-transition-duration: 250ms;
            transition-duration: 250ms;
            -webkit-transition-property: all;
            transition-property: all;
            -webkit-transition-timing-function: cubic-bezier(.7, 1, .7, 1);
            transition-timing-function: cubic-bezier(.7, 1, .7, 1)
        }

        .embed_video_new .image_icon_center {
            display: inline-block;
            height: 100%;
            vertical-align: middle
        }

        .embed_video_new .media_content,
        .embed_video_new .flash_content {
            width: 100%;
            height: 282px;
            position: relative;
            background: #000
        }

        .embed_video_new .media_content .video_container {
            height: 100%;
            width: 100%;
            position: relative
        }

        .fp-reload {
            font-family: "Arial", sans-serif;
            color: #ccc;
            font-size: 14px;
            float: left;
            position: absolute
        }

        .fp-reload-button {
            display: inline-block;
            padding: 5px 10px;
            border: 1px solid #333;
            cursor: pointer;
            background: #000
        }

        .fp-reload-button:hover {
            background: #9f224e
        }

        .clear {
            clear: both;
            line-height: 0
        }

        #breackcumb_portal {
            padding-bottom: 5px;
            padding-top: 10px
        }

        .block_timer {
            font: 400 11px arial;
            padding: 5px 0 0;
            white-space: nowrap
        }

        .content_news {
            padding: 0 0 10px;
            overflow: hidden
        }

        title-news {
            margin-top: 10px;
            color: #333
        }

        title-news a.title_topic {
            color: #333
        }

        .short_intro,
        .relative_news {
            font-weight: 700
        }

        .short_intro {
            font: 700 14px/18px arial;
            width: 100%;
            float: left;
            padding-bottom: 10px;
            color: #444;
            text-rendering: geometricPrecision
        }

        .short_intro h3 {
            font: 700 14px/18px arial
        }

        .gocnhin .short_intro {
            color: #333;
            font: 400 14px/18px arial
        }

        .short_intro a,
        .fck_detail p.Normal a,
        .fck_detail p.Image a,
        .fck_detail table a,
        .fck_detail .box_brief_info p a,
        .box_quangcao .block_image_news a {
            color: #076db6;
            position: relative;
            text-decoration: underline;
            text-underline-position: under
        }

        .short_intro a:hover,
        .fck_detail p.Normal a:hover,
        .fck_detail p.Image a:hover,
        .fck_detail table a:hover,
        .fck_detail .box_brief_info p a:hover,
        .box_quangcao .block_image_news a:hover {
            color: #087cce
        }

        .fck_detail p.Normal a {
            text-decoration: none;
            border-bottom-width: 1px;
            border-bottom-style: solid;
            padding-bottom: 1px
        }

        .fck_detail {
            width: 100%;
            float: left;
            position: relative;
            font: 400 18px arial;
            line-height: 160%;
            padding: 0;
            color: #222
        }

        .fck_detail table caption {
            caption-side: bottom;
            font: 400 14px arial;
            color: #333;
            background: #f5f5f5;
            padding: 10px;
            text-align: left
        }

        .fck_detail table.tplCaption td {
            line-height: 0;
            padding: 0
        }

        .fck_detail table.tplCaption {
            min-width: 100%
        }

        .fck_detail table.tplCaption tr {
            background: #f0eeea
        }

        .fck_detail table.tplCaption tr+tr {
            background: none
        }

        .fck_detail table.tplCaption td td {
            line-height: auto
        }

        .fck_detail table {
            max-width: 100%;
            margin: 0 auto 15px;
            position: relative
        }

        .fck_detail .tplCaption {
            text-align: center
        }

        .fck_detail .tplCaption .Image {
            text-align: left
        }

        .fck_detail .tplCaption img {
            max-height: 700px
        }

        figure {
            position: relative
        }

        figure:before {
            -webkit-transition-duration: 250ms;
            transition-duration: 250ms;
            -webkit-transition-property: all;
            transition-property: all;
            -webkit-transition-timing-function: cubic-bezier(.7, 1, .7, 1);
            transition-timing-function: cubic-bezier(.7, 1, .7, 1);
            opacity: 0;
            visibility: hidden;
            top: 10px;
            left: 10px;
            content: 'Bấm để xem chi tiết';
            color: #fff;
            font-size: 14px;
            line-height: 16px;
            background: rgba(34, 34, 34, .8);
            padding: 8px 9px;
            border-radius: 3px;
            position: absolute
        }

        figure.has-link {
            cursor: pointer
        }

        figure.has-link:before {
            opacity: 1;
            visibility: visible;
            z-index: 2
        }

        .fck_detail figure.tplCaption {
            width: 100%;
            float: left;
            position: relative;
            margin-bottom: 15px
        }

        .fck_detail figure.tplCaption .fig-picture {
            width: 100%;
            float: left;
            display: table;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            background: #f0eeea;
            text-align: center
        }

        .fck_detail figure.tplCaption figcaption {
            width: 100%;
            float: left;
            text-align: left
        }

        .fck_detail figure.tplCaption figcaption p {
            font: 400 14px/160% arial;
            padding-top: 10px;
            margin-bottom: 0
        }

        .fck_detail figure.tplCaption img {
            max-height: 700px
        }

        .fck_detail ol {
            list-style: decimal;
            padding: 0 0 0 30px;
            margin: 0
        }

        .fck_detail ol li {
            list-style-type: decimal;
            margin-left: 7px
        }

        .fck_detail td {
            padding: 5px
        }

        .fck_detail table.tplCaption td.caption,
        .fck_detail table.tplCaption td.Image,
        .fck_detail table.tplCaption td p.Normal,
        .fck_detail table.tplCaption td .Image,
        .fck_detail .tplCaption .Image {
            font: 400 14px arial;
            line-height: 160%;
            color: #222;
            padding: 10px 0 0 0;
            margin: 0;
            text-align: left
        }

        .fck_detail table.tbl_insert .Normal {
            padding: 0;
            background: none;
            color: #333
        }

        .fck_detail table.tbl_insert td {
            border: 1px solid #e5e5e5
        }

        .fck_detail p.Image {
            margin: 0;
            padding: 5px
        }

        .fck_detail .Normal,
        .fck_detail p {
            margin: 0 0 1em;
            line-height: 160%;
            text-rendering: optimizeSpeed
        }

        .fck_detail p.subtitle {
            font-weight: 700
        }

        .fck_detail table td.Image p {
            margin: 0 0 1em
        }

        .fck_detail .ContractNo {
            display: none
        }

        .fck_detail table td.PnDTitle {
            color: #fff;
            font-family: 'Verdana';
            font-size: 8pt;
            font-weight: 700;
            text-decoration: none
        }

        .embed-container {
            position: relative;
            height: 0;
            overflow: hidden;
            padding-bottom: 56.25%;
            margin-bottom: 15px;
            clear: both
        }

        .embed-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none
        }

        .embed-container.audio {
            padding-bottom: 8.15%
        }

        .audio-wrapper {
            padding-bottom: 11%
        }

        .box_embed_video_parent {
            overflow: hidden;
            clear: both
        }

        .box_embed_video {
            margin-bottom: 15px;
            height: 0;
            width: 100%;
            padding-bottom: 56.25%;
            position: relative;
            background: #f5f5f5
        }

        .item_slide_show .box_embed_video {
            margin-bottom: 0
        }

        .item_slide_show .embed-container {
            margin-bottom: 0
        }

        .desc_cation p,
        .desc_cation p.Image {
            font: 400 14px/160% arial;
            padding: 10px 0 0 0;
            margin-bottom: 0;
            text-align: left
        }

        .fck_detail .vote_rating_box {
            border: 1px solid #e5e5e5;
            padding: 20px
        }

        .fck_detail .vote_rating_box .title-box-category {
            font-family: arial;
            margin-bottom: 10px
        }

        .fck_detail .vote_rating_box .title-box-category .inner-title {
            color: #757575
        }

        .fck_detail .vote_rating_box .title-box-category .inner-title:before {
            display: none
        }

        .fck_detail .vote_rating_box .title_bx {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 15px
        }

        .fck_detail .vote_rating_box .label_check {
            font-size: 17px
        }

        .fck_detail .vote_rating_box .label_check input.radio_check[type="radio"] {
            top: 3px
        }

        .fck_detail .vote_rating_box .count-vote {
            font-size: 14px;
            line-height: 16px
        }

        .fck_detail .vote_rating_box .box_button {
            margin-top: 10px
        }

        .fck_detail .vote_rating_box .txt-kq-vote {
            font-size: 17px
        }

        .fck_detail .vote_rating_box._noresult {
            position: relative
        }

        .fck_detail .vote_rating_box._noresult .time-vote {
            position: absolute;
            right: 20px;
            bottom: 29px;
            width: auto
        }

        .fck_detail table[align="left"] {
            min-width: inherit;
            float: left;
            width: auto;
            margin-bottom: 0;
            margin-right: 18px
        }

        .fck_detail table[align="right"] {
            min-width: inherit;
            float: right;
            width: auto;
            margin-bottom: 0;
            margin-left: 18px
        }

        .fck_detail td table {
            margin: 0;
            width: 100%
        }

        .fck_detail .BoxTitle {
            font-family: 'Arial';
            color: #fff;
            font-weight: bold;
            text-decoration: none;
            margin: 0 !important;
            padding: 2px
        }

        .wrap_pic {
            width: 100%;
            float: left;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            margin-bottom: 1em
        }

        .wrap_pic .block_thumb_wrap {
            background: #f0eeea;
            min-width: 670px;
            max-width: 100%;
            margin: 0 auto;
            position: relative;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center
        }

        .wrap_pic .desc_cation {
            width: 100%;
            max-width: 670px;
            margin: 0 auto;
            clear: both;
            font-size: 16px;
            line-height: 160%
        }

        .wrap_pic .desc_cation p {
            font-size: 16px;
            line-height: 160%;
            padding-top: 15px;
            margin-bottom: 0
        }

        .g-before-after {
            position: relative;
            overflow: hidden
        }

        .g-before-after span {
            position: absolute;
            background: rgba(34, 34, 34, .4);
            border-radius: 2px;
            line-height: 24px;
            padding: 0 6px;
            top: 8px;
            font-size: 14px;
            color: #fff;
            z-index: 2
        }

        .g-before-after .before {
            left: 8px
        }

        .g-before-after .after {
            right: 8px
        }

        .g-before-after .touch {
            position: absolute;
            bottom: 10px;
            z-index: 4;
            right: 10px;
            color: #fff;
            font-size: 14px;
            text-shadow: 0 1px 1px rgba(0, 0, 0, .2)
        }

        .g-before-after .touch svg {
            width: 16.5px;
            height: 20px;
            background: url("data:image/svg+xml;charset=UTF-8,%3csvg width='19' height='24' viewBox='0 0 19 24' fill='none' xmlns='http://www.w3.org/2000/svg'%3e%3cg filter='url(%23filter0_d_16_30)'%3e%3cpath d='M8.99807 2.99682V9.25C8.99807 9.66421 9.33385 10 9.74807 10C10.1623 10 10.4981 9.66421 10.4981 9.25V4.22345C10.4981 3.98399 10.7023 3.74762 10.9959 3.74591C11.2584 3.7443 11.5 3.99047 11.5 4.25V11.75C11.5 12.0577 11.6879 12.3342 11.974 12.4474C12.2593 12.5603 12.5846 12.488 12.7952 12.2651L12.7959 12.2643L12.7985 12.2616C12.8026 12.2574 12.8101 12.2498 12.8208 12.2392C12.8422 12.218 12.8766 12.185 12.9226 12.1434C13.0151 12.06 13.1521 11.9445 13.3241 11.8227C13.6758 11.5737 14.1332 11.3272 14.6268 11.2407C15.1641 11.1466 15.6737 11.204 16.0124 11.379C16.221 11.4867 16.3843 11.644 16.4577 11.9073L14.7993 13.1541C14.7713 13.1752 14.7448 13.1982 14.7199 13.223L12.5447 15.396C11.6101 16.3296 10.8326 17.4081 10.242 18.5897C9.96277 19.1484 9.39181 19.5013 8.76722 19.5013H6.03943C5.46764 19.5013 4.97061 19.2285 4.7136 18.7883C3.97783 17.528 3 15.5004 3 13.7536V6C3 5.73158 3.21505 5.49994 3.50115 5.49994C3.79011 5.49994 4.00409 5.73065 4.00409 6V9.5C4.00409 9.91421 4.33988 10.25 4.75409 10.25C5.1683 10.25 5.50409 9.91421 5.50409 9.5V4.25C5.50409 3.97174 5.71851 3.74592 6 3.74592C6.28688 3.74592 6.5 3.9715 6.5 4.25V9.25C6.5 9.66421 6.83579 10 7.25 10C7.66421 10 8 9.66421 8 9.25V2.99682C8 2.72415 8.21208 2.49729 8.49859 2.49707C8.78902 2.49685 8.99807 2.72007 8.99807 2.99682ZM10.9866 2.24594C10.7753 2.24719 10.5744 2.27993 10.3872 2.33898ZM10.3872 2.33898C10.1247 1.58043 9.41757 0.996358 8.49743 0.997071C7.58169 0.997784 6.87538 1.58304 6.61197 2.33844C6.42187 2.27859 6.21687 2.24592 6 2.24592C4.8915 2.24592 4.10363 3.10157 4.01285 4.06407C3.85127 4.02235 3.6801 3.99994 3.50115 3.99994C2.33182 3.99994 1.5 4.95905 1.5 6V13.7536C1.5 15.9342 2.67139 18.2654 3.4182 19.5446C3.97463 20.4977 4.99781 21.0013 6.03943 21.0013H8.76722C9.96007 21.0013 11.0505 20.3273 11.5838 19.2603C12.1021 18.2232 12.7846 17.2766 13.6048 16.4572L15.7428 14.3214L17.7007 12.8495C17.8891 12.7078 18 12.4858 18 12.25C18 11.1883 17.4687 10.4429 16.7008 10.0463C15.9851 9.67661 15.1185 9.63171 14.3678 9.76325C13.8491 9.85416 13.3849 10.0467 13 10.2581V4.25C13 3.18962 12.1118 2.23917 10.9866 2.24594' fill='white'/%3e%3c/g%3e%3cdefs%3e%3cfilter id='filter0_d_16_30' x='0.5' y='0.99707' width='18.5' height='22.0043' filterUnits='userSpaceOnUse' color-interpolation-filters='sRGB'%3e%3cfeFlood flood-opacity='0' result='BackgroundImageFix'/%3e%3cfeColorMatrix in='SourceAlpha' type='matrix' values='0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0' result='hardAlpha'/%3e%3cfeOffset dy='1'/%3e%3cfeGaussianBlur stdDeviation='0.5'/%3e%3cfeComposite in2='hardAlpha' operator='out'/%3e%3cfeColorMatrix type='matrix' values='0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.2 0'/%3e%3cfeBlend mode='normal' in2='BackgroundImageFix' result='effect1_dropShadow_16_30'/%3e%3cfeBlend mode='normal' in='SourceGraphic' in2='effect1_dropShadow_16_30' result='shape'/%3e%3c/filter%3e%3c/defs%3e%3c/svg%3e ") no-repeat 0 0/contain
        }

        .g-before-after:hover .before,
        .g-before-after:hover .after {
            opacity: 0
        }

        .g-before-after img {
            display: block
        }

        .g-before-after .g-img-before {
            float: left
        }

        .g-before-after .g-img-after {
            left: 50%;
            bottom: 0;
            overflow: hidden
        }

        .g-before-after .g-img-after,
        .g-before-after .g-img-after img {
            position: absolute;
            right: 0;
            top: 0
        }

        .g-before-after .g-img-divider {
            position: absolute;
            left: 50%;
            z-index: 1;
            margin-left: -3px;
            top: 0;
            bottom: 0;
            width: 0;
            border-left: 3px solid #fff;
            border-right: 3px solid #fff
        }

        .g-before-after .g-img-after img {
            max-width: inherit
        }

        .g-before-after .g-img-divider span {
            background-image: url(data:image/svg+xml;charset=UTF-8,%3csvg\ width=\'32\'\ height=\'32\'\ viewBox=\'0\ 0\ 32\ 32\'\ fill=\'none\'\ xmlns=\'http://www.w3.org/2000/svg\'%3e%3crect\ width=\'32\'\ height=\'32\'\ rx=\'16\'\ fill=\'white\'/%3e%3cpath\ d=\'M15.5\ 10C15.2239\ 10\ 15\ 10.2239\ 15\ 10.5V14.5C15\ 14.7761\ 14.7762\ 15\ 14.5\ 15C14.2239\ 15\ 14\ 14.7761\ 14\ 14.5V11.5C14\ 11.2239\ 13.7762\ 11\ 13.5\ 11C13.2239\ 11\ 13\ 11.2239\ 13\ 11.5V15.5C13\ 15.7761\ 12.7762\ 16\ 12.5\ 16C12.2239\ 16\ 12\ 15.7761\ 12\ 15.5V13.5C12\ 13.2239\ 11.7761\ 13\ 11.5\ 13C11.2232\ 13\ 11\ 13.2235\ 11\ 13.499V17.5C11\ 18.0685\ 11.2526\ 18.7912\ 11.6338\ 19.5376C12.0078\ 20.2701\ 12.4741\ 20.9659\ 12.8351\ 21.4637C13.081\ 21.8028\ 13.4879\ 22\ 13.9362\ 22H15.7655C16.4949\ 22\ 17.173\ 21.4406\ 17.5114\ 20.6406C18.0953\ 19.2605\ 19.0234\ 18.125\ 19.7918\ 17.342C20.1779\ 16.9484\ 20.5287\ 16.6389\ 20.7841\ 16.4269L20.7975\ 16.4157C20.6885\ 16.3034\ 20.5873\ 16.2276\ 20.4963\ 16.1776C20.3378\ 16.0905\ 20.1893\ 16.0697\ 20.0372\ 16.0917C19.6972\ 16.1408\ 19.2964\ 16.4107\ 18.8535\ 16.8536C18.7105\ 16.9966\ 18.4955\ 17.0393\ 18.3086\ 16.9619C18.1218\ 16.8845\ 18\ 16.7022\ 18\ 16.5V11.5C18\ 11.2239\ 17.7761\ 11\ 17.5\ 11C17.226\ 11\ 17.0035\ 11.2203\ 17\ 11.4935V14.5C17\ 14.7761\ 16.7762\ 15\ 16.5\ 15C16.2239\ 15\ 16\ 14.7761\ 16\ 14.5L16\ 11.5C16\ 11.4962\ 16\ 11.4924\ 16\ 11.4887V10.5C16\ 10.2239\ 15.7762\ 10\ 15.5\ 10ZM12\ 12.0854V11.5C12\ 10.6716\ 12.6716\ 10\ 13.5\ 10C13.6952\ 10\ 13.8816\ 10.0373\ 14.0526\ 10.105C14.2259\ 9.46823\ 14.8083\ 9\ 15.5\ 9C16.1917\ 9\ 16.7741\ 9.46823\ 16.9475\ 10.105C17.1185\ 10.0373\ 17.3049\ 10\ 17.5\ 10C18.3284\ 10\ 19\ 10.6716\ 19\ 11.5V15.4478C19.2765\ 15.2765\ 19.5763\ 15.1479\ 19.8941\ 15.102C20.2534\ 15.05\ 20.6221\ 15.1058\ 20.9779\ 15.3012C21.3256\ 15.4923\ 21.6361\ 15.8028\ 21.916\ 16.2227C22.0656\ 16.4471\ 22.0102\ 16.7499\ 21.7907\ 16.9067L21.7868\ 16.9096L21.7695\ 16.9223C21.7537\ 16.9339\ 21.7294\ 16.9521\ 21.6976\ 16.9765C21.6338\ 17.0254\ 21.5398\ 17.0992\ 21.4228\ 17.1963C21.1887\ 17.3907\ 20.8638\ 17.6772\ 20.5055\ 18.0423C19.785\ 18.7766\ 18.9491\ 19.8089\ 18.4324\ 21.0302C17.9953\ 22.0635\ 17.0267\ 23\ 15.7655\ 23H13.9362C13.1975\ 23\ 12.4765\ 22.6727\ 12.0255\ 22.0507C11.6487\ 21.5311\ 11.1499\ 20.7888\ 10.7432\ 19.9924C10.3437\ 19.21\ 10\ 18.3128\ 10\ 17.5V13.499C10\ 12.6698\ 10.6723\ 12\ 11.5\ 12C11.6753\ 12\ 11.8436\ 12.0301\ 12\ 12.0854ZM12\ 15.5L12\ 15.5065L12\ 15.5Z\'\ fill=\'%23757575\'/%3e%3c/svg%3e);
            background-position: 0;
            position: absolute;
            top: 50%;
            display: block;
            line-height: 1;
            text-align: center;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            height: 32px;
            width: 32px;
            color: transparent;
            border-radius: 50%;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%
        }

        .note_flip {
            font-size: 14px;
            color: #fff;
            position: absolute;
            bottom: 13px;
            right: 13px;
            line-height: 16px;
            z-index: 2;
            height: 18px;
            text-shadow: 0 1px 1px rgba(0, 0, 0, .2)
        }

        .note_flip i.ic {
            width: 22px;
            height: 18px;
            margin-left: 4px;
            fill: #fff;
            background: url("data:image/svg+xml;charset=UTF-8,%3csvg width='20' height='16' viewBox='0 0 20 16' fill='none' xmlns='http://www.w3.org/2000/svg'%3e%3cg filter='url(%23filter0_d_16_47)'%3e%3cpath d='M2.5 13.5C2.2355 13.5 1.99056 13.3607 1.85537 13.1333C1.72018 12.906 1.71473 12.6243 1.84103 12.3919L8.09103 0.891875C8.25484 0.590461 8.60228 0.438613 8.93476 0.523124C9.26724 0.607634 9.5 0.906958 9.5 1.25001V12.75C9.5 13.1642 9.16421 13.5 8.75 13.5H2.5ZM18.1446 13.1333C18.0094 13.3607 17.7645 13.5 17.5 13.5H11.25C10.8358 13.5 10.5 13.1642 10.5 12.75V1.25001C10.5 0.906958 10.7328 0.607634 11.0652 0.523124C11.3977 0.438613 11.7452 0.590461 11.909 0.891875L18.159 12.3919C18.2853 12.6243 18.2798 12.906 18.1446 13.1333ZM12 4.20065V12H16.2388L12 4.20065Z' fill='white'/%3e%3c/g%3e%3cdefs%3e%3cfilter id='filter0_d_16_47' x='0.75' y='0.499939' width='18.5' height='15.0001' filterUnits='userSpaceOnUse' color-interpolation-filters='sRGB'%3e%3cfeFlood flood-opacity='0' result='BackgroundImageFix'/%3e%3cfeColorMatrix in='SourceAlpha' type='matrix' values='0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0' result='hardAlpha'/%3e%3cfeOffset dy='1'/%3e%3cfeGaussianBlur stdDeviation='0.5'/%3e%3cfeComposite in2='hardAlpha' operator='out'/%3e%3cfeColorMatrix type='matrix' values='0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.2 0'/%3e%3cfeBlend mode='normal' in2='BackgroundImageFix' result='effect1_dropShadow_16_47'/%3e%3cfeBlend mode='normal' in='SourceGraphic' in2='effect1_dropShadow_16_47' result='shape'/%3e%3c/filter%3e%3c/defs%3e%3c/svg%3e ") no-repeat 0 0/contain
        }

        .flip_wrap {
            display: block !important;
            background: none !important
        }

        .flip_wrap::after {
            display: block
        }

        .flip_wrap .stamp {
            position: absolute;
            z-index: 2;
            background: rgba(34, 34, 34, .4);
            border-radius: 2px;
            line-height: 24px;
            color: #fff;
            padding: 0 6px;
            font-size: 14px;
            left: 8px;
            top: 8px
        }

        .flip_wrap .back {
            overflow: hidden
        }

        .flip_wrap img {
            width: 100%;
            height: 100%
        }

        .flip_wrap .ic-flip {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 99
        }

        .page-detail.detail-photo {
            padding: 20px 0;
            background: #fcfaf6;
            border-bottom: 1px solid #e0e0e0
        }

        .page-detail.detail-photo .container {
            display: block
        }

        .page-detail.detail-photo .header-content,
        .page-detail.detail-photo .width-detail-photo {
            width: 100%;
            max-width: 680px;
            margin: 0 auto 10px auto
        }

        .page-detail.detail-photo .description {
            font-size: 16px
        }

        .page-detail.detail-photo .description .location-stamp {
            font-size: 14px
        }

        .page-detail.detail-photo .width-detail-photo {
            margin-bottom: 0
        }

        .page-detail.detail-photo .item_slide_show {
            width: 100%;
            float: left;
            display: table !important;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            margin-bottom: 50px
        }

        .page-detail.detail-photo .item_slide_show .block_thumb_slide_show {
            background: #f0eeea;
            min-width: 680px;
            max-width: 100%;
            margin: 0 auto;
            position: relative;
            display: table;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            overflow: hidden
        }

        .page-detail.detail-photo .item_slide_show .block_thumb_slide_show img {
            position: absolute;
            top: 0;
            left: 50%;
            -webkit-transform: translateX(-50%);
            transform: translateX(-50%)
        }

        .page-detail.detail-photo .item_slide_show .desc_cation {
            width: 100%;
            max-width: 680px;
            margin: 0 auto;
            clear: both;
            font-size: 16px;
            line-height: 160%
        }

        .page-detail.detail-photo .item_slide_show .desc_cation p {
            font-size: 16px;
            line-height: 160%;
            padding-top: 15px;
            margin-bottom: 0
        }

        .page-detail.detail-photo .item_slide_show .icon_thumb_zoom {
            position: absolute
        }

        .page-detail.detail-photo .author {
            font-size: 16px
        }

        .page-detail.detail-photo .topic-detail {
            margin-top: 20px
        }

        .page-detail.detail-photo .list-news {
            max-width: 680px;
            margin-left: auto;
            margin-right: auto;
            clear: both;
            float: none !important
        }

        @media screen and (max-width:1129px) {
            .page-detail.detail-photo .item_slide_show .block_thumb_slide_show {
                width: 100% !important
            }
        }

        .page-detail .width-detail-photo {
            margin-bottom: 0;
            clear: both
        }

        .page-detail .width-detail-photo .social-com {
            margin-bottom: 20px
        }

        .block_thumb_picture img.lazy {
            height: 100%
        }

        .social-com {
            margin-bottom: 10px
        }

        .social-com .circle_s {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #fff;
            border: 1px solid #e5e5e5;
            margin-right: 10px;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center
        }

        .social-com .circle_s .ic {
            -ms-flex-item-align: center;
            align-self: center
        }

        .social-com .circle_s.luutin {
            margin-left: 10px;
            position: relative
        }

        .social-com .circle_s.luutin:before {
            width: 1px;
            height: 24px;
            background: #e5e5e5;
            content: "";
            position: absolute;
            top: 3px;
            left: -11px
        }

        .social-com .circle_s.luutin.active {
            background: #076db6;
            border: 1px solid #076db6
        }

        .social-com .circle_s.luutin.active .ic {
            fill: #fff
        }

        .social-com .circle_s:hover.fb .ic {
            fill: #3b5999
        }

        .social-com .circle_s:hover.tw .ic {
            fill: #55acee
        }

        .social-com .circle_s:hover.luutin .ic {
            fill: #087cce
        }

        .social-com .circle_s:hover.luutin.active {
            background: #087cce;
            border: 1px solid #087cce
        }

        .social-com .circle_s:hover.luutin.active .ic {
            fill: #fff
        }

        .social-com .count_com_hoz {
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center
        }

        .social-com .count_com_hoz .circle_s {
            margin-right: 0
        }

        .social-com .count_com_hoz .number_cmt {
            padding-left: 5px
        }

        .social-com .count_com_hoz:hover .ic {
            fill: #b52759
        }

        .photo-dark .page-detail.detail-photo {
            padding-top: 100px;
            background-color: #151b22;
            background-position: top center;
            background-repeat: no-repeat;
            position: relative;
            margin-bottom: 20px
        }

        .photo-dark .page-detail.detail-photo .bg-cover {
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            text-align: center;
            display: block;
            height: 325px;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: top center
        }

        .photo-dark .page-detail.detail-photo .bg-cover:before {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            content: "";
            background: -webkit-gradient(linear, left top, left bottom, from(rgba(23, 25, 26, .45)), to(#17191a));
            background: linear-gradient(180deg, rgba(23, 25, 26, .45) 0%, #17191a 100%)
        }

        .photo-dark .page-detail.detail-photo .list-news {
            border-left: 1px solid #777
        }

        .photo-dark .page-detail.detail-photo .list-news li:before {
            background: #bdbdbd
        }

        .photo-dark .page-detail.detail-photo .item_slide_show .desc_cation,
        .photo-dark .page-detail.detail-photo .wrap_pic .desc_cation {
            color: #e5e5e5
        }

        .photo-dark .page-detail.detail-photo .item_slide_show .block_thumb_slide_show,
        .photo-dark .page-detail.detail-photo .item_slide_show .block_thumb_wrap,
        .photo-dark .page-detail.detail-photo .wrap_pic .block_thumb_slide_show,
        .photo-dark .page-detail.detail-photo .wrap_pic .block_thumb_wrap {
            background: rgba(255, 255, 255, .05)
        }

        .photo-dark .page-detail.detail-photo:before {
            content: "";
            width: 100%;
            height: 10px;
            background: rgba(23, 25, 26, .3);
            position: absolute;
            bottom: -10px;
            left: 0
        }

        .photo-dark .page-detail.detail-photo:after {
            content: "";
            width: 100%;
            height: 10px;
            background: rgba(23, 25, 26, .1);
            position: absolute;
            bottom: -20px;
            left: 0
        }

        .photo-dark .page-detail.detail-photo .wrap_video {
            margin-bottom: 35px
        }

        .photo-dark .page-detail .breadcrumb li {
            color: #bdbdbd
        }

        .photo-dark .page-detail .breadcrumb li:first-child {
            color: #55acee
        }

        .photo-dark .page-detail .title-detail {
            color: #fff
        }

        .photo-dark .page-detail .description {
            color: #bdbdbd
        }

        .photo-dark .page-detail .header-content .date,
        .photo-dark .page-detail .width-detail-photo .date {
            color: #bdbdbd
        }

        .photo-dark .page-detail .author {
            color: #757575
        }

        .photo-dark .page-detail .author strong {
            color: #e5e5e5
        }

        .photo-dark .social-com .circle_s {
            background: none;
            border: 1px solid #757575
        }

        .photo-dark .social-com .circle_s.luutin:before {
            background: #828282
        }

        .photo-dark .social-com .circle_s.luutin.active {
            background: #076db6;
            border: 1px solid #076db6
        }

        .photo-dark .social-com .circle_s.luutin.active .ic {
            fill: #fff
        }

        .photo-dark .social-com .circle_s:hover {
            border: 1px solid #bdbdbd
        }

        .photo-dark .social-com .circle_s:hover.fb .ic {
            fill: #e5e5e5
        }

        .photo-dark .social-com .circle_s:hover.tw .ic {
            fill: #e5e5e5
        }

        .photo-dark .social-com .circle_s:hover.luutin .ic {
            fill: #e5e5e5
        }

        .photo-dark .social-com .circle_s:hover.luutin.active {
            background: #087cce;
            border: 1px solid #087cce
        }

        .photo-dark .social-com .circle_s:hover.luutin.active .ic {
            fill: #fff
        }

        .photo-dark .social-com .count_com_hoz {
            color: #757575
        }

        .photo-dark .social-com .count_com_hoz:hover .ic {
            fill: #e5e5e5
        }

        .photo-dark .social-com .ic-print {
            -webkit-filter: brightness(1);
            filter: brightness(1)
        }

        .photo-dark .fck_detail table.tplCaption td.caption,
        .photo-dark .fck_detail table.tplCaption td.Image,
        .photo-dark .fck_detail table.tplCaption td p.Normal,
        .photo-dark .fck_detail table.tplCaption td .Image,
        .photo-dark .fck_detail .tplCaption .Image {
            color: #e5e5e5
        }

        .photo-dark .short_intro a,
        .photo-dark .fck_detail a {
            color: #39aaff
        }

        .photo-dark .short_intro a:hover,
        .photo-dark .fck_detail a:hover {
            color: #6bc0ff
        }

        .photo-dark .note_flip {
            background: #222;
            border: 1px solid #222;
            color: #bdbdbd
        }

        .photo-dark .note_flip .icon-flip {
            background: #4f4f4f
        }

        .photo-dark .note_flip .icon-flip .ic {
            fill: #fff
        }

        .detail-live .header-content,
        .detail-live .page-detail .width-detail-photo,
        .page-detail .detail-live .width-detail-photo,
        .detail-live .title-detail,
        .detail-live .description {
            padding: 0
        }

        .detail-live .list-news {
            max-width: 680px;
            margin-left: auto;
            margin-right: auto;
            float: none !important
        }

        .detail-live .related-list {
            padding-left: 20px
        }

        .detail-live.page-detail.top-detail .sidebar-2 {
            max-width: 420px;
            padding-left: 55px
        }

        .detail-live.page-detail.top-detail .sidebar-1 {
            max-width: calc(100% - 420px);
            padding: 20px 0 0
        }

        .detail-live .fck_detail {
            padding: 0;
            background: none;
            border: none;
            margin-bottom: 20px
        }

        .detail-live .fck_detail .tplCaption .Image {
            text-align: left
        }

        .detail-live .fck_detail .wrap-img-content {
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center
        }

        .detail-live .author {
            clear: both;
            line-height: 160%;
            margin-bottom: 9px
        }

        .detail-live .header-live {
            padding-bottom: 20px !important;
            line-height: 32px;
            padding: 0;
            font-size: 14px;
            margin-bottom: 20px;
            border-bottom: 1px solid #bdbdbd
        }

        .detail-live .header-live .ic-live:before {
            top: 13px
        }

        .detail-live .header-live .ic-live {
            margin-right: 0
        }

        .detail-live .header-live .ic-live:before {
            background: #da2e59
        }

        .detail-live .header-live .ic-live:after {
            content: 'Live';
            font-family: "Merriweather", serif;
            color: #da2e59;
            font-size: 16px;
            font-weight: 700
        }

        .detail-live .header-live .ic-live.not-start:after {
            content: "Sắp diễn ra";
            color: #da2e59
        }

        .detail-live .header-live .ic-live.not-start:before {
            background: #da2e59;
            -webkit-box-shadow: 0 0 0 rgba(218, 46, 89, .9);
            box-shadow: 0 0 0 rgba(218, 46, 89, .9);
            -webkit-animation: live-pulse 1s infinite;
            animation: live-pulse 1s infinite
        }

        .detail-live .header-live .ic-live.the-end:after {
            color: #757575;
            content: 'Đã kết thúc' !important
        }

        .detail-live .header-live .ic-live.the-end:before {
            background: #757575;
            -webkit-box-shadow: 0 0 0 rgba(117, 117, 117, .4);
            box-shadow: 0 0 0 rgba(117, 117, 117, .4);
            -webkit-animation: live-pulse-2 1s infinite;
            animation: live-pulse-2 1s infinite
        }

        .detail-live .header-live .ic-live.the-end+.update-time {
            color: #757575;
            margin-left: 0
        }

        .detail-live .header-live .update-time {
            color: #da2e59;
            font-size: 14px;
            margin-left: 10px
        }

        .detail-live .header-live .time {
            display: inline-block;
            margin-left: 20px;
            position: relative
        }

        .detail-live .header-live .time:before {
            content: '';
            width: 1px;
            height: 14px;
            background: #e5e5e5;
            position: absolute;
            left: -11px;
            top: 10px
        }

        .detail-live .header-live .time.finish {
            margin-left: 0
        }

        .detail-live .header-live .time.finish:before {
            content: none
        }

        .detail-live .header-live .social {
            float: right
        }

        .detail-live .header-live .social .circle_s {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #fff;
            border: 1px solid #e5e5e5;
            margin-left: 10px;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            position: relative
        }

        .detail-live .header-live .social .circle_s .ic {
            -ms-flex-item-align: center;
            align-self: center
        }

        .detail-live .header-live .social .circle_s.fb:hover .ic {
            fill: #3b5999
        }

        .detail-live .header-live .social .circle_s.tw:hover .ic {
            fill: #55acee
        }

        .detail-live .header-live .social .circle_s.luutin:hover .ic {
            fill: #076db6
        }

        .detail-live .header-live .social .circle_s.luutin.active:hover .ic {
            fill: #fff
        }

        .detail-live .header-live .social .count_com_hoz {
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center
        }

        .detail-live .header-live .social .count_com_hoz .number_cmt {
            padding-left: 5px;
            font-size: 12px;
            color: #757575
        }

        .detail-live .header-live .social .count_com_hoz:hover .ic {
            fill: #9f224e
        }

        .detail-live .header-live.endgame .time {
            margin-left: 0
        }

        .detail-live .header-live.endgame .time:before {
            display: none
        }

        .detail-live .tab-live {
            padding: 0;
            font-size: 18px;
            line-height: 23px;
            font-family: "Merriweather", serif;
            border-bottom: 1px solid #bdbdbd;
            margin-bottom: 20px
        }

        .detail-live .tab-live a {
            position: relative;
            margin-right: 20px;
            padding-bottom: 12px;
            display: inline-block;
            color: #757575;
            -webkit-transition-duration: 200ms;
            transition-duration: 200ms;
            -webkit-transition-property: all;
            transition-property: all;
            -webkit-transition-timing-function: cubic-bezier(.7, 1, .7, 1);
            transition-timing-function: cubic-bezier(.7, 1, .7, 1)
        }

        .detail-live .tab-live a:before {
            content: '';
            width: 100%;
            height: 3px;
            background: transparent;
            position: absolute;
            left: 0;
            bottom: -1px;
            -webkit-transition-duration: 200ms;
            transition-duration: 200ms;
            -webkit-transition-property: all;
            transition-property: all;
            -webkit-transition-timing-function: cubic-bezier(.7, 1, .7, 1);
            transition-timing-function: cubic-bezier(.7, 1, .7, 1)
        }

        .detail-live .tab-live a.active {
            color: #b42652;
            font-weight: bold
        }

        .detail-live .tab-live a.active:before {
            background: #b42652
        }

        .detail-live .tab-live a:hover {
            color: #b42652
        }

        .detail-live .wrap-sort {
            text-align: left;
            font-size: 0;
            margin-bottom: 10px
        }

        .detail-live .wrap-sort a {
            width: 100px;
            height: 36px;
            line-height: 36px;
            text-align: center;
            background: #e5e5e5;
            text-decoration: none;
            display: inline-block;
            color: #222;
            font-size: 15px;
            border: 1px solid #e5e5e5;
            -webkit-transition-duration: 200ms;
            transition-duration: 200ms;
            -webkit-transition-property: all;
            transition-property: all;
            -webkit-transition-timing-function: cubic-bezier(.7, 1, .7, 1);
            transition-timing-function: cubic-bezier(.7, 1, .7, 1)
        }

        .detail-live .wrap-sort a:first-child {
            border-radius: 3px 0 0 3px
        }

        .detail-live .wrap-sort a:last-child {
            border-radius: 0 3px 3px 0
        }

        .detail-live .wrap-sort a:before {
            content: none
        }

        .detail-live .wrap-sort a:hover {
            background: #bdbdbd;
            border: 1px solid #bdbdbd
        }

        .detail-live .wrap-sort a.active {
            background: #fff;
            font-weight: 700;
            border: 1px solid #e5e5e5
        }

        .detail-live .timeline {
            display: inline-block;
            font-size: 14px;
            line-height: 16px;
            color: #757575;
            margin-bottom: 10px
        }

        .detail-live .timeline strong {
            display: inline-block;
            margin-left: 20px;
            position: relative;
            color: #222
        }

        .detail-live .timeline strong:before {
            content: '';
            width: 1px;
            height: 10px;
            background: #e0e0e0;
            position: absolute;
            left: -11px;
            top: 3px
        }

        .detail-live .block-item {
            width: 100%;
            float: left;
            padding-bottom: 15px;
            margin-bottom: 15px;
            border-bottom: 1px solid #e5e5e5
        }

        .detail-live .block-item:last-of-type {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0
        }

        .detail-live .title-block-live {
            font-size: 20px;
            line-height: 160%;
            font-family: "Merriweather", serif;
            font-weight: bold;
            margin-bottom: 15px
        }

        .detail-live .social-block {
            float: left;
            line-height: normal;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            opacity: 0;
            -webkit-transition-duration: 200ms;
            transition-duration: 200ms;
            -webkit-transition-property: all;
            transition-property: all;
            -webkit-transition-timing-function: cubic-bezier(.7, 1, .7, 1);
            transition-timing-function: cubic-bezier(.7, 1, .7, 1)
        }

        .detail-live .social-block .txt-share {
            font-size: 13px;
            color: #757575;
            margin-right: 13px
        }

        .detail-live .social-block a {
            margin-right: 10px;
            padding-right: 10px;
            border-right: 1px solid #e5e5e5;
            text-decoration: none;
            position: relative;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            color: #757575;
            font-size: 13px
        }

        .detail-live .social-block a:last-of-type {
            border-right: none
        }

        .detail-live .social-block a:before {
            content: none
        }

        .detail-live .social-block a .ic {
            -ms-flex-item-align: center;
            align-self: center;
            margin-right: 5px;
            width: 13px;
            height: 13px;
            fill: #757575
        }

        .detail-live .social-block a:hover {
            color: #076db6
        }

        .detail-live .social-block a:hover .ic {
            color: #076db6
        }

        .detail-live .social-block a.fb:hover {
            color: #3b5999
        }

        .detail-live .social-block a.fb:hover .ic {
            fill: #3b5999
        }

        .detail-live .social-block a.tw:hover {
            color: #55acee
        }

        .detail-live .social-block a.tw:hover .ic {
            fill: #55acee
        }

        .detail-live .block-pin {
            margin-bottom: 20px
        }

        .detail-live .block-pin p {
            font: 400 18px arial;
            line-height: 160%
        }

        .detail-live .block-pin .header-block {
            padding-right: 25px
        }

        .detail-live .block-item:hover .social-block,
        .detail-live .block-pin:hover .social-block {
            opacity: 1
        }

        .detail-live .btn-view {
            border: 1px solid #bdbdbd;
            border-radius: 4px;
            background: #fff;
            color: #4f4f4f;
            font-family: "Merriweather", serif;
            font-weight: 700;
            font-size: 16px;
            text-decoration: none;
            clear: both;
            display: block;
            text-align: center;
            padding: 9px 0
        }

        .detail-live .btn-view:hover {
            color: #4f4f4f
        }

        .detail-live .btn-view:before {
            content: none
        }

        .detail-live .wrap-notifile {
            width: 100%;
            float: left;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center
        }

        .detail-live .notifile {
            height: 36px;
            line-height: 36px;
            -webkit-box-shadow: 0 2px 8px rgba(0, 0, 0, .1);
            box-shadow: 0 2px 8px rgba(0, 0, 0, .1);
            border-radius: 18px;
            color: #fff;
            font-size: 15px;
            padding: 0 15px;
            display: inline-block
        }

        .detail-live .notifile.new-content {
            background: #04416d
        }

        .detail-live .notifile.new-content .ic {
            fill: #fff
        }

        .detail-live .notifile.new-goal {
            background: #9f224e
        }

        .detail-live .wrap-notifile-backtotop .notifile {
            height: 40px;
            width: 40px;
            line-height: 40px;
            border-radius: 50%;
            text-align: center;
            padding: 0;
            background: #04416d
        }

        .detail-live .wrap-notifile-backtotop .notifile .ic {
            fill: #fff
        }

        .detail-live.page-detail .tags {
            border-bottom: none
        }

        .detail-live .wrap-notifileback {
            -webkit-box-pack: unset;
            -ms-flex-pack: unset;
            justify-content: unset;
            position: fixed;
            top: 120px;
            left: calc(50% - 205px);
            z-index: 99 !important;
            cursor: pointer
        }

        .detail-live .wrap-notifileback {
            width: 100%;
            float: left;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center
        }

        .header-block {
            position: relative
        }

        .header-block .ic-pin {
            position: absolute;
            top: 5px;
            right: 5px
        }

        .endgame .ic-live {
            display: none
        }

        .detail-live .header-live.endgame .time {
            margin-left: 0 !important
        }

        .detail-live .header-live.endgame .time:before {
            display: none !important
        }

        .tab-comment {
            background: #fff;
            border: 1px solid #e5e5e5
        }

        .tab-comment .header-tab {
            font-family: "Merriweather", serif;
            font-size: 16px;
            line-height: 20px
        }

        .tab-comment .header-tab a {
            width: 50%;
            height: 48px;
            line-height: 48px;
            text-align: left;
            padding-left: 20px;
            background: #e5e5e5
        }

        .tab-comment .header-tab a:hover {
            background: #bdbdbd
        }

        .tab-comment .header-tab a.active {
            background: #fff;
            font-weight: bold
        }

        .tab-comment .content-tab {
            padding: 20px 0 20px 10px
        }

        .tab-comment .content-tab .start {
            font-size: 15px;
            font-weight: bold;
            line-height: 23px;
            color: #757575;
            margin-bottom: 15px;
            padding-left: 35px;
            position: relative;
            width: 100%;
            float: left
        }

        .tab-comment .content-tab .start:before {
            content: '';
            width: 9px;
            height: 1px;
            background: #e5e5e5;
            position: absolute;
            left: 11px;
            top: 13px
        }

        .tab-comment .content-tab .start.updating {
            color: #9f224e
        }

        .tab-comment .content-tab .start.updating:before {
            height: 9px;
            border-radius: 50%;
            background: #9f224e;
            top: 8px;
            z-index: 1
        }

        .tab-comment .content-tab .ds-dienbien {
            padding: 0 20px 0 35px;
            position: relative
        }

        .tab-comment .content-tab .ds-dienbien:before {
            content: '';
            width: 1px;
            height: calc(100% + 30px);
            position: absolute;
            left: 15px;
            top: -25px;
            background: #e5e5e5
        }

        .tab-comment .content-tab .ds-dienbien li {
            position: relative;
            margin-bottom: 15px
        }

        .tab-comment .content-tab .ds-dienbien li strong {
            font-size: 15px;
            line-height: 16px;
            font-weight: bold
        }

        .tab-comment .content-tab .ds-dienbien li a {
            display: block;
            font-size: 15px;
            line-height: 23px;
            -webkit-transition-duration: 200ms;
            transition-duration: 200ms;
            -webkit-transition-property: all;
            transition-property: all;
            -webkit-transition-timing-function: cubic-bezier(.7, 1, .7, 1);
            transition-timing-function: cubic-bezier(.7, 1, .7, 1)
        }

        .tab-comment .content-tab .ds-dienbien li a:hover {
            color: #076db6
        }

        .tab-comment .content-tab .ds-dienbien li.time {
            color: #757575;
            font-size: 14px;
            line-height: 16px
        }

        .tab-comment .content-tab .ds-dienbien li.time:before {
            content: none
        }

        .tab-comment .content-tab .ds-dienbien li:before {
            content: '';
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: #e5e5e5;
            position: absolute;
            left: -24px;
            top: 4px
        }

        .tab-comment .content-tab .ds-dienbien li.active:before {
            background: #757575
        }

        .tab-comment .content-tab .scrollbar-right {
            height: 610px;
            overflow: hidden
        }

        .tab-comment .content-tab .box_comment_pin {
            padding: 0 20px 0 10px
        }

        .detail-live .fck_detail_pin .container_auio .afp-controlbar-container {
            position: unset !important
        }

        .detail-live .footer-content a.btn-cmt {
            display: none !important
        }

        .detail-live .social a.active {
            background: #076db6 !important;
            border: 1px solid #076db6 !important
        }

        .detail-live .social a.active .ic {
            fill: #fff
        }

        .detail-live .block-item-timer,
        .detail-live .block-item-ads {
            width: 100%;
            float: left;
            padding-bottom: 15px;
            margin-bottom: 15px;
            border-bottom: 1px solid #e5e5e5
        }

        .detail-live .block-item-timer span.timeline {
            color: #9f224e !important;
            font-weight: bold;
            font-size: 18px
        }

        .highlight-item {
            cursor: pointer
        }

        .bottom_content {
            border-top: 1px solid #e5e5e5;
            padding-top: 20px
        }

        .blink-block {
            background-color: rgba(255, 165, 0, .4);
            -webkit-animation-name: bckanim;
            animation-name: bckanim;
            -webkit-animation-fill-mode: forwards;
            animation-fill-mode: forwards;
            -webkit-animation-duration: 3s;
            animation-duration: 3s;
            -webkit-animation-delay: 0s;
            animation-delay: 0s
        }

        @-webkit-keyframes bckanim {
            0% {
                background-color: rgba(255, 165, 0, 0.4)
            }
            100% {
                background-color: transparent
            }
        }

        @keyframes bckanim {
            0% {
                background-color: rgba(255, 165, 0, 0.4)
            }
            100% {
                background-color: transparent
            }
        }

        .detail-live .wrap-notifile {
            -webkit-box-pack: unset;
            -ms-flex-pack: unset;
            justify-content: unset;
            position: fixed;
            top: 70px;
            left: calc(50% - 300px);
            z-index: 9999;
            cursor: pointer
        }

        .detail-live .wrap-notifile-backtotop {
            top: 120px;
            left: calc(50% - 205px)
        }

        .fck_detail_pin {
            border: none !important;
            padding: 0 !important;
            margin-bottom: 0 !important
        }

        .fck_detail_pin .header-block+p {
            padding-right: 30px
        }

        .header-block.date-line span {
            color: #9f224e;
            font-weight: 700
        }

        .detail-live .block-item:last-child {
            margin-bottom: 15px
        }

        .detail-live .block-item.last {
            border-bottom: none;
            margin-bottom: 0
        }

        .spinner2 {
            margin: 0 auto;
            width: 70px;
            text-align: center
        }

        .spinner2>div {
            width: 10px;
            height: 10px;
            background-color: #9f224e;
            border-radius: 100%;
            display: inline-block;
            -webkit-animation: sk-bouncedelay 1.4s infinite ease-in-out both;
            animation: sk-bouncedelay 1.4s infinite ease-in-out both
        }

        .spinner2 .bounce1 {
            -webkit-animation-delay: -.32s;
            animation-delay: -.32s
        }

        .spinner2 .bounce2 {
            -webkit-animation-delay: -.16s;
            animation-delay: -.16s
        }

        .ds-dienbien li strong,
        .related-list li {
            position: relative
        }

        .ds-dienbien li strong .spinner2 {
            position: absolute;
            top: 1px;
            left: -55px
        }

        .related-list li .spinner2 {
            position: absolute;
            top: 0;
            left: -33px
        }

        @-webkit-keyframes sk-bouncedelay {
            0%,
            80%,
            100% {
                -webkit-transform: scale(0)
            }
            40% {
                -webkit-transform: scale(1)
            }
        }

        @keyframes sk-bouncedelay {
            0%,
            80%,
            100% {
                -webkit-transform: scale(0);
                transform: scale(0)
            }
            40% {
                -webkit-transform: scale(1);
                transform: scale(1)
            }
        }

        .content-block .description .meta-news {
            display: none
        }

        .ic-pin.active {
            fill: #076db6
        }

        .ic-pin {
            cursor: pointer
        }

        .detail-interview .tab-live {
            border-bottom: 1px solid #bdbdbd;
            padding: 0
        }

        .detail-interview .fck_detail {
            background: none;
            border: none;
            padding: 0
        }

        .detail-interview .fck_detail .tplCaption .Image {
            background: none
        }

        .detail-interview.page-detail.top-detail .sidebar-1 {
            max-width: calc(100% - 420px)
        }

        .detail-interview.page-detail.top-detail .sidebar-2 {
            max-width: 420px;
            padding-left: 55px
        }

        .detail-interview .header-content,
        .detail-interview .page-detail .width-detail-photo,
        .page-detail .detail-interview .width-detail-photo,
        .detail-interview .title-detail,
        .detail-interview .description,
        .detail-interview .header-live {
            padding: 0
        }

        .detail-interview .block-pin {
            padding: 0;
            background: none
        }

        .detail-interview .block-pin .box_embed_video_parent {
            max-width: 100%;
            width: 100%;
            margin: 0
        }

        .detail-interview .block-extracontent {
            border-bottom: 1px solid #bdbdbd;
            margin-bottom: 20px
        }

        .detail-interview .social-block {
            opacity: 1
        }

        .detail-interview .social-block a {
            border-right: none
        }

        .detail-interview .social-block a .ic {
            fill: #757575 !important
        }

        .detail-interview .social-block a.fb:hover {
            color: #3b5999
        }

        .detail-interview .social-block a.fb:hover .ic {
            fill: #3b5999 !important
        }

        .detail-interview .social-block a.link-s:hover {
            color: #076db6
        }

        .detail-interview .social-block a.link-s:hover .ic {
            fill: #076db6 !important
        }

        .detail-interview .tab-comment .content-tab {
            padding-top: 0;
            padding-bottom: 0
        }

        .detail-interview .sidebar-2 .tab-comment .header-tab a {
            text-align: left
        }

        .detail-interview .btn-view {
            border: 1px solid #bdbdbd;
            border-radius: 4px;
            background: #fff;
            color: #4f4f4f;
            font-family: "Merriweather", serif;
            font-weight: 700;
            font-size: 16px
        }

        .detail-interview .btn-view:hover {
            color: #4f4f4f
        }

        .detail-interview .block-item {
            padding-bottom: 20px;
            margin-bottom: 20px
        }

        .detail-interview .block-item:last-of-type {
            margin-bottom: 20px;
            padding-bottom: 0
        }

        .detail-interview .fck_detail .consultant_reply {
            margin-bottom: 8px
        }

        .detail-interview .tab-comment {
            padding-top: 8px
        }

        .detail-interview .fck_detail .name_ques {
            font: 18px/150% Arial;
            font-style: italic;
            margin-bottom: 20px;
            -webkit-font-feature-settings: 'pnum' on, 'lnum' on;
            font-feature-settings: 'pnum' on, 'lnum' on
        }

        .detail-interview .fck_detail .name_ques p {
            display: initial
        }

        .detail-interview .fck_detail .name_ques .au_ques {
            color: #757575
        }

        .item_pvtt figure.tplCaption {
            background: none;
            text-align: left
        }

        .box_note_join {
            padding-top: 15px;
            border-top: 1px solid #e5e5e5
        }

        .box_note_join .tit_note {
            font-family: "Merriweather", serif;
            font-weight: bold;
            font-size: 20px;
            line-height: 160%;
            color: #222;
            margin-bottom: 20px
        }

        .form_alarm .input_element {
            padding-right: 105px;
            width: 60%
        }

        .form_alarm .btn_vne {
            position: absolute;
            top: 0;
            right: 0
        }

        .form_alarm .note_form_alarm {
            width: 40%;
            padding-left: 10px;
            line-height: 135%
        }

        .box_about_author {
            padding-top: 15px;
            margin-top: 15px;
            border-top: 1px solid #e5e5e5
        }

        .box_about_author .inner_about_author {
            background: #f7f7f7;
            padding: 20px 20px 0 20px
        }

        .box_about_author .name_au {
            font-family: "Merriweather", serif;
            font-size: 20px;
            color: #9f224e
        }

        .box_reply_interview .Interview {
            font-weight: 700;
            margin-bottom: 4px;
            margin-right: 0
        }

        .form_dangky {
            padding: 0 20px 0 10px
        }

        .form_dangky .input_form,
        .form_dangky .input_main {
            border-radius: 4px !important
        }

        .form_dangky .transition {
            padding: 10px 10px;
            resize: none;
            -webkit-transition: .2s all;
            transition: .2s all
        }

        .form_dangky .transition:focus,
        .form_dangky .transition.focus {
            height: 120px
        }

        .form_dangky .input_element {
            margin-bottom: 15px
        }

        .form_dangky .input_element .left {
            width: 77%
        }

        .form_dangky .input_element .right {
            width: 20%
        }

        .form_dangky .note_form_dk {
            padding: 13px 15px;
            background: #f7f7f7;
            margin-bottom: 10px;
            font-size: 15px;
            line-height: 1.5
        }

        .form_dangky .note_form_dk a {
            color: #076db6;
            text-decoration: underline;
            text-underline-position: under
        }

        .form_dangky .note_form_dk.note_red {
            color: #9f224e;
            border-bottom: 1px solid #e5e5e5;
            padding: 0 0 10px 0;
            background: none
        }

        .form_dangky .check_sub {
            margin-bottom: 10px;
            cursor: pointer
        }

        .form_dangky .check_sub input {
            display: inline-block;
            vertical-align: top;
            margin: 2px 5px 0 0
        }

        .form_dangky .btn_vne {
            width: auto;
            float: left;
            text-align: center;
            font-weight: 400
        }

        .form_dangky input[type="number"] {
            padding-right: 0
        }

        .sidebar-2 .form_dangky {
            padding-top: 0
        }

        .sidebar-2 .form_dangky .btn_vne {
            width: 100%;
            font-weight: 700
        }

        .sidebar-2 .tab-comment .header-tab {
            text-align: center;
            font-size: 18px;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center
        }

        .sidebar-2 .tab-comment .header-tab a {
            padding: 0 20px;
            width: auto;
            text-align: left;
            display: block
        }

        .detail-interview .tab-comment .content-tab .ds-question-interview li:before {
            top: 7px
        }

        .select_question {
            margin-bottom: 15px;
            padding: 0 20px 0 10px
        }

        .select_question .option_select {
            width: 100%;
            float: left;
            background: #fff;
            border: 1px solid #bdbdbd;
            border-radius: 3px;
            height: 40px;
            padding: 0 10px;
            color: #333;
            font-size: 15px;
            outline: none
        }

        .empty_content {
            position: relative;
            text-align: center;
            padding: 200px 20px
        }

        .empty_content .ic {
            width: 80px;
            height: 80px;
            fill: #e5e5e5;
            margin-bottom: 10px
        }

        .block-khachmoi {
            border-bottom: 1px solid #bdbdbd;
            margin-bottom: 20px
        }

        .block-khachmoi .inner-list-km {
            -ms-flex-wrap: wrap;
            flex-wrap: wrap
        }

        .block-khachmoi .txt-km {
            font-family: "Merriweather", serif;
            font-size: 20px;
            line-height: 160%;
            font-weight: 700;
            margin-bottom: 10px
        }

        .block-khachmoi .item-km {
            width: 100%;
            margin-bottom: 20px
        }

        .block-khachmoi .item-km .thumb-art {
            margin-right: 15px;
            width: 120px
        }

        .block-khachmoi .item-km .thumb {
            border-radius: 50%
        }

        .block-khachmoi .item-km p {
            font-size: 18px;
            line-height: 160%
        }

        .block-khachmoi .item-km p.name-km {
            font-family: "Merriweather", serif;
            font-size: 22px
        }

        .block-khachmoi .item-km p.des-km {
            margin-top: 5px;
            color: #4f4f4f
        }

        .block-khachmoi [class*="grid__"] {
            -webkit-column-gap: 20px;
            column-gap: 20px;
            row-gap: 20px;
            position: relative
        }

        .block-khachmoi .grid {
            display: grid;
            width: 100%;
            margin-left: 0;
            margin-right: 0;
            position: relative
        }

        .block-khachmoi .grid .item-km {
            margin-bottom: 0
        }

        .block-khachmoi .grid .item-km p {
            line-height: 1.4
        }

        .block-khachmoi .grid .item-km .thumb-art {
            width: 100px;
            margin-right: 10px
        }

        .block-khachmoi .grid .item-km .name-km {
            font-size: 18px;
            overflow: hidden
        }

        .block-khachmoi .grid .item-km .des-km {
            font-size: 16px;
            overflow: hidden
        }

        .block-khachmoi .grid__1 {
            grid-template-columns: repeat(1, 1fr)
        }

        .block-khachmoi .grid__2 {
            grid-template-columns: repeat(2, 1fr)
        }

        .block-khachmoi .grid__3 {
            grid-template-columns: repeat(3, 1fr)
        }

        .block-khachmoi.block-khachmoi-more .inner-list-km {
            width: calc(100% + 20px);
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-left: -20px
        }

        .block-khachmoi.block-khachmoi-more .item-km {
            width: 50%;
            padding-left: 20px
        }

        .block-khachmoi.block-khachmoi-more .item-km p {
            font-size: 16px
        }

        .block-khachmoi.block-khachmoi-more .item-km p.des-km {
            font-size: 14px;
            line-height: 140%
        }

        .block-khachmoi.block-khachmoi-more .item-km .thumb-art {
            width: 100px
        }

        .block-khachmoi.block-khachmoi-3 .item-km {
            width: 33.33333%
        }

        .block-khachmoi.block-khachmoi-3 .item-km .thumb-art {
            width: 100%;
            margin-bottom: 8px
        }

        .block-khachmoi.block-khachmoi-3 .item-km p {
            line-height: 22.4px
        }

        .block-khachmoi.block-khachmoi-3 .item-km p span {
            margin-top: 4px;
            display: block
        }

        .block-khachmoi.border-top {
            padding-top: 20px;
            border-top: 1px solid #bdbdbd
        }

        .block-guicauhoi .form_dangky,
        .box-right-interview .form_dangky {
            padding: 0
        }

        .block-guicauhoi .form_dangky .btn_vne,
        .box-right-interview .form_dangky .btn_vne {
            width: auto;
            font-weight: normal;
            background: #b42652
        }

        .block-guicauhoi .note-res,
        .box-right-interview .note-res {
            font: 400 14px/16px arial;
            margin-left: 20px
        }

        .block-guicauhoi .note-res sup,
        .box-right-interview .note-res sup {
            color: #d0021b
        }

        .block-guicauhoi .head-text,
        .box-right-interview .head-text {
            font: bold 20px/160% "Merriweather", serif;
            margin-bottom: 15px
        }

        .block-guicauhoi .label_input,
        .box-right-interview .label_input {
            font-weight: 400;
            margin-bottom: 8px
        }

        .block-guicauhoi .label_input sup,
        .box-right-interview .label_input sup {
            color: #d0021b;
            margin-top: -3px;
            display: inline-block
        }

        .block-guicauhoi .form_dangky .input_element .input_50,
        .box-right-interview .form_dangky .input_element .input_50 {
            width: 49%
        }

        .block-guicauhoi .form_dangky .input_element .input_30,
        .box-right-interview .form_dangky .input_element .input_30 {
            width: 29%
        }

        .block-guicauhoi .form_dangky .input_element .input_70,
        .box-right-interview .form_dangky .input_element .input_70 {
            width: 69%
        }

        .block-guicauhoi .select-gt,
        .box-right-interview .select-gt {
            width: calc(49% - 5px);
            text-align: center;
            margin-right: 2px;
            display: inline-block;
            background: #fff;
            border: 1px solid #bdbdbd;
            border-radius: 4px;
            font-size: 16px;
            color: #4f4f4f;
            padding: 10px 0 10px 0
        }

        .block-guicauhoi .select-gt:last-of-type,
        .box-right-interview .select-gt:last-of-type {
            margin-right: 0
        }

        .block-guicauhoi .select-gt.active,
        .box-right-interview .select-gt.active {
            color: #b42652;
            font-weight: 700;
            border-color: #b42652
        }

        .block-guicauhoi {
            padding-bottom: 5px;
            border-bottom: 1px solid #bdbdbd
        }

        .box-right-interview .form_dangky {
            padding: 0 20px 5px 10px
        }

        .box-right-interview .form_dangky .btn_vne {
            width: 100%;
            font-weight: 700;
            font-family: "Merriweather", serif
        }

        .box-right-interview .note-res {
            margin-left: auto;
            padding-right: 20px;
            margin-top: -7px
        }

        .box-col-sticky {
            position: -webkit-sticky;
            position: sticky;
            top: 70px;
            left: 0
        }

        .block-book-alarm {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: end;
            -ms-flex-align: end;
            align-items: flex-end;
            padding-bottom: 15px;
            border-bottom: 1px solid #bdbdbd
        }

        .block-book-alarm .head-text {
            margin-bottom: 5px
        }

        .block-book-alarm .txt-alarm {
            -ms-flex-negative: 1;
            flex-shrink: 1;
            padding-right: 30px
        }

        .block-book-alarm .txt-alarm p {
            font-size: 16px;
            line-height: 140%
        }

        .block-book-alarm .button-alarm {
            -ms-flex-negative: 0;
            flex-shrink: 0;
            margin-left: auto;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center
        }

        .block-book-alarm .button-alarm a {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            font-size: 16px;
            padding: 0 14px;
            height: 44px;
            background: #fff;
            border: 1px solid #e5e5e5;
            border-radius: 4px;
            margin-left: 10px
        }

        .block-book-alarm .button-alarm a img {
            margin-right: 5px
        }

        @media (max-width:600px) {
            .block-book-alarm {
                -ms-flex-wrap: wrap;
                flex-wrap: wrap
            }
            .block-book-alarm .txt-alarm {
                padding-right: 0
            }
            .block-book-alarm .button-alarm {
                margin-left: 0;
                margin-top: 15px;
                width: 100%;
                -webkit-box-pack: center;
                -ms-flex-pack: center;
                justify-content: center
            }
            .block-book-alarm .button-alarm a {
                width: 100%;
                -webkit-box-pack: center;
                -ms-flex-pack: center;
                justify-content: center
            }
            .block-book-alarm .button-alarm a:first-child {
                margin-left: 0
            }
        }

        figure.ob {
            width: 100%;
            margin: 0 0 0 0;
            overflow: hidden
        }

        .block-pin {
            border-bottom: 1px solid #bdbdbd
        }

        .block-pin .box_embed_video_parent {
            overflow: hidden;
            max-width: 100%;
            width: 100%;
            margin: 0
        }

        .box_embed_video {
            width: 100%;
            position: relative;
            background: #e1e1e1
        }

        .box_embed_video .embed-container,
        .box_embed_video .embed-container-square {
            -webkit-transition-duration: 300ms;
            transition-duration: 300ms;
            -webkit-transition-property: left;
            transition-property: left;
            -webkit-transition-timing-function: cubic-bezier(.7, 1, .7, 1);
            transition-timing-function: cubic-bezier(.7, 1, .7, 1)
        }

        .box_embed_video .parser_title {
            opacity: 0;
            visibility: hidden;
            width: 100%;
            position: absolute;
            top: 180px;
            left: 0;
            background: #fff;
            padding: 10px;
            font: 400 14px arial;
            color: #333;
            -webkit-transition-duration: 200ms;
            transition-duration: 200ms;
            -webkit-transition-property: all;
            transition-property: all;
            -webkit-transition-timing-function: cubic-bezier(.2, 1, .2, 1);
            transition-timing-function: cubic-bezier(.2, 1, .2, 1);
            -webkit-box-shadow: 0 2px 8px rgba(0, 0, 0, .1);
            box-shadow: 0 2px 8px rgba(0, 0, 0, .1);
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            text-align: left;
            height: auto
        }

        .box_embed_video .embed-container .parser_title b {
            color: #9f224e
        }

        .box_embed_video .close-video {
            color: #333;
            font-family: -webkit-body;
            font-size: 33px;
            width: 30px;
            height: 30px;
            line-height: 28px;
            position: absolute;
            top: -15px;
            right: -15px;
            cursor: pointer;
            text-align: center;
            display: none;
            background: #fff;
            border: 1px solid #e5e5e5;
            border-radius: 50%
        }

        .start_sticky .embed-container.fadeout,
        .start_sticky .embed-container-square.fadeout {
            opacity: 0
        }

        .start_sticky .embed-container.fadein,
        .start_sticky .embed-container-square.fadein {
            opacity: 1;
            -webkit-transition: opacity .5s;
            transition: opacity .5s;
            -webkit-animation: animationVideoUp .5s ease;
            animation: animationVideoUp .5s ease
        }

        .start_sticky .embed-container.fadeinDown,
        .start_sticky .embed-container-square.fadeinDown {
            opacity: 1;
            -webkit-transition: opacity .5s;
            transition: opacity .5s;
            bottom: auto;
            top: 70px;
            -webkit-animation: animationVideoDown .5s ease;
            animation: animationVideoDown .5s ease
        }

        .box_embed_video .embed-container.fadeout-up,
        .box_embed_video .embed-container-square.fadeout-up {
            opacity: 0
        }

        .box_embed_video .embed-container.fadein-up,
        .box_embed_video .embed-container-square.fadein-up {
            opacity: 1;
            -webkit-transition: opacity 1s;
            transition: opacity 1s
        }

        .start_sticky .box_embed_video .embed-container .parser_title,
        .start_sticky .box_embed_video .embed-container-square .parser_title {
            opacity: 1;
            visibility: visible
        }

        .start_sticky .box_embed_video .embed-container {
            position: fixed;
            bottom: 36px;
            left: 20px;
            width: 320px;
            padding-bottom: 0;
            height: 180px;
            z-index: 9999;
            overflow: visible
        }

        .start_sticky .box_embed_video .embed-container iframe {
            width: 100%;
            height: 180px
        }

        .start_sticky .box_embed_video .embed-container>div {
            height: 180px !important
        }

        .start_sticky .box_embed_video .embed-container>div .media_content {
            height: 180px !important
        }

        .start_sticky .box_embed_video .parser_title {
            opacity: 1;
            visibility: visible;
            display: block !important;
            height: auto !important
        }

        .start_sticky .box_embed_video .embed-container>div+.parser_title {
            height: auto !important
        }

        .start_sticky .box_embed_video .close-video {
            display: block !important
        }

        .box_embed_video .embed-container-square .parser_title {
            top: 256px
        }

        .start_sticky .box_embed_video .embed-container-square {
            width: 320px;
            height: 256px
        }

        .start_sticky .box_embed_video .embed-container-square {
            width: 320px;
            height: 256px;
            position: fixed;
            bottom: 36px;
            left: 20px;
            padding-bottom: 0;
            z-index: 9999;
            overflow: visible
        }

        .start_sticky .box_embed_video .embed-container-square iframe {
            width: 100%;
            height: 256px
        }

        .start_sticky .box_embed_video>.embed-container-square+div+div>div {
            height: 256px !important
        }

        .start_sticky .box_embed_video>.embed-container-square+div+div>div .media_content {
            height: 256px !important
        }

        .start_sticky .box_embed_video .embed-container-square iframe {
            width: 100%;
            height: 256px
        }

        .start_sticky .box_embed_video .embed-container-square>div .media_content {
            height: 256px !important
        }

        .start_sticky .box_embed_video>.embed-container-square+div+div>div+.parser_title {
            height: auto !important
        }

        @-webkit-keyframes animationVideoDown {
            from {
                -webkit-transform: translateY(-110%);
                transform: translateY(-110%);
                opacity: 0
            }
            to {
                -webkit-transform: translateY(0);
                transform: translateY(0);
                opacity: 1
            }
        }

        @keyframes animationVideoDown {
            from {
                -webkit-transform: translateY(-110%);
                transform: translateY(-110%);
                opacity: 0
            }
            to {
                -webkit-transform: translateY(0);
                transform: translateY(0);
                opacity: 1
            }
        }

        @-webkit-keyframes animationVideoUp {
            from {
                -webkit-transform: translateY(110%);
                transform: translateY(110%);
                opacity: 0
            }
            to {
                -webkit-transform: translateY(0);
                transform: translateY(0);
                opacity: 1
            }
        }

        @keyframes animationVideoUp {
            from {
                -webkit-transform: translateY(110%);
                transform: translateY(110%);
                opacity: 0
            }
            to {
                -webkit-transform: translateY(0);
                transform: translateY(0);
                opacity: 1
            }
        }

        .wrap-img-content {
            width: 100%;
            float: left;
            position: relative;
            padding-bottom: 15px
        }

        .wrap-img-content .inner-img-info {
            width: calc(100% - 55px)
        }

        .page-detail.detail-infographic {
            background: #222;
            padding-top: 20px !important
        }

        .page-detail.detail-infographic .header-content .date,
        .page-detail.detail-infographic .width-detail-photo .date {
            color: #bdbdbd
        }

        .page-detail.detail-infographic .breadcrumb li {
            color: #bdbdbd
        }

        .page-detail.detail-infographic .breadcrumb li:first-child {
            color: #bdbdbd
        }

        .page-detail.detail-infographic .title-detail {
            color: #fff
        }

        .page-detail.detail-infographic .width-detail-photo .description {
            color: #bdbdbd
        }

        .page-detail.detail-infographic .related-list li {
            color: #39aaff
        }

        .page-detail.detail-infographic .related-list li:before {
            background: #bdbdbd
        }

        .page-detail.detail-infographic .author {
            color: #757575;
            font-size: 16px
        }

        .page-detail.detail-infographic .social_pin {
            top: 65px;
            padding-top: 0;
            width: 55px
        }

        .page-detail.detail-infographic .social_pin .social_left li a {
            border: 1px solid #757575;
            background: none
        }

        .page-detail.detail-infographic .social_pin .social_left li a .ic {
            fill: #757575
        }

        .page-detail.detail-infographic .social_pin .social_left li a .number_cmt {
            bottom: -25px
        }

        .page-detail.detail-infographic .social_pin .social_left li a:hover {
            background: none;
            border: 1px solid #bdbdbd
        }

        .page-detail.detail-infographic .social_pin .social_left li a:hover .ic {
            fill: #e5e5e5
        }

        .page-detail.detail-infographic .social_pin .social_left li a.social_fb:hover,
        .page-detail.detail-infographic .social_pin .social_left li a.social_twit:hover,
        .page-detail.detail-infographic .social_pin .social_left li a.social_save:hover,
        .page-detail.detail-infographic .social_pin .social_left li a.social_comment:hover {
            background: none;
            border: 1px solid #e5e5e5
        }

        .page-detail.detail-infographic .social_pin .social_left li.border {
            border-top: 1px solid #757575
        }

        .photo-dark .fck_detail {
            color: #e5e5e5
        }

        .text-to-speech {
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            margin-bottom: 24px;
            position: relative;
            min-height: 32px
        }

        .text-to-speech .click-listen {
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            font-size: 14px;
            line-height: 100%;
            margin-right: 18px
        }

        .text-to-speech .ico-listen {
            border: 1px solid #222;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            text-align: center;
            line-height: 27px;
            margin-right: 8px
        }

        .text-to-speech .ico-listen .ic {
            width: 13px;
            height: 13px;
            fill: #222
        }

        .text-to-speech .time-duration {
            margin-left: 8px;
            color: #757575
        }

        .text-to-speech .icon-info-listen {
            cursor: pointer;
            position: relative
        }

        .text-to-speech .icon-info-listen:after {
            border: solid #e5e5e5;
            border-width: 0 1px 1px 0;
            display: inline-block;
            background: #fff;
            padding: 7px;
            transform: rotate(-135deg);
            -webkit-transform: rotate(-135deg);
            content: '';
            position: absolute;
            top: 28px;
            left: 50%;
            margin-left: -7.5px;
            z-index: 2;
            opacity: 0;
            -webkit-transition-duration: 300ms;
            transition-duration: 300ms;
            -webkit-transition-property: all;
            transition-property: all;
            -webkit-transition-timing-function: cubic-bezier(.7, 1, .7, 1);
            transition-timing-function: cubic-bezier(.7, 1, .7, 1)
        }

        .text-to-speech .icon-info-listen .ic {
            fill: #bdbdbd;
            width: 23px;
            height: 23px
        }

        .text-to-speech .box-info-listen {
            -webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, .2);
            box-shadow: 0 1px 4px rgba(0, 0, 0, .2);
            padding: 16px;
            background: #fff;
            width: 320px;
            position: absolute;
            left: 0;
            z-index: 1;
            opacity: 0;
            visibility: hidden;
            top: 62px;
            -webkit-transition-duration: 300ms;
            transition-duration: 300ms;
            -webkit-transition-property: all;
            transition-property: all;
            -webkit-transition-timing-function: cubic-bezier(.7, 1, .7, 1);
            transition-timing-function: cubic-bezier(.7, 1, .7, 1)
        }

        .text-to-speech .box-info-listen p {
            font-size: 14px;
            line-height: 140%
        }

        .text-to-speech .box-info-listen .btn_vne {
            display: inline-block;
            background: #c92a57;
            border-radius: 2px;
            height: 32px;
            line-height: 32px;
            padding: 0 9px
        }

        .text-to-speech.show-info .icon-info-listen:after {
            opacity: 1
        }

        .text-to-speech.show-info .box-info-listen {
            opacity: 1;
            visibility: visible;
            top: 42px
        }

        .text-to-speech.text-to-speech-player {
            width: 100%;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center
        }

        .text-to-speech.text-to-speech-player .player-audio {
            width: 100%;
            max-width: 360px;
            -ms-flex-negative: 1;
            flex-shrink: 1
        }

        .text-to-speech.text-to-speech-player .edit-speed {
            width: 122px;
            -ms-flex-negative: 0;
            flex-shrink: 0;
            -webkit-box-pack: end;
            -ms-flex-pack: end;
            justify-content: flex-end;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            color: #757575
        }

        .text-to-speech.text-to-speech-player .edit-speed img {
            margin-left: 10px
        }

        .text-to-speech.text-to-speech-player .box-edit-speed {
            width: 360px;
            left: auto;
            right: 130px;
            top: 46px;
            top: 66px;
            z-index: 5;
            text-align: center
        }

        .text-to-speech.text-to-speech-player .box-edit-speed .tit-pop-edit {
            font: 700 16px/160% "Merriweather", serif;
            margin-bottom: 20px
        }

        .text-to-speech.text-to-speech-player .box-edit-speed .row-edit-s {
            width: 160px;
            height: 44px;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            border: 1px solid #bdbdbd;
            border-radius: 4px;
            margin: 0 auto;
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 8px
        }

        .text-to-speech.text-to-speech-player .box-edit-speed .btn-edit {
            width: 44px;
            height: 44px;
            -ms-flex-negative: 0;
            flex-shrink: 0;
            cursor: pointer;
            line-height: 44px;
            font-family: -webkit-body;
            font-size: 25px
        }

        .text-to-speech.text-to-speech-player .box-edit-speed .number-change {
            width: 100%;
            -ms-flex-negative: 1;
            flex-shrink: 1
        }

        .text-to-speech.text-to-speech-player .box-edit-speed p {
            color: #757575;
            margin-bottom: 16px
        }

        .text-to-speech.text-to-speech-player .box-edit-speed .note-s {
            font-size: 12px;
            margin-bottom: 16px;
            width: 100%;
            float: left
        }

        .text-to-speech.text-to-speech-player .box-edit-speed .note-danhgia {
            margin-bottom: 0;
            font-size: 12px
        }

        .text-to-speech.text-to-speech-player .box-edit-speed .note-danhgia a {
            color: #222;
            text-decoration: underline
        }

        .text-to-speech.text-to-speech-player .box-edit-speed .close-edit {
            width: 32px;
            height: 32px;
            border: 1px solid #222;
            border-radius: 50%;
            text-align: center;
            line-height: 28px;
            font-family: -webkit-body;
            display: block;
            font-size: 30px;
            position: absolute;
            top: 16px;
            right: 16px;
            cursor: pointer
        }

        .text-to-speech.text-to-speech-player.show-info .edit-speed:after {
            z-index: 6
        }

        .text-to-speech.text-to-speech-player.show-info .box-edit-speed {
            top: 46px
        }

        .wrap_video {
            margin-bottom: 5px
        }

        .wrap_video p {
            width: 100%;
            max-width: 680px;
            margin: 0 auto 15px auto !important;
            clear: both;
            font-size: 16px;
            line-height: 160%
        }

        .page-detail.top-detail {
            background: #fcfaf6;
            border-bottom: 1px solid #e0e0e0
        }

        .page-detail.top-detail .container {
            background: #fcfaf6
        }

        .page-detail.top-detail .sidebar-1 {
            width: 100%;
            max-width: calc(100% - 420px);
            padding: 20px 0 0 0
        }

        .page-detail.top-detail .sidebar-1 .description a {
            color: #076db6;
            text-decoration: underline;
            text-underline-position: under
        }

        .page-detail.top-detail .sidebar-2 {
            width: 100%;
            max-width: 355px;
            padding: 20px 0 0 55px
        }

        .page-detail.top-detail .sidebar-2 .wrapper-sticky {
            margin-bottom: 20px
        }

        .page-detail .sidebar-1 {
            width: 100%;
            max-width: calc(100% - 355px);
            padding: 20px 0 0 0;
            position: relative
        }

        .page-detail .sidebar-2 {
            width: 100%;
            max-width: 355px;
            padding: 20px 0 0 55px
        }

        .page-detail .header-content,
        .page-detail .width-detail-photo {
            margin-bottom: 10px
        }

        .page-detail .header-content .date,
        .page-detail .width-detail-photo .date {
            float: right;
            color: #757575;
            font-size: 14px
        }

        .page-detail .related-list {
            width: 100%;
            float: left;
            margin-bottom: 12px
        }

        .page-detail .related-list li {
            width: 100%;
            float: left;
            font-size: 14px;
            line-height: 18px;
            padding-left: 13px;
            position: relative;
            color: #076db6;
            margin-bottom: 10px;
            font-family: "Merriweather", serif
        }

        .page-detail .related-list li:before {
            content: '';
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: #757575;
            position: absolute;
            left: 0;
            top: 7px
        }

        .page-detail .related-list li .ic-external {
            width: 12px;
            height: 12px;
            fill: #bdbdbd
        }

        .page-detail .related-list li .count_cmt {
            font-size: 12px;
            color: #076db6;
            display: inline-block;
            vertical-align: top;
            text-decoration: none;
            font-family: arial
        }

        .page-detail .related-list li .count_cmt .ic {
            fill: #bdbdbd;
            width: 12px;
            height: 12px;
            margin-right: 1px
        }

        .page-detail .related-list li .count_cmt:hover {
            color: #087cce
        }

        .page-detail .related-list li .count_cmt:hover .ic {
            fill: #999
        }

        .page-detail .title-detail {
            font-size: 32px;
            line-height: 150%;
            font-family: "Merriweather", serif;
            font-weight: bold;
            margin-bottom: 15px
        }

        .page-detail .user-myvne {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            margin-bottom: 15px
        }

        .page-detail .user-myvne .avata {
            width: 36px;
            height: 36px;
            border-radius: 100%;
            overflow: hidden;
            background: #e5e5e5
        }

        .page-detail .user-myvne .text-author-post {
            font-weight: bold;
            font-size: 16px;
            margin-left: 12px
        }

        .page-detail .description {
            font-size: 18px;
            line-height: 160%;
            font-weight: 400;
            margin-bottom: 15px
        }

        .page-detail .description .location-stamp {
            font-size: 16px;
            margin-right: 15px
        }

        .page-detail .description .location-stamp:before {
            bottom: 6px
        }

        .page-detail .list-news {
            width: 100%;
            float: left;
            font-size: 16px;
            line-height: 18px;
            padding: 10px 0 0 30px;
            border-left: 1px solid #bdbdbd;
            margin-bottom: 20px;
            clear: both
        }

        .page-detail .list-news li {
            margin-bottom: 10px;
            position: relative;
            line-height: 160%;
            text-align: left
        }

        .page-detail .list-news li:before {
            content: '';
            width: 5px;
            height: 5px;
            background: #757575;
            position: absolute;
            left: -12px;
            top: 10px;
            border-radius: 50%
        }

        .page-detail .list-news li a {
            color: #076db6;
            position: relative;
            text-decoration: underline;
            text-underline-position: under
        }

        .page-detail .list-news li .meta-news {
            margin-left: 5px;
            display: inline-block;
            vertical-align: middle
        }

        .page-detail .list-news li .meta-news .count_cmt {
            text-decoration: none !important
        }

        .box-category__list-news {
            display: -moz-flex;
            display: -ms-flex;
            display: -o-flex;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            width: 100%;
            margin-bottom: 30px
        }

        .box-category__list-news .sidebar-1 {
            padding-top: 0;
            max-width: calc(100% - 340px)
        }

        .box-category__list-news .sidebar-2 {
            padding: 0 0 0 40px;
            position: relative;
            max-width: 340px
        }

        .box-category__list-news .sidebar-2::before {
            content: "";
            background: #e5e5e5;
            position: absolute;
            top: 0;
            bottom: 0;
            width: 1px;
            left: 20px
        }

        .box-category__list-news .sidebar-2 .wrapper-sticky {
            position: sticky;
            position: -webkit-sticky;
            top: 70px
        }

        .box-category__list-news.ab-test {
            padding-top: 20px;
            border-top: double #222;
            float: left;
            margin-top: -20px
        }

        .header-social {
            margin-bottom: 10px
        }

        .header-social .social .circle_s {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #fff;
            border: 1px solid #e5e5e5;
            margin-right: 10px;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center
        }

        .header-social .social .circle_s .ic {
            -ms-flex-item-align: center;
            align-self: center
        }

        .header-social .social .count_com_hoz {
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center
        }

        .header-social .social .count_com_hoz .circle_s {
            margin-right: 0
        }

        .header-social .social .count_com_hoz .number_cmt {
            padding-left: 5px
        }

        .score-table {
            background: #fff;
            padding: 15px;
            color: #222;
            border: 1px solid #e5e5e5;
            font-family: "Merriweather", serif;
            margin-bottom: 20px
        }

        .score-table .group {
            width: 35%
        }

        .score-table .group:first-child {
            padding-right: 30px
        }

        .score-table .group:first-child strong {
            margin-left: auto
        }

        .score-table .group:last-child {
            -webkit-box-orient: horizontal;
            -webkit-box-direction: reverse;
            -ms-flex-direction: row-reverse;
            flex-direction: row-reverse;
            padding-left: 30px;
            text-align: right
        }

        .score-table .group:last-child strong {
            margin-right: auto
        }

        .score-table .group.group-score {
            width: 30%;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            -ms-flex-item-align: center;
            align-self: center;
            text-align: center
        }

        .score-table .group.group-score .main-score {
            width: 100%;
            font-weight: bold;
            font-size: 24px;
            font-family: arial
        }

        .score-table .group.group-score .sub-score {
            width: 100%;
            font: 400 18px/140% arial;
            padding: 0 32px;
            margin-top: 5px
        }

        .score-table .group.lose {
            color: #757575
        }

        .score-table .name {
            font-size: 18px;
            line-height: 30px;
            font-weight: bold;
            font-family: Arial;
            margin-bottom: 10px
        }

        .score-table p {
            font-family: arial;
            font-size: 16px;
            line-height: 17px;
            margin-top: 8px
        }

        .box_tuvan {
            border-top: 1px solid #e5e5e5;
            padding: 20px 0 10px 0;
            font-size: 15px
        }

        .box_tuvan .box_left {
            width: 50%;
            border-right: 1px solid #e5e5e5;
            padding-right: 20px
        }

        .box_tuvan .box_right {
            width: 50%;
            padding-left: 20px
        }

        .box_tuvan p {
            margin-bottom: 10px
        }

        .box_tuvan__2 {
            background: #fff;
            border: 1px solid #e5e5e5;
            font-size: 15px;
            padding: 12px 10px;
            margin-bottom: 20px;
            text-align: center
        }

        .box_tuvan__2 p {
            display: inline-block;
            margin-bottom: 0
        }

        .box_tuvan__2 svg {
            fill: #bdbdbd;
            vertical-align: text-top
        }

        .view_reply {
            height: 40px;
            line-height: 40px;
            background: #e5e5e5;
            color: #4f4f4f !important;
            text-decoration: none !important;
            font-size: 15px;
            font-weight: 700;
            text-align: center;
            display: block;
            margin-bottom: 20px;
            text-decoration: none
        }

        .view_reply:hover {
            background: #bdbdbd
        }

        .block_reply_tv {
            margin-top: 0
        }

        .block_reply_tv .tit_reply {
            font-family: "Merriweather", serif;
            font-weight: bold;
            font-size: 24px;
            margin-bottom: .7em
        }

        .block_reply_tv .author_tv {
            text-align: right;
            margin-bottom: 0
        }

        .block_reply_tv .info_author_tv {
            text-align: right
        }

        .item_quiz {
            margin-bottom: 20px;
            background: #fff;
            border: 1px solid #e5e5e5;
            padding: 20px
        }

        .item_quiz .txt_goiy {
            font-size: 14px
        }

        .item_quiz .tittle_quiz {
            font-family: "Merriweather", serif;
            font-size: 16px;
            font-weight: 700;
            color: #222;
            margin-bottom: 10px
        }

        .item_quiz .tittle_quiz .total-ques {
            color: #757575
        }

        .item_quiz .img_quiz img {
            width: 100%;
            float: left
        }

        .item_quiz .note_ans {
            font-size: 14px;
            margin-top: 5px
        }

        .item_quiz .btn_guidapan {
            text-decoration: none
        }

        .item_quiz .btn_guidapan:hover {
            color: #fff
        }

        .item_ans_quiz {
            margin-top: 10px
        }

        .item_ans_quiz .label_ans_quiz {
            cursor: pointer;
            border-radius: 3px;
            width: 100%;
            float: left;
            background: #f3f3f3;
            border: 1px solid #e5e5e5;
            padding: 5px 15px 5px 40px;
            position: relative
        }

        .item_ans_quiz .label_ans_quiz .text_ans {
            font-size: 17px;
            line-height: 20px;
            color: #222;
            position: relative
        }

        .item_ans_quiz .label_ans_quiz:hover,
        .item_ans_quiz .label_ans_quiz.active {
            background: #dedede
        }

        .item_ans_quiz .input_quiz {
            position: absolute;
            top: 13px;
            left: 15px
        }

        .item_no_input .item_ans_quiz .label_ans_quiz {
            padding-left: 15px
        }

        .item_no_input .item_ans_quiz .input_quiz {
            opacity: 0;
            visibility: hidden
        }

        .item_ans_result .label_ans_quiz {
            border: none;
            padding-right: 65px
        }

        .item_ans_result .result_bar {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            background: #51a732;
            border-radius: 3px;
            z-index: 0
        }

        .item_ans_result .result_bar .percent_ans {
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            background: #338d13;
            border-radius: 3px
        }

        .item_ans_result .label_ans_quiz .text_ans {
            color: #fff
        }

        .item_ans_result.wrong_ans .result_bar {
            background: #e18a8a
        }

        .item_ans_result.wrong_ans .result_bar .percent_ans {
            background: #cc4545
        }

        .item_ans_result.no-choice .result_bar {
            background: #ccc
        }

        .item_ans_result.no-choice .result_bar .percent_ans {
            background: #ccc
        }

        .item_ans_result.no-choice .label_ans_quiz .text_ans {
            color: #222
        }

        .item_ans_result .number_percent {
            width: 45px;
            height: 24px;
            background: #fff;
            border-radius: 100px;
            text-align: center;
            line-height: 24px;
            color: #4f4f4f;
            font-size: 14px;
            font-weight: 700;
            position: absolute;
            right: 10px;
            top: 50%;
            margin-top: -12px
        }

        .popup-zoom {
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            background: #000;
            z-index: 99999;
            opacity: 0;
            -webkit-transition-duration: 300ms;
            transition-duration: 300ms;
            -webkit-transition-property: all;
            transition-property: all;
            -webkit-transition-timing-function: cubic-bezier(.7, 1, .7, 1);
            transition-timing-function: cubic-bezier(.7, 1, .7, 1);
            visibility: hidden;
            transform: scale(.5);
            -webkit-transform: scale(.5)
        }

        .popup-zoom .close-zoom {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #424242;
            cursor: pointer;
            text-align: center;
            line-height: 40px;
            color: #bdbdbd;
            font-family: -webkit-body;
            font-size: 30px;
            z-index: 1
        }

        .popup-zoom .wrap-img-zoom {
            width: calc(100% - 240px);
            height: 100%;
            position: relative
        }

        .popup-zoom .img-zoom {
            max-width: 100%;
            max-height: 100%;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%)
        }

        .popup-zoom .wrap-caption-zoom {
            width: 240px;
            height: 100%;
            padding: 110px 20px 20px 20px;
            color: #e0e0e0;
            border-left: 1px solid #4f4f4f;
            font-size: 15px;
            line-height: 160%
        }

        .popup-zoom .wrap-caption-zoom p {
            margin-bottom: 20px
        }

        .popup-zoom.no-caption .wrap-img-zoom {
            width: 100%
        }

        .popup-zoom.no-caption .wrap-caption-zoom {
            display: none
        }

        .popup-zoom .inner-caption {
            max-height: calc(100% - 110px);
            overflow: hidden
        }

        .popup-zoom .inner-caption .ss-content {
            padding-right: 20px
        }

        .popup-zoom .inner-caption .ss-scroll {
            background: #424242
        }

        .show-zoom .popup-zoom {
            opacity: 1;
            visibility: visible;
            transform: scale(1);
            -webkit-transform: scale(1)
        }

        .fck_detail .paywall-paragraph-overlay {
            position: absolute;
            bottom: 15px;
            left: 0;
            width: 100%;
            height: 400px;
            background: -webkit-gradient(linear, left top, left bottom, color-stop(3.37%, rgba(252, 250, 246, 0)), color-stop(45.74%, #fcfaf6));
            background: linear-gradient(to bottom, rgba(252, 250, 246, 0) 3.37%, #fcfaf6 45.74%);
            background: -webkit-linear-gradient(top, rgba(252, 250, 246, 0) 3.37%, #fcfaf6 45.74%);
            font-size: 15px;
            display: block
        }

        .fck_detail a.paywall-readmore {
            position: absolute;
            bottom: 75px;
            left: 50%;
            margin-left: -187.5px;
            text-decoration: none;
            background: #fcfaf6;
            display: block;
            color: #076db6;
            width: 375px;
            text-align: center;
            padding: 9px 0;
            border-radius: 3px;
            border: 1px solid #e5e5e5;
            font-weight: bold;
            font-size: 15px
        }

        .fck_detail a.paywall-readmore:hover {
            background: #fff;
            border: 1px solid #e5e5e5
        }

        .fck_detail .paywall-preview {
            display: block
        }

        .fck_detail table.paywall-preview,
        .fck_detail table {
            display: table !important
        }

        .photo-dark .fck_detail .paywall-paragraph-overlay {
            background: -webkit-gradient(linear, left top, left bottom, color-stop(3.37%, rgba(252, 250, 246, 0)), color-stop(45.74%, #17191a));
            background: linear-gradient(to bottom, rgba(252, 250, 246, 0) 3.37%, #17191a 45.74%);
            background: -webkit-linear-gradient(top, rgba(252, 250, 246, 0) 3.37%, #17191a 45.74%)
        }

        .photo-dark .fck_detail a.paywall-readmore {
            border: 1px solid #4f4f4f;
            background: #17191a;
            color: #bdbdbd
        }

        .photo-dark .fck_detail a.paywall-readmore:hover {
            background: #222;
            color: #e5e5e5
        }

        .photo-dark .box-tinlienquanv2 {
            background: rgba(255, 255, 255, .05);
            border: 0;
            color: #fafafa
        }

        .photo-dark .box-tinlienquanv2 .item-news {
            border-bottom: 1px solid #757575
        }

        .photo-dark .box-tinlienquanv2 .item-news .title-news {
            color: #fafafa !important
        }

        .photo-dark .box-tinlienquanv2 .item-news .title-news a {
            color: #fafafa !important
        }

        .photo-dark .box-tinlienquanv2 .item-news .description {
            color: #fafafa !important
        }

        .photo-dark .box-tinlienquanv2 .item-news .description a {
            color: #fafafa !important
        }

        .photo-dark .box-tinlienquanv2 .item-news .description .count_cmt {
            color: #e66489 !important
        }

        .photo-dark .box-tinlienquanv2 .item-news:last-of-type {
            border-bottom: 0
        }

        .box-table-op1 {
            position: relative
        }

        .box-table-op1::before {
            content: "";
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0, rgba(255, 255, 255, 0)), color-stop(8.1%, rgba(255, 255, 255, .013)), color-stop(15.5%, rgba(255, 255, 255, .049)), color-stop(22.5%, rgba(255, 255, 255, .104)), color-stop(29%, rgba(255, 255, 255, .175)), color-stop(35.3%, rgba(255, 255, 255, .259)), color-stop(41.2%, rgba(255, 255, 255, .352)), color-stop(47.1%, rgba(255, 255, 255, .45)), color-stop(52.9%, rgba(255, 255, 255, .55)), color-stop(58.8%, rgba(255, 255, 255, .648)), color-stop(64.7%, rgba(255, 255, 255, .741)), color-stop(71%, rgba(255, 255, 255, .825)), color-stop(77.5%, rgba(255, 255, 255, .896)), color-stop(84.5%, rgba(255, 255, 255, .951)), color-stop(91.9%, rgba(255, 255, 255, .987)), to(#fff));
            background: linear-gradient(180deg, rgba(255, 255, 255, 0) 0, rgba(255, 255, 255, .013) 8.1%, rgba(255, 255, 255, .049) 15.5%, rgba(255, 255, 255, .104) 22.5%, rgba(255, 255, 255, .175) 29%, rgba(255, 255, 255, .259) 35.3%, rgba(255, 255, 255, .352) 41.2%, rgba(255, 255, 255, .45) 47.1%, rgba(255, 255, 255, .55) 52.9%, rgba(255, 255, 255, .648) 58.8%, rgba(255, 255, 255, .741) 64.7%, rgba(255, 255, 255, .825) 71%, rgba(255, 255, 255, .896) 77.5%, rgba(255, 255, 255, .951) 84.5%, rgba(255, 255, 255, .987) 91.9%, #fff);
            pointer-events: none;
            position: absolute;
            z-index: 1;
            width: 100%;
            height: 100px;
            bottom: 60px
        }

        .box-table-op1 .table-responsive {
            max-height: 400px;
            overflow: hidden;
            position: relative
        }

        .box-table-op1 table {
            width: 100%;
            background: #fff
        }

        .box-table-op1 .btn-loadmore {
            margin: 0 auto;
            text-align: center;
            clear: both;
            -webkit-transition: .5s all;
            transition: .5s all;
            width: 120px;
            margin-top: 20px
        }

        .box-table-op1 .btn-loadmore .view_all {
            background: #e5e5e5;
            border-radius: 100px;
            font-size: 16px;
            width: 120px;
            color: #757575;
            height: 40px;
            position: relative;
            line-height: 40px;
            text-align: center;
            display: inline-block;
            text-decoration: none;
            cursor: pointer
        }

        .box-table-op1 .btn-loadmore .view_all .ic {
            width: 14px;
            height: 14px;
            vertical-align: middle;
            margin: -4px 5px 0 0
        }

        .box-table-op1 .btn-loadmore .view_all .see svg {
            -webkit-transform: rotate(180deg);
            transform: rotate(180deg)
        }

        .box-table-op1 .btn-loadmore .view_all .collapse {
            display: none
        }

        .box-table-op1 .btn-loadmore .view_all.active .see {
            display: none
        }

        .box-table-op1 .btn-loadmore .view_all.active .collapse {
            display: block
        }

        .box-table-op1.show .table-responsive {
            max-height: 100%
        }

        .box-table-op1.show table {
            margin-bottom: 0
        }

        .box-table-op1.show::before {
            display: none
        }

        @media (max-width:600px) {
            .box-table-op1 .table-responsive {
                overflow-x: auto
            }
            .box-table-op1 table th,
            .box-table-op1 table td {
                white-space: nowrap
            }
        }
    </style>
    <link rel="preload" href="https://s1.vnecdn.net/vnexpress/restruct/c/v2847/v2_2019/pc/detail-file.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://s1.vnecdn.net/vnexpress/restruct/c/v2847/v2_2019/pc/detail-file.css" crossorigin="anonymous"></noscript>
    <link rel="stylesheet" href="https://s1.vnecdn.net/vnexpress/restruct/c/v2847/v2_2019/pc/thoisu.css" media="all">
    <style class="webfont" data-cache-name="Merriweather" data-cache-file-woff2="https://s1.vnecdn.net/vnexpress/restruct/c/v2847/v2_2019/pc/webfonts/Merriweather-woff2.css" data-cache-hash-woff2="fc2b038bec1f4b4d7dd2f8019a57a7ad" data-cache-file-woff="https://s1.vnecdn.net/vnexpress/restruct/c/v2847/v2_2019/pc/webfonts/Merriweather-woff.css"
        data-cache-hash-woff="cee538b68f8fa3400618e4a4f363a223" data-cache-file-ttf="https://s1.vnecdn.net/vnexpress/restruct/c/v2847/v2_2019/pc/webfonts/Merriweather-ttf.css" data-cache-hash-ttf="23fc73084560a7f6cc4057edce36ccd5"></style>
    <script type="text/javascript">
        var fallback = 'https://s1.vnecdn.net/vnexpress/restruct/c/v2847/v2_2019/pc/webfonts/fonts.css';
        var ua = navigator.userAgent;
        var isBot = (typeof navigator !== "undefined" && /headless/i.test(navigator.userAgent));
        var revisionCSS = 'v2847';
        var ES6 = 0;

        function loadFontsFromStorage() {
            try {
                var saveFont = function(fontName, fontHash, css) {
                    for (var i = 0, totalItems = localStorage.length; i < totalItems - 1; i++) {
                        var key = localStorage.key(i);
                        if (key.indexOf(fontStorageKey(fontName)) !== -1) {
                            localStorage.removeItem(key);
                            break
                        }
                    }
                    localStorage.setItem(fontStorageKey(fontName, fontHash), JSON.stringify({
                        value: css
                    }))
                };
                var fetchFont = function(url, el, fontName, fontHash) {
                    var xhr = new XMLHttpRequest;
                    this["guFont"] = function(fontData) {
                        return fontData.css
                    };
                    xhr.open("GET", url, true);
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            var css = xhr.responseText;
                            useFont(el, css, fontName);
                            saveFont(fontName, fontHash, css)
                        }
                    };
                    xhr.send()
                };
                var useFont = function(el, css, fontName) {
                    el.innerHTML = css
                };
                var fontStorageKey = function(fontName, fontHash) {
                    fontHash = fontHash === undefined ? "" : fontHash;
                    return "gu.fonts." + fontName + "." + fontHash
                };
                var fontFormat = function() {
                    var formatStorageKey = "gu.fonts.format";
                    var format = localStorage.getItem(formatStorageKey);

                    function supportsWoff2() {
                        if ("FontFace" in window) try {
                            var f = new window.FontFace("t", 'url("data:application/font-woff2,") format("woff2")', {});
                            f.load()["catch"](function() {});
                            if (f.status === "loading") return true
                        } catch (e) {}
                        if (!/edge\/([0-9]+)/.test(ua.toLowerCase())) {
                            var browser = /(chrome|firefox)\/([0-9]+)/.exec(ua.toLowerCase());
                            var supportsWoff2$0 = {
                                "chrome": 36,
                                "firefox": 39
                            };
                            return !!browser && supportsWoff2$0[browser[1]] < parseInt(browser[2], 10)
                        }
                        return false
                    }
                    if (/value/.test(format)) {
                        format = JSON.parse(format).value;
                        localStorage.setItem(formatStorageKey, format)
                    }
                    if (!format) {
                        format = supportsWoff2() ? "woff2" : ua.indexOf("android") > -1 ? "ttf" : "woff";
                        localStorage.setItem(formatStorageKey, format)
                    }
                    return format
                }();
                var fonts = document.querySelectorAll(".webfont");
                var urlAttribute = "data-cache-file-" + fontFormat;
                var hashAttribute = "data-cache-hash-" + fontFormat;
                var nameAttribute = "data-cache-name";
                for (var i = 0, j = fonts.length; i < j; ++i) {
                    var font = fonts[i];
                    var fontURL = font.getAttribute(urlAttribute);
                    var fontName = font.getAttribute(hashAttribute);;
                    var fontHash = font.getAttribute(nameAttribute);;
                    var fontData = localStorage.getItem(fontStorageKey(fontName, fontHash));
                    if (fontData) useFont(font, JSON.parse(fontData).value, fontName);
                    else fetchFont(fontURL, font, fontName, fontHash)
                }
                return true
            } catch (e) {}
            return false
        }

        function loadFontsAsynchronously() {
            try {
                var scripts = document.getElementsByTagName("script");
                var thisScript = scripts[scripts.length - 1];
                var fonts = document.createElement("link");
                fonts.rel = "stylesheet";
                fonts.className = "webfonts";
                fonts.href = fallback;
                window.setTimeout(function() {
                    thisScript.parentNode.insertBefore(fonts, thisScript)
                })
            } catch (e) {}
        }
    </script>
    <script>
        if (('serviceWorker' in navigator) && isBot === false) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/sw-production.js');
            });
        }
    </script>
    <script>
        ! function(e) {
            "use strict";
            var t = function(t, n, r) {
                function o() {
                    i.addEventListener && i.removeEventListener("load", o), i.media = r || "all"
                }
                var a, l = e.document,
                    i = l.createElement("link");
                if (n) a = n;
                else {
                    var d = (l.body || l.getElementsByTagName("head")[0]).childNodes;
                    a = d[d.length - 1]
                }
                var s = l.styleSheets;
                i.rel = "stylesheet", i.href = t, i.media = "only x",
                    function e(t) {
                        if (l.body) return t();
                        setTimeout(function() {
                            e(t)
                        })
                    }(function() {
                        a.parentNode.insertBefore(i, n ? a : a.nextSibling)
                    });
                var u = function(e) {
                    for (var t = i.href, n = s.length; n--;)
                        if (s[n].href === t) return e();
                    setTimeout(function() {
                        u(e)
                    })
                };
                return i.addEventListener && i.addEventListener("load", o), i.onloadcssdefined = u, u(o), i
            };
            "undefined" != typeof exports ? exports.loadCSS = t : e.loadCSS = t
        }("undefined" != typeof global ? global : this),
        function(e) {
            if (e.loadCSS) {
                var t = loadCSS.relpreload = {};
                if (t.support = function() {
                        try {
                            return e.document.createElement("link").relList.supports("preload")
                        } catch (e) {
                            return !1
                        }
                    }, t.poly = function() {
                        for (var t = e.document.getElementsByTagName("link"), n = 0; n < t.length; n++) {
                            var r = t[n];
                            "preload" === r.rel && "style" === r.getAttribute("as") && (e.loadCSS(r.href, r, r.getAttribute("media")), r.rel = null)
                        }
                    }, !t.support()) {
                    t.poly();
                    var n = e.setInterval(t.poly, 300);
                    e.addEventListener && e.addEventListener("load", function() {
                        t.poly(), e.clearInterval(n)
                    }), e.attachEvent && e.attachEvent("onload", function() {
                        e.clearInterval(n)
                    })
                }
            }
        }(this);
        var sanitizeSVG = function(svgText) {
            if (typeof window === 'undefined') {
                return '';
            }
            if (!svgText) {
                return '';
            }
            var svgDisallowed = ['a', 'animate', 'color-profile', 'cursor', 'discard', 'fedropshadow', 'font-face', 'font-face-format', 'font-face-name', 'font-face-src', 'font-face-uri', 'foreignobject', 'hatch', 'hatchpath', 'mesh', 'meshgradient', 'meshpatch', 'meshrow', 'missing-glyph', 'script', 'set', 'solidcolor', 'unknown', 'use'];
            var playground = window.document.createElement('template');
            playground.innerHTML = svgText;
            var svgEl = playground.content.firstElementChild;
            if (!svgEl) {
                return '';
            }
            var attributes = [];
            var svgElAttributes = svgEl.attributes;
            for (var i = 0; i < svgElAttributes.length; i++) {
                attributes.push(svgElAttributes[i].name);
            }
            var hasScriptAttr = !!attributes.find(function(attr) {
                return attr.startsWith('on');
            });
            var disallowedSvgElements = svgEl.querySelectorAll(svgDisallowed.join(','));
            return disallowedSvgElements.length === 0 && !hasScriptAttr ? svgText : '';
        };
        var fetchSVG = function(filepath, name) {
            if (!document.createElementNS || !document.createElementNS('http://www.w3.org/2000/svg', 'svg').createSVGRect) {
                return true;
            }
            var file = filepath;
            var suffix = name != null ? '_' + name : '';
            var keyName = 'inlineSVGdata' + suffix;
            var keyRev = 'inlineSVGrev' + suffix;
            if (typeof filepath === 'undefined' || filepath === null) {
                file = css_url_vne + '/v2_2019/pc/images/graphics/icon-vne.svg';
            }
            var isLocalStorage = window.supportLS,
                request, data, insertIT = function() {
                    document.body.insertAdjacentHTML('afterbegin', data);
                    removeTitle();
                },
                insert = function() {
                    if (document.body) insertIT();
                    else document.addEventListener('DOMContentLoaded', insertIT);
                },
                removeTitle = function() {
                    var svg = document.querySelectorAll('svg symbol');
                    if (svg != null) {
                        for (var i = 0; i < svg.length; ++i) {
                            var el = svg[i].querySelector('title');
                            if (el != null) el.parentNode.removeChild(el);
                        }
                    }
                };
            if (isLocalStorage && localStorage.getItem(keyRev) == revisionCSS) {
                data = sanitizeSVG(localStorage.getItem(keyName));
                if (data) {
                    insert();
                    return true;
                }
            }
            try {
                request = new XMLHttpRequest();
                request.open('GET', file, true);
                request.onload = function() {
                    if (request.status >= 200 && request.status < 400) {
                        data = sanitizeSVG(request.responseText);
                        if (data) {
                            insert();
                            if (isLocalStorage) {
                                localStorage.setItem(keyName, data);
                                localStorage.setItem(keyRev, revisionCSS);
                            }
                        }
                    }
                }
                request.send();
            } catch (e) {}
        }
        if (isBot === false) {
            if (window.supportLS) {
                loadFontsFromStorage();
            } else {
                loadFontsAsynchronously();
            }
            fetchSVG();
            fetchSVG(css_url_vne + '/v2_2019/pc/weather/icon-demo/weather/icon-weather.svg', 'weather');
        }
    </script>
    <script type="text/javascript">
        var list_box_gt = {
            "phimdecu": {
                "code": 200,
                "data": [{
                    "title": "Nh\u00e0 tr\u1ecd Balanha",
                    "share_url": "\/nha-tro-balanha-tieng-cuoi-tu-su-khon-kho-4076174.html",
                    "thumbnail_url": "https:\/\/i-giaitri.vnecdn.net\/2020\/04\/02\/nha-tro-balanha-1585829180-2009-1585829236.jpg",
                    "thumb_list": {
                        "thumb_300_180_100_1_crop": "https:\/\/i1-giaitri.vnecdn.net\/2020\/04\/02\/nha-tro-balanha-1585829180-2009-1585829236.jpg?w=300&h=180&q=100&dpr=1&fit=crop&s=QmQy3LaS-ZdvKJ-ZY3IPYQ",
                        "thumb_300_180_100_2_crop": "https:\/\/i1-giaitri.vnecdn.net\/2020\/04\/02\/nha-tro-balanha-1585829180-2009-1585829236.jpg?w=300&h=180&q=100&dpr=2&fit=crop&s=HRCG3dc3W3K-0V9xxrLsXw"
                    }
                }, {
                    "title": "Th\u1ebf gi\u1edbi h\u00f4n nh\u00e2n",
                    "share_url": "\/ly-do-phim-19-the-gioi-hon-nhan-gay-sot-4095614.html",
                    "thumbnail_url": "https:\/\/i-giaitri.vnecdn.net\/2020\/05\/13\/The-gioi-hon-nhan-1589354805.jpg",
                    "thumb_list": {
                        "thumb_300_180_100_1_crop": "https:\/\/i1-giaitri.vnecdn.net\/2020\/05\/13\/The-gioi-hon-nhan-1589354805.jpg?w=300&h=180&q=100&dpr=1&fit=crop&s=E6uztpUxajUiuOzuyzP6aw",
                        "thumb_300_180_100_2_crop": "https:\/\/i1-giaitri.vnecdn.net\/2020\/05\/13\/The-gioi-hon-nhan-1589354805.jpg?w=300&h=180&q=100&dpr=2&fit=crop&s=TAwzQSOWZ4c4o3fk31n8TQ"
                    }
                }, {
                    "title": "Ho\u1ea1t \u0111\u1ed9ng ngo\u1ea1i kh\u00f3a",
                    "share_url": "\/extracurricular-series-ve-the-gioi-mai-dam-4095160.html",
                    "thumbnail_url": "https:\/\/i-giaitri.vnecdn.net\/2020\/05\/13\/Hoat-dong-ngoai-khoa-Extracurricular-1589354804.jpg",
                    "thumb_list": {
                        "thumb_300_180_100_1_crop": "https:\/\/i1-giaitri.vnecdn.net\/2020\/05\/13\/Hoat-dong-ngoai-khoa-Extracurricular-1589354804.jpg?w=300&h=180&q=100&dpr=1&fit=crop&s=MD6uH0P4vcDyrg_w6coJpw",
                        "thumb_300_180_100_2_crop": "https:\/\/i1-giaitri.vnecdn.net\/2020\/05\/13\/Hoat-dong-ngoai-khoa-Extracurricular-1589354804.jpg?w=300&h=180&q=100&dpr=2&fit=crop&s=S53yEn5w9mcoodezosh36w"
                    }
                }, {
                    "title": "Into the Night",
                    "share_url": "javascript:;",
                    "thumbnail_url": "https:\/\/i-giaitri.vnecdn.net\/2020\/05\/13\/Into-The-Night-1589354805.jpg",
                    "thumb_list": {
                        "thumb_300_180_100_1_crop": "https:\/\/i1-giaitri.vnecdn.net\/2020\/05\/13\/Into-The-Night-1589354805.jpg?w=300&h=180&q=100&dpr=1&fit=crop&s=y5iMOlqu5tQWVE2dnC9PNQ",
                        "thumb_300_180_100_2_crop": "https:\/\/i1-giaitri.vnecdn.net\/2020\/05\/13\/Into-The-Night-1589354805.jpg?w=300&h=180&q=100&dpr=2&fit=crop&s=i-P0hnaBdRUAqcbpViYiRA"
                    }
                }, {
                    "title": "Nh\u1eefng ng\u00e0y kh\u00f4ng qu\u00ean",
                    "share_url": "\/nhung-ngay-khong-quen-tieng-cuoi-thoi-dich-4086344.html",
                    "thumbnail_url": "https:\/\/i-giaitri.vnecdn.net\/2020\/05\/13\/Nhung-ngay-khong-quen-1589354805.jpg",
                    "thumb_list": {
                        "thumb_300_180_100_1_crop": "https:\/\/i1-giaitri.vnecdn.net\/2020\/05\/13\/Nhung-ngay-khong-quen-1589354805.jpg?w=300&h=180&q=100&dpr=1&fit=crop&s=3qj-OEii6SO4tkpFLRuIuA",
                        "thumb_300_180_100_2_crop": "https:\/\/i1-giaitri.vnecdn.net\/2020\/05\/13\/Nhung-ngay-khong-quen-1589354805.jpg?w=300&h=180&q=100&dpr=2&fit=crop&s=nZmGElMr4W92etFMvrqDwg"
                    }
                }, {
                    "title": "Bad Education",
                    "share_url": "\/loat-phim-truc-tuyen-noi-bat-thang-4-4078260.html",
                    "thumbnail_url": "https:\/\/i-giaitri.vnecdn.net\/2020\/05\/13\/Bad-Education-1589354804.jpg",
                    "thumb_list": {
                        "thumb_300_180_100_1_crop": "https:\/\/i1-giaitri.vnecdn.net\/2020\/05\/13\/Bad-Education-1589354804.jpg?w=300&h=180&q=100&dpr=1&fit=crop&s=eMVOsD8BzhCzMqQdFbF7XA",
                        "thumb_300_180_100_2_crop": "https:\/\/i1-giaitri.vnecdn.net\/2020\/05\/13\/Bad-Education-1589354804.jpg?w=300&h=180&q=100&dpr=2&fit=crop&s=Chqqf7p_osnju2eBeBsFdw"
                    }
                }]
            },
            "hottopic": {
                "ids": "13328,24605,22465,23636"
            }
        }
    </script>
    <!-- VIDEO VOD SCRIPT -->
    <script src="https://s1.vnecdn.net/vnexpress/restruct/j/v6055/v3/production/vod.js" async></script>
    <!-- END VIDEO VOD SCRIPT -->
    <meta name="facebook-domain-verification" content="wvm97b5u7iqh99xtqcj81z0955s2ha" />
</head>

<body class="" data-source="Detail-TheGioi_PhanTich-4775017" id="dark_theme">
    <div id="_ads_bg_top" class="lazier"></div>
    <header class="section top-header" data-campaign="Header">
        <div class="container ">
            <a href="javascript:;" class="all-menu all-menu-tablet"><span class="hamburger"></span></a>
            <a href="/" data-medium="Logo" class="logo" title="Báo VnExpress - Báo tiếng Việt nhiều người xem nhất" onclick="trackingLogoHome('logo-header', this.href)">
<img src="https://s1.vnecdn.net/vnexpress/restruct/i/v921/v2_2019/pc/graphics/logo.svg" alt="VnExpress - Bao tieng Viet nhieu nguoi xem nhat">
</a>
<?php
date_default_timezone_set('Asia/Ho_Chi_Minh'); // Thiết lập múi giờ Việt Nam
$dayOfWeek = array(
    'Sunday' => 'Chủ nhật',
    'Monday' => 'Thứ hai',
    'Tuesday' => 'Thứ ba',
    'Wednesday' => 'Thứ tư',
    'Thursday' => 'Thứ năm',
    'Friday' => 'Thứ sáu',
    'Saturday' => 'Thứ bảy'
);

$currentDay = date('l'); // Lấy ngày hiện tại bằng tiếng Anh
$dayInVietnamese = $dayOfWeek[$currentDay]; // Chuyển đổi ngày sang tiếng Việt
$currentDate = date('d/m/Y'); // Lấy ngày hiện tại theo định dạng dd/mm/yyyy

echo '<span class="time-now">' . $dayInVietnamese . ', ' . $currentDate . '</span>';
?>

            <div class="right">
                <!--<div id="_topLive" class=""></div>-->
                <a href="/tin-tuc-24h" class="btn24hqua " title="Mới nhất" data-campaign="menu-MoiNhat" data-medium="Item-MoiNhat">
                    <!-- <svg class="ic ic-24h"><use xlink:href="#time"></use></svg> -->
                    Mới nhất
                </a>
                <div class="news-area">
                    <span class="txt-area">
<!-- <span class="dot-blue dot-region-news hidden"></span> -->
                    <!-- <svg width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M10 7C10 8.65685 8.65685 10 7 10C5.34315 10 4 8.65685 4 7C4 5.34315 5.34315 4 7 4C8.65685 4 10 5.34315 10 7ZM9 7C9 5.89543 8.10457 5 7 5C5.89543 5 5 5.89543 5 7C5 8.10457 5.89543 9 7 9C8.10457 9 9 8.10457 9 7ZM11.9497 11.955C14.6834 9.2201 14.6834 4.78601 11.9497 2.05115C9.21608 -0.683716 4.78392 -0.683716 2.05025 2.05115C-0.683418 4.78601 -0.683418 9.2201 2.05025 11.955L3.57128 13.4538L5.61408 15.4389L5.74691 15.5567C6.52168 16.1847 7.65623 16.1455 8.38611 15.4391L10.8223 13.0691L11.9497 11.955ZM2.75499 2.75619C5.09944 0.410715 8.90055 0.410715 11.245 2.75619C13.5294 5.04153 13.5879 8.71039 11.4207 11.0667L11.245 11.2499L9.92371 12.5539L7.69315 14.7225L7.60016 14.8021C7.24594 15.0699 6.7543 15.0698 6.40012 14.802L6.30713 14.7224L3.3263 11.817L2.75499 11.2499L2.57927 11.0667C0.412077 8.71039 0.47065 5.04153 2.75499 2.75619Z" fill="#9F9F9F"></path>
							</svg> -->
                    Tin theo khu vực
                    </span>
                    <!-- <div class="hint-area hint-region-news hidden">
							Trang tin về 
																															<strong>
										<a href="https://vnexpress.net/topic/ha-noi-26482" title="Hà Nội" class="gaBoxLinkDisplay" data-event-category="Article Link Display" data-event-action="Detail-TheGioi_PhanTich-4775017-Item-TinKhuVuc_Hint_Desktop" data-event-label="Item-1">Hà Nội</a>
									</strong>
									và									
																	<strong>
										<a href="https://vnexpress.net/topic/tp-ho-chi-minh-26483" title="TP Hồ Chí Minh" class="gaBoxLinkDisplay" data-event-category="Article Link Display" data-event-action="Detail-TheGioi_PhanTich-4775017-Item-TinKhuVuc_Hint_Desktop" data-event-label="Item-2">TP Hồ Chí Minh</a>
									</strong>
																		
																						<span class="close-hint gaBoxLinkDisplay" data-event-category="Article Link Click" data-event-action="Detail-TheGioi_PhanTich-4775017-Item-TinKhuVuc_Hint_Desktop" data-event-label="Button-Close">×</span>
						</div> -->
                    <ul class="sub-area">
                        <li><a href="https://vnexpress.net/topic/ha-noi-26482" title="Hà Nội" data-medium="Item-TinKhuVuc_HaNoi">Hà Nội</a></li>
                        <li><a href="https://vnexpress.net/topic/tp-ho-chi-minh-26483" title="TP Hồ Chí Minh" data-medium="Item-TinKhuVuc_TPHoChiMinh">TP Hồ Chí Minh</a></li>
                    </ul>
                </div>
                <a href="https://e.vnexpress.net/" class="evne" title="VnExpress International" data-campaign="menu-English" data-medium="Item-English"><svg class="ic ic-evne"><use xlink:href="#letter-E"></use></svg>International</a>
                <form class="search search-vne" action="https://timkiem.vnexpress.net" id="formSearchHeader">
                    <input id="keywordHeader" type="text" name="q" placeholder="Tìm kiếm" autocomplete="off">
                    <button type="submit" title="Tìm kiếm" class="btn-search-vne" id="buttonSearchHeader"><svg class="ic ic-search"><use xlink:href="#Search"></use></svg></button>
                </form>
                <a href="/myvne" title="" class="menu-myvn" data-medium="Logo-myvne">
<img src="https://s1.vnecdn.net/vnexpress/restruct/c/v2847/v2_2019/pc/images/graphics/menu-myvne.svg" alt="">
</a>
                <div id="myvne_taskbar"></div>
            </div>
        </div>
    </header>
    <section class="section wrap-main-nav" id="wrap-main-nav" data-campaign="Header">
        <nav class="main-nav">
            <ul class="parent">
                <li class="home">
                    <a href="/" class="flexbox" title="Trang chủ" data-medium="Menu-Home" onclick="trackingLogoHome('logo-header-menu', this.href)">
<svg class="ic ic-home"><use xlink:href="#Home"></use></svg>
<svg class="ic ic-evne"><use xlink:href="#letter-E"></use></svg>
</a>
                </li>
                <li class="newlest"><a data-medium="Menu-MoiNhat" href="/tin-tuc-24h" title="Mới nhất">Mới nhất</a></li>
                <li class="thoisu" data-id="1001005">
                    <a title="Thời sự" href="/thoi-su" data-medium="Menu-ThoiSu">
Thời sự </a>
                </li>
                <li class="gocnhin" data-id="1003450">
                    <a title="Góc nhìn" href="/goc-nhin" data-medium="Menu-GocNhin">
Góc nhìn </a>
                </li>
                <li class="thegioi active" data-id="1001002">
                    <a title="Thế giới" href="/the-gioi" data-medium="Menu-TheGioi">
Thế giới </a>
                </li>
                <li class="video" data-id="1003834">
                    <a title="Video" href="https://video.vnexpress.net" data-medium="Menu-Video">
Video </a>
                </li>
                <li class="podcasts" data-id="1004685">
                    <a title="Podcasts" href="/podcast" data-medium="Menu-Podcasts">
Podcasts </a>
                </li>
                <li class="kinhdoanh" data-id="1003159">
                    <a title="Kinh doanh" href="/kinh-doanh" data-medium="Menu-KinhDoanh">
Kinh doanh </a>
                </li>
                <li class="batdongsan" data-id="1005628">
                    <a title="Bất động sản" href="/bat-dong-san" data-medium="Menu-BatDongSan">
Bất động sản </a>
                </li>
                <li class="khoahoc" data-id="1001009">
                    <a title="Khoa học" href="/khoa-hoc" data-medium="Menu-KhoaHoc">
Khoa học </a>
                </li>
                <li class="giaitri" data-id="1002691">
                    <a title="Giải trí" href="/giai-tri" data-medium="Menu-GiaiTri">
Giải trí </a>
                </li>
                <li class="thethao" data-id="1002565">
                    <a title="Thể thao" href="/the-thao" data-medium="Menu-TheThao">
Thể thao </a>
                </li>
                <li class="phapluat" data-id="1001007">
                    <a title="Pháp luật" href="/phap-luat" data-medium="Menu-PhapLuat">
Pháp luật </a>
                </li>
                <li class="giaoduc" data-id="1003497">
                    <a title="Giáo dục" href="/giao-duc" data-medium="Menu-GiaoDuc">
Giáo dục </a>
                </li>
                <li class="suckhoe" data-id="1003750">
                    <a title="Sức khỏe" href="/suc-khoe" data-medium="Menu-SucKhoe">
Sức khỏe </a>
                </li>
                <li class="doisong" data-id="1002966">
                    <a title="Đời sống" href="/doi-song" data-medium="Menu-DoiSong">
Đời sống </a>
                </li>
                <li class="dulich" data-id="1003231">
                    <a title="Du lịch" href="/du-lich" data-medium="Menu-DuLich">
Du lịch </a>
                </li>
                <li class="sohoa" data-id="1002592">
                    <a title="Số hóa" href="/so-hoa" data-medium="Menu-SoHoa">
Số hóa </a>
                </li>
                <li class="xe" data-id="1001006">
                    <a title="Xe" href="/oto-xe-may" data-medium="Menu-Xe">
Xe </a>
                </li>
                <li class="ykien" data-id="1001012">
                    <a title="Ý kiến" href="/y-kien" data-medium="Menu-YKien">
Ý kiến </a>
                </li>
                <li class="tamsu" data-id="1001014">
                    <a title="Tâm sự" href="/tam-su" data-medium="Menu-TamSu">
Tâm sự </a>
                </li>
                <li class="all-menu has_transition"><a href="javascript:;">Tất cả <span class="hamburger"></span></a></li>
            </ul>
        </nav>
        <section class="wrap-all-menu"></section>
    </section>
    <section class="section"></section>
    <!--end header-->
    <!--main_menu menu PC-->
    <section class="section center" id="sync_bgu_and_masthead" style="display:none">
        <div id='sis_bgu'>
            <script>
                try {
                    googTagCode.display.push('sis_bgu');
                } catch (e) {}
            </script>
        </div>
    </section>
    <!-- CONTENT  -->
    <section class="section page-detail top-detail " data-component-config='{"type":"text","article_id":4775017}'>
        <div class="container">
            <div class="social_pin">
                <ul class="social_left">
                    <li><a href="javascript:;" class="social_fb flexbox btn_share" data-type="fb" rel="nofollow" title="Chia sẻ bài viết lên facebook"><svg class="ic ic-facebook"><use xlink:href="#Facebook"></use></svg></a></li>
                    <li><a href="javascript:;" class="social_twit flexbox btn_share get-link-bitly" data-type="tw" rel="nofollow" data-url="https://vnexpress.net/vu-tap-kich-rocket-co-the-cham-ngoi-chien-tranh-israel-hezbollah-4775017.html" title="Chia sẻ bài viết lên twitter"><svg class="ic ic-twitter"><use xlink:href="#Twitter"></use></svg></a></li>
                    <li><a href="javascript:;" class="social_in flexbox btn_share" data-type="in" rel="nofollow" data-url="https://vnexpress.net/vu-tap-kich-rocket-co-the-cham-ngoi-chien-tranh-israel-hezbollah-4775017.html" data-desc="Dù Israel và Hezbollah đều muốn tránh kịch bản xung đột toàn diện, vụ tập kích rocket khiến 12 trẻ thiệt mạng có thể thổi bùng cuộc chiến tổng lực."
                            title="Chia sẻ bài viết lên Linkedin"><svg class="ic ic-linkedin"><use xlink:href="#Linkedin"></use></svg></a></li>
                    <li class="myvne_save_for_later" data-token="2a38dcf7a64925f29070c50f36ab3a4b" data-article-id="4775017" title="Lưu bài viết"></li>
                    <li class="li_comment"><a href="#box_comment_vne" class="social_comment flexbox" title="Bình luận"><svg class="ic ic-comment"><use xlink:href="#Comment-Reg"></use></svg><span class="number_cmt txt_num_comment num_cmt_detail" data-type="comment" data-objecttype="1" data-objectid="4775017"></span></a></li>
                    <li><a href="javascript:;" class="social_print flexbox print_content" title="In"><i class="ic ic-print"></i></a></li>
                </ul>
            </div>
            <div class="sidebar-1">
                <div class="header-content width_common">
                <ul class="breadcrumb" data-campaign="Header">
<li><a data-medium="Menu-TheGioi" href="#" title="Thế giới" data-itm-source="#vn_source=Detail-TheGioi_PhanTich-4775017&amp;vn_campaign=Header&amp;vn_medium=Menu-TheGioi&amp;vn_term=Desktop" data-itm-added="1">Thế giới</a></li><li><a data-medium="Menu-PhanTich" href="#" title="Phân tích" data-itm-source="#vn_source=Detail-TheGioi_PhanTich-4775017&amp;vn_campaign=Header&amp;vn_medium=Menu-PhanTich&amp;vn_term=Desktop" data-itm-added="1">Phân tích</a></li>	<span id="parentCateDetail" data-cate="1001142"></span>
<span id="site-sub-id" data-cate="1001142"></span>
</ul>
                    <span class="date">
                    <?php
$date = new DateTime($news['created_at']);
$daysOfWeek = ['Chủ nhật', 'Thứ hai', 'Thứ ba', 'Thứ tư', 'Thứ năm', 'Thứ sáu', 'Thứ bảy'];
$dayOfWeek = $daysOfWeek[$date->format('w')]; // Lấy tên ngày trong tuần bằng tiếng Việt
echo $dayOfWeek . ', ' . $date->format('d/m/Y');
?>

                    </span>
                </div>
                <h1 class="title-detail"><?php echo $news['title']; ?> </h1>
                <!-- show vote button-->
                <!-- end show vote button-->
                <article class="fck_detail ">
                <?php echo htmlspecialchars_decode($news['content']); ?>
                            <!-- Hope -->
                            <!-- End Hope -->
                </article>
                <!-- show vote button-->
                <!-- end show vote button-->
                <div class="footer-content  width_common">
                    <div class="myvne_save_for_later" data-token="2a38dcf7a64925f29070c50f36ab3a4b" data-article-id="4775017" title="Lưu bài viết"></div>
                    <div class="social">
                        <a href="javascript:;" class="fb btn_share" data-type="fb" rel="nofollow" title="Chia sẻ bài viết lên facebook">
<svg class="ic ic-facebook"><use xlink:href="#Facebook"></use></svg>
</a>
                        <a href="javascript:;" onclick="window.open('https://mail.google.com/mail/u/0/?view=cm&fs=1&tf=1&su=V%E1%BB%A5+t%E1%BA%ADp+k%C3%ADch+rocket+c%C3%B3+th%E1%BB%83+ch%C3%A2m+ng%C3%B2i+chi%E1%BA%BFn+tranh+Israel+-+Hezbollah&body=https%3A%2F%2Fvnexpress.net%2Fvu-tap-kich-rocket-co-the-cham-ngoi-chien-tranh-israel-hezbollah-4775017.html', '_blank')"
                            class="mail" rel="nofollow" title="Mail">
<svg class="ic ic-email"><use xlink:href="#Mail"></use></svg>
</a>
                        <a href="javascript:;" class="share-link btn_copy" rel="nofollow" title="Copy link">
<svg class="ic ic-link"><use xlink:href="#Link"></use></svg>
<span class="tip" style="display: none;">Copy link thành công</span>
</a>
                    </div>
                </div>
                <div id="_detail_topic" class="lazier"></div>
            </div>
            <div class="popup-zoom flexbox">
                <span class="close-zoom">&times;</span>
                <div class="wrap-img-zoom"><img src="" class="img-zoom"></div>
                <div class="wrap-caption-zoom"></div>
            </div>
            <div class="sidebar-2 col-sticky">
                <div class="width_common wrapper-sticky">
                    <div class="inner-wrap-sticky" style="position: relative;">
                        <div class="box-category">
                            <div class="banner-ads">
                                <div data-id="large_1" id="sis_large1">
                                    <script>
                                        googTagCode.display.push("sis_large1");
                                    </script>
                                </div>
                            </div>
                        </div>
                        <div id="_detail_blockRight" class="lazier" style="height: 100%"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section page-detail middle-detail">
        <div class="container">
            <div class="sidebar-1 pin-comment">
            </div>
            <div class="sidebar-2">
            </div>
        </div>
    </section>
    <section class="section page-detail bottom-detail">
        <div class="container">
            <div id="_detail_cungChuyenMuc" class="lazier"></div>
            <div id="_detail_quantam" class="lazier"></div>
            <div class="box-category__list-news">
                <div class="sidebar-1 pin-comment">
                    <div id="_detail_top_ykien" class="lazier"></div>
                    <!-- <div id="_detail_tinLienQuan" class="lazier"></div> -->
                    <div class="section-comment">
                        <div id="box_comment_vne" data-component="true" data-component-type="comment_library" class="box_comment_vne box_category width_common" data-component-runtime="js" data-component-function="showComment" data-component-input='{"type":"comment","article_id":4775017,"article_type":1,"site_id":1000000,"category_id":1001142,"sign":"f9967b37850db46683bbd25da2388e27","limit":24,"tab_active":"most_like","reactions":{"funny":"1"}}'>
                        </div>
                    </div>
                    <div id="_detail_listtag" class="lazier"></div>
                    <div class="detail_cooking"></div>
                    <div id="_detail_listmyvne" class="lazier"></div>
                    <div id="_detail_cungchuyenmuc" class="lazier"></div>
                    <div id="_detail_danhchoban" class="lazier"></div>
                    <div id="_detail_topnew" class="lazier"></div>
                </div>
                <div class="sidebar-2">
                    <div id="_detail_blockRight_2" class="lazier" style="height: 100%"></div>
                    <div id="_detail_blockRight_3" class="lazier"></div>
                </div>
            </div>
            <div id="_box_danhchoban" class="lazier"></div>
            <div class="width_common inner-box-business">
                <div id="_box_business" class="lazier"></div>
                <!-- Fshop -->
                <div class="container fs_box">
                    <div>
                        <div id="_detail_bottom_fshop" class="lazier"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section page-detail bottom-detail">
        <div class="container flexbox">
            <div id='rich-media-banner-ads'>
                <div id='sis_richmedia'>
                    <script>
                        try {
                            googTagCode.display.push('sis_richmedia')
                        } catch (e) {};
                    </script>
                </div>
            </div>
            <div id="OverLapHiden" style="width:100%; height:100%; left:0px; top:0px; position:fixed; display:none; background-color:rgb(0, 0, 0); opacity:0.6; z-index:5000001;"></div>
            <div id="_detail_bottom" class="lazier" style="height: 100%"></div>
        </div>
    </section>
    <style>
        .fck_detail>.thumb {
            height: auto
        }

        .box_quangcao .Normal {
            clear: none
        }

        .box_quangcao>div.block_image_news>div.thumb>figure>div.fig-picture>picture>img {
            left: 0 !important
        }
    </style>
    <!-- END CONTENT  -->
    <!-- FOOTER -->
    <div id="sis_slider">
        <script>
            try {
                googTagCode.display.push("sis_slider");
            } catch (e) {
                console.log(e);
            }
        </script>
    </div>
    <div id="_footer" class="lazier"></div>
    <footer class="footer container" data-component-runtime="js" data-component-function="initLayout" data-component-input="{}" id="wrapper_footer" data-campaign="Footer"></footer>
    <script type="text/javascript">
        var scriptFooterArr = ["https:\/\/s1.vnecdn.net\/vnexpress\/restruct\/j\/v6055\/v3\/production\/wpn.js", "https:\/\/s1.vnecdn.net\/vnexpress\/restruct\/j\/v6055\/v3\/production\/modules\/detail.defer.js"];
        var scriptFooterIS = function(scripts, itv) {
            if (window.lazyReady === true) {
                if (typeof itv !== 'undefined') {
                    clearInterval(itv);
                }
                for (var f = 0; f < scripts.length; f++) {
                    addScripts(scripts[f], false);
                }
                return true;
            } else {
                return false;
            }
        }
        window.addEventListener('DOMContentLoaded', function() {
            if (scriptFooterIS(scriptFooterArr) === false) {
                var checkReady = setInterval(function() {
                    scriptFooterIS(scriptFooterArr, checkReady);
                }, 100);
                setTimeout(function() {
                    clearInterval(checkReady);
                }, 5000);
            }
        });
    </script>
    <a href="javascript:;" id="to_top" title="Lên đầu trang"><svg class="ic ic-arrow-up"><use xlink:href="#Arrow-Up-1"></use></svg></a>
    <script>
        ! function(a) {
            "use strict";
            var b = function(b, c, d) {
                function j(a) {
                    if (e.body) return a();
                    setTimeout(function() {
                        j(a)
                    })
                }

                function l() {
                    f.addEventListener && f.removeEventListener("load", l), f.media = d || "all"
                }
                var g, e = a.document,
                    f = e.createElement("link");
                if (c) g = c;
                else {
                    var h = (e.body || e.getElementsByTagName("head")[0]).childNodes;
                    g = h[h.length - 1]
                }
                var i = e.styleSheets;
                f.rel = "stylesheet", f.href = b, f.media = "only x", j(function() {
                    g.parentNode.insertBefore(f, c ? g : g.nextSibling)
                });
                var k = function(a) {
                    for (var b = f.href, c = i.length; c--;)
                        if (i[c].href === b) return a();
                    setTimeout(function() {
                        k(a)
                    })
                };
                return f.addEventListener && f.addEventListener("load", l), f.onloadcssdefined = k, k(l), f
            };
            "undefined" != typeof exports ? exports.loadCSS = b : a.loadCSS = b
        }("undefined" != typeof global ? global : this);
        ! function(a) {
            if (a.loadCSS) {
                var b = loadCSS.relpreload = {};
                if (b.support = function() {
                        try {
                            return a.document.createElement("link").relList.supports("preload")
                        } catch (a) {
                            return !1
                        }
                    }, b.poly = function() {
                        for (var b = a.document.getElementsByTagName("link"), c = 0; c < b.length; c++) {
                            var d = b[c];
                            "preload" === d.rel && "style" === d.getAttribute("as") && (a.loadCSS(d.href, d, d.getAttribute("media")), d.rel = null)
                        }
                    }, !b.support()) {
                    b.poly();
                    var c = a.setInterval(b.poly, 300);
                    a.addEventListener && a.addEventListener("load", function() {
                        b.poly(), a.clearInterval(c)
                    }), a.attachEvent && a.attachEvent("onload", function() {
                        a.clearInterval(c)
                    })
                }
            }
        }(this);
    </script>
    <div id="tt_end_page" style="display: none;"></div>
</body>
<script>
    ! function() {
        let t, e = "fosp_uid=",
            n = decodeURIComponent(document.cookie).split(";"),
            i = !1;
        for (let r = 0; r < n.length; r++) {
            let s = n[r];
            for (;
                " " == s.charAt(0);) s = s.substring(1);
            0 == s.indexOf(e) && (t = s.substring(e.length, s.length)), 0 == s.indexOf("myvne_user_id=") && (i = !0)
        }
        if (t) {
            var d = "https://adp.vnecdn.net";
            fetch(`${d}/jn/dt`).then(t => t.json()).then(e => {
                if (e.sc_v) {
                    let n = document.createElement("script");
                    n.setAttribute("src", `${d}/jn/sc.js?v=${e.sc_v}`), n.setAttribute("type", "text/javascript"), n.setAttribute("async", !0), n.onload = function() {
                        var e = setInterval(() => {
                            if (i) {
                                if ("undefined" == typeof myvne_users || void 0 === myvne_users.profile || void 0 === myvne_users.profile.user_id) return;
                                clearInterval(e)
                            } else clearInterval(e);
                            "object" == typeof Journey && Journey.readyToRun() && fetch(`${d}/jn/dt?uid=${t}`).then(t => t.json()).then(t => {
                                t.dt && (window.jn_dt = t.dt), Journey.init()
                            })
                        }, 1e3)
                    }, document.body.appendChild(n)
                }
            }).catch(t => {
                console.error("Error:", t)
            })
        }
    }();
</script>

</html>