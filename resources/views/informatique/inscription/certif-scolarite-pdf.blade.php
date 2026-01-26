<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attestation de Fréquentation</title>
    <style>
        /* --- Styles de base pour la mise en page A4 --- */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            /* background-color: #f0f0f0; */
            font-size: 13pt; /* Police de base */
        }

        .document-container {
            /* width: 210mm; Largeur A4 */
            /* min-height: 297mm; Hauteur A4 */
            /* margin: 30px auto; Centrage sur la page et marge externe */
            /* padding: 20mm 25mm; Marges du document (Top, Right, Bottom, Left) */
            background-color: white;
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); Ombre légère pour simuler une feuille */
            /* box-sizing: border-box; Inclusion du padding dans la largeur/hauteur */
            position: relative; /* Référence pour le pied de page absolu */
        }

        /* --- EN-TÊTE --- */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            font-size: 9pt;
            font-weight: bold;
            text-align: center;
            line-height: 1.2;
            margin-bottom: 20px;
            height: 150px;
        }

        .header-left {
            float: left;
            /* text-align: left; */
        }

        .header-right {
            float: right;
            /* text-align: right; */
        }

        .union-line {
            border-top: 1px solid black;
            padding-top: 20px;
            margin-top: 5px;
        }

        .header-separator {
            border: none;
            border-top: 2px solid black;
            margin: 40px 0;
            padding: 0;
        }

        /* --- INFORMATIONS INSTITUTIONNELLES --- */
        .institution-info {
            display: grid;
            grid-template-columns: 1fr 2fr 1fr;
            align-items: center;
            text-align: center;
            /* margin-top: 30px;
            margin-bottom: 10px; */
            font-size: 10pt;
            line-height: 1.1;
        }

        .logo-text {
            /* font-size: 14pt; */
            font-weight: bold;
            text-align: center;
            width: 250px;
            height: 150px;
            border: 2px solid black;
            position: fixed;
            top: 10px;
            left: 40%;
            /* margin-left: 50px; */
        }

        .academic-year {
            font-size: 14pt;
            margin-right: 30px;
            /* font-weight: bold; */
        }

        .year-highlight {
            font-size: 13pt;
            font-weight: bold;
            /* border: 2px solid black; */
            /* padding: 2px 5px; */
            /* display: inline-block; */
        }

        /* --- CORPS DU DOCUMENT --- */
        .body-content {
            margin-top: 20px;
            margin-bottom: 20px;
            margin-left: 20px;
            font-size: 13pt;
            line-height: 1.5;
        }
        .faculty-title {
            text-align: center;
            font-size: 15pt;
            margin-top: 20px;
            font-weight: bold;
            /* margin-bottom: 50px; */
            padding: 10px 0;
            background-color: rgb(192 192 192);
        }

        .body-divider {
            border-top: 4px dashed black;
            width: 50%;
            margin-top: 20px;
            margin-bottom: 20px;
            margin-left: 25%;
            padding: 0;
        }

        .document-title {
            text-align: center;
            font-size: 20pt;
            /* text-decoration: underline; */
            margin-bottom: 50px;
        }

        .intro-text, .final-text {
            text-align: justify;
            line-height: 1.5;
            /* margin-bottom: 20px; */
        }

        /* --- DÉTAILS DE L'ATTESTATION (Les lignes d'infos) --- */
        .details-section {
            /* line-height: 2.2; */
            /* margin: 40px 0; */
        }

        .detail-line {
            display: flex;
            justify-content: flex-start;
            /* Utilisation d'un décalage visuel pour le texte */
            /* margin-left: 20px;  */
        }

        .detail-line .label {
            flex-shrink: 0; /* Ne pas réduire l'espace du label */
            margin-right: 5px;
        }

        .detail-line .value {
            flex-grow: 1;
            font-weight: bold;
            text-transform: uppercase;
            /* Bordure pointillée pour simuler un champ à remplir */
            /* border-bottom: 1px dotted black; */
            /* margin-right: 20px;  */
            /* padding-left: 5px; */
        }

        .detail-line .value.large-name {
            font-size: 13pt;
            text-align: center;
        }

        .detail-line .value.class {
            text-transform: none; /* La classe est souvent écrite avec une casse normale */
        }

        /* --- PIED DE PAGE / SIGNATURE --- */
        .footer-section {
            margin-left: 20%;
            /* display: flex; */
            /* justify-content: space-between; */
            margin-top: 80px;
            font-size: 10pt;
            line-height: 1.4;
            width: 100%;
        }

        .date-place {
            /* text-align: left; */
            font-size: 12pt;
            margin-left: 35%; 
        }

        .director-block {
            font-weight: bold;
            text-align: center;
            font-size: 12pt;
            /* width: 80%; */
        }

        .signature-line {
            height: 50px;
            /* Espace pour la signature ou le cachet */
        }

        .director-name {
            font-weight: bold;
            width: 100%;
        }

        /* --- NOTE IMPORTANTE (NB) --- */
        .note {
            font-size: 8pt;
            margin-top: 50px;
            padding: 5px;
            border: 1px dashed #ccc;
            text-align: justify;
            line-height: 1.3;
        }

        /* --- PIED DE PAGE ABSOLU (Texte en bas de page) --- */
        .absolute-footer {
            /* position: absolute; */
            /* bottom: 10mm; */
            /* left: 0; */
            /* right: 0; */
            margin-top: 100px;
            padding: 10px 0;
            text-align: center;
            font-size: 10pt;
            color: #222;
            height: 80px;
            /* border: 4px solid #ccc; */
            background-color: #ccc;
        }

        .universite-name {
            /* font-weight: bold; */
            font-size: 12pt;
            margin-top: 50px;
            /* margin-left: 20%; */
            text-align: center;
        }

        /* Styles pour l'impression (optionnel mais recommandé) */
        /* @media print {
            body {
                background: none;
            }
            .document-container {
                box-shadow: none;
                margin: 0;
                min-height: 100vh;
            }
        } */
    </style>
</head>
<body>
    <div class="document-container">
        <div class="header">
            <div class="header-left">
                MINISTÈRE DE L'ENSEIGNEMENT <br>
                SUPÉRIEUR <br>
                ET DE LA RECHERCHE <br>
                SCIENTIFIQUE <br>
            </div>
            <div class="logo-text"></div>

            <div class="header-right">
                <p>RÉPUBLIQUE DE COTE D'IVOIRE</p>
                <p class="union-line">UNION - DISCIPLINE - TRAVAIL</p>
            </div>
        </div>
        <hr class="header-separator">

        <div class="institution-info">
            <div>
                <span class="academic-year">ANNÉE UNIVERSITAIRE</span> <span class="year-highlight">{{ $anneeAcademique->debut }} - {{ $anneeAcademique->fin }}</span>
            </div>
        </div>
        
        <div class="body-content">
            <div class="faculty-title">{{ $inscription->classe->niveauFaculte->faculte->nom }}</div>
            <div class="body-divider"></div>
            <h1 class="document-title">ATTESTATION DE FRÉQUENTATION</h1>
            
            <div class="intro-text">
                Nous soussignés,
                @if (env('OWNER') == 'ua_bouake' || env('OWNER') == 'ua_sp' || env('OWNER') == 'ua_abidjan')
                    Université de l'Atlantique,
                @elseif (env('OWNER') == 'ua_sp')
                    Université des Jeunes Filles de GRAND-BASSAM, 
                @else
                    Université de l'Atlantique,
                @endif
                attestons que
            </div>
            
            <div class="details-section">
                <p class="detail-line">
                    <span class="label"></span>
                    <span class="value large-name">{{ $etudiant->fullname }}</span>
                </p>
                <p class="detail-line">
                    <span class="label">né(e) le {{ $etudiant->date_naissance->format('d/m/Y') }} à</span>
                    <span class="value">{{ $etudiant->lieu_naissance }}</span>
                </p>
                <p class="detail-line">
                    <span class="label">sous le numéro matricule</span>
                    <span class="value matricule">{{ $etudiant->matricule_etudiant }}</span>
                </p>
                <p class="detail-line">
                    <span class="label">en classe de</span>
                    <span class="value class">{{ $inscription->classe->nom }}</span>
                </p>
                <p class="detail-line">
                    <span class="label">est régulièrement inscrit(e) dans mon établissement au titre de l'année scolaire</span> <br>
                    <span class="value year-detail">{{ $anneeAcademique->debut }} - {{ $anneeAcademique->fin }}</span>
                    <span class="label">, en régime</span>
                    <span class="value regime">EXTERNE</span>
                </p>
            </div>
            
            <div class="final-text">
                En foi de quoi, nous lui délivrons cette attestation pour servir et valoir ce que de droit.
            </div>
        </div>
        
        <div class="footer-section">
            <div class="date-place">
                Fait à Grand Bassam, le {{ now()->format('d/m/Y') }}
            </div>
            <div class="director-block">
                <p>La Directrice de la Scolarité</p>
                <div class="signature-line"></div>
                <p class="director-name">Dr ASSAMOI Edith Florence De Paule</p>
            </div>
        </div>
    </div>
    
    <div class="absolute-footer">
        <strong>NB:</strong> Cette ATTESTATION n'est délivrée qu'une seule fois. En cas de besoin, l'intéressé devra lui-même établir des copies qu'il fera certifier conforme à l'originale par le Maire ou le Commissaire de police de sa résidence.
    </div>
    <div style="width: 100%">
        <div class="universite-name">
            <hr>
            {{-- @if (env('OWNER') == 'ua_bouake' || env('OWNER') == 'ua_sp' || env('OWNER') == 'ua_abidjan')
                UNIVERSITÉ DE L'ATLANTIQUE
            @elseif (env('OWNER') == 'ua_sp')
                UNIVERSITE DES JEUNES FILLES DE GRAND-BASSAM
            @else
                UNIVERSITÉ DE L'ATLANTIQUE
            @endif --}}
            @if (env('OWNER') == 'ua_bouake')
                <div class="coordonne-ua">
                    Administration, Faculté et instituts : <br>
                    Bouaké - Rue Centre Commerce le Capitol  <br>
                    Tel : 2731658301 / 0749159961 / 0779816010 / 0709126473 <br>
                    <span class="underline"> Arreté d'ouverture n°06157 du 06 Avril 2009</span>  <br>
                    E-mail : uatlantique.bouake@groupeatlantique.com / web : uatlantique.org
                </div>
            @elseif(env('OWNER') == 'ua_bassam')
                <div class="coordonne-ua">
                    Administration, Faculté et instituts : <br>
                    Grand-Bassam - Mockey ville, Carr Château  <br>
                    Tel : 0758399851 / 0171083223<br>
                    <span style="text-decoration: underline"> Arreté d'ouverture n°650 du 18 Juin 2019</span>  <br>
                    E-mail : infos@groupeatlantique.com
                </div>
            @elseif(env('OWNER') == 'ua_sp')
                <div class="coordonne-ua">
                    Administration, Faculté et instituts : <br>
                    San Pedro - Quartier Balmer  <br>
                    Tel : 0585795454 / 0703739898<br>
                    <span style="text-decoration: underline"> Arreté d'ouverture n°608 du 18 Juin 2019</span>  <br>
                    E-mail : infos@groupeatlantique.com
                </div>
            @else
                <div class="ua">UNIVERSITÉ DE L'ATLANTIQUE</div>
                <div class="coordonne-ua">
                    Cocody - 2 Plateaux, Saint Jacques, derrière l'ENA, Rue J17 <br>
                    06 BP 6631 Abidjan 06 Tél : +225 01 02 02 46 46 / 01 42 33 85 85  <br>
                    E-mail: scolarite@groupeatlantique.com / Site Web : uatlantique.org <br>
                    Arrêté d'ouverture n°0210 du 11 sept. 2000
                </div>
            @endif
        </div>
    </div>
</body>
</html>