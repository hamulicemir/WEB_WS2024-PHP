<?php session_start(); ?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
    <link href="faq.stylesheet.css" rel="stylesheet"/> 
    <title>Hilfe & FAQs - Sonnenschuss</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1;
        }
    </style>
</head>
<body>
    <?php include './inc/nav.php';?>
    <main class="container mt-5">
        <h1 class="mb-4 text-center">Hilfe & FAQs</h1>
        <div class="accordion accordion-flush border border-dark" id="accordionFlushFAQs">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        1. Wie melde ich mich an?
                    </button>
                </h2>       
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushFAQs">
                    <div class="accordion-body">
                        Klicken Sie auf „Login“ und geben Sie Ihren Benutzernamen und Ihr Passwort ein. Wenn die Daten korrekt sind, werden Sie auf die Startseite weitergeleitet und sehen eine Willkommensnachricht.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        2. Wie reserviere ich ein Zimmer?
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushFAQs">
                    <div class="accordion-body">
                        Nachdem Sie sich eingeloggt haben, klicken Sie auf „Zimmer reservieren“. Wählen Sie den gewünschten Zeitraum, Zimmeroptionen (mit/ohne Frühstück, Parkplatz, Haustiermitnahme). Klicken Sie auf „Reservieren“, um die Buchung abzuschließen. Sie können Ihre Reservierungen jederzeit unter „Meine Reservierungen“ einsehen.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        3. Kann ich meine Reservierung stornieren oder ändern?
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushFAQs">
                    <div class="accordion-body">
                        Ja, Sie können Ihre Reservierung unter „Meine Reservierungen“ ansehen und bei Bedarf stornieren.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                        4. Welche zusätzlichen Leistungen sind buchbar?
                    </button>
                </h2>
                <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushFAQs">
                    <div class="accordion-body">
                        Neben dem Zimmer können Sie optional Frühstück, einen Parkplatz und die Mitnahme eines Haustieres hinzufügen. Diese Optionen sind mit einem Aufpreis verbunden, den Sie bei der Reservierung sehen.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                        5. Wie poste ich als Administrator eine Nachricht?
                    </button>
                </h2>
                <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushFAQs">
                    <div class="accordion-body">
                        Wenn Sie Administrator sind, sehen Sie im Menü die Option „News-Beiträge“. Hier können Sie Nachrichten erstellen und Bilder hochladen, die dann auf der Startseite erscheinen.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingSix">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                        6. Wer kann die News-Beiträge sehen?
                    </button>
                </h2>
                <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushFAQs">
                    <div class="accordion-body">
                        Alle Benutzer, auch anonyme Gäste, können die News-Beiträge der Administratoren sehen.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingSeven">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
                        7. Welche Benutzerrollen gibt es?
                    </button>
                </h2>
                <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushFAQs">
                    <div class="accordion-body">
                        <strong>Anonyme Benutzer:</strong> Können News lesen, die Hilfe- und Impressumsseite einsehen, und sich registrieren.<br>
                        <strong>Registrierte Benutzer:</strong> Können Zimmer buchen, Reservierungsdetails einsehen und ihr Profil verwalten.<br>
                        <strong>Administratoren:</strong> Können zusätzlich News posten, Reservierungen und Benutzer verwalten.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingEight">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEight" aria-expanded="false" aria-controls="flush-collapseEight">
                        8. Was kann ich tun, wenn ich mein Passwort vergessen habe?
                    </button>
                </h2>
                <div id="flush-collapseEight" class="accordion-collapse collapse" aria-labelledby="flush-headingEight" data-bs-parent="#accordionFlushFAQs">
                    <div class="accordion-body">
                        Bitte wenden Sie sich an einen Administrator, um Ihr Passwort zurückzusetzen.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingNine">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseNine" aria-expanded="false" aria-controls="flush-collapseNine">
                        9. Wie melde ich mich ab?
                    </button>
                </h2>
                <div id="flush-collapseNine" class="accordion-collapse collapse" aria-labelledby="flush-headingNine" data-bs-parent="#accordionFlushFAQs">
                    <div class="accordion-body">
                        Klicken Sie auf „Logout“, um sich von der Website abzumelden.
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include './inc/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+3oB7j1o5y5r1b7+AMvyTG2x1p5r" crossorigin="anonymous"></script>
</body>
</html>