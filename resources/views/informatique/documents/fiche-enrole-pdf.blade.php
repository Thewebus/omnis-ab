<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Fiche Enrôlement Ministère</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 5mm; /* Marges très étroites pour gagner de la place */
        }

        body {
            font-family: 'Helvetica', Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed; /* Indispensable pour contrôler la largeur */
        }

        /* Styles des cellules */
        th, td {
            border: 1.5px solid #000; /* Bordures plus marquées */
            padding: 8px 3px;
            font-size: 12px; /* TAILLE AUGMENTÉE */
            word-wrap: break-word;
            text-align: center;
            line-height: 1.2;
        }

        /* En-têtes principaux (Fiche & Filière) */
        .main-title {
            font-size: 20px;
            font-weight: bold;
            height: 45px;
            text-transform: uppercase;
        }

        .sub-title {
            font-size: 16px;
            font-weight: bold;
            height: 35px;
            background-color: #f0f0f0;
        }

        /* Ligne des noms de colonnes */
        .col-headers th {
            font-size: 11px; /* Légèrement plus petit que le contenu pour tenir sur une ligne */
            font-weight: bold;
            background-color: #e5e5e5;
            text-transform: uppercase;
        }

        /* Largeurs spécifiques pour équilibrer le tableau */
        .w-id { width: 7%; }
        .w-mat { width: 8%; }
        .w-table { width: 7%; }
        .w-nom { width: 18%; text-align: left; padding-left: 5px; }
        .w-date { width: 8%; }
        .w-lieu { width: 10%; }
        .w-tel { width: 9%; }
        .w-fil { width: 15%; font-size: 10px; } /* On garde la filière un peu plus petite */
        .w-etab { width: 10%; }
        .w-code { width: 4%; }
        .w-sign { width: 9%; }

        /* Style pour les données */
        .data-row td {
            height: 40px; /* Plus haut pour faciliter la lecture/écriture */
        }

        .bold-text {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <table>
        <thead>
            <tr class="main-header">
                <th colspan="11">FICHE ENROLEMENT MINISTERE</th>
            </tr>
            <tr class="sub-header">
                <th colspan="11">LICENCE 1 EN COMMUNICATION ET JOURNALISME</th>
            </tr>
            <tr class="col-headers">
                <th class="w-id">ID PERM.</th>
                <th class="w-mat">MATRICULE</th>
                <th class="w-table">N° TABLE</th>
                <th class="w-nom">NOM & PRENOMS</th>
                <th class="w-date">DATE NAISS.</th>
                <th class="w-lieu">LIEU NAISS.</th>
                <th class="w-tel">CONTACT</th>
                <th class="w-fil">FILIERE</th>
                <th class="w-etab">ETABLISSEMENT</th>
                <th class="w-code">CODE</th>
                <th class="w-sign">EMARG.</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($etudiants as $etudiant)
                <tr class="data-row">
                    <td>{{ $etudiant->id_permanent }} </td>
                    <td>{{ $etudiant->matricule_etudiant }}</td>
                    <td>{{ $etudiant->numero_table_bac }}</td>
                    <td class="w-nom bold-text">{{ $etudiant->fullname }}</td>
                    <td>{{ $etudiant->date_naissance->format('d/m/Y') }}</td>
                    <td>{{ $etudiant->lieu_naissance }}</td>
                    <td>{{ $etudiant->numero_etudiant }}</td>
                    <td class="w-fil">{{ $classe->niveauFaculte->faculte->nom }}</td>
                    <td>{{ $etudiant->etablissement_origine }}</td>
                    <td>{{ $etudiant->code_ep }}</td>
                    <td class="bold-text">{{ $etudiant->emargement }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>