<!DOCTYPE html>
<html>
<head>
    <title>Task App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 40px;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 600px;
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        form.add-task {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        input[type="text"] {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            outline: none;
        }

        button {
            padding: 10px 14px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        .add-btn {
            background: #4CAF50;
            color: white;
        }

        .task {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px;
            margin-bottom: 10px;
            background: #fafafa;
            border: 1px solid #eee;
            border-radius: 8px;
        }

        .task-title {
            flex: 1;
            margin-left: 10px;
            color: #333;
        }

        .done-btn {
            background: #2196F3;
            color: white;
        }

        .delete-btn {
            background: #f44336;
            color: white;
            margin-left: 5px;
        }

        .logout {
            margin-top: 20px;
            text-align: center;
        }

        .logout button {
            background: #555;
            color: white;
            width: 100%;
        }

        form {
            margin: 0;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Task Manager</h1>

    <!-- Add Task -->
    <form method="POST" action="/tasks" class="add-task">
        @csrf
        <input type="text" name="title" placeholder="New Task" required>
        <button class="add-btn">Add</button>
    </form>

    <!-- Task List -->
    @foreach($tasks as $task)
    <div class="task">

        <!-- Toggle Done -->
        <form method="POST" action="/tasks/{{ $task->id }}">
            @csrf
            @method('PATCH')
            <button class="done-btn">
                {{ $task->is_done ? '✔ Done' : '❌ Pending' }}
            </button>
        </form>

        <!-- Title -->
        <div class="task-title">
            {{ $task->title }}
        </div>

        <!-- Delete -->
        <form method="POST" action="/tasks/{{ $task->id }}">
            @csrf
            @method('DELETE')
            <button class="delete-btn">Delete</button>
        </form>

    </div>
    @endforeach

    <!-- Logout -->
    <div class="logout">
        <form method="POST" action="/logout">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>

</div>

</body>
</html>