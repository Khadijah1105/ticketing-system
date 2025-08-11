<!DOCTYPE html>
<html lang="eng">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Ticket Detail</title>
    </head>
    <body>
        <div class="container mt-3">
            <nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom border-dark">
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
                    </div>
                </div>
            </nav>
        </div>
        <div class="container mt-5">
            <h1>Ticket Detail</h1>
            {{-- <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $ticket->title }}</h5>
                    <p class="card-text"><strong>Description:</strong> {{ $ticket->description }}</p>
                    <p class="card-text"><strong>Priority:</strong> {{ ucfirst($ticket->priority) }}</p>
                    <p class="card-text"><strong>Status:</strong> {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}</p>
                    <p class="card-text"><strong>Created At:</strong> {{ $ticket->created_at->format('Y-m-d H:i') }}</p>
                    <a href="{{ route('tickets.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div> --}}
            <table class="table table-bordered">
                <tr>
                    <th>Title</th>
                    <td>{{ $ticket->title }}</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>{{ $ticket->description }}</td>
                </tr>
                <tr>
                    <th>Priority</th>
                    <td>{{ ucwords($ticket->priority) }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ ucwords(str_replace('_', ' ', $ticket->status)) }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $ticket->created_at->setTimezone('Asia/Kuala_Lumpur')->format('d F Y h:i A') }}</td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td>{{ $ticket->updated_at->setTimezone('Asia/Kuala_Lumpur')->format('d F Y h:i A') }}</td>
                </tr>
            </table>
            <a href="{{ route('tickets.index') }}" class="btn btn-warning">Back to List</a>
        </div>
    </body>
</html>