userDigitalSigningView.vue

Overview van alle files die digitaal gesigneerd dienen te worden.
data: filename, email adres ontvanger, stukje test van aanvrager, aanvrager, download knop,
akkoord en niet akkoord knop.

adminDigitalSigningView.vue

Alle digital aanvragen.

Flow: Admin zoekt een client op en bijbehorende document. Druk op 
handtekening aanvraag. Vult de gegevens in emailadres ontvanger,
stukje tekst. Druk daarna op de verzend knop.

Nu wordt er een nieuwe entry aangemaakt in digitalSignature table. Ook wordt het bestand van interesse gekopieerd naar documentsDigitialSignatures.
