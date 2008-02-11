<?php
/*
XtraUpload - File Hosting Software
Copyright (C) 2006-2007  Matthew Glinski and XtraFile.com
Link: http://www.xtrafile.com
-----------------------------------------------------------------
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program(LICENSE.txt); if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

// Text Strings are defined using the following:
// {FILENAME)/{STRING_NUMBER}
// so for the file main2.php the first piece of text in this array would look like this:
// $lang['home']['1'] = 'Uploading your file! ';

$lang = array(); // Define the $lang variable as an array
####################################
####################################
####################################
// BEGIN FILE: include/pages/home.php
$lang['home'] = array(); 
$lang['home']['1'] = 'Deine Datei wird hochgeladen';
$lang['home']['2'] = '<br>Deine Datei wird hochgeladen <br> Bitte warte während deine Datei hochgeladen wird. <br />
Das nächste mal kannst du den Flash Upload nutzen und erhälst dann eine Fortschrittsanzeige während deines Uploads! ';
$lang['home']['3'] = 'Fertig';
$lang['home']['4'] = 'Status: ';
$lang['home']['5'] = 'von';
$lang['home']['6'] = 'gesendet ( in';
$lang['home']['7'] = 'Noch verbleibende Dauer: ';
$lang['home']['8'] = ' Sekunden';
$lang['home']['9'] = 'Verstrichene Zeit: ';
$lang['home']['10'] = 'Für mehr Funktionen kannst du auch einen ';
$lang['home']['11'] = 'Datei hochladen';
$lang['home']['12'] = 'Datei herunterladen';
$lang['home']['13'] = 'Mit Flash hochladen';
$lang['home']['14'] = 'Einen HTTP Link hochladen';
$lang['home']['15'] = 'Mit Browser hochladen';
$lang['home']['16'] = 'Deine Datei wird auf unseren Server registriert.<br />
Bitte warte, du wirst gleich weitergeleitet.';
$lang['home']['17'] = 'Wähle eine Datei zum hochladen aus ( ';
$lang['home']['18'] = 'MB maximal pro Datei)';
$lang['home']['19'] = 'HTTP Link zum hochladen:';
$lang['home']['20'] = '<strong>Beschreibung:</strong> (Optional) ';
$lang['home']['21'] = '<strong>Passwort:</strong> (Optional) ';
$lang['home']['22'] = '  Datei hochladen  ';
$lang['home']['23'] = 'Datei zum hochladen';
$lang['home']['24'] = 'Gib eine Datei ID ein zum herunterladen:';
$lang['home']['25'] = '  Datei herunterladen!  ';
$lang['home']['26'] = '<b>Make File Featured</b>';
$lang['home']['27'] = 'Ja';
$lang['home']['28'] = 'Nein';
$lang['home']['29'] = 'Ausgewählte Dateien ';
$lang['home']['30'] = 'Datei per Email verschicken';
$lang['home']['31'] = 'Mehrere Emailadressen mit Komma trennen(,)';
$lang['home']['32'] = 'Bis zu 100 Adressen, Empfänger erhalten das Passwort für die Datei automatisch mit.';
$lang['home']['33'] = 'Premium Account registrieren!';
$lang['home']['34'] = 'Zeige Zusatzfunktionen';
$lang['home']['35'] = '';
// END FILE: include/pages/home.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/main.php
$lang['main'] = array(); 
$lang['main']['1'] = 'Maximale Versuche erreicht\'s von ';
$lang['main']['2'] = ' ohne Erfolg!';
$lang['main']['3'] = 'Du musst den Text im Bild eingeben bevor du eine Datei hochladen kannst<br />
';
$lang['main']['4'] = 'Erneut versuchen';
// END FILE: include/pages/main.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/logout.php
$lang['logout'] = array(); 
$lang['logout']['1'] = 'Logout erfolgreich!';
$lang['logout']['2'] = 'Wir leiten dich nun weiter.';
// END FILE: include/pages/logout.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/rate.php
$lang['rate'] = array(); 
$lang['rate']['1'] = 'Bitte wähle eine Datei zum bewerten aus.';
$lang['rate']['2'] = 'Die Datei ID ist falsch. \nBitte überprüfe die Datei und versuche es erneut.';
$lang['rate']['3'] = 'Datei zum bewerten( Abhängig von der Datei ID ): ';
$lang['rate']['4'] = 'Datei herunterladen';
$lang['rate']['5'] = 'Die Datei wurde in unserer Datenbank nicht gefunden. <br />
Please check the link and try again.';
$lang['rate']['6'] = 'Datei Beschreibung anzeigen';
$lang['rate']['7'] = 'Diese Datei bewerten ';
$lang['rate']['8'] = 'Dateityp: ';
$lang['rate']['9'] = 'Datei herunterladen';
$lang['rate']['10'] = 'Derzeitige Bewertung:';
$lang['rate']['11'] = 'Diese Datei wurde noch nicht bewertet!';
$lang['rate']['12'] = 'Beschreibung:';
$lang['rate']['13'] = ' Diese Datei bewerten  ';
$lang['rate']['14'] = '-- Wähle Bewertung--';
$lang['rate']['15'] = '  Bewerte diese Datei:  ';
// END FILE: include/pages/rate.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/points.php
$lang['points'] = array(); 
$lang['points']['1'] = 'Dein Account ist ausgelaufen seit ';
$lang['points']['2'] = ' Tagen';
$lang['points']['3'] = 'Du hast nicht genügend Punkte um deinen Account zu verlängern';
$lang['points']['4'] = 'Du hast keine Berechtiung um deinen Account zu verlängern';
$lang['points']['5'] = 'Benutzername: ';
$lang['points']['6'] = 'Benutzergruppe: ';
$lang['points']['7'] = 'Dein Account ';
$lang['points']['8'] = 'läuft am ';
$lang['points']['9'] = ' Läuft niemals ab';
$lang['points']['10'] = 'Du kannst deinen Account für ';
$lang['points']['11'] = ' Tage ';
$lang['points']['12'] = ' Punkte';
$lang['points']['13'] = 'Du hast derzeit ';
$lang['points']['14'] = 'Verlängere deinen Account';
$lang['points']['15'] = 'Du musst eingelogged sein um deine Punkte zu verwalten.';
$lang['points']['16'] = 'Dein Account läuft niemals ab, daher kannst du ihn auch nicht verlängern.';
$lang['points']['17'] = 'Du hast nicht genügend Punkte um deinen Account zu verlängern. <br />
Das minimum das du benötigst ist ';
$lang['points']['18'] = 'Punkte';
// END FILE: include/pages/points.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/support.php
$lang['support'] = array(); 
$lang['support']['1'] = 'Bitte wähle eine der Kategorien um schnell und unkompliziert Support zu erhalten. <br />
Derzeit bieten wir keinen freien Support an, wir arbeiten an der Erweiterung unserer Seite, in naher Zukunft bieten wir freien Support an. ';
$lang['support']['2'] = 'Häufig gestelle Fragen (FAQ)';
$lang['support']['3'] = 'Email an den Support';
// END FILE: include/pages/support.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/url.php
$lang['url'] = array(); 
$lang['url']['1'] = 'Bitte wähle eine Datei zum hochladen aus befor du auf hochladen klickst.';
$lang['url']['2'] = 'Datei zu groß, die Datei ist größer als ';
$lang['url']['3'] = ' MB';
$lang['url']['4'] = 'Der Dateityp den du hochgeladen hast(';
$lang['url']['5'] = ') ist nicht erlaubt.';
$lang['url']['6'] = 'Erfolg';
$lang['url']['7'] = 'Downloadlink : ';
$lang['url']['8'] = 'Datei ID: ';
$lang['url']['9'] = '&quot;Diese Datei bewerten&quot; Link: ';
$lang['url']['10'] = 'Beschreibung:';
$lang['url']['11'] = 'Passwort:';
$lang['url']['12'] = 'Deine IP Adresse ';
$lang['url']['13'] = ' wurde aus Sicherheitsgründen gespeichert. ';
$lang['url']['14'] = 'Datei löschen:';
$lang['url']['15'] = 'Dateilinks ausblenden';
$lang['url']['16'] = 'Dateilinks einblenden';
$lang['url']['17'] = 'Video HTML Links ausblenden';
$lang['url']['18'] = 'Video HTML Links einblenden';
$lang['url']['19'] = 'Dateiupload erfolgreich';
$lang['url']['20'] = 'Thumbnail Vorschau:';
$lang['url']['21'] = 'Dateityp:';
$lang['url']['22'] = 'Zeige BB Codes';
$lang['url']['23'] = 'Zeige das Bild deinen Freunden:';
$lang['url']['24'] = 'Hotlink für Forum 1:';
$lang['url']['25'] = 'Hotlink für Forum 2:';
$lang['url']['26'] = 'Thumbnaillink für Forum 1: ';
$lang['url']['27'] = 'Thumbnaillink für Forum 2: ';
$lang['url']['28'] = 'Hotlink für Internetseite (HTML): ';
$lang['url']['29'] = 'Direkter Link zum Bild:';
$lang['url']['30'] = 'Upload komplett!<br />
Bitte warte während die Datei geprüft wird.';
// END FILE: include/pages/url.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/.php
$lang['upload'] = array(); 
$lang['upload']['1'] = 'Datei zu groß, die Datei ist größer als ';
$lang['upload']['2'] = ' MB';
$lang['upload']['3'] = 'Die Datei die du hochgeladen hast(';
$lang['upload']['4'] = ') ist nicht erlaubt.';
$lang['upload']['5'] = 'Datei nicht hochgeladen';
$lang['upload']['6'] = 'Du wirst zur Hauptseite weitergeleitet';
$lang['upload']['7'] = 'Erfolg';
$lang['upload']['8'] = 'Downloadlink : ';
$lang['upload']['9'] = 'Datei ID: ';
$lang['upload']['10'] = 'Bewerte diese Datei:';
$lang['upload']['11'] = 'Beschreibung:';
$lang['upload']['12'] = 'Passwort:';
$lang['upload']['13'] = 'Deine IP Adresse ';
$lang['upload']['14'] = ' wurde aus Sicherheitsgründen gespeichert.';
$lang['upload']['15'] = 'Link um die Datei zu löschen:';
$lang['upload']['16'] = 'Es entstand ein Fehler während deine Datei hochgeladen wurde:';
$lang['upload']['17'] = 'Der HTTP Link ist größer als es das Dateilimit bei deinem Account zulässt.';
$lang['upload']['18'] = 'Es ist ein unbekannter Fehler entstanden während deine Datei hochgeladen wurde.';
$lang['upload']['19'] = 'Kann nicht zum FTP Server verbinden. ';
$lang['upload']['20'] = 'FTP Server Login ist fehlgeschlagen ';
$lang['upload']['21'] = 'Die Dateigröße auf dem FTP Server konnte nicht festgestellt werden';
$lang['upload']['22'] = 'Unbenkannter Fehler ';
$lang['upload']['23'] = 'Tempdatei konnte nicht gefunden werden, prüfe "temp" Verzeichniss auf die richtige Berechtigung';
$lang['upload']['24'] = 'Die Datei konnte nicht verschoben werden, prüfe "files" Verzeichniss auf die richtige Berechtigung';
// END FILE: include/pages/upload.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/addfolder.php
$lang['addfolder'] = array(); 
$lang['addfolder']['1'] = 'Erstelle Dateiordner ';
$lang['addfolder']['2'] = 'Der Dateiordner wurde erstellt.<br />
';
$lang['addfolder']['3'] = 'Gehe zurück zum Ordnermanager';
$lang['addfolder']['4'] = 'Dateiordner Info';
$lang['addfolder']['5'] = 'Dateiordner Name:';
$lang['addfolder']['6'] = 'Dateiordner Link:';
$lang['addfolder']['7'] = 'Dateiordner ID:';
$lang['addfolder']['8'] = 'Dateiordner Passwort:';
$lang['addfolder']['9'] = 'Dateiordner Admin Passowrt:';
$lang['addfolder']['10'] = 'Dateien zum hinzufügen, ein Link pro Zeile:';
$lang['addfolder']['11'] = '';
// END FILE: include/pages/addfolder.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/view.php
$lang['view'] = array(); 
$lang['view']['1'] = ' Dateiordner Passwort ';
$lang['view']['2'] = 'Bestätigen';
$lang['view']['3'] = 'Dateiordner : ';
$lang['view']['4'] = 'Ersteller: ';
$lang['view']['5'] = '&lt;-&lt; Keine Beschreibung &gt;-&gt;';
$lang['view']['6'] = 'Datei herunterladen';
$lang['view']['7'] = 'Du hast keine Berechtigung Dateiordner aufzurufen';
$lang['view']['8'] = 'Passwort falsch!';
$lang['view']['9'] = 'Der Ordnerinhaber hat den Ordner mit einem Passwort geschützt. <br />Bitte gib das Passwort ein um den Ordner zu betrachten.';
$lang['view']['10'] = 'Uploader';
$lang['view']['11'] = 'Dateiname';
$lang['view']['12'] = 'Dateilink ';
$lang['view']['13'] = 'Dateistatus ';
$lang['view']['14'] = 'Zeige Dateiordner';
$lang['view']['15'] = 'Bitte gib eine Dateiordner ID ein: ';
$lang['view']['16'] = 'Bestätigen';
// END FILE: include/pages/view.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/advertising.php
$lang['advertising'] = array(); 
$lang['advertising']['1'] = 'Werbe mit ';
$lang['advertising']['2'] = 'Du möchtest mehr Besucher auf deiner Seite? Unsere Werbekampagnen geben dir die beste Möglichkeit das deine Werbung täglich von tausenden Besuchern gesehen wird! ';
$lang['advertising']['3'] = 'Textlinks:<br />	<strong><span class="style4">Price : $15</span><span class="style11"> / Textlink </span><br /> Gültigkeit : 1 Monat ';
$lang['advertising']['4'] = '460X60 Banner:<br /><strong>Preis :</strong> <strong>$20 / Banner</strong><br />
<strong>Gültigkeit :</strong> <strong>1 Monat';
$lang['advertising']['5'] = 'Bitte <a href="index.php?p=contact">klicke hier</a> um uns zu kontaktieren so das weitere Details geklärt werden können. ';
$lang['advertising']['6'] = 'Nach Bezahlung wird deine Werbekampagne innerhalb der nächsten Stunden bearbeitet und direkt angezeigt. ';
$lang['advertising']['7'] = 'Unterstütze uns in dem du einen der folgenden HTML Codes auf deiner Seite einbindest :';
$lang['advertising']['8'] = ' - Lade deine Dateien kostenlos hoch! ';
// END FILE: include/pages/advertising.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/delacc.php
$lang['delacc'] = array(); 
$lang['delacc']['1'] = 'Dein Account wurde erfolgreich gelöscht! ';
$lang['delacc']['2'] = 'Schade das du nicht weiter Mitglied bei uns bist! <br />
 Vergiss nicht dein Paypal Abbonement zu stornieren. ';
$lang['delacc']['3'] = 'Bist du dir sicher das du deinen Account löschen willst?';
$lang['delacc']['4'] = 'Ja';
$lang['delacc']['5'] = 'Bist du dir sicher? Dieser Vorgang kann nicht rückgängig gemacht werden';
$lang['delacc']['6'] = 'Löschen bestätigen';
// END FILE: include/pages/delacc.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/contactus.php
$lang['contactus'] = array(); 
$lang['contactus']['1'] = 'Support';
$lang['contactus']['2'] = 'Unser Support ist für alle Mitglieder erreichbar.';
$lang['contactus']['3'] = 'Deine Nachricht wurde gesendet, du solltest innerhalb der nächsten 24 Stunden eine Antwort erhalten ';
$lang['contactus']['4'] = 'Eine gültige Emailadresse wird benötigt!';
$lang['contactus']['5'] = 'Ein Nachrichtenbetreff wird benötigt!';
$lang['contactus']['6'] = 'Eine Nachricht wird benötigt!';
$lang['contactus']['7'] = 'FEHLER!';
$lang['contactus']['8'] = 'Deine Emailadresse:';
$lang['contactus']['9'] = 'Betreff:';
$lang['contactus']['10'] = 'Nachricht:';
$lang['contactus']['11'] = 'Sicherheitscode:';
$lang['contactus']['12'] = 'Dies wird benötigt um SPAM zu verhindern.';
$lang['contactus']['13'] = 'Email abschicken';
// END FILE: include/pages/contactus.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/.php
$lang['download'] = array(); 
$lang['download']['1'] = 'Dateilink inkorrekt';
$lang['download']['2'] = 'Dateilink ist inkorrekt!';
$lang['download']['3'] = 'Dein Downloadlink: ';
$lang['download']['4'] = 'Lade diese Datei sofort herunter';
$lang['download']['5'] = 'Downloadlink inkorrekt!';
$lang['download']['6'] = 'Deine IP Adresse stimmt nicht mit der Downloadlink IP Adresse überein.';
$lang['download']['7'] = '  Du wirst weitergeleitet, bitte warten.';
$lang['download']['8'] = 'Unlimitiert';
$lang['download']['9'] = 'Unbekannt';
$lang['download']['10'] = 'Dein Dateidownload';
$lang['download']['11'] = ' ist bereit ';
$lang['download']['12'] = 'Download FAQ';
$lang['download']['13'] = '';
$lang['download']['14'] = '';
$lang['download']['15'] = '';
// END FILE: include/pages/download.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/editp.php
$lang['editp'] = array(); 
$lang['editp']['1'] = 'Deine Account Informationen wurden gespeichert.';
$lang['editp']['2'] = 'Ändere deine Accountdetails und klicke auf den bestätigen Button unterhalb.';
$lang['editp']['3'] = 'Benutzername:';
$lang['editp']['4'] = 'Neues Passwort:';
$lang['editp']['5'] = 'Neue Emailadresse:';
$lang['editp']['6'] = 'bestätigen';
// END FILE: include/pages/editp.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/editimg.php
$lang['editimg'] = array(); 
$lang['editimg']['1'] = 'Datei ';
$lang['editimg']['2'] = ' wurde gelöscht';
$lang['editimg']['3'] = 'Du hast keine Berechtigung diese Datei zu löschen';
$lang['editimg']['4'] = 'Verwalte deine Dateien';
$lang['editimg']['5'] = 'Name';
$lang['editimg']['6'] = 'heruntergeladen';
$lang['editimg']['7'] = 'Löschen?';
$lang['editimg']['8'] = 'Keine aktuelle Datei gefunden';
$lang['editimg']['9'] = 'Du hast keine Berechtigung Dateien zu verwalten';
$lang['editimg']['9'] = 'Dateistatus';
// END FILE: include/pages/editimg.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/.php
$lang['errordl'] = array(); 
$lang['errordl']['1'] = 'Erlaubtes Transfervolumen erreicht! </font></strong> <br />
um mehr herunterzuladen brauchst du einen Premiumaccount. <br /><strong>Versuche es in einer Stunde wieder ';
$lang['errordl']['2'] = 'Bitte lies unsere ';
$lang['errordl']['3'] = 'AGB';
// END FILE: include/pages/errordl.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/error.php
$lang['error'] = array(); 
$lang['error']['1'] = 'Datei nicht gefunden! </span><br /> Die ausgewählte Datei konnte nicht auf unserem Server gefunden werden! ';
$lang['error']['2'] = 'Dies kann verschiedene Gründe haben : ';
$lang['error']['3'] = '1. Es wurden beschwerden an uns geschickt<br /> 2. Die Datei war zu lange inaktiv<br /> 3. Der Uploader der Datei hat die Datei gelöscht ';
// END FILE: include/pages/error.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/fastpass.php
$lang['fastpass'] = array(); 
$lang['fastpass']['1'] = 'Bitte registriere dich für einen Account <br /> Alle Accounts werden direkt freigeschaltet';
$lang['fastpass']['2'] = 'Probleme bei der Anmeldung? <a href="index.php?p=contactus">Kontaktiere uns</a>. ';
$lang['fastpass']['3'] = 'Sobald deine Bezahlung gemacht wurde, wird dir automatisch ein Passwort zugeschickt. Bitte prüfe deinen SPAM Filter wenn du keine Email erhälst. Dir wird kein Passwort zugeschickt wenn du nicht bezahlst.';
// END FILE: include/pages/fastpass.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/folder.php
$lang['folder'] = array(); 
$lang['folder']['1'] = 'Verwalte deine Ordner';
$lang['folder']['2'] = 'Zeige';
$lang['folder']['3'] = 'Löschen';
$lang['folder']['4'] = 'Neuen Ordner erstellen';
$lang['folder']['5'] = 'Um einen neuen Ordner zu erstellen wähle die Dateien aus die du diesem Ordner hinzufügen möchtest. Kopiere die Dateilinks in die Box auf der nächsten Seite (einen pro Zeile) und klicke auf weiter.';
$lang['folder']['6'] = 'Ordnername:';
$lang['folder']['7'] = 'Ordnerpasswort: ';
$lang['folder']['8'] = 'Erstelle Ordner';
$lang['folder']['9'] = 'Du hast keine Berechtigung Dateiordner zu erstellen';
$lang['folder']['10'] = 'Dein Ordner wurde bearbeitet.<br /><br />
Please wait while we redirect you.';
$lang['folder']['11'] = 'Bearbeite Dateiordner';
$lang['folder']['12'] = 'Entferne Dateien';
$lang['folder']['13'] = 'Füge Dateien hinzu';
$lang['folder']['14'] = ' Datei beibehalten';
$lang['folder']['15'] = ' Füge Datei zum Ordner hinzu';
$lang['folder']['16'] = 'Änderungen bestätigen';
$lang['folder']['17'] = ' Datei/en gelöscht!';
$lang['folder']['18'] = 'Adminpasswort geändert!';
$lang['folder']['19'] = ' Neue Dateien hinzugefügt!';
$lang['folder']['20'] = 'Ordner gelöscht!';
$lang['folder']['21'] = 'Verwalte Dateiordner: ';
$lang['folder']['22'] = 'Verwalte Dateien in Ordner';
$lang['folder']['23'] = 'Füge neue Dateien hinzu';
$lang['folder']['24'] = 'Ändere Adminpasswort';
$lang['folder']['26'] = 'Lösche diesen Ordner';
$lang['folder']['27'] = 'Ändere Adminpasswort:';
$lang['folder']['28'] = 'Neues Adminpasswort:';
$lang['folder']['29'] = 'Füge Dateien hinzu:';
$lang['folder']['30'] = 'Füge hier die Dateilinks ein, einen pro Zeile:';
$lang['folder']['31'] = 'Füge neue Dateien hinzu';
$lang['folder']['32'] = 'Ändere Adminpasswort';
$lang['folder']['33'] = 'Verwalte Dateien:';
$lang['folder']['34'] = 'Löschen';
$lang['folder']['35'] = 'Dateilink';
$lang['folder']['36'] = 'Lösche ausgewählte Dateien';
$lang['folder']['37'] = 'Es existiert kein Ordner mit deiner Beschreibung!';
$lang['folder']['38'] = 'Lösche Ordner ';
$lang['folder']['39'] = 'Bitte gib das Adminpasswort für diesen Ordner ein um ihn zu löschen';
$lang['folder']['40'] = 'Ordner ID: ';
$lang['folder']['41'] = 'Adminpasswort: ';
$lang['folder']['42'] = 'Lösche Ordner';
$lang['folder']['43'] = 'Füge Dateien zum Ordner hinzu ';
$lang['folder']['44'] = 'Logge dich unterhalb in deinen Dateiordner ein um Dateien hinzuzufügen! ';
$lang['folder']['45'] = 'Verwalte Ordner ';
$lang['folder']['46'] = 'Logge dich unterhalb in deinen Ordner ein um ihn zu verwalten! ';
$lang['folder']['47'] = 'Dateien hinzufügen';
$lang['folder']['48'] = 'Ordneradmin';
$lang['folder']['49'] = 'Du hast schon einen Ordner? Logge dich unterhalb ein um ihn zu verwalten! ';
$lang['folder']['50'] = '';
// END FILE: include/pages/folder.php
####################################
####################################
####################################
/*
// BEGIN FILE: include/pages/flash.php
$lang['flash'] = array(); 
$lang['flash']['1'] = 'Erfolgreich';
$lang['flash']['2'] = ' Downloadlink : ';
$lang['flash']['3'] = 'Datei ID: ';
$lang['flash']['4'] = 'Bewerte diese Datei:';
$lang['flash']['5'] = 'Beschreibung: ';
$lang['flash']['6'] = 'Passwort: ';
$lang['flash']['7'] = 'Deine IP Adresse ';
$lang['flash']['8'] = ' wurde aus Sicherheitsgründen gespeichert. ';
$lang['flash']['9'] = ' Es gab ein Problem während des Uploads deiner Datei. Du wirst zur Hauptseite weitergeleitet.';
$lang['flash']['10'] = 'Löschlink für die Datei:';
// END FILE: include/pages/flash.php
####################################
####################################
####################################
*/
// BEGIN FILE: include/pages/history.php
$lang['history'] = array(); 
$lang['history']['1'] = 'Die History deines Accounts wird hier gezeigt für Benutzer ';
$lang['history']['2'] = 'wenn dein Account abläuft wirst du dich erneut registrieren müssen um unseren Service weiter nutzen zu können. ';
$lang['history']['3'] = 'Insgesamt erworbene Benutzerpunkte: ';
$lang['history']['4'] = 'Zuletzt heruntergeladene Datei : ';
$lang['history']['5'] = 'Dateigröße (in kb) : ';
$lang['history']['6'] = 'Du musst eingelogged sein um deine Downloadhistory sehen zu können';
// END FILE: include/pages/history.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/join.php
$lang['join'] = array(); 
$lang['join']['1'] = 'Premium Anmeldung ';
$lang['join']['2'] = 'DEINE IP WIRD AUS SICHERHEITSGRÜNDEN GESPEICHERT: ';
$lang['join']['3'] = 'Du musst den folgenden Bedingungen zustimmen um dich zu registrieren';
$lang['join']['4'] = 'Wenn du den Zurück Button im Browser benutzt wird deine Anmeldung abgebrochen. Du kannst nach der Anmeldung deine Angaben jederzeit verändern. ';
$lang['join']['5'] = 'AGB und Konditionen';
$lang['join']['6'] = ' Ich stimme zu';
$lang['join']['7'] = ' Ich lehne ab';
$lang['join']['8'] = 'Weiter';
$lang['join']['9'] = 'Du musst den AGB zustimmen damit du dir einen Account registrieren kannst.';
// END FILE: include/pages/.php
####################################
####################################
####################################
// BEGIN FILE: include/pages/login.php
$lang['login'] = array(); 
$lang['login']['1'] = 'Login  ';
$lang['login']['2'] = 'Benutzername: ';
$lang['login']['3'] = 'Passwort';
$lang['login']['4'] = 'Passwort vergessen?';
$lang['login']['5'] = 'Neuen Account registrieren!';
$lang['login']['6'] = 'Benutzername/Passwort wurde nicht in unserer Datenbank gefunden. Bitte versuche es erneut.';
$lang['login']['7'] = 'Deine Sitzung ist abgelaufen.<br />
Please Login Again';
$lang['login']['8'] = 'Dein Login war erfolgreich!';
$lang['login']['9'] = 'Bitte warte, du wirst weitergeleitet.';
// END FILE: include/pages/logout.php
// END FILE: include/pages/login.php
####################################
####################################
####################################
// BEGIN FILE: include/step1.php
$lang['step1'] = array(); 
$lang['step1']['1'] = 'Wähle einen Benutzernamen:';
$lang['step1']['2'] = 'Wähle eine Zahlungsmethode';
$lang['step1']['3'] = 'Weiter';
// END FILE: include/step1.php
####################################
####################################
####################################
// BEGIN FILE: include/step2.php
$lang['step2'] = array(); 
$lang['step2']['1'] = 'Premium Mitgliedschaft';
// END FILE: include/step2.php
####################################
####################################
####################################
// BEGIN FILE: include/step3.php
$lang['step3'] = array(); 
$lang['step3']['1'] = 'Premium Mitgliedschaft';
// END FILE: include/step3.php
####################################
####################################
####################################
// BEGIN FILE: include/no_cost.php
$lang['no_cost'] = array(); 
$lang['no_cost']['1'] = 'Diese Emailadresse wird bereits benutzt. Bitte gib eine andere an';
$lang['no_cost']['2'] = 'Dieser Benutzername wird bereits verwendet. Bitte wähle einen anderen';
$lang['no_cost']['3'] = 'Das Passwort stimmt nicht überein';
$lang['no_cost']['4'] = 'Es sind keine weiteren Anmeldung erlaubt';
$lang['no_cost']['5'] = '
<h3 align="center">Vielen Dank für die Anmeldung!</h3>
<div align="center">Dein Account wurde erstellt.<br />Bitte warte, du wirst zum Login weitergeleitet.</div>
';
$lang['no_cost']['6'] = 'Bitte gib ein Passwort ein';
$lang['no_cost']['7'] = 'Das Passwort stimmt nicht überein, bitte überprüfen.';
$lang['no_cost']['8'] = 'Bitte wähle einen Benutzernamen mit mehr als 6 Zeichen';
$lang['no_cost']['9'] = 'Bitte gib eine gültige Emailadresse ein.';
$lang['no_cost']['10'] = 'Details eingeben ';
$lang['no_cost']['11'] = 'Benutzername';
$lang['no_cost']['12'] = 'Passwort';
$lang['no_cost']['13'] = 'Passwort erneut';
$lang['no_cost']['14'] = 'Emailadresse ';
$lang['no_cost']['15'] = '  Anmelden  ';
$lang['no_cost']['16'] = 'Die Emailadresse die du eingegeben hast ist nicht korrekt.';
$lang['no_cost']['17'] = '';
// END FILE: include/no_cost.php
####################################
####################################
####################################
// BEGIN FILE: include/payment/paypal.php
$lang['paypal'] = array(); 
$lang['paypal']['1'] = 'Hallo, '."\n\n".' dein Premiumaccount auf ';
$lang['paypal']['2'] = ' wurde bestätigt. Deine Zugangsdaten findest du unterhalb.'."\n".'';
$lang['paypal']['3'] = "\n".'Benutzername: ';
$lang['paypal']['4'] = "\n".'Passwort: ';
$lang['paypal']['5'] = 'Vielen Dank für deine Anmeldung,'."\n";
$lang['paypal']['6'] = ' Mitarbeiter';
$lang['paypal']['7'] = 'Bezahle jetzt mit Paypal!';
// END FILE: include/payment/paypal.php
####################################
####################################
####################################
// BEGIN FILE: include/payment/authnet.php
$lang['authnet'] = array(); 
$lang['authnet']['1'] = 'Hallo, \n dein Premiumaccount auf ';
$lang['authnet']['2'] = ' wurde bestätigt. Deine Zugangsdaten findest du unterhalb.'."\n"."\n";
$lang['authnet']['3'] = "\n".'Benutzername: ';
$lang['authnet']['4'] = "\n".'Passwort: ';
$lang['authnet']['5'] = 'Vielen Dank erneut für deine Anmeldung, '."\n";
$lang['authnet']['6'] = ' Mitarbeiter';
$lang['authnet']['7'] = 'Kreditkartennummer';
$lang['authnet']['8'] = 'Kartenverfallsdatum';
$lang['authnet']['9'] = 'Sicherheitscode';
$lang['authnet']['10'] = 'Name';
$lang['authnet']['11'] = 'Vorname';
$lang['authnet']['12'] = 'Adresse';
$lang['authnet']['13'] = 'Stadt';
$lang['authnet']['14'] = 'Staat';
$lang['authnet']['15'] = 'Postleitzahl ';
$lang['authnet']['16'] = 'Emailadresse';
$lang['authnet']['17'] = 'Telefonnummer';
$lang['authnet']['18'] = 'Bezahle mit einer Kreditkarte';
$lang['authnet']['19'] = 'Bestellung erfolgreich. <br />
Bitte prüfe deine Emails für deine Zugangsdaten.';
$lang['authnet']['20'] = 'Bestellung erfolgreich. <br />
Grund: ';
$lang['authnet']['21'] = '<br /> Bitte warte bis wir Kontakt mit dir aufnehmen, in der Regel innerhalb der nächsten 24 Stunden.';
// END FILE: include/payment/authnet.php
####################################
####################################
####################################
// BEGIN FILE: include/payment/2co.php
$lang['2co'] = array(); 
$lang['2co']['1'] = 'Hallo, '."\n". 'dein Premiumaccount ';
$lang['2co']['2'] = ' wurde bestätigt. Deine Zugangsdaten findest du unterhalb. '."\n"."\n";
$lang['2co']['3'] = "\n".'Benutzername: ';
$lang['2co']['4'] = "\n".'Passwort: ';
$lang['2co']['5'] = 'Vielen Dank erneut für deine Bestellung,'."\n";
$lang['2co']['6'] = ' Mitarbeiter';
$lang['2co']['7'] = 'Bezahle mit 2CheckOut';
// END FILE: include/payment/2co.php
####################################
####################################
####################################
// BEGIN FILE: include/payment/check.php
$lang['check'] = array(); 
$lang['check']['1'] = ' Vielen Dank das du einen Premiumaccount registriert hast ';
$lang['check']['2'] = 'Bitte folge den Informationen unterhalb um zu bezahlen.';
// END FILE: include/payment/check.php
####################################
####################################
####################################
// BEGIN FILE: /script.php
$lang['script'] = array(); 
$lang['script']['1'] = 'Sorry, der Dateityp den du versuchst hast hochzuladen(';
$lang['script']['2'] = ') ist nicht erlaubt. \nBitte versuche es erneut.';
$lang['script']['3'] = 'Bitte wähle eine Datei zum hochladen aus.';
$lang['script']['4'] = 'Bitte gib einen korrekten HTTP Link zum hochladen ein.';
// END FILE: /script.php
####################################
####################################
####################################
// BEGIN FILE: /download2.php
$lang['download2'] = array(); 
$lang['download2']['1'] = 'Diese Datei wurde vom Uploader mit einem Passwort geschützt.<br /> 
Bitte gib das Passwort unterhalb ein um Zugriff auf die Datei zu erhalten.';
$lang['download2']['2'] = 'Dateipasswort: ';
$lang['download2']['3'] = 'Bestätigen';
// END FILE: /download2.php
####################################
####################################
####################################
// BEGIN FILE: /captcha.php
$lang['captcha'] = array(); 
$lang['captcha']['1'] = 'Du musst die Buchstaben/Zahlen eintippen ';
$lang['captcha']['2'] = ' </b> und bestätigen um Dateien hoch/runter zu laden.';
$lang['captcha']['3'] = 'Du kannst das nicht lesen? ';
$lang['captcha']['4'] = 'Bestätigen';
$lang['captcha']['5'] = 'Neues Bild erstellen';
// END FILE: /captcha.php
####################################
####################################
####################################
// BEGIN FILE: ./include/open.functions.inc.php
$lang['open'] = array(); 
$lang['open']['1'] = 'Funktion';
$lang['open']['2'] = 'Preis';
$lang['open']['3'] = 'Kostenlos!';
$lang['open']['4'] = 'Downloadlimit';
$lang['open']['5'] = 'Unbegrenzt';
$lang['open']['6'] = 'MB pro Stunde';
$lang['open']['7'] = 'Maximale Dateigröße';
$lang['open']['8'] = 'Unbegrenzt';
$lang['open']['9'] = 'MB';// MB = MegaByte
$lang['open']['10'] = 'Downloadmanager erlaubt ';
$lang['open']['11'] = 'Hochladen mit HTTP Link ';
$lang['open']['12'] = 'Remoteupload ';
$lang['open']['13'] = 'Upload Via Flash ';
$lang['open']['14'] = 'Dateiordner anzeigen ';
$lang['open']['15'] = 'Dateiordner erstellen ';
$lang['open']['16'] = 'Eigene Uploads verwalten ';
$lang['open']['17'] = 'CAPTCHA vor Download';
$lang['open']['18'] = 'CAPTCHA auf Internetseite';
$lang['open']['19'] = 'Verfällt ';
$lang['open']['20'] = ' Tage';
$lang['open']['21'] = ' Verfällt nie ';
$lang['open']['22'] = 'Dateilinks per Email verschicken ';
$lang['open']['23'] = 'Geschwindigkeitsbegrenzung ';
$lang['open']['24'] = ' KBPS';
$lang['open']['25'] = ' Kein Limit';
$lang['open']['26'] = 'Accounts verfügbar';
$lang['open']['27'] = 'Unbegrenzt';
$lang['open']['28'] = 'Accounts verfügbar';
$lang['open']['29'] = 'Jetzt anmelden!';
$lang['open']['30'] = 'Keine Anmeldung';
$lang['open']['31'] = '  Jetzt anmelden!';
$lang['open']['32'] = 'Diese Dateitypen sind ';
$lang['open']['33'] = 'nicht ';
$lang['open']['34'] = 'Dateityp';
$lang['open']['35'] = 'Downloads';
$lang['open']['36'] = 'Jetzt herunterladen!';
$lang['open']['37'] = 'erlaubt: ';

// END FILE: include/open.functions.inc.php
####################################
####################################
####################################
// BEGIN FILE: ./include/functions.inc.php
$lang['functions'] = array(); 
$lang['functions']['1'] = 'Datei existiert nicht';
$lang['functions']['2'] = 'Datei wurde gelöscht';
$lang['functions']['3'] = 'Datei gefunden!';
$lang['functions']['4'] = 'Datei gelöscht!';
$lang['functions']['5'] = 'Datei entfernt!';
$lang['functions']['6'] = 'Datei abgelaufen!';
$lang['functions']['7'] = 'Datei nicht gefunden!';
$lang['functions']['8'] = 'Noch keine Datei heruntergeladen bei dieser Sitzung';
$lang['functions']['9'] = '';
// END FILE: ./include/functions.inc.php
####################################
####################################
####################################
// BEGIN FILE: ./download_summary.tpl.php
$lang['download_summary'] = array(); 
$lang['download_summary']['1'] = 'Dateiname';
$lang['download_summary']['2'] = 'Uploader';
$lang['download_summary']['3'] = 'Dateigröße';
$lang['download_summary']['4'] = 'Downloads';
$lang['download_summary']['5'] = ' Transfervolumen';
$lang['download_summary']['6'] = 'MB pro Stunde';
$lang['download_summary']['7'] = ' Beschreibung';
$lang['download_summary']['8'] = 'Wenn du eine Datei herunterlädst akzeptierst du unsere ';
$lang['download_summary']['9'] = 'AGB';
$lang['download_summary']['10'] = '';
// END FILE: ./download_summary.tpl.php
####################################
####################################
####################################
// BEGIN FILE: ./include/kernel/news.php
$lang['news'] = array(); 
$lang['news']['1'] = 'Erstellt am: ';
$lang['news']['2'] = 'von: ';
$lang['news']['3'] = 'Klicke hier um mehr zu lesen!';
$lang['news']['4'] = '';
// END FILE: ./include/kernel/news.php
####################################
####################################
####################################
// BEGIN FILE: ./include/kernel/header.php
$lang['forgotpass'] = array(); 
$lang['forgotpass']['1'] = 'Sorry, deine Emailadresse kann nicht in unserer Datenbank gefunden werden, bitte versuche es erneut!';
$lang['forgotpass']['2'] = 'Hallo ';
$lang['forgotpass']['3'] = 'Dein Passwort wurde zurück gesetzt ';
$lang['forgotpass']['4'] = 'Benutzername';
$lang['forgotpass']['5'] = '(neues)Passwort';
$lang['forgotpass']['6'] = 'Bitte merke dir das neue Passwort.';
$lang['forgotpass']['7'] = 'Bitte antworte nicht auf diese Email';
$lang['forgotpass']['8'] = 'Vielen Dank!';
$lang['forgotpass']['9'] = 'Mitarbeiter';
$lang['forgotpass']['10'] = 'Dein Passwort wurde geändert und dir per Email zugeschickt. <br />
Bitte prüfe deinen SPAM Filter wenn du keine Email erhälst.';
$lang['forgotpass']['11'] = 'Account Passwort zurück gesetzt';
$lang['forgotpass']['12'] = 'Passwort vergessen';
$lang['forgotpass']['13'] = 'Emailadress: ';
// END FILE: ./include/kernel/header.php
####################################
####################################
####################################
// BEGIN FILE: ./include/kernel/delfile.php
$lang['delfile'] = array(); 
$lang['delfile']['1'] = 'Die Datei wurde nicht gefunden.';
$lang['delfile']['2'] = 'Du wirst zur Hauptseite weitergeleitet.';
$lang['delfile']['3'] = 'Die Datei wurde nicht gefunden';
$lang['delfile']['4'] = 'Die Datei wurde erfolgreich gelöscht.';
$lang['delfile']['5'] = 'Datei löschen: ';
$lang['delfile']['6'] = 'OK, deine Datei wird nicht gelöscht.\nDu wirst zur Hauptseite weitergeleitet.';
$lang['delfile']['7'] = 'Bist du dir sicher das du diese Datei löschen möchtest?\nWenn du erstmal auf JA geklickt hast kann die Datei nicht wiederhergestellt werden!';
$lang['delfile']['8'] = ' Ja, lösche diese Datei. ';
$lang['delfile']['9'] = ' Nein, behalte die Datei. ';
$lang['delfile']['10'] = 'Datei löschen';
$lang['delfile']['11'] = '';
// END FILE: ./include/kernel/delfile.php
####################################
####################################
####################################
// BEGIN FILE: ./include/kernel/comments.php
$lang['comments'] = array(); 
$lang['comments']['1'] = 'Bitte wartem du wirst zum Download zurück geleitet. ';
$lang['comments']['2'] = 'Dein Kommentar wurde hinzugefügt!';
$lang['comments']['3'] = 'Der Kommentar wurde ';
$lang['comments']['4'] = 'versteckt';
$lang['comments']['5'] = 'hinzugefügt';
$lang['comments']['6'] = 'Der Kommentar wurde gelöscht!';
$lang['comments']['7'] = 'Der Kommentar wurde geändert!';
$lang['comments']['8'] = 'Name:';
$lang['comments']['9'] = 'Kommentartitel:';
$lang['comments']['10'] = 'Homepage Adresse:';
$lang['comments']['11'] = 'Emailadress:';
$lang['comments']['12'] = 'Kommentar:';
$lang['comments']['13'] = 'Kommentar bearbeiten';
$lang['comments']['14'] = 'Formular zurück setzen';
$lang['comments']['15'] = 'Keine Aktion ausgewählt, kann Anfrage nicht bearbeiten';
$lang['comments']['16'] = '';
// END FILE: ./include/kernel/comments.php
####################################
####################################
####################################
// BEGIN FILE: ./include/kernel/userFolders.php
$lang['userFolders'] = array(); 
$lang['userFolders']['1'] = 'Ordnerverwaltung ';
$lang['userFolders']['2'] = 'Ordnername';
$lang['userFolders']['3'] = 'Ordnercode';
$lang['userFolders']['4'] = 'Aktion';
$lang['userFolders']['5'] = 'Kein Name';
$lang['userFolders']['6'] = 'Zeige Dateiordner';
$lang['userFolders']['7'] = 'Ordneradmin';
$lang['userFolders']['8'] = 'Lösche Dateiordner';
$lang['userFolders']['9'] = '';
// END FILE: ./include/kernel/userFolders.php
####################################
####################################
####################################
// BEGIN FILE: ./include/kernel/usercp.php
$lang['usercp'] = array(); 
$lang['usercp']['1'] = 'Benuterkontoverwaltung ';
$lang['usercp']['2'] = '5 neuesten Dateiploads ';
$lang['usercp']['3'] = 'Persönliche Einstellungen ';
$lang['usercp']['4'] = 'Zeige mehr Dateien';
$lang['usercp']['5'] = ' 5 neuesten Dateiordner';
$lang['usercp']['6'] = 'Deine Benutzungsstatistik';
$lang['usercp']['7'] = 'Ordnername';
$lang['usercp']['8'] = 'Ordnercode';
$lang['usercp']['9'] = 'Aktion';
$lang['usercp']['10'] = 'Kein Name';
$lang['usercp']['11'] = 'Zeige alle deine Ordner';
$lang['usercp']['12'] = 'Anzahl von Uploads:';
$lang['usercp']['13'] = 'Odneranzahl:';
$lang['usercp']['14'] = 'Gesammte Punkte: ';
$lang['usercp']['15'] = 'Insgesamt genutzter Speicher: ';
$lang['usercp']['16'] = 'Zeige alle Dateien';
$lang['usercp']['17'] = 'Erstelle neuen Ordner';
$lang['usercp']['18'] = '';
// END FILE: ./include/kernel/usercp.php
####################################
####################################
####################################
// BEGIN FILE: ./include/kernel/rss.php
$lang['rss'] = array(); 
$lang['rss']['1'] = 'RSS Feeds';
$lang['rss']['2'] = 'Hier haben wir einige RSS Feeds für hochgeladene Dateien.';
$lang['rss']['3'] = 'TOP 10 Dateien';
$lang['rss']['4'] = '10 am ausgesuchte Dateien';
$lang['rss']['5'] = '10 am wenigsten heruntergeladene Dateien  ';
$lang['rss']['6'] = '';
// END FILE: ./include/kernel/rss.php
####################################
####################################
####################################
// BEGIN FILE: ./include/kernel/report.php
$lang['report'] = array(); 
$lang['report']['1'] = 'Datei gemeldet, vielen Dank!';
$lang['report']['2'] = 'Datei melden';
$lang['report']['3'] = 'Um eine Datei zu melden die gegen unsere AGB verstößt kopiere den Dateilink in die Box unterhalb, wir werden dies dann prüfen.';
$lang['report']['4'] = 'Dateilink: ';
$lang['report']['5'] = 'Datei melden';
$lang['report']['6'] = '';
// END FILE: ./include/kernel/.php
####################################
####################################
####################################
// BEGIN FILE: ./include/kernel/linkchecker.php
$lang['linkchecker'] = array(); 
$lang['linkchecker']['1'] = 'Prüfe deine Dateilinks ';
$lang['linkchecker']['2'] = 'Du kannst diese Funktion nutzen um Dateilinks auf ihre Gültigkeit hin zu überprüfen.<br />
Kopiere einfach die Dateilinks (einen pro Zeile) unterhalb in die Textbox und drücke auf überprüfen. Danach wird dir ausgegeben welche Links noch gültig sind und welche nicht';
$lang['linkchecker']['3'] = 'Überprüfe Links ';
$lang['linkchecker']['4'] = ' von ';
$lang['linkchecker']['5'] = 'Links sind gültig ';
$lang['linkchecker']['6'] = 'Prüfe noch mehr Links!';
$lang['linkchecker']['7'] = 'Prüfe Links';
$lang['linkchecker']['8'] = 'Prüfe noch mehr Links!';
$lang['linkchecker']['9'] = '';
// END FILE: ./include/kernel/linkchecker.php
####################################
####################################
####################################
// BEGIN FILE: ./include/kernel/file_upload.php
$lang['file_upload'] = array(); 
$lang['file_upload']['1'] = 'Diese Datei kann nicht direkt aufgerufen werden. ';
$lang['file_upload']['2'] = 'Verstecke BB Codes';
$lang['file_upload']['3'] = 'Zeige BB Codes';
$lang['file_upload']['4'] = 'Die Datei die du hochgeladen hast wurde bereits hochgeladen. <br />
Here are the file details.';
$lang['file_upload']['5'] = '';
// END FILE: ./include/kernel/file_upload.php
####################################
####################################
####################################
// BEGIN FILE: ./include/kernel/files.php
$lang['files'] = array(); 
$lang['files']['1'] = 'Bitte wähle einen Ordner aus wo die Datei hinzugefügt werden soll.';
$lang['files']['2'] = 'Füge zum Ordner hinzu?';
$lang['files']['3'] = 'Hinzufügen';
$lang['files']['4'] = 'Füge Dateien zum Ordner hinzu';
$lang['files']['5'] = '';
// END FILE: ./include/kernel/files.php
####################################
####################################
####################################
// BEGIN FILE: ./include/kernel/.php
$lang['kernelUpload'] = array(); 
$lang['kernelUpload']['1'] = 'Datei hochladen';
$lang['kernelUpload']['2'] = 'Hallo ';
$lang['kernelUpload']['3'] = 'Hallo, jemand hat eine Datei hochgeladen und möchte das du dir diese anschaust. ';
$lang['kernelUpload']['4'] = 'Die Detaisl über diesen Vorgang findest du unterhalb:';
$lang['kernelUpload']['5'] = 'Name:';
$lang['kernelUpload']['6'] = 'Beschreibung: ';
$lang['kernelUpload']['7'] = 'Passwort: ';
$lang['kernelUpload']['8'] = 'Downloadlink: ';
$lang['kernelUpload']['9'] = 'Größe: ';
$lang['kernelUpload']['10'] = 'Vielen Dank!';
$lang['kernelUpload']['11'] = '- Dein ';
$lang['kernelUpload']['12'] = 'Team ';
$lang['kernelUpload']['13'] = 'Diese Nachricht wurde automatisch erstellt, bitte antworte nicht auf diese Email.';
$lang['']['14'] = '';
$lang['']['15'] = '';
$lang['']['16'] = '';
$lang['']['17'] = '';
$lang['']['18'] = '';
$lang['']['19'] = '';
$lang['']['20'] = '';
$lang['']['21'] = '';
$lang['']['22'] = '';
$lang['']['23'] = '';
$lang['']['24'] = '';
$lang['']['25'] = '';
// END FILE: ./include/kernel/.php
####################################
####################################
####################################
// BEGIN FILE: ./include/kernel/uploadError.php
$lang['uploadError'] = array(); 
$lang['uploadError']['1'] = 'Die Datei die hochgeladen wurde is zu groß!';
$lang['uploadError']['2'] = 'Die Datei die du hochgeladen hast ist zu groß um das sie bei uns gespeichert werden könnte.';
$lang['uploadError']['3'] = 'Größere Dateien sind eventuell möglich wenn du deinen derzeitigen Account upgradest ';
$lang['uploadError']['4'] = 'upgradest';
$lang['uploadError']['5'] = ' oder ';
$lang['uploadError']['6'] = 'du dich in einen existierenden';
$lang['uploadError']['7'] = ' einloggst.';
$lang['uploadError']['8'] = 'FTP Login ist mit den angegebenen Daten nicht möglich!';
$lang['uploadError']['9'] = 'FTP Login Fehler';
$lang['uploadError']['10'] = 'Die FTP Login Daten die du angegeben hast sind nicht korrekt.';
$lang['uploadError']['11'] = 'Die Datei die du hochgeladen hast wird von unserem System nicht geduldet!';
$lang['uploadError']['12'] = 'Die Datei die du hochgeladen hast wird von unserem System nicht geduldet';
$lang['uploadError']['13'] = 'Wir haben meherere Meldungen erhalten das die hochgeladen Datei gegen unsere ';
$lang['uploadError']['14'] = 'ein unbekannter Fehler ist entstanden';
$lang['uploadError']['15'] = 'Auf unserem System ist ein Fehler entstanden den du nicht ändern kannst.';
$lang['uploadError']['16'] = 'unser Team wurde informiert, wir werden das Problem so schnell wie möglich beheben.';
$lang['uploadError']['17'] = '';
// END FILE: ./include/kernel/uploadError.php
####################################
####################################
####################################
// BEGIN FILE: ./include/kernel/.php
$lang[''] = array(); 
$lang['']['1'] = '';
$lang['']['2'] = '';
$lang['']['3'] = '';
$lang['']['4'] = '';
$lang['']['5'] = '';
$lang['']['6'] = '';
$lang['']['7'] = '';
$lang['']['8'] = '';
$lang['']['9'] = '';
$lang['']['10'] = '';
$lang['']['11'] = '';
$lang['']['12'] = '';
$lang['']['13'] = '';
$lang['']['14'] = '';
$lang['']['15'] = '';
$lang['']['16'] = '';
$lang['']['17'] = '';
$lang['']['18'] = '';
$lang['']['19'] = '';
$lang['']['20'] = '';
$lang['']['21'] = '';
$lang['']['22'] = '';
$lang['']['23'] = '';
$lang['']['24'] = '';
$lang['']['25'] = '';
// END FILE: ./include/kernel/.php
// MISC Language ( spans multiple pages)
$lang['misc'] = array(); 
$lang['misc']['1'] = 'Seite Nummer:';
$lang['misc']['2'] = 'Wähle eine Seite';
$lang['misc']['3'] = 'Seite';
$lang['misc']['4'] = 'Anzahl von Ergebnissen: ';
$lang['misc']['5'] = '';
$lang['misc']['6'] = '';
$lang['misc']['7'] = '';
$lang['misc']['8'] = '';
$lang['misc']['9'] = '';
$lang['misc']['10'] = '';
?>