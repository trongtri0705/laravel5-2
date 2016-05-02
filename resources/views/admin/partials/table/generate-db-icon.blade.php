<form>
    {{ csrf_field() }}
    <a class="{{ isset($isDisable) && $isDisable ? 'dis-class' : '' }} generateDB btn label label-danger xad-ovr " data-token="{{ csrf_token() }}" data-id="{{ $id }}" data-url="{{ route('admin::user::generateDB') }}">Generate DB</a>
</form>
