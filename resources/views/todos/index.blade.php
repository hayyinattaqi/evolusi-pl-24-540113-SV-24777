<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>To Do List</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 40px auto; }
        h1 { text-align: center; }
        form { display: flex; gap: 8px; margin-bottom: 20px; }
        input[type="text"] { flex: 1; padding: 8px; }
        button { padding: 8px 12px; cursor: pointer; }
        ul { list-style: none; padding: 0; }
        li { display: flex; justify-content: space-between; align-items: center; padding: 8px; border-bottom: 1px solid #ddd; }
        .done { text-decoration: line-through; color: gray; }
        .actions form { display: inline; margin: 0; }
    </style>
</head>
<body>
    <h1>To Do List</h1>

    <form action="{{ route('todos.store') }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Tambah tugas baru..." required>
        <button type="submit">Tambah</button>
    </form>

    <ul>
        @forelse ($todos as $todo)
            <li>
                <span class="{{ $todo->is_done ? 'done' : '' }}">
                    {{ $todo->title }}
                </span>
                <span class="actions">
                    <form action="{{ route('todos.update', $todo) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit">
                            {{ $todo->is_done ? 'Batal' : 'Selesai' }}
                        </button>
                    </form>
                    <form action="{{ route('todos.destroy', $todo) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </span>
            </li>
        @empty
            <li>Belum ada tugas.</li>
        @endforelse
    </ul>
</body>
</html>