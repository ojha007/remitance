<tr class="bank_tr">
    <td>

        {!! Form::select('bank_id[]',$selectBanks,$bank->bank_id ?? null
        ,['class'=>'form-control select2 rounded-0 ',
        'style'=>'width:100%','placeholder'=>'Select Bank']) !!}

    </td>
    <td>

        {!! Form::text('account_name[]', $bank->account_name ?? '',['class'=>'form-control rounded-0',
        'style'=>'width:100%','placeholder'=>'Enter Account Name']) !!}

    </td>
    <td>

        {!! Form::text('branch[]', $bank->branch ?? '',['class'=>'form-control rounded-0',
        'style'=>'width:100%','placeholder'=>'Enter Branch']) !!}

    </td>
    <td>

        {!! Form::number('account_number[]', $bank->account_number ?? '',['class'=>'form-control rounded-0',
        'style'=>'width:100%','placeholder'=>'Enter Account Number']) !!}

    </td>
    <td>
        <label>
            <input type="hidden" value="{{$bank->is_default ?? '0'}}" name="is_default[]">
                {!! Form::checkbox('is_default[]', $bank->is_default ?? '1' , ['class'=>'iCheck']) !!}
        </label>

    </td>
    <td>
        <button class="btn btn-danger btn-flat btn-sm deleteRow" type="button">
            <i class="fa fa-times"></i>
        </button>
    </td>
</tr>
