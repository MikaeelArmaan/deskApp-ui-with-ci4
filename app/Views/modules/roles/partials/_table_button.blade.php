<div class="dropdown">
    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button"
        data-toggle="dropdown">
        <i class="dw dw-more"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
        <a class="dropdown-item text-warning btn-edit" href="#" data-items="{{ json_encode($data) }}"
            data-url="{{ route_to('roles.update', $data->id) }}"><i class="dw dw-edit2"></i> Edit</a>
        <a class="dropdown-item text-danger" href="#" data-url="{{ route_to('roles.delete', $data->id) }}"><i
                class="dw dw-delete-3"></i> Delete</a>
    </div>
</div>
