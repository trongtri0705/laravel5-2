@if ($delLink)
    <form action="{{ $delLink }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}

        <button class="btn label label-danger xad-ovr {{ isset($delClass) ? $delClass : '' }}"
                onclick="return confirm('{{ isset($warningDelMsg) && $warningDelMsg ? $warningDelMsg : 'Are you sure you want to delete this item?' }}');">Delete</button>
    </form>
@endif

<a href="{{ $editLink }}" class="edit label label-primary xad-ovr">Edit</a>

@if (isset($showLink))
    <a href="{{ $showLink }}" class="view label btn bg-olive xad-ovr">View</a>
@endif



