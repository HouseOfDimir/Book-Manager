<table class="table table-bordered table-hover display" id="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Code</th>
            <th scope="col">Titre</th>
            <th scope="col">Auteur</th>
            <th scope="col">Genre</th>
            <th scope="col">Appartenance</th>
            <th scope="col">Etat actuel</th>
            <th scope="col">Modifier</th>
            <th scope="col">Supprimer</th>
        </tr>
    </thead>
    <tbody>
        @if($datas ?? '')
            @foreach($datas as $data)
                <tr>
                    <th scope="row">{{ $data->nom }}</th>
                    <th scope="row">{{ $data->prenom }}</th>
                    <th scope="row">{{ $data->adresse }}</th>
                    <th scope="row">{{ $data->zipcode }}</th>
                    <th scope="row">{{ $data->ville }}</th>
                    <th scope="row">{{ $data->age }}</th>
                    <td><a href="" class="btn btn-info linkToInfo"><i class="fas fa-info-circle"></i></a></td>
                    <td><a href="{{ route('books.toModifybook', $book->id) }}" class="btn btn-warning linkToEdit"><i class="fas fa-edit"></i></a></td>
                    <td><a href="{{ route('books.deletebook', $book->id) }}" class="btn btn-dark linkToDel"><i class="fas fa-trash"></i></a></td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>