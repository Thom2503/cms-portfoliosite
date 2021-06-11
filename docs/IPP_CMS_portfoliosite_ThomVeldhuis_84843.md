# IPP CMS Portfoliosite

*Thom Veldhuis - 84843 - i2b*

![](/Users/thom2503/Documents/School/Leerjaar 2/Beroeps/cms-portfoliosite-main/docs/cover_image.jpg)

# Table of contents

[TOC]



# Opdrachtomschrijving en debriefing

## Opdrachtomschrijving

Er gaat een website gemaakt worden, voor studenten en bedrijven. Hier worden portfolio projecten opgezet van studenten waar bedrijven naar kunnen kijken. Studenten hebben een eigen pagina met een overzicht van hun portfolio projecten die zij kunnen toevoegen, aanpassen en verwijderen.

Bedrijven kunnen een homepagina bekijken waar zij eerst een account voor moeten krijgen door een email te sturen waar zij als reactie een link naar een account maken pagina kijken. Zij kunnen op de homepagina filteren en sorteren.

Er moeten video's, foto's en pdf toegevoegd kunnen worden aan de project pagina's, die worden in de pagina zelf bekeken en niet bekeken. Er moet op de about me pagina de naam, leeftijd en een overzicht van alle projecten laten zien.

## Debriefing

Wij hebben geen einddatum bedacht voor dit na het gesprek, ik ga daarom met een scrum methode gebruiken om mijn werk bij te houden. Hier staan paar velden in, backlog, to do, doing, review en done. Daar hou ik bij waar ik ben, wat ik nog moet doen en waar ik mee klaar ben.

Dit zijn alle vragen die ik heb gesteld tijdens het gesprek met de klant:

- Wat voor informatie zou aangepast moeten worden in de portfolio pagina's en op de cv pagina.
  - Uploaden aan eigen systeem, aanpassen content. Titel, omschrijving en bijlage.

- Moet er een bepaalde style zijn?
  - GLR style als op de website.

- Moeten videos en foto's gelijk op de webpagina laten zien
  - Ja

- Moet pdf als download er bij komen?
  - Ja, moet er in de pagina door heen kunnen scrollen.

- Wat moet er op de homepagina komen te staan
  - Overzicht van verschillende studenten. Gesorteerd en gefilterd worden na het aanmaken van een account of inloggen. sorteren op php of werk bijvoorbeeld.

- Welke informatie mag wel en niet gezien worden door niet ingelogde gebruikers
  - studenten alleen van zichzelf hun eigen portfolio. En bedrijven kunnen een overzicht zien van alle portfolios.

Er was nog wat extra informatie die ik er bij moest weten.

Er moet namelijk ook gechecked worden dat er geen virussen worden geupload wanneer een gebruiker media toevoegd. Dus ik moet checken voor mp4, png, jpeg, jpg, gifs en pdf. Alle andere soorten media moeten niet geaccepteerd worden.

Alle invoervelden worden ook grondig gecontroleerd. Om xss tegen te gaan. Of sql injections tegen te gaan. 

Als een bedrijf een account wil krijgen moeten ze eerst een mailtje sturen, en als zij geaccepteerd worden word er een mailtje terug gestuurd waar zij naar een pagina worden gestuurd waar zij dan een account kunnen maken.

De styling extra moet in de style van de GLR main website zijn, dus dat betekend alle logo's en fonts worden gebruikt op deze website. Het logo word gebruikt als SVG, zodat het makkelijk ingezoomd en uitgezoomd kan worden. Als de font niet gratis is moet ik een andere font downloaden die er op lijkt.

# Beeldvorming

## MoSCoW Analyse

### Must do

- Inlog pagina voor studenten
- Mail pagina voor bedrijven
- Inlog pagina voor bedrijven
- Portfolio bekijken, bewerken en verwijderen
- pdf in pagina kunnen bekijken
- Foto's en video's in de pagina kunnen kijken
- Bedrijven homepagina
- Homepagina sorteren en filteren
- Logo en fonts in de style van glr.

### Should do

- Studenten foto's op de studenten pagina's
- CV pagina met personalia, opleidingen en werkervaringen enz.

### Could do

- Extra media types toevoegen, zoals webp enz.
- Admin pagina waar de bedrijven die niet meer de website op mogen, verwijderd kunnen worden
- Meerdere Media kunnen uploaden

### Would do

- Markdown voor portfolio projecten
- CV en andere projecten naar pdf kunnen exporteren met plaatjes er bij
- Studenten kunnen zoeken

# Planning

Tijdens dit project werk ik niet met een deadline maar met een scrum techniek.
Mijn scrum board ziet er zo uit:

![](/Users/thom2503/Documents/School/Leerjaar 2/Beroeps/cms-portfoliosite-main/docs/scrumboard_thom.PNG)

En een link naar trello zelf:
[Link naar trello](https://trello.com/b/o7yuWTiT)

# Doel en doelgroep

## Doel

Het doel van deze site is zodat studenten een plek hebben om hun projecten te uploaden en te tonen aan bedrijven die misschien, stagiaires of werknemers zoeken. Bedrijven moeten hier dus ook kunnen zoeken naar verschillende opleidingen om zo een perfecte keuze te kunnen maken voor wat zij zoeken.

## Doelgroep

### Doelgroep 1 - Bedrijven

Bedrijven komen naar deze website om te zoeken naar studenten met een goed portfolio zodat zij die kunnen aannemen als stagiaire of als werknemer.

### Doelgroep 2 - Studenten

Studenten gebruiken deze site om hun projecten te tonen. Om dus aangenomen te kunnen worden voor bijvoorbeeld een stage. Dit kan ook voor hun een manier zijn om werk te tonen aan elkaar.

# Inhoud

Er komen er komen ongeveer 6 verschillende pagina's die allemaal iets anders doen. Je hebt een inlog pagina, die is voor als je al een account hebt. Als je die nog niet hebt kan je die aanmaken, of aanvragen in het geval van een bedrijf. Die krijgt een mailtje met een andere link naar een andere pagina.

Je hebt een aparte studenten pagina waar zij een overzicht kunnen vinden van hun projecten. Die projecten kunnen zijn toevoegen, bewerken, verwijderen of bekijken via andere pagina's.

De bedrijven kunnen ook naar een homepagina waar zij studenten kunnen vinden. Die kunnen daar ook sorteren en filteren op bepaalde opleidingen.

## Functioneel Ontwerp

Flowchart voor de website:

![](/Users/thom2503/Documents/School/Leerjaar 2/Beroeps/cms-portfoliosite-main/docs/flowchart_cms.svg)

## Technisch Ontwerp

### Database ontwerp

![](/Users/thom2503/Documents/School/Leerjaar 2/Beroeps/cms-portfoliosite-main/docs/cms_database.svg)

### Technologien

- PHP 7.3

  Dit is voor alles wat met de backend te maken heeft, connectie met de database enzovoorts.

- HTML 5

  Geeft de structuur van de website.

- CSS 3

  Brengt styling aan de website

- Javascript

  Voor extra client sided dingen die ik niet in PHP kan doen.

- MySQL

  Voor de database queries

## Grafisch Ontwerp

### Wireframes

![](/Users/thom2503/Documents/School/Leerjaar 2/Beroeps/cms-portfoliosite-main/docs/cms_inlog.svg)

Inlogpagina

![](/Users/thom2503/Documents/School/Leerjaar 2/Beroeps/cms-portfoliosite-main/docs/cms_student.svg)

Studentenpagina

![](/Users/thom2503/Documents/School/Leerjaar 2/Beroeps/cms-portfoliosite-main/docs/cms_account_maken.svg)

Account aanmaken voor studenten

![](/Users/thom2503/Documents/School/Leerjaar 2/Beroeps/cms-portfoliosite-main/docs/cms_project_bekijken.svg)

Project bekijken

![](/Users/thom2503/Documents/School/Leerjaar 2/Beroeps/cms-portfoliosite-main/docs/cms_project.svg)

Project aanpassen, verwijderen of toevoegen.

![](/Users/thom2503/Documents/School/Leerjaar 2/Beroeps/cms-portfoliosite-main/docs/cms_bedrijf_maken.svg)

Bedrijf account aanmaken

![](/Users/thom2503/Documents/School/Leerjaar 2/Beroeps/cms-portfoliosite-main/docs/cms_homepage.svg)

Homepagina

![](/Users/thom2503/Documents/School/Leerjaar 2/Beroeps/cms-portfoliosite-main/docs/cms_homepage_kleur.svg)

Homepagina met kleur

### Kleuren en fonts

#### Kleuren

- Zwart
- Wit
- Grijs (RGB 102/102/102)
- Groen (RGB 143/229/007) (#8fe507)

##### Opleiding kleuren

- AV Media (RGB 255/221/000)
- Redactie medewerker (RGB 231/049/136)
- Mediamanagement (RGB 245/156/000)
- Mediavormgeven (RGB 228/004/040)
- Creative productie (RGB 120/063/145)
- Mediatechnologie (RGB 000/099/175)
- Evenemententechniek (RGB 045/184/197)

#### Fonts

- Nimbus sans

# Onderhoud en promotie

## Onderhoud

Er zijn paar dingen die onderhoud moeten krijgen na het afmaken van dit project.

- Bestanden van projecten.

  Bij elk project komen bestanden maar die zou je niet voor eeuwig kunnen opslaan dus die zouden eens in de zoveel jaar verwijderd moeten worden.

- Gebruikers verwijderen

  Het kan zijn dat een student klaar is met de opleiding en een nieuwe plek heeft om zijn of haar projecten te laten zien, die zouden dan verwijderd moeten kunnen worden. Hetzelfde geld voor bedrijven die het niet meer nodig vinden om de website te gebruiken.

- Bugs

  Er zijn altijd bugs in een applicatie en die kun je niet allemaal weg halen zonder dat er nieuwe bijkomen daar zou dus extra opgelet worden als er onderhoud plaats vind.

- Optimalisatie

  Het internet groeit qua gebruikers maar ook in snelheid, maar dat betekent niet dat alles snel gaat op jouw website. Met die verandering moet er zeker rekening gehouden worden.

## Promotie

Promotie kan via deze dingen gedaan worden en dat ga ik er ook in bouwen.

- SEO optimalisatie

  Dit kan je doen door meta tags te gebruiken in html. Geen divs meer gebruiken. Correcte titels enz.

- Op school

  Het is voor studenten bedoeld dus het zou zo veel mogelijk op school worden laten zien. En leraren moeten studenten aanraden om de site te gebruiken.

- Bedrijven

  Je kan bedrijven bijvoorbeeld kunnen helpen die stagiaires zoeken door ze deze website te laten zien.

- Optimalisatie

  Een langzame website wilt niemand gebruiken dus daar moet zeker rekening mee gehouden worden.

