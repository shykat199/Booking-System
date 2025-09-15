@extends('layouts.app')
@push('style')
    <style>
        :root {
            --primary: #5e72e4;
            --secondary: #8392ab;
            --success: #2dce89;
            --danger: #f5365c;
            --dark: #344767;
            --light: #f8f9fa;
        }


        .header {
            background: #308e87;
            color: white;
            padding: 1rem;
            border-radius: 12px 12px 0 0;
        }

        .task-input-container {
            background: white;
            padding: 1rem;
            border-bottom: 1px solid #e9ecef;
        }

        .task-list {
            background: white;
            padding: 0;
            margin: 0;
            max-height: 400px;
            overflow-y: auto;
        }

        .task-item {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .task-item:hover {
            background-color: #f8f9fa;
        }

        .task-item.completed .task-text {
            text-decoration: line-through;
            color: var(--secondary);
        }

        .task-text {
            flex-grow: 1;
            margin: 0 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .task-actions {
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .task-item:hover .task-actions {
            opacity: 1;
        }

        .stats {
            background: white;
            padding: 1rem 1.5rem;
            border-top: 1px solid #e9ecef;
            border-radius: 0 0 12px 12px;
        }

        .btn-add {
            background: var(--primary);
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 14px rgba(50, 50, 93, 0.1), 0 3px 6px rgba(0, 0, 0, 0.08);
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #e9ecef;
        }

        .custom-control-input:checked ~ .custom-control-label::before {
            background-color: var(--success);
            border-color: var(--success);
        }

        .custom-checkbox .custom-control-label::before {
            border-radius: 50%;
        }

        .btn-action {
            background: transparent;
            border: none;
            color: var(--secondary);
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .btn-action:hover {
            background: #e9ecef;
            color: var(--dark);
        }

        .btn-delete:hover {
            color: var(--danger);
        }

        /* Animation for new tasks */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .task-item {
            animation: fadeIn 0.3s ease;
        }
    </style>
@endpush
@section('content')

    <div class="page-body">
        <div class="container-fluid default-dashboard">
            <div class="container mt-2">
                <div class="header">
                    <h2 class="mb-0"><i class="fas fa-tasks mr-2"></i> Task Manager</h2>
                    <p class="mb-0 mt-1">Organize your tasks efficiently</p>
                </div>

                <div class="task-input-container">
                    <div class="input-group">
                        <input type="text" class="form-control" id="taskInput" placeholder="Enter a new task..."
                               aria-label="Enter a new task">
                        &nbsp;&nbsp;
                        <div class="input-group-append">
                            <button class="btn btn-primary btn-add" type="button" id="addTaskBtn">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="task-filters mt-3">
                        <a href="{{route('tasks',['type'=>'all'])}}" class="btn btn-outline-primary btn-sm filter-btn" data-filter="all">All</a>
                        <a href="{{route('tasks',['type'=>'completed'])}}" class="btn btn-outline-success btn-sm filter-btn" data-filter="completed">Completed</a>
                        <a href="{{route('tasks',['type'=>'pending'])}}" class="btn btn-outline-warning btn-sm filter-btn" data-filter="pending">Pending</a>
                    </div>

                </div>

                <ul class="task-list" id="taskList">
                    @foreach($tasks as $key => $task)
                        @include('partials.task-item', ['task' => $task])
                    @endforeach
                </ul>

                <div class="stats d-flex justify-content-between">
                    <span id="tasksRemaining" style="color: #308e87">0 tasks remaining</span>
                    <span id="completedTasks" style="color: #308e87">0 task completed</span>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        $(document).ready(function() {

            function updateCounters() {
                const totalTasks = $('.task-item').length;
                const completedTasks = $('.task-item.completed').length;
                const remainingTasks = totalTasks - completedTasks;

                $('#tasksRemaining').text(`${remainingTasks} task${remainingTasks !== 1 ? 's' : ''} remaining`);
                $('#completedTasks').text(`${completedTasks} task${completedTasks !== 1 ? 's' : ''} completed`);
            }

            $('#addTaskBtn').click(function() {
                const taskText = $('#taskInput').val().trim();
                if (taskText) {

                    let btn = $(this);
                    let originalHtml = btn.html();
                    btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                    btn.prop('disabled', true);

                    saveTask('add', taskText, btn, originalHtml);

                    updateCounters();
                }
            });

            $('#taskInput').keypress(function(e) {
                if (e.which === 13) {
                    $('#addTaskBtn').click();
                }
            });

            $('#taskList').on('click', '.task-text', function() {
                const taskItem = $(this).closest('.task-item');
                const taskId = taskItem.attr('data-taskId');
                const isCompleted = taskItem.hasClass('completed');

                if (isCompleted) {
                    taskItem.removeClass('completed');
                    $(this).prev().find('input[type="checkbox"]').prop('checked', false);
                } else {
                    taskItem.addClass('completed');
                    $(this).prev().find('input[type="checkbox"]').prop('checked', true);
                }

                updateStatus('update', taskId, !isCompleted);

                updateCounters();
            });

            $('#taskList').on('change', 'input[type="checkbox"]', function() {
                const taskItem = $(this).closest('.task-item');
                const taskId = taskItem.attr('data-taskId');
                const isCompleted = taskItem.hasClass('completed');

                if (isCompleted) {
                    taskItem.addClass('completed');
                } else {
                    taskItem.removeClass('completed');
                }

                updateStatus('update', taskId, !isCompleted);

                updateCounters();
            });

            $('#taskList').on('click', '.btn-delete', function(e) {
                e.stopPropagation();
                const taskItem = $(this).closest('.task-item');
                const taskId = taskItem.attr('data-taskId');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This task will be deleted!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    deleteTask('delete', taskId, taskItem);
                });

            });

            function saveTask(action, taskText, btn = null, originalHtml = null) {

                $.ajax({
                    url: `{{route('save-tasks')}}`,
                    method: 'POST',
                    data: {
                        action: action,
                        task: taskText,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.html) {
                            $('#taskList').prepend(response.html);
                            $('#taskInput').val('');
                            updateCounters();

                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: response.message || 'Task saved successfully!',
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true
                            });

                            btn.html(originalHtml);
                            btn.prop('disabled', false);
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: msg,
                            showConfirmButton: false,
                            timer: 2500,
                            timerProgressBar: true
                        });
                    }
                });
            }

            function updateStatus(action, taskId, status) {

                let url = '/tasks/:id/update'.replace(':id', taskId);

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        completed: status,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            updateCounters();
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: response.message || 'Task updated successfully!',
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: msg,
                            showConfirmButton: false,
                            timer: 2500,
                            timerProgressBar: true
                        });
                    }
                });
            }

            function deleteTask(action, taskId, taskItem) {

                let url = '/tasks/:id/delete'.replace(':id', taskId);

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            taskItem.remove();

                            updateCounters();

                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: response.message || 'Task deleted successfully!',
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: msg,
                            showConfirmButton: false,
                            timer: 2500,
                            timerProgressBar: true
                        });
                    }
                });
            }

            updateCounters();
        });
    </script>
@endpush
