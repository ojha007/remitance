<table class="table table-bordered table-condensed">
    <tbody>
    <tr>
        <th class=" text-center">Permissions</th>
        <th class="text-center">View</th>
        <th class=" text-center">Create</th>
        <th class=" text-center">Edit</th>
        <th class=" text-center">Delete</th>
    </tr>
    @php($access = [
        'view','create','edit','delete'
        ])
    @foreach($classes as $class)
        @include('backend::permissions.template',
            ['permission_name'=>$class,'access'=>$access])
    @endforeach
    </tbody>
</table>
{{--</div>--}}
@push('scripts')
    <script>
        $(document).ready(function () {
            $('.view-access').on('ifChanged', function (event) {
                if (!this.checked) {
                    $(this).closest('tr').find('input.create-access').prop('checked', this.checked).iCheck('update');
                    $(this).closest('tr').find('input.edit-access').prop('checked', this.checked).iCheck('update');
                    $(this).closest('tr').find('input.delete-access').prop('checked', this.checked).iCheck('update');
                    $(this).closest('tr').find('input.approve-access').prop('checked', this.checked).iCheck('update');
                    $(this).closest('tr').find('input.full-access').prop('checked', this.checked).iCheck('update');
                }
            });
            $('.create-access').on('ifChanged', function (event) {
                if (this.checked) {
                    $(this).closest('tr').find('input.view-access').prop('checked', this.checked).iCheck('update');
                } else {
                    $(this).closest('tr').find('input.edit-access').prop('checked', this.checked).iCheck('update');
                    $(this).closest('tr').find('input.delete-access').prop('checked', this.checked).iCheck('update');
                    $(this).closest('tr').find('input.full-access').prop('checked', this.checked).iCheck('update');
                }
            });
            $('.edit-access').on('ifChanged', function (event) {
                if (this.checked) {
                    $(this).closest('tr').find('input.view-access').prop('checked', this.checked).iCheck('update');
                    $(this).closest('tr').find('input.create-access').prop('checked', this.checked).iCheck('update');
                } else {
                    $(this).closest('tr').find('input.delete-access').prop('checked', this.checked).iCheck('update');
                    $(this).closest('tr').find('input.full-access').prop('checked', this.checked).iCheck('update');
                }
            });
            $('.delete-access').on('ifChanged', function (event) {
                if (this.checked) {
                    $(this).closest('tr').find('input.view-access').prop('checked', this.checked).iCheck('update');
                    $(this).closest('tr').find('input.create-access').prop('checked', this.checked).iCheck('update');
                    $(this).closest('tr').find('input.edit-access').prop('checked', this.checked).iCheck('update');
                    $(this).closest('tr').find('input.full-access').prop('checked', this.checked).iCheck('update');
                } else {
                    $(this).closest('tr').find('input.full-access').prop('checked', this.checked).iCheck('update');
                }
            });


        });

    </script>
@endpush
