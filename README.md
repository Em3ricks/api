# api

För denna del av uppgiften har ett enklare API skapats med en CRUD-metodik innehållande
funktioner för att skapa, läsa, uppdatera och radera värden mot en databasanslutning. 
Observera dock att endast funktioner för att läsa och uppdatera har implementerats i steg två, 
skapandet av webbtjänsten, men färdiga funktioner för de andra två bitarna är ändå skapade i 
mitt API. 
Jag har tillämpat en objektorienterad approach där jag har två huvudklasser jag arbetar i, en klass
för databasanslutningen och en klass för mina funktioner. Funktionerna är skriva i PHP och kommer
senare att konsumeras av min webbtjänst med FETCH. 
Sammantaget hämtar funktionen för att läsa ut data från min databas den information som är lagrad där 
och konverterar denna till en array. Denna array lagrar jag sedan i en egen variabel och fortsatt
även dess fyra kolumner i varsin variabel. När jag har informationen på detta vis blir det sedan enkelt
att läsa ut denna och ge mina olika värden relevanta överskrifter senare i min webbtjänst. I filen
för att skapa värden tillämpar jag en liknande metodik men här formulerar jag en SQL-fråga som säger att
de variabler jag tidigare kopplade till de olika kolumnerna är också den information som ska matas in 
i databasen. Dessa värden behöver jag senare bara binda till mitt formulär så att vid ifyllnad av 
formulärets fält så matas strängen in i respektive variabel, konverteras efter behov och matas sedan
in i rätt fält genom min SQL-fråga.

Länk till webbtjänst för testkörning:
http://studenter.miun.se/~joem1800/writeable/Moment5/pub/
