<?php

namespace App\Http\Livewire;

use App\Models\Note;
use App\Models\User;
use App\Models\Matiere;
use Livewire\Component;
use App\Services\BulletinService;

class ListeEtudiantSession2 extends Component
{
    public $classeId;
    public $ueId;
    public $ueNom;
    public $dataEtudiants = [];   // [ ['id'=>, 'fullname'=>, 'matieres'=>[ ['id'=>,'nom'=>] ] ] ]
    public $notes = [];           // notes[etudiantId][matiereId] = valeur

    protected $listeners = ['listeEtudiantSession2'];

    // Reçoit l'UE sélectionnée : $data = [ 0 => {UE...}, 'classe_id' => X ]
    public function listeEtudiantSession2($data) {
        $this->classeId = $data['classe_id'];
        $this->ueId = $data[0]['id'];
        $this->ueNom = $data[0]['nom'] ?? '';
        $this->chargerEtudiants();
    }

    private function chargerEtudiants() {
        $bulletinService = new BulletinService();
        $anneeAcademique = getSelectedAnneeAcademique() ?? getLastAnneeAcademique();

        $etudiants = User::whereHas('inscriptions', function ($q) use ($anneeAcademique) {
                $q->where('classe_id', $this->classeId)
                  ->where('annee_academique_id', $anneeAcademique->id);
            })
            ->orderBy('fullname', 'asc')
            ->get();

        $this->dataEtudiants = [];

        foreach ($etudiants as $etudiant) {
            // Matières à repasser (UE non validée + matière < 10).
            $matieres = $bulletinService->matieresARepasser($this->classeId, $this->ueId, $etudiant->id);
            if ($matieres->isEmpty()) {
                continue;
            }

            $matieresData = [];
            foreach ($matieres as $matiere) {
                $note = Note::where('annee_academique_id', $anneeAcademique->id)
                    ->where('classe_id', $this->classeId)
                    ->where('matiere_id', $matiere->id)
                    ->where('user_id', $etudiant->id)
                    ->first();

                // À la saisie, on n'affiche que les matières sans note de session 2
                // (celles déjà saisies passent par l'écran de modification).
                if (!is_null($note) && !is_null($note->partiel_session_2)) {
                    continue;
                }

                $matieresData[] = [
                    'id' => $matiere->id,
                    'nom' => $matiere->nom,
                ];
            }

            if (empty($matieresData)) {
                continue;
            }

            $this->dataEtudiants[] = [
                'id' => $etudiant->id,
                'fullname' => $etudiant->fullname,
                'matieres' => $matieresData,
            ];
        }
    }

    public function postSession2() {
        $anneeAcademique = getSelectedAnneeAcademique() ?? getLastAnneeAcademique();

        // Validation : chaque note saisie doit être un nombre compris entre 0 et 20.
        foreach ($this->notes as $matieresNotes) {
            foreach ((array) $matieresNotes as $valeur) {
                if ($valeur === null || $valeur === '') {
                    continue;
                }
                if (!is_numeric($valeur) || $valeur < 0 || $valeur > 20) {
                    session()->flash('error', 'Chaque note de session 2 doit être un nombre compris entre 0 et 20.');
                    return;
                }
            }
        }

        $ignores = 0;
        foreach ($this->notes as $etudiantId => $matieresNotes) {
            foreach ((array) $matieresNotes as $matiereId => $valeur) {
                if ($valeur === null || $valeur === '') {
                    continue;
                }

                $matiere = Matiere::find($matiereId);
                if (is_null($matiere)) {
                    continue;
                }

                $note = Note::where('annee_academique_id', $anneeAcademique->id)
                    ->where('classe_id', $matiere->classe->id)
                    ->where('matiere_id', $matiere->id)
                    ->where('user_id', $etudiantId)
                    ->first();

                if (!is_null($note)) {
                    // On ne stocke QUE partiel_session_2 : la moyenne de session 1 est préservée
                    // (le bulletin s'en sert pour décider et calcule la moyenne finale à la volée).
                    $note->update([
                        'partiel_session_2' => $valeur,
                        'status' => $valeur >= 10 ? 'admis' : 'ajourné',
                    ]);
                } else {
                    // Un étudiant en session 2 a normalement une note de session 1. Création de secours
                    // uniquement si un professeur est affecté (professeur_id est NOT NULL en base).
                    $professeur = $matiere->professeurs->first();
                    if (is_null($professeur)) {
                        $ignores++;
                        continue;
                    }
                    Note::create([
                        'partiel_session_2' => $valeur,
                        'status' => $valeur >= 10 ? 'admis' : 'ajourné',
                        'classe_id' => $matiere->classe->id,
                        'matiere_id' => $matiere->id,
                        'user_id' => $etudiantId,
                        'professeur_id' => $professeur->id,
                        'annee_academique_id' => $anneeAcademique->id,
                    ]);
                }
            }
        }

        $this->notes = [];
        $this->chargerEtudiants();
        session()->flash('message', 'Notes de session 2 enregistrées !' . ($ignores ? " ($ignores note(s) ignorée(s) : matière sans professeur affecté)" : ''));
    }

    public function render()
    {
        return view('livewire.liste-etudiant-session2');
    }
}
