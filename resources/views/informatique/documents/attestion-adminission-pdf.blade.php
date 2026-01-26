<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Attestion Admission</title>
    <style>
        .bloc-header .annee-session .titre{
            display: inline-block;
            font-size: 1rem;
        }
        .img {
            margin-bottom: 2em;
            /* border: 1px solid #e6edef; */
            width: 30%;
            height: 11.5%;
            margin-top: -50px;
        }
        .ministere {
            text-align: center;
            width: 60%;
            position: fixed;
            left: 45%;
            top: -40px
        }
        .annee-session {
        }
        .annee-academique {
            margin-left: 15%;
            font-size: 1.2rem;
        }
        .matricule {
            font-size: 0.8rem;
        }
        .faculte {
            width: 100%;
            vertical-align: middle;
            height: 50px;
            /* padding: 2px 5px; */
            background-color: rgb(186, 186, 186);
            color: #000000;
            border-radius: 0.25rem;
            text-align: center;
            font-size: 1rem;
            /* margin-top: -60px; */
        }
        .certif {
            text-align: center;
        }
        .text {
            font-size: 1.2rem;
            text-align: justify;
            text-justify: distribute;
            line-height: 2em;
        }
        .signature {
            /* position: absolute;
            right: 0; */
            margin-top: 5%;
            float: right;
            font-size: 1.2rem;
        }
        .avis-important {
            background-color: rgb(186, 186, 186);
            width: 100%;
            margin-top: 25%;
            /* height: 1.5em; */
            padding: 1em;
        }
        .pied-page {
            font-size: 0.9em;
            width: 100%;
            position: fixed;
            bottom: -3%;
            text-align: center;
        }
        .ua {
            width: 100%;
            font-weight: bold; 
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="bloc-header">
        <div class="img">
            @if (env('OWNER') == 'ua_bassam')
                <img src="https://omnis-ab.uatlantique.org/assets/images/logo_ua_bassam.png" width="500" alt="LOGO UA">
            @elseif(env('OWNER') == 'ua_sp')
                <img src="https://omnis-ab.uatlantique.org/assets/images/logo_ua_sp.png" width="350" alt="LOGO UA">
            @else
                <img src="https://omnis-ab.uatlantique.org/assets/images/logo_ua.png" width="450" alt="LOGO UA">
            @endif
        </div>
        <div class="ministere">
            <span>REPUBLIQUE DE CÔTE D'IVOIRE <br> -------------------------- <br></span>
            <span>UNION - DISCIPLINE - TRAVAIL <br> ---------------------- <br></span>
            <span>MINISTERE DE L'ENSEINGNEMENT SUPÉRIEUR <br> ET DE LA RECHERCHE SCIENTITFIQUE</span>
        </div>
    </div>
    <hr>
    <div class="annee-session">
        <span class="matricule">17375 /R/SG/INFO</span>
        <span class="annee-academique">Année Universitaire {{ $anneUniversitaire->debut . ' - ' . $anneUniversitaire->fin }}</span>
    </div>
    <div class="faculte">
        <h3>{{ $etudiant->classe($anneUniversitaire->id)->niveauFaculte->faculte->nom ?? 'NOM FACULTÉ' }}</h3> 
    </div>
    <div class="certif">
        <h2>CERTIFICAT {{ $docType == 'attestation_admission' ? 'D\'ADMISSION' : 'DE REUSSITE' }}</h2>
        <h4>A LA {{ $etudiant->classe($anneUniversitaire->id)->nom ?? 'NOM CLASSE   '}}</h4>
    </div>
    <div class="text">
        Nous soussignés, Université de l'Atlantique, certifions que <br>
        <strong>M / Mlle {{ $etudiant->fullname }}</strong> <br>
        Né(e) le <strong>{{ $etudiant->date_naissance->format('d/m/Y') }}</strong> à <strong>{{ $etudiant->lieu_naissance }}</strong> <br>
        inscrit sous le numéro de Carte d'étudiant : <strong>{{ $etudiant->matricule_etudiant }}</strong> <br>
        a satisfait aux épreuves de l'examen et obtenu la : <br>
        <strong>{{ $etudiant->classe($anneUniversitaire->id)->nom ?? 'NOM CLASSE    '}}</strong> <br>
        à la session de <strong>{{ $session }} {{ $annee }}</strong>, avec la mention <strong>{{ $mention }}</strong> <br>
        Le présent certificat lui est délivré pour servir et valoir ce que de droit.
    </div>
    <div class="signature">
        Fait à ABIDJAN, le {{ date('d/m/Y') }} <br>
        <strong>Le Président du Conseil Scientifique</strong><br><br><br>
        <span><strong>{{ $president }}</strong> </span>
    </div>
    <div class="avis-important">
        NB : Ce CERTIFICAT n'est délivré qu'une seule fois. En cas de besoin, l'intéressé devra lui-même établir des copies
        qu'il fera certifier conforme à l'originale par le Maire ou le Commissaire de police de sa résidence
    </div>
    <div class="pied-page">
        <hr>
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
</body>
</html>