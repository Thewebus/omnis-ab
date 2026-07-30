<div class="col-4 table-wrapper-scroll-y my-custom-scrollbar">
    @if (!empty($ueId))
        <h6>UE : {{ $ueNom }}</h6>

        @if (session()->has('message'))
            <div class="my-3"><div class="alert alert-success">{{ session('message') }}</div></div>
        @endif
        @if (session()->has('error'))
            <div class="my-3"><div class="alert alert-danger">{{ session('error') }}</div></div>
        @endif

        @if (!empty($dataEtudiants))
            <form wire:submit.prevent="postSession2">
                @csrf
                <div class="table-responsive">
                    <table class="table">
                        <thead class="bg-primary">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom & Prénoms</th>
                                <th scope="col">Matière(s)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataEtudiants as $etudiant)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $etudiant['fullname'] }}</td>
                                    <td>
                                        @foreach ($etudiant['matieres'] as $matiere)
                                            <div class="mb-2">
                                                <label class="mb-0">{{ $matiere['nom'] }}</label>
                                                <input class="form-control" type="number" step="0.01" min="0" max="20"
                                                    wire:model="notes.{{ $etudiant['id'] }}.{{ $matiere['id'] }}"
                                                    placeholder="Note session 2" />
                                            </div>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block my-3 float-right">
                        <i class="fa fa-save"></i> Enregistrer les notes
                    </button>
                </div>
            </form>
        @else
            <h4 class="mt-5">Aucun étudiant à repasser pour cette UE.</h4>
        @endif
    @else
        <h4 class="mt-5">Sélectionner une UE.</h4>
    @endif
</div>
