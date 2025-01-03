<?php session_start();?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
    <title>Impressum - Hotel GmbH</title>
</head>

<body>
    <?php include './inc/nav.php';?>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Imprint</h1>
        <div class="card p-4">
            <h2 class="h5">Sonnenschuss Hotel GmbH</h2>
            <p>Gesellschaft mit beschränkter Haftung</p>
            <p>Hotel</p>
            <p><strong>UID-No:</strong> ATU12345678</p>
            <p><strong>FN:</strong> 123456a</p>
            <p><strong>FB-Gericht:</strong> Wien</p>
            <p><strong>Firmensitz:</strong> 1220 Wien</p>
            <p><strong>Adress:</strong> Wienerstraße 12 I, Österreich</p>
            <p><strong>CEOs:</strong></p>
            <div class="row">
                <div class="col-md-6 text-center">
                    <img src="./Pictures/adi 3.jpg" class="img-fluid rounded-circle mb-2" alt="Adi Redzic" style="width: 100px; height: 150px; object-fit: cover;">
                    <p>Adi Redzic</p>
                </div>
                <div class="col-md-6 text-center">
                    <img src="./Pictures/Emir1.png" class="img-fluid rounded-circle mb-2" alt="Emir Hamulic" style="width: 100; height: 150px; object-fit: cover;">
                    <p>Emir Hamulic</p>
                </div>
            </div>
            <p><strong>Contact:</strong> Tel: +43 650 1234, E-Mail: <a href="mailto:email@server.domain">email@server.domain</a></p>
            <p><strong>Members:</strong> Mitglied der WKÖ, WKNÖ, Landesinnung Hotel, Fachgruppe Hotellerie</p>
            <p><strong>Gewerbeordnung:</strong> <a href="http://www.ris.bka.gv.at">www.ris.bka.gv.at</a></p>
            <p><strong>Gewerbebehörde:</strong> Bezirkshauptmannschaft Wien</p>
            <p><strong>Berufsbezeichnung:</strong> Hotelbetrieb</p>
            <p><strong>Verleihungsstaat:</strong> Meisterprüfung abgelegt in Österreich</p>
            <p id="Beschwerde">Verbraucher haben die Möglichkeit, Beschwerden an die Online-Streitbeilegungsplattform der EU zu richten: <a href="http://ec.europa.eu/odr">http://ec.europa.eu/odr</a>. Sie können allfällige Beschwerden auch an die oben angegebene E-Mail-Adresse richten.</p>
        </div>
    </div>
    <?php include './inc/footer.php'; ?>
</body>
</html>