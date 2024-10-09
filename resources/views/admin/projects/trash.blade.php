@extends('layouts.app')


@section('content')
    @if (session('delete_confirm'))
        <div class="alert alert-success" role="alert">
            {{ session('delete_confirm') }}
        </div>
    @endif


    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome Progetto</th>
                <th scope="col">Progetto di tipo</th>
                <th scope="col">Tecnologie</th>
                <th scope="col">Data di inizio</th>
                <th scope="col">Link Repository</th>
                <th scope="col">Tools</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <th scope="row">{{ $project->id }}</th>
                    <td>{{ $project->name }}</td>
                    <td>
                        @if ($project->type)
                            <span style="cursor: default" class="btn btn-sm btn-info">{{ $project->type?->name }}</span>
                        @else
                        @endif
                    </td>
                    <td>
                        @forelse ($project->technologies as $tech)
                            <span style="cursor: default" class="btn btn-sm btn-primary">{{ $tech->name }}</span>
                        @empty
                        @endforelse
                    </td>
                    <td>{{ date('d/m/Y', strtotime($project->start_date)) }}</td>
                    <td><a href="{{ $project->repo_link }}">Vai alla repo</a></td>
                    <td>

                        <form class="d-inline" action="{{ route('admin.projects.restore', $project->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success">Ripristina</button>
                        </form>

                        <form class="d-inline" action="{{ route('admin.projects.delete', $project->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Elimina</button>
                        </form>

                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $projects->links() }}
    </div>
@endsection
