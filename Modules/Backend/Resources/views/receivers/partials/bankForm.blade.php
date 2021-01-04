<tr class="bank_tr">
    <td>
        <div class="form-group">
            {!! Form::select('bank_id[]',$selectBanks,$bank->bank_id ?? null
            ,['class'=>'form-control select2 rounded-0 ',
            'style'=>'width:100%','placeholder'=>'Select Bank']) !!}
        </div>

    </td>
    <td>
        <div class="form-group">
            {!! Form::text('account_name[]', $bank->account_name ?? '',['class'=>'form-control rounded-0',
            'style'=>'width:100%','placeholder'=>'Enter Account Name']) !!}
        </div>
    </td>
    <td>
        <div class="form-group">
            {!! Form::text('branch[]', $bank->branch ?? '',['class'=>'form-control rounded-0',
            'style'=>'width:100%','placeholder'=>'Enter Branch']) !!}
        </div>
    </td>
    <td>
        <div class="form-group">
            {!! Form::number('account_number[]', $bank->account_number ?? '',['class'=>'form-control rounded-0',
            'style'=>'width:100%','placeholder'=>'Enter Account Number']) !!}
        </div>
    </td>
    <td>
        <div class="form-group">
            <label>
                <input type="hidden" value="{{$bank->is_default ?? '0'}}" name="is_default[]">
                {!! Form::checkbox('is_default[]', $bank->is_default ?? '1' , ['class'=>'iCheck']) !!}
            </label>
        </div>

    </td>
    <td>
        <button class="btn btn-danger btn-flat btn-sm deleteRow" type="button">
            <i class="fa fa-times"></i>
        </button>
    </td>
</tr>
