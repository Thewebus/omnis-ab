<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificat de Réussite Master</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Times New Roman', serif;
            /* font-size: 30px; */
            /* background: #f5f5f5; */
            /* padding: 20px; */
        }

        .certificate {
            /* max-width: 800px; */
            /* margin: 0 auto; */
            background: white;
            padding: 20px 60px;
            /* box-shadow: 0 0 20px rgba(0,0,0,0.1); */
            /* border: 3px solid #003366; */
        }

        .university-info {
            text-align: center;
            font-size: 25px;
            line-height: 1.4;
            margin-top: 40px;
            color: #333;
            font-weight: bold
        }

        .university-info strong {
            font-size: 25px;
            text-transform: uppercase;
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin: 30px 0;
            font-size: 25px;
        }

        .logo {
            position: absolute;
            left: 10%;
        }

        /* .left-section, .right-section {
            flex: 1;
            text-align: center;
        } */

        .left-section {
            text-align: center;
            /* text-align: left; */
            float: left;
            font-weight: bold;
            line-height: 1.6;
        }

        .right-section {
            text-align: center;
            /* text-align: right; */
            float: right;
            font-weight: bold;
            line-height: 1.6;
        }

        .separator {
            text-align: center;
            margin: 3px 0;
        }

        .reference-number {
            /* text-align: center; */
            font-size: 30px;
            font-weight: bold;
            /* margin-top: 100px; */
        }

        .faculty {
            text-align: center;
            font-size: 50px;
            font-weight: bold;
            margin-top: 350px;
            /* margin-bottom: 10px; */
        }

        .faculty-separator {
            text-align: center;
            /* margin: 5px 0 30px 0; */
        }

        .title {
            text-align: center;
            font-size: 40px;
            font-weight: bold;
            /* text-decoration: underline; */
            margin: 30px 0 10px 0;
        }
        .subtitle {
            margin: 0 auto;
            text-align: center;
            font-size: 40px;
            font-weight: bold;
            margin-bottom: 10px;
            width: 50%;
        }

        .option {
            text-align: center;
            font-size: 40px;
            font-weight: bold;
            margin-bottom: 40px;
        }

        .content {
            font-size: 35px;
            line-height: 2;
            text-align: justify;
            margin: 0 50px;
        }

        .content p {
            margin-bottom: 15px;
        }

        /* .student-info {
            margin: 20px 0;
        } */

        .student-name {
            font-weight: bold;
            font-size: 35px;
            /* text-align: center; */
            /* margin: 15px 0; */
        }

        .info-line {
            margin: 8px 0;
        }

        .highlight {
            font-weight: bold;
        }

        .mention {
            font-weight: bold;
            text-transform: uppercase;
        }

        .closing {
            /* margin-top: 30px; */
        }

        .right-bottom {
            margin-top: 20px;
            text-align: right;
        }

        .date-location {
            text-align: right;
            font-size: 35px;
            margin: 40px 0 20px 0;
        }

        .signature-section {
            text-align: right;
            margin-top: 40px;
        }

        .signature-title {
            font-size: 35px;
            font-weight: bold;
            margin-bottom: 200px;
        }

        .signature-name {
            font-size: 35px;
            font-weight: bold;
        }

        .note {
            margin-top: 50px;
            font-size: 25px;
            line-height: 1.4;
            border-bottom: 4px solid #222;
            font-weight: bold;
            padding-bottom: 15px;
        }

        .admin {
            float: left;
            font-size: 30px;
            font-weight: bold;
            margin-top: 10px;
        }
        .faculte {
            float: right;
            font-size: 30px;
            font-weight: bold;
            margin-top: 10px;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }
            .certificate {
                box-shadow: none;
            }
        }
    </style>
</head>
<body>
    <div class="certificate">
        <!-- En-tête administratif -->
        <div class="header-section">
            <div class="left-section">
                REPUBLIQUE DE COTE D'IVOIRE<br>
                ------------------<br>
                MINISTERE DE L'ENSEIGNEMENT<br>
                SUPERIEUR ET DE LA RECHERCHE<br>
                SCIENTIFIQUE<br>
                ---------------------
                <!-- Numéro de référence -->
                <div class="reference-number">24219/R/SG/INFO</div>
            </div>
            <div class="logo">
                @if (env('OWNER') == 'ua_bassam')
                    <img src="https://omnis-ab.uatlantique.org/assets/images/logo_ua_bassam.png" width="500" alt="LOGO UA">
                @elseif(env('OWNER') == 'ua_sp')
                    <img src="https://omnis-ab.uatlantique.org/assets/images/logo_ua_sp.png" width="350" alt="LOGO UA">
                @else
                    <img src="https://omnis-ab.uatlantique.org/assets/images/logo_ua.png" width="450" alt="LOGO UA">
                @endif
            </div>
            <div class="right-section">
                UNION – DISCIPLINE – TRAVAIL<br>
                -------------------<br>
                ANNEE UNIVERSITAIRE<br>
                {{ $anneeUniversitaire->debut }} - {{ $anneeUniversitaire->fin }}<br>
                --------------
            </div>
        </div>

        <!-- Faculté -->
        <div class="faculty">{{ $etudiant->classe($anneeUniversitaire->id)->niveauFaculte->faculte->nom }}</div>
        <div class="faculty-separator">----------------------------</div>

        <!-- Titre -->
        <div class="title">Certificat de Réussite</div>
        <div class="subtitle">{{ $etudiant->classe($anneeUniversitaire->id)->nom }}</div>
        {{-- <div class="option">OPTION "PROFESSIONS JUDICIAIRES"</div> --}}

        <!-- Contenu -->
        <div class="content">
            <p>Nous soussignés, Université de l'Atlantique, certifions que</p>
            
            <div class="student-info">
                Monsieur <span class="student-name">{{ $etudiant->fullname }}</span>
                
                <div class="info-line">
                    né le <span class="highlight">{{ $etudiant->date_naissance->format('d/m/Y') }}</span> à <span class="highlight">{{ $etudiant->lieu_naissance }}</span>
                </div>
                
                <div class="info-line">
                    inscrit sous le numéro de Carte d'étudiant : <span class="highlight">{{ $etudiant->matricule_etudiant }}</span>
                </div>
            </div>
            
            <p>a satisfait aux épreuves de l'examen et a obtenu au mémoire la note de <span class="highlight">{{ number_format($note, 2, ',', ' ') }}</span> à la date du <span class="">{{ $session }}</span>.</p>
            
            <p>Ce résultat, ajouté aux notes des autres unités d'enseignements, lui valent la réussite au <span class="highlight">{{ $etudiant->classe($anneeUniversitaire->id)->nom }}</span> avec la mention <span class="mention">{{ $mention }}</span>.</p>
            
            <div class="closing">
                <p>Le présent certificat lui est délivré pour servir et valoir ce que de droit.</p>
            </div>
        </div>

        <div class="right-bottom">
            <!-- Date et lieu -->
            <div class="date-location">
                Fait à Bouaké, le {{ now()->translatedFormat('d F Y') }}
            </div>
    
            <!-- Signature -->
            <div class="signature-section">
                <div class="signature-title">Le Doyen des Facultés</div>
                <div class="signature-name">{{ $president }}</div>
            </div>
        </div>

        <!-- Note en bas de page -->
        <div class="note">
            <p>
                <strong>N.B. :</strong> Ce CERTIFICAT n'est délivré qu'une seule fois. En cas de besoin, l'intéressé devra lui-même établir des copies qu'il fera certifier
            </p>
            <p style="margin-left: 70px;">conforme à l'original par le Maire ou le Commissaire de Police de sa résidence</p>
            
        </div>
        <div class="bottom-end">
            <div class="admin">
                Administration
            </div>
            <div class="faculte">
                Facultés et Instituts:
            </div>
        </div>

        <!-- En-tête avec informations administratives -->
        <div class="university-info">



            @if (env('OWNER') == 'ua_bouake')
                <div class="coordonne-ua">
                    <strong>Université de l'Atlantique Annexe Bouaké</strong><br>
                    Bouaké-Rue Centre Commerce Le Capitol<br>
                    Tél : 2731658301 / 0779816010/0749159951/0709126473<br>
                    E-mail: scolarite@groupeatlantique.com / Site Web: uatlantique.org<br>
                    Arrêté d'ouverture n°06157 du 06 avril 2009
                </div>
            @elseif(env('OWNER') == 'ua_bassam')
                <div class="coordonne-ua">
                    <strong>Université de l'Atlantique Annexe Grand-Bassam</strong><br>
                    Grand-Bassam - Mockey ville, Carr Château  <br>
                    Tel : 0758399851 / 0171083223<br>
                    <span style="text-decoration: underline"> Arreté d'ouverture n°650 du 18 Juin 2019</span>  <br>
                    E-mail : infos@groupeatlantique.com
                </div>
            @elseif(env('OWNER') == 'ua_sp')
                <div class="coordonne-ua">
                    <strong>Université de l'Atlantique Annexe San-Pedro</strong><br>
                    San Pedro - Quartier Balmer  <br>
                    Tel : 0585795454 / 0703739898<br>
                    <span style="text-decoration: underline"> Arreté d'ouverture n°608 du 18 Juin 2019</span>  <br>
                    E-mail : infos@groupeatlantique.com
                </div>
            @else
                <div class="ua">UNIVERSITÉ DE L'ATLANTIQUE</div>
                <div class="coordonne-ua">
                    Cocody - 2 plateaux, Saint Jacques, derrière l'ENA, Rue J17 <br>
                    06 BP 6631 ABIDJAN 06 - Tel : +225 01 02 02 46 46 / 01 42 33 85 85 <br>
                    E-mail : scolarite@groupeatlantique.com / Site Web : uatlantique.org <br>
                    <span> Arreté d'ouverture n°0210 du 11 Sept. 2000</span>
                </div>
            @endif
            
        </div>
    </div>
</body>
</html>