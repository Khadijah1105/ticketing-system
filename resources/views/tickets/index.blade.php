<!DOCTYPE html>
<html lang="eng">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>Ticket Dashboard</title>
    </head>
    <body>
        <div class="container mt-3">
            <nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom border-dark" style="background-color: #e3f2fd;" data-bs-theme="light">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('tickets.index') }}">Tickets</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('tickets.create') }}">Create</a>
                            </li>
                        </ul>
                        {{-- <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form> --}}
                    </div>
                </div>
            </nav>
        </div>
        <div class="container mt-5 center-text">
            <h1>Tickets</h1>
            {{-- <div class="mt-3">
                <a href="{{ route('tickets.create') }}" class="btn btn-light">Create Ticket</a>
            </div> --}}
            <div class="mt-5">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align:center" scope="col">No</th>
                            <th style="text-align:center" scope="col">Title</th>
                            <th style="text-align:center" scope="col">Status</th>
                            <th style="text-align:center" scope="col">Priority</th>
                            <th style="text-align:center" scope="col" colspan="3" >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tickets as $index => $ticket)
                        <tr>
                            <td>{{ ($tickets->currentPage() - 1) * $tickets->perPage() + $index + 1 }}</td>
                            <td>{{ $ticket->title }}</td>
                            <td>{{ ucwords(str_replace('_', ' ', $ticket->status)) }}</td>
                            <td>{{ ucwords($ticket->priority) }}</td>
                            <td><a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-primary">View</a></td>
                            <td><a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-secondary">Edit</a></td>
                            <td>
                                <!-- Trigger modal -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $ticket->id }}">
                                    Delete
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal{{ $ticket->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $ticket->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $ticket->id }}">Delete Ticket</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this ticket?
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $tickets->links() }}
            </div>
            <div class="d-flex justify-content-center small text-muted">
                Showing {{ $tickets->firstItem() }} to {{ $tickets->lastItem() }} of {{ $tickets->total() }} results
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>