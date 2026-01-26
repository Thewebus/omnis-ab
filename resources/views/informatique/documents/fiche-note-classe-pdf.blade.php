<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Fiche des Notes</title>
    <style>
        /* Configuration de la page pour l'impression */
        @page {
            size: A4 landscape;
            margin: 5mm;
        }

        body {
            background-color: #ffffff;
            color: #000;
            font-family: Arial, Helvetica, sans-serif;
            margin: 5px; /* Marges externes réduites à 5px */
            padding: 0;
        }

        .container {
            width: 100%;
            margin: 0;
            padding: 5px; /* Padding interne réduit */
        }

        /* En-tête */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
        }

        .university-info {
            font-size: 22px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .academic-year {
            font-size: 18px;
            font-weight: bold;
            text-align: right;
        }

        /* Titres */
        .titles {
            text-align: center;
            margin-bottom: 20px;
        }

        .titles h1 { font-size: 35px; text-transform: uppercase; margin: 5px 0; }
        .titles h2 { font-size: 30px; text-decoration: underline; margin: 5px 0; font-weight: bold; }
        .titles h3 { font-size: 25px; color: #0044cc; margin-top: 10px; }

        /* Tableaux */
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed; /* Force le respect des largeurs */
        }

        th, td {
            border: 2px solid #000; /* Bordures plus épaisses pour la lecture */
            padding: 8px 4px;
            text-align: center;
            word-wrap: break-word;
        }

        /* Tableau d'infos (Haut) */
        .info-table td {
            height: 40px;
            font-size: 20px;
        }
        .label { font-weight: bold; background-color: #f0f0f0; }

        /* TABLEAU PRINCIPAL (Lisibilité augmentée) */
        .main-table {
            margin-top: 15px;
        }

        .main-table th {
            background-color: #333;
            color: white;
            font-size: 20px; /* Un peu plus petit pour les entêtes pour gagner de la place */
            height: 50px;
            text-transform: uppercase;
        }

        .main-table td {
            font-size: 20px; /* TAILLE DE POLICE AUGMENTÉE */
            font-weight: 500;
            height: 45px; /* LIGNES PLUS HAUTES */
        }

        /* Largeurs des colonnes */
        .col-n { width: 45px; }
        .col-nom { width: 28%; text-align: center; padding-left: 10px; font-weight: bold; }
        .col-dev { width: 7.5%; }
        .col-moy { width: 85px; background-color: #eee; font-weight: 900; }

        .row-even { background-color: #f9f9f9; }

    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <div class="university-info">
            Université de l'Atlantique 
            <span style="color: #666;">
                @if (env('OWNER') == 'ua_bouake')
                    BOUAKE
                @elseif (env('OWNER') == 'ua_bassam')
                    BASSAM
                @elseif (env('OWNER') == 'ua_sp')
                    SAN PEDRO
                @else
                    ABIDJAN
                @endif
            </span>
        </div>
        <div class="academic-year">ANNEE UNIVERSITAIRE {{ $anneeAcademique->debut }} - {{ $anneeAcademique->fin }}</div>
    </div>

    <div class="titles">
        <h1>{{ $classe->niveauFaculte->faculte->nom }}</h1>
        <h2>FICHE DES NOTES</h2>
        <h3>NIVEAU : {{ $classe->nom }}</h3>
    </div>

    <table class="info-table">
        <tr>
            <td class="label" style="width: 120px;">MATIERE :</td>
            <td colspan="4" style="font-size: 18px; font-weight: bold;">{{ $matiere->nom }}</td>
            <td class="label">UE</td>
            <td class="label">COEF</td>
            <td class="label">CREDIT</td>
            <td class="label">VH/C</td>
            <td class="label">VH/TD</td>
        </tr>
        <tr>
            <td class="label">ENSEIGNANT :</td>
            <td colspan="2">{{ $matiere->professeur()?->fullname }}</td>
            <td class="label" style="width: 130px;">EMARGEMENT</td>
            <td style="width: 150px;">
                {{-- Mgt --}}
            </td>
            <td>{{ $matiere->uniteEnseignement->nom }}</td>
            <td>{{ $matiere->coefficient }}</td>
            <td>{{ $matiere->credit }}</td>
            <td>{{ $matiere->volume_horaire }}</td>
            <td>
                {{-- VH/D --}}
            </td>
        </tr>
        <tr>
            <td class="label">CHARGE DE TD :</td>
            <td colspan="2">
                {{-- TD diff --}}
            </td>
            <td class="label" style="width: 130px;"></td>
            <td class="label" style="width: 150px;"></td>
            <td class="label"></td>
            <td class="label"></td>
            <td class="label"></td>
            <td class="label"></td>
            <td class="label"></td>
        </tr>
    </table>

    <table class="main-table">
        <thead>
            <tr>
                <th class="col-n">N°</th>
                <th class="col-nom">NOM & PRENOMS</th>

                @foreach ($notesSelectionnees as $notesSelectionnee)
                    <th class="col-dev">DEV. {{ $loop->iteration }}</th>
                @endforeach
                {{-- <th class="col-dev">DEV 1</th> --}}
                {{-- <th class="col-dev">DEV 3</th> --}}
                {{-- <th class="col-dev">DEV 4</th> --}}
                {{-- <th class="col-dev">DEV 5</th> --}}
                {{-- <th class="col-dev">DEV 6</th> --}}

                <th class="col-moy">MOYENNE</th>
                <th>OBSERVATIONS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataNotes as $dataNote)
                <tr {{ $loop->iteration % 2 == 0 ? 'class=row-even' : ''}}>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $dataNote['nom_etudiant']->fullname }}</td>
                    @foreach ($notesSelectionnees as $notesSelectionnee)
                        <td>{{ $dataNote[$notesSelectionnee] }}</td>
                    @endforeach
                    <td class="col-moy">{{ $dataNote['moyenne'] }}</td>
                    <td></td>
                </tr>
            @endforeach
            {{-- <tr class="row-even">
                <td>02</td>
                <td>ADAMOU FAISAL</td>
                <td></td><td></td><td></td><td></td><td></td><td></td>
                <td class="col-moy"></td><td></td>
            </tr> --}}
            {{-- <tr>
                <td>03</td>
                <td>BAKARE NADIE TAMILADE BLESSING</td>
                <td></td><td></td><td></td><td></td><td></td><td></td>
                <td class="col-moy"></td><td></td>
            </tr> --}}
            {{-- <tr class="row-even">
                <td>04</td>
                <td>COULIBALY ZANGA DRISSA FELIX</td>
                <td></td><td></td><td></td><td></td><td></td><td></td>
                <td class="col-moy"></td><td></td>
            </tr> --}}
            {{-- <tr>
                <td>05</td>
                <td>DANSI KOUEPHA ESTEL</td>
                <td></td><td></td><td></td><td></td><td></td><td></td>
                <td class="col-moy"></td><td></td>
            </tr> --}}
        </tbody>
    </table>
</div>

</body>
</html>