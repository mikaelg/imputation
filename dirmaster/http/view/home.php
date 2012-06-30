<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
    <title></title>
</head>

<body>
    <div class="hero-unit">
        <h1>Imputation</h1>

        <p>Een Object-ge&ouml;ri&euml;nteerd project in het kader van de Eduvision cursus "Masterclass PHP"</p>

        <p><a class="btn btn-primary btn-large" href="/login">LOGIN</a></p>
    </div>

    <div class="row">
        <div class="span2">
            <h1>Overzicht</h1>

            <ul>
                <li><a href="/login">login</a></li>

                <li><a href="/overview">Overview</a></li>

                <li><a href="/project/testproject">Project "testproject"</a></li>

                <li><a href="/employee">Employee</a></li>

                <li><a href="/imputation">Imputation</a></li>
            </ul>
        </div>

        <div class="span10">
            <h1>Opdrachtomschrijving</h1>

            <p>&nbsp;</p>

            <blockquote style="font-style: italic">
                <h2>Envisioning:</h2>

                <p>Een bedrijf heeft projecten voor verschillende klanten waar medewerkers type-uren op registreren en projectmanagers rapporten uit kunnen trekken.</p>
            </blockquote>

            <p>Niet alle mogelijke aspecten van dit programma werden uitgewerkt, aangezien dit binnen het voorziene tijdsbestek onmogelijk was.<br>
            De volgende gebruiksscenario's zijn in code uitgewerkt:<br>
        	</p>

            <ul>

                <li>Inloggen</li>

                <li>Overzicht van projecten met zoekfunctie op startdatum</li>
                
                <li>Detailpagina van een project</li>
                
                <li>Detailpagina van een personeelslid</li>

                <li>Uren imputeren</li>

                <li>Uitloggen</li>
                
                <li>404 errorpagina</li>

            </ul>

         	<p>De applicatie is gestoeld op de MVC-filosofie, waar de Model-classes zorgen voor de verbinding met de databank en de implementatie van de business-logic uit de "Common" classes (zie volgende paragraaf).
        	De Controller dient voor het nemen van beslissingen op applicatie-vlak en sluist gegevens door van de Model-laag naar de View-laag. Een Run en Router class zorgen er in combinatie
        	met de Apache module mod_rewrite voor dat de juiste controller wordt gekozen en dat de juiste parameters eraan worden meegegeven.</p>

        	<p>Het systeem werd zodanig geschreven dat er later andere functionaliteit kan worden toegevoegd. Denk hierbij aan HRM, CRM, Boekhouding, Facility-management, etc. 
         	Om de business-logic hiervoor los te koppelen van de MVC architectuur is er gekozen voor een aparte namespace, genaamd "Common". In deze classes worden de 
         	objectrelaties vastgelegd die in het classdiagram van de "Common" namespace (zie verderop) zijn vastgelegd . De classes in deze namespace zijn, in het kader van deze loskoppeling,
         	onafhankelijk van de databanklaag en doen derhalve geen enkele databankoperatie. Ze dienen puur voor hi&euml;rarchische structurering, vastleggen van invul-verplichting en
         	business-logica. In dit geval worden ze dus gebruikt als verlengde van de Model-laag van de MVC architectuur. </p>

            

            <p>Er werden ook, in het kader van de cursus, een aantal unit-tests geschreven om basisfunctionaliteit van de common classes te testen doorheen het ontwikkelproces. Er is 
            gekozen voor PHPUnit als unit-testing framework.</p>

			<p>Om het grafische aspect toch op een effici&euml;nte manier enige vorm te geven is er voor de View-laag gekozen voor het Twitter Bootstrap framework. Dit biedt basisfunctionaliteit voor o.a. alert-boxes 
				en een adaptive layout voor verschillende devices.<br />
				Er werd een eigen templating systeem gemaakt dat gebruik maakt van standaard PHP code die de inhoud van een dynamic content registry tussen de HTML zet.</p>

            <p>De volgende functionaliteiten werden in de analysefase meegenomen, maar er werd voor gekozen om wegens het beperkte tijdsbestek de volgende aspecten niet in productie te nemen:<br></p>
            
            <ul>
               
                <li>Rapporten genereren op basis van de ingevoerde prestaties</li>

                <li>Project management</li>

                <li>Visualiseren klantgegevens</li>

                 <li>Wijzigen van wachtwoord</li>

                <li>...</li>
                <li>...</li>
                <li>...</li>
            </ul>

            <p>
                Tevens werd er <strong>geen</strong> rekening gehouden met client-side controle van de input in de invoerformulieren. Ten eerste omdat dergelijke controles enkel dienen om de usability te verbeteren en
                de uiteidelijke controle toch op server-niveau moet gebeuren; ten tweede omdat het een PHP cursus is, geen JavaScript cursus.<br />
                Opnieuw pre-fillen van de ingevoerde waarden na het falen van een server-side controle wordt hier dan ook niet gedaan. 
            </p>

         </div>
    </div>

    <div class="row">
        <div class="span2">
            &nbsp;
        </div>

        <div class="span10">
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="span2">
            &nbsp;
        </div>

        <div class="span10">
            <h1>UML diagrammen</h1>
        </div>
    </div>

    <div class="row">
        <div class="span2">
            &nbsp;
        </div>

        <div class="span5">
            <h2>Mika&euml;l</h2>

            <ul>
            	<!-- haal de type="circle" weg als je een document hebt geupload en de URL hier hebt ingevuld-->

                <li type="circle"><a href="./_documentatie/" target="_blank">Use Case 1: Overzicht van projecten opvragen</a></li>

                <li type="circle"><a href="./_documentatie/" target="_blank">Use Case 2: ???</a></li>

                <li type="circle"><a href="./_documentatie/" target="_blank">Activity diagram 1: ????</a></li>

                <li type="circle"><a href="./_documentatie/" target="_blank">Activity diagram 2: ????</a></li>

                <li ><a href="./_documentatie/IMPUTATION_CLASS_MVC_authentication.pdf" target="_blank">Class diagram 1: MVC authentication</a></li>
                <li ><a href="./_documentatie/IMPUTATION_CLASS_MVC_pages.pdf" target="_blank">Class diagram 2: MVC pages (na inloggen)</a></li>
            </ul>
        </div>

        <div class="span5">
            <h2>Georges</h2>

            <ul>
            	<!-- haal de type="circle" weg als je een document hebt geupload en de URL hier hebt ingevuld-->

                <li><a href="./_documentatie/USE_CASE_imputerenVanUren.pdf" target="_blank">Use Case 1: Imputeren van uren</a></li>

                <li type="circle"><a href="./_documentatie/" target="_blank">Use Case 2: ???</a></li>

                <li><a href="./_documentatie/ACTIVITY_DIAGRAM_imputerenVanUren.pdf" target="_blank">Activity diagram 1: Imputeren van uren</a></li>

                <li><a href="./_documentatie/ACTIVITY_DIAGRAM_Login.pdf" target="_blank">Activity diagram 2: Inloggen</a></li>

                <li><a href="./_documentatie/CLASS_DIAGRAM_CommonNamespace.pdf" target="_blank">Class diagram: De Common Namespace</a></li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="span2">
            &nbsp;
        </div>

        <div class="span10">
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="span2">
            &nbsp;
        </div>

        <div class="span10">
            <h1>Code Repository</h1>
        </div>
    </div>

    <div class="row">
        <div class="span2">
            &nbsp;
        </div>

        <div class="span10">
            <p>Voor het versiebeheer van onze code hebben we er in overleg met de lesgever voor gekozen om GIT te gebruiken in plaats van Subversion.
            Op <a href="http://www.github.com" target="_blank">Github.com</a> heb je de mogelijkheid om een gratis GIT repository te laten hosten, op voorwaarde dat het een open-source project is.</p>

            <p>De repository waar onze code in terug te vinden is kan je hier bekijken:<br>
            <a href="https://github.com/mikaelg/imputation" target="_blank">https://github.com/mikaelg/imputation</a><br>
            Aangezien het een open-source project is, hoef je dus ook niet in te loggen om de code te kunnen bekijken.</p>
        </div>
    </div>

    <div class="row">
        <div class="span2">
            &nbsp;
        </div>

        <div class="span10">
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="span2">
            &nbsp;
        </div>

        <div class="span10">
            <h1>Live site</h1>
        </div>
    </div>

    <div class="row">
        <div class="span2">
            &nbsp;
        </div>

        <div class="span10">
            <p>
            De live site staat hier:<br />
            <a href="http://imputation.worldimagemap.com" target="_blank">http://imputation.worldimagemap.com</a>
            <br />
            <br />
            Inloggen kan je <a href="/login">hier</a> met user "frb" en wachtwoord "1234567"
            <br />
            </p>
            <p>
            Op de project overzicht pagina krijg je resultaten als je zoekt met volgende data
        	</p>
            <ul>
           	 <li>14/05/2012 of vroeger geeft alle resultaten</li>
           	 <li>15/05/2012 en 16/05/2012 geven elk 1 project weer</li>
            </ul> 
        </div>
    </div>

    <div class="row">
        <div class="span2">
            &nbsp;
        </div>

        <div class="span10"></div>
    </div>
</body>
</html>
