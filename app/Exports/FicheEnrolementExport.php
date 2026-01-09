<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FicheEnrolementExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithEvents
{
    protected $etudiants;
    protected $faculte;
    protected $anneeAcademique;

    public function __construct($etudiants, $faculte, $anneeAcademique)
    {
        $this->etudiants = $etudiants;
        $this->faculte = $faculte;
        $this->anneeAcademique = $anneeAcademique;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->etudiants;
    }

    // 1. Définition des titres (Lignes 1, 2 et 3)
    public function headings(): array
    {
        return [
            ['FICHE ENROLEMENT MINISTERE'],
            [$this->faculte->nom],
            [
                'ID PERMANENT',
                'MATRICULE',
                'N° TABLE BAC',
                'NOM & PRENOMS',
                'DATE NAISS.',
                'LIEU NAISS.',
                'CONTACT',
                'FILIERE',
                'ETABLISSEMENT',
                'CODE EP',
                'EMARGEMENT'
            ]
        ];
    }

    // 2. Correspondance des données
    public function map($etudiant): array
    {
        return [
            $etudiant->id_permanent,
            $etudiant->matricule_etudiant,
            $etudiant->numero_table_bac,
            $etudiant->fullname, // Nom & Prénoms combinés
            $etudiant->date_naissance->format('d/m/Y'),
            $etudiant->lieu_naissance,
            $etudiant->numero_etudiant,
            $this->faculte->nom,
            $etudiant->etablissement_origine,
            $etudiant->code_ep,
            $etudiant->emargement,
        ];
    }

    // 3. Stylisation (Bordures, Gras, Centrage)
    public function styles(Worksheet $sheet)
    {
        return [
            // Style de la ligne de titre des colonnes (Ligne 3)
            3 => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            // Bordures pour tout le tableau (exemple pour 100 lignes)
            'A1:K100' => [
                'borders' => [
                    'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                ],
            ],
        ];
    }

    // 4. Fusion des cellules (Titres)
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Fusionner de A à K pour les deux premières lignes
                $event->sheet->getDelegate()->mergeCells('A1:K1');
                $event->sheet->getDelegate()->mergeCells('A2:K2');

                // Centrage vertical et horizontal des titres
                $event->sheet->getDelegate()->getStyle('A1:K2')->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                
                // Augmenter la taille de la police pour le titre principal
                $event->sheet->getDelegate()->getStyle('A1')->getFont()->setSize(16)->setBold(true);
                $event->sheet->getDelegate()->getStyle('A2')->getFont()->setSize(14)->setBold(true);
            },
        ];
    }
}
