<?php

use Modules\Backend\Entities\SendMoney;

function spanByStatus($status, $withPull = ''): string
{

    switch ($status) {
        case 'yes':
        case '1':
            $labelClass = 'bg-green';
            $labelName = 'Active';
            break;
        case 'no';
        case '0':
            $labelClass = 'bg-yellow';
            $labelName = 'Inactive';
            break;
        case SendMoney::PENDING:
        case SendMoney::READY_TO_TRANSFERRED:
        case SendMoney::READY_TO_COLLECT:
            $labelClass = 'bg-yellow';
            $labelName = $status;
            break;
        case SendMoney::PAID:
        case SendMoney::COMPLETED:
        case SendMoney::TRANSFERRED:
            $labelClass = 'bg-green';
            $labelName = $status;
            break;
        case SendMoney::HOLD:
        case SendMoney::CANCELLED:
            $labelClass = 'bg-red';
            $labelName = $status;
            break;
        default:
            $labelClass = 'bg-blue';
            $labelName = $status;

    }
    return '<span style="cursor: default;"
        class="label btn btn-flat  ' . $labelClass . ' ' . ($withPull) . '">'
        . ucfirst($labelName) . '</span>';
}
