@extends('layouts.etudiant.master')

@section('title')Fiche d'inscription
    {{ $title }}
@endsection

@push('css')
@endpush

@section('content')
  @component('components.etudiant.breadcrumb')
    @slot('breadcrumb_title')
      <h3>Accueil</h3>
    @endslot
    <li class="breadcrumb-item">Inscription</li>
    <li class="breadcrumb-item active">Fiche d'inscription</li>
  @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Fiche d'inscription : {{ $etudiant->fullname }}</h5>
                        {{-- <span> 
                            @if ($etudiant->inscriptions->last()->valide == 0 && $etudiant->inscriptions->last()->raison == null)
                                <span class="badge badge-warning">En attente</span>
                            @elseif ($etudiant->inscriptions->last()->valide == 0 && $etudiant->inscriptions->last()->raison !== null)
                                <span class="badge badge-danger">Refusé</span>
                            @else
                                <span class="badge badge-success">Validé</span>
                            @endif
                        </span> --}}
                        <div class="row mt-5">
                            <div class="col-md-3"></div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3"> <a href="{{ route('user.modif-fiche-inscription') }}" class="btn btn-warning"><i class="fa fa-edit"></i> Modifié les informations</a></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 style="color: #24695c">IDENTITE PERSONNELLE</h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                Date Nais. : <b>{{ $etudiant->date_naissance?->format('d/m/Y') }}</b> 
                            </div>
                            <div class="col-md-4">
                                Lieu Nais. : <b>{{ $etudiant->lieu_naissance }}</b> 
                            </div>
                            <div class="col-md-4">
                                Nationalité : <b>{{ $etudiant->nationalite ?? __('NEANT') }}</b> 
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                Sexe : <b>{{ $etudiant->sexe }}</b> 
                            </div>
                            <div class="col-md-4">
                                Domicile : <b>{{ $etudiant->domicile ?? __('NEANT') }}</b> 
                            </div>
                            <div class="col-md-4">
                                Téléphone : <b>{{ $etudiant->numero_etudiant }}</b> 
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                Email : <b>{{ $etudiant->email ?? __('NEANT') }}</b> 
                            </div>
                            <div class="col-md-4">
                                Etablissement d'origine : <b>{{ strtoupper($etudiant->etablissement_origine) ?? __('NEANT') }}</b> 
                            </div>
                            <div class="col-md-4">
                                Adr. Géographique : <b>{{ strtoupper($etudiant->adresse_geographique) ?? __('NEANT') }}</b> 
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                Matricule : <b>{{ strtoupper($etudiant->matricule_etudiant) ?? __('NEANT') }}</b> 
                            </div>
                            <div class="col-md-2">
                                Niveau Etd. : <b>{{ strtoupper($etudiant->niveau_etude) ?? __('NEANT') }}</b> 
                            </div>
                            <div class="col-md-2">
                                Serie BAC : <b>{{ strtoupper($etudiant->serie_bac) ?? __('NEANT') }}</b> 
                            </div>
                            <div class="col-md-3">
                               Autre diplome : <b>{{ $etudiant->autre_diplome ?? __('NEANT') }}</b> 
                            </div>
                            <div class="col-md-3">
                                Faculté : <b>
                                    {{ $etudiant->classe($anneeAcademique->id)->niveauFaculte->faculte->nom ?? __('NEANT') }}
                                </b> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                {{-- <h5 style="color: #24695c">ANNEE ACADEMIQUE {{ $etudiant->inscription($anneeAcademique->id)?->anneeAcademique->debut }} - {{""}}</h5> --}}
                                <h5 style="color: #24695c">ANNEE ACADEMIQUE {{ $etudiant->inscription($anneeAcademique->id)?->anneeAcademique->debut }} - {{ $etudiant->inscription($anneeAcademique->id)?->anneeAcademique->fin }}</h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                Statut : <b>{{ strtoupper($etudiant->statut) ?? __('NEANT') }}</b> 
                            </div>
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4">
                                Niveau d'étude : <b>{{ $etudiant->classe($anneeAcademique->id)->niveauFaculte->nom ?? __('NEANT') }}</b> 
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                Date de la première entrée à l'université (année) : <b>{{ $etudiant->premier_entree_ua ?? __('NEANT') }}</b> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h5 style="color: #24695c">RESPONSABLE LEGAL DE L'ÉTUDIANT (A APPELER EN CAS D'URGENCE)</h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                Responsable : <b>
                                    {{ $etudiant->responsable_legal == null ? __('NEANT') : ($etudiant->responsable_legal == 'autre' ? strtoupper($etudiant->responsable_legal_precision) : strtoupper($etudiant->responsable_legal)) }}
                                </b> 
                            </div>
                            <div class="col-md-4">
                                Nom & Prénoms : <b>{{ $etudiant->responsable_legal_fullname ?? __('NEANT') }}</b> 
                            </div>
                            <div class="col-md-4">
                                Profession : <b>{{ $etudiant->responsable_legal_profession ?? __('NEANT') }}</b> 
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                Adresse : <b>{{ $etudiant->responsable_legal_adresse ?? _('NEANT') }} </b> 
                            </div>
                            <div class="col-md-4">
                                Domicile : <b>{{ $etudiant->responsable_legal_domicile ?? __('NEANT') }}</b> 
                            </div>
                            <div class="col-md-4">
                                Numéro : <b>{{ $etudiant->responsable_legal_numero ?? __('NEANT') }}</b> 
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-md-12">
                                <h5 style="color: #24695c">PERSONNE EN CHARGE DU PAIEMENT DE LA SCOLATITÉ (A APPELER EN CAS DE BESOIN)</h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                Nom & Prénoms : <b>{{ $etudiant->responsable_scolarite_fullname ?? __('NEANT') }}</b> 
                            </div>
                            <div class="col-md-4">
                                Profession : <b>{{ $etudiant->responsable_scolarite_profession ?? __('NEANT') }}</b> 
                            </div>
                            <div class="col-md-4">
                                Adresse : <b>{{ $etudiant->responsable_scolarite_adresse ?? _('NEANT') }} </b> 
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                Domicile : <b>{{ $etudiant->responsable_scolarite_dimicile ?? __('NEANT') }}</b> 
                            </div>
                            <div class="col-md-4">
                                Numéro : <b>{{ $etudiant->responsable_scolarite_numero ?? __('NEANT') }}</b> 
                            </div>
                        </div> --}}
                        {{-- <div class="row">
                            <div class="col-md-12">
                                <h5 style="color: #24695c">PRISE EN CHARGE</h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                Prise en charge : <b>{{ $etudiant->inscriptions->last()->prise_chage == 0 ? __('NON') : __('OUI') }}</b> 
                            </div>
                            <div class="col-md-4">
                                Type de prise en charge : <b>{{ $etudiant->inscriptions->last()->prise_charge_type ?? __('NEANT') }}</b> 
                            </div>
                            <div class="col-md-4">
                                Scolarité : <b>{{ $etudiant->inscriptions->last()->net_payer }} FR CFA </b> 
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                Remise : <b>{{ $etudiant->inscriptions->last()->remise }} FR CFA</b> 
                            </div>
                            <div class="col-md-4">
                                Net à payer : <b>{{ $etudiant->inscriptions->last()->net_payer }} FR CFA</b> 
                            </div>
                        </div> --}}
                        <div class="row mt-3">
                            <div class="col-md-2">
                                <a class="btn btn-outline-primary" 
                                    href="{{ $etudiant->inscriptions->last()?->extrait_naissance == null ? '#' : asset(str_replace('public', 'storage', $etudiant->inscriptions->last()->extrait_naissance)) }}"
                                >
                                    Ext. nais. {{ $etudiant->inscriptions->last()?->extrait_naissance == null ? '(Aucun)' : '' }}
                                </a>
                            </div>
                            <div class="col-md-2">
                                <a 
                                    href="{{ $etudiant->inscriptions->last()?->bac_legalise == null ? '#' : asset(str_replace('public', 'storage', $etudiant->inscriptions->last()->bac_legalise)) }}" class="btn btn-outline-secondary"
                                >
                                    BAC {{ $etudiant->inscriptions->last()?->bac_legalise == null ? '(Aucun)' : '' }}
                                </a>    
                            </div>
                            <div class="col-md-2">
                                <a 
                                    href="{{ $etudiant->inscriptions->last()?->cp_note_bac == null ? '#' : asset(str_replace('public', 'storage', $etudiant->inscriptions->last()->cp_note_bac)) }}" 
                                    class="btn btn-outline-warning"
                                >
                                    Note BAC {{ $etudiant->inscriptions->last()?->cp_note_bac == null ? '(Aucun)' : '' }}
                                </a>
                            </div>
                            <div class="col-md-2">
                                <a 
                                    href="{{ $etudiant->inscriptions->last()?->fiche_inscription == null ? '#' : asset(str_replace('public', 'storage', $etudiant->inscriptions->last()->fiche_inscription)) }}" 
                                    class="btn btn-outline-secondary"
                                >
                                    Fiche inscription {{ $etudiant->inscriptions->last()?->fiche_inscription == null ? '(Aucun)' : '' }}
                                </a>
                            </div>
                            <div class="col-md-2">
                                <a 
                                    href="{{ $etudiant->inscriptions->last()?->fiche_oriantation == null ? '#' : asset(str_replace('public', 'storage', $etudiant->inscriptions->last()->fiche_oriantation)) }}" 
                                    class="btn btn-outline-secondary"
                                >
                                    Fiche orientation {{ $etudiant->inscriptions->last()?->fiche_oriantation == null ? '(Aucun)' : '' }}
                                </a>
                            </div>
                            <div class="col-md-2">
                                <a 
                                    href="{{ $etudiant->inscriptions->last()?->photo == null ? '#' : asset(str_replace('public', 'storage', $etudiant->inscriptions->last()->photo)) }}" 
                                    class="btn btn-outline-secondary"
                                >
                                    Photo {{ $etudiant->inscriptions->last()?->photo == null ? '(Aucun)' : '' }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


  @push('scripts')
  @endpush

@endsection
