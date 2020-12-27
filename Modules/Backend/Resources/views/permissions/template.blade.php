<tr>
    <th class="text-center">{{ucwords(str_replace('-',' ',$permission_name))}}</th>
    @foreach($access as $key)
        <td class="text-center">
            <div class="checkbox icheck">
                <label>
                    {{ Form::checkbox('permission[]',
                    $permission_name.'-'.$key,
                    isset($permissions) &&
                     $permissions->contains($permission_name.'-'.$key),
                     ['class' => $key.'-access access-permission iCheck']) }}
                </label>
            </div>
        </td>
    @endforeach

</tr>
