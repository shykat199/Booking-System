<li class="task-item {{$task->is_completed ? 'completed':''}}" data-taskId="{{ $task->id }}">
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" data-taskId = "{{$task->id}}" id="task{{ $task->id }}" {{$task->is_completed ? 'checked':''}}>
        <label class="custom-control-label" for="task{{ $task->id }}"></label>
    </div>
    <span class="task-text">{{ $task->title }}</span>

    <small class="text-muted me-3" title="{{ $task->created_at }}">
        {{ $task->created_at->diffForHumans() }}
    </small>

    <div class="task-actions">
        <button class="btn-action btn-delete text-danger"><i class="fas fa-trash"></i></button>
    </div>
</li>
