<li>{{ $sub_tasks->title }}</li>
@if ($sub_tasks->parent)
    <ul>
        @foreach ($sub_tasks->parent as $sub_task)
            @include('backend.pages.sub_tasks', ['sub_tasks' => $sub_task])
        @endforeach
    </ul>
@endif