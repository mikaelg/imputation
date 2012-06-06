<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
    <title></title>
</head>

<body>
    <div class="hero-unit">
        <h1>Imputation</h1>

        <p>Om gebruik te maken van het Imputation project dien je te beschikken over een geldige login en paswoord.</p>

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
			<p>&nbsp;
			</p>
			<blockquote style="font-style: italic"><h2>Envisioning:</h2>
            <p>Een bedrijf heeft projecten voor verschillende klanten waar medewerkers type-uren op registreren en projectmanagers rapporten uit kunnen trekken.</blockquote></p>

			<p>
		
			
			Niet alle mogelijk aspecten van dit programma werden uitgewerkt, aangezien dit binnen het voorziene tijdsbestek onmogelijk was.<br />
			De volgende use cases zijn in code uitgewerkt:<br />
				<ul>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
				</ul>
			
			Deze functionaliteiten werden bewust weggelaten:<br />
				<ul>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
				</ul>
					
			<p>
			Het systeem werd zodanig geschreven dat er later andere functionaliteit kan worden toegevoegd. Denk hierbij aan HRM, CRM, Boekhouding, Facility-management, etc.
			Om de business-logic hiervoor los te koppelen van de MVC architectuur is er gekozen voor een aparte namespace, genaamd "Common". In deze classes worden de objectrelaties vastgelegd die in het classdiagram van de common namespace zijn vastgelegd. De classes in deze namespace zijn in het kader van deze loskoppeling  onafhankelijk van de databanklaag.
			</p>
			
			<p>
			De Applicatielaag is gestoeld op de MVC-filosofie, waar de Model-classes zorgen voor de verbinding met de databank en de implementatie van de business-logic uit de common classes.
			</p>
			
			<p>
			Er werden ook, in het kader van de cursus, een aantal unit-tests geschreven om basisfunctionaliteit van de common classes te testen doorheen het ontwikkelproces. Er is gekozen voor PHPUnit als unit-testing framework. 
			</p>
            
        </div>
    </div>

	<div class="row">
        <div class="span2">
            &nbsp;
        </div>

        <div class="span10">
        	<hr />
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
				<li><a href="" target="_blank">Use Case 1: Overzicht van projecten opvragen</a></li>

                <li><a href="" target="_blank">Use Case 2: ???</a></li>

                <li><a href="" target="_blank">Activity diagram 1: ????</a></li>
                
                <li><a href="" target="_blank">Activity diagram 2: ????</a></li>
                
                <li><a href="" target="_blank">Class diagram: ????</a></li>


            </ul>
        </div>
        
        
         <div class="span5">
        	<h2>Georges</h2>
            <ul>
                <li><a href="" target="_blank" >Use Case 1: Imputeren van uren</a></li>

                <li><a href="" target="_blank">Use Case 2: ???</a></li>

                <li><a href="" target="_blank">Activity diagram 1: ????</a></li>
                
                <li><a href="" target="_blank">Activity diagram 2: ????</a></li>
                
                <li><a href="" target="_blank">Class diagram: ????</a></li>

            </ul>
        </div>
        
    </div>
    

    
    <div class="row">
        <div class="span2">
            &nbsp;
        </div>

        <div class="span10">
        	<hr />
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
        	<p>
        		Voor het versiebeheer van onze code hebben we ervoor gekozen om GIT te gebruiken in plaats van Subversion, dit omdat SVN de dag van vandaag aan zijn aftocht bezig is ten voordele van het krachtigere en meer flexibele GIT. 
        		<br />Op <a href="http://www.github.com" target=_blank>Github.com</a> heb je de mogelijkheid om een gratis GIT repository te laten hosten, op voorwaarde dat het een open-source project is.
        	</p>
        	
        	<p>
        		De repository waar onze code in terug te vinden is kan je hier bekijken:<br />
        		<a href="https://github.com/mikaelg/imputation" target="_blank">https://github.com/mikaelg/imputation</a>
        		<br />
        		Aangezien het een open-source project is, hoef je niet in te loggen om de code te kunnen bekijken.
        	</p>
       	</div>
    </div>
    
    
     <div class="row">
        <div class="span2">
            &nbsp;
        </div>

        <div class="span10">
        	<hr />
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
        	</p>
       	</div>
    </div>
    
    <div class="row">
        <div class="span2">
            &nbsp;
        </div>

        <div class="span10">
        	
       	</div>
    </div>  
    
   </body>
</html>
