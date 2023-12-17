<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            border-radius: 3px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px;
            width: 300px;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-top {
            background-color: #001f3f;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        .card-img {
            background: linear-gradient(to bottom right, #b3c0d9, #8695b7);
            padding: 20px;
            text-align: center;
        }

        .card-img img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .card-price {
            background-color: #334e68;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-price span {
            color: #b3c0d9;
        }
    </style>
</head>
<body>

<?php
$url = "https://www.brickplanet.com/shop/search?featured=0&rare=1&type=-1&search=&sort_by=5&page=1";
$html = file_get_contents($url);

$doc = new DOMDocument();
libxml_use_internal_errors(true);
$doc->loadHTML($html);
libxml_clear_errors();

$xpath = new DOMXPath($doc);

$items = $xpath->query('//div[@class="col-6 col-md-3"]');
$itemsCount = min($items->length, 5);

for ($i = 0; $i < $itemsCount; $i++) {
    $currentItem = $items->item($i);

    $imageSrc = $xpath->query('.//img[@class="card-thumbnail"]', $currentItem)->item(0)->getAttribute('src');
    $itemName = $xpath->query('.//a[@class="d-block truncate text-decoration-none fw-semibold text-light mb-1"]', $currentItem)->item(0)->nodeValue;
    $price = $xpath->query('.//div[@class="text-credits"]', $currentItem)->item(0)->nodeValue;

    echo '<div class="card">';
    echo '    <div class="card-top">';
    echo "        $itemName";
    echo '    </div>';
    echo '    <div class="card-img">';
    echo "        <img src=\"$imageSrc\" alt=\"Item Image\">";
    echo '    </div>';
    echo '    <div class="card-price">';
    echo '        <span>Price</span>';
    echo "        <span>$price</span>";
    echo '    </div>';
    echo '    <div class="card-price">';
    echo '        <span>Stock</span>';
    echo '        <span>1</span>';
    echo '    </div>';
    echo '</div>';
}

?>

</body>
</html>
