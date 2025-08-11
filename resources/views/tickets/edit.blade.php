<!DOCTYPE html>
<html lang="eng">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>Edit Ticket</title>
    </head>
    <body>
        <div class="container mt-3">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
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
            <h1>Edit Ticket</h1>
            <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{old('title', $ticket->title)}}" required>
                </div>
                <div class="mb-3">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="5" required>{{old('description', $ticket->description)}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="priority">Priority</label>
                    <select class="form-select" id="priority" name="priority" required>
                        <option value="low" {{ old('priority', $ticket->priority) == 'low' ? 'selected' : '' }}>Low</option> <!--ternary operator to check if the old value matches expression1 correct, return expression2. If false, return expression3-->
                        <option value="medium" {{ old('priority', $ticket->priority) == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ old('priority', $ticket->priority) == 'high' ? 'selected' : '' }}>High</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="status">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="open" {{ old('status', $ticket->status) == 'open' ? 'selected' : '' }}>Open</option>
                        <option value="in_progress" {{ old('status', $ticket->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="closed" {{ old('status', $ticket->status) == 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>
    </body>
</html>