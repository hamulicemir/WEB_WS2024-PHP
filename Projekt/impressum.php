<?php session_start();?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
    <title>Imprint - Hotel GmbH</title>
</head>

<body>
    <?php include './inc/nav.php';?>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Imprint</h1>
        <div class="card p-4">
            <h2 class="h5"><strong>Sonnenschuss Hotel GmbH</strong></h2>
            <p>Limited Liability Company</p>
            <p>Hotel</p>
            <p><strong>UID-No:</strong> ATU12345678</p>
            <p><strong>FN:</strong> 123456a</p>
            <p><strong>Commercial Court:</strong> Vienna</p>
            <p><strong>Company Headquarters:</strong> 1220 Vienna</p>
            <p><strong>Address:</strong> Wienerstraße 12 I, Austria</p>
            <p><strong>CEOs:</strong></p>
            <div class="row">
                <div class="col-md-2 text-center">
                    <img src="./Pictures/adi 3.jpg" class="img-fluid rounded-circle mb-2" alt="Adi Redzic" style="width: 100px; height: 150px; object-fit: cover;">
                    <p>Adi Redzic</p>
                </div>
                <div class="col-md-2 text-center">
                    <img src="./Pictures/Emir1.png" class="img-fluid rounded-circle mb-2" alt="Emir Hamulic" style="width: 100px; height: 150px; object-fit: cover;">
                    <p>Emir Hamulic</p>
                </div>
            </div>
            <p><strong>Contact:</strong> Tel: +43 650 1234, E-Mail: <a href="mailto:email@server.domain">email@server.domain</a></p>
            <p><strong>Members:</strong> Member of WKÖ, WKNÖ, State Guild Hotel, Hotel Industry Group</p>
            <p><strong>Trade Regulations:</strong> <a href="http://www.ris.bka.gv.at">www.ris.bka.gv.at</a></p>
            <p><strong>Trade Authority:</strong> District Authority Vienna</p>
            <p><strong>Professional Title:</strong> Hotel Operation</p>
            <p><strong>Awarding State:</strong> Master examination taken in Austria</p>
            <p id="Complaint">Consumers have the possibility to address complaints to the EU Online Dispute Resolution Platform: <a href="http://ec.europa.eu/odr">http://ec.europa.eu/odr</a>. You can also address any complaints to the above email address.</p>
        </div>
    </div>
    <?php include './inc/footer.php'; ?>
</body>
</html>