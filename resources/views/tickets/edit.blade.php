<!DOCTYPE html>
<html lang="eng">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>Edit Ticket</title>
    </head>
    <body>
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
                        <option value="low" {{ old('priority', $ticket->priority) == 'low' ? 'selected' : '' }}>Low</option>
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